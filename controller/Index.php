<?php

class Index
{

    public function __construct()
    {
        @session_start();
    }

    // public function fix() {
    //     $farmacias = (new Factory('farmacia'))->select('farmacia_id, farmacia_cnpj')->get();
    //     foreach($farmacias as $k => $v) {
    //         $with = [
    //             'id' => $v->farmacia_id,
    //             'cnpj' => $this->mask($v->farmacia_cnpj, '99.999.999/9999-99')
    //         ];
    //         (new Factory('farmacia'))->with($with)->save();
    //     }
    // }

    public function mask($val, $mask) {
        $maskared = '';
        $k = 0;
        for($i = 0; $i<=strlen($mask)-1; $i++) {
            if($mask[$i] == '9') {
                if(isset($val[$k])) $maskared .= $val[$k++];
            } else {
                if(isset($mask[$i])) $maskared .= $mask[$i];
            }
        }
        return $maskared;
    }

    public function indexAction()
    {
        $data = [
            // Principal
            'mapper' => [],
        ];

        Tpl::view("tema.optionmaker.home.index", $data);
    }

    public function viewInfo()
    {
        Auth::validator();
        $info = Http::get_in_params('info', 'int');
        if (isset($info->value) && !empty($info->value) && $info->value > 0 && $info->value <= 4) {
            $info = intval($info->value);
            $data = [
                'mapper' => [],
            ];

            Tpl::view("tema.optionmaker.quiz.info{$info}", $data);
        } else {
            $data = [
                'mapper' => [],
            ];

            Tpl::view("tema.optionmaker.quiz.info1", $data);
        }
    }

    public function viewQuiz()
    {
        Auth::validator();
        $perguntas = $this->get_random_perguntas();

        $data = [
            'perguntas' => $perguntas,
            'mapper' => [],
        ];

        Tpl::view("tema.optionmaker.quiz.index", $data);
    }

    public function viewVideo()
    {
        Auth::validator();
        $data = [
            'mapper' => [],
        ];

        Tpl::view("tema.optionmaker.quiz.video", $data);
    }

    public function get_random_perguntas()
    {
        if (isset($_SESSION['quiz_perguntas']) && !empty($_SESSION['quiz_perguntas'])) {
            return $_SESSION['quiz_perguntas'];
        } else {
            $perguntas = (new Factory('pergunta'))->order("RAND() LIMIT 7")->get();
            if (isset($perguntas[0])) {
                foreach ($perguntas as $k => $v) {
                    $perguntas[$k]->alternativas = (new Factory('alternativa'))->where("alternativa_pergunta = " . $v->pergunta_id)->order("alternativa_indicador")->get();
                }
                $_SESSION['quiz_perguntas'] = $perguntas;
                return $_SESSION['quiz_perguntas'];
            }
            return null;
        }
    }

    public function escolhe_alternativas()
    {

        if (intval($_SESSION['tentativas_realizadas']) >= intval($_SESSION['tentativas_restantes'])) {
            echo json_encode(['status' => 400, 'session' => $_SESSION]);
            exit;
        }
        $_SESSION['tentativas_realizadas']++;
        $respostas = Req::post('respostas');
        $acertos = 0;
        $participante_resposta = [];
        // reseta os acertos
        (new Factory("participante_resposta"))
            ->where("participante_resposta_participante = " .  intval(ClientSession::node('uid')))
            ->drop();
        foreach ($respostas as $res) {
            $with = [
                'participante' => ClientSession::node('uid'),
                'pergunta' => $res['pergunta_id'],
                'resposta' => $res['alternativa_id'],
                'certa' => 0
            ];
            $alternativa = (new Factory('alternativa'))->find($res['alternativa_id']);
            if (isset($alternativa->alternativa_id) && $alternativa->alternativa_correta == 1) {
                $acertos++;
                $with['certa'] = 1;
            }
            $participante_resposta[] = $with;
        }
        (new Factory('participante_resposta'))->with($participante_resposta)->save();
        $with = [
            'id' => ClientSession::node('uid'),
            'acertos' => $acertos,
            'hora_voto' => date("Y-m-d H:i:s")
        ];
        (new Factory('participante'))->with($with)->save();
        $_SESSION['acertos'] = $acertos;
        echo json_encode(['status' => 200]);
    }

    public function agradecimentos()
    {
        Auth::validator();
        unset($_SESSION["quiz_perguntas"]);
        if (isset($_SESSION['acertos'])) {
            $tentativas_restantes = $_SESSION['tentativas_restantes'] - $_SESSION['tentativas_realizadas'];
            $acertos = $_SESSION['acertos'];
            // echo "acertos: " . $acertos . "<br>";
            // echo "tentativas_restantes: " . $tentativas_restantes . "<br>";
            // exit;
            if ($acertos == 3) {
                $this->clear();
                $msg = 'Nossa equipe entregará seu presente exclusivo.';
            } else {
                $msg = 'Foi quase! Agradecemos sua participação!';
            }

            if($tentativas_restantes == 0) {
                $this->clear();
            }


            $data = [
                'acertos' => $acertos,
                'tentativas_restantes' => $tentativas_restantes ,
                'msg' => $msg,
                'mapper' => [],
            ];

            Tpl::view("tema.optionmaker.quiz.agradecimentos", $data);
        } else {
            $data = [
                'acertos' => 0,
                'tentativas_restantes' => 0,
                'msg' => "Foi quase! Agradecemos sua participação!",
                'mapper' => [],
            ];
            Tpl::view("tema.optionmaker.quiz.agradecimentos", $data);
        }
    }

    public function clear()
    {
        unset($_SESSION["client_node"]);
        unset($_SESSION["tentativas_restantes"]);
        unset($_SESSION["tentativas_realizadas"]);
        unset($_SESSION["acertos"]);
    }

    public function termos()
    {
        $file = Path::base() . '/media/files/termos.pdf';
        $filename = 'Termos de uso.pdf';

        header('Content-type: application/pdf');
        header('Content-Disposition: inline; filename="' . $filename . '"');
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: ' . filesize($file));
        header('Accept-Ranges: bytes');

        @readfile($file);
    }
}

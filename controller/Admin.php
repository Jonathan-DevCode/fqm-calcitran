<?php

class Admin
{
    public function __construct()
    {
        @session_start();
    }

    public function check()
    {
        if (!Session::check() || !Session::node('uid')) {
            Session::destroy();
            Http::redirect_to('/admin/login');
        }
    }

    public function login()
    {
        $data = [
            'mapper' => []
        ];
        Tpl::view('admin.pages.login.index', $data, 1);
    }

    public function __addUser()
    {
        Http::redirect_to('/');
        $with = [
            'login' => 'admin',
            'senha' => md5('admin')
        ];
        (new Factory('admin'))->with($with)->save();
        echo 'Usuário salvo';
    }

    public function indexAction()
    {
        $this->check();
        $data = [            
            'mapper' => []
        ];
        Tpl::view('admin.pages.dashboard.index', $data, 1);
    }

    public function listar_participantes_old() {
        (new Factory('participante', 1))
            ->select("
                participante.*, DATE_FORMAT(participante_resposta_created, '%d/%m/%Y às %H:%i') AS horario_resposta,
                DATE_FORMAT(participante_created, '%d/%m/%Y às %H:%i') AS participante_created_formated,
                (SELECT COUNT(*) FROM participante_resposta WHERE participante_resposta_participante = participante_id AND participante_resposta_certa = 1) AS participante_qtd_acertos")
            ->join("participante_resposta", "participante_resposta_participante = participante_id", "LEFT")
            ->group_by("participante_id")
            ->order("participante_qtd_acertos DESC")
            ->get(1);
    }

    public function listar_participantes_old2() {
        $participantes = (new Factory('participante'))
            ->select("participante.*, DATE_FORMAT(participante_created, '%d/%m/%Y às %H:%i') AS participante_created_formated")                                    
            ->get();
        
        // recupera os acertos e a data do voto
        $votos = (new Factory("participante_resposta"))
            ->select("participante_resposta_participante, participante_resposta_certa, DATE_FORMAT(participante_resposta_created, '%d/%m/%Y às %H:%i') AS horario_resposta")
            // ->where("participante_resposta_certa = 1")
            ->get();
        
        $votos_indexed = [];
        if(isset($votos[0])) {
            foreach($votos as $voto) {
                
                if(isset($votos_indexed[$voto->participante_resposta_participante])) {
                    if($voto->participante_resposta_certa == 1 && $votos_indexed[$voto->participante_resposta_participante]->qtd_acertos < 3) {
                        $votos_indexed[$voto->participante_resposta_participante]->qtd_acertos++;
                    }
                    // ja existe o indice de voto daquele participante, com 1 acerto
                } else {
                    // cria o indice de voto
                    $votos_indexed[$voto->participante_resposta_participante] = new stdClass();
                    $votos_indexed[$voto->participante_resposta_participante]->horario_resposta = $voto->horario_resposta;

                    if($voto->participante_resposta_certa == 1) {
                        $votos_indexed[$voto->participante_resposta_participante]->qtd_acertos = 1;
                    } else {
                        $votos_indexed[$voto->participante_resposta_participante]->qtd_acertos = 0;
                    }
                }
            }
        }

        // insere os votos em seus respectivos participantes
        if(isset($participantes[0])) {
            foreach($participantes as $k => $v) {
                if(isset($votos_indexed[$participantes[$k]->participante_id])) {
                    $participantes[$k]->participante_qtd_acertos = $votos_indexed[$participantes[$k]->participante_id]->qtd_acertos;
                    $participantes[$k]->horario_resposta = $votos_indexed[$participantes[$k]->participante_id]->horario_resposta;
                } else {
                    $participantes[$k]->participante_qtd_acertos = 0;
                    $participantes[$k]->horario_resposta = null;
                }
            }
        }

        // ordena pelos acertos
        $acertos = [];
        if(isset($participantes[0])) {
            foreach($participantes as $key => $row) {
                $acertos[$key] = $row->participante_qtd_acertos;
            }
        }

        array_multisort($acertos, SORT_DESC, $participantes);


        echo json_encode($participantes);
    }

    public function listar_participantes() {
        $participantes = (new Factory('participante'))
            ->select("participante.*, DATE_FORMAT(participante_created, '%d/%m/%Y às %H:%i') AS participante_created_formated, DATE_FORMAT(participante_hora_voto, '%d/%m/%Y às %H:%i') AS horario_resposta")          
            ->order("participante_acertos DESC")                          
            ->get();
        if(isset($participantes[0])) {
            foreach($participantes as $k => $v) {
                $participantes[$k]->participante_cpf = base64_decode($participantes[$k]->participante_cpf);
            }
        }

        echo json_encode($participantes);
    }

   
    // public function relatorio()
    // {
    //     $this->check();
    //     $candidatos = (new Factory('candidato'))->select("*, (SELECT COUNT(*) FROM voto WHERE voto_candidato = candidato_id) AS candidato_qtd_votos")->order("candidato_qtd_votos DESC, candidato_gen ASC")->get();
    //     $votos_brancos = (new Factory('voto'))->where("voto_candidato = 0")->get();
    //     $votos_brancos = isset($votos_brancos[0]) ? sizeof($votos_brancos) : '0';
    //     $data = [
    //         'candidatos' => $candidatos,
    //         'votos_branco' => $votos_brancos,
    //         'mapper' => []
    //     ];
    //     Tpl::view('admin.pages.dashboard.relatorio', $data, 1);
    // }

    public function clear()
    {
        $this->check();

        $key = Req::post('key', 'int');
        $pass = Req::post('pass', 'string');
        if ($key < 1 || empty($pass)) {
            Http::redirect_to('/admin/?error');
        }
        $where = "admin_id = " . Session::node('uid') . ' AND admin_senha = "' . md5($pass) . '"';
        $verify = (new Factory('admin'))->where($where)->get();
        if (!isset($verify[0])) {
            Http::redirect_to('/admin/?error');
        }

        $this->limpa_respostas(1);
        Http::redirect_to('/admin/?success');
    }

    public function limpa_respostas($is_callable = false)
    {
        if ($is_callable) {
            $columns = [
                ['name' => 'id', 'type' => 'int(11)', 'key' => true],
                ['name' => 'participante', 'type' => 'int'],            
                ['name' => 'pergunta', 'type' => 'int'],
                ['name' => 'resposta', 'type' => 'int'],
                ['name' => 'certa', 'type' => 'int(1)', 'default' => '0'],
            ];
            (new DB)->drop_table('participante_resposta');
            (new DB)->create_table('participante_resposta', $columns);

            $columns = [
                ['name' => 'id', 'type' => 'int(11)', 'key' => true],
                ['name' => 'nome', 'type' => 'varchar(255)'],
                ['name' => 'funcao', 'type' => 'varchar(255)'],
                ['name' => 'cpf', 'type' => 'varchar(40)'],
                ['name' => 'farmacia', 'type' => 'varchar(255)'],
                ['name' => 'farmacia_cnpj', 'type' => 'varchar(24)'],
                ['name' => 'telefone', 'type' => 'varchar(18)'],
                ['name' => 'email', 'type' => 'varchar(255)'],
                ['name' => 'acertos', 'type' => 'int(1)'],
                ['name' => 'hora_voto', 'type' => 'datetime'],
            ];
            (new DB)->drop_table('participante');
            (new DB)->create_table('participante', $columns);
        }
    }
}

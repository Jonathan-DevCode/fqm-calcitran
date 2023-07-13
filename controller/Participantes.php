<?php

class Participantes
{
    public function __construct()
    {
        @session_start();
        if (!Session::check() || !Session::node('uid')) {
            Session::destroy();
            Http::redirect_to('/admin/login');
        }
    }

    public function indexAction()
    {        
        $data = [            
            'mapper' => []
        ];
        Tpl::view('admin.pages.participantes.index', $data, 1);
    }

    public function lista() {
        $participantes = (new Factory('participante'))
            ->get();

        if (isset($participantes[0])) {
            foreach ($participantes as $k => $v) {
                $participantes[$k]->participante_cpf = base64_decode($participantes[$k]->participante_cpf);
                $participantes[$k]->participante_json = json_encode($participantes[$k]);
            }
        }
        echo json_encode($participantes);
    }

    public function gravar()
    {
        $dados = Filter::parse_full($_POST);
        if (
            empty($dados['participante_nome']) ||
            empty($dados['participante_funcao']) ||
            empty($dados['participante_cpf']) ||
            empty($dados['participante_farmacia']) ||
            empty($dados['participante_email']) ||
            empty($dados['participante_telefone'])
        ) {
            Http::redirect_to('/participantes/?campos-obrigatorios');
        }

        $dados['participante_cpf'] = base64_encode($dados['participante_cpf']);

        (new Factory('participante'))->with($dados)->save();
        Http::redirect_to('/participantes/?success');
    }

    public function remove()
    {
        $id = Req::post("id", 'int');
        if (empty($id) || $id <= 0) {
            Http::redirect_to('/participantes/?campos-obrigatorios');
        }
        (new Factory('participante'))->drop($id);
        Http::redirect_to('/participantes/?success');
    }
}

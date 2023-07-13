<?php

class Perguntas
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
            'perguntas' => (new Factory('pergunta'))->order("pergunta_texto")->get(),
            'mapper' => []
        ];
        Tpl::view('admin.pages.perguntas.index', $data, 1);
    }

    public function gravar() {
        $dados = Filter::parse_full($_POST);
        if(empty($dados['pergunta_texto'])) {
            Http::redirect_to('/perguntas/?campos-obrigatorios');
        }

        (new Factory('pergunta'))->with($dados)->save();
        Http::redirect_to('/perguntas/?success');
    }

    public function remove() {
        $id = Req::post("id", 'int');
        if(empty($id) || $id <= 0) {
            Http::redirect_to('/perguntas/?campos-obrigatorios');
        }
        (new Factory('pergunta'))->drop($id);
        Http::redirect_to('/perguntas/?success');
    }
}

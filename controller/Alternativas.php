<?php

class Alternativas
{
    public function __construct()
    {
        @session_start();
        if (!Session::check() || !Session::node('uid')) {
            Session::destroy();
            Http::redirect_to('/admin/login');
        }
    }

    public function ver()
    {
        $pergunta = Http::get_in_params('ver', 'int');
        if(!isset($pergunta->value) || empty($pergunta->value)) {
            Http::redirect_to('/perguntas/?error');
        }
        $pergunta_id = $pergunta->value;
        $pergunta = (new Factory('pergunta'))->find($pergunta_id);
        if(isset($pergunta->pergunta_id)) {
            $data = [
                'alternativas' => (new Factory('alternativa'))->where("alternativa_pergunta = $pergunta_id")->order("alternativa_id DESC")->get(),
                'pergunta_id' => $pergunta_id,
                'pergunta_texto' => $pergunta->pergunta_texto,
                'mapper' => []
            ];
            Tpl::view('admin.pages.alternativas.index', $data, 1);
        } else {
            Http::redirect_to('/admin/?error');
        }
    }

    public function indexAction()
    {
        $pergunta = Http::get_in_params('alternativas', 'int');
        if(!isset($pergunta->value) || empty($pergunta->value)) {
            Http::redirect_to('/perguntas/?error');
        }
        $pergunta_id = $pergunta->value;
        $data = [
            'alternativas' => (new Factory('alternativa'))->where("alternativa_pergunta = $pergunta_id")->order("alternativa_id DESC")->get(),
            'pergunta_id' => $pergunta_id,
            'mapper' => []
        ];
        Tpl::view('admin.pages.alternativas.index', $data, 1);
    }

    public function gravar() {
        $dados = Filter::parse_full($_POST);
        if(empty($dados['alternativa_texto'])) {
            if(empty($dados['alternativa_pergunta'])) {
                Http::redirect_to('/perguntas/?error');
            } else {
                Http::redirect_to('/alternativas/ver/'. $dados['alternativa_pergunta'] .'/?campos-obrigatorios');
            }
        }

        (new Factory('alternativa'))->with($dados)->save();
        Http::redirect_to('/alternativas/ver/'. $dados['alternativa_pergunta'] .'/?success');
    }

    public function remove() {
        $id = Req::post("id", 'int');
        $pergunta_id = Req::post("pergunta_id", 'int');
        if(empty($id) || $id <= 0) {
            Http::redirect_to('/alternativas/ver/'. $pergunta_id .'/?campos-obrigatorios');
        }
        (new Factory('alternativa'))->drop($id);
        if(empty($pergunta_id)) {
            Http::redirect_to('/perguntas/?success');
        } else {
            Http::redirect_to('/alternativas/ver/'. $pergunta_id .'/?success');
        }
    }
}

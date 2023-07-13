<?php

class Auth
{

    public function __construct()
    {
    }

    public function indexAction()
    {
    }

    public function cadastro()
    {
        $dados = Filter::parse_full($_POST);
        if(!isset($dados['check_termos']) || empty($dados['check_termos']) || $dados['check_termos'] != 'on') {
            Http::redirect_to('/?error');
        }

        unset($dados['check_termos']);

        // $verify = (new Factory('participante'))
        //     ->where("participante_cpf = '" . base64_encode($dados['participante_cpf']) . "'")
        //     ->get();
        // if (isset($verify[0])) {
        //     Http::redirect_to('/?login-indisponivel');
        // }

        $dados['participante_cpf'] = base64_encode($dados['participante_cpf']);

        $id = (new Factory('participante'))->with($dados)->save();
        ClientSession::init();
        ClientSession::init();
        ClientSession::node('uid', $id);
        ClientSession::node('unome', $dados['participante_nome']);
        ClientSession::node('uip', (new Browser)->get_ip());
        $_SESSION['acertos'] = 3;
        $_SESSION['tentativas_restantes'] = 3;
        $_SESSION['tentativas_realizadas'] = 0;
        $_SESSION['quiz_perguntas'] = [];
        Http::redirect_to('/info/1');
    }

    public function admin()
    {
        $login = Req::post('login', 'string');
        $senha = Req::post('senha', 'string');

        if (empty($login) || empty($senha)) {
            Http::redirect_to('/admin/login/?campos-obrigatorios');
        }

        $senha = md5($senha);
        $user = (new Factory('admin'))->where("admin_login = '$login' AND admin_senha = '$senha'")->get();

        if (!isset($user[0])) {
            Http::redirect_to('/admin/login/?login-inexistente');
        }
        $u = $user[0];
        Session::init();
        Session::node('uid', $u->admin_id);
        Session::node('unome', $u->admin_nome);
        Session::node('uperms', $u->admin_permissao);
        Session::node('uip', (new Browser)->get_ip());
        Http::redirect_to('/admin');
    }

    public function logout_admin()
    {
        Session::destroy();
        Http::redirect_to('/admin');
    }

    public function logout()
    {
        Session::destroy();
        Http::redirect_to('/');
    }

    static function validator()
    {
        if (!ClientSession::node('uid')) {
            Http::redirect_to('/');
        }

        if(isset($_SESSION['quiz_escolhas']) && !empty($_SESSION['quiz_escolhas']) && is_array($_SESSION['quiz_escolhas']) && sizeof($_SESSION['quiz_escolhas']) >= 3) {
            // respondeu 3 vzs já, não pode responder mais
            Http::redirect_to('/finalizado/?limite-alcancado');
        }
    }
}

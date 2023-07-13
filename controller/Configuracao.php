<?php

class Configuracao
{

    public function __construct()
    {
        (new Install)->check_tabelas_principais();
        Sessao::check();
        Sessao::perms('G');
        if (ucfirst(Session::node('ulevel')) != '1') {
            Http::redirect_to('/admin/?error');
        }
    }

    public function indexAction()
    {
        $data = [
            'config' => (new Config)->get(),            
            'mapper' => ['config']
        ];
        Tpl::view('admin.config.config', $data, 1);
    }

    public function loja()
    {
        $data = [
            'config' => (new Config)->get(),
            
            'mapper' => ['config']
        ];
        Tpl::view('admin.config.site', $data, 1);
    }


    public function logo()
    {
        $data = [
            'config' => (new Config)->get(),
            
            'mapper' => ['config']
        ];
        Tpl::view('admin.config.logo', $data, 1);
    }

    public function email()
    {
        $data = [
            'config' => (new Config)->get(),
            
            'smtp' => (new Config)->getSmtp(),
            'mapper' => ['config', 'smtp']
        ];
        Tpl::view('admin.config.email', $data, 1);
    }

    public function contato()
    {
        $data = [
            'config' => (new Config)->get(),
            
            'contato' => (new Config)->getContato(),
            'mapper' => ['config', 'contato']
        ];
        Tpl::view('admin.config.contato', $data, 1);
    }

    public function rede()
    {
        $data = [
            'config' => (new Config)->get(),
            'rede' => (new Config)->getRedesSociais(),
            
            'mapper' => ['config', 'rede']
        ];
        Tpl::view('admin.config.rede', $data, 1);
    }
    
    public function layout() {
        $cores = (new Factory('config_cores'))->get();
        $data = [
            'config' => (new Config)->get(),          
            'cores' => $cores,
            'mapper' => ['config']
        ];
        Tpl::view('admin.config.layout', $data, 1);
    }

    public function gravar()
    {
        if (isset($_POST['config_id']) && !empty($_POST['config_id']) && intval($_POST['config_id']) > 0) {
            $return = Http::get_in_params('return');

            if (isset($return->value)) {
                $return = $return->value;
                (new Factory('config'))->with($_POST)->save();
                Http::redirect_to("/configuracao/$return/?success");
            }
        }
    }

    public function gravarSmtp()
    {
        if (isset($_POST['smtp_id']) && !empty($_POST['smtp_id'])) {
            $return = Http::get_in_params('return');
            if (isset($return->value)) {
                $return = $return->value;
                if (Req::is_empty('smtp_pass')) {
                    Req::drop('smtp_pass');
                }
                (new Factory('smtp'))->with($_POST)->save();
                Http::redirect_to("/configuracao/$return/?success");
            }
        }
    }

    public function  altera_cor()
    {
        if (isset($_POST['config_tema_color'])) {
            $data = [
                'id' => 1,
                'config_tema_color' => $_POST['config_tema_color'],
            ];
            (new Factory('config'))->with($data)->save();
            echo true;
        }
    }

    public function gravarContato()
    {
        if (isset($_POST['contato_id']) && !empty($_POST['contato_id'])) {
            $return = Http::get_in_params('return');
            if (isset($return->value)) {
                $return = $return->value;
                (new Factory('contato'))->with($_POST)->save();
                Http::redirect_to("/configuracao/$return/?success");
            }
        }
    }

    public function gravarRede()
    {
        if (isset($_POST['redesSociais_id']) && !empty($_POST['redesSociais_id'])) {
            $return = Http::get_in_params('return');
            if (isset($return->value)) {
                $return = $return->value;
                (new Factory('redesSociais'))->with($_POST)->save();
                Http::redirect_to("/configuracao/$return/?success");
            }
        }
    }

    public function logo_upload()
    {
        if (!empty($_FILES['logo']['name'])) {
            $file = $_FILES['logo'];
            $img = Media::upload($file, 'site', 'img');

            if (is_object($img)) {
                /*REMOVE ATUAL LOGO */
                $current = (new Factory('config'))->find(1);
                $current_logo = Path::base() . "/media/site/$current->config_site_logo";
                if (file_exists($current_logo)) {
                    @unlink($current_logo);
                }
                /*END REMOVE ATUAL LOGO */
                /*ATUALIZA LOGO*/
                $logo = ['site_logo' => $img->url, 'id' => 1];
                (new Factory('config'))->with($logo)->save();
            }
        };
        Http::redirect_to("/configuracao/logo/?success");
    }

    public function favicon_upload()
    {
        if (!empty($_FILES['favicon']['name'])) {
            $file = $_FILES['favicon'];
            $img = Media::upload($file, 'site', 'img');

            if (is_object($img)) {

                /*REMOVE ATUAL LOGO */
                $current = (new Factory('config'))->find(1);

                $current_logo = Path::base() . "/media/site/$current->config_site_favicon";
                if (file_exists($current_logo)) {
                    @unlink($current_logo);
                }
                /*END REMOVE ATUAL LOGO */
                /*ATUALIZA LOGO*/
                $logo = ['site_favicon' => $img->url, 'id' => 1];
                (new Factory('config'))->with($logo)->save();
            }
        };

        if (!empty($_FILES['favicon']['name'])) {
            $file = $_FILES['favicon'];
            $img = Media::upload($file, 'site', 'img');            
        };

        Http::redirect_to("/configuracao/logo/?success");
    }

    public function login_upload()
    {
        if (!empty($_FILES['login'])) {
            $file = $_FILES['login'];
            $img = Media::upload($file, 'site', 'img');
            if (is_object($img)) {
                /*REMOVE ATUAL LOGO */
                $current = (new Factory('config'))->find(1);
                $current_login = Path::base() . "/media/site/$current->config_site_loginscreen";
                if (file_exists($current_login)) {
                    @unlink($current_login);
                }
                /*END REMOVE ATUAL LOGO */
                /*ATUALIZA LOGO*/
                $screen = ['site_loginscreen' => $img->url, 'id' => 1];
                (new Factory('config'))->with($screen)->save();
            }
        }
        Http::redirect_to("/configuracao/logo/?success");
    }

    public function gravar_modo() {        
        $config_id = Req::post('config_id', 'int');
        $config_site_modo = Req::post('config_site_modo', 'int');

        if($config_id > 0 && $config_site_modo > 0) {
            $with = [
                'id' => $config_id,
                'site_modo' => $config_site_modo
            ];
            (new Factory('config'))->with($with)->save();
            Http::redirect_to('/configuracao/?success');
        } else {
            Http::redirect_to('/configuracao/?error');
        }
    }

    public function gravar_layout() {        
        $config_id = Req::post('config_id', 'int');
        $config_site_layout = Req::post('config_site_layout', 'int');

        if($config_id > 0 && $config_site_layout > 0) {
            $with = [
                'id' => $config_id,
                'site_layout' => $config_site_layout
            ];
            (new Factory('config'))->with($with)->save();
            Http::redirect_to('/configuracao/layout/?success');
        } else {
            Http::redirect_to('/configuracao/layout/?error');
        }
    }

    public function gravar_cores() {   
        foreach($_POST['config_cores_id'] as $k => $v) {
            $id = $_POST['config_cores_id'][$k];
            $local = $_POST['config_cores_local'][$k];
            $fundo = $_POST['config_cores_fundo'][$k];
            $texto = $_POST['config_cores_texto'][$k];
            $hover_fundo = $_POST['config_cores_hover_fundo'][$k];
            $hover_texto = $_POST['config_cores_hover_texto'][$k];

            $with = [
                'id' => $id,
                'local' => $local,
                'fundo' => $fundo,
                'texto' => $texto,
                'hover_fundo' => $hover_fundo,
                'hover_texto' => $hover_texto
            ];
            (new Factory('config_cores'))->with($with)->save();
        }

        Http::redirect_to("/configuracao/layout/?success");
    }
}

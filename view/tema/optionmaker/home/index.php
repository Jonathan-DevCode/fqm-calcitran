<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Central do cliente</title>
    <!-- Stylesheets -->
    <link href="${baseUri}/view/tema/optionmaker/assets/css/bootstrap.css" rel="stylesheet">
    <link href="${baseUri}/view/tema/optionmaker/assets/css/fontawesome-all.css" rel="stylesheet">
    <link href="${baseUri}/view/admin/assets/plugins/select2/select2.css" rel="stylesheet">
    <link href="${baseUri}/view/tema/optionmaker/assets/css/style.css" rel="stylesheet">
    <link href="${baseUri}/view/tema/optionmaker/assets/css/toast.css" rel="stylesheet">
    <link href="${baseUri}/view/tema/optionmaker/assets/css/custom.css" rel="stylesheet">
    <!-- Responsive Settings -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!--[if lt IE 9]><script src="https:/cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
    <!--[if lt IE 9]><script src="js/respond.js"></script><![endif]-->

    <style>
        .select2-selection__rendered {
            line-height: 2.20rem !important;
        }

        .select2-container .select2-selection--single {
            height: 2.20rem !important;
        }

        .select2-selection__arrow {
            height: 2.20rem !important;
        }

        .img-pack {
            margin-left: -300px;
            margin-top: -220px;
            max-width: auto !important;
            width: auto;
        }

        .title-custom {
            margin-top: 33px;
        }

        @media screen and (max-width: 799px) {
            .img-pack {
                margin-left: 20px;
                margin-top: -50px;
                max-width: 100% !important;
            }

            .img-slogan {
                max-width: 100% !important;
            }

            .title-custom {
                margin-top: 0px;
            }

            .btn-send {
                width: 100%;
            }
        }
    </style>
</head>

<body style="background-image: url('${baseUri}/media/files_helpers/_GERAL/FUNDO.png');min-height: 100vh;background-size: cover;background-position: center;">


    <div id="no-ie" class="container" style="margin-top: 2vh">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 text-center images-home">
                    <img src="${baseUri}/media/files_helpers/_GERAL/ESCOLHA.png" class="escolha" alt="">
                    <img src="${baseUri}/media/files_helpers/_GERAL/CONHECA.png" class="conheca" alt="">
                    <img src="${baseUri}/media/files_helpers/_GERAL/PRODUTOS.png" class="produtos" alt="">
            </div>

            <div class="col-12 col-sm-12 col-md-6 col-lg-6 text-white">
                <h5 class="text-white title-custom">Bem vindo!</h5>
                <p style="line-height: <?php if (Browser::agent('mobile')) : ?>1.125em<?php else : ?>0.125em<?php endif; ?>;">Participe e ganhe um brinde exclusivo!</p>

                <form action="${baseUri}/auth/cadastro" method="post">
                    <div class="row">
                        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <label for="">Nome <span class="text-danger">*</span> </label>
                                <input type="text" required name="participante_nome" class="form-control">
                            </div>
                        </div>

                        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <label for="">Função <span class="text-danger">*</span> </label>
                                <input type="text" required name="participante_funcao" class="form-control">
                            </div>
                        </div>

                        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <label for="">CPF <span class="text-danger">*</span> </label>
                                <input type="text" required name="participante_cpf" class="form-control cpf">
                            </div>
                        </div>

                        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <label for="">E-mail <span class="text-danger">*</span> </label>
                                <input type="email" required name="participante_email" class="form-control">
                            </div>
                        </div>

                        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <label for="">Celular <span class="text-danger">*</span> </label>
                                <input type="text" required name="participante_telefone" class="form-control fone">
                            </div>
                        </div>

                        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <label for="">Bandeira da farmácia <span class="text-danger">*</span> </label>
                                <input type="text" required name="participante_farmacia" class="form-control">
                            </div>
                        </div>

                        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <label for="">CNPJ da Farmácia <span class="text-danger">*</span> </label>
                                <input type="text" required name="participante_farmacia_cnpj" class="form-control cnpj">
                            </div>
                        </div>

                        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="check_termos" id="flexCheckChecked">
                                <label class="form-check-label" for="flexCheckChecked">
                                    Concordo com os <a target="_blank" href="${baseUri}/termos">Termos de uso da plataforma</a>
                                </label>
                            </div>
                        </div>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-send button-home">CLIQUE AQUI PARA INICIAR</button>
                </form>

                <br><br>
                <!-- <img src="${baseUri}/media/default/logo.png" alt="Logo Option Maker"> -->
                <br>
                <!-- <p>OptionMaker</p> -->
            </div>
        </div>
    </div>
    <div id="ie" class="d-none text-center">
        <br><br><br>
        <h4>ATENÇAO</h4>
        Esta aplicação não roda no <b>INTERNET EXPLORER</b>. Por favor use outro Browser (chrome, firefox, edge, opera). <br> Obrigado.
    </div>

    <script src="${baseUri}/view/tema/optionmaker/assets/js/jquery.js"></script>
    <script src="${baseUri}/view/tema/optionmaker/assets/js/bootstrap.min.js"></script>
    <script src="${baseUri}/view/admin/assets/plugins/select2/select2.js"></script>
    <script src="${baseUri}/view/tema/optionmaker/assets/js/mask.js"></script>
    <script src="${baseUri}/view/tema/optionmaker/assets/js/toast.js"></script>
    <script src="${baseUri}/view/tema/optionmaker/assets/js/main.js"></script>


    <script type="text/javascript">
        $(document).ready(function() {
            $(".select2").select2();

            var isIE = /*@cc_on!@*/ false || !!document.documentMode;
            if (isIE == true) {
                $("#no-ie").addClass('d-none');
                $("#ie").removeClass('d-none');
            } else {
                $("#no-ie").removeClass('d-none');
                $("#ie").addClass('d-none');
            }
        })

    </script>
</body>

</html>
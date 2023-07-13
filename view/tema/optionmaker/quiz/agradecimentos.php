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
    <link href="${baseUri}/view/tema/optionmaker/assets/css/agradecimentos.css" rel="stylesheet">
    <!-- Responsive Settings -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!--[if lt IE 9]><script src="https:/cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
    <!--[if lt IE 9]><script src="js/respond.js"></script><![endif]-->

</head>

<body style="background-image: url('${baseUri}/media/files_helpers/_GERAL/FUNDO.png');min-height: 100vh;background-size: cover;background-position: center;">

<div id="no-ie" class="container" style="max-width: 935px;">
        <div class="col-sm-12">
            <div
                class="row container-topo"
                style="
                min-height: 145px;
                margin: 0;
                margin-bottom: 2vh;
                background-image: url('${baseUri}/media/files_helpers/_GERAL/topo.png');
                background-size: contain;
                background-position: center;
                background-repeat: no-repeat;">

                <p class="d-none"></p>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center card-quiz">
                <?php if ($data['acertos'] == 3) : ?>
                    <div class="row texto-parabens">
                        <div class="col-12 col-md-8">
                            <h1> Parabéns! </h1>
                            <h2> Você acertou tudo! </h2>
                            <h2> Nossa equipe entregará o brinde. </h2>
                        </div>
                        <div class="col-12 col-md-4 py-3">
                            <img class="img-parabens" src="${baseUri}/media/files_helpers/SLIDE_09/boa.png" alt="">
                        </div>
                    </div>
                <?php else : ?>
                    <?php if ($data['tentativas_restantes'] == 2 && intval($data['acertos']) <= 2) : ?>
                        <div class="row texto-parabens">
                            <div class="col-12 col-md-8">
                                <h1> Não foi dessa vez! </h1>
                                <h2> Mas você ainda tem <br> </h2>
                                <h2> <b style="color: yellow;"> 2 CHANCES</b>, <br></h2>
                                <h2 class="mb-4"> boa sorte! </h2>
                                <a class="link-tentar-denovo" href="${baseUri}/quiz"> TENTE OUTRA VEZ </a>
                            </div>
                            <div class="col-12 col-md-4 py-3">
                                <img class="img-parabens" src="${baseUri}/media/files_helpers/SLIDE_09/deuruim.png" alt="">
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if ($data['tentativas_restantes'] == 1 && intval($data['acertos']) <= 2) : ?>
                        <div class="row texto-parabens">
                            <div class="col-12 col-md-8">
                                <h1> Não desiste, </h1>
                                <h2> você ainda tem <br></h2>
                                <h2> <b style="color: yellow;"> 1 CHANCE</b>, <br></h2>
                                <h2 class="mb-4"> boa sorte! </h2>
                                <a class="link-tentar-denovo" href="${baseUri}/quiz"> TENTE OUTRA VEZ </a>
                            </div>
                            <div class="col-12 col-md-4 py-3">
                                <img class="img-parabens" src="${baseUri}/media/files_helpers/SLIDE_09/deuruim.png" alt="">
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if ($data['tentativas_restantes'] == 0 && intval($data['acertos']) <= 2) : ?>
                        <b class="text-white" style="font-size: 22px;">Que pena, você não acertou todas as questões. Obrigado por participar!</b>
                        <script>
                            setTimeout(() => {
                                window.location.href = "https://www.fqmgrupo.com.br/fqmconsumo/linhas/saude/linha-calcitran-4";
                            }, 5000);
                        </script>
                    <?php endif; ?>
                <?php endif; ?>


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
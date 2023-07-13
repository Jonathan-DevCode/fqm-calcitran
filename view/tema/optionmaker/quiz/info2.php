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
    <link href="${baseUri}/view/tema/optionmaker/assets/css/page-info-2.css" rel="stylesheet">

    <!-- Responsive Settings -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!--[if lt IE 9]><script src="https:/cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
    <!--[if lt IE 9]><script src="js/respond.js"></script><![endif]-->

</head>

<body style="background-image: url('${baseUri}/media/files_helpers/_GERAL/FUNDO.png');min-height: 100vh;background-size: cover;background-position: center;">

    <div id="no-ie" class="container" style="margin-top: 5vh; max-width: 935px;">

        <div 
            class="row container-topo" 
            style="
            min-height: 100px;
            margin: 0;
            margin-bottom: 0vh;
            background-image: url('${baseUri}/media/files_helpers/_GERAL/topo.png');
            background-size: contain;
            background-position: center;
            background-repeat: no-repeat;">

            <p class="d-none"></p>
        
        </div>

        <div class="row">
            <div class="d-flex image-container col-12 col-md-6 order-2 order-sm-1 justify-content-center">
                <img src="${baseUri}/media/files_helpers/_GERAL/PRODUTO.png" class="produto" alt="">
            </div>
            <div class="col-12 col-md-6 d-flex order-1 order-sm-2 flex-column justify-content-center mb-5">
                <img class="triplo" src="${baseUri}/media/files_helpers/SLIDE_03/triplo.png" alt="">
                <div class="d-flex mt-4">
                    <img class="item-list" src="${baseUri}/media/files_helpers/SLIDE_03/articulacao.png" alt="">
                    <div class="descricao ml-3">
                        <h1> 1. ARTICULAÇÃO </h1>
                        <p> Diminui a degradação das articulações e auxilia na manutenção da função articular </p>
                    </div>
                </div>
                <div class="d-flex mt-2">
                    <img class="item-list" src="${baseUri}/media/files_helpers/SLIDE_03/ossos.png" alt="">
                    <div class="descricao ml-3">
                        <h1> 2. OSSOS </h1>
                        <p> Auxilia no fortalecimento dos ossos e na prevenção da perda da massa óssea </p>
                    </div>
                </div>
                <div class="d-flex mt-2">
                    <img class="item-list" src="${baseUri}/media/files_helpers/SLIDE_03/muscle.png" alt="">
                    <div class="descricao ml-3">
                        <h1> 3. MÚSCULOS </h1>
                        <p> Auxilia no funcionamento muscular e alivia as dores e desconfortos nas articulações </p>
                    </div>
                </div>
                <a class="link-avancar" href="${baseUri}/info/3"><i class="fa fa-angle-right"></i> Avançar </a>
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
</body>

</html>
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
    <link href="${baseUri}/view/tema/optionmaker/assets/css/page-info-1.css" rel="stylesheet">
    <!-- Responsive Settings -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!--[if lt IE 9]><script src="https:/cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
    <!--[if lt IE 9]><script src="js/respond.js"></script><![endif]-->
</head>

<body style="background-image: url('${baseUri}/media/files_helpers/_GERAL/FUNDO.png');min-height: 100vh;background-size: cover;background-position: center;">


<div id="no-ie" class="container">
    
    <div 
        class="row container-topo" 
        style="
        min-height: 100px;
        margin: 0;
        margin-bottom: 3vh;
        background-image: url('${baseUri}/media/files_helpers/_GERAL/topo.png');
        background-size: contain;
        background-position: center;
        background-repeat: no-repeat;">

        <p class="d-none"></p>
    
    </div>

    <div class="row">
        <div class="d-flex image-container col-12 col-md-6 order-2 order-sm-1 justify-content-center">
            <img src="${baseUri}/media/files_helpers/SLIDE_02/BRINDE.png" class="word-image" alt="">
            <img src="${baseUri}/media/files_helpers/SLIDE_02/BLUR.png" class="shadow-image" alt="">
        </div>
        <div class="col-12 col-md-6 d-flex order-1 order-sm-2 flex-column justify-content-center mb-5">
            <img class="quiz" src="${baseUri}/media/files_helpers/SLIDE_02/quiz.png" alt="">
            <p class="paragrafo"> Leia as informações, assista o vídeo, responda as 3 perguntas corretamente e <b> ganhe um brinde exclusivo! </b> </p>
            <a class="link-avancar" href="${baseUri}/info/2"><i class="fa fa-angle-right"></i> Avançar </a>
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
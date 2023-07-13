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
    </style>
</head>

<body style="background-color: #00032C;min-height: 100vh;">


    <div id="no-ie">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center">
                <!-- <img src="${baseUri}/media/default/imecap_hair.png" alt="" width="150"> -->
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center text-white">
                <!-- <h5 class="text-white" style="margin-top: 33px;">Por favor, assista nosso vídeo para poder seguir para o quiz!</h5> -->
                <video style="width: 100vw; height: 100vh;" controls autoplay id="video">
                    <source src="${baseUri}/media/videos/calcitran.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                <!-- <a href="${baseUri}/quiz" class="btn btn-info"><i class="fa fa-arrow-right"></i> Seguir para o Quiz</a> -->
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

            document.getElementById('video').addEventListener('ended', endVideo, false);

            function endVideo(e) {
                window.location.href = "${baseUri}/quiz";
            }
        })
    </script>
</body>

</html>
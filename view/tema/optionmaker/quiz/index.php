<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Central do cliente</title>
    <!-- Stylesheets -->
    <link href="${baseUri}/view/tema/optionmaker/assets/css/bootstrap.css" rel="stylesheet">
    <link href="${baseUri}/view/tema/optionmaker/assets/css/fontawesome-all.css" rel="stylesheet">
    <link href="${baseUri}/view/tema/optionmaker/assets/css/style.css" rel="stylesheet">
    <link href="${baseUri}/view/tema/optionmaker/assets/css/custom.css" rel="stylesheet">
    <link href="${baseUri}/view/tema/optionmaker/assets/css/toast.css" rel="stylesheet">
    <link href="${baseUri}/view/tema/optionmaker/assets/css/index-quiz.css" rel="stylesheet">
    <!-- Responsive Settings -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
</head>

<style>
    img {
        max-width: 100%;
    }

    .decidiu-fumasil-1 {
        margin-top: 40px;
    }

    .alternativa_text p {
        line-height: 1.5;
        font-size: 16px;
        margin-bottom: 0;
        width: 85%;
    }

    @media screen and (max-width: 799px) {
        .alternativa_text {
            flex-direction: row;
        }
    }
</style>

<body style="background-image: url('${baseUri}/media/files_helpers/_GERAL/FUNDO.png');min-height: 100vh;background-size: cover;background-position: center;">
    <div class="container" style="margin-bottom: 30px; max-width: 935px;">
        <div class="row">
            <div class="col-sm-12">

                <div
                    class="row container-topo"
                    style="
                    min-height: 145px;
                    margin: 0;
                    margin-bottom: 3vh;
                    background-image: url('${baseUri}/media/files_helpers/_GERAL/topo.png');
                    background-size: contain;
                    background-position: center;
                    background-repeat: no-repeat;">

                    <p class="d-none"></p>

                </div>

                <div class="row">
                    <?php if (isset($data['perguntas'][0])) : ?>
                        <?php foreach ($data['perguntas'] as $k => $v) : ?>
                            <div class="col-sm-12 mt-3 perguntas" id="pergunta_<?= intval($k) + 1 ?>">
                                <div class="card" style="background-color: transparent;">
                                    <div class="card-body card-quiz">
                                        <h4 class="text-white" style="font-size: 25px; line-height: 1em !important;">
                                            <b class="titulo_pergunta text-left">
                                                <?= intval($k) + 1 ?>. <?= $v->pergunta_texto ?>
                                            </b>
                                        </h4>
                                        <?php if (isset($v->alternativas) && !empty($v->alternativas) && isset($v->alternativas[0])) : ?>
                                            <?php foreach ($v->alternativas as $alt) : ?>
                                                <div class="alternativa pointer row alternativa_opcao_<?= $k ?>" id="alternativa_<?= $alt->alternativa_id ?>" onclick="selecionaQuestao('<?= $alt->alternativa_id ?>', '<?= $k ?>', '<?= $v->pergunta_id ?>')">
                                                    <div class="col-12">
                                                        <div class="d-flex align-items-center alternativa_text">
                                                            <div>
                                                                <img src="${baseUri}/media/files_helpers/_GERAL/circulo.png" class="circulo" alt="">
                                                                <?= $alt->alternativa_indicador ?>
                                                            </div>
                                                            <p><?= $alt->alternativa_texto ?></p>

                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        <div class="d-flex justify-content-end footer-quiz">
                                            <button class="btn btn-info btn-block" onclick="set_step(1)"><i class="fa fa-angle-right"></i> AVANÇAR </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>

    <script src="${baseUri}/view/tema/optionmaker/assets/js/jquery.js"></script>
    <script src="${baseUri}/view/tema/optionmaker/assets/js/bootstrap.min.js"></script>
    <script src="${baseUri}/view/tema/optionmaker/assets/js/mask.js"></script>
    <script src="${baseUri}/view/tema/optionmaker/assets/js/toast.js"></script>
    <script src="${baseUri}/view/tema/optionmaker/assets/js/main.js"></script>

    <script>
        var step = 1;
        var selecionou_pergunta_step = false;
        $(document).ready(() => {
            $(".perguntas").hide();
            $("#pergunta_" + step).show();
            $("#btn-next").show();
            $("#btn-end").hide();
        })
        var respostas = [{
                pergunta_id: 0,
                alternativa_id: 0
            },
            {
                pergunta_id: 0,
                alternativa_id: 0
            },
            {
                pergunta_id: 0,
                alternativa_id: 0
            }
        ];

        function set_step(avanca = false) {

            if(!selecionou_pergunta_step) {
                alert_custom("Responda a pergunta para prosseguir!");
                return false;
            }

            selecionou_pergunta_step = false;

            if (avanca) {
                step++;
            } else {
                step--;
            }

            const btnNext = document.getElementById('btn-next');
            const btnEnd = document.getElementById('btn-end');

            if (respostas[2].pergunta_id > 0) {
                finaliza_quiz();
            } else {
                $(".perguntas").hide();
                $("#pergunta_" + step).show();

                if(step == 3) {
                    $(".footer-quiz button").html("<i class='fa fa-check'></i> FINALIZAR");
                }
            }

        }


        function selecionaQuestao(alternativa_id, pergunta_indice, pergunta_id) {
            selecionou_pergunta_step = true;
            let id_html = "#alternativa_" + alternativa_id;
            let class_html = ".alternativa_opcao_" + pergunta_indice;

            $(class_html).removeClass('selecionada');
            $(id_html).addClass('selecionada');
            respostas[pergunta_indice].pergunta_id = pergunta_id;
            respostas[pergunta_indice].alternativa_id = alternativa_id;
        }

        function finaliza_quiz() {
            console.log(respostas);

            let estaPreenchido = true;

            for (let index = 0; index < respostas.length; index++) {
                if (!respostas[index].pergunta_id > 0) {
                    estaPreenchido = false;
                    break;
                }
            }

            if (estaPreenchido) {
                let url = '${baseUri}/index/escolhe_alternativas';
                $.post(url, {
                        respostas: respostas
                    })
                    .then(res => {
                        console.log(res);
                        res = JSON.parse(res);
                        if (res.status != undefined && res.status == 200) {
                            window.location.href = "${baseUri}/agradecimentos";
                        } else {
                            alert_custom("Erro ao finalizar quiz!");
                            console.log(res);
                        }
                    })
            } else {
                alert_custom("Responda todas as perguntas para finalizar!");
            }
        }
    </script>
</body>

</html>
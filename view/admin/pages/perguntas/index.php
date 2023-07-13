<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Central do cliente</title>
    <!-- Stylesheets -->
    <link href="${baseUri}/view/admin/assets/css/bootstrap.css" rel="stylesheet">
    <link href="${baseUri}/view/admin/assets/css/fontawesome-all.css" rel="stylesheet">
    <link href="${baseUri}/view/admin/assets/plugins/datatable/datatable.css" rel="stylesheet">
    <link href="${baseUri}/view/admin/assets/css/style.css" rel="stylesheet">
    <link href="${baseUri}/view/admin/assets/css/toast.css" rel="stylesheet">
    <link href="${baseUri}/view/admin/assets/css/custom.css" rel="stylesheet">
    <link href="${baseUri}/view/admin/assets/plugins/dropify/dist/css/dropify.min.css" rel="stylesheet">
    <!-- Responsive Settings -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!--[if lt IE 9]><script src="https:/cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
    <!--[if lt IE 9]><script src="js/respond.js"></script><![endif]-->
</head>

<style>
    form .dropify-wrapper .dropify-preview .dropify-render img {
        object-fit: cover;
    }

    form .dropify-wrapper {
        display: block;
        position: relative;
        cursor: pointer;
        border-radius: 10px;
        object-fit: cover;
        height: 200px;
        overflow: hidden;
        max-width: 100%;
        font-size: 14px;
        line-height: 22px;
        color: #777;
        background-color: #FFF;
        border: 2px solid #E5E5E5;
        -webkit-transition: border-color .15s linear;
        transition: border-color .15s linear
    }
</style>

<body style="background-image: linear-gradient(to bottom right, rgb(255, 255, 255), rgb(200, 200, 200));min-height: 100vh;">
    @(admin.components.menu-superior)

    <br><br><br>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-9 col-lg-9">
                <h4><b>Perguntas</b></h4>

            </div>
            <?php if (Session::node('uperms') == 1) : ?>
                <div class="col-sm-12 col-md-3 col-ld-3 align-self-center">
                    <button class="btn btn-danger btn-block" onclick="show_novo()"><i class="fa fa-plus"></i> Adicionar</button>
                </div>
            <?php endif; ?>
            <div class="col-sm-12">
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12">
                <div class="card">
                    <div class="card-body">

                        <table id="datatable" class="datatable display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th width="100">Título</th>
                                    <?php if (Session::node('uperms') == 1) : ?>
                                        <th class="d-print-none" width="100">Ações</th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (isset($data['perguntas'][0])) : ?>
                                    <?php foreach ($data['perguntas'] as $c) : ?>
                                        <tr>
                                            <td><?= Filter::cut($c->pergunta_texto, 100, '...') ?></td>
                                            <?php if (Session::node('uperms') == 1) : ?>
                                                <td>
                                                    <a href="${baseUri}/alternativas/ver/<?= $c->pergunta_id ?>" title="Alternativas" class="btn btn-secondary btn-sm"><i class="fa fa-list"></i></a>
                                                    <button class="btn btn-primary btn-sm" onclick='show_edit(`<?= json_encode($c) ?>`)'><i class="fa fa-edit"></i></button>
                                                    <button class="btn btn-danger btn-sm" onclick="show_remove(<?= $c->pergunta_id ?>)"><i class="fa fa-trash"></i></button>
                                                </td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="modalNovo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Salvar pergunta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="${baseUri}/perguntas/gravar" method="post" enctype="multipart/form-data">
                        <input type="hidden" class="form-control" name="pergunta_id" id="pergunta_id">
                        <div class="row">
                            <div class="col-sm-12">
                                <label for="pergunta_texto">Título</label>
                                <input type="text" class="form-control" name="pergunta_texto" id="pergunta_texto">
                            </div>
                            <div class="col-sm-12 mt-3">
                                <button type="submit" class="btn btn-danger btn-block">Salvar pergunta</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalRemove" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Remover pergunta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="${baseUri}/perguntas/remove" method="post">
                        <input type="hidden" class="form-control" name="id" id="pergunta_id_remove">

                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <i class="fa fa-exclamation-triangle fa-3x text-warning" aria-hidden="true"></i>
                                <br>
                                <h4 class="text-warning text-center">Atenção</h4>
                                <p>
                                    Você está prestes a remover um <b>pergunta</b> e essa ação não poderá ser desfeita.
                                </p>
                                <button class="btn btn-danger btn-block" type="submit">Remover</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <script src="${baseUri}/view/admin/assets/js/jquery.js"></script>
    <script src="${baseUri}/view/admin/assets/js/bootstrap.min.js"></script>
    <script src="${baseUri}/view/admin/assets/js/toast.js"></script>
    <script src="${baseUri}/view/admin/assets/plugins/datatable/jquery.datatable.js"></script>
    <script src="${baseUri}/view/admin/assets/plugins/datatable/datatable.js"></script>
    <script src="${baseUri}/view/admin/assets/js/datatable-init.js"></script>
    <script src="${baseUri}/view/admin/assets/js/mask.js"></script>
    <script src="${baseUri}/view/admin/assets/js/main.js"></script>
    <script src="${baseUri}/view/admin/assets/plugins/dropify/dist/js/dropify.min.js"></script>

    <script>
        $(document).ready(function() {
            $(".menu-link").addClass("btn btn-danger");
            $(".menu-perguntas").removeClass("btn-danger").addClass("btn-outline-danger text-danger");
            datatable_init();
        });

        function show_novo() {
            $("#pergunta_id").val("");
            $("#pergunta_texto").val("");         
            $('#modalNovo').modal('show');
        }

        function show_edit(pergunta) {
            pergunta = JSON.parse(pergunta);
            $("#pergunta_id").val(pergunta.pergunta_id);
            $("#pergunta_texto").val(pergunta.pergunta_texto);
            $('#modalNovo').modal('show');
        }

        function show_remove(id) {
            $("#pergunta_id_remove").val(id);
            $("#modalRemove").modal('show');
        }
    </script>
</body>

</html>
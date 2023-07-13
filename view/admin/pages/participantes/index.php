<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Central do cliente</title>
    <!-- Stylesheets -->
    <link href="${baseUri}/view/admin/assets/css/bootstrap.css" rel="stylesheet">
    <link href="${baseUri}/view/admin/assets/css/fontawesome-all.css" rel="stylesheet">
    <link href="${baseUri}/view/admin/assets/plugins/datatable/datatable.css" rel="stylesheet">
    <link href="${baseUri}/view/admin/assets/plugins/select2/select2.css" rel="stylesheet">
    <link href="${baseUri}/view/admin/assets/css/style.css" rel="stylesheet">
    <link href="${baseUri}/view/admin/assets/css/toast.css" rel="stylesheet">
    <link href="${baseUri}/view/admin/assets/css/custom.css" rel="stylesheet">
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

<body style="background-image: linear-gradient(to bottom right, rgb(255, 255, 255), rgb(200, 200, 200));min-height: 100vh;">
    @(admin.components.menu-superior)

    <br><br><br>
    <div class="container" id="vm">
        <div class="row">
            <div class="col-sm-12 col-md-9 col-lg-9">
                <h4><b>Participantes</b></h4>

            </div>
            <?php if (Session::node('uperms') == 1) : ?>
                <div class="col-sm-12 col-md-3 col-ld-3 align-self-center">
                    <button class="btn btn-danger btn-block d-none" onclick="show_novo()"><i class="fa fa-plus"></i> Adicionar</button>
                </div>
            <?php endif; ?>
            <div class="col-sm-12">
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12 text-center" v-if="loading">
                <h5>Por favor, aguarde enquanto carregamos as informações...</h5>
            </div>
            <div class="col-12 col-sm-12" v-if="!loading">
                <div class="card">
                    <div class="card-body">

                        <table id="datatable" class="datatable display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome / CPF</th>
                                    <th>E-mail / Telefone</th>
                                    <th>Farmácia / Função</th>
                                    <?php if (Session::node('uperms') == 1) : ?>
                                        <th class="d-print-none" width="100">Ações</th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody v-if="participantes != null">
                                <tr v-for="p in participantes">
                                    <td><b> {{ p.participante_id }}</b></td>
                                    <td> {{ p.participante_nome }} <br><small> {{ p.participante_cpf }}</small></td>
                                    <td> {{ p.participante_email }} <br><small> {{ p.participante_telefone }}</small></td>
                                    <td> {{ p.participante_farmacia }} <br><small> {{ p.participante_funcao }}</small></td>

                                    <?php if (Session::node('uperms') == 1) : ?>
                                        <td>
                                            <button class="btn btn-danger btn-sm" v-on:click="show_remove(p.participante_id)"><i class="fa fa-trash"></i></button>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="modalNovo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Salvar participante</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="${baseUri}/participantes/gravar" method="post">
                        <input type="hidden" class="form-control" name="participante_id" id="participante_id">
                        <div class="row">
                            <div class="col-sm-12 col-xs-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label for="participante_nome">Nome Completo <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" name="participante_nome" id="participante_nome">
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label for="participante_funcao">Função</label>
                                    <input type="text" class="form-control" name="participante_funcao" id="participante_funcao">
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label for="participante_farmacia">Função</label>
                                    <input type="text" class="form-control" name="participante_farmacia" id="participante_farmacia">
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label for="participante_farmacia_cnpj">CNPJ da farmácia</label>
                                    <input type="text" class="form-control cnpj" name="participante_farmacia_cnpj" id="participante_farmacia_cnpj">
                                </div>
                            </div>

                            <div class="col-sm-12 col-xs-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label for="participante_cpf">CPF <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control cpf" name="participante_cpf" id="participante_cpf">
                                </div>
                            </div>

                            <div class="col-sm-12 col-xs-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label for="participante_email">E-mail</label>
                                    <input type="email" class="form-control" name="participante_email" id="participante_email">
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label for="participante_telefone">Telefone</label>
                                    <input type="text" class="form-control fone" name="participante_telefone" id="participante_telefone">
                                </div>
                            </div>

                            <div class="col-sm-12 mt-3">
                                <button type="submit" class="btn btn-danger btn-block">Salvar participante</button>
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
                    <h5 class="modal-title">Remover participante</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="${baseUri}/participantes/remove" method="post">
                        <input type="hidden" class="form-control" name="id" id="participante_id_remove">

                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <i class="fa fa-exclamation-triangle fa-3x text-warning" aria-hidden="true"></i>
                                <br>
                                <h4 class="text-warning text-center">Atenção</h4>
                                <p>
                                    Você está prestes a remover um <b>participante</b> e essa ação não poderá ser desfeita.
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
    <script src="${baseUri}/view/admin/assets/plugins/select2/select2.js"></script>
    <script src="${baseUri}/view/admin/assets/js/mask.js"></script>
    <script src="${baseUri}/view/admin/assets/js/datatable-init.js"></script>
    <script src="${baseUri}/view/admin/assets/js/main.js"></script>
    <script src="${baseUri}/view/tema/optionmaker/assets/js/vue.js"></script>

    <script>
        var baseUri = "${baseUri}";
        var table;
        var vm = new Vue({
            el: '#vm',
            data: {
                participantes: null,
                loading: true,
            },
            methods: {
                listar: async function() {
                    this.loading = true;
                    var url = baseUri + '/participantes/lista/';
                    let resp = await fetch(url)
                        .then(resp => resp.json())
                        .then(data => {                            
                            vm.participantes = data;
                        })
                        .then(() => {
                            this.loading = false;                            
                        })
                },
                show_edit: function(participante) {
                    $("#participante_id").val(participante.participante_id);
                    $("#participante_nome").val(participante.participante_nome);
                    $("#participante_funcao").val(participante.participante_funcao);
                    $("#participante_farmacia").val(participante.participante_farmacia).trigger('change');
                    $("#participante_cpf").val(participante.participante_cpf);
                    $("#participante_email").val(participante.participante_email);
                    $("#participante_telefone").val(participante.participante_telefone);
                    $('#modalNovo').modal('show');
                },
                show_remove: function(id) {
                    $("#participante_id_remove").val(id);
                    $("#modalRemove").modal('show');
                }
            },
            created: async function() {
                $(".menu-link").addClass("btn btn-danger");
                $(".menu-participantes").removeClass("btn-danger").addClass("btn-outline-danger text-danger");
                $(".select2").select2();
                await this.listar();
                datatable_init();
            }
        });

        function show_novo() {
            $("#participante_id").val("");
            $("#participante_nome").val("");
            $("#participante_funcao").val("");
            $("#participante_farmacia").val(0).trigger('change');
            $("#participante_cpf").val("");
            $("#participante_email").val("");
            $("#participante_telefone").val("");
            $('#modalNovo').modal('show');
        }
    </script>
</body>

</html>
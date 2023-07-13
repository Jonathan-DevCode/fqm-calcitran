<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Central do cliente</title>
    <!-- Stylesheets -->
    <link href="${baseUri}/view/tema/optionmaker/assets/css/bootstrap.css" rel="stylesheet">
    <link href="${baseUri}/view/tema/optionmaker/assets/css/fontawesome-all.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
    <link href="${baseUri}/view/tema/optionmaker/assets/css/style.css" rel="stylesheet">
    <link href="${baseUri}/view/tema/optionmaker/assets/css/toast.css" rel="stylesheet">
    <link href="${baseUri}/view/tema/optionmaker/assets/css/custom.css" rel="stylesheet">
    <!-- Responsive Settings -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!--[if lt IE 9]><script src="https:/cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
    <!--[if lt IE 9]><script src="js/respond.js"></script><![endif]-->
</head>

<body style="background-image: linear-gradient(to bottom right, rgb(255, 255, 255), rgb(200, 200, 200));min-height: 100vh">
    @(admin.components.menu-superior)

    <br><br><br>
    <div class="container-fluid" id="vm">
        <div class="row">
            <div class="col-sm-12">
                <h4><b>Dashboard</b></h4>
                <hr>
            </div>
        </div>
        <div class="row justify-content-between">
            <div class="col-sm-12 col-md-3 col-lg-3 mt-4 mb-4">
                <?php if (Session::node('uperms') == 1) : ?>
                    <a onclick="$('#modalLimpaBanco').modal('show')">
                        <div class="card" style="background-color: rgb(235, 67, 67) !important;color: white !important;">
                            <div class="card-body text-center text-white">
                                <i class="fa fa-trash"></i> <b>Limpar Banco de Dados</b>
                            </div>
                        </div>
                    </a>
                <?php endif; ?>
            </div>
        </div>
        <div class="row">
        <div class="col-12 col-sm-12 text-center" v-if="loading">
                <h5>Por favor, aguarde enquanto carregamos as informações...</h5>
            </div>
            <div class="col-12 col-sm-12" v-if="!loading">
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-muted text-center"><b>Ranking dos Participantes</b></h5>

                        <div class="row">
                            <div class="col-sm-12">
                                <table id="datatable_participantes" class="datatable display table-hover table-striped table-bordered w-100" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Participante</th>
                                            <th>CPF</th>
                                            <th>Farmácia</th>
                                            <th>Função</th>
                                            <th>CNPJ</th>
                                            <th>E-mail</th>
                                            <th>Telefone</th>
                                            <th>Acertos</th>
                                            <th>Data voto</th>
                                        </tr>
                                    </thead>
                                    <tbody v-if="participantes != null">
                                        <tr v-for="p in participantes">
                                            <td> {{ p.participante_nome }}</td>
                                            <td> {{ p.participante_cpf }}</td>
                                            <td> {{ p.participante_farmacia }}</td>
                                            <td> {{ p.participante_funcao }}</td>
                                            <!-- <td> {{ Filter::clear_cnpj(p.participante_farmacia_cnpj) }}</td> -->
                                            <td> 
                                                {{ p.participante_farmacia_cnpj.replace(".", "").replace(".", "").replace("/", "").replace("-", "") }}
                                            </td>
                                            <td> {{ p.participante_email }}</td>
                                            <td> {{ p.participante_telefone }}</td>
                                            <td> {{ p.participante_acertos }}</td>
                                            <td> {{ p.horario_resposta ? p.horario_resposta : p.participante_created_formated }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalLimpaBanco" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Limpar Banco de Dados</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="${baseUri}/admin/clear" method="post">
                            <input type="hidden" class="form-control" name="key" value="1">

                            <div class="row">
                                <div class="col-sm-12 text-center">
                                    <i class="fa fa-exclamation-triangle fa-3x text-warning" aria-hidden="true"></i>
                                    <br>
                                    <h4 class="text-warning text-center">Atenção</h4>
                                    <p>
                                        Você está prestes a <b>LIMPAR O BANCO DE DADOS</b> e essa ação não poderá ser desfeita.
                                        <br>
                                        Para executar essa ação, digite sua senha no campo abaixo <br>
                                        <input type="password" class="form-control" name="pass" placeholder="Sua senha">
                                    </p>

                                    <button class="btn btn-danger btn-block" type="submit">Estou ciente e desejo limpar o banco de dados</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>



    <script src="${baseUri}/view/tema/optionmaker/assets/js/jquery.js"></script>
    <script src="${baseUri}/view/tema/optionmaker/assets/js/bootstrap.min.js"></script>
    <script src="${baseUri}/view/tema/optionmaker/assets/js/toast.js"></script>
    <script src="${baseUri}/view/admin/assets/js/mask.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>

    <script src="${baseUri}/view/admin/assets/js/datatable-init.js?v=2"></script>
    <script src="${baseUri}/view/tema/optionmaker/assets/js/main.js"></script>
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
                    var url = baseUri + '/admin/listar_participantes/';
                    let resp = await fetch(url)
                        .then(resp => resp.json())
                        .then(data => {                            
                            vm.participantes = data;
                        })
                        .then(() => {
                            this.loading = false;
                        })
                },
            },
            created: async function() {
                $(".menu-link").addClass("btn btn-danger");
                $(".menu-dashboard").removeClass("btn-danger").addClass("btn-outline-danger text-danger");                
                await this.listar();
                datatable_init("#datatable_participantes", 1);
            }
        });
    </script>
</body>

</html>
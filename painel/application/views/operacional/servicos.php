<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <?php $this->load->view('layout/head'); ?>
    <!-- END HEAD -->

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid topage-sidebar-closed page-sidebar-closed">
        <!-- BEGIN HEADER -->
        <?php $this->load->view('layout/header'); ?>
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN SIDEBAR -->
            <?php $this->load->view('layout/sidebar'); ?>
            <!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEADER-->
                    <h1 class="page-title"><i class="fa fa-taxi"> </i>  SERVIÇOS ENVIADOS
                        <small></small>
                        <!--   MENU DE CONTEXTO -->
                        <div class="btn-group pull-right" role="group">
                            <a class="btn btn-default btn-sm btn btn-secondary" href="<?php echo base_url('index.php/operacional/servicos/enviar_servicos'); ?>">
                                 <i class="fa fa-taxi"> </i> Tela de Envio de Serviços
                            </a>
                        </div>
                        <!--   MENU DE CONTEXTO -->
                        <div class="btn-group pull-right" role="group">
                            <a class="btn btn-default btn-sm btn btn-secondary" href="<?php echo base_url('painel'); ?>">
                                <i class="fa fa-dashboard"></i> Dashboard
                            </a>
                        </div>
                    </h1>
                    <!-- END PAGE HEADER--> 
                    <div class="row">
                        <?php if($alerta != null){ ?>
                            <div class="alert alert-<?php echo $alerta['class']; ?>">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <?php echo $alerta['mensagem']; ?>
                            </div>
                        <?php 
                        }
                        ?>
                   

                        <div class="portlet light">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-wrench"></i>Filtro de Data Agendamento </div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                                    <a href="" class="fullscreen" data-original-title="" title=""></a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                
                                <form action="" method="post" onsubmit="$('.portlet').css('display','none');$('#gif').css('display','block');">

                                    <div class="form-group col-md-4">
                                        <label>Data Inicial</label>
                                        <input type="text" name="data_cad_i" class="form-control datepicker" value="<?php echo set_value('data_cad_i'); ?>" readonly="readonly">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>Data Final</label>
                                        <input type="text" name="data_cad_f" class="form-control datepicker" value="<?php echo set_value('data_cad_f'); ?>" readonly="readonly">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label style="color: #FFF"> Filtrar </label>
                                        <input type="submit" name="filtrar" class="btn btn-primary btn-block" value="Filtrar" >
                                    </div>

                                </form>

                            <div class="clearfix"></div>
                            </div>
                        </div>

                         <!-- Gif de  loading apos aplicar um filtro -->
                          <div id="gif" align="center" style="display: none;">
                                  
                            <img src="<?php echo base_url('assets/img/').'loading.gif'; ?>" style="max-height: 85px;">
                            <h4>Aguarde, isso pode demorar um pouco. </h4>

                          </div>

                        <div class="portlet light"> 
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-wrench"></i>Ordens de Serviços Enviadas</div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                                    <a href="" class="fullscreen" data-original-title="" title=""></a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                
                                <?php
                                    if($servicos)
                                    { 
                                ?>
                                <table class="table datatable">
                                    <thead>
                                        <th>Contrato</th>
                                        <th>Numero Os</th>
                                        <th>Descrição do Serviço</th>
                                        <th>Data Marcada</th>
                                        <th>Período</th>
                                        <th>Técnicos</th>
                                        <th>Abrir</th>
                                    </thead>
                                    <tbody>

                                    <?php
                                        foreach ($servicos->result() as $servico) {
                                    ?>

                                        <tr <?php if($servico->status_os == 'F'){ echo 'style="background-color:#98FB98"'; } ?> > 
                                            <td><?php echo $servico->codcli; ?></td>
                                            <td>#<?php echo $servico->numero_os; ?></td>
                                            <td><?php echo $servico->descri_ords; ?></td>
                                            <td><?php echo $servico->data_servico; ?></td>
                                            <td><?php echo $servico->periodo; ?></td>
                                            <td><?php echo $servico->tecnicos; ?></td>
                                            <td>
                                                
                                                    <a href="<?php echo base_url('index.php/operacional/servicos/servico/').$servico->cod_servico; ?>" class="btn btn-info btn-xs">Ver/Abrir</a>
                                                
                                            </td>
                                        </tr>

                                    <?php
                                        }
                                    ?>


                                    </tbody>
                                </table>
                                <?php
                                    } /*END IF $servico*/
                                ?>

                            <div class="clearfix"></div>
                            </div>
                        </div>




                    </div>
                    <!-- END ROW --> 
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
            <!-- BEGIN QUICK SIDEBAR -->
            <?php $this->load->view('layout/quick_sidebar'); ?>
            <!-- END QUICK SIDEBAR -->
        </div>
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->

        
        <?php $this->load->view('layout/footer'); ?>

        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script>
            $(function() {
                $( ".datepicker" ).datepicker();
            });
            $( ".datepicker" ).datepicker({ 
                dateFormat: "yy-mm-dd",
                dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
                dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
                dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
                monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
                monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
                nextText: 'Próximo',
                prevText: 'Anterior'
            });
        </script>



        <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
        <script>
            $(document).ready(function() {
                $('.datatable').DataTable({
                    "language" : {
                        "lengthMenu" : "Mostrar _MENU_ registros por página",
                        "loadingRecords" : "Carregando...",
                        "processing" : "Processando...",
                        "search" : "Buscar:",
                        "zeroRecords" : "Nenhum registro encontrado",
                        "info" : "Página _PAGE_ de _PAGES_",
                        "infoEmpty" : "Não há registros disponíveis",
                        "infoFiltered" : "(Filtro _MAX_ dos registros)",
                        "paginate" : {
                            "first" : "Primeira",
                            "last" : "Ultima",
                            "next" : "Próximo",
                            "previous" : "Anterior",
                        },
                    }
                });
            }); 
        </script>

        <script type="text/javascript">
            // For demo to fit into DataTables site builder...
            $('.datatable').removeClass('display').addClass('table'); 
        </script>



        <script type="text/javascript">
          $(document).ready(function () {

              $(".add").click(function () {
                      $(".tecnicos:last").clone().appendTo(".select_tec");
              });

              $(".select_tec").on('click', '.remove_tec', function () {
                      $(".tecnicos:last").remove();
              });
          })
        </script>    



        <!-- END FOOTER -->
    </body>

</html>
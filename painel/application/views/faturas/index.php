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
                    <h1 class="page-title"> CADASTROS
                        <div class="btn-group pull-right" role="group">
                            <!-- Large modal -->
                            <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#printFatura">
                                <i class="fa fa-print"></i> Imprimir Faturas
                            </button>
                        </div>
                    </h1>

                    <!-- Modal -->
                    <div id="printFatura" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Data de recolhimento</h4>
                          </div>
                          <div class="modal-body">
                            <form action="<?php echo base_url('faturas/print_fat'); ?>" method="post" target="_blank">
                                <div class="form-group">
                                    <label>Informe a data</label>
                                    <input type="text" class=" form-control datepicker" name="data" readonly="readonly" required>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary btn-block" value="Confirmar">
                                </div>
                            </form>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                          </div>
                        </div>

                      </div>
                    </div>



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
                                            <i class="fa fa-filter"></i>Faturas Abertas
                                        </div>
                                        <div class="tools">
                                            <a href="javascript:;" class="collapse" data-original-title=""
                                                title=""> </a> <a href="" class="fullscreen"
                                                data-original-title="" title=""></a>
                                        </div>

                                        <div class="actions">
                                                <div class="btn-group">
                                                
                                                    <a class="btn btn-outline" href="javascript:;"
                                                        data-toggle="dropdown"> <i class="fa fa-share"></i> <span
                                                        class="hidden-xs"> Opções </span> <i class="fa fa-angle-down"></i>
                                                    </a>
                                                    <ul class="dropdown-menu pull-right" id="sample_3_tools">
                                                        <li><a href="javascript:;" data-action="0" class="tool-action">
                                                                <i class="icon-printer"></i> Imprimir
                                                        </a></li>
                                                        <li><a href="javascript:;" data-action="1" class="tool-action">
                                                                <i class="icon-check"></i> Copiar
                                                        </a></li>
                                                        <li><a href="javascript:;" data-action="2" class="tool-action">
                                                                <i class="icon-doc"></i> PDF
                                                        </a></li>
                                                        <li><a href="javascript:;" data-action="3" class="tool-action">
                                                                <i class="icon-paper-clip"></i> Excel
                                                        </a></li>
                                                    </ul>
                                                </div>
                                             </div>
                                    </div>
                                    <div class="portlet-body">
                                        <table class="table table-striped" id="sample_3">
                                            <thead>
                                                <th>Código</th>
                                                <th>Nome</th>
                                                <th>Fechar</th>
                                                <th>Cancelar</th>
                                                <th>Status</th>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($faturas_abertas->result() as $fat): ?>
                                                    
                                                        <tr>
                                                            <td><?php echo "#".$fat->cod_fatura; ?></td>
                                                            <td><?php echo $fat->nome; ?></td>
                                                            <td>
                                                                <form action="" method="post" >
                                                                    <label class="radio-inline">
                                                                      <input type="radio" name="cod_status" value="2" required>Marcar Pago
                                                                    </label>
                                                                    <label class="radio-inline">
                                                                      <input type="radio" name="cod_status" value="3" required><span class="text-danger">Cancelar</span>
                                                                    </label>
                                                                    <input type="hidden" name="cod_fatura" value="<?php echo $fat->cod_fatura; ?>">
                                                                    <input type="submit" class="btn btn-primary" name="opcoes" value="Ok">
                                                                </form>
                                                            </td>
                                                            <td><?php echo $fat->status; ?></td>
                                                        </tr>
                                                        
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="clearfix"></div>
                                    <!-- Final do portlet-body -->
                                </div>

                            <div class="clearfix"></div>
                            </div>
                        
                    </div>
                    <!-- END ROW --> 
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
            <!-- BEGIN QUICK SIDEBAR -->

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
            <?php $this->load->view('layout/quick_sidebar'); ?>
            <!-- END QUICK SIDEBAR -->
        </div>
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        <?php $this->load->view('layout/footer'); ?>
        <!-- END FOOTER -->
    </body>
</html>
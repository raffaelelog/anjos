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
                    <h1 class="page-title"><i class="fa fa-taxi"> </i> FECHAR ORDEM DE SERVIÇO
                        <small></small>
                        <!--   MENU DE CONTEXTO -->
                        <div class="btn-group pull-right" role="group">
                            <a class="btn btn-default btn-sm btn btn-secondary" href="<?php echo base_url('painel'); ?>">
                                <i class="fa fa-dashboard"></i> Dashboard
                            </a>
                            <a class="btn btn-default btn-sm btn btn-secondary" href="<?php echo base_url('index.php/operacional/servicos/minhas_os_s'); ?>">
                                <i class="fa fa-wrench"></i> Minhas OS's
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

                        <div class="portlet box blue">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-wrench"></i>Instalação/Reativação/Ponto Adicional TV </div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                                    <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                

                                <form action="" method="post">

                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label>Número de Pontos</label>
                                            <input type="text" name="tv_pontos" class="form-control">
                                        </div>


                                        <div class="form-group">
                                            <label>Set Top Box</label>
                                            <input type="text" name="tv_stb" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Antenas</label>
                                            <input type="text" name="tv_antenas" class="form-control">
                                        </div>


                                        <div class="form-group">
                                            <label>Diplex</label>
                                            <input type="text" name="tv_diplex" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Quantidade de Cabo</label>
                                            <input type="text" name="tv_qtd_cabo" class="form-control">
                                        </div>

                                        
                                    </div>

                                    <div class="col-md-6">

                                    <div class="form-group equipamentos">
                                            <label>Equipamentos Instalados 
                                                <div class="add btn btn-default btn-sm"><i class="fa fa-plus-circle"></i>
                                                </div><div class="remove_eq btn btn-default btn-sm"><i class="fa fa-remove"></i>
                                                </div>
                                            </label>
                                            <select name="cod_produtoitem[]" class="form-control cod_produtoitem">
                                                <option value="">Equipamentos Usados.</option>
                                                <?php foreach ($estoque_tec_os->result() as $item): ?>
                                                 <option value="<?php echo $item->cod_produtoitem; ?>">
                                                    <?php echo $item->cod_produtoitem.' - '.$item->descricao; ?>
                                                     
                                                 </option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>

                                        <hr>
                                        <div class="form-group">
                                            <div class="">
                                                <h4 class="text-primary"><i class="fa fa-info-circle"></i> Equipamentos com o cliente<small class="text-danger"> Marque os equipamentos que foram retirados(Caso tenha sido).</small class="text-danger"> </h4>
                                                <?php foreach ($estoque_cliente_os->result() as $item_cli): ?>
                                                    <div class="checkbox" style="margin-left: 20px;">
                                                        <label class="checkbox col-md-12">
                                                            <input 
                                                            type="checkbox" 
                                                            name="cod_produtoitem_cli[]" 
                                                            value="<?php echo $item_cli->cod_produtoitem; ?>"
                                                            class=""
                                                            
                                                            > 
                                                            <?php echo $item_cli->cod_produtoitem." - ".$item_cli->descricao; ?>
                                                        </label>
                                                    </div>
                                                <?php endforeach ?>
                                                
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Hora Entrada</label>
                                            <input type="text" name="hora_entrada" class="form-control hora">
                                        </div>

                                        <div class="form-group">
                                            <label>Hora Saída</label>
                                            <input type="text" name="hora_saida" class="form-control hora">
                                        </div>


                                        <div class="form-group">
                                            <label>Obs.:</label>
                                            <textarea name="obs" class="form-control"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <input type="hidden" name="cod_servico" value="<?php echo $cod_servico; ?>">
                                            <input type="hidden" name="codcli" value="<?php echo $codcli; ?>">
                                            <input type="submit" class="btn btn-primary btn-block" name="fechar" value="Fechar TV">
                                        </div>

                                    </div>

                                </form>
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

        
        <script type="text/javascript">
          $(document).ready(function () {

              $(".add").click(function () {
                      $('.cod_produtoitem:last').clone().appendTo('.equipamentos');
                      $('cod_produtoitem').clone().appendTo('.equipamentos');
              });

              $(".equipamentos").on('click', '.remove_eq', function () {
                      $(".cod_produtoitem:last").remove();
              });
          })
        </script>

        <!-- END FOOTER -->
    </body>

</html>
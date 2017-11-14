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
                    <h1 class="page-title"><i class="fa fa-taxi"> </i>  TIPO DE ORDEM DE SERVIÇO
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
                                    <i class="fa fa-wrench"></i>Tipos Cadastrados</div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                                    <a href="" class="fullscreen" data-original-title="" title=""></a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <table class="table table-responsive">
                                    <thead>
                                    	<th>Descrição</th>
                                        <th>Código</th>                                        
                                        <th>Valor(R$)</th>
                                        <th>Retrabalho</th>
                                        <th>Editar</th>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($ope_servico_tipo->result() as $tipo_os): ?>
                                            <form action="" method="post">
                                            <tr>
                                                <td><?php echo $tipo_os->descri_ords; ?></td>
                                                <td><?php echo $tipo_os->cod_tipo_servico; ?></td>                                                
                                                <td><input type="text" class="form-control moeda" name="valor_ords" value="<?php echo $tipo_os->valor_ords; ?>" placeholder="Valor"></td>
                                                <td>
                                                    <label class="radio-inline"><input type="radio" <?php if($tipo_os->retrabalho == 1){ echo ' checked="checked"';} ?> name="retrabalho" value="1" >Sim </label>
                                                    <label class="radio-inline"><input type="radio" <?php if($tipo_os->retrabalho == 0){ echo ' checked="checked"';} ?> name="retrabalho" value="0" >Não </label>
                                                </td>
                                                <td>
                                                    <input type="hidden" name="cod_tipo_servico" value="<?php echo $tipo_os->cod_tipo_servico; ?>">
                                                    <input type="submit" name="atualizar" value="Atualizar" class="btn btn-primary btn-block btn-sm">
                                                </td>
                                            </tr>
                                            </form>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>

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

        <script src="<?php echo base_url('assets/global/scripts/')?>jquery.maskedinput.min.js"></script>
            <script>

            $(function() {

                $.mask.definitions['m'] = "[0-9]";
                $(".moeda").mask("mm.mm");
            });

        </script>

        <!-- END FOOTER -->
    </body>

</html>
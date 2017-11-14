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
                    <h1 class="page-title"><i class="fa fa-taxi"> </i>  Metas
                        <small></small>
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
                                    <i class="fa fa-wrench"></i>Metas dos Técnicos </div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                                    <a href="" class="fullscreen" data-original-title="" title=""></a>
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
                                <table class="table table-responsive" id="sample_3">
                                    <thead>
                                        <th>Tecnico</th>
                                        <th>Unidade</th> 
                                        <th>Setor</th>
                                        <th>Ação</th>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($meta->result() as $item) { ?>
                                            <tr>
                                                <td><?php echo $item->nome; ?></td>                                              
                                                <td><?php echo $item->unidade; ?></td>                                       
                                                <td><?php echo $item->descri_setor; ?></td>
                                                <td><a class="btn btn-success btn-xs" href="<?php echo base_url('operacional/servicos/meta') . "/" . $item -> cod_usuario; ?>"><i class="fa fa-edit"></i>lançar</a></td>
                                            </tr>  
                                        <?php } ?>
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
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <!-- END FOOTER -->
    </body>
</html>
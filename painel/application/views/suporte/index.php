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
                    <h1 class="page-title"> SUPORTE OPERATE
                        <small></small>
                    </h1>
                    <!-- END PAGE HEADER--> 
                    <div class="row">
                        <div class="portlet box blue-hoki">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-wrench"></i>Formulário </div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                                    <a href="" class="fullscreen" data-original-title="" title=""></a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <?php if($alerta != null){ ?>
                                    <div class="alert alert-<?php echo $alerta['class']; ?>">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <?php echo $alerta['mensagem']; ?>
                                    </div>
                                <?php  
                                }
                                ?>
                                <div class="col-md-6">
                                    <h3>Envie uma mensagem com a descrição do problema</h3>
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <textarea type="text" name="msg" class="form-control" style="resize: none;" rows="3"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <input type="Submit" name="enviar" class="btn btn-primary btn-block" value="Enviar">
                                        </div>
                                    </form>
                                </div> 
                                <div class="col-md-6">
                                    <h3>Contatos </h3>
                                    <ul class="list-group">
                                       <li class="list-group-item"><i class="fa fa-arrow-right"></i> Ramal 3703</li>
                                       <li class="list-group-item"><i class="fa fa-arrow-right"></i> E-mail: ti.desenvolvimento@cityshop.com.br</li>
                                       <li class="list-group-item"><i class="fa fa-arrow-right"></i> Skype: ti.desenvolvimento@cityshop.com.br | rafaelrjs | thiago_de_paula_elias</li>
                                    </ul>
                                </div>
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
        <!-- END FOOTER -->
    </body>
</html>
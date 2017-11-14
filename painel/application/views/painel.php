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

                    <h1 class="page-title"> Inicio

                        <small>Seja bem vindo!</small>

                    </h1>

                    <!-- END PAGE HEADER-->

                    <div class="row">

                        <div class="portlet light bordered">

                            <div class="portlet-title">



                                <div class="caption">

                                    <i class="icon-settings font-green-sharp"></i>

                                    <span class="caption-subject font-green-sharp bold uppercase">Atalhos</span>

                                </div>



                                <div class="actions">

                                    

                                </div>

                            </div>



                            <div class="portlet-body">

                                <a href="<?php echo base_url('perfil'); ?>" class="icon-btn">

                                    <i class="fa fa-group"></i>

                                    <div> Perfil </div>

                                </a>

                                 <a href="<?php echo base_url('Cadastros'); ?>" class="icon-btn">

                                    <i class="fa fa-users"></i>

                                    <div> Cadastros </div>

                                </a>

                                 <a href="<?php echo base_url('faturas'); ?>" class="icon-btn">

                                    <i class="fa fa-money"></i>

                                    <div> Faturas </div>

                                </a>

                                <a href="<?php echo base_url('suporte'); ?>" class="icon-btn">

                                    <i class="fa fa-support"></i>

                                    <div> Suporte </div> 

                                </a>

                                <a href="<?php echo base_url('conta/sair'); ?>" class="icon-btn">

                                    <i class="fa fa-sign-out"></i>

                                    <div> Sair </div>

                                </a>

                            </div>

                        </div>





                        <div class="portlet light bordered">

                            <div class="portlet-title">



                                <div class="caption">

                                    <i class="icon-info font-green-sharp"></i>

                                    <span class="caption-subject font-green-sharp bold uppercase">Avisos importantes</span>

                                </div>



                                <div class="actions">

                                    

                                </div>

                            </div>



                            <div class="portlet-body">



                                <div class="alert alert-danger">

                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                                    <strong>Atenção</strong>: Ainda não trocou sua senha? <a href="<?php echo base_url('perfil'); ?>">clique aqui</a> e mude-a para uma mais segura.

                                  </div>

                                </div>



                            </div>

                        </div>

                    </div>

                            

                    </div>



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
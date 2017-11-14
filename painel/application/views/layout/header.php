<div class="page-header navbar navbar-fixed-top">

            <!-- BEGIN HEADER INNER -->

            <div class="page-header-inner ">

                <!-- BEGIN LOGO -->

                <div class="page-logo">

                    <a href="<?php echo base_url(); ?>">

                        <img src="<?php echo base_url(); ?>/assets/layouts/layout2/img/logo-default.png" alt="logo" class="logo-default" style="max-height: 50px;"  /> </a>

                    <div class="menu-toggler sidebar-toggler">

                        <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->

                    </div>

                </div>

                <!-- END LOGO -->

                <!-- BEGIN RESPONSIVE MENU TOGGLER -->

                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>

                <!-- END RESPONSIVE MENU TOGGLER -->

                

                <!-- BEGIN PAGE TOP -->

                <div class="page-top">

                    <div class="hidden-md hidden-xs" style="width: 200px; color: #CCC; float: left; padding-left: 20px;">

                        <h3>Anjos Solidários</h3>

                    </div>

                    <!-- BEGIN TOP NAVIGATION MENU -->

                    <div class="top-menu">

                        <ul class="nav navbar-nav pull-right">

                            <!-- BEGIN NOTIFICATION DROPDOWN -->

                            <!-- BEGIN USER LOGIN DROPDOWN -->

                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->

                            <li class="dropdown dropdown-user">

                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">

                                    <img alt="" class="img-circle" src="<?php echo base_url(); ?>/assets/layouts/layout2/img/avatar3_small.jpg" />

                                    <span class="username username-hide-on-mobile"> <?php echo $this->session->userdata('nome'); ?> </span>

                                    <i class="fa fa-angle-down"></i>

                                </a>

                                <ul class="dropdown-menu dropdown-menu-default">

                                    <li>

                                        <a href="<?php echo base_url('perfil'); ?>">

                                            <i class="icon-user"></i> Meu perfil </a>

                                    </li>

                                    <li>

                                        <a href="<?php echo base_url('conta/sair'); ?>">

                                            <i class="icon-key"></i> Sair </a>

                                    </li>



                                    <?php

                                        if(!isset($_SESSION['cod_usuario']))

                                        {

                                            redirect('http://operate.city10.com.br');

                                        }

                                    ?>

                                </ul>

                            </li>

                            <!-- END USER LOGIN DROPDOWN -->

                            <!-- BEGIN QUICK SIDEBAR TOGGLER -->

                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->

                            <li class="dropdown dropdown-extended quick-sidebar-toggler">

                                <span class="sr-only">Toggle Quick Sidebar</span>

                               <!--  <i class="icon-info"></i>  -->

                            </li>

                            <!-- END QUICK SIDEBAR TOGGLER -->

                        </ul>

                    </div>

                    <!-- END TOP NAVIGATION MENU -->

                </div>

                <!-- END PAGE TOP -->

            </div>

            <!-- END HEADER INNER -->

        </div>
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
                    <h1 class="page-title"><i class="fa fa-taxi"> </i>  FECHAR ORDEM DE SERVIÇO
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

                        <div class="portlet light">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-wrench"></i>Fechar Ordem de Instalação </div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                                    <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                

                                <form action="" method="post">

                                    <div class="col-md-6">
                                        <div class=" form-group">
                                            <label>Código da Caixa<small class="text-danger"> Caso seja cabonet e não tenha como saber a caixa, escolha a caixa 30000-000C.</small></label>
                                            <select name="cod_caixa" class="form-control" id="combobox" required>
                                                <option value="">Selecione...</option>
                                                <?php foreach ($listar_caixas->result() as $caixa): ?>
                                                    <option value="<?php echo $caixa->cod_caixa; ?>"><?php echo $caixa->codigo; ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>

                                        <div class=" form-group">
                                            <label>Login</label>
                                            <select name="fibra_login" class="form-control" required>
                                                <option value="">Selecione o login</option>
                                                <?php foreach ($logins->result() as $login): ?>
                                                    <option value="<?php echo $login->login; ?>"><?php echo $login->login; ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>

                                        <div class=" form-group">
                                            <label>Onu Compartilhada(Cabonet)?</label><br />
                                            <label class="radio-inline"><input type="radio" value="1" name="fibra_onu_compartilhada" required>SIM</label>
                                            <label class="radio-inline"><input type="radio" value="0" name="fibra_onu_compartilhada">NÂO</label>
                                        </div>

                                        <div class=" form-group">
                                            <label>Mac</label>
                                            <input type="text" name="fibra_mac" onkeyup="maskIt(this,event,'##:##:##:##:##:##')"  class="form-control uppercase" required="required">
                                        </div>

                                         <div class=" form-group">
                                            <label>Spliter</label>
                                            <select name="fibra_spliter" class="form-control" required="required">
                                                <option value="">Selecione...</option>
                                                <option value="1x4">1x4</option>
                                                <option value="1x8">1x8</option>
                                                <option value="1x16">1x16</option>
                                                <option value="1x24">1x24</option>
                                            </select>
                                        </div>

                                        <div class=" form-group">
                                            <label>Cor</label>
                                            <input type="text" name="fibra_cor" class="form-control" required="required">
                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class=" form-group">
                                            <label>Sinal</label>
                                            <input type="text" name="fr_budget" class="form-control" required="required">
                                        </div>

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

                                        <div class=" form-group col-md-6">
                                            <label>Hora da Entrada</label>
                                            <input type="text" name="hora_entrada" class="form-control" onkeyup="maskIt(this,event,'##:##')" required">
                                        </div>

                                        <div class=" form-group col-md-6">
                                            <label>Hora da Saída</label>
                                            <input type="text" name="hora_saida" class="form-control" onkeyup="maskIt(this,event,'##:##')" required>
                                        </div>

                                        <div class=" form-group">
                                            <label>Obs.:</label>
                                            <textarea class="form-control" name="obs"></textarea>
                                        </div>

                                        <div class=" form-group">
                                            <input type="hidden" name="bairro" value="<?php echo $bairro; ?>">
                                            <input type="hidden" name="codcli" value="<?php echo $codcli; ?>">
                                            <input type="hidden" name="cod_servico" value="<?php echo $cod_servico; ?>">
                                            <input type="submit" class="btn btn-primary btn-block" name="fechar" value="Fechar Instalação Fibra">
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

         <script src="//code.jquery.com/jquery-1.10.2.js"></script>
         <script type="text/javascript">
          $(document).ready(function () {

              $(".add").click(function () {
                      $(".cod_produtoitem:last").clone().appendTo(".equipamentos");
              });

              $(".equipamentos").on('click', '.remove_eq', function () {
                      $(".cod_produtoitem:last").remove();
              });
          })
        </script>


        <?php $this->load->view('layout/footer'); ?>

        <!-- END FOOTER -->
    </body>

</html>
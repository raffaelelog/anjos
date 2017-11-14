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
                    <h1 class="page-title"><i class="fa fa-taxi"> </i>  MINHAS ORDENS DE SERVIÇO
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
                                    <i class="fa fa-wrench"></i>Agendadas 
                                </div>
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
                                        <th>Nº O.S.</th>
                                        <th>Serviço</th>
                                        <th>Data-Serviço</th>
                                        <th>Contrato</th>
                                        <th>Período</th>
                                        <th>Fechar</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach ($minhas_os_s->result() as $os) {

                                            	$cod_tipo_servico = $os->cod_tipo_servico;
                                        ?>
                                            <tr>
                                                <td><?php echo $os->numero_os; ?></td>
                                                <td><?php echo $os->descri_ords; ?></td>
                                                <td><?php echo $os->data_servico; ?></td>
                                                <td><?php echo $os->codcli; ?></td>
                                                <td><?php echo $os->periodo; ?></td>
                                                <td>
                                                    <button href="#" value="<?php echo $os->cod_servico."-".$os->codcli."-".$os->cod_tipo_servico."-".$os->bairro; ?>" onclick="pegarValues(this.value)" class="btn btn-primary btn-sm btn-block"  data-toggle="modal" data-target="#pegarCod"> Fechar
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php
                                            }
                                        ?>
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

        <!-- Modal Fechar OS-->
        <div class="modal fade" id="pegarCod" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <form action="<?php echo base_url('index.php/operacional/servicos/fechar_os'); ?>" method="post">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Fechar Ordem de servico</h4>
                  </div>
                  
                    <input type="hidden" name="values" class="form-control" id="conteudo" value="">
                    <input type="hidden" name="cod_cli" class="form-control" value="">
                  
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <input type="submit" class="btn btn-primary" name="fechar" value="Confirmar">
                  </div>
                </div>
            </form>
          </div>
        </div>

        <script type="text/javascript">
          
          //VISUALIZAR CONTEUDO EM MODAL A PARTIR DE UM ID MYSQL
          var navegador = navigator.userAgent.toLowerCase(); //Cria e atribui à variável global 'navegador' (em caracteres minúsculos) o nome e a versão do navegador

          //Função que inicia o objeto XMLHttpRequest
          function objetoXML(){
           if (navegador.indexOf('msie') != -1) { //Internet Explorer
           var controle = (navegador.indexOf('msie 5') != -1) ? 'Microsoft.XMLHTTP' : 'Msxml2.XMLHTTP'; //Operador ternário que adiciona o objeto padrão do seu navegador (caso for o IE) à variável 'controle'
           try{
           return xmlhttp = new ActiveXObject(controle); //Inicia o objeto no IE
           }catch(e){}
           }else{ //Firefox, Safari, Outros..
           return xmlhttp = new XMLHttpRequest(); //Inicia o objeto no Firefox, Safari, Mozilla
           }
          }

          // Exibe os dados do usuário pelo ID que foi passado como parâmetro
          function pegarValues(id) {
            var url = id;
           document.getElementById('conteudo').value= url;
          }

        </script>

        <!-- END FOOTER -->
    </body>

</html>
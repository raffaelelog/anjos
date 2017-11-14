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
  <div class="clearfix"></div>
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
        <div>
          <div class="page-title">
            Manutenção
            <!--   MENU DE CONTEXTO -->
            <div class="btn-group pull-right" role="group">
              <!--  END MODAL -->
              <a class="btn btn-default btn-sm btn btn-secondary"
                href="<?php echo base_url('relatorios/relatorios'); ?>"> <i
                class="fa fa-table"></i> Relatórios
              </a>
              <a class="btn btn-default btn-sm btn btn-secondary"
                href="<?php echo base_url('painel'); ?>"> <i
                class="fa fa-dashboard"></i> Dashboard 
              </a> 
            </div>
          </div>
        </div>
      <!-- END PAGE HEADER-->

            <?php if($alerta != null){ ?>
              <div class="alert alert-<?php echo $alerta['class']; ?>">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo $alerta['mensagem']; ?>
              </div>
            <?php } ?> 

            <div class="row"> 
              <!-- BEGIN Portlet PORTLET-->
              <div class="portlet light">
                <div class="portlet-title">
                  <div class="caption">
                      <i class="icon-screen-tablet font-grey-gallery"></i>
                      <span class="caption-subject bold font-grey-gallery uppercase"> Filtrar Ip do Repetidor</span>
                      <span class="caption-helper"></span>
                  </div>
                  <div class="tools">
                      <a href="" class="collapse" data-original-title="" title=""> </a>
                      <a href="" class="fullscreen" data-original-title="" title=""> </a>
                      <a href="" class="remove" data-original-title="" title=""> </a>
                  </div>
                </div>
                <div class="portlet-body">
 
                    <form method="post" action="">

                      <div class="form-group col-md-10">
                        <input type="text" class="form-control" name="ip_repetidor"  placeholder="Ip do Repetidor" required>
                      </div>

                      <div class="form-group col-md-2">
                        <input type="submit" class="btn btn-primary btn-block" name="filtrar" Value="Enviar" >
                      </div>
                    </form>
                  
                </div>
                <div class="clearfix"></div>
              </div>
              <!-- END GRID PORTLET-->
            </div>
            <!-- FIM CLASS ROW -->

            <div class="row"> 
              <!-- BEGIN Portlet PORTLET-->
              <div class="portlet light">
                <div class="portlet-title">
                  <div class="caption">
                      <i class="icon-screen-tablet font-grey-gallery"></i>
                      <span class="caption-subject bold font-grey-gallery uppercase"> Movimento de Ítens de Consumo - Estoque</span>
                      <span class="caption-helper"></span>
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
                    <table class="table table-hover" id="sample_3">
                      <thead>
                        <th>Contrato</th>
                        <th>MAC</th>
                        <th>Ip</th>
                        <th>Velocidade</th>
                        <th>Vlan</th>
                        <th>Dados do Cliente</th>
                      </thead>
                      <tbody>
                      <?php
                        if($clientes)
                        {
                            foreach ($clientes->result() as $cliente) {
                      ?>
                      <tr>

                        <td><?php echo $cliente->contrato_id; ?></td>
                        <td><?php echo $cliente->telefone; ?></td>
                        <td><?php echo $cliente->ip; ?></td>
                        <td><?php echo $cliente->velocidade; ?></td>
                        <td><?php echo $cliente->vlan; ?></td>
                        <td>
                        <?php
                          foreach ($informacoes->result() as $info)
                          {
                            
                          
                            if($info->contrato == $cliente->contrato_id)
                            {
                              echo $info->nome." - ";
                              echo $info->endereco." ";
                              echo $info->bairro." ";
                              echo $info->cidade." ";
                              echo $info->telefone." ";
                              echo $info->celular." ";
                            }

                          }
                          ?>
                        </td>
                      </tr>

                      <?php
                          }
                        }
                        else
                        {
                          echo "Nenhum Resultado encontrado. Verifique IP ou configuração SNMP";
                        }
                      ?>
                    </tbody>
                      
                    </table>
                   
                  
                </div>
                <div class="clearfix"></div>
              </div>
              <!-- END GRID PORTLET-->
            </div>
            <!-- FIM CLASS ROW -->
            

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
























































          

  		
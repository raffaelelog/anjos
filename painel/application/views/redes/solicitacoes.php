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
                    <h1 class="page-title"><i class="fa fa-archive"> </i>  Solicitações TI
                        <small></small>
                        <!--   MENU DE CONTEXTO -->
                        <div class="btn-group pull-right" role="group">                      
                            <a class="btn btn-default btn-sm btn btn-secondary" href="<?php echo base_url('painel'); ?>">
                                <i class="fa fa-dashboard"></i> Dashboard
                            </a>
                            <a class="btn btn-default btn-sm btn btn-secondary" data-toggle="modal" data-target="#cadastroSolicitacao" href="#">
                                <i class="fa fa-plus-circle"></i> Cadastrar
                            </a>
                        </div>
                    </h1>
                    <!-- Modal Cadastrar Caixa -->
                    <div class="modal fade" id="cadastroSolicitacao" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Cadastrar Nova Solicitação</h4>
                          </div>
                        <form action="" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                              <label>Solicitante</label>
                              <select name="usuario_solicitante" class="form-control" required>
                                <option value=""></option>
                                <?php foreach ($usuarios->result() as $user): ?>
                                <option value="<?php echo $user->cod_usuario; ?>"><?php echo $user->nome; ?></option>  
                                <?php endforeach ?>
                              </select>
                            </div>
                            <div class="form-group">
                              <label>Descrição da Solicitação</label>
                              <input type="text" name="descricao" class="form-control" required>
                            </div>
							<div class="form-group">
                              <label>Atividade Realizada</label>
                              <select name="atividade" class="form-control" required>
                                <option value=""></option>
                                <?php foreach ($atividades->result() as $user): ?>
                                <option value="<?php echo $user->cod_atividade; ?>"><?php echo $user->descricao; ?></option>  
                                <?php endforeach ?>
                              </select>
                            </div>
                            <div class="form-group">
                              <label>Data Solicitação</label>
                              <input type="text" name="data_solicitacao" readonly="readonly" class="form-control datepicker" value="<?php echo date('Y-m-d'); ?>" required>
                            </div>

                            <div class="form-group">
                              <label class="radio-inline">
                                  <input type="radio" name="resolvido" value="1">Resolvido
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="resolvido" value="0" checked="checked">A Resolver
                                </label>
                            </div>

                            <div class="form-group">
                              <label>Obs.:</label>
                              <textarea class="form-control" name="obs"></textarea>
                            </div>

                        </div>
                        <div class="clearfix"></div>
                        <hr>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                            <input type="submit" class="btn btn-primary" name="cadastrar" value="Cadastrar">
                            
                         </div>
                        </form>
                        <div class="clearfix"></div>
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
                        <!-- Caixas Cadastradas -->
                        <div class="portlet light">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-wrench"></i>Filtro de Data Agendamento </div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                                    <a href="" class="fullscreen" data-original-title="" title=""></a>
                                </div>
                            </div>
                            <div class="portlet-body">                             
                                <form action="" method="post">
                                    <div class="form-group col-md-4">
                                        <label>Data Inicial</label>
                                        <input type="text" name="data_ini" class="form-control datepicker" value="<?php echo set_value('data_ini'); ?>" readonly="readonly">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Data Final</label>
                                        <input type="text" name="data_fim" class="form-control datepicker" value="<?php echo set_value('data_fim'); ?>" readonly="readonly">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label style="color: #FFF"> Filtrar </label>
                                        <input type="submit" name="filtrar" class="btn btn-primary btn-block" value="Filtrar" >
                                    </div>
                                </form>
                            <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="portlet light"> 
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-wrench"></i>Tarefas realizadas </div>
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
                                <table class="table table-hover datatable" id="sample_3">
                                    <thead>
                                        <th>Data</th>
                                        <th>Solicitação</th>
                                        <th>Solicitante</th>
                                        <th>Status</th>
                                        <th>Técnico</th>
                                        <th>Mudar Status</th>
                                    </thead>
                                    <tbody>

                                      <?php if($solicitacoes){ foreach ($solicitacoes->result() as $sol): ?>
                                        <tr <?php if($sol->resolvido == 1){ echo 'class="text-success"'; }else{ echo 'class="text-danger"'; } ?> >
                                          <td><?php echo date('d-m-Y',strtotime($sol->data_solicitacao)); ?></td>
                                          <td><?php echo $sol->descricao; ?></td>
                                          <td><?php echo $sol->usuario_solicitante; ?></td>
                                          <td>
                                          <?php 
                                            if($sol->resolvido == 1)
                                            {
                                              echo 'Resolvido';
                                            }
                                            elseif ($sol->resolvido == 0) 
                                            {
                                              echo 'Pendente';
                                            }
                                            
                                          ?>
                                            
                                          </td>
                                          <td><?php echo $sol->nome; ?></td>
                                          <td>
                                            <form action="" method="post">

                                              <input type="hidden" name="cod_solicitacao" value="<?php echo $sol->cod_solicitacao; ?>">

                                              <?php if($sol->resolvido == 1){ ?>

                                              <input type="hidden" name="status" value="0">

                                              <input type="submit" name="mudar" class="btn btn-primary btn-xs btn-block" value="Mudar">

                                              <?php }
                                              if($sol->resolvido == 0)
                                              { ?>
                                              <input type="hidden" name="status" value="1">
                                              <input type="submit" name="mudar" class="btn btn-primary btn-xs btn-block" value="Mudar">

                                              <?php  } ?>
                                            </form>
                                          </td>

                                        </tr>
                                      <?php endforeach; }?>
                                        
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
        <!-- END FOOTER -->
    </body>
</html>
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
                    <h1 class="page-title"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                        Ordem de Serviço
                        <small></small>
                        <!--   MENU DE CONTEXTO -->
                        <div class="btn-group pull-right" role="group">
                            <a class="btn btn-default btn-sm btn btn-primary" href="<?php echo base_url('operacional/servicos/enviar_servicos'); ?>">
                                     <i class="fa fa-arrow-circle-left"> </i> Voltar para Enviar Serviços
                            </a>


                            <a class="btn btn-default btn-sm btn btn-info" href="<?php echo base_url('index.php/operacional/servicos/ordem_servico_enviadas'); ?>">
                                 <i class="fa fa-car"> </i> OS's Enviadas
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
                                    <i class="fa fa-wrench"></i> Detalhes</div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                                    <a href="" class="fullscreen" data-original-title="" title=""></a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <?php
                                  foreach ($servico->result() as $servico) {
                                ?>

                                <div class="mt-element-list col-md-9">
                                  <div class="mt-list-head list-simple font-white bg-grey">
                                      <div class="list-head-title-container">
                                          <h3 class="list-title text-primary">O.S. <?php echo $servico->numero_os." - ".$servico->status_os; ?></h3>
                                      </div>
                                  </div>
                                  <div class="mt-list-container list-simple">

                                      <form action="" method="post">

                                        <div class=" form-group col-md-6">
                                          <label>Data Agendada</label>
                                          <input type="text" class="form-control datepicker" name="data_servico" value="<?php echo $servico->data_servico; ?>" readonly="readonly" required>
                                        </div>

                                        <div class=" form-group col-md-6">
                                          <label>Periodo</label>
                                          <select name="periodo" class="form-control">
                                            <option value="Indiferente"<?php if($servico->periodo == 'Indiferente'){ echo ' selected="selected"';} ?> >Indiferente</option>
                                            <option value="Manhã" <?php if($servico->periodo == 'Manhã'){ echo ' selected="selected"';} ?> >Manhã</option> 
                                            <option value="Tarde" <?php if($servico->periodo == 'Tarde'){ echo ' selected="selected"';} ?> >Tarde</option> 
                                            <option value="Sem Contato" <?php if($servico->periodo == 'Sem Contato'){ echo ' selected="selected"';} ?> >Sem Contato</option>
                                            <option value="Não Agendado" <?php if($servico->periodo == 'Não Agendado'){ echo ' selected="selected"';} ?> >Não Agendado</option>
                                          </select>
                                        </div>

                                        <div class=" form-group col-md-12">
                                        
                                        <label>Serviço</label>
                                          <select name="ope_servico_tipo" class="form-control" required>

                                            <?php foreach ($ope_servico_tipo->result() as $tipo): ?>
                                              <option value="<?php echo $tipo->cod_tipo_servico; ?>" 
                                              <?php if($tipo->cod_tipo_servico == $servico->cod_tipo_servico)
                                              { echo ' selected="selected"'; } 
                                              ?> >
                                              
                                                <?php echo $tipo->descri_ords; ?>
                                                
                                              </option>
                                            <?php endforeach ?>

                                          </select>
                                        </div>
                                        <div class="col-md-12" style="margin-top: 10px">
                                          <label>Observação</label>
                                          <textarea name="obs" class="form-control"><?php echo $servico->obs; ?></textarea>
                                        </div>

                                        <div class="col-md-12">
                                          <input type="submit" class="btn btn-primary pull-right" style="margin-top: 10px" name="atualizar" value="Atualizar">
                                        </div>
                                        
                                      </form>

                                      <div class="clearfix"></div>
                                  </div>

                                </div>

                                <?php
                                  }
                                ?>

                                


                                <div class="mt-element-list col-md-3">
                                  <div class="mt-list-head list-simple font-white bg-grey">
                                      <div class="list-head-title-container">
                                          <h3 class="list-title">Técnico(s)</h3>
                                      </div>
                                  </div>
                                  <div class="mt-list-container list-simple">
                                      <form action="" method="post">
                                        <?php
                                          foreach ($tecnicos_os->result() as $tecnico) {
                                        ?>
                                            <label class="checkbox-inline"><input type="checkbox" name="cod_usuario[]" value="<?php echo $tecnico->cod_usuario; ?>"><?php echo $tecnico->nome." - ".$tecnico->pontos; ?></label><br />

                                        <?php
                                          }
                                        ?>
                                        <br>
                                        <input type="submit" class="btn btn-danger btn-block" name="excluir" value="Excluir da O.S.">
                                      </form>

                                      <hr>

                                      <form action="" method="post">
                                        <select name="cod_usuario" class="form-control" required>
                                          <option value="">Adicionar Técnico...</option>
                                          <?php
                                            foreach ($tecnicos_os_add->result() as $tec) {
                                          ?>
                                          <option value="<?php  echo $tec->cod_usuario; ?>"><?php  echo $tec->nome; ?></option>
                                          <?php
                                            }
                                          ?>
                                        </select>
                                        <br>
                                        <input type="submit" class="btn btn-primary btn-block" name="adicionar" value="Adicionar Técnico">
                                      </form>
                                  </div>
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
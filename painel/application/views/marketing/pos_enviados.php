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
				<h1 class="page-title">
					POS ATENDIMENTO <small></small>
				</h1>
				<!-- END PAGE HEADER-->
				<div class="row">
				<?php if($alerta !=null){ ?>
					<div class="alert alert-<?php echo $alerta['class']; ?>">
						<button type="button" class="close" data-dismiss="alert"
							aria-label="Close">
							<span aria-hidden="true"> &times; </span>
						</button>
						<?php echo $alerta['mensagem']; ?>
					</div>
				<?php } ?>





					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-wrench"></i>Não Realizados
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse" data-original-title=""
									title=""> </a> <a href="" class="fullscreen"
									data-original-title="" title=""></a>
							</div>
						</div>
						<div class="portlet-body">
							<form action="" method="post">
	                            <div class="form-group col-md-9">
	                            	<input type="text" name="data_servico" value="<?php echo set_value('data_servico') ?>" class="form-control datepicker" placeholder="Data da Ordem de serviço" readonly="readonly">
	                            </div>
	                            <div class=" form-group col-md-3">
	                            	<input type="submit" name="filtrar" value="Filtrar" class="btn btn-primary btn-block">
	                            </div>
	                    	</form>

	                    	<div class="clearfix"></div>

						</div>
					</div>




					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-wrench"></i>Não Realizados
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse" data-original-title=""
									title=""> </a> <a href="" class="fullscreen"
									data-original-title="" title=""></a>
							</div>
						</div>
						<div class="portlet-body">
                            <table class="table datatable" id="sample_3">
                            	<thead>
                            		<th>Número OS</th>
                            		<th>Contrato</th>
                            		<th>Periodo</th>
                            		<th>Serviço</th>
                            		<th>Opções</th>
                            	</thead>
                            	<tbody>
                            		<?php foreach ($pos_enviados->result() as $atendimento): ?>
                            			<tr>
                            				<td>#<?php echo $atendimento->numero_os; ?></td>
                            				<td><?php echo $atendimento->codcli; ?></td>
                            				<td><?php echo $atendimento->periodo; ?></td>
                            				<td><?php echo $atendimento->descri_ords; ?></td>
                            				<td>
                            					<a href="<?php echo base_url('marketing/pos_atendimento/editar/').$atendimento->cod_servico;?>" class="btn btn-primary btn-xs" >Editar</a>
                            				</td>
                            			</tr>
                            		<?php endforeach ?>
                            		
                            	</tbody>
                            </table>

                            <!-- Modal Pos -->
							<div class="modal fade" id="modalPos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							  <div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							        <h4 class="modal-title" id="myModalLabel">Enviar Pos Atendimento</h4>
							      </div>

							      <form action="" method="post">

							      	<div class="modal-body">

							      		<div class="form-group">
							      			<label>Antendimento</label>
							      			<select class="form-control" name="atendimento" required>
							      				<option value=""> Selecione...</option>
							      				<option value="Insatisfeito"> Insatisfeito</option>
							      				<option value="Satisfeito"> Satisfeito</option>
							      				<option value="Sem Contato"> Sem Contato</option>
							      			</select>
							      		</div>

							      		<div class="form-group">
							      			<label>Produto</label>
							      			<select class="form-control" name="atendimento" required>
							      				<option value=""> Selecione...</option>
							      				<option value="Insatisfeito"> Insatisfeito</option>
							      				<option value="Satisfeito"> Satisfeito</option>
							      				<option value="Sem Contato"> Sem Contato</option>
							      			</select>
							      		</div>

							      		<div class="form-group">
							      			<label>Classificação</label>
							      			<select class="form-control" name="atendimento" required>
							      				<option value=""> Selecione...</option>
							      				<option value="otimo"> Ótimo</option>
							      				<option value="regular"> Regular</option>
							      				<option value="bom"> Bom</option>
							      			</select>
							      		</div>

							      		<div class="form-group">
							      			<label>Nota</label>
							      			<select class="form-control" name="atendimento" required>
							      				<option value=""> Selecione...</option>
							      				<?php
							      					for ($i=1; $i <= 10; $i++) { 
							      						echo '<option value="'.$i.'">'.$i.'</option>';
							      					}
							      				?>
							      			</select>
							      		</div>

							      		<div class="form-group">
							      			<label>Motivo de Insatisfação</label>
							      			<select class="form-control" name="atendimento">
							      				<option value="NULL"> Selecione...</option>
							      				<option value="Conexão Lenta">Conexão Lenta</option>
							      				<option value="Conexão Caindo">Conexão Caindo</option>
							      				<option value="Sem Conexão">Sem Conexão</option>
							      				<option value="Problema não resolvido">Problema não resolvido</option>
							      				<option value="Outros">Outros</option>

							      			</select>
							      		</div>



							      		<input type="hidden" name="cod_servico" class="form-control" id="conteudo" value="">
							      
							        
								      </div>
								      <div class="modal-footer">
								        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
								        <input type="submit" class="btn btn-primary pull-right" name="confirmar" value="Confirmar">
								      </div>

								    </form>

							    </div>
							  </div>
							</div>
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
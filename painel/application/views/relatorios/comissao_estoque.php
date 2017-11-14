<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
    <?php $this->load->view('layout/head'); ?>
    <!-- END HEAD -->
<body
	class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid topage-sidebar-closed page-sidebar-closed">
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
					<i class="fa fa-archive"> </i> Atividades Realizadas na Manutenção
					<small></small>
					<!--   MENU DE CONTEXTO -->
					<div class="btn-group pull-right" role="group">
						<a class="btn btn-default btn-sm btn btn-secondary"
							href="<?php echo base_url('relatorios/relatorios'); ?>"> <i
							class="fa fa-table"></i> Relatórios
						</a> <a class="btn btn-default btn-sm btn btn-secondary"
							href="<?php echo base_url('painel'); ?>"> <i
							class="fa fa-dashboard"></i> Dashboard
						</a>
					</div>
				</h1>
				<!-- END PAGE HEADER-->
				<div class="row">
					<!--Comissao tecnicos -->
					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-wrench"></i>Filtro da Comissão
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse" data-original-title=""
									title=""> </a> <a href="" class="fullscreen"
									data-original-title="" title=""></a>
							</div>
						</div>
						<div class="portlet-body">
							<form action="" method="post">
								<div class="form-group col-md-4 col-md-offset-1">
									<label>Data</label> <input required="required" type="text"
										name="data" id="data" class="form-control monthPicker"
										readonly="readonly">
								</div>
								<div class="form-group col-md-4 col-md-offset-1">
									<label style="color: #FFF"> Filtrar </label> <input
										type="submit" name="filtrar" class="btn btn-primary btn-block"
										value="Filtrar">
								</div>
							</form>
							<div class="clearfix"></div>
						</div>
					</div>
					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-wrench"></i>Valores da Comissão<?php if ($comissao != null) { echo ": "; foreach ($comissao->result() as $com){ echo $com->nome." - R$ ".$com->valor."; ";}}?>
 							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse" data-original-title=""
									title=""> </a> <a href="" class="fullscreen"
									data-original-title="" title=""></a>
							</div>
						</div>
						<div class="portlet-body">
							<table class="table table-hover datatable" >
								<thead>
									<th>Equipamento</th>
									<th>Quantidade</th>
									<th>Valor</th>
									<th>Descrição OS</th>
									<th>Técnico</th>
								</thead>
								<tbody>
                                	<?php if ($valor!= null) { foreach ($valor->result() as $val){ ?>
                                    <tr>
										<td><?php echo $val->equipamento; ?></td>
										<td><?php echo $val->quantidade; ?></td>
										<td><?php echo "R$ ".$val->valor; ?></td>
										<td><?php echo $val->descri_tipo; ?></td>
										<td><?php echo $val->nome; ?></td>
									</tr>
									<?php }} ?>	
                              	</tbody>
							</table>
							<div class="clearfix"></div>
						</div>
					</div>
					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-wrench"></i>Atividades Realizadas
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse" data-original-title=""
									title=""> </a> <a href="" class="fullscreen"
									data-original-title="" title=""></a>
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
							<table class="table table-hover datatable" id="sample_3">
								<thead>
									<th>Nº OS</th>
									<th>Nome do Técnico</th>
									<th>Produto</th>
									<th>Data Ini. </th>
									<th>Data Fim </th>
									<th>Duração</th>
									<th>Produto</th>
									<th>Tipo</th>
									<th>Retorno</th>
									<th>Classificação</th>
									<th>Comissão</th>
								</thead>
								<tbody>
                                	<?php if ($solicitacao!= null) { foreach ($solicitacao->result() as $sol){ ?>
                                    <tr>
										<td><?php echo $sol->cod_manutencao; ?></td>
										<td><?php echo $sol->nome; ?></td>
										<td><?php echo $sol->descricao; ?></td>
										<td><?php echo $sol->data_inicio; ?></td>
										<td><?php echo $sol->data_fim; ?></td>
										<td><?php  $date_time  = new DateTime($sol->data_inicio);  $diff = $date_time->diff( new DateTime($sol->data_fim)); echo $diff->format('%y ano(s), %m mês(s), %d dia(s), %H hora(s), %i minuto(s) e %s segundo(s)'); ?></td>							
										<td><?php echo $sol->cod_produtoitem; ?></td>
										<td><?php echo $sol->descri_tipo; ?></td>
										<td><?php echo $sol->retorno; ?></td>
										<td><?php echo $sol->equipamento; ?></td>
										<td><?php echo $sol->comissao; ?></td>
									</tr>
									<?php }} ?>	
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
	<link rel="stylesheet"
		href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script>
		$(document).ready(function(){
		    $(".monthPicker").datepicker({ 
		        dateFormat: 'yy-mm',
		        changeMonth: true,
		        changeYear: true,
		        showButtonPanel: true,
	            monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
	            maxDate: 'm',
	            closeText : 'Selecionar',
	            showButtonPanel:false,
		        onClose: function(dateText, inst) {  
		            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val(); 
		            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val(); 
		            var day = '01';
		            $(this).val($.datepicker.formatDate('yy-mm-dd', new Date(year, month,day)));
		        }
		    });
		    $(".monthPicker").focus(function () {
				$(".ui-datepicker-calendar").hide();
				$("#ui-datepicker-div").position({
					  my: "center top",
					  at: "center bottom",
					  of: $(this)
				});
			});
		});
    </script>
	<!-- END FOOTER -->
</body>
</html>
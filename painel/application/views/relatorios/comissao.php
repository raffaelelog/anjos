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
					<i class="fa fa-archive"> </i> Comissão <small></small>
					<!--   MENU DE CONTEXTO -->
					<div class="btn-group pull-right" role="group">
						<a class="btn btn-default btn-sm btn btn-secondary"
							href="<?php echo base_url('relatorios/relatorios'); ?>"> <i
							class="fa fa-table"></i> Relatórios
						</a>
						<a class="btn btn-default btn-sm btn btn-secondary"
							href="<?php echo base_url('painel'); ?>"> <i
							class="fa fa-dashboard"></i> Dashboard 
						</a>
					</div>
				</h1>
				<!-- END PAGE HEADER-->
				<div class="row">
                        <?php if($alerta != null){ ?>
                            <div
						class="alert alert-<?php echo $alerta['class']; ?>">
						<button type="button" class="close" data-dismiss="alert"
							aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
                                <?php echo $alerta['mensagem']; ?>
                            </div>
                        <?php } ?>
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
									<label>Data</label> 
									<input required="required" type="text" name="data" id="data"  class="form-control monthPicker" readonly="readonly" >
								</div>
								<div class="form-group col-md-4 col-md-offset-1">
									<label style="color: #FFF"> Filtrar </label> 
									<input type="submit" name="filtrar" class="btn btn-primary btn-block" value="Filtrar">
								</div>
							</form>
							<div class="clearfix"></div>
						</div>
					</div>
					<?php if($operacional){ ?>
					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-wrench"></i>Comissão Equipe Operacional-Redes 
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
									<th>Setor</th>
									<th>Unidade</th>
									<th>Técnico</th>
									<th>Meta Realizada</th>
									<th>Meta Definida</th>
									<th>Percentual</th>
									<th>Comissão Bruta</th>
									<th>Comissão Liquida</th>
								</thead>
								<tbody>
                                	<?php	$quantidade_tecnicos = $operacional->num_rows(); $total_operacional=0; 
                                			foreach ($operacional->result() as $sol){ ?>
                                    	<tr>
                                    		<td><?php echo $sol->descri_setor; ?></td>
											<td><?php echo $sol->descri_unidade; ?></td>
											<td><?php echo $sol->nome; ?></td>
											<td><?php echo number_format($sol->meta_realizada, 2, ',', '.'); ?></td>
											<td><?php echo $sol->meta_definida; ?></td>
											<td><?php echo number_format($sol->percentual, 2, ',', '.').'%'; ?></td>
											<td><?php echo "R$ ".number_format($sol->comissao_bruta, 2, ',', '.');?></td>
											<td><?php echo "R$ ".number_format($sol->comissao, 2, ',', '.');
											$total_operacional = $total_operacional + $sol->comissao; 
                                			} ?></td>
										</tr>
                                			<?php if($quantidade_tecnicos != 0 and $total_operacional != 0){
                                				$comissao_redes = $total_operacional/$quantidade_tecnicos;
                                			}else{
                                				$comissao_redes = 0;
                                			}
                                			foreach ($redes->result() as $sol): ?>
                                    	<tr>
											<td><?php echo $sol->descri_setor; ?></td>
											<td><?php echo $sol->descri_unidade; ?></td>
											<td><?php echo $sol->nome; ?></td>
											<td>-</td>
											<td>-</td>
											<td>-</td>
											<td>-</td>
											<td><?php echo "R$ ".number_format($comissao_redes, 2, ',', '.'); ?></td>										
										</tr>
                                	<?php endforeach; $total_redes = $comissao_redes*$redes->num_rows();?>
                                	
                                	
                              	</tbody>
							</table>
							<div class="clearfix"></div>
						</div>
					</div>
					<div class="portlet light col-md-6">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-wrench"></i>Comissão por serviço
							</div>
						</div>
						<div class="portlet-body">
							<table class="table table-hover datatable" id="sample_3">
								<thead>
									<th>Valor Pago</th>
									<th>Tipo de serviço</th>
								</thead>
								<tbody>
								<?php foreach ($servico->result() as $sol){ ?>
									<tr>
										<td><?php echo "R$: ".number_format($sol->valor, 2, ',', '.');?></td> 
										<td><?php echo $sol->descri_gser;?></td> 
									</tr>
								<?php } ?>
								</tbody>
							</table>
							<div class="clearfix"></div>
						</div>
					</div>
					<div class="portlet light col-md-6">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-wrench"></i>Valores Totais 
							</div>
						</div>
						<div class="portlet-body">
							<table class="table table-hover datatable" id="sample_3">
								<thead>
									<th>Valor Pago</th>
									<th>Setor</th>
								</thead>
								<tbody>
									<tr>
										<td><?php echo "R$: ".number_format($total_operacional, 2, ',', '.');?></td> 
										<td><?php echo "Operacional";?></td> 
									</tr>
									<tr>
										<td><?php echo "R$: ".number_format($total_redes, 2, ',', '.');?></td>
										<td><?php echo "Redes";?></td> 
									</tr>
									<tr>
										<td><?php echo "R$: ".number_format($total_operacional+$total_redes, 2, ',', '.'); ?></td>
										<td><?php echo "Total";?></td> 
									</tr>
								</tbody>
							</table>
							<div class="clearfix"></div>
						</div>
					</div>
				<?php } ?> 
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
		$(document).ready(function(){
		    $(".monthPicker").datepicker({ 
		        dateFormat: 'yy-mm',
		        changeMonth: true,
		        changeYear: true,
		        showButtonPanel: true,
	            monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
	            minDate: '-1m',
	            maxDate: '+1y',
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
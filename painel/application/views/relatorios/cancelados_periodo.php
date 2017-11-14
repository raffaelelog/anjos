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
						Planos Cancelados por período
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
				<div class="row">
					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-filter"></i>Filtro
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse" data-original-title=""
									title=""> </a> <a href="" class="fullscreen"
									data-original-title="" title=""></a>
							</div>
						</div>
						<div class="portlet-body">
                            <form action="" method="post" onsubmit="$('.portlet').css('display','none');$('#gif').css('display','block');">

                                <div class="form-group col-md-3">
                                    <label>Data Inicial</label>
                                    <input type="text" name="data_i" class="form-control datepicker" value="<?php echo set_value('data_i'); ?>" readonly="readonly" required>
                                </div>

                                <div class="form-group col-md-3">
                                    <label>Data Final</label>
                                    <input type="text" name="data_f" class="form-control datepicker" value="<?php echo set_value('data_f'); ?>" readonly="readonly" required>
                                </div>

                                <div class="form-group col-md-3">
                                    <label>Unidade</label>
                                    <select name="pop" class="form-control" required="required">
                                    	<option value="">Selecione...</option>
                                    	<option value="MATRIZ">BCA</option>
                                    	<option value="021X0SX9YT">SOE</option>
                                    </select>
                                    
                                </div>

                                <div class="form-group col-md-3">
                                    <label style="color: #FFF"> Filtrar </label>
                                    <input type="submit" name="filtrar" class="btn btn-primary btn-block" value="Filtrar" >
                                </div>

                            </form>
						</div>
						<div class="clearfix"></div>
						<!-- Final do portlet-body -->
					</div>
				<!-- END ROW -->
				</div>

				<div class="row">
					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-table"></i>Cancelados por Período
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse" data-original-title=""
									title=""> </a> <a href="" class="fullscreen"
									data-original-title="" title=""></a>
							</div>
							<div class="actions">
								<div class="btn-group">
									<a class="btn btn-outline" href="javascript:;" data-toggle="dropdown"> <i class="fa fa-share"></i> <span class="hidden-xs"> Opções </span> <i
										class="fa fa-angle-down"></i>
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
											<th>Contratro</th>
											<th>Cliente</th>
											<th>Plano</th>
											<th>Data Cancelamento</th>
											<th>Motivo Cancelamento</th>
										</thead>
										<tbody>
											<?php foreach ($cancelados_periodo->result() as $cancelado): ?>
												<tr>
			                    					<td><?php echo $cancelado->contrato; ?></td>
			                    					<td><?php echo $cancelado->cliente; ?></td>
			                    					<td><?php echo $cancelado->plano; ?></td>
			                    					<td><?php echo $cancelado->data_can; ?></td>
			                    					<td><?php echo $cancelado->motivo; ?></td>
			                    				</tr>
											<?php endforeach ?>
		                    				
		                   	 			</tbody>
									</table>

						</div>

						<div class="clearfix"></div>
						<!-- Final do portlet-body -->
					</div>
					<!-- END ROW -->
				</div>



			</div>
			<!-- END CONTENT -->
			<!-- BEGIN QUICK SIDEBAR -->
        <?php $this->load->view('layout/quick_sidebar'); ?>
        <!-- END QUICK SIDEBAR -->
		</div>
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
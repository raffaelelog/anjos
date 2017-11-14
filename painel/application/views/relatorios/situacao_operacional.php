
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
						Instalações
						<!--   MENU DE CONTEXTO -->
						<div class="btn-group pull-right" role="group">
							<!--  END MODAL -->
							<a class="btn btn-default btn-sm btn btn-secondary"
								href="<?php echo base_url('relatorios/relatorios'); ?>"> <i
								class="fa fa-table"></i> Relatórios
							</a> <a class="btn btn-default btn-sm btn btn-secondary"
								href="<?php echo base_url('painel'); ?>"> <i
								class="fa fa-dashboard"></i> Dashboard
							</a>
						</div>
					</div>
				</div>
				<!-- END PAGE HEADER-->
				<div class="row">
					<?php if($alerta !=null){ ?>
            		<div class="alert alert-<?php echo $alerta['class']; ?>">
						<button type="button" class="close" data-dismiss="alert"
							aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
                		<?php echo $alerta[ 'mensagem']; ?>
            		</div>
            		<?php } ?>
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
							<form action="" method="post">
								<div class="form-group col-md-6">
									<label>Data Inicial</label> 
									<input required="required" type="text" name="data" id="data"  class="form-control monthPicker" readonly="readonly" >
								</div>
								
								<div class="form-group col-md-6">
									<label style="color: #FFF"> Filtrar </label> 
									<input type="submit" name="filtrar" class="btn btn-primary btn-block" value="Filtrar">
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
								<i class="fa fa-bar-chart"></i>Gráfico de instalações
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse" data-original-title=""
									title=""> </a> <a href="" class="fullscreen"
									data-original-title="" title=""></a>
							</div>
						</div>
						<div class="portlet-body">
							<script src="<?php echo base_url('assets/global/scripts/');?>echarts.common.min.js"></script>
							<!-- prepare a DOM container with width and height -->
							<div id="main" style="width: 100%; height: 500px;"></div>
							<script type="text/javascript">
                                var myChart = echarts.init(document.getElementById('main'));                                  
                                        option = {
                                        	<?php if($meses != null and $tipos != null){ ?>
										    title: {
										    	<?php $valor_mes1 = 0; $valores_mes1 = ''; foreach ( $mes1->result () as $item ) { $valor_mes1 = $valor_mes1 + $item->quantidade; $valores_mes1 = $valores_mes1."'".$item->quantidade."',";}?>
										    	<?php $valor_mes2 = 0; $valores_mes2 = ''; foreach ( $mes2->result () as $item ) { $valor_mes2 = $valor_mes2 + $item->quantidade; $valores_mes2 = $valores_mes2."'".$item->quantidade."',";}?>
										    	<?php $valor_mes3 = 0; $valores_mes3 = ''; foreach ( $mes3->result () as $item ) { $valor_mes3 = $valor_mes3 + $item->quantidade; $valores_mes3 = $valores_mes3."'".$item->quantidade."',";}?>
										        text: 'INSTALADAS - <?php echo strtoupper ($meses[0]).': '.$valor_mes1.', '.strtoupper ($meses[1]).': '.$valor_mes2.' e '.strtoupper ($meses[2]).': '.$valor_mes3; ?>',
										        
										    },
										    tooltip : {
							    		        trigger: 'axis',
							    		        axisPointer : {            
							    		            type : 'shadow'        
							    		        }
							    		    },
							    		    toolbox: {
							    		        show : true,
							    		        feature : {
							    		            saveAsImage : {show: true,title:"Salvar em PNG"}
							    		        }
							    		    },
										    grid: {
							    		        left: '3%',
							    		        right: '4%',
							    		        bottom: '3%',
							    		        containLabel: true
							    		    },
										    yAxis: [{
										        type: 'value',
										        name: 'Quantidade',
										        axisLabel: {
										            formatter: '{value}'
										        }
										    }],
										    xAxis: [{
										        type: 'category',
										        name: 'Itens',
										        data: [<?php foreach ( $tipos->result () as $item ) {echo "'".trim($item->descri_ords)."',";} ?> ],
										        axisLabel : {
				 		            	        	 show:true,
						            	             interval: '0', 
						            	             rotate: 10,
						            	             margin: 20,
				 		                            formatter:'{value}'
				 		                            },
										    }],  
										    series: [{
										        name: '<?php echo $meses[0]; ?>',
										        type: 'bar',
										        data: [<?php echo $valores_mes1; ?>],
											    itemStyle: {
									                normal: {
									                    label: {
									                        show: true,
									                        position: 'top',
									                        formatter: '{c}'
									                    }
									                }
									            }
								        	}
										 	, {
										        name: '<?php echo $meses[1]; ?>',
										        type: 'bar',
										        data: [<?php echo $valores_mes2; ?>],
										        itemStyle: {
									                normal: {
									                    label: {
									                        show: true,
									                        position: 'top',
									                        formatter: '{c}'
									                    }
									                }
									            }
								            }
										 	,{
										        name: '<?php echo $meses[2]; ?>',
										        type: 'bar',
										        data: [<?php echo $valores_mes3; ?>],
										        itemStyle: {
									                normal: {
									                    label: {
									                        show: true,
									                        position: 'top',
									                        formatter: '{c}'
									                    }
									                }
									            }
								            }
										    ]
										    <?php } ?>
										};
                                        // use configuration item and data specified to show chart
                        		myChart.setOption(option);
                        	</script>
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
								<i class="fa fa-table"></i>Lista de Instalações
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
									<th>Data do Serviço</th>
									<th>Número da OS</th>
									<th>Retrabalho</th>
									<th>Periodo</th>
									<th>Contrato do cliente</th>
									<th>Observação</th>
								</thead>
								<tbody>
									<?php if($instalacoes) {foreach ( $instalacoes->result () as $item ) { ?>	
                                	<tr>
                                		<td><?php echo $item->data_servico; ?></td>
										<td><?php echo $item->numero_os; ?></td>
										<td><?php if($item->retrabalho == 1){echo "Sim";}else{echo "Não";} ?></td>
										<td><?php echo $item->periodo; ?></td>	
										<td><?php echo $item->codcli; ?></td>
										<td><?php echo $item->obs; ?></td>							
									</tr>   
									<?php }} ?>	 		
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
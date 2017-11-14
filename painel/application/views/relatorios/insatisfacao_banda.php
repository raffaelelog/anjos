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
						Relatório
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

                                <div class="form-group col-md-4">
                                    <label>Data Inicial</label>
                                    <input type="text" name="data_i" class="form-control datepicker" value="<?php echo set_value('data_cad_i'); ?>" readonly="readonly" required>
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Data Final</label>
                                    <input type="text" name="data_f" class="form-control datepicker" value="<?php echo set_value('data_cad_f'); ?>" readonly="readonly" required>
                                </div>

                                <div class="form-group col-md-4">
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
								<i class="fa fa-bar-chart"></i>Gráfico Insatisfação por Banda
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse" data-original-title=""
									title=""> </a> <a href="" class="fullscreen"
									data-original-title="" title=""></a>
							</div>
							
						</div>
						<div class="portlet-body">
							<?php 
							$planos =  $insatisfeitos->num_rows(); 
							$meses_total =  $retrabalhos->num_rows();
							?>
							<?php


								// converter numero do mes em nome
								function nome_mes($numero_mes)
								{
									switch ($numero_mes) {
										case '1':
											return 'Janeiro';
											break;
										case '2':
											return 'Fevereiro';
											break;
										case '3':
											return 'Março';
											break;
										case '4':
											return 'Abril';
											break;
										case '5':
											return 'Maio';
											break;
										case '6':
											return 'Junho';
											break;
										case '7':
											return 'Julho';
											break;
										case '8':
											return 'Agosto';
											break;
										case '9':
											return 'Setembro';
											break;
										case '10':
											return 'Outubro';
											break;
										case '11':
											return 'Novembro';
											break;
										case '12':
											return 'Dezembro';
											break;
									}
								}// Fim função

								// Pegas os valores de mes e total
								for ($i=0; $i < $meses; $i++) {
									$row = $insatisfeitos->row($i);
									$mes[$i] = nome_mes($row->mes);
									$mes_num[$i] = $row->mes;
									$num_os[$i] = $row->total;
								}

								// Pega os valores de mes e total de OS's
								for ($i=0; $i < $meses_total; $i++) {
									$row = $os_total->row($i);
									$mes_total[$i] = $row->mes;
									$num_os_total[$i] = $row->total;
								}

								for ($i=0; $i < $meses; $i++) { 
									$pc[$i] = round($num_os[$i] / $num_os_total[$i] * 100);
								}



							?>

							<script src="<?php echo base_url('assets/global/scripts/');?>echarts.common.min.js"></script>
                                    <!-- prepare a DOM container with width and height -->
                                    <div id="main" style="width: 100%;height:500px;"></div>
                                    
                                    
                                    <script type="text/javascript">
                                        // based on prepared DOM, initialize echarts instance
                                        var myChart = echarts.init(document.getElementById('main'));

                                        


                                        option = {
										    title: {
										        text: 'RETRABALHO'
										    },
										    tooltip: {
										        trigger: 'axis',
										        axisPointer: { 
										            type: 'shadow' // 默认为直线，可选为：'line' | 'shadow'
										        }
										    },
										    legend: {
										        data: ['Retrabalho', 'Total de OSs'],
										        align: 'right',
										        right: 10
										    },
										    grid: {
										        left: '3%',
										        right: '4%',
										        bottom: '3%',
										        containLabel: true
										    },
										    xAxis: [{
										        type: 'category',
										        data: [
											        <?php 
											        	for($i = 0; $i < $meses; $i++ )
											        	{
											        		echo "'".$mes[$i]."',";
											        	}
											        ?>
										        ]
										    }],
										    yAxis: [{
										        type: 'value',
										        name: 'Quantidade',
										        axisLabel: {
										            formatter: '{value}'
										        }
										    }],
										    series: [{
										        name: 'Retrabalho',
										        type: 'bar',
										        data: [
										        <?php 
										        	for($i = 0; $i < $meses; $i++ )
										        	{
										        		echo "'".$num_os[$i]."',";
										        	}
										        ?>
										        ]
										    }, {
										        name: 'Total de OSs',
										        type: 'bar',
										        data: [
										        	<?php 
											        	for($i = 0; $i < $meses; $i++ )
											        	{
											        		echo "'".$num_os_total[$i]."',";
											        	}
											        ?>
										        ]
										    }]
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
								<i class="fa fa-table"></i>Relatório Retrabalho
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
											<th>Mês</th>
											<th>Retrabalhos</th>
											<th>Ordens no Mês</th>
										</thead>
										<tbody>
		                    				<?php

		                    					for ($i=0; $i < $meses; $i++) { 
		                    				?>
		                    					<tr>
		                    						<td><?php echo $mes[$i]; ?></td>
		                    						<td><?php echo "<strong>".$num_os[$i]."</strong> (".$pc[$i]."%)"; ?></td>
		                    						<td><?php echo $num_os_total[$i]; ?></td>
		                    					</tr>
		                    				<?php
		                    					}

		                    				?>
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
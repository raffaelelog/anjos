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
					<i class="fa fa-archive"> </i> Canceladas vs Retiradas <small></small>
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
                        <!-- Caixas Cadastradas -->
					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-wrench"></i>Filtro de Data Agendamento
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse" data-original-title=""
									title=""> </a> <a href="" class="fullscreen"
									data-original-title="" title=""></a>
							</div>
						</div>
						<div class="portlet-body">
							<form action="" method="post">
								<div class="form-group col-md-4">
									<label>Data Inicial</label> <input type="text" name="data_ini"
										class="form-control datepicker"
										value="<?php echo set_value('data_ini'); ?>"
										readonly="readonly">
								</div>
								<div class="form-group col-md-4">
									<label>Data Final</label> <input type="text" name="data_fim"
										class="form-control datepicker"
										value="<?php echo set_value('data_fim'); ?>"
										readonly="readonly">
								</div>
								<div class="form-group col-md-4">
									<label style="color: #FFF"> Filtrar </label> <input
										type="submit" name="filtrar" class="btn btn-primary btn-block"
										value="Filtrar">
								</div>
							</form>
							<div class="clearfix"></div>
						</div>
					</div>
					<?php if($solicitacoes){ ?>
					<div class="portlet light">
						<div class="portlet-title"> 
							<div class="caption">
								<i class="fa fa-wrench"></i>Grafico Canceladas x Retiradas<?php echo ", Periodo: De ".date('d-m-Y', strtotime(set_value('data_ini')))." a ".date('d-m-Y', strtotime(set_value('data_fim'))); ?>  
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse" data-original-title=""
									title=""> </a> <a href="" class="fullscreen"
									data-original-title="" title=""></a>
							</div>
						</div>
						<div class="portlet-body">
							<div class="content-wrapper"
								style='background-color: #EEE9E9; overflow: auto;'>
								<div class="main">
									<div id="main" style="height: 520px;"></div>
								</div>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
					<?php } ?>
					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-wrench"></i>Tarefas realizadas
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
									<th>Data</th>
									<th>Contrato</th>
									<th>Cliente</th>
									<th>Cidade</th>
									<th>Plano</th>
									<th>Descrição</th>
								</thead>
								<tbody>
                                	<?php if($solicitacoes){ $total = $solicitacoes-> num_rows(); foreach ($solicitacoes->result() as $sol): ?>
                                    	<tr>                          										
										<td><?php echo date('d-m-Y', strtotime($sol->data_can)); ?></td>
										<td><?php echo $sol->contrato; ?></td>
										<td><?php echo $sol->nome; ?></td>
										<td><?php echo $sol->cidade; ?></td>
										<td><?php echo $sol->plano; ?></td>
										<td><?php echo $sol->tipo; ?></td>
									</tr>
                                	<?php endforeach; } ?>  
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
	<script src="<?php echo base_url()."assets/global/scripts/echarts.common.min.js";?>"></script>
	<script type="text/javascript">
    	var myChart = echarts.init(document.getElementById('main'));
    	option = {
    			title: {
                    text: '<?php echo "Total de Pendentes Lançamento: "; echo $total-$lancadas;?>', 
                    subtext: '<?php echo "Total de Pendentes a Fechamento: "; echo $lancadas-$fechadas;?>'
                },
    		    color: ['#3398DB'],
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
    		    xAxis : [
    		    	{
    		            type : 'value',
    		            data : ['Quantidade']
    		        }
    		    ],
    		    yAxis : [
    		    	{
    		            type : 'category',
    		            data : ['Clientes Cancelados','Ordens de Retirada Abertas', 'Ordens de Retiradas Realizadas'],
    		            axisTick: {
    		                alignWithLabel: true
    		            }
    		        }
    		    ],
    		    series : [
    		        {
    		            name:'OSs de Retirada',
    		            type:'bar',
    		            barWidth: '60%',
    		            data:[<?php echo $total.",".$lancadas.",".$fechadas;?>],
    		            itemStyle: {
    		                normal: {
    		                    color: function(params) {
    		                        // build a color map as your need.
    		                        var colorList = ['#4169E1','#0000CD','#191970'];
    		                        return colorList[params.dataIndex]
    		                    }
    		                }
    		            }
    		        }
    		    ]
    		};
        myChart.setOption(option);
    </script>
	<!-- END FOOTER -->
</body>
</html>
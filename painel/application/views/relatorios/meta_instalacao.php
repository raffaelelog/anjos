
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
									<label>Data Inicial</label> <input required="required"
										type="text" name="data" id="data"
										class="form-control monthPicker" readonly="readonly">
								</div>

								<div class="form-group col-md-6">
									<label style="color: #FFF"> Filtrar </label> <input
										type="submit" name="filtrar" class="btn btn-primary btn-block"
										value="Filtrar">
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
							<script
								src="<?php echo base_url('assets/global/scripts/');?>echarts.common.min.js"></script>
							<!-- prepare a DOM container with width and height -->
							<div id="main" style="width: 100%; height: 500px;"></div>
							<script type="text/javascript">
                                var myChart = echarts.init(document.getElementById('main'));                                  
                                option = {
                                		color: ['#c23531','#2F4F4F','#5F9EA0', '#008B8B','#BDB76B','#FF4500','#2f4554'],
                                		<?php if($meses != null and $metas != null){ ?>
                                		title: {
                                			<?php $valor_mes1 = $mes3->row(0)->quantidade + $mes3->row(1)->quantidade + $mes3->row(2)->quantidade + $mes3->row(3)->quantidade + $mes3->row(4)->quantidade?>	
                                			<?php $valor_mes2 = $mes2->row(0)->quantidade + $mes2->row(1)->quantidade + $mes2->row(2)->quantidade + $mes2->row(3)->quantidade + $mes2->row(4)->quantidade?>
                                			<?php $valor_mes3 = $mes1->row(0)->quantidade + $mes1->row(1)->quantidade + $mes1->row(2)->quantidade + $mes1->row(3)->quantidade + $mes1->row(4)->quantidade?>
									    	text: 'Metas x Instaladas',
									    	subtext: 'INSTALADAS - <?php echo strtoupper ($meses[0]).': '.$valor_mes1.', '.strtoupper ($meses[1]).': '.$valor_mes2.' e '.strtoupper ($meses[2]).': '.$valor_mes3; ?>',
									    	position: 'top'
									    },
                                		tooltip : {
                                	        trigger: 'axis',
                                	        axisPointer : {            
                                	            type : 'shadow'        
                                	        }
                                	    },
                                	    legend: {
                                	        data:['Meta','Fibra','Radio','TV','Telefonia','Migração','Total de Instaladas'],
                                	  		x: 'right'
                                	    },
                                	    grid: {
                                	        left: '3%',
                                	        right: '4%',
                                	        bottom: '3%',
                                	        containLabel: true
                                	    },
                                	    xAxis : [
                                	        {
                                	            type : 'category',
                                	            data : [ <?php echo "'".strtoupper ($meses[0])."'"; ?> ,<?php echo "'".strtoupper ($meses[1])."'"; ?>,<?php echo "'".strtoupper ($meses[2])."'"; ?>]
                                	        }
                                	    ],
                                	    yAxis : [
                                	        {
                                	            type : 'value'
                                	        }
                                	    ],
                                	    series : [
                                	        {
                                	            name:'Meta',
                                	            type:'bar',
                                	            data:[<?php foreach ( $metas->result () as $item ) {echo "'".trim($item->valor)."',";}?>],
                                	            itemStyle: {
									                normal: {
									                    label: {
									                        show: true,
									                        position: 'top',
									                        formatter: '{c}'
									                    }
									                }
									            }    
                                    	    },
                                    	    {
                                	            name:'Total de Instaladas',
                                	            type:'bar',
                                	            data:[<?php echo $valor_mes1 ?>,<?php echo $valor_mes2 ?>,<?php echo $valor_mes3 ?>],
                                	            itemStyle: {
									                normal: {
									                    label: {
									                        show: true,
									                        position: 'top',
									                        formatter: '{c}'
									                    }
									                }
									            }    
                                    	    },
                                    	    { 
                                	            name:'Migração',
                                	            type:'bar',
                                	            stack: 'Realizadas',
                                	            data:[<?php echo $mes3->row(0)->quantidade ?>, <?php echo $mes2->row(0)->quantidade ?>, <?php echo$mes1->row(0)->quantidade ?>]
                                	        },    
                                	        {
                                	            name:'Fibra',
                                	            type:'bar',
                                	            stack: 'Realizadas',
                                	            data:[<?php echo$mes3->row(1)->quantidade ?>, <?php echo$mes2->row(1)->quantidade ?>, <?php echo $mes1->row(1)->quantidade ?>]
                                	        },
                                	        {
                                	            name:'Radio',
                                	            type:'bar',
                                	            stack: 'Realizadas',
                                	            data:[<?php echo $mes3->row(2)->quantidade ?>, <?php echo$mes2->row(2)->quantidade ?>, <?php echo $mes1->row(2)->quantidade ?>]
                                	        },
                                	        {
                                	            name:'Telefonia',
                                	            type:'bar',
                                	            stack: 'Realizadas',
                                	            data:[<?php echo $mes3->row(3)->quantidade ?>, <?php echo $mes2->row(3)->quantidade ?>, <?php echo $mes1->row(3)->quantidade ?>]
											},
                                	        {
                                	            name:'TV',
                                	            type:'bar',
                                	            stack: 'Realizadas',
                                	            data:[<?php echo $mes3->row(4)->quantidade ?>, <?php echo $mes2->row(4)->quantidade ?>, <?php echo $mes1->row(4)->quantidade ?>]
                                	        }  
                                	    ]
                                	<?php } ?>
                                	};
                        		myChart.setOption(option);
                        	</script>
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
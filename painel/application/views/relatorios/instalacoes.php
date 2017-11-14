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
					<i class="fa fa-archive"> </i>Instalações <small></small>
					<!--   MENU DE CONTEXTO -->
					<div class="btn-group pull-right" role="group">
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
                    
					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-wrench"></i>Filtro de Data Instalação
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
								<i class="fa fa-wrench"></i>Gráfico  
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
        // 路径配置
        require.config({
            paths: {
                echarts: 'http://echarts.baidu.com/build/dist'
            }
        });
        
        // 使用
        require(
            [
                'echarts',
                'echarts/chart/bar',
				 'echarts/chart/line' 
            ],
            function (ec) {
                // 基于准备好的dom，初始化echarts图表
                var myChart = ec.init(document.getElementById('main')); 
                
                var option = {
    title : {
        text: '',
        subtext: ''
    },
    tooltip : {
        trigger: 'axis'
    },
    legend: {
        data:[<?php echo" '$mes3','$mes2','$mes1' "; ?>]
    },
    toolbox: {
        show : true,
        feature : {
            mark : {show: false},
            dataView : {show: false, readOnly: false},
            magicType : {show: true, type: ['line','bar']},
            restore : {show: false},
            saveAsImage : {show: true}
        }
    },
    calculable : true,
    xAxis : [
        {
            type : 'category',

			data : ['Produtos']
    
        }
    ],
    yAxis : [
        {
            type : 'value'
        }
    ],
    series : [
        {
            name:'NOME DA SERIE',
            type:'bar',
            data:[15],
                              
           itemStyle: {
                normal: {
                    label: {
                        show: true,
                        position: 'top',
                        formatter: '{c}'
                    }
                }
            },
        }

    ]
};
				
        
                // 为echarts对象加载数据 
                myChart.setOption(option); 
            }
        );
    </script>
	<!-- END FOOTER -->
</body>
</html>
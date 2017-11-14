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
                    <h1 class="page-title"> OPERACIONAL
                        <small>estatisticas e gráficos</small>
                    </h1>
                    <!-- END PAGE HEADER-->
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat2 ">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-green-sharp">
                                            <span data-counter="counterup" data-value="1024">0</span>
                                            <small class="font-green-sharp">#</small>
                                        </h3>
                                        <small>OS's ABERTAS</small>
                                    </div>
                                    <div class="icon">
                                        <i class="icon-pie-chart"></i>
                                    </div>
                                </div>
                                <div class="progress-info">
                                    <div class="progress">
                                        <span style="width: 100%;" class="progress-bar progress-bar-success green-sharp">
                                            <span class="sr-only"></span>
                                        </span>
                                    </div>
                                    <div class="status">
                                        <div class="status-title"> Total </div>
                                        <div class="status-number"> 38% </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat2 ">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-red-haze">
                                            <span data-counter="counterup" data-value="75">0</span>
                                        </h3>
                                        <small>OS's AGENDADAS</small>
                                    </div>
                                    <div class="icon">
                                        <i class="icon-like"></i>
                                    </div>
                                </div>
                                <div class="progress-info">
                                    <div class="progress">
                                        <span style="width: 20%;" class="progress-bar progress-bar-success red-haze">
                                            <span class="sr-only">20% atualizados</span>
                                        </span>
                                    </div>
                                    <div class="status">
                                        <div class="status-title"> Atualização </div>
                                        <div class="status-number"> 20% </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat2 ">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-blue-sharp">
                                            <span data-counter="counterup" data-value="1510"></span>
                                        </h3>
                                        <small>ATENDIMENTOS
                                        <i class="icon-basket"></i>
                                    </div>
                                </div>
                                <div class="progress-info">
                                    <div class="progress">
                                        <span style="width: 78%;" class="progress-bar progress-bar-success blue-sharp">
                                            <span class="sr-only"></span>
                                        </span>
                                    </div>
                                    <div class="status">
                                        <div class="status-title"> Mês </div>
                                        <div class="status-number"> 78% </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat2 ">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-purple-soft">
                                            <span data-counter="counterup" data-value="276"></span>
                                        </h3>
                                        <small>INSTALAÇÕES</small>
                                    </div>
                                    <div class="icon">
                                        <i class="icon-user"></i>
                                    </div>
                                </div>
                                <div class="progress-info">
                                    <div class="progress">
                                        <span style="width: 22%;" class="progress-bar progress-bar-success purple-soft">
                                            <span class="sr-only"></span>
                                        </span>
                                    </div>
                                    <div class="status">
                                        <div class="status-title"> Atualizados </div>
                                        <div class="status-number"> 22% </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <!-- Botões de atalho para os Gráficos ou relatórios -->

                            <div class="col-md-12">
                                <div class="clearfix">
                                    <a href="#" class="btn blue"><i class="fa fa-bar-chart"></i> Cancelados X Retirados </a>
                                    <a href="#" class="btn blue"><i class="fa fa-bar-chart"></i> Modelo </a>
                                </div>
                                
                            </div>

                            <hr>
                            <br><br><br>
                            <div class="col-md-12">
                                <script src="<?php echo base_url('assets/global/scripts/');?>echarts.common.min.js"></script>
                                    <!-- prepare a DOM container with width and height -->
                                    <div id="main" style="width: 100%;height:1000px;"></div>
                                    <?php 
                                    $nomes = '';
                                    $numeros = '';
                                    foreach ($ranking_graf->result() as $graf): ?>
                                        <?php 
                                        $nomes .= '\''.$graf->nome." - $graf->sigla".'\',';
                                        $numeros .= $graf->total.',';

                                        ?>
                                    <?php endforeach ?>
                                    <script type="text/javascript">
                                        // based on prepared DOM, initialize echarts instance
                                        var myChart = echarts.init(document.getElementById('main'));

                                        option = {
                                            title: {
                                                text: 'Ranking Técnico',
                                                subtext: 'Mês atual'
                                            },
                                            grid: {
                                                left: '3%',
                                                right: '4%',
                                                bottom: '3%',
                                                containLabel: true
                                            },
                                            xAxis: {
                                                type: 'value',
                                                boundaryGap: [0, 0.01]
                                            },
                                            yAxis: {
                                                type: 'category',
                                                data: [<?php echo $nomes ?>]
                                            },
                                             toolbox: {
                                            show : true,
                                            feature : {
                                                mark : {show: true},
                                                magicType : {show: true, type: ['line', 'bar']},
                                                saveAsImage : {show: true}
                                            }
                                        },
                                            series : [
                                                {
                                                    name:'Técnicos',
                                                    type:'bar',
                                                    itemStyle: {
                                                      normal: {
                                                          color: function(params) {
                                                                // build a color map as your need.
                                                                var colorList = [
                                                                 '#6A5ACD', '   #483D8B','#191970','#000080','#00008B','#0000CD','#0000FF','#4169E1','#1E90FF','#00BFFF','#87CEFA','#87CEEB','#ADD8E6','#4682B4','#FF82B4','#6A5ACD', '   #483D8B','#191970','#000080','#00008B','#0000CD','#0000FF','#4169E1','#1E90FF','#00BFFF','#87CEFA','#87CEEB','#ADD8E6','#4682B4','#FF82B4','#6A5ACD', '   #483D8B','#191970','#000080','#00008B','#0000CD','#0000FF','#4169E1','#1E90FF','#00BFFF','#87CEFA','#87CEEB','#ADD8E6','#4682B4','#FF82B4',
                                                                ];
                                                                return colorList[params.dataIndex]
                                                            },
                                                        label : {
                                                          show: true
                                                                }
                                                    }},
                                                    data:[<?php echo $numeros ?>]
                                                },
                                            ]
                                        };
                                        // use configuration item and data specified to show chart
                                        myChart.setOption(option);
                                    </script>
                            </div>
                        </div>
                    </div>
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
        <!-- END FOOTER -->
    </body>

</html>
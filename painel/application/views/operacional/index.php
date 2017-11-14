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

                    <hr>

                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <script src="<?php echo base_url('assets/global/scripts/');?>echarts.common.min.js"></script>
                                    <!-- prepare a DOM container with width and height -->
                                    <div id="main" style="width: 100%;height:350px;"></div>
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
                                                data: ['Wagner Campos','Thiago Oliveira','Heitor','Welignton Silva','Jeff','João Paulo','Daniel','Adilson Rosa','Alexandre Junior','Bruno Carvalho','Bruno Junior','Cláudio']
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
                                                                 '#6A5ACD', '   #483D8B','#191970','#000080','#00008B','#0000CD','#0000FF','#4169E1','#1E90FF','#00BFFF','#87CEFA','#87CEEB','#ADD8E6','#4682B4','#FF82B4',
                                                                ];
                                                                return colorList[params.dataIndex]
                                                            },
                                                        label : {
                                                          show: true
                                                                }
                                                    }},
                                                    data:[20, 25, 19, 32, 25, 22, 22, 31, 25, 14, 24, 29]
                                                },

                                            ]
                                        };


                                        // use configuration item and data specified to show chart
                                        myChart.setOption(option);
                                    </script>
                            </div>

                            <div class="col-md-6">
                                <!-- prepare a DOM container with width and height -->
                                    <div id="main_pie" style="width: 100%;height:350px;"></div>
                                    <script type="text/javascript">
                                        // based on prepared DOM, initialize echarts instance
                                        var myChart_pie = echarts.init(document.getElementById('main_pie'));

                                        option = {

                                        backgroundColor: '#CCC',

                                        title: {
                                            text: 'Status de Ordens no mês',
                                            left: 'center',
                                            top: 20,
                                            textStyle: {
                                                color: '#000'
                                            }
                                        },

                                        tooltip : {
                                            trigger: 'item',
                                            formatter: "{a} <br/>{b} : {c} ({d}%)"
                                        },

                                        visualMap: {
                                            show: false,
                                            min: 80,
                                            max: 600,
                                            inRange: {
                                                colorLightness: [0, 1]
                                            }
                                        },
                                        series : [
                                            {
                                                name:'Quantidade',
                                                type:'pie',
                                                radius : '55%',
                                                center: ['50%', '50%'],
                                                data:[
                                                    {value:1024, name:'Abertas'},
                                                    {value:600, name:'Fechadas'},
                                                    {value:800, name:'Pendentes'}
                                                ].sort(function (a, b) { return a.value - b.value; }),
                                                roseType: 'radius',
                                                label: {
                                                    normal: {
                                                        textStyle: {
                                                            color: '#FFF'
                                                        }
                                                    }
                                                },
                                                labelLine: {
                                                    normal: {
                                                        lineStyle: {
                                                            color: '#FFF'
                                                        },
                                                        smooth: 0.2,
                                                        length: 10,
                                                        length2: 20
                                                    }
                                                },
                                                itemStyle: {
                                                    normal: {
                                                        color: '#c23531',
                                                        shadowBlur: 200,
                                                        shadowColor: '#FFF'
                                                    }
                                                },

                                                animationType: 'scale',
                                                animationEasing: 'elasticOut',
                                                animationDelay: function (idx) {
                                                    return Math.random() * 200;
                                                }
                                            }
                                        ]
                                    };


                                        // use configuration item and data specified to show chart
                                        myChart_pie.setOption(option);
                                    </script>
                            </div>
                        </div>
                    </div>

                    <div class="container">
                        <div class="row">
                            
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
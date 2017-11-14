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
                    <div class="page-title">
                      Histórico
                      <small>Mapa</small>
                      <!--   MENU DE CONTEXTO -->
                      <div class="btn-group pull-right" role="group">
                        <a class="btn btn-default btn-sm btn btn-secondary" href="<?php echo base_url('index.php/geo/historico/tecnicos'); ?>">
                          <i class="fa fa-wrench"> </i> Ver todos os Técnicos
                        </a>
                        <a class="btn btn-default btn-sm btn btn-secondary" href="<?php echo base_url('painel'); ?>">
                          <i class="fa fa-dashboard"> </i> Dashboard
                        </a>
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
                                <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                                <a href="" class="fullscreen" data-original-title="" title=""></a>
                            </div>
                        </div>
                        <div class="portlet-body" >
                            <form action="" method="post">
                                <div class="col-md-3">
                                    <input type="text" name="data" class="form-control datepicker" placeholder="Informe uma data" required="required">
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control" name="hora_inicial">
                                        <option value="07:00:00.000" selected="selected">Hora Inicial</option>
                                        <option value="07:00:00">07:00</option>
                                        <option value="08:00:00">08:00</option>
                                        <option value="09:00:00">09:00</option>
                                        <option value="10:00:00">10:00</option>
                                        <option value="11:00:00">11:00</option>
                                        <option value="12:00:00">12:00</option>
                                        <option value="13:00:00">13:00</option>
                                        <option value="14:00:00">14:00</option>
                                        <option value="15:00:00">15:00</option>
                                        <option value="16:00:00">16:00</option>
                                        <option value="17:00:00">17:00</option>
                                        <option value="18:00:00">18:00</option>
                                        <option value="19:00:00">19:00</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control" name="hora_final">

                                        <option value="20:00:00" selected="selected">Hora Final</option>
                                        <option value="08:00:00">08:00</option>
                                        <option value="09:00:00">09:00</option>
                                        <option value="10:00:00">10:00</option>
                                        <option value="11:00:00">11:00</option>
                                        <option value="12:00:00">12:00</option>
                                        <option value="13:00:00">13:00</option>
                                        <option value="14:00:00">14:00</option>
                                        <option value="15:00:00">15:00</option>
                                        <option value="16:00:00">16:00</option>
                                        <option value="17:00:00">17:00</option>
                                        <option value="18:00:00">18:00</option>
                                        <option value="19:00:00">19:00</option>
                                        <option value="20:00:00">20:00</option>
                                    </select>
                                </div>
                                <div class="col-md-3"><input type="submit" name="filtro" value="Filtrar" class="btn btn-primary btn-block"></div>
                            </form>
                            <div class="clearfix"></div>
                        </div><!-- Final do portlet-body -->
                    </div>
                        <div class="portlet light"> 
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-wrench"></i>Mapa </div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                                    <a href="" class="fullscreen" data-original-title="" title=""></a>
                                </div>
                            </div>
                            <div class="portlet-body" >
                            <?php 
                                    echo $historico_tec->num_rows;
                                    if($historico_tec->num_rows() === NULL OR $historico_tec->num_rows() == 0 )
                                    {
                            ?>
                            <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              Nenhum registro encontrado para esse usuário.
                            </div>
                            <?php            
                                    }else{ 
                            ?>
                            <div id="map" style="min-height: 400px;"></div>


                            <?php
                                /*                                  
                                    Tratamento das coordenadas do usuario
                                    para interação com a api do gmap
                                */
                                $coordenada = '';
                                $coordenada_calor = '';
                                foreach ($historico_tec->result() as $historico) {
                                    /*Concatena os registros le Lat. e long. no formato correto*/
                                    $coordenada .= '{lat: '.$historico->latitude.', lng: '.$historico->longitude.'},';
                                    $coordenada_calor .= 'new google.maps.LatLng('.$historico->latitude.','. $historico->longitude.'),';
                                }
                                /*
                                    Pegar a coordenada do ponto inicial e centro do mapa
                                    last_row por ser o registro mais recente
                                */
                                $primeiro_ponto = $historico_tec->last_row();
                                $center = '{lat: '.$primeiro_ponto->latitude.', lng: '.$primeiro_ponto->longitude.'}';
                                /*
                                    Pegar a coordenada do ponto final
                                    first_row por ser o registro mais antigo
                                */
                                $ultimo_ponto = $historico_tec->first_row();
                                $ponto_final = '{lat: '.$ultimo_ponto->latitude.', lng: '.$ultimo_ponto->longitude.'}';
                            ?>
                            <script>
                            var map, heatmap;
                            function initMap() {
                                map = new google.maps.Map(document.getElementById('map'), {
                                    zoom: 15,
                                    center: <?php /*Ponto inicial*/echo $center; ?>
                                });
                              var flightPlanCoordinates = [
                                <?php  echo /*Pontos no mapa*/$coordenada; ?>
                              ];
                              var flightPath = new google.maps.Polyline({
                                path: flightPlanCoordinates,
                                geodesic: true,
                                strokeColor: '#0000FF',
                                strokeOpacity: 0.9,
                                strokeWeight: 2,                               
                                geodesic: true,
                                visible: true,
                                icons: [{
                                  icon: {
                                    path: google.maps.SymbolPath.BACKWARD_OPEN_ARROW
                                  },
                                  offset: '25px',
                                  repeat: '70px',
                                }]
                              });
                              //Confirgurar icone personalizado
                                var image = {
                                url: '<?php echo base_url('assets/img/')."m_azul.png"; ?>',
                                // This marker is 20 pixels wide by 32 pixels high.
                                size: new google.maps.Size(50 , 42)
                              };
                              //Confirgurar icone personalizado
                                var image_f = {
                                url: '<?php echo base_url('assets/img/')."m_verde.png"; ?>',
                                // This marker is 20 pixels wide by 32 pixels high.
                                size: new google.maps.Size(50 , 42)
                              };                             
                              //Marker inicial + window com info
                              var contentString = 'Informações adicionais<br>Linha 2';
                              var infowindow = new google.maps.InfoWindow({
                                content: contentString
                              });
                          		var markerInicial = new google.maps.Marker({
                                position: <?php echo /*Coordenada do marker inicial*/$center; ?>,
                                map: map,
                                title: 'Ponto Inicial!',
                                icon: image
                              });
                              /*Window do marker inicial*/
                              markerInicial.addListener('click', function() {
                                infowindow.open(map, markerInicial);
                              });
                              /*Marker final*/
                              var markerF = new google.maps.Marker({
                                position: <?php echo  /*Cooredenada do marker final*/$ponto_final; ?>,
                                map: map,
                                title: 'Ponto Final!',
                                icon:image_f
                              });
                              flightPath.setMap(map);
                              /*Camada de mapa de calor*/
                              heatmap = new google.maps.visualization.HeatmapLayer({
                                data: getPoints(),
                                map: map
                              });
                              // Heatmap data: 500 Points
                                function getPoints() {
                                  return [
                                    <?php  echo /*Pontos no mapa*/$coordenada_calor; ?>
                                ];
                                }                                               
                            }
							</script>
        					<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAFRGCF8DPiY8AZY54b44_sNuX0JVYQkr4&signed_in=true&libraries=visualization&sensor=true&callback=initMap"></script>
                            <?php } ?>                                        
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
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
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
        <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
        <script>
            $(document).ready(function() {
                $('.datatable').DataTable({
                    "language" : {
                        "lengthMenu" : "Mostrar _MENU_ registros por página",
                        "loadingRecords" : "Carregando...",
                        "processing" : "Processando...",
                        "search" : "Buscar:",
                        "zeroRecords" : "Nenhum registro encontrado",
                        "info" : "Página _PAGE_ de _PAGES_",
                        "infoEmpty" : "Não há registros disponíveis",
                        "infoFiltered" : "(Filtro _MAX_ dos registros)",
                        "paginate" : {
                            "first" : "Primeira",
                            "last" : "Ultima",
                            "next" : "Próximo",
                            "previous" : "Anterior",
                        },
                    }
                });
            }); 
        </script>
        <script type="text/javascript">
            // For demo to fit into DataTables site builder...
            $('.datatable').removeClass('display').addClass('table'); 
        </script>
        <!-- END FOOTER -->
    </body>
</html>
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
				<div class="page-title">
					DASHBOARD <small>estatisticas e gráficos</small>
					<div class="btn-group pull-right" role="group">
						<a class="btn btn-default btn-sm btn btn-secondary"
							href="<?php echo base_url('painel'); ?>"> <i
							class="fa fa-dashboard"> </i> Dashboard
						</a>
					</div>
				</div>
				<!-- END PAGE HEADER-->
				<div class="row">
					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-wrench"></i>Técnicos
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse" data-original-title=""
									title=""> </a> <a href="" class="fullscreen"
									data-original-title="" title=""></a>
							</div>
						</div>
						<div class="portlet-body">
							<table class="table table-hover datatable" id="sample_3">
								<thead>
									<tr>
										<th>Técnico</th>
										<th>E-mail</th>
										<th>Unidade</th>
										<th>Ver Histórico</th>
									</tr>
								</thead>
								<tbody>
                            <?php foreach ( $tecnicos->result () as $tecnico ) { ?>
                            	<tr>
										<td> <?= $tecnico->nome; ?> </td>
										<td> <?= $tecnico->email; ?> </td>
										<td> <?= $tecnico->unidade; ?> </td>
										<td><a
											href="<?php echo base_url('geo/historico/tecnico')."/".$tecnico->cod_usuario; ?>"
											class="btn btn-primary btn-xs pull-right">Abrir</a></td>
									</tr>
                           	<?php } ?>                           
                        	</tbody>
							</table>
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
	<script type="text/javascript">  $('.datatable').removeClass('display').addClass('table');  </script>
	<!-- END FOOTER -->
</body>
</html>
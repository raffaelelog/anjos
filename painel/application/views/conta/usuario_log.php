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
					Logs Usuário
					<div class="btn-group pull-right" role="group">
						<a class="btn btn-default btn-sm btn btn-secondary"
							href="<?php echo base_url('usuarios/logs'); ?>"> <i
							class="fa fa-user"> </i> Logs dos Usuários
						</a> <a class="btn btn-default btn-sm btn btn-secondary"
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
								<i class="fa fa-filter"></i>Logs do usuário - <?php echo $logs->num_rows(); ?> registro(s)
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
							<table class="table table-hover datatable" id="sample_3">
								<thead>
									<th>Id</th>
									<th>Data</th>
									<th>Atividade</th>
								</thead>
								<tbody>
									<?php $id = 1;  ?>
									<?php foreach ( $logs->result () as $item ) { ?>
										<tr>
										<th><?php echo $id++; ?></th>
										<td style="width: 80px"> <?php echo date('d-m-Y', strtotime($item -> data)) ; ?> </td>
										<td> <?php echo $item -> atividade; ?> </td>
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
	<!-- END FOOTER -->
	</body>
</html>
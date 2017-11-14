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
				<h1 class="page-title">Gerência do Site</h1>
				<!-- END PAGE HEADER-->
				<div class="row">
					<?php foreach ($lista -> result() as $item){ ?>
					<div class="col-md-3">
						<div class="dashboard-stat blue-madison"
							style="background-color: #1E90FF">
							<div class="visual">
								<i class="fa <?php echo $item -> icone; ?>"></i>
							</div>
							<div class="details">
								<div class="number">&nbsp;</div>
								<div class="" style="width: 100%; color: #FFF"><?php echo $item -> titulo; ?></div>
							</div>
							<a class="more"
								href="<?php echo base_url($item -> uri_pagina);?>"
								style="clear: both; background-color: #1E90FF"> Abrir <i
								class="m-icon-swapright m-icon-white"></i>
							</a>
						</div>
					</div>
					<?php } ?>
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
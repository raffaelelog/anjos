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
					Ítens de Consumo - Tranferências Realizadas
					<!--   MENU DE CONTEXTO -->
					<div class="btn-group pull-right" role="group">
						<a class="btn btn-default btn-sm btn btn-secondary"
							href="<?php echo base_url('estoque/dashboard'); ?>"> <i
							class="fa fa-dashboard"></i> Dashboard
						</a>
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
								<i class="fa fa-filter"></i>Produtos Transferidos
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
							<table class="table table-striped" id="sample_3">
								<thead>
									<th>Data</th>
									<th>Produto</th>
									<th>Código</th>
									<th>Quantidade</th>
								</thead>
								<tbody>
									<?php foreach ($transferidos->result() as $trans): ?>
										<tr>
											<td><?php echo $trans->data_lan; ?></td>
											<td><?php echo $trans->descricao; ?></td>
											<td><?php echo $trans->cod_itemconsumo; ?></td>
											<td><?php echo $trans->quantidade; ?></td>
										</tr>
									<?php endforeach ?>
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
	<!-- END FOOTER -->
</body>
</html>
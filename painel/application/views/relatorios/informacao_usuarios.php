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
				<div>
					<div class="page-title">
						Usuários Operate
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
					</div>
				</div>
				<!-- END PAGE HEADER-->
				<div class="row">
					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-filter"></i>Relatório Usuários
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
									<th>Nome</th>
									<th>Unidade</th>
									<th>Setor</th>
									<th>Email</th>
									<th>Ramal</th>
									<th>Telefone 1</th>
									<th>Telefone 2</th>								
								</thead>
								<tbody>
                    			<?php if($itens){foreach ( $itens->result () as $item ) { ?>
                      				<tr>
										<td><?php echo $item->nome; ?></td>
										<td><?php echo $item->descri_unidade; ?></td>
										<td><?php echo $item->descri_setor; ?></td>
										<td><?php echo $item->email; ?></td>
										<td><?php echo $item->ramal;?></td>
										<td>
											<?php if($item->telefone_1 != null){ 
												if(strlen ($item->telefone_1) == 11 ){ 
													echo "(".substr($item->telefone_1, 0,2).")".substr($item->telefone_1, 2,5)."-".substr($item->telefone_1, -4);
												}else{
													echo "(".substr($item->telefone_1, 0,2).")".substr($item->telefone_1, 2,4)."-".substr($item->telefone_1, -4);
												}
											}else{
												echo " - ";
											} ?>
										</td>
										<td>
											<?php if($item->telefone_2 != null){ 
												if(strlen ($item->telefone_2) == 11 ){
													echo "(".substr($item->telefone_2, 0,2).")".substr($item->telefone_2, 2,5)."-".substr($item->telefone_2, -4);
												}else{
													echo "(".substr($item->telefone_2, 0,2).")".substr($item->telefone_2, 2,4)."-".substr($item->telefone_2, -4);
												}
											}else{
												echo " - ";
											} ?>
										</td>
									</tr>
                    			<?php }} ?>
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
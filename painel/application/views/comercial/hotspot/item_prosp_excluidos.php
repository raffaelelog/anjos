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
					Registros de Contato HotSpot City10
					<!--   MENU DE CONTEXTO -->
					<div class="btn-group pull-right" role="group">
						<a class="btn btn-default btn-sm btn btn-secondary"
							href="<?php echo base_url('comercial/prospecto/index_removidos'); ?>">
							<i class="fa fa-dashboard"></i> Cadastros Removidos
						</a> <a class="btn btn-default btn-sm btn btn-secondary"
							href="<?php echo base_url('painel'); ?>"> <i
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
								<i class="fa fa-filter"></i>Dados do prospecto
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse" data-original-title=""
									title=""> </a> <a href="" class="fullscreen"
									data-original-title="" title=""></a>
							</div>
						</div>
						<?php foreach ( $cadastro->result () as $itemCad ) {	?>
						<div class="portlet-body">
							<div class="col-md-12">
								<div class="col-md-6">
									<table>
										<tr>
											<th><label style="font-size: 20px"><u> Informações Principais</u>: </label>
												<br></th>
										</tr>
										<tr>
											<td><label><u> Nome</u>: </label>
											<?php echo $itemCad ->nome; ?> </td>
										</tr>
										<tr>
											<td><label><u> E-mail</u>: </label>
											<?php echo $itemCad->email; ?> </td>
										</tr>
										<tr>
											<td><label><u> Celular</u>: </label>
											<?php echo $itemCad-> celular; ?> <br> <br></td>
										</tr>
									</table>
								</div>
								<div class="col-md-6">
									<table>
										<tr>
											<th><label style="font-size: 20px"><u> Informações
													Complementares</u>: </label> <br></th>
										</tr>
										<tr>
											<td><label><u> Data de Nascimento</u>: </label> <?php echo date('d-m-Y', strtotime($itemCad->dat_nascimento)); ?> </td>
										</tr>
										<tr>
											<td><label><u> Cidade</u>: </label> <?php echo $itemCad-> cidade; ?> </td>
										</tr>
										<tr>
											<td><label><u> Contrato</u>: </label> <?php echo $itemCad-> cliente; ?> </td>
										</tr>
									</table>
								</div>
							</div><div class="clearfix"></div>
						</div>
					</div>
					<?php } ?>
					<!-- Final do portlet-body -->
					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-filter"></i>Lista de registros de contato
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse" data-original-title=""
									title=""> </a> <a href="" class="fullscreen"
									data-original-title="" title=""></a>
							</div>
						</div>
						<div class="portlet-body">
							<table class="table table-hover datatable" id="sample_3_tools">
								<thead>
									<th>Data oferta</th>
									<th>Período oferta</th>
									<th>Pessoa contactada</th>
									<th>Funcionario</th>
									<th>Descritivo</th>
								</thead>
								<tbody>
                   	 		<?php foreach ( $itens->result () as $item ) { ?>
                   	   			<tr>
										<td><?php echo $item -> Data_oferta; ?></td>
										<td><?php echo $item -> Horario_oferta; ?></td>
										<td><?php echo $item -> Pessoa_contactada; ?></td>
										<td><?php echo $item -> Pessoa_funcionario; ?></td>
										<td align="justify"><?php echo $item -> Observacao; ?></td>
									</tr>
                    		<?php } ?>
                    		</tbody>
							</table>
						</div>
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
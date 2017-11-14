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
			<div class="page-content">
				<!-- BEGIN PAGE HEADER-->
				<div>
					<div class="page-title">
						Páginas
						<!--   MENU DE CONTEXTO -->
						<div class="btn-group pull-right" role="group">
							<a class="btn btn-default btn-sm btn btn-secondary"
								href="<?php echo base_url('painel'); ?>"> <i
								class="fa fa-dashboard"></i> Dashboard
							</a>
						</div>
					</div>
				</div>
				<!-- END PAGE HEADER-->
				<div class="row">
					<!-- BEGIN Portlet PORTLET-->
					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-screen-tablet font-grey-gallery"></i> <span
									class="caption-subject bold font-grey-gallery uppercase">
									Cadastrar Página </span> <span class="caption-helper"></span>
							</div>
							<div class="tools">
								<a href="" class="collapse" data-original-title="" title=""> </a>
								<a href="" class="fullscreen" data-original-title="" title=""> </a>
								<a href="" class="remove" data-original-title="" title=""> </a>
							</div>
						</div>
						<div class="portlet-body">
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
                          <form
								action="<?php echo base_url('usuarios/paginas'); ?>"
								method="post">
								<div class="col-md-2">
									<label>Setor/Categoria</label> <select name="cod_setor"
										class="form-control" required="required">
										<option value="">Selecione...</option>
                                <?php foreach ( $setores->result () as $setor ) { ?>
                                  <option value="<?php echo $setor->cod_setor; ?>"><?php echo $setor->descri_setor; ?></option>
                                <?php } ?>
                              </select>
								</div>
								<div class="col-md-2">
									<label>Título</label> <input type="text" class="form-control"
										name="titulo" placeholder="Título">
								</div>
								<div class="col-md-2">
									<label>URI</label> <input type="text" class="form-control"
										name="uri_pagina" placeholder="usuarios/cadastrar">
								</div>
								<div class="col-md-2">
									<label>Cod. Ícone</label> <input type="text"
										class="form-control" name="icone" placeholder="fa-user">
								</div>
								<div class="col-md-2">
									<label>Atalho/Menu</label><br /> <label class="radio-inline"> <input
										type="radio" class="" name="atalho" value="1">Sim
									</label> <label class="radio-inline"> <input type="radio"
										class="" name="atalho" value="0" checked>Não
									</label>

								</div>
								<div class="col-md-2">
									<label>&nbsp;</label> <input type="submit"
										class="btn btn-primary col-md-12" name="novo"
										value="Cadastrar">
								</div>
							</form>
							<div class="clearfix"></div>
						</div>
					</div>
					<!-- END GRID PORTLET-->
				</div>
				<!-- FIM CLASS ROW -->
				<!--  MOSTRAR PAGINAS CADASTRADAS -->
				<div class="row">
					<!-- BEGIN Portlet PORTLET-->
					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-screen-tablet font-grey-gallery"></i> <span
									class="caption-subject bold font-grey-gallery uppercase">
									Páginas Cadastradas</span> <span class="caption-helper"></span>
							</div>
							<div class="tools">
								<a href="" class="collapse" data-original-title="" title=""> </a>
								<a href="" class="fullscreen" data-original-title="" title=""> </a>
								<a href="" class="remove" data-original-title="" title=""> </a>
							</div>
						</div>
						<div class="portlet-body">
							<table class="table table-bordered" id="sample_3">
								<thead>
									<th>Setor</th>
									<th>Título</th>
									<th>URI</th>
									<th>Ícone</th>
									<th>Atalho</th>
									<th>Opções</th>
								</thead>
								<tbody>
                              <?php foreach ( $paginas->result () as $pagina ) { ?>
                              <tr>
										<td><?php echo $pagina->descri_setor; ?></td>
										<td><?php echo $pagina->titulo; ?></td>
										<td><?php echo $pagina->uri_pagina; ?></td>
										<td><i class="fa <?php echo $pagina->icone; ?>"></i> <?php echo $pagina->icone; ?></td>
										<td><?php if($pagina->atalho == 1){echo "Sim";}else{echo "Não";} ?></td>
										<td>
											<form action="<?php echo base_url('usuarios/paginas'); ?>"
												method="post">
												<input type="hidden" name="cod_pagina"
													value="<?php echo $pagina->cod_pagina; ?>"> <input
													type="submit" name="excluir" value="Excluir"
													class="btn btn-danger btn-sm">
											</form>
										</td>
									</tr>
                              <?php } ?>
                             </tbody>
							</table>
							<div class="clearfix"></div>
						</div>
					</div>
					<!-- END GRID PORTLET-->
				</div>
				<!-- FIM CLASS ROW -->
				<!-- FIM MOSTRAR PÁGINAS CADASTRADAS -->
			</div>
		</div>
		<!-- END CONTENT -->
		<!-- BEGIN QUICK SIDEBAR -->
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
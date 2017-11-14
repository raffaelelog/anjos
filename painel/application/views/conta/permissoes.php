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
					Usuários
					<!--   MENU DE CONTEXTO -->
					<div class="btn-group pull-right" role="group">
						<a class="btn btn-default btn-sm btn btn-secondary"
							href="<?php echo base_url('usuarios'); ?>"> <i
							class="fa fa-user"></i> Usuários
						</a>
						<a class="btn btn-default btn-sm btn btn-secondary"
							href="<?php echo base_url('painel'); ?>"> <i
							class="fa fa-dashboard"></i> Dashboard
						</a>
						<button class="btn btn-default btn-sm btn btn-secondary"
							data-toggle="modal" data-target="#novoUsuario">
							<i class="fa fa-user-plus"></i> Clonar Usuário
						</button>
					</div>
				</div>
				<!-- Modal -->
				<div class="modal fade" id="novoUsuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal"
									aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								<h4 class="modal-title" id="myModalLabel">Clonar Usuário</h4>
							</div>
							<form class="form-group" action="<?php echo base_url().'usuarios/permissoes/'.$usuario->row(0)->cod_usuario; ?>"
								method="post">
								<div class="modal-body">
									<div class="form-group col-md-6">
										<label for="nome">Usuário que receberá</label> 
										<input readonly type="text" class="form-control" name="nome" id="nome" required="required" value="<?php echo $usuario->row(0)->nome; ?>">
									</div>
									<div class="form-group col-md-6">
										<label for="setorl">Setor</label> 
										<input readonly type="text" class="form-control" name="setor" id="setor" required="required" value="<?php echo $usuario->row(0)->descri_setor; ?>">
									</div>
								</div>
								<div class="modal-footer col-md-12">
									<div class="form-group col-md-12">
										<label for="nivel">Usuário clonado</label> 
										<select name="clone" class="form-control" required="required">
											<option value="">Selecione...</option>										
											 <?php foreach ( $usuarios->result () as $item ) { ?>      
												<option value="<?php echo $item->cod_usuario;?>"><?php echo $item->nome." (".$item->descri_setor." )";?></option>
											 <?php } ?> 
										</select>
									</div>							
								</div>
								<hr>
								<div class="modal-footer col-md-6">
									<button type="button" class="btn btn-default btn-block" data-dismiss="modal">Cancelar</button>							
								</div>
								<div class="modal-footer col-md-6">
									<input type="submit" class="btn btn-primary btn-block" value="Clonar" name="clonar">
								</div>
								<div class="clearfix"></div>
							</form>
						</div>
					</div>
				</div>
				<!-- END MODAL-->
				<!-- END PAGE HEADER-->
				<div class="row">
					<div class="col-md-12 ">
						<!-- BEGIN Portlet PORTLET-->
						<div class="portlet light">
							<div class="portlet-title">
								<div class="caption">
									<i class="icon-screen-tablet font-grey-gallery"></i> 
									<span class="caption-subject bold font-grey-gallery uppercase">
									<?php echo "Usuario ".$usuario->row(0)->nome." (".$usuario->row(0)->descri_setor.")"." - ".$quantidade->num_rows()." Telas liberadas";?>
									</span> <span class="caption-helper"></span>
								</div>
								<div class="tools">
									<a href="" class="collapse" data-original-title="" title=""> </a>
									<a href="" class="fullscreen" data-original-title="" title="">
									</a> <a href="" class="remove" data-original-title="" title="">
									</a>
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
                              <?php $setor=0; ?>                               
                              <?php foreach ( $categorias_permissoes->result () as $categorias ) { ?>                              
                              	<?php if ($categorias->cod_setor != $setor){ ?> 
                              	<?php $setor=$categorias->cod_setor; ?> 
                              	<br><h4><i class="fa fa-file"></i> <?php echo $categorias->descri_setor; ?></h4>
                              	<?php } ?> 
								<table class="table table-hover datatable" style="margin-bottom: 0;" id="sample_3">
									<tbody>                               
                                      <tr>
											<td><?php echo $categorias->titulo; ?></td>
											<td><?php if ($categorias->permissao == 1) { ?>
                                            	<form action="" method="post">
													<input type="submit" class="btn btn-danger btn-xs pull-right" name="mudar_permissao" value="Retirar Permissão"> 
													<input type="hidden" name="cod_pagina" value="<?php echo $categorias->cod_pagina; ?>">
												</form>
                                            	<?php } else { ?>
                                            	<form action="" method="post">
													<input type="submit" class="btn btn-success btn-xs pull-right" name="mudar_permissao" value="Permitir"> 
													<input type="hidden" name="cod_pagina" value="<?php echo $categorias->cod_pagina; ?>"> 
													<input type="hidden" name="uri_pagina" value="<?php echo $categorias->uri_pagina; ?>">
												</form>
                                            <?php } ?>                                       
                                        	</td>
										</tr>                             
                                  </tbody>
								</table>
                                <?php } ?>
                              <div class="clearfix"></div>
							</div>
						</div>
						<!-- END GRID PORTLET-->
					</div>
					<!-- END GRID PORTLET-->
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
	<!-- END CONTAINER -->
	<!-- BEGIN FOOTER -->
    <?php $this->load->view('layout/footer'); ?>
<!-- END FOOTER -->
</body>
</html>
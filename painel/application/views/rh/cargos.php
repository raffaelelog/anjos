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
				<h1 class="page-title">
					<i class="fa fa-taxi"> </i> Cargos <small></small>
					<!--   MENU DE CONTEXTO -->
					<div class="btn-group pull-right" role="group">
						<a class="btn btn-default btn-sm btn btn-secondary"
							href="<?php echo base_url('painel'); ?>"> <i
							class="fa fa-dashboard"></i> Dashboard
						</a>
						<button class="btn btn-default btn-sm btn btn-secondary"
							data-toggle="modal" data-target="#novoCargo">
							<i class="fa fa-user-plus"></i> Novo Cargo
						</button>
					</div>
				</h1>
				<!-- END PAGE HEADER-->
				<div class="modal fade" id="novoCargo" tabindex="-1" role="dialog"
					aria-labelledby="myModalLabel">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal"
									aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								<h4 class="modal-title" id="myModalLabel">Cadastrar Novo Cargo</h4>
							</div>
							<form class="form-group" name="formulario" action="" method="post">
								<div class="modal-body">
									<div class="form-group col-md-12">
										<label for="nome">Nome do cargo</label> 
										<input type="text" class="form-control" name="cargo" id="cargo" required="required" value="<?php echo set_value('cargo'); ?>" autocomplete="off">
									</div>
								</div>
								<div class="modal-footer col-md-6">
									<button type="button" class="btn btn-default btn-block" data-dismiss="modal">Cancelar</button>							
								</div>
								<div class="modal-footer col-md-6">
									<input type="submit" class="btn btn-primary btn-block" name="cadastrar_cargos" value="Cadastrar">
								</div>
								<div class="clearfix"></div>
							</form>
						</div>
					</div>
				</div>
				<div class="modal fade" id="editar" tabindex="-1" role="dialog"
					aria-labelledby="myModalLabel">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal"
									aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								<h4 class="modal-title" id="myModalLabel">Editar cargo</h4>
							</div>
							<form class="form-group" name="formulario" action=""
								method="post">
								<div class="modal-body">
									<div class="form-group col-md-12">
										<label for="nome">Valor</label> 
										<input type="text" class="form-control valor_editado" 
											name="valor_editado" id="valor_editado" autocomplete="off"> 
										<input type="hidden" class="id" value="#" name="id">
									</div>
									<div class="modal-footer col-md-4">
										<button type="button" class="btn btn-default btn-block"
											data-dismiss="modal">Cancelar</button>
									</div>
									<div class="modal-footer col-md-4">
										<button type="submit" class="btn btn-primary btn-block"
											name="editar_cargo" value="Editar">Editar</button>
									</div>
									<div class="modal-footer col-md-4">
										<button type="submit" class="btn btn-danger btn-block"
											name="excluir_cargo" value="Excluir">Excluir</button>
									</div>
									<div class="clearfix"></div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<!-- END PAGE HEADER-->
				<!-- END PAGE HEADER-->
				<div class="row">
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
               		<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-wrench"></i>Cargos Existentes
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
							<table class="table table-responsive" id="sample_3">
								<thead>
									<th>Cargo</th>
									<th>Ações</th>
								</thead>
								<tbody>
                                	<?php foreach ($cargo->result() as $item) { ?>
                                    	<tr>
											<td><?php echo $item->desc_cargo; ?></td>
											<td><a class="editar btn btn-success btn-xs"
												data-valor="<?php echo $item->desc_cargo; ?>"
												data-id="<?php echo $item->cod_cargo; ?>"><i
													class="fa fa-edit"></i>Modificar</a> 
											</td>
										</tr>  
                                	<?php } ?>
                            	</tbody>
							</table>
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
        <script>	
	    	$('.editar').on('click', function(){
	     		var id = $(this).data('id'); // vamos buscar o valor do atributo data-id
	      		var valor = $(this).data('valor')
	      		$('input.id').attr('value', id);
	      		$('input.valor_editado').attr('value', valor);
	      		$('#editar').modal('show'); // modal aparece
			});
    	</script>
	<link rel="stylesheet"
		href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<!-- END FOOTER -->
</body>
</html>
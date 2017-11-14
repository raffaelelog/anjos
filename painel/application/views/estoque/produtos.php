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
						Produtos Cadastrados
						<!--   MENU DE CONTEXTO -->
						<div class="btn-group pull-right" role="group">
							<!-- Large modal -->
							<button type="button" class="btn btn-default btn-sm"
								data-toggle="modal" data-target="#cadastrar">
								<i class="fa fa-plus-square"></i> Cadastrar
							</button>
							<!-- Modal -->
							<div class="modal fade" id="cadastrar" role="dialog">
								<div class="modal-dialog">
									<!-- Modal content-->
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">Cadastrar novo produto</h4>
										</div>
										<div class="modal-body">
											<form method="post"
												action="<?php echo base_url('estoque/produtos'); ?>">
												<div class="form-group">
													<label>Descrição</label> <input type="text"
														name="descricao_produto" class="form-control"
														onkeyup="maiuscula(this)" placeholder="Nome do Produto"
														value="<?php echo set_value('descricao'); ?>">
												</div>
												<!-- -->
												<div class="form-group">
													<label>Categoria</label> <select class="form-control"
														name="cod_categoria" required="required">
														<option value="">Selecione...</option>
                          							<?php foreach ( $categorias->result () as $categoria ) { ?>
                            							<option
															value="<?php echo $categoria->cod_categoria; ?>"><?php echo $categoria->descricao; ?></option>
                          							<?php } ?> 
                        						</select>
												</div>
												<div class="form-group">
													<label>Produto Ativo</label> <label class="radio-inline"> <input
														type="radio" name="ativo_produto" value="1" checked>Sim
													</label> <label class="radio-inline"> <input type="radio"
														name="ativo_produto" value="0">Não
													</label>
												</div>
												<div class="form-group">
													<label>Obs.:</label>
													<textarea name="obs_produto" class="form-control"></textarea>
												</div>
												<!-- -->
												<div class="form-group">
													<input type="submit" class="btn btn-primary form-control"
														name="cadastrar" value="Cadastrar">
												</div>
												<div class="clear-fix"></div>
											</form>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default"
												data-dismiss="modal">Fechar</button>
										</div>
									</div
								
								</div>
							</div>
							<!--  END MODAL -->
							<a class="btn btn-default btn-sm btn btn-secondary"
								href="<?php echo base_url('painel'); ?>"> <i
								class="fa fa-dashboard"></i> Dashboard
							</a>
						</div>
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
								<i class="fa fa-filter"></i>Filtro 
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse" data-original-title=""
									title=""> </a> <a href="" class="fullscreen"
									data-original-title="" title=""></a>
							</div>
						</div>
						<div class="portlet-body">
							<form class="form-group" method="post"
								action="<?php echo base_url('estoque/produtos'); ?>">
								<div class="col-md-3 col-sm-12 form-group">
									<label>Descrição</label> <input type="text"
										class="form-control" name="descricao" placeholder="Descrição">
								</div>
								<div class="col-md-3 col-sm-12 form-group">
									<label>Categoria</label> <select class="form-control"
										name="categoria">
										<option value="">Selecione...</option>
                        			<?php foreach ( $categorias->result () as $categoria ) { ?>
                         				<option
											alue="<?php echo $categoria->cod_categoria; ?>"><?php echo $categoria->descricao; ?></option>
                        			<?php } ?>
                      			</select>
								</div>
								<div class="col-md-3 col-sm-12 form-group">
									<label>Ativo</label> <select class="form-control" name="ativo">
										<option value="1">Sim</option>
										<option value="0">Não</option>
									</select>
								</div>
								<div class="col-md-3 col-sm-12 form-group">
									<label>&nbsp;</label> <input type="submit" value="Filtrar"
										class="btn col-md-12  btn-primary">
								</div>
							</form>
							<div class="clearfix"></div>
						</div>
						<!-- Final do portlet-body -->
					</div>
					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-filter"></i><span
									class="caption-subject bold uppercase">
										Produtos</span> <span class="caption-helper">Caso a busca na
										tabela não retorne o resultado esperado, use o filtro acima</span>
							
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
									<th>Descrição</th>
									<th>Categoria</th>
									<th>Ativo</th>
									<th class="text-center">Opções</th>
								</thead>
								<tbody>
                  			<?php foreach ( $produtos->result () as $produto ) { ?>
                      			<tr>
										<td><a
											href="<?php echo base_url('estoque/produtos/produto')."/".$produto->cod_produto; ?>"> <?php echo $produto->descricao; ?> </a>
										</td>
										<td><?php echo $produto->categoria; ?></td>
										<td><?php $ativo = $produto->ativo; if($ativo='1'){echo 'Ativo';}else{echo 'Inativo';} ?></td>
										<td class="text-center"><a
											href="<?php echo base_url('estoque/produtos/produto')."/".$produto->cod_produto; ?>"
											class="btn btn-primary btn-xs"><i class="fa fa-download"></i></a>
										</td>
									</tr>
                  			<?php } ?>
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
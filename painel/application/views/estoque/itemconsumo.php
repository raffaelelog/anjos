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
					Ítens de Consumo
					<!--   MENU DE CONTEXTO -->
					<div class="btn-group pull-right" role="group">
						<!-- CADASTRAR -->
						<a class="btn btn-default btn-sm btn btn-secondary"
							data-toggle="modal" data-target="#myModal"><i
							class="fa fa-plus-circle"></i> Cadastrar</a>
						<!-- Modal -->
						<div class="modal fade" id="myModal" role="dialog">
							<div class="modal-dialog">
								<!-- Modal content-->
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title">Cadastar Novo Ítem de Consumo</h4>
									</div>
									<div class="modal-body">
										<form method="post" action="">
											<div class="form-group col-md-12">
												<label>Categoria</label> <select name="cod_cat_itemconsumo"
													class="form-control" required>
													<option value="">Selecione...</option>
                          							<?php foreach ($cat_itemconsumo->result() as $categoria): ?>
                           							 	<option
														value="<?php echo $categoria->cod_cat_itemconsumo; ?>"><?php echo $categoria->descricao; ?></option>
                          							<?php endforeach ?>
                        						</select>
											</div>
											<div class="form-group col-md-6">
												<label>Descrição</label> <input type="text" name="descricao"
													class="form-control" onkeyup="maiuscula(this)"
													placeholder="Descrição" required>
											</div>
											<div class="form-group col-md-6">
												<label>Código do Produto</label> <input type="text"
													name="codigo" class="form-control"
													onkeyup="maiuscula(this)" placeholder="codigo" required>
											</div>
											<div class="form-group col-md-6">
												<label>Valor Unitário</label> <input type="text"
													name="valor_unitario" class="form-control"
													onkeyup="moedas(this)" placeholder="Valor Unitário"
													required>
											</div>
											<div class="form-group col-md-6">
												<label>Unidade de Medida</label> <input type="text"
													name="unidade_medida" class="form-control"
													placeholder="Unidade" value="UN" required>
											</div>
											<div class="form-group col-md-6">
												<label>Quant. MIN</label> <input type="text"
													name="quant_minima" class="form-control" placeholder="Min">
											</div>
											<div class="form-group col-md-6">
												<label>Quant. Inicial</label> <input type="text"
													name="estoque_atual" class="form-control" value="0"
													placeholder="codigo" required>
											</div>
											
											<div class="form-group col-md-12">
												<input type="submit" class="btn btn-primary btn-block pull-right"
													name="cadastrar" value="Cadastrar">
											</div>
											<hr>
											<div class="form-group col-md-12">
												<input class="btn btn-default btn-block pull-right"
													name="cancelar" data-dismiss="modal" value="Cancelar">
											</div>
											<div class="clearfix"></div>
										</form>
									</div>
								</div>
							</div>
						</div>
						<!-- FIM CADASTRAR -->
						<!-- INICIO DEVOLUÇÃO -->
						<!-- Button trigger modal -->
						<button type="button"
							class="btn btn-default btn-sm btn btn-secondary"
							data-toggle="modal" data-target="#devolucao">
							<i class="fa fa-refresh"></i> Devolução
						</button>
						<!-- Modal -->
						<div class="modal fade" id="devolucao" tabindex="-1" role="dialog"
							aria-labelledby="myModalLabel">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal"
											aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
										<h4 class="modal-title" id="myModalLabel">Devolução de Ítem de
											Consumo</h4>
									</div>
									<!-- Inicio Form -->
									<form method="post" action="">
										<div class="modal-body">
											<div class="form-group col-md-4">
												<label>Código </label> <input type="text"
													name="codigo" class="form-control" required>
											</div>
											<div class="form-group col-md-4">
												<label>Quantidade</label> <input type="text"
													name="quantidade" class="form-control" required>
											</div>
											<div class="form-group col-md-4">
												<label>Usuário/Técnico</label> <select class="form-control"
													name="cod_usuario" required>
													<option value="">Selecione...</option>
                          							<?php foreach ( $listar_usuarios->result () as $usuario ) { ?>
                           								<option value="<?php echo $usuario->cod_usuario; ?>"><?php echo $usuario->nome; ?></option>
                           							<?php } ?>
                       						 	</select>
											</div>
										</div>
										<div class="clearfix"></div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default"
												data-dismiss="modal">Cancelar</button>
											<input type="submit" class="btn btn-primary" name="devolucao"
												value="Confirmar">
										</div>
									</form>
									<!-- Fim Form -->
								</div>
							</div>
						</div>
						<!-- FIM DEVOLUÇÃO -->
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
								<i class="fa fa-filter"></i>Produtos Cadastrados
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse" data-original-title=""
									title=""> </a> <a href="" class="fullscreen"
									data-original-title="" title=""></a>
							</div>
						</div>
						<div class="portlet-body">
							<table class="table table-hover datatable" id="sample_3" >
								<thead>
									<th>Cod.</th>
									<th>Desc.</th>
									<th>Min.</th>
									<th>Estoque</th>
									<th>Un.</th>
									<th>Lançar Entrada</th>
								</thead>
								<tbody>
                      			<?php foreach ($itensconsumo->result() as $item): ?>                       
                        			<tr>
										<td><?php echo $item->codigo; ?></td>
										<td><?php echo $item->descricao; ?></td>
										<td><?php echo $item->quant_minima; ?></td>
										<td>
                            		<?php if ($item->estoque_atual <= $item->quant_minima) {
                            			echo '<span class="text-danger"> <strong>' . $item->estoque_atual . "</strong></span>";
									} else {
										 echo $item->estoque_atual;
									}?>
                         		 	</td>
										<td><?php echo $item->unidade; ?></td>
										<td align="right">
											<form action="" method="post">
												<div class="col-md-12">
													<div class="col-sm-4">
														<input type="text" class="form-control tooltips"
															name="quantidade" placeholder="Quant"
															data-placement="top"
															data-original-title="Quantidade a Lançar" required>
													</div>
													<div class="col-sm-4">
														<input type="text" class="form-control tooltips moeda"
															onkeyup="moedas(this)" name="valor_unitario"
															value="<?php echo $item->valor_unitario; ?>"
															placeholder="Valor Unitário" data-placement="top"
															data-original-title="Atualiza o custo unitário" required>
														<input type="hidden" name="cod_itemconsumo"
															value="<?php echo $item->cod_itemconsumo; ?>"> <input
															type="hidden" name="estoque_atual"
															value="<?php echo $item->estoque_atual; ?>"> <input
															type="hidden" name="cod_unidade"
															value="<?php echo $item->cod_unidade; ?>">
													</div>
													<div class="col-sm-4 pull-right">
														<input type="submit" class="btn btn-primary"
															name="entrada" value="Lançar">
													</div>
												</div>
											</form>
											<div class="clearfix"></div>
										</td>
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
     <script>
            //retorna moeda formatada em real
            $('.moeda').keyup(function(){
                var v = $(this).val();
                v=v.replace(/\D/g,'');
                v=v.replace(/(\d{1,2})$/, '.$1');
                $(this).val(v);
            });
        </script>
	<!-- END FOOTER -->
</body>
</html>
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
					Produto
					<!--   MENU DE CONTEXTO -->
					<div class="btn-group pull-right" role="group">
						<!-- Trigger the modal with a button -->
						<button type="button" class="btn btn-default btn-sm"
							data-toggle="modal" data-target="#registrar_entrada">
							<i class="fa fa-download"></i> Registrar Entrada
						</button>
						<!-- Large modal -->
						<button type="button" class="btn btn-primary btn-sm"
							data-toggle="modal" data-target="#atualizar">
							<i class="fa fa-edit"></i> Editar
						</button>
						
						<a class="btn btn-default btn-sm btn btn-secondary"
							href="<?php echo base_url('painel'); ?>"> <i
							class="fa fa-dashboard"></i> Dashboard
						</a>
					</div>
				</div>
				<!-- INICIO REGISTRAR ENTRADA -->
						<div id="registrar_entrada" class="modal fade" role="dialog">
							<div class="modal-dialog">
								<!-- Modal content-->
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title">Registrar Entrada</h4>
									</div>
									<div class="modal-body">
										<form method="post" class="lancar_entrada" action="">
											<div class="col-md-6">
												<label>Data Garantia</label> 
												<input type="text"
													class="form-control datepicker" name="garantia"
													placeholder="Garantia" readonly="readonly">
											</div>
											<div class="col-md-6">
												<label>Quantidade</label> <input type="text"
													class="form-control" name="quantidade"
													placeholder="Quantidade" required>
											</div>
											<div class="col-md-6">
												<label>Preço de Custo</label> <input type="text"
													class="form-control moeda" name="preco_custo"
													placeholder="Preço de Custo" >
											</div>
											<div class="col-md-6">
												<label>Numero da Nota Fiscal</label> <input type="text"
													class="form-control" name="nota_fiscal"
													value="1000000000001" placeholder="Nº Nota Fiscal">
											</div>

											<!-- -->
											<div class="form-group  col-md-6">
												<label>Fornecedor</label> <select class="form-control"
													name="cod_fornecedor" required="required">
													<option value="">Selecione...</option>
                          							<?php foreach ( $fornecedores->result () as $fornecedor ) { ?>
                           								<option
														value="<?php echo $fornecedor->cod_fornecedor; ?>"> <?php echo $fornecedor->fornecedor_nome; ?></option>
                          							<?php } ?>
                        						</select>
											</div>
											<!-- -->
											<div class="form-group  col-md-6">
												<label>Grupo de Serviços</label> <select
													class="form-control" name="cod_gruposervico"
													required="required">
													<option value="">Selecione...</option>
                          							<?php foreach ( $grupos_servico->result () as $grupo_servico ) { ?>
                            							<option
														value="<?php echo $grupo_servico->cod_gruposervico; ?>"> <?php echo $grupo_servico->descricao; ?></option>
                          							<?php }	?>
                        						</select>
											</div>
											<br> <br> <br> <br>
											<div class="col-md-12">
												<label>Observações</label>
												<textarea class="form-control" name="obs"></textarea>
											</div>
											<div class="clearfix"></div>
											<br />
											<div class="col-md-12">
												<input type="submit" name="entrada" value="Confirmar"
													class="btn btn-primary">
											</div>
											<div class="clearfix"></div>
											<div class="col-md-12">
												<hr />
												<div id="loadergif" class="alert alert-info"
													style="display: none; font-size: 14px" align="center">
													AGUARDE! Não feche esta janela sem a confirmação de
													conclusão.</div>
											</div>
										</form>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default"
											data-dismiss="modal" value="">Cancelar</button>
									</div>
								</div>
							</div>
						</div>
						<!-- FIM REGISTRAR ENTRADA -->
						<!-- Modal -->
						<div class="modal fade" id="atualizar" role="dialog">
							<div class="modal-dialog">
								<!-- Modal content-->
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title">Atualizar produto</h4>
									</div>
									<div class="modal-body">                    
                    				<?php foreach ( $produto->result () as $item ) { $descricao_produto = $item->descricao; ?>
                      					<form method="post" action="">
											<div class="form-group">
												<label>Descrição</label> <input type="text"
													name="descricao" class="form-control"
													onkeyup="maiuscula(this)" placeholder="Nome do Produto"
													value="<?php echo $item->descricao; ?>">
											</div>
											<!-- -->
											<div class="form-group">
												<label>Categoria</label> <select class="form-control"
													name="cod_categoria" required="required">
													<option value="">Selecione...</option>
                              						<?php foreach ( $categorias->result () as $categoria ) { ?>
                                					<option
														value="<?php echo $categoria->cod_categoria; ?>"
														<?php if($item->cod_categoria==$categoria->cod_categoria){ echo 'selected="selected"'; } ?>>
                                  						<?php echo $categoria->descricao; ?>          
                                					</option>
                             						<?php } ?> 
                            					</select>
											</div>
											<div class="form-group">
												<label>Produto Ativo</label> <label class="radio-inline"> <input
													type="radio" name="ativo" value="1"
													<?php if($item->ativo==1){ echo "checked";} ?>>Sim
												</label> <label class="radio-inline"> <input type="radio"
													name="ativo" value="0"
													<?php if($item->ativo==0){ echo "checked";} ?>>Não
												</label>
											</div>
											<div class="form-group">
												<label>Obs.:</label>
												<textarea name="obs" class="form-control"><?php echo $item->obs; ?></textarea>
											</div>
											<!-- -->
											<div class="form-group text-right">
												<input type="submit" class="btn btn-primary"
													name="atualizar" value="Atualizar">
											</div>
											<div class="clear-fix"></div>
										</form>
                    					<?php } ?>
                  					</div>
								</div>
							</div>
						</div>
						<!--  END MODAL -->
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
								<i class="fa fa-filter"></i><?php echo $descricao_produto; ?>
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse" data-original-title=""
									title=""> </a> <a href="" class="fullscreen"
									data-original-title="" title=""></a>
							</div>
						</div>
						<div class="portlet-body">
							<table class="table" id="sample_3">
								<thead>
									<th>Data de Cadastro</th>
									<th>Código</th>
									<th>Garantia</th>
									<th>Nota Fiscal</th>
									<th>Unidade</th>
									<th>Status</th>
									<th>Histórico</th>
								</thead>
								<tbody>
                      			<?php foreach ( $produtos->result () as $item ) { ?> 
                      				<tr>
										<td><?php echo date('d-m-Y', strtotime($item->data_cadastro)); ?></td>
										<td><?php echo $item->cod_produtoitem; ?></td>
										<td><?php echo date('d-m-Y', strtotime($item->garantia)); ?></td>
										<td><?php echo $item->nota_fiscal; ?></td>
										<td><?php echo $item->unidade; ?></td>
										<td><?php echo $item->status; ?></td>
										<td><a
											href="<?php echo base_url('estoque/produtos/item')."/".$item->cod_produtoitem; ?>"
											class="btn btn-primary btn-xs"> <i class="fa fa-history"></i>
												Histórico
										</a></td>
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
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script>
            $(function() {
                $( ".datepicker" ).datepicker();
            });
            $( ".datepicker" ).datepicker({ 
                dateFormat: "yy-mm-dd",
                dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
                dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
                dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
                monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
                monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
                nextText: 'Próximo',
                prevText: 'Anterior'
            });
        </script>

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
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
						Produtos em Manutenção
						<!--   MENU DE CONTEXTO -->
						<div class="btn-group pull-right" role="group">
							<!-- Large modal -->
							<button type="button" class="btn btn-default btn-sm"
								data-toggle="modal" data-target="#cadastrar">
								<i class="fa fa-plus-square"></i> Cadastrar OS Manutenção
							</button>
							<!-- Modal -->
							<div class="modal fade" id="cadastrar" role="dialog">
								<div class="modal-dialog">
									<!-- Modal content-->
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">Abrir OS</h4>
										</div>
										<div class="modal-body">
											<form method="post" action="">
												<div class="form-group">
													<input type="text" class="form-control"
														name="cod_produtoitem"
														placeholder="Digite o código do produto" required>
												</div>
												<div class="form-group">
													<select name="cod_manutencaoresp" class="form-control">
					                          			<?php foreach ( $manutencao_resp->result () as $resp ) { ?>
					                            			<option value="<?php echo $resp->cod_usuario; ?>"><?php echo $resp->nome; ?></option>                        
					                         			<?php } ?>
													</select>
												</div>
												<div class="form-group">
													<input type="text" class="form-control" name="defeito"
														placeholder="Digite o Defeito" required>
												</div>
												<div class="form-group">
													<textarea class="form-control" name="obs"></textarea>
												</div>
												<div class="form-group">
													<input type="submit"
														class="btn btn-primary btn-block pull-right"
														name="manutencao" value="Confirmar">
												</div>
												<br>
											</form>
											<div class="clear-fix"></div>
										</div>
									</div>
								</div>
							</div>
							<!--  END MODAL -->
							<a class="btn btn-default btn-sm btn btn-secondary"
								href="<?php echo base_url('painel'); ?>"> <i
								class="fa fa-dashboard"></i> Dashboard
							</a>
							<a class="btn btn-default btn-sm btn btn-secondary"
								href="<?php echo base_url('estoque/manutencao/exportar'); ?>"> <i
								class="fa fa-download"></i> Exportar Relatorio Produtos
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
								<i class="fa fa-filter"></i>Ítens em Manutenção
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
									<th>Num. OS</th>
									<th>Código</th>
									<th>Produto</th>
									<th>Responsável</th>
									<th>Data Entrada</th>
									<th>Abrir</th>
								</thead>
								<tbody>
                    		<?php foreach ( $itens->result () as $item ) { ?>
                      			<tr>
										<td><?php echo str_pad($item->cod_manutencao, 4, "0", STR_PAD_LEFT); echo "( $item->descricao_status )"; ?></td>
										<td><?php echo $item->codigo; ?></td>
										<td><?php echo $item->produto; ?></td>
										<td><?php echo $item->responsavel_nome; ?></td>
										<td><?php echo date ("d-m-Y", strtotime($item->entrada)); ?></td>
										<td><a class="btn btn-primary btn-xs"
											href="<?php echo base_url('estoque/manutencao/item')."/".$item->cod_manutencao."_".$item->codigo; ?>"><i
												class="fa fa-folder-open"></i> Abrir</a></td>
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
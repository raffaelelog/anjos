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
					Instalar/Retirar - Página Cliente
					<!--   MENU DE CONTEXTO -->
					<div class="btn-group pull-right" role="group">
						<a class="btn btn-primary btn-sm btn btn-secondary"
							href="<?php echo base_url('estoque/produtos/estoque_tecnico'); ?>">
							<i class="fa fa-refresh"></i> Mudar Cliente
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
								<i class="fa fa-filter"></i><span
									class="caption-subject bold font-grey-gallery uppercase">
									Informe o <span class="text-danger">Código do Produto</span>
								</span> <span class="caption-helper">Código do produto para dar
									baixa em ítens do seu estoque</span>
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse" data-original-title=""
									title=""> </a> <a href="" class="fullscreen"
									data-original-title="" title=""></a>
							</div>
						</div>
						<div class="portlet-body">
                	<?php foreach ( $cliente->result () as $cli ) { ?>             
                		<div class="col-md-6">
								<strong>Nome do Cliente: </strong><?php echo $cli->nome_cli; ?> <br />
								<strong>Contrato: </strong><?php echo $cli->codcli; ?>
                		</div>
							<div class="col-md-6">
								<strong>Endereço Cadastro: </strong><?php echo $cli->endereco; ?><br />
								<strong>Bairro de Cadastro: </strong><?php echo $cli->bairro; ?>
                		</div>
                	<?php } ?>
                	<hr />
							<br> <br>
							<div class="col-md-12">
								<form method="post"
									action="<?php echo base_url('estoque/produtos/estoque_cliente'); ?>">
									<div class="input-group">
										<input type="text" class="form-control" name="cod_produtoitem"
											placeholder="Informe o codigo do produto..." required
											autofocus> <input type="hidden" name="cod_cliente"
											value="<?php echo $cod_cliente; ?>"> <span
											class="input-group-btn"> <input class="btn btn-success"
											type="submit" name="baixa" value="Dar Baixa">
										</span>
									</div>
									<!-- /input-group -->
								</form>
							</div>
						</div>
						<div class="clearfix"></div>
						<!-- Final do portlet-body -->
					</div>
					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-filter"></i>Ítens em meu Estoque
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse" data-original-title=""
									title=""> </a> <a href="" class="fullscreen"
									data-original-title="" title=""></a>
							</div>
						</div>
						<div class="portlet-body">
							<table class="table table-hover datatable" id="sample_3">
								<thead>
									<th>Descrição</th>
									<th>Unidade</th>
									<th>Data Instalação</th>
									<th>Retirada</th>
								</thead>
								<tbody>
                     		<?php foreach ( $estoque_cliente->result () as $item ) { ?>
                      			<tr>
										<td><?php echo $item->cod_produtoitem." - ".$item->descricao; ?></td>
										<td><?php echo $item->unidade; ?></td>
										<td><?php echo data_ptbr($item->data_cliente); ?></td>
										<td>
											<form action="" method="post">
												<input type="hidden" name="cod_produtoitem"
													value="<?php echo $item->cod_produtoitem; ?>"> <input
													type="hidden" name="cod_cliente"
													value="<?php echo $cod_cliente; ?>"> <input type="submit"
													class="btn btn-danger btn-xs" name="retirar"
													value="Retirar">
											</form>
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
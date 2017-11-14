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
					Histórico
					<!--   MENU DE CONTEXTO -->
					<div class="btn-group pull-right" role="group">
						<a class="btn btn-default btn-sm btn btn-secondary"
							href="<?php echo base_url('estoque/produtos'); ?>"> <i
							class="fa fa-table"></i> Produtos
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
								<i class="fa fa-filter"></i>Localizar outro Produto
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse" data-original-title=""
									title=""> </a> <a href="" class="fullscreen"
									data-original-title="" title=""></a>
							</div>
						</div>
						<div class="portlet-body">
							<form method="post"
								action="<?php echo base_url('estoque/produtos/item/000000') ?>">
								<div class="input-group">
									<input type="text" class="form-control" name="cod_produtoitem"
										placeholder="Código do produto..." required autofocus> <span
										class="input-group-btn"> <input class="btn btn-primary"
										type="submit" value="Buscar">
									</span>
								</div>
								<!-- /input-group -->
							</form>
						</div>
						<div class="clearfix"></div>
						<!-- Final do portlet-body -->
					</div>
					<?php foreach ( $produtos_item->result () as $produto ) {  $data_cadastro = date('d-m-Y', strtotime($produto->data_cadastro )); ?>
					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-filter"></i><?php echo $produto->descricao; ?>
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse" data-original-title=""
									title=""> </a> <a href="" class="fullscreen"
									data-original-title="" title=""></a>
							</div>
						</div>
						<div class="portlet-body">
							<div class="col-md-4">
								<strong>Data de Cadastro: </strong> <?php echo date('d-m-Y', strtotime($produto->data_cadastro)); ?></div>
							<div class="col-md-4">
								<strong>Garantia: </strong> <?php echo date('d-m-Y', strtotime($produto->garantia)); ?></div>
							<div class="col-md-4">
								<strong>Nota Fiscal: </strong> <?php echo $produto->nota_fiscal; ?></div>
							<div class="col-md-4">
								<strong>Preço de Custo: </strong> <?php echo $produto->preco_custo; ?></div>
							<div class="col-md-4">
								<strong>Fornecedor: </strong> <?php echo $produto->fornecedor; ?></div>
							<div class="col-md-4">
								<strong>Grupo de Serviço: </strong> <?php echo $produto->grupo_servico; ?></div>
							<div class="col-md-4">
								<strong>Status Atual: </strong> <?php echo $produto->descricao_status; ?></div>
							<div class="clearfix"></div>
						</div>
						<!-- Final do portlet-body -->
					</div>
					<?php } ?>
					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-filter"></i>Histórico do Produto
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse" data-original-title=""
									title=""> </a> <a href="" class="fullscreen"
									data-original-title="" title=""></a>
							</div>
						</div>
						<div class="portlet-body">
							<ul class="list-group">
								<li class="list-group-item"><span class="badge pull-left"
									style="margin-right: 10px;"><?php echo @$data_cadastro; ?></span>
									Cadastro do Produto</li>

                    		<?php foreach ( $log_produtos->result () as $log ) { ?>
                     			<li class="list-group-item"><span
									class="badge pull-left" style="margin-right: 10px;"><?php echo date('d-m-Y', strtotime($log->data_log)); ?></span> 
                          			<?php echo $log->descricao; ?> (<?php echo $log->nome; ?>)
                      			</li>
                   			<?php } ?>
                  		</ul>
                  		<?php if (@! $data_cadastro) { ?>
                    		<div class="alert alert-danger text-center">
								<h4>PRODUTO NÃO ENCONTRADO.</h4>
							</div>
                 		<?php } ?>
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
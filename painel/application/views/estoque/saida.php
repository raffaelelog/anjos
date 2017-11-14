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
      			<?php
									
				foreach ( $tecnico->result () as $tec ) {
					$nome_tecnico = $tec->nome;
					$unidade_tecnico = $tec->unidade;
					$cod_unidade = $tec->cod_unidade;
				}
				?>
        		<div class="page-title">
          		<?php echo $nome_tecnico." - ".$unidade_tecnico; ?>
         		 <!--   MENU DE CONTEXTO -->
						<div class="btn-group pull-right" role="group">
							<a class="btn btn-default btn-sm btn btn-secondary"
								href="<?php echo base_url('estoque/tecnicos'); ?>"> <i
								class="fa fa-wrench"></i> Técnicos
							</a> <a class="btn btn-default btn-sm btn btn-secondary"
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
            		<div class="col-md-8">
						<div class="portlet light">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-filter"></i><span
										class="caption-subject bold uppercase">
										Saída para o técnico <span><?php echo $nome_tecnico; ?></span>
									</span> <span class="caption-helper">Informe o código do
										produto</span>
								</div>
								<div class="tools">
									<a href="javascript:;" class="collapse" data-original-title=""
										title=""> </a> <a href="" class="fullscreen"
										data-original-title="" title=""></a>
								</div>
							</div>
							<div class="portlet-body">
								<form method="post" action="">
									<div class="input-group">
										<input type="text" class="form-control text-uppercase" name="cod_produtoitem"
											placeholder="Código do produto..." required autofocus> <input
											type="hidden" name="cod_unidade"
											value="<?php echo $cod_unidade; ?>"> <span
											class="input-group-btn"> <input class="btn btn-primary"
											type="submit" name="saida" value="Confirmar">
										</span>
									</div>
									<!-- /input-group -->
								</form>
							</div>
							<div class="clearfix"></div>
							<!-- Final do portlet-body -->
						</div>
					</div>
					<div class="col-md-4">
						<div class="portlet light">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-filter"></i>Item de Consumo
								</div>
								<div class="tools">
									<a href="javascript:;" class="collapse" data-original-title=""
										title=""> </a> <a href="" class="fullscreen"
										data-original-title="" title=""></a>
								</div>
							</div>
							<div class="portlet-body">
								<form method="post" action="">
									<div class="input-group">
										<input type="text" class="form-control text-uppercase" name="cod_itemconsumo"
											onkeyup="maiuscula(this)" placeholder="Código do produto..."
											required autofocus> <input type="hidden" name="cod_unidade"
											value="<?php echo $cod_unidade; ?>"> <span
											class="input-group-btn"> <input class="btn btn-danger"
											type="submit" name="saida_consumo" value="Confirmar">
										</span>
									</div>
									<!-- /input-group -->
								</form>
							</div>
							<div class="clearfix"></div>
							<!-- Final do portlet-body -->
						</div>
					</div>
					<div class="col-md-12">
					<?php foreach ($limite_tec->result() as $limite): ?>
					<?php if($limite->limite == 1){?>
						<div class="alert alert-danger">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						  	<strong class="uppercase"><?php echo $limite->descricao ?></strong> Limite Excedido.
						</div>
					<?php  } ?>
					<?php endforeach ?>
						
					</div>
					<div class="col-md-12">
						<div class="portlet light">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-filter"></i>Produtos com o Técnico
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
										<th>Código</th>
										<th>Produto</th>
										<th>Data da Saída</th>
									</thead>
									<tbody>
                      		<?php foreach ( $produtos_tec->result () as $produto ) { ?>                     
                      			<tr>
											
											<td><?php echo $produto->cod_produtoitem; ?></td>
											<td><?php echo $produto->descricao; ?></td>
											<td><?php echo date('d-m-Y', strtotime($produto->data_tecnico)); ?> </td>
											
										</tr>
                      		<?php } ?>
                    		</tbody>
								</table>
							</div>
							<div class="clearfix"></div>
							<!-- Final do portlet-body -->
						</div>
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
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
					GERENCIAMENTO DE CONTRATOS
					<!--   MENU DE CONTEXTO -->
					<div class="btn-group pull-right" role="group">
						<a class="btn btn-default btn-sm btn btn-secondary"
							href="<?php echo base_url('marketing/site'); ?>"> <i
							class="fa fa-desktop" style="margin-right: 5px"></i> Gerência
							do Site
						</a>
						<a class="btn btn-default btn-sm btn btn-secondary"
							href="<?php echo base_url('painel'); ?>"> <i
							class="fa fa-dashboard" style="margin-right: 5px"></i> Dashboard
						</a> 
					</div>
					<!-- FIM DO MENU DE CONTEXTO -->
				</div>
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
					<!-- END CATEGORIA -->

					<!-- BEGIN LISTA PERGUNTA -->
					<div class="portlet box blue-hoki">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-wrench"></i>Lista de contratos da página
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse" data-original-title=""
									title=""> </a> <a href="" class="fullscreen"
									data-original-title="" title=""></a>
							</div>
						</div>
						<div class="portlet-body">
							<table class="table table-striped">
								<thead>
									<th>Caminho</th>
									<th>Titulo</th>
									<th>Unidade</th>
									<th>Opções</th>
								</thead>
								<tbody>
                                	<?php foreach ( $contratos->result () as $item ) { ?>
                                    	<tr>
										<td style="vertical-align: middle;"> <?php echo $item->caminho; ?> </td>
										<td style="vertical-align: middle;"> <?php echo $item->titulo; ?> </td>
										<td style="vertical-align: middle;"> <?php echo $item->unidade; ?> </td>
										<form action="" method="post">
											<td style="vertical-align: middle;"><input type="submit"
												class="btn btn-danger btn-sm" name="excluir_contrato"
												value="Excluir"></td> <input type="hidden"
												name="cod_contrato"
												value="<?php echo $item->cod_contrato;?>"> <input
												type="hidden" name="caminhho_contrato"
												value="<?php echo $item->caminho;?>">
										</form>
									</tr>
                                	<?php } ?>
                         		</tbody>
							</table>
						</div>
					</div>
					<!-- BEGIN CONTRATO -->
					<div class="portlet box blue-hoki">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-wrench"></i>Cadastrar Novo contrato
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse" data-original-title=""
									title=""> </a> <a href="" class="fullscreen"
									data-original-title="" title=""></a>
							</div>
						</div>
						<div class="portlet-body">
							<form action="" method="post" enctype="multipart/form-data">
								<div class="form-group col-md-6">
									<label>Título</label> <input type="text" name="titulo_contrato"
										class="form-control" required="required">
								</div>
								<div class="form-group col-md-6">
									<label>Unidade</label> <select name="unidade" id="unidade"
										class="form-control" required>
										<option value=''>Selecione uma unidade</option>
												<?php foreach ( $unidades->result () as $item ) { ?>
												<option value='<?php echo $item->cod_unidade; ?>'><?php echo $item->cidade; ?></option>
												<?php } ?>
										</select> <br>
								</div>
								<div>
									<div class="form-group col-md-6">
										<input type="file" name="arquivo" accept=".pdf"
											class="form-control" required>
									</div>
									<div class="form-group col-md-6">
										<input type="submit" name="cadastrar_contrato"
											class="btn btn-primary btn-block" value="Cadastrar">
									</div>
								</div>
							</form>
							<div class="clearfix"></div>
						</div>
					</div>
					<!-- END CONTRATO -->
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
</body>
</html>

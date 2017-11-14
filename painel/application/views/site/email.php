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
					GERENCIAMENTO DE EMAIL'S
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
					<div>
						<!-- BEGIN CATEGORIA -->
						<div class="portlet box blue-hoki">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-wrench"></i> Formulário de assunto
								</div>
								<div class="tools">
									<a href="javascript:;" class="collapse" data-original-title=""
										title=""> </a> <a href="" class="fullscreen"
										data-original-title="" title=""></a>
								</div>
							</div>
							<div class="portlet-body">
								<div class="col-md-6">
									<h3>Remover assunto do email</h3>
									<table class="table table-striped">
										<thead>
											<th>Assunto</th>
											<th>Opções</th>
										</thead>
										<tbody>
                                        <?php foreach ( $assunto->result () as $item ) { ?>
                                        <tr>
												<td style="vertical-align: middle;"> <?php echo $item->descricao; ?> </td>
												<form action="" method="post">
													<td><input type="submit" class="btn btn-danger btn-sm"
														name="excluir_ass" value="Excluir"></td> <input
														type="hidden" name="cod_email"
														value="<?php echo $item->cod_email; ?>">
												</form>
											</tr>
                                        <?php } ?>
                                    </tbody>
									</table>
								</div>
								<div class="col-md-6">
									<h3>Adicionar assunto do email</h3>
									<table class="table table-striped">
										<thead>
											<th>Assunto</th>
											<th>Opções</th>
										</thead>
										<tbody>
											<tr>
												<form action="" method="post">
													<td style="vertical-align: middle;"><input type="text"
														name="name_cadastro_ass" required="required"
														class="form-control"
														placeholder="Adicione uma nova categoria"></td>
													<td style="vertical-align: middle;"><input type="submit"
														class="btn btn-primary btn-sm" name="cadastrar_ass"
														value="Cadastrar"></td>
												</form>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
					<!-- END CATEGORIA -->

					<!-- BEGIN LISTA PERGUNTA -->
					<div class="portlet box blue-hoki">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-wrench"></i>Lista de email's
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
									<th>Assunto</th>
									<th>Unidade</th>
									<th>Pessoa de destino</th>
									<th>Email</th>
									<th>Opções</th>
								</thead>
								<tbody>
                                	<?php foreach ( $emails->result () as $item ) { ?>
                                    	<tr>
										<td style="vertical-align: middle;"> <?php echo $item->assunto; ?> </td>
										<td style="vertical-align: middle;"> <?php echo $item->unidade; ?> </td>
										<td style="vertical-align: middle;"> <?php echo $item->remetente; ?> </td>
										<td style="vertical-align: middle;"> <?php echo $item->email; ?> </td>
										<form action="" method="post">
											<td style="vertical-align: middle;"><input type="submit"
												class="btn btn-danger btn-sm" name="excluir_email"
												value="Excluir"></td> <input type="hidden" name="cod_email"
												value="<?php echo $item->cod_lista; ?>">
										</form>
									</tr>
                                	<?php } ?>
                         		</tbody>
							</table>
						</div>
					</div>
					<!-- END LISTA PERGUNTA -->


					<!-- BEGIN PERGUNTA -->
					<div class="portlet box blue-hoki">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-wrench"></i>Cadastrar Novo email
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
									<label>Nome</label> <input type="text" name="nome_email"
										class="form-control" required="required">
								</div>
								<div class="form-group col-md-6">
									<label>Email</label> <input type="text" name="email"
										class="form-control" required="required">
								</div>

								<div class="form-group col-md-6">
									<label>Assunto</label> <select name="assunto_email"
										id="assunto_email" class="form-control" required>
										<option value=''></option>
												<?php foreach ( $assunto->result () as $item ) { ?>
												<option value='<?php echo $item->cod_email; ?>'><?php echo $item->descricao; ?></option>
												<?php } ?>
										</select>
								</div>

								<div class="form-group col-md-6">
									<label>Unidade</label> <select name="unidade" id="unidade"
										class="form-control" required>
										<option value=''>Selecione uma unidade</option>
												<?php foreach ( $unidades->result () as $item ) { ?>
												<option value='<?php echo $item->cod_unidade; ?>'><?php echo $item->cidade; ?></option>
												<?php } ?>
										</select>
								</div>


								<div class="form-group">
									<input type="submit" name="cadastrar_faq"
										class="btn btn-primary btn-block" value="Cadastrar">
								</div>
							</form>

						</div>
					</div>

					<!-- END PERGUNTA -->




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

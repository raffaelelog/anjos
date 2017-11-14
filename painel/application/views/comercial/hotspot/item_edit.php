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
					Editar Cadastro HotSpot City10
					<!--   MENU DE CONTEXTO -->
					<div class="btn-group pull-right" role="group">
						<a class="btn btn-default btn-sm btn btn-secondary"
							href="<?php echo base_url('comercial/prospecto'); ?>"> <i
							class="fa fa-dashboard"></i> Prospecção
						</a> <a class="btn btn-default btn-sm btn btn-secondary"
							href="<?php echo base_url('painel'); ?>"> <i
							class="fa fa-dashboard"></i> Dashboard
						</a>
					</div>
				</div>
				<!-- END PAGE HEADER-->
				<div class="row">
				<?php foreach ( $cadastro->result () as $itemCad ) {	?>
					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-filter"></i>Informações do cadastro
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse" data-original-title=""
									title=""> </a> <a href="" class="fullscreen"
									data-original-title="" title=""></a>
							</div>
						</div>
						<div class="portlet-body">
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
						<div class="col-md-12">
								<form method="post"
									action="<?php echo base_url('comercial/prospecto/editar_cadastro/').$itemCad->id_prosp;?>"
									data-toggle="validator" accept-charset="utf-8">
									<div class="col-md-12">
										<label style="font-size: 20px"> Informações Principais: </label>
									</div>
									<div class="col-md-4">
										<label> Nome </label> <input readonly class="form-control"
											name="nome" value="<?php echo $itemCad ->nome; ?>"
											required="required"><br>
									</div>
									<div class="col-md-4">
										<label> CPF </label> <input readonly class="form-control"
											name="cpf" value="<?php echo $itemCad ->cpf; ?>"
											required="required"><br>
									</div>
									<div class="col-md-4">
										<label> Data de Nascimento </label> <input readonly
											class="form-control"
											value="<?php echo date('d-m-Y', strtotime($itemCad->dat_nascimento)); ?>"
											name="datNasc" maxlength="255" 
											required="required"> <br>
									</div>
									<div class="col-md-4">
										<label> Email/Login </label> <input type="text"
											class="form-control" value="<?php echo $itemCad->email; ?>"
											name="email" maxlength="255" onkeyup="mascara(this,email)"
											required="required"> <br>
									</div>
									<div class="col-md-4">
										<label> Celular </label> <input type="text"
											class="form-control"
											value="<?php echo '('.substr($itemCad-> celular,0, 2).') '.substr($itemCad-> celular, 2,5).'-'.substr($itemCad-> celular, -4); ?>"
											name="celular" maxlength="15"
											onkeyup="mascara(this,telefone)" required="required"> <br>
									</div>
									<div class="col-md-4">
										<label> Cidade </label> <select name="cidade" id="cidadeId"
											class="form-control" required>
											<?php foreach ($cidades->result() as $cid) { ?>
												<option value="<?php echo $cid->cidade;?>"
												<?php if($cid->cidade == $itemCad->cidade){ echo "selected";}?>><?php echo $cid->cidade.' - '.$cid->estado; ?></option>
											<?php } ?>
										</select> <br>
									</div>
									<div class="col-md-12">
										<button type="submit" class="btn btn-primary btn-block"
											name="editar" value="Confirmar">Editar</button>
										<br> <br>
									</div>
								</form>
							</div><div class="clearfix"></div>
						</div>
						<!-- Final do portlet-body -->
					</div>
					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-wrench"></i>Envio da senha
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse" data-original-title=""
									title=""> </a> <a href="" class="fullscreen"
									data-original-title="" title=""></a>
							</div>
						</div>
						<div class="portlet-body">
							<div class="col-md-12">
								<form method="post"
									action="<?php echo base_url('comercial/prospecto/enviar_senha/').$itemCad->id_prosp;?>"
									data-toggle="validator" accept-charset="utf-8">
									<div class="col-md-12">
										<label style="font-size: 20px"> Recuperação de Senha: </label>
										<br>
									</div>
									<div class="col-md-12">
										<label> Dados de recuperação: </label>
									</div>
									<div class="col-md-4">
										<input type="text" class="form-control" readonly
											value="<?php echo '('.substr($itemCad-> celular,0, 2).') '.substr($itemCad-> celular, 2,5).'-'.substr($itemCad-> celular, -4); ?>"
											name="celularSenha" maxlength="15" required="required"> <br>
									</div>
									<div class="col-md-4">
										<input type="text" class="form-control" readonly
											value="<?php echo $itemCad->email; ?>" name="emailSenha"
											maxlength="255" required="required"><input type="hidden"
											name="nomeSenha" value="<?php echo $itemCad ->nome; ?>">
									</div>
									<div class="col-md-4">
										<button type="submit" class="btn btn-primary btn-block"
											name="mudar" value="Confirmar">Enviar para o email</button>
									</div>
								</form>
							</div><div class="clearfix"></div>
						</div>
					</div>
					<?php } ?>
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
    <!-- END FOOTER -->
    <script
	src="<?php echo base_url(); ?>assets/global/plugins/mascaras.js" type="text/javascript"></script>
</body>
</html>
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
					Usuários
					<!--   MENU DE CONTEXTO -->
					<div class="btn-group pull-right" role="group">
						<a class="btn btn-default btn-sm btn btn-secondary"
							href="<?php echo base_url('usuarios'); ?>"> <i class="fa fa-user"></i>
							Usuários
						</a> <a class="btn btn-default btn-sm btn btn-secondary"
							href="<?php echo base_url('painel'); ?>"> <i
							class="fa fa-dashboard"></i> Dashboard
						</a>
					</div>
				</div>
				<!-- END PAGE HEADER-->
				<div class="row">
					<div class="col-md-12 ">
						<!-- BEGIN Portlet PORTLET-->
						<div class="portlet light">
							<div class="portlet-title">
								<div class="caption">
									<i class="icon-screen-tablet font-grey-gallery"></i> <span
										class="caption-subject bold font-grey-gallery uppercase">
										Dados do Cadastro </span> <span class="caption-helper"></span>
								</div>
								<div class="tools">
									<a href="" class="collapse" data-original-title="" title=""> </a>
									<a href="" class="fullscreen" data-original-title="" title="">
									</a> <a href="" class="remove" data-original-title="" title="">
									</a>
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
                              <?php } foreach ( $usuario_editar->result () as $usuario_e ) { $cod_usuario = $usuario_e->cod_usuario; ?>
                              <!-- INICIO ALTERAR DADOS DE ACESSO-->
								<div class="col-md-6">
									<div class="panel panel-default">
										<div class="panel-heading">Alterar dados de Acesso</div>
										<div class="panel-body"><br>
											<form class="form-group" name="formulario" action="<?php echo base_url('usuarios/usuario_atualizar/').$cod_usuario; ?>" method="post" enctype="multipart/form-data">
												<div class="form-group col-md-6">
													<label for="nome">Nome</label> 
													<input type="text" class="form-control" name="nome" id="nome" required="required" maxlength="45" onkeyup="mascara(this, mascaranome)" value="<?php echo $usuario_e->nome; ?>">
												</div>
												<div class="form-group col-md-6">
													<label for="nome">CPF</label> 
													<input type="text" class="form-control" maxlength="14" onkeyup="mascara(this, mascaracpf)" onkeypress="mascara(this, mascaracpf)" name="cpf" id="cpf" required="required" value="<?php if( $usuario_e->cpf != ''){$cpf = $usuario_e->cpf; echo substr($cpf,0,3).'.'.substr($cpf,3,3).'.'.substr($cpf,6,3).'-'.substr($cpf,9,2);} ?>">
												</div>
												<div class="form-group col-md-6">
													<label for="endereco">Endereço</label> 
													<input type="text" class="form-control" name="endereco" id="endereco" maxlength="255" required="required" value="<?php echo $usuario_e->endereco; ?>">
												</div>
												<div class="form-group col-md-6">
													<label for="email">E-mail</label> 
													<input type="text" class="form-control" name="email" id="email" required="required" value="<?php echo $usuario_e->email; ?>">
												</div>
												<div class="form-group col-md-6">
													<label for="telefone_1">Telefone 1</label> 
													<input type="text" class="form-control" name="telefone_1"  id="telefone_1" minlength="13" maxlength="14" onkeypress="mascaraTelefone(formulario.telefone_1)" onkeyup="mascaraTelefone(formulario.telefone_1)" value="<?php if($usuario_e->telefone_1 != ''){ $tel1 = $usuario_e->telefone_1;  if(strlen($tel1) == 11) { echo '('.substr($tel1,0,2).')'.substr($tel1,2,5).'-'.substr($tel1,7,4); }else{ echo '('.substr($tel1,0,2).')'.substr($tel1,2,4).'-'.substr($tel1,6,4); } } ?>" required="required">
												</div>
												<div class="form-group col-md-6">
													<label for="telefone_2">telefone 2</label> 
													<input type="text" class="form-control" name="telefone_2" id="telefone_2" minlength="13" maxlength="14"  onkeypress="mascaraTelefone(formulario.telefone_2)" onkeyup="mascaraTelefone(formulario.telefone_2)" value="<?php if($usuario_e->telefone_2 != ''){ $tel2 = $usuario_e->telefone_2; if(strlen($tel2) == 11) { echo '('.substr($tel2,0,2).')'.substr($tel2,2,5).'-'.substr($tel2,7,4); }else{ echo '('.substr($tel2,0,2).')'.substr($tel2,2,4).'-'.substr($tel2,6,4);} } ?>">
												</div>
												<div class="form-group col-md-6">
													<label for="email">Cargo</label> <select name="cargo"
														class="form-control" required="required">
														<option value="">Selecione...</option>
                                                		<?php foreach ( $cargo->result () as $item ) { ?>
                                                  			<option value="<?php echo $item->cod_cargo; ?>"
															<?php if ($item->cod_cargo== $usuario_e->cod_cargo) { echo "selected"; } ?>> <?php echo $item->desc_cargo; ?> </option>
                                                		<?php } ?>
                                              		</select>
												</div>
												<div class="form-group col-md-6">
													<label for="nivel">Nível</label> 
													<select name="nivel" class="form-control" required="required">
														<option value="">Selecione...</option>
														<option value="1" <?php if (1 == $usuario_e->nivel) { echo "selected"; } ?>>Padrão</option>
														<option value="5" <?php if (5 == $usuario_e->nivel) { echo "selected"; } ?>>Admin. Sistema</option>					
													</select>
												</div>
												<!-- RECEBE SETORES -->
												<div class="form-group col-md-6">
													<label for="email">Setor</label> <select name="cod_setor"
														class="form-control" required="required">
														<option value="">Selecione...</option>
                                                		<?php foreach ( $setores->result () as $setor ) { ?>
                                                  			<option value="<?php echo $setor->cod_setor; ?>" <?php if ($setor->cod_setor == $usuario_e->cod_setor) { echo "selected"; } ?>> <?php echo $setor->descri_setor; ?> </option>
                                                		<?php } ?>
                                              		</select>
												</div>
												<!-- RECEBE UNIDADES -->
												<div class="form-group col-md-6">
													<label for="email">Unidade</label> <select
														name="cod_unidade" class="form-control"
														required="required">
                                                 	<?php foreach ( $unidades->result () as $unidade ) { ?>
                                                  		<option
															value="<?php echo $unidade->cod_unidade; ?>"
															<?php if ($unidade->cod_unidade == $usuario_e->cod_unidade) { echo "selected"; } ?>> <?php echo $unidade->descri_unidade; ?> </option>
                                                	<?php } ?>
                                              		</select>
												</div>
												<!-- USUÁRIO ATIVO/INATIVO -->
												<div class="form-group">
													<input type="submit" class="btn btn-primary pull-right" value="Salvar Alterações">
												</div>
											</form>
										</div>
									</div>
								</div>
                              <?php } ?>
                              <!-- FIM ALTERAR DADOS DE ACESSO-->
								<!-- INICIO ALTERAR SENHA-->
								<div class="col-md-6">
									<div class="panel panel-default">
										<div class="panel-heading">Alterar Senha</div>
										<div class="panel-body"><br>
											<form class="form-group"
												action="<?php echo base_url('usuarios/trocar_senha_usuario')."/".$cod_usuario; ?>"
												method="post">
												<div class="form-group">
													<label for="senha">Senha</label> <input type="password"
														class="form-control" name="senha" id="senha"
														required="required">
												</div>
												<div class="form-group">
													<label for="confsenha">Confirma Senhar</label> <input
														type="password" class="form-control" name="confsenha"
														id="confsenha" required="required">
												</div>
												<div class="form-group">
													<label for=""></label> <input type="submit"
														class="btn btn-primary pull-right" value="Atualizar Senha">
												</div>
											</form>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="panel panel-default">
										<div class="panel-heading">Alterar Foto</div>
										<div class="panel-body"><br><br>
											<form class="form-group" action="<?php echo base_url('usuarios/trocar_foto')."/".$cod_usuario; ?>" method="post" enctype="multipart/form-data">
												<div class="form-group col-md-12">
													<label for="foto">Foto:</label> 
													<input type="file" name="foto" class="form-control" required>
												</div>
												<div class="form-group">
													<label for=""></label> 
													<input type="submit" class="btn btn-primary pull-right" value="Atualizar Foto">
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
							<!-- FIM ALTERAR SENHA-->
							<div class="clearfix"></div>
						</div>
					</div>
					<!-- END GRID PORTLET-->
				</div>
			</div>
			<!-- END ROW -->
		</div>
		<!-- END CONTENT BODY -->
	</div>
	<!-- END CONTENT -->
	<!-- BEGIN QUICK SIDEBAR -->
    <?php $this->load->view('layout/quick_sidebar'); ?>
    <!-- END QUICK SIDEBAR -->
	<!-- END CONTAINER -->
	<!-- BEGIN FOOTER -->
    <?php $this->load->view('layout/footer'); ?>
    <script src="<?php echo base_url()."assets/global/apps/scripts/mascaras.js"; ?>" type="text/javascript"></script>
<!-- END FOOTER -->
</body>
</html>
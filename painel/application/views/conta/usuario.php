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
							href="<?php echo base_url('usuarios'); ?>"> <i
							class="fa fa-user"></i> Usuários
						</a>
						<a class="btn btn-default btn-sm btn btn-secondary"
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
										<div class="panel-body">
											<form class="form-group"
												action="<?php echo base_url('usuarios/usuario_atualizar\\').$cod_usuario; ?>"
												method="post">
												<div class="form-group">
													<label for="nome">Nome</label> <input type="text"
														class="form-control" name="nome" id="nome"
														required="required"
														value="<?php echo $usuario_e->nome; ?>">
												</div>
												<div class="form-group">
													<label for="email">E-mail</label> <input type="text"
														class="form-control" name="email" id="email"
														required="required"
														value="<?php echo $usuario_e->email; ?>">
												</div>
												<div class="form-group col-md-6">
													<label for="email">Nível</label> <select name="nivel"
														class="form-control" required="required">
														<option value="1">Padrão</option>
														<option value="5">Admin. Sistema</option>
													</select>
												</div>
												<!-- RECEBE SETORES -->
												<div class="form-group col-md-6">
													<label for="email">Setor</label> 
													<select name="cod_setor"
														class="form-control" required="required">
														<option value="">Selecione...</option>
                                                		<?php foreach ( $setores->result () as $setor ) { ?>
                                                  			<option value="<?php echo $setor->cod_setor; ?>" <?php if ($setor->cod_setor == $usuario_e->cod_setor) { echo "selected"; } ?>> <?php echo $setor->descri_setor; ?> </option>
                                                		<?php } ?>
                                              		</select>
												</div>
												<!-- RECEBE UNIDADES -->
												<div class="form-group">
													<label for="email">Unidade</label> 
													<select name="cod_unidade" class="form-control" required="required">
                                                 	<?php foreach ( $unidades->result () as $unidade ) { ?>
                                                  		<option value="<?php echo $unidade->cod_unidade; ?>" <?php if ($unidade->cod_unidade == $usuario_e->cod_unidade) { echo "selected"; } ?>> <?php echo $unidade->descri_unidade; ?> </option>
                                                	<?php } ?>
                                              		</select>
												</div>
												<!-- USUÁRIO ATIVO/INATIVO -->
												<div class="form-group">
													<label for="senha">Usuário Ativo: </label> <label> <input
														type="radio" name="ativo" value="1" checked="checked">Sim
													</label> <label><input type="radio" name="ativo" value="0">Não</label>
												</div>
												<div class="form-group">
													<input type="submit" class="btn btn-primary pull-right"
														value="Salvar Alterações">
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
										<div class="panel-body">
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
<!-- END FOOTER -->
</body>
</html>
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
				<h1 class="page-title">
					Perfil <small></small>
				</h1>
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
                    <?php  }  ?>
                   <div class="portlet light box">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-wrench"></i>Dados Cadastrais
							</div>
						</div>
						<div class="portlet-body">                                                              
                        <?php foreach ($users->result() as $user) { ?>
                        	<div class="col-md-12">
                        		<form name="formulario" action="<?php echo base_url(''); ?>" enctype="multipart/form-data" method="post" enctype="multipart/form-data">
	                          		<div class="col-md-12">
	                          			<center>
	                          				<img src ="<?php if($user->fotos != null){echo base_url().'source/fotos_user/'.$user->fotos; }else{echo base_url().'source/fotos_user/user.png';}  ?>" style="max-height: 20%;max-width: 20%; padding-bottom: 5% " >
	                          				<br>
	                          			</center>
	                          		</div>
									<div class="form-group col-md-6">
										<label for="nome">Nome</label> <input readonly type="text"
											class="form-control" name="nome" id="nome" required="required"
											value="<?php echo $user->nome; ?>" onkeyup="maiuscula(this)">
									</div>
									<div class="form-group col-md-6">
										<label for="nome">CPF</label> <input readonly type="text"
											class="form-control" name="cpf" id="cpf"
											value="<?php if( $user->cpf != ''){$cpf = $user->cpf; echo substr($cpf,0,3).'.'.substr($cpf,3,3).'.'.substr($cpf,6,3).'-'.substr($cpf,9,2);} ?>">
									</div>
									<div class="form-group col-md-6">
										<label for="nome">E-mail</label> <input readonly type="text"
											class="form-control" name="email" id="email"
											required="required" value="<?php echo $user->email; ?>"
											onkeyup="minuscula(this)">
									</div>
									<div class="form-group col-md-6">
										<label for="nome">Setor</label> <input readonly type="text"
											class="form-control" name="setor" id="setor"
											value="<?php echo $user->setor; ?>"
											onkeyup="minuscula(this)">
									</div>
									<div class="form-group col-md-12">
										<label for="endereco">Endereço</label> 
										<input type="text" class="form-control" name="endereco" id="endereco" maxlength="255" required="required" value="<?php echo $user->endereco; ?>">
									</div>
									<div class="form-group col-md-6">
										<label for="nome">Telefone 1</label> 
										<input type="text" class="form-control" name="telefone_1" id="telefone_1" required="required" value="<?php if($user->telefone_1 != ''){ $tel1 = $user->telefone_1;  if(strlen($tel1) == 11) { echo '('.substr($tel1,0,2).')'.substr($tel1,2,5).'-'.substr($tel1,7,4); }else{ echo '('.substr($tel1,0,2).')'.substr($tel1,2,4).'-'.substr($tel1,6,4); } } ?>" onkeypress="mascaraTelefone(formulario.telefone_1)" onkeyup="mascaraTelefone(formulario.telefone_1)" >
									</div>
									<div class="form-group col-md-6">
										<label for="nome">Telefone 2</label> 
										<input type="text" class="form-control" name="telefone_2" id="telefone_2" required="required" value="<?php if($user->telefone_2 != ''){ $tel2 = $user->telefone_2; if(strlen($tel2) == 11) { echo '('.substr($tel2,0,2).')'.substr($tel2,2,5).'-'.substr($tel2,7,4); }else{ echo '('.substr($tel2,0,2).')'.substr($tel2,2,4).'-'.substr($tel2,6,4);} } ?>" onkeypress="mascaraTelefone(formulario.telefone_2)" onkeyup="mascaraTelefone(formulario.telefone_2)" >
									</div>
								</form>
							</div>
                          <?php } ?>
                          <div class="col-md-12">
								<H3>Alterar senha</H3>
								<form class="form-group"
									action="<?php echo base_url('perfil/trocar_senha'); ?>"
									method="post">
									<div class="form-group col-md-6">
										<label for="senha">Senha</label> <input type="password"
											class="form-control" name="senha" id="senha"
											required="required">
									</div>
									<div class="form-group col-md-6">
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
							<div class="clearfix"></div>
						</div>
					</div>
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
	</div>
	<!-- END CONTAINER -->
	<!-- BEGIN FOOTER -->       
    <?php $this->load->view('layout/footer'); ?>
    <script src="<?php echo base_url()."assets/global/apps/scripts/mascaras.js"; ?>" type="text/javascript"></script>
    <!-- END FOOTER -->
</body>
</html>
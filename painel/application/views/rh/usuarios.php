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
					<div class="btn-group pull-right" role="group">
						<a class="btn btn-default btn-sm btn btn-secondary"
							href="<?php echo base_url('painel'); ?>"> <i
							class="fa fa-dashboard"></i> Dashboard
						</a>
						<button class="btn btn-default btn-sm btn btn-secondary"
							data-toggle="modal" data-target="#novoUsuario">
							<i class="fa fa-user-plus"></i> Novo Usuário
						</button>
					</div>
				</div>
				<!-- END PAGE HEADER-->
				<!-- Modal -->
				<div class="modal fade" id="novoUsuario" tabindex="-1" role="dialog"
					aria-labelledby="myModalLabel">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal"
									aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								<h4 class="modal-title" id="myModalLabel">Cadastrar Novo Usuário</h4>
							</div>
							<form class="form-group" name="formulario" action="<?php echo base_url('usuarios/novo_usuario'); ?>" method="post" enctype="multipart/form-data" >
								<div class="modal-body">
									<div class="form-group col-md-6">
										<label for="nome">Nome</label> 
										<input type="text" class="form-control" maxlength="45" onkeyup="mascara(this, mascaranome)" name="nome" id="nome" required="required" value="<?php echo set_value('nome'); ?>" autocomplete="off">
									</div>
									<div class="form-group col-md-6">
										<label for="cpf">Cpf</label> 
										<input type="text" class="form-control" maxlength="14" onkeyup="mascara(this, mascaracpf)" onkeypress="mascara(this, mascaracpf)" name="cpf" id="cpf" required="required" value="<?php echo set_value('cpf'); ?>"  autocomplete="off">
									</div>
									<div class="form-group col-md-12">
										<label for="email">Endereço</label> 
										<input type="text" class="form-control"  maxlength="255" name="endereco" id="endereco" required="required" value="<?php echo set_value('endereco'); ?>" maxlength="255">
									</div>
									<div class="form-group col-md-6">
										<label for="telefone_1">Telefone 1</label> 
										<input type="text" class="form-control" name="telefone_1"  id="telefone_1" minlength="13" maxlength="14" required="required" value="<?php echo set_value('telefone_1'); ?>" onkeypress="mascaraTelefone(formulario.telefone_1)" onkeyup="mascaraTelefone(formulario.telefone_1)">
									</div>
									<div class="form-group col-md-6">
										<label for="telefone_2">Telefone 2</label> 
										<input type="text" class="form-control" name="telefone_2" id="telefone_2" minlength="13" maxlength="14" value="<?php echo set_value('telefone_2'); ?>" onkeypress="mascaraTelefone(formulario.telefone_2)" onkeyup="mascaraTelefone(formulario.telefone_2)">
									</div>
									<div class="form-group col-md-6">
										<label for="email">E-mail</label> 
										<input type="text"  class="form-control" maxlength="255" name="email" id="email" required="required" value="<?php echo set_value('email'); ?>">
									</div>
									<div class="form-group col-md-6">
										<label for="cargo">Cargo</label> 
										<select name="cargo" class="form-control" required="required">
											<option value="">Selecione...</option>
											<?php if($cargo){ foreach ( $cargo->result () as $item ) { echo '<option value="' . $item->cod_cargo. '">' . $item->desc_cargo. '</option>'; } } ?>
										</select>
									</div>	
									<div class="form-group col-md-6">
										<label for="nivel">Nível</label> 
										<select name="nivel" class="form-control" required="required">
											<option value="">Selecione...</option>
											<option value="1">Padrão</option>
											<?php if($this->session->userdata('nivel')==5){ echo '<option value="5">Admin. Sistema</option>'; } ?> 
										</select>
									</div>
									<!-- RECEBE SETORES -->
									<div class="form-group col-md-6">
										<label for="cod_setor">Setor</label> 
										<select name="cod_setor" class="form-control" required="required">
											<option value="">Selecione...</option>
                          					<?php if($setores){ foreach ( $setores->result () as $setor ) { echo '<option value="' . $setor->cod_setor . '">' . $setor->descri_setor . '</option>'; } } ?>
                          				</select>
									</div>
									<div class="form-group col-md-12">
										<label for="foto">Foto:</label> 
										<input type="file" name="foto" class="form-control" required>
									</div>
									<!-- RECEBE UNIDADES -->
									<div class="form-group col-md-12">
										<label for="cod_unidade">Unidade</label> 
										<select name="cod_unidade" class="form-control" required="required">
											<option value="">Selecione...</option>
                          					<?php if($unidades){ foreach ( $unidades->result () as $unidade ) { echo '<option value="' . $unidade->cod_unidade . '">' . $unidade->descri_unidade . '</option>'; } } ?>
                          				</select>
									</div>
									<!-- USUÁRIO ATIVO/INATIVO -->
									<div class="form-group col-md-6">
										<label for="ativo">Usuário Ativo: </label> 
										<label>
											<input type="radio" name="ativo" value="1" checked="checked">Sim
										</label>
										<label>
											<input type="radio" name="ativo" value="0">Não
										</label>
									</div>
									<!-- USUÁRIO TECNICO -->
									<div class="form-group col-md-6">
										<label for="tecnico">Técnico Externo: </label>
										<label>
											<input type="radio" name="tecnico" value="1">Sim
										</label>
										<label>
											<input type="radio" name="tecnico" value="0" checked="checked">Não
										</label>
									</div>
									<div class="clearfix"></div>
									<hr>
									<div class="form-group col-md-6">
										<label for="senha">Senha</label> 
										<input type="password" class="form-control" name="senha" id="senha" required="required">
									</div>
									<div class="form-group col-md-6">
										<label for="confsenha">Confirme a Senha</label> 
										<input type="password" class="form-control" name="confsenha" id="confsenha" required="required">
									</div>
								</div>
								
								<div class="modal-footer col-md-6">
									<button type="button" class="btn btn-default btn-block" data-dismiss="modal">Cancelar</button>							
								</div>
								<div class="modal-footer col-md-6">
									<input type="submit" class="btn btn-primary btn-block" value="Cadastrar">
								</div>
								<div class="clearfix"></div>
							</form>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="row">
					<div class="col-md-12 ">
						<!-- BEGIN Portlet PORTLET-->
						<div class="portlet light">
							<div class="portlet-title">
								<div class="caption">
									<i class="icon-screen-tablet font-grey-gallery"></i> 
										Dados do Cadastro </span>
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
					            <table class="table table-striped table-bordered datatable" id="sample_3">
									<thead>
										<th>Nome</th>										
										<th>E-mail</th>
										<th>Setor</th>
										<th>Unidade</th>
										<th>Status</th>
										<th class="text-center">Opções</th>
									</thead>
									<tbody>
					              	<?php if ($usuarios) { foreach ( $usuarios->result () as $usuario ) { ?> 
					                	<tr>
											<td><?php echo $usuario->nome; ?></td>											
											<td><?php echo $usuario->email; ?></td>
											<td><?php echo $usuario->setor; ?></td>
											<td><?php echo $usuario->unidade; ?></td>
											<td><?php $ativo = $usuario->ativo;
																					switch ($ativo) {
																						case '1' :
																							echo "Ativo";
																							break;
																						
																						case '0' :
																							echo "Inativo";
																							break;
																						
																						default :
																							// code...
																							break;
																					}
																					?></td>
											<td class="text-center">
					                    		<?php $cod_usuario = $usuario->cod_usuario; ?>
					                    		<a href="<?php echo base_url('usuarios/status')."/".$cod_usuario ?>" title="Ativa/Desativar Cadastro"><i class="fa fa-check-circle-o"></i></a> 
					                    		<a href="<?php echo base_url('usuarios/editar_usuario')."/".$cod_usuario ?>"  title="Editar Cadastro"><i class="fa fa-edit"> </i></a> 
					                    		<?php if($this->session->userdata('nivel') == 5 ){ echo '<a href="'.base_url('usuarios/permissoes').'/'.$cod_usuario.'" title="Modificar Permissões"><i class="fa fa-lock"> </i></a>'; }?>					              
											</td>
										</tr>
					                <?php } } ?>
					              </tbody>
								</table>
							</div>
						</div>
						<!-- END GRID PORTLET-->
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
	<!-- END CONTAINER -->
	<!-- BEGIN FOOTER -->
    <?php $this->load->view('layout/footer'); ?>
	<script src="<?php echo base_url()."assets/global/apps/scripts/mascaras.js"; ?>" type="text/javascript"></script>
<!-- END FOOTER -->
</body>
</html>
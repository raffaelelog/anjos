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
					GERENCIAMENTO DO FAQ
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
						<div class="portlet box blue-hoki col-md-6">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-wrench"></i>Remover categoria
								</div>
								<div class="tools">
									<a href="javascript:;" class="collapse" data-original-title=""
										title=""> </a> <a href="" class="fullscreen"
										data-original-title="" title=""></a>
								</div>
							</div>
							<div class="portlet-body"
								style="max-height: 300px; min-height: 300px">
								<table class="table table-striped">
									<thead>
										<th>Categoria</th>
										<th>Opções</th>
									</thead>
									<tbody>
                                        <?php foreach ( $faq->result () as $item ) { ?>
                                        <tr>
											<td style="vertical-align: middle;"> <?php echo $item->descricao; ?> </td>
											<form action="" method="post">
												<td><input type="submit" class="btn btn-danger btn-sm"
													name="excluir_cat" value="Excluir"></td> <input
													type="hidden" name="cod_cat_faq"
													value="<?php echo $item->cod_cat_faq; ?>">
											</form>
										</tr>
                                        <?php } ?>
                                    </tbody>
								</table>
							</div>
						</div>
						<div class="portlet box blue-hoki col-md-6">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-wrench"></i>Adicionar categoria
								</div>
								<div class="tools">
									<a href="javascript:;" class="collapse" data-original-title=""
										title=""> </a> <a href="" class="fullscreen"
										data-original-title="" title=""></a>
								</div>
							</div>
							<div class="portlet-body" style="min-height: 300px">
								<table class="table table-striped">
									<thead>
										<th>Categoria</th>
										<th>Opções</th>
									</thead>
									<tbody>
										<tr>
											<form action="" method="post">
												<td style="vertical-align: middle;"><input type="text"
													name="name_cadastro_cat" required="required"
													class="form-control"
													placeholder="Adicione uma nova categoria"></td>
												<td style="vertical-align: middle;"><input type="submit"
													class="btn btn-primary btn-sm" name="cadastrar_cat"
													value="Cadastrar"></td>
											</form>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<!-- END CATEGORIA -->

					<!-- BEGIN LISTA PERGUNTA -->
					<div class="portlet box blue-hoki col-md-12">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-wrench"></i>Lista FAQ
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
									<th>Categoria</th>
									<th>Pergunta</th>
									<th>Resposta</th>
									<th>Opções</th>
								</thead>
								<tbody>
                                	<?php foreach ( $perguntas->result () as $item ) { ?>
                                    	<tr>
										<td style="vertical-align: middle;"> <?php echo $item->descricao; ?> </td>
										<td style="vertical-align: middle;"> <?php echo $item->pergunta; ?> </td>
										<td style="vertical-align: middle;"> <?php echo $item->resposta; ?> </td>
										<form action="" method="post">
											<td style="vertical-align: middle;"><input type="submit"
												class="btn btn-danger btn-sm" name="excluir_pergunta"
												value="Excluir"></td> <input type="hidden" name="cod_faq"
												value="<?php echo $item->cod_faq; ?>">
										</form>
									</tr>
                                	<?php } ?>
                         		</tbody>
							</table>
						</div>
					</div>
					<!-- END LISTA PERGUNTA -->


					<!-- BEGIN PERGUNTA -->
					<div class="portlet box blue-hoki col-md-12">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-wrench"></i>Cadastrar Novo FAQ
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
									<label>Pergunta</label> <input type="text" name="pergunta_faq"
										class="form-control" required="required">
								</div>
								<div class="form-group col-md-6">
									<label>Categoria</label> <select name="categoria_faq"
										id="categoria_faq" class="form-control" required>
										<option value=''></option>
												<?php foreach ( $faq->result () as $item ) { ?>
												<option value='<?php echo $item->cod_cat_faq; ?>'><?php echo $item->descricao; ?></option>
												<?php } ?>
										</select>
								</div>
								<div class="form-group col-md-12">
									<label>Resposta</label>
									<!-- Make sure the path to CKEditor is correct. -->
									<script src="<?php echo base_url('ckeditor/ckeditor.js'); ?>"></script>
									<textarea name="resposta_faq" id="resposta_faq" rows="5"
										cols="80" required="required"> Conteúdo da explicação. </textarea>
									<script>
                                                            // Replace the <textarea id="editor1"> with a CKEditor
                                                            // instance, using default configuration.
                                                            CKEDITOR.replace( 'resposta_faq', {
                                                                language: 'pt',
                                                                filebrowserBrowseUrl : '<?php echo base_url();?>filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
                                                                filebrowserUploadUrl : '<?php echo base_url();?>filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
                                                                filebrowserImageBrowseUrl : '<?php echo base_url();?>filemanager/dialog.php?type=1&editor=ckeditor&fldr='
                                                            });
                                   </script>
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

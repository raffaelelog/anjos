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
					GERENCIAMENTO DE SERVICOS
					<!--   MENU DE CONTEXTO -->
					<div class="btn-group pull-right" role="group"> 
						<a class="btn btn-default btn-sm btn btn-secondary"
							href="<?php echo base_url('marketing/site'); ?>"> <i
							class="fa fa-desktop" style="margin-right: 5px"></i> Gerência
							do Site
						</a>
						<a class="btn btn-default btn-sm btn btn-secondary"
							href="<?php echo base_url('marketing/site/servicos'); ?>">
							<i class="fa fa-wrench" style="margin-right: 5px"></i> Servicos
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
                        <div
						class="portlet box green-hoki bg-blue-chambray col-md-12">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-wrench"></i>Cadastrar Novo
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse" data-original-title=""
									title=""></a> <a href="" class="fullscreen"
									data-original-title="" title=""></a>
							</div>
						</div>
						<div class="portlet-body">
                            <?php foreach ( $servico->result () as $serv ) { ?>
                            <form action="" method="post"
								enctype="multipart/form-data">
								<div class="form-group">
									<label>Título</label> <input type="text" name="titulo"
										value="<?php echo $serv->titulo; ?>" class="form-control">
								</div>
								<div class="form-group">
									<label>Descrição Breve(Home)</label> <input type="text"
										name="descricao_breve"
										value="<?php echo $serv->descricao_breve; ?>"
										class="form-control">
								</div>
								<div class="form-group">
									<label>Descição</label>
									<!-- Make sure the path to CKEditor is correct. -->
									<script src="<?php echo base_url('ckeditor/ckeditor.js'); ?>"></script>
									<textarea name="descricao" id="editor1" rows="5" cols="80"><?php echo $serv->descricao; ?></textarea>
									<script>
                                                // Replace the <textarea id="editor1"> with a CKEditor
                                                // instance, using default configuration.
                                                CKEDITOR.replace( 'editor1', {
                                                    language: 'en',
                                                    filebrowserBrowseUrl : '<?php echo base_url();?>filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
                                                    filebrowserUploadUrl : '<?php echo base_url();?>filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
                                                    filebrowserImageBrowseUrl : '<?php echo base_url();?>filemanager/dialog.php?type=1&editor=ckeditor&fldr='
                                                });
                                        </script>
								</div>
								<div class="form-group">
									<label>Categoria de Serviços</label> <select
										class="form-control" name="cod_cat_servicos" required>
										<option value="0">Selecionar...</option>
                                        <?php foreach ( $cat_servicos->result () as $servico ) { ?>
											<option value="<?php echo $servico->cod_cat_servicos; ?>" <?php if($servico->cod_cat_servicos == $serv->cod_cat_servicos){echo "selected";} ?>><?php echo $servico->descricao; ?></option>
                                        <?php } ?>
                                    </select>
								</div>
								<div class="form-group">
									<label>Unidade de Negócio</label> <select class="form-control"
										name="cod_unidade">
										<option value="0">Todas as Unidades</option>
                                        <?php foreach ( $unidades->result () as $unidade ) { ?>
											<option value="<?php echo $unidade->cod_unidade; ?>" <?php if($unidade->cod_unidade==$serv->cod_unidade){ echo " selected";} ?>><?php echo $unidade->descri_unidade; ?></option>                                       
                                        <?php } ?>
                                    </select>
								</div>
								<div class="form-group">
									<label>Icone/Imagem(PNG - 300x150px)<span class="text-danger">Deixar
											em branco se não quiser trocar</span></label> <input
										type="file" name="imagem"> <input type="hidden" name="icone"
										value="<?php echo $serv->imagem; ?>">
								</div>
								<div class="form-group">
									<input type="submit" name="editar_servico"
										class="btn btn-primary btn-block" value="Atualizar">
								</div>
							</form> 
                            <?php } ?>                                
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
    </body>
</html>
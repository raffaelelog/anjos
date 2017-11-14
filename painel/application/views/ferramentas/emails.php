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
					Envio de emails internos em massa
					<!--   MENU DE CONTEXTO -->
					<div class="btn-group pull-right" role="group">
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
					<div class="portlet portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-wrench"></i>Novo email
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse" data-original-title=""
									title=""> </a> <a href="" class="fullscreen"
									data-original-title="" title=""></a>
							</div>
						</div>
						<div class="portlet-body">
							<form action="" method="post" enctype="multipart/form-data">
								<div class="form-group col-md-4">
									<label>Assunto</label> 
									<input type="text" name="assunto" class="form-control" required="required">
								</div>
								<div class="form-group col-md-4">
									<label>Unidades de destino</label> 
									<select name="unidade" class="form-control" required="required">
										<option value="">selecione</option>
										<option value="0">Todos as unidades</option>
										<?php foreach ($unidade->result() as $item){ ?>
											<option value="<?php echo $item->cod_unidade ?>"><?php echo $item->descri_unidade ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="form-group col-md-4">
									<label>Setores de destino</label> 
									<select name="setor" class="form-control" required="required">
										<option value="">selecione</option>
										<option value="0">Todos os setores</option>
										<?php foreach ($setor->result() as $item){ ?>
											<option value="<?php echo $item->cod_setor?>"><?php echo $item->descri_setor?></option>
										<?php } ?>
									</select>
								</div>
								<div class="form-group col-md-12">
									<label>Texto do email</label>
									<!-- Make sure the path to CKEditor is correct. -->
									<script src="<?php echo base_url('ckeditor/ckeditor.js'); ?>"></script>
									<textarea name="texto" id="editor1" rows="5" cols="80" required="required"></textarea>
									<script>
										CKEDITOR.replace( 'editor1', {
	                                        language: 'pt',
	                                        filebrowserBrowseUrl : '<?php echo base_url();?>filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
	                                        filebrowserUploadUrl : '<?php echo base_url();?>filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
	                                        filebrowserImageBrowseUrl : '<?php echo base_url();?>filemanager/dialog.php?type=1&editor=ckeditor&fldr='
	                                    });
									</script>
								</div>
								<hr>
								<div class="form-group col-md-6">
									<label for="file">Anexo:</label> 
									<input type="file" accept=".xls, .xlsx, .doc, .docx,.ppt, .pptx, .pdf" class="form-control" id="file" name="file">
								</div>
								<div class="form-group col-md-6">
									<label style="color: #FFF"> Enviar </label> 
									<input type="submit" name="enviar_email" class="btn btn-primary btn-block"value="Enviar">
								</div>
							</form>
							<div class="clearfix"></div>
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
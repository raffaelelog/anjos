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
					GERENCIAMENTO DE BANNERS
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
                        <div class="portlet box blue-hoki">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-wrench"></i>Banner's Cadastrados
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
									<th>Banner</th>
									<th>Texto linha 1</th>
									<th>Texto linha 2</th>
									<th>Texto linha 3</th>
									<th>Texto do Botão</th>
									<th>URL</th>
									<th>Excluir</th>
								</thead>
								<tbody>
                                <?php foreach ( $banners->result () as $banner ) { ?>
                                    <tr>
										<td style="vertical-align: middle;"><img
											src="<?php echo base_url('source')."/$banner->imagem"; ?>"
											style="max-height: 120px"></td>
										<td style="vertical-align: middle;"><?php echo $banner->texto_1; ?></td>
										<td style="vertical-align: middle;"><?php echo $banner->texto_2; ?></td>
										<td style="vertical-align: middle;"><?php echo $banner->texto_3; ?></td>
										<td style="vertical-align: middle;"><?php echo $banner->btn_text; ?></td>
										<td style="vertical-align: middle;"><?php echo $banner->btn_url; ?></td>
										<td style="vertical-align: middle;">
											<form action="" method="post">
												<input type="hidden" name="cod_banner"
													value="<?php echo $banner->cod_banner; ?>"> <input
													type="submit" class="btn btn-danger btn-sm" name="excluir"
													value="Excluir">
											</form>

										</td>
									</tr>
                                    <?php } ?>
                            	</tbody>
							</table>
						</div>
					</div>
					<div class="portlet box blue-hoki">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-wrench"></i>Cadastrar Novo
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
									<label>Linha de texto 1</label> <input type="text"
										name="texto_1" class="form-control">
								</div>
								<div class="form-group col-md-6">
									<label>Linha de texto 3</label> <input type="text"
										name="texto_3" class="form-control">
								</div>
								<div class="form-group">
									<label>Linha de texto 2</label>
									<!-- Make sure the path to CKEditor is correct. -->
									<script src="<?php echo base_url('ckeditor/ckeditor.js'); ?>"></script>
									<textarea name="texto_2" id="editor1" rows="5" cols="80"> Conteúdo da Matéria. </textarea>
									<script>
                                                            CKEDITOR.replace( 'editor1', {
                                                                language: 'pt',
                                                                filebrowserBrowseUrl : '<?php echo base_url();?>filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
                                                                filebrowserUploadUrl : '<?php echo base_url();?>filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
                                                                filebrowserImageBrowseUrl : '<?php echo base_url();?>filemanager/dialog.php?type=1&editor=ckeditor&fldr='
                                                            });
                                   </script>
								</div>
								<div class="form-group col-md-3">
									<label>Texto do Botão</label> <input type="text"
										name="btn_text" class="form-control">
								</div>
								<div class="form-group col-md-3">
									<label>URL</label> <input type="text" name="btn_url"
										class="form-control">
								</div>
								<div class="form-group col-md-3">
									<label>Imagem do Banner</label> <input type="file"
										name="imagem" class="form-control" required>
								</div>
								<div class="form-group col-md-3">
									<label>Unidade</label> 
									<select class="form-control" name="cod_unidade">
										<option value="0">Todas as Unidades</option>
                                        <?php foreach ( $unidades->result () as $unidade ) { echo '<option value="' . $unidade->cod_unidade . '">' . $unidade->descri_unidade . '</option>'; } ?>
                                    </select>
								</div>
								<div class="form-group">
									<input type="submit" name="cadastrar_banner"
										class="btn btn-primary btn-block" value="Cadastrar">
								</div>
							</form>
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
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
					GERENCIAMENTO DE BLOG
					<!--   MENU DE CONTEXTO -->
					<div class="btn-group pull-right" role="group">
						<a class="btn btn-default btn-sm btn btn-secondary"
							href="<?php echo base_url('marketing/site'); ?>"> <i
							class="fa fa-desktop" style="margin-right: 5px"></i> Gerência do Site
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
								<i class="fa fa-wrench"></i>Dicas City10 Cadastradas
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
									<th>Imagem</th>
									<th>Título</th>
									<th>Breve Descrição</th>
									<th>Data</th>
									<th>Texto</th>
									<th>Autor</th>
									<th>Segmento de URL</th>
									<th>Excluir</th>
								</thead>
								<tbody>
                                        <?php foreach ( $blog->result () as $item ) { ?>
                                        <tr>
										<td style="vertical-align: middle;"><img
											src="<?php echo $item->capa; ?>" style="max-height: 120px"></td>
										<td style="vertical-align: middle;"><?php echo $item->titulo; ?></td>
										<td style="vertical-align: middle;"><?php echo $item->descricao; ?></td>
										<td style="vertical-align: middle;"><?php echo date('d-m-Y', strtotime($item->data)); ?></td>
										<td style="vertical-align: middle;"><?php echo $item->texto; ?></td>
										<td style="vertical-align: middle;"><?php echo $item->autor; ?></td>
										<td style="vertical-align: middle;"><?php echo $item->url; ?></td>
										<td style="vertical-align: middle;">
											<form action="" method="post">
												<input type="hidden" name="cod_dica" value="<?php echo $item->cod_dica; ?>"> 
												<input type="hidden" name="caminhho_dica" value="<?php echo $item->capa;?>">
												<input type="submit" class="btn btn-danger btn-sm" name="excluir_dica" value="Excluir">
											</form>

										</td>
									</tr>
                                	<?php }?>
                            	</tbody>
							</table>
						</div>
					</div>
					<div class="portlet box blue-hoki">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-wrench"></i>Cadastrar Nova Dica City10
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
									<label>Título</label> <input type="text" name="titulo"
										class="form-control" required>
								</div>

								<div class="form-group col-md-6">
									<label>Breve Descrição</label> <input type="text"
										name="descricao" class="form-control" required>
								</div>
								<div class="form-group col-md-12">
									<label> Conteúdo da Matéria</label>
									<!-- Make sure the path to CKEditor is correct. -->
									<script src="<?php echo base_url('ckeditor/ckeditor.js'); ?>"></script>
									<textarea name="texto" id="editor1" rows="5" cols="80" required>                                                         
                                                    </textarea>
									<script>
                                                            // Replace the <textarea id="editor1"> with a CKEditor
                                                            // instance, using default configuration.
                                                            CKEDITOR.replace( 'editor1', {
                                                                language: 'pt',
                                                                filebrowserBrowseUrl : '<?php echo base_url();?>filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
                                                                filebrowserUploadUrl : '<?php echo base_url();?>filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
                                                                filebrowserImageBrowseUrl : '<?php echo base_url();?>filemanager/dialog.php?type=1&editor=ckeditor&fldr='
                                                            });
                                                        </script>
								</div>
								<div class="form-group col-md-6">
									 <input type="file" accept=".jpg" name="imagem" class="form-control" required>
								</div>
								<div class="form-group col-md-6">
									<input type="submit" name="cadastrar_dica"
										class="btn btn-primary btn-block" value="Cadastrar">
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

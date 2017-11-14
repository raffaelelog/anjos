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
							href="<?php echo base_url('painel'); ?>"> <i
							class="fa fa-dashboard" style="margin-right: 5px"></i> Dashboard
						</a> 
						<a class="btn btn-default btn-sm btn btn-primary"
							href="<?php echo base_url('marketing/site/servicos_novo'); ?>">
							<i class="fa fa-plus-circle" style="margin-right: 5px"></i> Novo
							Serviço
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
                            <div class="portlet box blue-hoki col-md-12">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-wrench"></i>servicos Cadastrados
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse" data-original-title=""
									title=""> </a> <a href="" class="fullscreen"
									data-original-title="" title=""></a>
							</div>
						</div>
						<div class="portlet-body">

							<table class="table datatable">
								<thead>
									<th>Icone/Imagem</th>
									<th>Serviço</th>
									<th>Categoria</th>
									<th class="text-center">Opções</th>
								</thead>
								<tbody>
                                <?php foreach ( $listar_servicos->result () as $servico ) { ?>
                                	<tr>
										<td><img
											src="<?php echo base_url('source/').$servico->imagem; ?>"
											style="max-height: 40px;"></td>
										<td><?php echo $servico->titulo; ?></td>
										<td><?php echo $servico->categoria; ?></td>
										<td><a
											href="<?php echo base_url('index.php/marketing/site/servicos_editar').'/'.$servico->cod_servico; ?>"
											class="btn btn-primary pull-right">Editar </a> <a
											href="<?php echo base_url('index.php/marketing/site/servicos_excluir').'/'.$servico->cod_servico; ?>"
											class="btn btn-danger pull-right">Excluir </a></td>
									</tr> 
									<?php } ?>
                            	</tbody>
							</table>
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
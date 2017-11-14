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
					<i class="fa fa-archive"> </i> Consulta de clientes <small></small>
					<!--   MENU DE CONTEXTO -->
					<div class="btn-group pull-right" role="group">
						<a class="btn btn-default btn-sm btn btn-secondary"
							href="<?php echo base_url('painel'); ?>"> <i
							class="fa fa-dashboard"></i> Dashboard
						</a>
					</div>
				</h1>
				<!-- END PAGE HEADER-->
				<div class="row">
					<!-- Caixas Cadastradas -->
					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-wrench"></i>Filtro da Consulta
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse" data-original-title=""
									title=""> </a> <a href="" class="fullscreen"
									data-original-title="" title=""></a>
							</div>
						</div>
						<div class="portlet-body">
							<form action="" method="post">
								<div class="form-group col-md-4 col-md-offset-1">
									<label>Cidades</label> 
									<select name="entrada" class="form-control" required="required">
										<option value="">Selecione..</option>
										<option value="0">Todas</option>
										<?php if($cidades){ foreach ($cidades->result() as $cid){ echo '<option value="'.$cid->cidade.'">'.$cid->nome_cid.'</option>';}}?>
									</select> 
								</div>
								<div class="form-group col-md-4 col-md-offset-1">
									<label style="color: #FFF"> Consultar </label> <input
										type="submit" name="filtrar"
										class="btn btn-primary btn-block" value="Filtrar">
								</div>
							</form>
							<div class="clearfix"></div>
						</div>
					</div>

					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-wrench"></i>Clientes
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse" data-original-title=""
									title=""> </a> <a href="" class="fullscreen"
									data-original-title="" title=""></a>
							</div>
							<div class="actions">
								<div class="btn-group">
									<a class="btn btn-outline" href="javascript:;"
										data-toggle="dropdown"> <i class="fa fa-share"></i> <span
										class="hidden-xs"> Opções </span> <i class="fa fa-angle-down"></i>
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
							<table class="table table-hover datatable" id="sample_3">
								<thead>
									<th>Contrato</th>
									<th>Nome</th>
									<th>Cidade</th>
									<th>Bairro</th>
									<th>55+DDD+Telefone</th>
									<th>55+DDD+Celular</th>
								</thead>
								<tbody>
                                	<?php if($telefones){ foreach ($telefones->result() as $sol): ?>
                                    	<tr>

										<td><?php echo $sol->codcli; ?></td>
										<td><?php echo $sol->nome_cli; ?></td>
										<td><?php echo $sol->nome_cid; ?></td>
										<td><?php echo $sol->bairro; ?></td>
										<td><?php if(strlen ($sol->telefone)==12){echo $sol->telefone;}  ?></td>
										<td><?php $celular = preg_replace("/[^0-9]/", "",  $sol->celular); if(strlen ($celular)==13){echo $celular;} else{if(strlen ($celular)==12 and substr($celular, 5, 1)!=3){echo substr($celular,0, 5).'9'.substr($celular, 5,12);}}?></td>
									</tr>
                                	<?php endforeach; } ?>  
                              	</tbody>
							</table>
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
	<!-- END FOOTER -->
</body>
</html>
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
					Manutenção
					<!--   MENU DE CONTEXTO -->
					<div class="btn-group pull-right" role="group">
						<a class="btn btn-default btn-sm btn btn-secondary"
							href="<?php echo base_url('estoque/manutencao'); ?>"> <i
							class="fa fa-wrench"></i> Voltar para Manutenção
						</a> <a class="btn btn-default btn-sm btn btn-secondary"
							href="<?php echo base_url('painel'); ?>"> <i
							class="fa fa-dashboard"></i> Dashboard
						</a>
					</div>
				</div>
				<!-- END PAGE HEADER-->
				<div class="row">
					<?php if($alerta !=null){ ?>
            		<div class="alert alert-<?php echo $alerta['class']; ?>">
						<button type="button" class="close" data-dismiss="alert"
							aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
                		<?php echo $alerta[ 'mensagem']; ?>
            		</div>
            		<?php } ?>
					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-filter"></i>
									<?php foreach ( $produtos->result () as $produto ) { ?>
									<span class="caption-subject bold font-grey-gallery uppercase">  
										Dados da OS - <span class="text-danger"> <?php echo str_pad($cod_manutencao, 4, "0", STR_PAD_LEFT); ?></span>
										<?php if($produto->cod_statusmanutencao==2){echo "(*******FECHADA*******)";} ?>:
									</span>
									
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse" data-original-title=""
									title=""> </a> <a href="" class="fullscreen"
									data-original-title="" title=""></a>
							</div>
						</div>
						
						<div class="portlet-body">
                  			<div class="col-md-8">
								<form method="post" class="form-group" action="">
									<div class="col-md-12 form-group">
										<select name="cod_statusmanutencao" class="form-control">
	                          			<?php foreach ( $status_manutencao->result () as $status ) { ?>
	                            			<option value="<?php echo $status->cod_statusmanutencao; ?>" <?php if($status->cod_statusmanutencao==$produto->cod_statusmanutencao){echo " selected"; $cod_statusmanutencao_anterior = $status->cod_statusmanutencao;} ?>>                            
	                              				<?php echo $status->descricao; ?>               
	                           				</option>                       
	                          			<?php } ?>
                        				</select>
									</div>
									<div class="col-md-12 form-group">
										<select name="cod_manutencaoresp" class="form-control">
                          			<?php if($produto->retorno == null or $nivel == 5){ foreach ( $manutencaoresp->result () as $resp ) { ?>
                            		<?php echo  '<option value="'.$resp->cod_usuario.'"'; if($resp->cod_usuario==$produto->cod_usuario){echo " selected";} echo '>'.$resp->nome.'</option>'; ?>                        
                         			<?php }} else{echo  '<option value="'.$produto->cod_usuario.'">'.$produto->nome.'</option>';} ?>
                        			</select>
									</div>
									<div class="col-md-6 form-group">
										<input type="text" class="form-control" name="defeito"
											value="<?php echo $produto->defeito; ?>"
											placeholder="Descrição do Defeito">
									</div>
									<div class="col-md-6 form-group">
										<select name="cod_tipo_manutencao" class="form-control">
                          				<option value=" ">Selecione</option>          
	                          			<?php foreach ( $tipo->result () as $tip ) { ?>
	                            			<option value="<?php echo $tip->cod_tipo_manutencao; ?>"<?php if($tip->cod_tipo_manutencao==$produto->cod_tipo_manutencao){echo " selected"; } ?>><?php echo $tip->descri_tipo; ?></option>                        
	                         			<?php } ?>
                        			</select>
									</div> 
									<div class="clearfix"></div>
									<div class="col-md-8 form-group">
										<textarea  cols="4" rows="4" style="overflow:auto;resize:none" class="form-control" name="obs"><?php echo $produto->obs; ?></textarea>
									</div>									
									<div class="col-md-4 form-group">
										<input type="hidden" name="cod_statusmanutencao_anterior" value="<?php echo $cod_statusmanutencao_anterior; ?>"> 
										<input type="hidden" name="cod_produtoitem" value="<?php echo $produto->cod_produtoitem; ?>"> 
										<label style="color: #FFF"> Atualizar </label> 
										<input type="submit" name="atualizar" class="btn btn-primary btn-block" value="Atualizar">
									</div>
									<div class="clearfix"></div>
								</form>
							</div>
							<div class="col-md-4">
								<h4>Informações do Equipamento</h4>
								<span class="col-md-12"><strong>Código: </strong><?php echo $produto->codigo; ?></span>
								<span class="col-md-12"><strong>Data Entrada: </strong><?php echo date('d-m-Y', strtotime( $produto->entrada)); ?></span>
								<span class="col-md-12"><strong>Produto: </strong><?php echo $produto->produto; ?></span>
								<span class="col-md-12"><strong>Data Retorno: </strong><?php
																		if (isset ( $produto->data_retorno )) {
																			echo date ( 'd/m/Y', strtotime ( $produto->data_retorno ) ) . " - " . $produto->retorno . " vez(es)";
																		} else {
																			echo "Não retornou";
																		}
																		?></span>
								<div class="clearfix"></div>
								<hr />
								<span class="col-md-12"><strong>Responsável: </strong><?php echo $produto->responsavel_nome; ?></span>
								<div class="clearfix"></div>
								<hr />
							</div>
                		<?php } ?>
						<div class="clearfix"></div>
						<h4>
							<i class="fa fa-info"></i> Atenção
						</h4>
						<ul class="list-group">
							<li class="list-group-item">1 - Ao selecionar <span
								class="text-danger">CONCLUÍDA</span> a OS é fechada e o produto
								automaticamente é devolvido ao estoque
							</li>
							<li class="list-group-item">2 - Ao selecionar <span
								class="text-danger">SEM SOLUÇÃO</span> a OS é fechada e o
								produto é dado como LIXO ELETRÔNICO
							</li>
							<li class="list-group-item">3 - Os demais status não alteram nada
								no produto, apenas a situação da Ordem de Serviço.</li>
						</ul>
						<!-- Final do portlet-body -->
					</div>
					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-filter"></i>Ordens Abertas anteriormente para avaliação deste produto
							</div>
						</div>
						<div class="portlet-body">
							<table class="table table-hover datatable" id="sample_3">
								<thead>
									<th>Num. OS</th>
									<th>Código</th>
									<th>Responsável</th>
									<th>Retorno por OS</th>
									<th>Observação</th>
									<th>defeito</th>
									<th>Tipo</th>
								</thead>
								<tbody>
                    				<?php foreach ( $lancamentos->result () as $item ) { ?>
                      					<tr>
											<td><?php echo $item->cod_manutencao; ?></td>
											<td><?php echo $item->cod_produtoitem; ?></td>
											<td><?php echo $item->nome; ?></td>
											<td><?php echo $item->retorno; ?></td>
											<td><?php echo $item->obs; ?></td>
											<td><?php echo $item->defeito; ?></td>
											<td><?php echo $item->descri_tipo; ?></td>
										</tr>
                    				<?php } ?>
                   	 			</tbody>
							</table>
						</div>
						<div class="clearfix"></div>
						<!-- Final do portlet-body -->
					</div>
					<!-- END ROW -->
				</div>
			</div>
			<!-- END CONTENT -->
			<!-- BEGIN QUICK SIDEBAR -->
        <?php $this->load->view('layout/quick_sidebar'); ?>
        <!-- END QUICK SIDEBAR -->
		</div>
	</div>
	<!-- END CONTAINER -->
	<!-- BEGIN FOOTER -->
    <?php $this->load->view('layout/footer'); ?>
	<!-- END FOOTER -->
</body>
</html>
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
					Ítens de Consumo - Tranferência de Unidade
					<!--   MENU DE CONTEXTO -->
					<div class="btn-group pull-right" role="group">
						<a class="btn btn-primary btn-sm btn btn-secondary"
							href="<?php echo base_url('estoque/itemconsumo/transferencias'); ?>"> <i
							class="fa fa-arrow-right"></i> Histórico
						</a>

						<a class="btn btn-default btn-sm btn btn-secondary"
							href="<?php echo base_url('estoque/dashboard'); ?>"> <i
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
								<i class="fa fa-filter"></i>Produtos
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse" data-original-title=""
									title=""> </a> <a href="" class="fullscreen"
									data-original-title="" title=""></a>
							</div>
						</div>
						<div class="portlet-body">
							<form action="" method="post">
								<div class="form-group equipamentos">
                                    <label>Add/Remover Item
                                        <div class="add btn btn-default btn-sm"><i class="fa fa-plus-circle"></i>
                                        </div><div class="remove_eq btn btn-default btn-sm"><i class="fa fa-remove"></i>
                                        </div>
                                    </label>

                                    <div class="clonar" style="padding: 3px; margin-bottom: 10px;">

	                                    <div class="col-md-4">
	                                    	<input type="text" name="codigo[]" class="form-control text-uppercase" placeholder="Código do Produto" required>
	                                    </div>

	                                    <div class="col-md-4">
	                                    	<input type="text" name="quantidade[]" class="form-control" placeholder="Quantidade" required>
	                                    </div>

	                                    <div class="col-md-4">
	                                    	<select name="cod_unidade" class="form-control">
	                                    		<?php foreach ($unidades_transferencia->result() as $unidade): ?>
	                                    			<option value="<?php echo $unidade->cod_unidade; ?>"><?php echo $unidade->descri_unidade; ?></option>
	                                    		<?php endforeach ?>
	                                    	</select>
	                                    </div>

	                                    <div class="clearfix"></div>
	                                </div>

                                </div>

                                <div class="form-group col-md-12">
                                	<input type="submit" class="btn btn-primary pull-right" name="enviar" value="Transferir Produtos">
                                </div>

							</form>
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
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
         <script type="text/javascript">
          $(document).ready(function () {

              $(".add").click(function () {
                      $(".clonar:last").clone().appendTo(".equipamentos");
              });

              $(".equipamentos").on('click', '.remove_eq', function () {
                      $(".clonar:last").remove();
              });


          })
        </script>
    <?php $this->load->view('layout/footer'); ?>


	<!-- END FOOTER -->
</body>
</html>
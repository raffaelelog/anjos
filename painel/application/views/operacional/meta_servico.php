<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
    <?php $this->load->view('layout/head'); ?>
    <!-- END HEAD -->
	<body  class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid topage-sidebar-closed page-sidebar-closed">
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
					<i class="fa fa-taxi"> </i> Metas <small></small>
					<!--   MENU DE CONTEXTO -->
					<div class="btn-group pull-right" role="group">
						<a class="btn btn-default btn-sm btn btn-secondary"
							href="<?php echo base_url('operacional/servicos/metas_servico'); ?>"> <i
							class="fa fa-users"></i> Metas-Serviço
						</a>
						<a class="btn btn-default btn-sm btn btn-secondary"
							href="<?php echo base_url('painel'); ?>"> <i
							class="fa fa-dashboard"></i> Dashboard
						</a>
					</div>
				</h1>
				<!-- END PAGE HEADER-->
				<div class="modal fade" id="editar" tabindex="-1" role="dialog"
					aria-labelledby="myModalLabel">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal"
									aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								<h4 class="modal-title" id="myModalLabel">
									Editar Meta do Serviço  
								</h4>
							</div>
							<form class="form-group" name="formulario" action="" method="post">
								<div class="modal-body">
									<div class="form-group col-md-12">
										<label for="nome">Valor</label> 
										<input type="number" class="form-control valor_editado" value="#" max="1000" min="400" step="1" class="form-control" name="valor_editado" id="valor_editado" autocomplete="off"> 
										<input type="hidden" class="id" value="#" name="id">
									</div>
									<div class="modal-footer col-md-4">
										<button type="button" class="btn btn-default btn-block"
											data-dismiss="modal">Cancelar</button>
									</div>
									<div class="modal-footer col-md-4">
										<button type="submit" class="btn btn-primary btn-block"
											name="editar_meta" value="Editar">Editar</button>
									</div>
									<div class="modal-footer col-md-4">
										<button type="submit" class="btn btn-danger btn-block"
											name="excluir_meta" value="Excluir">Excluir</button>
									</div>
									<div class="clearfix"></div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="row">
               		<?php if($alerta != null){ ?>
                    	<div class="alert alert-<?php echo $alerta['class']; ?>">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
                            <?php echo $alerta['mensagem']; ?>
                       	</div>
                    <?php } ?>        
					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-wrench"></i>Inserir meta
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse" data-original-title=""
									title=""> </a> <a href="" class="fullscreen"
									data-original-title="" title=""></a>
							</div>
						</div>
						<div class="portlet-body">
							<form action="" method="post">
								<div class="form-group col-md-3">
									<label>Meta</label> 
									<input type="number" required="required" name="valor_meta" class="form-control" max="1000" min="400" step="1"">
								</div>
								<div class="form-group col-md-3">
									<label>Data Inicial</label> 
									<input required="required" type="text" name="data_ini" id="data_ini"  class="form-control monthPicker" readonly="readonly" >
								</div>
								<div class="form-group col-md-3">
									<label>Data Final</label> 
									<input required="required" type="text" name="data_fim" id="data_fim" class="form-control monthPicker" readonly="readonly" >
								</div>
								<div class="form-group col-md-3">
									<label style="color: #FFF"> Inserir </label> 
									<input type="submit" name="inserir_meta" class="btn btn-primary btn-block" value="Inserir">
								</div>
							</form>
							<div class="clearfix"></div>
						</div>
					</div>
					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-wrench"></i>Metas de Instalação  
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
							<table class="table table-responsive" id="sample_3">
								<thead>
									<th>Mês</th>
									<th>Ano</th>
									<th>Valor</th>
									<th>Ação</th>
								</thead>
								<tbody>
                                    <?php foreach ($lista_servico->result() as $item) { ?>
                                    	<tr>
											<td><?php echo $item->data_mes; ?></td>
											<td><?php echo $item->data_ano; ?></td>
											<td><?php $valor = $item->valor; echo $valor; ?></td>
											<td><?php if($valor!=null){ echo '<a class="editar btn btn-success btn-sm btn-block" data-valor="'.$valor.'" data-id="'.$item->cod_meta_servico.'"><i class="fa fa-edit"></i>Editar</a>';} ?></td>
										</tr>  
                                    <?php } ?>
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
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script>
	$(document).ready(function(){
	    $(".monthPicker").datepicker({ 
	        dateFormat: 'yy-mm-dd',
	        changeMonth: true,
	        changeYear: true,
	        showButtonPanel: true,
            monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
            minDate: '-1m',
            maxDate: '+1y',
            closeText : 'Selecionar',
            showButtonPanel:false,
	        onClose: function(dateText, inst) {  
	            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val(); 
	            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val(); 
	            var day = '01';
	            $(this).val($.datepicker.formatDate('yy-mm-dd', new Date(year, month,day)));
	        }
	    });
	    $(".monthPicker").focus(function () {
			$(".ui-datepicker-calendar").hide();
			$("#ui-datepicker-div").position({
				  my: "center top",
				  at: "center bottom",
				  of: $(this)
			});
		});
	});
    </script>
	<script>	
    	$('.editar').on('click', function(){
     		var id = $(this).data('id'); // vamos buscar o valor do atributo data-id
      		var valor = $(this).data('valor')
      		$('input.id').attr('value', id);
      		$('input.valor_editado').attr('value', valor);
      		$('#editar').modal('show'); // modal aparece
		});
    </script>
	<!-- END FOOTER -->
</body>
</html>
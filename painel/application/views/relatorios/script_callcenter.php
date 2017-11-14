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
				<div>
					<div class="page-title">
						Manutenção
						<!--   MENU DE CONTEXTO -->
						<div class="btn-group pull-right" role="group">
							<a class="btn btn-default btn-sm btn btn-secondary"
								href="<?php echo base_url('relatorios/relatorios'); ?>"> <i
								class="fa fa-table"></i> Relatórios
							</a>
							<a class="btn btn-default btn-sm btn btn-secondary"
								href="<?php echo base_url('painel'); ?>"> <i
								class="fa fa-dashboard"></i> Dashboard 
							</a> 
						</div>
					</div>
				</div>
				<!-- END PAGE HEADER-->
				<div class="row">
					<div class="portlet light">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-wrench"></i>Filtro de Data Agendamento </div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                                    <a href="" class="fullscreen" data-original-title="" title=""></a>
                                </div>
                            </div>
                            <div class="portlet-body">                             
                                <form action="" method="post">
                                    <div class="form-group col-md-4">
                                        <label>Data Inicial</label>
                                        <input type="text" name="data_ini" class="form-control datepicker" value="<?php echo set_value('data_cad_i'); ?>" readonly="readonly">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Data Final</label>
                                        <input type="text" name="data_fim" class="form-control datepicker" value="<?php echo set_value('data_cad_f'); ?>" readonly="readonly">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label style="color: #FFF"> Filtrar </label>
                                        <input type="submit" name="filtrar" class="btn btn-primary btn-block" value="Filtrar" >
                                    </div>
                                </form>
                            <div class="clearfix"></div>
                            </div>
                        </div>
					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-filter"></i>Relatório Script Call Center
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
									<th>Data Lançamento</th>
									<th>Nome Cliente</th>
									<th>Contrato</th>
									<th>Atendente</th>
									<th>Bairro</th>
									<th>Cidade</th>
									<th>Script1</th>
									<th>Script2</th>
									<th>Script3</th>
									<th>Script4</th>
								</thead>
								<tbody>
                    			<?php if($itens){foreach ( $itens->result () as $item ) { ?>
                      				<tr>
										<td><?php echo date('d-m-Y', strtotime($item->data_lan)); ?></td>
										<td><?php echo $item->nome_cli; ?></td>
										<td><?php echo $item->codcli; ?></td>
										<td><?php echo $item->nome_usu; ?></td>	
										<td><?php echo $item->bairro; ?></td>
										<td><?php echo $item->nome_cid; ?></td>										
										<?php $text = str_replace("\n","*",$item->script);
										$script = explode('*',$text); 
										$count = substr_count($text, '*'); ?>
										<td><?php if($count>0){echo $script[0];} ?></td>
										<td><?php if($count>=1){echo $script[1];} ?></td>
										<td><?php if($count>=2){echo $script[2];} ?></td>
										<td><?php if($count>=3){echo $script[3];} ?></td>
									</tr>
                    			<?php }} ?>
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
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.js"></script>
    <script>
            $(function() {
                $( ".datepicker" ).datepicker();
            });
            $( ".datepicker" ).datepicker({ 
                dateFormat: "yy-mm-dd",
                dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
                dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
                dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
                monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
                monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
                nextText: 'Próximo',
                prevText: 'Anterior'
            });
    </script>
    <?php $this->load->view('layout/footer'); ?>
	<!-- END FOOTER -->
</body>
</html>
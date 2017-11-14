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
							<!--  END MODAL -->
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
								<i class="fa fa-filter"></i>Relatório Manutenção
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse" data-original-title=""
									title=""> </a> <a href="" class="fullscreen"
									data-original-title="" title=""></a>
							</div>
							<div class="actions">
								<div class="btn-group">
									<a class="btn btn-outline" href="javascript:;" data-toggle="dropdown"> <i class="fa fa-share"></i> <span class="hidden-xs"> Opções </span> <i
										class="fa fa-angle-down"></i>
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
									<th>Nº OS</th>
									<th>Código</th>
									<th>Nome do Produto</th>
									<th>Data-Entrada</th>
									<th>Data-Saida</th>
									<th>Retorno</th>
									<th>Data Retorno</th>
									<th>Tempo</th>
									<th>Nome Responsável</th>
									<th>Preço/Custo</th>
								</thead>
								<tbody>
                    			<?php foreach ( $itens->result () as $item ) { ?>
                      				<tr>
										<td><?php echo $item->OS." (".$item->STATUS.")"; ?></td> 
										<td><?php echo $item->CODIGO; ?></td>
										<td><?php echo $item->PRODUTO; ?></td>
										<td><?php echo date ("d-m-Y", strtotime($item->DATA_ENTRADA)); ?></td>
										<td><?php if($item->DATA_SAIDA!= null){echo date ("d-m-Y", strtotime($item->DATA_SAIDA));} ?></td>
										<td><?php echo $item->RETORNOS; ?></td>
										<td><?php if($item->DATA_ULTIMO_RETORNO != null){echo date ("d-m-Y", strtotime($item->DATA_ULTIMO_RETORNO));} ?></td>
										<td><?php if($item->DATA_ULTIMO_RETORNO == null){echo diff(date ("Y-m-d", strtotime($item->DATA_ENTRADA)), date ("Y-m-d"),'d');} else {echo diff(date ("Y-m-d", strtotime($item->DATA_ULTIMO_RETORNO)), date ("Y-m-d"),'d');} echo "dias";?></td>
										<td><?php echo $item->RESPONSAVEL; ?></td>										
										<td><?php echo $item->PRECo_CUSTO; ?></td>
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
    <?php function diff ($inicio, $fim, $tipo){
    	if (!$fim || $fim < $inicio) {
    		return "A data final deve ser maior que a inicial.";
    	} elseif ($inicio < "1970-01-01") {
    		return "A data final deve ser maior que 01/01/1970.";
    	} else {
    		if (strlen($inicio) > 10) {
    			$time_inicio = mktime(substr($inicio,-8,2),substr($inicio,-5,2),substr($inicio,-2), substr($inicio,5,2), substr($inicio,8,2), substr($inicio,0,4));
    		} else {
    			$time_inicio = mktime(0,0,0, substr($inicio,5,2), substr($inicio,-2), substr($inicio,0,4));
    		}
    		if (strlen($fim) > 10) {
    			$time_fim = mktime(substr($fim,-8,2),substr($fim,-5,2),substr($fim,-2), substr($fim,5,2), substr($fim,8,2), substr($fim,0,4));
    		} else {
    			$time_fim = mktime(0,0,0, substr($fim,5,2), substr($fim,-2), substr($fim,0,4));
    		}
    		$diferenca = ($time_fim - $time_inicio);
    		switch($tipo){
    			case "i": return round($diferenca/60);			break;
    			case "H": return round($diferenca/3600); 		break;
    			case "d": return round($diferenca/86400);  		break;
    		}
    	}
    }?>
	<!-- END FOOTER -->
</body>
</html>
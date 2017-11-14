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
					ENVIAR SMS <small></small>
				</h1>
				<!-- END PAGE HEADER-->
				<div class="row">
					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-wrench"></i>Formulário
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse" data-original-title=""
									title=""> </a> <a href="" class="fullscreen"
									data-original-title="" title=""></a>
							</div>
						</div>
						<div class="portlet-body">
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
                                <div class="col-md-6">
								<h3>Informações</h3>
								<ul class="list-group">
									<li class="list-group-item"><i class="fa fa-arrow-right"></i> O
										número deve ser inserido no formato DDD+Número, exemplo:
										32984111234</li>
									<li class="list-group-item"><i class="fa fa-arrow-right"></i> O
										limite de caracteres de uma mensagem é de 160</li>
									<li class="list-group-item"><i class="fa fa-arrow-right"></i> A
										mensagem, se enviada, chegará ao destinatário em segundos.</li>
									<li class="list-group-item"><i class="fa fa-arrow-right"></i>
										Qualquer problema ou dificuldade em enviar contactar o setor
										responsável no ramal 707.</li>
								</ul>
							</div>
							<div class="col-md-6">
								<h3>Formulário de envio</h3>
								<form action="" method="post">
									<div class="form-group">
										<input type="text" class="form-control" readonly="readonly"
											id="in_from" placeholder="Remetente" value="Operate"
											name="fromInput">
									</div>
									<div class="form-group">
										<input type="text" class="form-control" id="in_to"
											maxlength="11" placeholder="Exemplo: 32991231234"
											name="toInput">
									</div>
									<input type="hidden" class="form-control" id="in_messageId"
										value="<?php echo rand(); ?>" name="messageIdInput">
									<div class="form-group">
										<textarea type="text" class="form-control" id="in_text"
											maxlength="160" placeholder="Mensagem" name="textInput"
											rows="2"></textarea>
									</div>
									<input type="hidden" id="in_notify_url" value=" "
										name="notifyUrlInput"> <input type="hidden"
										id="in_notify_contentType" value=" "
										name="notifyContentTypeInput"> <input type="hidden"
										id="in_callback_data" value=" " name="callbackDataInput">
									<div class="form-group">
										<input type="submit" class="btn btn-primary btn-block"
											name="enviar" value="Enviar">
									</div>
								</form>
							</div>
							<hr />
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
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
					POS ATENDIMENTO <small></small>
				</h1>
				<!-- END PAGE HEADER-->
				<div class="row">
					<?php if($alerta !=null){ ?>
						<div class="alert alert-<?php echo $alerta['class']; ?>">
							<button type="button" class="close" data-dismiss="alert"
								aria-label="Close">
								<span aria-hidden="true"> &times; </span>
							</button>
							<?php echo $alerta['mensagem']; ?>
						</div>
					<?php } ?>

					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-wrench"></i>Editar
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse" data-original-title=""
									title=""> </a> <a href="" class="fullscreen"
									data-original-title="" title=""></a>
							</div>
						</div>
						<div class="portlet-body">
							<?php foreach ($pos_editar->result() as $pos): ?>
								
							
                            <form action="" method="post">

							      	<div class="modal-body">

							      		<div class="form-group">
							      			<label>Antendimento</label>
							      			<select class="form-control" name="atendimento" required>
							      				<option value=""> Selecione...</option>
							      				<option value="Insatisfeito" <?php if($pos->atendimento == 'Insatisfeito'){ echo 'selected="selected"';} ?> > Insatisfeito</option>
							      				<option value="Satisfeito" <?php if($pos->atendimento == 'Satisfeito'){ echo 'selected="selected"';} ?>> Satisfeito</option>
							      				<option value="Sem Contato" <?php if($pos->atendimento == 'Sem Contato'){ echo 'selected="selected"';} ?>> Sem Contato</option>
							      			</select>
							      		</div>

							      		<div class="form-group">
							      			<label>Produto</label>
							      			<select class="form-control" name="produto" required>
							      				<option value=""> Selecione...</option>
							      				<option value="Insatisfeito"  <?php if($pos->produto == 'Insatisfeito'){ echo 'selected="selected"';} ?> > Insatisfeito</option>
							      				<option value="Satisfeito"  <?php if($pos->produto == 'Satisfeito'){ echo 'selected="selected"';} ?> > Satisfeito</option>
							      				<option value="Sem Contato"  <?php if($pos->produto == 'Sem Contato'){ echo 'selected="selected"';} ?> > Sem Contato</option>
							      			</select>
							      		</div>

							      		<div class="form-group">
							      			<label>Classificação</label>
							      			<select class="form-control" name="classificacao" required>
							      				<option value=""> Selecione...</option>
							      				<option value="otimo"  <?php if($pos->classificacao == 'otimo'){ echo 'selected="selected"';} ?> > Ótimo</option>
							      				<option value="regular"  <?php if($pos->classificacao == 'regular'){ echo 'selected="selected"';} ?> > Regular</option>
							      				<option value="ruim"  <?php if($pos->classificacao == 'ruim'){ echo 'selected="selected"';} ?> > Ruim</option>
							      			</select>
							      		</div>

							      		<div class="form-group">
							      			<label>Nota</label>
							      			<select class="form-control" name="nota" required>
							      				<option value=""> Selecione...</option>
							      				<?php
							      					for ($i=0; $i <= 10; $i++) { 
							      				?>
							      				<option value="<?php echo $i; ?>" <?php if($pos->nota == $i){ echo 'selected="selected"';} ?> ><?php echo $i; ?></option>
							      				<?php
							      					}
							      				?>
							      			</select>
							      		</div>

							      		<div class="form-group">
							      			<label>Motivo de Insatisfação</label>
							      			<select class="form-control" name="motivo_insatisfacao">
							      			
							      				<option value="NULL"> Selecione...</option>
							      				<option value="Conexão Lenta" <?php if($pos->motivo_insatisfacao == 'Conexão Lenta'){ echo 'selected="selected"';} ?>>Conexão Lenta</option>
							      				<option value="Conexão Caindo" <?php if($pos->motivo_insatisfacao == 'Conexão Caindo'){ echo 'selected="selected"';} ?>>Conexão Caindo</option>
							      				<option value="Sem Conexão" <?php if($pos->motivo_insatisfacao == 'Sem Conexão'){ echo 'selected="selected"';} ?>>Sem Conexão</option>
							      				<option value="Problema não resolvido" <?php if($pos->motivo_insatisfacao == 'Problema não resolvido'){ echo 'selected="selected"';} ?>>Problema não resolvido</option>
							      				<option value="Outros" <?php if($pos->motivo_insatisfacao == 'Outros'){ echo 'selected="selected"';} ?>>Outros</option>

							      			</select>
							      		</div>


							      		<input type="hidden" name="cod_servico" class="form-control" id="conteudo" value="">
							      
							        
								      </div>
								      <div class="modal-footer">
								        <a href="<?php echo base_url('marketing/pos_atendimento'); ?>" class="btn btn-default pull-left">Cancelar e Voltar</a>
								        <input type="submit" class="btn btn-primary pull-right" name="confirmar" value="Confirmar">
								      </div>

								    </form>

								    <?php endforeach ?>
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
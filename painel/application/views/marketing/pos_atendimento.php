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
					<!--   MENU DE CONTEXTO -->
                        <div class="btn-group pull-right" role="group">
                            <a class="btn btn-default btn-sm btn btn-primary" href="<?php echo base_url('/marketing/pos_atendimento/pos_enviados'); ?>">
                                 <i class="fa fa-taxi"> </i> Realizadas
                            </a>
                        </div>
                        <!--   MENU DE CONTEXTO -->
                        <div class="btn-group pull-right" role="group">
                            <a class="btn btn-default btn-sm btn btn-secondary" href="<?php echo base_url('painel'); ?>">
                                <i class="fa fa-dashboard"></i> Dashboard
                            </a>
                        </div>
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
								<i class="fa fa-wrench"></i>Não Realizados
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse" data-original-title=""
									title=""> </a> <a href="" class="fullscreen"
									data-original-title="" title=""></a>
							</div>
						</div>
						<div class="portlet-body">
                            <table class="table datatable" id="sample_3">
                            	<thead>
                            		<th>Número OS</th>
                            		<th>Contrato</th>
                            		<th>Periodo</th>
                            		<th>Serviço</th>
                            		<th>Opções</th>
                            	</thead>
                            	<tbody>
                            		<?php foreach ($pos_atendimentos->result() as $atendimento): ?>
                            			<tr>
                            				<td>#<?php echo $atendimento->numero_os; ?></td>
                            				<td><?php echo $atendimento->codcli; ?></td>
                            				<td><?php echo $atendimento->periodo; ?></td>
                            				<td><?php echo $atendimento->descri_ords; ?></td>
                            				<td>
                            					
                            					<!-- Button trigger modal -->
												<button type="button" onclick="pegarValues(this.value)" value="<?php echo $atendimento->cod_servico; ?>" class="btn btn-primary btn-sm " data-toggle="modal" data-target="#modalPos">
												  Enviar
												</button>

                            				</td>
                            			</tr>
                            		<?php endforeach ?>
                            		
                            	</tbody>
                            </table>

                            <!-- Modal Pos -->
							<div class="modal fade" id="modalPos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							  <div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							        <h4 class="modal-title" id="myModalLabel">Enviar Pos Atendimento</h4>
							      </div>

							      <form action="" method="post">

							      	<div class="modal-body">

							      		<div class="form-group">
							      			<label>Antendimento</label>
							      			<select class="form-control" name="atendimento" required>
							      				<option value=""> Selecione...</option>
							      				<option value="Insatisfeito"> Insatisfeito</option>
							      				<option value="Satisfeito"> Satisfeito</option>
							      				<option value="Sem Contato"> Sem Contato</option>
							      			</select>
							      		</div>

							      		<div class="form-group">
							      			<label>Produto</label>
							      			<select class="form-control" name="produto">
							      				<option value=""> Selecione...</option>
							      				<option value="Insatisfeito"> Insatisfeito</option>
							      				<option value="Satisfeito"> Satisfeito</option>
							      				<option value="Sem Contato"> Sem Contato</option>
							      			</select>
							      		</div>

							      		<div class="form-group">
							      			<label>Classificação</label>
							      			<select class="form-control" name="classificacao" >
							      				<option value=""> Selecione...</option>
							      				<option value="otimo"> Ótimo</option>
							      				<option value="regular"> Regular</option>
							      				<option value="ruim"> Ruim</option>
							      			</select>
							      		</div>

							      		<div class="form-group">
							      			<label>Nota</label>
							      			<select class="form-control" name="nota" >
							      				<option value=""> Selecione...</option>
							      				<?php
							      					for ($i=0; $i <= 10; $i++) { 
							      						echo '<option value="'.$i.'">'.$i.'</option>';
							      					}
							      				?>
							      			</select>
							      		</div>

							      		<div class="form-group">
							      			<label>Motivo de Insatisfação</label>
							      			<select class="form-control" name="motivo_insatisfacao">
							      				<option value=""> Selecione...</option>
							      				<option value="Conexão Lenta">Conexão Lenta</option>
							      				<option value="Conexão Caindo">Conexão Caindo</option>
							      				<option value="Sem Conexão">Sem Conexão</option>
							      				<option value="Problema não resolvido">Problema não resolvido</option>
							      				<option value="Outros">Outros</option>

							      			</select>
							      		</div>



							      		<input type="hidden" name="cod_servico" class="form-control" id="conteudo" value="">
							      
							        
								      </div>
								      <div class="modal-footer">
								        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
								        <input type="submit" class="btn btn-primary pull-right" name="confirmar" value="Confirmar">
								      </div>

								    </form>

							    </div>
							  </div>
							</div>
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

    <script type="text/javascript">
          
          //VISUALIZAR CONTEUDO EM MODAL A PARTIR DE UM ID MYSQL
          var navegador = navigator.userAgent.toLowerCase(); //Cria e atribui à variável global 'navegador' (em caracteres minúsculos) o nome e a versão do navegador

          //Função que inicia o objeto XMLHttpRequest
          function objetoXML(){
           if (navegador.indexOf('msie') != -1) { //Internet Explorer
           var controle = (navegador.indexOf('msie 5') != -1) ? 'Microsoft.XMLHTTP' : 'Msxml2.XMLHTTP'; //Operador ternário que adiciona o objeto padrão do seu navegador (caso for o IE) à variável 'controle'
           try{
           return xmlhttp = new ActiveXObject(controle); //Inicia o objeto no IE
           }catch(e){}
           }else{ //Firefox, Safari, Outros..
           return xmlhttp = new XMLHttpRequest(); //Inicia o objeto no Firefox, Safari, Mozilla
           }
          }

          // Exibe os dados do usuário pelo ID que foi passado como parâmetro
          function pegarValues(id) {
            var url = id;
           document.getElementById('conteudo').value= url;
          }

        </script>

    <!-- END FOOTER -->
	</body>
</html>
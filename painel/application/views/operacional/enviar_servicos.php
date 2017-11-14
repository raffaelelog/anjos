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
					<i class="fa fa-arrow-circle-right" aria-hidden="true"></i> ENVIAR
					SERVIÇOS <small></small>
					
					<!--   MENU DE CONTEXTO -->
					<div class="btn-group pull-right" role="group">
						<a class="btn btn-default btn-sm btn btn-info"
							href="<?php echo base_url('index.php/operacional/servicos/receber_os_dia'); ?>" target="_blank">
							<i class="fa fa-refresh"> </i>
						</a>
					</div>

					<div class="btn-group pull-right" role="group">
						<a class="btn btn-default btn-sm btn btn-primary"
							href="<?php echo base_url('index.php/operacional/servicos/ordem_servico_enviadas'); ?>">
							<i class="fa fa-taxi"> </i> Serviços Enviados
						</a>
					</div>

					<div class="btn-group pull-right" role="group">
						<a class="btn btn-default btn-sm btn btn-secondary"
							href="<?php echo base_url('painel'); ?>"> <i
							class="fa fa-dashboard"></i> Dashboard
						</a>
					</div>
				</h1>
				<!-- Modal -->
				<div id="ver" class="modal fade" role="dialog">
					<div class="modal-dialog">
						<!-- Modal content-->
						<div class="modal-content">
							<!-- MODAL NOVO SERVICO -->
							<form method="post" action="">

								<div class="modal-body">
									<div id="conteudo"></div>
									<hr />
									<div class="form-gorup select_tec">
										<label> Técnico(s)
											<div class="btn btn-default btn-sm add" id="">
												<i class="fa fa-plus"></i>
											</div>
											<div class="btn btn-default btn-sm remove_tec" id="">
												<i class="fa fa-remove"></i>
											</div>
										</label> 
										<select name="tecnico[]"
											class="form-control tecnicos"
											style="margin-bottom: 5px; font-weight: bold;" required>
											<option value="">Selecione...</option>
                        				<?php foreach ( $tecnicos->result () as $tecnico ) { ?>
                            				<option value="<?php  echo $tecnico->cod_usuario; ?>"><?php  echo $tecnico->nome." (".$tecnico->unidade.") "; ?></option>
                        				<?php } ?>                        
                    					</select>
									</div>
									<hr />
									<div class="form-group  col-md-6">
										<label>Data para Realizar o Serviço</label> <input type="text"
											class="form-control datepicker" name="data_servico" required>
									</div>
									<div class="form-group  col-md-6">
										<label>Período</label> <select name="periodo"
											class="form-control">
											<option value="Indiferente">Indiferente</option>
											<option value="Manhã">Manhã</option>
											<option value="Tarde">Tarde</option>
											<option value="Sem Contato">Sem Contato</option>
											<option value="Não Agendado">Não Agendado</option>
										</select>
									</div>
								</div>
								<div class="modal-footer">
									<input type="hidden" name="data_cad_i"
										value="<?php echo set_value('data_cad_i'); ?>"> <input
										type="hidden" name="data_cad_f"
										value="<?php echo set_value('data_cad_i'); ?>">
									<button type="button" class="btn btn-default"
										data-dismiss="modal">Cancelar</button>
									<input type="submit" class="btn btn-primary"
										name="novo_servico" value="Confirmar">
								</div>
							</form>
							<!-- MODAL NOVO SERVICO -->
						</div>
					</div>
				</div>
				<!-- END MODAL -->
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
                        <div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-wrench"></i>Filtro de Data de Cadastro
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse" data-original-title=""
									title=""> </a> <a href="" class="fullscreen"
									data-original-title="" title=""></a>
							</div>
						</div>
						<div class="portlet-body">
							<form action="" method="post">
								<div class="form-group col-md-8">
									<label>Número da O.S.</label> <input type="text"
										name="numero_os" class="form-control"
										value="<?php echo set_value('numero_os'); ?>">
								</div>
								<div class="form-group col-md-4">
									<label style="color: #FFF"> Filtrar </label> <input
										type="submit" name="filtrar" class="btn btn-primary btn-block"
										value="Filtrar">
								</div>
							</form>
							<div class="clearfix"></div>
						</div>
					</div>
					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-wrench"></i>Ordens de Serviços
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse" data-original-title=""
									title=""> </a> <a href="" class="fullscreen"
									data-original-title="" title=""></a>
							</div>
						</div>
						<div class="portlet-body">                               
                                <?php if ($servicos) { ?>
                                <table class="table datatable">
								<thead>
									<th>Contrato</th>
									<th>Num. O.S.</th>
									<th>Bairro</th>
									<th>Status</th>
									<th>Serviço</th>
									<th>Data Agendada</th>
									<th>Técnicos</th>
									<th>Enviar</th>
								</thead>
								<tbody>
                                    <?php foreach ( $servicos->result () as $servico ) { ?>
                                        <tr>
										<td><?php echo $servico->codcli; ?></td>
										<td>#<?php echo $servico->numero_os; ?></td>
										<td><?php echo $servico->bairro.' <span class="text-warning">' .$servico->cidade.'</span>'; ?></td>
										<td><?php echo $servico->status_os; ?></td>
										<td><?php echo $servico->descri_ords; ?></td>
										<td class="text-danger">
											<strong><?php if($servico->data_servico==''){echo 'NÃO AGENDADA';}else{echo $servico->data_servico;} ?></strong>
										</td>
										<td class="text-danger">
											<strong><?php if($servico->tecnicos==''){echo 'SEM TÉCNICOS';}else{echo $servico->tecnicos;} ?></strong>
										</td>
										<td>
											<a href="<?php echo base_url('index.php/operacional/servicos/servico/').$servico->cod_servico; ?>" class="btn btn-info btn-xs btn-block">Abrir</a>
										</td>
									</tr>
                                    <?php } ?>
                                    </tbody>
							</table>
                            <?php } ?>
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
          function mostrarOs(id) {
           xmlhttp=objetoXML();
           if (xmlhttp==null) {
           alert ("Seu navegador não suporta AJAX!");
           return;
           }
           var url="<?php echo base_url('index.php/operacional/servicos/form_enviar_servico') ?>";
           url=url+"?numero_os="+id;
           xmlhttp.onreadystatechange=function() {
           if (xmlhttp.readyState==4 || xmlhttp.readyState=="complete") {
           document.getElementById('conteudo').innerHTML=xmlhttp.responseText;
           }
           }
           xmlhttp.open("GET",url,true);
           xmlhttp.send(null);
          }

        </script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
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
	<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
	<script>
            $(document).ready(function() {
                $('.datatable').DataTable({
                    "language" : {
                        "lengthMenu" : "Mostrar _MENU_ registros por página",
                        "loadingRecords" : "Carregando...",
                        "processing" : "Processando...",
                        "search" : "Buscar:",
                        "zeroRecords" : "Nenhum registro encontrado",
                        "info" : "Página _PAGE_ de _PAGES_",
                        "infoEmpty" : "Não há registros disponíveis",
                        "infoFiltered" : "(Filtro _MAX_ dos registros)",
                        "paginate" : {
                            "first" : "Primeira",
                            "last" : "Ultima",
                            "next" : "Próximo",
                            "previous" : "Anterior",
                        },
                    }
                });
            }); 
        </script>
	<script type="text/javascript">
            // For demo to fit into DataTables site builder...
            $('.datatable').removeClass('display').addClass('table'); 
    </script>
	<script type="text/javascript">
          $(document).ready(function () {

              $(".add").click(function () {
                      $(".tecnicos:last").clone().appendTo(".select_tec");
              });

              $(".select_tec").on('click', '.remove_tec', function () {
                      $(".tecnicos:last").remove();
              });
          })
    </script>
	<!-- END FOOTER -->
</body>
</html>
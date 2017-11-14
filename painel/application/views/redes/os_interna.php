<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
    <?php $this->load->view('layout/head'); ?>
    <!-- END HEAD -->
<body
	class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid topage-sidebar-closed page-sidebar-closed">
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
					<i class="fa fa-archive"> </i> OS's Internas <small></small>
					<!--   MENU DE CONTEXTO -->
					<div class="btn-group pull-right" role="group">
						<a class="btn btn-default btn-sm btn btn-secondary"
							href="<?php echo base_url('painel'); ?>"> <i
							class="fa fa-dashboard"></i> Dashboard
						</a> <a class="btn btn-default btn-sm btn btn-secondary"
							data-toggle="modal" data-target="#cadastroOsInterna" href="#"> <i
							class="fa fa-plus-circle"></i> Cadastrar OS
						</a>
					</div>
				</h1>
				<!-- Modal Cadastrar OS -->
				<div class="modal fade" id="cadastroOsInterna" tabindex="-1"
					role="dialog" aria-labelledby="myModalLabel">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal"
									aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								<h4 class="modal-title" id="myModalLabel">Cadastrar Nova Caixa</h4>
							</div>
							<form action="" method="post">
								<div class="modal-body">

									<div class="form-group col-md-6">
										<label>Cidade</label> <select name="cod_cidade"
											class="form-control" required>
											<option value="">Selecione...</option>
                                       <?php foreach ($cidades_os->result() as $cidade): ?>
                                         <option
												value="<?php echo $cidade->cidade; ?>"><?php echo $cidade->nome_cid; ?></option>
                                       <?php endforeach ?>
                                   </select>
									</div>

									<div class="form-group col-md-6">
										<label>Bairro</label> <input type="text" name="bairro"
											class="form-control" required>
									</div>

									<div class="form-group col-md-12">
										<label>Tipo de Serviço</label> <select
											name="cod_tipo_os_interna" class="form-control" required>
											<option value="">Selecione...</option>
                                       <?php foreach ($tipo_os_interna->result() as $tipo): ?>
                                         <option
												value="<?php echo $tipo->cod_tipo_os_interna; ?>"><?php echo $tipo->descricao; ?></option>
                                       <?php endforeach ?>
                                   </select>
									</div>

									<div class="form-group col-md-6">
										<label>Solicitante</label> <select name="solicitante"
											class="form-control" required>
											<option value="">Selecione...</option>
                                       <?php foreach ($solicitantes->result() as $solicitante): ?>
                                         <option
												value="<?php echo $solicitante->cod_usuario; ?>"><?php echo $solicitante->nome; ?></option>
                                       <?php endforeach ?>
                                   </select>
									</div>

									<div class="form-group col-md-6">
										<label>Data</label> <input type="text" name="data"
											class="form-control  datepicker" readonly="readonly" required>
									</div>

									<div class="form-group col-md-6">
										<label>Hora Inicial</label> <input type="text" maxlength="5"
											name="hora_inicial" onkeyup="maskIt(this,event,'##:##')" onkeypress="maskIt(this,event,'##:##')"
											class="form-control" required>
									</div>

									<div class="form-group col-md-6">
										<label>Hora Final</label> <input type="text" name="hora_final" maxlength="5"
											onkeyup="maskIt(this,event,'##:##')" class="form-control" onkeypress="maskIt(this,event,'##:##')"
											required>
									</div>

									<div class="form-group col-md-6">
										<label>Hora deslocamento Inicial</label> <input type="text" maxlength="5"
											name="hora_inicial_desl" onkeyup="maskIt(this,event,'##:##')" onkeypress="maskIt(this,event,'##:##')"
											class="form-control" required>
									</div>

									<div class="form-group col-md-6">
										<label>Hora Final do Deslocamento</label> <input type="text" maxlength="5"
											name="hora_final_desl" onkeyup="maskIt(this,event,'##:##')" onkeypress="maskIt(this,event,'##:##')"
											class="form-control" required>
									</div>

									<div class="form-gorup select_tec">
										<label> Técnico(s)
											<div class="btn btn-default btn-sm add" id="">
												<i class="fa fa-plus"></i>
											</div>
											<div class="btn btn-default btn-sm remove_tec" id="">
												<i class="fa fa-remove"></i>
											</div>
										</label> <select name="tecnico[]"
											class="form-control tecnicos"
											style="margin-bottom: 5px; font-weight: bold;" required>
											<option value="">Selecione...</option>
                                              <?php foreach ( $tecnicos_os_interna->result () as $tecnico ) { ?>
                                                  <option
												value="<?php  echo $tecnico->cod_usuario; ?>"><?php  echo $tecnico->nome; ?></option>
                                              <?php } ?>                        
                                  </select>
									</div>

									<hr>


									<div class="col-md-12">
										<label>Observações</label>
										<textarea name="obs" class="form-control"></textarea>
									</div>
								</div>
								<div class="clearfix"></div>
								<hr>
								<div class="modal-footer">
									<button type="button" class="btn btn-default pull-left"
										data-dismiss="modal">Cancelar</button>
									<input type="submit" class="btn btn-primary" name="cadastrar"
										value="Cadastrar">

								</div>
							</form>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
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
                        <?php
																								}
																								?>
                        <div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-wrench"></i>Filtro de Data Agendamento
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse" data-original-title=""
									title=""> </a> <a href="" class="fullscreen"
									data-original-title="" title=""></a>
							</div>
						</div>
						<div class="portlet-body">
							<form action="" method="post">
								<div class="form-group col-md-4">
									<label>Data Inicial</label> <input type="text" name="data_ini"
										class="form-control datepicker"
										value="<?php echo set_value('data_ini'); ?>"
										readonly="readonly">
								</div>
								<div class="form-group col-md-4">
									<label>Data Final</label> <input type="text" name="data_fim"
										class="form-control datepicker"
										value="<?php echo set_value('data_fim'); ?>"
										readonly="readonly">
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
					<!-- Caixas Cadastradas -->
					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-wrench"></i>OS's Enviadas
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
									<th>Data do Serviço</th>
									<th>Cidade</th>
									<th>Bairro</th>
									<th>Solicitante</th>
									<th>Tecnico(s)</th>
									<th>Obs.</th>
									<th>Deslocamento</th>
									<th>Tempo Desloc.</th>
									<th>Hora Serviço</th>
									<th>Tempo H. Serviço</th>
									<th>Tipo de Serviço</th>
								</thead>
								<tbody>
                                        <?php if ($os_interna) foreach ($os_interna->result() as $os): ?>
                                    <tr>
                                        <td><?php echo date('d-m-Y',strtotime($os->data)); ?></td>
										<td><?php echo $os->cidade; ?></td>
										<td><?php echo $os->bairro; ?></td>
										<td><?php echo $os->solicitante; ?></td>
										<td><?php echo $os->tecnicos; ?></td>
										<td><?php echo $os->obs; ?></td>
										<td><?php echo $os->hora_inicial_desl." a ".$os->hora_final_desl; ?></td>
										<td><?php echo difDeHoras($os->hora_inicial_desl, $os->hora_final_desl);?></td>
										<td><?php echo $os->hora_inicial." a ".$os->hora_final; ?></td>
										<td><?php echo difDeHoras($os->hora_inicial, $os->hora_final); ?></td>
										<td><?php echo $os->descricao; ?></td>
									</tr>
                                        <?php endforeach ?>
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
    <!-- Função para datepicker jquery UI -->
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
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
	<!-- Função para add ou remover técnico da OS -->
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
    <?php
		function difDeHoras($hIni, $hFinal)
		{        
		    // Separa á hora dos minutos
		    $hIni = explode(':', $hIni);
		    $hFinal = explode(':', $hFinal);
		    // Converte a hora e minuto para segundos
		    $hIni = (60 * 60 * $hIni[0]) + (60 * $hIni[1]);
		    $hFinal = (60 * 60 * $hFinal[0]) + (60 * $hFinal[1]);
		    
		    // Verifica se a hora final é maior que a inicial
		    if(!($hIni < $hFinal)) {
		        return false;
		    }
		    // Calcula diferença de horas
		    $difDeHora = $hFinal - $hIni;
		    //Converte os segundos para Hora e Minuto
		    $tempo = $difDeHora / (60 * 60);
		    $tempo = explode('.', $tempo); // Aqui divide o restante da hora, pois se não for inteiro, retornará um decimal, o minuto, será o valor depois do ponto.
		    $hora = $tempo[0];
		    @$minutos = (float) (0) . '.' . $tempo[1]; // Aqui forçamos a conversão para float, para não ter erro.
		    $minutos = $minutos * 60; // Aqui multiplicamos o valor que sobra que é menor que 1, por 60, assim ele retornará o minuto corretamente, entre 0 á 59 minutos.
		    $minutos = explode('.', $minutos); // Aqui damos explode para retornar somente o valor inteiro do minuto. O que sobra será os segundos
		    $minutos = $minutos[0];
		    //Aqui faz uma verificação, para retornar corretamente as horas, mas se não quiser, só mandar retornar a variavel hora e minutos
		    if (!(isset($tempo[1]))) {
		        if($hora == 1){
		            return $hora . ' Hora';
		        } else {
		            return $hora . ' Horas';
		        }
		    } else {
		        if($hora == 1){
		            if($minutos == 1){
		                return $hora . ' Hora e ' .$minutos . ' Minuto';
		            } else {
		                return $hora . ' Hora e ' .$minutos . ' Minutos';
		            }
		        } else {
		            if($minutos == 1){
		                return $hora . ' Horas e ' .$minutos . ' Minuto';
		            } else {
		                return $hora . ' Horas e ' .$minutos . ' Minutos';
		            }
		        }
		    }
		}?>
	<!-- END FOOTER -->
</body>
</html>
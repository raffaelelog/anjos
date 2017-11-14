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
					<i class="fa fa-arrow-circle-right" aria-hidden="true"></i> RETRABALHO <small></small>
					<div class="btn-group pull-right" role="group">
						<a class="btn btn-default btn-sm btn btn-secondary"
							href="<?php echo base_url('painel'); ?>"> <i
							class="fa fa-dashboard"></i> Dashboard
						</a>
					</div>
				</h1>
				
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
                <i class="fa fa-wrench"></i>Filtro
              </div>
              <div class="tools">
                <a href="javascript:;" class="collapse" data-original-title=""
                  title=""> </a> <a href="" class="fullscreen"
                  data-original-title="" title=""></a>
              </div>
            </div>
            <div class="portlet-body">                               
              <form action="" method="post" id="form" onsubmit="$('.portlet').css('display','none');$('#gif').css('display','block');"">

                <div class="form-group col-md-4">
                  <input type="text" name="data_i" class="form-control datepicker" value="<?php echo set_value('data_i'); ?>" placeholder="Data Inicial" readonly="readonly" required>
                </div>

                <div class="form-group col-md-4">
                  <input type="text" name="data_f" class="form-control datepicker" value="<?php echo set_value('data_f'); ?>" placeholder="Data Final" readonly="readonly" required>
                </div>

                <div class="form-group col-md-4">
                  <input type="submit" name="filtrar" class="btn btn-primary btn-block"  value="Filtrar">
                </div>

              </form>
              <div class="clearfix"></div>
            </div>
          </div>


          <!-- Gif de  loading apos aplicar um filtro -->
          <div id="gif" align="center" style="display: none;">
                  
            <img src="<?php echo base_url('assets/img/').'loading.gif'; ?>" style="max-height: 85px;">
            <h4>Aguarde, isso pode demorar um pouco. </h4>

          </div>


					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-wrench"></i>Ordens de Serviço
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse" data-original-title=""
									title=""> </a> <a href="" class="fullscreen"
									data-original-title="" title=""></a>
							</div>
						</div>
						<div class="portlet-body">                               
              <table class="table table-striped table-hover" id="sample_3" >
                <thead>
                  <th>Contrato</th>
                  <th>Data do Serviço</th> 
                  <th>Serviço Realizado</th>
                  <th>Status</th>
                  <th>Obs</th>
                  <th>Marcar Retrabalho</th>
                </thead>
                <tbody>
                  <?php foreach ($lista_retrabalho->result() as $retrabalho): ?>
                    <tr <?php if($retrabalho->retrabalho == 1){ echo 'class="text-danger"'; } ?> >
                      <td><?php echo $retrabalho->codcli; ?></td>
                      <td><?php echo $retrabalho->data_servico; ?></td>
                      <td><?php echo $retrabalho->descri_ords; ?></td>
                      <td><?php echo $retrabalho->status_os; ?></td>
                      <td><?php echo $retrabalho->obs; ?></td>
                      <td>
                      <form action="" method="post">
                        <input type="hidden" name="cod_servico" value="<?php echo $retrabalho->cod_servico; ?>">
                        <input type="hidden" name="data_i" value="<?php echo set_value('data_i'); ?>">
                        <input type="hidden" name="data_f" value="<?php echo set_value('data_f'); ?>">
                        <input type="hidden" name="filtrar" value="Filtrar">
                        <input type="submit" class="btn btn-danger btn-xs btn-block" name="marcar" value="Marcar">
                      </form>
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
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script>
            $(function() {
                $( ".datepicker" ).datepicker();
            });
            $( ".datepicker" ).datepicker({ 
                dateFormat: "yy-mm-dd",
				changeMonth: true,
        		changeYear: true,
                dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
                dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
                dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
                monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
                monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
                nextText: 'Próximo',
                prevText: 'Anterior'
            });
   	</script>
	
	<!-- END FOOTER -->
</body>
</html>
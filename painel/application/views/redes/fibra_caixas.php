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
        <div class="clearfix"> </div>
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
                    <h1 class="page-title"><i class="fa fa-archive"> </i>  Caixas
                        <small></small>
                        <!--   MENU DE CONTEXTO -->
                        <div class="btn-group pull-right" role="group">                      
                            <a class="btn btn-default btn-sm btn btn-secondary" href="<?php echo base_url('painel'); ?>">
                                <i class="fa fa-dashboard"></i> Dashboard
                            </a>
                            <a class="btn btn-default btn-sm btn btn-secondary" data-toggle="modal" data-target="#cadastroCaixa" href="#">
                                <i class="fa fa-plus-circle"></i> Cadastrar Caixa
                            </a>
                        </div>
                    </h1>
                    <!-- Modal Cadastrar Caixa -->
                    <div class="modal fade" id="cadastroCaixa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Cadastrar Nova Caixa</h4>
                          </div>
                        <form action="" method="post">
                        <div class="modal-body">                        
                                <div class="form-group col-md-4">
                                   <label>Tipo de Caixa</label>
                                   <select name="tipo" class="form-control" required>
                                       <option value="">Selecione...</option>
                                       <option value="C">Conectorizada</option>
                                       <option value="D">Derivação</option>
                                   </select>
                                </div>
                                <div class="form-group col-md-4">
                                   <label>Complemento</label>
                                   <select name="complemento" class="form-control">
                                       <option value="">Selecione...</option>
                                       <option value="-A">Caixa A</option>
                                       <option value="-B">Caixa B</option>
                                       <option value="-C">Caixa C</option>
                                   </select>
                                </div>
                                <div class="form-group col-md-4">
                                   <label>Rede</label>
                                   <select name="rede" class="form-control" required>
                                       <option value="">Selecione...</option>
                                       <option value="EPON">EPON</option>
                                       <option value="GPON">GPON</option>
                                   </select>
                                </div>

                                <div class="col-md-12">
                                  <label>Código <small class="text-danger">Só preencha se for código novo sem cep</small></label>
                                  <input type="text" name="codigo" class="form-control" >
                                </div>

                                <div class="form-group col-md-12">
                                      <label>Central</label>
                                      <select name="cod_central" class="form-control" required>
                                         <option value="">Selecione...</option>
                                          <?php
                                            foreach ($centrais->result() as $central) {
                                          ?>                                           
                                         <option value="<?php echo $central->cod_central; ?>"><?php echo $central->descricao; ?></option>
                                          <?php
                                            }
                                          ?>
                                      </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>CEP</label>
                                    <input type="text" class="form-control"  onkeyup="maskIt(this,event,'#####-###')"  name="cep">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Total de Portas</label>
                                    <input type="text" class="form-control" name="num_portas_total">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Portas Disponíveis</label>
                                    <input type="text" class="form-control" name="num_portas_disponiveis">
                                </div>
                                <div class="form-group col-md-10 col-sm-12">
                                    <label>Lugradouro <small style="color: #CCC">Ex.: Rua A, Av. 123</small></label>
                                    <input type="text" class="form-control" name="endereco">
                                </div>
                                <div class="form-group col-md-2 col-sm-12">
                                    <label>Num.</label>
                                    <input type="text" class="form-control" onkeyup="maskIt(this,event,'########')" name="numero">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Bairro</label>
                                    <input type="text" class="form-control" name="bairro">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Cidade</label>
                                    <input type="text" class="form-control" name="cidade">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Latitude</label>
                                    <input type="text" class="form-control" name="latitude">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Longitude</label>
                                    <input type="text" class="form-control" name="longitude">
                                </div>
                                <div class="col-md-12">
                                    <label>Observações</label>
                                    <textarea name="obs" class="form-control"></textarea>
                                </div>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                            <input type="submit" class="btn btn-primary" name="cadastrar" value="Cadastrar">
                            
                         </div>
                        </form>
                        <div class="clearfix"></div>
                        </div>
                      </div>
                    </div>
                    <!-- END PAGE HEADER--> 
                    <div class="row">
                        <?php if($alerta != null){ ?>
                            <div class="alert alert-<?php echo $alerta['class']; ?>">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <?php echo $alerta['mensagem']; ?>
                            </div>
                        <?php 
                        }
                        ?>
                        <!-- Caixas Cadastradas -->
                        <div class="portlet light"> 
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-wrench"></i>Caixas Cadastradas </div>
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
                                        <th>Código</th>
                                        <th>Total de Portal</th>
                                        <th>Portas Disponíveis</th>
                                        <th>Bairro</th>
                                        <th>Cidade</th>
                                        <th>Editar</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach ($caixas->result() as $caixa) {
                                        ?>
                                        <tr>
                                            <td><?php echo $caixa->codigo; ?></td>
                                            <td><?php echo $caixa->num_portas_total; ?></td>
                                            <td><?php echo $caixa->num_portas_disponiveis; ?></td>
                                            <td><?php echo $caixa->bairro; ?></td>
                                            <td><?php echo $caixa->cidade; ?></td>
                                            <td>
                                                <button href="#" value="<?php echo $caixa->cod_caixa; ?>" onclick="mostraCaixa(this.value)" class="btn btn-primary btn-sm btn-block"  data-toggle="modal" data-target="#editarCaixa">Editar</button>
                                            </td>
                                        </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                                <!-- Modal Editar Caixa -->
                                <div class="modal fade" id="editarCaixa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div id="conteudo"></div>
                                    </div>
                                  </div>
                                </div>
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
          function mostraCaixa(id) {
           xmlhttp=objetoXML();
           if (xmlhttp==null) {
           alert ("Seu navegador não suporta AJAX!");
           return;
           }

           var url="<?php echo base_url('index.php/redes/redes/mostraCaixa') ?>";
           url=url+"?cod_caixa="+id;
           xmlhttp.onreadystatechange=function() {
           if (xmlhttp.readyState==4 || xmlhttp.readyState=="complete") {
           document.getElementById('conteudo').innerHTML=xmlhttp.responseText;
           }
           }
           xmlhttp.open("GET",url,true);
           xmlhttp.send(null);
          }
        </script>       
        <script>
            //MASCARA PARA DATA, HORA E OUTROS        
            function maskIt(w,e,m,r,a){            
            // Cancela se o evento for Backspace
            if (!e) var e = window.event
            if (e.keyCode) code = e.keyCode;
            else if (e.which) code = e.which;          
            // Variáveis da função
            var txt  = (!r) ? w.value.replace(/[^\d]+/gi,'') : w.value.replace(/[^\d]+/gi,'').reverse();
            var mask = (!r) ? m : m.reverse();
            var pre  = (a ) ? a.pre : "";
            var pos  = (a ) ? a.pos : "";
            var ret  = "";
            if(code == 9 || code == 8 || txt.length == mask.replace(/[^#]+/g,'').length) return false;
            // Loop na máscara para aplicar os caracteres
            for(var x=0,y=0, z=mask.length;x<z && y<txt.length;){
                    if(mask.charAt(x)!='#'){
                            ret += mask.charAt(x); x++;
                    } else{
                            ret += txt.charAt(y); y++; x++;
                    }
            }            
            // Retorno da função
            ret = (!r) ? ret : ret.reverse()        
            w.value = pre+ret+pos;
            }
            // Novo método para o objeto 'String'
            String.prototype.reverse = function(){
            return this.split('').reverse().join('');
            };
        </script>
        <!-- END FOOTER -->
    </body>
</html>
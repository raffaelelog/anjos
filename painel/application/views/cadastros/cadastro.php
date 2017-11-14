
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
                    <h1 class="page-title"> CADASTRO
                        <div class="btn-group pull-right" role="group">
                            <!-- Large modal -->
                            <a type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editarCadastro"><i class="fa fa-edit"></i> Editar</a>
                            <!-- Fatura Recorrente -->
                            <a type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#faturaRecorrente">Add Fatura Recorrente</a>
                        </div>
                    </h1>

                    <!-- Modal Fatura Recorrente -->
                    <div id="faturaRecorrente" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Fatura Recorrente</h4>
                          </div>
                          <div class="modal-body">
                            
                            <form action="" method="post">
                                <div class="form-group">
                                    <label>Dia Recebimento</label>
                                    <input type="text" name="dia_vencimento" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label>Valor</label>
                                    <input type="text" name="valor" onkeyup="maskIt(this, event, '####.##', true)" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <input type="submit" class="form-control btn btn-block btn-primary" name="fatura_recorrente" value="Cadastrar">
                                </div>


                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                              </div>

                            </form>


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

                                <!-- DADOS CADASTRAIS INICIO -->
                                <div class="portlet light">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-filter"></i>DADOS CADASTRAIS
                                        </div>
                                        <div class="tools">
                                            <a href="javascript:;" class="collapse" data-original-title=""
                                                title=""> </a> <a href="" class="fullscreen"
                                                data-original-title="" title=""></a>
                                        </div>
                                    </div>

                                        
                                    <div class="portlet-body">
                                        
                                            <div class="modal-body">

                                                <?php foreach ($cadastro->result() as $cad): ?>
                                                    <ul class="list-group">
                                                      <li class="list-group-item"><strong>Nome: </strong><?php echo $cad->nome; ?></li>
                                                      <li class="list-group-item"><strong>Endereço: </strong><?php echo $cad->endereco." ".$cad->bairro." ".$cad->cidade."/".$cad->estado; ?></li>
                                                      <li class="list-group-item"><strong>Contatos: </strong><?php echo $cad->telefone." - ".$cad->celular; ?></li>
                                                    </ul>


                                                    <!-- Modal -->
                                                    <div id="editarCadastro" class="modal fade" role="dialog">
                                                      <div class="modal-dialog">

                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title">Editar Cadastro</h4>
                                                          </div>
                                                          <div class="modal-body">

                                                            <form action="" method="post">

                                                                <div class="form-group">
                                                                    <label>Nome Completo</label>
                                                                    <input type="text" name="nome" value="<?php echo $cad->nome; ?>"  class="form-control" required="required">
                                                                </div>

                                                                <div class="form-group col-md-6">
                                                                    <label>Telefone</label>
                                                                    <input type="text" value="<?php echo $cad->telefone; ?>"  name="telefone" class="form-control">
                                                                </div>

                                                                <div class="form-group col-md-6">
                                                                    <label>Celular</label>
                                                                    <input type="text" value="<?php echo $cad->celular; ?>"  name="celular" class="form-control">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Endereço</label>
                                                                    <input type="text" name="endereco" value="<?php echo $cad->endereco; ?>"  class="form-control" required="required">
                                                                </div>

                                                                <div class="form-group col-md-6">
                                                                    <label>Número</label>
                                                                    <input type="text" name="numero" value="<?php echo $cad->numero; ?>"  class="form-control" required="required">
                                                                </div>

                                                                <div class="form-group col-md-6">
                                                                    <label>Complemento</label>
                                                                    <input type="text" name="complemento" value="<?php echo $cad->complemento; ?>"  class="form-control">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Referência</label>
                                                                    <input type="text" name="referencia" value="<?php echo $cad->referencia; ?>"  class="form-control">
                                                                </div>

                                                                <div class="form-group col-md-6">
                                                                    <label>Bairro</label>
                                                                    <input type="text" name="bairro" value="<?php echo $cad->bairro; ?>"  class="form-control" required="required">
                                                                </div>

                                                                <div class="form-group col-md-6">
                                                                    <label>Cidade</label>
                                                                    <input type="text" name="cidade" value="<?php echo $cad->cidade; ?>"  class="form-control" required="required">
                                                                </div>

                                                                <div class="form-group col-md-6">
                                                                    <label>Estado</label>
                                                                    <input type="text" name="estado" value="<?php echo $cad->estado; ?>"  value="MINAS GERAIS" class="form-control">
                                                                </div>

                                                                <div class="form-group col-md-6">
                                                                    <label>CEP</label>
                                                                    <input type="text" name="cep" value="<?php echo $cad->cep; ?>"  class="form-control">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Obs.</label>
                                                                    <textarea name="obs" value="<?php echo $cad->obs; ?>"  class="form-control"></textarea>
                                                                </div>

                                                                <div class="form-group">
                                                                    <input type="submit" class="btn btn-sm btn-block btn-primary" name="atualizar" value="Atualizar">
                                                                </div>
                                                            </form>

                                                          </div>
                                                          <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                                          </div>
                                                        </div>

                                                      </div>
                                                    </div>
                                        <?php endforeach ?>
                                        <!-- Trigger the modal with a button -->
                                            
                                    </div>
                                    <div class="clearfix"></div>
                                    <!-- Final do portlet-body -->
                                </div>
                                <!-- DADOS CADASTRAIS FIM -->
                        
                    </div>
                    <!-- END ROW --> 


                    <div class="container">
                        <!-- END PAGE HEADER--> 
                        <div class="row">
                                    <!-- DADOS CADASTRAIS INICIO -->
                                    <div class="portlet light">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-money"></i>FATURAS 
                                                <!-- Trigger the modal with a button -->
                                                <a type="button" class="" data-toggle="modal" data-target="#novaFatura">
                                                    <i class="fa fa-plus-circle"></i>
                                                </a>
                                            </div>
                                            <div class="tools">
                                                <a href="javascript:;" class="collapse" data-original-title=""
                                                    title=""> </a> <a href="" class="fullscreen"
                                                    data-original-title="" title=""></a>
                                            </div>
                                        </div>

                                        <div class="portlet-body">

                                            <table class="table table-striped" id="sample_3">
                                                <thead>
                                                    <th>Código</th>
                                                    <th>Data Emissão</th>
                                                    <th>Data Recebimento</th>
                                                    <th>Status</th>
                                                    <th>Valor</th>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($faturas_cadastro->result() as $fatura): ?>
                                                    <tr>
                                                        <td><?php echo $fatura->cod_fatura; ?></td>
                                                        <td><?php echo data_ptbr($fatura->data_emissao); ?></td>
                                                        <td><?php echo data_ptbr($fatura->data_vencimento); ?></td>
                                                        <td><?php echo $fatura->descricao; ?></td>
                                                        <td><?php echo $fatura->valor; ?></td>
                                                    </tr>
                                                    <?php endforeach ?>
                                                </tbody>
                                            </table>

                                            <!-- Modal nova fatura -->
                                            <div id="novaFatura" class="modal fade" role="dialog">
                                              <div class="modal-dialog">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Criar Fatura</h4>
                                                  </div>
                                                    <form action="" method="post">
                                                      <div class="modal-body">
                                                        
                                                        <div class="form-group">
                                                            <label>Data Recebimento</label>
                                                            <input type="text" name="data_vencimento" class="form-control datepicker" readonly="readonly" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Valor</label>
                                                            <input type="text" name="valor" onkeyup="maskIt(this, event, '####.##', true)" class="form-control" required>
                                                        </div>

                                                      </div>
                                                      <div class="modal-footer">
                                                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                                                        <input type="submit" class="btn btn-primary pull-right" name="cadastrar_fatura" value="Cadastrar">
                                                      </div>
                                                    </form>



                                                </div>

                                              </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- DADOS CADASTRAIS FIM -->
                        </div>
                        <!-- END ROW --> 
                    </div>

                    <div class="container">
                        <!-- END PAGE HEADER--> 
                        <div class="row">
                                    <!-- DADOS CADASTRAIS INICIO -->
                                    <div class="portlet light">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-money"></i>FATURA RECORRENTE 
                                                <!-- Trigger the modal with a button -->
                                                <a type="button" class="" data-toggle="modal" data-target="#faturaRecorrente">
                                                    <i class="fa fa-plus-circle"></i>
                                                </a>
                                            </div>
                                            <div class="tools">
                                                <a href="javascript:;" class="collapse" data-original-title=""
                                                    title=""> </a> <a href="" class="fullscreen"
                                                    data-original-title="" title=""></a>
                                            </div>
                                        </div>

                                        <div class="portlet-body">

                                            <?php foreach ($fatura_recorrente->result() as $fat): ?>
                                                
                                                <div class="col-md-12">
                                                        <form action="" method="post">

                                                        <div class=" form-gorup col-md-4">
                                                            <input type="text" class="form-control" name="dia_vencimento" value="<?php echo $fat->dia_vencimento; ?>" readonly="readonly">
                                                        </div>

                                                        <div class=" form-gorup col-md-4">
                                                            <input type="text" class="form-control" name="valor" value="<?php echo $fat->valor; ?>" readonly="readonly">
                                                        </div>

                                                        <div class=" form-gorup col-md-4">
                                                            <input type="hidden" name="cod_fatura_recorrente" value="<?php echo $fat->cod_fatura_recorrente; ?>">
                                                            <input type="submit" name="excluir_fatura_recorrente" class="btn btn-sm btn-danger btn-block" value="Excluir"> 
                                                        </div>

                                                    </form>
                                                    <hr>
                                                </div>

                                            <?php endforeach ?>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                    <!-- DADOS CADASTRAIS FIM -->
                        </div>
                        <!-- END ROW --> 
                    </div>


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


        <?php $this->load->view('layout/footer'); ?>
        <!-- END FOOTER -->
    </body>
</html>
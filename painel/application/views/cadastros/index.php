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
                    <h1 class="page-title"> CADASTROS
                        <div class="btn-group pull-right" role="group">
                            <!-- Large modal -->
                            <button type="button" class="btn btn-default btn-sm"
                                data-toggle="modal" data-target="#cadastrar">
                                <i class="fa fa-plus-square"></i> Cadastrar
                            </button>
                        </div>
                    </h1>


                    <!-- Modal -->
                            <div class="modal fade" id="cadastrar" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Cadastrar Novo</h4>
                                        </div>
                                        <form action="" method="post">
                                            <div class="modal-body">

                                                    <div class="form-group">
                                                        <label>Nome Completo</label>
                                                        <input type="text" name="nome" class="form-control" required="required">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label>Telefone</label>
                                                        <input type="text" name="telefone" class="form-control">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label>Celular</label>
                                                        <input type="text" name="celular" class="form-control">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Endereço</label>
                                                        <input type="text" name="endereco" class="form-control" required="required">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label>Número</label>
                                                        <input type="text" name="numero" class="form-control" required="required">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label>Complemento</label>
                                                        <input type="text" name="complemento" class="form-control">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Referência</label>
                                                        <input type="text" name="referencia" class="form-control">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label>Bairro</label>
                                                        <input type="text" name="bairro" class="form-control" required="required">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label>Cidade</label>
                                                        <input type="text" name="cidade" class="form-control" required="required">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label>Estado</label>
                                                        <input type="text" name="estado" value="MINAS GERAIS" class="form-control">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label>CEP</label>
                                                        <input type="text" name="cep" class="form-control">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Obs.</label>
                                                        <textarea name="obs" class="form-control"></textarea>
                                                    </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>
                                                <input type="submit" class="btn btn-primary pull-right" name="cadastrar" value="Cadastrar">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!--  END MODAL -->



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


                                <div class="portlet light">
                                	<div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-filter"></i>Busca por Nome ou Telefone
                                        </div>
                                        <div class="tools">
                                            <a href="javascript:;" class="collapse" data-original-title=""
                                                title=""> </a> <a href="" class="fullscreen"
                                                data-original-title="" title=""></a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                    	<form action="" method="post">
                                    		<div class="form-group col-md-10 col-sm-12">
	                                    		<label>Digite nome ou telefone</label> 
	                                    		<input type="text" name="busca" class="form-control" placeholder="Digite o nome ou telefone" required>
	                                    	</div>
	                                    	<div class="form-group col-md-2 col-sm-12">
	                                    		<label>&nbsp;&nbsp;&nbsp;</label>
	                                    		<input type="submit" class="btn btn-primary btn-block" name="buscar" value="Buscar">
	                                    	</div>
                                    	</form>
                                    	<div class="clearfix"></div>
                                    </div>
                                </div><!-- Fim Portable -->

                                <div class="portlet light">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-filter"></i>Cadastros
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
                                        <table class="table table-striped" id="sample_3">
                                            <thead>
                                                <th>Nome</th>
                                                <th>Telefone</th>
                                                <th>Celular</th>
                                                <th>Endereço</th>
                                                <th>Bairro</th>
                                                <th>Cidade</th>
                                                <th>Opções</th>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($cadastros->result() as $cadastro): ?>
                                                    
                                                    <tr>
                                                        <td><?php echo $cadastro->nome; ?></td>
                                                        <td><?php echo $cadastro->telefone; ?></td>
                                                        <td><?php echo $cadastro->celular; ?></td>
                                                        <td><?php echo $cadastro->endereco." ".$cadastro->numero; ?></td>
                                                        <td><?php echo $cadastro->bairro; ?></td>
                                                        <td><?php echo $cadastro->cidade; ?></td>
                                                        <td><a href="<?php echo base_url('cadastros/cadastro/').$cadastro->cod_cadastro; ?>" class="btn btn-primary btn-sm">Abrir</a></td>
                                                    </tr>

                                                <?php endforeach ?>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="clearfix"></div>
                                    <!-- Final do portlet-body -->
                                </div>

                            <div class="clearfix"></div>
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
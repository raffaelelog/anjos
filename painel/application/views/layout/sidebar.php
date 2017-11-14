		<div class="page-sidebar-wrapper">
        	<!-- END SIDEBAR -->
            <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
            <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
            <div class="page-sidebar navbar-collapse collapse">
            	<!-- BEGIN SIDEBAR MENU -->
                <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-hover-submenu page-sidebar-menu-closed" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                	<li class="nav-item start active open">
                    	<a href="<?php echo base_url('painel'); ?>" class="nav-link nav-toggle">
                        	<i class="icon-home"></i>
                            <span class="title">Dashboard</span> 
                            <span class="selected"></span>
                            <span class="arrow open"></span>
                       </a>
                   </li>
                   <?php $cod_usuario_sessao = $this->session->userdata('cod_usuario');
                   		if($this->session->userdata('nivel') < 5) {
                                $categorias_menu = $this->db->query("
                                SELECT s.descri_setor, s.cod_setor, s.icone FROM sys_permissoes pe
                                LEFT JOIN sys_paginas pg ON pe.cod_pagina = pg.cod_pagina
                                LEFT JOIN sys_setor s ON pg.cod_setor = s.cod_setor
                                WHERE pe.cod_usuario = '$cod_usuario_sessao' AND pg.atalho = 1
                                GROUP BY s.cod_setor
                                ORDER BY s.descri_setor,pg.titulo");
                        }
                        else {
                        	$categorias_menu = $this->db->query("SELECT * FROM sys_setor s ORDER BY s.descri_setor");
                        }
                        if($categorias_menu->num_rows()>=1) {
                            foreach ($categorias_menu->result() as $categoria_menu) { ?>
                        	<li class="nav-item  ">
                            	<a href="javascript:;" class="nav-link nav-toggle">
                                	<i class=" fa <?php echo $categoria_menu->icone; ?>"></i>
                                	<span class="title"><?php echo $categoria_menu->descri_setor; ?></span>
                                	<span class="arrow"></span>
                            	</a>
                           		<ul class="sub-menu"> 
                           		<?php $cod_setor = $categoria_menu->cod_setor;
                                	if($this->session->userdata('nivel') < 5)
                                    {
                                        $paginas = $this->db->query("
                                        SELECT pg.titulo AS titulo
                                        , per.uri_pagina AS uri_pagina
                                        FROM sys_permissoes per
                                        LEFT JOIN sys_paginas pg ON per.cod_pagina = pg.cod_pagina
                                        WHERE pg.cod_setor =  '$cod_setor'  AND pg.atalho = 1
                                        AND per.cod_usuario = '$cod_usuario_sessao'  ORDER BY pg.titulo
                                      ");
                                    }
                                    else
                                    {
                                        $paginas = $this->db->query("
                                        SELECT * FROM sys_paginas
                                        WHERE cod_setor = '$cod_setor'  AND atalho = 1
                                        ORDER BY titulo
                                      ");
                                    }
                                    foreach ($paginas->result() as $pagina) { ?>  
                                    <li>
                                        <a href="<?php echo base_url($pagina->uri_pagina); ?>"><i class="fa fa-caret-right"></i> <?php echo $pagina->titulo; ?></a>
                                    </li>
                                <?php } ?>
                            </ul>                      
                        </li>
                        <?php  } }  ?>
                        <li class="nav-item">
                            <a href="<?php echo base_url('suporte'); ?>" class="nav-link nav-toggle">
                                <i class="fa fa-support"></i>
                                <span class="title">Suporte</span>
                            </a>
                        </li>
                    </ul>
                    <!-- END SIDEBAR MENU -->
                </div>
                <!-- END SIDEBAR -->
            </div>
<?php
defined ( 'BASEPATH' ) or exit ( 'Nenhum script de acesso será permetido!!' );
class Mapas_model extends CI_Model {
	public function mapas(){
		$usuario ="";
		if($_SESSION ['nivel']!=5){
			$usuario = "and sy.cod_usuario ='".$_SESSION ['cod_usuario']."'";
		}
		$caixas = $this->db->query("SELECT s.uri_pagina,s.titulo FROM sys_paginas as s 
			left join sys_permissoes as sy on s.cod_pagina=sy.cod_pagina 
			where s.cod_setor = '12' and s.atalho = '0' ".$usuario." group by uri_pagina ");
		if($caixas)
		{
			return $caixas;
		}
		else
		{
			return FALSE;
		}
	}
}
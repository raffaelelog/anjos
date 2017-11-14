<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Ferramentas_model extends CI_Model {
	public function grava_log($cod_usuario, $atividade, $data) {
		$dados = array (
				'cod_usuario' => $cod_usuario,
				'atividade' => $atividade,
				'data' => $data 
		);
		
		$this->db->insert ( 'sys_log_usu', $dados );
	}
	public function consulta_clientes($entrada, $campo) {
		$consulta = $this->db->query ( "SELECT c.codcli,c.nome_cli,c.endereco,c.referencia,c.bairro,rc.cod_caixa,rc.cod_spliter, rc.fibra_vlan,rc.fibra_mac, se.descri_ser, c.cep,rc.fibra_login,rc.fibra_spliter,ci.nome_cid  
		FROM servicos_cli AS sc 
		LEFT JOIN redes_clientes AS rc ON rc.contrato = sc.codcli
		INNER JOIN clientes AS c ON c.codcli = sc.codcli
		INNER JOIN servicos AS se ON sc.codser = se.codser
		LEFT JOIN cidades AS ci ON ci.cidade = c.cidade
		WHERE $entrada LIKE '%$campo%' AND c.ativo = 's' AND sc.codcan = ''" );
		if ($consulta) {
			return $consulta;
		} else {
			return False;
		}
	}
	public function dados_setor(){
		$consulta = $this->db->query ( "SELECT s.cod_setor,s.descri_setor FROM sys_setor AS s
			INNER JOIN sys_usuarios AS su ON s.cod_setor = su.cod_setor
			group by s.descri_setor" );
		if ($consulta) {
			return $consulta;
		} else {
			return False;
		}
	}
	public function dados_unidade(){
		$consulta = $this->db->query ( "SELECT cod_unidade,descri_unidade FROM sys_unidade" );
		if ($consulta) {
			return $consulta;
		} else {
			return False;
		}
	}
	public function dados_email($setor,$unidade){
		if($setor != 0){
			$define_setor = "AND cod_setor = $setor";
		}else{
			$define_setor = "";
		}
		if($unidade != 0){
			$define_unidade = "AND cod_unidade = $unidade";
		}else{
			$define_unidade = "";
		}
		$consulta = $this->db->query ( "SELECT nome,email FROM isp_city10.sys_usuarios where ativo = 1 $define_setor $define_unidade ");
		if ($consulta) {
			return $consulta;
		} else {
			return False;
		}
	}
	
	
}/*END MODEL*/
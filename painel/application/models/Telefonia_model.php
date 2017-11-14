<?php
defined('BASEPATH') OR exit('Nenhum script de acesso será permetido!!');
class Telefonia_model extends CI_Model {
	public function cidaodes_telefones()
	{
		$query = $this->db->query("SELECT cc.cidade, cc.nome_cid
			FROM clientes as c
			inner join servicos_cli as sc on sc.codcli = c.codcli
			inner join cidades as cc on cc.cidade = c.cidade
			inner join status as s on s.codest = sc.codest
			where ativo = 's' and sc.codest = '020IF0JLW9' 
			group by cc.cidade");
		if($query)
		{
			return $query;
		} 
		else
		{
			return FALSE;
		}
	}
	public function telefones($cod_cidade)
	{
		if ($cod_cidade == 0){
			$cidade = '';
		}
		else{
			$cidade = "and cc.cidade = '$cod_cidade'";
		}
		$query = $this->db->query("SELECT c.codcli,c.nome_cli, cc.nome_cid,c.bairro,concat('55',c.ddd,c.fone) as telefone,concat('55',c.celular) as celular
			FROM clientes as c
			inner join servicos_cli as sc on sc.codcli = c.codcli
			inner join cidades as cc on cc.cidade = c.cidade
			inner join status as s on s.codest = sc.codest
			where ativo = 's' and sc.codest = '020IF0JLW9' $cidade
			group by c.codcli");
		if($query)
		{
			return $query;
		}
		else
		{
			return FALSE;
		}
	}
}
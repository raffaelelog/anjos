<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Geo_model extends CI_Model {


public function tecnicos()
{
	$tecnicos = $this->db->query("
		SELECT u.*, un.descri_unidade AS unidade FROM
		sys_usuarios u
		LEFT JOIN sys_unidade un ON u.cod_unidade = un.cod_unidade
		WHERE 
		u.tecnico = 1
		AND u.ativo = 1
		");

	if($tecnicos)
	{
		return $tecnicos; 
	}
	else
	{
		return FALSE;
	}
}


public function tecnico($cod_usuario)
{
	return FALSE;
}

public function historico_tec($cod_usuario, $hora_inicial, $hora_final)
{
	$consulta = $this->db->query("
		SELECT * FROM geo_localizacao
		WHERE
		cod_usuario = '$cod_usuario'
		AND data BETWEEN '$hora_inicial' AND '$hora_final'

		");

	if($consulta)
	{
		return $consulta;
	}
	else
	{
		return FALSE;
	}
}



}/*END MODEL*/
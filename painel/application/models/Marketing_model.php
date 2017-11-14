<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Marketing_model extends CI_Model {
public function pos_atendimentos()
{
	$consulta =  $this->db->query("
		SELECT 
		se.numero_os AS numero_os
		,oco.codcli AS codcli
		,t.descri_ords AS descri_ords
		,se.periodo AS periodo
		,se.cod_servico AS cod_servico
		FROM ope_servico se
		LEFT JOIN ordem_servico os ON se.cod_servico = os.codords
		LEFT JOIN ope_servico_tipo t ON se.cod_tipo_servico = t.cod_tipo_servico 
		LEFT JOIN ocorrencias oco ON os.codoco = oco.codoco
		WHERE se.cod_servico NOT IN (
		SELECT po.cod_servico FROM mkt_pos_atendimento po
		)
		AND se.status_os = 'F'
		AND se.data_servico >= '2017-07-05'
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
public function pos_enviados($data_servico)
{
	$consulta =  $this->db->query("
		SELECT 
		se.numero_os AS numero_os
		,oco.codcli AS codcli
		,t.descri_ords AS descri_ords
		,se.periodo AS periodo
		,se.cod_servico AS cod_servico
		FROM mkt_pos_atendimento pa
		LEFT JOIN ope_servico se ON pa.cod_servico = se.cod_servico
		LEFT JOIN ordem_servico os ON se.cod_servico = os.codords
		LEFT JOIN ope_servico_tipo t ON se.cod_tipo_servico = t.cod_tipo_servico 
		LEFT JOIN ocorrencias oco ON os.codoco = oco.codoco
		WHERE 
		se.data_servico = '$data_servico'
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
public function cadastrar_pos($cod_servico, $atendimento, $produto, $classificacao, $nota, $motivo_insatisfacao)
{
	$dados = array(
		'cod_servico' => $cod_servico,
		'atendimento' => $atendimento,
		'produto' => $produto,
		'classificacao' => $classificacao,
		'nota' => $nota,
		'motivo_insatisfacao' => $motivo_insatisfacao
	);
	$cadastrar = $this->db->insert('mkt_pos_atendimento', $dados);
	if($cadastrar)
	{
		return TRUE;
	}
	else
	{
		return FALSE;
	}
}
public function pos_editar($cod_servico)
{
	$consulta =  $this->db->query("
		SELECT 
		*
		FROM mkt_pos_atendimento pa
		WHERE 
		pa.cod_servico = '$cod_servico'
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
}//FIM MODEL
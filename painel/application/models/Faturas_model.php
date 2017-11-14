<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Faturas_model extends CI_Model
{

	public function faturas_print($data)
	{
		$consulta = $this->db->query("
			SELECT 
			    *
			FROM
			    faturas f
			        LEFT JOIN
			    cadastros c ON f.cod_cadastro = c.cod_cadastro
			WHERE
			    data_vencimento = '$data'
			        AND f.cod_status = 1
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


	public function faturas_abertas()
	{
		$consulta = $this->db->query("
			SELECT 
			    c.nome AS nome,
			    f.data_vencimento AS data,
			    f.valor AS valor,
			    fs.descricao AS status,
			    f.cod_fatura AS cod_fatura
			FROM
			    faturas f
			        LEFT JOIN
			    cadastros c ON f.cod_cadastro = c.cod_cadastro
			        LEFT JOIN
			    faturas_status fs ON f.cod_status = fs.cod_status
			WHERE
			    f.cod_status = 1
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


	public function atualizar_status($cod_fatura, $cod_status)
	{

		$dados = array('cod_status' => $cod_status);
		$this->db->where('cod_fatura', $cod_fatura);
		$atualizar = $this->db->update('faturas', $dados);

		if($atualizar)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

}//FIM MODEL 
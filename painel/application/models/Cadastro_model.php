<?php

defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class Cadastro_model extends CI_Model {

	public function cadastrar($nome, $telefone, $celular, $endereco, $numero, $complemento, $referencia, $bairro, $cidade, $estado, $cep, $obs)
	{
		$dados = array(
			'nome' => $nome,
			'telefone' => $telefone,
			'celular' => $celular,
			'endereco' => $endereco,
			'numero' => $numero,
			'complemento' => $complemento,
			'referencia' => $referencia,
			'bairro' => $bairro,
			'cidade' => $cidade,
			'estado' => $estado,
			'cep' => $cep,
			'obs' => $obs
			);

		$cadastrar = $this->db->insert('cadastros', $dados);

		if($cadastrar)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	public function atualizar($cod_cadastro, $nome, $telefone, $celular, $endereco, $numero, $complemento, $referencia, $bairro, $cidade, $estado, $cep, $obs)
	{
		$dados = array(
			'nome' => $nome,
			'telefone' => $telefone,
			'celular' => $celular,
			'endereco' => $endereco,
			'numero' => $numero,
			'complemento' => $complemento,
			'referencia' => $referencia,
			'bairro' => $bairro,
			'cidade' => $cidade,
			'estado' => $estado,
			'cep' => $cep,
			'obs' => $obs
			);

		$this->db->where('cod_cadastro', $cod_cadastro);
		$cadastrar = $this->db->update('cadastros', $dados);

		if($cadastrar)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}


	// Listar cadastros
	public function cadastros($filtro,$busca)
	{
		$consulta = $this->db->query("
			SELECT
			*
			FROM 
			cadastros
			WHERE TRUE
			$filtro
			ORDER BY nome
			LIMIT 100
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





	// Listar cadastros
	public function cadastro($cod_cadastro)
	{
		$consulta = $this->db->query("
			SELECT
			*
			FROM 
			cadastros
			where cod_cadastro = '$cod_cadastro'
			ORDER BY nome
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

	public function faturas_cadastro($cod_cadastro)
	{
		$consulta = $this->db->query("
			SELECT
			f.*,fs.descricao
			FROM 
			faturas f
			left join faturas_status fs ON f.cod_status = fs.cod_status
			where cod_cadastro = '$cod_cadastro'
			ORDER BY cod_fatura desc
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



	//
	public function cadastrar_fatura($cod_cadastro, $cod_status, $data_emissao, $data_vencimento, $valor)
	{
		$dados = array(
			'cod_cadastro' => $cod_cadastro,
			'cod_status' => $cod_status,
			'data_emissao' => $data_emissao,
			'data_vencimento' => $data_vencimento,
			'valor' => $valor
		);

		$cadastrar = $this->db->insert('faturas', $dados);

		if($cadastrar)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}



	// 
	public function cadastrar_fatura_recorrente($cod_cadastro, $dia_vencimento, $valor)
	{
		$dados = array(
			'cod_cadastro' => $cod_cadastro,
			'dia_vencimento' => $dia_vencimento,
			'valor' => $valor
		);

		$cadastrar = $this->db->insert('fatura_recorrente', $dados);

		if($cadastrar)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	public function fatura_recorrente($cod_cadastro)
	{
		$consulta = $this->db->query("
			SELECT
			*
			FROM 
			fatura_recorrente f
			where cod_cadastro = '$cod_cadastro'
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

	//
	public function excluir_fatura_recorrente($cod_fatura_recorrente)
	{
		$this->db->where('cod_fatura_recorrente', $cod_fatura_recorrente);
		$excluir = $this->db->delete('fatura_recorrente');

		if($excluir)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}





}// END Model
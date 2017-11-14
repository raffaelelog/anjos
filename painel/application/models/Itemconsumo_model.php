<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Itemconsumo_model extends CI_Model
{
	
	public function cat_itemconsumo()
	{	

		$consulta = $this->db->query("
				SELECT * from estoque_cat_itemconsumo ORDER BY descricao ;
			");

		if($consulta)
		{
			return $consulta;
		}
	}

	/*LISTA USUARIOS DO SISTEMA*/
	public function listar_usuarios()
	{	

		$consulta = $this->db->query("
				SELECT
					*
				FROM sys_usuarios u
				WHERE
				u.ativo = 1
				ORDER BY u.nome
				;
			");

		if($consulta)
		{
			return $consulta;
		}
	}




	public function itensconsumo()
	{	

		$cod_unidade = $this->session->userdata('cod_unidade');

		$consulta = $this->db->query("
				SELECT ic.*, u.descri_unidade AS unidade
				from estoque_itemconsumo ic
				LEFT JOIN sys_unidade u ON ic.cod_unidade = u.cod_unidade
				WHERE ic.cod_unidade = '$cod_unidade'
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



	public function cadastrar($cod_cat_itemconsumo, $descricao, $codigo, $unidade_medida, $quant_minima, $estoque_atual, $valor_unitario, $ativo)
	{
		/*
			verifica a existencia de um profuto com o mesmo codigo.
		*/
		$consulta = $this->db->query("
				SELECT * FROM estoque_itemconsumo
				where codigo = '$codigo'
			");
		

		/*
			se não encontrar nenhum produto com
			o mesmo codigo cadastra o novo produto
		*/
		if($consulta->num_rows()==0)
		{
			/*
				Registro na unidade de BCA codigo 1
			*/
			$dados = array(
				'cod_unidade'				=> 1,
				'cod_cat_itemconsumo'		=> $cod_cat_itemconsumo,
				'descricao'					=> $descricao,
				'codigo'					=> $codigo,
				'unidade_medida'			=> $unidade_medida,
				'estoque_atual'				=> $estoque_atual,
				'quant_minima'				=> $quant_minima,
				'valor_unitario'			=> $valor_unitario,
				'ativo'						=> $ativo
				);

			//Faz o cadastro
			$str = $this->db->insert('estoque_itemconsumo', $dados);
			$cod_itemconsumo = $this->db->insert_id();




			/*
				Registro na unidade de SOE codigo 2
			*/
			$dados_soe = array(
				'cod_unidade'				=> 2,
				'cod_cat_itemconsumo'		=> $cod_cat_itemconsumo,
				'descricao'					=> $descricao,
				'codigo'					=> $codigo,
				'unidade_medida'			=> $unidade_medida,
				'estoque_atual'				=> 0,
				'quant_minima'				=> $quant_minima,
				'valor_unitario'			=> $valor_unitario,
				'ativo'						=> $ativo
				);

			//Faz o cadastro
			$str_soe = $this->db->insert('estoque_itemconsumo', $dados_soe);
			/*
				Fim cadastro produto BCA e SOE
			*/

				
			
			/*
				Se cadastro do produto for TRUE
				e numero inicial de produtos maior que zero
				cadastra uma ocorrencia
			*/
			if($str && $estoque_atual>0)
			{
				$cod_usuario = $this->session->userdata('cod_usuario');
				$data_oco = date('Y-m-d');
				$tipo_oco = 1; /* 1 = entrada e 0 = saída */
				$descricao_oco = 'Lançamento BCA';

				$dados_oco = array(
					'cod_itemconsumo'		=> $cod_itemconsumo,
					'cod_unidade'			=> 1,//Registro para BCA onde sera dada a entrada inicial
					'cod_usuario'			=> $cod_usuario,
					'quantidade'			=> $estoque_atual,
					'tipo_oco'				=> $tipo_oco,
					'data_oco'				=> $data_oco,
					'descricao_oco'			=> $descricao_oco
				);

				//Faz o cadastro em ocorrencias
				$str_oco = $this->db->insert('estoque_ocorrencias', $dados_oco);
				}
				else
				{
					$str_oco = TRUE;
				}


				/*
					Verifica os inserts
				*/
				if($str && $str_oco && $str_soe)
				{
					return TRUE;
				}
				else
				{
					return FALSE;
				}
			}
			else
			{
				return FALSE;
			}
	}
	/*FIM Cadastrar*/




	/*Realizar entrada no estoque*/
	public function entrada($quantidade, $valor_unitario, $cod_itemconsumo, $estoque_atual, $cod_unidade)
	{
		/*Inicio Update item de consumo*/
		$data = array(
		        'estoque_atual' => $quantidade+$estoque_atual,
		        'valor_unitario' => $valor_unitario
		        );

		$this->db->where('cod_itemconsumo', $cod_itemconsumo);
		$this->db->where('cod_unidade', $cod_unidade);
		$entrada = $this->db->update('estoque_itemconsumo', $data);

		/*Fim update no item de consumo*/


		if($entrada)
		{
			$cod_usuario = $this->session->userdata('cod_usuario');
			$data_oco = date('Y-m-d');
			$tipo_oco = 1; /* 1 = entrada e 0 = saída */
			$descricao_oco = 'Entrada no estoque';

			$dados_oco = array(
				'cod_itemconsumo'		=> $cod_itemconsumo,
				'cod_unidade'			=> $cod_unidade,
				'cod_usuario'			=> $cod_usuario,
				'quantidade'			=> $quantidade,
				'tipo_oco'				=> $tipo_oco,
				'data_oco'				=> $data_oco,
				'descricao_oco'			=> $descricao_oco
			);

			//Faz o cadastro em ocorrencias
			$str_oco = $this->db->insert('estoque_ocorrencias', $dados_oco);

			if($str_oco)
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
			/*Fim if entrada*/
		}
	}

	/*Saida Item de Consumo*/
	public function saida($quantidade, $codigo, $cod_unidade, $cod_usuario)
	{
		/*Verifica se o Produto existe na unidade e tem quantidade para saida*/
		$consulta_item = $this->db->query("
				SELECT * FROM estoque_itemconsumo
				where codigo = '$codigo' AND cod_unidade = '$cod_unidade' AND estoque_atual >= '$quantidade'
			");
		$row = $consulta_item->row();
		$estoque_atual = $row->estoque_atual;
		$cod_itemconsumo = $row->cod_itemconsumo;

		if($consulta_item->num_rows()==1)
		{
			
			$data = array(
		        'estoque_atual' => $estoque_atual-$quantidade
		        );

			$this->db->where('codigo', $codigo);
			$this->db->where('cod_unidade', $cod_unidade);
			$saida = $this->db->update('estoque_itemconsumo', $data);
		
			/* Registra Ocorrencia de saida */
			if($saida)
			{
				$data_oco = date('Y-m-d');
				$tipo_oco = 0; /* 1 = entrada e 0 = saída */
				$descricao_oco = 'Saída do estoque';

				$dados_oco = array(
					'cod_itemconsumo'		=> $cod_itemconsumo,
					'cod_unidade'			=> $cod_unidade,
					'cod_usuario'			=> $cod_usuario,
					'quantidade'			=> $quantidade,
					'tipo_oco'				=> $tipo_oco,
					'data_oco'				=> $data_oco,
					'descricao_oco'			=> $descricao_oco
				);

				//Faz o cadastro em ocorrencias
				$str_oco = $this->db->insert('estoque_ocorrencias', $dados_oco);
			}
			/* Fim ocorrencia de saída */


			if($str_oco)
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
		}
		else
		{
			return FALSE;
		}


	}
	/*Fim Saída Item de Consumo*/



	/*Inicio devolução item de consumo*/
	public function devolucao($codigo, $quantidade, $cod_usuario)
	{
		$cod_unidade = $this->session->userdata('cod_unidade');

		/*Atualizar estoque*/
		$this->db->where('codigo', $codigo);
		$this->db->where('cod_unidade', $cod_unidade);
		{
			$this->db->set('estoque_atual', "estoque_atual + '$quantidade' ", FALSE);
		}

		$atualizar = $this->db->update('estoque_itemconsumo');

		if($atualizar)
		{
			/*Pegar o cod_itenconsumo*/
			$pegar_cod = $this->db->query("
				SELECT
				*
				FROM
				estoque_itemconsumo
				WHERE
				codigo = '$codigo'
				AND cod_unidade = '$cod_unidade'
				");
			$row = $pegar_cod->row();
			echo $cod_itemconsumo = $row->cod_itemconsumo;

			$cod_usuario = $this->session->userdata('cod_usuario');
			$data_oco = date('Y-m-d');
			$tipo_oco = 1; /* 1 = entrada e 0 = saída */
			$descricao_oco = 'Devolução ao estoque';

			$dados_oco = array(
				'cod_itemconsumo'		=> $cod_itemconsumo,
				'cod_unidade'			=> $cod_unidade,
				'cod_usuario'			=> $cod_usuario,
				'quantidade'			=> $quantidade,
				'tipo_oco'				=> $tipo_oco,
				'data_oco'				=> $data_oco,
				'descricao_oco'			=> $descricao_oco
			);

			//Faz o cadastro em ocorrencias
			$str_oco = $this->db->insert('estoque_ocorrencias', $dados_oco);

			return TRUE;
		}
		else
		{
			return FALSE;
		}

	}
	/*Fim devolucao item de consumo*/

	// Tranferencia de unidade
	public function unidades_transferencia()
	{
		$cod_unidade = $this->session->userdata('cod_unidade');

		$consulta = $this->db->query("
				SELECT * FROM sys_unidade
				WHERE 
				cod_unidade != '$cod_unidade'
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



	// Tranferencia de produto entre unidades_transferencia
	public function transferir_produtos($codigo, $cod_unidade, $quantidade, $data_lan)
	{
		$num_itens = count($codigo);
		$cod_unidade_saida = $this->session->userdata('cod_unidade');

		for ($i=0; $i < $num_itens ; $i++) { 
			
			$dados = array(
				'cod_itemconsumo' => $codigo[$i],
				'cod_unidade' => $cod_unidade,
				'quantidade' => $quantidade[$i],
				'data_lan' => $data_lan
				);

			$enviar = $this->db->insert('estoque_transferencia', $dados);

			// Atualiza estoque unidade saída
			$atualizar_unidade_saida = $this->db->query("
				UPDATE estoque_itemconsumo 
				SET estoque_atual = estoque_atual - $quantidade[$i]
				WHERE codigo = '$codigo[$i]'
				AND cod_unidade = '$cod_unidade_saida'   
				");

			// Atualiza estoque unidade destino
			$atualizar_unidades = $this->db->query("
				UPDATE estoque_itemconsumo 
				SET estoque_atual = estoque_atual + $quantidade[$i]
				WHERE codigo = '$codigo[$i]'
				AND cod_unidade = '$cod_unidade'
				");
		}
		// Fim for

		if($enviar AND $atualizar_unidades AND $atualizar_unidade_saida)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}

	}




	// Itens tranferidos entre unidades
	public function transferidos()
	{
		$consulta = $this->db->query("
				SELECT tr.*, i.descricao, DATE_FORMAT(tr.data_lan, '%d/%m/%Y') as data_lan
				FROM estoque_transferencia tr
				LEFT JOIN estoque_itemconsumo i ON tr.cod_itemconsumo = i.codigo
				WHERE
				i.descricao IS NOT NULL
				GROUP BY tr.cod_transferencia
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


}//FIM ITEM DE CONSUMO
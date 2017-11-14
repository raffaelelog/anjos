<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Manutencao_model extends CI_Model {
	public function itens($codigo) {
		if ($codigo != '') {
			$where = " AND (m.cod_produtoitem = '$codigo' OR m.cod_manutencao = '') ";
			$limit = '';
		} else {
			$where = '';
			$limit = ' LIMIT 3000';
		}
		$consulta = $this->db->query ( "SELECT
				m.cod_produtoitem AS codigo
				,m.data_entrada AS entrada
				,m.defeito AS defeito
				,p.descricao as produto
				,m.cod_manutencao AS cod_manutencao
				,sy.nome AS responsavel_nome
				,sm.descricao AS descricao_status 
				FROM estoque_manutencao m
				LEFT JOIN estoque_produtoitem pi ON m.cod_produtoitem = pi.cod_produtoitem
				LEFT JOIN estoque_produto p ON pi.cod_produto = p.cod_produto
				LEFT JOIN sys_usuarios sy ON m.cod_usuario = sy.cod_usuario
				LEFT JOIN estoque_statusmanutencao sm ON m.cod_statusmanutencao = sm.cod_statusmanutencao
				WHERE m.ativo = '1'
				AND (m.cod_statusmanutencao != 2 OR m.cod_statusmanutencao != 5)
				$where
				ORDER BY m.data_entrada
				$limit
			" );
		
		if ($consulta) {
			return $consulta;
		}
	}
	public function item_manutencao($cod_manutencao) {
		$consulta = $this->db->query ( "SELECT
				m.cod_produtoitem AS codigo
				,m.data_entrada AS entrada
				,m.defeito AS defeito
				,p.descricao as produto
				,m.cod_manutencao AS cod_manutencao
				,sy.nome AS responsavel_nome
				,sy.cod_usuario AS cod_usuario
				,m.cod_statusmanutencao AS cod_statusmanutencao
				,m.cod_produtoitem AS cod_produtoitem
				,m.obs AS obs
				,m.retorno AS retorno
				,m.data_retorno AS data_retorno
				,emt.cod_tipo_manutencao AS cod_tipo_manutencao
				,sy.nome as nome
				FROM estoque_manutencao m
				LEFT JOIN estoque_produtoitem pi ON m.cod_produtoitem = pi.cod_produtoitem
				LEFT JOIN estoque_produto p ON pi.cod_produto = p.cod_produto
				LEFT JOIN sys_usuarios sy ON m.cod_usuario = sy.cod_usuario
                left JOIN estoque_manutencao_tipo emt ON emt.cod_tipo_manutencao = m.cod_tipo_manutencao
				WHERE m.cod_manutencao = '$cod_manutencao' " );
		
		if ($consulta) {
			return $consulta;
		}
	}
	public function manutencao_resp() {
		$consulta = $this->db->query ( "SELECT * FROM sys_usuarios where cod_setor = 3 and tecnico = 1 and ativo = 1" ); //
		
		if ($consulta) {
			return $consulta;
		}
	}
	public function cadastrar($cod_produtoitem, $defeito, $obs, $cod_usuario) {
		
		/*
		 *
		 * Verifica se o item saiu da manutenção nos
		 * ultimos 90 dias
		 *
		 */
		$consulta = $this->db->query ( "SELECT
				MAX(cod_manutencao) AS cod_manutencao
				,retorno AS retorno
				FROM estoque_manutencao  
				WHERE data_saida BETWEEN DATE_SUB(NOW(), INTERVAL 90 DAY) AND NOW()
				AND cod_produtoitem = '$cod_produtoitem'" );
		foreach ( $consulta->result () as $item ) {
			$cod_manutencao = $item->cod_manutencao;
			$retorno_atual = $item->retorno + 1;
		}
		
		if ($cod_manutencao != NULL) {
			$data_atual = date ( 'Y-m-d' );
			$data = array (
					'cod_statusmanutencao' => 1,
					'retorno' => $retorno_atual,
					'data_retorno' => $data_atual,
					'ativo' => 1 
			);
			$this->db->where ( 'cod_manutencao', $cod_manutencao );
			$atualiza = $this->db->update ( 'estoque_manutencao', $data );
			
			// ATUALIZA O STATUS DO ITEM PARA ESTOQUE
			$data = array (
					'cod_statusitem' => 5,
					'data_tecnico' => NULL,
					'cliente' => NULL,
					'data_cliente' => NULL,
					'data_cliente_saida' => NULL 
			);
			
			$this->db->where ( 'cod_produtoitem', $cod_produtoitem );
			
			$query = $this->db->update ( 'estoque_produtoitem', $data );
			// FIM STATUS ITEM
			
			// LOG_PRODUTO
			$cod_usuario = $this->session->userdata ( 'cod_usuario' );
			$data_log = date ( 'Y-m-d' );
			$dados_log = array (
					'descricao' => "Enviado para manutenção",
					'cod_usuario' => $cod_usuario,
					'cod_produtoitem' => $cod_produtoitem,
					'data_log' => $data_log 
			);
			$log = $this->db->insert ( 'estoque_logproduto', $dados_log );
			// END LOG_PRODUTO
			
			if ($atualiza) {
				return TRUE;
			}
		} else {
			/**
			 * *****************************************
			 */
			
			/*
			 * Verifica se o item está no sistema
			 */
			$hoje = date ( 'Y-m-d' );
			$consulta = $this->db->query ( "
					
					SELECT * FROM estoque_produtoitem
					where cod_produtoitem = '$cod_produtoitem'
					AND cod_statusitem = '1'
	                AND garantia <= '$hoje'
				" );
			
			/*
			 * Se encontrado, faz o lançamento na manutenção
			 */
			if ($consulta->num_rows () > 0) {
				/*
				 * VERIFICA SE O PRODUTO FOI ENCONTRADO
				 * E RELALIZA O CADASTRO NA MANUTENÇÃO
				 */
				
				$dados = array (
						'cod_produtoitem' => $cod_produtoitem,
						'data_entrada' => $hoje,
						'defeito' => $defeito,
						'obs' => $obs,
						'cod_usuario' => $cod_usuario,
						'cod_statusmanutencao' => 1 
				);
				
				// CADASTRA NA MANUTENÇÃO
				$str = $this->db->insert ( 'estoque_manutencao', $dados );
				
				// ATUALIZA O STATUS DO ITEM PARA MANUTENÇÃO
				$data = array (
						'cod_statusitem' => 5,
						'data_tecnico' => NULL,
						'cliente' => NULL,
						'data_cliente' => NULL,
						'data_cliente_saida' => NULL 
				);
				
				$this->db->where ( 'cod_produtoitem', $cod_produtoitem );
				
				$query = $this->db->update ( 'estoque_produtoitem', $data );
				
				// FIM ATUALIZAR O STATUS DO ITEM
				
				// LOG_PRODUTO
				$cod_usuario = $this->session->userdata ( 'cod_usuario' );
				$data_log = date ( 'Y-m-d' );
				$dados_log = array (
						'descricao' => "Enviado para manutenção",
						'cod_usuario' => $cod_usuario,
						'cod_produtoitem' => $cod_produtoitem,
						'data_log' => $data_log 
				);
				$log = $this->db->insert ( 'estoque_logproduto', $dados_log );
				// END LOG_PRODUTO
				
				if ($str) {
					return TRUE;
				} else {
					return FALSE;
				}
			} /* END CONSULTA */
			else {
				/* CASO NÃO ENCONTRO O PRODUTO */
				return FALSE;
			}
		
		/**
		 * ****************************************
		 */
		}
	} // END CADASTRAR
	public function atualizar($cod_manutencao, $cod_produtoitem, $cod_statusmanutencao, $defeito, $obs, $cod_usuario,$cod_tipo_manutencao) {
		
		/*
		 * VERIFICA SE FOI SELECIOADO A
		 * OPÇÃO CONCLUÍDA. ISSO FAZ COM QUE A OS SEJA
		 * FECHADA E O ITEM DEVOLVIDO AO ESTOQUE
		 */
		if ($cod_statusmanutencao == 2) {
			$data = date ( 'Y-m-d' );
			
			// ATUALIZAR A DATA
			// DE SAIDA DA MANUTENCAO
			$data = array (
					'cod_statusmanutencao' => $cod_statusmanutencao,
					'data_saida' => $data,
					'ativo' => 0,
					'cod_tipo_manutencao' => $cod_tipo_manutencao
					
			);
			$this->db->where ( 'cod_manutencao', $cod_manutencao );
			$query = $this->db->update ( 'estoque_manutencao', $data );
			
			// LOG_PRODUTO
			$cod_usuario = $this->session->userdata ( 'cod_usuario' );
			$data_log = date ( 'Y-m-d' );
			$dados_log = array (
					'descricao' => "Saiu da Manutenção. Devolvido ao estoque.",
					'cod_usuario' => $cod_usuario,
					'cod_produtoitem' => $cod_produtoitem,
					'data_log' => $data_log 
			);
			$log = $this->db->insert ( 'estoque_logproduto', $dados_log );
			// END LOG_PRODUTO
			
			// ATUALIZA O STATUS
			// DO ITEM
			$data = array (
					'cod_statusitem' => 1 
			);
			
			$this->db->where ( 'cod_produtoitem', $cod_produtoitem );
			$query = $this->db->update ( 'estoque_produtoitem', $data );
			
			if ($query) {
				return TRUE;
			} else {
				return FALSE;
			}
		} elseif ($cod_statusmanutencao == 5)/* VERIFICA SE O ITEM FOI DESCARTADO */
		{
			$data = date ( 'Y-m-d' );
			
			// ATUALIZAR A DATA
			// DE SAIDA DA MANUTENCAO
			$data = array (
					'cod_statusmanutencao' => $cod_statusmanutencao,
					'data_saida' => $data,
					'ativo' => 0, 
					'cod_tipo_manutencao' => $cod_tipo_manutencao
			);
			
			$this->db->where ( 'cod_manutencao', $cod_manutencao );
			$query = $this->db->update ( 'estoque_manutencao', $data );
			
			// LOG_PRODUTO
			$cod_usuario = $this->session->userdata ( 'cod_usuario' );
			$data_log = date ( 'Y-m-d' );
			$dados_log = array (
					'descricao' => "Ítem descartado. Lixo eletrônico.",
					'cod_usuario' => $cod_usuario,
					'cod_produtoitem' => $cod_produtoitem,
					'data_log' => $data_log 
			);
			$log = $this->db->insert ( 'estoque_logproduto', $dados_log );
			// END LOG_PRODUTO
			
			// ATUALIZA O STATUS
			// DO ITEM
			$data = array (
					'cod_statusitem' => 6 
			);
			
			$this->db->where ( 'cod_produtoitem', $cod_produtoitem );
			$query = $this->db->update ( 'estoque_produtoitem', $data );
			
			if ($query) {
				return TRUE;
			} else {
				return FALSE;
			}
		} else {
			$data = array (
					'cod_produtoitem' => $cod_produtoitem,
					'cod_statusmanutencao' => $cod_statusmanutencao,
					'cod_usuario' => $cod_usuario,
					'defeito' => $defeito,
					'obs' => $obs,
					'cod_tipo_manutencao' => $cod_tipo_manutencao
			);
			
			$this->db->where ( 'cod_manutencao', $cod_manutencao );
			$query = $this->db->update ( 'estoque_manutencao', $data );
			
			if ($query) {
				return TRUE;
			} else {
				return FALSE;
			}
		}
	}
	public function status_manutencao() {
		$consulta = $this->db->query ( "SELECT * from estoque_statusmanutencao where ativo = 1 ORDER BY descricao " );
		
		if ($consulta) {
			return $consulta;
		}
	}
	public function os_item($cod_produtoitem, $cod_manutencao) {
		$consulta = $this->db->query ( "SELECT em.cod_manutencao,em.cod_produtoitem,su.nome,es.descricao, em.retorno,em.defeito,em.obs,emt.descri_tipo
			FROM estoque_manutencao as em
			inner join sys_usuarios as su on em.cod_usuario = su.cod_usuario
			inner join estoque_statusmanutencao as es on es.cod_statusmanutencao = em.cod_statusmanutencao
			left join estoque_manutencao_tipo as emt on emt.cod_tipo_manutencao = em.cod_tipo_manutencao
			where cod_produtoitem = '$cod_produtoitem' and cod_manutencao != '$cod_manutencao'" );
		if ($consulta) {
			return $consulta;
		} else {
			return false;
		}
	}
	public function exporte() {
		$consulta = $this->db->query ( "select m.cod_manutencao as OS
			,m.cod_produtoitem as CODIGO
			,p.descricao as PRODUTO
			,m.data_entrada AS DATA_ENTRADA
			,m.data_saida AS DATA_SAIDA
			,m.retorno AS RETORNOS
			,m.data_retorno AS DATA_ULTIMO_RETORNO
			,sy.nome AS RESPONSAVEL
			,sm.descricao AS STATUS
			,pi.preco_custo AS PRECo_CUSTO
			from estoque_manutencao m
			inner join sys_usuarios as sy on m.cod_usuario = sy.cod_usuario
			inner join estoque_produtoitem as pi on m.cod_produtoitem = pi.cod_produtoitem
			inner join estoque_produto as p on pi.cod_produto = p.cod_produto
			inner join estoque_statusmanutencao as sm on m.cod_statusmanutencao = sm.cod_statusmanutencao" );
		if ($consulta) {
			return $consulta;
		}
	}
	public function tipo_manutencao() {
		$consulta = $this->db->query ( "SELECT * FROM estoque_manutencao_tipo " );
		
		if ($consulta) {
			return $consulta;
		}
	}
	public function lanca_tempo_ini_os_comissao($cod_manutencao, $data_inicio) {
		$consulta = $this->db->query ( "SELECT * FROM estoque_manutencao_comissao where cod_manutencao = '$cod_manutencao' " );
		if ($consulta->num_rows () == 0) {
			$dados = array (
					'data_inicio' => $data_inicio,
					'cod_manutencao' => $cod_manutencao 
			);
			$log = $this->db->insert ( 'estoque_manutencao_comissao', $dados );
		}
	}
	public function lanca_tempo_fim_os_comissao($cod_manutencao, $cod_manutencaoresp, $data_fim) {
		$consulta = $this->db->query ( "SELECT * FROM estoque_manutencao_comissao where cod_manutencao = '$cod_manutencao' " );
		if ($consulta->num_rows () != 0) {
			$dados = array (
					'cod_usuario' => $cod_manutencaoresp,
					'data_fim' => $data_fim 
			);
			$this->db->where ( 'cod_manutencao', $cod_manutencao );
			$atualiza = $this->db->update ( 'estoque_manutencao_comissao', $dados );
		}
	}
}//FIM MODEL MANUTENÇÃO
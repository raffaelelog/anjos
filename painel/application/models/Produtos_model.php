<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produtos_model extends CI_Model
{
	public function produtos($descricao, $categoria, $ativo)
	{
	 	
		if($descricao!=''){$descricao = "AND p.descricao like '%$descricao%'";}
		if($categoria!=''){$categoria = "AND p.cod_categoria = '$categoria'";}
		if($ativo!=''){$ativo = "AND ativo = '$ativo'";}

		$consulta = $this->db->query("
				SELECT
				p.descricao AS descricao
				,c.descricao AS categoria
				,p.ativo AS ativo
				,p.obs AS obs
				,p.cod_produto
				FROM estoque_produto p
				LEFT JOIN estoque_categorias c ON p.cod_categoria = c.cod_categoria
				WHERE p.descricao IS NOT NULL $descricao $categoria $ativo
				ORDER BY p.descricao 
				LIMIT 100 
			");
		
		if($consulta)
		{
			return $consulta;
		} 
	}


	public function categorias()
	{	

		$consulta = $this->db->query("
				SELECT * from estoque_categorias ORDER BY descricao ;
			");

		if($consulta)
		{
			return $consulta;
		}
	}

	public function fornecedores()
	{	

		$consulta = $this->db->query("
				SELECT * from estoque_fornecedor ORDER BY fornecedor_nome ;
			");

		if($consulta)
		{
			return $consulta;
		}
	}

	public function grupos_servico()
	{	

		$consulta = $this->db->query("
				SELECT * from estoque_gruposervico ORDER BY descricao ;
			");

		if($consulta)
		{
			return $consulta;
		}
	}


	public function novo_produto($cod_categoria, $descricao_produto, $ativo_produto, $obs_produto)
	{
		$dados = array(
			'cod_categoria'		=> $cod_categoria,
			'descricao'			=> $descricao_produto,
			'ativo'				=> $ativo_produto,
			'obs'				=> $obs_produto
			);

		$str = $this->db->insert('estoque_produto', $dados);;

		if($str)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}



	}/*END CADASTRAR*/



	public function produto($cod_produto)
	{
		$consulta = $this->db->query("
				SELECT
					p.descricao AS descricao
					,p.ativo AS ativo
					,c.descricao AS categoria
					,p.obs AS obs
					,p.cod_categoria AS cod_categoria
					,p.cod_produto AS cod_produto
				from estoque_produto p
				LEFT JOIN estoque_categorias c ON p.cod_categoria = c.cod_categoria
				WHERE cod_produto = '$cod_produto' ORDER BY descricao ;
			");

		if($consulta)
		{
			return $consulta;
		}
	}

	public function atualizar_produto($cod_produto, $cod_categoria, $descricao, $ativo, $obs)
	{
		$data = array(
        'cod_categoria' => $cod_categoria,
        'descricao' => $descricao,
        'ativo' => $ativo,
        'obs' => $obs
		);

		$this->db->where('cod_produto', $cod_produto);
		$atualizar = $this->db->update('estoque_produto', $data);

		if($atualizar)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}


	public function produtos_item($cod_produto)
	{
		$consulta = $this->db->query("
				SELECT 
				pi.*
				,p.descricao AS descricao
				,st.descricao AS status
				,u.descri_unidade as unidade
				from estoque_produtoitem pi
				LEFT JOIN sys_unidade u ON pi.cod_unidade = u.cod_unidade
				LEFT JOIN estoque_produto p ON pi.cod_produto = p.cod_produto
				LEFT JOIN estoque_statusitem st on pi.cod_statusitem = st.cod_statusitem
				WHERE pi.cod_produto = '$cod_produto' 
				ORDER BY pi.data_cadastro ;
			");

		if($consulta)
		{
			return $consulta;
		}
	}

	public function entrada($cod_produto, $cod_usuario, $cod_fornecedor, $cod_statusitem, $cod_unidade, $preco_custo, $obs, $data_cadastro, $garantia, $nota_fiscal, $cod_gruposervico, $quantidade)
	{
		$dados = array(
			 			'cod_produto'		=>$cod_produto,
			 			'cod_usuario'		=>$cod_usuario,
                        'cod_fornecedor'	=>$cod_fornecedor, 
                        'cod_statusitem'	=>$cod_statusitem,
                        'cod_gruposervico'	=>$cod_gruposervico,
                        'cod_unidade'		=>$cod_unidade,
                        'preco_custo'		=>$preco_custo, 
                        'obs'				=>$obs , 
                        'data_cadastro'		=>$data_cadastro,
                        'garantia'			=>$garantia , 
                        'nota_fiscal'		=>$nota_fiscal
			);

		for($i = 0; $i<$quantidade;$i++){
		$str = $this->db->insert('estoque_produtoitem', $dados);
		}
		if($str)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}




	public function produtos_item_ver($cod_produtoitem)
	{
		$consulta = $this->db->query("
				SELECT
				p.descricao AS descricao
				,f.cod_fornecedor AS cod_fornecedor
				,f.fornecedor_nome AS fornecedor
				,s.cod_statusitem AS cod_statusitem
				,s.descricao AS descricao_status
				,pi.preco_custo AS preco_custo
				,pi.obs AS obs
				,pi.data_cadastro AS data_cadastro
				,pi.garantia AS garantia
				,pi.nota_fiscal AS nota_fiscal
				,pi.cod_gruposervico AS cod_gruposervico
				,sg.descricao AS grupo_servico
				FROM estoque_produtoitem pi
				LEFT JOIN estoque_produto p ON pi.cod_produto = p.cod_produto
				LEFT JOIN estoque_fornecedor f ON pi.cod_fornecedor = f.cod_fornecedor
				LEFT JOIN estoque_statusitem s ON pi.cod_statusitem = s.cod_statusitem
				LEFT JOIN estoque_gruposervico sg ON pi.cod_gruposervico = sg.cod_gruposervico 
				WHERE pi.cod_produtoitem = '$cod_produtoitem'
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


	//log de registros do item
	public function log_produto($cod_produtoitem)
	{
		$consulta = $this->db->query("
				SELECT
				lp.descricao AS descricao
				,lp.cod_usuario AS cod_usuario
				,lp.cod_produtoitem AS cod_produtoitem
				,lp.data_log AS data_log
				,u.nome AS nome
				FROM estoque_logproduto lp
				LEFT JOIN sys_usuarios u ON lp.cod_usuario = u.cod_usuario
				WHERE lp.cod_produtoitem = '$cod_produtoitem' 
				ORDER BY lp.cod_logproduto;
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




	public function devolucao($cod_produtoitem)
	{	

		$data_tecnico = date('Y-m-d');
		$cod_usuario = $this->session->userdata('cod_usuario');

		//PEGA A UNIDADE PARA
		//ATUALIZAR EM CASO DE TROCA
		$cod_unidade =  $this->session->userdata('cod_unidade');
		
			$data = array(
	        'cod_usuario' 	=> $cod_usuario,
	        'cod_statusitem' => 1,
	        'data_tecnico' 	=> null,
	        'data_cliente' 	=> null,
	        'cliente' 	=> null,
	        'data_tecnico' 	=> null,
	        'cod_unidade'		=> $cod_unidade
			);

			$this->db->where('cod_produtoitem', $cod_produtoitem);
			$this->db->where('cod_statusitem !=', 5);

			$atualiza = $this->db->update('estoque_produtoitem', $data);

			if($this->db->affected_rows()==1)
			{	
				//LOG_PRODUTO
				$data_log = date('Y-m-d');
				$dados_log = array(
		 			'descricao'			=>"Devolvido ao Estoque",
		 			'cod_usuario'		=>$cod_usuario,
		 			'cod_produtoitem'	=>$cod_produtoitem,
		 			'data_log'			=>$data_log
					);
				$log = $this->db->insert('estoque_logproduto', $dados_log);
				//END LOG_PRODUTO

				return $this->db->affected_rows();
			}
			else
			{
				return $this->db->affected_rows();
			}
	}

	public function ultimos_logs()
	{
		$consulta = $this->db->query("
				SELECT
				lp.data_log AS data
				,p.descricao AS produto
				,lp.descricao AS descricao
				,u.nome AS usuario
				,lp.cod_produtoitem AS cod_produtoitem
				FROM estoque_logproduto lp
				LEFT JOIN estoque_produtoitem pi ON lp.cod_produtoitem = pi.cod_produtoitem
				LEFT JOIN estoque_produto p ON pi.cod_produto = p.cod_produto
				LEFT JOIN sys_usuarios u ON lp.cod_usuario = u.cod_usuario
				ORDER BY lp.cod_logproduto desc LIMIT 10
			");

		if($consulta)
		{
			return $consulta;
		}
	}


	/*PRODUTOS NO ESTOQUE TECNICO*/
	public function estoque_tecnico($cod_usuario)
	{
		$consulta = $this->db->query("
				SELECT 
				pi.*
				,p.descricao AS descricao
				,st.descricao AS status
				,u.descri_unidade as unidade
				,pi.data_tecnico AS data_tecnico
				from estoque_produtoitem pi
				LEFT JOIN sys_unidade u ON pi.cod_unidade = u.cod_unidade
				LEFT JOIN estoque_produto p ON pi.cod_produto = p.cod_produto
				LEFT JOIN estoque_statusitem st on pi.cod_statusitem = st.cod_statusitem
				WHERE pi.cod_usuario = '$cod_usuario'
				AND pi.cod_statusitem = 2
				ORDER BY pi.data_tecnico desc;
			");

		if($consulta)
		{
			return $consulta;
		}
	}


	/*PRODUTOS NO ESTOQUE CLIENTE*/
	public function estoque_cliente($cod_cliente)
	{
		$consulta = $this->db->query("
			SELECT 
			pi.*
			,p.descricao AS descricao
			,st.descricao AS status
			,u.descri_unidade as unidade
			,pi.data_cliente AS data_cliente
			from estoque_produtoitem pi
			LEFT JOIN sys_unidade u ON pi.cod_unidade = u.cod_unidade
			LEFT JOIN estoque_produto p ON pi.cod_produto = p.cod_produto
			LEFT JOIN estoque_statusitem st on pi.cod_statusitem = st.cod_statusitem
			WHERE pi.cliente = '$cod_cliente'
			AND pi.cod_statusitem = 3
			ORDER BY pi.data_tecnico desc ;
			");

		if($consulta)
		{
			return $consulta;
		}
	}




	public function cliente($cod_cliente)
	{
		$consulta = $this->db->query("
				SELECT
				*
				FROM
				clientes
				where codcli = '$cod_cliente'
			");

		if($consulta)
		{
			return $consulta;
		}
	}

	

	public function baixa_cliente($cod_cliente, $cod_produtoitem)
	{
		$data_cliente = date('Y-m-d');
		$cod_usuario = $this->session->userdata('cod_usuario');
		
			$data = array(
	        'cod_statusitem' => 3,
	        'data_cliente' 	=> $data_cliente,
	        'cliente'		=> $cod_cliente
			);

			$this->db->where('cod_produtoitem', $cod_produtoitem);
			$this->db->where('cod_usuario', $cod_usuario);
			$this->db->where('cod_statusitem', 2);

			$atualiza = $this->db->update('estoque_produtoitem', $data);

			if($this->db->affected_rows()==1)
			{	
				//LOG_PRODUTO
				$data_log = date('Y-m-d');
				$dados_log = array(
		 			'descricao'			=>"Instalado no Cliente $cod_cliente",
		 			'cod_usuario'		=>$cod_usuario,
		 			'cod_produtoitem'	=>$cod_produtoitem,
		 			'data_log'			=>$data_log
					);
				$log = $this->db->insert('estoque_logproduto', $dados_log);
				//END LOG_PRODUTO

				return $this->db->affected_rows();
			}
			else
			{
				return $this->db->affected_rows();
			}
	}




	public function retirar_cliente($cod_produtoitem)
	{
		$cod_usuario = $this->session->userdata('cod_usuario');
		
			$data = array(
	        'cod_statusitem' => 2,
	        'data_cliente' 	=> NULL,
	        'cliente'		=> NULL,
	        'cod_usuario' 	=>$cod_usuario
			);

			$this->db->where('cod_produtoitem', $cod_produtoitem);

			$atualiza = $this->db->update('estoque_produtoitem', $data);

			if($this->db->affected_rows()==1)
			{	
				//LOG_PRODUTO
				$data_log = date('Y-m-d');
				$dados_log = array(
		 			'descricao'			=>"Retirado do Cliente",
		 			'cod_usuario'		=>$cod_usuario,
		 			'cod_produtoitem'	=>$cod_produtoitem,
		 			'data_log'			=>$data_log
					);
				$log = $this->db->insert('estoque_logproduto', $dados_log);
				//END LOG_PRODUTO

				return $this->db->affected_rows();
			}
			else
			{
				return $this->db->affected_rows();
			}
	}




	/*	LISTAR PRODUTOS INSTALADOS INFRA/REDES */
	public function produtos_infra()
	{
		$consulta = $this->db->query("
				SELECT pi.*, p.descricao FROM estoque_produtoitem pi
				LEFT JOIN estoque_produto p ON pi.cod_produto = p.cod_produto
				WHERE pi.cod_statusitem = 4
			");

		if($consulta)
		{
			return $consulta;
		}
	}

	public function cadastro_infra($cod_produtoitem)
	{
		$data_infra  = date('Y-m-d');
		$cod_usuario = $this->session->userdata('cod_usuario');

		$consulta = $this->db->query("
				SELECT * FROM estoque_produtoitem
				WHERE cod_produtoitem = '$cod_produtoitem'
			");

		if($consulta->num_rows()===1)
		{
			$dados = array(
				'cod_statusitem '	=> 4,
				'data_infra'		=> $data_infra
				);
			$this->db->where('cod_produtoitem', $cod_produtoitem);
			$atualiza = $this->db->update('estoque_produtoitem', $dados);


				//LOG_PRODUTO
				$data_log = date('Y-m-d');
				$dados_log = array(
		 			'descricao'			=>"Enviado Infra/Redes",
		 			'cod_usuario'		=>$cod_usuario,
		 			'cod_produtoitem'	=>$cod_produtoitem,
		 			'data_log'			=>$data_log
					);

				$log = $this->db->insert('estoque_logproduto', $dados_log);
				//END LOG_PRODUTO



			if($atualiza)
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


}//FIM MODEL GRAFICOS
<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Site_model extends CI_Model {
	
	public function telas() {
		$banners = $this->db->query ( "SELECT titulo, uri_pagina,icone FROM sys_paginas where cod_setor ='9' and atalho = '0'" );
		
		if ($banners) {
			return $banners;
		} else {
			return FALSE;
		}
	}
	public function banners() {
		$banners = $this->db->query ( "
		SELECT 
		*
		FROM 
		site_banners
		" );
		
		if ($banners) {
			return $banners;
		} else {
			return FALSE;
		}
	}
	
	/* Cadastrar novo banner no site */
	public function enviar_banner($nome, $texto_1, $texto_2, $texto_3, $btn_text, $btn_url, $cod_unidade) {
		$dados = array (
				'imagem' => $nome,
				'texto_1' => $texto_1,
				'texto_2' => $texto_2,
				'texto_3' => $texto_3,
				'btn_text' => $btn_text,
				'btn_url' => $btn_url,
				'cod_unidade' => $cod_unidade 
		);
		
		$cadastrar = $this->db->insert ( 'site_banners', $dados );
		
		if ($cadastrar) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	/* Excluir Banner */
	public function excluir_banner($cod_banner) {
		$this->db->where ( 'cod_banner', $cod_banner );
		$excluir = $this->db->delete ( 'site_banners' );
		
		if ($excluir) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	// Unidades de Negocio
	public function unidades() {
		$unidades = $this->db->query ( "
		SELECT 
		*
		FROM 
		sys_unidade
		" );
		
		if ($unidades) {
			return $unidades;
		} else {
			return FALSE;
		}
	}
	// Categoria de Serviços
	public function cat_servicos() {
		$unidades = $this->db->query ( "
		SELECT 
		*
		FROM 
		site_cat_servicos
		" );
		
		if ($unidades) {
			return $unidades;
		} else {
			return FALSE;
		}
	}
	/* Cadastrar novo serviço */
	public function enviar_servico($nome, $cod_cat_servicos, $cod_unidade, $titulo, $descricao_breve, $descricao, $url) {
		$dados = array (
				'cod_cat_servicos' => $cod_cat_servicos,
				'cod_unidade' => $cod_unidade,
				'titulo' => $titulo,
				'descricao_breve' => $descricao_breve,
				'descricao' => $descricao,
				'url' => $url,
				'imagem' => $nome 
		);
		
		$cadastrar = $this->db->insert ( 'site_servicos', $dados );
		
		$ultimo_id = $this->db->insert_id ();
		
		if ($cadastrar) {
			return $ultimo_id;
		} else {
			return FALSE;
		}
	}
	/* fim cadastrar servicos */
	
	/* Cadastrar novo serviço */
	public function atualizar_servico($cod_servico, $nome, $cod_cat_servicos, $cod_unidade, $titulo, $descricao_breve, $descricao, $url) {
		$dados = array (
				'cod_cat_servicos' => $cod_cat_servicos,
				'cod_unidade' => $cod_unidade,
				'titulo' => $titulo,
				'descricao_breve' => $descricao_breve,
				'descricao' => $descricao,
				'url' => $url,
				'imagem' => $nome 
		);
		
		$this->db->where ( 'cod_servico', $cod_servico );
		
		$atualizar = $this->db->update ( 'site_servicos', $dados );
		
		if ($atualizar) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	/* fim cadastrar servicos */
	
	/* Listar Servicos */
	public function listar_servicos() {
		$consulta = $this->db->query ( "
		SELECT
		ss.*
		,scs.descricao AS categoria
		FROM 
		site_servicos ss
		LEFT JOIN site_cat_servicos scs ON ss.cod_cat_servicos = scs.cod_cat_servicos
		" );
		
		if ($consulta) {
			return $consulta;
		} else {
			return FALSE;
		}
	}
	/* Fim Listar Servicos */
	public function servico($cod_servico) {
		$consulta = $this->db->query ( "

		SELECT
			*
		FROM 
			site_servicos
		WHERE 
			cod_servico = '$cod_servico'

		" );
		
		if ($consulta) {
			return $consulta;
		} else {
			return FALSE;
		}
	}
	public function servicos_excluir($cod_servico) {
		$this->db->where ( 'cod_servico', $cod_servico );
		$excluir = $this->db->delete ( 'site_servicos' );
		
		if ($excluir) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	/* Inicio categoria FAQ */
	public function faq() {
		$faq = $this->db->query ( "
		SELECT
		*
		FROM
		site_cat_faq
		" );
		
		if ($faq) {
			return $faq;
		} else {
			return FALSE;
		}
	}
	public function excluir_categoria($cod_cat) {
		$faq = $this->db->query ( "
		SELECT
		*
		FROM
		site_faq WHERE cod_cat_faq = '$cod_cat'
		" );
		If ($faq->num_rows () == 0) {
			$this->db->where ( 'cod_cat_faq', $cod_cat );
			$excluir = $this->db->delete ( 'site_cat_faq' );
			if ($excluir) {
				return TRUE;
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}
	public function enviar_categoria($categoia) {
		$query = $this->db->query ( "
				SELECT
				*
				FROM
				site_cat_faq WHERE descricao = '$categoia'
				" );
		If ($query->num_rows () == 0) {
			$dados = array (
					'descricao' => $categoia 
			);
			$cadastrar = $this->db->insert ( 'site_cat_faq', $dados );
			if ($cadastrar) {
				return True;
			} else {
				return FALSE;
			}
		} else {
			return False;
		}
	}
	
	/* fim categoria FAQ */
	
	/* Inicio perguntas FAQ */
	public function perguntas() {
		$faq = $this->db->query ( "SELECT site_faq.cod_faq, site_cat_faq.descricao, site_faq.pergunta, site_faq.resposta FROM isp_city10.site_faq inner join isp_city10.site_cat_faq  ON site_faq.cod_cat_faq=site_cat_faq.cod_cat_faq order by descricao;" );
		if ($faq) {
			return $faq;
		} else {
			return FALSE;
		}
	}
	public function excluir_pergunta($cod_faq) {
		$this->db->where ( 'cod_faq', $cod_faq );
		$excluir = $this->db->delete ( 'site_faq' );
		if ($excluir) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	public function enviar_pergunta($pergunta, $cod_cat_faq, $resposta) {
		$query = $this->db->query ( "
				SELECT
				*
				FROM
				site_faq WHERE cod_cat_faq = '$cod_cat_faq' and pergunta='$pergunta'" );
		If ($query->num_rows () == 0) {
			$dados = array (
					'cod_cat_faq' => $cod_cat_faq,
					'pergunta' => $pergunta,
					'resposta' => $resposta 
			);
			$cadastrar = $this->db->insert ( 'site_faq', $dados );
			if ($cadastrar) {
				return True;
			} else {
				return FALSE;
			}
		} else {
			return False;
		}
	}
	/* Fim perguntas FAQ */
	
	/* Inicio assunto email */
	public function assunto() {
		$faq = $this->db->query ( "
		SELECT
		*
		FROM
		site_emails
		" );
		
		if ($faq) {
			return $faq;
		} else {
			return FALSE;
		}
	}
	public function excluir_assunto($cod_ass) {
		$faq = $this->db->query ( "
				SELECT
				*
				FROM
				site_emails_lista WHERE cod_email = '$cod_ass'
				" );
		If ($faq->num_rows () == 0) {
			$this->db->where ( 'cod_email', $cod_ass );
			$excluir = $this->db->delete ( 'site_emails' );
			if ($excluir) {
				return TRUE;
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}
	public function enviar_assunto($assunto) {
		$query = $this->db->query ( "
				SELECT
				*
				FROM
				site_emails WHERE descricao = '$assunto'
				" );
		If ($query->num_rows () == 0) {
			$dados = array (
					'descricao' => $assunto 
			);
			$cadastrar = $this->db->insert ( 'site_emails', $dados );
			if ($cadastrar) {
				return True;
			} else {
				return FALSE;
			}
		} else {
			return False;
		}
	}
	
	/* Fim assunto email */
	
	/* Inicio email */
	public function emails() {
		$faq = $this->db->query ( "
		select a.cod_lista, a.remetente as remetente,a.email as email,b.descricao as assunto,c.cidade as unidade from isp_city10.site_emails_lista a inner join isp_city10.site_emails b on a.cod_email = b.cod_email inner join isp_city10.sys_unidade c on a.cod_unidade = c.cod_unidade;
		" );
		
		if ($faq) {
			return $faq;
		} else {
			return FALSE;
		}
	}
	public function excluir_email($cod_email) {
		$this->db->where ( 'cod_lista', $cod_email );
		$excluir = $this->db->delete ( 'site_emails_lista' );
		if ($excluir) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	public function enviar_email($remetente, $email, $cod_email, $cod_unidade) {
		$query = $this->db->query ( "
				SELECT
				*
				FROM
				site_emails_lista WHERE cod_email = '$cod_email' and email = '$email' and cod_unidade = '$cod_unidade'
				" );
		If ($query->num_rows () == 0) {
			$dados = array (
					'remetente' => $remetente,
					'email' => $email,
					'cod_email' => $cod_email,
					'cod_unidade' => $cod_unidade 
			);
			$cadastrar = $this->db->insert ( 'site_emails_lista', $dados );
			if ($cadastrar) {
				return True;
			} else {
				return FALSE;
			}
		} else {
			return False;
		}
	}
	
	/* Fim assunto email */
	
	/* Inicio contratos */
	public function contratos() {
		$faq = $this->db->query ( "
		SELECT site_contratos.cod_contrato,site_contratos.caminho,site_contratos.titulo,sys_unidade.cidade as unidade FROM isp_city10.site_contratos INNER JOIN isp_city10.sys_unidade ON site_contratos.cod_unidade = sys_unidade.cod_unidade 
		" );
		
		if ($faq) {
			return $faq;
		} else {
			return FALSE;
		}
	}
	public function excluir_contrato($cod_contrato) {
		$this->db->where ( 'cod_contrato', $cod_contrato);
		$excluir = $this->db->delete ( 'site_contratos' );
		if ($excluir) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	public function enviar_contrato($caminho, $titulo, $unidade) {
		$query = $this->db->query ( "
					SELECT
					*
					FROM
					site_contratos WHERE titulo = '$titulo' and cod_unidade = '$unidade'
					" );
		If ($query->num_rows () == 0) {
			$dados = array (
					'cod_unidade' => $unidade,
					'titulo' => $titulo,
					'caminho' => $caminho
			);
			$cadastrar = $this->db->insert ( 'site_contratos', $dados );
			if ($cadastrar) {
				return True;
			} else {
				return FALSE;
			}
		} else {
			return False;
		}
	}
	
	/* Fim contratos */
	
	/* Inicio blog */
	public function dicas_blog() {
		$faq = $this->db->query ( "
		SELECT * FROM isp_city10.site_dicas 
		" );
		
		if ($faq) {
			return $faq;
		} else {
			return FALSE;
		}
	}
	
	public function enviar_blog($imagempath,$titulo,$descricao,$data, $texto,$autor,$urlamigavel) {
		$query = $this->db->query ( "
				SELECT
				*
				FROM
				site_dicas WHERE url = '$urlamigavel' 
				" );
		If ($query->num_rows () == 0) {
			$dados = array (
					'capa' => $imagempath,
					'titulo' => $titulo,
					'descricao' => $descricao,
					'data' => $data,
					'texto' => $texto,
					'autor' => $autor,
					'url' => $urlamigavel
			);
			$cadastrar = $this->db->insert ( 'site_dicas', $dados );
			if ($cadastrar) {
				return True;
			} else {
				return FALSE;
			}
		} else {
			return False;
		}
	}
	
	public function excluir_blog ($cod_dica) {
		$this->db->where ( 'cod_dica', $cod_dica);
		$excluir = $this->db->delete ( 'site_dicas' );
		if ($excluir) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	/* Fim blog */
	
	/* Inicio log */
	public function registrar_log($cod_usuario, $atividade, $data) {
		$dados = array (
				'cod_usuario' => $cod_usuario,
				'atividade' => $atividade,
				'data' => $data 
		);
		$this->db->insert ( 'sys_log_usu', $dados );
	}
	/* Fim log */
}/*END MODEL*/
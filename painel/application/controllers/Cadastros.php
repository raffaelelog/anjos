<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Cadastros extends CI_Controller {


	public function index()
	{
		$dados['alerta'] = NULL;
		$this->load->model ( 'Cadastro_model' );

		// Novo Cadastro
		if($this->input->post('cadastrar') === 'Cadastrar')
		{
			$nome = $this->input->post('nome');
			$telefone = $this->input->post('telefone');
			$celular = $this->input->post('celular');
			$endereco = $this->input->post('endereco');
			$numero = $this->input->post('numero');
			$complemento = $this->input->post('complemento');
			$referencia = $this->input->post('referencia');
			$bairro = $this->input->post('bairro');
			$cidade = $this->input->post('cidade');
			$estado = $this->input->post('estado');
			$cep = $this->input->post('cep');
			$obs = $this->input->post('obs');

			$cadastrar = $this->Cadastro_model->cadastrar($nome, $telefone, $celular, $endereco, $numero, $complemento, $referencia, $bairro, $cidade, $estado, $cep, $obs);

			if ($cadastrar) 
			{
				$dados['alerta'] = array(
					'class' => 'success',
					'mensagem' => 'Cadastro realizado com sucesso'
				);
			}
			else
			{
				$dados['alerta'] = array(
					'class' => 'danger',
					'mensagem' => 'Algo deu errado'
				);
			}

		}
		// End Cadastrar


		if($this->input->post('buscar')==='Buscar')
		{
			$busca = $this->input->post('busca');
			$filtro = "AND (nome like '%$busca%' OR telefone LIKE '%$busca%') ";
		}
		else
		{
			$busca = '';
			$filtro = '';
		}

		
		$dados['cadastros'] = $this->Cadastro_model->cadastros($filtro, $busca);
		$this->load->view('cadastros/index', $dados);
	}




	// Tele Cadastro
	public function cadastro($cod_cadastro)
	{	
		$dados['alerta'] = NULL;
		$this->load->model ( 'Cadastro_model' );
		

		// Atualizar Atualizar
		if($this->input->post('atualizar') === 'Atualizar')
		{
			$nome = $this->input->post('nome');
			$telefone = $this->input->post('telefone');
			$celular = $this->input->post('celular');
			$endereco = $this->input->post('endereco');
			$numero = $this->input->post('numero');
			$complemento = $this->input->post('complemento');
			$referencia = $this->input->post('referencia');
			$bairro = $this->input->post('bairro');
			$cidade = $this->input->post('cidade');
			$estado = $this->input->post('estado');
			$cep = $this->input->post('cep');
			$obs = $this->input->post('obs');

			$atualizar = $this->Cadastro_model->atualizar($cod_cadastro, $nome, $telefone, $celular, $endereco, $numero, $complemento, $referencia, $bairro, $cidade, $estado, $cep, $obs);

			if ($atualizar) 
			{
				$dados['alerta'] = array(
					'class' => 'success',
					'mensagem' => 'Cadastro atualizado com sucesso'
				);
			}
			else
			{
				$dados['alerta'] = array(
					'class' => 'danger',
					'mensagem' => 'Algo deu errado'
				);
			}

		}
		// End Atualizar


		// Atualizar Atualizar
		if($this->input->post('cadastrar_fatura') === 'Cadastrar')
		{
			$cod_status = 1;
			$data_emissao = date('Y-m-d');
			$data_vencimento = $this->input->post('data_vencimento');
			$valor = $this->input->post('valor');

			$atualizar = $this->Cadastro_model->cadastrar_fatura($cod_cadastro, $cod_status, $data_emissao, $data_vencimento, $valor);

			if ($atualizar) 
			{
				$dados['alerta'] = array(
					'class' => 'success',
					'mensagem' => 'Cadastro realizado com sucesso'
				);
			}
			else
			{
				$dados['alerta'] = array(
					'class' => 'danger',
					'mensagem' => 'Algo deu errado'
				);
			}

		}
		// End Atualizar


		// Fatura Recorrente
		if ($this->input->post('fatura_recorrente') === 'Cadastrar') 
		{
			$dia_vencimento = $this->input->post('dia_vencimento');
			$valor = $this->input->post('valor');

			$cadastrar = $this->Cadastro_model->cadastrar_fatura_recorrente($cod_cadastro, $dia_vencimento, $valor);

			if ($cadastrar) 
			{
				$dados['alerta'] = array(
					'class' => 'success',
					'mensagem' => 'Cadastro realizado com sucesso'
				);
			}
			else
			{
				$dados['alerta'] = array(
					'class' => 'danger',
					'mensagem' => 'Algo deu errado'
				);
			}
		}

		// Excluir fatura recorrente
		if($this->input->post('excluir_fatura_recorrente') === 'Excluir')
		{
			$cod_fatura_recorrente = $this->input->post('cod_fatura_recorrente');
			$excluir = $this->Cadastro_model->excluir_fatura_recorrente($cod_fatura_recorrente);

			if ($excluir) 
			{
				$dados['alerta'] = array(
					'class' => 'success',
					'mensagem' => 'Item Excluído'
				);
			}
			else
			{
				$dados['alerta'] = array(
					'class' => 'danger',
					'mensagem' => 'Algo deu errado'
				);
			}
		}


		$dados['fatura_recorrente'] = $this->Cadastro_model->fatura_recorrente($cod_cadastro);
		$dados['faturas_cadastro'] = $this->Cadastro_model->faturas_cadastro($cod_cadastro);
		$dados['cadastro'] = $this->Cadastro_model->cadastro($cod_cadastro);
		$this->load->view('cadastros/cadastro', $dados);
	}










}// FIM Controller


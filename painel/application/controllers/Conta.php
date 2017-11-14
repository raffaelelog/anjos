<?php

class Conta extends CI_Controller {

	

	public function entrar()

	{

		$dados['alerta'] = NULL;

		$this->load->model('usuarios_model');

		if($this->input->post('entrar')==='Entrar')

		{

			$this->form_validation->set_rules('email','EMAIL','required|trim');

			$this->form_validation->set_rules('senha','SENHA','required|trim');

			if($this->form_validation->run() === TRUE)

			{

				$email = trim($this->input->post('email'));

				$senha = $this->input->post('senha'); 

				$login_existe = $this->usuarios_model->check_login($email, $senha);				 

				if($login_existe)
				{
					$usuario = $login_existe;

					$cod_usuario = $usuario['cod_usuario'];

					$permissoes_usuario = $this->usuarios_model->permissoes_usuario($cod_usuario);

					$uris = '';

					foreach ($permissoes_usuario->result() as $permissoes) {

						$uris .= $permissoes->uri_pagina."-";
					}

					$session = array(

			        'email'  		=> $usuario['email'],

			        'nome'  		=> $usuario['nome'],

			        'cod_usuario'	=> $usuario['cod_usuario'],

			        'cod_unidade'	=> $usuario['cod_unidade'],

			        'logado' 		=> TRUE,

			        'nivel'	 		=> $usuario['nivel'],

			        'permissoes'	=> $uris



					);

					$this->session->set_userdata($session);

					redirect('painel');

				}

				else

				{

					//array com a classe e mensagem a serrem exibidas

					//em caso de erro de autenticação

					$dados['alerta'] = array(

						'class' => 'danger',

						'mensagem' => 'Verifique usuário e senha'

					);

				}

			} 

			else

			{

				//array com a classe e mensagem a serrem exibidas

				//em caso de erro de validação

				$dados['alerta'] = array(

					'class' => 'danger',

					'mensagem' => 'Falha na validação dos dados'

				);

			}	 

		}

		if($this->input->post('senha')==='Solicitar')

		{

			$email = $this->input->post('email');

			$verifica_email = $this->usuarios_model->verifica_email_existe($email);

			if($verifica_email)

			{

				/*Gera nova senha e novo salt*/

				$senha = rand(); 

                $salt =  rand(4564646454465,978465465465464656565);

                /*Atualiza com a nova senha gerada*/

                $atualiza_nova_senha = $this->usuarios_model->recupera_senha_usuario($email, $senha, $salt);

                /*Envia um e-mail com a nova senha*/

                $assunto = "Troca de senha do Operate";    

                $msg = "Sua nova senha do Operate é $senha <br>. Favor troca-la no próximo acesso através do seu perfil em: http://operate.city10.com.br/perfil/trocar_senha. ";

                $this->load->library('email');

                $this->email->to ($email, 'Usuario');

                $this->email->from ("ti.desenvolvimento@cityshop.com.br", 'Operate - City10 Desenvolvimento');

                $this->email->subject (utf8_decode($assunto));

                $this->email->message ($msg);

                if($this->email->send ())

                {

                /*Retorna um alert*/

				$dados['alerta'] = array(

					'class' => 'info',

					'mensagem' => 'Nova senha enviada para seu e-mail.'

					);

				}

				else

				{

					$dados['alerta'] = array(

					'class' => 'info',

					'mensagem' => 'Não foi possivel enviar sua senha, favor entrar em contato com o suporte!'

					);

				}

			}/*Caso o e-mail não seja encontrado no banco*/

			else

			{

				$dados['alerta'] = array(

					'class' => 'danger',

					'mensagem' => 'E-mail não cadastrado.'

					);

			}

		}

		$this->load->view('conta/entrar', $dados);

	}

	public function sair()

	{

		$this->session->unset_userdata('cod_usuario');

		redirect('conta/entrar');

	}

}
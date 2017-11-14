<?php
class Perfil extends CI_Controller {
	function __construct() {
		// Construct the parent class
		parent::__construct ();
		$this->load->model('Usuarios_model');
	}
	public function index() {
		$alerta = null;
		$dados = array (
				'alerta' => $alerta 
		);
		$cod_usuario = $this->session->userdata ( 'cod_usuario' );
		$dados ['users'] = $this->Usuarios_model->usuario_dados_perfil($cod_usuario);
		$this->load->view ( 'conta/perfil', $dados );
	}
	public function atualizar() {
		$alerta = null;
		$this->form_validation->set_rules ( 'nome', 'NOME', 'required' );
		$this->form_validation->set_rules ( 'email', 'EMAIL', 'required|valid_email' );
		if ($this->form_validation->run () === TRUE) {
			$nome = $this->input->post ( 'nome' );
			$email = $this->input->post ( 'email' );
			$tecnico = $this->input->post ( 'tecnico' );
			$cod_usuario = $this->session->userdata ( 'cod_usuario' );
			$atualiza_perfil = $this->Usuarios_model->atualiza_perfil ( $cod_usuario, $nome, $email, $tecnico );
			if ($atualiza_perfil) {
				// array com a classe e mensagem a serrem exibidas
				$alerta = array (
						'class' => 'success',
						'mensagem' => 'Dados atualizados com sucesso!' 
				);
			} else {
				// array com a classe e mensagem a serrem exibidas
				$alerta = array (
						'class' => 'danger',
						'mensagem' => 'Não foi possível atualizar!' 
				);
			}
		} else {
			// array com a classe e mensagem a serem exibidas
			// em caso de erro de validação
			$alerta = array (
					'class' => 'danger',
					'mensagem' => 'Falha na validação dos dados' 
			);
		}
		$dados = array (
				'alerta' => $alerta 
		);
		$cod_usuario = $this->session->userdata ( 'cod_usuario' );
		$dados ['users'] = $this->Usuarios_model->usuario_dados_perfil($cod_usuario);
		$this->load->view ( 'conta/perfil', $dados );
	}
	
	public function trocar_senha() {
		$alerta = null;
		$this->form_validation->set_rules ( 'senha', 'Senha', 'trim|required' );
		$this->form_validation->set_rules ( 'confsenha', 'Senha Confirmação', 'trim|required|matches[senha]' );
		if ($this->form_validation->run () === TRUE) {
			$senha = $this->input->post ( 'senha' );
			$salt = rand ( 4564646454465, 978465465465464656565 );
			$cod_usuario = $this->session->userdata ( 'cod_usuario' );
			$atualiza_perfil = $this->Usuarios_model->atualiza_senha ( $cod_usuario, $senha, $salt );
			if ($atualiza_perfil) {
				// array com a classe e mensagem a serrem exibidas
				$alerta = array (
						'class' => 'success',
						'mensagem' => 'Dados atualizados com sucesso!' 
				);
			} else {
				// array com a classe e mensagem a serrem exibidas
				$alerta = array (
						'class' => 'danger',
						'mensagem' => 'Não foi possível atualizar!' 
				);
			}
		} else {
			// array com a classe e mensagem a serrem exibidas
			// em caso de erro de validação
			$alerta = array (
					'class' => 'danger',
					'mensagem' => 'As senhas não correspondem.' 
			);
		}
		$dados = array (
				'alerta' => $alerta 
		);
		$cod_usuario = $this->session->userdata ( 'cod_usuario' );
		$dados ['users'] = $this->Usuarios_model->usuario_dados_perfil($cod_usuario);
		$this->load->view ( 'conta/perfil', $dados );
	}
}
<?php
class Usuarios extends CI_Controller {
	function __construct() {
		// Construct the parent class
		parent::__construct ();		
		$this->load->model ( 'Usuarios_model' );
	}
	public function index() {
		$dados = array (
				'alerta' => null 
		);
		$dados ['usuarios'] = $this->Usuarios_model->usuarios ();
		$dados ['setores'] = $this->Usuarios_model->setores ();
		$dados ['unidades'] = $this->Usuarios_model->unidades ();
		$dados ['cargo'] = $this->Usuarios_model->usuarios_cargos ();
		$this->load->view ( 'rh/usuarios', $dados );
	}
	public function logs() {
		$dados ['alerta'] = null;
		$dados ['cadastros'] = $this->Usuarios_model->log_usuarios_ativos();
		$this->load->view ( 'redes/usuarios_log', $dados );
	}
	public function log_usu($cod_usuario) {
		$dados ['alerta'] = null;
		$dados ['logs'] = $this->Usuarios_model->log_usuario($cod_usuario);
		$this->load->view ( 'redes/usuario_log', $dados );
	}
	public function status($cod_usuario) {
		$alerta = null;
		$modificar = $this->Usuarios_model->bloquear_usuario( $cod_usuario );
		if ($modificar) {
			$alerta = array (
					'class' => 'info',
					'mensagem' => 'Modificado o estatus do Usuário com sucesso!' 
			);
		} else {
			$alerta = array (
					'class' => 'danger',
					'mensagem' => 'Não foi possível  modificar o estatus do usuário!'
			);
		}
		$dados = array (
				'alerta' => $alerta 
		);
		$dados ['cargo'] = $this->Usuarios_model->usuarios_cargos ();
		$dados ['usuarios'] = $this->Usuarios_model->usuarios ();
		$dados ['setores'] = $this->Usuarios_model->setores ();
		$dados ['unidades'] = $this->Usuarios_model->unidades ();
		$this->load->view ( 'rh/usuarios', $dados );
	}
	public function novo_usuario() {
		$alerta = null;
		$this->form_validation->set_rules ( 'nome', 'NOME', 'required' );
		$this->form_validation->set_rules ( 'email', 'EMAIL', 'required|valid_email');
		$this->form_validation->set_rules ( 'cpf', 'Cpf', 'trim|required' );
		$this->form_validation->set_rules ( 'senha', 'Senha', 'trim|required' );
		$this->form_validation->set_rules ( 'confsenha', 'Senha Confirmação', 'trim|required|matches[senha]' );
		$this->form_validation->set_rules ( 'telefone_1', 'Telefone', 'trim|required' );
		$this->form_validation->set_rules ( 'cargo', 'Cargo', 'trim|required' );
		$this->form_validation->set_rules ( 'endereco', 'Endereco', 'trim|required' );
		if ($this->form_validation->run () === TRUE) {
			$ativo = $this->input->post ( 'ativo' );
			$cod_setor = $this->input->post ( 'cod_setor' );
			$cod_unidade = $this->input->post ( 'cod_unidade' );
			$cpf = str_replace(".", "", str_replace("-", "", $this->input->post('cpf')));
			$cargo = $this->input->post ( 'cargo' );
			$email = $this->input->post ( 'email' );
			$endereco = $this->input->post ( 'endereco' );
			$nivel = $this->input->post ( 'nivel' );
			$nome = $this->input->post ( 'nome' );
			$senha = $this->input->post ( 'senha' );
			$salt = rand ( 4564646454465, 978465465465464656565 );
			$tecnico = $this->input->post ( 'tecnico' );
			$telefone_1 = str_replace(")", "", str_replace("(", "", str_replace("-", "", $this->input->post('telefone_1'))));
			if( $this->input->post ( 'telefone_2' ) != ''){
				$telefone_2 = str_replace(")", "", str_replace("(", "", str_replace("-", "", $this->input->post('telefone_2'))));
			}else{
				$telefone_2 ='';
			}
			$usuario_existe = $this->Usuarios_model->usuario_existe($email,$cpf);
			if($usuario_existe){
				if($_FILES['foto']['size'] != 0){
					$config['upload_path']          = './source/fotos_user/';
					$config['allowed_types']        = 'jpg|png|jpeg';
					$config['max_size']             = 1000;
					$config['max_width']            = 1024;
					$config['max_height']           = 768;
					$config['file_name']           	= $cpf;
					$this->load->library('upload', $config);
					$this->upload->do_upload('foto');
					$nome_foto = $this->upload->data('file_name');
				}
				else{
					$nome_foto = '';
				}
				$novo_usuario = $this->Usuarios_model->novo_usuario ($ativo,$cod_setor,$cod_unidade,$cpf,$cargo,$email,$endereco,$nivel,$nome,$senha,$salt,$tecnico,$telefone_1,$telefone_2,$nome_foto);
				if ($novo_usuario) {
					$alerta = array (
							'class' => 'success',
							'mensagem' => 'Usuário cadastrado com sucesso!'
					);
				} else {
					$alerta = array (
							'class' => 'danger',
							'mensagem' => 'Não foi possível cadastrar o usuário!'
					);
				}
			}else {
				$alerta = array (
						'class' => 'danger',
						'mensagem' => 'Não foi possível cadastrar o usuário, esse usuário ja existe!'
				);
			}
		} else {
			$alerta = array (
					'class' => 'danger',
					'mensagem' => 'Erro na validação dos dados' 
			);
		}
		$dados = array (
				'alerta' => $alerta 
		);
		$dados ['cargo'] = $this->Usuarios_model->usuarios_cargos ();
		$dados ['usuarios'] = $this->Usuarios_model->usuarios ();
		$dados ['setores'] = $this->Usuarios_model->setores ();
		$dados ['unidades'] = $this->Usuarios_model->unidades ();
		$this->load->view ( 'rh/usuarios', $dados );
	}
	// CARREGAR USUARIO NA PAGINA PARA EDITAR
	public function editar_usuario($cod_usuario) {
		$dados = array (
				'alerta' => null 
		);
		$dados ['cargo'] = $this->Usuarios_model->usuarios_cargos ();
		$dados ['usuario_editar'] = $this->Usuarios_model->usuario ( $cod_usuario );
		$dados ['setores'] = $this->Usuarios_model->setores ();
		$dados ['unidades'] = $this->Usuarios_model->unidades ();		
		$this->load->view ( 'rh/usuario', $dados );
	}
	// EDITAR USUARIO
	public function usuario_atualizar($cod_usuario) {
		$alerta = null;
		$this->form_validation->set_rules ( 'nome', 'NOME', 'required' );
		$this->form_validation->set_rules ( 'email', 'EMAIL', 'required|valid_email');
		$this->form_validation->set_rules ( 'cpf', 'Cpf', 'trim|required' );
		$this->form_validation->set_rules ( 'telefone_1', 'Telefone', 'trim|required' );
		$this->form_validation->set_rules ( 'cargo', 'Cargo', 'trim|required' );
		$this->form_validation->set_rules ( 'endereco', 'Endereco', 'trim|required' );
		if ($this->form_validation->run () === TRUE) {			
			$cod_setor = $this->input->post ( 'cod_setor' );
			$cod_unidade = $this->input->post ( 'cod_unidade' );
			$cpf = str_replace(".", "", str_replace("-", "", $this->input->post('cpf')));
			$cargo = $this->input->post ( 'cargo' );
			$email = $this->input->post ( 'email' );
			$endereco = $this->input->post ( 'endereco' );
			$nivel = $this->input->post ( 'nivel' );
			$nome = $this->input->post ( 'nome' );
			$tecnico = $this->input->post ( 'tecnico' );
			$telefone_1 = str_replace(")", "", str_replace("(", "", str_replace("-", "", $this->input->post('telefone_1'))));
			if( $this->input->post ( 'telefone_2' ) != ''){
				$telefone_2 = str_replace(")", "", str_replace("(", "", str_replace("-", "", $this->input->post('telefone_2'))));
			}else{
				$telefone_2 ='';
			}
			$atualiza_usuario = $this->Usuarios_model->usuario_atualizar ($cod_usuario,$cod_setor,$cod_unidade,$cpf,$cargo,$email,$endereco,$nivel,$nome,$tecnico,trim($telefone_1),trim($telefone_2));
			if ($atualiza_usuario) {
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
					'mensagem' => 'Falha na validação dos dados' 
			);
		}
		$dados = array (
				'alerta' => $alerta 
		);
		$dados ['cargo'] = $this->Usuarios_model->usuarios_cargos ();
		$dados ['usuario_editar'] = $this->Usuarios_model->usuario ( $cod_usuario );
		$dados ['setores'] = $this->Usuarios_model->setores ();
		$dados ['unidades'] = $this->Usuarios_model->unidades ();
		$this->load->view ( 'rh/usuario', $dados );
	}
	public function trocar_senha_usuario($cod_usuario) {
		$alerta = null;
		$this->form_validation->set_rules ( 'senha', 'Senha', 'trim|required' );
		$this->form_validation->set_rules ( 'confsenha', 'Senha Confirmação', 'trim|required|matches[senha]' );
		if ($this->form_validation->run () === TRUE) {
			$senha = $this->input->post ( 'senha' );
			$salt = rand ( 4564646454465, 978465465465464656565 );
			$atualiza_perfil = $this->Usuarios_model->atualiza_senha_usuario ( $cod_usuario, $senha, $salt );
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
		$dados ['usuario_editar'] = $this->Usuarios_model->usuario ( $cod_usuario );
		$dados ['usuarios'] = $this->Usuarios_model->usuarios ();
		$dados ['setores'] = $this->Usuarios_model->setores ();
		$dados ['unidades'] = $this->Usuarios_model->unidades ();
		$dados ['cargo'] = $this->Usuarios_model->usuarios_cargos ();
		$this->load->view ( 'rh/usuario', $dados );
	}
	public function paginas() {
		$dados ['alerta'] = null;
		/* INICIO CADASTRAR NOVA PÁGINA */
		if ($this->input->post ( 'novo' ) === 'Cadastrar') {
			$cod_setor = $this->input->post ( 'cod_setor' );
			$titulo = $this->input->post ( 'titulo' );
			$uri_pagina = $this->input->post ( 'uri_pagina' );
			$icone = $this->input->post ( 'icone' );
			$atalho = $this->input->post ( 'atalho' );
			$cadastrar_pagina = $this->Usuarios_model->cadastrar_pagina ( $cod_setor, $titulo, $uri_pagina, $icone, $atalho );
			if ($cadastrar_pagina) {
				$dados ['alerta'] = array (
						'class' => 'success',
						'mensagem' => 'Página cadastrada com sucesso!' 
				);
			} else {
				$dados ['alerta'] = array (
						'class' => 'danger',
						'mensagem' => 'Não foi possível cadastrar a página.' 
				);
			}
		}
		/* FIM CADASTRAR NOVA PÁGINA */
		/* INICIO EXCLUIR PÁGINA */
		if ($this->input->post ( 'excluir' ) === 'Excluir') {
			$cod_pagina = $this->input->post ( 'cod_pagina' );
			$excluir_pagina = $this->Usuarios_model->excluir_pagina ( $cod_pagina );
			if ($excluir_pagina) {
				$dados ['alerta'] = array (
						'class' => 'info',
						'mensagem' => 'Página excluída com sucesso!' 
				);
			} else {
				$dados ['alerta'] = array (
						'class' => 'danger',
						'mensagem' => 'Não foi possível excluír a página.' 
				);
			}
		}
		/* FIM EXCLUIR NOVA PÁGINA */
		$dados ['setores'] = $this->Usuarios_model->setores ();
		$dados ['paginas'] = $this->Usuarios_model->paginas ();
		$this->load->view ( 'redes/paginas', $dados );
	}
	public function trocar_foto($cod_usuario) {
		$alerta = null;
		$usuario = $this->Usuarios_model->usuario ( $cod_usuario );
		if($_FILES['foto']['size'] != 0){
			$cpf = $usuario-> row()->cpf ;
			if($cpf != ''){
				$foto = $usuario-> row()->foto;
				if($foto != ''){
					$caminho = "source/fotos_user/".$foto;
					unlink ( FCPATH . $caminho );
				}
				$config['upload_path']          = './source/fotos_user/';
				$config['allowed_types']        = 'jpg|png|jpeg';
				$config['max_size']             = 1000;
				$config['max_width']            = 1024;
				$config['max_height']           = 768;
				$config['file_name']           	= $cpf;
				$this->load->library('upload', $config);
				$this->upload->do_upload('foto');
				$nome_foto = $this->upload->data('file_name');
				if($this->Usuarios_model->atualizar_foto($nome_foto, $cod_usuario)){
					$alerta = array (
							'class' => 'success',
							'mensagem' => 'Imagem salva com sucesso!'
					);
				}else{
					$alerta = array (
							'class' => 'danger',
							'mensagem' => 'Problemas ao enviar a foto!'
					);
				}
			}else{
				$alerta = array (
						'class' => 'danger',
						'mensagem' => 'Insira o CPF do usuario antes de adicionar a foto!'
				);
			}
		}else {
			$alerta = array (
					'class' => 'danger',
					'mensagem' => 'Nenhuma imagem foi selecionada!'
			);
		}
		$dados = array (
				'alerta' => $alerta
		);
		$dados ['usuario_editar'] = $usuario;
		$dados ['cargo'] = $this->Usuarios_model->usuarios_cargos ();
		$dados ['setores'] = $this->Usuarios_model->setores ();
		$dados ['unidades'] = $this->Usuarios_model->unidades ();
		$this->load->view ( 'rh/usuario', $dados );
	}
	public function permissoes($cod_usuario) {
		$dados = array (
				'alerta' => null 
		);
		if ($this->input->post ( 'mudar_permissao' ) === 'Retirar Permissão') {
			$cod_pagina = $this->input->post ( 'cod_pagina' );
			$mudar_permissao = $this->Usuarios_model->negar ( $cod_usuario, $cod_pagina );
			if ($mudar_permissao) {
				$dados ['alerta'] = array (
						'class' => 'info',
						'mensagem' => 'Permissão retirada com sucesso!' 
				);
			}
		} // END NEGAR
		if ($this->input->post ( 'mudar_permissao' ) === 'Permitir') {
			$cod_pagina = $this->input->post ( 'cod_pagina' );
			$uri_pagina = $this->input->post ( 'uri_pagina' );
			$mudar_permissao = $this->Usuarios_model->permitir ( $cod_usuario, $cod_pagina, $uri_pagina );
			if ($mudar_permissao) {
				$dados ['alerta'] = array (
						'class' => 'success',
						'mensagem' => 'Permissão concedida com sucesso!' 
				);
			}
		} // END PERMITIR
		if($this->input->post ( 'clonar' ) === 'Clonar'){
			$clone = $this->Usuarios_model->clonar($cod_usuario,$this->input->post ('clone'));
			if ($clone) {
				$dados ['alerta'] = array (
						'class' => 'success',
						'mensagem' => 'Clonado com sucesso!');
			}else{
				$dados ['alerta'] = array (
						'class' => 'danger',
						'mensagem' => 'Erro ao clonar!');
			}
		}
		$dados ['categorias_permissoes'] = $this->Usuarios_model->permissoes_usuarios($cod_usuario);
		$dados ['usuario'] = $this->Usuarios_model->dados_usu($cod_usuario);
		$dados ['quantidade'] = $this->Usuarios_model->permissoes_quantidade($cod_usuario);
		$dados ['usuarios'] = $this->Usuarios_model->dados_usuarios();
		$this->load->view ( 'rh/permissoes', $dados );
	}
} 
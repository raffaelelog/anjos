<?php
defined('BASEPATH') OR exit('Nenhum script de acesso será permetido!!');
class Usuarios_model extends CI_Model {
	//LOGIN DE USUARIO
	public function check_login($email, $senha)
	{
		$query = $this->db->query("select * from sys_usuarios where email = '$email'");
		foreach ($query->result() as $usuario)
		{
		        $salt = $usuario->salt; 
		}
		@$hash = md5($senha . $salt);
        $this->db->from('sys_usuarios');
		$this->db->where('email', $email);
		$this->db->where('ativo', 1);
		$this->db->where('senha', $hash);
		$usuarios = $this->db->get();		
		if($usuarios->num_rows())
		{
			$usuario = $usuarios->result_array(); 
			return $usuario[0];
		}
		else
		{
			return FALSE;
		}
	}
	public function clonar($cod_usuario_clone,$cod_usuario_clonado)
	{
		$query = $this->db->query("select cod_pagina,uri_pagina from sys_permissoes where cod_usuario = '$cod_usuario_clonado'");
		if($query->num_rows()!= 0){
			$query1 = $this->db->query("select cod_pagina,uri_pagina from sys_permissoes where cod_usuario = '$cod_usuario_clone'");
			if($query1->num_rows()!= 0){
				$this->db->where('cod_usuario',$cod_usuario_clone);
				$this->db->delete('sys_permissoes');
			}
			foreach ($query->result() as $permissoes)
			{
				$this->db->set('cod_usuario', $cod_usuario_clone);
				$this->db->set('cod_pagina', $permissoes->cod_pagina);
				$this->db->set('uri_pagina', $permissoes->uri_pagina);
				$this->db->insert('sys_permissoes');
			}
			$query = $this->db->query("select cod_usuario from sys_permissoes where cod_usuario = '$cod_usuario_clone'");
			if($query->num_rows() != 0)
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
		}else{
			return FALSE;
		}
	}
	public function usuarios_cargos()
	{
		$query = $this->db->query("select * from sys_cargo");
		
		if($query)
		{
			return $query;
		}
		else
		{
			return FALSE;
		}
	}
	public function log_usuarios_ativos()
	{
		$query = $this->db->query("select a.cod_usuario as cod_usuario, a.nome as nome,a.email as email,b.cidade as unidade from sys_usuarios as a inner join sys_unidade as b on a.cod_unidade = b.cod_unidade where ativo = 1");
		if($query)
		{
			return $query;
		} 
		else
		{
			return FALSE;
		}
	}
	public function log_usuario($cod_usuario)
	{
		$query = $this->db->query("SELECT * FROM sys_log_usu where cod_usuario = '$cod_usuario' ORDER BY data DESC; ");
		if($query)
		{
			return $query;
		}
		else
		{
			return FALSE;
		}
	}
	//CARREGAR DADOS DO USUARIO
	public function usuario($cod_usuario){
		$this->db->from('sys_usuarios');
		$this->db->where("cod_usuario = '$cod_usuario'");
		$users2 = $this->db->get();
		return $users2;
	}
	//CARREGAR DADOS DO USUARIO
	public function usuario_dados_perfil($cod_usuario){
			return $this->db->query("SELECT s.cod_usuario as cod_usuario, s.nome as nome, s.email as email, s.telefone_1 as telefone_1,s.telefone_2 as telefone_2, s.cpf as cpf, CONCAT( sy.descri_setor , '( ' , ss.cidade , ')' )as setor, s.foto as fotos, s.endereco as endereco FROM sys_usuarios as s
			inner join sys_setor as sy on sy.cod_setor = s.cod_setor
			inner join sys_unidade as ss on ss.cod_unidade = s.cod_unidade 
			where cod_usuario = '$cod_usuario';");
	}
	//ATUALIZAR DADOS DO USUARIO
	public function atualiza_perfil($cod_usuario, $nome, $email)
	{
		$data = array(
	        'nome' => $nome,
	        'email' => $email
		);
		$this->db->where('cod_usuario', $cod_usuario);
		$atualiza = $this->db->update('sys_usuarios', $data);
		if($atualiza)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	} 
	//ATUALIZAR SENHA DO USUARIO
	public function atualiza_senha($cod_usuario, $senha, $salt)
	{	
		@$hash = md5($senha . $salt);
        $data = array(
	        'senha' => $hash,
	        'salt' => $salt
		);
		$this->db->where('cod_usuario', $cod_usuario);
		$atualiza = $this->db->update('sys_usuarios', $data);

		if($atualiza)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	//EXIBIR USUARIOS CADASTRADOS
	public function usuarios()
	{	
		$usuarios = $this->db->query("SELECT s.cod_usuario as cod_usuario, s.nome as nome, s.email as email,sy.descri_setor as setor, s.ativo as ativo, ss.cidade as unidade FROM sys_usuarios as s
				inner join sys_setor as sy on sy.cod_setor = s.cod_setor
				inner join sys_unidade as ss on ss.cod_unidade = s.cod_unidade");
		if($usuarios)
		{
			return $usuarios;
		}
		else
		{
			return FALSE;
		}
	}
	public function bloquear_usuario($cod_usuario)
	{
		$usuarios = $this->db->query("SELECT ativo FROM sys_usuarios WHERE cod_usuario = '$cod_usuario'");
		if($usuarios->row(0)->ativo == 0){
			$data = array('cod_usuario'=> $cod_usuario,'ativo'=> '1');
			$this->db->where('cod_usuario', $cod_usuario);
			$atualiza = $this->db->update('sys_usuarios', $data);
		}else{
			$data = array('cod_usuario'=> $cod_usuario,'ativo'=> '0');
			$this->db->where('cod_usuario', $cod_usuario);
			$atualiza = $this->db->update('sys_usuarios', $data);
		}
		
		if($atualiza)
		{
			return TRUE;
		}else{
			return FALSE;
		}
	}
	public function permissoes_usuarios($cod_usuario)
	{
		$permissoes=$this->db->query ( "SELECT if(p.cod_pagina IN(select per.cod_pagina FROM sys_permissoes per where cod_usuario = '$cod_usuario' ),'1', '0') AS permissao,p.cod_pagina as cod_pagina, p.titulo as titulo, p.cod_setor as cod_setor, p.uri_pagina as uri_pagina,ss.descri_setor as descri_setor
			FROM sys_paginas p 
			inner join sys_setor as ss on ss.cod_setor = p.cod_setor
			ORDER BY ss.descri_setor,p.titulo asc" );
		if($permissoes)
		{
			return $permissoes;
		}
	}
	public function dados_usuarios()
	{
		$permissoes=$this->db->query ( "SELECT s.cod_usuario as cod_usuario,s.nome as nome,sy.descri_setor as descri_setor FROM sys_usuarios as s 
			inner join sys_setor as sy on s.cod_setor = sy.cod_setor
			where s.ativo = '1' and s.nivel = '1' order by s.nome" );
		if($permissoes)
		{
			return $permissoes;
		}
	}
	public function dados_usu($cod_usuario)
	{
		$permissoes=$this->db->query ( "SELECT ss.cod_usuario,ss.nome,se.descri_setor from sys_usuarios as ss 
			inner join sys_setor as se on se.cod_setor = ss.cod_setor
			where ss.cod_usuario = '$cod_usuario'" );
		if($permissoes)
		{
			return $permissoes;
		}
	}
	public function permissoes_quantidade($cod_usuario)
	{
		$permissoes=$this->db->query ( "SELECT * from sys_permissoes where cod_usuario = '$cod_usuario'" );
		if($permissoes)
		{
			return $permissoes;
		}
	}
	public function usuario_existe($email,$cpf)
	{
		$query = $this->db->query ( "SELECT email FROM sys_usuarios WHERE email ='$email' or cpf = '$cpf'" );
		if($query->num_rows () == 0){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	public function novo_usuario($ativo,$cod_setor,$cod_unidade,$cpf,$cargo,$email,$endereco,$nivel,$nome,$senha,$salt,$tecnico,$telefone_1,$telefone_2,$fotos)
	{
		
		@$hash = md5($senha . $salt);
		$dados = array(
				'ativo' 				=> $ativo,
				'cod_setor' 			=> $cod_setor,
				'cod_unidade' 			=> $cod_unidade,
				'cpf' 					=> $cpf,
				'cod_cargo' 			=> $cargo,
				'email' 				=> $email,
				'endereco' 				=> $endereco,
				'nivel' 				=> $nivel,
				'nome' 					=> $nome,
				'senha' 				=> $hash,
				'salt' 					=> $salt,
				'tecnico' 				=> $tecnico,
				'telefone_1' 			=> $telefone_1,
				'telefone_2' 			=> $telefone_2,
				'foto'					=> $fotos
		);
		$str = $this->db->insert('sys_usuarios', $dados);
		if($str)
		{
			return TRUE;
		}else{
			return FALSE;
		}
				
	}
	public function usuario_atualizar ($cod_usuario,$cod_setor,$cod_unidade,$cpf,$cargo,$email,$endereco,$nivel,$nome,$tecnico,$telefone_1,$telefone_2)
	{		
		$data = array(
	        'cod_setor' 			=> $cod_setor,
	        'cod_unidade' 			=> $cod_unidade,
			'cpf' 					=> $cpf,
			'cod_cargo' 			=> $cargo,
			'email' 				=> $email,
			'endereco' 				=> $endereco,
			'nivel' 				=> $nivel,
			'nome' 					=> $nome,
			'tecnico' 				=> $tecnico,
			'telefone_1' 			=> $telefone_1,
			'telefone_2' 			=> $telefone_2
		);
		$this->db->where('cod_usuario', $cod_usuario);
		$atualiza = $this->db->update('sys_usuarios', $data);
		if($atualiza)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	//ATUALIZAR SENHA DO USUARIO ID
	public function atualiza_senha_usuario($cod_usuario, $senha, $salt)
	{	
		@$hash = md5($senha . $salt);
		$data = array(
	        'senha' => $hash,
	        'salt' => $salt
		);
		$this->db->where('cod_usuario', $cod_usuario);
		$atualiza = $this->db->update('sys_usuarios', $data);
		if($atualiza)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	//ATUALIZAR SENHA DO USUARIO ID
	public function recupera_senha_usuario($email, $senha, $salt)
	{	
		@$hash = md5($senha . $salt);
		$data = array(
	        'senha' => $hash,
	        'salt' => $salt
		);
		$this->db->where('email', $email);
		$atualiza = $this->db->update('sys_usuarios', $data);
		if($atualiza)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}	
	}
	//CARREGAR SETORES CADASTRADOS
	public function setores()
	{
        $this->db->from('sys_setor');
		$setores = $this->db->get();
		return $setores;
	}
	//CARREGAR UNIDADES CADASTRADOS
	public function unidades()
	{
        $this->db->from('sys_unidade');
		$setores = $this->db->get();
		return $setores;
	}
 	//CADASTRAR NOVA PÁGINA
 	public function cadastrar_pagina($cod_setor, $titulo, $uri_pagina, $icone, $atalho)
 	{
 		
 		$query = $this->db->query ( "SELECT cod_setor FROM sys_paginas WHERE cod_setor ='$cod_setor' AND uri_pagina = '$uri_pagina'; " );
 		if($query->num_rows () == 0){
 			$dados = array(
 					'cod_setor' 			=> $cod_setor,
 					'titulo' 				=> $titulo,
 					'uri_pagina' 			=> $uri_pagina,
 					'icone' 				=> $icone,
 					'atalho'				=> $atalho
 			);
 			$str = $this->db->insert('sys_paginas', $dados);
 			if($str)
 			{
 				return TRUE;
 			}else{
 				return FALSE;
 			}
 		}else{
 			return FALSE;
 		}
 	}
 	/*FIM CADASTRAR PÁGINA*/
 	//BUSCAR PÁGINAS
 	public function paginas()
 	{
 		$consulta = $this->db->query("
				SELECT
				*
				FROM sys_paginas sp
				LEFT JOIN sys_setor ss ON sp.cod_setor = ss.cod_setor
				ORDER BY ss.descri_setor
			");
		if($consulta)
		{
			return $consulta;
		}
 	}
 	//EXCLUIR PÁGINA
 	public function excluir_pagina($cod_pagina)
	{
		// Excluir registros de
		// permissoes com a página
		//a ser excluída
		$this->db->where('cod_pagina', $cod_pagina);
		$this->db->delete('sys_permissoes');
		//exluir a página
		$this->db->where('cod_pagina', $cod_pagina);
		$excluir_pagina = $this->db->delete('sys_paginas');	
		if($excluir_pagina)
		{
			return TRUE;
		}
	}
	//CARREGAR PERMISSOES
 	public function paginas_permissoes()
 	{
 		$consulta = $this->db->query("
				SELECT
				*
				FROM sys_paginas sp
				LEFT JOIN sys_setor ss ON sp.cod_setor = ss.cod_setor
				ORDER BY ss.descri_setor
			");

		if($consulta)
		{
			return $consulta;
		}
 	}
 	//CARREGAR CATEGORIAS/SETORES
 	
 	//MOSTRAR PERMISSOES DO USUARIO
 	public function permissoes_usuario($cod_usuario)
 	{
 		$consulta = $this->db->query("
				SELECT
				*
				FROM sys_permissoes
				WHERE cod_usuario = $cod_usuario
			");
		if($consulta)
		{
			return $consulta;
		}
 	}
 	//REMOVER PERMISSÃO
 	public function negar($cod_usuario, $cod_pagina)
 	{
 		$this->db->where('cod_usuario', $cod_usuario);
 		$this->db->where('cod_pagina', $cod_pagina);
		$excluir = $this->db->delete('sys_permissoes');
		if($excluir)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
 	}
 	//ADICIONAR PERMISSÃO
 	public function permitir($cod_usuario, $cod_pagina, $uri_pagina)
 	{
 		
	 		$dados = array(
	        'cod_usuario' 	=> $cod_usuario,
	        'cod_pagina' 	=> $cod_pagina,
	        'uri_pagina' 	=> $uri_pagina
	);
	$inserir = $this->db->insert('sys_permissoes', $dados);
		if($inserir)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
 	}
 	/*Verifica se um e-mail esta cadastrado*/
 	public function verifica_email_existe($email)
 	{
 		$consulta = $this->db->query("SELECT * FROM sys_usuarios where email = '$email' ");

		if($consulta->num_rows()>=1)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
 	}
 	public function atualizar_foto($foto, $cod_usuario)
 	{
 		$data = array(
 				'foto' 					=> $foto
 		);
 		$this->db->where('cod_usuario', $cod_usuario);
 		$atualiza = $this->db->update('sys_usuarios', $data);
 		if($atualiza)
 		{
 			return TRUE;
 		}else{
 			return FALSE;
 		}
 		
 	}
}

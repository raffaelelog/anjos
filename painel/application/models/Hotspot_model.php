<?php
defined ( 'BASEPATH' ) or exit ( 'Nenhum script de acesso permetido!!' );
class Hotspot_model extends CI_Model {
	public function confereCidades() {
		return $this->db->query ( "SELECT cidades.nome_cid as cidade, cidades.estado as estado FROM isp_city10.cidades inner join clientes on clientes.cidade = cidades.cidade where cidades.estado = 'MG' group by cidades.nome_cid" );
	}
	public function edita_cadastro($id_prosp, $cpf, $datNasc, $email, $celular, $cidade) {
		$consulta = $this->db->query ( "SELECT email from com_usu_prosp WHERE id_prosp = '$id_prosp'" );
		foreach ( $consulta->result () as $item ) {
			$emailVelho = $item->email;
		}
		if ($consulta->num_rows () == 1) {
			$dados = array (
					'email' => $email,
					'telephone' => $celular 
			);
			// dados da loja
			$bd_secundario = $this->load->database ( 'city10', TRUE );
			$bd_secundario->where ( 'email', $emailVelho );
			$query = $bd_secundario->update ( 'loja_customer', $dados );
			// comando de inserção dos dados da array
			if ($query) {
				$consulta = $bd_secundario->query ( "SELECT customer_id from loja_customer where email = '$email' " );
				foreach ( $consulta->result () as $item ) {
					$id = $item->customer_id;
				}
				$dados1 = array (
						'city' => $cidade 
				);
				// dados da loja
				$bd_secundario->where ( 'customer_id', $id );
				$query1 = $bd_secundario->update ( 'loja_address', $dados1 );
				if ($query1) {
					// validação da inserção
					/* ---Cadastro dos parametros do freeradius--- */
					$dados2 = array (
							'username' => $email 
					);
					$bd_secundario->where ( 'username', $emailVelho );
					$query2 = $bd_secundario->update ( 'radcheck', $dados2 );
					if ($query2) {
						$dados3 = array (
								'username' => $email 
						);
						// Definição do Freeradius quanto ao grupo de banda
						$bd_secundario->where ( 'username', $emailVelho );
						$query3 = $bd_secundario->update ( 'radusergroup', $dados3 );
						if ($query3) {
							$dados4 = array (
									'email' => $email,
									'celular' => $celular,
									'cidade' => $cidade,
									'login' => $email 
							);
							$this->db->where ( 'email', $emailVelho );
							$consulta = $this->db->update ( 'com_usu_prosp', $dados4 );
							$resposta = '0';
							// tudo deu certo
						} else {
							$resposta = '1';
							// seta a informação de alerta (no controller) para erro ao cadastrar na tabela radusergroup
						}
					} else {
						$resposta = '2';
						// seta a informação de alerta (no controller) para erro ao cadastrar na tabela radcheck
					}
				} else {
					$resposta = '3';
					// seta a informação de alerta (no controller) para erro ao cadastrar na tabela loja_address
				}
			} else {
				$resposta = '4';
				// seta a informação de alerta (no controller) para erro ao cadastrar na tabela loja_customer
			}
		} else {
			$resposta = '5';
			// seta a informação de alerta (no controller) para cpf indisponivel
		}
		return $resposta;
	}
	public function envia_senha($email) {
		$bd_secundario = $this->load->database ( 'city10', TRUE );
		$consulta = $bd_secundario->query ( "SELECT value FROM radcheck where username ='$email' and attribute = 'Cleartext-Password'" );
		foreach ( $consulta->result () as $itens ) {
			return $itens->value;
		}
		// retorna consulta
	}
	public function exportar($id) {
		$consulta = $this->db->query ( "select c.nome AS Nome, c.cpf As cpf, c.email AS Email,TIMESTAMPDIFF(YEAR, c.dat_nascimento, NOW()) AS Idade, c.celular as Celular,c.cidade as Cidade,
				if(c.cpf=m.cpf and m.ativo = 'S', m.codcli ,'Não Cliente' ) as Cliente
				FROM com_usu_prosp as c
				left join clientes as m on c.cpf = m.cpf
				WHERE c.status_prosp ='$id' GROUP BY Nome ORDER BY id_prosp desc" );
		return $consulta;
		// retorna consulta
	}
	// Função de inserção de registro de contato
	public function insert($id, $dataOfert, $periodo, $pessoaContato, $funcionario, $observacao, $servico) {
		$query = $this->db->query ( "
				SELECT
				*
				FROM
				com_registro_prosp WHERE id_prosp = '$id' and data_oferta = '$dataOfert' and observacao = '$observacao'
				" );
		If ($query->num_rows () == 0) {
			$dados1 = array (
					'id_prosp' => $id,
					'data_oferta' => $dataOfert,
					'horario_oferta' => $periodo,
					'pessoa_contactada' => $pessoaContato,
					'cod_usuario_funcionario' => $funcionario,
					'observacao' => $observacao,
					'servico' => $servico 
			);
			// Montagem do array com os dados do insert
			$this->db->insert ( 'com_registro_prosp', $dados1 );
			// Realização do insert na tabela hotspot_registro_prosp com os dados definidos no array $dados1
		}
	}
	// função que retorna a consulta que contem os cadastrados do usuarios hotspot (não integrator, não cliente)
	public function itens($id) {
		$consulta = $this->db->query ( " select c.id_prosp as Id, c.nome AS Nome, c.cpf As cpf, c.email AS Email,
				if(c.cpf=m.cpf and m.ativo = 'S', m.codcli ,'Não Cliente' ) as Cliente
				FROM com_usu_prosp as c
				left join clientes as m on c.cpf = m.cpf
				WHERE c.status_prosp ='$id' GROUP BY Nome ORDER BY id_prosp desc" );
		return $consulta;
		// retorna consulta
	}
	// Função que modifica o status de um cadastro para não excluido (0 para status excluido - visivel na view prospecto_removidos; 1 para status não excluido - visivel na view prospecto)
	public function recupera($id) {
		$up = array (
				'status_prosp' => 1 
		);
		// Definição do status
		$this->db->where ( 'id_prosp', $id );
		// Definição de qual cadastro deve ser modificado (definido pelo id do cadastro)
		$query = $this->db->update ( 'com_usu_prosp', $up );
		// Update do status na tabela hotspot_usu_prosp
	}
	public function registrar_log($cod_usuario, $atividade, $data) { // salva um log da ultima ação realizada
		$dados = array (
				'cod_usuario' => $cod_usuario,
				'atividade' => $atividade,
				'data' => $data 
		);
		$this->db->insert ( 'sys_log_usu', $dados );
	}
	public function resgistros($id_prosp) { // registro de todos os ususarios
		return $this->db->query ( "select c.id_prosp as id_prosp, c.nome AS nome, c.cpf As cpf, c.email AS email, c.celular as celular, c.cidade as cidade,c.dat_nascimento as dat_nascimento,
				if(c.cpf=m.cpf and m.ativo = 'S', m.codcli ,'Não Cliente' ) as cliente
				FROM com_usu_prosp as c
				left join clientes as m on c.cpf = m.cpf
				WHERE c.id_prosp = '$id_prosp' GROUP BY nome " );
		// retorna consulta
	}
	public function resgistros_usu($id_prosp) { // registro individual de um usuario
		return $this->db->query ( "SELECT a.id As Id,a.data_oferta AS Data_oferta,a.horario_oferta AS Horario_oferta,a.pessoa_contactada AS Pessoa_contactada,a.observacao AS Observacao,a.servico AS servico,a.id_prosp as id_prosp,b.nome as Pessoa_funcionario FROM isp_city10.com_registro_prosp as a Inner join sys_usuarios as b on a.cod_usuario_funcionario = b.cod_usuario where id_prosp = '$id_prosp' order by data_oferta desc" );
		// retorna consulta
	}
	// Função que modifica o status de um cadastro para excluido (0 para status excluido - visivel na view prospecto_removidos; 1 para status não excluido - visivel na view prospecto)
	public function remove($id) {
		$up = array (
				'status_prosp' => 0 
		);
		// Definição do status
		$this->db->where ( 'id_prosp', $id );
		// Definição de qual cadastro deve ser modificado (definido pelo id do cadastro)
		$query = $this->db->update ( 'com_usu_prosp', $up );
		// Update do status na tabela hotspot_usu_prosp
	}
	// Função que retorna todos os serviços ofertados na city10
	public function serv() {
		$consulta = $this->db->query ( "select codser,descri_ser from servicos" );
		// consulta que recupera os serviços ofertados na city10
		return $consulta;
		// retorna consulta
	}
	public function usuario() {
		$consulta = $this->db->query ( "select cod_usuario, nome from sys_usuarios where cod_setor = '6'" );
		// consulta que recupera os serviços ofertados na city10
		return $consulta;
		// retorna consulta
	}
}
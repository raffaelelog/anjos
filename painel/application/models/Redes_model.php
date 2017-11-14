<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Redes_model extends CI_Model {
	public function listar_caixas() {
		$caixas = $this->db->query ( "
		SELECT 
		*
		FROM 
		redes_caixas
		" );
		if ($caixas) {
			return $caixas;
		} else {
			return FALSE;
		}
	}
	public function listar_centrais() {
		$caixas = $this->db->query ( "SELECT * FROM redes_centrais order by descricao" );
		if ($caixas) {
			return $caixas;
		} else {
			return FALSE;
		}
	}
	public function cadastrar_caixa($tipo, $codigo, $num_portas_total, $num_portas_disponiveis, $rede, $cod_central, $endereco, $numero, $bairro, $cidade, $cep, $latitude, $longitude, $obs) {
		$dados = array (
				'tipo' => $tipo,
				'codigo' => $codigo,
				'num_portas_total' => $num_portas_total,
				'num_portas_disponiveis' => $num_portas_disponiveis,
				'rede' => $rede,
				'cod_central' => $cod_central,
				'endereco' => $endereco,
				'numero' => $numero,
				'bairro' => $bairro,
				'cidade' => $cidade,
				'cep' => $cep,
				'latitude' => $latitude,
				'longitude' => $longitude,
				'obs' => $obs 
		);
		$cadastrar = $this->db->insert ( 'redes_caixas', $dados );
		if ($cadastrar) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	public function atualizar_caixa($cod_caixa, $tipo, $codigo, $num_portas_total, $num_portas_disponiveis, $rede, $cod_central, $endereco, $numero, $bairro, $cidade, $cep, $latitude, $longitude, $obs) {
		$dados = array (
				'tipo' => $tipo,
				'codigo' => $codigo,
				'num_portas_total' => $num_portas_total,
				'num_portas_disponiveis' => $num_portas_disponiveis,
				'rede' => $rede,
				'cod_central' => $cod_central,
				'endereco' => $endereco,
				'numero' => $numero,
				'bairro' => $bairro,
				'cidade' => $cidade,
				'cep' => $cep,
				'latitude' => $latitude,
				'longitude' => $longitude,
				'obs' => $obs 
		);
		$this->db->where ( 'cod_caixa', $cod_caixa );
		$atualizar = $this->db->update ( 'redes_caixas', $dados );
		if ($atualizar) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	public function ler_caixa($cod_caixa) {
		$caixa = $this->db->query ( "
			SELECT 
			*
			FROM 
			redes_caixas
			where 
			cod_caixa = '$cod_caixa'
		" );
		
		if ($caixa) {
			return $caixa;
		} else {
			return FALSE;
		}
	}
	public function solicitacoes($data_ini, $data_fim) {
		$consulta = $this->db->query ( "
			SELECT
			s.cod_solicitacao AS cod_solicitacao
			,s.descricao AS descricao
			,s.resolvido AS resolvido
			,usu.nome as usuario_solicitante
			,s.data_solicitacao AS data_solicitacao
			,u.nome AS nome
			FROM redes_solicitacoes s 
			left join sys_usuarios u ON s.cod_usuario = u.cod_usuario
			left join sys_usuarios usu ON s.usuario_solicitante = usu.cod_usuario 
			where s.data_solicitacao BETWEEN '$data_ini' and '$data_fim' ORDER BY s.data_solicitacao DESC;" );
		if ($consulta) {
			return $consulta;
		} else {
			return FALSE;
		}
	}
	public function usuarios() {
		$consulta = $this->db->query ( "
			SELECT
			*
			FROM 
			sys_usuarios
			where 
			ativo = 1
			order by nome " );
		
		if ($consulta) {
			return $consulta;
		} else {
			return FALSE;
		}
	}
	public function atividades() {
		$consulta = $this->db->query ( "SELECT * FROM redes_atividades;" );
		if ($consulta) {
			return $consulta;
		} else {
			return FALSE;
		}
	}
	/* Cadastrar Solicitação */
	public function cadastro_solicitacao($cod_usuario, $descricao, $data_solicitacao, $resolvido, $usuario_solicitante, $obs,$atividade) {
		$query = $this->db->query ( "
			SELECT
			*
			FROM
			redes_solicitacoes WHERE cod_usuario = '$cod_usuario' and data_solicitacao = '$data_solicitacao' and descricao = '$descricao' and obs = '$obs'
			" );
		If ($query->num_rows () == 0) {
			$dados = array (
					'cod_usuario' => $cod_usuario,
					'descricao' => $descricao,
					'data_solicitacao' => $data_solicitacao,
					'resolvido' => $resolvido,
					'usuario_solicitante' => $usuario_solicitante,
					'obs' => $obs,
					'cod_atividade' => $atividade
			);
			$cadastrar = $this->db->insert ( 'redes_solicitacoes', $dados );
			if ($cadastrar) {
				return TRUE;
			} else {
				return FALSE;
			}
		}
	}
	public function status_solicitacao($cod_solicitacao, $status) {
		$dados = array (
				'resolvido' => $status 
		);
		$this->db->where ( 'cod_solicitacao', $cod_solicitacao );
		$atualizar = $this->db->update ( 'redes_solicitacoes', $dados );
		if ($atualizar) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	public function cidades_os($codpop) {
		$consulta = $this->db->query ( "
		SELECT cid.cidade ,cid.nome_cid ,cp.codpop 
			FROM cidades cid
		LEFT JOIN cidades_pop cp ON cid.cidade = cp.cidade
		WHERE cp.codpop = '$codpop'
		ORDER BY cid.nome_cid
		" );
		
		if ($consulta) {
			return $consulta;
		} else {
			return FALSE;
		}
	}
	// OSs internas
	public function os_interna($data_ini,$data_fim) {
		$consulta = $this->db->query ( "
		SELECT
		    os.*
		    ,cid.nome_cid AS cidade
		    ,toi.descricao AS descricao
		    ,u.nome AS solicitante
		    ,(select group_concat(u.nome separator ' - ')
             from redes_os_interna_tec t
             left join sys_usuarios u ON t.cod_usuario = u.cod_usuario
             where
             os.cod_os_interna = t.cod_os_interna
            )as tecnicos
		FROM redes_os_interna os
		LEFT JOIN cidades cid ON os.cod_cidade = cid.cidade
		LEFT JOIN redes_tipo_os_interna toi ON os.cod_tipo_os_interna = toi.cod_tipo_os_interna
		LEFT JOIN redes_os_interna_sol u ON os.solicitante = u.cod_usuario
		WHERE os.data >= '$data_ini' AND os.data <= '$data_fim'
		order BY os.data
		" );
		
		if ($consulta) {
			return $consulta;
		} else {
			return FALSE;
		}
	}
	public function tipo_os_interna() {
		$consulta = $this->db->query ( "
		SELECT * 
			FROM redes_tipo_os_interna
		ORDER BY descricao
		" );
		
		if ($consulta) {
			return $consulta;
		} else {
			return FALSE;
		}
	}
	public function solicitantes($cod_unidade) {
		$consulta = $this->db->query ( "
		SELECT * 
			FROM redes_os_interna_sol u
		WHERE
		u.ativo = 1
		ORDER BY nome
		" );
		
		if ($consulta) {
			return $consulta;
		} else {
			return FALSE;
		}
	}
	public function tecnicos_os_interna($cod_unidade) {
		$consulta = $this->db->query ( "
		SELECT * 
			FROM sys_usuarios u
		WHERE
		u.cod_setor = 1
		AND u.ativo = 1
		AND u.cod_unidade = '$cod_unidade'
		ORDER BY nome
		" );
		
		if ($consulta) {
			return $consulta;
		} else {
			return FALSE;
		}
	}
	public function cadastrar_os_interna($cod_cidade, $cod_tipo_os_interna, $bairro, $solicitante, $data, $hora_inicial, $hora_final, $hora_inicial_desl, $hora_final_desl, $obs) {
		$dados = array (
				'cod_cidade' => $cod_cidade,
				'cod_tipo_os_interna' => $cod_tipo_os_interna,
				'bairro' => $bairro,
				'solicitante' => $solicitante,
				'data' => $data,
				'hora_inicial' => $hora_inicial,
				'hora_final' => $hora_final,
				'hora_inicial_desl' => $hora_inicial_desl,
				'hora_final_desl' => $hora_final_desl,
				'obs' => $obs 
		);
		
		$cadastrar = $this->db->insert ( 'redes_os_interna', $dados );
		
		// Recupera cod do ultimo registro
		$cod_os_interna = $this->db->insert_id ();
		
		if ($cadastrar) {
			return $cod_os_interna;
		} else {
			return FALSE;
		}
	}
	public function enviar_tecnicos_os($cod_os_interna, $cod_usuario) {
		$dados = array (
				'cod_os_interna' => $cod_os_interna,
				'cod_usuario' => $cod_usuario 
		);
		
		$cadastrar = $this->db->insert ( 'redes_os_interna_tec', $dados );
		
		if ($cadastrar) {
			return TRUE;
		} else {
			return FALSE;
		}
	}



	
	public function clientes_repetidores($ip_repetidor)
	{
	 	
			if(@snmpwalk($ip_repetidor, "cityread", ".1.3.6.1.4.1.41112.1.4.7.1.1"))
			{

				$a = snmpwalk($ip_repetidor, "cityread", ".1.3.6.1.4.1.41112.1.4.7.1.1");
				$i = 0;

				foreach ($a as $aa)
				{
					$mac_a = 	substr($aa, -18);
					$mac[$i] = " telefone = '".str_replace(' ', '', $mac_a)."' OR ";
					$i++;
				}


				$DB2 = $this->load->database('infox', TRUE);




				$macs = join("   ",$mac);

				$consulta = $DB2->query("
					SELECT
					*
					FROM start
					WhERE 
					
					($macs

					2 = 1)
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
			else
			{
				return FALSE;
			}
	}


	

	public function informacoes_login($login)
	{
		$consulta = $this->db->query(
			"
			SELECT
			    c.codcli AS contrato
			    ,c.nome_cli AS nome
			    ,c.endereco AS endereco
			    ,c.bairro AS bairro
			    ,cid.nome_cid AS cidade
			    ,c.fone as telefone
			    ,c.celular as celular
			    ,se.descri_ser as plano
			FROM
			login_radius r
			LEFT JOIN servicos_cli sc ON r.codsercli = sc.codsercli
			LEFT JOIN servicos se ON sc.codser = se.codser
			LEFT JOIN clientes c ON sc.codcli = c.codcli
			LEFT JOIN cidades cid ON c.cidade = cid.cidade
			WHERE
			r.login = '$login' 

			"
			);

		if($consulta)
		{
			return $consulta;
		}
		else
		{
			return FALSE;
		}
	}



	public function informacoes()
	{
		$consulta = $this->db->query(
			"
			SELECT
			    c.codcli AS contrato
			    ,c.nome_cli AS nome
			    ,c.endereco AS endereco
			    ,c.bairro AS bairro
			    ,cid.nome_cid AS cidade
			    ,c.fone as telefone
			    ,c.celular as celular
			    ,se.descri_ser as plano
			    ,r.login AS login
			FROM
			login_radius r
			LEFT JOIN servicos_cli sc ON r.codsercli = sc.codsercli
			LEFT JOIN servicos se ON sc.codser = se.codser
			LEFT JOIN clientes c ON sc.codcli = c.codcli
			LEFT JOIN cidades cid ON c.cidade = cid.cidade
			WHERE
			1=1

			"
			);

		if($consulta)
		{
			return $consulta;
		}
		else
		{
			return FALSE;
		}
	}








}/*END MODEL*/
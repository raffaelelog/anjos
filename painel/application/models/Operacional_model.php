<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Operacional_model extends CI_Model {
	public function verifica_os_cadastrada($codords) {
		$verifica = $this->db->query ( "
		SELECT 
		*
		FROM 
		ope_servico
		WHERE 
		cod_servico = '$codords'
		" );
		if ($verifica->num_rows () >= 1) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	public function listar_os_tec() {
		$consulta = $this->db->query ( "SELECT op.descri_ords AS descri_ords, s.nome AS nome, o.numero_os AS numero_os, o.obs AS obs,o.status_os AS status_os, o.data_servico AS data_servico, o.retrabalho AS retrabalho, o.periodo AS periodo FROM ope_servico AS o	
		INNER JOIN ope_servico_tipo AS op on o.cod_tipo_servico = op.cod_tipo_servico
		INNER JOIN ope_servico_tec AS os on o.cod_servico = os.cod_servico
		INNER JOIN sys_usuarios AS s on s.cod_usuario = os.cod_usuario
		ORDER BY o.numero_os LIMIT 3000" );
		if ($consulta) {
			return $consulta;
		} else {
			return FALSE;
		}
	}
	public function inserir_os_dia($codords, $codoco, $codtec, $numero_os, $codtords, $status_os, $descri_ords, $data_cad, $hora, $unidade_t, $obs, $data_ret, $valor_os) {
		$dados = array (
				'codords' => $codords,
				'codoco' => $codoco,
				'codtec' => $codtec,
				'numero_os' => $numero_os,
				'codtords' => $codtords,
				'status_os' => $status_os,
				'data_cad' => $data_cad,
				'hora' => $hora,
				'unidade_t' => $unidade_t,
				'obs' => $obs,
				'data_ret' => $data_ret,
				'valor_os' => $valor_os 
		);
		$cadastrar = $this->db->insert ( 'ordem_servico', $dados );
	}
	public function atualizar_os_dia($codords, $codoco, $codtec, $numero_os, $codtords, $status_os, $descri_ords, $data_cad, $hora, $unidade_t, $obs, $data_ret, $valor_os) {
		$dados = array (
				'codoco' => $codoco,
				'codtec' => $codtec,
				'numero_os' => $numero_os,
				'codtords' => $codtords,
				'status_os' => $status_os,
				'data_cad' => $data_cad,
				'hora' => $hora,
				'unidade_t' => $unidade_t,
				'obs' => $obs,
				'data_ret' => $data_ret,
				'valor_os' => $valor_os 
		);
		$this->db->where ( 'codords', $codords );
		$atualizar = $this->db->update ( 'ordem_servico', $dados );
	}
	/* Insere o cordsercli na tabela ope_servico */
	public function insere_ope_servico($codords, $codsercli, $codtords, $codsercli, $numero_os, $status_os, $obs) {
		$dados = array (
				'cod_servico' => $codords,
				'cod_tipo_servico' => $codtords,
				'codsercli' => $codsercli,
				'numero_os' => $numero_os,
				'status_os' => $status_os,
				'obs' => $obs 
		);
		$inserir = $this->db->insert ( 'ope_servico', $dados );
		
		if ($inserir) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	/* Listar servicos para serem enviados aos tecnicos */
	public function listar_servicos($numero_os) {
		$consulta = $this->db->query ( "
	   SELECT
        sc.codcli AS codcli
        ,c.nome_cli AS nome_cli
        ,IFNULL(UPPER(ec.bairro),UPPER(c.bairro)) AS bairro
        ,IFNULL(UPPER(cid.nome_cid),UPPER(ci.nome_cid)) AS cidade
        ,os.status_os AS status_os
        ,ts.descri_ords AS descri_ords
        ,os.cod_servico AS cod_servico
        ,os.numero_os AS numero_os
        ,os.data_servico AS data_servico
        ,(select group_concat(u.nome separator ', ')
             from ope_servico_tec t
             left join sys_usuarios u ON t.cod_usuario = u.cod_usuario
             where
             os.cod_servico = t.cod_servico
            )as tecnicos
        FROM ope_servico os
        LEFT JOIN servicos_cli sc ON os.codsercli = sc.codsercli
        LEFT JOIN endereco_cli ec ON sc.codecli_i = ec.codecli
        LEFT JOIN cidades cid ON ec.cidade = cid.cidade
        LEFT JOIN clientes c ON sc.codcli = c.codcli
        LEFT JOIN cidades ci ON c.cidade = ci.cidade
        LEFT JOIN ope_servico_tipo ts ON os.cod_tipo_servico = ts.cod_tipo_servico
        WHERE
        os.numero_os = '$numero_os'         
		" );
		if ($consulta) {
			return $consulta;
		} else {
			return FALSE;
		}
	}
	/* Fim listar serviço */
	/* Listar servicos para serem enviados aos tecnicos */
	public function listar_servicos_cadastrados($data_cad_i, $data_cad_f, $codpop) {
		$consulta = $this->db->query ( "
       SELECT 
        os.numero_os as numero_os
        ,os.cod_servico as cod_servico
        ,os.periodo as periodo
        ,os.status_os as status_os
        ,tos.descri_ords as descri_ords
        ,sc.codcli as codcli
        ,(select group_concat(u.nome separator ', ')
             from ope_servico_tec t
             left join sys_usuarios u ON t.cod_usuario = u.cod_usuario
             where
             os.cod_servico = t.cod_servico
            )as tecnicos
        ,DATE_FORMAT(os.data_servico, '%d/%m/%Y') as data_servico
        from ope_servico os
        left join ordem_servico osi ON os.cod_servico = osi.codords
        left join tipo_orden_s tos on osi.codtords = tos.codtords
        left join servicos_cli sc on os.codsercli = sc.codsercli
        left join clientes c ON sc.codcli = c.codcli
        left join cidades_pop cp ON c.cidade = cp.cidade
        where
        os.data_servico BETWEEN '$data_cad_i' AND '$data_cad_f'
        AND cp.codpop = '$codpop'
        " );
		if ($consulta) {
			return $consulta;
		} else {
			return FALSE;
		}
	}
	/* Fim listar serviço */
	/* Listar servicos para serem enviados aos tecnicos */
	public function servico($cod_servico) {
		$consulta = $this->db->query ( "
       SELECT 
        os.numero_os as numero_os
        ,os.cod_servico as cod_servico
        ,IF(os.status_os= 'P', 'Pendente', IF(os.status_os = 'A', 'Aguardando Agendamento', 'Outros')) as status_os
        ,tos.descri_ords as descri_ords
        ,oco.codcli as codcli
        ,os.periodo as periodo
        ,os.obs as obs
        ,os.cod_tipo_servico as cod_tipo_servico
        ,(select group_concat(u.nome separator ', ')
             from ope_servico_tec t
             left join sys_usuarios u ON t.cod_usuario = u.cod_usuario
             where
             os.cod_servico = t.cod_servico
            )as tecnicos
        ,os.data_servico as data_servico
        from ope_servico os
        left join ordem_servico osi ON os.cod_servico = osi.codords
        left join tipo_orden_s tos on osi.codtords = tos.codtords
        left join ocorrencias oco on osi.codoco = oco.codoco
        where
        os.cod_servico = '$cod_servico'
        " );
		if ($consulta) {
			return $consulta;
		} else {
			return FALSE;
		}
	}
	/* Fim listar serviço */
	/* ATUALIZAR OS */
	public function atualizar_os($cod_servico, $data_servico, $periodo, $cod_tipo_servico, $obs) {
		$dados = array (
				'cod_tipo_servico' => $cod_tipo_servico,
				'data_servico' => $data_servico,
				'periodo' => $periodo,
				'obs' => $obs 
		);
		$this->db->where ( 'cod_servico', $cod_servico );
		$atualizar_os = $this->db->update ( 'ope_servico', $dados );
		
		if ($atualizar_os) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	/* FIM ATUALIZAR OS */
	/* INICIO TECNICOS */
	public function tecnicos() {
		$unidade = '';
		if ($this->session->userdata ( 'nivel' ) != 5) {
			$unidade = ' and u.cod_unidade = ' . $this->session->userdata ( 'cod_unidade' );
		}
		$consulta = $this->db->query ( "SELECT u.cod_usuario as cod_usuario, u.nome as nome, u.email as email, s.descri_unidade as unidade, u.cod_unidade as cod_unidade 
		FROM sys_usuarios u 
		INNER JOIN sys_unidade as s on s.cod_unidade = u.cod_unidade 
		WHERE u.ativo = '1' AND u.tecnico = '1' and nivel = '1' $unidade ORDER BY u.nome" );
		
		if ($consulta) {
			return $consulta;
		} else {
			return FALSE;
		}
	}
	/* FIM TECNICOS */
	/* INICIO TECNICOS */
	public function tecnicos_os_add($cod_servico) {
		$unidade = '';
		if ($_SESSION ['nivel'] != 5) {
			$unidade = ' and u.cod_unidade = ' . $_SESSION ['cod_unidade'];
		}
		$consulta = $this->db->query ( "SELECT u.cod_usuario as cod_usuario, u.nome as nome
			FROM sys_usuarios u
			INNER JOIN sys_unidade as s on s.cod_unidade = u.cod_unidade
			WHERE u.cod_usuario NOT IN(select ser.cod_usuario from ope_servico_tec ser where ser.cod_servico = '$cod_servico') AND u.ativo = '1' AND u.tecnico = '1' $unidade ORDER BY u.nome" );
		if ($consulta) {
			return $consulta;
		} else {
			return FALSE;
		}
	}
	/* FIM TECNICOS */
	/* INICIO TECNICOS */
	public function tecnicos_os($cod_servico) {
		$consulta = $this->db->query ( "
        SELECT
        u.cod_usuario AS cod_usuario
        ,u.nome AS nome
        ,st.pontos AS pontos
        FROM
        ope_servico_tec st
        left join sys_usuarios u ON st.cod_usuario = u.cod_usuario 
        WHERE
        st.cod_servico = '$cod_servico'
        ORDER BY u.nome
        " );
		if ($consulta) {
			return $consulta;
		} else {
			return FALSE;
		}
	}
	/* FIM TECNICOS */
	/* EXLUIR TÉCNICOS DA OS */
	public function excluir_tec_os($cod_servico, $tecnico) {
		$this->db->where ( 'cod_usuario', $tecnico );
		$this->db->where ( 'cod_servico', $cod_servico );
		$excluir = $this->db->delete ( 'ope_servico_tec' );
		if ($excluir) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	/* FIM EXCLUIR TECNICOS DA OS */
	/* VERIFICA O NUMERO DE TÉCNICOS EM UMA OS */
	public function num_tec_os($cod_servico) {
		$consulta = $this->db->query ( "
        SELECT
        *
        FROM
        ope_servico_tec st
        where 
        st.cod_servico = '$cod_servico'
        " );
		if ($consulta) {
			return $consulta->num_rows ();
		} else {
			return FALSE;
		}
	}
	/* ATUALIZAR A PONTUAÇÃO DE TODOS OS TÉCNICOS DE UMA OS */
	public function atualizar_pontuacao($cod_servico, $pontos) {
		$dados = array (
				'pontos' => $pontos 
		);
		$this->db->where ( 'cod_servico', $cod_servico );
		$atualizar = $this->db->update ( 'ope_servico_tec', $dados );
		if ($atualizar) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	/* Adicionar técnico a OS */
	public function adicionar_tecnico_os($cod_servico, $cod_usuario) {
		$dados = array (
				'cod_usuario' => $cod_usuario,
				'cod_servico' => $cod_servico 
		);
		
		$adicionar_tecnico_os = $this->db->insert ( 'ope_servico_tec', $dados );
		if ($adicionar_tecnico_os) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	/* */
	public function resumo_os($numero_os) {
		$consulta = $this->db->query ( "
	SELECT
    os.numero_os AS numero_os_100        
    # STATUS DA OS
    ,UPPER(IF(os.status_os='F','Fechada',IF(os.status_os='S','Sem Solução',
    IF(os.status_os='P','Pendente','Outros')))) AS Status_OS_100

    ,os.status_os AS status_os

    # TRAZ O NOME DO CLIENTE
    ,c.nome_cli AS nome_cli      

    # ENDERECO PRINCIPAL DO CLIENTE                   
    ,c.endereco AS endereco_300           
    #BAIRRO PRINCIPAL DO CLIENTE  
	,c.bairro AS bairro_300
      
    #TELEFONE DO CLIENTE
    ,UPPER(CONCAT('(',c.ddd,') ',c.fone)) AS Fone_150
    
    #CAMPO COM CPF/CNPJ DE CLIENTE
    ,IF(LOWER(c.tipo_cliente)='f',c.cpf,c.cnpj) AS cpf_cnpj_150
   
    # campo com o tipo do cliente
    ,IF (o.codcli>0,UPPER('CLIENTE'),IF (o.codcon>0,UPPER('P. ROTEAMENTO'),
    UPPER('PROSPECTO'))) AS tipocli_100 
        
    #CAMPO COM O STATUS DO CLIENTE    
    ,IF(c.ativo = 'S','Ativo','Inativo')    AS Status_50
        
    # campo com o nome do tecnico
    ,u.nome_usu AS nome_do_tecnico_150    
    
    #ENDERECO DE INSTALACAO
    ,IFNULL(UPPER(ec.endereco),UPPER(c.endereco))    AS endereco_instalacao_150
        
    #BAIRRO DE INSTALACAO
    ,IFNULL(UPPER(ec.bairro),UPPER(c.bairro))    AS bairro_instalacao_150
    
    #CIDADE DE INSTALACAO
    ,IFNULL(UPPER(cec.nome_cid),UPPER(ci.nome_cid))     AS cidade_instalacao_100
    
    #ESTADO DE INSTALACAO
    ,IFNULL(UPPER(cec.estado),UPPER(ci.estado))    AS estado_instalacao_100                        
       
    #OBS DA OS 
    ,LEFT (os.obs, 254) AS obs_os
        
    #NOME DO TIPO DE ATENDIMENTO
    ,op.nome_ocop AS tipo_atendimento_100
    
    #CATEGORIA DO ATENDIMENTO
    ,co.descri_catoco    AS Categoria_Atendimento_150
        
    #STATUS DO ATENDIMENTO
    ,IF(o.data_sol='0000-00-00','pendente','solucionado') AS
     status_atendimento_50

    # campo com o n° de protocolo
    ,o.numero_oco AS nro_protocolo_80
    
    #GERADO POR    
    ,ug.nome_usu AS gerada_por_100
    
    #DATA ABERTURA DO ATENDIMENTO
    ,o.data_lan AS data_abertura_atend_100
    
    
    #PLANO
    ,CONCAT('(',sc.nro_plano,') ',s.descri_ser) AS Plano_300
    
    #VALOR DA INSTALACAO
    ,sc.valor_taxa AS valor_inst_100
    
    #MENSALIDADE
    ,sc.valor_plano AS mensalidade_100        
    
    #STATUS DO PLANO
    ,st.descri_est AS Status_Plano_100
    
    #VALOR DA OS
    ,os.valor_os AS Valor_os_100
    
    #TIPO DA OS
    ,tos.descri_ords AS Tipo_os_200

    ,os.codtords AS cod_tipo_servico

    ,os.codords AS cod_servico

from 
	#ENTIDADE PRINCIPAL
     ocorrencias o    
    
    #LJ OCORRENCIAS
    JOIN ordem_servico os    ON o.codoco = os.codoco
    
    #LJ com prospect
    LEFT JOIN prospect p ON p.codpros = o.codpros
    
    #LJ OCORRENCIA PADRAO
    LEFT JOIN oco_padrao op ON o.codocop = op.codocop
     
    #LJ TIPO DA OS
    LEFT JOIN tipo_orden_s tos ON tos.codtords = os.codtords
    
    #LJ CM USUARIO PARA OBTER DADOS DO TECNICO ATRIBUIDO A EXECUCAO DEFINIDO NA ABERTURA
    LEFT JOIN usuarios u ON os.codtec = u.codtec AND u.codtec <> space(10) 
        
    #LJ CM USUARIO PARA OBTER DADOS DO USUARIO GERADOR
    LEFT JOIN usuarios ug ON os.codusu = ug.codusu             
    
    #LJ PARA O SOLICITANTE DA OCORRENCIA, QUANDO CLIENTE
    LEFT JOIN clientes c ON o.codcli = c.codcli

    
    #LJ PARA A CIDADE DO SOLICITANTE-CLIENTE
    LEFT JOIN cidades ci ON c.cidade = ci.cidade
    
    #LF PARA A CIDADE COM PROSPECTO
    LEFT JOIN cidades ci3 ON p.cidade = ci3.cidade
    
    #LJ PARA TRAZER OS DADOS DO PLANO CONTRATADO
    LEFT JOIN servicos_cli sc ON sc.codsercli = o.codsercli
    
    #LJ PARA TRAZER OS DADOS DO PLANO
    LEFT JOIN servicos s ON sc.codser = s.codser
    
    #LJ PRA PEGAR O ENDERECO DE INSTALACAO
    LEFT JOIN endereco_cli ec ON sc.codecli_i = ec.codecli 
    
    #LJ PRA PEGAR CIDADE E UF DO ENDERECO DE INSTALACAO
    LEFT JOIN cidades cec ON ec.cidade = cec.cidade 
    
    #LJ PARA OBTER STATUS DO SERVICO
    LEFT JOIN status st ON sc.codest = st.codest
    
    #LJ PARA OBTER VENDEDOR
    LEFT JOIN usuarios v ON sc.codven = v.codven

    # LJ PARA OBTER A CATEGORIA DA OCORRENCIA
    LEFT JOIN categoria_oco co ON o.codcatoco = co.codcatoco
    
    #LJ CM USUARIO PARA OBTER DADOS DO TECNICO ATRIBUIDO A EXECUCAO DEFINIDO NO FECHAMENTO
    LEFT JOIN usuarios tec ON tec.codtec = os.codtec_ret and trim(codtec_ret)<>''

    # LJ com motivo_fechamento_os mfos on 
    LEFT JOIN motivo_fechamento_os mfos on os.codmfos=mfos.codmfos    
	where 
		true
	      #{and false}#
	AND os.numero_os = '$numero_os' 
	GROUP BY os.numero_os 
	ORDER BY 1 

		" );
		
		if ($consulta) {
			return $consulta;
		} else {
			return FALSE;
		}
	}
	/* */
	public function enviar_servico($cod_servico, $cod_tipo_servico, $numero_os, $data_servico, $status_os, $periodo, $obs) {
		$dados = array (
				'cod_servico' => $cod_servico,
				'cod_tipo_servico' => $cod_tipo_servico,
				'numero_os' => $numero_os,
				'data_servico' => $data_servico,
				'status_os' => $status_os,
				'periodo' => $periodo,
				'obs' => $obs 
		);
		$inserir = $this->db->insert ( 'ope_servico', $dados );
		if ($inserir) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	public function enviar_servico_tec($tecnico, $cod_servico, $pontos) {
		$dados = array (
				'cod_usuario' => $tecnico,
				'cod_servico' => $cod_servico,
				'pontos' => $pontos 
		);
		$cadastrar = $this->db->insert ( 'ope_servico_tec', $dados );
		if ($cadastrar) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	/* SELECIONA OS's DO TÉCNICO LOGADO NO SISTEMA */
	public function minhas_os_s($cod_usuario) {
		$consulta = $this->db->query ( "
        SELECT
        se.cod_servico AS cod_servico
        ,se.data_servico AS data_servico
        ,se.periodo AS periodo
        ,se.status_os AS status_os
        ,sc.codcli AS codcli
        ,c.nome_cli AS nome_cli
        ,os.numero_os AS numero_os
        ,sti.cod_tipo_servico AS cod_tipo_servico
        ,sti.view AS view
        ,sti.descri_ords as descri_ords
        ,DATE_FORMAT(se.data_servico, '%d/%m/%Y') as data_servico
        ,c.bairro AS bairro  
        FROM
        ope_servico_tec st
        LEFT JOIN ope_servico se ON st.cod_servico = se.cod_servico
        LEFT JOIN ope_servico_tipo sti ON se.cod_tipo_servico = sti.cod_tipo_servico 
        LEFT JOIN ordem_servico os ON se.cod_servico =  os.codords
        LEFT JOIN servicos_cli sc ON se.codsercli = sc.codsercli
        LEFT JOIN clientes c ON sc.codcli = c.codcli
        where 
        st.cod_usuario = '$cod_usuario' 
        and se.status_os != 'F' AND se.status_os != 'S'
        and se.data_servico >= CURRENT_DATE();
        " );
		if ($consulta) {
			return $consulta;
		} else {
			return FALSE;
		}
	}
	public function ope_servico_tipo() {
		$consulta = $this->db->query ( "
        SELECT
        *
        FROM 
        ope_servico_tipo
        ORDER BY descri_ords
        " );
		if ($consulta) {
			return $consulta;
		} else {
			return FALSE;
		}
	}
	public function view_form($cod_tipo_servico) {
		$consulta = $this->db->query ( "
        SELECT
        view
        FROM 
        ope_servico_tipo
        where
        cod_tipo_servico = '$cod_tipo_servico'
        " );
		
		$row = $consulta->row ( 0 );
		if ($consulta) {
			return $row->view;
		} else {
			return FALSE;
		}
	}
	public function listar_caixas() {
		$cod_unidade = $this->session->userdata ( 'cod_unidade' );
		$caixas = $this->db->query ( "
        SELECT 
        c.cod_caixa
        ,c.codigo
        FROM 
        redes_caixas c
        LEFT JOIN redes_centrais rc ON c.cod_central = rc.cod_central
        WHERE 
        c.num_portas_disponiveis > 0
        AND rc.cod_unidade = '$cod_unidade'
        order by c.cep
        " );
		if ($caixas) {
			return $caixas;
		} else {
			return FALSE;
		}
	}
	/* Pegar login(s) do cliente */
	public function logins_os($codcli) {
		$db = $this->load->database ( 'infox', TRUE );
		$logins = $db->query ( "
        SELECT 
        *
        FROM 
        login_cliente
        WHERE 
        codigo_cliente = '$codcli'
        " );
		if ($logins) {
			return $logins;
		} else {
			return FALSE;
		}
	}
	public function estoque_tec_os($cod_usuario) {
		$logins = $this->db->query ( "
        SELECT 
        pi.cod_produtoitem as cod_produtoitem
        ,p.descricao AS descricao
        FROM 
        estoque_produtoitem pi
        LEFT JOIN estoque_produto p ON pi.cod_produto = p.cod_produto
        WHERE 
        pi.cod_usuario = '$cod_usuario'
        AND cod_statusitem = 2
        " );
		if ($logins) {
			return $logins;
		} else {
			return FALSE;
		}
	}
	public function estoque_cliente_os($codcli) {
		$logins = $this->db->query ( "
        SELECT 
        pi.cod_produtoitem as cod_produtoitem
        ,p.descricao AS descricao
        FROM 
        estoque_produtoitem pi
        LEFT JOIN estoque_produto p ON pi.cod_produto = p.cod_produto
        WHERE 
        pi.cliente = '$codcli'
        AND cod_statusitem = 3
        " );
		if ($logins) {
			return $logins;
		} else {
			return FALSE;
		}
	}
	/* Fechar OS Instalação Fibra */
	public function fechar_os_if($codcli, $cod_usuario, $cod_servico, $cod_caixa, $fibra_login, $fibra_onu_compartilhada, $fibra_cor, $fibra_spliter, $fibra_mac, $fr_budget, $cod_produtoitem, $hora_entrada, $hora_saida, $status_os, $obs, $codsercli) {
		/* Atualizar ope_servico */
		$dados_servico = array (
				'status_os' => $status_os,
				'hora_entrada' => $hora_entrada,
				'hora_saida' => $hora_saida,
				'obs' => $obs 
		);
		$this->db->where ( 'cod_servico', $cod_servico );
		$atualizar_servico = $this->db->update ( 'ope_servico', $dados_servico );
		/* Cadastra na redes_clientes dados da instalação */
		$dados_cliente = array (
				'contrato' => $codcli,
				'cod_caixa' => $cod_caixa,
				'fibra_cor' => $fibra_cor,
				'fibra_mac' => $fibra_mac,
				'fibra_spliter' => $fibra_spliter,
				'fibra_login' => $fibra_login,
				'fibra_onu_compartilhada' => $fibra_onu_compartilhada,
				'fr_budget' => $fr_budget,
				'codsercli' => $codsercli 
		);
		$cadastrar = $this->db->insert ( 'redes_clientes', $dados_cliente );
		/* Atualiza Estoque */
		$data_log = date ( 'Y-m-d' );
		$nome_usuario = $this->session->userdata ( 'nome' );
		$total_produtos = count ( $cod_produtoitem );
		// baixa no estoque do técnico
		if ($total_produtos >= 1) {
			/* FOR SAÍDA ESTOQUE */
			for($i = 0; $i < $total_produtos; $i ++) {
				$dados_estoque = array (
						'cod_usuario' => $cod_usuario,
						'cod_statusitem' => 3,
						'cliente' => $codcli,
						'data_cliente' => $data_log 
				);
				$this->db->where ( 'cod_produtoitem', $cod_produtoitem [$i] );
				$atualizar_estoque = $this->db->update ( 'estoque_produtoitem', $dados_estoque );
				// LOG_PRODUTO
				$dados_log = array (
						'descricao' => "Instalado no Cliente $codcli ($nome_usuario)",
						'cod_usuario' => $cod_usuario,
						'cod_produtoitem' => $cod_produtoitem [$i],
						'data_log' => $data_log 
				);
				if ($cod_produtoitem [$i] >= 100000) {
					$log = $this->db->insert ( 'estoque_logproduto', $dados_log );
				}
				// END LOG_PRODUTO
			} /* FIM FOR SAÍDA ESTOQUE */
		}
		// Atualiza caixas
		$atualizar_caixa = $this->db->query ( " UPDATE redes_caixas SET num_portas_disponiveis = num_portas_disponiveis - 1 WHERE cod_caixa = '$cod_caixa'; " );
		// Fim Atualiza Caixa
		if ($atualizar_estoque and $cadastrar and $atualizar_servico) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	/* Fechar OS Instalação Fibra */
	/* Fechar Instalação de telefone */
	public function fechar_os_it($codcli, $cod_usuario, $cod_servico, $cod_produtoitem, $hora_entrada, $hora_saida, $status_os, $obs, $tel_mac_ata, $tel_num_switch, $tel_vlan, $tel_numero, $codsercli) {
		/* Atualizar ope_servico */
		$dados_servico = array (
				'status_os' => $status_os,
				'hora_entrada' => $hora_entrada,
				'hora_saida' => $hora_saida,
				'obs' => $obs 
		);
		$this->db->where ( 'cod_servico', $cod_servico );
		$atualizar_servico = $this->db->update ( 'ope_servico', $dados_servico );
		/* Atualiza Estoque */
		$data_log = date ( 'Y-m-d' );
		$nome_usuario = $this->session->userdata ( 'nome' );
		$total_produtos = count ( $cod_produtoitem );
		if ($total_produtos >= 1) {
			for($i = 0; $i < $total_produtos; $i ++) {
				$dados_estoque = array (
						'cod_usuario' => $cod_usuario,
						'cod_statusitem' => 3,
						'cliente' => $codcli,
						'data_cliente' => $data_log 
				);
				$this->db->where ( 'cod_produtoitem', $cod_produtoitem [$i] );
				$atualizar_estoque = $this->db->update ( 'estoque_produtoitem', $dados_estoque );
				// LOG_PRODUTO
				$dados_log = array (
						'descricao' => "Instalado no Cliente $codcli ($nome_usuario) ",
						'cod_usuario' => $cod_usuario,
						'cod_produtoitem' => $cod_produtoitem [$i],
						'data_log' => $data_log 
				);
				if ($cod_produtoitem [$i] >= 100000) {
					$log = $this->db->insert ( 'estoque_logproduto', $dados_log );
				}
				// END LOG_PRODUTO
			} /* Fim FOR */
		}
		/* Cadastra na redes_clientes dados da instalação */
		$dados_cliente = array (
				
				'contrato' => $codcli,
				'tel_mac_ata' => $tel_mac_ata,
				'tel_num_switch' => $tel_num_switch,
				'tel_vlan' => $tel_vlan,
				'tel_numero' => $tel_numero,
				'codsercli' => $codsercli 
		
		);
		$cadastrar = $this->db->insert ( 'redes_clientes', $dados_cliente );
		if ($atualizar_estoque and $cadastrar and $atualizar_servico) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	/* Fechar OS Atendimento */
	public function fechar_os_atendimento($codcli, $cod_usuario, $cod_servico, $cod_produtoitem, $cod_produtoitem_cli, $hora_entrada, $hora_saida, $status_os, $obs) {
		/* Atualizar ope_servico */
		$dados_servico = array (
				'status_os' => $status_os,
				'hora_entrada' => $hora_entrada,
				'hora_saida' => $hora_saida,
				'obs' => $obs 
		);
		$this->db->where ( 'cod_servico', $cod_servico );
		$atualizar_servico = $this->db->update ( 'ope_servico', $dados_servico );
		/* Atualiza Estoque */
		$data_log = date ( 'Y-m-d' );
		$nome_usuario = $this->session->userdata ( 'nome' );
		$total_produtos = count ( $cod_produtoitem );
		$total_produtos_cli = count ( $cod_produtoitem_cli );
		// baixa no estoque do técnico
		if ($total_produtos >= 1) {
			/* FOR SAÍDA ESTOQUE */
			for($i = 0; $i < $total_produtos; $i ++) {
				$dados_estoque = array (
						'cod_usuario' => $cod_usuario,
						'cod_statusitem' => 3,
						'cliente' => $codcli,
						'data_cliente' => $data_log 
				);
				$this->db->where ( 'cod_produtoitem', $cod_produtoitem [$i] );
				$atualizar_estoque = $this->db->update ( 'estoque_produtoitem', $dados_estoque );
				// LOG_PRODUTO
				$dados_log = array (
						'descricao' => "Instalado no Cliente $codcli ($nome_usuario)",
						'cod_usuario' => $cod_usuario,
						'cod_produtoitem' => $cod_produtoitem [$i],
						'data_log' => $data_log 
				);
				if ($cod_produtoitem [$i] >= 100000) {
					$log = $this->db->insert ( 'estoque_logproduto', $dados_log );
				}
				// END LOG_PRODUTO
			} /* FIM FOR SAÍDA ESTOQUE */
		}
		// Entrada do pruduto no estoque do técnico
		// quando o mesmo faz uma retirada
		if ($total_produtos_cli >= 1) {
			/* FOR SAÍDA ESTOQUE */
			for($i = 0; $i < $total_produtos_cli; $i ++) {
				$dados_estoque = array (
						'cod_usuario' => $cod_usuario,
						'cod_statusitem' => 2,
						'cliente' => NULL,
						'data_tecnico' => $data_log,
						'data_cliente_saida' => $data_log 
				);
				$this->db->where ( 'cod_produtoitem', $cod_produtoitem_cli [$i] );
				$atualizar_estoque = $this->db->update ( 'estoque_produtoitem', $dados_estoque );
				// LOG_PRODUTO
				$dados_log = array (
						'descricao' => "Retirado do Cliente $codcli",
						'cod_usuario' => $cod_usuario,
						'cod_produtoitem' => $cod_produtoitem_cli [$i],
						'data_log' => $data_log,
						'data_log' => $data_log 
				);
				if ($cod_produtoitem_cli [$i] >= 100000) {
					$log = $this->db->insert ( 'estoque_logproduto', $dados_log );
				}
				// END LOG_PRODUTO
			} /* FIM FOR SAÍDA ESTOQUE */
		}
		if ($atualizar_estoque and $atualizar_servico) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	/* Atualizar tipo de ordem de servico */
	public function atualizar_ope_servico_tipo($cod_tipo_servico, $valor_ords, $retrabalho) {
		$dados = array (
				'valor_ords' => $valor_ords,
				'retrabalho' => $retrabalho 
		);
		$this->db->where ( 'cod_tipo_servico', $cod_tipo_servico );
		$atualizar = $this->db->update ( 'ope_servico_tipo', $dados );
		if ($atualizar) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	public function redes_tipo_antena() {
		$antenas = $this->db->query ( "
        SELECT 
        *
        FROM 
        redes_tipo_antena
        " );
		if ($antenas) {
			return $antenas;
		} else {
			return FALSE;
		}
	}
	/* Fechar OS Radio */
	public function fechar_os_radio($codcli, $cod_usuario, $cod_servico, $cod_produtoitem, $cod_produtoitem_cli, $hora_entrada, $hora_saida, $status_os, $radio_antena, $radio_ap, $r_ruido, $fr_budget, $obs, $codsercli) {
		/* Registrar dados técnicos da instalação */
		$dados_cliente = array (
				'contrato' => $codcli,
				'radio_antena' => $radio_antena,
				'fr_ruido' => $r_ruido,
				'fr_budget' => $fr_budget,
				'codsercli' => $codsercli 
		);
		
		$cadastrar_cliente = $this->db->insert ( 'redes_clientes', $dados_cliente );
		/* Atualizar ope_servico */
		$dados_servico = array (
				'status_os' => $status_os,
				'hora_entrada' => $hora_entrada,
				'hora_saida' => $hora_saida,
				'obs' => $obs 
		);
		$this->db->where ( 'cod_servico', $cod_servico );
		$atualizar_servico = $this->db->update ( 'ope_servico', $dados_servico );
		/* Atualiza Estoque */
		$data_log = date ( 'Y-m-d' );
		$nome_usuario = $this->session->userdata ( 'nome' );
		$total_produtos = count ( $cod_produtoitem );
		$total_produtos_cli = count ( $cod_produtoitem_cli );
		// baixa no estoque do técnico
		if ($total_produtos >= 1) {
			/* FOR SAÍDA ESTOQUE */
			for($i = 0; $i < $total_produtos; $i ++) {
				$dados_estoque = array (
						'cod_usuario' => $cod_usuario,
						'cod_statusitem' => 3,
						'cliente' => $codcli,
						'data_cliente' => $data_log 
				);
				$this->db->where ( 'cod_produtoitem', $cod_produtoitem [$i] );
				$atualizar_estoque = $this->db->update ( 'estoque_produtoitem', $dados_estoque );
				// LOG_PRODUTO
				$dados_log = array (
						'descricao' => "Instalado no Cliente $codcli ($nome_usuario)",
						'cod_usuario' => $cod_usuario,
						'cod_produtoitem' => $cod_produtoitem [$i],
						'data_log' => $data_log 
				);
				if ($cod_produtoitem [$i] >= 100000) {
					$log = $this->db->insert ( 'estoque_logproduto', $dados_log );
				}
				// END LOG_PRODUTO
			} /* FIM FOR SAÍDA ESTOQUE */
		}
		// Entrada do pruduto no estoque do técnico
		// quando o mesmo faz uma retirada
		if ($total_produtos_cli >= 1) {
			/* FOR SAÍDA ESTOQUE */
			for($i = 0; $i < $total_produtos_cli; $i ++) {
				$dados_estoque = array (
						'cod_usuario' => $cod_usuario,
						'cod_statusitem' => 2,
						'cliente' => NULL,
						'data_tecnico' => $data_log,
						'data_cliente_saida' => $data_log 
				);
				$this->db->where ( 'cod_produtoitem', $cod_produtoitem_cli [$i] );
				$atualizar_estoque = $this->db->update ( 'estoque_produtoitem', $dados_estoque );
				// LOG_PRODUTO
				$dados_log = array (
						'descricao' => "Retirado do Cliente $codcli",
						'cod_usuario' => $cod_usuario,
						'cod_produtoitem' => $cod_produtoitem_cli [$i],
						'data_log' => $data_log,
						'data_log' => $data_log 
				);
				if ($cod_produtoitem_cli [$i] >= 100000) {
					$log = $this->db->insert ( 'estoque_logproduto', $dados_log );
				}
				// END LOG_PRODUTO
			} /* FIM FOR SAÍDA ESTOQUE */
		}
		if ($atualizar_estoque and $atualizar_servico and $cadastrar_cliente) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	/* Fechar OS TV */
	public function fechar_os_tv($codcli, $cod_usuario, $cod_servico, $cod_produtoitem, $cod_produtoitem_cli, $hora_entrada, $hora_saida, $status_os, $tv_pontos, $tv_stb, $tv_antenas, $tv_diplex, $tv_qtd_cabo, $obs, $codsercli) {
		/* Registrar dados técnicos da instalação */
		$dados_cliente = array (
				'contrato' => $codcli,
				'tv_pontos' => $tv_pontos,
				'tv_stb' => $tv_stb,
				'tv_antena' => $tv_antenas,
				'tv_diplex' => $tv_diplex,
				'tv_qtd_cabo' => $tv_qtd_cabo,
				'codsercli' => $codsercli 
		);
		$cadastrar_cliente = $this->db->insert ( 'redes_clientes', $dados_cliente );
		/* Atualizar ope_servico */
		$dados_servico = array (
				'status_os' => $status_os,
				'hora_entrada' => $hora_entrada,
				'hora_saida' => $hora_saida,
				'obs' => $obs 
		);
		$this->db->where ( 'cod_servico', $cod_servico );
		$atualizar_servico = $this->db->update ( 'ope_servico', $dados_servico );
		/* Atualiza Estoque */
		$data_log = date ( 'Y-m-d' );
		$nome_usuario = $this->session->userdata ( 'nome' );
		echo $total_produtos = count ( $cod_produtoitem );
		echo $total_produtos_cli = count ( $cod_produtoitem_cli );
		// baixa no estoque do técnico
		if ($total_produtos >= 1) {
			/* FOR SAÍDA ESTOQUE */
			for($i = 0; $i < $total_produtos; $i ++) {
				$dados_estoque = array (
						'cod_usuario' => $cod_usuario,
						'cod_statusitem' => 3,
						'cliente' => $codcli,
						'data_cliente' => $data_log 
				);
				$this->db->where ( 'cod_produtoitem', $cod_produtoitem [$i] );
				$atualizar_estoque = $this->db->update ( 'estoque_produtoitem', $dados_estoque );
				// LOG_PRODUTO
				$dados_log = array (
						'descricao' => "Instalado no Cliente $codcli ($nome_usuario)",
						'cod_usuario' => $cod_usuario,
						'cod_produtoitem' => $cod_produtoitem [$i],
						'data_log' => $data_log 
				);
				
				$log = $this->db->insert ( 'estoque_logproduto', $dados_log );
				// END LOG_PRODUTO
			} /* FIM FOR SAÍDA ESTOQUE */
		}
		// Entrada do pruduto no estoque do técnico
		// quando o mesmo faz uma retirada
		if ($total_produtos_cli >= 1) {
			/* FOR SAÍDA ESTOQUE */
			for($i = 0; $i < $total_produtos_cli; $i ++) {
				$dados_estoque = array (
						'cod_usuario' => $cod_usuario,
						'cod_statusitem' => 2,
						'cliente' => NULL,
						'data_tecnico' => $data_log,
						'data_cliente_saida' => $data_log 
				);
				$this->db->where ( 'cod_produtoitem', $cod_produtoitem_cli [$i] );
				$atualizar_estoque = $this->db->update ( 'estoque_produtoitem', $dados_estoque );
				// LOG_PRODUTO
				$dados_log = array (
						'descricao' => "Retirado do Cliente $codcli",
						'cod_usuario' => $cod_usuario,
						'cod_produtoitem' => $cod_produtoitem_cli [$i],
						'data_log' => $data_log,
						'data_log' => $data_log 
				);
				$log = $this->db->insert ( 'estoque_logproduto', $dados_log );
				// END LOG_PRODUTO
			} /* FIM FOR SAÍDA ESTOQUE */
		}
		if ($atualizar_estoque and $atualizar_servico and $cadastrar_cliente) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	/**
	 * *****************
	 * INICIO CONSULTAS DASHBOARD
	 * COM FILTRO POR UNIDADE
	 * ******************
	 */
	// Ranking
	public function ranking_graf($unidade) {
		$consulta = $this->db->query ( "
        SELECT
        SUM(st.pontos) AS total
        ,u.nome AS nome
        ,u.cod_unidade as cod_unidade
        ,un.sigla as sigla
        from ope_servico_tec st
        LEFT JOIN sys_usuarios u  ON st.cod_usuario = u.cod_usuario
        LEFT JOIN sys_unidade un ON u.cod_unidade = un.cod_unidade
        LEFT JOIN ope_servico s ON st.cod_servico = s.cod_servico
        WHERE
        s.data_servico BETWEEN ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 1 MONTH)), 1) AND last_day(sysdate())
        AND u.cod_unidade = $unidade
        AND (s.retrabalho IS NULL OR s.retrabalho = 0)
        AND s.status_os = 'F'
        GROUP BY st.cod_usuario
        order by u.nome desc
        " );

		if ($consulta) {
			return $consulta;
		} else {
			return FALSE;
		}
		
	}
	/**
	 * *****************
	 * INICIO CONSULTAS DASHBOARD
	 * COM FILTRO POR UNIDADE
	 * ******************
	 */
	public function dados_meta() {
		$unidade = '';
		if ($this->session->userdata ( 'nivel' ) != 5) {
			$unidade = ' and s.cod_unidade = ' . $this->session->userdata ( 'cod_unidade' );
		}
		$consulta = $this->db->query ( "SELECT s.cod_usuario as cod_usuario,s.nome as nome, sy.descri_unidade as unidade, sys.descri_setor as descri_setor 
			FROM sys_usuarios as s
			INNER JOIN sys_unidade as sy on sy.cod_unidade = s.cod_unidade
			INNER JOIN sys_setor as sys on sys.cod_setor = s.cod_setor
			WHERE s.ativo = 1 and s.cod_setor = 2 and s.tecnico = 1 $unidade ORDER BY s.nome" );
		if ($consulta) {
			return $consulta;
		} else {
			return FALSE;
		}
	}
	public function dados_usuario_meta($usuario) {
		$consulta = $this->db->query ( "SELECT  s.nome, ss.descri_setor,sy.descri_unidade
			FROM sys_usuarios AS s
			INNER JOIN sys_unidade AS sy ON sy.cod_unidade = s.cod_unidade
			INNER JOIN sys_setor AS ss ON ss.cod_setor = s.cod_setor
			WHERE s.cod_usuario = $usuario AND s.ativo = 1 AND s.tecnico = 1 AND s.cod_setor = 2" );
		if ($consulta) {
			return $consulta;
		} else {
			return FALSE;
		}
	}
	public function dados_meta_usuario($usuario) {
		$consulta = $this->db->query ( "SELECT om.cod_usuario,om.valor,om.data_mes,om.data_ano,om.cod_meta 
		FROM ope_meta AS om 
		INNER JOIN sys_usuarios AS su ON su.cod_usuario = om.cod_usuario
		WHERE om.cod_usuario = $usuario and su.ativo = 1 and su.cod_setor = 2 and su.tecnico = 1 " );
		if ($consulta) {
			return $consulta;
		} else {
			return FALSE;
		}
	}
	public function dados_meta_editar($id, $valor) {
		$data = array (
				'valor' => $valor 
		);
		$this->db->where ( 'cod_meta', $id );
		$editar = $this->db->update ( 'ope_meta', $data );
		if ($editar) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	public function lista_retrabalho($data_i, $data_f) {
		$consulta = $this->db->query ( "
    SELECT os.cod_servico, os.codcli, st.descri_ords, os.obs, DATE_FORMAT(os.data_servico, '%d/%m/%Y') as data_servico ,os.status_os, os.retrabalho FROM ope_servico os
    LEFT JOIN ope_servico_tipo st ON os.cod_tipo_servico = st.cod_tipo_servico
    WHERE 
    os.codcli IN(
    select ose.codcli from ope_servico ose where ose.status_os = 'F' AND ose.data_servico BETWEEN '$data_i' AND '$data_f' group by ose.codcli having count(ose.codcli) > 1
    )
    AND os.data_servico BETWEEN '$data_i' AND '$data_f'
    " );
		if ($consulta) {
			return $consulta;
		} else {
			return FALSE;
		}
	}
	public function marcar_retrabalho($cod_servico) {
		$this->db->set ( 'retrabalho', 1 );
		$this->db->where ( 'cod_servico', $cod_servico );
		$marcar = $this->db->update ( 'ope_servico' );
		if ($marcar) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	/* Gravar Log */
	public function grava_log($cod_usuario, $atividade, $data) {
		$dados = array (
				'cod_usuario' => $cod_usuario,
				'atividade' => $atividade,
				'data' => $data 
		);
		$this->db->insert ( 'sys_log_usu', $dados );
	}
	public function codsercli($cod_servico) {
		$consulta = $this->db->query ( "
            SELECT os.codsercli
            FROM ope_servico os
            WHERE 
            os.cod_servico = '$cod_servico'
            " );
		$row = $consulta->row ( 0 );
		if ($consulta) {
			return $row->codsercli;
		} else {
			return '';
		}
	}
	public function ordens_sem_codcli() {
		$consulta = $this->db->query ( "
            SELECT os.cod_servico
            FROM ope_servico os
            WHERE 
            os.codcli IS NULL OR os.codcli = ''
            " );
		if ($consulta) {
			return $consulta;
		} else {
			return FALSE;
		}
	}
	public function pega_codcli($cod_servico) {
		$consulta = $this->db->query ( "
            SELECT sc.codcli
            FROM ope_servico os
            LEFT JOIN servicos_cli sc ON os.codsercli = sc.codsercli
            WHERE 
            os.cod_servico = '$cod_servico'
            " );
		$row = $consulta->row ( 0 );
		if ($consulta) {
			return $row->codcli;
		} else {
			return '';
		}
	}
	public function inserir_codcli($cod_servico, $codcli) {
		$dados = array (
				'codcli' => $codcli 
		);
		$this->db->where ( 'cod_servico', $cod_servico );
		$this->db->update ( 'ope_servico', $dados );
	}
	public function dados_meta_inserir($valor,$data_ini,$data_fim,$usuario){
		$data_ini_explode = explode("-", $data_ini);
		if($data_fim != ''){
			$data_fim_explode = explode("-", $data_fim);
			$consulta = $this->db->query ("SELECT * FROM ope_meta WHERE cod_usuario = '$usuario' AND data_mes BETWEEN '$data_ini_explode[1]' AND '$data_fim_explode[1]' AND data_ano BETWEEN '$data_ini_explode[0]' AND '$data_fim_explode[0]'");
			if($consulta->num_rows () != 0){
				$this->db->where ( 'data_mes <=', $data_fim_explode[1]);
				$this->db->where ( 'data_mes >=', $data_ini_explode[1]);
				$this->db->where ( 'data_ano <=', $data_fim_explode[0]);
				$this->db->where ( 'data_ano >=', $data_ini_explode[0]);
				$this->db->where ( 'cod_usuario', $usuario);
				$excluir = $this->db->delete ('ope_meta');
			}
			$interval = (date_diff(date_create($data_ini),date_create($data_fim))->format('%m')) + (12*(date_diff(date_create($data_ini),date_create($data_fim))->format('%y')));
			$ano = $data_ini_explode[0];
			$mes =  $data_ini_explode[1];
			for ($i = 0; $i <= $interval; $i++) {
				
				$data = array(
						'cod_usuario' => $usuario,
						'valor' => $valor,
						'data_mes' => $mes,
						'data_ano' => $ano
				);
				$inserir=$this->db->insert('ope_meta', $data);
				if($mes==12){
					$mes = 0;
					$ano = $ano+1;
				}
				$mes ++;
			}
			return true;
		}else{
			$consulta = $this->db->query ("SELECT * FROM ope_meta WHERE cod_usuario = '$usuario' AND data_mes = '$data_ini_explode[1]' AND data_ano = '$data_ini_explode[0]' ");
			if($consulta->num_rows () == 0){
				$data = array(
						'cod_usuario' => $usuario,
						'valor' => $valor,
						'data_mes' => $data_ini_explode[1],
						'data_ano' => $data_ini_explode[0]
				);
				$inserir=$this->db->insert('ope_meta', $data);
				if($inserir){
					return true;
				}
				else{
					return  false;
				}
			}else{
				return  false;
			}
		}
	} 
	public function dados_meta_excluir($id){
		$this->db->where ( 'cod_meta', $id);
		$excluir = $this->db->delete ('ope_meta');
		if($excluir){
			return true;
		}else{
			return  false;
		}
	}
	public function listar_unidades(){
		$unidade = '';
		if ($this->session->userdata ( 'nivel' ) != 5) {
			$unidade = ' where cod_unidade = ' . $this->session->userdata ( 'cod_unidade' );
		}
		$consulta = $this->db->query ( "SELECT * FROM sys_unidade $unidade" );
		if ($consulta) {
			return $consulta;
		} else {
			return FALSE;
		}
	}
	public function listar_meta_servico($unidade){
		$consulta = $this->db->query ( "SELECT * 
			FROM 
				ope_meta_servico
			where 
				cod_unidade = '$unidade'" );
		if ($consulta) {
			return $consulta;
		} else {
			return FALSE;
		}
	}
	public function servico_tipo($servico){
		$consulta = $this->db->query ( "SELECT *
				FROM
				ope_servico_tipo
				where
				cod_tipo_servico = '$servico'" );
		if ($consulta) {
			return $consulta;
		} else {
			return FALSE;
		}
	}
	public function dados_meta_servico_editar($id, $valor) {
		$data = array (
				'valor' => $valor
		);
		$this->db->where ( 'cod_meta_servico', $id );
		$editar = $this->db->update ( 'ope_meta_servico', $data );
		if ($editar) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	public function dados_meta_servico_inserir($valor,$data_ini,$data_fim,$unidade){
		$data_ini_explode = explode("-", $data_ini);
		$ano = $data_ini_explode[0];
		$mes =  $data_ini_explode[1];
		if($data_fim != ''){
			$data_fim_explode = explode("-", $data_fim);
			$consulta = $this->db->query ("SELECT * FROM ope_meta_servico WHERE data_mes BETWEEN '$data_ini_explode[1]' AND '$data_fim_explode[1]' AND data_ano BETWEEN '$data_ini_explode[0]' AND '$data_fim_explode[0]' AND cod_unidade = '$unidade'");
			if($consulta->num_rows () != 0){
				$this->db->where ( 'data_mes <=', $data_fim_explode[1]);
				$this->db->where ( 'data_mes >=', $data_ini_explode[1]);
				$this->db->where ( 'data_ano <=', $data_fim_explode[0]);
				$this->db->where ( 'data_ano >=', $data_ini_explode[0]);
				$this->db->where ( 'cod_unidade', $unidade);
				$excluir = $this->db->delete ('ope_meta_servico');
			}
			$interval = (date_diff(date_create($data_ini),date_create($data_fim))->format('%m')) + (12*(date_diff(date_create($data_ini),date_create($data_fim))->format('%y')));
			
			for ($i = 0; $i <= $interval; $i++) {
				$data = array(
						'valor' => $valor,
						'data_mes' => $mes,
						'data_ano' => $ano,
						'cod_unidade' => $unidade
				);
				$inserir=$this->db->insert('ope_meta_servico', $data);
				if($mes==12){
					$mes = 0;
					$ano = $ano+1;
				}
				$mes ++;
			}
			return true;
		}else{
			$consulta = $this->db->query ("SELECT * FROM ope_meta_servico WHERE data_mes = '$data_ini_explode[1]' AND data_ano = '$data_ini_explode[0]' AND cod_unidade = '$unidade'");
			if($consulta->num_rows () == 0){
				$data = array(
						'valor' => $valor,
						'data_mes' => $mes,
						'data_ano' => $ano,
						'cod_unidade' => $unidade
				);
				$inserir=$this->db->insert('ope_meta_servico', $data);
				if($inserir){
					return true;
				}
				else{
					return  false;
				}
			}else{
				return  false;
			}
		}
	}
	public function dados_meta_servico_excluir($id){
		$this->db->where ( 'cod_meta_servico', $id);
		$excluir = $this->db->delete ('ope_meta_servico');
		if($excluir){
			return true;
		}else{
			return  false;
		}
	}
}/*END MODEL*/
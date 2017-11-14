<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Relatorio_model extends CI_Model {
	public function exporta_manutencao() {
		$consulta = $this->db->query ( "select m.cod_manutencao as OS
			,m.cod_produtoitem as CODIGO
			,p.descricao as PRODUTO
			,m.data_entrada AS DATA_ENTRADA
			,m.data_saida AS DATA_SAIDA
			,m.retorno AS RETORNOS
			,m.data_retorno AS DATA_ULTIMO_RETORNO
			,sy.nome AS RESPONSAVEL
			,sm.descricao AS STATUS
			,pi.preco_custo AS PRECo_CUSTO
			from estoque_manutencao m
			inner join sys_usuarios as sy on sy.cod_usuario = m.cod_usuario
			inner join estoque_produtoitem as pi on m.cod_produtoitem = pi.cod_produtoitem
			inner join estoque_produto as p on pi.cod_produto = p.cod_produto
			inner join estoque_statusmanutencao as sm on m.cod_statusmanutencao = sm.cod_statusmanutencao
			where m.ativo = 1" );
		if ($consulta) {
			return $consulta;
		}
		else{
			return False;
		}
	}
	public function relatorio_callcenter($data_ini,$data_fim) {
		$consulta = $this->db->query ( "SELECT c.nome_cli as nome_cli,c.bairro as bairro,cd.nome_cid as nome_cid,c.codcli as codcli,o.data_lan as data_lan,o.descri_oco as descri_oco,o.script as script,u.nome_usu as nome_usu FROM isp_city10.ocorrencias as o
			inner join clientes as c on o.codcli=c.codcli
			inner join usuarios as u on o.codusu=u.codusu
			inner join cidades as cd  on c.cidade=cd.cidade
			where o.codcar = '01WX0Y8WTX' and o.data_lan BETWEEN '$data_ini' and '$data_fim' ORDER BY o.data_lan DESC;" );
		if ($consulta) {
			return $consulta;
		}
		else{
			return False;
		}
	}
	public function dados_usuario() {
		$consulta = $this->db->query ( "SELECT s.nome, sy.descri_unidade,ss.descri_setor,s.email, s.telefone_1, s.telefone_2,s.ramal FROM sys_usuarios as s
			inner join sys_unidade as sy on sy.cod_unidade = s.cod_unidade
			inner join sys_setor as ss on ss.cod_setor = s.cod_setor
			where s.ativo = 1 ORDER BY s.nome;" );
		if ($consulta) {
			return $consulta;
		}
		else{
			return False;
		}
	}
	public function retiradas($data_ini,$data_fim,$unidade){
		$consulta = $this->db->query ( "SELECT c.codcli AS contrato ,c.nome_cli AS nome ,cid.nome_cid AS cidade ,se.descri_ser AS plano ,sc.valor_plano AS valor ,sc.data_can AS data_can ,mc.descri_can AS motivo ,gs.descri_gser ,IF(sc.codsercli_p='','Cancelamento','Migração') AS tipo
				FROM servicos_cli sc
				LEFT JOIN servicos se ON sc.codser = se.codser
				LEFT JOIN grupos_servicos gs ON se.codgser = gs.codgser
				LEFT JOIN clientes c ON sc.codcli = c.codcli
				LEFT JOIN cidades cid ON c.cidade = cid.cidade
				LEFT JOIN cidades_pop cp ON c.cidade = cp.cidade
				LEFT JOIN motivos_cancel mc ON sc.codcan = mc.codcan
				INNER JOIN sys_unidade ssu ON ssu.codpop = cp.codpop
				WHERE sc.data_can BETWEEN '$data_ini' AND '$data_fim'
				AND mc.codcan != 'E4HH0UYKV8' AND mc.codcan != 'EZ2W123KXG' AND mc.codcan != 'EZ2W123963' AND mc.codcan != 'EZ2W122KTX' and se.codser != 'SER0000109'
				AND sc.codsercli_p = '' AND mc.descri_can IS NOT NULL AND ssu.url = '$unidade' AND sc.codcan IS NOT NULL" );
		if ($consulta) {
			return $consulta;
		}
		else{
			return False;
		}
	}
	public function ordens_lancadas($data_ini,$data_fim,$unidade){
		$consulta = $this->db->query ( "SELECT COUNT(*) as contagem
			FROM ordem_servico as os
			INNER JOIN ocorrencias AS oco ON oco.codoco = os.codoco
			INNER jOIN clientes AS cl ON cl.codcli = oco.codcli
			INNER JOIN cidades_pop AS cp ON cp.cidade = cl.cidade
			INNER JOIN sys_unidade ssu ON ssu.codpop = cp.codpop
			WHERE os.codtords = 'E45P151DOD' and os.data_cad BETWEEN '$data_ini' AND '$data_fim' and ssu.url = '$unidade' " );
		if ($consulta) {
			return $consulta;
		}
		else{
			return False;
		}
	}
	public function ordens_fechadas($data_ini,$data_fim,$unidade){
		$consulta = $this->db->query ( "SELECT COUNT(*) as contagem
				FROM ordem_servico as os
				INNER JOIN ocorrencias AS oco ON oco.codoco = os.codoco
				INNER jOIN clientes AS cl ON cl.codcli = oco.codcli
				INNER JOIN cidades_pop AS cp ON cp.cidade = cl.cidade
				INNER JOIN sys_unidade ssu ON ssu.codpop = cp.codpop
				WHERE os.codtords = 'E45P151DOD' and os.data_cad BETWEEN '$data_ini' AND '$data_fim' and ssu.url = '$unidade' and os.status_os = 'F' " );
		if ($consulta) {
			return $consulta;
		}
		else{
			return False;
		}
	}	
	public function relatorios(){
		$usuario ="";
		if($_SESSION ['nivel']!=5){
			$usuario = "and sy.cod_usuario ='".$_SESSION ['cod_usuario']."'";
		}
		$caixas = $this->db->query("SELECT s.uri_pagina,s.titulo FROM sys_paginas as s
			left join sys_permissoes as sy on s.cod_pagina=sy.cod_pagina
			where s.cod_setor = '8' and s.atalho = '0' ".$usuario." group by uri_pagina ");
		if($caixas)
		{
			return $caixas;
		}
		else
		{
			return FALSE;
		}
	}
	public function comissao($data_inicio,$unidade){
		$data_fim = date('Y-m-d', strtotime("+1 month", strtotime($data_inicio)));
		$data_inicio_explode = explode("-", $data_inicio);
		$caixas = $this->db->query("SELECT su.nome,SUM(CASE os.retrabalho WHEN '1' THEN '0' ELSE ost.pontos*ostp.valor_ords END) as comissao_bruta, sun.descri_unidade,ss.descri_setor,SUM(CASE os.retrabalho WHEN '1' THEN '0' ELSE ost.pontos END) as meta_realizada, om.valor as meta_definida, (SUM(CASE os.retrabalho WHEN '1' THEN '0' ELSE ost.pontos END)*100/om.valor) as percentual, if((SUM(CASE os.retrabalho WHEN '1' THEN '0' ELSE ost.pontos END)*100/om.valor) <=100, (((SUM(CASE os.retrabalho WHEN '1' THEN '0' ELSE ost.pontos END)*100/om.valor)*SUM(CASE os.retrabalho WHEN '1' THEN '0' ELSE ostp.valor_ords*ost.pontos END))/100),(SUM(CASE os.retrabalho WHEN '1' THEN '0' ELSE ost.pontos*ostp.valor_ords END)*100)/(SUM(CASE os.retrabalho WHEN '1' THEN '0' ELSE ost.pontos END)*100/om.valor)) as comissao
			FROM ope_servico AS os 
			INNER JOIN ope_servico_tec AS ost ON ost.cod_servico = os.cod_servico
			INNER JOIN ope_servico_tipo AS ostp ON ostp.cod_tipo_servico = os.cod_tipo_servico
			INNER JOIN sys_usuarios AS su ON  su.cod_usuario = ost.cod_usuario
			INNER JOIN sys_unidade AS sun ON su.cod_unidade = sun.cod_unidade
			INNER JOIN sys_setor AS ss ON ss.cod_setor = su.cod_setor
			INNER JOIN ope_meta AS om ON om.cod_usuario = su.cod_usuario
			WHERE su.ativo = 1 and su.cod_setor = 2 AND su.tecnico = 1 AND os.data_servico >= '$data_inicio' AND os.data_servico <'$data_fim' AND om.data_mes = '$data_inicio_explode[1]' and om.data_ano = '$data_inicio_explode[0]' AND os.status_os = 'f' AND sun.url = '$unidade' group by 1");
		if($caixas)
		{
			return $caixas;
		}
		else
		{
			return FALSE;
		}
	}
	public function comissao_por_servico($data_inicio,$unidade){
		$data_fim = date('Y-m-d', strtotime("+1 month", strtotime($data_inicio)));
		$data_inicio_explode = explode("-", $data_inicio);
		$caixas = $this->db->query("SELECT SUM(valor) as valor, descri_gser FROM (SELECT if (v.percentual<=100,(v.percentual*SUM(if (os.retrabalho = 1,0,ostp.valor_ords*ost.pontos))/100),((SUM(if(os.retrabalho=1,0,ost.pontos*ostp.valor_ords))*100)/v.percentual)) as valor,gs.descri_gser,gs.codgser
			FROM (SELECT su.cod_usuario,(SUM(if(os.retrabalho=1,0,ost.pontos))*100/om.valor) as percentual
			FROM ope_servico AS os 
						INNER JOIN ope_servico_tec AS ost ON ost.cod_servico = os.cod_servico
						INNER JOIN sys_usuarios AS su ON  su.cod_usuario = ost.cod_usuario
						INNER JOIN sys_unidade AS sun ON su.cod_unidade = sun.cod_unidade
						INNER JOIN ope_meta AS om ON om.cod_usuario = su.cod_usuario
						WHERE su.ativo = 1 and su.cod_setor = 2 AND su.tecnico = 1 AND 
			            os.data_servico >= '$data_inicio' AND os.data_servico <'$data_fim' AND 
			            om.data_mes = '$data_inicio_explode[1]' and om.data_ano = '$data_inicio_explode[0]' AND 
			            os.status_os = 'f' AND sun.url = '$unidade' group by 1) v 
			inner join ope_servico_tec as ost on ost.cod_usuario = v.cod_usuario
			inner join ope_servico as os on ost.cod_servico = os.cod_servico
			inner join servicos_cli as sc on sc.codsercli = os.codsercli
			inner join servicos as s on s.codser = sc.codser
			inner join grupos_servicos as gs on gs.codgser = s.codgser
			INNER JOIN ope_servico_tipo AS ostp ON ostp.cod_tipo_servico = os.cod_tipo_servico
			where os.status_os = 'F' and os.data_servico >= '$data_inicio' AND os.data_servico <'$data_fim' 
			group by gs.codgser,v.cod_usuario) V2
			group by codgser");
		if($caixas)
		{
			return $caixas;
		}
		else
		{
			return FALSE;
		}
	}
	public function comissao_rede($unidade){
		$caixas = $this->db->query("SELECT su.nome, sun.descri_unidade,ss.descri_setor
				FROM sys_usuarios AS su
				INNER JOIN sys_unidade AS sun ON su.cod_unidade = sun.cod_unidade
				INNER JOIN sys_setor AS ss ON ss.cod_setor = su.cod_setor
				WHERE su.ativo = 1 AND su.cod_setor = 1 AND su.tecnico = 1 AND su.nivel <>5 AND sun.url = '$unidade'");
		if($caixas)
		{
			return $caixas;
		}
		else
		{
			return FALSE;
		}
	}
	// Pegar soma de OS's de retrabalho por periodo
	public function retrabalhos($data_i, $data_f)
	{
		$consulta = $this->db->query("
			SELECT
			extract(month from os.data_servico) as mes
			,IF(SUM(os.retrabalho)>0,SUM(os.retrabalho),0) as total
			FROM 
			ope_servico os
			WHERE 
			extract(month from os.data_servico) IS NOT NULL
			and os.data_servico != ''
			and os.data_servico != 0
			and os.status_os = 'F'
			and os.data_servico between '$data_i' and '$data_f'
			group by extract(month from os.data_servico);
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
	// Total de OS por mes para calculos de retrabalho
	public function os_total($data_i, $data_f)
	{
		$consulta = $this->db->query("
			SELECT
			extract(month from os.data_servico) as mes
			,count(*) as total
			FROM 
			ope_servico os
			WHERE 
			os.data_servico is not NULl
			and os.data_servico != ''
			and os.data_servico != 0
			and os.status_os = 'F'
			and os.data_servico between '$data_i' and '$data_f'
			group by extract(month from os.data_servico);
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
	public function solicitacoes_ti($data_inicio){
		$data_fim = date('Y-m-d', strtotime("+1 month", strtotime($data_inicio)));
		$caixas = $this->db->query("SELECT su.nome, COUNT(*) as quantidade, ra.descricao
			FROM redes_solicitacoes AS r
			INNER JOIN redes_atividades AS ra ON ra.cod_atividade = r.cod_atividade
			INNER JOIN sys_usuarios AS su ON su.cod_usuario = r.cod_usuario
			WHERE r.data_solicitacao >= '$data_inicio' AND r.data_solicitacao < '$data_fim' GROUP BY r.cod_usuario,ra.cod_atividade");
		if($caixas)
		{
			return $caixas;
		}
		else
		{
			return FALSE;
		}
	}
	public function solicitacoes_ti_total($data_inicio){
		$data_fim = date('Y-m-d', strtotime("+1 month", strtotime($data_inicio)));
		$caixas = $this->db->query("SELECT rs.cod_atividade,ra.descricao,count(*) AS quantidade
			FROM redes_solicitacoes AS rs
			INNER JOIN redes_atividades AS ra ON ra.cod_atividade = rs.cod_atividade
			WHERE rs.data_solicitacao >= '$data_inicio' AND rs.data_solicitacao < '$data_fim' GROUP BY rs.cod_atividade");
		if($caixas)
		{
			return $caixas;
		}
		else
		{
			return FALSE;
		}
	}


	// Instatisfacao por banda
	public function insatisfacao_banda($data_i, $data_f)
	{
		$consulta = $this->db->query("
			SELECT
			IF(count(pa.produto)>0,count(pa.produto),0) as total
			,extract(month from os.data_servico) as mes
			,se.descri_ser AS plano
			FROM mkt_pos_atendimento pa
			LEFT JOIN ope_servico os ON pa.cod_servico = os.cod_servico
			LEFT JOIN servicos_cli sc ON os.codsercli = sc.codsercli
			LEFT JOIN servicos se ON sc.codser = se.codser
			WHERE
			pa.produto = 'Insatisfeito'
			group by se.descri_ser
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

	// Cancelados por periodo
	public function cancelados_periodo($data_i, $data_f, $pop)
	{
		$consulta = $this->db->query("
			SELECT
			sc.codcli AS contrato
			,c.nome_cli AS cliente
			,se.descri_ser AS plano
			,st.descri_est AS status
			,mc.descri_can AS motivo
			,sc.data_can
			,sc.codpop AS unidade
			FROM 
			servicos_cli sc
			LEFT JOIN servicos se ON sc.codser = se.codser
			LEFT JOIN motivos_cancel mc ON sc.codcan = mc.codcan
			LEFT JOIN clientes c ON sc.codcli = c.codcli
			LEFT JOIN status st ON sc.codest = st.codest
			WHERE
			sc.data_can BETWEEN '$data_i' AND '$data_f'
			AND sc.codest = '020IN0W6LU'
			AND sc.codcan NOT IN('EZ2W122KTX', 'EZ2W123KXG', 'EZ6K0WBEEI', 'EZ2W123963')
			AND sc.codser NOT IN('SER0000098', 'SER0000027')
			AND sc.codpop = '$pop'
			AND mc.descri_can IS NOT NULL
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
	
	public function tipos_os_instalacao()
	{
		$consulta = $this->db->query("SELECT descri_ords,cod_tipo_servico FROM ope_servico_tipo 
			WHERE ativo = 1 AND
			(cod_tipo_servico = 'IAX90MWJ7C' or 
			 cod_tipo_servico = 'IAX90MZKXK' or 
			 cod_tipo_servico = 'IAX90MQNKW' or 
			 cod_tipo_servico = 'IAX90MYMGX' or
			 cod_tipo_servico = 'IAX90MZ25W' or
			 cod_tipo_servico = 'IAX90MZE87' or
			 cod_tipo_servico = 'IAX90MRT96' or
			 cod_tipo_servico = 'IAX90MSL36' or
			 cod_tipo_servico = 'IAX90MWYHK' or
			 cod_tipo_servico = 'IAX90MXCPJ' or
			 cod_tipo_servico = 'IAX90N06PQ' or
 			cod_tipo_servico = 'IAX90N0HD8')");
		if($consulta)
		{
			return $consulta;
		}
		else
		{
			return FALSE;
		}
	}
	public function instalacao_mes($data_i, $data_f, $unidade)
	{
		$consulta = $this->db->query("
			SELECT cod_tipo_servico, quantidade FROM (
				SELECT 
					os.cod_tipo_servico as cod_tipo_servico, count(*) as quantidade
				FROM 
					ope_servico_tipo as ost 
					inner JOIN isp_city10.ope_servico as os on os.cod_tipo_servico = ost.cod_tipo_servico
					INNER JOIN ope_servico_tec AS ot on os.cod_servico = ot.cod_servico
					INNER JOIN sys_usuarios AS su ON su.cod_usuario = ot.cod_usuario
					INNER JOIN sys_unidade AS ss ON ss.cod_unidade = su.cod_unidade
				WHERE 
					os.status_os = 'F' 
					and os.data_servico is not null  
					and os.data_servico  >='$data_i' and os.data_servico  <'$data_f'
					and ss.url = '$unidade'
					and 
			            (os.cod_tipo_servico = 'IAX90MWJ7C' or 
						 os.cod_tipo_servico = 'IAX90MZKXK' or 
						 os.cod_tipo_servico = 'IAX90MQNKW' or 
						 os.cod_tipo_servico = 'IAX90MYMGX' or
						 os.cod_tipo_servico = 'IAX90MZ25W' or
						 os.cod_tipo_servico = 'IAX90MZE87' or
						 os.cod_tipo_servico = 'IAX90MRT96' or
						 os.cod_tipo_servico = 'IAX90MSL36' or
						 os.cod_tipo_servico = 'IAX90MWYHK' or
						 os.cod_tipo_servico = 'IAX90MXCPJ' or
						 os.cod_tipo_servico = 'IAX90N06PQ' or
						 os.cod_tipo_servico = 'IAX90N0HD8')
				group by 
					os.cod_tipo_servico 
				UNION
				SELECT 
					o.cod_tipo_servico, 0
				FROM 
					ope_servico_tipo as o
				WHERE 
					(o.cod_tipo_servico = 'IAX90MWJ7C' or 
					 o.cod_tipo_servico = 'IAX90MZKXK' or 
					 o.cod_tipo_servico = 'IAX90MQNKW' or 
					 o.cod_tipo_servico = 'IAX90MYMGX' or
					 o.cod_tipo_servico = 'IAX90MZ25W' or
					 o.cod_tipo_servico = 'IAX90MZE87' or
					 o.cod_tipo_servico = 'IAX90MRT96' or
					 o.cod_tipo_servico = 'IAX90MSL36' or
					 o.cod_tipo_servico = 'IAX90MWYHK' or
					 o.cod_tipo_servico = 'IAX90MXCPJ' or
					 o.cod_tipo_servico = 'IAX90N06PQ' or
					 o.cod_tipo_servico = 'IAX90N0HD8') ) virtual
			GROUP BY 
				cod_tipo_servico");
		if($consulta)
		{
			return $consulta;
		}
		else
		{
			return FALSE;
		}
	}
	public function instalacoes($data_f,$data_i,$unidade)
	{
		$consulta = $this->db->query("
				SELECT
					os.data_servico, os.numero_os ,os.obs, os.retrabalho,os.periodo,os.codcli
				FROM
					ope_servico_tipo as ost
				inner JOIN isp_city10.ope_servico as os on os.cod_tipo_servico = ost.cod_tipo_servico
				INNER JOIN ope_servico_tec AS ot on os.cod_servico = ot.cod_servico
				INNER JOIN sys_usuarios AS su ON su.cod_usuario = ot.cod_usuario
				INNER JOIN sys_unidade AS ss ON ss.cod_unidade = su.cod_unidade
				WHERE
					os.status_os = 'F'
					and os.data_servico is not null
					and os.data_servico  >='$data_i' and os.data_servico  <'$data_f'
					and ss.url = '$unidade'
					and
						(os.cod_tipo_servico = 'IAX90MWJ7C' or
						os.cod_tipo_servico = 'IAX90MZKXK' or
						os.cod_tipo_servico = 'IAX90MQNKW' or
						os.cod_tipo_servico = 'IAX90MYMGX' or
						os.cod_tipo_servico = 'IAX90MZ25W' or
						os.cod_tipo_servico = 'IAX90MZE87' or
						os.cod_tipo_servico = 'IAX90MRT96' or
						os.cod_tipo_servico = 'IAX90MSL36' or
						os.cod_tipo_servico = 'IAX90MWYHK' or
						os.cod_tipo_servico = 'IAX90MXCPJ' or
						os.cod_tipo_servico = 'IAX90N06PQ' or
						os.cod_tipo_servico = 'IAX90N0HD8')");
		if($consulta)
		{
			return $consulta;
		}
		else
		{
			return FALSE;
		}
	}
	// Vendas por período
	public function vendas_periodo($data_i, $data_f, $unidade)
	{
		$consulta = $this->db->query("
			SELECT
			        date(os.data_cad) AS data
			        ,c.codcli AS contrato
			        ,op.nome_ocop AS tipo
			        ,c.bairro AS bairro
			        ,cid.nome_cid AS cidade
			FROM ordem_servico os
			LEFT JOIN tipo_orden_s tos ON os.codtords = tos.codtords
			LEFT JOIN ocorrencias oc ON os.codoco = oc.codoco
			LEFT JOIN oco_padrao op ON oc.codocop = op.codocop
			LEFT JOIN clientes c ON oc.codcli = c.codcli
			LEFT JOIN cidades cid ON c.cidade = cid.cidade
			LEFT JOIN cidades_pop cp ON c.cidade = cp.cidade 
			WHERE cp.codpop = '$unidade'
			AND tos.codtords IN ('IAX90MYMGX', 'IAX90MZE87', 'IAX90MZ25W', 'NOVOPONTO', 'E4NS0W8NDD', 'E4EJ0VMFRB', 'IAX90MQNKW', 'IAX90MSL36', 'IAX90MRT96', 'E4EJ0VPDI5', 'IAX90MWJ7C', 'IAX90MXCPJ', 'IAX90MWYHK', 'IAX90MZKXK', 'IAX90N0HD8', 'IAX90N06PQ')
			AND os.data_cad BETWEEN '$data_i' AND '$data_f'
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
	public function metas_servico($data_1,$data_2,$data_3,$unidade)
	{
		
		$consulta = $this->db->query("SELECT valor from (
			SELECT 
				os.valor,CONCAT (os.data_ano ,'-',os.data_mes) as data
			FROM 
				ope_meta_servico as os
			INNER JOIN sys_unidade as s on s.cod_unidade = os.cod_unidade
			WHERE
				s.url = '$unidade' AND
				(CONCAT(os.data_ano,'-', os.data_mes)  <= '$data_1' AND
				 CONCAT(os.data_ano,'-', os.data_mes)  >= '$data_3' )
		   UNION 
           SELECT 
				0,'$data_3'
		   UNION 
           SELECT 
				0,'$data_2'
		   UNION 
           SELECT 
				0,'$data_1') virtual
		GROUP BY data");
		
		if($consulta)
		{
			return $consulta;
		}
		else
		{
			return FALSE;
		}
	}
	public function metas_servico_instalacao_mes($data_i, $data_f, $unidade)
	{
		$consulta = $this->db->query("SELECT  quantidade AS quantidade FROM (
				SELECT
				ost.descri_ords,os.cod_tipo_servico as cod_tipo_servico, count(*) as quantidade
				FROM
				ope_servico_tipo as ost
				inner JOIN ope_servico as os on os.cod_tipo_servico = ost.cod_tipo_servico
				INNER JOIN ope_servico_tec AS ot on os.cod_servico = ot.cod_servico
				INNER JOIN sys_usuarios AS su ON su.cod_usuario = ot.cod_usuario
				INNER JOIN sys_unidade AS ss ON ss.cod_unidade = su.cod_unidade
				WHERE
				os.status_os = 'F'
				and os.data_servico is not null
				and os.data_servico  >='$data_i' and os.data_servico  <'$data_f'
				and ss.url = '$unidade'
				and
				(os.cod_tipo_servico = 'IAX90MWJ7C' or
                os.cod_tipo_servico = 'E4EJ0VMFRB' or
				os.cod_tipo_servico = 'IAX90MZKXK' or
				os.cod_tipo_servico = 'IAX90MQNKW' or
				os.cod_tipo_servico = 'IAX90MYMGX' or
				os.cod_tipo_servico = 'IAX90MZ25W' or
				os.cod_tipo_servico = 'IAX90MZE87' or
				os.cod_tipo_servico = 'IAX90MRT96' or
				os.cod_tipo_servico = 'IAX90MSL36' or
				os.cod_tipo_servico = 'IAX90MWYHK' or
				os.cod_tipo_servico = 'IAX90MXCPJ' or
				os.cod_tipo_servico = 'IAX90N06PQ' or
				os.cod_tipo_servico = 'IAX90N0HD8')
				group by
				os.cod_tipo_servico
				UNION
				SELECT
				o.descri_ords, o.cod_tipo_servico, 0
				FROM
				ope_servico_tipo as o
				WHERE
				(o.cod_tipo_servico = 'IAX90MWJ7C' or
                o.cod_tipo_servico = 'E4EJ0VMFRB' or
				o.cod_tipo_servico = 'IAX90MZKXK' or
				o.cod_tipo_servico = 'IAX90MQNKW' or
				o.cod_tipo_servico = 'IAX90MYMGX' or
				o.cod_tipo_servico = 'IAX90MZ25W' or
				o.cod_tipo_servico = 'IAX90MZE87' or
				o.cod_tipo_servico = 'IAX90MRT96' or
				o.cod_tipo_servico = 'IAX90MSL36' or
				o.cod_tipo_servico = 'IAX90MWYHK' or
				o.cod_tipo_servico = 'IAX90MXCPJ' or
				o.cod_tipo_servico = 'IAX90N06PQ' or
				o.cod_tipo_servico = 'IAX90N0HD8') ) virtual
				GROUP BY
					LEFT (descri_ords, LOCATE(' ', descri_ords) - 1)
				ORDER BY 
					LEFT (descri_ords, LOCATE(' ', descri_ords) - 1) asc");
		if($consulta)
		{
			return $consulta;
		}
		else
		{
			return FALSE;
		}
	}
	public function comissao_estoque_manutencao($data_i, $data_f)
	{
		$consulta = $this->db->query("SELECT su.nome,ep.descricao,emc.data_inicio,emc.data_fim,em.cod_produtoitem, em.defeito, em.cod_manutencao,em.retorno,if(eg.cod_gruposervico = 2 or eg.cod_gruposervico = 6,'onu','outros') as equipamento,  emt.descri_tipo, if(eg.cod_gruposervico = 2 or eg.cod_gruposervico = 6,if(emt.cod_tipo_manutencao = 7,4,1),if(emt.cod_tipo_manutencao = 7,0.9,0.45)) as comissao
			FROM estoque_manutencao_comissao as emc
			inner join estoque_manutencao as em on em.cod_manutencao = emc.cod_manutencao
			inner join sys_usuarios as su on su.cod_usuario = emc.cod_usuario
			inner join estoque_manutencao_tipo as emt on emt.cod_tipo_manutencao = em.cod_tipo_manutencao 
			inner join estoque_produtoitem as ept on ept.cod_produtoitem = em.cod_produtoitem
			inner join estoque_produto as ep on ep.cod_produto = ept.cod_produto
			inner join estoque_gruposervico as eg on eg.cod_gruposervico = ept.cod_gruposervico
			where emc.data_fim >= '$data_i' and emc.data_fim < '$data_f'");
		
		if($consulta)
		{
			return $consulta;
		}
		else
		{
			return FALSE;
		}
	}
	public function comissao_estoque_manutencao_valor($data_i, $data_f)
	{
		$consulta = $this->db->query("SELECT if(eg.cod_gruposervico = 2 or eg.cod_gruposervico = 6,'onu','outros') as equipamento, count(*) as quantidade, emt.descri_tipo,su.nome, if(eg.cod_gruposervico = 2 or eg.cod_gruposervico = 6,if(emt.cod_tipo_manutencao = 7,count(*)*4,count(*)*1),if(emt.cod_tipo_manutencao = 7,count(*)*0.9,count(*)*0.45)) as valor
			FROM estoque_manutencao_comissao as emc
			inner join estoque_manutencao as em on em.cod_manutencao = emc.cod_manutencao
			inner join sys_usuarios as su on su.cod_usuario = emc.cod_usuario
			inner join estoque_manutencao_tipo as emt on emt.cod_tipo_manutencao = em.cod_tipo_manutencao 
			inner join estoque_produtoitem as ept on ept.cod_produtoitem = em.cod_produtoitem
			inner join estoque_produto as ep on ep.cod_produto = ept.cod_produto
			inner join estoque_gruposervico as eg on eg.cod_gruposervico = ept.cod_gruposervico
			where emc.data_fim >= '$data_i'  and emc.data_fim < '$data_f'
			group by equipamento,em.cod_tipo_manutencao,em.cod_usuario");
		
		if($consulta)
		{
			return $consulta;
		}
		else
		{
			return FALSE;
		}
	}
	public function comissao_estoque_manutencao_valor_tecnico($data_i, $data_f)
	{
		$consulta = $this->db->query("SELECT su.nome, sum(if(eg.cod_gruposervico = 2 or eg.cod_gruposervico = 6,if(emt.cod_tipo_manutencao = 7,4,1),if(emt.cod_tipo_manutencao = 7,0.9,0.45))) as valor
				FROM estoque_manutencao_comissao as emc
				inner join estoque_manutencao as em on em.cod_manutencao = emc.cod_manutencao
				inner join sys_usuarios as su on su.cod_usuario = emc.cod_usuario
				inner join estoque_manutencao_tipo as emt on emt.cod_tipo_manutencao = em.cod_tipo_manutencao
				inner join estoque_produtoitem as ept on ept.cod_produtoitem = em.cod_produtoitem
				inner join estoque_produto as ep on ep.cod_produto = ept.cod_produto
				inner join estoque_gruposervico as eg on eg.cod_gruposervico = ept.cod_gruposervico
				where emc.data_fim >= '$data_i'  and emc.data_fim < '$data_f'
				group by em.cod_usuario");
		
		if($consulta)
		{
			return $consulta;
		}
		else
		{
			return FALSE;
		}
	}
}
// Fim model
<?php

	function data_ptbr($data){

		$nova_data = date('d/m/Y', strtotime($data));

		return $nova_data;

	}





	//Remover caracteres especiais

	function semcaract($texto) {



    // matriz de entrada

    $t1 = array( 'ä','ã','à','á','â','ê','ë','è','é','ï','ì','í','ö','õ','ò','ó','ô','ü','ù','ú','û','À','Á','É','Í','Ó','Ú','ñ','Ñ','ç','Ç',' ','-','(',')',',',';',':','|','!','"','#','$','%','&','/','=','?','~','^','>','<','ª','º' );



    // matriz de saída

    $t2   = array( 'a','a','a','a','a','e','e','e','e','i','i','i','o','o','o','o','o','u','u','u','u','A','A','E','I','O','U','n','n','c','C','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-' );



    // devolver a texto

    return str_replace($t1, $t2, $texto);

}





	function verifica_permissao($pagina_atual, $permissoes, $nivel)

	{

		//$pag_atual = $this->uri->uri_string();

		

		//Trata a url para usar apenas

		//segment 1 e 2 caso

		//encontre uma ou mais barras

		if(substr_count($pagina_atual, '/')==2)

		{ 

			$uri = explode('/', $pagina_atual);

			$nova_pagina = $uri[0]."/".$uri[1];

		}

		else if(substr_count($pagina_atual, '/')>=3)

		{ 

			$uri = explode('/', $pagina_atual);

			$nova_pagina = $uri[0]."/".$uri[1]."/".$uri[2];

		}

		else

		{

			$nova_pagina = $pagina_atual;

		}



		//verifica se tema uri atual

		//nas permissoes do usuario

		if(substr_count($permissoes,$nova_pagina) OR $pagina_atual == 'painel' OR $nivel>=5)

		{

			return TRUE;

		}

		else

		{

			return FALSE;

		}

	} // End Verifica permissão

	


	// Pega o dia da semana de uma data
	function diadata($dia)
	{
		$diaa=substr($dia,0,2)."-";

		$mes=substr($dia,3,2)."-";

		$ano=substr($dia,6,4);

		$diasemana = date("w", mktime(0,0,0,$mes,$diaa,$ano));

		switch($diasemana) {

			case"0": $dia_semana = "domingo"; break;

			case"1": $dia_semana = "segunda"; break;

			case"2": $dia_semana = "terca"; break;

			case"3": $dia_semana = "quarta"; break;

			case"4": $dia_semana = "quinta"; break;

			case"5": $dia_semana = "sexta"; break;

			case"6": $dia_semana = "sabado"; break;

		} // End Case

		return $diasemana;

	}

	



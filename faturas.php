<?php
     define('_HOST_NAME','localhost');
     define('_DATABASE_NAME','anjosso_sistema');
     define('_DATABASE_USER_NAME','anjosso_sistema');
     define('_DATABASE_PASSWORD','+=4Q]iOZt+1t');


     function diadata($dia)
		{
			$diaa=substr($dia,0,2)."-";

			$mes=substr($dia,3,2)."-";

			$ano=substr($dia,6,4);
			// Dia da semana de 0 a 6
			$diasemana = date("w", mktime(0,0,0,$mes,$diaa,$ano) );

		return $diasemana;

		}



 
     $MySQLiconn = new MySQLi(_HOST_NAME,_DATABASE_USER_NAME,_DATABASE_PASSWORD,_DATABASE_NAME);
  
     if($MySQLiconn->connect_errno)
     {
       die("ERROR : -> ".$MySQLiconn->connect_error);
     }

     $data_br = date('d-m-Y');
     if(diadata($data_br) == 0)
     {
     	$novo_dia = date('d') + 1;
		$data_vencimento_verifica = date('Y-m-').$novo_dia;
     }

	//Recupera a lista de faturas recorrentes
  	$fat_rec = $MySQLiconn->query("
		SELECT 
		    *
		FROM
		    fatura_recorrente fr
		WHERE
		    fr.dia_vencimento = DAY(NOW())
		    AND fr.cod_fatura_recorrente NOT IN (
				SELECT 
					fgc.cod_fatura_recorrente
				FROM fatura_geradas_cron fgc WHERE
		        fgc.cod_fatura_recorrente = fr.cod_fatura_recorrente
		        AND fgc.data_vencimento = '$data_vencimento_verifica'
		    )
		    AND fr.cod_cadastro NOT IN (
				select
					fat.cod_cadastro
				from faturas fat
		        where 
		        fat.cod_cadastro = fat.cod_cadastro
		        AND Month(fat.data_vencimento) = Month(NOW())
		        # AND DAY(fat.data_vencimento) = DAY(NOW())
		        AND fat.cod_status = 1
		    )
    


		");
  	
  	
	while($row=$fat_rec->fetch_array())
	{
		// Variáveis para fatura
		 $cod_cadastro = $row['cod_cadastro'];
		 $cod_status = 1;
		 $data_emissao = date('Y-m-d');
		 $data_vencimento = date('Y-m-').$row['dia_vencimento'];
		 // Data formata BR
		$data_br = $row['dia_vencimento'].date('-m-Y');
		 $valor = $row['valor'];
		 echo diadata($data_br);

		// verifica se o dia da semana é um domingo
		if(diadata($data_br) == 0)
		{
			$novo_dia = $row['dia_vencimento'] + 1;
			$data_vencimento = date('Y-m-').$novo_dia;
		}

		//para fatura_geradas_cron
		echo $cod_fatura_recorrente = $row['cod_fatura_recorrente'];

		$nova_fatura = $MySQLiconn->query("
			INSERT INTO faturas(cod_cadastro,cod_status,data_emissao, data_vencimento, valor) VALUES ('$cod_cadastro','$cod_status','$data_emissao', '$data_vencimento','$valor')
			");


  
	  if($nova_fatura)
	  {
	  	$registrar_ok = $MySQLiconn->query("
			INSERT INTO fatura_geradas_cron(cod_fatura_recorrente,data_vencimento) VALUES ('$cod_fatura_recorrente','$data_vencimento')
			");
	  	if($registrar_ok)
	  	{
	  		echo 'OK';
	  	}
	  	else
	  	{
	  		echo $MySQLiconn->error;
	  		mail('atenimento@rjsolucoesweb.com.br', 'Erro cron Registrar OK', 'Erro ao registrar OK'.$cod_fatura_recorrente);

	  	}
	  	// end if

	  }
	  else
	  {
	   echo $MySQLiconn->error;
	   mail('atenimento@rjsolucoesweb.com.br', 'Erro cron Registrar OK', 'Erro gerar fatura '.$cod_fatura_recorrente);

	  }
	  // end if


	}
	 ?>
   
<?php
defined('BASEPATH') OR exit('Nenhum script de acesso permetido!!');
//padrão de validação do codeigniter para "solicitação de execução"

if (!function_exists('verificaCpf')) {//validação de existencia da função

	function verificaCpf($cpf) {//função de validação do cpf
		$cpf = "$cpf";
		//seta a informação do cpf em uma variavel
		if (strpos($cpf, "-") !== false) {//verifica se a variavel $cpf tem traço
			$cpf = str_replace("-", "", $cpf);
			//remove o traço da variavel $cpf
		}
		if (strpos($cpf, ".") !== false) {//verifica se a variavel $cpf tem ponto
			$cpf = str_replace(".", "", $cpf);
			//remove o ponto da variavel $cpf
		}
		$sum = 0;
		//seta o valor 0 em uma variavel
		$cpf = str_split($cpf);
		//splita a variavel $cpf separando cada caracter
		$cpftrueverifier = array();
		//seta a variavel $cpftrueverifier com um array
		$cpfnumbers = array_splice($cpf, 0, 9);
		//remove no primeiro digiito o numeral 9
		$cpfdefault = array(10, 9, 8, 7, 6, 5, 4, 3, 2);
		//armazena na variavel $cpfdefault um array contendo os valores 10, 9, 8, 7, 6, 5, 4, 3, 2
		for ($i = 0; $i <= 8; $i++) {//Multiplica-se os 9 primeiros dígitos pela sequência decrescente de números de 10 à 2 e soma os resultados
			$sum += $cpfnumbers[$i] * $cpfdefault[$i];
		}
		$sumresult = $sum % 11;
		//Multiplica-se o resultado por 10 e dividirmos por 11
		if ($sumresult < 2) {// Se o RESTO da divisão for igual ao primeiro dígito verificador (primeiro dígito depois do ‘-‘), a primeira parte da validação está correta
			$cpftrueverifier[0] = 0;
			//Se o resto da divisão for igual a 10, nós o consideramos como 0 se não 11 - $sumresult
		} else {
			$cpftrueverifier[0] = 11 - $sumresult;
		}
		$sum = 0;
		//seta o valor 0 em uma variavel
		$cpfdefault = array(11, 10, 9, 8, 7, 6, 5, 4, 3, 2);
		//consideramos os 9 primeiros dígitos, mais o primeiro dígito verificador, e vamos multiplicar esses 10 números pela sequencia decrescente de 11 a 2.
		$cpfnumbers[9] = $cpftrueverifier[0];
		for ($i = 0; $i <= 9; $i++) {
			$sum += $cpfnumbers[$i] * $cpfdefault[$i];
		}
		$sumresult = $sum % 11;
		//Seguindo o mesmo processo da primeira verificação, multiplicamos por 10 e dividimos por 11.
		if ($sumresult < 2) {//Verificando o RESTO, como feito anteriormente
			$cpftrueverifier[1] = 0;
		} else {
			$cpftrueverifier[1] = 11 - $sumresult;
		}
		$returner = false;
		//arranjo do retorno quanto as duas validações (seta a informação 0 na variavel $returner)
		if ($cpf == $cpftrueverifier) {//verifica se o cpf é valido para os testes anteriores
			$returner = true;
			//variavel $returner recebe true para a validação anterior
		}
		$cpfver = array_merge($cpfnumbers, $cpf);
		//fusão de um ou mais arrays em um array
		if (count(array_unique($cpfver)) == 1 || $cpfver == array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 0)) {//verificação de numeros repetidos Ex.: 111.111.111-11
			$returner = false;
			//retora falso para caso a afirmativa acima seja verdadeira
		}
		return $returner;
		//retorna se o cpf é valido ou não
	}

}

if (!function_exists('verificaEmail')) {//validação de existencia da função
	function verificaEmail($email) {//função de validação do email
		$email = "$email";
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {//filter_var (Filtra a variável com um especificado filtro). Foi passado como parametro. O filtro FILTER_VALIDATE_EMAIL valida um endereço de e-mail.
			return true;
			//retorna true caso seja valido o email
		} else {
			return false;
			//retorna false caso não seja valido o email
		}
	}

}

if (!function_exists('verificaCelular')) {//validação de existencia da função

	function verificaCelular($celular) {//função de validação do celular
		static $regex;
		if ($regex === null) {//verifica se a variavel não possui nada setado
			/* O trecho abaixo valida os ddd's existentes no brasil*/
			$ddds = implode('|', array(11, 12, 13, 14, 15, 16, 17, 18, 19, 21, 22, 24, 27, 28, 91, 92, 93, 94, 95, 81, 82, 83, 84, 85, 86, 87, 31, 32, 33, 34, 35, 37, 38, 71, 73, 74, 75, 77, 79, 61, 62, 63, 64, 65, 66, 67, 68, 69, 49, 51, 53, 54, 55));
			$regex = '#^(\((' . $ddds . ')\) 9|\((?!' . $ddds . ')\d{2}\) )[6789]\d{3}-\d{4}$#';
			//seta a formatação de um regex de telefoe celular em uma variavel
		}
		return preg_match($regex, $celular) > 0;
		//Busca um "bjeto" para uma correspondência com a expressão regular dada no padrão (da expressão do regex). Retorna true ou false para a comparação (>0)
	}

}

if (!function_exists('sorteio')) {//validação de existencia da função
	function sorteio($item) {//função de validação do email
		for($salt = '', $i = 0, $z = strlen ( $a = 'abcdefghijklmnopqrstuvwxyz0123456789' ) - 1; $i != $item; $x = mt_rand ( 0, $z ), $salt .= $a {$x}, $i ++);
		return $salt;
	}	
}
?>

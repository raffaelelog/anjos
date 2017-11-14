<?php
defined('BASEPATH') OR exit('Nenhum script de acesso permetido!!');
//padrão de validação do codeigniter para "solicitação de execução"

if (!function_exists('dadosEmail')) {//validação de existencia da função
	function dadosEmail() {
		$dados = array('Charset' => 'utf8_decode()', 'Host' => 'smtp.cityshop.com.br', 'Port' => '587', 'Username' => 'ti.desenvolvimento@cityshop.com.br', 'Password' => 'tiphp2016', 'email' => 'ti.desenvolvimento@cityshop.com.br', 'nome' => 'City10 Desenvolvimento', 'nome' => 'City10 Desenvolvimento', 'nome' => 'City10 Desenvolvimento');
		return $dados;
	}
}
?>

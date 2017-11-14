<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Cadastros extends CI_Controller {

	public function index()
	{
		$dados['alerta'] = NULL;


		$this->load->view('suporte/index', $dados);
	}

}


<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Suporte extends CI_Controller {
	public function index()
	{
		$dados['alerta'] = NULL;
		if($this->input->post('enviar') === 'Enviar')
		{
			$assunto = "Suporte Operate";
			$remetente = $this->session->userdata('email');
			$nome = $this->session->userdata('nome');
			$msg = $this->input->post('msg');
			$this->load->library('email');
			$this->email->to ( "ti.desenvolvimento@cityshop.com.br", 'Operate - City10 Desenvolvimento');
			$this->email->from ($remetente, utf8_decode($nome));
			$this->email->subject (utf8_decode($assunto));
			$this->email->message ($msg);
			if($this->email->send ())
			{
				$dados['alerta'] = array('class' => 'success','mensagem' => 'Sua mensagem foi enviada com sucesso.');
			}
			else
			{
				$dados['alerta'] = array('class' => 'danger','mensagem' => 'Não foi possível enviar a mensagem. Tente outro meio de suporte');
			}
		}
		$this->load->view('suporte/index', $dados);
	}
}

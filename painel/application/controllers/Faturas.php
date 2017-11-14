<?php

class Faturas extends CI_Controller {

	function __construct() {

		// Construct the parent class

		parent::__construct ();

		$this->load->model('Faturas_model');

	}

	public function index() {

		$dados['alerta'] = NULL;

		if($this->input->post('opcoes') === 'Ok')
		{
			$cod_fatura = $this->input->post('cod_fatura');
			$cod_status = $this->input->post('cod_status');

			$atualizar = $this->Faturas_model->atualizar_status($cod_fatura, $cod_status);

			if ($atualizar) {
				$dados ['alerta'] = array (
						'class' => 'success',
						'mensagem' => 'Alterações realizadas com sucesso!' 
				);
			} else {
				$dados ['alerta'] = array (
						'class' => 'danger',
						'mensagem' => 'Não foi possivel atualizar!' 
				);
			}
		}

		$dados['faturas_abertas'] = $this->Faturas_model->faturas_abertas();
		$this->load->view ( 'faturas/index', $dados );

	}


	public function print_fat() {

		$data = $this->input->post('data');


		$dados['faturas_print'] = $this->Faturas_model->faturas_print($data);
		$this->load->view ( 'faturas/print', $dados );

	}


}
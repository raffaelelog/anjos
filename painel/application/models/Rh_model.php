<?php
defined ( 'BASEPATH' ) or exit ('No direct script access allowed');
class Rh_model extends CI_Model {
	public function lista_cargos() {
		$verifica = $this->db->query ("SELECT * FROM sys_cargo;");
		if ($verifica) {
			return $verifica;
		} else {
			return FALSE;
		}
	}
	public function excluir_cargo($cod_cargo) {
		$this->db->where ( 'cod_cargo', $cod_cargo);
		$excluir = $this->db->delete ( 'sys_cargo' );
		if ($excluir) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	public function editar_cargo($cod_cargo,$valor){
		$dados = array (
				'desc_cargo' => $valor
		);
		$this->db->where ( 'cod_cargo', $cod_cargo);
		$atualizar = $this->db->update ( 'sys_cargo', $dados );
		if ($atualizar) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	public function enviar_cargo($cargo){
		$dados = array (
				'desc_cargo' => $cargo
		);
		$cadastrar = $this->db->insert ( 'sys_cargo', $dados );
		if ($cadastrar) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	
	
}/*END MODEL*/
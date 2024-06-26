<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perfil extends CI_Controller {

	function __construct()
	{
		parent::__construct();		
		date_default_timezone_set('America/Recife');

		if(!$this->session->userdata('id')){
			redirect('');
		}
		

   } // fecha fn USER

	
	function Index(){
		$dados['titulo'] = "";
		$dados['cb'] = "";
		$qr = $this->db->get('usuarios');
		#echo $qr->num_rows();
		$this->load->view('login' , $dados);
	}

	function dd($cb=''){
		$id_user = $this->session->userdata('id');

		$qr_premios =  $this->db->query("SELECT * FROM premiacoes WHERE  id_user = '".$this->session->userdata('id')."' AND tipo_win = 1");
		$qr_depositos = $this->db->query("SELECT * FROM depositos WHERE  id_user = '".$this->session->userdata('id')."' AND status = 1 AND valor > 0 ");

		$dados['cb'] = $cb;
		$dados['qr_premios'] = $qr_premios;
		$dados['qr_depositos'] = $qr_depositos;
		$dados['dd'] = $this->padrao_model->get_by_id($id_user,'usuarios')->row();

		$this->load->view('perfil' , $dados);
	}

	
	
} // x class

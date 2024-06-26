<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	
	function Index(){
		$dados['titulo'] = "";
		$dados['cb'] = "";
		$qr = $this->db->get('usuarios');
		#echo $qr->num_rows();
		$this->load->view('login' , $dados);
	}

	function err($cb=""){
		$dados['cb'] = $cb;
		#$qr = $this->db->get('usuarios');
		#echo $qr->num_rows();
		$this->load->view('login' , $dados);
	}

	
	
	function logar() {
		
		#print_r($_POST);
		#return false;

		$this->load->library('session');		

		$login = $this->input->post('email');		
		$senha = $this->input->post('senha');
		$this->db->where(array('email' => $login, 'senha' => $senha));
		$qr_login = $this->db->get('usuarios');
		
		#echo $qr_login->num_rows();
		#return false;

		if($qr_login->num_rows() > 0){
			$dd_user = $qr_login->row();
			#print_r($dd_user);
			#return false;
			$dd_session = array(
				'usr' => true,
				'id' => $dd_user->id,
				'nome' => $dd_user->nome,
				'nivel' => $dd_user->nivel,
				'email' => $login
			);
			$this->session->set_userdata($dd_session);
			#print_r($dd_session);
			#return false;
			if ($this->session->userdata('nivel') == 1) {								
				redirect('adm/usuarios/dash','refresh');
			}else{
				#redirect('home','refresh');
				#echo $this->session->userdata('nivel');
				//redirect('home/andamento','refresh');
				redirect('home/play/2','refresh');
			}

			if ($this->session->userdata('nivel') == 2) {		
				#redirect('adm/usuarios/dash','refresh');
			}



		}else{
			echo "E-mail ou senha inválido <a href='".base_url()."' >Voltar</a>";
			#redirect('admin','refresh');
		}
		
	} // x fn

	
} // x class

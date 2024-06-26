<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();		
		date_default_timezone_set('America/Recife');
		

   } // fecha fn USER

	
	public function index()
	{
		#$this->base();
		#$this->andamento();
		$this->play(1);
	}


	public function base()
	{
		$this->load->model('adm/usuarios_model');
		$dados['titulo'] = "";
		#echo "OK";
		$this->load->view('pagina1' , $dados);
	}

	function verifica_login(){
		if($this->session->userdata('id')){
			echo $this->session->userdata('id');
		}else{
			echo "0";
		}
	}


	function sair(){
		$this->session->sess_destroy();
		redirect('','refresh');
	}

	
	public function andamento($cb="1")
	{
		$this->load->model('adm/usuarios_model');
		$dados['titulo'] = "";
		$dados['cb'] = $cb;
		#echo "OK";
		if($cb == 1){
			$this->load->view('pagina1' , $dados);	
		}

		if($cb == 2){
			$this->load->view('pagina2' , $dados);	
		}
		
	}

	public function faq($cb="")
	{
		$this->load->model('adm/usuarios_model');
		$dados['titulo'] = "";
		$dados['cb'] = $cb;
		
		$this->load->view('faq' , $dados);	
		
	}

	public function jogo_responsavel($cb="")
	{
		$this->load->model('adm/usuarios_model');
		$dados['titulo'] = "";
		$dados['cb'] = $cb;
		
		$this->load->view('jogo-responsavel' , $dados);	
		
	}

	public function politica($cb="")
	{
		$this->load->model('adm/usuarios_model');
		$dados['titulo'] = "";
		$dados['cb'] = $cb;
		
		$this->load->view('politicas-de-uso' , $dados);	
		
	}

	public function regulamento($cb="")
	{
		$this->load->model('adm/usuarios_model');
		$dados['titulo'] = "";
		$dados['cb'] = $cb;
		
		$this->load->view('regulamento' , $dados);	
		
	}

	public function play($cb="2")
	{
		$this->load->model('adm/usuarios_model');
		$dados['titulo'] = "";
		$dados['cb'] = $cb;
		#echo "OK";

		if($cb == 1){
			$this->load->view('pagina1' , $dados);	
			#redirect('');
		}

		if($cb == 2){
			if(!$this->session->userdata('id')){
				redirect('');
			}
			$this->load->view('pagina2' , $dados);	
		}
	}

	function check_play(){
		$this->load->model('adm/usuarios_model');
		if(!$this->session->userdata('id')){
			echo "Nao Autozirado";
		}else{
			$resp = 2;
			$id_user = $this->session->userdata('id');			
			$saldo = (int) $this->usuarios_model->saldo(0,0);
			
			#echo $saldo;
			#return false;

			if($saldo < 1){
				#echo "Sem fundos";
				#echo 0;
				$resp = 0;
				#return false;
			}
			#echo "OK1";
			// verifica raspadinha pendente
			$qr_verifica_pend = $this->db->query("SELECT * FROM premiacoes WHERE id_user = '".$id_user."' AND status = 0");
			if($qr_verifica_pend->num_rows() > 0){
				#echo "Raspadinha pendente";
				//echo "1";
				
				$resp = 1;
				$hash_new = $qr_verifica_pend->row()->hash_rasp;
				$dd_rasp_new = $qr_verifica_pend->row();
				#$result['resp'] = $resp;
				#$result['hash'] = $hash_new;
				#echo json_encode($result);
				#echo $qr_verifica_pend->num_rows();
				#return false;
			}else{

				// get prox rasp
				$qr_rasp = $this->db->query("SELECT * FROM premiacoes WHERE status = 0 AND hash_rasp IS NULL AND id_user = 0 ORDER BY id asc LIMIT 1");
				if($qr_rasp->num_rows() > 0){
					$dd_rasp_new = $qr_rasp->row();

					// criar rash
					$rand = rand(11111,99999);
					$hash_data = date("Y-m-d h:i:s");
					$hash_new = md5($rand.'-'.$hash_data);

					// DEBITA
					if($saldo >= 1){
						$dd_debita = [
							'id_user_mov' => $this->session->userdata('id'),
							'id_user' => 1,
							'valor' => 1,
							'data_hora_pagamento' => date("Y-m-d h:i:s"),
							'tipo' => "compra",
							'descricao' => "Compra ".date("Y-m-d h:i:s"),
							'status' => 1,
							'hash' => $hash_new
						];
						#if($resp != 0 && $resp != 1){
						if($resp == 2){
							$this->db->insert('movimento' , $dd_debita);	
						}
						
						
					} // x if saldo

					$dd_rasp_up = [
						'hash_rasp' => $hash_new,
						'id_user' => $id_user
					];
					if($resp == 2){
						$this->db->where('id',$dd_rasp_new->id);
						$this->db->update('premiacoes' , $dd_rasp_up);
					}
					
					#print_r($dd_rasp_new);

					
					#echo $hash_new;
				} // x if qr_rasp->num_rows()

				#$resp = 2;
			} // x else num_rows pend


			$numeros_expl = explode('-',$dd_rasp_new->numeros);
			$result = [];
			$result['resp'] = $resp;
			$result['hash'] = $hash_new;
			$result['numeros'] = $dd_rasp_new->numeros;
			$result['n1'] = $numeros_expl[0];
			$result['n2'] = $numeros_expl[1];
			$result['n3'] = $numeros_expl[2];
			$result['n4'] = $numeros_expl[3];
			$result['n5'] = $numeros_expl[4];
			$result['n6'] = $numeros_expl[5];
			echo json_encode($result);

			#echo "id_user".$id_user;
			#echo "<br>";

		} // x else
	} // x fn

	function get_saldo(){
		
		$this->load->model('adm/usuarios_model');
		if(!$this->session->userdata('id')){
			echo "Nao Autozirado";
			#echo "0,00";
		}else{

			$id_user = $this->session->userdata('id');			
			$saldo =  $this->usuarios_model->saldo(0,0);		
			echo  number_format($saldo, 2, ',', '.');
			#echo (float) $saldo;
		}
		
	}

	function fim_rasp($hash){
		if(!$this->session->userdata('id')){
			redirect("");
		}

		$this->db->where('hash_rasp' , $hash);
		$qr = $this->db->get('premiacoes');

		#echo $hash;


		if($qr->num_rows() == 0){
			echo "Chave inválida. Comando suspeito.";
		}else{

			$dd_rasp = $qr->row();
			if($dd_rasp->status == 1){
				echo "Raspadinha já validada.";
				return false;
			}

			if($dd_rasp->tipo_win == 1){
				// credita para usuario

					$dd_credita = [
						'id_user' => $this->session->userdata('id'),
						'id_user_mov' => 1,
						'valor' => $dd_rasp->valor,
						'data_hora_pagamento' => date("Y-m-d h:i:s"),
						'tipo' => "ganho",
						'descricao' => "Compra ".date("Y-m-d h:i:s"),
						'status' => 1,
						'hash' => $dd_rasp->hash_rasp
					];
					$this->db->insert('movimento' , $dd_credita);

			}else{

			}

			$dd_up = [
				'status' => 1
			];
			$this->db->where('hash_rasp' , $hash);
			$this->db->update('premiacoes' , $dd_up);

			$this->db->select('tipo_win as rst','hash_rasp');
			$this->db->where('hash_rasp' , $hash);
			$dd_hasp_new = $this->db->get('premiacoes')->row();

			#echo json_decode($dd_rasp , false);
			echo json_encode($dd_hasp_new);





		}
	} // x fn

	function set_saque(){
    	$this->load->model('adm/usuarios_model');

		if(!$this->session->userdata('id')){
			redirect("");
		}else{
			///////// logado
			$valor = str_replace("R$ ","",$_POST['valor']);
			$valor = str_replace(".","",$valor);
			$valor = str_replace(",",".",$valor);
			
			#$valor = $this->input->post('valor');
			$wallet = $this->input->post('wallet');
			$wallet_tipo = $this->input->post('wallet_tipo');
			$id_user = $this->session->userdata('id');
			

                $saldo = $this->usuarios_model->saldo($this->session->userdata('id'),0,1);

                ## SET SQUE EM movimento
                if($valor > $saldo){
                	#redirect('user/financeiro/saldo','refresh');
                	#echo "sem saldo";
                	echo "Sem saldo. <a href='".base_url()."home/play/2' >Voltar</a>";
                	return false;
                }
                if($valor < 1){
                	#redirect('user/financeiro/min','refresh');
                	echo "Valor inválido. <a href='".base_url()."home/play/2' >Voltar</a>";
                }
                #return false;
                if($valor <= $saldo){
                	$dd_mov = array(
                		'id_user_mov' => $id_user,
                		'id_user' => 1,
                		'data_hora_pagamento' => date("Y-m-d H:i:s"),
                		'valor' => $valor,
                		'tipo' => 'saque',
                		'descricao' => "Saque de $valor às ".date("Y-m-d H:i:s")." Wallet: $wallet ",
                		'status' => 1,
                		'wallet' => $wallet_tipo,
                		'hash' => $wallet,
                		'realizado' => 0
                	);
                	$this->db->insert('movimento' , $dd_mov);
                	#redirect('user/financeiro/seted','refresh');
                	redirect('home/play/2','refresh');

                }else{
                	#redirect('user/financeiro/saldo','refresh');
                	echo "Saldo insuficiente. <a href='".base_url()."home/play/2' >Voltar</a>";
                	#redirect('home/play/2','refresh');
                }

                ## X set saque


		} // x else

    } // x fn
	
} // x class

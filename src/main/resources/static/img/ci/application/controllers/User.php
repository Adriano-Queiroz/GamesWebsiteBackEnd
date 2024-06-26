<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {


	function __construct()
	{
		parent::__construct();
		
		$this->load->model('fb_model');

		// define("ID_USER",42);
		// define("id_user",42);

		// $qr_api_mp =  $this->padrao_model->get_by_matriz('id_user',ID_USER,'usuarios_parametros');
		// $api_mp = $qr_api_mp->row()->api_mp;
		// define("API_MP",$api_mp);

		// // whqatsapp
		// $dbbot = $this->load->database('dbbot', TRUE);
        // $this->dbbot = $dbbot;
        date_default_timezone_set('America/Recife');
        include('includes/env.php');


   } 

	function index() {
		
		$dados['cb'] = "";

		#$this->load->view('bo/base' , $dados);	
		#$dados['eventos'] = $this->padrao_model->get_qr('bot_eventos');
		$this->load->view('bet/base' , $dados);	
		#echo "OK";
	}
	
	function dados(){
		$this->load->model('adm/usuarios_model');
		if(!$this->session->userdata('id')){
			redirect('','refresh');
		}
		$id_user = $this->session->userdata('id');

		$this->db->where('id',$id_user);
		$dados['dd_user'] = $this->db->get('usuarios')->row();

		#$apostas = $this->db->query("SELECT * FROM movimento WHERE id_user_mov = '".$id_user."' AND tipo = 'aposta' AND status = 1 ORDER BY id desc");
		$apostas = $this->db->query("SELECT * FROM apostas WHERE id_user = '".$id_user."' AND status = 2 ORDER BY id desc");
		$dados['apostas'] = $apostas;

		$apostas_abertas = $this->db->query("SELECT * FROM apostas WHERE id_user = '".$id_user."' AND status = 1 ORDER BY id desc");
		$dados['apostas_abertas'] = $apostas_abertas;

		
		$dados['cb'] = "";

		$loterias = $this->db->query("SELECT * FROM loterias ORDER BY id asc");
		$dados['loterias'] = $loterias;

		$loterias_alt = $this->db->query("SELECT * FROM loterias WHERE federal = 0 ORDER BY id asc");
		$dados['loterias_alt'] = $loterias_alt;

		$this->load->view('front/user/dados' , $dados);
	}

	function jogos(){
		$this->load->model('adm/usuarios_model');
		if(!$this->session->userdata('id')){
			redirect('','refresh');
		}
		$id_user = $this->session->userdata('id');

		$this->db->where('id',$id_user);
		$dados['dd_user'] = $this->db->get('usuarios')->row();

		#$apostas = $this->db->query("SELECT * FROM movimento WHERE id_user_mov = '".$id_user."' AND tipo = 'aposta' AND status = 1 ORDER BY id desc");
		$apostas = $this->db->query("SELECT * FROM apostas WHERE id_user = '".$id_user."' AND status = 2 ORDER BY id desc");
		$dados['apostas'] = $apostas;

		$apostas_abertas = $this->db->query("SELECT * FROM apostas WHERE id_user = '".$id_user."' AND status = 1 ORDER BY id desc");
		$dados['apostas_abertas'] = $apostas_abertas;

		$loterias = $this->db->query("SELECT * FROM loterias WHERE federal = 1 ORDER BY id asc");
		$dados['loterias'] = $loterias;

		// $loterias_alt
		$loterias_alt = $this->db->query("SELECT * FROM loterias WHERE federal = 0 ORDER BY id asc");
		$dados['loterias_alt'] = $loterias_alt;

		#$loterias_alt = $this->db->query("SELECT * FROM loterias WHERE federal = 0 ORDER BY id asc");
		$loterias_hoje = $this->db->query("select * from proximos_sorteios WHERE dt_proximo BETWEEN '".date("Y-m-d")." 00:00:01' AND  '".date("Y-m-d")." 23:59:59'");
		$dados['loterias_hj'] = $loterias_hoje;


		$last_sorteiors = $this->db->query("SELECT * FROM resultados_loterias ORDER BY id desc LIMIT 6");
		$dados['last_sorteiors'] = $last_sorteiors;



		
		$dados['cb'] = "";

		$this->load->view('front/user/jogos' , $dados);
	}

	function rede(){
		$this->load->model('adm/usuarios_model');
		if(!$this->session->userdata('id')){
			redirect('','refresh');
		}
		$id_user = $this->session->userdata('id');

		$this->db->where('id',$id_user);
		$dados['dd_user'] = $this->db->get('usuarios')->row();

		#$apostas = $this->db->query("SELECT * FROM movimento WHERE id_user_mov = '".$id_user."' AND tipo = 'aposta' AND status = 1 ORDER BY id desc");
		$apostas = $this->db->query("SELECT * FROM apostas WHERE id_user = '".$id_user."' AND status = 2 ORDER BY id desc");
		$dados['apostas'] = $apostas;

		$apostas_abertas = $this->db->query("SELECT * FROM apostas WHERE id_user = '".$id_user."' AND status = 1 ORDER BY id desc");
		$dados['apostas_abertas'] = $apostas_abertas;

		$loterias_alt = $this->db->query("SELECT * FROM loterias WHERE federal = 0 ORDER BY id asc");
		$dados['loterias'] = $loterias_alt;
		
		$loterias_alt = $this->db->query("SELECT * FROM loterias WHERE federal = 0 ORDER BY id asc");
		$dados['loterias_alt'] = $loterias_alt;

		$loterias_alt = $this->db->query("SELECT * FROM loterias WHERE federal = 0 ORDER BY id asc");
		$dados['loterias_hj'] = $loterias_alt;

		$clientes = $this->padrao_model->get_by_matriz('id_user',$this->session->userdata('id'),'usuarios');
		$dados['clientes'] = $clientes;

		
		$dados['cb'] = "";

		$this->load->view('front/user/rede' , $dados);
	}

	function qrcode(){
		$this->load->model('adm/usuarios_model');
		if(!$this->session->userdata('id')){
			redirect('','refresh');
		}
		$id_user = $this->session->userdata('id');

		$this->db->where('id',$id_user);
		$dados['dd_user'] = $this->db->get('usuarios')->row();

		#$apostas = $this->db->query("SELECT * FROM movimento WHERE id_user_mov = '".$id_user."' AND tipo = 'aposta' AND status = 1 ORDER BY id desc");
		$apostas = $this->db->query("SELECT * FROM apostas WHERE id_user = '".$id_user."' AND status = 2 ORDER BY id desc");
		$dados['apostas'] = $apostas;

		$apostas_abertas = $this->db->query("SELECT * FROM apostas WHERE id_user = '".$id_user."' AND status = 1 ORDER BY id desc");
		$dados['apostas_abertas'] = $apostas_abertas;

		$loterias = $this->db->query("SELECT * FROM loterias ORDER BY id asc");
		$dados['loterias'] = $loterias;

		
		$dados['cb'] = "";

		$this->load->view('front/user/qrcode' , $dados);
	}
	// MERCADO PAGO	
	function process_payment($tipo="deposito"){
		// TEST-7bc1e82a-cb62-4dea-b394-de2a656f5fba - Public Key
		// TEST-685172168846807-012610-c99a2afde36d8c0ac567b2613371ec49-182756904 - ACess Token
		#require_once "includes/lib/mercadopago.php";
			$this->load->model('padrao_model');


		  #$access_token = "TEST-685172168846807-012610-c99a2afde36d8c0ac567b2613371ec49-182756904"; // igor
		  #$access_token = "APP_USR-2066780416209141-051020-30af29e5d7dcba40da76ce847890802b-555931958";
		  #$access_token = "APP_USR-2066780416209141-051020-30af29e5d7dcba40da76ce847890802b-555931958"; // teste conta de augusto
		  $access_token = API_MP;

			  if(isset($_POST)){

			    if(isset($_POST['pix'])){

			      if($_POST['pix']){
			      	$id_user = $this->session->userdata('id');
					$dd_user = $this->padrao_model->get_by_id($id_user,'usuarios')->row();
					#print_r($dd_user);

			        #$valor = 10;
			        
			        $valor = str_replace("R$ ","",$_POST['valor_dep']);
					$valor = str_replace(".","",$valor);
					$valor = str_replace(",",".",$valor);

					

					$hash = md5($id_user."--3--32-".date("Y-m-d h:i:s"));


					$dd_dep = array(
						'id_user' => $id_user,
						'valor' => $valor
					);

					if(isset($_POST['id_aposta'])){
						$dd_dep['id_aposta'] = $this->input->post('id_aposta');
					}


					$this->db->where($dd_dep);
					$qr_dep = $this->db->get('depositos');
					if($qr_dep->num_rows() == 0){
						$dd_dep['hash_transacao'] = $hash;
						$this->db->insert('depositos', $dd_dep);
						$id_ext = $this->db->insert_id();
					}else{
						$id_ext = $qr_dep->row()->id;
					}
					
					#echo $id_ext;
					#echo "<br>";
					#print_r($dd_user);
					#return false;
					
					

			        #include_once 'mercadopago/lib/mercadopago/vendor/autoload.php';
			        include_once 'includes/mercadopago/lib/mercadopago/vendor/autoload.php';

			        //MercadoPago\SDK::setAccessToken($access_token);

			        MercadoPago\SDK::setAccessToken($access_token);
			     
		         	 $payment = new MercadoPago\Payment();
					 $payment->transaction_amount = $valor;
					 $payment->description = "Saldo L.A";
					 $payment->payment_method_id = "pix";
					 #$payment->external_reference = $this->session->userdata('id').date("Y").date("m").date("d");
					 $payment->external_reference = $id_ext;
					 //$payment->payment_method_id = "bolbradesco";
					 $payment->payer = array(
					    "email" => $dd_user->email,
					    "first_name" => $dd_user->nome,
					 	#"email" => "igor@yahoo.com.br",
					    # "first_name" => "Igor",
					     "last_name" => "Loteria",
					     "identification" => array(
					         "type" => "CPF",
					         "number" => "06030689444"
					      ),
					     "address"=>  array(
					         "zip_code" => "52021180",
					         "street_name" => "Av. João de Barros",
					         "street_number" => "1888",
					         "neighborhood" => "Encruzilhada",
					         "city" => "Recife",
					         "federal_unit" => "PE"
					      )
					   );

					 $payment->save();	
					 
					 echo json_encode($payment->point_of_interaction);

			      }else{
			        echo json_encode(array(
			          'status'  => 'error',
			          'message' => 'pix required'
			        ));
			        exit;
			      }

			    }else{
			      echo json_encode(array(
			        'status'  => 'error',
			        'message' => 'pix required'
			      ));
			      exit;
			    }

			  }else{
			    echo json_encode(array(
			      'status'  => 'error',
			      'message' => 'post required'
			    ));
			    exit;
			  }




		/*
		MercadoPago\SDK::setAccessToken("ENV_ACCESS_TOKEN");

		 $payment = new MercadoPago\Payment();
		 $payment->transaction_amount = 100;
		 $payment->description = "Título do produto";
		 $payment->payment_method_id = "pix";
		 $payment->payer = array(
		     "email" => $this->input->post("email"),
		     "first_name" => $this->input->post("payerFirstName"),
		     "last_name" => $this->input->post("payerLastName"),
		     "identification" => array(
		         "type" => "CPF",
		         "number" => $this->input->post("identificationNumber")
		      ),
		     "address"=>  array(
		         "zip_code" => "06233200",
		         "street_name" => "Av. das Nações Unidas",
		         "street_number" => "3003",
		         "neighborhood" => "Bonfim",
		         "city" => "Osasco",
		         "federal_unit" => "SP"
		      )
		   );

		 $payment->save();
		 */



		#print_r($_POST);
	}

	function verifica_pagamento($id_trans){

		include_once 'includes/mercadopago/lib/mercadopago/vendor/autoload.php';
        MercadoPago\SDK::setAccessToken($access_token);
     	$payment = new MercadoPago\Payment();
     	$payment = MercadoPago\Payment::find_by_id($payment_id);
		$payment->capture = true;
		$payment->update();

	}

	function busca_pagamento(){

		#$access_token = "APP_USR-2066780416209141-051020-30af29e5d7dcba40da76ce847890802b-555931958";
		$access_token = API_MP;

        include_once 'includes/mercadopago/lib/mercadopago/vendor/autoload.php';
		
        MercadoPago\SDK::setAccessToken($access_token);
     	#$payment = new MercadoPago\Payment();

     	$filters = array(
            "sort" => "date_last_updated",
            "criteria" => "desc",
            "limit" => "10"
        );

     	$payment = MercadoPago\Payment::search($filters);
     	$payment->sort = "date_last_updated";     	
     	$payment->criteria = "desc";     	
		//$payment->capture = true;
		//$payment->save();
		//$payment->update();
		
		

		foreach ($payment as $key => $value) {
		    #echo $value->nome;
		    #echo $key;
		    #echo "<br><br>";
		    #echo $value->idade;
		}
		$total = count($payment);
		#echo "<br>";
		#print_r($payment[0]);
		#echo $payment["0"];
		// https://www.mercadopago.com.br/developers/pt/reference/payments/_payments_search/get // DOCUMENTACAO
		for($p=0; $p<$total; $p++){

			echo "Data criação: <strong>".$payment[$p]->date_created."</strong>";
			echo "<br>";
			echo "Data aprovação: <strong>".$payment[$p]->date_approved."</strong>";
			echo "<br>";
			echo "Tipo de pagamento: <strong> ".$payment[$p]->payment_method_id." (".$payment[$p]->operation_type.")</strong>";
			echo "<br>";
			echo "Status: <strong>".$payment[$p]->status." - ".$payment[$p]->status_detail." </strong>";
			echo "<br>";
			echo "Description: <strong>".$payment[$p]->description."</strong>";
			echo "<br>";
			echo "External_reference: <strong>".$payment[$p]->external_reference."</strong>";
			echo "<br>";
			echo "Valor: <strong>".$payment[$p]->transaction_amount."</strong>";
			echo "<br>";
			// 
			echo "<span style='color:silver'>";
			#print_r($payment[$p]);
			echo "</span>";
			echo "<br><br><hr>";

		}

		

	}

	function busca_status_pag($id_ref){

		// API_MP

		#$access_token = "APP_USR-685172168846807-012610-649caed966c451e2c65d542a6ade4edd-182756904";
		$access_token = API_MP;
		
        include_once 'includes/mercadopago/lib/mercadopago/vendor/autoload.php';		
        MercadoPago\SDK::setAccessToken($access_token);
     	$filters = array(
            "external_reference" => $id_ref
        );
     	$payment = MercadoPago\Payment::search($filters);
		$total = count($payment);		
		#print_r($payment);
		#echo "<br>";
		#echo "<br>";
		// https://www.mercadopago.com.br/developers/pt/reference/payments/_payments_search/get // DOCUMENTACAO
		#for($p=0; $p<$total; $p++){
			#return  $payment[$total-1]->status;
			if(isset($payment[$total-1])){
				return  $payment[$total-1]->status;
			}else{
				return "n existe";
			}
			
			/*
			pending
			approved
			authorized
			in_process
			in_mediation
			rejected
			cancelled
			refunded
			charged_back
			*/
		#}

	}

	function get_deps_pend(){
		$qr_dep = $this->db->query("SELECT * FROM depositos WHERE status = 0");
		foreach ($qr_dep->result() as $dd) {
			# code...
			echo "<strong>".$dd->id."</strong> - (".$dd->status.") - ";
			$status_mp = $this->busca_status_pag($dd->id);
			echo $status_mp." ";
			if($status_mp == "pending"){
				echo "[Pendente]";
			}

			if($status_mp == "approved"){
				echo "[Pago]";

				$valor_depositado = $dd->valor;

				$dd_mov = array(
	        		'id_user_mov' => 1,
	        		'id_user' => $dd->id_user,
	        		'data_hora_pagamento' => date("Y-m-d H:i:s"),
	        		'valor' => $valor_depositado,
	        		'tipo' => 'deposito',
	        		'descricao' => "Deposito via PIX de $valor_depositado às ".$dd->dt_reg."  ",
	        		'status' => 1,
	        		'wallet' => "pix",
	        		'hash' => $dd->hash_transacao,
	        		'realizado' => 0
	        	);

					
				## LIBERA INSERÇÃO DE SALDO
					
	        	$this->db->insert('movimento' , $dd_mov); // add saldo

				$status_ok = array('status' => 1);
				$this->db->where('id',$dd->id);
				$this->db->update('depositos', $status_ok); // remove de pendentes

				if($dd->id_aposta > 0){
					$dd_status_aposta = array('status' => 1);
					$this->db->where('id',$dd->id_aposta);
					$this->db->update('apostas' , $dd_status_aposta);
				}
			
			



			}
			#echo $status_mp;

			echo "<br>";

			if($status_mp == 'cancelled'){
				$this->db->where('id',$dd->id);
				$this->db->delete('depositos');
				echo "<br>removido....";
			}

		} // x foreach
	}

	function set_compras_adm($id_deposito, $id_user=0){
		#$this->load->model('usuarios_model');
		$last_compra = $this->usuarios_model->set_compra($id_deposito, $id_user);
		echo $last_compra;

	}

	function verifica_last_pay($id_sorteio){
		if(!$this->session->userdata('id')){
			#redirect('');
			echo "deslogado.";
		}

		$db2 = $this->load->database('db2', TRUE);
        $this->db2 = $db2;

		$id_user = $this->session->userdata('id');
		#$qr_last = $this->db->query("SELECT * FROM depositos WHERE id_user = ".$id_user." AND id_sorteio = ".$id_sorteio." AND (status = 0 || status = 1) AND pago = 0 ORDER BY id desc LIMIT 1");
		$qr_last = $this->db->query("SELECT * FROM depositos WHERE id_user = ".$id_user." AND id_sorteio = ".$id_sorteio." ORDER BY id desc LIMIT 1");
		if($qr_last->num_rows() > 0){

			foreach($qr_last->result() as $last){
				$status_mp = $this->busca_status_pag($last->id);

				########## ATIVA COTAS

				if($status_mp == "approved"){

					$valor_depositado = round($last->valor,2);

					#$this->usuarios_model->set_compra($last->id);
					$this->fb_model->set_msg_whats($last->id_user_compra,2);

					

				} // x if aproved


				########## X ATIVA COTAS


				echo $status_mp;
				#echo "approved";
				#echo "approved";
			} // x foreach


		}else{
			#redirect('');
			echo "sem last ".$id_user;
		}

	}

	function verifica_last_reserva($id_sorteio){
		if(!$this->session->userdata('id')){
			#redirect('');
			echo "deslogado.";
		}

		$db2 = $this->load->database('db2', TRUE);
        $this->db2 = $db2;
		#echo "OK";

		$id_user = $this->session->userdata('id');
		#$qr_last = $this->db->query("SELECT * FROM depositos WHERE id_user = ".$id_user." AND id_sorteio = ".$id_sorteio." AND (status = 0 || status = 1) AND pago = 0 ORDER BY id desc LIMIT 1");
		$qr_last = $this->db->query("SELECT * FROM depositos WHERE id_user = ".$id_user." AND id_sorteio = ".$id_sorteio." ORDER BY id desc LIMIT 1");
		if($qr_last->num_rows() > 0){

			foreach($qr_last->result() as $last){
				


				$dados['dep'] = $last;
				$dados['user'] = $this->padrao_model->get_by_id($last->id_user,'usuarios')->row();
				$this->load->view('front/last_reserva' , $dados);
			} // x foreach


		}else{
			#redirect('');
			echo "sem last ".$id_user;
		}

	}

	function verifica_pagamento_mp($id_aposta){
		$this->db->where('id_aposta',$id_aposta);
		$qr_dep = $this->db->get('depositos');
		if($qr_dep->num_rows() == 0){
			echo "n existe";
		}else{
			$dd = $qr_dep->row();
			$id_pagamento = $dd->id;
			$status_mp = $this->busca_status_pag($id_pagamento);
			#echo $status_mp." ";
			if($status_mp == "pending" || $status_mp == 'cancelled'){
				echo 0;
			}

			if($status_mp == "approved"){
				$valor_depositado = $dd->valor;

				$this->usuarios_model->set_compra($last->id);

				$dd_mov = array(
	        		'id_user_mov' => 1,
	        		'id_user' => $dd->id_user,
	        		'data_hora_pagamento' => date("Y-m-d H:i:s"),
	        		'valor' => $valor_depositado,
	        		'tipo' => 'deposito',
	        		'descricao' => "Aposta avulso via PIX de $valor_depositado às ".$dd->dt_reg."  ",
	        		'status' => 1,
	        		'wallet' => "pix",
	        		'hash' => $dd->hash_transacao,
	        		'realizado' => 0
	        	);

					
				## LIBERA INSERÇÃO DE SALDO
					
	        	$this->db->insert('movimento' , $dd_mov); // add saldo

				$status_ok = array('status' => 1);
				$this->db->where('id',$dd->id);
				$this->db->update('depositos', $status_ok); // remove de pendentes

				#if($dd->id_aposta > 0){
				$dd_status_aposta = array('status' => 1);
				$this->db->where('id',$dd->id_aposta);
				$this->db->update('apostas' , $dd_status_aposta);
				#}

				echo 1;

			} // x if aprovado
		}
		
			
	}


	// MERCADO PAGO	
	function process_payment_gpt($id_user){
		header('Access-Control-Allow-Origin: *');
		$db2 = $this->load->database('db2', TRUE);
        $this->db2 = $db2;
		// TEST-7bc1e82a-cb62-4dea-b394-de2a656f5fba - Public Key
		// TEST-685172168846807-012610-c99a2afde36d8c0ac567b2613371ec49-182756904 - ACess Token
		#require_once "includes/lib/mercadopago.php";
			$this->load->model('padrao_model');


		  
		  #$access_token = "APP_USR-685172168846807-012610-649caed966c451e2c65d542a6ade4edd-182756904"; // Igor
		  $access_token = API_MP;

			  if(isset($_POST)){

			    if(isset($_POST['pix'])){

			      if($_POST['pix']){
			      	#$id_user = $this->session->userdata('id');
			      	$this->db2->where('id',$id_user);
			      	$qr_user = $this->db2->get('ai_user');
			      	$dd_user = $qr_user->row();
					#$dd_user = $this->padrao_model->get_by_id($id_user,'usuarios')->row();
					#print_r($dd_user);

			        #$valor = 10;
			        
			        $valor = str_replace("R$ ","",$_POST['valor_dep']);
					#$valor = str_replace(".","",$valor);
					#$valor = str_replace(",",".",$valor);
			        $valor = 7.59;
					

					$hash = md5($id_user."--3--32-".date("Y-m-d h:i:s"));


					$dd_dep = array(
						'id_user' => $id_user,
						'valor' => $valor
					);
					$this->db2->where($dd_dep);
					$qr_dep = $this->db2->get('depositos');
					if($qr_dep->num_rows() >= 0){
						$dd_dep['hash_transacao'] = $hash;
						$this->db2->insert('depositos', $dd_dep);
						$id_ext = $this->db->insert_id();
					}else{
						$id_ext = $qr_dep->row()->id;
					}
					
					#echo $id_ext;
					#echo "<br>";
					#print_r($dd_user);
					#return false;
					
					

			        #include_once 'mercadopago/lib/mercadopago/vendor/autoload.php';
			        include_once 'includes/mercadopago/lib/mercadopago/vendor/autoload.php';

			        //MercadoPago\SDK::setAccessToken($access_token);

			        MercadoPago\SDK::setAccessToken($access_token);
			     
		         	 $payment = new MercadoPago\Payment();
					 $payment->transaction_amount = $valor;
					 $payment->description = "Saldo L.A";
					 $payment->payment_method_id = "pix";
					 #$payment->external_reference = $this->session->userdata('id').date("Y").date("m").date("d");
					 $payment->external_reference = $id_ext;
					 //$payment->payment_method_id = "bolbradesco";
					 $payment->payer = array(
					    #"email" => $dd_user->email,
					    "email" => "comercial@produtosinovadores.com.br",
					    "first_name" => $dd_user->nome,
					 	#"email" => "igor@yahoo.com.br",
					    # "first_name" => "Igor",
					     "last_name" => "Loteria",
					     "identification" => array(
					         "type" => "CPF",
					         "number" => "06030689444"
					      ),
					     "address"=>  array(
					         "zip_code" => "52041230",
					         "street_name" => "Rua dr jose higino ribeiro campos",
					         "street_number" => "11",
					         "neighborhood" => "Encruzilhada",
					         "city" => "Recife",
					         "federal_unit" => "PE"
					      )
					   );

					 $payment->save();	
					 echo json_encode($payment->point_of_interaction);

			      }else{
			        echo json_encode(array(
			          'status'  => 'error',
			          'message' => 'pix required'
			        ));
			        exit;
			      }

			    }else{
			      echo json_encode(array(
			        'status'  => 'error',
			        'message' => 'pix required'
			      ));
			      exit;
			    }

			  }else{
			    echo json_encode(array(
			      'status'  => 'error',
			      'message' => 'post required'
			    ));
			    exit;
			  }

	} // x fn

	function get_deps_pend_chatbot($id_user=0){
		$db2 = $this->load->database('db2', TRUE);
        $this->db2 = $db2;

        #echo "OK";
        #echo id_user;
        #return false;

		
		#$qr_dep = $this->db2->query("SELECT * FROM depositos WHERE status = 0 AND id_cliente = ".id_user." ORDER BY id desc LIMIT 100");
		#$qr_dep = $this->db2->query("SELECT * FROM depositos WHERE status = 0 ORDER BY id desc LIMIT 1");
		$qr_dep = $this->db2->query("SELECT * FROM depositos WHERE status = 0 ORDER BY id desc LIMIT 100");
		#echo $qr_dep->num_rows();
		foreach ($qr_dep->result() as $dd) {
			# code...
			echo "<strong>".$dd->id."</strong> - (".$dd->status.") - ";
			$status_mp = $this->busca_status_pag($dd->id);
			echo $status_mp." ";

			#$status_mp = "approved";

			if($status_mp == "pending"){
				echo "[Pendente]";
			}

			if($status_mp == "cancelled"){
				echo "[Cancelado]";
				$status_cancel = array('status' => 3, 'pago' => 3);
				$this->db2->where('id',$dd->id);
				$this->db2->update('depositos', $status_cancel); // remove de pendentes
			}

			if($status_mp == "approved"){
				#$qr_cotas = $this->db2->query("SELECT * FROM sorteios_compras WHERE id_deposito = ".$dd->id." ");
				#echo "[Pago] (".$qr_cotas->num_rows().")";
				echo "[Pago] ";

				$valor_depositado = $dd->valor;
				#$this->usuarios_model->set_compra($dd->id,id_user);
				$this->set_compra($dd->id,id_user);

				#$this->fb_model->set_msg_whats($dd->id_user,2);
			} // x if aprovado
			#echo $status_mp;

			echo "<br>OK";

		}
	}


	#######  SET_COMPRA
	function set_compra($id_deposito, $id_user=0){
		#echo "set_compra";
		#return false;
		
		$dd_deposito = $this->padrao_model->get_by_id($id_deposito,'depositos')->row();
		$dd_sorteio = $this->padrao_model->get_by_id($dd_deposito->id_sorteio,'raspadinhas')->row();
		#print_r($dd_sorteio);
		
		#return false;
		if($this->session->userdata('nivel') == "1" && $id_user != "0"){
			$id_user = $id_user;
		}else{
			$id_user = $this->session->userdata('id');
		}

		$db2 = $this->load->database('db2', TRUE);
        $this->db2 = $db2;

        ## veio do controller
        $last = $dd_deposito;
        $valor_depositado = round($last->valor,2);

		$dd_mov = array(
    		#'id_user_mov' => 1,
    		'id_user_mov' => ID_USER,
    		'id_user' => $last->id_user,
    		'data_hora_pagamento' => date("Y-m-d H:i:s"),
    		'valor' => $valor_depositado,
    		'tipo' => 'deposito',
    		'descricao' => "Deposito via PIX de $valor_depositado às ".$last->dt_reg."  ",
    		'status' => 1,
    		'wallet' => "pix",
    		'hash' => $last->hash_transacao,
    		'realizado' => 0
    	);

    	#print_r($dd_mov);
    	#return false;

		
		## LIBERA INSERÇÃO DE SALDO
		
		
    	$this->db2->insert('movimento' , $dd_mov); // add saldo

		
		$status_ok = array('status' => 1, 'pago' => 1);
		$this->db2->where('id',$last->id);
		$this->db2->update('depositos', $status_ok); // remove de pendentes


		#### BONUS
		$this->calcular_bonus($last->id_user,$valor_depositado);

        ## x veio do controller



        #echo $id_user;


	} // x fn	


	#######X SET_COMPRA

	function calcular_bonus($usuario,$valor_depositado){

		$dd_rasp = $this->db->query("SELECT * FROM raspadinhas ORDER BY id desc LIMIT 1")->row();

		#$bonus_primeiro_deposito = 0.02; // 2% do valor depositado
	    #$bonus_recarga_diaria = 0.10; // 10% do valor depositado
	    #$bonus_boas_vindas_valor = 50; // Valor fixo do bônus de boas-vindas

	    $bonus_primeiro_deposito = $dd_rasp->bonus_primeira_recarga / 100; // 2% do valor depositado
	    $bonus_recarga_diaria = $dd_rasp->bonus_recarga_diaria / 100; // 10% do valor depositado
	    $bonus_boas_vindas_valor = $dd_rasp->bonus_boas_vindas; // Valor fixo do bônus de boas-vindas

	    $bonus_total = 0;

	    // PRIMEIRO DEPOSITO Verificar se é o primeiro depósito
	    $qr_depositos = $this->db->query("SELECT COUNT(id) as total FROM movimento WHERE  tipo = 'deposito' AND status = 1 AND bonus = 0 AND id_user = $usuario ");
	    #echo $qr_depositos->row()->total;
	    #return false;
	    if ($qr_depositos->row()->total == 1) {
	        $bonus = $valor_depositado * $bonus_primeiro_deposito;
	        $descricao  = "Bônus de Primeiro Depósito:  ".$bonus." <br>";
	        #$descricao "Bônus de Primeiro Depósito: R$ " . number_format($bonus, 2, ',', '.') . "<br>";

	        $dd_mov = array(
	    		#'id_user_mov' => 1,
	    		'id_user_mov' => ID_USER,
	    		'id_user' => $usuario,
	    		'data_hora_pagamento' => date("Y-m-d H:i:s"),
	    		'valor' => $bonus,
	    		'tipo' => 'deposito',
	    		'descricao' => $descricao,
	    		'status' => 1,
	    		'bonus' => 1,
	    		'wallet' => "pix",
	    		#'hash' => $last->hash_transacao,
	    		'hash' => md5($usuario."--*-*-".date("Y-m-d H:i:s")),
	    		'realizado' => 0
	    	);
	    	#print_r($dd_mov);
	    	#return false;
			
			## LIBERA INSERÇÃO DE SALDO
	    	$this->db->insert('movimento' , $dd_mov); // add saldo
	        $bonus_total += $bonus;
	    } // x if primeiro deposito



	    ###################
	    // RECARGA DIARIA DEPOSITO Verificar ultimo deposito
	    $dataAtual = new DateTime();  // Cria um objeto DateTime com a data atual
		$dataAtual->sub(new DateInterval('P1D'));  // 
		#data_menos_1_dia = $dataAtual->format('Y-m-d');  
		$data_menos_1_dia = date("Y-m-d");

	    #$qr_depositos_last = $this->db->query("SELECT COUNT(id) as total FROM movimento WHERE  tipo = 'deposito' AND status = 1 AND id_user = $usuario  AND (dt BETWEEN '".$data_menos_1_dia." 00:00:01' AND '".$hoje." 23:59:59')");
	    $qr_depositos_last = $this->db->query("SELECT COUNT(id) as total FROM movimento WHERE  tipo = 'deposito' AND status = 1 AND bonus = 0 AND id_user = $usuario  AND (dt BETWEEN '".$data_menos_1_dia." 00:00:01' AND '".$data_menos_1_dia." 23:59:59')");
	    if ($qr_depositos_last->row()->total > 0 && $dd_rasp->bonus_recarga_diaria > 0) {
	        $bonus = $valor_depositado * $bonus_recarga_diaria;	  	             
	        #$descricao  "Bônus de Recarga Diária: R$ " . number_format($bonus, 2, ',', '.') . "<br>";
	        $descricao = "Bônus de Recarga Diária:  $bonus <br>";

	        $dd_mov = array(
	    		#'id_user_mov' => 1,
	    		'id_user_mov' => ID_USER,
	    		'id_user' => $usuario,
	    		'data_hora_pagamento' => date("Y-m-d H:i:s"),
	    		'valor' => $bonus,
	    		'tipo' => 'deposito',
	    		'descricao' => $descricao,
	    		'status' => 1,
	    		'bonus' => 1,
	    		'wallet' => "pix",
	    		#'hash' => $last->hash_transacao,
	    		'hash' => md5($usuario."--*-*-".date("Y-m-d H:i:s")),
	    		'realizado' => 0
	    	);
	    	#print_r($dd_mov);
	    	#return false;
			
			## LIBERA INSERÇÃO DE SALDO
	    	$this->db->insert('movimento' , $dd_mov); // add saldo
	        $bonus_total += $bonus;
	    } // x if recarga diaria
	    #####################

	    // Verificar se é uma recarga diária
	    #$bonus = $valor_depositado * $bonus_recarga_diaria;
	    #echo "Bônus de Recarga Diária: R$ " . number_format($bonus, 2, ',', '.') . "<br>";
	    #$bonus_total += $bonus;

	    // Verificar se o usuário já recebeu o bônus de boas-vindas
	    // if (!$usuario->recebeu_boas_vindas) {
	    //     echo "Bônus de Boas-vindas: R$ " . number_format($bonus_boas_vindas_valor, 2, ',', '.') . "<br>";
	    //     $bonus_total += $bonus_boas_vindas_valor;
	    // }

	    #echo "Bônus Total: R$ " . number_format($bonus_total, 2, ',', '.') . "<br>";
	    
	    #return $bonus_total;
			
	}  // x fn



	function validar_dep($id_deposito){
		if(!$this->session->userdata('id')){
			redirect('');
		}

		if($this->session->userdata('nivel') > 2){
			redirect('');
		}

		#echo $id_deposito;
		$db2 = $this->load->database('db2', TRUE);
        $this->db2 = $db2;

		$qr_dep = $this->db2->query("SELECT * FROM depositos WHERE id = ".$id_deposito." ORDER BY id desc");
		foreach ($qr_dep->result() as $dd) {
			if($dd->id_cliente != $this->session->userdata('id') && $this->session->userdata('nivel') > 1){
				redirect('');
			}
			# code...
			#echo "<strong>".$dd->id."</strong> - (".$dd->status.") - ";
			$status_mp = $this->busca_status_pag($dd->id);
			#echo $status_mp." ";
			if($status_mp == "pending"){
				#echo "[Pendente]";
			}

			#if($status_mp == "approved"){
				#echo "[Pago]";
				$valor_depositado = $dd->valor;
				$this->usuarios_model->set_compra($dd->id);
				$this->fb_model->set_msg_whats($dd->id_user,2);


			#}
			#echo $status_mp;

			#echo "<br>OK";
			redirect('adm/sorteios/vendas/'.$dd->id_sorteio.'/0');

		}
	}

	/*
	function ​ ​PagarMP​​(​​$ref​​ , ​ ​ $nome​​ , ​ ​ $valor​​ , ​ ​ $url​​){ 
		// iniciando as credenciais do MP 
		// Os valores de client_id e client_secret são informados 
		// como atributos da classe 
		$mp​​ = ​ ​ new ​ ​ MP​​(​​$this​​->​​client_id​​, ​ ​ $this​​->​​client_secret​​); 
	} 

	function​​ ​ Retorno​​(​​$id​​ , ​ ​ $conn​​){ 
		// iniciando as credenciais do MP 
		$mp​​ = ​ ​ new ​ ​ MP​​(​​$this​​->​​client_id​​, ​ ​ $this​​->​​client_secret​​); 		​
		​
		
	} 

	class ​ ​ PagamentoMP​​{ 
	// vamos dar alguns atributos a esta class 
	// como : 
	 
	// O botão que irá retornar da função PagarMP (string) 
	public ​ ​ $btn_mp​​; 
	 
	// Definiremos o botão que irá retornar, se será uma lightbox 
	// do mercado pago ou não, como padrão será false. o user será  
	// redirecionado para o site do mercado pago 
	private ​ ​ $lightbox​​ = ​ ​ false​​; 
	 
	// Esta variável recebe uma array com os dados da transação 
	public ​ ​ $info​​ = ​ ​ array​​(); 
	 
	// Se for em modo de teste, esta variável recebe true, caso  
	// contrário o sistema estará em modo de produção 
	private ​ ​ $sandbox​​ = ​ ​ true​​; 
	 
	// Suas credenciais do mercado pago 
	private ​ ​ $client_id​​ = ​ ​ “SEU CLIENT_ID”​​; 
	private ​ ​ $client_secret ​ ​ = ​ ​ “SUA CLIENT_SECRET”​​; 
	 
	
	 
	}
	*/
	
	// MERCADO PAGO

	function set_dd($campo){
		$dd_up = array('status' => 1);

		if(isset($_POST['nome'])){
			$dd_up['nome'] = $this->input->post('nome');
		}

		if(isset($_POST['telefone'])){
			$dd_up['telefone'] = $this->input->post('telefone');
		}

		if(isset($_POST['email'])){
			#$dd_up['email'] = $this->input->post('email');
		}

		if(isset($_POST['senha'])){
			$dd_up['senha'] = $this->input->post('senha');
		}

		// 'wallet' : val , 'wallet_tipo'
		if(isset($_POST['wallet'])){
			$dd_up['wallet'] = $this->input->post('wallet');
		}

		if(isset($_POST['wallet_tipo'])){
			$dd_up['wallet_tipo'] = $this->input->post('wallet_tipo');
		}

		if(isset($_POST['pix'])){
			$dd_up['pix'] = $this->input->post('pix');
		}


		$this->db->where('id',$this->session->userdata('id'));
		$this->db->update('usuarios' , $dd_up);
		print_r($dd_up);
	}

	function financeiro($cb=""){
		$this->load->model('adm/usuarios_model');
		if(!$this->session->userdata('id')){
			redirect('','refresh');
		}
		$dados['cb'] = $cb;
		$id_user = $this->session->userdata('id');

		$movs = $this->db->query("SELECT * FROM movimento WHERE (id_user = '".$id_user."' OR id_user_mov = '".$id_user."') AND status = 1 ORDER BY dt desc");
		$dados['movs'] = $movs;

		$this->db->where('id',$id_user);
		$dados['dd_user'] = $this->db->get('usuarios')->row();

		#$apostas = $this->db->query("SELECT * FROM movimento WHERE id_user_mov = '".$id_user."' AND tipo = 'aposta' AND status = 1 ORDER BY id desc");
		$apostas = $this->db->query("SELECT * FROM apostas WHERE id_user = '".$id_user."' AND status = 2 ORDER BY id desc");
		$dados['apostas'] = $apostas;

		$apostas_abertas = $this->db->query("SELECT * FROM apostas WHERE id_user = '".$id_user."' AND status = 1 ORDER BY id desc");
		$dados['apostas_abertas'] = $apostas_abertas;

		$loterias = $this->db->query("SELECT * FROM loterias ORDER BY id asc");
		$dados['loterias'] = $loterias;

		$loterias_alt = $this->db->query("SELECT * FROM loterias WHERE federal = 0 ORDER BY id asc");
		$dados['loterias_alt'] = $loterias_alt;


		$this->load->view('front/user/financeiro' , $dados);
	}

	function set_hash(){
		$wallet_tipo = $this->input->post('wallet_tipo');
		$hash  = $this->input->post('hash');
		#$valor  = $this->input->post('valor');

		$valor = str_replace("R$ ","",$_POST['valor']);
		$valor = str_replace(".","",$valor);
		$valor = str_replace(",",".",$valor);

		$dd_hash = array(
			'id_user' => $this->session->userdata('id'),
			'wallet_tipo' => $wallet_tipo,
			'wallet' => $hash,
			'valor' => $valor

		);

		$this->db->insert('hash_transacao' , $dd_hash);

		#print_r($_POST);
		redirect('user/financeiro/hash_up','refresh');
	}

	function set_saque(){
    	$this->load->model('adm/Usuarios_model');

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
			

			// ##
			// verifica primeiro deposito
			#$valor_investido = $this->Usuarios_model->valor_investido($this->session->userdata('id'),0);
			// get_rent
			#$get_rent = $this->Usuarios_model->get_rent($this->session->userdata('id'),0);
			#$get_rent_mes = $this->Usuarios_model->get_rent_mes($this->session->userdata('id'),0);			

			// saques
			/*
			$saques = $this->Usuarios_model->saques($this->session->userdata('id'),0);
			$dados['saques'] = $saques;

			$last_dep = $this->db->query("SELECT * FROM movimento WHERE id_user = '".$id_user."' AND status = 1 AND tipo = 'deposito' ORDER BY dt asc LIMIT 1");
			#if($last_dep->num_rows() > 0){
				$first_dep = substr($last_dep->row()->data_hora_pagamento,0,10);
				$hoje = date("Y-m-d");
				#echo $first_dep;
				$data_inicio = new DateTime($first_dep);
			    $data_fim = new DateTime($hoje);
			    // Resgata diferença entre as datas
			    $dateInterval = $data_inicio->diff($data_fim);
			    $dias_ativo = $dateInterval->days;

			    // disponivel para saque
			    if($dias_ativo > 90){
                    $disp_saque = $valor_investido + $get_rent;
                }else{
                	$ver_perc = ($get_rent * 100) / $valor_investido;
                	if($ver_perc >= 20){
                		$disp_saque = $get_rent;
                	}else{
                		$disp_saque = 0;	
                	}                  
                    
                }
                $disp_saque = $disp_saque - $saques;
                */
                #echo $valor." <= ".$disp_saque;
                #print_r($_POST);
                #echo "<br><br><hr>";
                #$saldo = $this->Usuarios_model->saldo($this->session->userdata('id'),0);
                #echo $saldo." > ".$valor;
                $saldo = $this->Usuarios_model->saldo($this->session->userdata('id'),0);

                ## SET SQUE EM movimento
                if($valor > $saldo){
                	#redirect('user/financeiro/saldo','refresh');
                	#echo "sem saldo";
                	#return false;
                }
                if($valor < 10){
                	redirect('user/financeiro/min','refresh');
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
                	redirect('user/financeiro/seted','refresh');

                }else{
                	redirect('user/financeiro/saldo','refresh');
                }

                ## X set saque

                // rent mes
               	#$rent_mes = ($get_rent_mes * 100) / $valor_investido; //$get_rent_mes;

                // rentabilidade mensal
			    
			#}else{
			#	redirect('home/financeiro/ind','refresh');
				#$dias_ativo = 0;
				#$disp_saque = 0;
				#$ver_perc = 0;
				#$rent_mes = 0;
			#}
			// X ##


		}

    }


	################################### NOVOCOD PARA LOTERIAS
	function set_aposta(){
		date_default_timezone_set('America/Recife');
		$this->load->model('adm/usuarios_model');
		$this->load->model('loterias_model');
		#print_r($_POST);
		$loteria = $this->input->post('loteria');
		$n = $this->input->post('n');


		#echo $loteria;
		// proximos_sorteios
		$this->db->where('loteria',$loteria);
		$qr_prox_sorteio = $this->db->get('proximos_sorteios');
		if($qr_prox_sorteio->num_rows() > 0){
			$dd_prox_sort = $qr_prox_sorteio->row();
			if($dd_prox_sort->status == 1){
				redirect('');
			}
		}
		return false;

		//  VERIFICA QTD
		$total_numV = 0;
		foreach($n as $keyV => $n_selV){
			#echo $keyV." => ".$n_selV;
			if($n_selV > 0){
				$total_numV++;
			}
			#echo "<br>";
		}
		

		// megasena
		if($loteria == 1 || $loteria == 8){
			$num_min = 20;
			$num_max = 40;	
		}

		// quina
		if($loteria == 2 || $loteria == 9){
			$num_min = 20;
			$num_max = 50;	
		}

		// lotofacil
		if($loteria == 3 || $loteria == 10){
			$num_min = 17;
			$num_max = 23;	
		}
		
		// lotomania
		if($loteria == 4 || $loteria == 11){
			$num_min = 60;
			$num_max = 80;	
		}

		// dupla sena
		if($loteria == 5 || $loteria == 12){
			$num_min = 10;
			$num_max = 30;	
		}
		
		// time manIa
		if($loteria == 6 || $loteria == 13){
			$num_min = 20;
			$num_max = 50;	
		}

		// DIA DE SORTE
		if($loteria == 7 || $loteria == 14){
			$num_min = 13;
			$num_max = 22;	
		}

		// loteria alternativa
		/*
		if($loteria == 8 || $loteria == 14){
			$num_min = 20;
			$num_max = 50;	
		}
		*/

		#echo "<br>";
		#echo $total_numV." < ".$num_min." || ".$total_numV." > ".$num_max; 
		if($total_numV < $num_min || $total_numV > $num_max){
			#echo "Quantidade de números inválidos.<a href='".base_url()."'>Voltar</a>";
			redirect('home/erro/2','refresh');
			//return false;
		}

		#$valor_aposta = $this->input->post('valor_aposta');
		$valor = str_replace("R$ ","",$_POST['valor_aposta']);
		$valor = str_replace(".","",$valor);
		$valor = str_replace(",",".",$valor);

		$status_mov = 1;

		if($this->session->userdata('id')){
			$status = 1;

			$saldo = $this->usuarios_model->saldo($this->session->userdata('id'),0);
			#if($valor > $saldo){
				$status_mov = 0;
				$status = 0;
				#$status_aposta = 0;
				#redirect('home/erro/3','refresh');
				#echo "Saldo insuficiente.<a href='".base_url()."'>Voltar</a>";
				#return false;
			#}

			if($valor < 1){
				#echo "Valor insuficiente.<a href='".base_url()."'>Voltar</a>";
				redirect('home/erro/4','refresh');
				return false;
			}

			#echo "<br>";
			if($this->session->userdata('id')){
				$id_user = $this->session->userdata('id');
			}else{
				$id_user = 777;
			}

			
		}else{ // x if session

			if(isset($_POST['telefone'])){
				if(strlen($_POST['telefone']) < 5){
					redirect('home/erro/3','refresh');
				}
				if($_POST['telefone'] != ""){
					$nome = $this->input->post('nome');

					$replace = array("(",")","-"," ",".");
					$telefone = $this->input->post('telefone');
					$telefone = str_replace($replace, "", $telefone);

					$this->db->where('telefone',$telefone);
					$qr_verifica_cad = $this->db->get('usuarios');
					if($qr_verifica_cad->num_rows() == 0){
						$dd_cad = array('telefone' => $telefone , 'nome' => $nome);
						$this->db->insert('usuarios' , $dd_cad);
						$id_user = $this->db->insert_id();
					}else{
						$id_user = $qr_verifica_cad->row()->id;
					}
				}
			}
			#$id_user = 9999;
			$status = 0;
			#$status = 1;
			$dd_session = array(
				'usr' => true,
				'guest' => true,
				'id' => $id_user,
				#'nome' => $dd_user->nome,
				#'nivel' => $dd_user->nivel,
				#'email' => $login
			);
			$this->session->set_userdata($dd_session);
		}
		
		$caracteres_para_md5 = "hashmd5".$id_user."--**-*".date("Y-d-m H:i:s")."loteriasonlinealternativas2343209482309";
		$hash = md5($caracteres_para_md5);
		$total_num = 0;

		// pega proximo concurso
		$this->db->where("id_loteria",$loteria);
		$this->db->order_by('id','desc');
		$this->db->limit(1);
		$qr_conc = $this->db->get("resultados_loterias");
		if($qr_conc->num_rows() > 0){
			$concurso_aposta = $qr_conc->row()->numero_concurso + 1; 
		}else{
			$concurso_aposta = 99; 
		}



		
		$dd_loteria = array(
			'hash' => $hash,
			'concurso' => $concurso_aposta,
			'id_user' => $id_user,
			'loteria' => $loteria,
			'valor' => $valor,
			'status' => $status

		);
		$this->db->insert('apostas' , $dd_loteria);
		$id_aposta = $this->db->insert_id();

		if(isset($_SESSION['guest'])){
			#$status_mov = 0;
			$status_mov = 1;
		}

		#$dd_movimento = $this->input->post('loteria');

		$hash2 = md5("loteriall".$id_user.date("Y-m-d H:i:s")."---apldasd");
		$dd_movimento = array(
			'hash' => $hash2,
			'id_user' => 1,
			'id_user_mov' => $id_user,
			'descricao' => $loteria.": Hash: ".$hash2." ID: ".$id_aposta,
			'data_hora_pagamento' => date("Y-m-d H:i:s"),
			'valor' => $valor,
			'tipo' => "aposta",
			#'status' => 1
			'status' => $status_mov

		);
		$this->db->insert('movimento' , $dd_movimento);

		$dd_apostas_numeros = array(
			'id_aposta' => $id_aposta,
			'hash' => $hash
		);

		foreach($n as $key => $n_sel){
			#echo $key." => ".$n_sel;
			if($n_sel > 0){
				$dd_apostas_numeros['numero'] = $n_sel;
				$this->db->insert('apostas_numeros' , $dd_apostas_numeros);
				$total_num++;
			}
			#echo "<br>";
		}
		// verifica lucro

		  $lucro = 0;
          $multipl = 0;
          $qtd_tem = $total_num;
          /*
          //console.log('Numeros selecionados: '+qtd_tem+" * "+val);
          if($qtd_tem == 17){
            $multipl = 3000;
          }
          if($qtd_tem == 18){
            $multipl = 800;
          }
          if($qtd_tem == 19){
            $multipl = 350;
          }
          if($qtd_tem == 20){
            $multipl = 105;
          }
          if($qtd_tem == 21){
            $multipl = 37;
          }
          if($qtd_tem == 22){
            $multipl = 9;
          }
          if($qtd_tem == 23){
            $multipl = 2.5;
          }
          /////////////X
          if($multipl > 0){
            $lucro = $valor * $multipl;
            #echo 'Lucro: '.$lucro." = ".$valor." * ".$multipl;
            //$("#lucro_label").html("R$ ".$lucro);
          }else{
            #echo 'Sem multiplicador';
          }
          */
          #$lucro = $this->loterias_model->get_lucro($loteria,$valor,$qtd_tem);
          #echo $loteria." - ".$valor." - ".$qtd_tem;
          #echo "<br>";
          #echo $lucro;
          #return false;

		// x verifica lucro
		// update em apostas
		$dd_qtd = array('numeros_qtd' => $total_num , 'lucro' => $this->loterias_model->get_lucro($loteria,$valor,$qtd_tem) );
		$this->db->where('id',$id_aposta);
		$this->db->update('apostas' , $dd_qtd);

		#$dd_loteria['numeros_qtd'] = $total_num;
		redirect("home/aposta/".$hash , "refresh");
		#echo "<br>";
		#echo "Total nº selecionados: ".$total_num;
	}

	function random_numbers($min, $max, $quantity) {
	    $numbers = range($min, $max);
	    shuffle($numbers);
	    return array_slice($numbers, 0, $quantity);
	}

	function gerar_apostas($loteria=6,$id_user=1){
		$this->load->model('loterias_model');

		$qr_loterias = $this->db->get('loterias');

		// lotofacil
		#$max_num =  25;
		#$max_esc = 23;

		#foreach($qr_loterias->result() as $lot){
			#$loteria = $lot->id;
			// megasena
			if($loteria == 1){
				$max_num =  60;
				$max_esc = 40;	
			}

			// quina
			if($loteria == 2){
				$max_num = 80;
				$max_esc = 50;	
			}

			// lotofacil
			if($loteria == 3){
				$max_num =  25;
				$max_esc = 23;
				#$num_min = 17;
				#$num_max = 23;	
			}
			
			if($loteria == 4){
				$max_num = 100;
				$max_esc = 80;	
			}

			if($loteria == 5){
				$max_num = 50;
				$max_esc = 30;	
			}
			
			// time manIa
			if($loteria == 6){
				$max_num = 80;
				$max_esc = 50;	
			}

			// DIA DE SORTE
			if($loteria == 7){
				$max_num = 31;
				$max_esc = 22;	
			}

			for($a=0; $a<1000;$a++){
				$caracteres_para_md5 = "hashmd5".$id_user."--**-*".date("Y-d-m H:i:s")."loteriasonlinealternativas2343209482309";
				$hash = md5($caracteres_para_md5);
				$total_num = 0;
				
				// pega proximo concurso
				$this->db->where("id_loteria",$loteria);
				$this->db->order_by('id','desc');
				$this->db->limit(1);
				$qr_conc = $this->db->get("resultados_loterias");
				if($qr_conc->num_rows() > 0){
					$concurso_aposta = $qr_conc->row()->numero_concurso + 1; 
				}else{
					$concurso_aposta = 99; 
				}


				$valor = 9.99;
				
				$dd_loteria = array(
					'hash' => $hash,
					'concurso' => $concurso_aposta,
					'id_user' => $id_user,
					'loteria' => $loteria,
					'valor' => $valor

				);
				$this->db->insert('apostas' , $dd_loteria);
				$id_aposta = $this->db->insert_id();
				
				$random_numbers = $this->random_numbers(1, $max_num, $max_esc);
				echo "Números gerados:";
				#echo implode(", ",$random_numbers);
				#print_r($random_numbers);

				$dd_apostas_numeros = array(
					'id_aposta' => $id_aposta,
					'hash' => $hash
				);

				foreach($random_numbers as $key => $n_sel){
					#echo $key." => ".$n_sel;
					if($n_sel > 0){
						$dd_apostas_numeros['numero'] = $n_sel;
						$this->db->insert('apostas_numeros' , $dd_apostas_numeros);
						echo " - ".$n_sel;
						$total_num++;
					}
					#echo "<br>";
				} // x foreach / dezendas
				$lucro = 0;
			    $multipl = 0;
			    $qtd_tem = $total_num;
			    $dd_qtd = array('numeros_qtd' => $total_num , 'lucro' => $this->loterias_model->get_lucro($loteria,$valor,$qtd_tem) );
			    print_r($dd_qtd);
			    echo "<br><br>";
				$this->db->where('id',$id_aposta);
				$this->db->update('apostas' , $dd_qtd);
			}
		#} // x foreach



	} // x fn

	function get_n_ersult_conc($id_loteria,$concurso){


		$qr_dezendas_conc = $this->db->query("SELECT * FROM resultados_loterias_dezenas WHERE id_loteria = '".$id_loteria."' AND concurso = '".$concurso."' ");
		if($qr_dezendas_conc->num_rows() > 0){

			echo "<div class='container'>";
			echo "<div class='row'>";
				
			
			$cont = 0;
            foreach($qr_dezendas_conc->result() as $dezena){ $cont++;
            	/*
            	echo '
            	<div class="contest-card">
                  <a href="contest-details-two.html" class="item-link"></a>
                  <div class="contest-card__thumb">
                    <img src="'.base_url().'assets/images/contest/s'.$dezena->dezena.'.png" alt="'.$dezena->dezena.'" title="'.$dezena->dezena.'" >                  
                  </div>
                </div>
            	';
            	*/
            	#<img src="'.base_url().'assets/images/contest/s'.$dezena->dezena.'.png" alt="'.$dezena->dezena.'" title="'.$dezena->dezena.'" >                                    
            	/*
            	echo '
            	<button class="btn btn-success">                  
                    '.$dezena->dezena.'
                </button>
            	';
            	*/
            	if($this->agent->is_mobile()){
            		echo "
	            	<div class='col-sm-2' style='float:left;border:green 0px solid;width:15%'>                  
	                    <img src='".base_url()."imagens/numeros/".$dezena->dezena.".png' style='width:50px' >
	                </div>
	            	";

            	}else{
            		echo "
	            	<div class='col-sm'>                  
	                    <img src='".base_url()."imagens/numeros/".$dezena->dezena.".png' >
	                </div>
	            	";

            	}
            	
            	if($cont == 10){
            		//echo "<br>	";
            	}
            }
            echo "</div>";
            echo "</div>";
        } // x if
	}
	function get_n_ersult_conc_json($concurso){
		$qr_dezendas_conc = $this->db->query("SELECT dezena FROM resultados_loterias_dezenas WHERE id_loteria = '".$concurso."' ");
		if($qr_dezendas_conc->num_rows() > 0){
			$qr_json = json_encode($qr_dezendas_conc->result());
			echo $qr_json;
			/*
            foreach($qr_dezendas_conc->result() as $dezena){
            	echo '
            	<div class="contest-card">
                  <a href="contest-details-two.html" class="item-link"></a>
                  <div class="contest-card__thumb">
                    <img src="'.base_url().'assets/images/contest/s'.$dezena->dezena.'.png" alt="'.$dezena->dezena.'" title="'.$dezena->dezena.'" >                  
                  </div>
                </div>
            	';
            }
            */
        }
	}

	function get_status_conc($loteria){


		$qr_dezendas_conc = $this->db->query("SELECT * FROM proximos_sorteios WHERE loteria = '".$loteria."' ");
		echo $qr_dezendas_conc->row()->status;
	}
	################################### X NOVO COD


	function set_edit(){
		#print_r($_POST);
		$replace = array("(",")","-"," ",".");
		$telefone = $this->input->post('telefone');
		$telefone = str_replace($replace, "", $telefone);
		$dd_user = array ( 
			'nome' => $this->input->post('nome'),
			'nascimento' => $this->input->post('nascimento'),
			'telefone' => $telefone,
			'email' => $this->input->post('email'),
			'cidade' => $this->input->post('cidade'),
			'estado' => $this->input->post('estado'), 
		);
		$this->db->where('id',$this->session->userdata('id'));
		$this->db->update('usuarios_thr' , $dd_user);
		redirect('user/profile','refresh');
	}

	function rel($tipo="",$cb=""){
		$dados['dd'] = $this->padrao_model->get_by_id($this->session->userdata('id'),'usuarios_thr')->row();
		if($dados['dd']->nivel > 1){
			redirect('');
		}

		$dados['users'] = $this->db->query("SELECT * FROM usuarios_thr ORDER BY id desc");

		$dados['tipo'] = $tipo;
		$dados['cb'] = $cb;

		#echo "OK";
		#return false;
		$this->load->view('adm/usuarios' , $dados);
	}	

	function set_venc(){
		$dados['dd'] = $this->padrao_model->get_by_id($this->session->userdata('id'),'usuarios_thr')->row();
		if($dados['dd']->nivel > 1){
			redirect('');
		}
		$this->load->model('padrao_model');
		$id_user = $this->input->post('id_user');
		$vencimento = $this->input->post('vencimento');
		
		$dd = array('vencimento' => $vencimento);
		$this->db->where('id',$id_user);
		$this->db->update('usuarios_thr',$dd);
		redirect('user/rel','refresh');
	}


	function login_novo(){
		#print_r($_POST);
		#return false;
		$db2 = $this->load->database('db2', TRUE);
        $this->db2 = $db2;

		$login = $this->input->post('usuario');
		$senha = $this->input->post('senha');
		$query = "select * from usuario where usuario = '$login' and senha = md5('$senha')";
		$qr = $this->db2->query($query);
		if($qr->num_rows() > 0){
			$dd_user = $qr->row();
			$dd_session = array(
				'id' => $dd_user->id_usuario,
				'usr' => true,
				'dt_login' => date("Y-m-d h:i:s"),
				'usuario' => $login,
				'nome' => $dd_user->nome,
				'sobrenome' => $dd_user->sobrenome,
				'nivel' => $dd_user->nivel
				#'vencimento' => $email
			);
			$this->session->set_userdata($dd_session);
			#print_r($this->session->userdata());
			#echo "<br>";
			#echo "true";
			redirect('home/front','refresh');
		}else{
			redirect('home/login/inv','refresh');
			#echo "false";
		} 
	}

	
	function logout(){

		$this->session->sess_destroy();
		#$this->load->view("logout");

		redirect('');

	}
	function sair(){

		$this->session->sess_destroy();
		redirect('');

	}

} // x class

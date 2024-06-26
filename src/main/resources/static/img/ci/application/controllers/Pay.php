<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pay extends CI_Controller {

	function __construct()
	{
		parent::__construct();		
		$this->padrao_model->indexador();
		if($this->session->userdata('id')){
			#redirect('admin','refresh');
		}

		$this->load->model('fb_model');
		// define("ID_USER",42);
		// define("id_user",42);

		// $qr_api_mp =  $this->padrao_model->get_by_matriz('id_user',ID_USER,'usuarios_parametros');
		// $api_mp = $qr_api_mp->row()->api_mp;
		// define("API_MP",$api_mp);
		include('includes/env.php');

		

		// whqatsapp
		// $dbbot = $this->load->database('dbbot', TRUE);
        // $this->dbbot = $dbbot;

   } // fecha construct

	
	public function index()
	{
		#$this->base();
		echo "OK 2";
	}


	// MERCADO PAGO	
	function process_payment($id_user=ID_USER,$id_sorteio=0){
		header('Access-Control-Allow-Origin: *');

		if($id_sorteio == 0){
			echo "Selecione uma raspadinha";
			return false;
			exit();
		}

		$qr_sorteio = $this->padrao_model->get_by_id($id_sorteio,'raspadinhas');

		$access_token = API_MP; // DINAMICO
		
		if($qr_sorteio->num_rows() == 0){
			redirect('');
		}else{
			$dd_sorteio = $qr_sorteio->row();
			if($dd_sorteio->api_mercado_pago != ""){
				$access_token = $dd_sorteio->api_mercado_pago;
			}
			
		}

		#$access_token = "APP_USR-685172168846807-012610-649caed966c451e2c65d542a6ade4edd-182756904"; // Igor
		
		
		#$access_token = API_MP;


			  if(isset($_POST)){

			  		// VALIDAÇÕES
					
					if($qr_sorteio->num_rows() > 0){
						
						#print_r($dd_sorteio);

						// dados do sorteio
						$valor_cota = $dd_sorteio->preco_cota; 
						$qtd_min = $dd_sorteio->qtd_minima;
						$qtd_max = $dd_sorteio->qtd_maxima;
						$qtd_max_user = $dd_sorteio->qtd_por_comprador;

						// post
						$compra_qtd_numeros = $this->input->post('qtd_numeros');
						$compra_valor = $this->input->post('valor_dep');
						
						// db
						$this->db->where('id_user_compra',$this->session->userdata('id'));
						$this->db->where('id_sorteio',$id_sorteio);
						$this->db->where('status',1);
						$qr_compras_user = $this->db->get('compras');

						#echo $qr_compras_user->num_rows();

						#return false;
						###################  ADICIONAR REGRAS E BONUS AQUI 


						################### X REGRAS E BONUS
						## PROMOCOES
						/*
						$promocoes = $this->db->query("SELECT * FROM sorteios_promocoes WHERE id_user = '".$id_user."' AND id_sorteio = ".$id_sorteio." ORDER BY numero asc ");		

						if($promocoes->num_rows() > 0){ 
			        	 	foreach($promocoes->result() as $promo_js){ 
							      if($compra_qtd_numeros >= $promo_js->qtd){
							      	$valor_cota = $promo_js->valor;
							      } // X IF
					    	} // X FOREACH
					    } // X IF
					    */

						## X PROMOCOES
						


						#echo "<br> <br>";

						#print_r($_POST);
						$valConf = $compra_qtd_numeros * $valor_cota;
						#echo $compra_qtd_numeros." > ".$qtd_max;
						#echo "<br>";

						if($compra_qtd_numeros > $qtd_max){
							// maxima quantidade atingida
							echo "999";
							return false;
						}

						if($qr_compras_user->num_rows() > $qtd_max_user){
							// maxima quantidade atingida
							echo "999";
							return false;
						}

						if($compra_qtd_numeros < $qtd_min){
							// maxima minima exigida
							#echo "111";
							#return false;
						}

						if($compra_valor < $valConf){
							// valor invalido
							#echo "555";
							#return false;
						}

						

						#return false;

					}else{
						echo "Sorteio invalido";
						return false;
					}

				    if(isset($_POST['pix'])){

				    	

				      if($_POST['pix']){
				      	#$id_user = $this->session->userdata('id');
				      	$this->db->where('id',$id_user);
				      	$qr_user = $this->db->get('usuarios');
				      	$dd_user = $qr_user->row();
						#$dd_user = $this->padrao_model->get_by_id($id_user,'usuarios')->row();
						#print_r($dd_user);

				        #$valor = 10;
				        // qtd_numeros
				        $qtd_numeros = $this->input->post('qtd_numeros');
				        $valor = str_replace("R$ ","",$this->input->post('valor_dep'));
						#$valor = str_replace(".","",$valor);
						#$valor = str_replace(",",".",$valor);
				        #$valor = 7.59;

				        if(empty($valor)){
				        	$valor = 10;
				        }


						$valor = round($valor,2);

						$hash = md5($id_user."--3--32-".date("Y-m-d h:i:s"));


						$dd_dep = array(
							'id_user' => $this->session->userdata('id'),
							'id_cliente' => 6,
							'id_sorteio' => $id_sorteio,
							'valor' => $valor,
							'qtd_numeros' => $qtd_numeros
						);
						$this->db->where($dd_dep);
						$qr_dep = $this->db->get('depositos');
						if($qr_dep->num_rows() >= 0){
							$dd_dep['hash_transacao'] = $hash;
							$this->db->insert('depositos', $dd_dep);
							$id_ext = $this->db->insert_id();
							#$this->fb_model->set_msg_whats($this->session->userdata('id'),1);
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
						 $payment->description = "Saldo Raspadinha";
						 $payment->payment_method_id = "pix";
						 #$payment->external_reference = $this->session->userdata('id').date("Y").date("m").date("d");
						 $payment->external_reference = $id_ext;
						 //$payment->payment_method_id = "bolbradesco";
						 $payment->payer = array(
						    #"email" => $dd_user->email,
						    "email" => "comercial@produtosinovadores.com.br",
						    #"email" => "alannapinko@hotmail.com",
						    
						    "first_name" => $dd_user->nome,
						 	#"email" => "igor@yahoo.com.br",
						    # "first_name" => "Igor",
						     "last_name" => "Raspadinha",
						     // "identification" => array(
						     //     "type" => "CPF",
						     //     "number" => "06030689444"
						     //  ),
						     "address"=>  array(
						         "zip_code" => "51350670",
						         "street_name" => "Avenida Recife",
						         "street_number" => "114",
						         "neighborhood" => "Várzea",
						         "city" => "Recife",
						         "federal_unit" => "PE"
						      )
						   );

						 $payment->save();	
						 #print_r($payment);
						 $call = [
						 	'id_ref' => $id_ext,
						 	'pay' => $payment->point_of_interaction
						 ];

						 // var base64 = obj.transaction_data.qr_code_base64;
	                     // var codePix = obj.transaction_data.qr_code;
						 $dd_pix_pay = [
						 	'pix_qrcode' => $payment->point_of_interaction->transaction_data->qr_code_base64,
						 	'pix_code_cc' => $payment->point_of_interaction->transaction_data->qr_code
						 ];
						 $this->db->where('id',$id_ext);
						 $this->db->update('depositos', $dd_pix_pay);
						 #echo $id_ext;
						 #print_r($dd_pix_pay);
						 #return false;

						 echo json_encode($payment->point_of_interaction);
						 #echo json_encode($call);

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


	//  X MERCADO PAGO	
	

	

	
}

<?php
class Fb_model extends CI_Model{	
	
	function _construct()
	{
		// Call the Model constructor
		parent::_construct();
		#define("numero_whats","100494629683438");  
	}

	function send_text($to="",$msg="",$cod_enc=""){
		#$this->load->model('fb_model');
		#$this->fb_model->send_text($to="",$msg="",$cod_enc="");
		
	    // #$url = 'https://graph.facebook.com/v15.0/121266314223152/messages';	     
	    // #$url = 'https://graph.facebook.com/v15.0/100494629683438/messages';	      // numero encomendas
	    $url = 'https://graph.facebook.com/v15.0/'.numero_whats.'/messages';	      // numero_whats
	     //   

	    // resolve 9 no numero do whatsapp
	    // $telefone_post = $to;
		// $replace_tel = ["+"," ","-","(",")"];
		// $telefone_trat = str_replace($replace_tel, "", $telefone_post);
		// $whatsapp = "";
		
	    
	    $ch = curl_init($url);	        
	    	    
	    $data_arr = ['messaging_product' => 'whatsapp','recipient_type' => 'individual' ,'to' => $to , 'type' => 'text' , 'text' => array( 'body' => $msg) ]; // 5581999468046 / 5581998522967 ricardo

	    #return $data_arr;
	    
	    $data = json_encode($data_arr);	    
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);	        
	    /* set the content type json */
	    $headers = [];
	    $headers[] = 'Content-Type:application/json';
	    $token = token_fb;
	    $headers[] = "Authorization: Bearer ".$token;
	    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);	        
	    /* set return type json */
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	        	    
	    $result = curl_exec($ch);
    	return $result;
	    #echo $result;
	
	} // send text



	function set_msg_whats($id_usuario,$tipo=1,$id_sorteio=0,$id_deposito=0){
		
		$this->db->where('id',$id_usuario);
		$usr = $this->db->get('usuarios')->row();

		
		$this->db->where('id',id_user);
		$dd_cond = $this->db->get('usuarios')->row();

		$dd = [];		

		$mensagem_body = "*SINO DA SORTE*\n\n";
		$mensagem_body .= "Rifa: *".$dd_cond->nome."*\n";		
		$mensagem_body .= "Usuário: *".$usr->nome."*\n";				
		$mensagem_body .= "Data: *".date("d/m/Y H:i:s")."*\n";		
		

		if($tipo == 1){
			$mensagem_body .= "PIX GERADO";		
		}

		if($tipo == 2){
			$mensagem_body .= "Pagamento Aprovado";		
		}

		if($tipo == 10){
			$mensagem_body .= "Ganhardor da RIFA";		
		}

		$this->dbbot->where('id_user',$dd_cond->id_bot);
		$this->dbbot->where('telefone',$usr->whatsapp);
		$qr_ver = $this->dbbot->get("pi_whats_users");
		if($qr_ver->num_rows() == 0){
			$dd_insert_user = array('id_user' => $dd_cond->id_bot ,'nome' => $nome ,'telefone' => $usr->whatsapp , 'id_produto' => $dd_cond->id );
			if(isset($_POST['img'])){
				$dd_insert_user['status'] = $this->input->post('img');
			}

			$this->dbbot->insert('pi_whats_users' , $dd_insert_user);
			$id_user_send = $this->dbbot->insert_id();
			#echo  1;
		}else{
			$id_user_send = $qr_ver->row()->id;
			#echo $qr_ver->row()->nivel;
		}

		

		

			// CRIA MSG EM pi_whats_msgs VIApiratex
			$dd_new_msg = array(
				'id_user' => $dd_cond->id_bot,
				'tipo' => 1,
				'nome' => 'Nova pix gerado',
				#'mensagem' => "Olá ".$mor->nome." .Chegou uma nova encomenda para você"
				'mensagem' => $mensagem_body
			);



			$this->dbbot->insert('pi_whats_msgs' , $dd_new_msg);
			$id_new_msg = $this->dbbot->insert_id();

			// agenda o envio 
			$dd_insert_not_mp = array(
				'id_msg' => $id_new_msg,
				#'id_user' => $usr->id,
				'id_user' => $dd_cond->id_bot,
				#'id_user' => $id_user_send,
				'contato' => $usr->whatsapp,
				#'data_envio' => date('Y-m-d H:i:s'),
				'data_envio' => date('Y-m-d').' 00:00:01',
				'enviada' => 0
			);
			$this->dbbot->insert('pi_whats_msgs_sends' , $dd_insert_not_mp);
			// X ENVIO PIRATEX

			#print_r($dd_insert_not_mp);
			

			#echo "OK";
			## DISPARA QRCODE
			if($id_new_msg){
				/*

				$dd_new_encomenda = $this->padrao_model->get_by_id($id_encomendas,'encomendas')->row();

				$dd_new_msg_img = array(
					'id_user' => $dd_cond->id,
					'tipo' => 5,
					'nome' => 'Novo QRCODE encomenda',
					#'mensagem' => "Olá ".$mor->nome." .Chegou uma nova encomenda para você"
					'mensagem' => $mensagem_body
				);
				//$dd_new_msg['tipo'] = 3;
				#$dd_new_msg['tipo'] = 1;
				#$dd_new_msg_img['imagem'] = base_url().$dd_new_encomenda->qrcode;
				$dd_new_msg_img['imagem'] = $dd_new_encomenda->qrcode;
			
			
				$this->db->insert('pi_whats_msgs' , $dd_new_msg_img);
				$id_new_msg_img = $this->db->insert_id();

				// agenda o envio 
				$dd_insert_not_mp = array(
					'id_msg' => $id_new_msg_img,
					'id_user' => $mor->id,
					'contato' => $mor->whatsapp,
					'data_envio' => date('Y-m-d H:i:s'),
					'enviada' => 0
				);
				$this->db->insert('pi_whats_msgs_sends' , $dd_insert_not_mp);
				// X ENVIO PIRATEX

				// cadastra em notificações para auditar a entrega e a visualização 
				$dd_notificacoes_enc = array(
					'n_encomenda' => $dd_new_encomenda->codigo_enc,
					'id_user' => $mor->id,
					'whats' => $mor->whatsapp,
					'id_resp' => $dd_cond->id,
					'id_msg' => $id_new_msg_img
				);

				#print_r($dd_notificacoes_enc);
				$this->db->insert('notificacoes', $dd_notificacoes_enc);
				*/
				


			} // x disparo qrcode

	} // X FN



}
?>
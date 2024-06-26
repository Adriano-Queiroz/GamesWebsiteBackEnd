<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

	


	function __construct()
	{
		parent::__construct();
		#$this->load->library('session');
		#$this->load->helper(array('form','url'));
		if(!$this->session->userdata('id')){
			redirect('admin','refresh');
		}

		if($this->session->userdata('nivel') > 1){
			redirect('admin','refresh');
		}
		date_default_timezone_set('America/Recife');
		#$this->load->model('adm/usuarios_model');
		#$this->load->model('padrao_model');
		#$this->padrao_model->indexador();

		//$this->usuarios_model->verSession();

   } // fecha fn USER




	function Index(){
		//echo "teste";
		$this->load->model('padrao_model');
		$dados["usuarios"] = $this->db->query("SELECT * FROM usuarios");
		$dd = $this->db->query("SELECT * FROM usuarios WHERE '".$this->session->userdata('id')."'")->row();
		
		print_r($dd);

		$dados["dd"] = $dd;
		#$this->load->view('adm/usuarios/lista', $dados);

	}

	function dash(){

		$dd = $this->db->query("SELECT * FROM usuarios WHERE id = '".$this->session->userdata('id')."'")->row();		

		$hj_ini = date("Y-m-d")." 00:00:01";
		$hj_fim = date("Y-m-d")." 23:59:59";

		if(isset($_POST['de'])){
			$hj_ini = $this->input->post('de')." 00:00:01";
			$hj_fim = $this->input->post('ate')." 23:59:59";
		}
		
		/*		
		// GERAL
		$total_compras = $this->db->query("SELECT * FROM depositos WHERE  id_cliente = '".$this->session->userdata('id')."' AND status = 1  ORDER BY id desc LIMIT 5");
		$total_valores = $this->db->query("SELECT SUM(valor) as total FROM depositos WHERE  id_cliente = '".$this->session->userdata('id')."' AND status = 1 ORDER BY id desc")->row()->total;
		$ticket_medio = $total_valores / $total_compras->num_rows(); 
		$ticket_medio = round($ticket_medio,2);

		// HOJE

		$total_compras_hj = $this->db->query("SELECT * FROM depositos WHERE  id_cliente = '".$this->session->userdata('id')."' AND status = 1 AND (dt_reg BETWEEN '".$hj_ini."' AND '".$hj_fim."') ORDER BY id desc")->num_rows();
		$total_valores_hj = $this->db->query("SELECT SUM(valor) as total FROM depositos WHERE  id_cliente = '".$this->session->userdata('id')."' AND status = 1 AND (dt_reg BETWEEN '".$hj_ini."' AND '".$hj_fim."') ORDER BY id desc")->row()->total;
		$ticket_medio_hj = $total_valores_hj / $total_compras_hj; 
		$ticket_medio_hj = round($ticket_medio_hj,2);



		$total_participantes_hj = $this->db->query("SELECT DISTINCT id_user FROM depositos WHERE  id_cliente = '".$this->session->userdata('id')."' AND status = 1 AND (dt_reg BETWEEN '".$hj_ini."' AND '".$hj_fim."') ORDER BY id desc")->num_rows();
		$total_compras_hj = $this->db->query("SELECT * FROM depositos WHERE  id_cliente = '".$this->session->userdata('id')."' AND status = 1 AND (dt_reg BETWEEN '".$hj_ini."' AND '".$hj_fim."') ORDER BY id desc")->num_rows();

		$dados['total_participantes'] = $this->db->query("SELECT * FROM usuarios WHERE  id_user = '".$this->session->userdata('id')."' ORDER BY id desc")->num_rows();				
		$dados['ultimos_cadastro'] = $this->db->query("SELECT * FROM usuarios WHERE  id_user = '".$this->session->userdata('id')."' ORDER BY id desc LIMIT 5");				
		$dados['total_participantes_hj'] = $total_participantes_hj;		
		$dados['total_compras_hj'] = $total_compras_hj;		
		$dados['total_compras'] = $total_compras;		
		$dados['ticket_medio'] = $ticket_medio;		

		$dados['ticket_medio_hj'] = $ticket_medio_hj;		

		$dados['rifa_mais_vendida'] = $this->db->query("SELECT s.id, s.titulo, SUM(d.valor) as valor_total
										FROM sorteios as s
										INNER JOIN depositos as d ON s.id = d.id_sorteio
										WHERE s.id_user = ".$this->session->userdata('id')."
										GROUP BY s.id, s.titulo
										ORDER BY valor_total DESC")->row();

		#print_r($dados);

		*/

		

		#$qr_total_compras = $this->db->query("SELECT SUM(valor) as total FROM depositos WHERE  (id_cliente = '".$this->session->userdata('id')."' OR id_cliente = 6) AND status = 1 ORDER BY id desc");
		$qr_total_compras = $this->db->query("SELECT SUM(valor) as total FROM movimento WHERE  tipo = 'deposito' AND bonus = 0  AND status = 1 AND (dt BETWEEN '".$hj_ini."' AND '".$hj_fim."') ORDER BY id desc");

			#echo $qr_total_compras->row()->total;
			#return false;
		$qr_compras = $this->db->query("SELECT * FROM depositos WHERE  id_cliente = '".$this->session->userdata('id')."' AND status = 1 AND (dt_reg BETWEEN '".$hj_ini."' AND '".$hj_fim."') ORDER BY id desc");
		$total_compras = $qr_compras->num_rows();

		$total_compras_hj = $this->db->query("SELECT * FROM depositos WHERE  id_cliente = '".$this->session->userdata('id')."' AND status = 1 AND (dt_reg BETWEEN '".$hj_ini."' AND '".$hj_fim."') ")->num_rows();
		$total_compras_rasp = $this->db->query("SELECT * FROM premiacoes WHERE  id_user > 0 AND  hash_rasp IS NOT NULL AND (dt_update BETWEEN '".$hj_ini."' AND '".$hj_fim."')  ")->num_rows();

		$total_saques = $this->db->query("SELECT SUM(valor) as total FROM movimento WHERE  tipo = 'saque' AND (dt BETWEEN '".$hj_ini."' AND '".$hj_fim."') ");

		#$premios = $this->db->query("SELECT * FROM premiacoes WHERE  id_user > 0 AND  hash_rasp IS NOT NULL AND tipo_win = 1 ");
		$premios = $this->db->query("SELECT * FROM movimento WHERE  id_user > 0 AND  tipo = 'deposito'  AND status = 1 AND (dt BETWEEN '".$hj_ini."' AND '".$hj_fim."') ");

		$depositos = $this->db->query("SELECT * FROM depositos WHERE valor > 0 AND  (dt_reg BETWEEN '".$hj_ini."' AND '".$hj_fim."') ORDER BY id desc ");	

		$raspadinha = $this->db->query("SELECT * FROM raspadinhas WHERE  id = 1")->row();

		
		#echo $qr_total_compras->row()->total;
		#return false;

		$dados["dd"] = $dd;

		$dados['hj_ini'] = $hj_ini;
		$dados['hj_fim'] = $hj_fim;

		$dados['total_compras_hj'] = $total_compras_hj;		
		$dados['total_compras'] = $total_compras;		
		$dados['total_compras_rasp'] = $total_compras_rasp;				
		#echo $total_compras_rasp;
		#return false;
		
		$dados['valor_total_compras'] = $qr_total_compras->row()->total;		
		$dados['total_saques'] = $total_saques->row()->total;		

		$dados['premios'] = $premios;	
		$dados['depositos'] = $depositos;	
		$dados['raspadinha'] = $raspadinha;	


		$dados['total_depositos'] = $this->db->query("SELECT SUM(valor) as total FROM movimento WHERE  tipo = 'deposito' AND (dt BETWEEN '".$hj_ini."' AND '".$hj_fim."')")->row()->total;

		$dados['total_depositos_validados'] = $this->db->query("SELECT SUM(valor) as total FROM movimento WHERE  tipo = 'deposito' AND bonus = 0 AND (dt BETWEEN '".$hj_ini."' AND '".$hj_fim."')")->row()->total;


		$dados['total_saques'] = $this->db->query("SELECT SUM(valor) as total FROM movimento WHERE  tipo = 'saque' AND
		realizado = 1 AND (dt BETWEEN '".$hj_ini."' AND '".$hj_fim."')  ")->row()->total;	
		$dados['saldo_atual'] = $dados['total_depositos_validados'] - $dados['total_saques'];	


		#$this->load->view('adm/usuarios/dash', $dados);
		$this->load->view('adm/usuarios/dash2', $dados);

	}

	function extrato($tipo='all'){

		$hj_ini = date("Y-m-d")." 00:00:01";
		$hj_fim = date("Y-m-d")." 23:59:59";

		if(isset($_POST['de'])){
			$hj_ini = $this->input->post('de')." 00:00:01";
			$hj_fim = $this->input->post('ate')." 23:59:59";
		}
		
		if($tipo == "all"){
			$movs = $this->db->query("SELECT * FROM movimento WHERE valor > 0 AND  status = 1 AND (dt BETWEEN '".$hj_ini."' AND '".$hj_fim."') ORDER BY id desc LIMIT 500");	
		}

		if($tipo == "depositos"){
			#movs = $this->db->query("SELECT * FROM movimento WHERE valor > 0  status = 1 AND tipo = 'deposito' AND (dt BETWEEN '".$hj_ini."' AND '".$hj_fim."') ORDER BY id desc LIMIT 500");	
			$depositos = $this->db->query("SELECT * FROM depositos WHERE valor > 0 AND (dt_reg BETWEEN '".$hj_ini."' AND '".$hj_fim."') ");	
			$dados['depositos'] = $depositos;
		}

		if($tipo == "saques"){
			$movs = $this->db->query("SELECT * FROM movimento WHERE valor > 0 AND tipo = 'saque' AND (dt BETWEEN '".$hj_ini."' AND '".$hj_fim."') ORDER BY id desc LIMIT 500");	
		}

		$dados['hj_ini'] = $hj_ini;
		$dados['hj_fim'] = $hj_fim;

		#if($tipo == "depositos" || $tipo == "saques"){
		#$dados['total_depositos'] = $this->db->query("SELECT SUM(valor) as total FROM movimento WHERE  tipo = 'deposito'")->row()->total;	
		$dados['total_depositos'] = $this->db->query("SELECT SUM(valor) as total FROM depositos WHERE  status = '1' AND pago = 1 AND (dt_reg BETWEEN '".$hj_ini."' AND '".$hj_fim."') ")->row()->total;	

		$dados['total_saques'] = $this->db->query("SELECT SUM(valor) as total FROM movimento WHERE  tipo = 'saque' AND (dt BETWEEN '".$hj_ini."' AND '".$hj_fim."') ")->row()->total;	
		$dados['saldo_atual'] = $dados['total_depositos'] - $dados['total_saques'];	
		#}
		

		$dados['tipo'] = $tipo;	
		if($tipo != "depositos"){
			$dados['movs'] = $movs;	
		}
		#echo $movs->num_rows();
		#return false;

		$this->load->view('adm/usuarios/extrato', $dados);
	}

	function set_dep(){
		#print_r($_POST);
		$id_mov = $this->input->post('id_mov');
		$dd_up = [];

		$dd = $this->padrao_model->get_by_id($id_mov,'movimento')->row();

		if($dd->realizado == 0){ // pendente
			$dd_up['realizado'] = 1;
		} else{
			$dd_up['realizado'] = 0;
		}

		if(isset($_FILES['doc'])){

			$file = $_FILES['doc'];
    
		    // Verifica se houve algum erro no upload
		    if ($file['error'] !== UPLOAD_ERR_OK) {
		        echo 'Erro no upload do arquivo. Código de erro: ' . $file['error'];
		        exit;
		    }
		    
		    // Define o diretório de destino e o nome do arquivo
		    $uploadDir = 'docs/';
		    $uploadFile = $uploadDir . basename($file['name']);
		    
		    // Verifica se o diretório de destino existe, se não, cria-o
		    if (!is_dir($uploadDir)) {
		        mkdir($uploadDir, 0777, true);
		    }
		    
		    // Move o arquivo para o diretório de destino
		    if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
		        #echo 'Arquivo enviado com sucesso!';
		        $dd_up['doc'] = basename($file['name']);
		    } else {
		        echo 'Falha ao mover o arquivo para o diretório de destino.';
		    }

		} // x if isset doc

		$this->db->where('id' , $id_mov);
		$this->db->update('movimento' , $dd_up);
		redirect('adm/usuarios/extrato/saques');


	}

	function base(){

		$dd = $this->db->query("SELECT * FROM usuarios WHERE '".$this->session->userdata('id')."'")->row();		

		$dados["dd"] = $dd;
		$this->load->view('adm/usuarios/base', $dados);

	}

	function ajustes__(){

		$dd = $this->db->query("SELECT * FROM usuarios WHERE '".$this->session->userdata('id')."'")->row();		

		$dados["dd"] = $dd;
		$this->load->view('adm/usuarios/ajustes', $dados);

	}

	function redes($id_rasp=0){

		$dd = $this->db->query("SELECT * FROM usuarios WHERE '".$this->session->userdata('id')."'")->row();		

		$dados["dd"] = $dd;
		#if($id_rasp == 0){
			$dados["raspadinhas"] = $this->db->query("SELECT * FROM raspadinhas ORDER BY id desc ");
			#$this->load->view('adm/usuarios/raspadinhas', $dados);	
		#}else{
			#$qr_rasp = $this->db->query("SELECT * FROM raspadinhas WHERE id = $id_rasp ORDER BY id desc ");
			$qr_rasp = $this->db->query("SELECT * FROM raspadinhas  ORDER BY id desc LIMIT 1 ");
			#echo $qr_rasp->num_rows();
			#return false;
			if($qr_rasp->num_rows() > 0){
				#$dados["rasp"] = $this->db->query("SELECT * FROM raspadinhas WHERE id = $id_rasp ORDER BY id desc ")->row();	
				$dados["rasp"] = $qr_rasp->row();	
				$this->load->view('adm/usuarios/redes', $dados);
			}else{
				echo "Dados invalidos...";
			}
			
			#print_r($dados["rasp"]);
			
		#}
		

	} // x fn

	function faq(){

		$dd = $this->db->query("SELECT * FROM usuarios WHERE '".$this->session->userdata('id')."'")->row();		
		$qr_rasp = $this->db->query("SELECT * FROM raspadinhas ORDER BY id desc ");
		$dados["rasp"] = $qr_rasp->row();	
		$this->load->view('adm/usuarios/faq', $dados);

		

	} // x fn


	function videos(){

		$dd = $this->db->query("SELECT * FROM usuarios WHERE '".$this->session->userdata('id')."'")->row();		
		$qr_rasp = $this->db->query("SELECT * FROM raspadinhas ORDER BY id desc ");
		$dados["rasp"] = $qr_rasp->row();	
		$this->load->view('adm/usuarios/videos', $dados);

		

	} // x fn

	function ajustes($id_rasp=0){

		$dd = $this->db->query("SELECT * FROM usuarios WHERE '".$this->session->userdata('id')."'")->row();		

		$dados["dd"] = $dd;
		#if($id_rasp == 0){
			$dados["raspadinhas"] = $this->db->query("SELECT * FROM raspadinhas ORDER BY id desc ");
			#$this->load->view('adm/usuarios/raspadinhas', $dados);	
		#}else{
			#$qr_rasp = $this->db->query("SELECT * FROM raspadinhas WHERE id = $id_rasp ORDER BY id desc ");
			$qr_rasp = $this->db->query("SELECT * FROM raspadinhas  ORDER BY id desc LIMIT 1 ");
			#echo $qr_rasp->num_rows();
			#return false;
			if($qr_rasp->num_rows() > 0){
				#$dados["rasp"] = $this->db->query("SELECT * FROM raspadinhas WHERE id = $id_rasp ORDER BY id desc ")->row();	
				$dados["rasp"] = $qr_rasp->row();	
				$this->load->view('adm/usuarios/ajustes', $dados);
			}else{
				echo "Dados invalidos...";
			}
			
			#print_r($dados["rasp"]);
			
		#}
		

	} // x fn

	function set_campo_rasp(){
		#print_r($_POST);
		#return false;
		$id_rasp = $this->input->post('id_rasp');
		$dd_up = []; 
		
		if(isset($_POST['bonus_boas_vindas'])){

			if(strpos($_POST['bonus_boas_vindas'],",")){
				#echo "TEM";
				$preco_cota = str_replace("R$ ","",$_POST['bonus_boas_vindas']);
				$preco_cota = str_replace(".","",$preco_cota);
				$preco_cota = str_replace(",",".",$preco_cota);
			}else{
				#echo "N TEM";
				$preco_cota = str_replace("R$ ","",$_POST['bonus_boas_vindas']);
				$preco_cota = $preco_cota;
			}

			$dd_up['bonus_boas_vindas'] = $preco_cota;

		} // x if isset bonus_boas_vindas


		if(isset($_POST['bonus_recarga_diaria'])){

			if(strpos($_POST['bonus_recarga_diaria'],",")){
				#echo "TEM";
				$preco_cota = str_replace("R$ ","",$_POST['bonus_recarga_diaria']);
				$preco_cota = str_replace(".","",$preco_cota);
				$preco_cota = str_replace(",",".",$preco_cota);
			}else{
				#echo "N TEM";
				$preco_cota = str_replace("R$ ","",$_POST['bonus_recarga_diaria']);
				$preco_cota = $preco_cota;
			}

			$dd_up['bonus_recarga_diaria'] = $preco_cota;

		} // x if isset bonus_recarga_diaria



		if(isset($_POST['bonus_primeira_recarga'])){

			if(strpos($_POST['bonus_primeira_recarga'],",")){
				#echo "TEM";
				$preco_cota = str_replace("R$ ","",$_POST['bonus_primeira_recarga']);
				$preco_cota = str_replace(".","",$preco_cota);
				$preco_cota = str_replace(",",".",$preco_cota);
			}else{
				#echo "N TEM";
				$preco_cota = str_replace("R$ ","",$_POST['bonus_primeira_recarga']);
				$preco_cota = $preco_cota;
			}

			$dd_up['bonus_primeira_recarga'] = $preco_cota;

		} // x if isset bonus_primeira_recarga


		if(isset($_POST['preco_cota'])){

			if(strpos($_POST['preco_cota'],",")){
				#echo "TEM";
				$preco_cota = str_replace("R$ ","",$_POST['preco_cota']);
				$preco_cota = str_replace(".","",$preco_cota);
				$preco_cota = str_replace(",",".",$preco_cota);
			}else{
				#echo "N TEM";
				$preco_cota = str_replace("R$ ","",$_POST['preco_cota']);
				$preco_cota = $preco_cota;
			}

			$dd_up['preco_cota'] = $preco_cota;

		} // x if isset preco_cota


		// porcentagens_premios
		if(isset($_POST['porcentagens_premios'])){

			if(strpos($_POST['porcentagens_premios'],",")){
				#echo "TEM";
				$preco_cota = str_replace("% ","",$_POST['porcentagens_premios']);
				$preco_cota = str_replace(".","",$preco_cota);
				$preco_cota = str_replace(",",".",$preco_cota);
			}else{
				#echo "N TEM";
				$preco_cota = str_replace("% ","",$_POST['porcentagens_premios']);
				$preco_cota = $preco_cota;
			}

			$dd_up['porcentagens_premios'] = $preco_cota;

		} // x if isset porcentagens_premios


		// lucro_desejado
		if(isset($_POST['lucro_desejado'])){

			if(strpos($_POST['lucro_desejado'],",")){
				#echo "TEM";
				$preco_cota = str_replace("% ","",$_POST['lucro_desejado']);
				$preco_cota = str_replace(".","",$preco_cota);
				$preco_cota = str_replace(",",".",$preco_cota);
			}else{
				#echo "N TEM";
				$preco_cota = str_replace("% ","",$_POST['lucro_desejado']);
				$preco_cota = $preco_cota;
			}

			$dd_up['lucro_desejado'] = $preco_cota;

		} // x if isset lucro_desejado


		// api_mercado_pago
		if(isset($_POST['api_mercado_pago'])){

			if(strpos($_POST['api_mercado_pago'],",")){
				#echo "TEM";
				$preco_cota = str_replace("% ","",$_POST['api_mercado_pago']);
				$preco_cota = str_replace(".","",$preco_cota);
				$preco_cota = str_replace(",",".",$preco_cota);
			}else{
				#echo "N TEM";
				$preco_cota = str_replace("% ","",$_POST['api_mercado_pago']);
				$preco_cota = $preco_cota;
			}

			$dd_up['api_mercado_pago'] = $preco_cota;

		} // x if isset api_mercado_pago


		// pixel_facebook
		if(isset($_POST['pixel_facebook'])){
			$pixel_facebook = $_POST['pixel_facebook'];
			$dd_up['pixel_facebook'] = $pixel_facebook;
		} // x if isset api_mercado_pago



		// links
		$red_link = "";
		if(isset($_POST['link_instagram'])){
			$red_link = "red_link";
			$link_instagram = $_POST['link_instagram'];
			$dd_up['link_instagram'] = $link_instagram;
		} // x if isset

		if(isset($_POST['link_whatsapp'])){
			$red_link = "red_link";
			$link_whatsapp = $_POST['link_whatsapp'];
			$dd_up['link_whatsapp'] = $link_whatsapp;
		} // x if isset

		if(isset($_POST['link_telegram'])){
			$red_link = "red_link";
			$link_telegram = $_POST['link_telegram'];
			$dd_up['link_telegram'] = $link_telegram;
		} // x if isset 





		
		$this->db->where('id', $id_rasp);
		$this->db->update('raspadinhas' , $dd_up);
		if($red_link == "red_link"){
			redirect('adm/usuarios/redes/'.$id_rasp);
		}else{
			redirect('adm/usuarios/ajustes/'.$id_rasp);	
		}
		

	} // x fn

	function set_credito_user($tipo=1){
		$q = $this->input->post('q');
		$valor = $this->input->post('valor');
		$voltar = " <a href='".base_url()."adm/usuarios/ajustes'> VOLTAR </a>";

		$preco_cota = str_replace("R$ ","",$valor);
		$preco_cota = str_replace(".","",$preco_cota);
		$preco_cota = str_replace(",",".",$preco_cota);

		$qr_user = $this->db->query("SELECT * FROM usuarios WHERE nome LIKE '%".$q."%' OR cpf LIKE '%".$q."%' OR email LIKE '%".$q."%' ");
		echo "Existem ".$qr_user->num_rows()." usuários encontrados com esse filtro <strong>".$q."</strong> <br> ";
		if($qr_user->num_rows() > 1){
			echo "Existem ".$qr_user->num_rows()." usuários encontrados com esse filtro <strong>".$q."</strong> ".$voltar;
			
			#echo "<br>";
			#print_r($_POST);			
			return false;
		}

		if($qr_user->num_rows() == 1){
			$dd_user = $qr_user->row();

			## ENVIA SALDO
			$valor_depositado = round($preco_cota,2);

			$dd_mov = array(
	    		'id_user_mov' => 1,
	    		#'id_user_mov' => ID_USER,
	    		'id_user' => $dd_user->id,
	    		'data_hora_pagamento' => date("Y-m-d H:i:s"),
	    		'valor' => $valor_depositado,
	    		'tipo' => 'deposito',
	    		'descricao' => "Deposito via ADM de $valor_depositado às ".date("Y-m-d H:i:s")."  ",
	    		'status' => 1,
	    		'bonus' => $tipo,
	    		'wallet' => "bonus",
	    		'hash' => md5("ADM"),
	    		'realizado' => 0
	    	);

	    	#print_r($dd_mov);
	    	#return false;			
			## LIBERA INSERÇÃO DE SALDO
	    	$this->db->insert('movimento' , $dd_mov); // add saldo


			echo "Enviado para ".$dd_user->nome." - R$ ".$valor_depositado." ".$voltar;
		}
		
	}


	function raspadinhas($id_rasp=0){

		$dd = $this->db->query("SELECT * FROM usuarios WHERE '".$this->session->userdata('id')."'")->row();		

		$dados["dd"] = $dd;
		if($id_rasp == 0){
			$dados["raspadinhas"] = $this->db->query("SELECT * FROM raspadinhas ORDER BY id desc ");
			$this->load->view('adm/usuarios/raspadinhas', $dados);	
		}else{
			$dados["rasp"] = $this->db->query("SELECT * FROM raspadinhas WHERE id = $id_rasp ORDER BY id desc ")->row();
			print_r($dados["rasp"]);
			#$this->load->view('adm/usuarios/ajustes', $dados);
		}
		

	}




	// function sorteios(){

	// 	$dd = $this->db->query("SELECT * FROM usuarios WHERE '".$this->session->userdata('id')."'")->row();		

	// 	$dados["dd"] = $dd;
	// 	$this->load->view('adm/usuarios/sorteios', $dados);

	// }

	function rel($nivel=3){
		//echo "teste";
		$this->load->model('padrao_model');
		$this->load->model('adm/usuarios_model');
		$dados['nivel'] = $nivel;
		if($this->session->userdata('nivel') > 1) {
			$dados["usuarios"] = $this->db->query("SELECT * FROM usuarios WHERE nivel = $nivel AND id_user = ".$this->session->userdata('id')." ORDER BY id desc ");
		}else{
			$dados["usuarios"] = $this->db->query("SELECT * FROM usuarios WHERE nivel = $nivel ORDER BY id desc");
		}


		$hj_ini = date("Y-m-d")." 00:00:01";
		$hj_fim = date("Y-m-d")." 23:59:59";

		if(isset($_POST['de'])){
			$hj_ini = $this->input->post('de')." 00:00:01";
			$hj_fim = $this->input->post('ate')." 23:59:59";

			$usuarios = $this->db->query("SELECT * FROM usuarios WHERE (nivel = $nivel ) AND (dt_cadastro BETWEEN '".$hj_ini."' AND '".$hj_fim."') ORDER BY id desc LIMIT 500");	
			$dados["usuarios"] = $usuarios;

			#echo "FILTRO<br>";
			#echo $usuarios->num_rows();
			#return false;
		}
		

		$usuarios_total = $this->db->query("SELECT COUNT(id) AS total FROM usuarios WHERE nivel = 3")->row()->total;
		$usuarios_ativos = $this->db->query("SELECT COUNT(DISTINCT(id_user)) AS total FROM premiacoes")->row()->total;
		$usuarios_inativos = $usuarios_total - $usuarios_ativos;

		$dados["usuarios_total"] = $usuarios_total;
		$dados["usuarios_ativos"] = $usuarios_ativos;
		$dados["usuarios_inativos"] = $usuarios_inativos;
		
			
		


		if($this->session->userdata('nivel') == 7){
			#$dados["usuarios"] = $this->db->query("SELECT * FROM usuarios WHERE id_prestador = ".$this->session->userdata('id')." AND nivel = $nivel ");
		}


		if($nivel == 3){


			if(isset($_POST['q'])){
				$where = "";

				if(isset($_POST['q'])){
					$q = $this->input->post('q');
					if($q != ""){
						$where .= " AND (nome LIKE '%".$q."%' OR email LIKE '%".$q."%' OR telefone LIKE '%".$q."%' )";
					}
				}


				// if(isset($_POST['status'])){
				// 	$status = $this->input->post('status');
				// 	if($status != "0"){
				// 		$where .= "status = ".$status." ";
				// 	}
				// }
				$qr = "SELECT * FROM usuarios WHERE  id > 0  ".$where." ";
				$usuarios = $this->db->query($qr);
				#echo $usuarios->num_rows();
				#return false;
				$dados["usuarios"] = $usuarios;

				echo "FILTRO Q <br>";
				echo $usuarios->num_rows();
				return false;
			}
			#echo $qr;
			#print_r($dados["usuarios"]);
			#return false;

			#$this->load->view('adm/usuarios/compradores', $dados);	
			#echo "<br>";
			#print_r($_POST);
			#echo "<br>";
			#echo $usuarios->num_rows();
			#return false;


			$this->load->view('adm/usuarios/relatorio', $dados);	
		}else{
			#$this->load->view('adm/usuarios/lista', $dados);		
			$this->load->view('adm/usuarios/relatorio', $dados);	
		}
		
		
		
		

	}

	function get_user($id_user){
		$this->db->where('id',$id_user);
		$qr = $this->db->get('usuarios');
		if($qr->num_rows() == 0){
			echo 0;
		}else{
			$this->load->model('adm/usuarios_model');
			$dd = $qr->row();
			$conteudo  = "";
			$saldo = $this->usuarios_model->saldo($dd->id,0);
			$conteudo  .= "
			<div class='row'>
				<div class='col-4'><strong>Nome</strong>:<br>".$dd->nome."</div>
				<div class='col-4'><strong>CPF</strong>:<br>".$dd->cpf."</div>
				<div class='col-4'><strong>Telefone</strong>:<br>".$dd->telefone."</div>
			</div>
			<br>
			<div class='row'>
				
				<div class='col-4'><strong>Saldo Real</strong>:<br> R$".$saldo."</div>
				<div class='col-4'><strong>Saldo Bônus</strong>:<br> R$ ".$saldo."</div>
				<div class='col-4' ><strong>Cadastro</strong>:<br>".$dd->dt_cadastro."</div>
				
			</div>";
			echo $conteudo;

			#echo json_encode($dd);
		}
	}

	function get_mov($id_mov){

		#$this->db->where('id',$id_mov);
		#$qr = $this->db->get('movimento');
		$qr = $this->db->query("
			SELECT m.id, m.id_user, m.valor, m.tipo, m.status, u.nome, u.chave_pix, u.tipo_chave_pix FROM movimento as m
			INNER JOIN usuarios AS u ON u.id = m.id_user_mov
			WHERE m.id = ".$id_mov."
			");
		if($qr->num_rows() == 0){
			echo 0;
		}else{
			$dd = $qr->row();
			echo json_encode($dd);
		}

	} // x fn

	function parametros(){
		
		$dados['parametros'] = $this->padrao_model->get_by_matriz('id_user',$this->session->userdata('id'),'usuarios_parametros')->row();

		#$parametros_bts = $this->padrao_model->get_by_matriz('id_user',$this->session->userdata('id'),'usuarios_parametros_bts');
		$parametros_bts = $this->db->query("SELECT * FROM usuarios_parametros_bts WHERE   id_user =  '".$this->session->userdata('id')."' ORDER BY numero asc ");
		$dados['parametros_bts'] = $parametros_bts;

		#echo $this->session->userdata('id')." - ".$parametros_bts->num_rows();

		if($parametros_bts->num_rows() == 0){
			for($b=1; $b<7; $b++){
				$bt[$b] = "";
			}
		}else{
			$b = 0;
			foreach($parametros_bts->result() as $dd_bt){ $b++;
				$bt[$b] = $dd_bt->numero;
			}


		}

		$dados['bt'] = $bt;

		#print_r($bt);
		#return false;



		$this->load->view('adm/usuarios/parametros' , $dados);
	}

	function set_parametros(){

		if ($_POST) {		

			#print_r($_POST);
			#return false;

			if(isset($_POST['nm_bts'])){
				$n = 0;
				$this->db->where('id_user',$this->session->userdata('id'));
				$this->db->delete('usuarios_parametros_bts');

				foreach($_POST['nm_bts'] as $n_bt){
					#echo $n_bt;
					#echo "<br>";

					$this->db->where('id_user',$this->session->userdata('id'));
					$this->db->where('numero',$n_bt);
					$qr_param = $this->db->get("usuarios_parametros_bts");
					if($qr_param->num_rows() == 0){
						$dd_bt = [
							'id_user' => $this->session->userdata('id'),
							'numero' => $n_bt
						];
						$this->db->insert('usuarios_parametros_bts', $dd_bt);
					}else{
						$this->db->where('id_user',$this->session->userdata('id'));
						$this->db->update('usuarios_parametros_bts', $dd);

					}


				} // x foreach
			}
			#return false;

			// $valor_a_pagar = $this->input->post('valor_a_pagar');			

			// if(strpos($valor_a_pagar,",")){
			// 	#echo "TEM";
			// 	$valor = str_replace("R$ ","",$valor_a_pagar);
			// 	$valor = str_replace(".","",$valor);
			// 	$valor = str_replace(",",".",$valor);
			// }else{
			// 	#echo "N TEM";
			// 	$valor = str_replace("R$ ","",$_POST['valor']);
			// 	$valor = $valor;
			// }

			$dd = array(
					
					
					'id_user' => $this->session->userdata('id'),

					'nome_site' => $this->input->post('nome_site'),
					'descricao_site' => $this->input->post('descricao_site'),
					'pixel_facebook' => $this->input->post('pixel_facebook'),
					'token_facebook' => $this->input->post('token_facebook'),
					'google_analytics' => $this->input->post('google_analytics'),
					'link_suporte_whatsapp' => $this->input->post('link_suporte_whatsapp'),

					'api_mp' => $this->input->post('api_mercado_pago'),


					'tit_promocao' => $this->input->post('tit_promocao'),
					'subtit_promocao' => $this->input->post('subtit_promocao'),
					'tit_cotas' => $this->input->post('tit_cotas'),
					'subtit_cotas' => $this->input->post('subtit_cotas'),
					'ver_numeros' => $this->input->post('ver_numeros'),
					'subtit_numeros' => $this->input->post('subtit_numeros'),


					'numero_inicial' => $this->input->post('numero_inicial'),
					#'tit_valor_a_pagar' => $this->input->post('tit_valor_a_pagar'),
					#'valor_a_pagar' => $valor,
					'link_whatsapp' => $this->input->post('link_whatsapp'),
					'link_telegram' => $this->input->post('link_telegram')					
			);



			
			$this->db->where('id_user',$this->session->userdata('id'));
			$qr_param = $this->db->get("usuarios_parametros");
			if($qr_param->num_rows() == 0){
				$this->db->insert('usuarios_parametros', $dd);
			}else{
				$this->db->where('id_user',$this->session->userdata('id'));
				$this->db->update('usuarios_parametros', $dd);

			}
								
			redirect('adm/usuarios/parametros/','refresh');
			
		}

	} // x fn set_parametro

	function set_parametros_front(){

		if ($_POST) {		

			#print_r($_POST);
			#return false;

			


			$dd = array(
					
					
					'id_user' => $this->session->userdata('id'),

					'qtd_ultimos_sorteios' => $_POST['qtd_ultimos_sorteios'],
					'titulo_ganhadores' => $_POST['titulo_ganhadores'],
					'subtitulo_ganhadores' => $_POST['subtitulo_ganhadores'],
					'qtd_numeros_ganhadores' => $_POST['qtd_numeros_ganhadores'],
					'link_whatsapp' => $_POST['link_whatsapp'],
					'link_telegram' => $_POST['link_telegram']					
			);

			if (isset($_POST['imagem'])) {
				#$dd['img'] = $_POST['imagem'];
			}

			if (isset($_POST['imagem'])) {
				#$dd['img'] = $_POST['imagem'];
			}

			$dd['cad_cpf'] = 0;
			if (isset($_POST['cad_cpf'])) {
				$dd['cad_cpf'] = 1;
			}

			$dd['cad_dt_nascimento'] = 0;
			if (isset($_POST['cad_dt_nascimento'])) {
				$dd['cad_dt_nascimento'] = 1;
			}

			#print_r($_POST);
			#return false;

			
			$this->db->where('id_user',$this->session->userdata('id'));
			$qr_param = $this->db->get("usuarios_parametros");
			if($qr_param->num_rows() == 0){
				$this->db->insert('usuarios_parametros', $dd);
			}else{
				$this->db->where('id_user',$this->session->userdata('id'));
				$this->db->update('usuarios_parametros', $dd);

			}
								
			redirect('adm/usuarios/parametros/','refresh');
			
		}

	} // x fn set_parametro

function novo($id_setor=0){
	//echo "teste";
	#if ($this->session->userdata('nivel') > 2) {
		$this->load->model('padrao_model');
		$dados['id_setor'] = $id_setor;
		$dados['niveis'] = $this->db->get('usuarios_niveis');
		#$dados['setores'] = $this->padrao_model->get_qr('usuarios_setores');
		#$dados['unidades'] = $this->db->get('unidades');
		$this->load->view('adm/usuarios/novo' , $dados);
	#} else {
	#	echo "Você não tem permissão para acessar esta página";	
	#}
}

#################################  CHATBOT WHATS


function upImgPost(){
	//echo "teste";
		##################### X IMAGENS #########################
		
		//upload codeigniter lib
		$config['upload_path'] = './imagens/usuarios/';
		$config['allowed_types'] = 'jpg|jpeg|gif|png';
	  	$this->load->library('upload', $config);

		
		if (!$this->upload->do_upload('photoimg')) {
			$status = 'error';
			$error = array('error' => $this->upload->display_errors());
			$msg = 'erro ao enviar o arquivo, tente novamente'.$error;
			echo $msg;
			print_r($error);
		} else  {
			$data = $this->upload->data();
		 
			$this->load->library('image_lib');
			
			//alterando img principal
			$conf['image_library'] = 'gd2';
			$conf['source_image'] = './imagens/usuarios/'.$data['file_name'];
			$conf['new_image'] = './imagens/usuarios/min/'.$data['file_name'];
			$conf['maintain_ratio'] = FALSE;
			//$conf['master_dim'] = 'height';
			$conf['height'] = 72;
			$conf['width'] = 120;
			$this->image_lib->initialize($conf); 
			$this->image_lib->resize();
			
			$conf2['image_library'] = 'gd2';
			$conf2['source_image'] = './imagens/usuarios/'.$data['file_name'];
			$conf2['new_image'] = './imagens/usuarios/des/'.$data['file_name'];
			$conf2['maintain_ratio'] = FALSE;
			//$conf['master_dim'] = 'height';
			$conf2['height'] = 210;
			$conf2['width'] = 300;
			$this->image_lib->initialize($conf2); 
			$this->image_lib->resize();
			
			echo "<img src='".base_url()."imagens/usuarios/min/".$data['file_name']."'>
					<input name='imagem' type='hidden' value='".$data['file_name']."'>";
		}


	}

function cadastrar(){
	$this->load->model('adm/usuarios_model');
	

	if ($_POST) {
		


			$dd = array(
					
					'nome' => $_POST['nome'],
					'nome_empresa' => $_POST['nome_empresa'],
					'id_user' => $this->session->userdata('id'),
					'telefone' => $_POST['telefone'],
					'whatsapp' => $_POST['whatsapp'],
					
					'nivel' => $_POST['nivel'],
					'apresentacao' => $_POST['apresentacao'],


					// 'numero' => $_POST['numero'],
					// 'bairro' => $_POST['bairro'],
					// 'cidade' => $_POST['cidade'],
					// 'uf' => $_POST['uf'],
					// 'complemento' => $_POST['email'],
					// 'cep' => $_POST['cep'],
					// 'redes_sociais' => $_POST['redes_sociais'],
					'nivel' => $_POST['nivel']
		);
		if (isset($_POST['imagem'])) {
			$dd['img'] = $_POST['imagem'];
		}

		if($_POST['nivel'] == "2"){
			$dd['email'] = $_POST['email'];
			$dd['senha'] = $_POST['senha'];
		}

		if($_POST['nivel'] == "7"){
			#$dd['site'] = $_POST['site'];
			#$dd['nome_empresa'] = $_POST['nome_empresa'];
			#$dd['id_prestador'] = $this->session->userdata('id');			
		}

		if($_POST['nivel'] == "2"){ // nivel indicacao
			$dd['id_user'] = $this->session->userdata('id');
		}

		if($this->session->userdata('nivel') == 7){
			$dd['id_prestador'] = $this->session->userdata('id');
		}

		

				
		if ($this->db->insert('usuarios', $dd)) {
			#return true;
			$id_new = $this->db->insert_id();

			if($_POST['nivel'] == "2"){
				$dd_param = [
					'id_user' => $id_new,
					'link_whatsapp' => $this->input->post('link_whatsapp'),
					'link_telegram' => $this->input->post('link_telegram')
				];
				$this->db->insert('usuarios_parametros' , $dd_param);
			}


			#redirect('adm/usuarios/edicao/'.$id_new,'refresh');
			redirect('adm/usuarios/rel/'.$_POST['nivel'],'refresh');
		} else {
			return false;	
		}




		redirect('adm/usuarios/rel/'.$_POST['nivel']); 
			
		
	}

}

function edicao($id){
	#$dados['niveis'] = $this->db->get('usuarios_niveis');
	#$dados['setores'] = $this->db->get('usuarios_setores');
	#$dados['unidades'] = $this->db->get('unidades');
	if($this->session->userdata('nivel') != "1" AND $id != $this->session->userdata('id') AND $this->session->userdata('nivel') != "7" ){
		redirect('adm/usuarios/edicao/'.$this->session->userdata('id'),'refresh');
	}
	$this->load->model('padrao_model');
	$dados["usuario"] = $this->db->query("SELECT * FROM usuarios WHERE id = ".$id)->row();

	#$dados["exames"] = $this->db->query("SELECT * FROM exames ORDER BY nome asc ");
	#$dados["consultas"] = $this->db->query("SELECT * FROM consultas ORDER BY nome asc");
	#$dados["procedimentos"] = $this->db->query("SELECT * FROM procedimentos ORDER BY nome asc");

	
	
	if($this->session->userdata('nivel') == 2){
		$this->load->view('adm/representantes/edicao_dados', $dados);	
		#$this->load->view('adm/representantes/dados', $dados);	
	}else{
		$this->load->view('adm/usuarios/edicao', $dados);	
	}

}



function alterarSenha($msg=''){
	
	$this->db->where('id', $this->session->userdata('id'));
	$dados["usuario"] = $this->db->get('usuarios')->row();
	
	$dados["msg"] = $msg;	
	if($this->session->userdata('nivel') == 2){
		$this->load->view('adm/representantes/edicao_dados', $dados);
	}else{
		$this->load->view('adm/usuarios/alterar_senha', $dados);
	}

}

function alterar(){
	$id = $this->session->userdata('id');
	$senha = $_POST['senha'];
	#$qry = $this->db->query("SELECT * FROM usuarios WHERE id = ".$id." AND senha = '".$senha."'");
	$qry = $this->db->query("SELECT * FROM usuarios WHERE id = ".$id." ");
	#echo $qry->num_rows();
	#echo "<br>"; 
	#print_r($_POST);
	#return false;
	if ($qry->num_rows() > 0) {
		
		$dd = array('senha' => $_POST["nova_senha"]);

		$this->db->where('id', $this->session->userdata('id'));
		$this->db->update('usuarios', $dd);
		
		$this->alterarSenha('Senha altearada com sucesso');
		
	} else {
		
		$this->alterarSenha('Senha Incorreta');
		
	}
}





function editar() {
	
	$dd = array(
				#'id_setor' => $_POST['id_setor'],
					'nome' => $_POST['nome'],
					'id_user' => $_POST['id_user'],
					'telefone' => $_POST['telefone'],
					'profissao' => $_POST['profissao'],
					'rg' => $_POST['identidade'],
					'cpf' => $_POST['cpf'],
					'login' => $_POST['login'],
					#'senha' => md5($_POST['senha']),
					'email' => $_POST['email'],
					#'id_setor' => $_POST['id_setor'],
					'nivel' => $_POST['nivel'],

					'endereco' => $_POST['endereco'],
					'numero' => $_POST['numero'],
					'bairro' => $_POST['bairro'],
					'cidade' => $_POST['cidade'],
					'uf' => $_POST['uf'],
					'complemento' => $_POST['email'],
					'cep' => $_POST['cep'],
					'redes_sociais' => $_POST['redes_sociais']
					
	);
	if($_POST['nivel'] == 7){ // prestador
		$dd['site'] = $_POST['site'];
		$dd['forma_pagamento'] = $_POST['forma_pagamento'];
		$dd['nome_empresa'] = $_POST['nome_empresa'];
		$dd['apresentacao'] = $_POST['apresentacao'];


		#$dd['banco'] = $_POST['banco'];
		#$dd['agencia'] = $_POST['agencia'];
		#$dd['conta'] = $_POST['conta'];
	}

	if($_POST['nivel'] == 1){ // ADM
		$dd['apresentacao'] = $_POST['apresentacao'];
	}

	if(isset($_POST['responsavel_tecnico'])){
		$dd['responsavel_tecnico'] = $_POST['responsavel_tecnico'];
	}

	if(isset($_POST['atendente'])){
		$dd['atendente'] = $_POST['atendente'];
	}

	$this->db->where('id', $_POST['id']);

	$dd_user = $this->db->get('usuarios')->row();

	#print_r($dd_user);
	#return false;
	

	if (isset($_POST['imagem'])) {
		$dd['img'] = $_POST['imagem'];
	}

	if (isset($_POST['assinatura'])) {
		$dd['assinatura'] = $_POST['assinatura'];
	}

	if (isset($_POST['qrcode'])) {
		$dd['qrcode'] = $_POST['qrcode'];
	}

	// Login e senha
	if(isset($_POST['login']) || isset($_POST['senha'])){
		$login = $this->input->post('login');
		$senha = $this->input->post('senha');
		if($login != $dd_user->login){
			$dd['login'] = $login;
		}
		if($senha != $dd_user->senha){
			$dd['senha'] = $senha;
		}
	}



	// x login e senha




	$this->db->where('id', $_POST['id']);	
	if ($this->db->update('usuarios', $dd)) {


		// parceiros
		$this->set_imagens($_POST['id']);



		#$this->Index();
		redirect('adm/usuarios/edicao/'.$_POST['id']);
	} else {
		echo "Falha ao alterar usuario!";	
	}
	
}



 // IMAGEM DE PARCEIROS
function set_imagens($id_usuario){
		
		$img_str = $_FILES['img1']['name'];
		$strs = explode(".",$img_str);
		$ext = $strs[1]; 
		#print_r( $strs);
				

		$pasta = "usuarios_parceiros";
		
		
		
		#$nm_img = url_title($nome).".".$ext; // remove o acento do nome da galeria para poder colocar o nome na imagem	
		
		
		
		//upload codeigniter lib

		$config['upload_path'] = "./imagens/$pasta/";
		$config['allowed_types'] = 'jpg|jpeg|gif|png';
	  	$this->load->library('upload', $config);
		
		#echo $pasta;
		#return false;
		#echo $this->upload->do_upload('img1');
		#return false;
		#echo $config['upload_path'];
		if (!$this->upload->do_upload('img1')) {
		#if (!isset($_FILES['img1'])) {

			$status = 'error';

			$error = array('error' => $this->upload->display_errors());

			$msg = 'erro ao enviar o arquivo, tente novamente'.$error;

			#echo $msg;

			#print_r($error);
	
			
			
			

		} else  {

			$data = $this->upload->data();
			$name = pathinfo($data['file_name'], PATHINFO_FILENAME);
			$ext = pathinfo($data['file_name'], PATHINFO_EXTENSION);
			$this->load->library('image_lib');
			
			

			//alterando img principal

			$conf['image_library'] = 'gd2';

			$conf['source_image'] = "./imagens/".$pasta."/".$data['file_name'];

			$conf['new_image'] = "./imagens/".$pasta."/mini/".$name.".".$ext;

			$conf['maintain_ratio'] = FALSE;

			//$conf['master_dim'] = 'height';
			if($pasta == 'banners'){
				$conf['height'] = 245;
				$conf['width'] = 290;
			}else{
				$conf['height'] = 92;
				$conf['width'] = 140;
			}
			$this->image_lib->initialize($conf); 

			$this->image_lib->resize();

			

			$conf2['image_library'] = 'gd2';

			$conf2['source_image'] = "./imagens/".$pasta."/".$data['file_name'];

			$conf2['new_image'] = "./imagens/".$pasta."/rel/".$name.".".$ext;

			$conf2['maintain_ratio'] = TRUE;

			//$conf['master_dim'] = 'height';

			#if($pasta == 'banners'){
				#$conf['height'] = 245;
				#$conf['width'] = 290;
			#}else{
				$conf['height'] = 340;
				$conf['width'] = 1089;
			#}

			$this->image_lib->initialize($conf2); 

			$this->image_lib->resize();

			

			## DB
			if ($this->upload->do_upload('img1') == '1') {
				$dd_img = array('id_usuario' => $id_usuario , 'img' => $name.".".$ext , 'img_grande' => $pasta);	
				#$this->db->where('id',$id_tit);	
				$this->db->insert('usuarios_parceiros' , $dd_img);
			}
			
			#echo "Opa 7";
			#print_r($_FILES['img1']);
			#echo "<br>";
			#echo $pasta.' - '.$nm_img;
	
			#return false;	

		}

		##################### X IMAGENS #########################

		

		

		

	} // x fn	


	function del_img($id_usuarios,$id_img){
		$this->db->where('id',$id_img);
		$this->db->delete('usuarios_parceiros');
		redirect('adm/usuarios/edicao/'.$id_usuarios,'refresh');
	}



// X IMAGEM DE PARCEIROS

###################################################### CONFIGURAÇÕES GERAIS DO BACKOFFICE

// PERGUNTAS FREQUENTES

function perguntas_frequentes(){

		$this->load->model('padrao_model');		
		$dados['niveis'] = $this->db->get('usuarios_niveis');

		$dados['perguntas'] = $this->db->query("SELECT * FROM perguntas_frequentes WHERE id_user = ".$this->session->userdata('id')." ");
		
		$this->load->view('adm/usuarios/perguntas-frequentes' , $dados);

}

function set_pergunta(){
	#print_r($_POST);
	$pergunta = $this->input->post('pergunta');
	$resposta = $this->input->post('resposta');

	$dd_set = [
		'id_user' => $this->session->userdata('id'),
		'pergunta' => $pergunta,
		'resposta' => $resposta,
		'ordem' => 100
	];
	$this->db->insert('perguntas_frequentes' , $dd_set);

	redirect('adm/usuarios/perguntas_frequentes');
}

function rem_perg($id_pergunta){
	$this->db->where('id',$id_pergunta);
	$this->db->where('id_user',$this->session->userdata('id'));
	$this->db->delete('perguntas_frequentes');
	redirect('adm/usuarios/perguntas_frequentes');
}

// X PERGUNTAS FRQUENTES


// COMUNICADOS

function comunicados(){
	

	$this->load->model('padrao_model');		
	$dados['niveis'] = $this->db->get('usuarios_niveis');
	
	$dados['comunicados'] = $this->db->query("SELECT * FROM comunicados WHERE id_user = ".$this->session->userdata('id')." ");

	$this->load->view('adm/usuarios/comunicados' , $dados);
	

}

function set_comunicado(){
	#print_r($_POST);
	$titulo = $this->input->post('titulo');
	$descricao = $this->input->post('descricao');

	$dd_set = [
		'id_user' => $this->session->userdata('id'),
		'titulo' => $titulo,
		'descricao' => $descricao,
		'ordem' => 100
	];
	$this->db->insert('comunicados' , $dd_set);

	redirect('adm/usuarios/comunicados');
}

function rem_comunicado($id_comunicado){
	$this->db->where('id',$id_comunicado);
	$this->db->where('id_user',$this->session->userdata('id'));
	$this->db->delete('comunicados');
	redirect('adm/usuarios/comunicados');
}

// X COMUNICADOS


function termos(){
	$id = $this->session->userdata('id');
	$dados["usuario"] = $this->db->query("SELECT * FROM usuarios WHERE id = ".$id)->row();
	
	$this->load->view('adm/usuarios/termos' , $dados);

}

function set_termo(){
	#print_r($_POST);
	$termo = $this->input->post('termo');

	$dd_set = [
		'termo' => $termo,
	];

	$this->db->where('id',$this->session->userdata('id'));
	$this->db->update('usuarios' , $dd_set);

	redirect('adm/usuarios/termos');
}

function certificado(){
	$id = $this->session->userdata('id');
	$dados["usuario"] = $this->db->query("SELECT * FROM usuarios WHERE id = ".$id)->row();
	
	$this->load->view('adm/usuarios/certificado' , $dados);

}

function set_certificado(){
	#print_r($_POST);
	$certificado = $this->input->post('certificado');

	$dd_set = [
		'certificado' => $certificado,
	];

	$this->db->where('id',$this->session->userdata('id'));
	$this->db->update('usuarios' , $dd_set);

	redirect('adm/usuarios/certificado');
}


function redes____(){
	$id = $this->session->userdata('id');
	$dados["usuario"] = $this->db->query("SELECT * FROM usuarios WHERE id = ".$id)->row();
	
	#print_r($dados["usuario"]);
	#return false;

	$this->load->view('adm/usuarios/redes-sociais' , $dados);

}

function set_redes(){
	#print_r($_POST);
	#return false;
	$instagram = $this->input->post('instagram');
	$facebook = $this->input->post('facebook');
	$twitter = $this->input->post('twitter');

	$dd_set = [
		'instagram' => $instagram,
		'facebook' => $facebook,
		'twitter' => $twitter,
	];

	$this->db->where('id',$this->session->userdata('id'));
	$this->db->update('usuarios' , $dd_set);

	redirect('adm/usuarios/redes');
}

###################################################### XXXXXXXXX CONFIGURAÇÕES GERAIS DO BACKOFFICE


function remover($id){
	
	$this->db->where('id', $id);
	$qr_dd = $this->db->get('usuarios');
	$id_nivel = $qr_dd->row()->nivel;

	$this->db->where('id', $id);
	$this->db->delete('usuarios');

	redirect('adm/usuarios/rel/'.$id_nivel);
	#$this->Index();


}

function rand_cotas(){
	
	$decimais = 6;
	$numero_sorteado = rand(000000, 999999);		
	$n = $numero_sorteado;
	$len = strlen($n);
	$zeros = $decimais - $len;
	if($decimais > $len){
		$zrs = "";
		for($z=1; $z<$zeros+1; $z++){
			$zrs .= "0";
		}
		$numero = $zrs.$n;
	}else{
		$numero = $n;
	}
	echo $numero;
	
}


function logout(){
	$this->session->sess_destroy();
	redirect('admin','refresh');
}


}

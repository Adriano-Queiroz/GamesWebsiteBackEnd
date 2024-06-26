<?php
class Usuarios_model extends CI_Model{	
	
	function _construct()
	{
		// Call the Model constructor
		parent::_construct();
	}

	function logar(){
		echo "!Aswdasd";
		return false;
	
		$login = $this->input->post('login');
		$id_inventario = $this->input->post('id_inventario');
		//$senha = $_POST['senha'];
		$senha = $this->input->post('senha');
		$this->db->where(array('login' => $login, 'senha' => $senha));
		$qr_login = $this->db->get('usuarios');
		#print_r($_POST);
		#echo "<br>";
		#echo $qr_login->num_rows();
		#return false;
	
		if($qr_login->num_rows() > 0){
			$dd_user = $qr_login->row();
			$dd_session = array(
								'usr' => true,
								'id' => $dd_user->id,
								'nome' => $dd_user->nome,
								'nivel' => $dd_user->nivel,
								'login' => $login
								);
								$this->session->set_userdata($dd_session);
			#redirect('index.php/adm/home');
		if ($this->session->userdata('nivel') == 1 || $this->session->userdata('nivel') == 4 || $this->session->userdata('nivel') == 3 ) {								
			redirect('adm/os/marcar/','refresh');
		}
		if ($this->session->userdata('nivel') == 7) {		
			redirect('adm/os/marcar/1','refresh');
		}

		if ($this->session->userdata('nivel') == 2) {		
			redirect('adm/representantes/marcar_os/0','refresh');
		}

		

		if ($this->session->userdata('nivel') == 8) {		
			redirect('adm/contabilidade/balanco','refresh');
		}

		if ($this->session->userdata('nivel') == 1){
			redirect('adm/home','refresh');
		}
		
		if ($this->session->userdata('nivel') == 5) {		
			if($id_inventario > 0){
				
				redirect('adm/inventarios/geral/'.$id_inventario,'refresh');

			}else{
				redirect('adm/os/marcar','refresh');
			}
		}

		}else{
			redirect('admin','refresh');
		}

	
	}

	function logar__(){
	
		$login = $_POST['login'];
		//$senha = $_POST['senha'];
		$senha = $_POST['senha'];
		$this->db->where(array('login' => $login, 'senha' => $senha));
		$qr_login = $this->db->get('usuarios');
	
		if($qr_login->num_rows() > 0){
			$dd_user = $qr_login->row();
			$dd_session = array(
								'usr' => true,
								'id' => $dd_user->id,
								'nome' => $dd_user->nome,
								'nivel' => $dd_user->nivel,
								'login' => $login
								);
								$this->session->set_userdata($dd_session);
			redirect('adm/home');
			//echo "oi";
		}else{
			redirect('admin');
		}
	
	}

	// VALIDA A NAVEGAÇÃO
	function verSession(){
	
		$ss = $this->session->userdata('usr');
		if(isset($ss)){
			if($ss == true){
			
			}else{
				redirect('admin');
			}
		}
	}
	
	function cadastrar() {
		
		#print_r($_POST);
		#return fase
		
		$dd = array(
					#'id_unidade' => $_POST['id_unidade'],
					#'id_setor' => $_POST['id_setor'],
					'nome' => $_POST['nome'],
					'login' => $_POST['login'],
					'senha' => $_POST['senha'],
					'email' => $_POST['email'],
					'telefone' => $_POST['telefone'],
					#'setor' => $_POST['setor'],
					'nivel' => $_POST['nivel']
		);

		if($_POST['nivel'] == 7){
			$dd['id_user'] = $this->session->userdata('id');
			$dd['forma_pagamento'] = $_POST['forma_pagamento'];

		}
		
		// define vez
		/*
		if($_POST['id_setor'] == 2){
			$this->db->where(array('id_unidade' => $_POST['id_unidade'] , 'id_setor' => '2'));
			$qr_vez = $this->db->get('usuarios');
			if($qr_vez->num_rows() == 0){
				$dd['vez'] = 1;
			} else{
				$dd['vez'] = $qr_vez->row()->vez;
			}
		
		}
		*/
		
				
		if ($this->db->insert('usuarios', $dd)) {
			return true;
			
		} else {
			echo "erro 117";
			return false;	
		}	
		
	
	}

	// SET COMPRAS

	function set_compra($id_deposito, $id_user=0){
		echo "set_compra";
		return false;
		
		$dd_deposito = $this->padrao_model->get_by_id($id_deposito,'depositos')->row();
		$dd_sorteio = $this->padrao_model->get_by_id($dd_deposito->id_sorteio,'sorteios')->row();
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

		//  INSERI CRÉDITOS
		#for($c=0;$c<$dd->qtd_numeros;$c++){
		$n_cota = 0;
		while($n_cota < $last->qtd_numeros){
			#$numero_sorteado = rand(100000, 999999);

			## RESOLVE NUMERO SORTEADO
			if($dd_sorteio->tipo_milhar == 1){
				$numero_rand = rand(000000, 999999);	
				$decimais = 6;
			}

			if($dd_sorteio->tipo_milhar == 2){
				$numero_rand = rand(0000000, 9999999);	
				$decimais = 7;
			}
			#$numero_rand = rand(000000, 999999);
			#$decimais = 6;
			#$numero_sorteado = rand(000000, 999999);		
			#$numero_sorteado = $numero_rand;		
			$n = $numero_rand;
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
			$numero_sorteado = $numero;
			#echo $numero;
			## X RESOLVE NUMERO SORTEADO
			$qr_numeros = $this->db2->query("SELECT * FROM sorteios_compras WHERE id_sorteio = ".$last->id_sorteio." AND status = 1 AND numeros = ".$numero_sorteado." ");
			if($qr_numeros->num_rows() == 0){
				$hash = "-"."***34*324*".date("Y-d-m h:i:s").$numero_sorteado;
				$dd_compra = array(
					'id_user' => ID_USER,
					'id_sorteio' => $dd_sorteio->id,
					'hash' => md5($hash),
					'id_deposito' => $last->id,
					'id_user_compra' => $last->id_user,					
					'status' => 1,
					'numeros' => $numero_sorteado,
					'dt_compra' => date("Y-m-d H:i:s")
				);

				##########  VERIFICA COTA PREMIADA

				$this->db->where('id_sorteio',$dd_sorteio->id);
				$this->db->where('numero',$numero_sorteado);
				$qr_cota_premiada = $this->db->get('sorteios_cotas_premiadas');
				if($qr_cota_premiada->num_rows() > 0){
					
					$dd_cota_compra['status'] = 1;
					$dd_cota_compra['id_user'] = $last->id_user;
					$this->db->where('id',$qr_cota_premiada->row()->id);
					$this->db->update('sorteios_cotas_premiadas' , $dd_cota_compra);

					$dd_compra['status'] = 10;


					#### ENVIA NOTIFICAÇÃO PRO GANHADOR E PRO RIFEIRO


					### x ENVIA NOTIFICAÇÃO
					#echo "COTA PREMIADA";
				}

				########## X VERIFICA COTA PREMIADA

				#echo $numero_sorteado;
				#echo "<br>";


				#$this->db2->where('id',$numero->id);
				if($this->db2->insert('sorteios_compras' , $dd_compra)){
					$n_cota++;
				}

			}

		}

        ## x veio do controller



        #echo $id_user;


	}

	
	
}
?>
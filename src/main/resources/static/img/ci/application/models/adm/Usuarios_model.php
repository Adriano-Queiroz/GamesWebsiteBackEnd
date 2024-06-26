<?
class Usuarios_model extends CI_Model{
	
	
	function _construct()
	{
		// Call the Model constructor
		parent::_construct();
	}


	function logar(){
		
		$login = $this->input->post('login');
		$id_inventario = $this->input->post('id_inventario');
		//$senha = $_POST['senha'];
		$senha = $this->input->post('senha');
		$this->db->where(array('login' => $login, 'senha' => $senha));
		$qr_login = $this->db->get('usuarios');
		print_r($_POST);
		echo "<br>";
		echo $qr_login->num_rows();
		return false;
	
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

	
	} //x logar

	############### FUNCOES DO 
	function saldo($id_user=0,$mostra=1,$bonus=0){ // bonus = 0 pega tudo
		if($id_user == 0){
			$id_user = $this->session->userdata('id');
		}

		if($bonus == 0){
			$cms = $this->db->query("SELECT * FROM movimento WHERE (id_user = '".$id_user."' OR id_user_mov = '".$id_user."') AND status = 1 ORDER BY dt asc");	
		}
		if($bonus == 1){ // apenas valores sem ser bonus
			$cms = $this->db->query("SELECT * FROM movimento WHERE (id_user = '".$id_user."' OR id_user_mov = '".$id_user."') AND status = 1 AND bonus = 0 ORDER BY dt asc");
		}

		$total = 0; 
		$saldo = 0;

		foreach($cms->result() as $cm){ 
			#$dd_pro = $this->padrao_model->get_by_id($car->id_carsmonster_p,'produtos');
			#$produto = $dd_pro->row();
			if($cm->id_user == $this->session->userdata('id')){ 
				$saldo += $cm->valor;
			}
			if($cm->id_user_mov == $this->session->userdata('id')){ 
				$saldo -= $cm->valor;
			}
			
		}
		#echo "R$ ".number_format($total, 2, ',', '.');
		if($mostra == 1){
			echo (float) $saldo;
		
		}else{
			return $saldo;
		}
	}

	function valor_investido($id_user=0,$mostra=1){
		if($id_user == 0){
			$id_user = $this->session->userdata('id');
		}

		#$cms = $this->db->query("SELECT * FROM movimento WHERE id_user = '".$id_user."' OR id_user_mov = '".$id_user."' AND status = 1 AND tipo = 'deposito' ORDER BY dt asc");
		$cms = $this->db->query("SELECT * FROM movimento WHERE id_user = '".$id_user."' AND status = 1 AND tipo = 'deposito' ORDER BY dt asc");

		$total = 0; 
		$saldo = 0;

		foreach($cms->result() as $cm){ 
			#$dd_pro = $this->padrao_model->get_by_id($car->id_carsmonster_p,'produtos');
			#$produto = $dd_pro->row();
			if($cm->id_user == $this->session->userdata('id')){ 
				$saldo += $cm->valor;
			}
			if($cm->id_user_mov == $this->session->userdata('id')){ 
				$saldo -= $cm->valor;
			}
			
		}
		#echo "R$ ".number_format($total, 2, ',', '.');
		if($mostra == 1){
			echo $saldo;
		
		}else{
			return $saldo;
		}
	}

	function get_rent($id_user=0,$mostra=1){
		if($id_user == 0){
			$id_user = $this->session->userdata('id');
		}

		#$cms = $this->db->query("SELECT * FROM movimento WHERE id_user = '".$id_user."' OR id_user_mov = '".$id_user."' AND status = 1 AND tipo = 'deposito' ORDER BY dt asc");
		$cms = $this->db->query("SELECT * FROM movimento WHERE id_user = '".$id_user."' AND status = 1 AND tipo = 'rentabilidade' ORDER BY dt asc");

		$total = 0; 
		$saldo = 0;

		foreach($cms->result() as $cm){ 
			#$dd_pro = $this->padrao_model->get_by_id($car->id_carsmonster_p,'produtos');
			#$produto = $dd_pro->row();
			if($cm->id_user == $this->session->userdata('id')){ 
				$saldo += $cm->valor;
			}
			if($cm->id_user_mov == $this->session->userdata('id')){ 
				$saldo -= $cm->valor;
			}
			
		}
		#echo "R$ ".number_format($total, 2, ',', '.');
		if($mostra == 1){
			echo $saldo;
		
		}else{
			return $saldo;
		}
	}

	// get_rent_mes
	function get_rent_mes($id_user=0,$mostra=1){
		if($id_user == 0){
			$id_user = $this->session->userdata('id');
		}
		$ano = date("Y");
		$mes_atual = date("m");
		if(strlen($mes_atual) == 1){
			$mes_atual = "0".$mes_atual;
		}
		$mes_ini = $ano."-".$mes_atual."-01 00:00:00";
		$mes_fim = $ano."-".$mes_atual."-31 23:59:59";

		#$cms = $this->db->query("SELECT * FROM movimento WHERE id_user = '".$id_user."' OR id_user_mov = '".$id_user."' AND status = 1 AND tipo = 'deposito' ORDER BY dt asc");
		$cms = $this->db->query("SELECT * FROM movimento WHERE id_user = '".$id_user."' AND status = 1 AND tipo = 'rentabilidade' AND ( data_hora_pagamento BETWEEN '".$mes_ini."' AND '".$mes_fim."') ORDER BY dt asc");

		$total = 0; 
		$saldo = 0;

		foreach($cms->result() as $cm){ 
			#$dd_pro = $this->padrao_model->get_by_id($car->id_carsmonster_p,'produtos');
			#$produto = $dd_pro->row();
			if($cm->id_user == $this->session->userdata('id')){ 
				$saldo += $cm->valor;
			}
			if($cm->id_user_mov == $this->session->userdata('id')){ 
				$saldo -= $cm->valor;
			}
			
		}
		#echo "R$ ".number_format($total, 2, ',', '.');
		if($mostra == 1){
			echo $saldo;
		
		}else{
			return $saldo;
		}
	}

	function saques($id_user=0,$mostra=1){
		if($id_user == 0){
			$id_user = $this->session->userdata('id');
		}

		#$cms = $this->db->query("SELECT * FROM movimento WHERE id_user = '".$id_user."' OR id_user_mov = '".$id_user."' AND status = 1 AND tipo = 'deposito' ORDER BY dt asc");
		$cms = $this->db->query("SELECT * FROM movimento WHERE id_user_mov = '".$id_user."' AND status = 1 AND tipo = 'saque' ORDER BY dt asc");

		$total = 0; 
		$saldo = 0;

		foreach($cms->result() as $cm){ 
			#$dd_pro = $this->padrao_model->get_by_id($car->id_carsmonster_p,'produtos');
			#$produto = $dd_pro->row();
			if($cm->id_user == $this->session->userdata('id')){ 
				$saldo -= $cm->valor;
			}
			if($cm->id_user_mov == $this->session->userdata('id')){ 
				$saldo += $cm->valor;
			}
			
		}
		#echo "R$ ".number_format($total, 2, ',', '.');
		if($mostra == 1){
			echo $saldo;
		
		}else{
			return $saldo;
		}
	}

	############### X FUNCOES DO SELECT






	/*
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
		#echo "OK";
		#print_r($_POST);
		#return false;
		
		
		$dd = array(
					#'site' => $_POST['site'],
					#'id_unidade' => $_POST['id_unidade'],
					#'id_setor' => $_POST['id_setor'],
					'nome' => $_POST['nome'],
					'id_user' => $_POST['id_user'],
					'telefone' => $_POST['telefone'],
					'profissao' => $_POST['profissao'],
					'rg' => $_POST['identidade'],
					'cpf' => $_POST['cpf'],
					'login' => $_POST['login'],
					#'senha' => md5($_POST['senha']),
					'senha' => $_POST['senha'],
					'email' => $_POST['email'],
					'nivel' => $_POST['nivel'],
#					'id_setor' => $_POST['id_setor'],

					'endereco' => $_POST['endereco'],
					'numero' => $_POST['numero'],
					'bairro' => $_POST['bairro'],
					'cidade' => $_POST['cidade'],
					'uf' => $_POST['uf'],
					'complemento' => $_POST['email'],
					'cep' => $_POST['cep'],
					'redes_sociais' => $_POST['redes_sociais'],
					'nivel' => $_POST['nivel']
		);
		if (isset($_POST['imagem'])) {
			$dd['img'] = $_POST['imagem'];
		}

		if($_POST['nivel'] == "7"){
			$dd['site'] = $_POST['site'];
			$dd['nome_empresa'] = $_POST['nome_empresa'];
			#$dd['banco'] = $_POST['banco'];
			#$dd['agencia'] = $_POST['agencia'];
			#$dd['conta'] = $_POST['conta'];
		}

				
		if ($this->db->insert('usuarios', $dd)) {
			#return true;
			$id_new = $this->db->insert_id();
			#redirect('adm/usuarios/edicao/'.$id_new,'refresh');
			redirect('adm/usuarios/rel/'.$_POST['nivel'],'refresh');
		} else {
			return false;	
		}	 
	
	}
	*/

########### FUNÇÃO PARA DATAS #######################
	// converter para data dd/mm/aaaa
	function converte_data($data){
		
		if (strstr($data, "/")) {//verifica se tem a barra /
		
		  $d = explode ("/", $data);//tira a barra
		  $invert_data = "$d[2]-$d[1]-$d[0]";//separa as datas $d[2] = ano $d[1] = mes etc...
		  return $invert_data;
		
		} elseif(strstr($data, "-")) {
		
		  $d = explode ("-", $data);
		  $invert_data = "$d[2]/$d[1]/$d[0]";
		  return $invert_data;
		
		} else {
		
		  return "Data invalida";
		
		}
	
	}


	
} // fecha class
?>

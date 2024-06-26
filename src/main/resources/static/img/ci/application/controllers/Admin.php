<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {


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

	
	function Index(){
		redirect('login');
		#$dados['titulo'] = "";
		#$qr = $this->db->get('usuarios');
		#echo $qr->num_rows();
		#$this->load->view('login' , $dados);
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
				#redirect('home/play/2','refresh');
				redirect('','refresh');
			}

			if ($this->session->userdata('nivel') == 2) {		
				#redirect('adm/usuarios/dash','refresh');
			}



		}else{
			#echo "E-mail ou senha inválido <a href='".base_url()."' >Voltar</a>";
			redirect('login/err/0','refresh');
		}
		
	} // x fn

	function cadastrar(){
		$nome = $this->input->post('nome');		
		$telefone = $this->input->post('telefone');
		$cep = $this->input->post('cep');
		$cpf = $this->input->post('cpf');
		$email = $this->input->post('email');
		$senha = $this->input->post('senha');

		$dd_insert = [
			'nome' => $nome,
			'telefone' => $telefone,
			'cep' => $cep,
			'cpf' => $cpf,
			'email' => $email,
			'senha' => $senha,
			'nivel' => 3
		];

		$this->db->where('email' , $email);
		$qr_verificia_email = $this->db->get('usuarios');
		if($qr_verificia_email->num_rows() > 0){			
			echo "Email já existe. <a href='".base_url()."' title='Voltar'>Voltar</a>";
			return false;
		}

		$this->db->where('telefone' , $telefone);
		$qr_verificia_email = $this->db->get('usuarios');
		if($qr_verificia_email->num_rows() > 0){
			echo "Telefone já existe. <a href='".base_url()."' title='Voltar'>Voltar</a>";
			return false;
		}

		$this->db->insert('usuarios' , $dd_insert);
		$usuario  = $this->db->insert_id();


		## bonus BOAS VINDAS
		$dd_rasp = $this->db->query("SELECT * FROM raspadinhas ORDER BY id desc LIMIT 1")->row();
		$bonus = $dd_rasp->bonus_boas_vindas;
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



		$this->logar();


	} // x cadastrar


	function set_edit(){
		if(!$this->session->userdata('id')){
			redirect('','refresh');
		}else{

			$id_user = $this->session->userdata('id');

			$nome = $this->input->post('nome');		
			$telefone = $this->input->post('telefone');
			#$cep = $this->input->post('cep');
			#$cpf = $this->input->post('cpf');
			$email = $this->input->post('email');
			#$senha = $this->input->post('senha');

			$dd_insert = [
				'nome' => $nome,
				'telefone' => $telefone,
				#'cep' => $cep,
				#'cpf' => $cpf,
				#'email' => $email,
				#'senha' => $senha,
				#'nivel' => 3
			];
			$this->db->where('id',$id_user);
			$this->db->update('usuarios' , $dd_insert);

			redirect('perfil/dd');



		} // x else
		
	}

	function cotas_reservadas($id_sorteio){

	}

	function verifica_cotas(){
		$qr = $this->db->query("
			SELECT u.id, u.nome, sc.id_user_compra, sc.id_deposito, sc.dt_compra, COUNT(*) AS quantidade
			FROM sorteios_compras sc
			JOIN usuarios u ON sc.id_user_compra = u.id
			GROUP BY sc.id_user_compra;
		");

		if($qr->num_rows() > 0){
			foreach($qr->result() as $dd){
				print_r($dd);
				echo "<br> ";
				$qr_dep = $this->padrao_model->get_by_id($dd->id_deposito,'depositos');
				echo "<strong>";
				$total_remover = $dd->quantidade - $qr_dep->row()->qtd_numeros;
				echo $dd->quantidade." - ".$qr_dep->row()->qtd_numeros." = ".$total_remover;
				if($total_remover > 0){
					#$this->db->where('id_deposito',$dd->id_deposito);
					#$this->db->limit($total_remover);
					#$this->db->delete('sorteios_compras');
				}

				echo "</strong>";
				echo "<br> ************************ <br> <hr>";
			}
		}
		
	}


	/*
	function gerar_bilheres_rasp($qtd=1000){
		$bonus2 = 100;
		$bonus10 = 50;
		$bonus50 = 10;

		$rasps = 0;
		while ($rasps < $qtd) {
			// code...
			$rasps++;
			$sort = $this->sortear();
			echo $rasps." = ".$sort;
			echo "<br>";
		}


	} // x fn




    public function sortear($repetir = false) {
	        // Definindo os números disponíveis
	        $numeros_disponiveis = [2, 5, 20, 50, 100];

	        // Array para armazenar os números selecionados
	        $numeros_selecionados = [];

	        if ($repetir) {
	            // Seleciona um número aleatório para ser repetido 3 vezes
	            $numero_para_repetir = $numeros_disponiveis[array_rand($numeros_disponiveis)];

	            // Remove o número selecionado para repetição do array original
	            $numeros_disponiveis = array_diff($numeros_disponiveis, [$numero_para_repetir]);

	            // Seleciona mais 3 números aleatórios dos disponíveis
	            shuffle($numeros_disponiveis);
	            $numeros_adicionais = array_slice($numeros_disponiveis, 0, 3);

	            // Combina os números selecionados com o número repetido
	            $numeros_selecionados = array_merge($numeros_adicionais, array_fill(0, 3, $numero_para_repetir));
	        } else {
	            // Garantir que cada número pode aparecer no máximo duas vezes
	            $max_repeticoes = 2;
	            $total_numeros = 6;

	            while (count($numeros_selecionados) < $total_numeros) {
	                // Embaralha os números disponíveis
	                shuffle($numeros_disponiveis);

	                // Adiciona um número selecionado ao array
	                $numero_selecionado = $numeros_disponiveis[0];
	                $contagem = array_count_values($numeros_selecionados);

	                // Verifica se o número já foi adicionado 2 vezes
	                if (!isset($contagem[$numero_selecionado]) || $contagem[$numero_selecionado] < $max_repeticoes) {
	                    $numeros_selecionados[] = $numero_selecionado;
	                }
	            }
	        }

	        // Embaralha os números selecionados para garantir a aleatoriedade
	        shuffle($numeros_selecionados);

	        // Converte o array em uma string no formato desejado
	        $resultado = implode('-', $numeros_selecionados);

	        // Retorna o resultado
	        #echo $resultado;
	        return $resultado;
	    
	} // x fn

	*/
	/*
	public function sortear($repetir = false) {
        $numeros_disponiveis = [2, 5, 20, 50, 100];
        $numeros_selecionados = [];

        if ($repetir) {
            $numero_para_repetir = $numeros_disponiveis[array_rand($numeros_disponiveis)];
            $numeros_disponiveis = array_diff($numeros_disponiveis, [$numero_para_repetir]);
            shuffle($numeros_disponiveis);
            $numeros_adicionais = array_slice($numeros_disponiveis, 0, 3);
            $numeros_selecionados = array_merge($numeros_adicionais, array_fill(0, 3, $numero_para_repetir));
        } else {
            $max_repeticoes = 2;
            $total_numeros = 6;

            while (count($numeros_selecionados) < $total_numeros) {
                shuffle($numeros_disponiveis);
                $numero_selecionado = $numeros_disponiveis[0];
                $contagem = array_count_values($numeros_selecionados);

                if (!isset($contagem[$numero_selecionado]) || $contagem[$numero_selecionado] < $max_repeticoes) {
                    $numeros_selecionados[] = $numero_selecionado;
                }
            }
        }

        shuffle($numeros_selecionados);
        $resultado = implode('-', $numeros_selecionados);

        return $resultado;
    }

    public function gerar_bilhetes_rasp($qtd = 1000) {
        $bonus2 = 100; // 10%
        $bonus10 = 50; // 5%
        $bonus50 = 10; // 1%

        $total_premios = $bonus2 + $bonus10 + $bonus50;

        $premios = array_merge(
            array_fill(0, $bonus2, 2),
            array_fill(0, $bonus10, 10),
            array_fill(0, $bonus50, 50)
        );

        shuffle($premios);

        $rasps = 0;
        $bilhetes = [];

        while ($rasps < $qtd) {
            $bilhete_premiado = false;

            if ($total_premios > 0 && mt_rand(1, $qtd) <= $total_premios) {
                $premio = array_pop($premios);
                $total_premios--;
                $bilhete_premiado = true;
            }

            $sort = $this->sortear($bilhete_premiado);
            $bilhetes[] = $sort;

            $dd_bilhete = [
            	'id_rasp' => 1,
            	'numeros' => $sort,
            	'status' => 0
            ];

            echo $rasps + 1 . " = " . $sort;
            if ($bilhete_premiado) {
                echo " (Premiado: $premio)";
                $dd_bilhete['tipo_win'] = 1;
                $dd_bilhete['valor'] = $premio;
            }

            $this->db->insert('premiacoes' , $dd_bilhete);
            echo "<br>";

            $rasps++;
        } // x while

        // Aqui você pode salvar os bilhetes em um banco de dados, arquivo, etc.
        // Neste exemplo, apenas retorna a lista de bilhetes.
        return $bilhetes;
    }
    */



    ######################################################
    /*
    public function sortear($repetir = false, $numero_repetido = null) {
        $numeros_disponiveis = [1, 2, 5, 10 ,20, 50, 100,500, 1000];
        $numeros_selecionados = [];

        if ($repetir && $numero_repetido !== null) {
            $numeros_disponiveis = array_diff($numeros_disponiveis, [$numero_repetido]);
            shuffle($numeros_disponiveis);
            $numeros_adicionais = array_slice($numeros_disponiveis, 0, 3);
            $numeros_selecionados = array_merge($numeros_adicionais, array_fill(0, 3, $numero_repetido));
        } else {
            $max_repeticoes = 2;
            $total_numeros = 6;

            while (count($numeros_selecionados) < $total_numeros) {
                shuffle($numeros_disponiveis);
                $numero_selecionado = $numeros_disponiveis[0];
                $contagem = array_count_values($numeros_selecionados);

                if (!isset($contagem[$numero_selecionado]) || $contagem[$numero_selecionado] < $max_repeticoes) {
                    $numeros_selecionados[] = $numero_selecionado;
                }
            }
        }

        shuffle($numeros_selecionados);
        $resultado = implode('-', $numeros_selecionados);

        return $resultado;
    }
    */

    function gera_bilhetes($qtd=1000,$n_premio=0){

    	if(!$this->session->userdata('id')){
    		redirect();
    	}

    	if($this->session->userdata('nivel') > 1){
    		redirect();
    	}

    	#$numeros_disponiveis = [1, 2, 5, 10 ,20, 50, 100,500, 1000];        
        #$numeros_selecionados = [];

        $rasps = 0;
        $bilhetes = [];

        $perda = 20;
        $lucro = 80;
        if($n_premio == 0){

        	while ($rasps < $qtd){
	            #$bilhete_premiado = false;
	            #$premio = null;
	            $rasps++;

	            #echo $rasps;
	            #echo "<br>";
	            $numeros = $sort = $this->sortear(false);
	            $dd_insert = [
	            	'id_rasp' => 1,
	            	'id_user' => 0,
	            	'numeros' => $numeros,
	            	'tipo_win' => 0,
	            	'status' => 0,
	            	'valor' => 0
	            ];
	            $this->db->insert('premiacoes' , $dd_insert);
	        } // x while

	        $qr_total = $this->db->get('premiacoes');
	        echo $qr_total->num_rows()." gerados";
	        

        } // x if
        
        if($n_premio > 0){

        	$qr_total = $this->db->get('premiacoes');
	        #echo $qr_total->num_rows();
	        $total = $qr_total->num_rows();

	        $qtd_premios = $total * ($perda / 100);

	        #echo "<br> Total premios: ";
	        #echo $qtd_premios;

	        #$bonus1 = 350; // 35.18%
	        #$bonus2 = 350; // 35.18%
	        #$bonus3 = 93; // 9.38%
	        #$bonus5 = 93; // 9.38%
	        #$bonus10 = 50; // 5.16%
	        #$bonus20 = 28; // 2.81%
	        #$bonus50 = 14; // 1.41%
	        #$bonus100 = 10; // 1%
	        #$bonus500 = 4; // 0.47%
	        #$bonus1000 = 0.10; // 0.09%

	        if($n_premio == 1){
	        	#$qtd_bonus1 = $qtd_premios * (35.18 / 100);	
	        	$qtd_bonus = 3518;	
	        	// replicado
	        	$qtd_bonus_int = (int) $qtd_bonus;
	        	$qr_bonus = $this->db->query("SELECT id,numeros FROM premiacoes WHERE id > 50 AND tipo_win = 0 AND status = 0 ORDER BY RAND() asc LIMIT $qtd_bonus_int ");

	        	$qr_bonus_exist = $this->db->query("SELECT COUNT(id) as total FROM premiacoes WHERE valor = $n_premio AND tipo_win = 1 AND status = 0");

	        	if($qr_bonus_exist->row()->total >= $qtd_bonus_int){
	        		echo "Premiacao ja gerada";
	        		return false;
	        	}

	        	foreach($qr_bonus->result() as $bon){
	        		#$n_win =  
	        		$numeros = $this->sortear(true,$n_premio);

	        		// DB
	        		$dd_up = [
		            	#'id_rasp' => 1,
		            	#'id_user' => 0,
		            	'numeros' => $numeros,
		            	'tipo_win' => 1,		            	
		            	'valor' => $n_premio
		            ];
		            $this->db->where('id',$bon->id);
		            $this->db->update('premiacoes' , $dd_up);

	        		echo $bon->id;
	        		echo "<span style='color:red'>".$bon->numeros."</span>";	        		
	        		echo " - <span style='color:green'>".$numeros."</span>";
	        		echo "<br>";
	        	} // x foreach
	        }

	        if($n_premio == 2){
	        	#$qtd_bonus2 = $qtd_premios * (35.18 / 100);
	        	#$qtd_bonus = $qtd_premios * (35.18 / 100);
	        	$qtd_bonus = 1759;


	        	// replicado
	        	$qtd_bonus_int = (int) $qtd_bonus;
	        	$qr_bonus = $this->db->query("SELECT id,numeros FROM premiacoes WHERE id > 50 AND tipo_win = 0 AND status = 0 ORDER BY RAND() LIMIT $qtd_bonus_int ");
	        	$qr_bonus_exist = $this->db->query("SELECT COUNT(id) as total FROM premiacoes WHERE valor = $n_premio AND tipo_win = 1 AND status = 0");

	        	if($qr_bonus_exist->row()->total >= $qtd_bonus_int){
	        		echo "Premiacao ja gerada";
	        		return false;
	        	}

	        	foreach($qr_bonus->result() as $bon){
	        		#$n_win =  
	        		$numeros = $this->sortear(true,$n_premio);

	        		// DB
	        		$dd_up = [
		            	#'id_rasp' => 1,
		            	#'id_user' => 0,
		            	'numeros' => $numeros,
		            	'tipo_win' => 1,		            	
		            	'valor' => $n_premio
		            ];
		            $this->db->where('id',$bon->id);
		            $this->db->update('premiacoes' , $dd_up);

	        		echo $bon->id;
	        		echo "<span style='color:red'>".$bon->numeros."</span>";	        		
	        		echo " - <span style='color:green'>".$numeros."</span>";
	        		echo "<br>";
	        	} // x foreach
	        }

	        if($n_premio == 3){
	        	#$qtd_bonus3 = $qtd_premios * (9.38 / 100);
	        	#$qtd_bonus = $qtd_premios * (9.38 / 100);
	        	$qtd_bonus = 312;

	        	// replicado
	        	$qtd_bonus_int = (int) $qtd_bonus;
	        	$qr_bonus = $this->db->query("SELECT id,numeros FROM premiacoes WHERE id > 10 AND tipo_win = 0 AND status = 0 ORDER BY RAND() LIMIT $qtd_bonus_int ");
	        	$qr_bonus_exist = $this->db->query("SELECT COUNT(id) as total FROM premiacoes WHERE valor = $n_premio AND tipo_win = 1 AND status = 0");

	        	if($qr_bonus_exist->row()->total >= $qtd_bonus_int){
	        		echo "Premiacao ja gerada";
	        		return false;
	        	}

	        	foreach($qr_bonus->result() as $bon){
	        		#$n_win =  
	        		$numeros = $this->sortear(true,$n_premio);

	        		// DB
	        		$dd_up = [
		            	#'id_rasp' => 1,
		            	#'id_user' => 0,
		            	'numeros' => $numeros,
		            	'tipo_win' => 1,		            	
		            	'valor' => $n_premio
		            ];
		            $this->db->where('id',$bon->id);
		            $this->db->update('premiacoes' , $dd_up);

	        		echo $bon->id;
	        		echo "<span style='color:red'>".$bon->numeros."</span>";	        		
	        		echo " - <span style='color:green'>".$numeros."</span>";
	        		echo "<br>";
	        	} // x foreach
	        }

	        if($n_premio == 5){
	        	#$qtd_bonus5 = $qtd_premios * (9.38 / 100);
	        	#$qtd_bonus = $qtd_premios * (9.38 / 100);
	        	$qtd_bonus = 187;

	        	// replicado
	        	$qtd_bonus_int = (int) $qtd_bonus;
	        	$qr_bonus = $this->db->query("SELECT id,numeros FROM premiacoes WHERE id > 10 AND tipo_win = 0 AND status = 0 ORDER BY RAND() LIMIT $qtd_bonus_int ");
	        	$qr_bonus_exist = $this->db->query("SELECT COUNT(id) as total FROM premiacoes WHERE valor = $n_premio AND tipo_win = 1 AND status = 0");

	        	if($qr_bonus_exist->row()->total >= $qtd_bonus_int){
	        		echo "Premiacao ja gerada";
	        		return false;
	        	}

	        	foreach($qr_bonus->result() as $bon){
	        		#$n_win =  
	        		$numeros = $this->sortear(true,$n_premio);

	        		// DB
	        		$dd_up = [
		            	#'id_rasp' => 1,
		            	#'id_user' => 0,
		            	'numeros' => $numeros,
		            	'tipo_win' => 1,		            	
		            	'valor' => $n_premio
		            ];
		            $this->db->where('id',$bon->id);
		            $this->db->update('premiacoes' , $dd_up);

	        		echo $bon->id;
	        		echo "<span style='color:red'>".$bon->numeros."</span>";	        		
	        		echo " - <span style='color:green'>".$numeros."</span>";
	        		echo "<br>";
	        	} // x foreach
	        }

	        if($n_premio == 10){
	        	#$qtd_bonus10 = $qtd_premios * (5.16 / 100);
	        	#$qtd_bonus = $qtd_premios * (5.16 / 100);
	        	$qtd_bonus = 51;

	        	// replicado
	        	$qtd_bonus_int = (int) $qtd_bonus;
	        	$qr_bonus = $this->db->query("SELECT id,numeros FROM premiacoes WHERE id > 10 AND tipo_win = 0 AND status = 0 ORDER BY RAND() LIMIT $qtd_bonus_int ");
	        	$qr_bonus_exist = $this->db->query("SELECT COUNT(id) as total FROM premiacoes WHERE valor = $n_premio AND tipo_win = 1 AND status = 0");

	        	if($qr_bonus_exist->row()->total >= $qtd_bonus_int){
	        		echo "Premiacao ja gerada";
	        		return false;
	        	}

	        	foreach($qr_bonus->result() as $bon){
	        		#$n_win =  
	        		$numeros = $this->sortear(true,$n_premio);

	        		// DB
	        		$dd_up = [
		            	#'id_rasp' => 1,
		            	#'id_user' => 0,
		            	'numeros' => $numeros,
		            	'tipo_win' => 1,		            	
		            	'valor' => $n_premio
		            ];
		            $this->db->where('id',$bon->id);
		            $this->db->update('premiacoes' , $dd_up);

	        		echo $bon->id;
	        		echo "<span style='color:red'>".$bon->numeros."</span>";	        		
	        		echo " - <span style='color:green'>".$numeros."</span>";
	        		echo "<br>";
	        	} // x foreach
	        }

	        if($n_premio == 20){
	        	#$qtd_bonus20 = $qtd_premios * (1.41 / 100);
	        	#$qtd_bonus = $qtd_premios * (1.41 / 100);
	        	$qtd_bonus = 14;

	        	// replicado
	        	$qtd_bonus_int = (int) $qtd_bonus;
	        	$qr_bonus = $this->db->query("SELECT id,numeros FROM premiacoes WHERE id > 10 AND tipo_win = 0 AND status = 0 ORDER BY RAND() LIMIT $qtd_bonus_int ");
	        	$qr_bonus_exist = $this->db->query("SELECT COUNT(id) as total FROM premiacoes WHERE valor = $n_premio AND tipo_win = 1 AND status = 0");

	        	if($qr_bonus_exist->row()->total >= $qtd_bonus_int){
	        		echo "Premiacao ja gerada";
	        		return false;
	        	}

	        	foreach($qr_bonus->result() as $bon){
	        		#$n_win =  
	        		$numeros = $this->sortear(true,$n_premio);

	        		// DB
	        		$dd_up = [
		            	#'id_rasp' => 1,
		            	#'id_user' => 0,
		            	'numeros' => $numeros,
		            	'tipo_win' => 1,		            	
		            	'valor' => $n_premio
		            ];
		            $this->db->where('id',$bon->id);
		            $this->db->update('premiacoes' , $dd_up);

	        		echo $bon->id;
	        		echo "<span style='color:red'>".$bon->numeros."</span>";	        		
	        		echo " - <span style='color:green'>".$numeros."</span>";
	        		echo "<br>";
	        	} // x foreach
	        }

	        if($n_premio == 50){
	        	#$qtd_bonus50 = $qtd_premios * (35.18 / 100);
	        	#$qtd_bonus = $qtd_premios * (35.18 / 100);
	        	$qtd_bonus = 2;

	        	// replicado
	        	$qtd_bonus_int = (int) $qtd_bonus;
	        	$qr_bonus = $this->db->query("SELECT id,numeros FROM premiacoes WHERE id > 10 AND tipo_win = 0 AND status = 0 ORDER BY RAND() LIMIT $qtd_bonus_int ");
	        	$qr_bonus_exist = $this->db->query("SELECT COUNT(id) as total FROM premiacoes WHERE valor = $n_premio AND tipo_win = 1 AND status = 0");

	        	if($qr_bonus_exist->row()->total >= $qtd_bonus_int){
	        		echo "Premiacao ja gerada";
	        		return false;
	        	}

	        	foreach($qr_bonus->result() as $bon){
	        		#$n_win =  
	        		$numeros = $this->sortear(true,$n_premio);

	        		// DB
	        		$dd_up = [
		            	#'id_rasp' => 1,
		            	#'id_user' => 0,
		            	'numeros' => $numeros,
		            	'tipo_win' => 1,		            	
		            	'valor' => $n_premio
		            ];
		            $this->db->where('id',$bon->id);
		            $this->db->update('premiacoes' , $dd_up);

	        		echo $bon->id;
	        		echo "<span style='color:red'>".$bon->numeros."</span>";	        		
	        		echo " - <span style='color:green'>".$numeros."</span>";
	        		echo "<br>";
	        	} // x foreach
	        }

	        if($n_premio == 100){
	        	#$qtd_bonus100 = $qtd_premios * (1 / 100);
	        	#$qtd_bonus = $qtd_premios * (1 / 100);
	        	$qtd_bonus = 2;

	        	// replicado
	        	$qtd_bonus_int = (int) $qtd_bonus;
	        	$qr_bonus = $this->db->query("SELECT id,numeros FROM premiacoes WHERE id > 10 AND tipo_win = 0 AND status = 0 ORDER BY RAND() LIMIT $qtd_bonus_int ");
	        	$qr_bonus_exist = $this->db->query("SELECT COUNT(id) as total FROM premiacoes WHERE valor = $n_premio AND tipo_win = 1 AND status = 0");

	        	if($qr_bonus_exist->row()->total >= $qtd_bonus_int){
	        		echo "Premiacao ja gerada";
	        		return false;
	        	}

	        	foreach($qr_bonus->result() as $bon){
	        		#$n_win =  
	        		$numeros = $this->sortear(true,$n_premio);

	        		// DB
	        		$dd_up = [
		            	#'id_rasp' => 1,
		            	#'id_user' => 0,
		            	'numeros' => $numeros,
		            	'tipo_win' => 1,		            	
		            	'valor' => $n_premio
		            ];
		            $this->db->where('id',$bon->id);
		            $this->db->update('premiacoes' , $dd_up);

	        		echo $bon->id;
	        		echo "<span style='color:red'>".$bon->numeros."</span>";	        		
	        		echo " - <span style='color:green'>".$numeros."</span>";
	        		echo "<br>";
	        	} // x foreach
	        }

	        if($n_premio == 500){
	        	#$qtd_bonus500 = $qtd_premios * (0.47 / 100);
	        	#$qtd_bonus = $qtd_premios * (0.47 / 100);
	        	$qtd_bonus = 1;

	        	// replicado
	        	$qtd_bonus_int = (int) $qtd_bonus;
	        	$qr_bonus = $this->db->query("SELECT id,numeros FROM premiacoes WHERE id > 10 AND tipo_win = 0 AND status = 0 ORDER BY RAND() LIMIT $qtd_bonus_int ");
	        	$qr_bonus_exist = $this->db->query("SELECT COUNT(id) as total FROM premiacoes WHERE valor = $n_premio AND tipo_win = 1 AND status = 0");

	        	if($qr_bonus_exist->row()->total >= $qtd_bonus_int){
	        		echo "Premiacao ja gerada";
	        		return false;
	        	}

	        	foreach($qr_bonus->result() as $bon){
	        		#$n_win =  
	        		$numeros = $this->sortear(true,$n_premio);

	        		// DB
	        		$dd_up = [
		            	#'id_rasp' => 1,
		            	#'id_user' => 0,
		            	'numeros' => $numeros,
		            	'tipo_win' => 1,		            	
		            	'valor' => $n_premio
		            ];
		            $this->db->where('id',$bon->id);
		            $this->db->update('premiacoes' , $dd_up);

	        		echo $bon->id;
	        		echo "<span style='color:red'>".$bon->numeros."</span>";	        		
	        		echo " - <span style='color:green'>".$numeros."</span>";
	        		echo "<br>";
	        	} // x foreach
	        }

	        if($n_premio == 1000){
	        	#$qtd_bonus1000 = $qtd_premios * (0.09 / 100);
	        	$qtd_bonus = $qtd_premios * (0.09 / 100);

	        	// replicado
	        	$qtd_bonus_int = (int) $qtd_bonus;
	        	$qr_bonus = $this->db->query("SELECT id,numeros FROM premiacoes WHERE id > 10 AND tipo_win = 0 AND status = 0 ORDER BY RAND() LIMIT $qtd_bonus_int ");
	        	$qr_bonus_exist = $this->db->query("SELECT COUNT(id) as total FROM premiacoes WHERE valor = $n_premio AND tipo_win = 1 AND status = 0");

	        	if($qr_bonus_exist->row()->total >= $qtd_bonus_int){
	        		echo "Premiacao ja gerada";
	        		return false;
	        	}

	        	foreach($qr_bonus->result() as $bon){
	        		#$n_win =  
	        		$numeros = $this->sortear(true,$n_premio);

	        		// DB
	        		$dd_up = [
		            	#'id_rasp' => 1,
		            	#'id_user' => 0,
		            	'numeros' => $numeros,
		            	'tipo_win' => 1,		            	
		            	'valor' => $n_premio
		            ];
		            $this->db->where('id',$bon->id);
		            $this->db->update('premiacoes' , $dd_up);

	        		echo $bon->id;
	        		echo "<span style='color:red'>".$bon->numeros."</span>";	        		
	        		echo " - <span style='color:green'>".$numeros."</span>";
	        		echo "<br>";
	        	} // x foreach
	        }

	        

	        echo "<br>";
	        echo  $qtd_bonus." Premios de R$ $n_premio<br>";
	        #echo  "R$ 2 ".$qtd_bonus2."<br>";
	        #echo  "R$ 3 ".$qtd_bonus3."<br>";
	        #echo  "R$ 5 ".$qtd_bonus5."<br>";
	        #echo  "R$ 10 ".$qtd_bonus10."<br>";
	        #echo  "R$ 20 ".$qtd_bonus20."<br>";
	        #echo  "R$ 50 ".$qtd_bonus50."<br>";
	        #echo  "R$ 100 ".$qtd_bonus100."<br>";
	        #echo  "R$ 500 ".$qtd_bonus500."<br>";
	        #echo  "R$ 1000 ".$qtd_bonus1000."<br>";

        }
        

    } // x fn

    public function sortear($repetir = false, $numero_repetido = null) {
        #$numeros_disponiveis = [2, 5, 20, 50, 100];
        $numeros_disponiveis = [1, 2, 5, 10 ,20, 50, 100,500, 1000];
        
        $numeros_selecionados = [];

        if ($repetir && $numero_repetido !== null) {
            $numeros_disponiveis = array_diff($numeros_disponiveis, [$numero_repetido]);
            shuffle($numeros_disponiveis);
            $numeros_adicionais = array_slice($numeros_disponiveis, 0, 3);
            $numeros_selecionados = array_merge($numeros_adicionais, array_fill(0, 3, $numero_repetido));
        } else {
            $max_repeticoes = 2;
            $total_numeros = 6;

            while (count($numeros_selecionados) < $total_numeros) {
                shuffle($numeros_disponiveis);
                $numero_selecionado = $numeros_disponiveis[0];
                $contagem = array_count_values($numeros_selecionados);

                if (!isset($contagem[$numero_selecionado]) || $contagem[$numero_selecionado] < $max_repeticoes) {
                    $numeros_selecionados[] = $numero_selecionado;
                }
            }
        }

        shuffle($numeros_selecionados);
        $resultado = implode('-', $numeros_selecionados);

        return $resultado;
    }

    public function gerar_bilhetes_rasp___($qtd = 1000) {
    	if(!$this->session->userdata('id')){
    		redirect();
    	}

    	if($this->session->userdata('nivel') > 1){
    		redirect();
    	}
        #$bonus2 = 100; // 10%
        #$bonus10 = 50; // 5%
        #$bonus50 = 10; // 1%


        $bonus1 = 350; // 35.18%
        $bonus2 = 350; // 35.18%
        $bonus3 = 93; // 9.38%
        $bonus5 = 93; // 9.38%
        $bonus10 = 50; // 5.16%
        $bonus20 = 28; // 2.81%
        $bonus50 = 14; // 1.41%
        $bonus100 = 10; // 1%
        $bonus500 = 4; // 0.47%
        $bonus1000 = 0.10; // 0.09%

        $total_premios = $bonus2 + $bonus3 + $bonus5 + $bonus10 + $bonus20 + $bonus50 + $bonus100 + $bonus500 + $bonus1000;

        $premios = array_merge(
            array_fill(0, $bonus1, 1),
            array_fill(0, $bonus2, 2),
            array_fill(0, $bonus3, 3),
            array_fill(0, $bonus5, 5),
            array_fill(0, $bonus10, 10),
            array_fill(0, $bonus20, 20),
            array_fill(0, $bonus50, 50),
            array_fill(0, $bonus100, 100),
            array_fill(0, $bonus500, 500),
            array_fill(0, $bonus1000, 1000)
        );

        shuffle($premios);

        $rasps = 0;
        $bilhetes = [];

        while ($rasps < $qtd) {
            $bilhete_premiado = false;
            $premio = null;

            if ($total_premios > 0 && mt_rand(1, $qtd) <= $total_premios) {
                $premio = array_pop($premios);
                $total_premios--;
                $bilhete_premiado = true;
            }

            $sort = $this->sortear($bilhete_premiado, $premio);
            $bilhetes[] = $sort;

            ######################
            $dd_bilhete = [
            	'id_rasp' => 1,
            	'numeros' => $sort,
            	'status' => 0
            ];

            echo $rasps + 1 . " = " . $sort;
            if ($bilhete_premiado) {
                echo " (Premiado: $premio)";
                $dd_bilhete['tipo_win'] = 1;
                $dd_bilhete['valor'] = $premio;
            }

            $this->db->insert('premiacoes' , $dd_bilhete);
            ######################

            // echo $rasps + 1 . " = " . $sort;
            // if ($bilhete_premiado) {
            //     echo " (Premiado: $premio)";
            // }
            echo "<br>";

            $rasps++;
        }

        return $bilhetes;
    }

    public function gerar_bilhetes_rasp($qtd = 1000, $lucros = 80, $perdas = 20) {
        
        if (!$this->session->userdata('id')) {
            redirect();
        }

        if ($this->session->userdata('nivel') > 1) {
            redirect();
        }

        $bonus1 = 350; // 35.18%
        $bonus2 = 350; // 35.18%
        $bonus3 = 93; // 9.38%
        $bonus5 = 93; // 9.38%
        $bonus10 = 50; // 5.16%
        $bonus20 = 28; // 2.81%
        $bonus50 = 14; // 1.41%
        $bonus100 = 10; // 1%
        $bonus500 = 4; // 0.47%
        $bonus1000 = 1; // 0.09%

        $total_premios = $bonus1 + $bonus2 + $bonus3 + $bonus5 + $bonus10 + $bonus20 + $bonus50 + $bonus100 + $bonus500 + $bonus1000;
        $num_vencedores = round($qtd * ($perdas / 100));
        $num_perdedores = $qtd - $num_vencedores;

        $premios = array_merge(
            array_fill(0, $bonus1, 1),
            array_fill(0, $bonus2, 2),
            array_fill(0, $bonus3, 3),
            array_fill(0, $bonus5, 5),
            array_fill(0, $bonus10, 10),
            array_fill(0, $bonus20, 20),
            array_fill(0, $bonus50, 50),
            array_fill(0, $bonus100, 100),
            array_fill(0, $bonus500, 500),
            array_fill(0, $bonus1000, 1000)
        );

        // Garantir que os prêmios são distribuídos aleatoriamente
        shuffle($premios);

        // Ajustar a lista de prêmios para representar apenas 20% dos bilhetes
        $premios = array_slice($premios, 0, $num_vencedores);

        $rasps = 0;
        $bilhetes = [];
        $ultimo_premiado = -1;

        while ($rasps < $qtd) {
            $bilhete_premiado = false;
            $premio = null;

            // Garantir que prêmios maiores não aparecem antes de 100 bilhetes
            if ($rasps >= 100 && $num_vencedores > 0 && !empty($premios)) {
                $premio = array_pop($premios);

                // Verificar se o prêmio é maior que 100 e garantir que apareça após 100 bilhetes
                if ($premio > 100 && $rasps < 100) {
                    array_unshift($premios, $premio);
                    $premio = null;
                } else {
                    $num_vencedores--;
                    $bilhete_premiado = true;
                }
            }

            // Evitar dois bilhetes premiados consecutivos
            if ($bilhete_premiado && $rasps == $ultimo_premiado + 1) {
                array_unshift($premios, $premio);
                $premio = null;
                $bilhete_premiado = false;
            } else if ($bilhete_premiado) {
                $ultimo_premiado = $rasps;
            }

            $sort = $this->sortear($bilhete_premiado, $premio);
            $bilhetes[] = $sort;

            $dd_bilhete = [
                'id_rasp' => 1,
                'numeros' => $sort,
                'status' => 0
            ];

            echo $rasps + 1 . " = " . $sort;
            if ($bilhete_premiado) {
                echo " (Premiado: $premio)";
                $dd_bilhete['tipo_win'] = 1;
                $dd_bilhete['valor'] = $premio;
            }

            $this->db->insert('premiacoes', $dd_bilhete);

            echo "<br>";

            $rasps++;
        }

        return $bilhetes;
    
    }
    ######################################################

	


	
	
function remove_cotas_finalizadas(){
	echo "OK";
	$qr_sorteios = $this->db->query("SELECT * FROM sorteios WHERE status = 3 ORDER BY id asc LIMIT 6");

	foreach( $qr_sorteios->result() as $sorteio){
		$qr_compras = $this->db->query("SELECT COUNT(id) as total FROM sorteios_compras WHERE id_sorteio = ".$sorteio->id." AND status = 1");
		$qr_compras_win = $this->db->query("SELECT * FROM sorteios_compras WHERE id_sorteio = ".$sorteio->id." AND status = 10");

		if($qr_compras->row()->total > 0){
			$qr_compras_nowin = $this->db->query("SELECT * FROM sorteios_compras WHERE id_sorteio = ".$sorteio->id." AND status = 1 LIMIT 10000");
			foreach($qr_compras_nowin->result() as $dd_compra){
				$this->db->insert('sorteios_compras_bk1', $dd_compra);
				#print_r($dd_compra);

				$this->db->where('id',$dd_compra->id);
				$this->db->delete('sorteios_compras');
				echo "<br>";
			}
		} // x total > 0

		echo "<h1>".$sorteio->id_user.": ".$sorteio->titulo."</h1>";
		echo "<p>(".$qr_compras->row()->total.") - [".$qr_compras_win->num_rows()."]</p>";
	}
}

} // x class

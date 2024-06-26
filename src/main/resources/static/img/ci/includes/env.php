<?php
define("id_user_cliente",1);
define("id_user",1);   
define("ID_USER",1);
        

#$qr_api_mp =  $this->padrao_model->get_by_matriz('id_user',ID_USER,'usuarios_parametros');
$qr_api_mp =  $this->padrao_model->get_by_matriz('id_user',ID_USER,'raspadinhas');

$api_mp = $qr_api_mp->row()->api_mercado_pago;
define("API_MP",$api_mp);

$dd_user = $this->db->query("SELECT * FROM usuarios WHERE id = '".id_user."'")->row();  
$dd_param = $this->db->query("SELECT * FROM usuarios_parametros WHERE id_user = '".id_user."'")->row(); 

#define("pixel_fb",$dd_param->pixel_facebook);
define("pixel_fb",$dd_param->pixel_facebook);
define("google_analytics",$dd_param->google_analytics);


// whqatsapp
#$dbbot = $this->load->database('dbbot', TRUE);
#$this->dbbot = $dbbot;
?>
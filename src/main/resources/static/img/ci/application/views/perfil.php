<!DOCTYPE html>
<html lang="en" data-footer="true">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
<title>Raspei Ganhei | Dashboard</title>
<meta name="description" content="Service Provider Getting Started">
<link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?=base_url()?>img/favicon/apple-touch-icon-57x57.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?=base_url()?>img/favicon/apple-touch-icon-114x114.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?=base_url()?>img/favicon/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?=base_url()?>img/favicon/apple-touch-icon-144x144.png">
<link rel="apple-touch-icon-precomposed" sizes="60x60" href="<?=base_url()?>img/favicon/apple-touch-icon-60x60.png">
<link rel="apple-touch-icon-precomposed" sizes="120x120" href="<?=base_url()?>img/favicon/apple-touch-icon-120x120.png">
<link rel="apple-touch-icon-precomposed" sizes="76x76" href="<?=base_url()?>img/favicon/apple-touch-icon-76x76.png">
<link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?=base_url()?>img/favicon/apple-touch-icon-152x152.png">
<link rel="icon" type="image/png" href="<?=base_url()?>img/favicon/favicon-196x196.png" sizes="196x196">
<link rel="icon" type="image/png" href="<?=base_url()?>img/favicon/favicon-96x96.png" sizes="96x96">
<link rel="icon" type="image/png" href="<?=base_url()?>img/favicon/favicon-32x32.png" sizes="32x32">
<link rel="icon" type="image/png" href="<?=base_url()?>img/favicon/favicon-16x16.png" sizes="16x16">
<link rel="icon" type="image/png" href="<?=base_url()?>img/favicon/favicon-128.png" sizes="128x128">
<meta name="application-name" content="&nbsp;">
<meta name="msapplication-TileColor" content="#FFFFFF">
<meta name="msapplication-TileImage" content="img/favicon/mstile-144x144.png">
<meta name="msapplication-square70x70logo" content="img/favicon/mstile-70x70.png">
<meta name="msapplication-square150x150logo" content="img/favicon/mstile-150x150.png">
<meta name="msapplication-wide310x150logo" content="img/favicon/mstile-310x150.png">
<meta name="msapplication-square310x310logo" content="img/favicon/mstile-310x310.png">
<link rel="preconnect" href="https://fonts.gstatic.com/">
<link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;700&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&amp;display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?=base_url()?>font/CS-Interface/style.css">
<link rel="stylesheet" href="<?=base_url()?>css/vendor/bootstrap.min.css">
<link rel="stylesheet" href="<?=base_url()?>css/vendor/OverlayScrollbars.min.css">
<link rel="stylesheet" href="<?=base_url()?>css/styles.css">
<link rel="stylesheet" href="<?=base_url()?>css/main.css">
<script src="<?=base_url()?>js/base/loader.js"></script>
</head>

<body>
<div id="root">
<div id="nav" class="nav-container d-flex">
<div class="nav-content d-flex">
<div class="logo position-relative">
<a href="<?=base_url()?>">
<div><img src="<?=base_url()?>logo.png"></div>
</a>
</div>
<div class="user-container d-flex">
<a href="#" class="d-flex user position-relative" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<img class="profile" alt="profile" src="https://raspeiganhei.com/img/favicon/mstile-310x310.png">
<div class="name"><?=$this->session->userdata('nome')?></div>
</a>
<div class="dropdown-menu dropdown-menu-end user-menu wide">


<div class="row mb-1 ms-0 me-0">

<div class="col-6 ps-1 pe-1">
<ul class="list-unstyled">
<li>
<a href="#">
<i data-acorn-icon="help" class="me-2" data-acorn-size="17"></i>
<span class="align-middle">Faq</span>
</a>
</li>
<li>
	<!-- https://chat.whatsapp.com/KWFniuwKLwP6O8mWyC0RO5 -->
<a href="#" target="_blank">
<i data-acorn-icon="file-text" class="me-2" data-acorn-size="17"></i>
<span class="align-middle">Suporte</span>
</a>
</li>
</ul>
</div>
<div class="col-6 pe-1 ps-1">
<ul class="list-unstyled">
<li>
<a href="#">
<i data-acorn-icon="gear" class="me-2" data-acorn-size="17"></i>
<span class="align-middle">Perfil</span>
</a>
</li>
<li>
<a href="<?=base_url()?>home/sair">
<i data-acorn-icon="logout" class="me-2" data-acorn-size="17"></i>
<span class="align-middle">Sair</span>
</a>
</li>
</ul>
</div>
</div>
</div>
</div>
<ul class="list-unstyled list-inline text-center menu-icons">
<li class="list-inline-item">
<a href="#" id="pinButton" class="pin-button">
<i data-acorn-icon="lock-on" class="unpin" data-acorn-size="18"></i>
<i data-acorn-icon="lock-off" class="pin" data-acorn-size="18"></i>
</a>
</li>
<li class="list-inline-item">
<a href="#" id="colorButton">
<i data-acorn-icon="light-on" class="light" data-acorn-size="18"></i>
<i data-acorn-icon="light-off" class="dark" data-acorn-size="18"></i>
</a>
</li>
<li class="list-inline-item">
<a href="#" data-bs-toggle="dropdown" data-bs-target="#notifications" aria-haspopup="true" aria-expanded="false" class="notification-button">
<div class="position-relative d-inline-flex">
<i data-acorn-icon="bell" data-acorn-size="18"></i>
<span class="position-absolute notification-dot rounded-xl"></span>
</div>
</a>
<div class="dropdown-menu dropdown-menu-end wide notification-dropdown scroll-out" id="notifications">
<div class="scroll">
<ul class="list-unstyled border-last-none">
<li class="mb-3 pb-3 border-bottom border-separator-light d-flex">
<img src="<?=base_url()?>img/profile/profile-1.webp" class="me-3 sw-4 sh-4 rounded-xl align-self-center" alt="...">
<div class="align-self-center">
<a href="#">Joisse Kaycee just sent a new comment!</a>
</div>
</li>
<li class="mb-3 pb-3 border-bottom border-separator-light d-flex">
<img src="<?=base_url()?>img/profile/profile-2.webp" class="me-3 sw-4 sh-4 rounded-xl align-self-center" alt="...">
<div class="align-self-center">
<a href="#">New order received! It is total $147,20.</a>
</div>
</li>
<li class="mb-3 pb-3 border-bottom border-separator-light d-flex">
<img src="<?=base_url()?>img/profile/profile-3.webp" class="me-3 sw-4 sh-4 rounded-xl align-self-center" alt="...">
<div class="align-self-center">
<a href="#">3 items just added to wish list by a user!</a>
</div>
</li>
<li class="pb-3 pb-3 border-bottom border-separator-light d-flex">
<img src="<?=base_url()?>img/profile/profile-6.webp" class="me-3 sw-4 sh-4 rounded-xl align-self-center" alt="...">
<div class="align-self-center">
<a href="#">Kirby Peters just sent a new message!</a>
</div>
</li>
</ul>
</div>
</div>
</li>
</ul>
<div class="menu-container flex-grow-1">
<ul id="menu" class="menu">
<li>
<a href="#relatorios">
<i data-acorn-icon="arrow-top" class="icon" data-acorn-size="18"></i>
<span class="label">Saques</span>
</a>
</li>
<li>
<a href="#relatorios">
<i data-acorn-icon="arrow-bottom" class="icon" data-acorn-size="18"></i>
<span class="label">Depositos</span>
</a>
</li>
<!-- <li>
<a href="#relatorios">
<i data-acorn-icon="user" class="icon" data-acorn-size="18"></i>
<span class="label">Afiliados</span>
</a>
</li> -->
</ul>
</div>
<div class="mobile-buttons-container">
<a href="#" id="mobileMenuButton" class="menu-button">
<i data-acorn-icon="menu"></i>
</a>
</div>
</div>
<div class="nav-shadow"></div>
</div>
<main>
<div class="container">
<div class="row">
<div class="col-auto d-none d-lg-flex">
<ul class="sw-25 side-menu mb-0 primary" id="menuSide">
<li>
<a href="#" data-bs-target="#dashboard">
<i data-acorn-icon="home" class="icon" data-acorn-size="18"></i>
<span class="label">Menu</span>
</a>
</li>
<li>

<ul>
<!-- <li>
<a href="dashboard.html">
<i data-acorn-icon="database" class="icon d-none" data-acorn-size="18"></i>
<span class="label">Dashboard</span>
</a>
</li -->
<!-- 
<li>
<a href="<?=base_url()?>perfil/dd">
<i data-acorn-icon="settings-1" class="icon d-none" data-acorn-size="18"></i>
<span class="label">Perfil</span>
</a>
</li>
<li>
<a href="usuarios.html">
<i data-acorn-icon="user" class="icon d-none" data-acorn-size="18"></i>
<span class="label">Usuários</span>
</a>
</li>
</ul>
</li>
<li>
<a href="#" data-bs-target="#account">
<i data-acorn-icon="user" class="icon" data-acorn-size="18"></i>
<span class="label">Financeiro</span>
</a>
<ul>
<li>
<a href="extrato.html">
<i data-acorn-icon="file-text" class="icon d-none" data-acorn-size="18"></i>
<span class="label">Extrato</span>
</a>
</li>
<li>
<a href="depositos.html">
<i data-acorn-icon="arrow-bottom" class="icon d-none" data-acorn-size="18"></i>
<span class="label">Depositos</span>
</a>
</li>
<li>
<a href="saques.html">
<i data-acorn-icon="arrow-top" class="icon d-none" data-acorn-size="18"></i>
<span class="label">Saques</span>
</a>
</li>
</ul>
</li>
<li>
<a href="#" data-bs-target="#support">
<i data-acorn-icon="help" class="icon" data-acorn-size="18"></i>
<span class="label">Suporte 24/7</span>
</a>
</li>
<ul>
<li>
<a href="#">
<i data-acorn-icon="question-hexagon" class="icon d-none" data-acorn-size="18"></i>
<span class="label">Faq</span>
</a>
</li>
<li>
<a href="ajustes-suporte.html">
<i data-acorn-icon="phone" class="icon d-none" data-acorn-size="18"></i>
<span class="label">Redes Sociais</span>
</a>
</li>
<li>
<a href="videos.html" >
<i data-acorn-icon="video" class="icon d-none" data-acorn-size="18"></i>
<span class="label">Vídeos</span>
</a>
</li>
</ul>
<li>
<a href="#" data-bs-target="#account">
<i data-acorn-icon="user" class="icon" data-acorn-size="18"></i>
<span class="label">Minha Conta</span>
</a>
<ul>
<li> -->
<a href="<?=base_url()?>perfil/dd">
<i data-acorn-icon="user" class="icon d-none" data-acorn-size="18"></i>
<span class="label">Perfil</span>
</a>
</li>
<li>
<a href="<?=base_url()?>home/sair">
<i data-acorn-icon="logout" class="icon d-none" data-acorn-size="18"></i>
<span class="label">Sair</span>
</a>
</li>
</ul>
</li>

</li>
</ul>
</div>
<div class="col">

<div class="card mb-5">
<div class="card-body">
	<form class="d-flex flex-column mb-4" method="post" action="<?=base_url()?>admin/set_edit">
		<div class="mb-3 mx-auto position-relative" id="singleImageUploadExample">
			<!-- <img src="<?=base_url()?>img/profile/profile-9.webp" alt="alternate text" class="rounded-xl border border-separator-light border-4 sw-12 sh-12" id="contactThumbModal"> -->
			<img src="https://raspeiganhei.com/img/favicon/mstile-310x310.png" alt="alternate text" class="rounded-xl border border-separator-light border-4 sw-12 sh-12" id="contactThumbModal">
			<!-- <button class="btn btn-sm btn-icon btn-icon-only btn-separator-light position-absolute rounded-xl e-0 b-0" type="button">
			<i data-acorn-icon="upload"></i>
			</button> -->
			<!-- <input class="file-upload d-none" type="file" accept="image/*"> -->
		</div>
		<div class="mb-3 filled w-100 d-flex flex-column">
			<i data-acorn-icon="user"></i>
			<input class="form-control" placeholder="Name" name="nome" value="<?=$dd->nome?>">
		</div>
		<div class="mb-3 filled w-100 d-flex flex-column">
			<i data-acorn-icon="tag"></i>
			<input class="form-control" placeholder="User Name" value="Brasil">
		</div>
		<div class="mb-3 filled w-100 d-flex flex-column">
			<i data-acorn-icon="email"></i>
			<input class="form-control" placeholder="Email" name="email" value="<?=$dd->email?>" disabled="disabled">
		</div>
		<div class="mb-3 filled w-100 d-flex flex-column">
			<i data-acorn-icon="phone"></i>
			<input class="form-control" placeholder="Phone" name="telefone" value="<?=$dd->telefone?>">
		</div>

		<button class="btn btn-primary" type="submit">Atualizar</button>

	</form>

</div>
</div>

<!-- <h2 class="small-title">Configuração de de Afiliado</h2>
<div class="card mb-5">
<div class="card-body">
<form class="mb-4">


<div class="mb-3 filled custom-control-container">
<i data-acorn-icon="user"></i>
<div class="form-check form-switch">
<input type="checkbox" class="form-check-input" id="quotaCheck" checked="checked">
<label class="form-check-label" for="quotaCheck">Usuário Afiliado</label>
</div>
</div>


</form>
<button class="btn btn-primary">Atualizar</button>
</div>
</div> -->

<h2 class="small-title" id="relatorios">Meus Prêmios (<?=$qr_premios->num_rows()?>)</h2>

<div class="card mb-5">
	
<div class="card-body">
<div class="mb-2 bg-transparent no-shadow d-none d-md-block g-0 sh-3">
<div class="row g-0 h-100 align-content-center">
<div class="col-12 col-md-5 d-flex align-items-center mb-2 mb-md-0 text-muted text-small">HORA DA COMPRA</div>
<div class="col-6 col-md-3 d-flex align-items-center text-alternate text-medium text-muted text-small">PRÊMIO</div>
<div class="col-6 col-md-2 d-flex align-items-center text-alternate text-medium text-muted text-small">RASPADINHA</div>
</div>
</div>
<div class="mb-5 border-last-none">

	<? if($qr_premios->num_rows() > 0){ ?>
		<? foreach($qr_premios->result() as $prem){ ?>
	<div class="h-100 sh-md-4 border-bottom border-separator-light pb-3 mb-3">
		<div class="row g-0 h-100 align-content-center">
			<div class="col-10 col-md-5 d-flex flex-column justify-content-center mb-1 mb-md-0 order-0">
				<div class="text-alternate"><?=$this->padrao_model->converte_data(substr($prem->dt_update,0,10))?></div>
			</div>
			<div class="col-6 col-md-3 d-flex flex-column justify-content-center mb-1 mb-md-0 order-2">
				<div class="text-alternate"><?=$this->session->userdata('nome')?></div>
			</div>
			<div class="col-6 col-md-2 d-flex flex-column justify-content-center mb-1 mb-md-0 order-3">
				<div class="text-alternate">R$ <?=$prem->valor?></div>
			</div>
		</div>
	</div>
	<? }
	} ?>








</div>
</div>
</div>

<h2 class="small-title">Meus Comprovantes (<?=$qr_depositos->num_rows()?>)</h2>
<div class="card mb-5">
<div class="card-body">
<div class="mb-2 bg-transparent no-shadow d-none d-md-block g-0 sh-3">
<div class="row g-0 h-100 align-content-center">
<div class="col-12 col-md-5 d-flex align-items-center mb-2 mb-md-0 text-muted text-small">HORA DA SOLICITAÇÃO</div>
<div class="col-6 col-md-3 d-flex align-items-center text-alternate text-medium text-muted text-small">VALOR</div>
<div class="col-6 col-md-2 d-flex align-items-center text-alternate text-medium text-muted text-small">STATUS</div>
<div class="col-6 col-md-2 d-flex align-items-center text-alternate text-medium justify-content-end text-muted text-small">COMPROVANTE</div>
</div>
</div>
<div class="mb-5 border-last-none">
	<? if($qr_depositos->num_rows() > 0){ ?>
		<? foreach($qr_depositos->result() as $dep){ ?>
	<div class="h-100 sh-md-4 border-bottom border-separator-light pb-3 mb-3">
		<div class="row g-0 h-100 align-content-center">
		<div class="col-10 col-md-5 d-flex flex-column justify-content-center mb-1 mb-md-0 order-0">
			<div class="text-muted text-small d-md-none">Title</div>
			<div class="text-alternate"><?=$this->padrao_model->converte_data(substr($dep->dt_reg,0,10))?></div>
		</div>
		<div class="col-6 col-md-3 d-flex flex-column justify-content-center mb-1 mb-md-0 order-2">
			<div class="text-muted text-small d-md-none">Amount</div>
			<div class="text-alternate">R$ <?=$dep->valor?></div>
		</div>
		<div class="col-6 col-md-2 d-flex flex-column justify-content-center mb-1 mb-md-0 order-3">
			<div class="text-muted text-small d-md-none">Date</div>
			<div class="text-alternate">
				<? if($dep->status == "0" ){ echo "Pendente"; }?>
				<? if($dep->status == "1" ){ echo "Efetuado"; }?>
					
				</div>
		</div>
		<div class="col-2 col-md-2 d-flex flex-column justify-content-center align-items-md-end mb-1 mb-md-0 order-1 order-md-4">
			<a class="link" href="#">
			<i data-acorn-icon="download"></i>
		</a>
		</div>
		</div>
	</div>
	<? }
	} ?>





</div>


<!-- <button class="btn btn-primary">Solicitar Saque</button>  -->

</div>
</div>


</div>
</div>
</div>
</main>
<footer>
<div class="footer-content">
<div class="container">
<div class="row">
<div class="col-12 col-sm-6">
<p class="mb-0 text-muted text-medium">Todos os direitos reservados a <a href="https://sinodeveloper.com" target="_blank"> Sino da Sorte </a></p>
</div>
<div class="col-sm-6 d-none d-sm-block">
<ul class="breadcrumb pt-0 pe-0 mb-0 float-end">
<li class="breadcrumb-item mb-0 text-medium">
<a href="https://www.instagram.com/raspaganha" target="_blank" class="btn-link">Instagram</a>
</li>
<li class="breadcrumb-item mb-0 text-medium">
<a href="https://www.facebook.com/profile.php?id=61558176722398" target="_blank" class="btn-link">Facebook</a>
</li>
<li class="breadcrumb-item mb-0 text-medium"><a href="https://twitter.com/" target="_blank" class="btn-link">Twitter</a></li>
<li class="breadcrumb-item mb-0 text-medium">
<a href="https://www.youtube.com" target="_blank" class="btn-link">Youtube</a>
</li>
</ul>
</div>
</div>
</div>
</div>
</footer>
</div>
<div class="modal fade modal-right scroll-out-negative" id="settings" data-bs-backdrop="true" tabindex="-1" role="dialog" aria-labelledby="settings" aria-hidden="true">
<div class="modal-dialog modal-dialog-scrollable full" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Theme Settings</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<div class="scroll-track-visible">
<div class="mb-5" id="color">
<label class="mb-3 d-inline-block form-label">Color</label>
<div class="row d-flex g-3 justify-content-between flex-wrap mb-3">
<a href="#" class="flex-grow-1 w-50 option col" data-value="light-blue" data-parent="color">
<div class="card rounded-md p-3 mb-1 no-shadow color">
<div class="blue-light"></div>
</div>
<div class="text-muted text-part">
<span class="text-extra-small align-middle">LIGHT BLUE</span>
</div>
</a>
<a href="#" class="flex-grow-1 w-50 option col" data-value="dark-blue" data-parent="color">
<div class="card rounded-md p-3 mb-1 no-shadow color">
<div class="blue-dark"></div>
</div>
<div class="text-muted text-part">
<span class="text-extra-small align-middle">DARK BLUE</span>
</div>
</a>
</div>
<div class="row d-flex g-3 justify-content-between flex-wrap mb-3">
<a href="#" class="flex-grow-1 w-50 option col" data-value="light-teal" data-parent="color">
<div class="card rounded-md p-3 mb-1 no-shadow color">
<div class="teal-light"></div>
</div>
<div class="text-muted text-part">
<span class="text-extra-small align-middle">LIGHT TEAL</span>
</div>
</a>
<a href="#" class="flex-grow-1 w-50 option col" data-value="dark-teal" data-parent="color">
<div class="card rounded-md p-3 mb-1 no-shadow color">
<div class="teal-dark"></div>
</div>
<div class="text-muted text-part">
<span class="text-extra-small align-middle">DARK TEAL</span>
</div>
</a>
</div>
<div class="row d-flex g-3 justify-content-between flex-wrap mb-3">
<a href="#" class="flex-grow-1 w-50 option col" data-value="light-sky" data-parent="color">
<div class="card rounded-md p-3 mb-1 no-shadow color">
<div class="sky-light"></div>
</div>
<div class="text-muted text-part">
<span class="text-extra-small align-middle">LIGHT SKY</span>
</div>
</a>
<a href="#" class="flex-grow-1 w-50 option col" data-value="dark-sky" data-parent="color">
<div class="card rounded-md p-3 mb-1 no-shadow color">
<div class="sky-dark"></div>
</div>
<div class="text-muted text-part">
<span class="text-extra-small align-middle">DARK SKY</span>
</div>
</a>
</div>
<div class="row d-flex g-3 justify-content-between flex-wrap mb-3">
<a href="#" class="flex-grow-1 w-50 option col" data-value="light-red" data-parent="color">
<div class="card rounded-md p-3 mb-1 no-shadow color">
<div class="red-light"></div>
</div>
<div class="text-muted text-part">
<span class="text-extra-small align-middle">LIGHT RED</span>
</div>
</a>
<a href="#" class="flex-grow-1 w-50 option col" data-value="dark-red" data-parent="color">
<div class="card rounded-md p-3 mb-1 no-shadow color">
<div class="red-dark"></div>
</div>
<div class="text-muted text-part">
<span class="text-extra-small align-middle">DARK RED</span>
</div>
</a>
</div>
<div class="row d-flex g-3 justify-content-between flex-wrap mb-3">
<a href="#" class="flex-grow-1 w-50 option col" data-value="light-green" data-parent="color">
<div class="card rounded-md p-3 mb-1 no-shadow color">
<div class="green-light"></div>
</div>
<div class="text-muted text-part">
<span class="text-extra-small align-middle">LIGHT GREEN</span>
</div>
</a>
<a href="#" class="flex-grow-1 w-50 option col" data-value="dark-green" data-parent="color">
<div class="card rounded-md p-3 mb-1 no-shadow color">
<div class="green-dark"></div>
</div>
<div class="text-muted text-part">
<span class="text-extra-small align-middle">DARK GREEN</span>
</div>
</a>
</div>
<div class="row d-flex g-3 justify-content-between flex-wrap mb-3">
<a href="#" class="flex-grow-1 w-50 option col" data-value="light-lime" data-parent="color">
<div class="card rounded-md p-3 mb-1 no-shadow color">
<div class="lime-light"></div>
</div>
<div class="text-muted text-part">
<span class="text-extra-small align-middle">LIGHT LIME</span>
</div>
</a>
<a href="#" class="flex-grow-1 w-50 option col" data-value="dark-lime" data-parent="color">
<div class="card rounded-md p-3 mb-1 no-shadow color">
<div class="lime-dark"></div>
</div>
<div class="text-muted text-part">
<span class="text-extra-small align-middle">DARK LIME</span>
</div>
</a>
</div>
<div class="row d-flex g-3 justify-content-between flex-wrap mb-3">
<a href="#" class="flex-grow-1 w-50 option col" data-value="light-pink" data-parent="color">
<div class="card rounded-md p-3 mb-1 no-shadow color">
<div class="pink-light"></div>
</div>
<div class="text-muted text-part">
<span class="text-extra-small align-middle">LIGHT PINK</span>
</div>
</a>
<a href="#" class="flex-grow-1 w-50 option col" data-value="dark-pink" data-parent="color">
<div class="card rounded-md p-3 mb-1 no-shadow color">
<div class="pink-dark"></div>
</div>
<div class="text-muted text-part">
<span class="text-extra-small align-middle">DARK PINK</span>
</div>
</a>
</div>
<div class="row d-flex g-3 justify-content-between flex-wrap mb-3">
<a href="#" class="flex-grow-1 w-50 option col" data-value="light-purple" data-parent="color">
<div class="card rounded-md p-3 mb-1 no-shadow color">
<div class="purple-light"></div>
</div>
<div class="text-muted text-part">
<span class="text-extra-small align-middle">LIGHT PURPLE</span>
</div>
</a>
<a href="#" class="flex-grow-1 w-50 option col" data-value="dark-purple" data-parent="color">
<div class="card rounded-md p-3 mb-1 no-shadow color">
<div class="purple-dark"></div>
</div>
<div class="text-muted text-part">
<span class="text-extra-small align-middle">DARK PURPLE</span>
</div>
</a>
</div>
</div>
<div class="mb-5" id="navcolor">
<label class="mb-3 d-inline-block form-label">Override Nav Palette</label>
<div class="row d-flex g-3 justify-content-between flex-wrap">
<a href="#" class="flex-grow-1 w-33 option col" data-value="default" data-parent="navcolor">
<div class="card rounded-md p-3 mb-1 no-shadow">
<div class="figure figure-primary top"></div>
<div class="figure figure-secondary bottom"></div>
</div>
<div class="text-muted text-part">
<span class="text-extra-small align-middle">DEFAULT</span>
</div>
</a>
<a href="#" class="flex-grow-1 w-33 option col" data-value="light" data-parent="navcolor">
<div class="card rounded-md p-3 mb-1 no-shadow">
<div class="figure figure-secondary figure-light top"></div>
<div class="figure figure-secondary bottom"></div>
</div>
<div class="text-muted text-part">
<span class="text-extra-small align-middle">LIGHT</span>
</div>
</a>
<a href="#" class="flex-grow-1 w-33 option col" data-value="dark" data-parent="navcolor">
<div class="card rounded-md p-3 mb-1 no-shadow">
<div class="figure figure-muted figure-dark top"></div>
<div class="figure figure-secondary bottom"></div>
</div>
<div class="text-muted text-part">
<span class="text-extra-small align-middle">DARK</span>
</div>
</a>
</div>
</div>
<div class="mb-5" id="behaviour">
<label class="mb-3 d-inline-block form-label">Menu Behaviour</label>
<div class="row d-flex g-3 justify-content-between flex-wrap">
<a href="#" class="flex-grow-1 w-50 option col" data-value="pinned" data-parent="behaviour">
<div class="card rounded-md p-3 mb-1 no-shadow">
<div class="figure figure-primary left large"></div>
<div class="figure figure-secondary right small"></div>
</div>
<div class="text-muted text-part">
<span class="text-extra-small align-middle">PINNED</span>
</div>
</a>
<a href="#" class="flex-grow-1 w-50 option col" data-value="unpinned" data-parent="behaviour">
<div class="card rounded-md p-3 mb-1 no-shadow">
<div class="figure figure-primary left"></div>
<div class="figure figure-secondary right"></div>
</div>
<div class="text-muted text-part">
<span class="text-extra-small align-middle">UNPINNED</span>
</div>
</a>
</div>
</div>
<div class="mb-5" id="layout">
<label class="mb-3 d-inline-block form-label">Layout</label>
<div class="row d-flex g-3 justify-content-between flex-wrap">
<a href="#" class="flex-grow-1 w-50 option col" data-value="fluid" data-parent="layout">
<div class="card rounded-md p-3 mb-1 no-shadow">
<div class="figure figure-primary top"></div>
<div class="figure figure-secondary bottom"></div>
</div>
<div class="text-muted text-part">
<span class="text-extra-small align-middle">FLUID</span>
</div>
</a>
<a href="#" class="flex-grow-1 w-50 option col" data-value="boxed" data-parent="layout">
<div class="card rounded-md p-3 mb-1 no-shadow">
<div class="figure figure-primary top"></div>
<div class="figure figure-secondary bottom small"></div>
</div>
<div class="text-muted text-part">
<span class="text-extra-small align-middle">BOXED</span>
</div>
</a>
</div>
</div>
<div class="mb-5" id="radius">
<label class="mb-3 d-inline-block form-label">Radius</label>
<div class="row d-flex g-3 justify-content-between flex-wrap">
<a href="#" class="flex-grow-1 w-33 option col" data-value="rounded" data-parent="radius">
<div class="card rounded-md radius-rounded p-3 mb-1 no-shadow">
<div class="figure figure-primary top"></div>
<div class="figure figure-secondary bottom"></div>
</div>
<div class="text-muted text-part">
<span class="text-extra-small align-middle">ROUNDED</span>
</div>
</a>
<a href="#" class="flex-grow-1 w-33 option col" data-value="standard" data-parent="radius">
<div class="card rounded-md radius-regular p-3 mb-1 no-shadow">
<div class="figure figure-primary top"></div>
<div class="figure figure-secondary bottom"></div>
</div>
<div class="text-muted text-part">
<span class="text-extra-small align-middle">STANDARD</span>
</div>
</a>
<a href="#" class="flex-grow-1 w-33 option col" data-value="flat" data-parent="radius">
<div class="card rounded-md radius-flat p-3 mb-1 no-shadow">
<div class="figure figure-primary top"></div>
<div class="figure figure-secondary bottom"></div>
</div>
<div class="text-muted text-part">
<span class="text-extra-small align-middle">FLAT</span>
</div>
</a>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="modal fade modal-right scroll-out-negative" id="niches" data-bs-backdrop="true" tabindex="-1" role="dialog" aria-labelledby="niches" aria-hidden="true">
<div class="modal-dialog modal-dialog-scrollable full" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Niches</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<div class="scroll-track-visible">
<div class="mb-5">
<label class="mb-2 d-inline-block form-label">Classic Dashboard</label>
<div class="hover-reveal-buttons position-relative hover-reveal cursor-default">
<div class="position-relative mb-3 mb-lg-5 rounded-sm">
<img src="https://acorn.coloredstrategies.com/img/page/classic-dashboard.webp" class="img-fluid rounded-sm lower-opacity border border-separator-light" alt="card image">
<div class="position-absolute reveal-content rounded-sm absolute-center-vertical text-center w-100">
<a target="_blank" href="https://acorn-html-classic-dashboard.coloredstrategies.com/" class="btn btn-primary btn-sm sw-10 sw-lg-12 d-block mx-auto my-1">
Html
</a>
<a target="_blank" href="https://acorn-laravel-classic-dashboard.coloredstrategies.com/" class="btn btn-primary btn-sm sw-10 sw-lg-12 d-block mx-auto my-1">
Laravel
</a>
<a target="_blank" href="https://acorn-dotnet-classic-dashboard.coloredstrategies.com/" class="btn btn-primary btn-sm sw-10 sw-lg-12 d-block mx-auto my-1">
.Net5
</a>
</div>
</div>
</div>
</div>
<div class="mb-5">
<label class="mb-2 d-inline-block form-label">Medical Assistant</label>
<div class="hover-reveal-buttons position-relative hover-reveal cursor-default">
<div class="position-relative mb-3 mb-lg-5 rounded-sm">
<img src="https://acorn.coloredstrategies.com/img/page/medical-assistant.webp" class="img-fluid rounded-sm lower-opacity border border-separator-light" alt="card image">
<div class="position-absolute reveal-content rounded-sm absolute-center-vertical text-center w-100">
<a target="_blank" href="https://acorn-html-medical-assistant.coloredstrategies.com/" class="btn btn-primary btn-sm sw-10 sw-lg-12 d-block mx-auto my-1">
Html
</a>
<a target="_blank" href="https://acorn-laravel-medical-assistant.coloredstrategies.com/" class="btn btn-primary btn-sm sw-10 sw-lg-12 d-block mx-auto my-1">
Laravel
</a>
<a target="_blank" href="https://acorn-dotnet-medical-assistant.coloredstrategies.com/" class="btn btn-primary btn-sm sw-10 sw-lg-12 d-block mx-auto my-1">
.Net5
</a>
</div>
</div>
</div>
</div>
<div class="mb-5">
<label class="mb-2 d-inline-block form-label">Service Provider</label>
<div class="hover-reveal-buttons position-relative hover-reveal cursor-default">
<div class="position-relative mb-3 mb-lg-5 rounded-sm">
<img src="https://acorn.coloredstrategies.com/img/page/service-provider.webp" class="img-fluid rounded-sm lower-opacity border border-separator-light" alt="card image">
<div class="position-absolute reveal-content rounded-sm absolute-center-vertical text-center w-100">
<a target="_blank" href="index.html" class="btn btn-primary btn-sm sw-10 sw-lg-12 d-block mx-auto my-1">
Html
</a>
<a target="_blank" href="https://acorn-laravel-service-provider.coloredstrategies.com/" class="btn btn-primary btn-sm sw-10 sw-lg-12 d-block mx-auto my-1">
Laravel
</a>
<a target="_blank" href="https://acorn-dotnet-service-provider.coloredstrategies.com/" class="btn btn-primary btn-sm sw-10 sw-lg-12 d-block mx-auto my-1">
.Net5
</a>
</div>
</div>
</div>
</div>
<div class="mb-5">
<label class="mb-2 d-inline-block form-label">Elearning Portal</label>
<div class="hover-reveal-buttons position-relative hover-reveal cursor-default">
<div class="position-relative mb-3 mb-lg-5 rounded-sm">
<img src="https://acorn.coloredstrategies.com/img/page/elearning-portal.webp" class="img-fluid rounded-sm lower-opacity border border-separator-light" alt="card image">
<div class="position-absolute reveal-content rounded-sm absolute-center-vertical text-center w-100">
<a target="_blank" href="https://acorn-html-elearning-portal.coloredstrategies.com/" class="btn btn-primary btn-sm sw-10 sw-lg-12 d-block mx-auto my-1">
Html
</a>
<a target="_blank" href="https://acorn-laravel-elearning-portal.coloredstrategies.com/" class="btn btn-primary btn-sm sw-10 sw-lg-12 d-block mx-auto my-1">
Laravel
</a>
<a target="_blank" href="https://acorn-dotnet-elearning-portal.coloredstrategies.com/" class="btn btn-primary btn-sm sw-10 sw-lg-12 d-block mx-auto my-1">
.Net5
</a>
</div>
</div>
</div>
</div>
<div class="mb-5">
<label class="mb-2 d-inline-block form-label">Ecommerce Platform</label>
<div class="hover-reveal-buttons position-relative hover-reveal cursor-default">
<div class="position-relative mb-3 mb-lg-5 rounded-sm">
<img src="https://acorn.coloredstrategies.com/img/page/ecommerce-platform.webp" class="img-fluid rounded-sm lower-opacity border border-separator-light" alt="card image">
<div class="position-absolute reveal-content rounded-sm absolute-center-vertical text-center w-100">
<a target="_blank" href="https://acorn-html-ecommerce-platform.coloredstrategies.com/" class="btn btn-primary btn-sm sw-10 sw-lg-12 d-block mx-auto my-1">
Html
</a>
<a target="_blank" href="https://acorn-laravel-ecommerce-platform.coloredstrategies.com/" class="btn btn-primary btn-sm sw-10 sw-lg-12 d-block mx-auto my-1">
Laravel
</a>
<a target="_blank" href="https://acorn-dotnet-ecommerce-platform.coloredstrategies.com/" class="btn btn-primary btn-sm sw-10 sw-lg-12 d-block mx-auto my-1">
.Net5
</a>
</div>
</div>
</div>
</div>
<div class="mb-5">
<label class="mb-2 d-inline-block form-label">Starter Project</label>
<div class="hover-reveal-buttons position-relative hover-reveal cursor-default">
<div class="position-relative mb-3 mb-lg-5 rounded-sm">
<img src="https://acorn.coloredstrategies.com/img/page/starter-project.webp" class="img-fluid rounded-sm lower-opacity border border-separator-light" alt="card image">
<div class="position-absolute reveal-content rounded-sm absolute-center-vertical text-center w-100">
<a target="_blank" href="https://acorn-html-starter-project.coloredstrategies.com/" class="btn btn-primary btn-sm sw-10 sw-lg-12 d-block mx-auto my-1">
Html
</a>
<a target="_blank" href="https://acorn-laravel-starter-project.coloredstrategies.com/" class="btn btn-primary btn-sm sw-10 sw-lg-12 d-block mx-auto my-1">
Laravel
</a>
<a target="_blank" href="https://acorn-dotnet-starter-project.coloredstrategies.com/" class="btn btn-primary btn-sm sw-10 sw-lg-12 d-block mx-auto my-1">
.Net5
</a>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<div class="modal fade modal-under-nav modal-search modal-close-out" id="searchPagesModal" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header border-0 p-0">
<button type="button" class="btn-close btn btn-icon btn-icon-only btn-foreground" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body ps-5 pe-5 pb-0 border-0">
<input id="searchPagesInput" class="form-control form-control-xl borderless ps-0 pe-0 mb-1 auto-complete" type="text" autocomplete="off">
</div>
<div class="modal-footer border-top justify-content-start ps-5 pe-5 pb-3 pt-3 border-0">
<span class="text-alternate d-inline-block m-0 me-3">
<i data-acorn-icon="arrow-bottom" data-acorn-size="15" class="text-alternate align-middle me-1"></i>
<span class="align-middle text-medium">Navigate</span>
</span>
<span class="text-alternate d-inline-block m-0 me-3">
<i data-acorn-icon="arrow-bottom-left" data-acorn-size="15" class="text-alternate align-middle me-1"></i>
<span class="align-middle text-medium">Select</span>
</span>
</div>
</div>
</div>
</div>
<script src="<?=base_url()?>js/vendor/jquery-3.5.1.min.js"></script>
<script src="<?=base_url()?>js/vendor/bootstrap.bundle.min.js"></script>
<script src="<?=base_url()?>js/vendor/OverlayScrollbars.min.js"></script>
<script src="<?=base_url()?>js/vendor/autoComplete.min.js"></script>
<script src="<?=base_url()?>js/vendor/clamp.min.js"></script>
<script src="<?=base_url()?>icon/acorn-icons.js"></script>
<script src="<?=base_url()?>icon/acorn-icons-interface.js"></script>
<script src="<?=base_url()?>icon/acorn-icons-commerce.js"></script>
<script src="<?=base_url()?>js/vendor/select2.full.min.js"></script>
<script src="<?=base_url()?>js/vendor/singleimageupload.js"></script>
<script src="<?=base_url()?>js/base/helpers.js"></script>
<script src="<?=base_url()?>js/base/globals.js"></script>
<script src="<?=base_url()?>js/base/nav.js"></script>
<script src="<?=base_url()?>js/base/search.js"></script>
<script src="<?=base_url()?>js/base/settings.js"></script>
<script src="<?=base_url()?>js/pages/account.settings.js"></script>
<script src="<?=base_url()?>js/common.js"></script>
<script src="<?=base_url()?>js/scripts.js"></script>
</body>

</html>

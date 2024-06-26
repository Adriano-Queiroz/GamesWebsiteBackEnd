<!DOCTYPE html>
<html lang="en" data-footer="true">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
<title>Acorn Admin Template | Getting Started</title>
<meta name="description" content="Service Provider Getting Started">

<!-- <link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?=base_url()?>img/favicon/apple-touch-icon-57x57.png">
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
<meta name="msapplication-TileImage" content="<?=base_url()?>img/favicon/mstile-144x144.png">
<meta name="msapplication-square70x70logo" content="<?=base_url()?>img/favicon/mstile-70x70.png">
<meta name="msapplication-square150x150logo" content="<?=base_url()?>img/favicon/mstile-150x150.png">
<meta name="msapplication-wide310x150logo" content="<?=base_url()?>img/favicon/mstile-310x150.png">
<meta name="msapplication-square310x310logo" content="<?=base_url()?>img/favicon/mstile-310x310.png">
<link rel="preconnect" href="https://fonts.gstatic.com/">
<link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;700&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&amp;display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?=base_url()?>font/CS-Interface/style.css">
<link rel="stylesheet" href="<?=base_url()?>css/vendor/bootstrap.min.css">
<link rel="stylesheet" href="<?=base_url()?>css/vendor/OverlayScrollbars.min.css">
<link rel="stylesheet" href="<?=base_url()?>css/styles.css">
<link rel="stylesheet" href="<?=base_url()?>css/main.css">
<script src="<?=base_url()?>js/base/loader.js"></script> -->


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
<meta name="msapplication-square70x70logo" content="<?=base_url()?>img/favicon/mstile-70x70.png">
<meta name="msapplication-square150x150logo" content="<?=base_url()?>img/favicon/mstile-150x150.png">
<meta name="msapplication-wide310x150logo" content="<?=base_url()?>img/favicon/mstile-310x150.png">
<meta name="msapplication-square310x310logo" content="<?=base_url()?>img/favicon/mstile-310x310.png">
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
<a href="dashboard.html">
<div><img src="<?=base_url()?>logo.png"></div>
</a>
</div>
<div class="user-container d-flex">
<a href="#" class="d-flex user position-relative" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<img class="profile" alt="profile" src="<?=base_url()?>img/profile/profile-9.webp">
<div class="name"><?=$this->session->userdata('nome')?></div>
<div class="name"><?=$this->session->userdata('id')?></div>
</a>
<div class="dropdown-menu dropdown-menu-end user-menu wide">


<div class="row mb-1 ms-0 me-0">

<div class="col-6 ps-1 pe-1">
<ul class="list-unstyled">
<li>
<a href="faq.html">
<i data-acorn-icon="help" class="me-2" data-acorn-size="17"></i>
<span class="align-middle">Faq</span>
</a>
</li>
<li>
<a href="https://chat.whatsapp.com/KWFniuwKLwP6O8mWyC0RO5" target="_blank">
<i data-acorn-icon="file-text" class="me-2" data-acorn-size="17"></i>
<span class="align-middle">Suporte</span>
</a>
</li>
</ul>
</div>
<div class="col-6 pe-1 ps-1">
<ul class="list-unstyled">
<li>
<a href="perfil.html">
<i data-acorn-icon="gear" class="me-2" data-acorn-size="17"></i>
<span class="align-middle">Perfil</span>
</a>
</li>
<li>
<a href="<?=base_url()?>adm/usuarios/logout">
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
<a href="saques.html">
<i data-acorn-icon="arrow-top" class="icon" data-acorn-size="18"></i>
<span class="label">Sacar</span>
</a>
</li>
<li>
<a href="depositos.html">
<i data-acorn-icon="arrow-bottom" class="icon" data-acorn-size="18"></i>
<span class="label">Depositar</span>
</a>
</li>
<li>
<a href="https://www.instagram.com/raspaganha">
<i data-acorn-icon="instagram" class="icon" data-acorn-size="18"></i>
<span class="label">Instagram</span>
</a>
</li>
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
<li>
<a href="Services.Database.html">
<i data-acorn-icon="database" class="icon d-none" data-acorn-size="18"></i>
<span class="label">Dashboard</span>
</a>
</li>
<li>
<a href="ajustes.html">
<i data-acorn-icon="settings-1" class="icon d-none" data-acorn-size="18"></i>
<span class="label">Ajustes</span>
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
<a href="#" data-bs-target="#account">
<i data-acorn-icon="user" class="icon" data-acorn-size="18"></i>
<span class="label">Minha Conta</span>
</a>
<ul>
<li>
<a href="perfil.html">
<i data-acorn-icon="user" class="icon d-none" data-acorn-size="18"></i>
<span class="label">Perfil</span>
</a>
</li>
<li>
<a href="#">
<i data-acorn-icon="logout" class="icon d-none" data-acorn-size="18"></i>
<span class="label">Sair</span>
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
<a href="faq.html">
<i data-acorn-icon="question-hexagon" class="icon d-none" data-acorn-size="18"></i>
<span class="label">Faq</span>
</a>
</li>
<li>
<a href="https://chat.whatsapp.com/KWFniuwKLwP6O8mWyC0RO5" target="_blank">
<i data-acorn-icon="phone" class="icon d-none" data-acorn-size="18"></i>
<span class="label">Whatsapp</span>
</a>
</li>
</ul>
</li>
</ul>
</div>


<div class="col">
<div class="page-title-container mb-3">
<div class="row">
<!--<div class="col mb-2">
<h1 class="mb-2 pb-0 display-4" id="title">Getting Started</h1>
<div class="text-muted font-heading text-small">Let us manage the database engines for your applications so you can focus on building.</div>
</div>-->
</div>
</div>
<div class="row">
<div class="col-12 col-xl-8 mb-8">
<div class="card h-100-card">
<div class="card-body d-flex flex-column justify-content-between">
<form>
<div class="text-alternate">Data Início</div>
<br>
<div class="mb-3 filled">
<i data-acorn-icon="clock"></i>
<input class="form-control" placeholder="08/05/2024">
</div>
<div class="text-alternate">Data Fim</div>
<br>
<div class="mb-3 filled">
<i data-acorn-icon="clock"></i>
<input class="form-control" placeholder="08/05/2024">
</div>
<a href="#" class="btn btn-icon btn-icon-start btn-outline-primary mt-1">
<i data-acorn-icon="search"></i>
<span>Pesquisar</span>
</a>
</form>
</div>
</div>
</div>
<div class="col-12 col-lg-4 mb-5">
<div class="scroll-out">
<div class="scroll-by-count" data-count="4">
<div class="card mb-2 hover-border-primary">
<a href="Services.DatabaseAdd.html" class="row g-0 sh-9">
<div class="col-auto">
<div class="sw-9 sh-9 d-inline-block d-flex justify-content-center align-items-center">
<div class="fw-bold text-primary">
<i data-acorn-icon="server"></i>
</div>
</div>
</div>
<div class="col">
<div class="card-body d-flex flex-column ps-0 pt-0 pb-0 h-100 justify-content-center">
<div class="d-flex flex-column">
<div class="text-alternate">Bônus de Boas Vindas</div>
<div class="text-small text-muted">Snaps muffin macaroon.</div>
</div>
</div>
</div>
</a>
</div>
<div class="card mb-2 hover-border-primary">
<a href="Services.Storage.html" class="row g-0 sh-9">
<div class="col-auto">
<div class="sw-9 sh-9 d-inline-block d-flex justify-content-center align-items-center">
<div class="fw-bold text-primary">
<i data-acorn-icon="cloud-download"></i>
</div>
</div>
</div>
<div class="col">
<div class="card-body d-flex flex-column ps-0 pt-0 pb-0 h-100 justify-content-center">
<div class="d-flex flex-column">
<div class="text-alternate">Bônus de Recarga Diária</div>
<div class="text-small text-muted">Brownie ice cream marshmallow topping.</div>
</div>
</div>
</div>
</a>
</div>
<div class="card mb-2 hover-border-primary">
<a href="Account.Security.html" class="row g-0 sh-9">
<div class="col-auto">
<div class="sw-9 sh-9 d-inline-block d-flex justify-content-center align-items-center">
<div class="fw-bold text-primary">
<i data-acorn-icon="shield"></i>
</div>
</div>
</div>
<div class="col">
<div class="card-body d-flex flex-column ps-0 pt-0 pb-0 h-100 justify-content-center">
<div class="d-flex flex-column">
<div class="text-alternate">Bônus na Primeira Recarga</div>
<div class="text-small text-muted">Sugar plum gummi bears jujubes.</div>
</div>
</div>
</div>
</a>
</div>
<div class="card mb-2 hover-border-primary">
<a href="Services.DatabaseDetail.html" class="row g-0 sh-9">
<div class="col-auto">
<div class="sw-9 sh-9 d-inline-block d-flex justify-content-center align-items-center">
<div class="fw-bold text-primary">
<i data-acorn-icon="chart-4"></i>
</div>
</div>
</div>
<div class="col">
<div class="card-body d-flex flex-column ps-0 pt-0 pb-0 h-100 justify-content-center">
<div class="d-flex flex-column">
<div class="text-alternate">Configuração de Lucro</div>
<div class="text-small text-muted">Jujubes candy jelly-o topping.</div>
</div>
</div>
</div>
</a>
</div>
<div class="card mb-2 hover-border-primary">
<a href="Support.Docs.html" class="row g-0 sh-9">
<div class="col-auto">
<div class="sw-9 sh-9 d-inline-block d-flex justify-content-center align-items-center">
<div class="fw-bold text-primary">
<i data-acorn-icon="category"></i>
</div>
</div>
</div>
<div class="col">
<div class="card-body d-flex flex-column ps-0 pt-0 pb-0 h-100 justify-content-center">
<div class="d-flex flex-column">
<div class="text-alternate">Integration Guides</div>
<div class="text-small text-muted">Jujubes candy jelly-o topping.</div>
</div>
</div>
</div>
</a>
</div>
</div>
</div>
</div>
</div>
<div class="mb-5">
<h2 class="small-title">Informação Geral Sistema</h2>
<div class="row g-2">
<div class="col-12 col-lg-6 col-xxl-3">
<div class="card">
<div class="card-body">
<div class="heading mb-0 d-flex justify-content-between lh-1-25 mb-3">
<span>Recargas Efetuadas <br>(08/05/2024 - 08/05/2024)</span>
<i data-acorn-icon="screen" class="text-primary"></i>
</div>
<div class="text-small text-success mb-1">
</div>
<div class="cta-1 text-primary">R$ 6.718,44</div>
</div>
</div>
</div>
<div class="col-12 col-lg-6 col-xxl-3">
<div class="card">
<div class="card-body">
<div class="heading mb-0 d-flex justify-content-between lh-1-25 mb-3">
<span>Raspadinhas Vendidas <br>(08/05/2024 - 08/05/2024)
</span>
<i data-acorn-icon="cart" class="text-primary"></i>
</div>
<div class="text-small text-success mb-1">
</div>
<div class="cta-1 text-primary">R$ 6.718,44</div>
</div>
</div>
</div>
<div class="col-12 col-lg-6 col-xxl-3">
<div class="card">
<div class="card-body">
<div class="heading mb-0 d-flex justify-content-between lh-1-25 mb-3">
<span>Total Saques <br>(Desde o Inicio)</span>
<i data-acorn-icon="clock" class="text-primary"></i>
</div>
<div class="text-small text-danger mb-1">
</div>
<div class="cta-1 text-primary">R$ 6.718,44</div>
</div>
</div>
</div>
<div class="col-12 col-lg-6 col-xxl-3">
<div class="card">
<div class="card-body">
<div class="heading mb-0 d-flex justify-content-between lh-1-25 mb-3">
<span>Saldo Atual <br>Usuários
</span>
<i data-acorn-icon="navigate-diagonal" class="text-primary"></i>
</div>
<div class="text-small text-success mb-1">
</div>
<div class="cta-1 text-primary">R$ 6.718,44</div>
</div>
</div>
</div>
</div>
</div>

<h2 class="small-title">Prêmios Distribuídos de 08/05/2024 - 08/05/2024</h2><br>

<div class="row mb-2">
<div class="col-sm-12 col-md-5 col-lg-3 col-xxl-2 mb-1">
<div class="d-inline-block float-md-start me-1 mb-1 search-input-container w-100 shadow bg-foreground">
<input class="form-control" placeholder="Pesquisar">
<span class="search-magnifier-icon">
<i data-acorn-icon="search"></i>
</span>
<span class="search-delete-icon d-none">
<i data-acorn-icon="close"></i>
</span>
</div>
</div>
<div class="col-sm-12 col-md-7 col-lg-9 col-xxl-10 text-end mb-1">
<div class="d-inline-block">
<div class="d-inline-block">
<button class="btn p-0" data-bs-toggle="dropdown" type="button" data-bs-offset="0,3">
<span class="btn btn-icon btn-icon-only btn-foreground-alternate shadow dropdown" data-bs-delay="0" data-bs-placement="top" data-bs-toggle="tooltip" title="Export">
<i data-acorn-icon="download"></i>
</span>
</button>
<div class="dropdown-menu shadow dropdown-menu-end">
<button class="dropdown-item export-copy" type="button">Copy</button>
<button class="dropdown-item export-excel" type="button">Excel</button>
<button class="dropdown-item export-cvs" type="button">Cvs</button>
</div>
</div>
<div class="dropdown-as-select d-inline-block ms-1" data-childselector="span">
<button class="btn p-0 shadow" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-bs-offset="0,3">
<span class="btn btn-foreground-alternate dropdown-toggle" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-delay="0" title="Item Count">
10 Itens
</span>
</button>
<div class="dropdown-menu shadow dropdown-menu-end">
<a class="dropdown-item active" href="#">10 Itens</a>
<a class="dropdown-item " href="#">20 Itens</a>
<a class="dropdown-item" href="#">100 Itens</a>
</div>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-12">
<div class="card">
<div class="card-body">
<div class="mb-2 bg-transparent no-shadow d-none d-md-block g-0 sh-3">
<div class="row g-0 h-100 align-content-center">
<div class="col-12 col-md-5 d-flex align-items-center mb-2 mb-md-0 text-muted text-small">NOME</div>
<div class="col-6 col-md-3 d-flex align-items-center text-alternate text-medium text-muted text-small">E-MAIL</div>
<div class="col-6 col-md-2 d-flex align-items-center text-alternate text-medium text-muted text-small">TELEFONE</div>
<div class="col-6 col-md-2 d-flex align-items-center text-alternate text-medium justify-content-end text-muted text-small">CPF</div>
</div>
</div>
<div class="mb-5 border-last-none">
<div class="h-100 sh-md-4 border-bottom border-separator-light pb-3 mb-3">
<div class="row g-0 h-100 align-content-center">
<div class="col-10 col-md-5 d-flex flex-column justify-content-center mb-1 mb-md-0 order-0">
<div class="text-muted text-small d-md-none">Title</div>
<div class="text-alternate">Monthly Payment</div>
</div>
<div class="col-6 col-md-3 d-flex flex-column justify-content-center mb-1 mb-md-0 order-2">
<div class="text-muted text-small d-md-none">Amount</div>
<div class="text-alternate">$ 16.25</div>
</div>
<div class="col-6 col-md-2 d-flex flex-column justify-content-center mb-1 mb-md-0 order-3">
<div class="text-muted text-small d-md-none">Date</div>
<div class="text-alternate">21.03.2021</div>
</div>
<div class="col-2 col-md-2 d-flex flex-column justify-content-center align-items-md-end mb-1 mb-md-0 order-1 order-md-4">
<a class="link" href="#">
<i data-acorn-icon="download"></i>
</a>
</div>
</div>
</div>
<div class="h-100 sh-md-4 border-bottom border-separator-light pb-3 mb-3">
<div class="row g-0 h-100 align-content-center">
<div class="col-10 col-md-5 d-flex flex-column justify-content-center mb-1 mb-md-0 order-0">
<div class="text-muted text-small d-md-none">Title</div>
<div class="text-alternate">Overuse Payment</div>
</div>
<div class="col-6 col-md-3 d-flex flex-column justify-content-center mb-1 mb-md-0 order-2">
<div class="text-muted text-small d-md-none">Amount</div>
<div class="text-alternate">$ 8.50</div>
</div>
<div class="col-6 col-md-2 d-flex flex-column justify-content-center mb-1 mb-md-0 order-3">
<div class="text-muted text-small d-md-none">Date</div>
<div class="text-alternate">21.03.2021</div>
</div>
<div class="col-2 col-md-2 d-flex flex-column justify-content-center align-items-md-end mb-1 mb-md-0 order-1 order-md-4">
<a class="link" href="#">
<i data-acorn-icon="download"></i>
</a>
</div>
</div>
</div>
<div class="h-100 sh-md-4 border-bottom border-separator-light pb-3 mb-3">
<div class="row g-0 h-100 align-content-center">
<div class="col-10 col-md-5 d-flex flex-column justify-content-center mb-1 mb-md-0 order-0">
<div class="text-muted text-small d-md-none">Title</div>
<div class="text-alternate">Invoice</div>
</div>
<div class="col-6 col-md-3 d-flex flex-column justify-content-center mb-1 mb-md-0 order-2">
<div class="text-muted text-small d-md-none">Amount</div>
<div class="text-alternate">$ 16.25</div>
</div>
<div class="col-6 col-md-2 d-flex flex-column justify-content-center mb-1 mb-md-0 order-3">
<div class="text-muted text-small d-md-none">Date</div>
<div class="text-alternate">21.03.2021</div>
</div>
<div class="col-2 col-md-2 d-flex flex-column justify-content-center align-items-md-end mb-1 mb-md-0 order-1 order-md-4">
<div class="text-alternate">
<button class="btn btn-foreground btn-outline-hover pe-0"><i data-acorn-icon="download"></i></button>
</div>
</div>
</div>
</div>
<div class="h-100 sh-md-4 border-bottom border-separator-light pb-3 mb-3">
<div class="row g-0 h-100 align-content-center">
<div class="col-10 col-md-5 d-flex flex-column justify-content-center mb-1 mb-md-0 order-0">
<div class="text-muted text-small d-md-none">Title</div>
<div class="text-alternate">Monthly Payment</div>
</div>
<div class="col-6 col-md-3 d-flex flex-column justify-content-center mb-1 mb-md-0 order-2">
<div class="text-muted text-small d-md-none">Amount</div>
<div class="text-alternate">$ 16.25</div>
</div>
<div class="col-6 col-md-2 d-flex flex-column justify-content-center mb-1 mb-md-0 order-3">
<div class="text-muted text-small d-md-none">Date</div>
<div class="text-alternate">21.02.2021</div>
</div>
<div class="col-2 col-md-2 d-flex flex-column justify-content-center align-items-md-end mb-1 mb-md-0 order-1 order-md-4">
<div class="text-alternate">
<button class="btn btn-foreground btn-outline-hover pe-0"><i data-acorn-icon="download"></i></button>
</div>
</div>
</div>
</div>
<div class="h-100 sh-md-4 border-bottom border-separator-light pb-3 mb-3">
<div class="row g-0 h-100 align-content-center">
<div class="col-10 col-md-5 d-flex flex-column justify-content-center mb-1 mb-md-0 order-0">
<div class="text-muted text-small d-md-none">Title</div>
<div class="text-alternate">Overuse Payment</div>
</div>
<div class="col-6 col-md-3 d-flex flex-column justify-content-center mb-1 mb-md-0 order-2">
<div class="text-muted text-small d-md-none">Amount</div>
<div class="text-alternate">$ 4.50</div>
</div>
<div class="col-6 col-md-2 d-flex flex-column justify-content-center mb-1 mb-md-0 order-3">
<div class="text-muted text-small d-md-none">Date</div>
<div class="text-alternate">21.02.2021</div>
</div>
<div class="col-2 col-md-2 d-flex flex-column justify-content-center align-items-md-end mb-1 mb-md-0 order-1 order-md-4">
<div class="text-alternate">
<button class="btn btn-foreground btn-outline-hover pe-0"><i data-acorn-icon="download"></i></button>
</div>
</div>
</div>
</div>
<div class="h-100 sh-md-4 border-bottom border-separator-light pb-3 mb-3">
<div class="row g-0 h-100 align-content-center">
<div class="col-10 col-md-5 d-flex flex-column justify-content-center mb-1 mb-md-0 order-0">
<div class="text-muted text-small d-md-none">Title</div>
<div class="text-alternate">Invoice</div>
</div>
<div class="col-6 col-md-3 d-flex flex-column justify-content-center mb-1 mb-md-0 order-2">
<div class="text-muted text-small d-md-none">Amount</div>
<div class="text-alternate">$ 16.25</div>
</div>
<div class="col-6 col-md-2 d-flex flex-column justify-content-center mb-1 mb-md-0 order-3">
<div class="text-muted text-small d-md-none">Date</div>
<div class="text-alternate">21.02.2021</div>
</div>
<div class="col-2 col-md-2 d-flex flex-column justify-content-center align-items-md-end mb-1 mb-md-0 order-1 order-md-4">
<div class="text-alternate">
<button class="btn btn-foreground btn-outline-hover pe-0"><i data-acorn-icon="download"></i></button>
</div>
</div>
</div>
</div>
<div class="h-100 sh-md-4 border-bottom border-separator-light pb-3 mb-3">
<div class="row g-0 h-100 align-content-center">
<div class="col-10 col-md-5 d-flex flex-column justify-content-center mb-1 mb-md-0 order-0">
<div class="text-muted text-small d-md-none">Title</div>
<div class="text-alternate">Monthly Payment</div>
</div>
<div class="col-6 col-md-3 d-flex flex-column justify-content-center mb-1 mb-md-0 order-2">
<div class="text-muted text-small d-md-none">Amount</div>
<div class="text-alternate">$ 16.25</div>
</div>
<div class="col-6 col-md-2 d-flex flex-column justify-content-center mb-1 mb-md-0 order-3">
<div class="text-muted text-small d-md-none">Date</div>
<div class="text-alternate">21.01.2021</div>
</div>
<div class="col-2 col-md-2 d-flex flex-column justify-content-center align-items-md-end mb-1 mb-md-0 order-1 order-md-4">
<div class="text-alternate">
<button class="btn btn-foreground btn-outline-hover pe-0"><i data-acorn-icon="download"></i></button>
</div>
</div>
</div>
</div>
<div class="h-100 sh-md-4 border-bottom border-separator-light pb-3 mb-3">
<div class="row g-0 h-100 align-content-center">
<div class="col-10 col-md-5 d-flex flex-column justify-content-center mb-1 mb-md-0 order-0">
<div class="text-muted text-small d-md-none">Title</div>
<div class="text-alternate">Invoice</div>
</div>
<div class="col-6 col-md-3 d-flex flex-column justify-content-center mb-1 mb-md-0 order-2">
<div class="text-muted text-small d-md-none">Amount</div>
<div class="text-alternate">$ 16.25</div>
</div>
<div class="col-6 col-md-2 d-flex flex-column justify-content-center mb-1 mb-md-0 order-3">
<div class="text-muted text-small d-md-none">Date</div>
<div class="text-alternate">21.01.2021</div>
</div>
<div class="col-2 col-md-2 d-flex flex-column justify-content-center align-items-md-end mb-1 mb-md-0 order-1 order-md-4">
<div class="text-alternate">
<button class="btn btn-foreground btn-outline-hover pe-0"><i data-acorn-icon="download"></i></button>
</div>
</div>
</div>
</div>
<div class="h-100 sh-md-4 border-bottom border-separator-light pb-3 mb-3">
<div class="row g-0 h-100 align-content-center">
<div class="col-10 col-md-5 d-flex flex-column justify-content-center mb-1 mb-md-0 order-0">
<div class="text-muted text-small d-md-none">Title</div>
<div class="text-alternate">Monthly Payment</div>
</div>
<div class="col-6 col-md-3 d-flex flex-column justify-content-center mb-1 mb-md-0 order-2">
<div class="text-muted text-small d-md-none">Amount</div>
<div class="text-alternate">$ 16.25</div>
</div>
<div class="col-6 col-md-2 d-flex flex-column justify-content-center mb-1 mb-md-0 order-3">
<div class="text-muted text-small d-md-none">Date</div>
<div class="text-alternate">21.12.2020</div>
</div>
<div class="col-2 col-md-2 d-flex flex-column justify-content-center align-items-md-end mb-1 mb-md-0 order-1 order-md-4">
<div class="text-alternate">
<button class="btn btn-foreground btn-outline-hover pe-0"><i data-acorn-icon="download"></i></button>
</div>
</div>
</div>
</div>
<div class="h-100 sh-md-4 border-bottom border-separator-light pb-3 mb-3">
<div class="row g-0 h-100 align-content-center">
<div class="col-10 col-md-5 d-flex flex-column justify-content-center mb-1 mb-md-0 order-0">
<div class="text-muted text-small d-md-none">Title</div>
<div class="text-alternate">Invoice</div>
</div>
<div class="col-6 col-md-3 d-flex flex-column justify-content-center mb-1 mb-md-0 order-2">
<div class="text-muted text-small d-md-none">Amount</div>
<div class="text-alternate">$ 16.25</div>
</div>
<div class="col-6 col-md-2 d-flex flex-column justify-content-center mb-1 mb-md-0 order-3">
<div class="text-muted text-small d-md-none">Date</div>
<div class="text-alternate">21.12.2020</div>
</div>
<div class="col-2 col-md-2 d-flex flex-column justify-content-center align-items-md-end mb-1 mb-md-0 order-1 order-md-4">
<div class="text-alternate">
<button class="btn btn-foreground btn-outline-hover pe-0"><i data-acorn-icon="download"></i></button>
</div>
</div>
</div>
</div>
</div>
<nav>
<ul class="pagination justify-content-center mb-0 semibordered">
<li class="page-item">
<a class="page-link" href="#" tabindex="-1" aria-disabled="true">
<i data-acorn-icon="chevron-left"></i>
</a>
</li>
<li class="page-item active"><a class="page-link" href="#">1</a></li>
<li class="page-item"><a class="page-link" href="#">2</a></li>
<li class="page-item"><a class="page-link" href="#">3</a></li>
<li class="page-item">
<a class="page-link" href="#" tabindex="-1" aria-disabled="true">
<i data-acorn-icon="chevron-right"></i>
</a>
</li>
</ul>
</nav>
</div>
</div>
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
<!-- <script src="<?=base_url()?>js/vendor/jquery-3.5.1.min.js"></script>
<script src="<?=base_url()?>js/vendor/bootstrap.bundle.min.js"></script>
<script src="<?=base_url()?>js/vendor/OverlayScrollbars.min.js"></script>
<script src="<?=base_url()?>js/vendor/autoComplete.min.js"></script>
<script src="<?=base_url()?>js/vendor/clamp.min.js"></script>
<script src="<?=base_url()?>icon/acorn-icons.js"></script>
<script src="<?=base_url()?>icon/acorn-icons-interface.js"></script>
<script src="<?=base_url()?>js/vendor/jquery.validate/jquery.validate.min.js"></script>
<script src="<?=base_url()?>js/vendor/jquery.validate/additional-methods.min.js"></script>
<script src="<?=base_url()?>js/base/helpers.js"></script>
<script src="<?=base_url()?>js/base/globals.js"></script>
<script src="<?=base_url()?>js/base/nav.js"></script>
<script src="<?=base_url()?>js/base/search.js"></script>
<script src="<?=base_url()?>js/base/settings.js"></script> -->
<!-- <script src="<?=base_url()?>js/pages/auth.login.js"></script> -->

<!-- <script src="<?=base_url()?>js/common.js"></script>
<script src="<?=base_url()?>js/scripts.js"></script> -->

<script src="<?=base_url()?>js/vendor/jquery-3.5.1.min.js"></script>
<script src="<?=base_url()?>js/vendor/bootstrap.bundle.min.js"></script>
<script src="<?=base_url()?>js/vendor/OverlayScrollbars.min.js"></script>
<script src="<?=base_url()?>js/vendor/autoComplete.min.js"></script>
<script src="<?=base_url()?>js/vendor/clamp.min.js"></script>
<script src="<?=base_url()?>icon/acorn-icons.js"></script>
<script src="<?=base_url()?>icon/acorn-icons-interface.js"></script>
<script src="<?=base_url()?>icon/acorn-icons-commerce.js"></script>
<script src="<?=base_url()?>js/base/helpers.js"></script>
<script src="<?=base_url()?>js/base/globals.js"></script>
<script src="<?=base_url()?>js/base/nav.js"></script>
<script src="<?=base_url()?>js/base/search.js"></script>
<script src="<?=base_url()?>js/base/settings.js"></script>
<script src="<?=base_url()?>js/common.js"></script>
<script src="<?=base_url()?>js/scripts.js"></script>
</body>

</html>

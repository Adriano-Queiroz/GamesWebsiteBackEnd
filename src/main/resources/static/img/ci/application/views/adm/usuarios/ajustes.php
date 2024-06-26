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
	
	<? include('includes/adm/header.php') ?>

		
		<? include('includes/adm/menu.php'); ?>
</div>
<div class="col">

<div class="mb-5">
<div class="row row-cols-1 row-cols-xl-2 g-2">

	<div class="col">

		
		<div class="card">
			<span class="badge rounded-pill bg-outline-primary me-1 position-absolute s-3 t-3 z-index-1">
				<i data-acorn-icon="check" data-acorn-size="15"></i>
			</span>
			<div class="card-body">

				<div class="row g-0">
					<div class="col-12 col-sm-auto pe-4 d-flex justify-content-center">
						<img src="<?=base_url()?>img/illustration/boas-vindas.png" class="theme-filter" alt="email icon">
					</div>
					<div class="col-12 col-sm">
						<form action="<?=base_url()?>adm/usuarios/set_campo_rasp" method="post">
							<input type="hidden" name="id_rasp" value="<?=$rasp->id?>">
							<input type="hidden" name="campo" value="bonus_boas_vindas">
							<a href="#" class="heading mb-2 d-inline-block">Bônus de Boas Vindas</a>
							<p>
								<span class="text-small text-muted">ATIVADO / DESATIVADO</span>
								<br>
								<div class="mb-3 filled">
									<i data-acorn-icon="clock"></i>
									<? if($rasp->bonus_boas_vindas == 0){ ?>
										<input class="form-control" placeholder="Desativado">
									<? }else{ ?>
										<input class="form-control" placeholder="Ativado">
									<? } ?>
								</div>
							</p>
							<p>
								<span class="text-small text-muted">VALOR DO BÔNUS (R$)</span>
								<br>
								<div class="mb-3 filled">
									<i data-acorn-icon="money"></i>
									<input class="form-control money" placeholder="1.00" value="<?=$rasp->bonus_boas_vindas?>" name="bonus_boas_vindas">
								</div>
								<br>
								<span class="text-small text-muted">Para desativar. digite 0 (zero) no valor do bônus</span>
								<br>
							</p>
							<button type="submit" class="btn btn-icon btn-icon-start btn-outline-primary mt-1">
								<i data-acorn-icon="edit-square"></i>
								<span>Alterar</span>
							</button>
						</form>
					</div>
				</div> 
				<!-- x row -->

			</div>
			<!-- x card-body -->
		</div>

	</div>

	<div class="col">

		
		<div class="card">
			<span class="badge rounded-pill bg-outline-primary me-1 position-absolute s-3 t-3 z-index-1">
				<i data-acorn-icon="check" data-acorn-size="15"></i>
			</span>
			<div class="card-body">

				<div class="row g-0">
					<div class="col-12 col-sm-auto pe-4 d-flex justify-content-center">
						<img src="<?=base_url()?>img/illustration/recarga.png" class="theme-filter" alt="email icon">
					</div>
					<div class="col-12 col-sm">
						<form action="<?=base_url()?>adm/usuarios/set_campo_rasp" method="post">
							<input type="hidden" name="id_rasp" value="<?=$rasp->id?>">
							<input type="hidden" name="campo" value="bonus_recarga_diaria">
							<a href="#" class="heading mb-2 d-inline-block">Bônus de Recarga Diária</a>
							<p>
								<span class="text-small text-muted">ATIVADO / DESATIVADO</span>
								<br>
								<div class="mb-3 filled">
									<i data-acorn-icon="clock"></i>
									<? if($rasp->bonus_recarga_diaria == 0){ ?>
										<input class="form-control" placeholder="Desativado">
									<? }else{ ?>
										<input class="form-control" placeholder="Ativado">
									<? } ?>
								</div>
							</p>
							<p>
								<span class="text-small text-muted">VALOR DO BÔNUS (%)</span>
								<br>
								<div class="mb-3 filled">
									<i data-acorn-icon="money"></i>
									<input class="form-control" placeholder="1.00" value="<?=$rasp->bonus_recarga_diaria?>" name="bonus_recarga_diaria">
								</div>
								<br>
								<span class="text-small text-muted">Para desativar. digite 0 (zero) no valor do bônus</span>
								<br>
							</p>
							<button type="submit" class="btn btn-icon btn-icon-start btn-outline-primary mt-1">
								<i data-acorn-icon="edit-square"></i>
								<span>Alterar</span>
							</button>
						</form>
					</div>
				</div> 
				<!-- x row -->

			</div>
			<!-- x card-body -->
		</div>

	</div>

	<div class="col">

		
		<div class="card">
			<span class="badge rounded-pill bg-outline-primary me-1 position-absolute s-3 t-3 z-index-1">
				<i data-acorn-icon="check" data-acorn-size="15"></i>
			</span>
			<div class="card-body">

				<div class="row g-0">
					<div class="col-12 col-sm-auto pe-4 d-flex justify-content-center">
						<img src="<?=base_url()?>img/illustration/primeira-recarga.png" class="theme-filter" alt="email icon">
					</div>
					<div class="col-12 col-sm">
						<form action="<?=base_url()?>adm/usuarios/set_campo_rasp" method="post">
							<input type="hidden" name="id_rasp" value="<?=$rasp->id?>">
							<input type="hidden" name="campo" value="bonus_primeira_recarga">
							<a href="#" class="heading mb-2 d-inline-block">Bônus na Primeira Recarga</a>
							<p>
								<span class="text-small text-muted">ATIVADO / DESATIVADO</span>
								<br>
								<div class="mb-3 filled">
									<i data-acorn-icon="clock"></i>
									<? if($rasp->bonus_primeira_recarga == 0){ ?>
										<input class="form-control" placeholder="Desativado">
									<? }else{ ?>
										<input class="form-control" placeholder="Ativado">
									<? } ?>
								</div>
							</p>
							<p>
								<span class="text-small text-muted">VALOR DO BÔNUS (%)</span>
								<br>
								<div class="mb-3 filled">
									<i data-acorn-icon="money"></i>
									<input class="form-control" placeholder="1.00" value="<?=$rasp->bonus_primeira_recarga?>" name="bonus_primeira_recarga">
								</div>
								<br>
								<span class="text-small text-muted">Para desativar. digite 0 (zero) no valor do bônus</span>
								<br>
							</p>
							<button type="submit" class="btn btn-icon btn-icon-start btn-outline-primary mt-1">
								<i data-acorn-icon="edit-square"></i>
								<span>Alterar</span>
							</button>
						</form>
					</div>
				</div> 
				<!-- x row -->

			</div>
			<!-- x card-body -->
		</div>

	</div>

	<div class="col">

		
		<div class="card">
			<span class="badge rounded-pill bg-outline-primary me-1 position-absolute s-3 t-3 z-index-1">
				<i data-acorn-icon="check" data-acorn-size="15"></i>
			</span>
			<div class="card-body">

				<div class="row g-0">
					<div class="col-12 col-sm-auto pe-4 d-flex justify-content-center">
						<img src="<?=base_url()?>img/illustration/preco-raspadinha.png" class="theme-filter" alt="email icon">
					</div>
					<div class="col-12 col-sm">
						<form action="<?=base_url()?>adm/usuarios/set_campo_rasp" method="post">
							<input type="hidden" name="id_rasp" value="<?=$rasp->id?>">
							<input type="hidden" name="campo" value="preco_cota">
							<a href="#" class="heading mb-2 d-inline-block">Preço da Raspadinha</a>
							<p>
								<span class="text-small text-muted">ATIVADO / DESATIVADO</span>
								<br>
								<div class="mb-3 filled">
									<i data-acorn-icon="clock"></i>
									<? if($rasp->preco_cota == 0){ ?>
										<input class="form-control" placeholder="Desativado">
									<? }else{ ?>
										<input class="form-control" placeholder="Ativado">
									<? } ?>
								</div>
							</p>
							<p>
								<span class="text-small text-muted">VALOR DO BÔNUS (R$)</span>
								<br>
								<div class="mb-3 filled">
									<i data-acorn-icon="money"></i>
									<input class="form-control money" placeholder="1.00" value="<?=$rasp->preco_cota?>" name="preco_cota">
								</div>
								<br>
								<span class="text-small text-muted">Para desativar. digite 0 (zero) no valor do bônus</span>
								<br>
							</p>
							<button type="submit" class="btn btn-icon btn-icon-start btn-outline-primary mt-1">
								<i data-acorn-icon="edit-square"></i>
								<span>Alterar</span>
							</button>
						</form>
					</div>
				</div> 
				<!-- x row -->

			</div>
			<!-- x card-body -->
		</div>

	</div>
<!--
<div class="col">
<div class="card">
<span class="badge rounded-pill bg-outline-primary me-1 position-absolute s-3 t-3 z-index-1">
<i data-acorn-icon="check" data-acorn-size="15"></i>
</span>
<div class="card-body">
<div class="row g-0">
<div class="col-12 col-sm-auto pe-4 d-flex justify-content-center">
<img src="<?=base_url()?>img/illustration/recarga.png" class="theme-filter" alt="email icon">
</div>
<div class="col-12 col-sm">
<a href="#" class="heading mb-2 d-inline-block">Bônus de Recarga Diária</a>
<p>
<span class="text-small text-muted">ATIVADO / DESATIVADO</span>
<br>
<div class="mb-3 filled">
<i data-acorn-icon="clock"></i>
<input class="form-control" placeholder="Desativado">
</div>
</p>
<p>
<span class="text-small text-muted">BÔNUS DE RECARGA (%)</span>
<br>
<div class="mb-3 filled">
<i data-acorn-icon="money"></i>
<input class="form-control" placeholder="100.00">
</div>
</p>
<a href="#" class="btn btn-icon btn-icon-start btn-outline-primary mt-1">
<i data-acorn-icon="edit-square"></i>
<span>Alterar</span>
</a>
</div>
</div>
</div>
</div>
</div>


<div class="col">
<div class="card">
<span class="badge rounded-pill bg-outline-primary me-1 position-absolute s-3 t-3 z-index-1">
<i data-acorn-icon="check" data-acorn-size="15"></i>
</span>
<div class="card-body">
<div class="row g-0">
<div class="col-12 col-sm-auto pe-4 d-flex justify-content-center">
<img src="<?=base_url()?>img/illustration/primeira-recarga.png" class="theme-filter" alt="email icon">
</div>
<div class="col-12 col-sm">
<a href="#" class="heading mb-2 d-inline-block">Bônus na Primeira Recarga</a>
<p>
<span class="text-small text-muted">ATIVADO / DESATIVADO</span>
<br>
<div class="mb-3 filled">
<i data-acorn-icon="clock"></i>
<input class="form-control" placeholder="Desativado">
</div>
</p>
<p>
<span class="text-small text-muted">BÔNUS DE RECARGA (%)</span>
<br>
<div class="mb-3 filled">
<i data-acorn-icon="money"></i>
<input class="form-control" placeholder="100.00">
</div>
</p>
<a href="#" class="btn btn-icon btn-icon-start btn-outline-primary mt-1">
<i data-acorn-icon="edit-square"></i>
<span>Alterar</span>
</a>
</div>
</div>
</div>
</div>
</div>

<div class="col">
<div class="card">
<span class="badge rounded-pill bg-outline-primary me-1 position-absolute s-3 t-3 z-index-1">
<i data-acorn-icon="check" data-acorn-size="15"></i>
</span>
<div class="card-body">
<div class="row g-0">
<div class="col-12 col-sm-auto pe-4 d-flex justify-content-center">
<img src="<?=base_url()?>img/illustration/preco-raspadinha.png" class="theme-filter" alt="email icon">
</div>
<div class="col-12 col-sm">
<a href="#" class="heading mb-2 d-inline-block">Preço da Raspadinha</a>
<p>
<span class="text-small text-muted">VALOR DA RASPADINHA (R$)</span>
<br>
<div class="mb-3 filled">
<i data-acorn-icon="money"></i>
<input class="form-control" placeholder="1.00">
</div>
</p>
<p>
<span class="text-small text-muted"></span>
<br>
<div class="mb-3 filled">
<br><br></div>
</p>
<a href="#" class="btn btn-icon btn-icon-start btn-outline-primary mt-1">
<i data-acorn-icon="edit-square"></i>
<span>Alterar</span>
</a>
</div>
</div>
</div>
</div>
</div>

-->


<div class="col">
	<div class="card">
		<span class="badge rounded-pill bg-outline-primary me-1 position-absolute s-3 t-3 z-index-1">
			<i data-acorn-icon="check" data-acorn-size="15"></i>
		</span>
	<div class="card-body">
		<div class="row g-0">
			<div class="col-12 col-sm-auto pe-4 d-flex justify-content-center">
				<img src="<?=base_url()?>img/illustration/configuracao.png" class="theme-filter" alt="email icon">
			</div>
			<div class="col-12 col-sm">
				<form action="<?=base_url()?>adm/usuarios/set_campo_rasp" method="post">
					<input type="hidden" name="id_rasp" value="<?=$rasp->id?>">
					<!-- <input type="hidden" name="campo" value="preco_cota"> -->

					<a href="#" class="heading mb-2 d-inline-block">Configuração de Lucro (Sistema Completo)</a>
					<p>
						<span class="text-small text-muted">LUCRO DESEJADO (%)</span>
						<br>
						<div class="mb-3 filled">
							<i data-acorn-icon="money"></i>
							<input class="form-control porcentagem" placeholder="20.00" name="lucro_desejado" value="<?=$rasp->lucro_desejado?>">
						</div>
					</p>
					<p>
						<span class="text-small text-muted">PORCENTAGEM DE PRÊMIOS (%)</span>
						<br>
						<div class="mb-3 filled">
							<i data-acorn-icon="money"></i>
							<input class="form-control porcentagem" placeholder="80.00" name="porcentagens_premios" value="<?=$rasp->porcentagens_premios?>">
						</div>
					</p>
					<button type="submit" class="btn btn-icon btn-icon-start btn-outline-primary mt-1">
						<i data-acorn-icon="edit-square"></i>
						<span>Alterar</span>
					</button>
				</form>
			</div>
		</div>
		</div>
	</div>
</div>


<div class="col">
<div class="card">
<span class="badge rounded-pill bg-outline-primary me-1 position-absolute s-3 t-3 z-index-1">
<i data-acorn-icon="check" data-acorn-size="15"></i>
</span>
<div class="card-body">
<div class="row g-0">
<div class="col-12 col-sm-auto pe-4 d-flex justify-content-center">
<img src="<?=base_url()?>img/illustration/usuario.png" class="theme-filter" alt="email icon">
</div>
<div class="col-12 col-sm">
	<form action="<?=base_url()?>adm/usuarios/set_credito_user" method="post">
		<input type="hidden" name="id_rasp" value="<?=$rasp->id?>">
		<a href="#" class="heading mb-2 d-inline-block">Creditar usuário (Bônus)</a>
		<p>
			<span class="text-small text-muted">CPF/Email/Nome USUÁRIO</span>
			<br>
			<div class="mb-3 filled">
				<i data-acorn-icon="user"></i>
				<input class="form-control" placeholder="000.000.000-00" name="q">
			</div>
		</p>
		<p>
			<span class="text-small text-muted">VALOR PARA CREDITAR</span>
			<br>
			<div class="mb-3 filled">
				<i data-acorn-icon="money"></i>
				<input class="form-control" placeholder="80.00" name="valor">
			</div>
		</p>
		<button type="submit" class="btn btn-icon btn-icon-start btn-outline-primary mt-1">
			<i data-acorn-icon="edit-square"></i>
			<span>Enviar</span>
		</button>
	</form>
</div>
</div>
</div>
</div>
</div><div class="col">
<div class="card">
<span class="badge rounded-pill bg-outline-primary me-1 position-absolute s-3 t-3 z-index-1">
<i data-acorn-icon="check" data-acorn-size="15"></i>
</span>
<div class="card-body">
<div class="row g-0">
<div class="col-12 col-sm-auto pe-4 d-flex justify-content-center">
	<img src="<?=base_url()?>img/illustration/premio.png" class="theme-filter" alt="email icon">
</div>


<div class="col-12 col-sm">

	<form action="<?=base_url()?>adm/usuarios/set_credito_user/0" method="post">
		<input type="hidden" name="id_rasp" value="<?=$rasp->id?>">
		<a href="#" class="heading mb-2 d-inline-block">Premiar usuário (Bônus)</a>
		<p>
			<span class="text-small text-muted">CPF/Email/Nome USUÁRIO</span>
			<br>
			<div class="mb-3 filled">
				<i data-acorn-icon="user"></i>
				<input class="form-control" placeholder="000.000.000-00" name="q">
			</div>
		</p>
		<p>
			<span class="text-small text-muted">VALOR PARA O PRÊMIO</span>
			<br>
			<div class="mb-3 filled">
				<i data-acorn-icon="money"></i>
				<input class="form-control" placeholder="80.00" name="valor">
			</div>
		</p>
		<button type="submit" class="btn btn-icon btn-icon-start btn-outline-primary mt-1">
			<i data-acorn-icon="edit-square"></i>
			<span>Enviar</span>
		</button>
	</form>


<!--<a href="#" class="heading mb-2 d-inline-block">Premiar Usuários</a>
<p>
<span class="text-small text-muted">CPF USUÁRIO</span>
<br>
<div class="mb-3 filled">
<i data-acorn-icon="user"></i>
<input class="form-control" placeholder="000.000.000-00">
</div>
</p>
<p>
<span class="text-small text-muted">VALOR PARA O PRÊMIO</span>
<br>
<div class="mb-3 filled">
<i data-acorn-icon="money"></i>
<input class="form-control" placeholder="80.00">
</div>
</p>
<a href="#" class="btn btn-icon btn-icon-start btn-outline-primary mt-1">
<i data-acorn-icon="edit-square"></i>
<span>Alterar</span>
</a>-->

</div>
</div>
</div>
</div>
</div>
<div class="col">
<div class="card">
<span class="badge rounded-pill bg-outline-primary me-1 position-absolute s-3 t-3 z-index-1">
<i data-acorn-icon="check" data-acorn-size="15"></i>
</span>
<div class="card-body">
<div class="row g-0">
<div class="col-12 col-sm-auto pe-4 d-flex justify-content-center">
<img src="<?=base_url()?>img/illustration/facebook.png" class="theme-filter" alt="email icon">
</div>
<div class="col-12 col-sm">

	<form action="<?=base_url()?>adm/usuarios/set_campo_rasp" method="post">
		<input type="hidden" name="id_rasp" value="<?=$rasp->id?>">
		<!-- <input type="hidden" name="campo" value="preco_cota"> -->

		<p>
			<a href="#" class="heading mb-2 d-inline-block">Configuração Pixel</a>
			<br>
			<span class="text-small text-muted">PIXEL FACEBOOK</span>
			<div class="mb-3 filled">
				<i data-acorn-icon="money"></i>
				<input class="form-control" placeholder="APP_USR-685183169946807...." name="pixel_facebook" value="<?=$rasp->pixel_facebook?>">
			</div>
		</p>
		<button type="submit" class="btn btn-icon btn-icon-start btn-outline-primary mt-1">
			<i data-acorn-icon="edit-square"></i>
			<span>Alterar</span>
		</button>
	</form>
<!--	
<a href="#" class="heading mb-2 d-inline-block">Configuração Pixel</a>
<p>
<span class="text-small text-muted">PIXEL FACEBOOK</span>
<br>
<div class="mb-3 filled">
<i data-acorn-icon="clock"></i>
<input class="form-control" placeholder="985552475745133">
</div>
</p>
<p>
<span class="text-small text-muted">TOKEN FACEBOOK</span>
<br>
<div class="mb-3 filled">
<i data-acorn-icon="money"></i>
<input class="form-control" placeholder="EAAOClm7UI8sBO8hZBB0mk8Ri80w8QMqvPxqR5nfA0Q5L21O3HDyonZC7HuiVmSExfD3xHz6563j9Q3ZC6czrOvuZBAVTIb0vF2ru9zDUXtsgXZCeTK9XZBPNK0f8SiLe0pKi0r3NjZCBfvCZC1AGORoDlj9qA8m0VZC6YS5yRZB4OpGuwArUhkSBYzZC59OwKEcZAvUwcwZDZD">
</div>
</p>
<a href="#" class="btn btn-icon btn-icon-start btn-outline-primary mt-1">
<i data-acorn-icon="edit-square"></i>
<span>Alterar</span>
</a>
-->
</div>
</div>
</div>
</div>
</div>
<!--
<div class="col">
<div class="card">
<span class="badge rounded-pill bg-outline-primary me-1 position-absolute s-3 t-3 z-index-1">
<i data-acorn-icon="check" data-acorn-size="15"></i>
</span>
<div class="card-body">
<div class="row g-0">
<div class="col-12 col-sm-auto pe-4 d-flex justify-content-center">
<img src="<?=base_url()?>img/illustration/mercadopago.png" class="theme-filter" alt="email icon">
</div>
<div class="col-12 col-sm">
<a href="#" class="heading mb-2 d-inline-block">Configuração Mercado Pago</a>
<p>
<span class="text-small text-muted">PIXEL MERCADOPAGO</span>
<br>
<div class="mb-3 filled">
<i data-acorn-icon="clock"></i>
<input class="form-control" placeholder="985552475745133">
</div>
</p>
<p>
<span class="text-small text-muted">TOKEN MERCADOPAGO</span>
<br>
<div class="mb-3 filled">
<i data-acorn-icon="money"></i>
<input class="form-control" placeholder="EAAOClm7UI8sBO8hZBB0mk8Ri80w8QMqvPxqR5nfA0Q5L21O3HDyonZC7HuiVmSExfD3xHz6563j9Q3ZC6czrOvuZBAVTIb0vF2ru9zDUXtsgXZCeTK9XZBPNK0f8SiLe0pKi0r3NjZCBfvCZC1AGORoDlj9qA8m0VZC6YS5yRZB4OpGuwArUhkSBYzZC59OwKEcZAvUwcwZDZD">
</div>
</p>
<a href="#" class="btn btn-icon btn-icon-start btn-outline-primary mt-1">
<i data-acorn-icon="edit-square"></i>
<span>Alterar</span>
</a>
</div>
</div>
</div>
</div>
</div>-->


<!-- mp -->
<div class="col">
	<div class="card">
		<span class="badge rounded-pill bg-outline-primary me-1 position-absolute s-3 t-3 z-index-1">
			<i data-acorn-icon="check" data-acorn-size="15"></i>
		</span>
	<div class="card-body">
		<div class="row g-0">
			<div class="col-12 col-sm-auto pe-4 d-flex justify-content-center">
				<img src="<?=base_url()?>img/illustration/mercadopago.png" class="theme-filter" alt="email icon">
			</div>
			<div class="col-12 col-sm">
				<form action="<?=base_url()?>adm/usuarios/set_campo_rasp" method="post">
					<input type="hidden" name="id_rasp" value="<?=$rasp->id?>">
					<!-- <input type="hidden" name="campo" value="preco_cota"> -->

					<p>
						<a href="#" class="heading mb-2 d-inline-block">Configuração Mercado Pago</a>
						<br>
						<span class="text-small text-muted">PIXEL MERCADOPAGO</span>
						<div class="mb-3 filled">
							<i data-acorn-icon="money"></i>
							<input class="form-control" placeholder="APP_USR-685183169946807...." name="api_mercado_pago" value="<?=$rasp->api_mercado_pago?>">
						</div>
					</p>
					<button type="submit" class="btn btn-icon btn-icon-start btn-outline-primary mt-1">
						<i data-acorn-icon="edit-square"></i>
						<span>Alterar</span>
					</button>
				</form>
			</div>
		</div>
		</div>
	</div>
</div>

<!-- mp -->





</div>
</div>
<h2 class="small-title">Prêmios Cadastrados (Raspadinha)</h2>
<div class="card">
<div class="card-body">
<div class="mb-2 bg-transparent no-shadow d-none d-md-block g-0 sh-3">
<div class="row g-0 h-100 align-content-center">
<div class="col-12 col-md-5 d-flex align-items-center mb-2 mb-md-0 text-muted text-small">PRÊMIO</div>
<div class="col-6 col-md-3 d-flex align-items-center text-alternate text-medium text-muted text-small">MÁXIMO DIÁRIO</div>
<div class="col-6 col-md-2 d-flex align-items-center text-alternate text-medium text-muted text-small">PROBABILIDADE</div>
<div class="col-6 col-md-2 d-flex align-items-center text-alternate text-medium justify-content-end text-muted text-small">AÇÕES</div>
</div>
</div>
<div class="mb-5 border-last-none">
	<div class="h-100 sh-md-4 border-bottom border-separator-light pb-3 mb-3">
<div class="row g-0 h-100 align-content-center">
<div class="col-11 col-md-5 d-flex flex-column justify-content-center mb-2 mb-md-0 order-0">
<div class="text-alternate">R$ 1,00</div>
</div>
<div class="col-12 col-md-3 d-flex flex-column justify-content-center mb-2 mb-md-0 order-2">
<div class="text-alternate">375</div>
</div>
<div class="col-12 col-md-3 d-flex flex-column justify-content-center mb-2 mb-md-0 order-3">
<div class="text-alternate">35.18%</div>
</div>
<div class="col-1 d-flex flex-column justify-content-center align-items-md-end mb-2 mb-md-0 order-1 order-md-4">
<a class="link" href="#">
<i data-acorn-icon="more-horizontal"></i>
</a>
</div>
</div>
</div>
<div class="h-100 sh-md-4 border-bottom border-separator-light pb-3 mb-3">
<div class="row g-0 h-100 align-content-center">
<div class="col-11 col-md-5 d-flex flex-column justify-content-center mb-2 mb-md-0 order-0">
<div class="text-alternate">R$ 2,00</div>
</div>
<div class="col-12 col-md-3 d-flex flex-column justify-content-center mb-2 mb-md-0 order-2">
<div class="text-alternate">375</div>
</div>
<div class="col-12 col-md-3 d-flex flex-column justify-content-center mb-2 mb-md-0 order-3">
<div class="text-alternate">35.18%</div>
</div>
<div class="col-1 d-flex flex-column justify-content-center align-items-md-end mb-2 mb-md-0 order-1 order-md-4">
<a class="link" href="#">
<i data-acorn-icon="more-horizontal"></i>
</a>
</div>
</div>
</div>
<div class="h-100 sh-md-4 border-bottom border-separator-light pb-3 mb-3">
<div class="row g-0 h-100 align-content-center">
<div class="col-11 col-md-5 d-flex flex-column justify-content-center mb-2 mb-md-0 order-0">
<div class="text-alternate">R$ 3,00</div>
</div>
<div class="col-12 col-md-3 d-flex flex-column justify-content-center mb-2 mb-md-0 order-2">
<div class="text-alternate">100</div>
</div>
<div class="col-12 col-md-3 d-flex flex-column justify-content-center mb-2 mb-md-0 order-3">
<div class="text-alternate">9.38%</div>
</div>
<div class="col-1 d-flex flex-column justify-content-center align-items-md-end mb-2 mb-md-0 order-1 order-md-4">
<a class="link" href="#">
<i data-acorn-icon="more-horizontal"></i>
</a>
</div>
</div>
</div>
<div class="h-100 sh-md-4 border-bottom border-separator-light pb-3 mb-3">
<div class="row g-0 h-100 align-content-center">
<div class="col-11 col-md-5 d-flex flex-column justify-content-center mb-2 mb-md-0 order-0">
<div class="text-alternate">R$ 5,00</div>
</div>
<div class="col-12 col-md-3 d-flex flex-column justify-content-center mb-2 mb-md-0 order-2">
<div class="text-alternate">100</div>
</div>
<div class="col-12 col-md-3 d-flex flex-column justify-content-center mb-2 mb-md-0 order-3">
<div class="text-alternate">9.38%</div>
</div>
<div class="col-1 d-flex flex-column justify-content-center align-items-md-end mb-2 mb-md-0 order-1 order-md-4">
<a class="link" href="#">
<i data-acorn-icon="more-horizontal"></i>
</a>
</div>
</div>
</div>
<div class="h-100 sh-md-4 border-bottom border-separator-light pb-3 mb-3">
<div class="row g-0 h-100 align-content-center">
<div class="col-11 col-md-5 d-flex flex-column justify-content-center mb-2 mb-md-0 order-0">
<div class="text-alternate">R$ 10,00</div>
</div>
<div class="col-12 col-md-3 d-flex flex-column justify-content-center mb-2 mb-md-0 order-2">
<div class="text-alternate">55</div>
</div>
<div class="col-12 col-md-3 d-flex flex-column justify-content-center mb-2 mb-md-0 order-3">
<div class="text-alternate">5.16%</div>
</div>
<div class="col-1 d-flex flex-column justify-content-center align-items-md-end mb-2 mb-md-0 order-1 order-md-4">
<a class="link" href="#">
<i data-acorn-icon="more-horizontal"></i>
</a>
</div>
</div>
</div>
<div class="h-100 sh-md-4 border-bottom border-separator-light pb-3 mb-3">
<div class="row g-0 h-100 align-content-center">
<div class="col-11 col-md-5 d-flex flex-column justify-content-center mb-2 mb-md-0 order-0">
<div class="text-alternate">R$ 20,00</div>
</div>
<div class="col-12 col-md-3 d-flex flex-column justify-content-center mb-2 mb-md-0 order-2">
<div class="text-alternate">30</div>
</div>
<div class="col-12 col-md-3 d-flex flex-column justify-content-center mb-2 mb-md-0 order-3">
<div class="text-alternate">2.81%</div>
</div>
<div class="col-1 d-flex flex-column justify-content-center align-items-md-end mb-2 mb-md-0 order-1 order-md-4">
<a class="link" href="#">
<i data-acorn-icon="more-horizontal"></i>
</a>
</div>
</div>
</div>
<div class="h-100 sh-md-4 border-bottom border-separator-light pb-3 mb-3">
<div class="row g-0 h-100 align-content-center">
<div class="col-11 col-md-5 d-flex flex-column justify-content-center mb-2 mb-md-0 order-0">
<div class="text-alternate">R$ 50,00</div>
</div>
<div class="col-12 col-md-3 d-flex flex-column justify-content-center mb-2 mb-md-0 order-2">
<div class="text-alternate">15</div>
</div>
<div class="col-12 col-md-3 d-flex flex-column justify-content-center mb-2 mb-md-0 order-3">
<div class="text-alternate">1.41%</div>
</div>
<div class="col-1 d-flex flex-column justify-content-center align-items-md-end mb-2 mb-md-0 order-1 order-md-4">
<a class="link" href="#">
<i data-acorn-icon="more-horizontal"></i>
</a>
</div>
</div>
</div>
<div class="h-100 sh-md-4 border-bottom border-separator-light pb-3 mb-3">
<div class="row g-0 h-100 align-content-center">
<div class="col-11 col-md-5 d-flex flex-column justify-content-center mb-2 mb-md-0 order-0">
<div class="text-alternate">R$ 100,00</div>
</div>
<div class="col-12 col-md-3 d-flex flex-column justify-content-center mb-2 mb-md-0 order-2">
<div class="text-alternate">10</div>
</div>
<div class="col-12 col-md-3 d-flex flex-column justify-content-center mb-2 mb-md-0 order-3">
<div class="text-alternate">0.94%</div>
</div>
<div class="col-1 d-flex flex-column justify-content-center align-items-md-end mb-2 mb-md-0 order-1 order-md-4">
<a class="link" href="#">
<i data-acorn-icon="more-horizontal"></i>
</a>
</div>
</div>
</div>
<div class="h-100 sh-md-4 border-bottom border-separator-light pb-3 mb-3">
<div class="row g-0 h-100 align-content-center">
<div class="col-11 col-md-5 d-flex flex-column justify-content-center mb-2 mb-md-0 order-0">
<div class="text-alternate">R$ 500,00</div>
</div>
<div class="col-12 col-md-3 d-flex flex-column justify-content-center mb-2 mb-md-0 order-2">
<div class="text-alternate">5</div>
</div>
<div class="col-12 col-md-3 d-flex flex-column justify-content-center mb-2 mb-md-0 order-3">
<div class="text-alternate">0.47%</div>
</div>
<div class="col-1 d-flex flex-column justify-content-center align-items-md-end mb-2 mb-md-0 order-1 order-md-4">
<a class="link" href="#">
<i data-acorn-icon="more-horizontal"></i>
</a>
</div>
</div>
</div>
<div class="h-100 sh-md-4 border-bottom border-separator-light pb-3 mb-3">
<div class="row g-0 h-100 align-content-center">
<div class="col-11 col-md-5 d-flex flex-column justify-content-center mb-2 mb-md-0 order-0">
<div class="text-alternate">R$ 1.000,00</div>
</div>
<div class="col-12 col-md-3 d-flex flex-column justify-content-center mb-2 mb-md-0 order-2">
<div class="text-alternate">1</div>
</div>
<div class="col-12 col-md-3 d-flex flex-column justify-content-center mb-2 mb-md-0 order-3">
<div class="text-alternate">0.09%</div>
</div>
<div class="col-1 d-flex flex-column justify-content-center align-items-md-end mb-2 mb-md-0 order-1 order-md-4">
<a class="link" href="#">
<i data-acorn-icon="more-horizontal"></i>
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
</main>



<? include("includes/adm/footer.php"); ?>



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
<script src="<?=base_url()?>js/base/helpers.js"></script>
<script src="<?=base_url()?>js/base/globals.js"></script>
<script src="<?=base_url()?>js/base/nav.js"></script>
<script src="<?=base_url()?>js/base/search.js"></script>
<script src="<?=base_url()?>js/base/settings.js"></script>
<script src="<?=base_url()?>js/common.js"></script>
<script src="<?=base_url()?>js/scripts.js"></script>


<!-- MASK MONEY  -->
<script src="<?php echo base_url()?>js/jquery.maskMoney.js" type="text/javascript"></script> 
<script src='//alexgorbatchev.com/pub/sh/current/scripts/shCore.js' type='text/javascript'></script> 
<script src='//alexgorbatchev.com/pub/sh/current/scripts/shBrushJScript.js' type='text/javascript'></script> 


<script type="text/javascript">
    $(document).ready(function(){

        $(".money").maskMoney({symbol:'R$ ', showSymbol:true, thousands:'.', decimal:',', symbolStay: true});
        $(".porcentagem").maskMoney({symbol:'% ', showSymbol:true, thousands:'.', decimal:',', symbolStay: true});



    })
</script>


</body>

<!-- Mirrored from acorn-html-service-provider.coloredstrategies.com/Account.Security.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 08 May 2024 18:50:27 GMT -->
</html>

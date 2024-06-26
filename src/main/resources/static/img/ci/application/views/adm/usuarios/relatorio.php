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

<div class="modal fade" id="modal_dd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Dados do usuário</h5>
        <button type="button" class="close bt_x" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="call_dd">
      	<h1>Aguarde...</h1>
        <!-- <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Recipient:</label>
            <input type="text" class="form-control" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control" id="message-text"></textarea>
          </div>
        </form> -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary bt_x" data-dismiss="modal">OK</button>
        <!-- <button type="button" class="btn btn-primary">OK</button> -->
      </div>
    </div>
  </div>
</div>




<div id="root">
	
	<?php include('includes/adm/header.php') ?>

		
		<?php include('includes/adm/menu.php'); ?>
</div>
		<div class="col">


		<div class="col-12 col-md-12">
				<div class="card">
						<div class="h-100 row g-0 card-body py-5 align-items-center">
							

									<form action="<?=base_url('adm/usuarios/rel/3')?>" method="post">

										<div class="text-alternate">Data Início</div>
										<br>
										<div class="mb-3 filled">
											<i data-acorn-icon="clock"></i>
											<?php if(isset($_POST['de'])){ $de = $this->input->post('de'); }else{ $de = ""; } ?>
											<input class="form-control" type="date" placeholder="<?=date("d/m/Y")?>" name="de" value="<?=$de?>">
										</div>
										<div class="text-alternate">Data Fim</div>
										<br>

											<div class="mb-3 filled">
											<i data-acorn-icon="clock"></i>
											<?php if(isset($_POST['ate'])){ $ate = $this->input->post('ate'); }else{ $ate = ""; } ?>
											<input class="form-control" placeholder="<?=date("d/m/Y")?>" type="date" name="ate" value="<?=$ate?>">
										</div>
										<button type="submit" class="btn btn-icon btn-icon-start btn-outline-primary mt-1">
											<i data-acorn-icon="search"></i>
											<span>Pesquisar</span>
										</button>
								</form>
						</div>

				</div>
	</div>

	<br><br>



			<!-- numeros  -->

			<div class="row">
				<div class="col-12 col-xxl-12 mb-5">
				<div class="row g-2">
				<div class="col-12 col-md-4">
					<div class="card">
					<div class="h-100 row g-0 card-body py-5 align-items-center">
					<div class="col-auto">
					<div class="bg-gradient-light sw-5 sh-5 rounded-xl d-flex justify-content-center align-items-center">
					<i data-acorn-icon="user" class="text-white"></i>
					</div>
					</div>
					<div class="col">
					<div class="sh-5 d-flex align-items-center lh-1-25 ps-3">Usuários de Ativos</div>
					</div>
					<div class="col-auto ps-3">
					<div class="cta-2 text-primary"><?=$usuarios_ativos?></div>
					</div>
					</div>

					</div>
				</div>
				<div class="col-12 col-md-4">
					<div class="card">
					<div class="h-100 row g-0 card-body py-5 align-items-center">
					<div class="col-auto">
					<div class="bg-gradient-light sw-5 sh-5 rounded-xl d-flex justify-content-center align-items-center">
					<i data-acorn-icon="user" class="text-white"></i>
					</div>
					</div>
					<div class="col">
					<div class="sh-5 d-flex align-items-center lh-1-25 ps-3">Usuários Inativos</div>
					</div>
					<div class="col-auto ps-3">
					<div class="cta-2 text-primary"><?=$usuarios_inativos?></div>
					</div>
					</div>
					</div>
				</div>
				<div class="col-12 col-md-4">

					<div class="card">
					<div class="h-100 row g-0 card-body py-5 align-items-center">
					<div class="col-auto">
					<div class="bg-gradient-light sw-5 sh-5 rounded-xl d-flex justify-content-center align-items-center">
					<i data-acorn-icon="user" class="text-white"></i>
					</div>
					</div>
					<div class="col">
					<div class="sh-5 d-flex align-items-center lh-1-25 ps-3">Total de Usuários</div>
					</div>
					<div class="col-auto ps-3">
					<div class="cta-2 text-primary"><?=$usuarios_total?></div>
					</div>
					</div>

					</div>

				</div>
				</div>
				</div>
			</div>

			<!-- x numeros -->



			<!-- TABELA ATUAL -->

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

		<button class="btn btn-primary">Todos</button>&nbsp;&nbsp;
		<button class="btn btn-success" >Ativos</button>&nbsp;&nbsp;
		<button class="btn btn-warning">Inativos</button>&nbsp;&nbsp;
		<button class="btn p-0" data-bs-toggle="dropdown" type="button" data-bs-offset="0,3">
		<span class="btn btn-icon btn-icon-only btn-foreground-alternate shadow dropdown" data-bs-delay="0" data-bs-placement="top" data-bs-toggle="tooltip" title="Baixar">
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

		<span class="btn btn-foreground-alternate dropdown-toggle" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-delay="0" title="Qtq por página">
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
<div class="mb-2 bg-transparent no-shadow d-none d-md-block g-0 sh-3 mb-4">
<div class="row g-0 h-100 align-content-center">
<div class="col d-flex align-items-center mb-2 mb-md-0 text-muted text-small">NOME</div>
<div class="col d-flex align-items-center text-alternate text-medium text-muted text-small">EMAIL</div>
<div class="col d-flex align-items-center text-alternate text-medium text-muted text-small">TELEFONE</div>
<div class="col d-flex align-items-center text-alternate text-medium text-muted text-small">CPF</div>
<div class="col d-flex align-items-center text-alternate text-medium text-muted text-small">SALDO REAL</div>
<div class="col d-flex align-items-center text-alternate text-medium text-muted text-small">SALDO BÔNUS</div>
<div class="col d-flex align-items-center text-alternate text-medium justify-content-end text-muted text-small">CADASTRO</div>
</div>
</div>
<div class="mb-5 border-last-none">
<!-- <div class="h-100 sh-md-4 border-bottom border-separator-light pb-3 mb-3">
<div class="row g-0 h-100 align-content-center">
<div class="col-10 col-md-5 d-flex flex-column justify-content-center mb-1 mb-md-0 order-0">
<div class="text-alternate" data-bs-toggle="modal" data-bs-target="#usuarioModal" style="cursor: pointer;">Tatiane da Silva</div>
</div>
<div class="col-6 col-md-3 d-flex flex-column justify-content-center mb-1 mb-md-0 order-2">
<div class="text-alternate" data-bs-toggle="modal" data-bs-target="#usuarioModal" style="cursor: pointer;">tes***@gmail.com**</div>
</div>
<div class="col-6 col-md-2 d-flex flex-column justify-content-center mb-1 mb-md-0 order-3">
<div class="text-alternate" data-bs-toggle="modal" data-bs-target="#usuarioModal" style="cursor: pointer;">(81)999**-**73</div>
</div>
<div class="col-2 col-md-2 d-flex flex-column justify-content-center align-items-md-end mb-1 mb-md-0 order-1 order-md-4">
<div class="text-alternate" data-bs-toggle="modal" data-bs-target="#usuarioModal" style="cursor: pointer;">038.***.***-82</div>

</div>
</div>
</div> -->
<?php foreach($usuarios->result() as $usuario){ ?>
	<div class="h-100 sh-md-4 border-bottom border-separator-light pb-3 mb-3">
		<div class="row g-0 h-100 align-content-center">
			<!-- Nome -->
			<div class="col d-flex flex-column justify-content-center mb-1 mb-md-0 order-0">
				<div class="text-alternate bt_dd_user" data-id="<?=$usuario->id?>" style="cursor: pointer;">
					<?=$usuario->nome?>
				</div>
			</div>
			<!-- E-mail -->
			<div class="col d-flex flex-column justify-content-center mb-1 mb-md-0 order-2">
				<div class="text-alternate">
					<?php
					$email_user = $usuario->email;
					if(strlen($email_user) > 3){
						$email_p1 = substr($email_user, 0,3);
						$email_expl = explode("@", $email_user);
						$email_p2 = substr($email_expl[1], 0,3);
						$email_hide = $email_p1."***@".$email_p2;
						echo $email_hide;	
					}else{
						echo "-";
					}
					?>
				</div>
			</div>
			<!-- Telefone -->
			<div class="col d-flex flex-column justify-content-center mb-1 mb-md-0 order-3">
				<div class="text-alternate">
					<?php
					$replace = ['(',')',' ','-'];
					$telefone_user = str_replace($replace, "", $usuario->telefone);
					$telefone_p1 = substr($telefone_user, 2,4);
					$telefone_p2 = substr($telefone_user, 6,4);

					$telefone_hide = $telefone_p1."****".$telefone_p2;
					echo $telefone_hide;
					?>
				</div>
			</div>
			<!-- CPF -->
			<div class="col d-flex flex-column justify-content-center align-items-md-start mb-1 mb-md-0 order-1 order-md-4">
				<div class="text-alternate">
					<?=substr($usuario->cpf,0,3)?>******
				</div>
			</div>
			<!-- Saldo real -->
			<div class="col d-flex flex-column justify-content-center align-items-md-start mb-1 mb-md-0 order-1 order-md-4">
				<div class="text-alternate">
					Saldo real
				</div>
			</div>
			<!-- Saldo bônus -->
			<div class="col d-flex flex-column justify-content-center align-items-md-start mb-1 mb-md-0 order-1 order-md-4">
				<div class="text-alternate">
					Saldo bônus
				</div>
			</div>
			<!-- Cadastro -->
			<div class="col d-flex flex-column justify-content-center align-items-md-end mb-1 mb-md-0 order-1 order-md-4">
				<div class="text-alternate">
					Cadastro
				</div>
			</div>

		</div>
	</div>
<?php } ?>


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


			<!-- TABELA ATUAL -->


			<!-- NOVA TBLE -->

			<div class="row" style="display: none;">
				<div class="col-12">
					<div class="card">
						<div class="card-body">

								<div class="mb-2 bg-transparent no-shadow d-none d-md-block g-0 sh-3">
									<div class="row g-0 h-100 align-content-center">
										<div class="col-12 col-md-5 d-flex align-items-center mb-2 mb-md-0 text-muted text-small">NOME</div>
										<div class="col-6 col-md-3 d-flex align-items-center text-alternate text-medium text-muted text-small">Saldo (Bônus)</div>
										<div class="col-6 col-md-2 d-flex align-items-center text-alternate text-medium text-muted text-small">TELEFONE</div>
										<div class="col-6 col-md-2 d-flex align-items-center text-alternate text-medium justify-content-end text-muted text-small">Cadastro</div>
										<!-- <div class="col-2  d-flex align-items-center text-alternate text-medium text-muted text-small">SALDO REAL</div>
										<div class="col-2  d-flex align-items-center text-alternate text-medium text-muted text-small">SALDO BÔNUS</div>
										<div class="col-2  d-flex align-items-center text-alternate text-medium text-muted text-small">CADASTR</div> -->
									</div>

								</div>

								<div class="mb-5 border-last-none">
									<?php foreach($usuarios->result() as $usuario){ ?>
										<div class="h-100 sh-md-4 border-bottom border-separator-light pb-3 mb-3">
											<div class="row g-0 h-100 align-content-center">
												<div class="col-10 col-md-5 d-flex flex-column justify-content-center mb-1 mb-md-0 order-0 bt_dd_user" data-id="<?=$usuario->id?>" style="cursor: pointer;">
													<div class="text-alternate"><?=$usuario->nome?>
														<a href="#<?=$usuario->telefone?>">Whats</a>
														-
														<a href="#<?=$usuario->telefone?>">Fone</a>
													</div>
												</div>
												<div class="col-6 col-md-3 d-flex flex-column justify-content-center mb-1 mb-md-0 order-2">
													<div class="text-alternate">R$ <?=str_replace(".",",",$this->usuarios_model->saldo($usuario->id,0))?></div>
												</div>
												<div class="col-6 col-md-2 d-flex flex-column justify-content-center mb-1 mb-md-0 order-3">
													<div class="text-alternate"><?=$usuario->telefone?></div>
												</div>
												<div class="col-2 col-md-2 d-flex flex-column justify-content-center align-items-md-end mb-1 mb-md-0 order-1 order-md-4">
													<a class="link" href="#">
													<div class="text-alternate"><?=$usuario->dt_cadastro?></div>
													</a>
												</div>
											</div>
										</div>
									<?php } ?>

								</div>
						</div>
					</div>
				</div>
			</div>



			<!-- NOVA TABLE -->




			<!-- dados dinamicos  -->

			<div class="mb-5" style="display: none;">
						<div class="row row-cols-1 row-cols-xl-2 g-2">

							<div class="col">
								<div class="card">
									
									<!-- ###################################### -->

									<h2 class="small-title">Usuários Cadastrados (Raspadinha)</h2>
									<div class="card">
									<div class="card-body">
									<div class="mb-2 bg-transparent no-shadow d-none d-md-block g-0 sh-3">
										<div class="row g-0 h-100 align-content-center">
											<div class="col-12 col-md-5 d-flex align-items-center mb-2 mb-md-0 text-muted text-small">Nome</div>
											<div class="col-6 col-md-3 d-flex align-items-center text-alternate text-medium text-muted text-small">MÁXIMO DIÁRIO</div>
											<div class="col-6 col-md-2 d-flex align-items-center text-alternate text-medium text-muted text-small">PROBABILIDADE</div>
											<div class="col-6 col-md-2 d-flex align-items-center text-alternate text-medium justify-content-end text-muted text-small">AÇÕES</div>
										</div>
									</div>

									<div class="mb-5 border-last-none">
										<?php foreach($usuarios->result() as $usuario){ ?>
											<div class="h-100 sh-md-4 border-bottom border-separator-light pb-3 mb-3">
												<div class="row g-0 h-100 align-content-center">
													<div class="col-11 col-md-5 d-flex flex-column justify-content-center mb-2 mb-md-0 order-0">
														<div class="text-alternate"><?=$usuario->nome?></div>
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
										<?php } ?>

								


									<!-- ########################################## -->
									

								</div>
							</div>



						</div>
					</div>

				</div>
			</div>

		 </div>

 
</main>



<?php include("includes/adm/footer.php"); ?>



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
<!-- <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script> -->
<!-- <script src="<?=base_url()?>js/vendor/bootstrap.bundle.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
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

<script>
	$(document).ready(function(){
		//alert("OPK");
		$(".bt_dd_user").click(function(){
			var id_user = $(this).attr('data-id');
			$("#modal_dd").modal('show');
			$.get("<?=base_url()?>adm/usuarios/get_user/"+id_user , function(dd_user){
				console.log(dd_user);
				$("#call_dd").html(dd_user);
			})
			//alert(id_user);

			$(".bt_x").click(function(){
				$("#modal_dd").modal('hide')
			})
		})
	})
</script>


</body>

<!-- Mirrored from acorn-html-service-provider.coloredstrategies.com/Account.Security.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 08 May 2024 18:50:27 GMT -->
</html>

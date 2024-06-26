<!-- NAV MOBILE -->

<?php if($this->session->userdata('id')) { ?>

	<div class="elementor-menu-toggle" id="menu-toggle" role="button" tabindex="0" aria-label="Alternar menu" aria-expanded="false">
		<style type="text/css">
			#btn-menu-bar, #btn-menu-close {
				color: #EA6C00;
			}
		</style>
		
		<?php if (isset($pageTeste)) { ?>
			<a href="https://raspeiganhei.com/ci/home/play/2" class="elementor-item elementor-item-anchor btn btn-primary" aria-current="">
				Jogar
			</a>
			<button type="button" class="btn btn-success bt_deposito"  data-toggle="modal" data-target=".bd-example-modal-sm">  
				Depositar
			</button>
		<?php } ?>

		<i aria-hidden="true" role="presentation" class="elementor-menu-toggle__icon--open eicon-menu-bar" id="btn-menu-bar"></i>
		<i aria-hidden="true" role="presentation" class="elementor-menu-toggle__icon--close eicon-close" id="btn-menu-close"></i>
		<span class="elementor-screen-only">Menu</span>
	</div>
	<nav class="elementor-nav-menu--dropdown elementor-nav-menu__container" aria-hidden="true" style="width: 1350px; left: 0px; top: 44px; --menu-height: 0;">
		<ul id="menu-2-2f86f7d9" class="elementor-nav-menu" data-smartmenus-id="1716133878130579">
			<?php if($this->session->userdata('id')) { ?>
				<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1186">
					<a href="#" class="elementor-item" tabindex="-1">
						<strong> <?=$this->session->userdata('nome'); ?> </strong>
					</a>
					<div class="dropdown">
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="font-size: 14px;">
							<a class="dropdown-item bt_deposito" href="#" style="color:red" >Depositar</a>
							<a class="dropdown-item" href="#">Meu Perfil</a>
							<a class="dropdown-item" href="#">Configurações</a>
							<div class="dropdown-divider"></div>
							<span class="dropdown-item-text" style="font-size: 14px;">Saldo:
								<strong>R$ </strong> <?//=str_replace(".",",",$this->usuarios_model->saldo(0,1))?>
							</span>
							<hr>
							<a class="dropdown-item" href="<?//=base_url('home/sair')?>">Sair</a>
						</div>
					</div>
				</li>
				
			<?php } ?>
			<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3980">
				<a href="https://raspeiganhei.com/ci/home/play/1" class="elementor-item elementor-item-anchor" aria-current="">
					Início
				</a>
			</li>
			<!-- <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-111">
				<a class="dropdown-item bt_deposito" href="#">Depositar</a>
			</li> -->
			<?php if($this->session->userdata('id')) { ?>
				<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3980">
					<a href="https://raspeiganhei.com/ci/home/play/2" class="elementor-item elementor-item-anchor" aria-current="">
						Jogar
					</a>
				</li>
			<?php } ?>
			<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3980">
				<a href="https://raspeiganhei.com/ci/home/regulamento" class="elementor-item elementor-item-anchor" aria-current="">
					Regulamento
				</a>
			</li>
			<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3980">
				<a href="https://raspeiganhei.com/ci/home/faq" class="elementor-item elementor-item-anchor" aria-current="">
					Faq
				</a>
			</li>
			<?php if($this->session->userdata('id')) { ?>
				<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3981">
					<a href="<?=base_url()?>home/sair" class="elementor-item">Sair</a>
				</li>
			<?php } ?>
		</ul>
	</nav>

<?php } else { ?>

	<style type="text/css">
		nav.user-logout-mob button {
			float: right;
			font-size: 0.8rem;
			margin-left: 7px;
			padding: 5px 10px;
		}
		@media (min-width: 1025px) {
			nav.user-logout-mob {
				display: none;
			}
		}
	</style>
	<nav class="user-logout-mob">
		<button class="btn btn-secondary item-cadastro" data-toggle="modal" data-target="#modalCadastro" >
			Cadastre-se
		</button>
		<button type="button" class="btn btn-primary bt_login" data-toggle="modal" data-target="#modalLogin">
			Entrar
		</button>
	</nav>
<?php } ?>
<!-- X NAV MOBILE X -->
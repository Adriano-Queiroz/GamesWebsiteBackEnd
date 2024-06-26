<li id="menu-user-tools" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3981 menu-user-tools">
	<?php if($this->session->userdata('id')) { ?>
		<a href="#" class="elementor-item elementor-item-anchor has-submenu" id="sm-11111-3" aria-haspopup="true" aria-controls="sm-11111-3" aria-expanded="false" aria-current="">
			<strong> <?=$this->session->userdata('nome')?> </strong>
			<i class="fa-solid fa-chevron-down"></i>
		</a>
		<ul class="sub-menu elementor-nav-menu--dropdown" id="sm-11111-3" role="group" aria-hidden="true" aria-labelledby="sm-11111-3" aria-expanded="false">
			<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-111">
				<a class="dropdown-item bt_deposito" href="#">Depositar</a>
			</li>
			<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-222">
				<a class="dropdown-item" href="<?=base_url()?>perfil/dd">Meu Perfil</a>
			</li>
			<!-- <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-333">
				<a class="dropdown-item" href="#">Configurações</a>
			</li> -->
			<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-444">
				<span class="dropdown-item">Saldo:
					<strong>R$ </strong> <?=str_replace(".",",",$this->usuarios_model->saldo(0,1))?>
				</span>
			</li>
			<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-555">
				<a class="dropdown-item" href="<?=base_url('home/sair')?>">Sair</a>
			</li>
		</ul>
	<?php } else { ?>
		<button type="button" class="btn btn-primary bt_login" data-toggle="modal" data-target="#modalLogin">
			Entrar
		</button>
		&nbsp;&nbsp;
		<button class="btn btn-secondary my-2 my-sm-0 item-cadastro" data-toggle="modal" data-target="#modalCadastro" >
			Cadastre-se
		</button>
	<?php } ?>
</li>
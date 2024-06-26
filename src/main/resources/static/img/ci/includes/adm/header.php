<div id="nav" class="nav-container d-flex">
		<div class="nav-content d-flex">
			<div class="logo position-relative">
				<a href="<?=base_url()?>adm/usuarios/dash">
					<div><img src="<?=base_url()?>logo.png"></div>
				</a>
			</div>
			<div class="user-container d-flex">
				<a href="#" class="d-flex user position-relative" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<!-- <img class="profile" alt="profile" src="<?=base_url()?>img/profile/perfil.png"> -->
					<img class="profile" alt="profile" src="https://raspeiganhei.com/img/favicon/mstile-310x310.png">
					<div class="name"><?=$this->session->userdata('nome')?></div>
					<div class="name"> :<?=$this->session->userdata('id')?></div>
				</a>
				<div class="dropdown-menu dropdown-menu-end user-menu wide">


					<div class="row mb-1 ms-0 me-0">

						<div class="col-6 ps-1 pe-1">
							<ul class="list-unstyled">
								<li>
								<a href="https://raspeiganhei.com/ci/home/faq" target="_blank">
								<i data-acorn-icon="help" class="me-2" data-acorn-size="17"></i>
								<span class="align-middle">Faq</span>
								</a>
								</li>
								<li>
								<a href="https://web.whatsapp.com/" target="_blank"  target="_blank">
								<i data-acorn-icon="file-text" class="me-2" data-acorn-size="17"></i>
								<span class="align-middle">Suporte</span>
								</a>
								</li>
								</ul>
								</div>
								<div class="col-6 pe-1 ps-1">
								<ul class="list-unstyled">
								<li>
								<a href="<?=base_url()?>perfil/dd">
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
					
						</ul>
					</div>
				</div>
			</li>
		</ul>
		<div class="menu-container flex-grow-1">
			<ul id="menu" class="menu">
				<li>
					<a href="<?=base_url()?>adm/usuarios/extrato/saques">
						<i data-acorn-icon="arrow-top" class="icon" data-acorn-size="18"></i>
						<span class="label">Saques</span>
					</a>
				</li>
				<li>
					<a href="<?=base_url()?>adm/usuarios/extrato/depositos">
						<i data-acorn-icon="arrow-bottom" class="icon" data-acorn-size="18"></i>
						<span class="label">Depositos</span>
					</a>
				</li>
				<li>
					<a href="https://raspeiganhei.com/afiliados.html" target="_blank">
						<i data-acorn-icon="user" class="icon" data-acorn-size="18"></i>
						<span class="label">Afiliados</span>
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
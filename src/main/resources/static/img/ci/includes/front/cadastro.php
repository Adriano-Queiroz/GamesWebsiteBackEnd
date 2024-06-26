<form class="form-inline" action="<?=base_url('admin/cadastrar')?>" method="post">

	<input class="form-control mr-sm-2" type="text" placeholder="Nome" aria-label="Nome" name="nome" required>						
	<input class="form-control mr-sm-2" type="text" placeholder="Telefone" aria-label="Telefone" name="telefone" id="telefone">

	<input class="form-control mr-sm-2" type="text" placeholder="CEP" aria-label="CEP" name="cep">						
	<input class="form-control mr-sm-2" type="text" placeholder="CPF" aria-label="CPF" name="cpf">
	
	<input class="form-control mr-sm-2" type="email" placeholder="E-mail" aria-label="Login" name="email" required>						
	<input class="form-control mr-sm-2" type="password" placeholder="Senha" aria-label="Senha" name="senha" required minlength="6">

	<button class="btn btn-success my-2 my-sm-0" type="submit">Cadastrar</button>
	&nbsp;&nbsp;&nbsp;&nbsp;Se você é membro, &nbsp; <a href="#" class="bt_login_cad">Faça Login</a>.
</form>
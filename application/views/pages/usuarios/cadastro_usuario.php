  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  	<!-- Content Header (Page header) -->
  	<section class="content-header">
  		<h1>
  			Cadastro de Usuario
  		</h1>
  		<ol class="breadcrumb">
  			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  			<li>Usuarios</li>
  			<li class="active"> Cadastro de Usuario</li>
  		</ol>
  	</section>

  	<!-- Main content -->
  	<section class="content">
  		<div class="row">
  			<div class="col-xs-12 col-sm-12 col-lg-12">
  				<div class="box box-warning">
  					<div class="box-header with-border">
  						<h3 class="box-title">Informe os dados do usuario</h3>
  					</div>
  					<?php
						if (isset($msg)) {
							echo '<div class="box-header with-border">' . $msg . '</div>';
						}
						?>
  					<div class="box-body">
  						<form role="form" action="cadastrausuario" method="post" class="form-horizontal">
  							<div class="box-body">
  								<div class="form-group">
  									<label for="nome" class="col-sm-2 control-label">Nome</label>

  									<div class="col-sm-10">
  										<input type="text" class="form-control" id="nome" name="nome" placeholder="Informe o nome completo do usuario" value="<?= set_value('nome'); ?>">
  									</div>
  								</div>
  								<div class="form-group">
  									<label for="login" class="col-sm-2 control-label">Login</label>

  									<div class="col-sm-10">
  										<input type="text" class="form-control" id="login" name="login" placeholder="Informe o nome completo do usuario" value="<?= set_value('login'); ?>">
  									</div>
  								</div>
  								<div class="form-group">
  									<label for="email" class="col-sm-2 control-label">E-mail</label>

  									<div class="col-sm-10">
  										<input type="email" class="form-control" id="email" name="email" placeholder="Informe o e-mail de contato" value="<?= set_value('email'); ?>">
  									</div>
  								</div>
  								<div class="form-group">
  									<label for="senha" class="col-sm-2 control-label">Password</label>

  									<div class="col-sm-10">
  										<input type="password" class="form-control" id="senha" name="senha" placeholder="Informe uma senha de 6 a 8 caracteres" value="<?= set_value('senha'); ?>">
  									</div>
  								</div>

  								<div class="form-group">
  									<label for="perfilid" class="col-sm-2 control-label">Perfil</label>
  									<div class="col-sm-10">
  										<select class="form-control" id="perfilid" name="perfilid">
  											<option value="">Selecione...</option>
  											<?php
												if (isset($resultadoPerfil)) {
													foreach ($resultadoPerfil as $perfil) {
														echo '<option value="' . $perfil->perfilid . '">' . $perfil->descricao . '</option>';
													}
												}
												?>
  										</select>
  									</div>
  								</div>
  							</div>
  							<div class="form-group">
  								<div class="col-xs-12 col-sm-9 col-lg-9">&nbsp;</div>
  								<div class="col-xs-12 col-sm-3 col-lg-3">
  									<button type="submit" class="btn btn-primary" style="width: 100%">Cadastrar Usuario</button>
  								</div>
  							</div>
  						</form>
  					</div>
  				</div>
  			</div>
  		</div>
  	</section>
  	<!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<!-- Script Page -->
  <script src="<?= base_url() ?>assets/js/jquery/jquery-2.2.3.min.js"></script>
  <script>
  	var base_url = '<?= base_url() ?>';
  	$(document).ready(function() {

  	});

  	function buscaInfo(perfil) {
  		var perfil = perfil;
  		var url = base_url + "home/buscaUsuarioPerfil";
  		$.post(url, {
  			perfil: perfil
  		}, function(data) {
  			$('#resultado').html(data);
  		});
  	}
  </script>

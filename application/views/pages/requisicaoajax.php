  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  	<!-- Content Header (Page header) -->
  	<section class="content-header">
  		<h1>
  			Dashboard <small>Version 2.0</small>
  		</h1>
  		<ol class="breadcrumb">
  			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  			<li class="active">Requisição AJAX</li>
  		</ol>
  	</section>

  	<!-- Main content -->
  	<section class="content">
  		<!-- Info boxes -->
  		<div class="row">
  			<div class="col-xs-12 col-sm-6 col-lg-3">
  				<div class="box box-warning">
  					<div class="box-header with-border">
  						<h3 class="box-title">Perfil</h3>
  					</div>
  					<!-- /.box-header -->
  					<div class="box-body">
  						<form role="form">
  							<div class="form-group">

  								<select class="form-control" onchange="buscaInfo(this.value)">
  									<option>Selecione</option>
  									<?php
										if (isset($resultadoPerfil)) {
											foreach ($resultadoPerfil as $perfil) {
												echo '<option value="' . $perfil->perfilid . '">' . $perfil->descricao . '</option>';
											}
										}
										?>
  								</select>
  							</div>
  						</form>
  					</div>
  				</div>
  			</div>
  			<div class="col-xs-12 col-sm-6 col-lg-3">
  				<div class="box box-warning">
  					<div class="box-header with-border">
  						<h3 class="box-title">Resultado AJAX</h3>
  					</div>
  					<!-- /.box-header -->
  					<div class="box-body">
  						<form role="form">
  							<div class="form-group">
  								<textarea class="form-control" rows="3" id="resultado" name="resultado" placeholder="Selecione o Perfil para mais informações..."></textarea>

  							</div>
  						</form>
  					</div>
  				</div>
  			</div>
  		</div>
  		<!-- /.row -->
  	</section>
  	<!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


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

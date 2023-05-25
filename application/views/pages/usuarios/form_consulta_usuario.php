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

<?php
// if ($this->session->userdata('logged_in')) {

if (isset($tela)) {
	$tela = $tela;
} else {
	$tela = 'dashboard';
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Painel de Controle | Dashboard</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.6 -->
	<link rel="stylesheet" href="<?= base_url(); ?>assetsadm/css/bootstrap/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	<!-- jvectormap -->
	<link rel="stylesheet" href="<?= base_url(); ?>assetsadm/css/jvectormap/jquery-jvectormap-1.2.2.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?= base_url(); ?>assetsadm/css/AdminLTE.min.css">
	<!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="<?= base_url(); ?>assetsadm/css/skins/_all-skins.min.css">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body class="hold-transition skin-blue sidebar-mini">

	<?php
	// $this->load->view("templates/header");
	$this->load->view("templates/topbar");
	$this->load->view("templates/sidebar");
	$this->load->view("templates/configbar");
	if ($tela != '') {
		$this->load->view("pages/" . $tela);
	}
	$this->load->view('templates/footer');
	$this->load->view('templates/controlbar');
	$this->load->view('templates/js');
	?>

	<!-- /.control-sidebar -->
	<!-- Add the sidebar's background. This div must be placed
       				immediately after the control sidebar -->
	<div class="control-sidebar-bg"></div>

	<!-- ./wrapper -->

	<!-- jQuery 2.2.3 -->
	<script src="<?= base_url(); ?>assetsadm/js/jquery/jquery-2.2.3.min.js"></script>
	<!-- Bootstrap 3.3.6 -->
	<script src="<?= base_url(); ?>assetsadm/js/bootstrap/bootstrap.min.js"></script>
	<!-- FastClick -->
	<script src="<?= base_url(); ?>assetsadm/js/fastclick/fastclick.js"></script>
	<!-- AdminLTE App -->
	<script src="<?= base_url(); ?>assetsadm/js/app.min.js"></script>
	<!-- Sparkline -->
	<script src="<?= base_url(); ?>assetsadm/js/sparkline/jquery.sparkline.min.js"></script>
	<!-- jvectormap -->
	<script src="<?= base_url(); ?>assetsadm/js/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
	<script src="<?= base_url(); ?>assetsadm/js/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
	<!-- SlimScroll 1.3.0 -->
	<script src="<?= base_url(); ?>assetsadm/js/slimScroll/jquery.slimscroll.min.js"></script>
	<!-- ChartJS 1.0.1 -->
	<script src="<?= base_url(); ?>assetsadm/js/chartjs/Chart.min.js"></script>
	<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
	<script src="<?= base_url(); ?>assetsadm/js/dashboard2.js"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="<?= base_url(); ?>assetsadm/js/demo.js"></script>
</body>

</html>


<?php
// } else {
// 	redirect('login');
// }
?>

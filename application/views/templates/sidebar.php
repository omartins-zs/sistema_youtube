<?php
$session_youtube = $this->session->userdata('logged_in');
$nomeUsuario = $session_youtube['nomeUsuario'];
$menuativo = '';
if (isset($telaativa)) {
	$menuativo = $telaativa;
}
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $menuativo;
?>
<!-- Left side column. contains the logo and sizdebar -->
<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- Sidebar user panel -->
		<div class="user-panel">
			<div class="pull-left image">
				<img src="../assets/img/01avatar.png" class="img-circle" alt="User Image">
			</div>
			<div class="pull-left info">
				<p><?= $nomeUsuario; ?></p>
				<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
			</div>
		</div>
		<ul class="sidebar-menu">
			<li class="treeview">
				<a href="dashboard">
					<i class="fa fa-dashboard"></i> <span>Dashboard</span>
				</a>
			</li>

			<li class="<?php if ($menuativo === "usuarios") {
							echo "active";
						} ?> treeview">
				<a href="#">
					<i class="fa fa-users"></i>
					<span>Usuarios</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="cadastrausuario"><i class="fa fa-circle-o"></i> Cadastro</a></li>
					<li><a href="consultausuario"><i class="fa fa-circle-o"></i> Consulta</a></li>
					<li><a href="listausuario"><i class="fa fa-circle-o"></i> Lista</a></li>
					<!--                              <li><a href="#"><i class="fa fa-circle-o"></i> Relat&oacute;rio</a></li>-->
				</ul>
			</li>

			<li class="<?php if ($menuativo === "clientes") {
							echo "active";
						} ?> treeview">
				<a href="#">
					<i class="fa fa-suitcase"></i>
					<span>Clientes</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="cadastracliente"><i class="fa fa-circle-o"></i> Cadastro</a></li>
					<li><a href="consultacliente"><i class="fa fa-circle-o"></i> Consulta</a></li>
					<li><a href="listacliente"><i class="fa fa-circle-o"></i> Lista</a></li>
				</ul>
			</li>

			<li class="<?php if ($menuativo === "produtos") {
							echo "active";
						} ?> treeview">
				<a href="#">
					<i class="fa fa-cubes"></i>
					<span>Produtos</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="cadastraproduto"><i class="fa fa-circle-o"></i> Cadastro</a></li>
					<li><a href="consultaproduto"><i class="fa fa-circle-o"></i> Consulta</a></li>
					<li><a href="listaproduto"><i class="fa fa-circle-o"></i> Lista</a></li>
				</ul>
			</li>

			<li class="<?php if ($menuativo === "pedido") {
							echo "active";
						} ?> treeview">
				<a href="#">
					<i class="fa fa-files-o"></i>
					<span>Pedidos</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="novopedido"><i class="fa fa-circle-o"></i> Novo Pedido</a></li>
					<li><a href="alterarpedido"><i class="fa fa-circle-o"></i> Alterar Pedido</a></li>
					<li><a href="consultarpedido"><i class="fa fa-circle-o"></i> Consultar Pedido</a></li>
					<li><a href="emissaopedido"><i class="fa fa-circle-o"></i> Emissão Pedido</a></li>
				</ul>
			</li>
			<li class="treeview">
				<a href="requicaoajax">
					<i class="fa fa-dashboard"></i> <span>Requisicao JQUERY/AJAX</span>
					<!--            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                              </span>-->
				</a>
			</li>
		</ul>
	</section>
	<!-- /.sidebar -->
</aside>
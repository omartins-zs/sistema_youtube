<link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap/bootstrap.min.css">
<link rel="stylesheet" href="<?= base_url(); ?>assets/datatables/dataTables.bootstrap.css">

<div class="content-wrapper">
	<section class="content-header">
		<h1>Lista de Usuarios</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li>Usuarios</li>
			<li class="active">Lista de Usuarios</li>
		</ol>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-lg-12">
				<div class="box box-warning">

					<?php
					if (isset($msg)) {
						echo '<div class="box-header with-border">' . $msg . '</div>';
					}
					?>
					<div class="box">
						<div class="box-header with-border">
							<h3 class="box-title">Lista de Usuarios localizados</h3>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>Nome do Usuario</th>
										<th>Login</th>
										<th>E-mail</th>
										<th>Cadastrado em:</th>
										<th>Ultimo Acesso</th>
									</tr>
								</thead>
								<tbody>
									<?php
									if (isset($resultadoUsuario)) {
										foreach ($resultadoUsuario as $usuarios) {
									?>
											<tr>
												<td><?= $usuarios->nome; ?></td>
												<td><?= $usuarios->login; ?></td>
												<td><?= $usuarios->email; ?></td>
												<td><?= $usuarios->datacadastro; ?></td>
												<td><?= $usuarios->dataultimoacesso; ?></td>
											</tr>
									<?php
										}
									}
									?>

								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

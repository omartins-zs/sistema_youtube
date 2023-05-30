<div class="content-wrapper">
	<section class="content-header">
		<h1>Cadastro de Clientes</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li>Clientes</li>
			<li class="active">Cadastro de Cliente</li>
		</ol>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-lg-12">
				<div class="box box-warning">
					<div class="box-header with-border">
						<h3 class="box-title">Informe os dados do cliente</h3>
					</div>
					<?php
					if (isset($msg)) {
						echo '<div class="box-header with-border">' . $msg . '</div>';
					}
					?>
					<div class="box-body">
						<form role="form" action="cadastracliente" method="post" class="form-horizontal">
							<div class="box-body">
								<div class="form-group">
									<label for="nomefantasia" class="col-sm-2 control-label">Nome Fantasia</label>

									<div class="col-sm-10">
										<input type="text" class="form-control" id="nomefantasia" name="nomefantasia" placeholder="Informe o nome fantasia do cliente" value="<?= set_value('nomefantasia'); ?>">
									</div>
								</div>
								<div class="form-group">
									<label for="razaosocial" class="col-sm-2 control-label">Razão Social</label>

									<div class="col-sm-10">
										<input type="text" class="form-control" id="razaosocial" name="razaosocial" placeholder="Informe a Razão Social" value="<?= set_value('razaosocial'); ?>">
									</div>
								</div>


							</div>
							<div class="form-group">
								<div class="col-xs-12 col-sm-9 col-lg-9">&nbsp;</div>
								<div class="col-xs-12 col-sm-3 col-lg-3">
									<button type="submit" class="btn btn-primary" style="width: 100%">Cadastrar Cliente</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

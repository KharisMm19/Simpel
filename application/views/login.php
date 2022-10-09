<body class="my-login-page">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
					<div class="brand">
						<img style="margin-left: 12px; height: 65px; margin-top: 20px; width: 65px;" src="<?= base_url();?>assetsLogin/img/logo2.png" alt="logo">
					</div>
					<div class="card fat">
						<div class="card-body">
                            <h4 class="card-title text-center">Login</h4>
							<?= $this->session->flashdata('pesan') ?>
							<form method="POST" class="my-login-validation" action="<?= base_url()?>Login/proses_login">
								<div class="form-group">
									<label for="username">Username</label>
									<input id="username" type="text" class="form-control" name="username" required autofocus>
								</div>

								<div class="form-group">
									<label for="password">Password</label>
									<input id="password" type="password" class="form-control" name="password" required
										data-eye>
									<div class="invalid-feedback">
										Password is required
									</div>
								</div>

								<div class="form-group m-0">
									<button type="submit" class="btn btn-primary btn-block">
										Login
									</button>
									<a class="btn btn-danger btn-block" href="<?php echo base_url()?>Dashboard">Back</a>
								</div>
							</form>
						</div>
					</div>

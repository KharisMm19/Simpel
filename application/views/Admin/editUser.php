<section id="main-content">
	<section class="wrapper">
		<br>
		<center>
			<h3 style="color: black;">Edit Data User</h3>
		</center>
		<div class="row mt">
			<div class="col-lg-12">
				<div class="form-panel">
					<?php echo validation_errors(); ?>
					<?php echo (isset( $upload_error)) ? '<div class="alert alert-warning" role="alert">' .$upload_error. '</div>' : ''; ?>

					<?php echo form_open_multipart(current_url(),array('class' => 'form-horizontal style-form','needs-validation','novalidate' => ''));?>
                    <form>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">SKPD</label>
							<div class="col-sm-10">
								<?php echo form_dropdown('nama_skpd', $skpd, set_value('id_skpd'), 'class="form-control" required' ); ?>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Level</label>
							<div class="col-sm-10">
								<?php echo form_dropdown('nama_jenis_user', $level, set_value('id_jenis_user'), 'class="form-control" required' ); ?>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Nama Lengkap</label>
							<div class="col-sm-10">
								<input type="text" name="nama_user" class="form-control"
									value="<?php echo set_value('nama_user', $result->nama_user) ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Email</label>
							<div class="col-sm-10">
								<input type="email" name="email" class="form-control"
									value="<?php echo set_value('email', $result->email) ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">No Telp</label>
							<div class="col-sm-10">
								<input type="text" name="nomor_telepon" class="form-control"
									value="<?php echo set_value('nomor_telepon', $result->nomor_telepon) ?>">
							</div>
						</div>

                        <div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Username</label>
							<div class="col-sm-10">
								<input type="text" name="username" class="form-control"
									value="<?php echo set_value('username', $result->username) ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Password</label>
							<div class="col-sm-10">
								<input type="password" name="password" class="form-control"
									value="<?php echo set_value('password', $result->password) ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Konfirmasi Password</label>
							<div class="col-sm-10">
								<input type="password" name="password2" class="form-control"
									value="<?php echo set_value('password', $result->password) ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Foto Profil</label>
							<?php if( $result->foto_user ) : ?>
							<img class="card-img-top" src="<?php echo base_url() .'uploads/'. $result->foto_user ?>"
								alt="Card image cap" width=300>
							<?php endif; ?>
							<div class="col-sm-12">
							<input type="file" name="image" class="form-control" placeholder="Choose file" />
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-offset-2 col-lg-10">
								<button class="btn btn-theme" type="submit">Save</button>
								<a class="btn btn-theme04" type="button" href="<?= base_url() ?>DataUser">Cancel</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</section>

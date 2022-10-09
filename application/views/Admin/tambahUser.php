<section id="main-content">
	<section class="wrapper">
		<?php if($this->session->flashdata('pesan')): ?>
		<?php echo '<p class="alert alert-success">'.$this->session->flashdata('pesan').'</p>'; ?>
		<?php endif; ?>
		<?php if($this->session->flashdata('user_registered')): ?>
		<?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_registered').'</p>'; ?>
		<?php endif; ?>
		<br>
		<center>
			<h3 style="color: black;">Tambah Data User</h3>
		</center>
		<div class="row mt">
			<div class="col-lg-12">
				<div class="form-panel">
					<?php echo validation_errors(); ?>
					<?php echo form_open_multipart('DataUser/tambah', array('class' => 'form-horizontal style-form','needs-validation','novalidate' => ''));?>
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
								<input type="text" name="nama_user" class="form-control" placeholder="Isi nama">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Email</label>
							<div class="col-sm-10">
								<input type="email" name="email" class="form-control" placeholder="Isi email">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">No Telp</label>
							<div class="col-sm-10">
								<input type="text" name="telp_user" class="form-control" placeholder="Isi no telp">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Username</label>
							<div class="col-sm-10">
								<input type="text" name="username" class="form-control" placeholder="Isi username">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Password</label>
							<div class="col-sm-10">
								<input type="password" name="password" class="form-control" placeholder="Isi password">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Konfirmasi Password</label>
							<div class="col-sm-10">
								<input type="password" name="password2" class="form-control"
									placeholder="Isi konfirmasi password">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Foto Profil</label>
							<div class="col-sm-10">
								<input type="file" name="image" class="form-control-file">
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

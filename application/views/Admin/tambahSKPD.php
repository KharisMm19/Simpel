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
			<h3 style="color: black;">Tambah Data SKPD</h3>
		</center>
		<div class="row mt">
			<div class="col-lg-12">
				<div class="form-panel">
					<?php echo validation_errors(); ?>
					<?php echo form_open_multipart('DataSkpd/tambah', array('class' => 'form-horizontal style-form','needs-validation','novalidate' => ''));?>
					<form>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Masukkan Nama SKPD</label>
							<div class="col-sm-10">
								<input type="text" name="nama_skpd" class="form-control" placeholder="Isi nama SKPD">
							</div>
						</div>
                        
                        <div class="form-group">
							<div class="col-lg-offset-2 col-lg-10">
								<button class="btn btn-theme" type="submit">Save</button>
								<a class="btn btn-theme04" type="button" href="<?= base_url() ?>DataSkpd">Cancel</a>
                            </div>
                        </div>
					</form>
				</div>
			</div>
		</div>
	</section>
</section>

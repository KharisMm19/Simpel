<section id="main-content">
	<section class="wrapper">
		<?php if ($this->session->flashdata('pesan')) : ?>
			<?php echo '<p class="alert alert-success">' . $this->session->flashdata('pesan') . '</p>'; ?>
		<?php endif; ?>
		<br>
		<center>
			<h3 style="color: black;">Tambah Data LHP</h3>
		</center>
		<div class="row mt">
			<div class="col-lg-12">
				<div class="form-panel">
					<?php echo validation_errors(); ?>
					<?php echo form_open_multipart('Admin/tambah', array('class' => 'form-horizontal style-form', 'needs-validation', 'novalidate' => '')); ?>
					<form>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">SKPD</label>
							<div class="col-sm-10">
								<?php echo form_dropdown('nama_skpd', $skpd, set_value('id_skpd'), 'class="form-control" required'); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">No. LHP</label>
							<div class="col-sm-10">
								<input type="text" name="no_lhp" class="form-control" placeholder="Isi No. LHP">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Judul LHP</label>
							<div class="col-sm-10">
								<input type="text" name="judul_lhp" class="form-control" placeholder="Isi Judul LHP">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Tahun</label>
							<div class="col-sm-10">
								<input type="text" name="tahun" class="form-control" placeholder="Isi Tahun">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Temuan</label>
							<div class="col-sm-10">
								<div class="table-responsive" style="margin-left:-8px;">
									<table class="table table-borderless" id="dynamic_field">
										<tr>
											<td>
												<input type="text" name="temuan[]" class="form-control name_list" placeholder="Isi Temuan" required="" />
											</td>

											<td>
												<button type="button" name="add" id="add" class="btn btn-primary"><i class="fa fa-plus"></i></button>
											</td>
										</tr>
									</table>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-offset-2 col-lg-10">
								<button class="btn btn-theme" type="submit">Save</button>
								<a class="btn btn-theme04" type="button" href="<?= base_url() ?>Admin/DataLhp">Cancel</a>
							</div>
						</div>
					</form>
					<?= form_close(); ?>
				</div>
			</div>
		</div>
	</section>
</section>
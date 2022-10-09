<section id="main-content">
	<section class="wrapper">
		<br>
		<center>
			<h3 style="color: black;">Edit Data LHP</h3>
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
								<?php echo form_dropdown('nama_skpd', $skpd, set_value('id_skpd', $result->id_skpd), 'class="form-control" required' ); ?>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">No. LHP</label>
							<div class="col-sm-10">
								<input type="text" name="no_lhp" class="form-control"
									value="<?php echo set_value('no_lhp', $result->no_lhp) ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Judul LHP</label>
							<div class="col-sm-10">
								<input type="text" name="judul_lhp" class="form-control"
									value="<?php echo set_value('judul_lhp', $result->judul_lhp) ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Tahun</label>
							<div class="col-sm-10">
								<input type="text" name="tahun" class="form-control"
									value="<?php echo set_value('tahun', $result->tahun) ?>">
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-offset-2 col-lg-10">
								<button class="btn btn-theme" type="submit">Save</button>
								<a class="btn btn-theme04" type="button" href="<?= base_url() ?>Admin/DataLHP">Cancel</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</section>

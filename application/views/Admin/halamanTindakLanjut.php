<section id="main-content">
	<section class="wrapper">
		<br>
		<center>
			<h3 style="color: black;">Input Tindak Lanjut</h3>
		</center>
		<div class="row mt">
			<div class="col-lg-12">
				<div class="form-panel">
					<?php echo validation_errors(); ?>
					<?php echo (isset( $upload_error)) ? '<div class="alert alert-warning" role="alert">' .$upload_error. '</div>' : ''; ?>

					<?php echo form_open_multipart(current_url(),array('class' => 'form-horizontal style-form','needs-validation','novalidate' => ''));?>
                    <form>
                        <div class="form-group" hidden>
							<label class="col-sm-2 col-sm-2 control-label">ID. Temuan</label>
							<div class="col-sm-10">
								<input type="text" name="id_temuan" class="form-control"
									value="<?php echo set_value('id_temuan', $result->id_temuan) ?>" readonly>
							</div>
						</div>
                        <div class="form-group" hidden>
							<label class="col-sm-2 col-sm-2 control-label">ID. Rekomendasi</label>
							<div class="col-sm-10">
								<input type="text" name="id_rekomendasi" class="form-control"
									value="<?php echo set_value('id_rekomendasi', $result->id_rekomendasi) ?>" readonly>
							</div>
						</div>
                        <div class="form-group" hidden>
							<label class="col-sm-2 col-sm-2 control-label">ID. LHP</label>
							<div class="col-sm-10">
								<input type="text" name="id_lhp" class="form-control"
									value="<?php echo set_value('id_lhp', $result->id_lhp) ?>" readonly>
							</div>
						</div>
                        <div class="form-group" hidden>
							<label class="col-sm-2 col-sm-2 control-label">ID. SKPD</label>
							<div class="col-sm-10">
								<input type="text" name="id_skpd" class="form-control"
									value="<?php echo set_value('id_skpd', $result->id_skpd) ?>" readonly>
							</div>
						</div>
                        <div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">No. LHP</label>
							<div class="col-sm-10">
								<input type="text" name="no_lhp" class="form-control"
									value="<?php echo set_value('no_lhp', $result->no_lhp) ?>" readonly>
							</div>
						</div>
                        <div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Judul LHP</label>
							<div class="col-sm-10">
								<input type="text" name="judul_lhp" class="form-control"
									value="<?php echo set_value('judul_lhp', $result->judul_lhp) ?>" readonly>
							</div>
						</div>
                        <div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Temuan</label>
							<div class="col-sm-10">
								<input type="text" name="temuan" class="form-control"
									value="<?php echo set_value('temuan', $result->temuan) ?>" readonly>
							</div>
						</div>
                        <div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Rekomendasi</label>
							<div class="col-sm-10">
								<input type="text" name="rekomendasi" class="form-control"
									value="<?php echo set_value('rekomendasi', $result->rekomendasi) ?>" readonly>
							</div>
						</div>
                        <div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Deskripsi<br>Usulan Tindak Lanjut</label>
							<div class="col-sm-10">
								<input type="text" name="keterangan" class="form-control"
									value="<?php echo set_value('keterangan', $result->keterangan) ?>">
							</div>
						</div>
                        <div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Status</label>
							<div class="col-sm-10">
								<?php echo form_dropdown('status', $status, set_value('id_status'), 'class="form-control" required'); ?>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-offset-2 col-lg-10">
								<button class="btn btn-theme" type="submit">Save</button>
								<a class="btn btn-theme04" type="button" href="<?= base_url('Admin/detailTL/'.$result->id_rekomendasi) ?>">Cancel</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</section>

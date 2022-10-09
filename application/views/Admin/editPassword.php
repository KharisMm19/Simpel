<section id="main-content">
	<section class="wrapper">
		<br>
		<center>
			<h3 style="color: black;">Edit Password User</h3>
		</center>
		<div class="row mt">
			<div class="col-lg-12">
				<div class="form-panel">
					<?php echo validation_errors(); ?>
					<?php echo (isset( $upload_error)) ? '<div class="alert alert-warning" role="alert">' .$upload_error. '</div>' : ''; ?>

					<?php echo form_open_multipart(current_url(),array('class' => 'form-horizontal style-form','needs-validation','novalidate' => ''));?>
                    <form>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Password</label>
							<div class="col-sm-10">
								<input type="password" name="password" class="form-control" placeholder="Isi password">
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-offset-2 col-lg-10">
								<button class="btn btn-theme" type="submit">Save</button>
								<a class="btn btn-theme04" type="button" href="<?= base_url() ?>Admin">Cancel</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</section>

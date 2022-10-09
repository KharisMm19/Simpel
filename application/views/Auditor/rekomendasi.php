<section id="main-content">
	<section class="wrapper">
		<?php if($this->session->flashdata('pesan')): ?>
		<?php echo '<p class="alert alert-success">'.$this->session->flashdata('pesan').'</p>'; ?>
		<?php endif; ?>
		<br>
		<center>
			<h3 style="color: black;">Input Rekomendasi</h3>
		</center>
		<div class="row mt">
			<div class="col-lg-12">
				<div class="form-panel">
					<?php echo validation_errors(); ?>
					<?php echo form_open_multipart('DataLHP/tambahRekomendasi', array('class' => 'form-horizontal style-form','needs-validation','novalidate' => ''));?>
					<form>
                        <div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">SKPD</label>
							<div class="col-sm-10">
                                <select class="form-control" name="skpd" id="skpd">
                                    <option selected>Please Select</option>
                                    <?php foreach($skpd as $key):?>
                                        <option value="<?php echo $key->id_skpd ?>"><?php echo $key->nama_skpd ?></option>
                                    <?php endforeach ?>
                                </select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">No. LHP</label>
							<div class="col-sm-10">
                                <select class="form-control" name="lhp" id="lhp" onchange="getLHP(this.options[this.selectedIndex].getAttribute('judul_lhp'), this.options[this.selectedIndex].getAttribute('tahun'))">
                                    <option value="">Please Select</option>
                                </select>
							</div>
						</div>
                        
                        <div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Judul LHP</label>
							<div class="col-sm-10">
								<input type="text" name="judul_lhp" id="judul_lhp" class="form-control" readonly>
							</div>
						</div>
                        
                        <div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Tahun</label>
							<div class="col-sm-10">
								<input type="text" name="tahun" id="tahun" class="form-control" readonly>
							</div>
						</div>
                        <div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Temuan</label>
							<div class="col-sm-10">
                                <select class="form-control" name="temuan" id="temuan">
                                    <option value="">Please Select</option>
                                </select>
							</div>
						</div>
                        <div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Rekomendasi</label>
							<div class="col-sm-10">
								<div class="table-responsive" style="margin-left:-8px;">
									<table class="table table-borderless" id="dynamic_field">
										<tr>
											<td>
												<input type="text" name="rekomendasi[]" class="form-control name_list" placeholder="Isi Rekomendasi" required="" />
											</td>

											<td>
												<button type="button" name="add2" id="add2" class="btn btn-primary"><i class="fa fa-plus"></i></button>
											</td>
										</tr>
									</table>
								</div>
							</div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
								<button class="btn btn-theme" type="submit">Save</button>
                            </div>
                        </div>
					</form>
                    <?= form_close();?>
				</div>
			</div>
		</div>
	</section>
</section>
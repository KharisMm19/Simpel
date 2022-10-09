<section id="main-content">
	<section class="wrapper">
		<div class="row">
			<div class="col-lg-12"><br>
				<h2 style="color: black;">Data LHP</h2><br>
				<?php if($this->session->flashdata('pesan')): ?>
				<?php echo '<p class="alert alert-success">'.$this->session->flashdata('pesan').'</p>'; ?>
				<?php endif; ?>
				<?php if($this->session->flashdata('user_registered')): ?>
				<?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_registered').'</p>'; ?>
				<?php endif; ?><br>
				<div class="adv-table">
					<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped table-condensed"
						id="hidden-table-info">
						<thead>
							<tr>
								<th class="text-center">Laporan Hasil Pemeriksaan</th>
                                <th class="text-center">Tahun</th>
								<th class="text-center">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php 
                            $no = 1;
                            foreach($lhp as $u) : ?>
                            <tr>
                                <td class="text-center"><b><?= $u['no_lhp']?></b><br><?= $u['judul_lhp']?></td>
                                <td class="text-center"><?= $u['tahun']?></td>
                                <td class="text-center">
                                    <a href="<?= base_url('TimTindakLanjut/status/'.$u['id_lhp'])?>" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                </td>
                            </tr>
                        <?php endforeach;?>
						</tbody>
					</table><br>
                    <a class="btn btn-theme04" type="button"
									href="<?= base_url('TimTindakLanjut/dataSkpd/') ?>"><i
										class="fa fa-arrow-left "></i> Back</a>
				</div>
			</div>
		</div>
	</section>
</section>

<!--main content start-->
<section id="main-content">
	<div class="container-fluid">
		<section class="wrapper">
			<h2>Detail Data LHP</h2>
			<hr>
			<div class="row">
				<div class="col-lg-4">
					<h4><strong>No. LHP : </strong><?= $lhpdata[0]['no_lhp']?></h3>
						<h4><strong>Judul LHP : </strong><?= $lhpdata[0]['judul_lhp']?></h3>
							<h4><strong>Tahun LHP : </strong><?= $lhpdata[0]['tahun']?></h3><br>
                            <h2>Info Status</h2>
					<hr>
					<table class="table table-bordered table-striped table-condensed text-center">
						<thead>
							<tr>
								<th class="text-center">Sesuai</th>
								<th class="text-center">Belum Sesuai</th>
								<th class="text-center">Belum Ditindak-lanjuti</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="text-center"><?= $sesuai ?></td>
								<td class="text-center"><?= $belum_sesuai ?></td>
                                <td class="text-center"><?= $belum_ditindak_lanjuti ?></td>
							</tr>
						</tbody>
					</table><br>
								<a class="btn btn-theme04" type="button" href="<?= base_url('TimTindakLanjut/TindakLanjut/') ?>"><i
										class="fa fa-arrow-left "></i> Back</a>
				</div>
				<div class="col-lg-8">
					<h4>Temuan</h4>
					<table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered"
						id="hidden-table-info">
						<thead>
							<tr>
								<th class="text-center">Temuan</th>
								<th class="text-center">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($temuan as $i => $u) : ?>
							<tr>

								<td class="text-center"><?= $u['temuan']?></td>
								<td class="text-center">
									<a href="<?= base_url()."TimTindakLanjut/lihatRekomendasiTL/".$u['id_temuan']; ?>"
										class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
								</td>
							</tr>
							<?php endforeach;?>
						</tbody>
					</table>
				</div>
			</div>
		</section>
	</div>
</section>
<!--main content end-->

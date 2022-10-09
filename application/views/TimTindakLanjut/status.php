<!--main content start-->
<section id="main-content">
	<div class="container-fluid">
		<section class="wrapper">
			<h2>Detail LHP</h2>
			<hr>
			<div class="row">
				<div class="col-lg-4">
					<h4><strong>No. LHP : </strong><?= $lhpdata[0]['no_lhp']?></h3>
						<h4><strong>Judul LHP : </strong><?= $lhpdata[0]['judul_lhp']?></h3>
							<h4><strong>Tahun LHP : </strong><?= $lhpdata[0]['tahun']?></h3><br>
								<a class="btn btn-theme04" type="button"
									href="<?= base_url('TimTindakLanjut/listLHP/'.$lhpdata[0]['id_skpd']) ?>"><i
										class="fa fa-arrow-left "></i> Back</a>
				</div>
				<div class="col-lg-8">
					<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped table-condensed"
						id="hidden-table-info">
						<thead>
							<tr>
								<th class="text-center">Temuan</th>
								<th class="text-center">Rekomendasi</th>
								<th class="text-center">Sesuai</th>
								<th class="text-center">Belum Sesuai</th>
								<th class="text-center">Belum Ditindak-lanjuti</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="text-center"><?= $temuan ?></td>
								<td class="text-center"><?= $rekomendasi ?></td>
								<td class="text-center"><?= $sesuai ?></td>
								<td class="text-center"><?= $belum_sesuai ?></td>
								<td class="text-center"><?= $belum_ditindak_lanjuti ?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</section>
	</div>
</section>
<!--main content end-->

		<!--main content end-->
		<section id="main-content">
			<section class="wrapper">
				<div class="row">
					<div class="col-lg-12">
						<h2 style="color: black;">Dashboard</h2><br>
						<div class="border-head">
							<h3>Status Keseluruhan</h3>
						</div>
						<table class="table table-bordered table-striped table-condensed">
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
						</table>
					</div>
				</div>
			</section>
		</section>
		<!--main content end-->

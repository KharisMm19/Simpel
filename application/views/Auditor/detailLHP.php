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
                    <h4><strong>Tahun LHP : </strong><?= $lhpdata[0]['tahun']?></h3>
                    <h4><strong>SKPD : </strong><?= $lhpdata[0]['nama_skpd']?></h3><br>
                    <a class="btn btn-theme04" type="button" href="<?= base_url() ?>DataLHP"><i class="fa fa-arrow-left "></i> Back</a>
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
                                    <a href="<?= base_url()."DataLHP/editTemuan/".$u['id_temuan']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
                                    <a href="<?= base_url()."DataLHP/deleteTemuan/".$u['id_temuan']."/".$u['id_lhp']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash-o "></i></a>
                                    <a href="<?= base_url()."DataLHP/lihatRekomendasi/".$u['id_temuan']; ?>" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
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

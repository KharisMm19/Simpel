<!--main content start-->
<section id="main-content">
    <div class="container-fluid">
        <section class="wrapper">
            <h2>Detail Rekomendasi Temuan</h2>
            <hr>
            <div class="row">
                <div class="col-lg-4">
                    <h4><strong>No. LHP : </strong><?= $lhpdata[0]['no_lhp']?></h3>
                    <h4><strong>Judul LHP : </strong><?= $lhpdata[0]['judul_lhp']?></h3>
                    <h4><strong>Tahun : </strong><?= $lhpdata[0]['tahun']?></h3><br>
                    <a class="btn btn-theme04" type="button" href="<?= base_url('Skpd/detailTindakLanjut/'.$lhpdata[0]['id_lhp']) ?>"><i class="fa fa-arrow-left "></i> Back</a>
                </div>
                <div class="col-lg-8">
                    <h4><strong>Temuan : </strong><?= $lhpdata[0]['temuan']?></h3><hr>
                    <h4>Rekomendasi</h4>
                    <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered"
						id="hidden-table-info">
						<thead>
							<tr>
                                <th class="text-center">Rekomendasi</th>
                                <th class="text-center">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($rekomendasi as $i => $u) : ?>
                            <tr>
                                <td class="text-center"><?= $u['rekomendasi']?><br>
                                <?php 
                                    if ($u['status'] == 'Sesuai') { ?>
                                        <span class="badge bg-success"><?= $u['status']?></span> <?php
                                    }elseif ($u['status'] == 'Belum Sesuai') { ?>
                                        <span class="badge bg-important"><?= $u['status']?></span> <?php
                                    }else { ?>
                                        <span class="badge bg-warning"><?= $u['status']?></span> <?php
                                    }
                                ?>
                                </td>
                                <td class="text-center">
                                    <?php
									if($u['keterangan'] != NULL){
										?><a href="<?= base_url()."Skpd/detailTL/".$u['id_rekomendasi']; ?>" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a><?php
									}else { ?>
                                        <i class="fa fa-times"></i><?php
                                    }
								    ?>
                                    <?php
									if($u['status'] == "Belum Sesuai"){
										?><a href="<?= base_url()."Skpd/BelumSesuai/".$u['id_rekomendasi']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a><?php
									}
								    ?>
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

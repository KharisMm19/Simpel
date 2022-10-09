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
                    <a class="btn btn-theme04" type="button" href="<?= base_url('Skpd/lihatRekomendasiTL/'.$lhpdata[0]['id_temuan']) ?>"><i class="fa fa-arrow-left "></i> Back</a>
                </div>
                <div class="col-lg-8">
                    <h4><strong>Temuan : </strong><?= $lhpdata[0]['temuan']?></h4><hr>
                    <h4><strong>Rekomendasi : </strong><?= $lhpdata[0]['rekomendasi']?><?php 
                                    if ($lhpdata[0]['status'] == 'Sesuai') { ?>
                                        <span class="badge bg-success"><?= $lhpdata[0]['status']?></span> <?php
                                    }elseif ($lhpdata[0]['status'] == 'Belum Sesuai') { ?>
                                        <span class="badge bg-important"><?= $lhpdata[0]['status']?></span> <?php
                                    }else { ?>
                                        <span class="badge bg-warning"><?= $lhpdata[0]['status']?></span> <?php
                                    }
                                ?></h4><hr>
                    <h4><strong>Deskripsi Usulan Tindak Lanjut : </strong><?= $lhpdata[0]['keterangan']?></h4><hr>
                    <h4>File</h4>
                    <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered"
						id="hidden-table-info">
						<thead>
							<tr>
                                <th class="text-center">Nama File</th>
                                <th class="text-center">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($file as $i => $u) : ?>
                            <tr>
                                <td class="text-center"><?= $u['file_name']?></span></td>
                                <td class="text-center">
                                    <a href="<?= base_url()."TimTindakLanjut/download/".$u['id']; ?>" class="btn btn-success btn-sm"><i class="fa fa-download"></i></a>
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

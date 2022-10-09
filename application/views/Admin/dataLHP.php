<!--main content start-->
<section id="main-content">
	<section class="wrapper">
		<div class="row">
			<div class="col-lg-12"><br>
				<h2 style="color: black;">Data LHP</h2>
				<?php if($this->session->flashdata('pesan')): ?>
				<?php echo '<p class="alert alert-success">'.$this->session->flashdata('pesan').'</p>'; ?>
				<?php endif; ?>
				<?php if($this->session->flashdata('user_registered')): ?>
				<?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_registered').'</p>'; ?>
				<?php endif; ?><br>
				<a class="btn btn-primary mb-3 mt-3" href="<?= base_url(); ?>Admin/tambah">Input Temuan LHP</a></button><br><br>
				<div class="adv-table">
					<table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered"
						id="hidden-table-info">
						<thead>
							<tr>
								<th class="text-center">No. LHP</th>
                                <th class="text-center">Judul LHP</th>
                                <th class="text-center">Tahun</th>
								<th class="text-center">SKPD</th>
								<th class="text-center">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php 
                            $no = 1;
                            foreach($result as $u) : ?>
                            <tr>
                                <td class="text-center"><?= $u['no_lhp']?></td>
                                <td class="text-center"><?= $u['judul_lhp']?></td>
                                <td class="text-center"><?= $u['tahun']?></td>
                                <td class="text-center"><?= $u['nama_skpd']?></td>
                                <td class="text-center">
                                    <a href="<?= base_url()."Admin/edit/".$u['id_lhp']; ?>">
	                				<button class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></button>
                                    <a href="<?= base_url()."Admin/delete/".$u['id_lhp']; ?>">
										<button class="btn btn-danger btn-sm" onClick="return confirm('are you sure you want to delete?');"><i class="fa fa-trash-o "></i></button></a>
                                    <a href="<?= base_url('Admin/detail/'.$u['id_lhp'])?>" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                </td>
                            </tr>
                        <?php endforeach;?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</section>
</section>
<!--main content end-->

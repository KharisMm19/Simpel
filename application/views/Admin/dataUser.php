<!--main content start-->
<section id="main-content">
	<section class="wrapper">
		<div class="row">
            <div class="col-lg-12"><br>
            <h2 style="color: black;">Data User</h2><br>
            <?php if($this->session->flashdata('pesan')): ?>
            <?php echo '<p class="alert alert-success">'.$this->session->flashdata('pesan').'</p>'; ?>
            <?php endif; ?>
            <?php if($this->session->flashdata('user_registered')): ?>
            <?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_registered').'</p>'; ?>
            <?php endif; ?><br>
            <a class="btn btn-primary mb-3 mt-3" href="<?= base_url(); ?>DataUser/tambah">Tambah Data</a></button><br><br>
                <table class="table table-bordered table-striped table-condensed text-center">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Foto</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">SKPD</th>
                            <th class="text-center">Username</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Level</th>
                            <th class="text-center">Nomor Telepon</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $no = 1;
                            foreach($result as $u) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><img style="height: 100px; width:100px;" src="<?= base_url().'/uploads/fotoUser/'.$u['foto_user'] ?>" alt="Foto User"></td>
                                <td><?= $u['nama_user']?></td>
                                <td><?= $u['nama_skpd']?></td>
                                <td><?= $u['username']?></td>
                                <td><?= $u['email']?></td>
                                <td><?= $u['nama_jenis_user']?></td>
                                <td><?= $u['nomor_telepon']?></td>
                                <td>
                                    <a href="<?= base_url()."DataUser/edit/".$u['id_user']; ?>">
	                				<button class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></button>
                                    <?php
									if($this->session->userdata('id_jenis_user') == "1" && $u['id_user'] != "3" ){
										?><a href="<?= base_url()."DataUser/delete/".$u['id_user']; ?>">
										<button class="btn btn-danger btn-sm" onClick="return confirm('are you sure you want to delete?');"><i class="fa fa-trash-o "></i></button></a><?php
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
</section>
<!--main content end-->

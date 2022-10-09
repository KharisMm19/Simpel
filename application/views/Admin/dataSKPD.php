<!--main content start-->
<section id="main-content">
	<section class="wrapper">
		<div class="row">
            <div class="col-lg-12"><br>
            <h2 style="color: black;">Data SKPD</h2><br>
            <?php if($this->session->flashdata('pesan')): ?>
            <?php echo '<p class="alert alert-success">'.$this->session->flashdata('pesan').'</p>'; ?>
            <?php endif; ?>
            <?php if($this->session->flashdata('user_registered')): ?>
            <?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_registered').'</p>'; ?>
            <?php endif; ?><br>
            <a class="btn btn-primary mb-3 mt-3" href="<?= base_url(); ?>DataSkpd/tambah">Tambah Data</a></button><br><br>
                <table class="table table-bordered table-striped table-condensed text-center">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">SKPD</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $no = 1;
                            foreach($result as $u) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                
                                <td><?= $u['nama_skpd']?></td>
                                
                                <td>
                                    <a href="<?= base_url()."DataSkpd/edit/".$u['id_skpd']; ?>">
	                				<button class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></button></a>
                                    <a href="<?= base_url()."DataSkpd/delete/".$u['id_skpd']; ?>">
									<button class="btn btn-danger btn-sm" onClick="return confirm('are you sure you want to delete?');"><i class="fa fa-trash-o "></i></button></a>
                                    <a href="<?= base_url()."Admin/temuan/".$u['id_skpd']; ?>">
	                				<button class="btn btn-warning btn-sm">Temuan</button></a>
                                    <a href="<?= base_url()."Admin/DataTindakLanjut/".$u['id_skpd']; ?>">
	                				<button class="btn btn-success btn-sm">Tindak Lanjut</button></a>
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

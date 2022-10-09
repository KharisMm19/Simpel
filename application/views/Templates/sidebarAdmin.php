		<aside>
			<div id="sidebar" class="nav-collapse ">
				<ul class="sidebar-menu" id="nav-accordion">
						<p class="centered"><a href="profile.html"><img src="<?= base_url().'/uploads/fotoUser/'.$foto_user ?>" class="img-circle"
								width="80"></a></p>
						<h5 class="centered"><?= $nama_user ?></h5>
					<li class="mt">
						<a href="<?= base_url() ?>Admin">
							<i class="fa fa-dashboard"></i>
							<span>Dashboard</span>
						</a>
					</li>
					<li>
						<a href="<?= base_url() ?>DataUser">
							<i class="fa fa-users"></i>
							<span>Data User</span>
						</a>
					</li>
					<li>
						<a href="<?= base_url() ?>DataSkpd">
							<i class="fa fa-building"></i>
							<span>Data SKPD</span>
						</a>
					</li>
					<li>
						<a href="<?= base_url() ?>Admin/DataLHP">
							<i class="fa fa-book"></i>
							<span>Daftar Temuan LHP</span>
						</a>
					</li>
					<li>
						<a href="<?= base_url() ?>Admin/tambahRekomendasi">
							<i class="fa fa-plus"></i>
							<span>Input Rekomendasi LHP</span>
						</a>
					</li>
					<li>
						<a href="<?= base_url()."Admin/gantiPassword/".$id_user; ?>">
							<i class="fa fa-gear"></i>
							<span>Ganti Password</span>
						</a>
					</li>
		</aside>
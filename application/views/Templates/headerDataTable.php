<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="Dashboard">
	<meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
	<title><?= $title ?></title>

	<!-- Favicons -->
	<!-- <link href="<?= base_url() ?>assetsAdmin/img/favicon.png" rel="icon">
	<link href="<?= base_url() ?>assetsAdmin/img/apple-touch-icon.png" rel="apple-touch-icon"> -->

	<link href="<?= base_url() ?>assetsAdmin/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>assetsAdmin/lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assetsAdmin/css/zabuto_calendar.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assetsAdmin/lib/gritter/css/jquery.gritter.css" />
	<link href="<?= base_url() ?>assetsAdmin/lib/advanced-datatable/css/demo_page.css" rel="stylesheet" />
  	<link rel="stylesheet" href="<?= base_url() ?>assetsAdmin/lib/advanced-datatable/css/DT_bootstrap.css" />
	<link href="<?= base_url() ?>assetsAdmin/css/style.css" rel="stylesheet">
	<link href="<?= base_url() ?>assetsAdmin/css/style-responsive.css" rel="stylesheet">
	<script src="<?= base_url() ?>assetsAdmin/lib/chart-master/Chart.js"></script>
</head>

<body>
	<section id="container">
		<header class="header black-bg">
			<div class="sidebar-toggle-box">
				<div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
			</div>
			<a href="<?= base_url() ?>Admin" class="logo"><b>SIM<span>PLE</span></b></a>
			<div class="top-menu">
				<ul class="nav pull-right top-menu">
					<li><a class="logout" href="<?= base_url() ?>Login/logout">Logout</a></li>
				</ul>
			</div>
		</header>
		<!--header end-->

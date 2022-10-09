<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?= $title ?></title>
    <link href="<?= base_url() ?>assetsDashboard/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assetsDashboard/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assetsDashboard/css/pe-icons.css" rel="stylesheet">
    <link href="<?= base_url() ?>assetsDashboard/css/prettyPhoto.css" rel="stylesheet">
    <link href="<?= base_url() ?>assetsDashboard/css/animate.css" rel="stylesheet">
    <link href="<?= base_url() ?>assetsDashboard/css/style.css" rel="stylesheet">
    <script src="<?= base_url() ?>assetsDashboard/js/jquery.js"></script>
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon" sizes="144x144" href="images/ico/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/ico/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/ico/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" href="images/ico/apple-touch-icon-57x57.png">

    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            'use strict';
            jQuery('body').backstretch([
                "<?= base_url() ?>assetsDashboard/images/bg/tabalong1.jpg"
            ], {
                duration: 5000,
                fade: 500,
                centeredY: true
            });

            $("#mapwrapper").gMap({
                controls: false,
                scrollwheel: false,
                markers: [{
                    latitude: 40.7566,
                    longitude: -73.9863,
                    icon: {
                        image: "images/marker.png",
                        iconsize: [44, 44],
                        iconanchor: [12, 46],
                        infowindowanchor: [12, 0]
                    }
                }],
                icon: {
                    image: "images/marker.png",
                    iconsize: [26, 46],
                    iconanchor: [12, 46],
                    infowindowanchor: [12, 0]
                },
                latitude: 40.7566,
                longitude: -73.9863,
                zoom: 14
            });
        });
    </script>
</head>
<!--/head-->

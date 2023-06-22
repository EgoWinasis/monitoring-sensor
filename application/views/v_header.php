<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/font-awesome/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
    <title><?=$title ?></title>
    <style>
        section{
            min-height: 600px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container-fluid">

            <a class="navbar-brand" href="#">Microkontroller</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <?php $link = $this->uri->segment(2); ?>
                    <li class="nav-item">
                        <a class="nav-link <?= $link == ""? "active" : "" ?>" href="<?php echo base_url() ?>">Data Sensor Jarak</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $link == "showflame"? "active" : "" ?>" href="<?php echo base_url()?>data/showflame">Data Sensor Api</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $link == "kontrol"? "active" : "" ?>" href="<?php echo base_url()?>data/kontrol">Kontrol Relay</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


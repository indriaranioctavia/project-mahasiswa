<!-- BAGIAN HEADER -->
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url('asset/bootstrap.min.css'); ?>">

    <title><?php if(isset($title)){ echo $title; } ?> - Kampus</title>
</head>

<body>
    <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
        <!-- Navbar content -->
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link <?php if(isset($mhometampil)){ echo "disabled"; } ?>" href="<?php echo base_url('home'); ?>">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if(isset($mdosentampil)){ echo "disabled"; } ?>" href="<?php echo base_url('dosen'); ?>">Dosen</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if(isset($mmahasiswatampil)){ echo "disabled"; } ?>" href="<?php echo base_url('mahasiswa'); ?>">Mahasiswa</a>
            </li>
          
            <li class="nav-item">
                <a class="nav-link <?php if(isset($mgaleritampil)){ echo "disabled"; } ?>" href="<?php echo base_url('galeri'); ?>">Galeri</a>
            </li>
        </ul>
    </nav>
    <!-- BAGIAN HEADER -->
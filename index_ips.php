<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

if(!isset($_SESSION['idSiswa'])){
    header("Location:index.php");
}
//konfigurasi
require('config/database.php');
require('config/csrf-token.php');
require('config/fungsi.php');
require('config/gump.class.php');
//token
$csrf = new csrf();
$token_id = $csrf->get_token_id();
$token_value = $csrf->get_token($token_id);

$sql = $db->prepare("SELECT * FROM rp_sekolah");
$sql->execute();
$skl = $sql->fetch(PDO::FETCH_ASSOC);

$sql2 = $db->prepare("SELECT * FROM rp_ips WHERE ips_id = :idna");
$sql2->execute(array(':idna' => $_SESSION['idSiswa']));
$rpt = $sql2->fetch(PDO::FETCH_ASSOC);
$token = urlencode(encryptor('encrypt', $rpt['ips_id']));
?>
<!DOCTYPE html>
<html style="height: auto;">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistem Penilaian Tengah Semester Online</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="asset/plugins/font-awesome/css/font-awesome.min.css">    
    <link rel="stylesheet" href="asset/css/AdminLTE.min.css">
    <link rel="stylesheet" href="asset/css/skin-blue.min.css">    
    <!-- jQuery 2.2.3 -->
    <script src="asset/js/jquery.min.js"></script>
</head>

<body class="hold-transition skin-blue layout-top-nav">
    <div class="wrapper">
        <header class="main-header">
            <nav class="navbar navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                        <a href="index.php" class="navbar-brand"><b>ERAPORT</b></a>
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#navbar-collapse">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li><a href="index.php"><i class="fa fa-home"></i> Beranda</a></li>
                        </ul>
                    </div>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">

                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <div class="content-wrapper">
            <div class="container">
                <section class="content">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="box box-success">
                                <div class="box-body">
                                    <h3 class="text-center">LAPORAN</h3>
                                    <h3 class="text-center">HASIL PENILAIAN TENGAH SEMESTER GASAL</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="box box-info">
                                <div class="box-header with-border">
                                    <h4 class="box-title"><?= $rpt['ips_nama']?></h4>
                                    <div class="pull-right box-tools">
                                        <a href="logout.php" class="btn btn-warning"><i class="fa  fa-caret-square-o-left"></i> LOGOUT</a>
                                    </div>                                
                                </div>
                                <div class="box-body">
                                    <dl class="dl-horizontal">
                                        <dt>Nama Lengkap</dt>
                                        <dd>: <?= $rpt['ips_nama']?></dd>
                                        <dt>NIS/NISN</dt>
                                        <dd>: <?= $rpt['ips_nisn']?></dd>
                                        <dt>Kelas</dt>
                                        <dd>: <?= $rpt['ips_kelas']?></dd>
                                    </dl>
                                    <a target="_blank" href="../cetak/RaportIPS.php?tingal=<?=$token;?>" class="btn btn-success"><i class="fa fa-print"></i> Cetak Hasil PTS</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>    
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <a href="https://ucu.suryadi.my.id" target="_blank">nolbyte</a>
            </div>
            <strong>Copyright &copy; <?= date("Y");?> <a href="<?= $skl['skl_website'];?>"><?= $skl['skl_nama'];?></a>.</strong> All rights reserved.
        </footer>    
    </div>
    <script src="asset/js/bootstrap.min.js"></script>
    <script src="asset/js/adminlte.min.js"></script>
</body>

</html>
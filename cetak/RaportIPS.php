<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
define("RESMI", "OK");
if(!isset($_SESSION['idSiswa']) && !isset($_SESSION['admID'])){
        header("Location: ../index.php");
    }

/*if (!isset($_SESSION['admID'])) {
    header("Location: ../index.php");
}*/
//konfigurasi
require('../config/database.php');
require('../config/fungsi.php');
if (isset($_GET['tingal']) && !empty($_GET['tingal'])) {
    $cokot             = urldecode($_GET['tingal']);
    $buka              = encryptor('decrypt', $cokot);
    $sql = $db->prepare("SELECT * FROM rp_ips WHERE ips_id = :idna");
    $sql->execute(array(':idna' => $buka));
    $rpt = $sql->fetch(PDO::FETCH_ASSOC);    
    if ($rpt === false) {
?><script>
            swal("Galat", "Transaksi tidak dapat dilakukan", "error");
        </script><?php
                }
            }
            ob_start();
                    ?>
<style type="text/css">
    .head {
        font-weight: bold;
        font-size: 14pt;
        text-align: center;
        line-height: 1.5;
    }

    table.list {
        border: 1px solid #000;
        border-collapse: collapse;
        width: 80%;
        margin: auto;
    }

    table.list td {
        border: 1px solid #000;
        padding: 5px;
    }

    table.list th {
        border: 1px solid #000;
        /*background-color: #625F5F;*/        
        padding: 8px;
        text-align: center;
    }
    table.list .hd {
        background-color: #c0c0c0;
    }
    table.list .sub {
        text-align: center;
        font-weight: bold;
    }
    table.list .sub1 {
        text-align: center;        
    }
    table.foot {
        border: 0px;
        border-collapse: collapse;
        width: 100%;
        margin-top: 15px;
        padding-left: 15px;
        vertical-align: top;
    }
    table.footer{
        border: 1px solid #000;
        border-collapse: collapse;
        width: 80%;
        /*margin-top: 5px;*/
    }
    table.footer td {
        border: 1px solid #000;
        padding: 5px;
    }
    table.footer .grs{
        text-align: center;
    }
    table.ttd {
        border: 0px;
        border-collapse: collapse;
        width: 100%;
        margin-top: 15px;
        padding-left: 15px;
    }
    table.ttd td{
        text-align: center;
    }
</style>
<page style="font-size:10pt;font-family:times;">
    <?php
    $sql2 = $db->prepare("SELECT * FROM rp_sekolah");
    $sql2->execute();
    $skl = $sql2->fetch(PDO::FETCH_ASSOC);
    ?>
    <div class="head">
        LAPORAN<br>HASIL PENILAIAN TENGAH SEMESTER GASAL
    </div>
    <table style="width: 900px; border-collapse: separate;padding-left: 15px;padding-top: 20px;padding-bottom: 20px">
        <tr>
            <td width="150">Nama Sekolah</td>
            <td width="300">: <?= $skl['skl_nama']; ?></td>
            <td width="150">Kelas/Prog</td>
            <td width="250">: <?= $rpt['ips_kelas']; ?></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>: <?= $skl['skl_alamat']; ?></td>
            <td>Semester</td>
            <td>: <?= $rpt['ips_semester']; ?></td>
        </tr>
        <tr>
            <td>Nama Peserta Didik</td>
            <td>: <?= $rpt['ips_nama']; ?></td>
            <td>T.P.</td>
            <td>: <?= $skl['skl_thnP']; ?></td>
        </tr>
        <tr>
            <td>No Induk/NISN</td>
            <td>: <?= $rpt['ips_nisn']; ?></td>
        </tr>
    </table>
    <table class="list">
        <thead>
            <tr>
                <th colspan="2" rowspan="2" style="vertical-align: middle;">MATA PELAJARAN</th>
                <th rowspan="2">KKM</th>
                <th colspan="2">NILAI</th>
                <th colspan="2">REMEDIAL/<br>PENGAYAAN</th>
                <th rowspan="2">KETERANGAN</th>
            </tr>
            <tr>
                <td class="sub">ANGKA</td>
                <td class="sub">PREDIKAT</td>
                <td class="sub">ANGKA</td>
                <td class="sub">PREDIKAT</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="hd" colspan="8">Kelompok A (Wajib)</td>
            </tr>
            <tr>
                <td class="sub1" style="width: 8px;">1</td>
                <td>Pendidikan Agama dan Budi Pekerti</td>
                <td class="sub1"><?= $rpt['ips_kkm'];?></td>
                <td class="sub1"><?= $rpt['ips_agama'];?></td>
                <td class="sub1">
                    <?php
                        if($rpt['ips_agama'] >= 0 && $rpt['ips_agama'] <= 70){
                            echo 'D';
                        }elseif($rpt['ips_agama'] >= 70 && $rpt['ips_agama'] <= 80){
                            echo 'C';
                        }elseif($rpt['ips_agama'] >= 81 && $rpt['ips_agama'] <= 90){
                            echo 'B';
                        }elseif($rpt['ips_agama'] >= 91 && $rpt['ips_agama'] <= 100){
                            echo 'A';
                        }
                    ?>
                </td>
                <td class="sub1"><?= $rpt['ips_agamaR']?></td>
                <td class="sub1">
                <?php
                        if($rpt['ips_agamaR'] >= 1 && $rpt['ips_agamaR'] <= 70){
                            echo 'D';
                        }elseif($rpt['ips_agamaR'] >= 70 && $rpt['ips_agamaR'] <= 80){
                            echo 'C';
                        }elseif($rpt['ips_agamaR'] >= 81 && $rpt['ips_agamaR'] <= 90){
                            echo 'B';
                        }elseif($rpt['ips_agamaR'] >= 91 && $rpt['ips_agamaR'] <= 100){
                            echo 'A';
                        }else{
                            echo "-";
                        }
                    ?>
                </td>
                <td class="sub1">
                    <?php
                        if($rpt['ips_agama'] >= $rpt['ips_kkm']){
                            echo 'Tuntas';
                        }elseif($rpt['ips_agamaR'] >= $rpt['ips_kkm']){
                            echo "Tuntas";
                        }else{
                            echo 'Belum Tuntas';
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td class="sub1" style="width: 8px;">2</td>
                <td>Pendidikan Pancasila dan Kewarganegaraan</td>
                <td class="sub1"><?= $rpt['ips_kkm'];?></td>
                <td class="sub1"><?= $rpt['ips_pkn'];?></td>
                <td class="sub1">
                    <?php
                        if($rpt['ips_pkn'] >= 0 && $rpt['ips_pkn'] <= 70){
                            echo 'D';
                        }elseif($rpt['ips_pkn'] >= 70 && $rpt['ips_pkn'] <= 80){
                            echo 'C';
                        }elseif($rpt['ips_pkn'] >= 81 && $rpt['ips_pkn'] <= 90){
                            echo 'B';
                        }elseif($rpt['ips_pkn'] >= 91 && $rpt['ips_pkn'] <= 100){
                            echo 'A';
                        }
                    ?>
                </td>
                <td class="sub1"><?= $rpt['ips_pknR']?></td>
                <td class="sub1">
                    <?php
                        if($rpt['ips_pknR'] >= 1 && $rpt['ips_pknR'] <= 70){
                            echo 'D';
                        }elseif($rpt['ips_pknR'] >= 70 && $rpt['ips_pknR'] <= 80){
                            echo 'C';
                        }elseif($rpt['ips_pknR'] >= 81 && $rpt['ips_pknR'] <= 90){
                            echo 'B';
                        }elseif($rpt['ips_pknR'] >= 91 && $rpt['ips_pknR'] <= 100){
                            echo 'A';
                        }else{
                            echo "-";
                        }
                    ?>
                </td>
                <td class="sub1">
                    <?php
                        if($rpt['ips_pkn'] >= $rpt['ips_kkm']){
                            echo 'Tuntas';
                        }elseif($rpt['ips_pknR'] >= $rpt['ips_kkm']){
                            echo 'Tuntas';
                        }else{
                            echo 'Belum Tuntas';
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td class="sub1" style="width: 8px;">3</td>
                <td>Bahasa Indonesia</td>
                <td class="sub1"><?= $rpt['ips_kkm'];?></td>
                <td class="sub1"><?= $rpt['ips_bhsInd'];?></td>
                <td class="sub1">
                <?php
                        if($rpt['ips_bhsInd'] >= 0 && $rpt['ips_bhsInd'] <= 70){
                            echo 'D';
                        }elseif($rpt['ips_bhsInd'] >= 70 && $rpt['ips_bhsInd'] <= 80){
                            echo 'C';
                        }elseif($rpt['ips_bhsInd'] >= 81 && $rpt['ips_bhsInd'] <= 90){
                            echo 'B';
                        }elseif($rpt['ips_bhsInd'] >= 91 && $rpt['ips_bhsInd'] <= 100){
                            echo 'A';
                        }
                    ?>
                </td>
                <td class="sub1"><?= $rpt['ips_bhsIndR'] ?></td>
                <td class="sub1">
                    <?php
                        if($rpt['ips_bhsIndR'] >= 1 && $rpt['ips_bhsIndR'] <= 70){
                            echo 'D';
                        }elseif($rpt['ips_bhsIndR'] >= 70 && $rpt['ips_bhsIndR'] <= 80){
                            echo 'C';
                        }elseif($rpt['ips_bhsIndR'] >= 81 && $rpt['ips_bhsIndR'] <= 90){
                            echo 'B';
                        }elseif($rpt['ips_bhsIndR'] >= 91 && $rpt['ips_bhsIndR'] <= 100){
                            echo 'A';
                        }else{
                            echo "-";
                        }
                    ?>
                </td>
                <td class="sub1">
                    <?php
                        if($rpt['ips_bhsInd'] >= $rpt['ips_kkm']){
                            echo 'Tuntas';
                        }elseif($rpt['ips_bhsIndR'] >= $rpt['ips_kkm']){
                            echo "Tuntas";
                        }else{
                            echo 'Belum Tuntas';
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td class="sub1" style="width: 8px;">4</td>
                <td>Matematika</td>
                <td class="sub1"><?= $rpt['ips_kkm'];?></td>
                <td class="sub1"><?= $rpt['ips_mtk'];?></td>
                <td class="sub1">
                <?php
                        if($rpt['ips_mtk'] >= 0 && $rpt['ips_mtk'] <= 70){
                            echo 'D';
                        }elseif($rpt['ips_mtk'] >= 70 && $rpt['ips_mtk'] <= 80){
                            echo 'C';
                        }elseif($rpt['ips_mtk'] >= 81 && $rpt['ips_mtk'] <= 90){
                            echo 'B';
                        }elseif($rpt['ips_mtk'] >= 91 && $rpt['ips_mtk'] <= 100){
                            echo 'A';
                        }
                    ?>
                </td>
                <td class="sub1"><?= $rpt['ips_mtkR'] ?></td>
                <td class="sub1">
                    <?php
                        if($rpt['ips_mtkR'] >= 1 && $rpt['ips_mtkR'] <= 70){
                            echo 'D';
                        }elseif($rpt['ips_mtkR'] >= 70 && $rpt['ips_mtkR'] <= 80){
                            echo 'C';
                        }elseif($rpt['ips_mtkR'] >= 81 && $rpt['ips_mtkR'] <= 90){
                            echo 'B';
                        }elseif($rpt['ips_mtkR'] >= 91 && $rpt['ips_mtkR'] <= 100){
                            echo 'A';
                        }else{
                            echo '-';
                        }
                    ?>
                </td>
                <td class="sub1">
                <?php
                        if($rpt['ips_mtk'] >= $rpt['ips_kkm']){
                            echo 'Tuntas';
                        }elseif($rpt['ips_mtkR'] >= $rpt['ips_kkm']){
                            echo "Tuntas";
                        }else{
                            echo 'Belum Tuntas';
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td class="sub1" style="width: 8px;">6</td>
                <td>Bahasa Inggris</td>
                <td class="sub1"><?= $rpt['ips_kkm'];?></td>
                <td class="sub1"><?= $rpt['ips_bhsIng'];?></td>
                <td class="sub1">
                    <?php
                        if($rpt['ips_bhsIng'] >= 0 && $rpt['ips_bhsIng'] <= 70){
                            echo 'D';
                        }elseif($rpt['ips_bhsIng'] >= 70 && $rpt['ips_bhsIng'] <= 80){
                            echo 'C';
                        }elseif($rpt['ips_bhsIng'] >= 81 && $rpt['ips_bhsIng'] <= 90){
                            echo 'B';
                        }elseif($rpt['ips_bhsIng'] >= 91 && $rpt['ips_bhsIng'] <= 100){
                            echo 'A';
                        }
                    ?>
                </td>
                <td class="sub1"><?= $rpt['ips_bhsIngR']?></td>
                <td class="sub1">
                    <?php
                        if($rpt['ips_bhsIngR'] >= 1 && $rpt['ips_bhsIngR'] <= 70){
                            echo 'D';
                        }elseif($rpt['ips_bhsIngR'] >= 70 && $rpt['ips_bhsIngR'] <= 80){
                            echo 'C';
                        }elseif($rpt['ips_bhsIngR'] >= 81 && $rpt['ips_bhsIngR'] <= 90){
                            echo 'B';
                        }elseif($rpt['ips_bhsIngR'] >= 91 && $rpt['ips_bhsIngR'] <= 100){
                            echo 'A';
                        }else{
                            echo "-";
                        }
                    ?>
                </td>
                <td class="sub1">
                <?php
                        if($rpt['ips_bhsIng'] >= $rpt['ips_kkm']){
                            echo 'Tuntas';
                        }elseif($rpt['ips_bhsIngR'] >= $rpt['ips_kkm']){
                            echo 'Tuntas';
                        }else{
                            echo 'Belum Tuntas';
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td class="sub1" style="width: 8px;">6</td>
                <td>Sejarah Indonesia</td>
                <td class="sub1"><?= $rpt['ips_kkm'];?></td>
                <td class="sub1"><?= $rpt['ips_sejarahInd'];?></td>
                <td class="sub1">
                    <?php
                        if($rpt['ips_sejarahInd'] >= 0 && $rpt['ips_sejarahInd'] <= 70){
                            echo 'D';
                        }elseif($rpt['ips_sejarahInd'] >= 70 && $rpt['ips_sejarahInd'] <= 80){
                            echo 'C';
                        }elseif($rpt['ips_sejarahInd'] >= 81 && $rpt['ips_sejarahInd'] <= 90){
                            echo 'B';
                        }elseif($rpt['ips_sejarahInd'] >= 91 && $rpt['ips_sejarahInd'] <= 100){
                            echo 'A';
                        }
                    ?>
                </td>
                <td class="sub1"><?= $rpt['ips_sejarahIndR'] ?></td>
                <td class="sub1">
                    <?php
                        if($rpt['ips_sejarahIndR'] >= 1 && $rpt['ips_sejarahIndR'] <= 70){
                            echo 'D';
                        }elseif($rpt['ips_sejarahIndR'] >= 70 && $rpt['ips_sejarahIndR'] <= 80){
                            echo 'C';
                        }elseif($rpt['ips_sejarahIndR'] >= 81 && $rpt['ips_sejarahIndR'] <= 90){
                            echo 'B';
                        }elseif($rpt['ips_sejarahIndR'] >= 91 && $rpt['ips_sejarahIndR'] <= 100){
                            echo 'A';
                        }else{
                            echo "-";
                        }
                    ?>
                </td>
                <td class="sub1">
                <?php
                        if($rpt['ips_sejarahInd'] >= $rpt['ips_kkm']){
                            echo 'Tuntas';
                        }elseif($rpt['ips_sejarahIndR'] >= $rpt['ips_kkm']){
                            echo 'Tuntas';
                        }else{
                            echo 'Belum Tuntas';
                        }
                    ?>
                </td>
            </tr>            
            <tr>
                <td class="hd" colspan="8">Kelompok B (Wajib)</td>
            </tr>
            <tr>
                <td class="sub1" style="width: 8px;">1</td>
                <td>Seni Budaya</td>
                <td class="sub1"><?= $rpt['ips_kkm'];?></td>
                <td class="sub1"><?= $rpt['ips_senbud'];?></td>
                <td class="sub1">
                    <?php
                        if($rpt['ips_senbud'] >= 0 && $rpt['ips_senbud'] <= 70){
                            echo 'D';
                        }elseif($rpt['ips_senbud'] >= 70 && $rpt['ips_senbud'] <= 80){
                            echo 'C';
                        }elseif($rpt['ips_senbud'] >= 81 && $rpt['ips_senbud'] <= 90){
                            echo 'B';
                        }elseif($rpt['ips_senbud'] >= 91 && $rpt['ips_senbud'] <= 100){
                            echo 'A';
                        }
                    ?>
                </td>
                <td class="sub1"><?= $rpt['ips_senbudR']?></td>
                <td class="sub1">
                    <?php
                        if($rpt['ips_senbudR'] >= 1 && $rpt['ips_senbudR'] <= 70){
                            echo 'D';
                        }elseif($rpt['ips_senbudR'] >= 70 && $rpt['ips_senbudR'] <= 80){
                            echo 'C';
                        }elseif($rpt['ips_senbudR'] >= 81 && $rpt['ips_senbudR'] <= 90){
                            echo 'B';
                        }elseif($rpt['ips_senbudR'] >= 91 && $rpt['ips_senbudR'] <= 100){
                            echo 'A';
                        }else{
                            echo "-";
                        }
                    ?>
                </td>
                <td class="sub1">
                <?php
                        if($rpt['ips_senbud'] >= $rpt['ips_kkm']){
                            echo 'Tuntas';
                        }elseif($rpt['ips_senbudR'] >= $rpt['ips_kkm']){
                            echo 'Tuntas';
                        }else{
                            echo 'Belum Tuntas';
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td class="sub1" style="width: 8px;">2</td>
                <td>Pendidikan Jasmani, Olah Raga dan Kesehatan</td>
                <td class="sub1"><?= $rpt['ips_kkm'];?></td>
                <td class="sub1"><?= $rpt['ips_penjas'];?></td>
                <td class="sub1">
                    <?php
                        if($rpt['ips_penjas'] >= 0 && $rpt['ips_penjas'] <= 70){
                            echo 'D';
                        }elseif($rpt['ips_penjas'] >= 70 && $rpt['ips_penjas'] <= 80){
                            echo 'C';
                        }elseif($rpt['ips_penjas'] >= 81 && $rpt['ips_penjas'] <= 90){
                            echo 'B';
                        }elseif($rpt['ips_penjas'] >= 91 && $rpt['ips_penjas'] <= 100){
                            echo 'A';
                        }
                    ?>
                </td>
                <td class="sub1"><?= $rpt['ips_penjasR']?></td>
                <td class="sub1">
                <?php
                        if($rpt['ips_penjasR'] >= 1 && $rpt['ips_penjasR'] <= 70){
                            echo 'D';
                        }elseif($rpt['ips_penjasR'] >= 70 && $rpt['ips_penjasR'] <= 80){
                            echo 'C';
                        }elseif($rpt['ips_penjasR'] >= 81 && $rpt['ips_penjasR'] <= 90){
                            echo 'B';
                        }elseif($rpt['ips_penjasR'] >= 91 && $rpt['ips_penjasR'] <= 100){
                            echo 'A';
                        }else{
                            echo "-";
                        }
                    ?>
                </td>
                <td class="sub1">
                <?php
                        if($rpt['ips_penjas'] >= $rpt['ips_kkm']){
                            echo 'Tuntas';
                        }elseif($rpt['ips_penjasR'] >= $rpt['ips_kkm']){
                            echo 'Tuntas';
                        }else{
                            echo 'Belum Tuntas';
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td class="sub1" style="width: 8px;">3</td>
                <td>Prakarya dan Kewirausahaan</td>
                <td class="sub1"><?= $rpt['ips_kkm'];?></td>
                <td class="sub1"><?= $rpt['ips_prakarya'];?></td>
                <td class="sub1">
                    <?php
                        if($rpt['ips_prakarya'] >= 0 && $rpt['ips_prakarya'] <= 70){
                            echo 'D';
                        }elseif($rpt['ips_prakarya'] >= 70 && $rpt['ips_prakarya'] <= 80){
                            echo 'C';
                        }elseif($rpt['ips_prakarya'] >= 81 && $rpt['ips_prakarya'] <= 90){
                            echo 'B';
                        }elseif($rpt['ips_prakarya'] >= 91 && $rpt['ips_prakarya'] <= 100){
                            echo 'A';
                        }
                    ?>
                </td>
                <td class="sub1"><?= $rpt['ips_prakaryaR']?></td>
                <td class="sub1">
                    <?php
                        if($rpt['ips_prakaryaR'] >= 1 && $rpt['ips_prakaryaR'] <= 70){
                            echo 'D';
                        }elseif($rpt['ips_prakaryaR'] >= 70 && $rpt['ips_prakaryaR'] <= 80){
                            echo 'C';
                        }elseif($rpt['ips_prakaryaR'] >= 81 && $rpt['ips_prakaryaR'] <= 90){
                            echo 'B';
                        }elseif($rpt['ips_prakaryaR'] >= 91 && $rpt['ips_prakaryaR'] <= 100){
                            echo 'A';
                        }else{
                            echo "-";
                        }
                    ?>
                </td>
                <td class="sub1">
                <?php
                        if($rpt['ips_prakarya'] >= $rpt['ips_kkm']){
                            echo 'Tuntas';
                        }elseif($rpt['ips_prakaryaR'] >= $rpt['ips_kkm']){
                            echo 'Tuntas';
                        }else{
                            echo 'Belum Tuntas';
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td class="hd" colspan="8">Kelompok C (Peminatan)</td>
            </tr>
            <tr>
                <td colspan="8" style="padding-left: 35px;">I. Peminatan</td>
            </tr>
            <tr>
                <td class="sub1" style="width: 8px;">1</td>
                <td>Geografi</td>
                <td class="sub1"><?= $rpt['ips_kkm'];?></td>
                <td class="sub1"><?= $rpt['ips_geografi'];?></td>
                <td class="sub1">
                    <?php
                        if($rpt['ips_geografi'] >= 0 && $rpt['ips_geografi'] <= 70){
                            echo 'D';
                        }elseif($rpt['ips_geografi'] >= 70 && $rpt['ips_geografi'] <= 80){
                            echo 'C';
                        }elseif($rpt['ips_geografi'] >= 81 && $rpt['ips_geografi'] <= 90){
                            echo 'B';
                        }elseif($rpt['ips_geografi'] >= 91 && $rpt['ips_geografi'] <= 100){
                            echo 'A';
                        }
                    ?>
                </td>
                <td class="sub1"><?= $rpt['ips_geografiR']?></td>
                <td class="sub1">
                    <?php
                        if($rpt['ips_geografiR'] >= 1 && $rpt['ips_geografiR'] <= 70){
                            echo 'D';
                        }elseif($rpt['ips_geografiR'] >= 70 && $rpt['ips_geografiR'] <= 80){
                            echo 'C';
                        }elseif($rpt['ips_geografiR'] >= 81 && $rpt['ips_geografiR'] <= 90){
                            echo 'B';
                        }elseif($rpt['ips_geografiR'] >= 91 && $rpt['ips_geografiR'] <= 100){
                            echo 'A';
                        }else{
                            echo "-";
                        }
                    ?>
                </td>
                <td class="sub1">
                <?php
                        if($rpt['ips_geografi'] >= $rpt['ips_kkm']){
                            echo 'Tuntas';
                        }elseif($rpt['ips_geografiR'] >= $rpt['ips_kkm']){
                            echo 'Tuntas';
                        }else{
                            echo 'Belum Tuntas';
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td class="sub1" style="width: 8px;">2</td>
                <td>Sejarah</td>
                <td class="sub1"><?= $rpt['ips_kkm'];?></td>
                <td class="sub1"><?= $rpt['ips_sejarah'];?></td>
                <td class="sub1">
                    <?php
                        if($rpt['ips_sejarah'] >= 0 && $rpt['ips_sejarah'] <= 70){
                            echo 'D';
                        }elseif($rpt['ips_sejarah'] >= 70 && $rpt['ips_sejarah'] <= 80){
                            echo 'C';
                        }elseif($rpt['ips_sejarah'] >= 81 && $rpt['ips_sejarah'] <= 90){
                            echo 'B';
                        }elseif($rpt['ips_sejarah'] >= 91 && $rpt['ips_sejarah'] <= 100){
                            echo 'A';
                        }
                    ?>
                </td>
                <td class="sub1"><?= $rpt['ips_sejarahR']?></td>
                <td class="sub1">
                    <?php
                        if($rpt['ips_sejarahR'] >= 1 && $rpt['ips_sejarahR'] <= 70){
                            echo 'D';
                        }elseif($rpt['ips_sejarahR'] >= 70 && $rpt['ips_sejarahR'] <= 80){
                            echo 'C';
                        }elseif($rpt['ips_sejarahR'] >= 81 && $rpt['ips_sejarahR'] <= 90){
                            echo 'B';
                        }elseif($rpt['ips_sejarahR'] >= 91 && $rpt['ips_sejarahR'] <= 100){
                            echo 'A';
                        }else{
                            echo "-";
                        }
                    ?>
                </td>
                <td class="sub1">
                <?php
                        if($rpt['ips_sejarah'] >= $rpt['ips_kkm']){
                            echo 'Tuntas';
                        }elseif($rpt['ips_sejarahR'] >= $rpt['ips_kkm']){
                            echo 'Tuntas';
                        }else{
                            echo 'Belum Tuntas';
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td class="sub1" style="width: 8px;">3</td>
                <td>Sosiologi</td>
                <td class="sub1"><?= $rpt['ips_kkm'];?></td>
                <td class="sub1"><?= $rpt['ips_sosiologi'];?></td>
                <td class="sub1">
                    <?php
                        if($rpt['ips_sosiologi'] >= 0 && $rpt['ips_sosiologi'] <= 70){
                            echo 'D';
                        }elseif($rpt['ips_sosiologi'] >= 70 && $rpt['ips_sosiologi'] <= 80){
                            echo 'C';
                        }elseif($rpt['ips_sosiologi'] >= 81 && $rpt['ips_sosiologi'] <= 90){
                            echo 'B';
                        }elseif($rpt['ips_sosiologi'] >= 91 && $rpt['ips_sosiologi'] <= 100){
                            echo 'A';
                        }
                    ?>
                </td>
                <td class="sub1"><?= $rpt['ips_sosiologiR']?></td>
                <td class="sub1">
                    <?php
                        if($rpt['ips_sosiologiR'] >= 1 && $rpt['ips_sosiologiR'] <= 70){
                            echo 'D';
                        }elseif($rpt['ips_sosiologiR'] >= 70 && $rpt['ips_sosiologiR'] <= 80){
                            echo 'C';
                        }elseif($rpt['ips_sosiologiR'] >= 81 && $rpt['ips_sosiologiR'] <= 90){
                            echo 'B';
                        }elseif($rpt['ips_sosiologiR'] >= 91 && $rpt['ips_sosiologiR'] <= 100){
                            echo 'A';
                        }else{
                            echo "-";
                        }
                    ?>
                </td>
                <td class="sub1">
                <?php
                        if($rpt['ips_sosiologi'] >= $rpt['ips_kkm']){
                            echo 'Tuntas';
                        }elseif($rpt['ips_sosiologiR'] >= $rpt['ips_kkm']){
                            echo 'Tuntas';
                        }else{
                            echo 'Belum Tuntas';
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td class="sub1" style="width: 8px;">4</td>
                <td>Ekonomi</td>
                <td class="sub1"><?= $rpt['ips_kkm'];?></td>
                <td class="sub1"><?= $rpt['ips_ekonomi'];?></td>
                <td class="sub1">
                    <?php
                        if($rpt['ips_ekonomi'] >= 0 && $rpt['ips_ekonomi'] <= 70){
                            echo 'D';
                        }elseif($rpt['ips_ekonomi'] >= 70 && $rpt['ips_ekonomi'] <= 80){
                            echo 'C';
                        }elseif($rpt['ips_ekonomi'] >= 81 && $rpt['ips_ekonomi'] <= 90){
                            echo 'B';
                        }elseif($rpt['ips_ekonomi'] >= 91 && $rpt['ips_ekonomi'] <= 100){
                            echo 'A';
                        }
                    ?>
                </td>
                <td class="sub1"><?= $rpt['ips_ekonomiR']?></td>
                <td class="sub1">
                    <?php
                        if($rpt['ips_ekonomiR'] >= 1 && $rpt['ips_ekonomiR'] <= 70){
                            echo 'D';
                        }elseif($rpt['ips_ekonomiR'] >= 70 && $rpt['ips_ekonomiR'] <= 80){
                            echo 'C';
                        }elseif($rpt['ips_ekonomiR'] >= 81 && $rpt['ips_ekonomiR'] <= 90){
                            echo 'B';
                        }elseif($rpt['ips_ekonomiR'] >= 91 && $rpt['ips_ekonomiR'] <= 100){
                            echo 'A';
                        }else{
                            echo "-";
                        }
                    ?>
                </td>
                <td class="sub1">
                <?php
                        if($rpt['ips_ekonomi'] >= $rpt['ips_kkm']){
                            echo 'Tuntas';
                        }elseif($rpt['ips_ekonomiR'] >= $rpt['ips_kkm']){
                            echo 'Tuntas';
                        }else{
                            echo 'Belum Tuntas';
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="8" style="padding-left: 35px;">II. Lintas Minat</td>
            </tr>
            <?php
                $kelas = stripos($rpt['ips_kelas'], "XII/");
                $kelas2 = stripos($rpt['ips_kelas'], "XI/");
                if($kelas !== FALSE){
            ?>
            <tr>
                <td class="sub1" style="width: 8px;">1</td>
                <td>Bahasa Arab</td>
                <td class="sub1"><?= $rpt['ips_kkm'];?></td>
                <td class="sub1"><?= $rpt['ips_bhsAr'];?></td>
                <td class="sub1">
                    <?php
                        if($rpt['ips_bhsAr'] >= 0 && $rpt['ips_bhsAr'] <= 70){
                            echo 'D';
                        }elseif($rpt['ips_bhsAr'] >= 70 && $rpt['ips_bhsAr'] <= 80){
                            echo 'C';
                        }elseif($rpt['ips_bhsAr'] >= 81 && $rpt['ips_bhsAr'] <= 90){
                            echo 'B';
                        }elseif($rpt['ips_bhsAr'] >= 91 && $rpt['ips_bhsAr'] <= 100){
                            echo 'A';
                        }
                    ?>
                </td>
                <td class="sub1"><?= $rpt['ips_bhsArR']?></td>
                <td class="sub1">
                    <?php
                        if($rpt['ips_bhsArR'] >= 1 && $rpt['ips_bhsArR'] <= 70){
                            echo 'D';
                        }elseif($rpt['ips_bhsArR'] >= 70 && $rpt['ips_bhsArR'] <= 80){
                            echo 'C';
                        }elseif($rpt['ips_bhsArR'] >= 81 && $rpt['ips_bhsArR'] <= 90){
                            echo 'B';
                        }elseif($rpt['ips_bhsArR'] >= 91 && $rpt['ips_bhsArR'] <= 100){
                            echo 'A';
                        }else{
                            echo "-";
                        }
                    ?>
                </td>
                <td class="sub1">
                <?php
                        if($rpt['ips_bhsAr'] >= $rpt['ips_kkm']){
                            echo 'Tuntas';
                        }elseif($rpt['ips_bhsArR'] >= $rpt['ips_kkm']){
                            echo 'Tuntas';
                        }else{
                            echo 'Belum Tuntas';
                        }
                    ?>
                </td>
            </tr>
                    <?php }elseif($kelas2 !== FALSE){ ?>
                    <tr>
                        <td class="sub1" style="width: 8px;">1</td>
                        <td>Biologi</td>
                        <td class="sub1"><?= $rpt['ips_kkm'];?></td>
                        <td class="sub1"><?= $rpt['ips_biologi'];?></td>
                        <td class="sub1">
                            <?php
                                if($rpt['ips_biologi'] >= 0 && $rpt['ips_biologi'] <= 70){
                                    echo 'D';
                                }elseif($rpt['ips_biologi'] >= 70 && $rpt['ips_biologi'] <= 80){
                                    echo 'C';
                                }elseif($rpt['ips_biologi'] >= 81 && $rpt['ips_biologi'] <= 90){
                                    echo 'B';
                                }elseif($rpt['ips_biologi'] >= 91 && $rpt['ips_biologi'] <= 100){
                                    echo 'A';
                                }
                            ?>
                        </td>
                        <td class="sub1"><?= $rpt['ips_biologiR']?></td>
                        <td class="sub1">
                            <?php
                                if($rpt['ips_biologiR'] >= 1 && $rpt['ips_biologiR'] <= 70){
                                    echo 'D';
                                }elseif($rpt['ips_biologiR'] >= 70 && $rpt['ips_biologiR'] <= 80){
                                    echo 'C';
                                }elseif($rpt['ips_biologiR'] >= 81 && $rpt['ips_biologiR'] <= 90){
                                    echo 'B';
                                }elseif($rpt['ips_biologiR'] >= 91 && $rpt['ips_biologiR'] <= 100){
                                    echo 'A';
                                }else{
                                    echo "-";
                                }
                            ?>
                        </td>
                        <td class="sub1">
                        <?php
                                if($rpt['ips_biologi'] >= $rpt['ips_kkm']){
                                    echo 'Tuntas';
                                }elseif($rpt['ips_biologiR'] >= $rpt['ips_kkm']){
                                    echo 'Tuntas';
                                }else{
                                    echo 'Belum Tuntas';
                                }
                            ?>
                        </td>
                    </tr>
                    <?php }else{ ?>
            <tr>
                <td class="sub1" style="width: 8px;">1</td>
                <td>Biologi</td>
                <td class="sub1"><?= $rpt['ips_kkm'];?></td>
                <td class="sub1"><?= $rpt['ips_biologi'];?></td>
                <td class="sub1">
                    <?php
                        if($rpt['ips_biologi'] >= 0 && $rpt['ips_biologi'] <= 70){
                            echo 'D';
                        }elseif($rpt['ips_biologi'] >= 70 && $rpt['ips_biologi'] <= 80){
                            echo 'C';
                        }elseif($rpt['ips_biologi'] >= 81 && $rpt['ips_biologi'] <= 90){
                            echo 'B';
                        }elseif($rpt['ips_biologi'] >= 91 && $rpt['ips_biologi'] <= 100){
                            echo 'A';
                        }
                    ?>
                </td>
                <td class="sub1"><?= $rpt['ips_biologiR']?></td>
                <td class="sub1">
                    <?php
                        if($rpt['ips_biologiR'] >= 1 && $rpt['ips_biologiR'] <= 70){
                            echo 'D';
                        }elseif($rpt['ips_biologiR'] >= 70 && $rpt['ips_biologiR'] <= 80){
                            echo 'C';
                        }elseif($rpt['ips_biologiR'] >= 81 && $rpt['ips_biologiR'] <= 90){
                            echo 'B';
                        }elseif($rpt['ips_biologiR'] >= 91 && $rpt['ips_biologiR'] <= 100){
                            echo 'A';
                        }else{
                            echo "-";
                        }
                    ?>
                </td>
                <td class="sub1">
                <?php
                        if($rpt['ips_biologi'] >= $rpt['ips_kkm']){
                            echo 'Tuntas';
                        }elseif($rpt['ips_biologiR'] >= $rpt['ips_kkm']){
                            echo 'Tuntas';
                        }else{
                            echo 'Belum Tuntas';
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td class="sub1" style="width: 8px;">2</td>
                <td>Kimia</td>
                <td class="sub1"><?= $rpt['ips_kkm'];?></td>
                <td class="sub1"><?= $rpt['ips_kimia'];?></td>
                <td class="sub1">
                    <?php
                        if($rpt['ips_kimia'] >= 0 && $rpt['ips_kimia'] <= 70){
                            echo 'D';
                        }elseif($rpt['ips_kimia'] >= 70 && $rpt['ips_kimia'] <= 80){
                            echo 'C';
                        }elseif($rpt['ips_kimia'] >= 81 && $rpt['ips_kimia'] <= 90){
                            echo 'B';
                        }elseif($rpt['ips_kimia'] >= 91 && $rpt['ips_kimia'] <= 100){
                            echo 'A';
                        }
                    ?>
                </td>
                <td class="sub1"><?= $rpt['ips_kimiaR']?></td>
                <td class="sub1">
                    <?php
                        if($rpt['ips_kimiaR'] >= 1 && $rpt['ips_kimiaR'] <= 70){
                            echo 'D';
                        }elseif($rpt['ips_kimiaR'] >= 70 && $rpt['ips_kimiaR'] <= 80){
                            echo 'C';
                        }elseif($rpt['ips_kimiaR'] >= 81 && $rpt['ips_kimiaR'] <= 90){
                            echo 'B';
                        }elseif($rpt['ips_kimiaR'] >= 91 && $rpt['ips_kimiaR'] <= 100){
                            echo 'A';
                        }else{
                            echo "-";
                        }
                    ?>
                </td>
                <td class="sub1">
                <?php
                        if($rpt['ips_kimia'] >= $rpt['ips_kkm']){
                            echo 'Tuntas';
                        }elseif($rpt['ips_kimiaR'] >= $rpt['ips_kkm']){
                            echo 'Tuntas';
                        }else{
                            echo 'Belum Tuntas';
                        }
                    ?>
                </td>
            </tr>
                    <?php } ?>
        </tbody>
    </table>
    <table class="foot">
        <tr>
            <td style="width: 50%;">
                <table class="footer">
                    <tr>
                        <td class="grs" style="width: 8px;">1</td>
                        <td style="width: 150px;">Rerata</td>
                        <td style="width: 120px;text-align:center"><?= number_format($rpt['ips_rerata'])?></td>
                    </tr>
                    <tr>
                        <td class="grs" style="width: 8px;">2</td>
                        <td style="width: 150px;">Peringkat</td>
                        <td style="width: 120px;text-align:center">
                            <?php
                                $kls1 = 'X/ IIS - 1'; $kls2 = 'X/ IIS - 2'; $kls3 = 'X/ IIS - 3'; $kls4 = 'XII/ IPS - 1'; $kls5 = 'XII/IPS - 2'; $kls6 = 'XII/ IIS - 3'; $kls7 = 'XII/ IIS - 4'; $kls8 = 'XI/ IIS - 1'; $kls9 = 'XI/ IIS - 2'; $kls10 = 'XI/ IIS - 3';
                                if($kls1 === $rpt['ips_kelas']){
                                    $sql = $db->prepare("SELECT COUNT(*) FROM rp_ips WHERE ips_kelas = ?");
                                    $sql->execute(array($kls1));
                                    $ttl = $sql->fetchColumn();
                                    echo $rpt['ips_rank'].'/'.$ttl;
                                }elseif($kls2 === $rpt['ips_kelas']){
                                    $sql = $db->prepare("SELECT COUNT(*) FROM rp_ips WHERE ips_kelas = ?");
                                    $sql->execute(array($kls2));
                                    $ttl = $sql->fetchColumn();
                                    echo $rpt['ips_rank'].'/'.$ttl;
                                }elseif($kls3 === $rpt['ips_kelas']){
                                    $sql = $db->prepare("SELECT COUNT(*) FROM rp_ips WHERE ips_kelas = ?");
                                    $sql->execute(array($kls3));
                                    $ttl = $sql->fetchColumn();
                                    echo $rpt['ips_rank'].'/'.$ttl;
                                }elseif($kls4 === $rpt['ips_kelas']){
                                    $sql = $db->prepare("SELECT COUNT(*) FROM rp_ips WHERE ips_kelas = ?");
                                    $sql->execute(array($kls4));
                                    $ttl = $sql->fetchColumn();
                                    echo $rpt['ips_rank'].'/'.$ttl;
                                }elseif($kls5 === $rpt['ips_kelas']){
                                    $sql = $db->prepare("SELECT COUNT(*) FROM rp_ips WHERE ips_kelas = ?");
                                    $sql->execute(array($kls5));
                                    $ttl = $sql->fetchColumn();
                                    echo $rpt['ips_rank'].'/'.$ttl;
                                }elseif($kls6 === $rpt['ips_kelas']){
                                    $sql = $db->prepare("SELECT COUNT(*) FROM rp_ips WHERE ips_kelas = ?");
                                    $sql->execute(array($kls6));
                                    $ttl = $sql->fetchColumn();
                                    echo $rpt['ips_rank'].'/'.$ttl;
                                }elseif($kls7 === $rpt['ips_kelas']){
                                    $sql = $db->prepare("SELECT COUNT(*) FROM rp_ips WHERE ips_kelas = ?");
                                    $sql->execute(array($kls7));
                                    $ttl = $sql->fetchColumn();
                                    echo $rpt['ips_rank'].'/'.$ttl;
                                }elseif($kls8 === $rpt['ips_kelas']){
                                    $sql = $db->prepare("SELECT COUNT(*) FROM rp_ips WHERE ips_kelas = ?");
                                    $sql->execute(array($kls8));
                                    $ttl = $sql->fetchColumn();
                                    echo $rpt['ips_rank'].'/'.$ttl;
                                }elseif($kls9 === $rpt['ips_kelas']){
                                    $sql = $db->prepare("SELECT COUNT(*) FROM rp_ips WHERE ips_kelas = ?");
                                    $sql->execute(array($kls9));
                                    $ttl = $sql->fetchColumn();
                                    echo $rpt['ips_rank'].'/'.$ttl;
                                }elseif($kls10 === $rpt['ips_kelas']){
                                    $sql = $db->prepare("SELECT COUNT(*) FROM rp_ips WHERE ips_kelas = ?");
                                    $sql->execute(array($kls10));
                                    $ttl = $sql->fetchColumn();
                                    echo $rpt['ips_rank'].'/'.$ttl;
                                }
                            ?>                         
                        </td>
                    </tr>
                </table>
            </td>
            <td rowspan="2" style="width: 50%;">
                <img src="../asset/img/predikat.png" style="height: 135px;">
            </td>
        </tr>
        <tr>
            <td>
            <table class="footer">
                <tr>
                    <td colspan="3" style="background-color: #c0c0c0; font-weight: bold">Ketidakhadiran</td>
                </tr>
                    <tr>
                        <td class="grs" style="width: 8px;">1</td>
                        <td style="width: 150px;">Sakit</td>
                        <td style="width: 120px;text-align:center"><?= $rpt['ips_sakit']?> hari</td>
                    </tr>
                    <tr>
                        <td class="grs" style="width: 8px;">2</td>
                        <td style="width: 150px;">Ijin</td>
                        <td style="width: 120px;text-align:center"><?= $rpt['ips_ijin']?> hari</td>
                    </tr>
                    <tr>
                        <td class="grs" style="width: 8px;">3</td>
                        <td style="width: 150px;">Tanpa Keterangan</td>
                        <td style="width: 120px;text-align:center"><?= $rpt['ips_alpa']?> hari</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table class="ttd">
        <tr>
            <td style="width: 30%;">
                Orang Tua / Wali Siswa,<br>
                <span style="margin-top:95px">.........................................</span>
            </td>
            <td style="width: 30%;">
                <br><br><br><br>Mengetahui<br>Kepala Sekolah<br>
                <img src="../asset/img/ttd-kepsek.jpg" style="width: 150px;"><br>
                <span><?= $skl['skl_kepsek']?></span>
            </td>
            <td style="width: 30%;">
                <?= $skl['skl_tglSK']?><br>Wali Kelas,<br>
                <?php
                    if($rpt['ips_walas'] == 'Supartini, S.Pd' && $rpt['ips_kelas'] == 'X/ IIS - 1'){ 
                        echo '<img src="../asset/img/Supartini.png" style="width: 130px"><br>';
                    }elseif($rpt['ips_walas'] == 'Rika Kartika, M.Pd' && $rpt['ips_kelas'] == 'X/ IIS - 2'){
                        echo '<img src="../asset/img/Rikha.png" style="width: 130px"><br>';
                    }elseif($rpt['ips_walas'] == 'Tuti Alawiyah, S.Pd' && $rpt['ips_kelas'] == 'X/ IIS - 3'){
                        echo '<img src="../asset/img/Tuti.png" style="width: 130px"><br>';
                    }elseif($rpt['ips_walas'] == 'Kurniawan Heryanto, S.Pd' && $rpt['ips_kelas'] == 'XI/ IIS - 1'){
                        echo '<img src="../asset/img/kurniawan.png" style="width: 130px"><br>';
                    }elseif($rpt['ips_walas'] == 'Aliyah, S.Pdi' && $rpt['ips_kelas'] == 'XI/ IIS - 2'){
                        echo '<img src="../asset/img/Aliyah.jpg" style="width: 130px"><br>';
                    }elseif($rpt['ips_walas'] == 'Akbar Fuad, S.Pd' && $rpt['ips_kelas'] == 'XI/ IIS - 3'){
                        echo '<img src="../asset/img/AkbarFuad.png" style="width: 130px"><br>';
                    }elseif($rpt['ips_walas'] == 'Drs. Gik Sugiarto' && $rpt['ips_kelas'] == 'XII/ IPS - 1'){
                        echo '<img src="../asset/img/Giek.jpg" style="width: 130px"><br>';
                    }elseif($rpt['ips_walas'] == 'Farida Muniroh, S.Pd' && $rpt['ips_kelas'] == 'XII/IPS - 2'){
                        echo '<img src="../asset/img/Farida.png" style="width: 130px"><br>';
                    }elseif($rpt['ips_walas'] == 'Fenti Utami, M.Pd' && $rpt['ips_kelas'] == 'XII/ IIS - 3'){
                        echo '<img src="../asset/img/Fenti.png" style="width: 130px"><br>';
                    }elseif($rpt['ips_walas'] == 'M. Tolib Apandi, M.Pd' && $rpt['ips_kelas'] == 'XII/ IIS - 4'){
                        echo '<img src="../asset/img/Tolib.jpg" style="width: 130px"><br>';
                    }
                ?>
                <span><?= $rpt['ips_walas']?></span>
            </td>
        </tr>
    </table>
</page>
<?php
$content = ob_get_clean();
// convert to PDF
require_once(dirname(__FILE__) . '/html2pdf4/html2pdf.class.php');
try {
    $html2pdf = new HTML2PDF('P', 'Legal', 'en', true, 'UTF-8', array(5, 5, 5, 15));
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
    //$html2pdf->createIndex('Sommaire', 25, 12, false, true, 1);
    $html2pdf->Output('Raport PTS -' . $skl['skl_nama'] . '.pdf');
} catch (HTML2PDF_exception $e) {
    echo $e;
    exit;
}
?>
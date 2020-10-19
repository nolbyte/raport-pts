<?php
session_start();
define("RESMI", "OK");
if(!isset($_SESSION['idSiswa']) && !isset($_SESSION['admID'])){
        header("Location: ../index.php");
    }
/*
if (!isset($_SESSION['admID'])) {
    header("Location: ../index.php");
}*/
//konfigurasi
require('../config/database.php');
require('../config/fungsi.php');
if (isset($_GET['tingal']) && !empty($_GET['tingal'])) {
    $cokot             = urldecode($_GET['tingal']);
    $buka              = encryptor('decrypt', $cokot);
    $sql = $db->prepare("SELECT * FROM rp_ipa WHERE ipa_id = :idna");
    $sql->execute(array(':idna' => $buka));
    $rpt = $sql->fetch(PDO::FETCH_ASSOC);    
    if ($rpt === false) {
?><script>
            swal("Galat", "Transaksi tidak dapat dilakukan", "error");
</script>
<?php
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
    .ttd-kepsek {
        background-image: url("../asset/img/ttd-kepsek.png");
        width: 200px;
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
            <td width="250">: <?= $rpt['ipa_kelas']; ?></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>: <?= $skl['skl_alamat']; ?></td>
            <td>Semester</td>
            <td>: <?= $rpt['ipa_semester']; ?></td>
        </tr>
        <tr>
            <td>Nama Peserta Didik</td>
            <td>: <?= $rpt['ipa_nama']; ?></td>
            <td>T.P.</td>
            <td>: <?= $skl['skl_thnP']; ?></td>
        </tr>
        <tr>
            <td>No Induk/NISN</td>
            <td>: <?= $rpt['ipa_nisn']; ?></td>
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
                <td class="sub1"><?= $rpt['ipa_kkm'];?></td>
                <td class="sub1"><?= $rpt['ipa_agama'];?></td>
                <td class="sub1">
                    <?php
                        if($rpt['ipa_agama'] >= 0 && $rpt['ipa_agama'] <= 70){
                            echo 'D';
                        }elseif($rpt['ipa_agama'] >= 70 && $rpt['ipa_agama'] <= 80){
                            echo 'C';
                        }elseif($rpt['ipa_agama'] >= 81 && $rpt['ipa_agama'] <= 90){
                            echo 'B';
                        }elseif($rpt['ipa_agama'] >= 91 && $rpt['ipa_agama'] <= 100){
                            echo 'A';
                        }
                    ?>
                </td>
                <td class="sub1"><?= $rpt['ipa_agamaR']?></td>
                <td class="sub1">
                <?php
                        if($rpt['ipa_agamaR'] >= 1 && $rpt['ipa_agamaR'] <= 70){
                            echo 'D';
                        }elseif($rpt['ipa_agamaR'] >= 70 && $rpt['ipa_agamaR'] <= 80){
                            echo 'C';
                        }elseif($rpt['ipa_agamaR'] >= 81 && $rpt['ipa_agamaR'] <= 90){
                            echo 'B';
                        }elseif($rpt['ipa_agamaR'] >= 91 && $rpt['ipa_agamaR'] <= 100){
                            echo 'A';
                        }else{
                            echo "-";
                        }
                    ?>
                </td>
                <td class="sub1">
                    <?php
                        if($rpt['ipa_agama'] >= $rpt['ipa_kkm']){
                            echo 'Tuntas';
                        }elseif($rpt['ipa_agamaR'] >= $rpt['ipa_kkm']){
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
                <td class="sub1"><?= $rpt['ipa_kkm'];?></td>
                <td class="sub1"><?= $rpt['ipa_pkn'];?></td>
                <td class="sub1">
                    <?php
                        if($rpt['ipa_pkn'] >= 0 && $rpt['ipa_pkn'] <= 70){
                            echo 'D';
                        }elseif($rpt['ipa_pkn'] >= 70 && $rpt['ipa_pkn'] <= 80){
                            echo 'C';
                        }elseif($rpt['ipa_pkn'] >= 81 && $rpt['ipa_pkn'] <= 90){
                            echo 'B';
                        }elseif($rpt['ipa_pkn'] >= 91 && $rpt['ipa_pkn'] <= 100){
                            echo 'A';
                        }
                    ?>
                </td>
                <td class="sub1"><?= $rpt['ipa_pknR']?></td>
                <td class="sub1">
                    <?php
                        if($rpt['ipa_pknR'] >= 1 && $rpt['ipa_pknR'] <= 70){
                            echo 'D';
                        }elseif($rpt['ipa_pknR'] >= 70 && $rpt['ipa_pknR'] <= 80){
                            echo 'C';
                        }elseif($rpt['ipa_pknR'] >= 81 && $rpt['ipa_pknR'] <= 90){
                            echo 'B';
                        }elseif($rpt['ipa_pknR'] >= 91 && $rpt['ipa_pknR'] <= 100){
                            echo 'A';
                        }else{
                            echo "-";
                        }
                    ?>
                </td>
                <td class="sub1">
                    <?php
                        if($rpt['ipa_pkn'] >= $rpt['ipa_kkm']){
                            echo 'Tuntas';
                        }elseif($rpt['ipa_pknR'] >= $rpt['ipa_kkm']){
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
                <td class="sub1"><?= $rpt['ipa_kkm'];?></td>
                <td class="sub1"><?= $rpt['ipa_bhsInd'];?></td>
                <td class="sub1">
                <?php
                        if($rpt['ipa_bhsInd'] >= 0 && $rpt['ipa_bhsInd'] <= 70){
                            echo 'D';
                        }elseif($rpt['ipa_bhsInd'] >= 70 && $rpt['ipa_bhsInd'] <= 80){
                            echo 'C';
                        }elseif($rpt['ipa_bhsInd'] >= 81 && $rpt['ipa_bhsInd'] <= 90){
                            echo 'B';
                        }elseif($rpt['ipa_bhsInd'] >= 91 && $rpt['ipa_bhsInd'] <= 100){
                            echo 'A';
                        }
                    ?>
                </td>
                <td class="sub1"><?= $rpt['ipa_bhsIndR'] ?></td>
                <td class="sub1">
                    <?php
                        if($rpt['ipa_bhsIndR'] >= 1 && $rpt['ipa_bhsIndR'] <= 70){
                            echo 'D';
                        }elseif($rpt['ipa_bhsIndR'] >= 70 && $rpt['ipa_bhsIndR'] <= 80){
                            echo 'C';
                        }elseif($rpt['ipa_bhsIndR'] >= 81 && $rpt['ipa_bhsIndR'] <= 90){
                            echo 'B';
                        }elseif($rpt['ipa_bhsIndR'] >= 91 && $rpt['ipa_bhsIndR'] <= 100){
                            echo 'A';
                        }else{
                            echo "-";
                        }
                    ?>
                </td>
                <td class="sub1">
                    <?php
                        if($rpt['ipa_bhsInd'] >= $rpt['ipa_kkm']){
                            echo 'Tuntas';
                        }elseif($rpt['ipa_bhsIndR'] >= $rpt['ipa_kkm']){
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
                <td class="sub1"><?= $rpt['ipa_kkm'];?></td>
                <td class="sub1"><?= $rpt['ipa_mtk'];?></td>
                <td class="sub1">
                <?php
                        if($rpt['ipa_mtk'] >= 0 && $rpt['ipa_mtk'] <= 70){
                            echo 'D';
                        }elseif($rpt['ipa_mtk'] >= 70 && $rpt['ipa_mtk'] <= 80){
                            echo 'C';
                        }elseif($rpt['ipa_mtk'] >= 81 && $rpt['ipa_mtk'] <= 90){
                            echo 'B';
                        }elseif($rpt['ipa_mtk'] >= 91 && $rpt['ipa_mtk'] <= 100){
                            echo 'A';
                        }
                    ?>
                </td>
                <td class="sub1"><?= $rpt['ipa_mtkR'] ?></td>
                <td class="sub1">
                    <?php
                        if($rpt['ipa_mtkR'] >= 1 && $rpt['ipa_mtkR'] <= 70){
                            echo 'D';
                        }elseif($rpt['ipa_mtkR'] >= 70 && $rpt['ipa_mtkR'] <= 80){
                            echo 'C';
                        }elseif($rpt['ipa_mtkR'] >= 81 && $rpt['ipa_mtkR'] <= 90){
                            echo 'B';
                        }elseif($rpt['ipa_mtkR'] >= 91 && $rpt['ipa_mtkR'] <= 100){
                            echo 'A';
                        }else{
                            echo '-';
                        }
                    ?>
                </td>
                <td class="sub1">
                <?php
                        if($rpt['ipa_mtk'] >= $rpt['ipa_kkm']){
                            echo 'Tuntas';
                        }elseif($rpt['ipa_mtkR'] >= $rpt['ipa_kkm']){
                            echo "Tuntas";
                        }else{
                            echo 'Belum Tuntas';
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td class="sub1" style="width: 8px;">5</td>
                <td>Bahasa Inggris</td>
                <td class="sub1"><?= $rpt['ipa_kkm'];?></td>
                <td class="sub1"><?= $rpt['ipa_bhsIng'];?></td>
                <td class="sub1">
                    <?php
                        if($rpt['ipa_bhsIng'] >= 0 && $rpt['ipa_bhsIng'] <= 70){
                            echo 'D';
                        }elseif($rpt['ipa_bhsIng'] >= 70 && $rpt['ipa_bhsIng'] <= 80){
                            echo 'C';
                        }elseif($rpt['ipa_bhsIng'] >= 81 && $rpt['ipa_bhsIng'] <= 90){
                            echo 'B';
                        }elseif($rpt['ipa_bhsIng'] >= 91 && $rpt['ipa_bhsIng'] <= 100){
                            echo 'A';
                        }
                    ?>
                </td>
                <td class="sub1"><?= $rpt['ipa_bhsIngR']?></td>
                <td class="sub1">
                    <?php
                        if($rpt['ipa_bhsIngR'] >= 1 && $rpt['ipa_bhsIngR'] <= 70){
                            echo 'D';
                        }elseif($rpt['ipa_bhsIngR'] >= 70 && $rpt['ipa_bhsIngR'] <= 80){
                            echo 'C';
                        }elseif($rpt['ipa_bhsIngR'] >= 81 && $rpt['ipa_bhsIngR'] <= 90){
                            echo 'B';
                        }elseif($rpt['ipa_bhsIngR'] >= 91 && $rpt['ipa_bhsIngR'] <= 100){
                            echo 'A';
                        }else{
                            echo "-";
                        }
                    ?>
                </td>
                <td class="sub1">
                <?php
                        if($rpt['ipa_bhsIng'] >= $rpt['ipa_kkm']){
                            echo 'Tuntas';
                        }elseif($rpt['ipa_bhsIngR'] >= $rpt['ipa_kkm']){
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
                <td class="sub1"><?= $rpt['ipa_kkm'];?></td>
                <td class="sub1"><?= $rpt['ipa_sejarahInd'];?></td>
                <td class="sub1">
                    <?php
                        if($rpt['ipa_sejarahInd'] >= 0 && $rpt['ipa_sejarahInd'] <= 70){
                            echo 'D';
                        }elseif($rpt['ipa_sejarahInd'] >= 70 && $rpt['ipa_sejarahInd'] <= 80){
                            echo 'C';
                        }elseif($rpt['ipa_sejarahInd'] >= 81 && $rpt['ipa_sejarahInd'] <= 90){
                            echo 'B';
                        }elseif($rpt['ipa_sejarahInd'] >= 91 && $rpt['ipa_sejarahInd'] <= 100){
                            echo 'A';
                        }
                    ?>
                </td>
                <td class="sub1"><?= $rpt['ipa_sejarahIndR'] ?></td>
                <td class="sub1">
                    <?php
                        if($rpt['ipa_sejarahIndR'] >= 1 && $rpt['ipa_sejarahIndR'] <= 70){
                            echo 'D';
                        }elseif($rpt['ipa_sejarahIndR'] >= 70 && $rpt['ipa_sejarahIndR'] <= 80){
                            echo 'C';
                        }elseif($rpt['ipa_sejarahIndR'] >= 81 && $rpt['ipa_sejarahIndR'] <= 90){
                            echo 'B';
                        }elseif($rpt['ipa_sejarahIndR'] >= 91 && $rpt['ipa_sejarahIndR'] <= 100){
                            echo 'A';
                        }else{
                            echo "-";
                        }
                    ?>
                </td>
                <td class="sub1">
                <?php
                        if($rpt['ipa_sejarahInd'] >= $rpt['ipa_kkm']){
                            echo 'Tuntas';
                        }elseif($rpt['ipa_sejarahIndR'] >= $rpt['ipa_kkm']){
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
                <td class="sub1"><?= $rpt['ipa_kkm'];?></td>
                <td class="sub1"><?= $rpt['ipa_senbud'];?></td>
                <td class="sub1">
                    <?php
                        if($rpt['ipa_senbud'] >= 0 && $rpt['ipa_senbud'] <= 70){
                            echo 'D';
                        }elseif($rpt['ipa_senbud'] >= 70 && $rpt['ipa_senbud'] <= 80){
                            echo 'C';
                        }elseif($rpt['ipa_senbud'] >= 81 && $rpt['ipa_senbud'] <= 90){
                            echo 'B';
                        }elseif($rpt['ipa_senbud'] >= 91 && $rpt['ipa_senbud'] <= 100){
                            echo 'A';
                        }
                    ?>
                </td>
                <td class="sub1"><?= $rpt['ipa_senbudR']?></td>
                <td class="sub1">
                    <?php
                        if($rpt['ipa_senbudR'] >= 1 && $rpt['ipa_senbudR'] <= 70){
                            echo 'D';
                        }elseif($rpt['ipa_senbudR'] >= 70 && $rpt['ipa_senbudR'] <= 80){
                            echo 'C';
                        }elseif($rpt['ipa_senbudR'] >= 81 && $rpt['ipa_senbudR'] <= 90){
                            echo 'B';
                        }elseif($rpt['ipa_senbudR'] >= 91 && $rpt['ipa_senbudR'] <= 100){
                            echo 'A';
                        }else{
                            echo "-";
                        }
                    ?>
                </td>
                <td class="sub1">
                <?php
                        if($rpt['ipa_senbud'] >= $rpt['ipa_kkm']){
                            echo 'Tuntas';
                        }elseif($rpt['ipa_senbudR'] >= $rpt['ipa_kkm']){
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
                <td class="sub1"><?= $rpt['ipa_kkm'];?></td>
                <td class="sub1"><?= $rpt['ipa_penjas'];?></td>
                <td class="sub1">
                    <?php
                        if($rpt['ipa_penjas'] >= 0 && $rpt['ipa_penjas'] <= 70){
                            echo 'D';
                        }elseif($rpt['ipa_penjas'] >= 70 && $rpt['ipa_penjas'] <= 80){
                            echo 'C';
                        }elseif($rpt['ipa_penjas'] >= 81 && $rpt['ipa_penjas'] <= 90){
                            echo 'B';
                        }elseif($rpt['ipa_penjas'] >= 91 && $rpt['ipa_penjas'] <= 100){
                            echo 'A';
                        }
                    ?>
                </td>
                <td class="sub1"><?= $rpt['ipa_penjasR']?></td>
                <td class="sub1">
                <?php
                        if($rpt['ipa_penjasR'] >= 1 && $rpt['ipa_penjasR'] <= 70){
                            echo 'D';
                        }elseif($rpt['ipa_penjasR'] >= 70 && $rpt['ipa_penjasR'] <= 80){
                            echo 'C';
                        }elseif($rpt['ipa_penjasR'] >= 81 && $rpt['ipa_penjasR'] <= 90){
                            echo 'B';
                        }elseif($rpt['ipa_penjasR'] >= 91 && $rpt['ipa_penjasR'] <= 100){
                            echo 'A';
                        }else{
                            echo "-";
                        }
                    ?>
                </td>
                <td class="sub1">
                <?php
                        if($rpt['ipa_penjas'] >= $rpt['ipa_kkm']){
                            echo 'Tuntas';
                        }elseif($rpt['ipa_penjasR'] >= $rpt['ipa_kkm']){
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
                <td class="sub1"><?= $rpt['ipa_kkm'];?></td>
                <td class="sub1"><?= $rpt['ipa_prakarya'];?></td>
                <td class="sub1">
                    <?php
                        if($rpt['ipa_prakarya'] >= 0 && $rpt['ipa_prakarya'] <= 70){
                            echo 'D';
                        }elseif($rpt['ipa_prakarya'] >= 70 && $rpt['ipa_prakarya'] <= 80){
                            echo 'C';
                        }elseif($rpt['ipa_prakarya'] >= 81 && $rpt['ipa_prakarya'] <= 90){
                            echo 'B';
                        }elseif($rpt['ipa_prakarya'] >= 91 && $rpt['ipa_prakarya'] <= 100){
                            echo 'A';
                        }
                    ?>
                </td>
                <td class="sub1"><?= $rpt['ipa_prakaryaR']?></td>
                <td class="sub1">
                    <?php
                        if($rpt['ipa_prakaryaR'] >= 1 && $rpt['ipa_prakaryaR'] <= 70){
                            echo 'D';
                        }elseif($rpt['ipa_prakaryaR'] >= 70 && $rpt['ipa_prakaryaR'] <= 80){
                            echo 'C';
                        }elseif($rpt['ipa_prakaryaR'] >= 81 && $rpt['ipa_prakaryaR'] <= 90){
                            echo 'B';
                        }elseif($rpt['ipa_prakaryaR'] >= 91 && $rpt['ipa_prakaryaR'] <= 100){
                            echo 'A';
                        }else{
                            echo "-";
                        }
                    ?>
                </td>
                <td class="sub1">
                <?php
                        if($rpt['ipa_prakarya'] >= $rpt['ipa_kkm']){
                            echo 'Tuntas';
                        }elseif($rpt['ipa_prakaryaR'] >= $rpt['ipa_kkm']){
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
                <td>Matematika</td>
                <td class="sub1"><?= $rpt['ipa_kkm'];?></td>
                <td class="sub1"><?= $rpt['ipa_mtk2'];?></td>
                <td class="sub1">
                    <?php
                        if($rpt['ipa_mtk2'] >= 0 && $rpt['ipa_mtk2'] <= 70){
                            echo 'D';
                        }elseif($rpt['ipa_mtk2'] >= 70 && $rpt['ipa_mtk2'] <= 80){
                            echo 'C';
                        }elseif($rpt['ipa_mtk2'] >= 81 && $rpt['ipa_mtk2'] <= 90){
                            echo 'B';
                        }elseif($rpt['ipa_mtk2'] >= 91 && $rpt['ipa_mtk2'] <= 100){
                            echo 'A';
                        }
                    ?>
                </td>
                <td class="sub1"><?= $rpt['ipa_mtk2R']?></td>
                <td class="sub1">
                    <?php
                        if($rpt['ipa_mtk2R'] >= 1 && $rpt['ipa_mtk2R'] <= 70){
                            echo 'D';
                        }elseif($rpt['ipa_mtk2R'] >= 70 && $rpt['ipa_mtk2R'] <= 80){
                            echo 'C';
                        }elseif($rpt['ipa_mtk2R'] >= 81 && $rpt['ipa_mtk2R'] <= 90){
                            echo 'B';
                        }elseif($rpt['ipa_mtk2R'] >= 91 && $rpt['ipa_mtk2R'] <= 100){
                            echo 'A';
                        }else{
                            echo "-";
                        }
                    ?>
                </td>
                <td class="sub1">
                <?php
                        if($rpt['ipa_mtk2'] >= $rpt['ipa_kkm']){
                            echo 'Tuntas';
                        }elseif($rpt['ipa_mtk2R'] >= $rpt['ipa_kkm']){
                            echo 'Tuntas';
                        }else{
                            echo 'Belum Tuntas';
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td class="sub1" style="width: 8px;">2</td>
                <td>Biologi</td>
                <td class="sub1"><?= $rpt['ipa_kkm'];?></td>
                <td class="sub1"><?= $rpt['ipa_biologi'];?></td>
                <td class="sub1">
                    <?php
                        if($rpt['ipa_biologi'] >= 0 && $rpt['ipa_biologi'] <= 70){
                            echo 'D';
                        }elseif($rpt['ipa_biologi'] >= 70 && $rpt['ipa_biologi'] <= 80){
                            echo 'C';
                        }elseif($rpt['ipa_biologi'] >= 81 && $rpt['ipa_biologi'] <= 90){
                            echo 'B';
                        }elseif($rpt['ipa_biologi'] >= 91 && $rpt['ipa_biologi'] <= 100){
                            echo 'A';
                        }
                    ?>
                </td>
                <td class="sub1"><?= $rpt['ipa_biologiR']?></td>
                <td class="sub1">
                    <?php
                        if($rpt['ipa_biologiR'] >= 1 && $rpt['ipa_biologiR'] <= 70){
                            echo 'D';
                        }elseif($rpt['ipa_biologiR'] >= 70 && $rpt['ipa_biologiR'] <= 80){
                            echo 'C';
                        }elseif($rpt['ipa_biologiR'] >= 81 && $rpt['ipa_biologiR'] <= 90){
                            echo 'B';
                        }elseif($rpt['ipa_biologiR'] >= 91 && $rpt['ipa_biologiR'] <= 100){
                            echo 'A';
                        }else{
                            echo "-";
                        }
                    ?>
                </td>
                <td class="sub1">
                <?php
                        if($rpt['ipa_biologi'] >= $rpt['ipa_kkm']){
                            echo 'Tuntas';
                        }elseif($rpt['ipa_biologiR'] >= $rpt['ipa_kkm']){
                            echo 'Tuntas';
                        }else{
                            echo 'Belum Tuntas';
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td class="sub1" style="width: 8px;">3</td>
                <td>Fisika</td>
                <td class="sub1"><?= $rpt['ipa_kkm'];?></td>
                <td class="sub1"><?= $rpt['ipa_fisika'];?></td>
                <td class="sub1">
                    <?php
                        if($rpt['ipa_fisika'] >= 0 && $rpt['ipa_fisika'] <= 70){
                            echo 'D';
                        }elseif($rpt['ipa_fisika'] >= 70 && $rpt['ipa_fisika'] <= 80){
                            echo 'C';
                        }elseif($rpt['ipa_fisika'] >= 81 && $rpt['ipa_fisika'] <= 90){
                            echo 'B';
                        }elseif($rpt['ipa_fisika'] >= 91 && $rpt['ipa_fisika'] <= 100){
                            echo 'A';
                        }
                    ?>
                </td>
                <td class="sub1"><?= $rpt['ipa_fisikaR']?></td>
                <td class="sub1">
                    <?php
                        if($rpt['ipa_fisikaR'] >= 1 && $rpt['ipa_fisikaR'] <= 70){
                            echo 'D';
                        }elseif($rpt['ipa_fisikaR'] >= 70 && $rpt['ipa_fisikaR'] <= 80){
                            echo 'C';
                        }elseif($rpt['ipa_fisikaR'] >= 81 && $rpt['ipa_fisikaR'] <= 90){
                            echo 'B';
                        }elseif($rpt['ipa_fisikaR'] >= 91 && $rpt['ipa_fisikaR'] <= 100){
                            echo 'A';
                        }else{
                            echo "-";
                        }
                    ?>
                </td>
                <td class="sub1">
                <?php
                        if($rpt['ipa_fisika'] >= $rpt['ipa_kkm']){
                            echo 'Tuntas';
                        }elseif($rpt['ipa_fisikaR'] >= $rpt['ipa_kkm']){
                            echo 'Tuntas';
                        }else{
                            echo 'Belum Tuntas';
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td class="sub1" style="width: 8px;">4</td>
                <td>Kimia</td>
                <td class="sub1"><?= $rpt['ipa_kkm'];?></td>
                <td class="sub1"><?= $rpt['ipa_kimia'];?></td>
                <td class="sub1">
                    <?php
                        if($rpt['ipa_kimia'] >= 0 && $rpt['ipa_kimia'] <= 70){
                            echo 'D';
                        }elseif($rpt['ipa_kimia'] >= 70 && $rpt['ipa_kimia'] <= 80){
                            echo 'C';
                        }elseif($rpt['ipa_kimia'] >= 81 && $rpt['ipa_kimia'] <= 90){
                            echo 'B';
                        }elseif($rpt['ipa_kimia'] >= 91 && $rpt['ipa_kimia'] <= 100){
                            echo 'A';
                        }
                    ?>
                </td>
                <td class="sub1"><?= $rpt['ipa_kimiaR']?></td>
                <td class="sub1">
                    <?php
                        if($rpt['ipa_kimiaR'] >= 1 && $rpt['ipa_kimiaR'] <= 70){
                            echo 'D';
                        }elseif($rpt['ipa_kimiaR'] >= 70 && $rpt['ipa_kimiaR'] <= 80){
                            echo 'C';
                        }elseif($rpt['ipa_kimiaR'] >= 81 && $rpt['ipa_kimiaR'] <= 90){
                            echo 'B';
                        }elseif($rpt['ipa_kimiaR'] >= 91 && $rpt['ipa_kimiaR'] <= 100){
                            echo 'A';
                        }else{
                            echo "-";
                        }
                    ?>
                </td>
                <td class="sub1">
                <?php
                        if($rpt['ipa_kimia'] >= $rpt['ipa_kkm']){
                            echo 'Tuntas';
                        }elseif($rpt['ipa_kimiaR'] >= $rpt['ipa_kkm']){
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
                $kelas = stripos($rpt['ipa_kelas'], "XI/");
                $kelas2 = stripos($rpt['ipa_kelas'], "XII/");
                if($kelas !== FALSE){
            ?>
            <tr>
                <td class="sub1" style="width: 8px;">1</td>
                <td>Geografi</td>
                <td class="sub1"><?= $rpt['ipa_kkm'];?></td>
                <td class="sub1"><?= $rpt['ipa_geografi'];?></td>
                <td class="sub1">
                    <?php
                        if($rpt['ipa_geografi'] >= 0 && $rpt['ipa_geografi'] <= 70){
                            echo 'D';
                        }elseif($rpt['ipa_geografi'] >= 70 && $rpt['ipa_geografi'] <= 80){
                            echo 'C';
                        }elseif($rpt['ipa_geografi'] >= 81 && $rpt['ipa_geografi'] <= 90){
                            echo 'B';
                        }elseif($rpt['ipa_geografi'] >= 91 && $rpt['ipa_geografi'] <= 100){
                            echo 'A';
                        }
                    ?>
                </td>
                <td class="sub1"><?= $rpt['ipa_geografiR']?></td>
                <td class="sub1">
                    <?php
                        if($rpt['ipa_geografiR'] >= 1 && $rpt['ipa_geografiR'] <= 70){
                            echo 'D';
                        }elseif($rpt['ipa_geografiR'] >= 70 && $rpt['ipa_geografiR'] <= 80){
                            echo 'C';
                        }elseif($rpt['ipa_geografiR'] >= 81 && $rpt['ipa_geografiR'] <= 90){
                            echo 'B';
                        }elseif($rpt['ipa_geografiR'] >= 91 && $rpt['ipa_geografiR'] <= 100){
                            echo 'A';
                        }else{
                            echo "-";
                        }
                    ?>
                </td>
                <td class="sub1">
                <?php
                        if($rpt['ipa_geografi'] >= $rpt['ipa_kkm']){
                            echo 'Tuntas';
                        }elseif($rpt['ipa_geografiR'] >= $rpt['ipa_kkm']){
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
                <td>Bahasa dan Sastra Inggris</td>
                <td class="sub1"><?= $rpt['ipa_kkm'];?></td>
                <td class="sub1"><?= $rpt['ipa_sasIng'];?></td>
                <td class="sub1">
                    <?php
                        if($rpt['ipa_sasIng'] >= 0 && $rpt['ipa_sasIng'] <= 70){
                            echo 'D';
                        }elseif($rpt['ipa_sasIng'] >= 70 && $rpt['ipa_sasIng'] <= 80){
                            echo 'C';
                        }elseif($rpt['ipa_sasIng'] >= 81 && $rpt['ipa_sasIng'] <= 90){
                            echo 'B';
                        }elseif($rpt['ipa_sasIng'] >= 91 && $rpt['ipa_sasIng'] <= 100){
                            echo 'A';
                        }
                    ?>
                </td>
                <td class="sub1"><?= $rpt['ipa_sasIngR']?></td>
                <td class="sub1">
                    <?php
                        if($rpt['ipa_sasIngR'] >= 1 && $rpt['ipa_sasIngR'] <= 70){
                            echo 'D';
                        }elseif($rpt['ipa_sasIngR'] >= 70 && $rpt['ipa_sasIngR'] <= 80){
                            echo 'C';
                        }elseif($rpt['ipa_sasIngR'] >= 81 && $rpt['ipa_sasIngR'] <= 90){
                            echo 'B';
                        }elseif($rpt['ipa_sasIngR'] >= 91 && $rpt['ipa_sasIngR'] <= 100){
                            echo 'A';
                        }else{
                            echo "-";
                        }
                    ?>
                </td>
                <td class="sub1">
                <?php
                        if($rpt['ipa_sasIng'] >= $rpt['ipa_kkm']){
                            echo 'Tuntas';
                        }elseif($rpt['ipa_sasIngR'] >= $rpt['ipa_kkm']){
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
                <td>Ekonomi</td>
                <td class="sub1"><?= $rpt['ipa_kkm'];?></td>
                <td class="sub1"><?= $rpt['ipa_ekonomi'];?></td>
                <td class="sub1">
                    <?php
                        if($rpt['ipa_ekonomi'] >= 0 && $rpt['ipa_ekonomi'] <= 70){
                            echo 'D';
                        }elseif($rpt['ipa_ekonomi'] >= 70 && $rpt['ipa_ekonomi'] <= 80){
                            echo 'C';
                        }elseif($rpt['ipa_ekonomi'] >= 81 && $rpt['ipa_ekonomi'] <= 90){
                            echo 'B';
                        }elseif($rpt['ipa_ekonomi'] >= 91 && $rpt['ipa_ekonomi'] <= 100){
                            echo 'A';
                        }
                    ?>
                </td>
                <td class="sub1"><?= $rpt['ipa_ekonomiR']?></td>
                <td class="sub1">
                    <?php
                        if($rpt['ipa_ekonomiR'] >= 1 && $rpt['ipa_ekonomiR'] <= 70){
                            echo 'D';
                        }elseif($rpt['ipa_ekonomiR'] >= 70 && $rpt['ipa_ekonomiR'] <= 80){
                            echo 'C';
                        }elseif($rpt['ipa_ekonomiR'] >= 81 && $rpt['ipa_ekonomiR'] <= 90){
                            echo 'B';
                        }elseif($rpt['ipa_ekonomiR'] >= 91 && $rpt['ipa_ekonomiR'] <= 100){
                            echo 'A';
                        }else{
                            echo "-";
                        }
                    ?>
                </td>
                <td class="sub1">
                <?php
                        if($rpt['ipa_ekonomi'] >= $rpt['ipa_kkm']){
                            echo 'Tuntas';
                        }elseif($rpt['ipa_ekonomiR'] >= $rpt['ipa_kkm']){
                            echo 'Tuntas';
                        }else{
                            echo 'Belum Tuntas';
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td class="sub1" style="width: 8px;">2</td>
                <td>Sosiologi</td>
                <td class="sub1"><?= $rpt['ipa_kkm'];?></td>
                <td class="sub1"><?= $rpt['ipa_sosiologi'];?></td>
                <td class="sub1">
                    <?php
                        if($rpt['ipa_sosiologi'] >= 0 && $rpt['ipa_sosiologi'] <= 70){
                            echo 'D';
                        }elseif($rpt['ipa_sosiologi'] >= 70 && $rpt['ipa_sosiologi'] <= 80){
                            echo 'C';
                        }elseif($rpt['ipa_sosiologi'] >= 81 && $rpt['ipa_sosiologi'] <= 90){
                            echo 'B';
                        }elseif($rpt['ipa_sosiologi'] >= 91 && $rpt['ipa_sosiologi'] <= 100){
                            echo 'A';
                        }
                    ?>
                </td>
                <td class="sub1"><?= $rpt['ipa_sosiologiR']?></td>
                <td class="sub1">
                    <?php
                        if($rpt['ipa_sosiologiR'] >= 1 && $rpt['ipa_sosiologiR'] <= 70){
                            echo 'D';
                        }elseif($rpt['ipa_sosiologiR'] >= 70 && $rpt['ipa_sosiologiR'] <= 80){
                            echo 'C';
                        }elseif($rpt['ipa_sosiologiR'] >= 81 && $rpt['ipa_sosiologiR'] <= 90){
                            echo 'B';
                        }elseif($rpt['ipa_sosiologiR'] >= 91 && $rpt['ipa_sosiologiR'] <= 100){
                            echo 'A';
                        }else{
                            echo "-";
                        }
                    ?>
                </td>
                <td class="sub1">
                <?php
                        if($rpt['ipa_sosiologi'] >= $rpt['ipa_kkm']){
                            echo 'Tuntas';
                        }elseif($rpt['ipa_sosiologiR'] >= $rpt['ipa_kkm']){
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
                        <td style="width: 120px;text-align:center"><?= number_format($rpt['ipa_rerata'])?></td>
                    </tr>
                    <tr>
                        <td class="grs" style="width: 8px;">2</td>
                        <td style="width: 150px;">Peringkat</td>
                        <td style="width: 120px;text-align:center">
                            <?php
                               $kls1 = 'X/ MIA - 1'; $kls2 = 'X/ MIA - 2'; $kls3 = 'XI/ MIA'; $kls4 = 'XII/ MIA - 1'; $kls5 = 'XII/ MIA - 2';
                               if($kls1 === $rpt['ipa_kelas']){
                                   $sql = $db->prepare("SELECT COUNT(*) FROM rp_ipa WHERE ipa_kelas = ?");
                                   $sql->execute(array($kls1));
                                   $ttl = $sql->fetchColumn();
                                   echo $rpt['ipa_rank'].'/'.$ttl;
                               }elseif($kls2 === $rpt['ipa_kelas']){
                                   $sql = $db->prepare("SELECT COUNT(*) FROM rp_ipa WHERE ipa_kelas = ?");
                                   $sql->execute(array($kls2));
                                   $ttl = $sql->fetchColumn();
                                   echo $rpt['ipa_rank'].'/'.$ttl;
                               }elseif($kls3 === $rpt['ipa_kelas']){
                                    $sql = $db->prepare("SELECT COUNT(*) FROM rp_ipa WHERE ipa_kelas = ?");
                                    $sql->execute(array($kls3));
                                    $ttl = $sql->fetchColumn();
                                    echo $rpt['ipa_rank'].'/'.$ttl;
                                }elseif($kls4 === $rpt['ipa_kelas']){
                                    $sql = $db->prepare("SELECT COUNT(*) FROM rp_ipa WHERE ipa_kelas = ?");
                                    $sql->execute(array($kls4));
                                    $ttl = $sql->fetchColumn();
                                    echo $rpt['ipa_rank'].'/'.$ttl;
                                }elseif($kls5 === $rpt['ipa_kelas']){
                                    $sql = $db->prepare("SELECT COUNT(*) FROM rp_ipa WHERE ipa_kelas = ?");
                                    $sql->execute(array($kls5));
                                    $ttl = $sql->fetchColumn();
                                    echo $rpt['ipa_rank'].'/'.$ttl;
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
                        <td style="width: 120px;text-align:center"><?= $rpt['ipa_sakit']?> hari</td>
                    </tr>
                    <tr>
                        <td class="grs" style="width: 8px;">2</td>
                        <td style="width: 150px;">Ijin</td>
                        <td style="width: 120px;text-align:center"><?= $rpt['ipa_ijin']?> hari</td>
                    </tr>
                    <tr>
                        <td class="grs" style="width: 8px;">3</td>
                        <td style="width: 150px;">Tanpa Keterangan</td>
                        <td style="width: 120px;text-align:center"><?= $rpt['ipa_alpa']?> hari</td>
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
                <img src="../asset/img/ttd-kepsek.jpg" style="width: 160px;"><br>
                <span><?= $skl['skl_kepsek']?></span>
            </td>
            <td style="width: 30%;">
                <?= $skl['skl_tglSK']?><br>Wali Kelas,<br>
                <?php 
                    if($rpt['ipa_walas'] == 'Nunur Jamilah, S.Kom' && $rpt['ipa_kelas'] == 'X/ MIA - 1'){ 
                        echo '<img src="../asset/img/Nunur.png" style="width: 130px"><br>';
                    }elseif($rpt['ipa_walas'] == 'Dra. Widji Lestari' && $rpt['ipa_kelas'] == 'X/ MIA - 2'){
                        echo '<img src="../asset/img/widji.jpg" style="width: 130px"><br>';
                    }elseif($rpt['ipa_walas'] == 'Muwaliha Aufa, S.Kom' && $rpt['ipa_kelas'] == 'XI/ MIA'){
                        echo '<img src="../asset/img/Muwaliha.jpg" style="width: 130px"><br>';
                    }elseif($rpt['ipa_walas'] == 'Ahmad Aldi, S.Pd' && $rpt['ipa_kelas'] == 'XII/ MIA - 1'){
                        echo '<img src="../asset/img/AhmadAldi.png" style="width: 130px"><br>';
                    }elseif($rpt['ipa_walas'] == 'Ernasari Batubara, S.Pd' && $rpt['ipa_kelas'] == 'XII/ MIA - 2'){
                        echo '<img src="../asset/img/Ernasari BB.jpg" style="width: 130px"><br>';
                    }
                ?>
                <span><?= $rpt['ipa_walas']?></span>
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
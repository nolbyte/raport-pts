<?php
defined("RESMI") or die("error");
//password containt
$options = [
    'cost' => 24,
];

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

if (isset($_POST['simpan'])) {
    $file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    if (isset($_FILES['berkas_excel']['name']) && in_array($_FILES['berkas_excel']['type'], $file_mimes)) {
        $arr_file = explode('.', $_FILES['berkas_excel']['name']);
        $extension = end($arr_file);

        if ('csv' == $extension) {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
        } else {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }

        $spreadsheet = $reader->load($_FILES['berkas_excel']['tmp_name']);

        $sheetData = $spreadsheet->getActiveSheet()->toArray();
        if(!empty($sheetData)){
        for ($i = 1; $i < count($sheetData); $i++) {
            $kelas     = $sheetData[$i]['1'];
            $nis       = $sheetData[$i]['2'];
            $nama      = $sheetData[$i]['3'];
            $walas     = $sheetData[$i]['4'];
            $kkm       = $sheetData[$i]['5'];
            $agama     = $sheetData[$i]['6'];
            $pkn       = $sheetData[$i]['7'];
            $bhsInd    = $sheetData[$i]['8'];
            $mtk       = $sheetData[$i]['9'];
            $bhsIng    = $sheetData[$i]['10'];
            $sejInd    = $sheetData[$i]['11'];
            $senbud    = $sheetData[$i]['12'];
            $penjas    = $sheetData[$i]['13'];
            $prakarya  = $sheetData[$i]['14'];
            $geografi  = $sheetData[$i]['15'];
            $sejarah   = $sheetData[$i]['16'];
            $sosiologi = $sheetData[$i]['17'];
            $ekonomi   = $sheetData[$i]['18'];
            $bhsAr     = $sheetData[$i]['19'];
            $kimia     = $sheetData[$i]['20'];
            $rerata    = $sheetData[$i]['21'];
            $jumlah    = $sheetData[$i]['22'];
            $rank      = $sheetData[$i]['23'];
            $sakit     = $sheetData[$i]['24'];
            $ijin      = $sheetData[$i]['25'];
            $alpa      = $sheetData[$i]['26'];

            $password = password_hash($jumlah, PASSWORD_BCRYPT, $options);
            $sql = $db->prepare("INSERT INTO rp_ips SET ips_nisn = ?, ips_kelas = ?, ips_nama = ?, ips_walas = ?, ips_kkm = ?, ips_agama = ?, ips_pkn = ?, ips_bhsInd = ?, ips_mtk = ?, ips_bhsIng = ?, ips_sejarahInd = ?, ips_senbud = ?, ips_penjas = ?, ips_prakarya = ?, ips_geografi = ?, ips_sejarah = ?, ips_sosiologi = ?, ips_ekonomi = ?, ips_bhsAr = ?, ips_kimia = ?, ips_rerata = ?, ips_jumlah = ?, ips_rank = ?, ips_sakit = ?, ips_ijin = ?, ips_alpa = ?, ips_password = ?");
            $sql->bindParam(1, $nis);
            $sql->bindParam(2, $kelas);
            $sql->bindParam(3, $nama);
            $sql->bindParam(4, $walas);
            $sql->bindParam(5, $kkm);
            $sql->bindParam(6, $agama);
            $sql->bindParam(7, $pkn);
            $sql->bindParam(8, $bhsInd);
            $sql->bindParam(9, $mtk);
            $sql->bindParam(10, $bhsIng);
            $sql->bindParam(11, $sejInd);
            $sql->bindParam(12, $senbud);
            $sql->bindParam(13, $penjas);
            $sql->bindParam(14, $prakarya);
            $sql->bindParam(15, $geografi);
            $sql->bindParam(16, $sejarah);
            $sql->bindParam(17, $sosiologi);
            $sql->bindParam(18, $ekonomi);
            $sql->bindParam(19, $bhsAr);
            $sql->bindParam(20, $kimia);
            $sql->bindParam(21, $rerata);
            $sql->bindParam(22, $jumlah);
            $sql->bindParam(23, $rank);
            $sql->bindParam(24, $sakit);
            $sql->bindParam(25, $ijin);
            $sql->bindParam(26, $alpa);
            $sql->bindParam(27, $password);
            $sql->execute();
        }
    }
    }
}
?>
<div class="row">
    <div class="col-md-10 col-xs-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-upload"></i> Upload Nilai Kelas IPS</h3>
            </div>
            <div class="box-body">
                <form method="post" class="form-horizontal" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Upload Excel</label>
                        <div class="col-sm-5">
                            <input type="file" name="berkas_excel" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"></label>
                        <div class="col-sm-5">
                            <button type="submit" class="btn btn-info" name="simpan"><i class="fa fa-upload"></i> Kirim</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
defined("RESMI") or die("error");
require('../config/excel_reader.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $target = basename($_FILES['berkas_excel']['name']) ;
    move_uploaded_file($_FILES['berkas_excel']['tmp_name'], $target);

    $data = new Spreadsheet_Excel_Reader($_FILES['berkas_excel']['name'],false);
    //menghitung jumlah baris file xls
    $baris = $data->rowcount($sheet_index=0);       
    //import data excel mulai baris ke-2 (karena tabel xls ada header pada baris 1)
    for ($i=2; $i <= $baris; $i++){  
    $nis             = $data->val($i, 1);
    $kelas           = $data->val($i, 2);
    $nama            = $data->val($i, 3);
    $tglLahir        = $data->val($i, 4);
    $walas           = $data->val($i, 5);
    $kkm             = $data->val($i, 6);
    $semester        = $data->val($i, 7);
    $agama           = $data->val($i, 8);
    $pkn             = $data->val($i, 9);
    $bhsInd          = $data->val($i, 10);
    $mtk             = $data->val($i, 11);
    $bhsIng          = $data->val($i, 12);
    $sejInd          = $data->val($i, 13);
    $senbud          = $data->val($i, 14);
    $penjas          = $data->val($i, 15);
    $prakarya        = $data->val($i, 16);
    $mtk2            = $data->val($i, 17);
    $biologi         = $data->val($i, 18);
    $fisika          = $data->val($i, 19);
    $kimia           = $data->val($i, 20);
    $ekonomi         = $data->val($i, 21);
    $sosiologi       = $data->val($i, 22);
    $sasIng          = $data->val($i, 23);
    $geografi        = $data->val($i, 24);
    $rerata          = $data->val($i, 25);
    $jumlah          = $data->val($i, 26);
    $rank            = $data->val($i, 27);
    $sakit           = $data->val($i, 28);
    $ijin            = $data->val($i, 29);
    $alpa            = $data->val($i, 30);
    $agamaR          = $data->val($i, 31);
    $pknR            = $data->val($i, 32);
    $bhsIndR         = $data->val($i, 33);
    $mtkR            = $data->val($i, 34);
    $bhsIngR         = $data->val($i, 35);
    $sejIndR         = $data->val($i, 36);
    $senbudR         = $data->val($i, 37);
    $penjasR         = $data->val($i, 38);
    $prakaryaR       = $data->val($i, 39);
    $mtk2R           = $data->val($i, 40);
    $biologiR        = $data->val($i, 41);
    $fisikaR         = $data->val($i, 42);
    $kimiaR          = $data->val($i, 43);
    $ekonomiR        = $data->val($i, 44);
    $sosiologiR      = $data->val($i, 45);
    $sasIngR         = $data->val($i, 46);
    $geografiR       = $data->val($i, 47);
    $plainPassword = strval($jumlah);
    $password = password_hash($plainPassword, PASSWORD_BCRYPT);
    $sql = $db->prepare("INSERT INTO rp_ipa SET ipa_nisn = ?, ipa_kelas = ?, ipa_nama = ?, ipa_tglLahir = ?, ipa_walas = ?, ipa_kkm = ?, ipa_semester = ?, ipa_agama = ?, ipa_pkn = ?, ipa_bhsInd = ?, ipa_mtk = ?, ipa_bhsIng = ?, ipa_sejarahInd = ?, ipa_senbud = ?, ipa_penjas = ?, ipa_prakarya = ?, ipa_mtk2 = ?, ipa_biologi = ?, ipa_fisika = ?, ipa_kimia = ?, ipa_ekonomi = ?, ipa_sosiologi = ?, ipa_sasIng = ?, ipa_geografi = ?, ipa_rerata = ?, ipa_jumlah = ?, ipa_rank = ?, ipa_sakit = ?, ipa_ijin = ?, ipa_alpa = ?, ipa_agamaR = ?, ipa_pknR = ?, ipa_bhsIndR = ?, ipa_mtkR = ?, ipa_bhsIngR = ?, ipa_sejarahIndR = ?, ipa_senbudR = ?, ipa_penjasR = ?, ipa_prakaryaR = ?, ipa_mtk2R = ?, ipa_biologiR = ?, ipa_fisikaR = ?, ipa_kimiaR = ?, ipa_ekonomiR = ?, ipa_sosiologiR = ?, ipa_sasIngR = ?, ipa_geografiR = ?, ipa_password = ?");
    $sql->bindParam(1, $nis);
    $sql->bindParam(2, $kelas);
    $sql->bindParam(3, $nama);
    $sql->bindParam(4, $tglLahir);
    $sql->bindParam(5, $walas);
    $sql->bindParam(6, $kkm);
    $sql->bindParam(7, $semester);
    $sql->bindParam(8, $agama);
    $sql->bindParam(9, $pkn);
    $sql->bindParam(10, $bhsInd);
    $sql->bindParam(11, $mtk);
    $sql->bindParam(12, $bhsIng);
    $sql->bindParam(13, $sejInd);
    $sql->bindParam(14, $senbud);
    $sql->bindParam(15, $penjas);
    $sql->bindParam(16, $prakarya);
    $sql->bindParam(17, $mtk2);
    $sql->bindParam(18, $biologi);
    $sql->bindParam(19, $fisika);
    $sql->bindParam(20, $kimia);
    $sql->bindParam(21, $ekonomi);
    $sql->bindParam(22, $sosiologi);
    $sql->bindParam(23, $sasIng);
    $sql->bindParam(24, $geografi);
    $sql->bindParam(25, $rerata);
    $sql->bindParam(26, $jumlah);
    $sql->bindParam(27, $rank);
    $sql->bindParam(28, $sakit);
    $sql->bindParam(29, $ijin);
    $sql->bindParam(30, $alpa);
    $sql->bindParam(31, $agamaR);
    $sql->bindParam(32, $pknR);
    $sql->bindParam(33, $bhsIndR);
    $sql->bindParam(34, $mtkR);
    $sql->bindParam(35, $bhsIngR);
    $sql->bindParam(36, $sejIndR);
    $sql->bindParam(37, $senbudR);
    $sql->bindParam(38, $penjasR);
    $sql->bindParam(39, $prakaryaR);
    $sql->bindParam(40, $mtk2R);
    $sql->bindParam(41, $biologiR);
    $sql->bindParam(42, $fisikaR);
    $sql->bindParam(43, $kimiaR);
    $sql->bindParam(44, $ekonomiR);
    $sql->bindParam(45, $sosiologiR);
    $sql->bindParam(46, $sasIngR);
    $sql->bindParam(47, $geografiR);
    $sql->bindParam(48, $password);
    if(!$sql->execute()){
        print_r($sql->errorInfo());
    }else{
    ?>
        <script>
            swal({ 
                    title: "Berhasil",
                    text: "Data nilai berhasil diimport",
                    type: "success" 
                },
                    function(){
                        window.location.href = 'index.php?mod=raport&hal=ipa';
                });
        </script>
    <?php
    }
    }
    unlink($_FILES['berkas_excel']['name']);
}
?>
<div class="row">
    <div class="col-md-8 col-xs-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-upload"></i> Upload Nilai Kelas ipa</h3>
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
<div class="row">
    <div class="col-md-12 col-xs-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-file-text-o"></i> Daftar Nilai Kelas ipa</h3>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <?php
                        $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
                        $limit = 15;
                        $limit_start = ($page - 1) * $limit;
                        $sql = $db->prepare("SELECT * FROM rp_ipa ORDER BY ipa_kelas ASC LIMIT ".$limit_start.",".$limit."");
                        $sql->execute();
                        $no = $limit_start+1;
                    ?>
                    <table id="siswa" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>NIS</th>
                                <th>Nama Lengkap</th>
                                <th>Kelas</th>
                                <th>Tgl Lahir</th>
                                <th>Rerata</th>
                                <th>Jumlah Nilai</th>
                                <th>Peringkat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($sql->fetchAll() as $r){
                                $token = urlencode(encryptor('encrypt', $r['ipa_id']));
                            ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $r['ipa_nisn'];?></td>
                                <td><?= $r['ipa_nama'];?></td>
                                <td><?= $r['ipa_kelas'];?></td>
                                <td><?= $r['ipa_tglLahir'];?></td>
                                <td><?= $r['ipa_rerata'];?></td>
                                <td><?= $r['ipa_jumlah'];?></td>
                                <td><?= $r['ipa_rank'];?></td>
                                <td>
                                    <a target="_blank" href="../cetak/RaportIPA.php?tingal=<?=$token;?>" class="btn btn-info"><i class="fa fa-print"></i></a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <ul class="pagination">
                        <?php
                            if ($page == 1) { 
                        ?>
                        <li class="disabled"><a href="#">First</a></li>
                        <li class="disabled"><a href="#">&laquo;</a></li>
                        <?php
                            } else { // Jika buka page ke 1
                                $link_prev = ($page > 1) ? $page - 1 : 1;
                        ?>
                        <li><a href="index.php?mod=raport&hal=ipa&page=1">First</a></li>
                        <li><a href="index.php?mod=raport&hal=ipa&page=<?php echo $link_prev; ?>">&laquo;</a></li>
                        <?php
                            }
                        ?>
                        <!-- LINK NUMBER -->
                        <?php
                        // Buat query untuk menghitung semua jumlah data
                        $sql2 = $db->prepare("SELECT COUNT(*) FROM rp_ipa");
                        $sql2->execute(); // Eksekusi querynya
                        $jml = $sql2->fetchColumn();

                        $jumlah_page = ceil($jml / $limit); // Hitung jumlah halamanya
                        $jumlah_number = 3; // Tentukan jumlah link number sebelum dan sesudah page yang aktif
                        $start_number = ($page > $jumlah_number) ? $page - $jumlah_number : 1; // Untuk awal link member
                        $end_number = ($page < ($jumlah_page - $jumlah_number)) ? $page + $jumlah_number : $jumlah_page; // Untuk akhir link number

                        for ($i = $start_number; $i <= $end_number; $i++) {
                            $link_active = ($page == $i) ? 'class="active"' : '';
                        ?>
                        <li <?php echo $link_active; ?>><a href="index.php?mod=raport&hal=ipa&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                        <?php
                            }
                        ?>
                        <!-- LINK NEXT AND LAST -->
                        <?php
                        // Jika page sama dengan jumlah page, maka disable link NEXT nya
                        // Artinya page tersebut adalah page terakhir
                            if ($page == $jumlah_page) { // Jika page terakhir
                        ?>
                        <li class="disabled"><a href="#">&raquo;</a></li>
                        <li class="disabled"><a href="#">Last</a></li>
                        <?php
                            } else { // Jika bukan page terakhir
                            $link_next = ($page < $jumlah_page) ? $page + 1 : $jumlah_page;
                        ?>
                        <li><a href="index.php?mod=raport&hal=ipa&page=<?php echo $link_next; ?>">&raquo;</a></li>
                        <li><a href="index.php?mod=raport&hal=ipa&page=<?php echo $jumlah_page; ?>">Last</a></li>
                        <?php
                            }
                        ?>
                    </ul>
                    <p class="help-text">Jumlah Data: <span class="label bg-blue"><?= $jml?></span></p>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        var ot = $('#siswa').dataTable({"paging": false,"info": false,"ordering":false});
    });
</script>
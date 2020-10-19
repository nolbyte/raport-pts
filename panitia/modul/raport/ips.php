<?php
defined("RESMI") or die("error");
//password containt
$options = [
    'cost' => 24,
];

require '../config/excel_reader.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $target = basename($_FILES['berkas_excel']['name']) ;
    move_uploaded_file($_FILES['berkas_excel']['tmp_name'], $target);

    $data = new Spreadsheet_Excel_Reader($_FILES['berkas_excel']['name'],false);
    //menghitung jumlah baris file xls
    $baris = $data->rowcount($sheet_index=0);       
    //import data excel mulai baris ke-2 (karena tabel xls ada header pada baris 1)
    for ($i=2; $i <= $baris; $i++){  
    $nis        = $data->val($i, 1);
    $kelas      = $data->val($i, 2);
    $nama       = $data->val($i, 3);
    $tglLahir   = $data->val($i, 4);
    $walas      = $data->val($i, 5);
    $kkm        = $data->val($i, 6);
    $semester   = $data->val($i, 7);
    $agama      = $data->val($i, 8);
    $pkn        = $data->val($i, 9);
    $bhsInd     = $data->val($i, 10);
    $mtk        = $data->val($i, 11);
    $bhsIng     = $data->val($i, 12);
    $sejInd     = $data->val($i, 13);
    $senbud     = $data->val($i, 14);
    $penjas     = $data->val($i, 15);
    $prakarya   = $data->val($i, 16);
    $geografi   = $data->val($i, 17);
    $sejarah    = $data->val($i, 18);
    $sosiologi  = $data->val($i, 19);
    $ekonomi    = $data->val($i, 20);
    $biologi    = $data->val($i, 21);
    $kimia      = $data->val($i, 22);
    $bhsAr      = $data->val($i, 23);
    $rerata     = $data->val($i, 24);
    $jumlah     = $data->val($i, 25);
    $rank       = $data->val($i, 26);
    $sakit      = $data->val($i, 27);
    $ijin       = $data->val($i, 28);
    $alpa       = $data->val($i, 29);
    $agamaR     = $data->val($i, 30);
    $pknR       = $data->val($i, 31);
    $bhsIndR    = $data->val($i, 32);
    $mtkR       = $data->val($i, 33);
    $bhsIngR    = $data->val($i, 34);
    $sejIndR    = $data->val($i, 35);
    $senbudR    = $data->val($i, 36);
    $penjasR    = $data->val($i, 37);
    $prakaryaR  = $data->val($i, 38);
    $geografiR  = $data->val($i, 39);
    $sejarahR   = $data->val($i, 40);
    $sosiologiR = $data->val($i, 41);
    $ekonomiR   = $data->val($i, 42);
    $biologiR   = $data->val($i, 43);
    $kimiaR     = $data->val($i, 44);
    $bhsArR     = $data->val($i, 45);
    //$plainPassword = strval($jumlah);
    $password = password_hash($jumlah, PASSWORD_BCRYPT);
    $sql = $db->prepare("INSERT INTO rp_ips SET ips_nisn = ?, ips_kelas = ?, ips_nama = ?, ips_tglLahir = ?, ips_walas = ?, ips_kkm = ?, ips_semester = ?, ips_agama = ?, ips_pkn = ?, ips_bhsInd = ?, ips_mtk = ?, ips_bhsIng = ?, ips_sejarahInd = ?, ips_senbud = ?, ips_penjas = ?, ips_prakarya = ?, ips_geografi = ?, ips_sejarah = ?, ips_sosiologi = ?, ips_ekonomi = ?, ips_biologi = ?, ips_kimia = ?, ips_bhsAr = ?, ips_rerata = ?, ips_jumlah = ?, ips_rank = ?, ips_sakit = ?, ips_ijin = ?, ips_alpa = ?, ips_agamaR = ?, ips_pknR = ?, ips_bhsIndR = ?, ips_mtkR = ?, ips_bhsIngR = ?, ips_sejarahIndR = ?, ips_senbudR = ?, ips_penjasR = ?, ips_prakaryaR = ?, ips_geografiR = ?, ips_sejarahR = ?, ips_sosiologiR = ?, ips_ekonomiR = ?, ips_biologiR = ?, ips_kimiaR = ?, ips_bhsArR = ?, ips_password = ?");
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
    $sql->bindParam(17, $geografi);
    $sql->bindParam(18, $sejarah);
    $sql->bindParam(19, $sosiologi);
    $sql->bindParam(20, $ekonomi);
    $sql->bindParam(21, $biologi);    
    $sql->bindParam(22, $kimia);
    $sql->bindParam(23, $bhsAr);
    $sql->bindParam(24, $rerata);
    $sql->bindParam(25, $jumlah);
    $sql->bindParam(26, $rank);
    $sql->bindParam(27, $sakit);
    $sql->bindParam(28, $ijin);
    $sql->bindParam(29, $alpa);
    $sql->bindParam(30, $agamaR);
    $sql->bindParam(31, $pknR);
    $sql->bindParam(32, $bhsIndR);
    $sql->bindParam(33, $mtkR);
    $sql->bindParam(34, $bhsIngR);
    $sql->bindParam(35, $sejIndR);
    $sql->bindParam(36, $senbudR);
    $sql->bindParam(37, $penjasR);
    $sql->bindParam(38, $prakaryaR);
    $sql->bindParam(39, $geografiR);
    $sql->bindParam(40, $sejarahR);
    $sql->bindParam(41, $sosiologiR);
    $sql->bindParam(42, $ekonomiR);
    $sql->bindParam(43, $biologiR);
    $sql->bindParam(44, $kimiaR);
    $sql->bindParam(45, $bhsArR);
    $sql->bindParam(46, $password);
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
                        window.location.href = 'index.php?mod=raport&hal=ips';
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
<div class="row">
    <div class="col-md-12 col-xs-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-file-text-o"></i> Daftar Nilai Kelas IPS</h3>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <?php
                        $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
                        $limit = 15;
                        $limit_start = ($page - 1) * $limit;
                        $sql = $db->prepare("SELECT * FROM rp_ips ORDER BY ips_kelas, ips_nama ASC LIMIT ".$limit_start.",".$limit."");
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
                                $token = urlencode(encryptor('encrypt', $r['ips_id']));
                            ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $r['ips_nisn'];?></td>
                                <td><?= $r['ips_nama'];?></td>
                                <td><?= $r['ips_kelas'];?></td>
                                <td><?= $r['ips_tglLahir'];?></td>
                                <td><?= $r['ips_rerata'];?></td>
                                <td><?= $r['ips_jumlah'];?></td>
                                <td><?= $r['ips_rank'];?></td>
                                <td>
                                    <a target="_blank" href="../cetak/RaportIPS.php?tingal=<?=$token;?>" class="btn btn-info"><i class="fa fa-print"></i></a>
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
                        <li><a href="index.php?mod=raport&hal=ips&page=1">First</a></li>
                        <li><a href="index.php?mod=raport&hal=ips&page=<?php echo $link_prev; ?>">&laquo;</a></li>
                        <?php
                            }
                        ?>
                        <!-- LINK NUMBER -->
                        <?php
                        // Buat query untuk menghitung semua jumlah data
                        $sql2 = $db->prepare("SELECT COUNT(*) FROM rp_ips");
                        $sql2->execute(); // Eksekusi querynya
                        $jml = $sql2->fetchColumn();

                        $jumlah_page = ceil($jml / $limit); // Hitung jumlah halamanya
                        $jumlah_number = 3; // Tentukan jumlah link number sebelum dan sesudah page yang aktif
                        $start_number = ($page > $jumlah_number) ? $page - $jumlah_number : 1; // Untuk awal link member
                        $end_number = ($page < ($jumlah_page - $jumlah_number)) ? $page + $jumlah_number : $jumlah_page; // Untuk akhir link number

                        for ($i = $start_number; $i <= $end_number; $i++) {
                            $link_active = ($page == $i) ? 'class="active"' : '';
                        ?>
                        <li <?php echo $link_active; ?>><a href="index.php?mod=raport&hal=ips&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
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
                        <li><a href="index.php?mod=raport&hal=ips&page=<?php echo $link_next; ?>">&raquo;</a></li>
                        <li><a href="index.php?mod=raport&hal=ips&page=<?php echo $jumlah_page; ?>">Last</a></li>
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

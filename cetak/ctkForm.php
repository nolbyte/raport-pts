<?php
    session_start();
    define("RESMI", "OK");
    if(!isset($_SESSION['idSiswa']) && !isset($_SESSION['admID'])){
        header("Location: ../index.php");
    }

    //konfigurasi
    require('../config/database.php');
    require('../config/fungsi.php');
    if(isset($_GET['tingal']) && !empty($_GET['tingal'])){
        $cokot             = urldecode($_GET['tingal']);
        $buka              = encryptor('decrypt', $cokot);
        $q                 = $db->prepare("SELECT * FROM us_pendaftar up
                            LEFT JOIN us_ortu uo ON up.siswa_id=uo.ot_siswa
                            LEFT JOIN us_periodik upe ON up.siswa_id=upe.periodik_siswa
                            LEFT JOIN us_registrasi ur ON up.siswa_id=ur.register_siswa
                            LEFT JOIN us_jurusan uj ON up.siswa_jurusan=uj.jurusan_id
                            LEFT JOIN us_periode upr ON up.siswa_gelombang=upr.periode_id                        
                        WHERE up.siswa_id = :id");
        $q->execute(array(':id' => $buka));
        $c                = $q->fetch(PDO::FETCH_ASSOC);
        if($c === false){
            ?><script>swal("Galat", "Transaksi tidak dapat dilakukan", "error");</script><?php
        }
    }
    ob_start();
?>
<style type="text/css">
    .head{
        font-weight: bold;
        font-size: 14pt;
        text-align: center;
    }
    p{
        font-size: 10pt;
        text-align: left;
    }
    h3{
        font-weight: bold;
        font-size: 12pt;
        margin-top: 0px;
    }
    table{
        border: 0px;
        font-size: 11pt;
        text-align: left;
    }
    tr, td{
        border-bottom: 1px solid #dddddd;
        padding: 5px;
    }
    th{
        background-color: #44483D;
        padding-left: 10px;
        font-weight: bold;
        font-size: 12pt;
        color: #ffffff;
    }
</style>
<page style="font-size:11pt;font-family:times;">
    <?php
        $tgl = date("m/d/Y");
        $d = $db->prepare("SELECT sekolah_nama, sekolah_website FROM us_sekolah");
        $d->execute();
        $e = $d->fetch(PDO::FETCH_ASSOC);        
    ?>
    <div class="head">FORMULIR PESERTA DIDIK</div>    
    <table style="padding: 5px">
        <tr>
            <td style="width: 150px">Tanggal</td>
            <td style="width: 180px">: <?= tgl_id($c['siswa_tgl_daftar']);?></td>
            <td style="width: 130px;text-align: right;">No. Pendaftaran</td>
            <td style="width: 170px">: <?=$c['siswa_no_daftar'];?></td>
        </tr>
    </table>    
    <table>
        <tr>
            <th colspan="3">DATA PRIBADI</th>
        </tr>
        <tr>
            <td>1</td>
            <td style="width: 250px">Nama Lengkap</td>
            <td style="width: 450px">: <?=$c['siswa_nama'];?></td>
        </tr>
        <tr>
            <td>2</td>    
            <td>Jenis Kelamin</td>
            <td>: <?php 
                    if($c['siswa_kelamin'] === 'L'){
                        echo 'Laki-laki';
                    }else{
                        echo 'Perempuan';
                    }
                    ?>                    
            </td>
        </tr>
        <tr>
            <td>3</td>
            <td>NISN</td>
            <td>: <?=$c['siswa_nisn'];?></td>
        </tr>
        <tr>
            <td>4</td>
            <td>NIK/No. KITAS (untuk WNA)</td>
            <td>: <?=$c['siswa_nik'];?></td>
        </tr>
        <tr>
            <td>5</td>
            <td>No. KK</td>
            <td>: <?=$c['siswa_noKK'];?></td>
        </tr>
        <tr>
            <td>6</td>
            <td>Tempat lahir</td>
            <td>: <?=$c['siswa_tempatLahir'];?></td>            
        </tr>
        <tr>
            <td>7</td>
            <td>Tanggal lahir</td>
            <td>: <?=$c['siswa_tglLahir'];?></td>
        </tr>
        <tr>
            <td>8</td>
            <td>No. Registrasi Akta Lahir</td>
            <td>: <?=$c['siswa_noAktaLahir'];?></td>
        </tr>
        <tr>
            <td>9</td>
            <td>Agama & Kepercayaan</td>
            <td>: <?=$c['siswa_agama'];?></td>
        </tr>
        <tr>
            <td>10</td>
            <td>Kewarganegaraan</td>
            <td>: <?=$c['siswa_kewarganegaraan'];?></td>
        </tr>
        <tr>
            <td>11</td>
            <td>Berkebutuhan khusus</td>
            <td>: <?=$c['siswa_kebutuhan'];?></td>
        </tr>
        <tr>
            <td>12</td>
            <td>Alamat Jalan</td>
            <td>: <?=$c['siswa_alamat_jln'];?></td>
        </tr>
        <tr>
            <td>13</td>
            <td>RT</td>
            <td>: <?=$c['siswa_rt'];?></td>
        </tr>
        <tr>
            <td>14</td>
            <td>RW</td>
            <td>: <?=$c['siswa_rw'];?></td>
        </tr>
        <tr>
            <td>15</td>
            <td>Nama Dusun</td>
            <td>: <?=$c['siswa_dusun'];?></td>
        </tr>
        <tr>
            <td>16</td>
            <td>Nama Kelurahan/Desa</td>
            <td>: <?=$c['siswa_kelurahan'];?></td>
        </tr>
        <tr>
            <td>17</td>
            <td>Kecamatan</td>
            <td>: <?=$c['siswa_kecamatan'];?></td>
        </tr>
        <tr>
            <td>18</td>
            <td>Kode Pos</td>
            <td>: <?=$c['siswa_kode_pos'];?></td>
        </tr>
        <tr>
            <td>19</td>
            <td>Lintang</td>
            <td>: <?=$c['siswa_lintang'];?></td>
        </tr>
        <tr>
            <td>20</td>
            <td>Bujur</td>
            <td>: <?=$c['siswa_bujur'];?></td>
        </tr>
        <tr>
            <td>21</td>
            <td>Tempat Tinggal</td>
            <td>: <?=$c['siswa_tinggal'];?></td>
        </tr>
        <tr>
            <td>22</td>
            <td>moda Transportasi</td>
            <td>: <?= $c['siswa_transport'];?></td>
        </tr>
        <tr>
            <td>23</td>
            <td>Anak keberapa</td>
            <td>: <?=$c['siswa_anak_ke'];?></td>
        </tr>
        <tr>
            <td>24</td>
            <td>Apakah punya KIP</td>
            <td>: <?=$c['siswa_kip'];?></td>
        </tr>
        <tr>
            <td style="vertical-align: top">25</td>
            <td style="vertical-align: top">Apakah peserta didik tersebut<br> tetap akan menerima KIP</td>
            <td style="vertical-align: top">: <?=$c['siswa_status_kip'];?></td>
        </tr>
        <tr>
            <td>26</td>
            <td>Alasan menolak KIP</td>
            <td>: <?=$c['siswa_alasan_kip'];?></td>
        </tr>
        <tr>
            <th colspan="3">DATA AYAH KANDUNG</th>
        </tr>
        <tr>
            <td>27</td>
            <td>Nama Ayah Kandung</td>
            <td>: <?=$c['ot_nama_ayah'];?></td>
        </tr>
        <tr>
            <td>28</td>
            <td>NIK Ayah</td>
            <td>: <?=$c['ot_nik_ayah'];?></td>
        </tr>
        <tr>
            <td>29</td>
            <td>Tahun lahir</td>
            <td>: <?=$c['ot_thn_lahir_ayah'];?></td>
        </tr>
        <tr>
            <td>30</td>
            <td>Pendidikan</td>
            <td>: <?=$c['ot_pendidikan_ayah'];?></td>
        </tr>
        <tr>
            <td>31</td>
            <td>Pekerjaan</td>
            <td>: <?=$c['ot_pekerjaan_ayah'];?></td>
        </tr>
        <tr>
            <td>32</td>
            <td>Penghasilan bulanan</td>
            <td>: <?=$c['ot_gaji_ayah'];?></td>
        </tr>
        <tr>
            <td>33</td>
            <td>Berkebutuhan Khusus</td>
            <td>: <?=$c['ot_kebutuhan_ayah'];?></td>
        </tr>
    </table>    
    </page>
    <page style="font-size:11pt;font-family:times;">
    <table style="padding-top: 5px">    
        <tr>
            <th colspan="3">DATA IBU KANDUNG</th>
        </tr>
        <tr>
            <td>34</td>
            <td style="width: 250px">Nama Ibu Kandung</td>
            <td style="width: 450px">: <?=$c['ot_nama_ibu'];?></td>
        </tr>
        <tr>
            <td>35</td>
            <td>NIK Ibu</td>
            <td>: <?=$c['ot_nik_ibu'];?></td>
        </tr>
        <tr>
            <td>36</td>
            <td>Tahun Lahir</td>
            <td>: <?=$c['ot_thn_lahir_ibu'];?></td>
        </tr>
        <tr>
            <td>37</td>
            <td>Pendidikan</td>
            <td>: <?=$c['ot_pendidikan_ibu'];?></td>
        </tr>
        <tr>
            <td>38</td>
            <td>Pekerjaan</td>
            <td>: <?=$c['ot_pekerjaan_ibu'];?></td>
        </tr>
        <tr>
            <td>39</td>
            <td>Penghasilan bulanan</td>
            <td>: <?=$c['ot_gaji_ibu'];?></td>
        </tr>
        <tr>
            <td>40</td>
            <td>Berkebutuhan Khusus</td>
            <td>: <?=$c['ot_kebutuhan_ibu'];?></td>
        </tr>        
        <tr>
            <th colspan="3">DATA WALI</th>
        </tr>
        <tr>
            <td>41</td>
            <td>Nama Wali</td>
            <td>: <?=$c['ot_nama_wali'];?></td>
        </tr>
        <tr>
            <td>42</td>
            <td>NIK Wali</td>
            <td>: <?=$c['ot_nik_wali'];?></td>
        </tr>
        <tr>
            <td>43</td>
            <td>Tahun Lahir</td>
            <td>: <?=$c['ot_thn_lahir_wali'];?></td>
        </tr>
        <tr>
            <td>44</td>
            <td>Pendidikan</td>
            <td>: <?=$c['ot_pendidikan_wali'];?></td>
        </tr>
        <tr>
            <td>45</td>
            <td>Pekerjaan</td>
            <td>: <?=$c['ot_pekerjaan_wali'];?></td>
        </tr>
        <tr>
            <td>46</td>
            <td>Penghasilan bulanan</td>
            <td>: <?=$c['ot_gaji_wali'];?></td>
        </tr>
        <tr>
            <th colspan="3">KONTAK</th>
        </tr>
        <tr>
            <td>47</td>
            <td>Nomor telepon Rumah</td>
            <td>: <?=$c['siswa_telp_rmh'];?></td>
        </tr>
        <tr>
            <td>48</td>
            <td>Nomor HP</td>
            <td>: <?=$c['siswa_hp'];?></td>
        </tr>
        
        <tr>
            <th colspan="3">DATA PERIODIK</th>
        </tr>
        <tr>
            <td>1</td>
            <td>Tinggi Badan</td>
            <td>: <?=$c['periodik_tinggi_badan'];?> cm</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Berat Badan</td>
            <td>: <?=$c['periodik_berat_badan'];?> kg</td>
        </tr>
        <tr>
            <td>3</td>
            <td>Lingkar Kepala</td>
            <td>: <?=$c['periodik_lingkar_kpl'];?> cm</td>
        </tr>
        <tr>
            <td>4</td>
            <td>Jarak tempat tinggal ke sekolah</td>
            <td>: <?=$c['periodik_jarak'];?></td>
        </tr>
        <tr>
            <td>5</td>
            <td>Sebutkan (dalam kilometer)</td>
            <td>: <?=$c['periodik_jml_jarak'];?> km</td>
        </tr>
        <tr>
            <td>6</td>
            <td>Waktu tempuh ke sekolah</td>
            <td>: <?=$c['periodik_waktu_jam'].' jam '.$c['periodik_waktu_menit'];?> menit</td>
        </tr>
        <tr>
            <td>7</td>
            <td>Jumlah Saudara Kandung</td>
            <td>: <?=$c['periodik_jml_saudara'];?></td>
        </tr>        
        <tr>
            <th colspan="3">PRESTASI</th>
        </tr>
        <tr>
            <td colspan="3">
                <?php
                    $pr = $db->prepare("SELECT * FROM us_prestasi WHERE prestasi_siswa = :id");
                    $pr->execute(array(':id' => $_SESSION['idSiswa']));
                    $row = $pr->fetchAll();
                    $no = 1;
                ?>
                <table style="border: 0px">                    
                    <tr>
                        <td style="font-weight: bold">No.</td>
                        <td style="font-weight: bold">Jenis</td>
                        <td style="font-weight: bold">Tingkat</td>
                        <td style="font-weight: bold">Nama Prestasi</td>
                        <td style="font-weight: bold">Tahun</td>
                        <td style="font-weight: bold">Penyelenggara</td>
                        <td style="font-weight: bold">Peringkat</td>
                    </tr>
                <?php 
                    if(!$row){ ?>
                    <tr>
                        <td colspan="7">Data Prestasi atas nama <?=$_SESSION['nama'];?> tidak ditemukan.</td>
                    </tr>
                <?php
                    }else{
                    foreach($row as $row){ ?>
                    <tr>
                        <td><?=$no++;?></td>
                        <td><?=$row['prestasi_jenis'];?></td>
                        <td><?=$row['prestasi_tingkat'];?></td>
                        <td><?=$row['prestasi_nama'];?></td>
                        <td><?=$row['prestasi_thn'];?></td>
                        <td><?=$row['prestasi_panitia'];?></td>
                        <td><?=$row['prestasi_peringkat'];?></td>
                    </tr>                
                <?php } } ?>
                </table>
            </td>
        </tr>
        <tr>
            <th colspan="3">BEASISWA</th>
        </tr>
        <tr>
            <td colspan="3">
                <?php
                    $bb = $db->prepare("SELECT * FROM us_beasiswa WHERE beasiswa_siswa = :idS");
                    $bb->execute(array(':idS' => $_SESSION['idSiswa']));
                    $rw = $bb->fetchAll();
                    $no = 1;
                ?>
                <table style="border: 0px">
                    <tr>
                        <td style="font-weight: bold">No</td>
                        <td style="font-weight: bold">Jenis Beasiswa</td>
                        <td style="font-weight: bold">Keterangan</td>
                        <td style="font-weight: bold">Tahun Mulai</td>
                        <td style="font-weight: bold">Tahun Selesai</td>
                    </tr>
                <?php if(!$rw){ ?>
                    <tr>
                        <td colspan="5">Data Beasiswa atas nama <?=$_SESSION['nama'];?> tidak ditemukan.</td>
                    </tr>
                <?php
                    }else{
                    foreach($rw as $row){
                ?>
                    <tr>
                        <td><?=$no++;?></td>
                        <td><?=$row['beasiswa_jenis'];?></td>
                        <td><?=$row['beasiswa_keterangan'];?></td>
                        <td><?=$row['beasiswa_thn_mulai'];?></td>
                        <td><?=$row['beasiswa_thn_selesai'];?></td>
                    </tr>
                <?php } } ?>
                </table>
            </td>
        </tr>
        <tr>
            <th colspan="3">KESEJAHTERAAN PESERTA DIDIK</th>
        </tr>
        <tr>
            <td></td>
            <td>Jenis Kesejahteraan</td>
            <td>: <?=$c['siswa_krt_sejahtera'];?></td>
        </tr>
        <tr>
            <td></td>
            <td>No. Kartu</td>
            <td>: <?=$c['siswa_krt_no'];?></td>
        </tr>
        <tr>
            <td></td>
            <td>Nama di kartu</td>
            <td>: <?=$c['siswa_krt_nama'];?></td>
        </tr>
    </table>    
</page>
<page style="font-size:11pt;font-family:times;">
    <table style="padding-top: 5px">
        <tr>
            <th colspan="3">REGISTRASI PESERTA DIDIK</th>
        </tr>
        <tr>
            <td>1</td>
            <td style="width: 250px">Kompetensi Keahlian</td>
            <td style="width: 450px">: <?=$c['jurusan_nama'];?></td>
        </tr>
        <tr>
            <td>2</td>
            <td>Jenis Pendaftaran</td>
            <td>: <?=$c['siswa_jenis_daftar'];?></td>
        </tr>
        <tr>
            <td>3</td>
            <td>NIS/Nomor Induk PD</td>
            <td>: </td>
        </tr>
        <tr>
            <td>4</td>
            <td>Tanggal Masuk Sekolah</td>
            <td>: </td>
        </tr>
        <tr>
            <td>5</td>
            <td>Sekolah Asal</td>
            <td>: <?=$c['register_sekolah'];?></td>
        </tr>
        <tr>
            <td>6</td>
            <td>No. Peserta UN SMp/MTS</td>
            <td>: <?=$c['register_no_un'];?></td>
        </tr>
        <tr>
            <td>7</td>
            <td>No. Seri Ijazah SMP/MTS</td>
            <td>: <?=$c['register_no_ijazah'];?></td>
        </tr>
        <tr>
            <td>8</td>
            <td>No. SKHUN SMP/MTS</td>
            <td>: <?=$c['register_no_skhun'];?></td>
        </tr>
    </table>
    <table style="padding-top: 5px">
		<tr>
			<th colspan="3">SURVEY PPDB</th>
		</tr>
		<tr>
			<td>1</td>
			<td style="width: 250px">Informasi PPDB</td>
			<td style="width: 450px">: <?= $c['siswa_survey'];?></td>
		</tr>
    </table>
    <p></p>
    <table style="width: 100%;border: 0px;">
        <tr>
            <td style="width: 50%; border: 0px;text-align: center">
                <br>
                Orang Tua/Wali Siswa<br><br><br><br><br><br>
                __________________________
            </td>
            <td style="width: 50%; border: 0px;text-align: center">
                Jakarta, <?= tgl_id($c['siswa_tgl_daftar']);?><br>
                Calon Siswa<br><br><br><br><br><br>
                <?=$c['siswa_nama'];?>
            </td>
        </tr>
    </table>        
</page>
<?php
    $content = ob_get_clean();
    // convert to PDF
    require_once(dirname(__FILE__).'/html2pdf4/html2pdf.class.php');
    try
        {
            $html2pdf = new HTML2PDF('P', 'Legal', 'en', true, 'UTF-8', array(5, 5, 10, 15));
            $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
            //$html2pdf->createIndex('Sommaire', 25, 12, false, true, 1);
            $html2pdf->Output('Formulir PPDB Online -'.$e['sekolah_nama'].'.pdf');
        }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
?>
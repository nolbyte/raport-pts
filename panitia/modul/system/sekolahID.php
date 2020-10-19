<?php
    defined("RESMI") or die("error");
    //ambil data sekolah
    $sql = $db->prepare("SELECT * FROM rp_sekolah");
    $sql->execute();
    $s = $sql->fetch(PDO::FETCH_ASSOC);
?>
<div class="row">
    <div class="col-md-10">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-home"></i> Identitas Sekolah</h3>
            </div>
            <div class="box-body">
                <form method="post" action="" class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nama Sekolah</label>
                        <div class="col-sm-5">
                            <input type="hidden" name="<?=$token_id ?>" value="<?= $token_value ?>">
                            <input type="hidden" name="skl_id" value="<?=$s['skl_id'];?>">
                            <input type="text" name="sekolah" class="form-control" value="<?=$s['skl_nama'];?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Alamat Sekolah</label>
                        <div class="col-sm-5">
                            <input type="text" name="alamat" class="form-control" value="<?=$s['skl_alamat']?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Website Sekolah</label>
                        <div class="col-sm-5">
                            <input type="text" name="website" class="form-control" value="<?=$s['skl_website']?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Kepala Sekolah</label>
                        <div class="col-sm-5">
                            <input type="text" name="kepsek" class="form-control" value="<?=$s['skl_kepsek']?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tahun Pelajaran</label>
                        <div class="col-sm-5">
                            <input type="text" name="thnP" class="form-control" value="<?= $s['skl_thnP'] ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tanggal Pembagian Raport</label>
                        <div class="col-sm-5">
                            <input type="text" name="tglSK" class="form-control" value="<?= $s['skl_tglSK'] ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"></label>
                        <div class="col-sm-5">
                            <button type="submit" class="btn btn-info" name="simpan"><i class="fa fa-floppy-o"></i> Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
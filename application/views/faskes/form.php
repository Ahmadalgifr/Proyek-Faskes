<div class="row">
    <div class="col-md-12">
        <?= $this->session->flashdata("mess") ?>
    </div>
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Form <?= $detail ? 'Ubah' : 'Tambah' ?></h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama">Jenis Faskes</label>
                        <select name="jenis_faskes" id="jenis_faskes" class="form-control">
                            <?php foreach ($jenis_faskes as $key => $value) :
                            $selected = $detail ? ($value->id === $detail->jenis_id ? 'selected' : '') : '';
                            ?>
                            <option value="<?=$value->id?>" <?=$selected?>><?=$value->nama?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" name="nama" id="nama" value="<?=$detail ? $detail->nama : ''?>" placeholder="Masukkan Nama">
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" name="alamat" id="alamat" value="<?=$detail ? $detail->alamat : ''?>" placeholder="Masukkan Alamat">
                    </div>
                    <div class="form-group">
                        <label for="latlong">Latitude Longitude</label>
                        <input type="text" class="form-control w-50" name="latlong" id="latlong" value="<?=$detail ? $detail->latlong : ''?>">
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <input type="text" class="form-control" name="deskripsi" id="deskripsi" value="<?=$detail ? $detail->deskripsi : ''?>" placeholder="Masukkan Deskripsi">
                    </div>
                    <div class="form-group">
                        <label for="skor_rating">Skor Rating</label>
                        <input type="number" class="form-control" name="skor_rating" id="skor_rating" value="<?=$detail ? $detail->skor_rating : ''?>" placeholder="Masukkan Skor Rating">
                    </div>
                    <div class="form-group">
                        <label for="kecamatan_id">Kecamatan</label>
                        <select name="kecamatan_id" id="kecamatan_id" class="form-control">
                            <?php foreach ($kecamatan as $key => $value) :
                            $selected = $detail ? ($value->id === $detail->kecamatan_id ? 'selected' : '') : '';
                            ?>
                            <option value="<?=$value->id?>" <?=$selected?>><?=$value->nama?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="website">Website</label>
                        <input type="text" class="form-control" name="website" id="website" value="<?=$detail ? $detail->website : ''?>" placeholder="Masukkan Website">
                    </div>
                    <div class="form-group">
                        <label for="jumlah_dokter">Jumlah Dokter</label>
                        <input type="text" class="form-control" name="jumlah_dokter" id="jumlah_dokter" value="<?=$detail ? $detail->jumlah_dokter : ''?>" placeholder="Masukkan Jumlah Dokter">
                    </div>
                    <div class="form-group">
                        <label for="jumlah_pegawai">Jumlah Pegawai</label>
                        <input type="text" class="form-control" name="jumlah_pegawai" id="jumlah_pegawai" value="<?=$detail ? $detail->jumlah_pegawai : ''?>" placeholder="Masukkan Jumlah Dokter">
                    </div>
                    <div class="form-group">
                        <label for="foto1">Foto 1</label>
                        <input type="file" class="d-block" name="foto1" id="foto1" accept="image/*">
                    </div>
                    <div class="form-group">
                        <label for="foto2">Foto 2</label>
                        <input type="file" class="d-block" name="foto2" id="foto2" accept="image/*">
                    </div>
                    <div class="form-group">
                        <label for="foto3">Foto 3</label>
                        <input type="file" class="d-block" name="foto3" id="foto3" accept="image/*">
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer float-right">
                    <a href="<?= base_url('admin/faskes') ?>" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i></a>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
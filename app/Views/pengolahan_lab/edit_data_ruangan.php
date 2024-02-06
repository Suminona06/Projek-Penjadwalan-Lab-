<?= $this->extend('backend/layout/pages-layout'); ?>
<?= $this->section('content'); ?>

<div class="container mt-5">
    <div class="row">
        <div class="col">
            <h2 class="mb-3">Form Edit Data Ruangan</h2>
            <form action="/admin/update_data_ruangan/<?= $ruangan['id_ruangan']; ?>" method="POST">
                <input type="hidden" class="form-control" id="id" name="id" value="value=" <?= $ruangan['id_ruangan']; ?>">
                <div class=" row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Ruangan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama_ruangan" name="nama_ruangan"
                            value="<?= $ruangan['nama_ruangan']; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Keterangan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="keterangan" name="keterangan"
                            value="<?= $ruangan['keterangan'] ?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Lokasi</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="lokasi" name="lokasi"
                            value="<?= $ruangan['id_ruangan'] ?>">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Data</button>
            </form>
        </div>
    </div>

</div>


<?= $this->endSection(); ?>
<?= $this->extend('backend/layout/pages-layout'); ?>
<?= $this->section('content'); ?>

<div class="container mt-5">
    <div class="row">
        <div class="col">
            <h2 class="mb-3">Form Edit Data Hardware</h2>
            <form action="/admin/update_data_hardware/<?= $hardware['id']; ?>" method="POST">
                <input type="hidden" class="form-control" id="id" name="id" value="value=" <?= $hardware['id']; ?>">
                <div class=" row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Gambar</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="gambar" name="gambar"
                            value="<?= $hardware['gambar']; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Keterangan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="keterangan" name="keterangan"
                            value="<?= $hardware['keterangan'] ?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Ruangan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="id_ruangan" name="id_ruangan"
                            value="<?= $hardware['id_ruangan'] ?>">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Data</button>
            </form>
        </div>
    </div>

</div>


<?= $this->endSection(); ?>
<?= $this->extend('backend/layout/pages-layout'); ?>
<?= $this->section('content'); ?>

<div class="container mt-5">
    <div class="row">
        <div class="col">
            <h2 class="mb-3">Form Edit Data Unit</h2>
            <form action="/admin/update_data_unit/<?= $unit['id_unit']; ?>" method="POST">
                <input type="hidden" class="form-control" id="id_unit" name="id_unit" value="value=<?= $unit['id_unit']; ?>">


                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Kode Unit</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="kode_unit" name="kode_unit" value="<?= $unit['kode_unit'] ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Unit</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama_unit" name="nama_unit" value="<?= $unit['nama_unit'] ?>">
                    </div>
                </div>


                <button type="submit" class="btn btn-primary">Simpan Data</button>
            </form>
        </div>
    </div>

</div>


<?= $this->endSection(); ?>
<?= $this->extend('backend/layout/pages-layout'); ?>
<?= $this->section('content'); ?>

<div class="container mt-5">
    <div class="row">
        <div class="col">
            <h2 class="mb-3">Form Tambah Foto</h2>
            <form action="/admin/save_data_galeri" method="POST">
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Gambar</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="foto" name="foto" value="">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Ruangan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="id_ruangan" name="id_ruangan" value="">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Tambah Data</button>
            </form>
        </div>
    </div>

    <?= $this->endSection(); ?>
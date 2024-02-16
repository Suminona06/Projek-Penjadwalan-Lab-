<?= $this->extend('backend/layout/pages-layout'); ?>
<?= $this->section('content'); ?>

<div class="container mt-5">
    <div class="row">
        <div class="col">
            <h2 class="mb-3">Form Tambah Data Tahun Ajaran</h2>
            <form action="/admin/save_data_ta" method="POST">
            <div class="form-group">
            <label for="thn_awal">Tahun Awal</label>
            <input type="text" class="form-control" id="thn_awal" name="thn_awal">
        </div>
        <div class="form-group">
            <label for="thn_akhir">Tahun Akhir</label>
            <input type="text" class="form-control" id="thn_akhir" name="thn_akhir">
        </div>
        <div class="form-group">
            <label for="semester">Semester</label>
            <input type="text" class="form-control" id="semester" name="semester">
        </div>

                <button type="submit" class="btn btn-primary">Tambah Data</button>
            </form>
        </div>
    </div>

    <?= $this->endSection(); ?>


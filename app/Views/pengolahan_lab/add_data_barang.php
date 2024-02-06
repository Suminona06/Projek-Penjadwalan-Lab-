<?= $this->extend('backend/layout/pages-layout'); ?>
<?= $this->section('content'); ?>

<div class="container mt-5">
    <div class="row">
        <div class="col">
            <h2 class="mb-3">Form Tambah Data Barang</h2>
            <form action="/admin/save_data_barang" method="POST">
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Barang</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Serial Number</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="serialnumber" name="serialnumber" value="">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Supplier</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="supplier" name="supplier">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Brand</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="brand" name="brand" value="">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Model</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="model" name="model" value="">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Penanggung Jawab</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="penanggungjawab" name="penanggungjawab" value="">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Tambah Data</button>
            </form>
        </div>
    </div>

    <?= $this->endSection(); ?>
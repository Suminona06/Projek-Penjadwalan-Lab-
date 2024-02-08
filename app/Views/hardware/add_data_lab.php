<?= $this->extend('backend/layout/pages-layout'); ?>
<?= $this->section('content'); ?>

<div class="container mt-5">
    <div class="row">
        <div class="col">
            <h2 class="mb-3">Form Tambah Data Hardware</h2>
            <form action="/admin/save_data_lab9" method="POST">
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">No Pc</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="no_pc" name="no_pc" value="" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Nama Pc</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama_pc" name="nama_pc">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Windows</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="windows" name="windows" value="">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Processor</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="processor" name="processor" value="">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Ram</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="ram" name="ram" value="">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Mouse</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="mouse" name="mouse" value="">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Keyboard</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="keyboard" name="keyboard" value="">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Tambah Data</button>
            </form>
        </div>
    </div>

    <?= $this->endSection(); ?>
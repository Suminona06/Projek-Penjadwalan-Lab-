<?= $this->extend('backend/layout/pages-layout'); ?>
<?= $this->section('content'); ?>

<div class="container mt-5">
    <div class="row">
        <div class="col">
            <h2 class="mb-3">Form Tambah Data Hardware</h2>
            <form action="/admin/update_data_lab9/<?= $hardware['id_galeri']; ?>" method="POST">
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">No Pc</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="no_pc" name="no_pc"
                            value=" <?= $hardware['no_pc']; ?>" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Nama Pc</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama_pc" name="nama_pc"
                            value=" <?= $hardware['nama_pc']; ?>" required>>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Windows</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="windows" name="windows"
                            value=" <?= $hardware['windows']; ?>" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Processor</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="processor" name="processor"
                            value=" <?= $hardware['processor']; ?>" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Ram</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="ram" name="ram" value=" <?= $hardware['ram']; ?>"
                            required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Mouse</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="mouse" name="mouse"
                            value=" <?= $hardware['mouse']; ?>" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Keyboard</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="keyboard" name="keyboard"
                            value=" <?= $hardware['keyboard']; ?>" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Tambah Data</button>
            </form>
        </div>
    </div>

    <?= $this->endSection(); ?>
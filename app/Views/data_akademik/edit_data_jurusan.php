<?= $this->extend('backend/layout/pages-layout'); ?>
<?= $this->section('content'); ?>

<div class="container mt-5">
    <div class="row">
        <div class="col">
            <h2 class="mb-3">Form Edit Data Jurusan</h2>
            <form action="/admin/update_data_jurusan/<?= $jurusan['id_jurusan']; ?>" method="POST">
                <input type="hidden" class="form-control" id="id_jurusan" name="id_jurusan" value="value=<?= $jurusan['id_jurusan']; ?>">


                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Jurusan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama_jurusan" name="nama_jurusan" value="<?= $jurusan['nama_jurusan'] ?>">
                    </div>
                </div>


                <button type="submit" class="btn btn-primary">Simpan Data</button>
            </form>
        </div>
    </div>

</div>


<?= $this->endSection(); ?>
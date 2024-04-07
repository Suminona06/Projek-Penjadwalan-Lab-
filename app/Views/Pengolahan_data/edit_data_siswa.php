<?= $this->extend('backend/layout/pages-layout'); ?>
<?= $this->section('content'); ?>

<div class="container mt-5">
    <div class="row">
        <div class="col">
            <h2 class="mb-3">Form Edit Data Siswa</h2>
            <?php $validation = \Config\Services::validation(); ?>
            <form action="/admin/update_data_siswa/<?= $siswa['id']; ?>" method="POST">
                <?= csrf_field() ?>
                <div class="row mb-3">
                    <input type="hidden" class="form-control" id="id" name="id" value=" <?= $siswa['id']; ?>">

                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap"
                            value=" <?= $siswa['nama_lengkap']; ?>" required>
                    </div>
                </div>
                <?php if ($validation->getError('nama_lengkap')): ?>
                    <div class="d-block text-danger " style="margin-top:-10px;margin-bottom:15px;margin-left:180px;">
                        <?= $validation->getError('nama_lengkap'); ?>
                    </div>
                <?php endif; ?>
                <div class="row mb-3">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin"
                            value=" <?= $siswa['jenis_kelamin']; ?>" required>
                    </div>
                </div>
                <?php if ($validation->getError('jenis_kelamin')): ?>
                    <div class="d-block text-danger " style="margin-top:-10px;margin-bottom:15px;margin-left:180px;">
                        <?= $validation->getError('jenis_kelamin'); ?>
                    </div>
                <?php endif; ?>
                <div class="row mb-3">
                    <label for="jurusan" class="col-sm-2 col-form-label">Jurusan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="juruusan_pkl" name="juruusan_pkl"
                            value=" <?= $siswa['juruusan_pkl']; ?>" required>
                    </div>
                </div>
                <?php if ($validation->getError('juruusan_pkl')): ?>
                    <div class="d-block text-danger " style="margin-top:-10px;margin-bottom:15px;margin-left:180px;">
                        <?= $validation->getError('juruusan_pkl'); ?>
                    </div>
                <?php endif; ?>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Asal Sekolah</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="asal_sekolah" name="asal_sekolah"
                            value=" <?= $siswa['asal_sekolah']; ?>" required>
                    </div>
                </div>
                <?php if ($validation->getError('asal_sekolah')): ?>
                    <div class="d-block text-danger " style="margin-top:-10px;margin-bottom:15px;margin-left:180px;">
                        <?= $validation->getError('asal_sekolah'); ?>
                    </div>
                <?php endif; ?>

                <button type="submit" class="btn btn-primary"
                    onclick="return confirm('Apakah Anda yakin ingin mengedit data ini?');">Tambah Data</button>
            </form>
        </div>
    </div>

    <?= $this->endSection(); ?>
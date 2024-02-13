<?= $this->extend('backend/layout/pages-layout'); ?>
<?= $this->section('content'); ?>

<div class="container mt-5">
    <div class="row">
        <div class="col">
            <h2 class="mb-3">Form Tambah Data Siswa</h2>
            <?php $validation = \Config\Services::validation(); ?>
            <form action="/admin/save_data_siswa" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <?php if (!empty(session()->getFlashdata('success'))): ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata('succes'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <spance aria-hidden="true">&times;</spance>
                        </button>
                    </div>
                <?php endif; ?>

                <?php if (!empty(session()->getFlashdata('fail'))): ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('fail'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <spance aria-hidden="true">&times;</spance>
                        </button>
                    </div>
                <?php endif; ?>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="">
                    </div>
                </div>
                <?php if ($validation->getError('nama_lengkap')): ?>
                    <div class="d-block text-danger " style="margin-top:-10px;margin-bottom:15px;margin-left:180px;">
                        <?= $validation->getError('nama_lengkap'); ?>
                    </div>
                <?php endif; ?>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin" value="">
                    </div>
                </div>
                <?php if ($validation->getError('jenis_kelamin')): ?>
                    <div class="d-block text-danger " style="margin-top:-10px;margin-bottom:15px;margin-left:180px;">
                        <?= $validation->getError('jenis_kelamin'); ?>
                    </div>
                <?php endif; ?>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Jurusan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="juruusan_pkl" name="juruusan_pkl" value="">
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
                        <input type="text" class="form-control" id="asal_sekolah" name="asal_sekolah" value="">
                    </div>
                </div>
                <?php if ($validation->getError('asal_sekolah')): ?>
                    <div class="d-block text-danger " style="margin-top:-10px;margin-bottom:15px;margin-left:180px;">
                        <?= $validation->getError('asal_sekolah'); ?>
                    </div>
                <?php endif; ?>
                <button type="submit" class="btn btn-primary">Tambah Data</button>
            </form>
        </div>
    </div>

    <?= $this->endSection(); ?>
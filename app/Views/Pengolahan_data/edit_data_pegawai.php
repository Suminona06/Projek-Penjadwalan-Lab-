<?= $this->extend('backend/layout/pages-layout'); ?>
<?= $this->section('content'); ?>

<div class="container mt-5">
    <div class="row">
        <div class="col">
            <h2 class="mb-3">Form Edit Data Pegawai</h2>
            <?php $validation = \Config\Services::validation(); ?>
            <form action="/admin/update_data_pegawai/<?= $pegawai['id']; ?>" method="POST">
                <?= csrf_field() ?>
                <div class="row mb-3">
                    <input type="hidden" class="form-control" id="id" name="id" value=" <?= $pegawai['id']; ?>" <div
                        class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama" name="nama" value=" <?= $pegawai['nama']; ?>"
                            required>
                    </div>
                </div>
                <?php if ($validation->getError('nama')): ?>
                    <div class="d-block text-danger " style="margin-top:-10px;margin-bottom:15px;margin-left:180px;">
                        <?= $validation->getError('nama'); ?>
                    </div>
                <?php endif; ?>
                <div class="row mb-3">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">NIP</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nip" name="nip" value=" <?= $pegawai['nip']; ?>"
                            required>
                    </div>
                </div>
                <?php if ($validation->getError('nip')): ?>
                    <div class="d-block text-danger " style="margin-top:-10px;margin-bottom:15px;margin-left:180px;">
                        <?= $validation->getError('nip'); ?>
                    </div>
                <?php endif; ?>
                <div class="row mb-3">
                    <label for="jurusan" class="col-sm-2 col-form-label">Id ruangan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="id_ruangan" name="id_ruangan"
                            value=" <?= $pegawai['id_ruangan']; ?>" required>
                    </div>
                </div>
                <?php if ($validation->getError('id_ruangan')): ?>
                    <div class="d-block text-danger " style="margin-top:-10px;margin-bottom:15px;margin-left:180px;">
                        <?= $validation->getError('id_ruangan'); ?>
                    </div>
                <?php endif; ?>

                <button type="submit" class="btn btn-primary"
                    onclick="return confirm('Apakah Anda yakin ingin mengedit data ini?');">Simpan Data</button>
            </form>
        </div>
    </div>

    <?= $this->endSection(); ?>
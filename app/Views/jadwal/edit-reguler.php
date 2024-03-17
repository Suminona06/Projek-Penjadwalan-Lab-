<?= $this->extend('backend/layout/pages-layout'); ?>
<?= $this->section('content'); ?>

<div class="container mt-5">
    <div class="row">
        <div class="col">
            <h2 class="mb-3">Form Edit Data Jadwal</h2>
            <?php $validation = \Config\Services::validation(); ?>
            <form action="/admin/jadwal-update/<?= $jadwal['id_jadwal']; ?>" method="POST"
                enctype="multipart/form-data">
                <?= csrf_field() ?>
                <?php if (!empty (session()->getFlashdata('success'))): ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata('succes'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <spance aria-hidden="true">&times;</spance>
                        </button>
                    </div>
                <?php endif; ?>

                <?php if (!empty (session()->getFlashdata('fail'))): ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('fail'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <spance aria-hidden="true">&times;</spance>
                        </button>
                    </div>
                <?php endif; ?>
                <input type="hidden" class="form-control" id="id" name="id" value="value=" <?= $jadwal['id_jadwal']; ?>">

                <div class=" row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Mata Kuliah</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="mk" name="mk" value="<?= $jadwal['mk']; ?>">
                    </div>
                </div>
                <?php if ($validation->getError('mk')): ?>
                    <div class="d-block text-danger " style="margin-top:-10px;margin-bottom:15px;margin-left:180px;">
                        <?= $validation->getError('mk'); ?>
                    </div>
                <?php endif; ?>
                <div class="row mb-3">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Nama Dosen</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama_dosen" name="nama_dosen"
                            value="<?= $jadwal['nama_dosen'] ?>">
                    </div>
                </div>
                <?php if ($validation->getError('nama_dosen')): ?>
                    <div class="d-block text-danger " style="margin-top:-10px;margin-bottom:15px;margin-left:180px;">
                        <?= $validation->getError('nama_dosen'); ?>
                    </div>
                <?php endif; ?>
                <div class="row mb-3">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Kelas</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="kelas" name="kelas" value="<?= $jadwal['kelas'] ?>">
                    </div>
                </div>
                <?php if ($validation->getError('kelas')): ?>
                    <div class="d-block text-danger " style="margin-top:-10px;margin-bottom:15px;margin-left:180px;">
                        <?= $validation->getError('kelas'); ?>
                    </div>
                <?php endif; ?>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Jam</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="jam" name="jam" value="<?= $jadwal['jam'] ?>">
                    </div>
                </div>
                <?php if ($validation->getError('jam')): ?>
                    <div class="d-block text-danger " style="margin-top:-10px;margin-bottom:15px;margin-left:180px;">
                        <?= $validation->getError('jam'); ?>
                    </div>
                <?php endif; ?>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Prodi</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama_prodi" name="nama_prodi"
                            value="<?= $jadwal['nama_prodi'] ?>">
                    </div>
                </div>
                <?php if ($validation->getError('nama_prodi')): ?>
                    <div class="d-block text-danger " style="margin-top:-10px;margin-bottom:15px;margin-left:180px;">
                        <?= $validation->getError('nama_prodi'); ?>
                    </div>
                <?php endif; ?>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Ruangan</label>
                    <div class="col-sm-10">
                        <select name="nama_ruangan" id="nama_ruangan" class="form-control">
                            <?php foreach ($ruangan as $item): ?>
                                <option value="<?= $item['nama_ruangan']; ?>" <?php if ($jadwal['nama_ruangan'] == $item['nama_ruangan']): ?> selected <?php endif; ?>>
                                    <?= $item['nama_ruangan']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <?php if ($validation->getError('nama_ruangan')): ?>
                    <div class="d-block text-danger " style="margin-top:-10px;margin-bottom:15px;margin-left:180px;">
                        <?= $validation->getError('nama_ruangan'); ?>
                    </div>
                <?php endif; ?>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Jenis</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="jenis" name="jenis" value="<?= $jadwal['jenis'] ?>">
                    </div>
                </div>
                <?php if ($validation->getError('jenis')): ?>
                    <div class="d-block text-danger " style="margin-top:-10px;margin-bottom:15px;margin-left:180px;">
                        <?= $validation->getError('jenis'); ?>
                    </div>
                <?php endif; ?>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Hari</label>
                    <div class="col-sm-10">
                        <select name="hari" id="hari" class="form-control">
                            <option value=""></option>
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                        </select>

                    </div>
                </div>
                <?php if ($validation->getError('hari')): ?>
                    <div class="d-block text-danger " style="margin-top:-10px;margin-bottom:15px;margin-left:180px;">
                        <?= $validation->getError('hari'); ?>
                    </div>
                <?php endif; ?>
                <button type="submit" class="btn btn-primary" onclick="return confirm('apakah anda yakin');">Simpan
                    Data</button>
            </form>
        </div>
    </div>

</div>


<?= $this->endSection(); ?>
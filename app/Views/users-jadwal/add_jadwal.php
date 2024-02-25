<?= $this->extend('backend/layout/user-layout'); ?>

<?= $this->section('content'); ?>

<!-- breadcrumb-section -->
<div class="breadcrumb-section breadcrumb-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="breadcrumb-text">
                    <p>Lab UPA-TIK</p>
                    <h2>Form Pengajuan Jadwal <br> Reguler Tahun <br> 2023-2024</h2>
                </div>
            </div>
        </div>
    </div>
</div>


<?php if (!empty(session()->getFlashdata('errors'))): ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('errors'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <spance aria-hidden="true">&times;</spance>
        </button>
    </div>
<?php endif; ?>
<div class="container mt-5">
    <div class="row">
        <div class="col">
            <h2 class="mt-3">Form Pengajuan Jadwal</h2>
            <form action="/admin/jadwal-save" method="POST">

                <div class="row mb-3">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Mata Kuliah</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="mk " name="mk">
                        <?php foreach ($tahun as $t): ?>
                            <input class='form-control' type="hidden" value="<?= $t->id_thn ?>" name="id_thn" />
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Kelas</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="kelas" name="kelas">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Ruangan Lab</label>
                    <div class="col-sm-10">
                        <select name="nama_ruangan" id="nama_ruangan" class="form-control">
                            <option value=""></option>
                            <?php foreach ($ruangan as $row): ?>
                                <option value="<?= $row['id_ruangan'] ?>">
                                    <?= $row['nama_ruangan'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Hari</label>
                    <div class="col-sm-10">
                        <select name="hari" id="hari" class="form-control">
                            <option value=""></option>
                            <?php foreach ($hari as $hari): ?>
                                <option value="<?= $hari; ?>">
                                    <?= $hari; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Nama Dosen</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="dosen" name="dosen">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">ID Prodi</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="prodi" name="prodi">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Jam</label>
                    <div class="col-sm-10">
                        <?php foreach ($jam as $j): ?>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="<?= $j['id'] ?>"
                                    id="jam<?= $j['id'] ?>" name="jam[]">
                                <label class="form-check-label" for="jam<?= $j['id'] ?>">
                                    <?= $j['jam'] ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mb-3">Daftar</button>
            </form>

        </div>
    </div>
</div>
<!-- end breadcrumb section -->


<?= $this->endSection(); ?>
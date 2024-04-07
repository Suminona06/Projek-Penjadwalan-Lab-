<?= $this->extend('backend/layout/pages-layout'); ?>
<?= $this->section('content'); ?>

<div class="container mt-5">
    <div class="row">
        <div class="col">
            <h2 class="mb-3">Form Tambah Foto</h2>
            <?php $validation = \Config\Services::validation(); ?>
            <form action="/admin/save_data_galeri" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <?php if (!empty(session()->getFlashdata('success'))): ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata('success'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

                <?php if (!empty(session()->getFlashdata('fail'))): ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('fail'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Gambar</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" id="foto" name="foto" value="">
                    </div>
                </div>
                <?php if ($validation->getError('foto')): ?>
                    <div class="d-block text-danger" style="margin-top:-10px;margin-bottom:15px;margin-left:180px;">
                        <?= $validation->getError('foto'); ?>
                    </div>
                <?php endif; ?>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Ruangan</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="id_ruangan" name="id_ruangan">
                            <?php foreach ($ruangan as $item): ?>
                                <option value="<?= $item['id_ruangan'] ?>">
                                    <?= $item['nama_ruangan'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Tambah Data</button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
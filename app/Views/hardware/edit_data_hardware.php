<?= $this->extend('backend/layout/pages-layout'); ?>
<?= $this->section('content'); ?>

<div class="container mt-5">
    <div class="row">
        <div class="col">
            <h2 class="mb-3">Form Edit Data Hardware</h2>
            <?php $validation = \Config\Services::validation(); ?>
            <form action="/admin/update_data_hardware/<?= $hardware['id']; ?>" method="POST"
                enctype="multipart/form-data">
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
                <input type="hidden" class="form-control" id="id" name="id" value="<?= $hardware['id']; ?>">
                <div class="row mb-3">
                    <img src="<?= base_url('img/' . $hardware['gambar']); ?>" alt="error" width="200px"
                        class="img-thumbnail">
                </div>
                <div class=" row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Gambar</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" id="gambar" name="gambar">
                    </div>
                </div>
                <?php if ($validation->getError('gambar')): ?>
                    <div class="d-block text-danger " style="margin-top:-10px;margin-bottom:15px;margin-left:180px;">
                        <?= $validation->getError('gambar'); ?>
                    </div>
                <?php endif; ?>
                <div class="row mb-3">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $hardware['nama'] ?>">
                    </div>
                </div>
                <?php if ($validation->getError('nama')): ?>
                    <div class="d-block text-danger " style="margin-top:-10px;margin-bottom:15px;margin-left:180px;">
                        <?= $validation->getError('nama'); ?>
                    </div>
                <?php endif; ?>
                <div class="row mb-3">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Jumlah</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="jumlah" name="jumlah"
                            value="<?= $hardware['jumlah'] ?>">
                    </div>
                </div>
                <?php if ($validation->getError('jumlah')): ?>
                    <div class="d-block text-danger " style="margin-top:-10px;margin-bottom:15px;margin-left:180px;">
                        <?= $validation->getError('jumlah'); ?>
                    </div>
                <?php endif; ?>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Ruangan</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="id_ruangan" name="id_ruangan">
                            <?php foreach ($ruangan as $ruangan_item): ?>
                                <option value="<?= $ruangan_item['id_ruangan'] ?>"
                                    <?= ($ruangan_item['id_ruangan'] == $hardware['id_ruangan']) ? 'selected' : '' ?>>
                                    <?= $ruangan_item['nama_ruangan'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <?php if ($validation->getError('ruangan')): ?>
                    <div class="d-block text-danger " style="margin-top:-10px;margin-bottom:15px;margin-left:180px;">
                        <?= $validation->getError('ruangan'); ?>
                    </div>
                <?php endif; ?>
                <button type="submit" class="btn btn-primary">Simpan Data</button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
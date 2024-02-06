<?= $this->extend('backend/layout/pages-layout'); ?>
<?= $this->section('content'); ?>

<div class="container mt-5">
    <div class="row">
        <div class="col">
            <h2 class="mb-3">Form Edit Galeri</h2>
            <form action="/admin/update_data_galeri/<?= $galeri['id_galeri']; ?>" method="POST"
                enctype="multipart/form-data">
                <input type="hidden" class="form-control" id="id_aset" name="id_galeri" value="value="
                    <?= $galeri['id_galeri']; ?>">
                <div class="row mb-3">
                    <img src="<?= base_url('img/' . $galeri['foto']); ?>" alt="error" width="200px"
                        class="img-thumbnail">
                </div>
                <div class=" row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Gambar</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" id="foto" name="foto" value="<?= $galeri['foto']; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Ruangan</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="nama_ruangan" name="nama_ruangan">
                            <?php foreach ($ruangan as $item): ?>
                                <option value="<?= $item['id_ruangan'] ?>" <?php if ($item['id_ruangan'] == $galeri['id_ruangan']): ?>selected<?php endif; ?>>
                                    <?= $item['nama_ruangan'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>


                <button type="submit" class="btn btn-primary">Simpan Data</button>
            </form>
        </div>
    </div>

</div>


<?= $this->endSection(); ?>
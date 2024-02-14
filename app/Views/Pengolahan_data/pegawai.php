<?= $this->extend('backend/layout/pages-layout'); ?>
<?= $this->section('content'); ?>
<!-- Page Content Here -->

<?php if (!empty(session()->getFlashdata('success'))): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <spance aria-hidden="true">&times;</spance>
        </button>
    </div>
<?php endif; ?>

<table class=" table table-bordered table-hover my-3">
    <thead class="thead-dark">
        <tr class="text-center">
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">NIP</th>
            <th scope="col">Nama Ruangan</th>
            <th scope="col">Aksi</th>
        </tr>

    <tbody>
        <?php
        // Ambil nilai parameter 'page_lab2' dari URL dan konversi ke integer
        $page = intval(request()->getVar('page_pegawai'));

        // Jika parameter tidak ada, atur nilai default ke 1
        if ($page <= 0) {
            $page = 1;
        }

        // Hitung nilai $i
        $i = 1 + (10 * ($page - 1));
        ?>
        <?php foreach ($pegawai as $fasilitas): ?>
            <tr class="text-center">
                <td scope="row">
                    <?= $i++; ?>
                </td>
                <td>
                    <?= $fasilitas['nama']; ?>
                </td>
                <td>
                    <?= $fasilitas['nip']; ?>
                </td>
                <td>
                    <?= $fasilitas['id_ruangan']; ?>
                </td>
                <td>
                    <a href="<?= route_to('admin.hapus.data.pegawai', $fasilitas['id']); ?>"
                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');"
                        class="btn btn-danger">Delete</a>
                    <a href="<?= route_to('admin.edit.data.pegawai', $fasilitas['id']); ?>" class="btn btn-success">Edit</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<div class="row my-3">
    <div class="col">
        <a href="<?= route_to('admin.add.pegawai'); ?>" class="btn btn-primary">Tambah Data Pegawai</a>
    </div>
</div>
<div class="row">
    <div class="col">
        <?= $pager->links('pegawai', 'my_pagination'); ?>
    </div>
</div>
<?= $this->endSection(); ?>
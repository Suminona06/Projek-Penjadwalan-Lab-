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
<h1 class="my-3">Siswa PKL</h1>
<table class=" table table-bordered table-hover my-3">
    <thead class="thead-dark">
        <tr class="text-center">
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Jenis Kelamin</th>
            <th scope="col">Jurusan</th>
            <th scope="col">Asal Sekolah</th>
            <th scope="col">Aksi</th>
        </tr>

    <tbody>
        <?php
        // Ambil nilai parameter 'page_lab2' dari URL dan konversi ke integer
        $page = intval(request()->getVar('page_siswa'));

        // Jika parameter tidak ada, atur nilai default ke 1
        if ($page <= 0) {
            $page = 1;
        }

        // Hitung nilai $i
        $i = 1 + (10 * ($page - 1));
        ?>
        <?php foreach ($siswa as $fasilitas): ?>
            <tr class="text-center">
                <td scope="row">
                    <?= $i++; ?>
                </td>
                <td>
                    <?= $fasilitas['nama_lengkap']; ?>
                </td>
                <td>
                    <?= $fasilitas['jenis_kelamin']; ?>
                </td>
                <td>
                    <?= $fasilitas['juruusan_pkl']; ?>
                </td>
                <td>
                    <?= $fasilitas['asal_sekolah']; ?>
                </td>
                <td>
                    <a href="<?= route_to('admin.hapus.data.siswa', $fasilitas['id']); ?>"
                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');"
                        class="btn btn-danger">Delete</a>
                    <a href="<?= route_to('admin.edit.data.siswa', $fasilitas['id']); ?>" class="btn btn-success">Edit</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<div class="row my-3">
    <div class="col">
        <a href="<?= route_to('admin.add.siswa'); ?>" class="btn btn-primary">Tambah Data Siswa</a>
        <a href="<?= route_to('siswa.export.pdf'); ?>" class="btn btn-warning">Export PDF</a>
    </div>
</div>
<div class="row">
    <div class="col">
        <?= $pager->links('siswa', 'my_pagination'); ?>
    </div>
</div>
<?= $this->endSection(); ?>
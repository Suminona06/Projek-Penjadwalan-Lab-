<?= $this->extend('backend/layout/pages-layout'); ?>

<?= $this->section('content'); ?>


<h1 class="my-3">Jadwal Reguler</h1>
<table class="table table-bordered my-3">
    <thead class="thead-dark">
        <tr class="text-center">
            <th scope="col">No</th>
            <th scope="col">Mk</th>
            <th scope="col">Nama Dosen</th>
            <th scope="col">Hari</th>
            <th scope="col">Jenis</th>
            <th scope="col">kelas</th>
            <th scope="col">Id tahun</th>
            <th scope="col">ID Ruangan</th>
            <th scope="col">ID Prodi</th>
            <th scope="col">Aksi</th>
        </tr>
    <tbody>

        <?php
        // Ambil nilai parameter 'page_lab2' dari URL dan konversi ke integer
        $page = intval(request()->getVar('page_jadwal'));

        // Jika parameter tidak ada, atur nilai default ke 1
        if ($page <= 0) {
            $page = 1;
        }

        // Hitung nilai $i
        $i = 1 + (10 * ($page - 1));
        ?>
        <?php foreach ($jadwal as $jadwal): ?>
            <tr class="text-center">
                <td scope="row">
                    <?= $i++; ?>
                </td>
                <td>
                    <?= $jadwal['mk']; ?>
                </td>
                <td>
                    <?= $jadwal['nama_dosen']; ?>
                </td>
                <td>
                    <?= $jadwal['hari']; ?>
                </td>
                <td>
                    <?= $jadwal['jenis']; ?>
                </td>
                <td>
                    <?= $jadwal['kelas']; ?>
                </td>
                <td>
                    <?= $jadwal['id_thn']; ?>
                </td>
                <td>
                    <?= $jadwal['id_ruangan']; ?>
                </td>
                <td>
                    <?= $jadwal['id_prodi']; ?>
                </td>
                <td> <a href="<?= route_to('admin.hapus.data.pegawai', $jadwal['id_jadwal']); ?>"
                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');"
                        class="btn btn-danger">Delete</a>
                    <a href="<?= route_to('admin.edit.data.pegawai', $jadwal['id_jadwal']); ?>"
                        class="btn btn-success">Edit</a>
                </td>
            </tr>

        <?php endforeach; ?>
    </tbody>
</table>

<div class="row">
    <div class="col">
        <?= $pager->links('jadwal', 'my_pagination'); ?>
    </div>
</div>

<?= $this->endSection(); ?>
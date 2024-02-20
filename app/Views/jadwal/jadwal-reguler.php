<?= $this->extend('backend/layout/pages-layout'); ?>

<?= $this->section('content'); ?>


<h1 class="my-3">Jadwal Reguler</h1>
<table class="table table-bordered my-3">
    <thead class="thead-dark">
        <tr class="text-center">
            <th scope="col">No</th>
            <th scope="col">Mata Kuliah</th>
            <th scope="col">Nama Dosen</th>
            <th scope="col">Kelas</th>
            <th scope="col">Jam</th>
            <th scope="col">Program Studi</th>
            <th scope="col">Ruangan</th>
            <th scope="col">Jenis</th>
            <th scope="col">Hari</th>
            <th scope="col">Tahun</th>
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
                    <?= $jadwal['kelas']; ?>
                </td>
                <td>
                    <?= $jadwal['jam']; ?>
                </td>
                <td>
                    <?= $jadwal['nama_prodi']; ?>
                </td>
                <td>
                    <?= $jadwal['nama_ruangan']; ?>
                </td>
                <td>
                    <?= $jadwal['jenis']; ?>
                </td>
                <td>
                    <?= $jadwal['hari']; ?>
                </td>
                <td>
                    <?= $jadwal['thn_awal']; ?>-
                    <?= $jadwal['thn_akhir']; ?>
                </td>
                <td>
                    <a href="/admin/hapus_data_jadwal/<?= $jadwal['id_jadwal']; ?>"
                        onclick="return confirm('apakah anda yakin');" class="btn btn-danger">Delete</a>
                </td>
            </tr>

        <?php endforeach; ?>
    </tbody>
</table>
<div class="row my-3">
    <div class="col">
        <a href="<?= route_to('jadwal.export.pdf') ?>" target="_blank" class="btn btn-warning">Export PDF</a>
    </div>
</div>
<div class="row">
    <div class="col">
        <?= $pager->links('jadwal', 'my_pagination'); ?>
    </div>
</div>

<?= $this->endSection(); ?>
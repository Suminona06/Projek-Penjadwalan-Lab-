<?= $this->extend('backend/layout/user-layout'); ?>

<?= $this->section('content'); ?>


<div class="breadcrumb-section breadcrumb-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="breadcrumb-text">
                    <p>Lab UPA-TIK</p>
                    <h1>List Jadwal Prodi UAS<br>
                    </h1>
                </div>
            </div>
        </div>
    </div>
</div>

<table class="table table-bordered my-3">
    <thead class="thead-dark">
        <tr class="text-center">
            <th scope="col">No</th>
            <th scope="col">Mata Kuliah</th>
            <th scope="col">Nama Dosen</th>
            <th scope="col">Kelas</th>
            <th scope="col">Id Prodi</th>
            <th scope="col">Ruangan</th>
            <th scope="col">Jam</th>
            <th scope="col">Jenis</th>
            <th scope="col">Hari</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <?php $i = 1; ?>

    <tbody>

        <?php foreach ($jadwalProdi as $jadwal): ?>
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
                    <?= $jadwal['id_prodi']; ?>
                </td>
                <td>
                    <?= $jadwal['nama_ruangan']; ?>
                </td>
                <td>
                    <?= $jadwal['jam']; ?>
                </td>
                <td>
                    <?= $jadwal['jenis']; ?>
                </td>
                <td>
                    <?= $jadwal['hari']; ?>
                </td>
                <td>
                    <a href="<?= route_to('user.hapus.prodi', $jadwal['id_jadwal']); ?>"
                        onclick="return confirm('apakah anda yakin');" class="btn btn-danger">Delete</a>
                </td>
            </tr>

        <?php endforeach; ?>
    </tbody>
    <a href="<?= route_to('user.add.jadwal', $idProdi); ?>" class="btn btn-primary mt-4 mx-3">Tambah Jadwal</a>
    <a href="<?= route_to('uas.export.pdf', $idProdi); ?>" class="btn btn-warning mt-4">Export Pdf</a>
</table>

<?= $this->endSection(); ?>
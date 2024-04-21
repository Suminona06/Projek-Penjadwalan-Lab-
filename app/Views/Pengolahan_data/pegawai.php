<?= $this->extend('backend/layout/pages-layout'); ?>
<?= $this->section('content'); ?>
<!-- Page Content Here -->

<div class="swal" data-swal="<?= session('success'); ?>"></div>
<h1 class="my-3">Pegawai UPA-TIK</h1>
<table class=" table table-bordered table-hover my-3">
    <thead class="thead-dark">
        <tr class="text-center">
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">NIP</th>
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
        <a href="<?= route_to('pegawai.export.pdf'); ?>" class="btn btn-warning">Export PDF</a>
    </div>
</div>
<div class="row">
    <div class="col">
        <?= $pager->links('pegawai', 'my_pagination'); ?>
    </div>
</div>
<?= $this->endSection(); ?>


<?= $this->section('scripts'); ?>
<script>

    const swalElement = document.querySelector('.swal'); // Mengambil elemen dengan kelas '.swal'
    const swalData = swalElement.dataset.swal; // Mengambil data dari atribut data HTML 'data-swal'

    if (swalData) {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: swalData,
            showConfirmButton: false,
            timer: 2000
        });
    }
</script>
<?= $this->endSection(); ?>
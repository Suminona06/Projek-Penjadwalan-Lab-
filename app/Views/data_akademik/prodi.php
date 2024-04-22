<?= $this->extend('backend/layout/pages-layout'); ?>
<?= $this->section('content'); ?>


<div class="swal" data-swal="<?= session('success'); ?>"></div>

<body>
    <center>
        <h1 class="my-3">Program Studi</h1>
    </center>
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr class="text-center">
                <th scope="col">No</th>
                <th scope="col">Kode Prodi</th>
                <th scope="col">Jurusan</th>
                <th scope="col">Nama Prodi</th>
                <th scope="col">Program</th>
                <th scope="col">Aksi</th>


        <tbody>
            <?php
            // Ambil nilai parameter 'page_lab2' dari URL dan konversi ke integer
            $page = intval(request()->getVar('page_prodi'));

            // Jika parameter tidak ada, atur nilai default ke 1
            if ($page <= 0) {
                $page = 1;
            }

            // Hitung nilai $i
            $i = 1 + (10 * ($page - 1));
            ?>
            <?php foreach ($prodi as $ta): ?>
                <tr class="text-center">
                    <td scope="row-1">
                        <?= $i++; ?>
                    </td>
                    <td>
                        <?= $ta['kode_prodi']; ?>
                    </td>
                    <td>
                        <?= $ta['nama_jurusan']; ?>
                    </td>
                    <td>
                        <?= $ta['program']; ?>
                    </td>
                    <td>
                        <?= $ta['nama_prodi']; ?>
                    </td>
                    <td>
                        <a href="/admin/edit_data_prodi/<?= $ta['id_prodi']; ?>" class="btn btn-success">Edit</a>
                        <a href="/admin/hapus_data_prodi/<?= $ta['id_prodi']; ?>"
                            onclick="return confirm('apakah anda yakin');" class="btn btn-danger">Delete</a>
                    </td>


                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="row my-3">
        <div class="col">
            <a href="<?= route_to('admin.add.prodi') ?>" class="btn btn-primary">Tambah Data prodi</a>
            <a href="<?= route_to('prodi.export.pdf') ?>" class="btn btn-warning">Export PDF</a>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <?= $pager->links('prodi', 'my_pagination'); ?>
        </div>
    </div>
</body>

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
            timer: 1900
        });
    }
</script>
<?= $this->endSection(); ?>
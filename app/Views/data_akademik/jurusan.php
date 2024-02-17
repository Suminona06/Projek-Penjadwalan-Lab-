<?= $this->extend('backend/layout/pages-layout'); ?>
<?= $this->section('content'); ?>




<body>
    <center>
        <h1 class="my-3">Jurusan</h1>
    </center>
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr class="text-center">
                <th scope="col">No</th>
                <th scope="col">Nama Jurusan</th>
                <th scope="col">Aksi</th>
            </tr>

        <tbody>
            <?php
            // Ambil nilai parameter 'page_lab2' dari URL dan konversi ke integer
            $page = intval(request()->getVar('page_jurusan'));

            // Jika parameter tidak ada, atur nilai default ke 1
            if ($page <= 0) {
                $page = 1;
            }

            // Hitung nilai $i
            $i = 1 + (10 * ($page - 1));
            ?>
            <?php foreach ($jurusan as $ta): ?>
                <tr class="text-center">
                    <td scope="row-1">
                        <?= $i++; ?>
                    </td>
                    <td>
                        <?= $ta['nama_jurusan']; ?>
                    </td>
                    <td>
                        <a href="/admin/edit_data_jurusan/<?= $ta['id_jurusan']; ?>" class="btn btn-success">Edit</a>
                        <a href="/admin/hapus_data_jurusan/<?= $ta['id_jurusan']; ?>"
                            onclick="return confirm('apakah anda yakin');" class="btn btn-danger">Delete</a>
                    </td>


                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="row my-3">
        <div class="col">
            <a href="<?= route_to('admin.add.jurusan') ?>" class="btn btn-primary">Tambah Data Jurusan</a>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <?= $pager->links('jurusan', 'my_pagination'); ?>
        </div>
    </div>
</body>

<?= $this->endSection(); ?>
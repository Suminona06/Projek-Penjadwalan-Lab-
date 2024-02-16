<?= $this->extend('backend/layout/pages-layout'); ?>
<?= $this->section('content'); ?>




<body>
    <center>
        <h1 class="my-3">Unit</h1>
    </center>
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr class="text-center">
                <th scope="col">No</th>
                <th scope="col">Kode Unit</th>
                <th scope="col">Nama Unit</th>
                <th scope="col">Aksi</th>


        <tbody>
            <?php
            // Ambil nilai parameter 'page_lab2' dari URL dan konversi ke integer
            $page = intval(request()->getVar('page_unit'));

            // Jika parameter tidak ada, atur nilai default ke 1
            if ($page <= 0) {
                $page = 1;
            }

            // Hitung nilai $i
            $i = 1 + (10 * ($page - 1));
            ?>
            <?php foreach ($unit as $ta): ?>
                <tr class="text-center">
                    <td scope="row-1">
                        <?= $i++; ?>
                    </td>
                    <td>
                        <?= $ta['kode_unit']; ?>
                    </td>
                    <td>
                        <?= $ta['nama_unit']; ?>
                    </td>
                    <td>
                        <a href="/admin/edit_data_unit/<?= $ta['id_unit']; ?>" class="btn btn-success">Edit</a>
                        <a href="/admin/hapus_data_unit/<?= $ta['id_unit']; ?>"
                            onclick="return confirm('apakah anda yakin');" class="btn btn-danger">Delete</a>
                    </td>


                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="row my-3">
        <div class="col">
            <a href="<?= route_to('admin.add.unit') ?>" class="btn btn-primary">Tambah Data Unit</a>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <?= $pager->links('unit', 'my_pagination'); ?>
        </div>
    </div>
</body>

<?= $this->endSection(); ?>
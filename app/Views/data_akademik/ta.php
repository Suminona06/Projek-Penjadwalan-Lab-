<?= $this->extend('backend/layout/pages-layout'); ?>
<?= $this->section('content'); ?>




<body>
    <center>
        <h1 class="my-3">Data Tahun Ajaran</h1>
    </center>
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr class="text-center">
                <th scope="col">No</th>
                <th scope="col">Tahun Ajaran</th>
                <th scope="col">Semester</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>

        <tbody>
            <?php
            // Ambil nilai parameter 'page_lab2' dari URL dan konversi ke integer
            $page = intval(request()->getVar('page_ta'));

            // Jika parameter tidak ada, atur nilai default ke 1
            if ($page <= 0) {
                $page = 1;
            }

            // Hitung nilai $i
            $i = 1 + (10 * ($page - 1));
            ?>
            <?php foreach ($ta as $row): ?>
                <tr class="text-center">
                    <td scope="row">
                        <?= $counter++; ?>
                    </td>
                    <td>
                        <?= $row['thn_awal']; ?> -
                        <?= $row['thn_akhir']; ?>
                    </td>
                    <td>
                        <?= $row['semester']; ?>
                    </td>
                    <td>
                        <?= $row['status']; ?>
                    </td>
                    <td>
                        <?php if ($row['status'] == 'TIDAK'): ?>
                            <a href="<?= route_to('admin.toggleStatus', $row['id_thn']); ?>"
                                class="btn btn-success">Aktifkan</a>
                        <?php else: ?>
                            <a href="<?= route_to('admin.toggleStatus', $row['id_thn']); ?>"
                                class="btn btn-danger">Nonaktifkan</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        </tbody>
    </table>

    <div class="row my-3">
        <div class="col">
            <a href="/admin/add_data_ta" class="btn btn-primary">Tambah Data Tahun Ajaran</a>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <?= $pager->links('ta', 'my_pagination'); ?>
        </div>
    </div>
</body>

<?= $this->endSection(); ?>
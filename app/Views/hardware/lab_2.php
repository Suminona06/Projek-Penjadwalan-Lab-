<?= $this->extend('backend/layout/pages-layout'); ?>
<?= $this->section('content'); ?>




<body>
    <h1>Fasilitas Hardware Lab
        <?= ($modelNumber - 8); ?>
    </h1>
    <table class="table table-bordered my-3">
        <thead class="">
            <tr class="text-center">
                <th scope="col">No</th>
                <th scope="col">No Pc</th>
                <th scope="col">Nama PC</th>
                <th scope="col">Windows</th>
                <th scope="col">Processor</th>
                <th scope="col">Ram</th>
                <th scope="col">Mouse</th>
                <th scope="col">Keyboard</th>
                <th scope="col">Aksi</th>
            </tr>

        <tbody>
            <?php
            // Ambil nilai parameter 'page_lab2' dari URL dan konversi ke integer
            $page = intval(request()->getVar('page_lab2'));

            // Jika parameter tidak ada, atur nilai default ke 1
            if ($page <= 0) {
                $page = 1;
            }

            // Hitung nilai $i
            $i = 1 + (10 * ($page - 1));
            ?>
            <?php foreach ($lab2 as $fasilitas): ?>
                <tr class="text-center">
                    <td scope="row">
                        <?= $i++; ?>
                    </td>
                    <td>
                        <?= $fasilitas['no_pc']; ?>
                    </td>
                    <td>
                        <?= $fasilitas['nama_pc']; ?>
                    </td>
                    <td>
                        <?= $fasilitas['windows']; ?>
                    </td>
                    <td>
                        <?= $fasilitas['processor']; ?>
                    </td>
                    <td>
                        <?= $fasilitas['ram']; ?>
                    </td>
                    <td>
                        <?= $fasilitas['mouse']; ?>
                    </td>
                    <td>
                        <?= $fasilitas['keyboard']; ?>
                    </td>
                    <td>
                        <a href="<?= route_to('hapus.data.lab', $modelNumber, $fasilitas['id_pc']); ?>"
                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');"
                            class="btn btn-danger">Delete</a>
                        <a href="<?= route_to('edit.lab', $modelNumber, $fasilitas['id_pc']); ?>"
                            class="btn btn-success">Edit</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="row my-3">
        <div class="col">
            <a href="<?= route_to('admin.add.lab', $modelNumber); ?>" class="btn btn-primary">Tambah Data Hardware</a>
        </div>
        <div class="col">
            <a href="<?= route_to('admin.export.pdf', $modelNumber); ?>" target="_blank" class="btn btn-warning">Export to PDF</a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?= $pager->links('lab2', 'my_pagination'); ?>
        </div>
    </div>
</body>

<?= $this->endSection(); ?>
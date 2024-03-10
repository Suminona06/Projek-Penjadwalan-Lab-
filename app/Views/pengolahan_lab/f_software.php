<?= $this->extend('backend/layout/pages-layout'); ?>
<?= $this->section('content'); ?>




<body>
    <h1>Fasilitas Software Lab
        <?= ($id_ruangan - 8); ?>
    </h1>
    <table class="table table-bordered my-3">
        <thead class="thead-dark">
            <tr class="text-center">
                <th scope="col">No</th>
                <th scope="col">Gambar</th>
                <th scope="col">Nama Software</th>
                <th scope="col">Jumlah</th>
                <th scope="col"> Ruangan Lab</th>
                <th scope="col">Aksi</th>
            </tr>

        <tbody>
            <?php
            // Ambil nilai parameter 'page_lab2' dari URL dan konversi ke integer
            $page = intval(request()->getVar('page_fasilitas'));

            // Jika parameter tidak ada, atur nilai default ke 1
            if ($page <= 0) {
                $page = 1;
            }

            // Hitung nilai $i
            $i = 1 + (10 * ($page - 1));
            ?>
            <?php foreach ($fasilitas as $fasilitas): ?>
                <tr class="text-center">
                    <td scope="row">
                        <?= $i++; ?>
                    </td>
                    <td>
                        <?= $fasilitas['gambar']; ?>
                    </td>
                    <td>
                        <?= $fasilitas['nama']; ?>
                    </td>
                    <td>
                        <?= $fasilitas['jumlah']; ?>
                    </td>
                    <td>
                        <?= $ruangan['nama_ruangan']; ?>
                    </td>
                    <td>
                        <a href="/admin/hapus_data_software/<?= $fasilitas['id']; ?>"
                            onclick="return confirm('apakah anda yakin');" class="btn btn-danger">Delete</a>
                        <a href="/admin/edit_data_software/<?= $fasilitas['id']; ?>" class="btn btn-success">Edit</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="row my-3">
        <div class="col">
            <a href="<?= route_to('admin.data.software', $id_ruangan); ?>" class="btn btn-primary">Tambah Data
                Software</a>
        </div>
        <div class="col">
            <a href="/admin/software_export/<?= $id_ruangan ?>" target="_blank"
                class="btn btn-warning">Export PDF</a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?= $pager->links('fasilitas', 'my_pagination'); ?>
        </div>
    </div>
</body>

<?= $this->endSection(); ?>
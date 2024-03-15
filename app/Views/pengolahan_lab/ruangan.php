<?= $this->extend('backend/layout/pages-layout'); ?>
<?= $this->section('content'); ?>




<body>
    <h1 class="my-3">Ruangan</h1>
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr class="text-center">
                <th scope="col">ID</th>
                <th scope="col">Nama Ruangan</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Penanggung Jawab</th>
                <th scope="col">Lokasi</th>
                <th scope="col">Aksi</th>
            </tr>

        <tbody>
            <?php
            // Ambil nilai parameter 'page_lab2' dari URL dan konversi ke integer
            $page = intval(request()->getVar('page_ruangan'));

            // Jika parameter tidak ada, atur nilai default ke 1
            if ($page <= 0) {
                $page = 1;
            }

            // Hitung nilai $i
            $i = 1 + (10 * ($page - 1)); ?>
            <?php foreach ($ruangan as $fasilitas): ?>
                <tr class="text-center">
                    <td scope="row-1">
                        <?= $i++; ?>
                    </td>
                    <td>
                        <?= $fasilitas['nama_ruangan']; ?>
                    </td>
                    <td>
                        <?= $fasilitas['keterangan']; ?>
                    </td>
                    <td>
                        <?= $fasilitas['nama']; ?>
                    </td>
                    <td>
                        <?= $fasilitas['lokasi']; ?>
                    </td>
                    <td>
                        <a href="/admin/hapus_data_ruangan/<?= $fasilitas['id_ruangan']; ?>"
                            onclick="return confirm('apakah anda yakin');" class="btn btn-danger">Delete</a>

                        <a href="/admin/edit_data_ruangan/<?= $fasilitas['id_ruangan']; ?>" class="btn btn-success">Edit</a>
                    </td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="row my-3">
        <div class="col">
            <a href="/admin/add_data_ruangan/" class="btn btn-primary">Tambah Data Ruangan</a>
        </div>
        <div class="col">
            <a href="<?= route_to('ruangan.export.pdf'); ?>" target="_blank" class="btn btn-warning">Export PDF</a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?= $pager->links('ruangan', 'my_pagination'); ?>
        </div>
    </div>
</body>

<?= $this->endSection(); ?>
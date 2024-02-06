<?= $this->extend('backend/layout/pages-layout'); ?>
<?= $this->section('content'); ?>




<body>
    <h1 class="my-3">Galeri</h1>
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr class="text-center">
                <th scope="col">No</th>
                <th scope="col">Gambar</th>
                <th scope="col">Ruangan</th>
                <th scope="col">Aksi</th>
            </tr>

        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($galeri as $galeri): ?>
                <tr class="text-center">
                    <td scope="row-1">
                        <?= $i++; ?>
                    </td>
                    <td>
                        <?= $galeri['foto']; ?>
                    </td>
                    <td>
                        <?= $galeri['nama_ruangan']; ?>
                    </td>
                    <td>
                        <a href="/admin/hapus_data_galeri/<?= $galeri['id_galeri']; ?>"
                            onclick="return confirm('apakah anda yakin');" class="btn btn-danger">Delete</a>

                        <a href="/admin/edit_data_galeri/<?= $galeri['id_galeri']; ?>" class="btn btn-success">Edit</a>
                    </td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="row my-3">
        <div class="col">
            <a href="/admin/add_data_galeri/" class="btn btn-primary">Tambah Data Galeri</a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?= $pager->links('galeri', 'my_pagination'); ?>
        </div>
    </div>
</body>

<?= $this->endSection(); ?>
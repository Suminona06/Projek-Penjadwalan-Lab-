<?= $this->extend('backend/layout/pages-layout'); ?>
<?= $this->section('content'); ?>




<body>
    <h1>Fasilitas Software</h1>
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr class="text-center">
                <th scope="col">No</th>
                <th scope="col">Gambar</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Lab</th>
                <th scope="col">Aksi</th>
            </tr>

        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($f_software as $fasilitas): ?>
                <tr class="text-center">
                    <td scope="row">
                        <?= $i++; ?>
                    </td>
                    <td>
                        <?= $fasilitas['gambar']; ?>
                    </td>
                    <td>
                        <?= $fasilitas['keterangan']; ?>
                    </td>
                    <td>
                        <?= $fasilitas['id_ruangan']; ?>
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
            <a href="/admin/add_data_software" class="btn btn-primary">Tambah Data Software</a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?= $pager->links('f_software', 'my_pagination'); ?>
        </div>
    </div>
</body>

<?= $this->endSection(); ?>
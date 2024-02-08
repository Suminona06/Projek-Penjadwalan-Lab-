<?= $this->extend('backend/layout/pages-layout'); ?>
<?= $this->section('content'); ?>




<body>
    <h1>Fasilitas Hardware</h1>
    <table class="table table-bordered">
        <thead class="thead-dark">
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
            <?php $i = 1; ?>
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
                        <a href="/admin/hapus_data_lab9/<?= $fasilitas['id_pc']; ?>"
                            onclick="return confirm('apakah anda yakin');" class="btn btn-danger">Delete</a>
                        <a href="/admin/edit_lab9/<?= $fasilitas['id_pc']; ?>" class="btn btn-success">Edit</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="row my-3">
        <div class="col">
            <a href="/admin/add_data_lab9" class="btn btn-primary">Tambah Data Hardware</a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?= $pager->links('lab2', 'my_pagination'); ?>
        </div>
    </div>
</body>

<?= $this->endSection(); ?>
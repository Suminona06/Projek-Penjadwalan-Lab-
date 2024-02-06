<?= $this->extend('backend/layout/pages-layout'); ?>
<?= $this->section('content'); ?>




<body>
    <h1 class="my-3">Data barang</h1>
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr class="text-center">
                <th scope="col">No</th>
                <th scope="col">Nama barang</th>
                <th scope="col">Serial Number</th>
                <th scope="col">Supplier</th>
                <th scope="col">Brand</th>
                <th scope="col">Model</th>
                <th scope="col">Penanggungjawab</th>
                <th scope="col">Aksi</th>
            </tr>

        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($barang as $fasilitas): ?>
                <tr class="text-center">
                    <td scope="row-1">
                        <?= $i++; ?>
                    </td>
                    <td>
                        <?= $fasilitas['deskripsi']; ?>
                    </td>
                    <td>
                        <?= $fasilitas['serialnumber']; ?>
                    </td>
                    <td>
                        <?= $fasilitas['supplier']; ?>
                    </td>
                    <td>
                        <?= $fasilitas['brand']; ?>
                    </td>
                    <td>
                        <?= $fasilitas['model']; ?>
                    </td>
                    <td>
                        <?= $fasilitas['penanggungjawab']; ?>
                    </td>
                    <td>
                        <a href="/admin/hapus_data_barang/<?= $fasilitas['id_aset']; ?>"
                            onclick="return confirm('apakah anda yakin');" class="btn btn-danger">Delete</a>

                        <a href="/admin/edit_data_barang/<?= $fasilitas['id_aset']; ?>" class="btn btn-success">Edit</a>
                    </td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="row my-3">
        <div class="col">
            <a href="<?= route_to('admin.add.barang') ?>" class="btn btn-primary">Tambah Data Barang</a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?= $pager->links('barang', 'my_pagination'); ?>
        </div>
    </div>
</body>

<?= $this->endSection(); ?>
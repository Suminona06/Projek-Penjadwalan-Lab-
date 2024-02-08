<?= $this->extend('backend/layout/pages-layout'); ?>
<?= $this->section('content'); ?>




<body>
    <h1 class="my-3">Fasilitas Hardware</h1>
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr class="text-center">
                <th scope="col">No</th>
                <th scope="col">Nama Lab</th>
                <th scope="col">Id Lab</th>
                <th scope="col">Aksi</th>
            </tr>

        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($fasilitas as $fasilitas): ?>
                <tr class="text-center">
                    <td scope="row-1">
                        <?= $i++; ?>
                    </td>
                    <td>
                        <?= $fasilitas['nama_ruangan']; ?>
                    </td>
                    <td>
                        <?= $fasilitas['id_ruangan']; ?>
                    </td>
                    <td>
                        <a href="<?= route_to('admin.lab.2', $fasilitas['id_ruangan']); ?>"
                            class="btn btn-success">Detail</a>
                    </td>


                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="row">
        <div class="col">
            <?= $pager->links('fasilitas', 'my_pagination'); ?>
        </div>
    </div>
</body>

<?= $this->endSection(); ?>
<?= $this->extend('backend/layout/pages-layout'); ?>
<?= $this->section('content'); ?>


<div class="swal" data-swal="<?= session('success'); ?>"></div>


<body>
    <h1 class="my-3 text-center">Data barang</h1>
    <div class="container mb-3">
        <div class="col">
            <form action="<?= route_to('admin.barang') ?>" method="post">
                <div class="form-group mb-0">
                    <div class="input-group-prepend">
                        <button class="btn btn-outline-secondary" type="button" id="button-addon1">Cari</button>
                        <input type="text" class="form-control search-input" placeholder="Cari Barang" name="keyword" />
                    </div>

                </div>
            </form>
        </div>
    </div>
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
                <th scope="col">Ruangan</th>
                <th scope="col">Aksi</th>
            </tr>

        <tbody>
            <?php
            $keyword = session('barang');

            $page = intval($_GET['page_barang'] ?? 1);

            // Jika parameter tidak ada, atur nilai default ke 1
            if ($page <= 0) {
                $page = 1;
            }

            // Hitung nilai $i
            $i = 1 + (10 * ($page - 1));
            ?>
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
                        <?= $fasilitas['nama_ruangan']; ?>
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
        <div class="col">
            <a href="<?= route_to('barang.export.pdf') ?>" target="_blank" class="btn btn-warning">Export PDF</a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?= $pager->links('barang', 'my_pagination'); ?>
        </div>
    </div>
</body>

<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script>

    const swalElement = document.querySelector('.swal'); // Mengambil elemen dengan kelas '.swal'
    const swalData = swalElement.dataset.swal; // Mengambil data dari atribut data HTML 'data-swal'

    if (swalData) {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: swalData,
            showConfirmButton: false,
            timer: 1900
        });
    }
</script>
<?= $this->endSection(); ?>
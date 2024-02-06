<?= $this->extend('backend/layout/pages-layout'); ?>
<?= $this->section('content'); ?>

<div class="container mt-5">
    <div class="row">
        <div class="col">
            <h2 class="mb-3">Form Edit Data Barang</h2>
            <form action="/admin/update_data_barang/<?= $barang['id_aset']; ?>" method="POST">
                <input type="hidden" class="form-control" id="id_aset" name="id_aset" value="value="
                    <?= $barang['id_aset']; ?>">
                <div class=" row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Barang</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="deskripsi" name="deskripsi"
                            value="<?= $barang['deskripsi']; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Serial Number</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="serialnumber" name="serialnumber"
                            value="<?= $barang['serialnumber'] ?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Supplier</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="supplier" name="supplier"
                            value="<?= $barang['supplier'] ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Brand</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="brand" name="brand" value="<?= $barang['brand'] ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Model</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="model" name="model" value="<?= $barang['model'] ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Penanggung Jawab</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="penanggungjawab" name="penanggungjawab"
                            value="<?= $barang['penanggungjawab'] ?>">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Data</button>
            </form>
        </div>
    </div>

</div>


<?= $this->endSection(); ?>
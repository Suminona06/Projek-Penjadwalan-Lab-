<?= $this->extend('backend/layout/pages-layout'); ?>
<?= $this->section('content'); ?>

<div class="container mt-5">
    <div class="row">
        <div class="col">
            <h2 class="mb-3">Form Edit Data Jadwal</h2>
            <?php $validation = \Config\Services::validation(); ?>
            <form action="/admin/jadwal-update/<?= $jadwal['id_jadwal']; ?>" method="POST"
                enctype="multipart/form-data">
                <?= csrf_field() ?>
                <?php if (!empty(session()->getFlashdata('success'))): ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata('success'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

                <?php if (!empty(session()->getFlashdata('fail'))): ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('fail'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
                <input type="hidden" class="form-control" id="id" name="id" value="<?= $jadwal['id_jadwal']; ?>">

                <div class="row mb-3">
                    <label for="mk" class="col-sm-2 col-form-label">Mata Kuliah</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="mk" name="mk" value="<?= $jadwal['mk']; ?>">
                    </div>
                </div>
                <?php if ($validation->getError('mk')): ?>
                    <div class="d-block text-danger" style="margin-top:-10px;margin-bottom:15px;margin-left:180px;">
                        <?= $validation->getError('mk'); ?>
                    </div>
                <?php endif; ?>
                <div class="row mb-3">
                    <label for="nama_dosen" class="col-sm-2 col-form-label">Nama Dosen</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama_dosen" name="nama_dosen"
                            value="<?= $jadwal['nama_dosen'] ?>">
                    </div>
                </div>
                <?php if ($validation->getError('nama_dosen')): ?>
                    <div class="d-block text-danger" style="margin-top:-10px;margin-bottom:15px;margin-left:180px;">
                        <?= $validation->getError('nama_dosen'); ?>
                    </div>
                <?php endif; ?>
                <div class="row mb-3">
                    <label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="kelas" name="kelas" value="<?= $jadwal['kelas'] ?>">
                    </div>
                </div>
                <?php if ($validation->getError('kelas')): ?>
                    <div class="d-block text-danger" style="margin-top:-10px;margin-bottom:15px;margin-left:180px;">
                        <?= $validation->getError('kelas'); ?>
                    </div>
                <?php endif; ?>
                <div id="jam-container" style="display:none;" class="row mb-3">
                    <label for="jam" class="col-sm-2 col-form-label">Jam</label>
                    <div class="col-sm-10" id="jam-list">
                        <!-- Jam options will be loaded here dynamically -->
                    </div>
                </div>
                <?php if ($validation->getError('jam')): ?>
                    <div class="d-block text-danger" style="margin-top:-10px;margin-bottom:15px;margin-left:180px;">
                        <?= $validation->getError('jam'); ?>
                    </div>
                <?php endif; ?>
                <div class="row mb-3">
                    <label for="nama_prodi" class="col-sm-2 col-form-label">Prodi</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama_prodi" name="nama_prodi"
                            value="<?= $jadwal['nama_prodi'] ?>">
                    </div>
                </div>
                <?php if ($validation->getError('nama_prodi')): ?>
                    <div class="d-block text-danger" style="margin-top:-10px;margin-bottom:15px;margin-left:180px;">
                        <?= $validation->getError('nama_prodi'); ?>
                    </div>
                <?php endif; ?>
                <div class="row mb-3">
                    <label for="nama_ruangan" class="col-sm-2 col-form-label">Ruangan</label>
                    <div class="col-sm-10">
                        <select name="nama_ruangan" id="nama_ruangan" class="form-control" onchange="getJamByRuangan()">
                            <?php foreach ($ruangan as $item): ?>
                                <option value="<?= $item['id_ruangan']; ?>"
                                    <?= $jadwal['nama_ruangan'] == $item['nama_ruangan'] ? 'selected' : ''; ?>>
                                    <?= $item['nama_ruangan']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <?php if ($validation->getError('nama_ruangan')): ?>
                    <div class="d-block text-danger" style="margin-top:-10px;margin-bottom:15px;margin-left:180px;">
                        <?= $validation->getError('nama_ruangan'); ?>
                    </div>
                <?php endif; ?>
                <div class="row mb-3">
                    <label for="jenis" class="col-sm-2 col-form-label">Jenis</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="jenis" name="jenis" value="<?= $jadwal['jenis'] ?>">
                    </div>
                </div>
                <?php if ($validation->getError('jenis')): ?>
                    <div class="d-block text-danger" style="margin-top:-10px;margin-bottom:15px;margin-left:180px;">
                        <?= $validation->getError('jenis'); ?>
                    </div>
                <?php endif; ?>
                <input type="hidden" class="form-control" id="tahun" name="tahun" value="<?= $tahun; ?>">
                <div class="row mb-3">
                    <label for="hari" class="col-sm-2 col-form-label">Hari</label>
                    <div class="col-sm-10">
                        <select name="hari" id="hari" class="form-control" onchange="getJamByRuangan()">
                            <option value=""></option>
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                        </select>
                    </div>
                </div>
                <?php if ($validation->getError('hari')): ?>
                    <div class="d-block text-danger" style="margin-top:-10px;margin-bottom:15px;margin-left:180px;">
                        <?= $validation->getError('hari'); ?>
                    </div>
                <?php endif; ?>
                <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah Anda yakin?');">Simpan
                    Data</button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>

<script>
    function getJamByRuangan() {
        const idRuangan = $('#nama_ruangan').val();
        const tahun = $('#tahun').val();
        const hari = $('#hari').val();
        const jenis = $('#jenis').val();

        if (idRuangan && hari) {
            $.ajax({
                url: "<?= base_url('/admin/jadwal-ajax-admin') ?>",
                type: "POST",
                data: {
                    id_ruangan: idRuangan,
                    hari: hari,
                    tahun: tahun,
                    jenis: jenis,
                },
                dataType: "JSON",
                success: function (response) {
                    console.log(response);
                    if (response.length > 0) {
                        $('#jam-container').show();
                        $('#jam-list').html(''); // Bersihkan konten sebelumnya

                        response.forEach(function (jam) {
                            const checkboxHtml = `
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="${jam.id}" id="jam${jam.id}" name="jam[]" ${jam.sudah_dipilih ? 'disabled' : ''}>
                                    <label class="form-check-label" for="jam${jam.id}">
                                        ${jam.jam}
                                    </label>
                                </div>
                            `;
                            $('#jam-list').append(checkboxHtml);
                        });
                    } else {
                        $('#jam-container').hide();
                    }
                },
                error: function (xhr, status, error) {
                    console.error('AJAX Error:', status, error, xhr);
                }
            });
        } else {
            $('#jam-container').hide();
            $('#jam-list').html('');
        }
    }
</script>

<?= $this->endSection(); ?>
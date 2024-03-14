<?= $this->extend('backend/layout/user-layout'); ?>

<?= $this->section('content'); ?>

<!-- breadcrumb-section -->
<div class="breadcrumb-section breadcrumb-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="breadcrumb-text">
                    <p>Lab UPA-TIK</p>
                    <h2>Form Pengajuan Jadwal <br> UTS Tahun <br> 2023-2024</h2>
                </div>
            </div>
        </div>
    </div>
</div>


<?php if (!empty(session()->getFlashdata('errors'))): ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('errors'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <spance aria-hidden="true">&times;</spance>
        </button>
    </div>
<?php endif; ?>
<div class="container mt-5">
    <div class="row">
        <div class="col">
            <h2 class="mt-3">Form Pengajuan Jadwal UTS</h2>
            <form action="/user/jadwal-save-uts" method="POST">

                <div class="row mb-3">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Mata Kuliah</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="mk " name="mk">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Kelas</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="kelas" name="kelas">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Ruangan Lab</label>
                    <div class="col-sm-10">
                        <select name="nama_ruangan" id="nama_ruangan" class="form-control"
                            onchange="getJamByRuangan2()">
                            <option value="">Pilih Ruangan</option>
                            <?php foreach ($ruangan as $row): ?>
                                <option value=" <?= $row['id_ruangan'] ?>">
                                    <?= $row['nama_ruangan'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Hari</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="hari" name="hari" onchange="getJamByRuangan2()">
                            <option value="">Pilih Hari</option>
                            <?php foreach ($hari as $h): ?>
                                <option value="<?= $h ?>">
                                    <?= $h ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Nama Dosen</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="dosen" name="dosen">
                    </div>
                </div>
                <input type="hidden" class="form-control" id="prodi" name="prodi" value="<?= $idProdi; ?>">
                <input type="hidden" class="form-control" id="tahun" name="tahun" value="<?= $tahun; ?>">

                <div id="jam-container" style="display:none;">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="jam" name="jam[]">
                        <label class="form-check-label" for="jam">
                            jam
                        </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mb-3">Daftar</button>
            </form>

        </div>
    </div>
</div>
<!-- end breadcrumb section -->

<script>
    function getJamByRuangan2() {
        const idRuangan = $('#nama_ruangan').val();
        const tahun = $('#tahun').val();
        const hari = $('#hari').val();
        if (idRuangan && hari) {
            $.ajax({
                url: "<?= base_url('/user/jadwal-ajax-2') ?>",
                type: "POST",
                data: {
                    id_ruangan: idRuangan,
                    hari: hari,
                    tahun: tahun,
                },
                dataType: "JSON",
                success: function (response) {
                    console.log(response);
                    if (response.length > 0) {
                        $('#jam-container').show();
                        $('#jam-container').html(''); // Bersihkan konten sebelumnya

                        response.forEach(function (jam) {
                            const checkboxHtml = `
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="${jam.id}" id="jam${jam.id}" name="jam[]" ${jam.sudah_dipilih ? 'disabled' : ''}>
                                <label class="form-check-label" for="jam${jam.id}">
                                    ${jam.jam}
                                </label>
                            </div>
                        `;

                            $('#jam-container').append(checkboxHtml);
                        });
                    } else {
                        $('#jam-container').hide();

                    }
                },

                error: function (xhr, status, error) {
                    console.error('AJAX Error:');
                    console.error('Status:', status);
                    console.error('Error:', error);
                    console.error('XHR:', xhr);

                    // Jika response JSON tersedia, coba log response
                    try {
                        var response = JSON.parse(xhr.responseText);
                        console.error('Response:', response);
                    } catch (e) {
                        console.error('Error parsing JSON response:', e);
                    }
                }
            });
        } else {
            $('#jam-container').hide();
            $('#jam-list').html('');
        }
    }
</script>



<?= $this->endSection(); ?>
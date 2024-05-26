<?= $this->extend('backend/layout/pages-layout'); ?>

<?= $this->section('content'); ?>


<div class="swal" data-swal="<?= session('success'); ?>"></div>

<h1 class="my-3 text-center">Pengajuan Jadwal Reguler</h1>

<table class="table table-bordered table-hover my-3 table-responsive-xl">
    <thead class="thead-dark">
        <tr class="text-center">
            <th scope="col">No</th>
            <th scope="col">Mata Kuliah</th>
            <th scope="col">Dosen</th>
            <th scope="col">Kelas</th>
            <th scope="col">Jam</th>
            <th scope="col">Program Studi</th>
            <th scope="col">Semester</th>
            <th scope="col">Ruangan</th>
            <th scope="col">Jenis</th>
            <th scope="col">Hari</th>
            <th scope="col">Tahun</th>
            <th scope="col">Aksi</th>
        </tr>
    <tbody>

        <?php

        $page = intval($_GET['page_jadwal'] ?? 1);

        // Jika parameter tidak ada, atur nilai default ke 1
        if ($page <= 0) {
            $page = 1;
        }

        // Hitung nilai $i
        $i = 1 + (10 * ($page - 1));
        ?>
        <?php foreach ($pengajuan as $jadwal): ?>
            <tr class="text-center">
                <td scope="row">
                    <?= $i++; ?>
                </td>
                <td>
                    <?= $jadwal['mk']; ?>
                </td>
                <td>
                    <?= $jadwal['nama_dosen']; ?>
                </td>
                <td>
                    <?= $jadwal['kelas']; ?>
                </td>
                <td>
                    <?= $jadwal['jam']; ?>
                </td>
                <td>
                    <?= $jadwal['nama_prodi']; ?>
                </td>
                <td>
                    <?= $jadwal['semester']; ?>
                </td>
                <td>
                    <?= $jadwal['nama_ruangan']; ?>
                </td>
                <td>
                    <?= $jadwal['jenis']; ?>
                </td>
                <td>
                    <?= $jadwal['hari']; ?>
                </td>
                <td>
                    <?= $jadwal['thn_awal']; ?>-
                    <?= $jadwal['thn_akhir']; ?>
                </td>
                <td>
                    <a href="/admin/hapus_data_pengajuan/<?= $jadwal['id_jadwal']; ?>" class="btn btn-danger my-2"
                        data-toggle="modal" data-target="#success-modal">Reject</a>
                    <a href="/admin/approve_data_pengajuan/<?= $jadwal['id_jadwal']; ?>" class="btn btn-success">Approve</a>
                </td>
            </tr>

        <?php endforeach; ?>
    </tbody>
</table>
<div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body  font-18 mx-4">
                <h3 class="mb-20">Silahkan isi form untuk user</h3>
                <form id="myForm" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="notif" name="notif">

                        </div>
                        <input type="hidden" class="form-control" id="jenis" name="jenis"
                            value="<?= isset($jadwal['jenis']) ? $jadwal['jenis'] : ''; ?>">
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-dark btn-lg"><i class="bi bi-send"></i></button>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-center">
                <?php if (isset($jadwal['id_jadwal'])): ?>
                    <a href="<?= route_to('admin.hapus.data.pengajuan', $jadwal['id_jadwal']) ?>"
                        class="btn btn-primary">Reject</a>
                <?php endif; ?>
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <?= $pager->links('pengajuan', 'my_pagination'); ?>
    </div>
</div>

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
<script>
    document.getElementById("myForm").addEventListener("submit", function (event) {
        event.preventDefault(); // Mencegah perilaku bawaan formulir untuk mengirimkan permintaan ke server dan memperbarui halaman

        var formData = new FormData(this);

        // Kirim data formulir ke server menggunakan AJAX
        fetch("/user/jadwal-prodi-reguler/<?= isset($jadwal['id_prodi']) ? $jadwal['id_prodi'] : ''; ?>", {
            method: 'POST',
            body: formData
        })
            .then(response => {
                if (response.ok) {
                    alert("Berhasil Mengirim Pesan."); // Tampilkan pesan jika permintaan berhasil
                } else {
                    alert("Gagal Mengirim Pesan."); // Tampilkan pesan jika permintaan gagal
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });
</script>
<?= $this->endSection(); ?>
<?= $this->extend('backend/layout/pages-layout'); ?>

<?= $this->section('content'); ?>

<?php if (!empty (session()->getFlashdata('success'))): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <spance aria-hidden="true">&times;</spance>
        </button>
    </div>
<?php endif; ?>

<h1 class="my-3">Jadwal Reguler</h1>
<div class="container">
    <div class="col">
        <form action="<?= route_to('admin.jadwal') ?>" method="post">
            <div class="form-group mb-0">
                <div class="input-group-prepend">
                    <button class="btn btn-outline-secondary" type="button" id="button-addon1">Cari</button>
                    <input type="text" class="form-control search-input" placeholder="Cari Jadwal" name="keyword" />
                </div>

            </div>
        </form>
    </div>
</div>

<table class="table table-bordered my-3 table-responsive-xl">
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
        $keyword = session('jadwal_keyword');

        $page = intval($_GET['page_jadwal'] ?? 1);

        // Jika parameter tidak ada, atur nilai default ke 1
        if ($page <= 0) {
            $page = 1;
        }

        // Hitung nilai $i
        $i = 1 + (10 * ($page - 1));
        ?>
        <?php foreach ($jadwal as $jadwal): ?>
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
                    <a href="/admin/hapus_data_jadwal/<?= $jadwal['id_jadwal']; ?>"
                        onclick="return confirm('apakah anda yakin');" class="btn btn-danger my-2">Delete</a>
                    <a href="/admin/jadwal-edit/<?= $jadwal['id_jadwal']; ?>" class="btn btn-success">Edit</a>
                </td>
            </tr>

        <?php endforeach; ?>
    </tbody>
</table>
<div class="row my-3">
    <div class="col">
        <a href="<?= route_to('jadwal.export.pdf') ?>" target="_blank" class="btn btn-warning">Export PDF</a>
        <a href="#" class="btn btn-success" data-toggle="modal" data-target="#success-modal"> Export excel
        </a>
    </div>
</div>
<div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center font-18 mx-6">
                <h3 class="mb-20">Silahkan pilih akan di filter berdasarkan apa</h3>
                <ul id="accordion-menu">
                    <li class="dropdown btn btn-warning">
                        <a href="javascript:;" class="dropdown-toggle">
                            Filter Sesuai Jam
                        </a>
                        <ul class="submenu">
                            <li><a href="<?= route_to('admin.pengolahan.lab'); ?>"> 07.00 - 07.50</a></li>
                            <li><a href="<?= route_to('admin.fasilitas'); ?>"> 07.50 - 08.40 </a></li>
                            <li><a href="<?= route_to('admin.barang'); ?>">08.40 - 09.30</a></li>
                            <li><a href="<?= route_to('admin.ruangan'); ?>">09.30 - 10.20</a></li>
                            <li><a href="<?= route_to('admin.galeri'); ?>">10.40 - 11.30</a></li>
                            <li><a href="<?= route_to('admin.galeri'); ?>"> 11.30 - 12.20</a></li>
                            <li><a href="<?= route_to('admin.galeri'); ?>"> 12.50 - 13.40</a></li>
                            <li><a href="<?= route_to('admin.galeri'); ?>"> 13.40 - 14.30</a></li>
                            <li><a href="<?= route_to('admin.galeri'); ?>"> 14.30 - 15.20</a></li>
                            <li><a href="<?= route_to('admin.galeri'); ?>"> 15.20 - 16.40</a></li>
                            <li><a href="<?= route_to('admin.galeri'); ?>"> 16.40 - 17.30</a></li>
                        </ul>
                    </li>

                    <li class="dropdown btn btn-warning">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="mtext">Filter Hari</span>
                        </a>
                        <ul class="submenu">
                            <li><a
                                    href="<?= route_to('export.regulerFilter.excel', $jadwal['jenis'], $hari[0]); ?>">Senin</a>
                            </li>
                            <li><a href="<?= route_to('export.regulerFilter.excel', $jadwal['jenis'], $hari[1]); ?>">Selasa
                                </a></li>
                            <li><a
                                    href="<?= route_to('export.regulerFilter.excel', $jadwal['jenis'], $hari[2]); ?>">Rabu</a>
                            </li>
                            <li><a
                                    href="<?= route_to('export.regulerFilter.excel', $jadwal['jenis'], $hari[3]); ?>">Kamis</a>
                            </li>
                            <li><a
                                    href="<?= route_to('export.regulerFilter.excel', $jadwal['jenis'], $hari[4]); ?>">Jumat</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <?php if ($pager): ?>
            <?= $pager->links('jadwal', 'my_pagination'); ?>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection(); ?>
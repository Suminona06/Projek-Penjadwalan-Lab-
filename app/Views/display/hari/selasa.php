<?= $this->extend('backend/layout/display-layout'); ?>

<?= $this->section('content'); ?>

<div class="breadcrumb-section breadcrumb-bg">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 offset-lg-2 text-center">
				<div class="breadcrumb-text">
					<p>Lab UPA-TIK</p>
					<h1>Jadwal Reguler Tahun <br>
						<?= esc($thn_awal . '-' . $thn_akhir); ?>
						<br>Semester
						<?= $semester; ?>
					</h1>
				</div>
			</div>
		</div>
	</div>
</div>

<table class="table table-bordered my-3 table-responsive-xl">
<h4 class="font-weight-bold text-uppercase text-center mt-2">Selasa</h4>
    <thead class="thead-dark">
        <tr class="text-center">
            <th scope="col">No</th>
            <th scope="col">Lab</th>
            <th scope="col">Jam</th>
            <th scope="col">Kelas</th>
            <th scope="col">Program_studi</th>
            <th scope="col">Dosen</th>
        </tr>
    <tbody>

        <?php

        // Hitung nilai $i
        $i = 1 ;
        ?>
        <?php foreach ($jadwal as $jadwal): ?>
            <tr class="text-center">
                <td scope="row">
                    <?= $i++; ?>
                </td>
                <td>
                    <?= $jadwal['nama_ruangan']; ?>
                </td>
                <td>
                    <?= $jadwal['jam']; ?>
                </td>
                <td>
                    <?= $jadwal['kelas']; ?>
                </td>
                <td>
                    <?= $jadwal['nama_prodi']; ?>
                </td>
                <td>
                    <?= $jadwal['nama_dosen']; ?>
                </td>
            </tr>

        <?php endforeach; ?>
    </tbody>
</table>


<?= $this->endSection(); ?>
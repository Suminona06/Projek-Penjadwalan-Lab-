<?= $this->extend('backend/layout/user-layout'); ?>

<?= $this->section('content'); ?>

<!-- breadcrumb-section -->
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
<!-- end breadcrumb section -->

<div class="container">
	<div class="row text-center">
		<div class="col-lg-14 col-md-12 col-sm-12 tab">
			<br>
			<table class="table table-bordered table-responsive">
				<thead class="thead-dark">
					<tr class='days'>
						<th rowspan="2" style="text-align: center; vertical-align: middle;">HARI</th>
						<th rowspan="2" style="text-align: center; vertical-align: middle;">LAB</th>
						<th colspan="11">Waktu</th>

					</tr>
					<tr>
						<?php foreach ($jam as $j): ?>
							<th class="time-2">
								<?= esc($j->jam); ?>
							</th>
						<?php endforeach; ?>
					</tr>
					<!-- hari -->
					<?php foreach ($hari as $h): ?>
						<tr class="time">
							<th class="time" style="text-align: center; vertical-align: middle;"
								rowspan="<?= esc($jumlahLab); ?>">
								<?= esc($h); ?>
							</th>
							<?php $no = 1;
							foreach ($ruangan as $r): ?>
								<?php if ($no > 1): ?>
								<tr>
								<?php endif; ?>
								<th class="time">
									<?= esc($r->nama_ruangan); ?>
								</th>
								<?php foreach ($jam as $j): ?>
									<?php
									$kelas = ''; // Inisialisasi kelas
									foreach ($jadwal as $k) {
										// Cek apakah jadwal sesuai dengan hari, ruangan, dan jam saat ini
										if ($k->hari == $h && $k->id_ruangan == $r->id_ruangan && $k->id_jam == $j->id) {
											// Jika sesuai, isi variabel $kelas dengan nilai kolom 'kelas'
											$kelas = esc($k->kelas);
											break;
										}
									}
									?>
									<td style='color:black'>
										<?= esc($kelas); ?>
									</td>
								<?php endforeach; ?>

								<?php if ($no > 1): ?>
								</tr>
							<?php endif; ?>
							<?php $no++; ?>
						<?php endforeach; ?>
						</tr>
					<?php endforeach; ?>
				</thead>
				<tbody>

				</tbody>
			</table>
			<a href="<?= route_to('jadwal.reguler.export.pdf') ?>" target="_blank" class="btn btn-warning mb-2">Export
				PDF</a>
			<a href="<?= route_to('export.jadwal-reguler.excel') ?>" target="_blank" class="btn btn-success mb-2">Export
				Excel</a>
		</div>
	</div>
</div>




<?= $this->endSection(); ?>
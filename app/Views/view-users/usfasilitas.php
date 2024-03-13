<?php $this->extend('backend/layout/user-layout') ?>

<?= $this->section('content'); ?>

<div class="hero-area hero-bg">
  <div class="container">
    <div class="row">
      <div class="col-lg-9 offset-lg-2 text-center">
        <div class="hero-text">
          <div class="hero-text-tablecell">
            <p class="subtitle">UPA-TIK</p>
            <h1 class="subtitle">Politeknik Negeri Bandung</h1>
            <div class="hero-btns">
              <a href="<?= route_to('user.galeri'); ?>" class="bordered-btn">Galeri</a>
              <a href="<?= route_to('user.kontak'); ?>" class="bordered-btn">Kontak Kami</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end hero area -->



<div class="container6">
    <h2>Fasilitas
    </h2>
  </div>
<section class="accord">
  <div class="juacord">
    <h3>Software</h3>
    <h3>Hardware</h3>
    <h3>Barang</h3>
  </div>
  <div class="cont_ac">
    <div class="cont_accord">


    <div class="accordion accordion1" id="accordionExample">
  <?php foreach ($ruangan as $idRuangan => $fasilitas) : ?>
    <?php
    // Di sini Anda dapat mengakses data nama ruangan berdasarkan $idRuangan menggunakan metode yang sesuai dari model Anda
    // Misalnya, jika Anda memiliki model yang mengambil nama ruangan berdasarkan ID, Anda bisa menggunakan sesuatu seperti ini:
    $namaRuangan = $modelRuangan->find($idRuangan)['nama_ruangan'];
    ?>
    <div class="accordion-item">
      <h2 class="accordion-header" id="heading<?= $idRuangan ?>">
        <button class="accordion-button collapsed-down" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $idRuangan ?>" aria-expanded="false" aria-controls="collapse<?= $idRuangan ?>">
          Software <?= $namaRuangan ?> <!-- Menggunakan nama ruangan di sini -->
        </button>
      </h2>
      <div id="collapse<?= $idRuangan ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $idRuangan ?>" data-bs-parent="#accordionExample">
        <div class="accordion-body">
          <div class="row">
          <?php if (isset($ruangan[$idRuangan]['fasilitas'])) : ?>
           <?php foreach ($ruangan[$idRuangan]['fasilitas'] as $gambar) : ?>
             <div class="col-md-3">
             <figure>
        <img src="<?= base_url('img/' . $gambar['gambar']) ?>" class="img-fluid" alt="">
        <figcaption><?= $gambar['nama']; ?></figcaption>
    </figure>
             </div>
           <?php endforeach; ?>
           <?php else : ?>
          <p>Tidak ada data barang untuk ruangan ini.</p>
        <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>




    </div>


    <div class="cont_accord2">
    
    <div class="accordion accordion2" id="accordionFlushExample">
    <?php foreach ($ruangan as $idRuangan => $fasilitashw) : ?>
      <?php
    // Di sini Anda dapat mengakses data nama ruangan berdasarkan $idRuangan menggunakan metode yang sesuai dari model Anda
    // Misalnya, jika Anda memiliki model yang mengambil nama ruangan berdasarkan ID, Anda bisa menggunakan sesuatu seperti ini:
    $namaRuangan = $modelRuangan->find($idRuangan)['nama_ruangan'];
    ?>
  <div class="accordion-item">
    <h2 class="accordion-header" id="heading<?= $idRuangan ?>">
    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne<?= $idRuangan ?>" aria-expanded="false" aria-controls="flush-collapseOne<?= $idRuangan ?>">
      Hardware <?= $namaRuangan ?> <!-- Menggunakan nama ruangan di sini -->
      </button>
    </h2>
    <div id="flush-collapseOne<?= $idRuangan ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $idRuangan ?>" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">
        <div class="row">
        <?php if (isset($ruangan[$idRuangan]['fasilitashw'])) : ?>
           <?php foreach ($ruangan[$idRuangan]['fasilitashw'] as $gambarhw) : ?>
            <div class="col-md-3">
              <img src="<?= base_url('img/' . $gambarhw['gambar']) ?>" class="img-fluid" alt="">
             </div>
         <?php endforeach; ?>
         <?php else : ?>
          <p>Tidak ada data barang untuk ruangan ini.</p>
         <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
  <?php endforeach; ?>
</div>

    </div>


    <div class="cont_accord3">
    
    <div class="accordion accordion3" id="accordionPanelsStayOpenExample">
    <?php foreach ($ruangan as $idRuangan => $brg) : ?>
      <?php
    // Di sini Anda dapat mengakses data nama ruangan berdasarkan $idRuangan menggunakan metode yang sesuai dari model Anda
    // Misalnya, jika Anda memiliki model yang mengambil nama ruangan berdasarkan ID, Anda bisa menggunakan sesuatu seperti ini:
    $namaRuangan = $modelRuangan->find($idRuangan)['nama_ruangan'];
    ?>
  <div class="accordion-item">
    <h2 class="accordion-header" id="heading<?= $idRuangan ?>">
    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne<?= $idRuangan ?>" aria-expanded="false" aria-controls="panelsStayOpen-collapseOne<?= $idRuangan ?>">
      Barang <?= $namaRuangan ?> <!-- Menggunakan nama ruangan di sini -->
      </button>
    </h2>
    <div id="panelsStayOpen-collapseOne<?= $idRuangan ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $idRuangan ?>" data-bs-parent="#accordionPanelsStayOpenExample">
      <div class="accordion-body">
        <div class="row">
        <?php if (isset($ruangan[$idRuangan]['barang'])) : ?>
           <?php foreach ($ruangan[$idRuangan]['barang'] as $databrg) : ?>
             <p><?= $databrg['deskripsi']; ?></p>
         <?php endforeach; ?>
         <?php else : ?>
          <p>Tidak ada data barang untuk ruangan ini.</p>
         <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
  <?php endforeach; ?>
</div>

    </div>

    

  

  </div>
</section>

<script src="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>

<script>
  $(document).ready(function() {
    // Saat tombol accordion diklik
    $('.accordion-button').click(function() {
      // Ambil posisi scroll sebelum collapse
      var scrollPos = $(window).scrollTop();

      // Tunggu sedikit sebelum mengatur kembali posisi scroll setelah collapse selesai
      setTimeout(function() {
        // Atur kembali posisi scroll ke posisi sebelum collapse
        $(window).scrollTop, (scrollPos);
      }, 300); // Sesuaikan dengan durasi animasi collapse, jika menggunakan animasi
    });
  });
</script>

<?= $this->endSection(); ?>
<?= $this->extend('layouts/adminTemplate'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid p-0">
  <h1 class="display-6 mb-3"><?= $kamar['nama']; ?></h1>

  <div class="row">
    <div class="col-md-4">
      <div class="card">
        <ul class="list-group list-group-flush">
          <li class="list-group-item py-3"><strong>Tipe : </strong><?= $kamar['tipe']; ?></li>
          <li class="list-group-item py-3"><strong>Harga : </strong>Rp <?= number_format($kamar['harga'], '0', '', '.'); ?></li>
          <li class="list-group-item py-3"><strong>Luas : </strong><?= $kamar['luas']; ?> m<sup>2</sup></li>
          <li class="list-group-item py-3"><strong>Kapasitas : </strong><?= $kamar['kapasitas']; ?> orang</li>
          <li class="list-group-item py-3"><strong>Hewan Peliharaan : </strong><?= ($kamar['hewan'] > 0) ? 'Yes' : 'No'; ?></li>
          <li class="list-group-item py-3"><strong>Sarapan : </strong><?= ($kamar['sarapan'] > 0) ? 'Yes' : 'No'; ?></li>
          <li class="list-group-item py-3"><strong>Internet : </strong><?= ($kamar['internet'] > 0) ? 'Yes' : 'No'; ?></li>
          <li class="list-group-item py-3"><strong>Featured : </strong><?= ($kamar['featured'] > 0) ? 'Yes' : 'No'; ?></li>
        </ul>
      </div>
      <a class="badge bg-secondary text-decoration-none" href="<?= base_url('/admin/kamar'); ?>">Kembali ke daftar</a>
    </div>
    <div class="col-md-8">
      <div class="card">
        <img src="/images/<?= $kamar['foto']; ?>" class="card-img-top" alt="<?= $kamar['nama']; ?>">
        <div class="card-body">
          <p class="card-text"><?= $kamar['deskripsi']; ?></p>
        </div>
      </div>
    </div>
  </div>
  <div class="row">

    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h2>Gallery</h2>
        </div>
        <div class="card-body">
          <div class="row">
            <?php foreach ($gallery as $g) : ?>
              <div class="col-md-4">
                <img src="/images/<?= $g; ?>" width="350px" class="img-fluid mb-4">
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<?= $this->endSection(); ?>
<?= $this->extend('layouts/adminTemplate'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid p-0">
  <h1 class="h3 mb-3"><?= $title; ?></h1>

  <div class="row">
    <div class="col-12 col-lg-12 col-xxl-9">

      <div class="row justify-content-between">
        <div class="col-sm-3">
          <a href="<?= base_url('/admin/kamar/create') ?>" class="btn btn-primary mb-3 d-block d-print-none"><i data-feather="plus"></i>Tambah Data Kamar</a>
        </div>
        <div class="col-sm-3">
          <a href="#" onclick="window.print()" class="btn btn-success mb-3 d-block d-print-none"><i data-feather="printer"></i>Print</a>
        </div>
      </div>

      <?php if (session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-success alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <div class="alert-message">
            <?= session()->getFlashdata('pesan'); ?>
          </div>
        </div>
      <?php endif; ?>

      <div class="card">
        <table class="table">
          <thead>
            <tr>
              <th>Nama</th>
              <th class="d-none d-xl-table-cell d-print-table-cell">Tipe</th>
              <th>Harga</th>
              <th class="d-none d-xl-table-cell d-print-table-cell">Di Order</th>
              <th style="width: 20%;" class="d-print-none">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($kamar as $k) : ?>
              <tr>
                <td><?= $k['nama']; ?></td>
                <td class="d-none d-xl-table-cell d-print-table-cell"><?= $k['tipe']; ?></td>
                <td>Rp <?= number_format($k['harga'], '0', '', '.'); ?></td>
                <td class="d-none d-xl-table-cell d-print-table-cell"><strong><?= $k['number_order']; ?></strong> kali</td>
                <td class="table-action d-print-none">
                  <a href="<?= base_url("/admin/kamar/" . $k['slug']); ?>" class="btn btn-outline"><i class="align-middle" data-feather="eye"></i></a>
                  <a href="<?= base_url("/admin/kamar/edit/" . $k['slug']); ?>" class="btn btn-outline"><i class="align-middle" data-feather="edit-2"></i></a>
                  <form action="<?= base_url("/admin/kamar/" . $k['id']); ?>" method="post" class="d-inline">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="_method" value="DELETE">
                    <button class="btn btn-outline" type="submit" onclick="return confirm('Anda yakin ?');"><i class="align-middle" data-feather="trash"></i></button>
                  </form>

                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>
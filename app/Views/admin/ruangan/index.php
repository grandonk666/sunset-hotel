<?= $this->extend('layouts/adminTemplate'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid p-0">
  <h1 class="h3 mb-3"><?= $title; ?></h1>

  <div class="row">
    <div class="col-12 col-lg-12 col-xxl-9">

      <div class="row justify-content-between">
        <div class="col-md-3">
          <a href="<?= base_url('/admin/ruangan/create') ?>" class="btn btn-primary mb-3 d-block"><i data-feather="plus"></i>Tambah Data Ruangan</a>
        </div>
        <div class="col-md-7">
          <form action="" method="post">
            <div class="form-group row">
              <div class="col-sm-5 mb-3">
                <select class="form-select" name="jenis" id="jenis">
                  <option <?= (!array_key_exists('id_kamar', $filter)) ? 'selected' : '' ?> value="all">
                    Jenis Kamar
                  </option>
                  <option value="all">Tampilkan Semua</option>
                  <?php foreach ($kamar_model->orderBy('tipe', 'asc')->findAll() as $kamar) : ?>
                    <option value="<?= $kamar['id']; ?>" <?= (array_key_exists('id_kamar', $filter) && $kamar['id'] == $filter['id_kamar']) ? 'selected' : '' ?>>
                      <?= $kamar['nama']; ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="col-sm-5 mb-3">
                <select class="form-select" name="status" id="status">
                  <option <?= (!array_key_exists('tersedia', $filter)) ? 'selected' : '' ?> value="all">Status</option>
                  <option value="all">Tampilkan Semua</option>
                  <option <?= (array_key_exists('tersedia', $filter) && $filter['tersedia'] == 1) ? 'selected' : '' ?> value="1">
                    Tersedia
                  </option>
                  <option <?= (array_key_exists('tersedia', $filter) && $filter['tersedia'] == 0) ? 'selected' : '' ?> value="0">
                    Dipesan
                  </option>
                </select>
              </div>
              <div class="col-sm-2 mb-3">
                <button type="submit" name="submit" value="submit" class="btn btn-secondary">Filter</button>
              </div>
            </div>
          </form>
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
              <th style="width: 20%">Nomor Ruangan</th>
              <th style="width: 35%">Jenis Kamar</th>
              <th style="width: 20%">Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($ruangan as $r) : ?>
              <tr>
                <td><?= $r['nomor_ruangan']; ?></td>
                <td>
                  <a class="text-reset text-decoration-none" href="<?= base_url('admin/kamar/' . $kamar_model->find($r['id_kamar'])['slug']) ?>">
                    <strong><?= $kamar_model->find($r['id_kamar'])['nama'] ?></strong>
                  </a>
                </td>
                <td>
                  <span class="badge <?= ($r['tersedia'] > 0) ? 'bg-success' : 'bg-danger' ?>">
                    <?= ($r['tersedia'] > 0) ? 'Tersedia' : 'Dipesan' ?>
                  </span>
                </td>
                <td class="table-action">
                  <a href="<?= base_url("/admin/ruangan/edit/" . $r['id']); ?>" class="btn btn-outline"><i class="align-middle" data-feather="edit-2"></i></a>
                  <form action="<?= base_url("/admin/ruangan/" . $r['id']); ?>" method="post" class="d-inline">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="_method" value="DELETE">
                    <button class="btn btn-outline" type="submit" onclick="return confirm('Anda yakin ?');"><i class="align-middle" data-feather="trash"></i></button>
                  </form>

                  <form action="<?= base_url("/admin/ruangan/status/" . $r['id']); ?>" method="post" class="d-none d-xl-inline">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="change-status" value="<?= ($r['tersedia'] > 0) ? 0 : 1 ?>">
                    <button class="btn btn-sm <?= ($r['tersedia'] > 0) ? 'btn-outline-danger' : 'btn-outline-success' ?>" type="submit"><?= ($r['tersedia'] > 0) ? 'Dipesan' : 'Tersedia' ?></button>

                  </form>

                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <?= $pager->links('ruangan', 'default_full'); ?>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>
<?= $this->extend('layouts/adminTemplate'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid p-0">

  <h1 class="h3 mb-3"><?= $title; ?></h1>

  <div class="row">
    <div class="col-md-9">
      <div class="card">
        <div class="card-body">

          <form action="<?= base_url('/admin/ruangan/save'); ?>" method="post">
            <?= csrf_field(); ?>

            <div class="form-group row mb-3">
              <label for="nomor_ruangan" class="col-form-label col-sm-3">Nomor Ruangan</label>
              <div class="col-sm-9">
                <input type="text" class="form-control <?= ($validation->hasError('nomor_ruangan')) ? 'is-invalid' : ''; ?>" id="nomor_ruangan" name="nomor_ruangan" value="<?= old('nomor_ruangan'); ?>">
                <div class="invalid-feedback">
                  <?= $validation->getError('nomor_ruangan'); ?>
                </div>
              </div>
            </div>

            <div class="form-group row mb-3">
              <label for="kamar" class="col-sm-3 col-form-label">Jenis Kamar</label>
              <div class="col-sm-9">
                <select class="form-select" name="kamar" id="kamar" required>
                  <option selected disabled>Pilih jenis kamar</option>
                  <?php foreach ($kamar as $k) : ?>
                    <option value="<?= $k['id']; ?>"><?= $k['nama']; ?></option>
                  <?php endforeach; ?>
                </select>
                <div class="invalid-feedback">
                  <?= $validation->getError('kamar'); ?>
                </div>
              </div>
            </div>

            <div class="form-group row mb-3">
              <label for="status" class="col-sm-3 col-form-label">Status</label>
              <div class="col-sm-9">
                <select class="form-select" name="status" id="status" required>
                  <option selected disabled>Pilih salah satu</option>
                  <option value="1">Tersedia</option>
                  <option value="0">Dipesan</option>
                </select>
                <div class="invalid-feedback">
                  <?= $validation->getError('status'); ?>
                </div>
              </div>
            </div>

            <div class="form-group row mt-4 justify-content-end">
              <div class="col-sm-4">
                <button type="submit" class="btn btn-primary">Tambah Data</button>
                <a class="btn btn-warning" href="<?= base_url('/admin/ruangan'); ?>">Batal</a>
              </div>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>
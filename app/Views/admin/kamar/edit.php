<?= $this->extend('layouts/adminTemplate'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid p-0">

  <h1 class="h3 mb-3"><?= $title; ?></h1>

  <div class="row">
    <div class="col-md-9">
      <div class="card">
        <div class="card-body">

          <form action="<?= base_url('/admin/kamar/update/' . $kamar['id']); ?>" method="post" enctype="multipart/form-data" class="form-buku">
            <?= csrf_field(); ?>

            <div class="form-group row mb-3">
              <label for="nama" class="col-sm-2 col-form-label">Nama</label>
              <div class="col-sm-10">
                <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="nama" name="nama" autofocus value="<?= (old('nama')) ? old('nama') : $kamar['nama']; ?>">
                <div class="invalid-feedback">
                  <?= $validation->getError('nama'); ?>
                </div>
              </div>
            </div>

            <div class="form-group row mb-3">
              <label for="tipe" class="col-sm-2 col-form-label">Tipe</label>
              <div class="col-sm-10">
                <input type="text" class="form-control <?= ($validation->hasError('tipe')) ? 'is-invalid' : ''; ?>" id="tipe" name="tipe" value="<?= (old('tipe')) ? old('tipe') : $kamar['tipe']; ?>">
                <div class="invalid-feedback">
                  <?= $validation->getError('tipe'); ?>
                </div>
              </div>
            </div>

            <div class="form-group row mb-3">
              <label for="harga" class="col-sm-2 col-form-label">Harga</label>
              <div class="col-sm-10">
                <input type="number" class="form-control <?= ($validation->hasError('harga')) ? 'is-invalid' : ''; ?>" id="harga" name="harga" value="<?= (old('harga')) ? old('harga') : $kamar['harga']; ?>">
                <div class="invalid-feedback">
                  <?= $validation->getError('harga'); ?>
                </div>
              </div>
            </div>

            <div class="form-group row mb-3">
              <label for="luas" class="col-sm-2 col-form-label">Luas</label>
              <div class="col-sm-10">
                <input type="number" class="form-control <?= ($validation->hasError('luas')) ? 'is-invalid' : ''; ?>" id="luas" name="luas" value="<?= (old('luas')) ? old('luas') : $kamar['luas']; ?>">
                <div class="invalid-feedback">
                  <?= $validation->getError('luas'); ?>
                </div>
              </div>
            </div>

            <div class="form-group row mb-3">
              <label for="kapasitas" class="col-sm-2 col-form-label">Kapasitas</label>
              <div class="col-sm-10">
                <input type="number" class="form-control <?= ($validation->hasError('kapasitas')) ? 'is-invalid' : ''; ?>" id="kapasitas" name="kapasitas" value="<?= (old('kapasitas')) ? old('kapasitas') : $kamar['kapasitas']; ?>">
                <div class="invalid-feedback">
                  <?= $validation->getError('kapasitas'); ?>
                </div>
              </div>
            </div>

            <div class="form-group row mb-3 justify-content-end">
              <div class="col-sm-10">
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" value="1" name="hewan" id="hewan" <?= ($kamar['hewan'] != 0) ? 'checked' : '' ?>>
                  <label class="form-check-label" for="hewan">Hewan Peliharaan</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" value="1" name="sarapan" id="sarapan" <?= ($kamar['sarapan'] != 0) ? 'checked' : '' ?>>
                  <label class="form-check-label" for="sarapan">Sarapan</label>
                </div>
              </div>
            </div>

            <div class="form-group row mb-3 justify-content-end">
              <div class="col-sm-10">
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" value="1" name="internet" id="internet" <?= ($kamar['internet'] != 0) ? 'checked' : '' ?>>
                  <label class="form-check-label" for="internet">Internet</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" value="1" name="featured" id="featured" <?= ($kamar['featured'] != 0) ? 'checked' : '' ?>>
                  <label class="form-check-label" for="featured">Featured</label>
                </div>
              </div>
            </div>

            <div class="form-group row mb-3">
              <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
              <div class="col-sm-10">
                <input type="text" class="form-control <?= ($validation->hasError('deskripsi')) ? 'is-invalid' : ''; ?>" id="deskripsi" name="deskripsi" value="<?= (old('deskripsi')) ? old('deskripsi') : $kamar['deskripsi']; ?>">
                <div class="invalid-feedback">
                  <?= $validation->getError('deskripsi'); ?>
                </div>
              </div>
            </div>

            <div class="form-group row mb-3">
              <label for="foto" class="col-sm-2 col-form-label">Foto Utama</label>
              <div class="col-sm-10">
                <input type="file" class="custom-file-input <?= ($validation->hasError('foto')) ? 'is-invalid' : ''; ?>" id="foto" name="foto" onchange="fotoLabel();">
                <div class="invalid-feedback">
                  <?= $validation->getError('foto'); ?>
                </div>
                <label class="custom-foto-label" for="foto"><?= $kamar['foto']; ?></label>
              </div>
            </div>

            <div class="form-group row mb-3">
              <label for="gallery" class="col-sm-2 col-form-label">Gallery</label>
              <div class="col-sm-10">
                <input type="file" class="custom-file-input <?= ($validation->hasError('gallery')) ? 'is-invalid' : ''; ?>" id="gallery" name="gallery[]" onchange="galleryLabel();" multiple>
                <div class="invalid-feedback">
                  <?= $validation->getError('gallery'); ?>
                </div>
                <label class="custom-gallery-label" for="gallery"><?= count($gallery) . ' files' ?></label>
              </div>
            </div>

            <div class="form-group row mt-4 justify-content-end">
              <div class="col-sm-4">
                <button type="submit" class="btn btn-primary">Ubah Data</button>
                <a class="btn btn-warning" href="<?= base_url('/admin/kamar'); ?>">Batal</a>
              </div>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>
<?= $this->extend('layouts/adminTemplate'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid p-0">

  <h1 class="h3 mb-3"><?= $title; ?></h1>

  <div class="row">
    <div class="col-md-9">
      <div class="card">
        <div class="card-body">

          <form action="<?= base_url('/admin/kamar/save'); ?>" method="post" enctype="multipart/form-data" class="form-buku">

            <?= csrf_field(); ?>

            <div class="form-group row mb-3">
              <label for="nama" class="col-form-label col-sm-2">Nama</label>
              <div class="col-sm-10">
                <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="nama" name="nama" value="<?= old('nama'); ?>">
                <div class="invalid-feedback">
                  <?= $validation->getError('nama'); ?>
                </div>
              </div>
            </div>

            <div class="form-group row mb-3">
              <label for="tipe" class="col-form-label col-sm-2">Tipe</label>
              <div class="col-sm-10">
                <input type="text" class="form-control <?= ($validation->hasError('tipe')) ? 'is-invalid' : ''; ?>" id="tipe" name="tipe" value="<?= old('tipe'); ?>">
                <div class="invalid-feedback">
                  <?= $validation->getError('tipe'); ?>
                </div>
              </div>
            </div>

            <div class="form-group row mb-3">
              <label for="harga" class="col-form-label col-sm-2">Harga</label>
              <div class="col-sm-10">
                <input type="number" class="form-control <?= ($validation->hasError('harga')) ? 'is-invalid' : ''; ?>" id="harga" name="harga" value="<?= old('harga'); ?>">
                <div class="invalid-feedback">
                  <?= $validation->getError('harga'); ?>
                </div>
              </div>
            </div>

            <div class="form-group row mb-3">
              <label for="luas" class="col-form-label col-sm-2">Luas</label>
              <div class="col-sm-10">
                <input type="number" class="form-control <?= ($validation->hasError('luas')) ? 'is-invalid' : ''; ?>" id="luas" name="luas" value="<?= old('luas'); ?>">
                <div class="invalid-feedback">
                  <?= $validation->getError('luas'); ?>
                </div>
              </div>
            </div>

            <div class="form-group row mb-3">
              <label for="kapasitas" class="col-form-label col-sm-2">Kapasitas</label>
              <div class="col-sm-10">
                <input type="number" class="form-control <?= ($validation->hasError('kapasitas')) ? 'is-invalid' : ''; ?>" id="kapasitas" name="kapasitas" value="<?= old('kapasitas'); ?>">
                <div class="invalid-feedback">
                  <?= $validation->getError('kapasitas'); ?>
                </div>
              </div>
            </div>

            <div class="form-group row mb-3 justify-content-end">
              <div class="col-sm-10">
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" value="1" name="hewan" id="hewan">
                  <label class="form-check-label" for="hewan">Hewan Peliharaan</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" value="1" name="sarapan" id="sarapan">
                  <label class="form-check-label" for="sarapan">Sarapan</label>
                </div>
              </div>
            </div>

            <div class="form-group row mb-3 justify-content-end">
              <div class="col-sm-10">
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" value="1" name="internet" id="internet">
                  <label class="form-check-label" for="internet">Internet</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" value="1" name="featured" id="featured">
                  <label class="form-check-label" for="featured">Featured</label>
                </div>
              </div>
            </div>

            <div class="form-group row mb-3">
              <label for="deskripsi" class="col-form-label col-sm-2">Deskripsi</label>
              <div class="col-sm-10">
                <input type="text" class="form-control <?= ($validation->hasError('deskripsi')) ? 'is-invalid' : ''; ?>" id="deskripsi" name="deskripsi" value="<?= old('deskripsi'); ?>">
                <div class="invalid-feedback">
                  <?= $validation->getError('deskripsi'); ?>
                </div>
              </div>
            </div>

            <div class="form-group row mb-3">
              <label for="foto" class="col-form-label col-sm-2">Foto Utama</label>
              <div class="col-sm-10">
                <input type="file" class="custom-file-input <?= ($validation->hasError('foto')) ? 'is-invalid' : ''; ?>" id="foto" name="foto" onchange="fotoLabel();">
                <div class="invalid-feedback">
                  <?= $validation->getError('foto'); ?>
                </div>
                <label class="custom-foto-label" for="foto">Pilih gambar</label>
              </div>
            </div>

            <div class="form-group row mb-3">
              <label for="gallery" class="col-form-label col-sm-2">Gallery</label>
              <div class="col-sm-10">
                <input type="file" class="custom-file-input <?= ($validation->hasError('gallery')) ? 'is-invalid' : ''; ?>" id="gallery" name="gallery[]" onchange="galleryLabel();" multiple>
                <div class="invalid-feedback">
                  <?= $validation->getError('gallery'); ?>
                </div>
                <label class="custom-gallery-label" for="gallery">0 file</label>
              </div>
            </div>

            <div class="form-group row mt-4 justify-content-end">
              <div class="col-sm-4">
                <button type="submit" class="btn btn-primary">Tambah Data</button>
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
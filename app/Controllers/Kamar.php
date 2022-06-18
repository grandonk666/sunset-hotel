<?php

namespace App\Controllers;

use App\Models\KamarModel;

class Kamar extends BaseController
{
  protected $kamarModel;
  protected $saveRules = [
    'nama' => [
      'label' => "Nama",
      'rules' => 'required|is_unique[kamar.nama]',
      'errors' => [
        'required' => '{field} harus diisi',
        'is_unique' => '{field} sudah terdaftar'
      ]
    ],
    'tipe' => [
      'label' => "Tipe",
      'rules' => 'required',
      'errors' => [
        'required' => '{field} harus diisi'
      ]
    ],
    'harga' => [
      'label' => "Harga",
      'rules' => 'required',
      'errors' => [
        'required' => '{field} harus diisi'
      ]
    ],
    'luas' => [
      'label' => "Luas",
      'rules' => 'required',
      'errors' => [
        'required' => '{field} harus diisi'
      ]
    ],
    'kapasitas' => [
      'label' => "Kapasitas",
      'rules' => 'required',
      'errors' => [
        'required' => '{field} harus diisi'
      ]
    ],
    'deskripsi' => [
      'label' => "Deskripsi",
      'rules' => 'required',
      'errors' => [
        'required' => '{field} harus diisi'
      ]
    ],
    'foto' => [
      'label' => 'Foto Utama',
      'rules' => 'max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
      'errors' => [
        'max_size' => 'Ukuran gambar terlalu besar',
        'is_image' => '{field} harus berupa gambar',
        'mime_in' => '{field} harus berupa gambar'
      ]
    ]
  ];
  public function __construct()
  {
    $this->kamarModel = new KamarModel();
  }

  public function index()
  {
    $data = [
      'nav' => 'kamar',
      'title' => 'Daftar Kamar',
      'kamar' => $this->kamarModel->getKamar()
    ];

    return view('admin/kamar/index', $data);
  }

  public function detail($slug)
  {
    $kamar = $this->kamarModel->getKamar($slug);
    $gallery = json_decode($kamar['gallery'], true);
    $data = [
      'nav' => 'kamar',
      'title' => 'Detail Kamar',
      'kamar' => $kamar,
      'gallery' => $gallery
    ];
    if (empty($data['kamar']))
    {
      throw new \CodeIgniter\Exceptions\PageNotFoundException('Kamar tidak ditemukan');
    }

    return view('admin/kamar/detail', $data);
  }

  public function create()
  {
    $data = [
      'nav' => 'kamar',
      'title' => 'Form Tambah Data Kamar',
      'validation' => \Config\Services::validation()
    ];

    return view('admin/kamar/create', $data);
  }

  public function save()
  {
    if (!$this->validate($this->saveRules))
    {
      return redirect()->to('/admin/kamar/create')->withInput();
    }

    $data = [
      'nama' => $this->request->getVar('nama'),
      'slug' => url_title($this->request->getVar('nama'), '-', true),
      'tipe' => $this->request->getVar('tipe'),
      'harga' => $this->request->getVar('harga'),
      'luas' => $this->request->getVar('luas'),
      'kapasitas' => $this->request->getVar('kapasitas'),
      'deskripsi' => $this->request->getVar('deskripsi'),
      'number_order' => 0,
      'hewan' => ($this->request->getVar('hewan')) ? 1 : 0,
      'sarapan' => ($this->request->getVar('sarapan')) ? 1 : 0,
      'internet' => ($this->request->getVar('internet')) ? 1 : 0,
      'featured' => ($this->request->getVar('featured')) ? 1 : 0,
      'foto' => $this->getFoto($this->request->getFile('foto')),
      'gallery' => $this->getGallery($this->request->getFileMultiple('gallery')),
    ];

    $this->kamarModel->save($data);

    session()->setFlashdata('pesan', 'Data berhasil ditambah');

    return redirect()->to('/admin/kamar');
  }

  public function delete($id)
  {
    $kamar = $this->kamarModel->find($id);
    $gallery = json_decode($kamar['gallery'], true);

    if ($gallery)
    {
      foreach ($gallery as $img)
      {
        unlink('images/' . $img);
      }
    }
    if ($kamar['foto'] != 'default.jpeg')
    {
      // hapus gambar
      unlink('images/' . $kamar['foto']);
    }

    $this->kamarModel->delete($id);

    session()->setFlashdata('pesan', 'Data berhasil dihapus');

    return redirect()->to('/admin/kamar');
  }

  public function edit($slug)
  {
    $kamar = $this->kamarModel->getKamar($slug);
    $gallery = json_decode($kamar['gallery'], true);

    $data = [
      'nav' => 'kamar',
      'title' => 'Form Ubah Data Kamar',
      'validation' => \Config\Services::validation(),
      'kamar' => $kamar,
      'gallery' => $gallery,
    ];

    return view('admin/kamar/edit', $data);
  }

  public function update($id)
  {
    $kamar = $this->kamarModel->find($id);
    $rules = $this->saveRules;
    $rules['nama'] = [
      'label' => "Nama",
      'rules' => "required|is_unique[kamar.nama, id, $id]",
      'errors' => [
        'required' => '{field} harus diisi',
        'is_unique' => '{field} sudah terdaftar'
      ]
    ];

    if (!$this->validate($rules))
    {
      return redirect()->to('/admin/kamar/edit/' . $kamar['slug'])->withInput();
    }

    $data = [
      'id' => $id,
      'nama' => $this->request->getVar('nama'),
      'slug' => url_title($this->request->getVar('nama'), '-', true),
      'tipe' => $this->request->getVar('tipe'),
      'harga' => $this->request->getVar('harga'),
      'luas' => $this->request->getVar('luas'),
      'kapasitas' => $this->request->getVar('kapasitas'),
      'deskripsi' => $this->request->getVar('deskripsi'),
      'number_order' => $kamar['number_order'],
      'hewan' => ($this->request->getVar('hewan')) ? 1 : 0,
      'sarapan' => ($this->request->getVar('sarapan')) ? 1 : 0,
      'internet' => ($this->request->getVar('internet')) ? 1 : 0,
      'featured' => ($this->request->getVar('featured')) ? 1 : 0,
      'foto' => $this->getFoto($this->request->getFile('foto'), $kamar),
      'gallery' => $this->getGallery($this->request->getFileMultiple('gallery'), $kamar),
    ];

    $this->kamarModel->save($data);

    session()->setFlashdata('pesan', 'Data berhasil diubah');

    return redirect()->to('/admin/kamar');
  }

  public function getFoto($fileFoto, $kamar = null)
  {
    if ($fileFoto->getError() == 4)
    {
      return ($kamar != null) ? $kamar['foto'] : 'default.jpeg';
    }

    $namaFoto = $fileFoto->getRandomName();
    $fileFoto->move('images', $namaFoto);
    if ($kamar != null && $kamar['foto'] != 'default.jpeg')
    {
      unlink('images/' . $kamar['foto']);
    }
    return $namaFoto;
  }

  public function getGallery($imageFile, $kamar = null)
  {
    if ($imageFile[0]->getError() == 4)
    {
      return ($kamar != null) ? $kamar['gallery'] : "{}";
    }

    $photo = [];
    foreach ($imageFile as $img)
    {
      if ($img->isValid() && !$img->hasMoved())
      {
        $newName = $img->getRandomName();
        $img->move('images', $newName);
      }
      array_push($photo, $newName);
    }

    if ($kamar != null)
    {
      $fotoGallery = json_decode($kamar['gallery'], true);
      if ($fotoGallery)
      {
        foreach ($fotoGallery as $img)
        {
          unlink('images/' . $img);
        }
      }
    }

    return json_encode($photo, JSON_FORCE_OBJECT);
  }
}

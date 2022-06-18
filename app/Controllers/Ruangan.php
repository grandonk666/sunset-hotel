<?php

namespace App\Controllers;

use App\Models\RuanganModel;
use App\Models\KamarModel;

class Ruangan extends BaseController
{
  protected $ruanganModel, $kamarModel;
  protected $saveRules = [
    'nomor_ruangan' => [
      'label' => "Nomor",
      'rules' => 'required|is_unique[ruangan.nomor_ruangan]',
      'errors' => [
        'required' => '{field} ruangan harus diisi',
        'is_unique' => '{field} ruangan terdaftar'
      ]
    ],
    'kamar' => [
      'label' => "Kamar",
      'rules' => 'required',
      'errors' => [
        'required' => '{field} harus diisi'
      ]
    ],
    'status' => [
      'label' => "Status",
      'rules' => 'required',
      'errors' => [
        'required' => '{field} harus diisi'
      ]
    ]
  ];
  public function __construct()
  {
    $this->ruanganModel = new RuanganModel();
    $this->kamarModel = new KamarModel();
  }

  public function index()
  {
    $page = $this->request->getVar('page_ruangan') ? $this->request->getVar('page_ruangan') : 1;

    if ($this->request->getVar('submit'))
    {
      $page = 1;
      $filter = $this->getFilter($this->request->getVar('jenis'), $this->request->getVar('status'));
    }
    else
    {
      $filter = $this->getFilterOnSession();
    }

    $data = [
      'nav' => 'ruangan',
      'title' => 'Daftar Ruangan',
      'ruangan' => $this->ruanganModel->getRuanganPaginate($filter, $page),
      'kamar_model' => $this->kamarModel,
      'pager' => $this->ruanganModel->pager,
      'filter' => $filter
    ];
    return view('admin/ruangan/index', $data);
  }

  public function create()
  {
    $data = [
      'nav' => 'ruangan',
      'validation' => \Config\Services::validation(),
      'title' => 'Form Tambah Data Ruangan',
      'kamar' => $this->kamarModel->getKamar(),
    ];

    return view('admin/ruangan/create', $data);
  }

  public function save()
  {
    if (!$this->validate($this->saveRules))
    {
      return redirect()->to('/admin/ruangan/create')->withInput();
    }

    $data = [
      'nomor_ruangan' => $this->request->getVar('nomor_ruangan'),
      'id_kamar' => (int)$this->request->getVar('kamar'),
      'tersedia' => (int)$this->request->getVar('status')
    ];

    $this->ruanganModel->save($data);

    session()->setFlashdata('pesan', 'Data berhasil ditambah');

    return redirect()->to('/admin/ruangan');
  }

  public function delete($id)
  {
    $this->ruanganModel->delete($id);

    session()->setFlashdata('pesan', 'Data berhasil dihapus');

    return redirect()->to('/admin/ruangan');
  }

  public function edit($id)
  {
    $data = [
      'nav' => 'ruangan',
      'title' => 'Form Ubah Data Ruangan',
      'validation' => \Config\Services::validation(),
      'ruangan' => $this->ruanganModel->find($id),
      'kamar' => $this->kamarModel->getKamar(),
    ];

    return view('admin/ruangan/edit', $data);
  }

  public function update($id)
  {
    $rules = $this->saveRules;
    $rules['nomor_ruangan'] = [
      'label' => "Nomor",
      'rules' => "required|is_unique[ruangan.nomor_ruangan, id, $id]",
      'errors' => [
        'required' => '{field} ruangan harus diisi',
        'is_unique' => '{field} ruangan terdaftar'
      ]
    ];
    if (!$this->validate($rules))
    {
      return redirect()->to('/admin/ruangan/edit/' . $id)->withInput();
    }

    $data = [
      'id' => $id,
      'nomor_ruangan' => $this->request->getVar('nomor_ruangan'),
      'id_kamar' => (int)$this->request->getVar('kamar'),
      'tersedia' => (int)$this->request->getVar('status')
    ];

    $this->ruanganModel->save($data);

    session()->setFlashdata('pesan', 'Data berhasil diubah');

    return redirect()->to('/admin/ruangan');
  }

  public function status($id)
  {
    $tersedia = (int)$this->request->getVar('change-status');
    $this->ruanganModel->save([
      'id' => $id,
      'tersedia' => $tersedia
    ]);

    return redirect()->to('/admin/ruangan');
  }

  public function getFilter($jenis, $status)
  {
    if ($jenis == 'all' && $status == 'all')
    {
      session()->remove('id_kamar');
      session()->remove('tersedia');
      return [];
    }
    if ($jenis != 'all' && $status != 'all')
    {
      session()->set(['id_kamar' => (int)$jenis, 'tersedia' => (int)$status]);
      return ['id_kamar' => (int)$jenis, 'tersedia' => (int)$status];
    }
    if ($jenis != 'all' && $status == 'all')
    {
      session()->remove('tersedia');
      session()->set(['id_kamar' => (int)$jenis]);
      return ['id_kamar' => (int)$jenis];
    }
    if ($jenis == 'all' && $status != 'all')
    {
      session()->remove('id_kamar');
      session()->set(['tersedia' => (int)$status]);
      return ['tersedia' => (int)$status];
    }
  }

  public function getFilterOnSession()
  {
    if (is_null(session('id_kamar')) && is_null(session('tersedia')))
    {
      return [];
    }
    if (!is_null(session('id_kamar')) && is_null(session('tersedia')))
    {
      return ['id_kamar' => session('id_kamar')];
    }
    if (is_null(session('id_kamar')) && !is_null(session('tersedia')))
    {
      return ['tersedia' => session('tersedia')];
    }
    return ['id_kamar' => session('id_kamar'), 'tersedia' => session('tersedia')];
  }
}

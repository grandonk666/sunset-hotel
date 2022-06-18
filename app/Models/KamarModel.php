<?php

namespace App\Models;

use CodeIgniter\Model;

class KamarModel extends Model
{
  protected $table = 'kamar';
  protected $useTimestamps = true;
  protected $allowedFields = ['nama', 'slug', 'tipe', 'foto', 'gallery', 'deskripsi', 'harga', 'luas', 'kapasitas', 'hewan', 'sarapan', 'featured', 'internet', 'number_order'];

  public function getKamar($slug = false)
  {
    if ($slug == false)
    {
      return $this->orderBy('tipe', 'asc')->findAll();
    }

    return $this->where(['slug' => $slug])->first();
  }

  public function getCountKamar()
  {
    return $this->countAllResults();
  }

  public function getSumOrder()
  {
    $order = $this->findColumn('number_order');
    $sum = 0;
    foreach ($order as $o)
    {
      $sum = $sum + $o;
    }

    return $sum;
  }

  public function getKamarGrafik()
  {
    $namaKamar = $this->orderBy('tipe', 'asc')->findColumn('nama');
    $totalOrder = $this->orderBy('tipe', 'asc')->findColumn('number_order');
    $result['kamar'] = $namaKamar;
    $result['total'] = $totalOrder;
    return $result;
  }
}

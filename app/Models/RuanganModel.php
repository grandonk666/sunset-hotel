<?php

namespace App\Models;

use CodeIgniter\Model;

class RuanganModel extends Model
{
  protected $table = 'ruangan';
  protected $useTimestamps = true;
  protected $allowedFields = ['nomor_ruangan', 'id_kamar', 'tersedia'];

  public function getRuanganPaginate($filter, $page)
  {
    return $this->where($filter)
      ->join('kamar', 'kamar.id = ruangan.id_kamar')
      ->orderBy('tipe', 'asc')
      ->paginate(6, 'ruangan', $page);
  }

  public function getCountRuangan()
  {
    return $this->countAllResults();
  }
}

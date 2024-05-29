<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table = "tb_barang";
    protected $returnType = 'object';
    protected $primaryKey = "id";
    protected $allowedFields = ["nama_barang"];
    protected $useTimestamps = false;

}
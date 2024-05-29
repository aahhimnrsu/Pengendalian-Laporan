<?php

namespace App\Models;

use CodeIgniter\Model;

class PeminjamanModel extends Model
{
    protected $table = "tb_peminjaman";
    protected $returnType = 'object';
    protected $primaryKey = "id";
    protected $allowedFields = ["id_peminjam","nama_peminjam", "nama_barang", "jumlah","tanggal_peminjaman","tanggal_pengembalian","status","foto","kondisi","keterangan"];
    protected $useTimestamps = false;

}
<?php

namespace App\Models;

use CodeIgniter\Model;

class AkunModel extends Model
{
    protected $table = "tb_user";
    protected $returnType = 'object';
    protected $primaryKey = "id";
    protected $allowedFields = ["nama", "username","password","universitas","foto","role","alamat","email"];
    protected $useTimestamps = false;

}
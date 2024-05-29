<?php

namespace App\Controllers;

use App\Models\BarangModel;
use App\Models\PeminjamanModel;

class Barang extends BaseController
{

    public function __construct() {
        if (session()->isLogin != true) {
            return redirect('/');
        }
    }
    
    public function index()
    {
        $BarangModel = new BarangModel();
        $data = array(
            'page' => 'Data Barang',
            'countnotif' => '0',
            'databarang' => $BarangModel->findAll(),
        );
        echo view('partials/header', $data);
        echo view('partials/navbar', $data);
        echo view('partials/sidebar', $data);
        echo view('barang/index', $data);
        echo view('partials/footer', $data);
    }
    
    public function tambah(){
        $BarangModel = new BarangModel();
        $BarangModel->insert([
            'nama_barang' => $this->request->getPost('nama_barang')
        ]);
        return redirect()->to(base_url('barang'));
    }

    public function hapus($id = false){
        $BarangModel = new BarangModel();
        $BarangModel->delete($id);
        return redirect()->to(base_url('barang'));
    }
}

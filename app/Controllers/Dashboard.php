<?php

namespace App\Controllers;

use App\Models\BarangModel;
use App\Models\PeminjamanModel;

class Dashboard extends BaseController
{

    public function __construct() {
        if (session()->isLogin != true) {
            return redirect('/');
        }
    }

    public function index()
    {
        $PeminjamanModel = new PeminjamanModel();
        $BarangModel = new BarangModel();
        // $peminjaman =  $PeminjamanModel->select('COUNT(id) as jumlah, tanggal_peminjaman as bulan')->groupBy('MONTH(tanggal_peminjaman)')->get()->getResult();
        // foreach($peminjaman as $peminjaman){
        //     echo date('F', strtotime($peminjaman->bulan));
        // }
        // die;

        $data = array(
            'page' => 'Dashboard',
            'countpeminjaman' => $PeminjamanModel->countAllResults(),
            'countlaporan' => $PeminjamanModel->where('kondisi', 'Rusak')->orWhere('kondisi','Hilang')->countAllResults(),
            'countpengembalian' => $PeminjamanModel->where('status', 'Telah Dikembalikan')->countAllResults(),
            'countbarang' => $BarangModel->countAllResults(),
            'bulanpeminjaman' => $PeminjamanModel->select('COUNT(id) as jumlah, MONTH(tanggal_peminjaman) as bulan')->groupBy('MONTH(tanggal_peminjaman)')->get()->getResult(),
            'bulan' => $PeminjamanModel->select('COUNT(id) as jumlah, tanggal_peminjaman as bulan')->groupBy('MONTH(tanggal_peminjaman)')->get()->getResult(),
            'bulanpengembalian' => $PeminjamanModel->select('COUNT(id) as jumlah, MONTH(tanggal_peminjaman) as bulan')->where('status', 'Telah Dikembalikan')->groupBy('MONTH(tanggal_peminjaman)')->get()->getResult(),
            'bulankerusakan' => $PeminjamanModel->select('COUNT(id) as jumlah, MONTH(tanggal_peminjaman) as bulan')->where('kondisi', 'Rusak')->orWhere('kondisi', 'Hilang')->groupBy('MONTH(tanggal_peminjaman)')->get()->getResult(),
        );
        echo view('partials/header', $data);
        echo view('partials/navbar', $data);
        echo view('partials/sidebar', $data);
        echo view('vw_dashboard', $data);
        echo view('partials/footer', $data);
    }
}

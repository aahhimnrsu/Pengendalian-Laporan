<?php

namespace App\Controllers;

use App\Libraries\Pdfgenerator;
use App\Models\AkunModel;
use App\Models\BarangModel;
use App\Models\PeminjamanModel;
use Dompdf\Dompdf;

class Laporan extends BaseController
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

        if(session()->get('role') != 'Peminjam'){
            $datapeminjaman = $PeminjamanModel->where('kondisi', 'Rusak')->orWhere('kondisi','Hilang')->get()->getResult();
        }else{
            $datapeminjaman = $PeminjamanModel->where('id_peminjam', session()->get('id'))->where('kondisi', 'Rusak')->orWhere('kondisi','Hilang')->get()->getResult();
        }
        $data = array(
            'page' => 'Laporan Kerusakan',
            'countnotif' => '0',
            'datapeminjaman' => $datapeminjaman,
            'databarang' => $BarangModel->findAll(),
        );
        echo view('partials/header', $data);
        echo view('partials/navbar', $data);
        echo view('partials/sidebar', $data);
        echo view('laporan/index', $data);
        echo view('partials/footer', $data);
    }
    
    public function bayar(){
        $PeminjamanModel = new PeminjamanModel();
        $id = $this->request->getPost('id');
        $PeminjamanModel->update($id,[
            'keterangan' => $this->request->getPost('keterangan'),
        ]);
        return redirect()->to(base_url('laporan'));
    }

    public function detail($id = false)
    {
        $PeminjamanModel = new PeminjamanModel();
        $AkunModel = new AkunModel();
        $query = $PeminjamanModel->where('id',$id)->first();
        $id_peminjam = $query->id_peminjam;
        $data = array(
            'page' => 'Laporan Kerusakan',
            'countnotif' => '0',
            'datapeminjaman' => $PeminjamanModel->where('id',$id)->get()->getResult(),
            'datapeminjam' => $AkunModel->where('id',$id_peminjam)->get()->getResult(),
        );
        echo view('partials/header', $data);
        echo view('partials/navbar', $data);
        echo view('partials/sidebar', $data);
        echo view('laporan/detail', $data);
        echo view('partials/footer', $data);
    }
    
    public function downloadpdf($id = false){
        $PeminjamanModel = new PeminjamanModel();
        $Pdfgenerator = new Pdfgenerator();
        // title dari pdf
        $this->data['datalaporan'] = $PeminjamanModel->where('id',$id)->get()->getResult();

        // filename dari pdf ketika didownload
        $file_pdf = date('Y-m-d').'_Laporan Kerusakan';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "portrait";

        $html = view('laporan/pdflaporan', $this->data);

        // run dompdf
        $Pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }
}

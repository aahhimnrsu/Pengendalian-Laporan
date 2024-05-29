<?php

namespace App\Controllers;

use App\Libraries\Pdfgenerator;
use App\Models\AkunModel;
use App\Models\BarangModel;
use App\Models\PeminjamanModel;
use PhpOffice\PhpWord\TemplateProcessor;
use Mpdf\Mpdf;

class Peminjaman extends BaseController
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
            $datapeminjaman = $PeminjamanModel->findAll();
        }else{
            $datapeminjaman = $PeminjamanModel->where('id_peminjam', session()->get('id'))->get()->getResult();
        }
        $data = array(
            'page' => 'Peminjaman',
            'countnotif' => '0',
            'datapeminjaman' => $datapeminjaman,
            'databarang' => $BarangModel->findAll(),
        );
        echo view('partials/header', $data);
        echo view('partials/navbar', $data);
        echo view('partials/sidebar', $data);
        echo view('peminjaman/index', $data);
        echo view('partials/footer', $data);
    }

    public function tambah(){
        $PeminjamanModel = new PeminjamanModel();
        $img = $this->request->getFile('foto');

    
        if (!$this->validate([
            'foto' => [
                'rules' => 'uploaded[foto]|mime_in[foto,image/jpg,image/png,image/jpeg]|max_size[foto,2048]',
                'errors' => [
                    'uploaded' => 'Harus Ada File yang diupload',
                    'mime_in' => 'File Extention Harus Berupa jpg/png/jpeg',
                    'max_size' => 'Ukuran File Maksimal 6 MB'
                ]
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        $fileName = $img->getName();
        $img->move('assets/uploads/idcard/', $fileName);
        $PeminjamanModel->insert([
            'id_peminjam' => $this->request->getPost('id_peminjam'),
            'nama_peminjam' => $this->request->getPost('nama_peminjam'),
            'nama_barang' => $this->request->getPost('nama_barang'),
            'jumlah' => $this->request->getPost('jumlah'),
            'tanggal_peminjaman' => $this->request->getPost('tanggal_peminjaman'),
            'tanggal_pengembalian' => $this->request->getPost('tanggal_pengembalian'),
            'status' => 'Menunggu Validasi',
            'foto' => $fileName,
        ]);
        return redirect()->to(base_url('peminjaman'));
    }

    public function getDataById()
    {
        $PeminjamanModel = new PeminjamanModel();
        $id = $this->request->getPost('id');
        $data = $PeminjamanModel->find($id);
        echo json_encode($data);
    }

    public function pengembalian(){
        $PeminjamanModel = new PeminjamanModel();
        $id = $this->request->getPost('id');
        $PeminjamanModel->update($id,[
            'kondisi' => $this->request->getPost('kondisi'),
            'status' => 'Telah Dikembalikan'
        ]);
        return redirect()->to(base_url('peminjaman'));
    }

    public function validasi($id = false){
        $PeminjamanModel = new PeminjamanModel();
        $AkunModel = new AkunModel();

        $query = $PeminjamanModel->where('id', $id)->first();
        $query2 = $AkunModel->where('id', $query->id_peminjam)->first();

        //KIRIM EMAIL
        $email = \Config\Services::email(); //LIBRARY EMAIL
        $to = $query2->email; //EMAIL TUJUAN
        $subject = 'APL PERTAMINA'; //SUBJECT EMAIL
        $message = 'Hai '.$query->nama_peminjam .'!!! Selamat Peminjaman kamu berupa '.$query->nama_barang.' pada tanggal '.$query->tanggal_peminjaman.' telah divalidasi oleh admin.'; //ISI EMAIL
        $email->setTo($to); //PROSES KIRIM
        $email->setFrom('pertaminaruplaju@gmail.com', 'Admin APL PERTAMINA RUU3'); //EMAIL PENGIRIM
        $email->setSubject($subject); //PROSES KIRIM
        $email->setMessage($message); //PROSES KIRIM
        if ($email->send()) {
            echo 'Email successfully sent';
        } else {
            $data = $email->printDebugger(['headers']);
            print_r($data);
        }
        $PeminjamanModel->update($id,[
            'status' => 'Belum Dikembalikan'
        ]);
        return redirect()->to(base_url('peminjaman'));
    }

    public function tidakvalidasi($id = false){
        $PeminjamanModel = new PeminjamanModel();
        $PeminjamanModel = new PeminjamanModel();
        $AkunModel = new AkunModel();

        $query = $PeminjamanModel->where('id', $id)->first();
        $query2 = $AkunModel->where('id', $query->id_peminjam)->first();

        //KIRIM EMAIL
        $email = \Config\Services::email(); //LIBRARY EMAIL
        $to = $query2->email; //EMAIL TUJUAN
        $subject = 'APL PERTAMINA'; //SUBJECT EMAIL
        $message = 'Hai '.$query->nama_peminjam .'!!! Mohon Maaf Peminjaman kamu berupa '.$query->nama_barang.' pada tanggal '.$query->tanggal_peminjaman.' tidak divalidasi oleh admin.'; //ISI EMAIL
        $email->setTo($to); //PROSES KIRIM
        $email->setFrom('pertaminaruplaju@gmail.com', 'Admin APL PERTAMINA RUU3'); //EMAIL PENGIRIM
        $email->setSubject($subject); //PROSES KIRIM
        $email->setMessage($message); //PROSES KIRIM
        if ($email->send()) {
            echo 'Email successfully sent';
        } else {
            $data = $email->printDebugger(['headers']);
            print_r($data);
        }
        $PeminjamanModel->update($id,[
            'status' => 'Tidak Tervalidasi'
        ]);
        return redirect()->to(base_url('peminjaman'));
    }

    public function detail($id = false)
    {
        $PeminjamanModel = new PeminjamanModel();
        $AkunModel = new AkunModel();
        $query = $PeminjamanModel->where('id',$id)->first();
        $id_peminjam = $query->id_peminjam;

        $data = array(
            'page' => 'Peminjaman',
            'countnotif' => '0',
            'datapeminjaman' => $PeminjamanModel->where('id',$id)->get()->getResult(),
            'datapeminjam' => $AkunModel->where('id',$id_peminjam)->get()->getResult(),
        );
        echo view('partials/header', $data);
        echo view('partials/navbar', $data);
        echo view('partials/sidebar', $data);
        echo view('peminjaman/detail', $data);
        echo view('partials/footer', $data);
    }

    public function pdfpeminjaman($id = false){
        $PeminjamanModel = new PeminjamanModel();
        $Pdfgenerator = new Pdfgenerator();
        // title dari pdf
        $this->data['datalaporan'] = $PeminjamanModel->where('id',$id)->get()->getResult();

        // filename dari pdf ketika didownload
        $file_pdf = date('Y-m-d').'_Bukti Peminjaman_'.$id;
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "portrait";

        $html = view('peminjaman/pdfpeminjaman', $this->data);

        // run dompdf
        $Pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }

    public function pdfpengembalian($id = false){
        $PeminjamanModel = new PeminjamanModel();
        $Pdfgenerator = new Pdfgenerator();
        // title dari pdf
        $this->data['datalaporan'] = $PeminjamanModel->where('id',$id)->get()->getResult();

        // filename dari pdf ketika didownload
        $file_pdf = date('Y-m-d').'_Bukti Pengembalian'.$id;
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "portrait";

        $html = view('peminjaman/pdfpengembalian', $this->data);

        // run dompdf
        $Pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }

    public function hapus($id = false){
        $PeminjamanModel = new PeminjamanModel();
        $PeminjamanModel->delete($id);
        return redirect()->to(base_url('peminjaman'));
    }
}

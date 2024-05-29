<?php

namespace App\Controllers;

use App\Models\AkunModel;
use App\Models\PeminjamanModel;

class ManajemenAkun extends BaseController
{

    public function __construct() {
        if (session()->isLogin != true) {
            return redirect('/');
        }
    }
    
    public function index()
    {
        $AkunModel = new AkunModel();
        $data = array(
            'page' => 'Manajemen Akun',
            'countnotif' => '0',
            'dataakun' => $AkunModel->findAll(),
        );
        echo view('partials/header', $data);
        echo view('partials/navbar', $data);
        echo view('partials/sidebar', $data);
        echo view('manajemenakun/index', $data);
        echo view('partials/footer', $data);
    }
    
    public function tambah(){
        $AkunModel = new AkunModel();
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
        $img->move('assets/uploads/fotopeminjam/', $fileName);
        $AkunModel->insert([
            'nama' => $this->request->getPost('nama'),
            'username' => $this->request->getPost('username'),
            'password' => $this->request->getPost('password'),
            'universitas' => $this->request->getPost('universitas'),
            'alamat' => $this->request->getPost('alamat'),
            'email' => $this->request->getPost('email'),
            'role' => $this->request->getPost('role'),
            'foto' => $fileName
        ]);
        return redirect()->to(base_url('manajemenakun'));
    }

    public function detail($id = false)
    {
        $AkunModel = new AkunModel();

        $data = array(
            'page' => 'Manajemen Akun',
            'countnotif' => '0',
            'datapeminjam' => $AkunModel->where('id',$id)->get()->getResult(),
        );
        echo view('partials/header', $data);
        echo view('partials/navbar', $data);
        echo view('partials/sidebar', $data);
        echo view('manajemenakun/detail', $data);
        echo view('partials/footer', $data);
    }

    public function edit($id = false)
    {
        $AkunModel = new AkunModel();

        $data = array(
            'page' => 'Manajemen Akun',
            'countnotif' => '0',
            'datapeminjam' => $AkunModel->where('id',$id)->get()->getResult(),
        );
        echo view('partials/header', $data);
        echo view('partials/navbar', $data);
        echo view('partials/sidebar', $data);
        echo view('manajemenakun/edit', $data);
        echo view('partials/footer', $data);
    }

    public function prosesedit(){
        $AkunModel = new AkunModel();
        $img = $this->request->getFile('foto');
        $id = $this->request->getPost('id');
        if($img == ''){
            $AkunModel->update($id,[
                'nama' => $this->request->getPost('nama'),
                'username' => $this->request->getPost('username'),
                'password' => $this->request->getPost('password'),
                'universitas' => $this->request->getPost('universitas'),
                'alamat' => $this->request->getPost('alamat'),
                'email' => $this->request->getPost('email'),
                'role' => $this->request->getPost('role'),
            ]);
        }else{
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
            $img->move('assets/uploads/fotopeminjam/', $fileName);
            $AkunModel->update($id,[
                'nama' => $this->request->getPost('nama'),
                'username' => $this->request->getPost('username'),
                'password' => $this->request->getPost('password'),
                'universitas' => $this->request->getPost('universitas'),
                'alamat' => $this->request->getPost('alamat'),
                'email' => $this->request->getPost('email'),
                'role' => $this->request->getPost('role'),
                'foto' => $fileName
            ]);
        }

        return redirect()->to(base_url('manajemenakun/detail/'.$id));
    }
    
    public function hapus($id = false){
        $AkunModel = new AkunModel();
        $AkunModel->delete($id);
        return redirect()->to(base_url('manajemenakun'));
    }

    public function ubahpassword()
    {
        $data = array(
            'page' => 'Manajemen Akun',
            'countnotif' => '0',
        );
        echo view('partials/header', $data);
        echo view('partials/navbar', $data);
        echo view('partials/sidebar', $data);
        echo view('manajemenakun/ubahpassword', $data);
        echo view('partials/footer', $data);
    }

    public function prosesubahpassword()
    {
        $AkunModel = new AkunModel();

        $id = $this->request->getPost('id');
        // var_dump($id);
        // die;

        $query = $AkunModel->where('id', $id)->first();
        $password = $query->password;
        $old = $this->request->getPost('old');
        $new = $this->request->getPost('new');
        $repeat = $this->request->getPost('repeat');

        if($password == $old){
            if($new == $repeat){
                $AkunModel->update($id,[
                    'password' => $new,
                ]);
                session()->setFlashdata('error', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Selamat!</strong> Password anda berhasil diubah.
              </div>');
                return redirect()->to(base_url('ubahpassword'));
            }else{
                session()->setFlashdata('error', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Maaf!</strong> Password yang anda ulangi tidak sama.
              </div>');
                return redirect()->to(base_url('ubahpassword'));
            }
        }else{
            session()->setFlashdata('error', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Maaf!</strong> Password lama anda salah.
              </div>');
                return redirect()->to(base_url('ubahpassword'));
        }
        
        return redirect()->to(base_url('ubahpassword'));
    }
}

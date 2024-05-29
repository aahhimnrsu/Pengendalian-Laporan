<?php

namespace App\Controllers;

use App\Models\AkunModel;

class Login extends BaseController
{
    public function __construct()
    {
        $session = \Config\Services::session();
    }

    public function index()
    {
        return view('login');
    }

    public function register()
    {
        return view('register');
    }

    public function prosesregister()
    {
        $AkunModel = new AkunModel();

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
            'role' => 'Peminjam',
            'foto' => $fileName
        ]);
        session()->setFlashdata('error', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Selamat!</strong> Akun anda telah terdaftar. <br> Silahkan Login.</div>');
        return redirect()->to(base_url('/'));
    }

    public function proses()
    {
        $session = \Config\Services::session();
        $AkunModel = new AkunModel();
        $data = $this->request->getPost();

        $user = $AkunModel->where('username', $data['username'])->first();
        $username = $user->username;

        if ($user) {
            if ($user->password != $data['password']) {
                session()->setFlashdata('password', 'Password Salah');
                return redirect()->to('/');
            } else {
                if (empty($username->username)) {
                    $sessLogin = [
                        'isLogin' => true,
                        'username' => $user->username,
                        'nama' => $user->nama,
                        'id' => $user->id,
                        'role' => $user->role
                    ];
                } else {
                    $sessLogin = [
                        'isLogin' => true,
                        'username' => $user->username,
                        'nama' => $user->nama,
                        'id' => $user->id,
                        'role' => $user->role
                    ];
                }
                $session->set($sessLogin);

                if ($user->role != 'Peminjam') {
                    return redirect()->to('dashboard');
                } else {
                    return redirect()->to('peminjaman');
                }
            }
        } else {
            //jika username tidak ditemukan, balikkan ke halaman login
            session()->setFlashdata('username', 'username Tidak Terdaftar');
            return redirect()->to('/');
        }
    }

    function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}

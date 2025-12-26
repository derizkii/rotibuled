<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Login extends BaseController
{
    protected $usersModel;
    
    public function __construct()
    {
        $this->usersModel = new UsersModel();
    }

    public function index()
    {
        return view('auth/login/index');
    }

    public function masuk()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
    
        if (is_string($username) && is_string($password)) {
            $cek = $this->usersModel->where('username', $username)->first();
    
            if (!empty($cek)) {
                // 1. Cek dengan password_verify (untuk user yang sudah migrasi/baru)
                if (password_verify($password, $cek['password'])) {
                    $this->setUserSession($cek);
                    return redirect()->to(base_url('dashboard'))->withInput();
                } 
                // 2. Cek sebagai Plaintext (untuk user lama/legacy)
                // Jika cocok, login DAN update ke hash (Auto-Migration)
                elseif ($password === $cek['password']) {
                    // Update password di database dengan Hash
                    $this->usersModel->update($cek['id_user'], [
                        'password' => password_hash($password, PASSWORD_DEFAULT)
                    ]);
                    
                    $this->setUserSession($cek);
                    session()->setFlashdata('success', 'Selamat Datang, ' . $cek['nm_user'] . '. Keamanan akun Anda telah ditingkatkan.');
                    return redirect()->to(base_url('dashboard'))->withInput();
                } else {
                    session()->setFlashdata('failed', 'Username/Password Salah');
                    return redirect()->to(base_url())->withInput();
                }
            } else {
                session()->setFlashdata('failed', 'Data tidak ditemukan!');
                return redirect()->to(base_url())->withInput();
            }
        } else {
            session()->setFlashdata('failed', 'Invalid input data!');
            return redirect()->to(base_url())->withInput();
        }
    }

    private function setUserSession($cek)
    {
        if ($cek['status'] == "Aktif") {
            session()->set([
                'idUser' => $cek['id_user'],
                'username' => $cek['username'],
                'name' => $cek['nm_user'],
                'level' => $cek['level'],
                'loggedIn' => true,
            ]);
            session()->setFlashdata('success', 'Selamat Datang, ' . $cek['nm_user']);
        } else {
            session()->setFlashdata('failed', 'Maaf, Status anda sudah Tidak Aktif');
            // Force logout logic if needed, but for now just prevent session set
            // The redirection happens in caller
        }
    }
    
    public function keluar()
    {
        session()->remove(['idUser', 'username', 'name', 'level', 'loggedIn']);
        return redirect()->to(base_url());
    }
}

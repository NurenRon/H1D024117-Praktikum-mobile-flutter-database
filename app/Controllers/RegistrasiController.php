<?php

namespace App\Controllers;

use App\Models\MRegistrasi;

class RegistrasiController extends RestfulController
{
    public function registrasi()
    {
        $nama     = $this->request->getVar('nama');
        $email    = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        if (empty($nama) || empty($email) || empty($password)) {
            return $this->responseHasil(400, false, 'Nama, email, dan password wajib diisi');
        }

        $model = new MRegistrasi();
        if ($model->where(['email' => $email])->first()) {
            return $this->responseHasil(400, false, 'Email sudah terdaftar');
        }

        $data = [
            'nama'     => $nama,
            'email'    => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ];

        $model->save($data);
        return $this->responseHasil(200, true, 'Registrasi Berhasil');
    }
}

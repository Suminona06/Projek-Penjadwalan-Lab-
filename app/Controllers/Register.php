<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Admin;
use App\Libraries\Hash;

class Register extends BaseController
{
    public function registerForm()
    {
        $data = [
            'pageTitle' => 'Registrasi',
        ];

        return view('backend/pages/auth/register', $data);
    }


    public function saveForm()
    {
        $rules = $this->validate([
            'email' => [
                'rules' => 'required|valid_email|is_unique[admin.email]',
                'error' => [
                    'required' => 'Email is required',
                    'valid_email' => 'Email tidak valid',
                    'is_unique' => 'Email sudah di gunakan !'
                ]
            ],
            'username' => [
                'rules' => 'required|min_length[3]|max_length[50]|is_unique[admin.username]',
                'errors' => [
                    'required' => 'Username is required',
                    'min_length' => 'Username minimal 3 karakter',
                    'max_length' => 'Username maksimal 50 karakter',
                    'is_unique' => 'Username sudah di gunakan !'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[5]',
                'errors' => [
                    'required' => 'Password required',
                    'min_length' => 'Password minimal 5 karakter'
                ]
            ],
            'confirm_password' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Konfirmasi Ulang',
                    'matches' => 'Password tidak sama!'
                ]
            ]
        ]);

        if (!$rules) {
            return view('backend/pages/auth/register', [
                'pageTitle' => 'Register',
                'validation' => $this->validator
            ]);
        } else {
            $admin = new Admin();
            $data = [
                'username' => $this->request->getVar('username'),
                'email' => $this->request->getVar('email'),
                'password' => Hash::make($this->request->getVar('password')),
            ];
            $admin->save($data);

            return redirect()->route('admin.login.form')->with('success', 'Registration successful!');
        }
    }
}

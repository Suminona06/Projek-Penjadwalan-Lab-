<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Libraries\CiAuth;
use App\Libraries\Hash;
use App\Models\Admin;
use App\Models\userModel;

class AuthController extends BaseController
{
    protected $helpers = ['url', 'form'];
    public function loginForm()
    {
        $data = [
            'pageTitle' => 'Login',
            'validation' => null,
        ];

        return view('backend/pages/auth/login', $data);
    }

    public function loginHandler()
    {
        $fieldtype = filter_var($this->request->getVar('login_id'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if ($fieldtype == 'email') {
            $isValid = $this->validate([
                'login_id' => [
                    'rules' => 'required|valid_email|is_not_unique[admin.email]',
                    'errors' => [
                        'required' => 'Email is required',
                        'valid_email' => 'Please, check the email field, It does not appears to be valid. ',
                        'is_not_unique' => 'Email is not Exist in our system'
                    ]
                ],
                'password' => [
                    'rules' => 'required|min_length[5]|max_length[45]',
                    'errors' => [
                        'required' => 'Password is required',
                        'min_length' => 'Password setidaknya harus 5 karakter',
                        'max_length' => 'Password tidak boleh lebih dari 45 karakter'
                    ]
                ]
            ]);
        } else {
            $isValid = $this->validate([
                'login_id' => [
                    'rules' => 'required|is_not_unique[admin.username]',
                    'errors' => [
                        'required' => 'Username is required',
                        'is_not_unique' => 'Username is not Exist in our system'
                    ]
                ],
                'password' => [
                    'rules' => 'required|min_length[5]|max_length[45]',
                    'errors' => [
                        'required' => 'Password is required',
                        'min_length' => 'Password setidaknya harus 5 karakter',
                        'max_length' => 'Password tidak boleh lebih dari 45 karakter'
                    ]
                ]
            ]);
        }

        if (!$isValid) {
            return view('backend/pages/auth/login', [
                'pageTitle' => 'Login',
                'validation' => $this->validator
            ]);

        } else {
            $admin = new Admin();
            $adminInfo = $admin->where($fieldtype, $this->request->getVar('login_id'))->first();
            $checkPassword = Hash::check($this->request->getVar('password'), $adminInfo['password']);

            if (!$checkPassword) {
                return redirect()->route('admin.login.form')->with('fail', 'Password Salah')->withInput();
            }else{
                CiAuth::setCiAuth($adminInfo); // Baris Penting

                return redirect()->route('admin.home');
            }
        }
    }

}

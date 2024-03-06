<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Libraries\CiAuth;

class AdminController extends BaseController
{
    public function index()
    {
        $data = [
            'pageTitle' => 'Dashboard'
        ];

        return view('Home/laman-contoh', $data);
    }

    public function logoutHandler()
    {
        CiAuth::forget();
        return redirect()->route('admin.login.form')->with('fail', 'You Are Logged Out!');
    }
    public function logoutUserHandler()
    {
        CiAuth::forget();
        return redirect()->route('user.login.form')->with('fail', 'You Are Logged Out!');
    }
}

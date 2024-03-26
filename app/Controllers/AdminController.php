<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Libraries\CiAuth;
use App\config\autoload;

class AdminController extends BaseController
{
    public function index()
    {
        $username = session()->get('username');
        session()->set('username', $username);
        $data = [
            'pageTitle' => 'Dashboard',
            'username' => $username
        ];

        ob_start();
        view('backend/layout/inc/header', $data);
        $viewContent = ob_get_clean();

        return view('Home/laman-contoh', $data);
    }

    public function logoutHandler()
    {
        CiAuth::forget();
        return redirect()->route('admin.login.form')->with('fail', 'You Are Logged Out!');
    }
    public function logoutUserHandler()
    {
        CiAuth::forgetOn();
        return redirect()->route('user.login.form')->with('fail', 'You Are Logged Out!');
    }
}

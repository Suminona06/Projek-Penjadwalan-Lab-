<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Libraries\CiAuth;
use App\Libraries\Hash;
use App\Models\Admin;
use App\Models\userModel;
use App\Models\PasswordResetToken;
use Carbon\Carbon;

class AuthController extends BaseController
{
    protected $helpers = ['url', 'form', 'CIMail'];
    public function loginForm()
    {
        $data = [
            'pageTitle' => 'Login',
            'validation' => null,
        ];

        return view('backend/pages/auth/login', $data);
    }

    public function loginUserForm()
    {
        $data = [
            'pageTitle' => 'Login',
            'validation' => null,
        ];

        return view('backend/pages/auth/login-user', $data);
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
            } else {
                CiAuth::setCiAuth($adminInfo); // Baris Penting

                return redirect()->route('admin.home');
            }
        }
    }
    public function loginUserHandler()
    {
        $fieldtype = filter_var($this->request->getVar('login_id'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if ($fieldtype == 'email') {
            $isValid = $this->validate([
                'login_id' => [
                    'rules' => 'required|valid_email|is_not_unique[user.email]',
                    'errors' => [
                        'required' => 'Email is required',
                        'valid_email' => 'Please, check the email field, It does not appears to be valid. ',
                        'is_not_unique' => 'Email is not Exist in our system'
                    ]
                ],
                'password' => [
                    'rules' => 'required|min_length[4]|max_length[45]',
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
                    'rules' => 'required|is_not_unique[user.username]',
                    'errors' => [
                        'required' => 'Username is required',
                        'is_not_unique' => 'Username is not Exist in our system'
                    ]
                ],
                'password' => [
                    'rules' => 'required|min_length[4]|max_length[45]',
                    'errors' => [
                        'required' => 'Password is required',
                        'min_length' => 'Password setidaknya harus 5 karakter',
                        'max_length' => 'Password tidak boleh lebih dari 45 karakter'
                    ]
                ]
            ]);
        }

        if (!$isValid) {
            return view('backend/pages/auth/login-user', [
                'pageTitle' => 'Login',
                'validation' => $this->validator
            ]);

        }

        $user = new userModel();
        $adminInfo = $user->where($fieldtype, $this->request->getVar('login_id'))->first();
        $idProdi = $adminInfo ? $adminInfo['id_prodi'] : null;

        if ($adminInfo) {
            // Periksa apakah akun aktif
            if ($adminInfo['status'] == 'aktif') {
                $inputPassword = Hash::check(
                    $this->request->getVar('password'),
                    $adminInfo['password']
                );

                if ($inputPassword) {
                    // Jika password cocok, lanjutkan
                    CiAuth::setCiAuth1($adminInfo);

                    // Simpan ID Prodi ke dalam sesi
                    $idProdi = $adminInfo['id_prodi'];
                    session()->set('idProdi', $idProdi);

                    return redirect()->route('user.ajukan');
                } else {
                    // Jika password tidak cocok, tampilkan pesan kesalahan
                    return redirect()->route('user.login.form')->with('fail', 'Password Salah')->withInput();
                }
            } else {
                // Jika akun tidak aktif, tampilkan pesan kesalahan
                return redirect()->route('user.login.form')->with('fail', 'Akun tidak aktif')->withInput();
            }
        } else {
            // Jika informasi admin tidak ditemukan, tampilkan pesan kesalahan
            return redirect()->route('user.login.form')->with('fail', 'Login ID tidak ditemukan')->withInput();
        }
    }

    public function forgotForm()
    {
        $data = array(
            'pageTitle' => 'Forgot Password',
            'validation' => null,

        );
        return view('backend/pages/auth/forgot', $data);
    }
    public function forgotFormUser()
    {
        $data = array(
            'pageTitle' => 'Forgot Password',
            'validation' => null,

        );
        return view('backend/pages/auth/forgot-user', $data);
    }

    public function sendPasswordResetLink()
    {

        $isValid = $this->validate([
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email is required',
                    'valid_email' => 'Please check email field.'
                ],
            ]
        ]);

        if (!$isValid) {
            return view('backend/pages/auth/forgot', [
                'pageTitle' => 'Forgot password',
                'validation' => $this->validator,
            ]);
        } else {
            //Get user (admin) details
            $admin = new Admin();
            $admin_info = $admin->asObject()->where('email', $this->request->getVar('email'))->first();

            //Generate Token
            $token = bin2hex(openssl_random_pseudo_bytes(65));

            $password_reset_token = new PasswordResetToken();
            $isOldTokenExists = $password_reset_token->asObject()->where('email', $admin_info->email)->first();

            if ($isOldTokenExists) {
                $password_reset_token->where('email', $admin_info->email)
                    ->set(['tokens' => $token, 'created_at' => Carbon::now()])
                    ->update();
            } else {
                $password_reset_token->insert([
                    'email' => $admin_info->email,
                    'tokens' => $token,
                    'created_at' => Carbon::now()
                ]);
            }

            // $actionLink = route_to('admin.reset-password', $token);
            $actionLink = base_url(route_to('admin.reset-password', $token));

            $mail_data = array(
                'actionLink' => $actionLink,
                'admin' => $admin_info,
            );

            $view = \Config\Services::renderer();
            $mail_body = $view->setVar('email_data', $mail_data)->render('email-templates/forgot-email-template');

            $mailConfig = array(
                'mail_from_email' => env('EMAIL_FROM_ADDRESS'),
                'mail_from_name' => env('EMAIL_FROM_NAME'),
                'mail_recipient_email' => $admin_info->email,
                'mail_recipient_name' => $admin_info->username,
                'mail_subject' => 'Reset Password',
                'mail_body' => $mail_body

            );

            // Send Email
            if (sendEmail($mailConfig)) {
                return redirect()->route('admin.forgot.password')->with('success', 'Kita sudah mengirimkan password ke email mu');
            } else {
                return redirect()->route('admin.forgot.password')->with('fail', 'Ada Sesuatu yang salah');
            }

        }

    }
    public function sendPasswordResetLinkUser()
    {

        $isValid = $this->validate([
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email is required',
                    'valid_email' => 'Please check email field.'
                ],
            ]
        ]);

        if (!$isValid) {
            return view('backend/pages/auth/forgot-user', [
                'pageTitle' => 'Forgot password',
                'validation' => $this->validator,
            ]);
        } else {
            //Get user (admin) details
            $user = new userModel();
            $user_info = $user->asObject()->where('email', $this->request->getVar('email'))->first();

            //Generate Token
            $token = bin2hex(openssl_random_pseudo_bytes(65));

            $password_reset_token = new PasswordResetToken();
            $isOldTokenExists = $password_reset_token->asObject()->where('email', $user_info->email)->first();

            if ($isOldTokenExists) {
                $password_reset_token->where('email', $user_info->email)
                    ->set(['tokens' => $token, 'created_at' => Carbon::now()])
                    ->update();
            } else {
                $password_reset_token->insert([
                    'email' => $user_info->email,
                    'tokens' => $token,
                    'created_at' => Carbon::now()
                ]);
            }

            // $actionLink = route_to('user.reset-password', $token);
            $actionLink = base_url(route_to('user.reset-password', $token));

            $mail_data = array(
                'actionLink' => $actionLink,
                'user' => $user_info,
            );

            $view = \Config\Services::renderer();
            $mail_body = $view->setVar('email_data', $mail_data)->render('email-templates/forgot-email-template-user');

            $mailConfig = array(
                'mail_from_email' => env('EMAIL_FROM_ADDRESS'),
                'mail_from_name' => env('EMAIL_FROM_NAME'),
                'mail_recipient_email' => $user_info->email,
                'mail_recipient_name' => $user_info->username,
                'mail_subject' => 'Reset Password',
                'mail_body' => $mail_body

            );

            // Send Email
            if (sendEmail($mailConfig)) {
                return redirect()->route('user.forgot.password')->with('success', 'Kita sudah mengirimkan password ke email mu');
            } else {
                return redirect()->route('user.forgot.password')->with('fail', 'Ada Sesuatu yang salah');
            }

        }

    }


    public function resetPassword($token)
    {
        $passwordResetPassword = new PasswordResetToken();
        $check_token = $passwordResetPassword->asObject()->where('tokens', $token)->first();

        if (!$check_token) {
            return redirect()->route('admin.forgot.password')->with('fail', 'Invalid token, Mintalah Reset Token Password Yang lain');
        } else {

            $diffMins = Carbon::createFromFormat('Y-m-d H:i:s', $check_token->created_at)->diffInMinutes(Carbon::now());

            if ($diffMins > 15) {
                return redirect()->route('admin.forgot.password')->with('fail', 'Token telah kadalaurasa, silahkan minta password reset link yang baru !');
            } else {
                return view('backend/pages/auth/reset', [
                    'pageTitle' => 'Reset Password',
                    'validation' => null,
                    'token' => $token
                ]);
            }
        }
    }
    public function resetPasswordUser($token)
    {
        $passwordResetPassword = new PasswordResetToken();
        $check_token = $passwordResetPassword->asObject()->where('tokens', $token)->first();

        if (!$check_token) {
            return redirect()->route('user.forgot.password')->with('fail', 'Invalid token, Mintalah Reset Token Password Yang lain');
        } else {

            $diffMins = Carbon::createFromFormat('Y-m-d H:i:s', $check_token->created_at)->diffInMinutes(Carbon::now());

            if ($diffMins > 150000000) {
                return redirect()->route('user.forgot.password')->with('fail', 'Token telah kadalaurasa, silahkan minta password reset link yang baru !');
            } else {
                return view('backend/pages/auth/reset-user', [
                    'pageTitle' => 'Reset Password',
                    'validation' => null,
                    'token' => $token
                ]);
            }
        }
    }

    public function resetPasswordHandler($token)
    {
        $isValid = $this->validate([
            'new_password' => [
                'rules' => 'required|min_length[3]|max_length[30]',
                'errors' => [
                    'required' => 'Masukkan password baru!',
                    'min_length' => 'Password minimal 3 karakter',
                    'max_length' => 'maksimal password adalah 6 karakter'
                ]
            ],
            'confirm_new_password' => [
                'rules' => 'required|matches[new_password]',
                'errors' => [
                    'required' => 'Konfirmasi password baru',
                    'matches' => 'Password tidak sama !'
                ]
            ]
        ]);

        if (!$isValid) {
            return view('backend/pages/auth/reset', [
                'pageTitle' => 'Reset Password',
                'validation' => null,
                'token' => $token,
            ]);
        } else {
            // Dapatkan detail tokens
            $passwordResetPassword = new PasswordResetToken();
            $get_token = $passwordResetPassword->asObject()->where('tokens', $token)->first();

            //Dapatlan admin detail
            $admin = new Admin();
            $admin_info = $admin->asObject()->where('email', $get_token->email)->first();

            if (!$get_token) {
                return redirect()->back()->with('fail', 'Token tidak Valid')->withInput();
            } else {
                //update admin password di database
                $admin->where('email', $admin_info->email)
                    ->set(['password' => Hash::make($this->request->getVar('new_password'))])
                    ->update();

                $mail_data = array(
                    'admin' => $admin_info,
                    'new_password' => $this->request->getVar('new_password')
                );

                $view = \Config\Services::renderer();
                $mail_body = $view->setVar('mail_data', $mail_data)->render('email-templates/password-changed-email-template');

                $mailConfig = array(
                    'mail_from_email' => env('EMAIL_FROM_ADDRESS'),
                    'mail_from_name' => env('EMAI_FROM_NAME'),
                    'mail_recipient_email' => $admin_info->email,
                    'mail_recipient_name' => $admin_info->username,
                    'mail_subject' => 'Changed Password',
                    'mail_body' => $mail_body
                );

                if (sendEmail($mailConfig)) {
                    //Hapus Token
                    $passwordResetPassword->where('email', $admin_info->email)->delete();

                    //Redirect dan tampilkan pesan pada laman login
                    return redirect()->route('admin.login.form')->with('success', 'Berhasil, Password anda telah berhasil di ubah, gunakan password baru untuk login ke system');
                } else {
                    return redirect()->back()->with('fail', 'Ada Sesuatu yang salah!');
                }
            }
        }
    }
    public function resetPasswordHandlerUser($token)
    {
        $isValid = $this->validate([
            'new_password' => [
                'rules' => 'required|min_length[3]|max_length[30]',
                'errors' => [
                    'required' => 'Masukkan password baru!',
                    'min_length' => 'Password minimal 3 karakter',
                    'max_length' => 'maksimal password adalah 6 karakter'
                ]
            ],
            'confirm_new_password' => [
                'rules' => 'required|matches[new_password]',
                'errors' => [
                    'required' => 'Konfirmasi password baru',
                    'matches' => 'Password tidak sama !'
                ]
            ]
        ]);

        if (!$isValid) {
            return view('backend/pages/auth/reset-user', [
                'pageTitle' => 'Reset Password',
                'validation' => null,
                'token' => $token,
            ]);
        } else {
            // Dapatkan detail tokens
            $passwordResetPassword = new PasswordResetToken();
            $get_token = $passwordResetPassword->asObject()->where('tokens', $token)->first();

            //Dapatlan admin detail
            $user = new userModel();
            $user_info = $user->asObject()->where('email', $get_token->email)->first();

            if (!$get_token) {
                return redirect()->back()->with('fail', 'Token tidak Valid')->withInput();
            } else {
                //update user password di database
                $user->where('email', $user_info->email)
                    ->set(['password' => Hash::make($this->request->getVar('new_password'))])
                    ->update();

                $mail_data = array(
                    'user' => $user_info,
                    'new_password' => $this->request->getVar('new_password')
                );

                $view = \Config\Services::renderer();
                $mail_body = $view->setVar('mail_data', $mail_data)->render('email-templates/password-changed-email-user');

                $mailConfig = array(
                    'mail_from_email' => env('EMAIL_FROM_ADDRESS'),
                    'mail_from_name' => env('EMAI_FROM_NAME'),
                    'mail_recipient_email' => $user_info->email,
                    'mail_recipient_name' => $user_info->username,
                    'mail_subject' => 'Changed Password',
                    'mail_body' => $mail_body
                );

                if (sendEmail($mailConfig)) {
                    //Hapus Token
                    $passwordResetPassword->where('email', $user_info->email)->delete();

                    //Redirect dan tampilkan pesan pada laman login
                    return redirect()->route('user.login.form')->with('success', 'Berhasil, Password anda telah berhasil di ubah, gunakan password baru untuk login ke system');
                } else {
                    return redirect()->back()->with('fail', 'Ada Sesuatu yang salah!');
                }
            }
        }
    }

}

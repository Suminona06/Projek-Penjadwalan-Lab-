<?php

namespace App\Controllers;

use App\Models\userModel;
use App\Models\prodiModel;
use App\Models\kritikModel;

class User extends BaseController
{
    public function index()
    {
        $usrModel = new userModel();
        $user = $usrModel->joinProdi()->paginate(10, 'user');
        $data = [
            'user' => $user,
            'pageTitle' => "User",
            'pager' => $usrModel->pager,
        ];



        return view('users/user', $data);
    }

    public function add_data_user()
    {
        $userModel = new userModel;
        $prodiModel = new prodiModel();

        $data = [
            'pageTitle' => 'user',
            'user' => $userModel->find('id_prodi'),
            'prodi' => $prodiModel->findAll()

        ];

        return view('users/add_data_user', $data);
    }

    public function save_data_user()
    {
        $userModel = new userModel();
        $prodiModel = new prodiModel();
        // Ambil data dari form
        $data = [
            'nama_user' => $this->request->getPost('nama_user'),
            'username' => $this->request->getPost('username'),
            'password' => $this->request->getPost('password'),
            'email' => $this->request->getPost('email'),
            'status' => $this->request->getPost('status'),
            'no_telp' => $this->request->getPost('no_telp'),
            'id_prodi' => $this->request->getPost('id_prodi'),
        ];

        // Validasi data jika diperlukan
        // Misalnya, Anda dapat menggunakan fitur validasi CodeIgniter

        // Simpan data ke dalam database

        $userModel->insert($data);

        // Redirect atau tampilkan pesan berhasil, tergantung pada kebutuhan Anda
        return redirect()->to(site_url('admin/users'));
    }

    public function edit_user($id_user)
    {
        $userModel = new UserModel();
        $prodiModel = new ProdiModel();

        $user = $userModel->find($id_user);

        if (!$user) {
            return redirect()->to('/admin/user')->with('error', 'Data user tidak ditemukan.');
        }

        $data = [
            'pageTitle' => 'Edit Data User',
            'user' => $user,
            'prodi' => $prodiModel->findAll()
        ];

        return view('users/edit_data_user', $data);
    }

    public function update_user($id_user)
    {
        $userModel = new UserModel();
        $prodiModel = new ProdiModel();

        $user = $userModel->find($id_user);

        if (!$user) {
            return redirect()->to('admin/users')->with('error', 'Data user tidak ditemukan.');
        }

        // Ambil data dari form
        $postData = $this->request->getPost();

        // Validasi data jika diperlukan

        // Pastikan id_jurusan yang dikirim valid
        if (!$prodiModel->find($postData['id_prodi'])) {
            return redirect()->back()->withInput()->with('error', 'Prodi tidak valid.');
        }

        // Update data user
        $userModel->update($id_user, $postData);

        return redirect()->to('admin/users')->with('success', 'Data prodi berhasil diperbarui.');
    }

    public function delete_user($id)
    {
        $userModel = new UserModel();

        $user = $userModel->find($id);

        if (!$user) {
            return redirect()->to('/admin/users')->with('error', 'Data prodi tidak ditemukan.');
        }

        // Hapus data user
        $userModel->delete($id);

        return redirect()->to('/admin/users')->with('success', 'Data user berhasil dihapus.');
    }

    public function kritik()
    {

        $user = new kritikModel();
        $kritik = $user->paginate(10, 'kritik');
        $data = [
            'kritik' => $kritik,
            'pageTitle' => "Kritik",
            'pager' => $user->pager,
        ];

        return view('users/kritik', $data);
    }
}

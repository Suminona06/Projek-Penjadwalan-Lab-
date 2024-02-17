<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\HardwareLab13;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\HardwareLab10;
use App\Models\HardwareLab9;
use App\Models\HardwareLab11;
use App\Models\HardwareLab12;
use App\Models\HardwareLab14;
use App\Models\HardwareLab15;
use App\Models\HardwareLab16;
use App\Models\RuanganModel;

class HardwareController extends BaseController
{
    public function detail($id_ruangan)
    {

        // Tentukan model yang sesuai dengan ruangan
        $model = 'App\Models\HardwareLab' . $id_ruangan;

        // Buat instance model yang sesuai
        $hardwareModel = new $model;

        $fasilitas = $hardwareModel->paginate(10, 'lab2');
        $data = [
            'pageTitle' => 'Lab Hardware',
            'lab2' => $fasilitas,
            'pager' => $hardwareModel->pager,
            'modelNumber' => $id_ruangan
        ];
        return view('hardware/lab_2', $data);
    }

    //Crud lab 
    public function delete_data_lab($modelNumber, $id_pc)
    {
        switch ($modelNumber) {
            case 9:
                $model = new HardwareLab9();
                break;
            case 10:
                $model = new HardwareLab10();
                break;
            case 11:
                $model = new HardwareLab11();
                break;
            case 12:
                $model = new HardwareLab12();
                break;
            case 13:
                $model = new HardwareLab13();
                break;
            case 14:
                $model = new HardwareLab14();
                break;
            case 15:
                $model = new HardwareLab15();
                break;
            case 16:
                $model = new HardwareLab16();
                break;
            // Tambahkan case lainnya sesuai dengan model yang Anda miliki
            default:
                // Jika nomor model tidak cocok, kembalikan dengan pesan kesalahan
                return redirect()->back()->with('error', 'Nomor model tidak valid.');
        }

        // Hapus data menggunakan model yang sesuai
        $model->delete(['id_pc' => $id_pc]);

        // Redirect ke halaman sebelumnya
        return redirect()->to($_SERVER['HTTP_REFERER'])->with('success', 'Data berhasil dihapus.');


    }



    public function edit_lab($modelNumber, $id_pc)
    {
        switch ($modelNumber) {
            case 9:
                $model = new HardwareLab9();
                break;
            case 10:
                $model = new HardwareLab10();
                break;
            case 11:
                $model = new HardwareLab11();
                break;
            case 12:
                $model = new HardwareLab12();
                break;
            case 13:
                $model = new HardwareLab13();
                break;
            case 14:
                $model = new HardwareLab14();
                break;
            case 15:
                $model = new HardwareLab15();
                break;
            case 16:
                $model = new HardwareLab16();
                break;
            // Tambahkan case lainnya sesuai dengan model yang Anda miliki
            default:
                // Jika nomor model tidak cocok, kembalikan dengan pesan kesalahan
                return redirect()->back()->with('error', 'Nomor model tidak valid.');
        }

        $data = [
            'pageTitle' => 'Edit data lab',
            'modelNumber' => $modelNumber,
            'hardware' => $model->where('id_pc', $id_pc)->first()

        ];

        return view('hardware/edit_data_lab9', $data);
    }

    public function update_lab($id_pc)
    {
        $modelNumber = $this->request->getPost('modelNumber');

        switch ($modelNumber) {
            case 9:
                $model = new HardwareLab9();
                break;
            case 10:
                $model = new HardwareLab10();
                break;
            case 11:
                $model = new HardwareLab11();
                break;
            case 12:
                $model = new HardwareLab12();
                break;
            case 13:
                $model = new HardwareLab13();
                break;
            case 14:
                $model = new HardwareLab14();
                break;
            case 15:
                $model = new HardwareLab15();
                break;
            case 16:
                $model = new HardwareLab16();
                break;
            // Tambahkan case lainnya sesuai dengan model yang Anda miliki
            default:
                // Jika nomor model tidak cocok, kembalikan dengan pesan kesalahan
                return redirect()->back()->with('error', 'Nomor model tidak valid.');
        }

        $rules = $this->validate([
            'no_pc' => [
                'rules' => 'required|max_length[40]',
                'errors' => [
                    'required' => ' no pc tidak boleh kosong',
                    'max_length[40]' => 'Nama Terlalu Panjang',
                ]
            ],
            'nama_pc' => [
                'rules' => 'required|min_length[2]',
                'errors' => [
                    'required' => 'merk pc di perlukan',
                    'min_length' => 'terlalu pendek'
                ]
            ],
            'windows' => [
                'rules' => 'required|min_length[5]',
                'errors' => [
                    'required' => 'masukkan versi os',
                    'min_length' => 'terlalu pendek'
                ]
            ],
            'processor' => [
                'rules' => 'required|min_length[5]',
                'errors' => [
                    'required' => 'processor harus di isi',
                    'min_length' => 'terlalu pendek'
                ]
            ],
            'ram' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => ' jumlah ram harus di isi',
                    'min_length' => 'terlalu pendek'
                ]
            ],
            'mouse' => [
                'rules' => 'required|min_length[2]',
                'errors' => [
                    'required' => 'merek mouse harus di isi',
                    'min_length' => 'terlalu pendek'
                ]
            ],
            'keyboard' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'keyboard harus di isi',
                    'min_length' => 'terlalu pendek'
                ]
            ],

        ]);

        if (!$rules) {
            $data = [
                'pageTitle' => 'Edit data lab',
                'modelNumber' => $modelNumber,
                'hardware' => $model->where('id_pc', $id_pc)->first(),
                'validation' => $this->validator

            ];

            return view('hardware/edit_data_lab9', $data);
        } else {
            // Ambil data dari form
            // Ambil data dari form
            $data = [
                'no_pc' => $this->request->getPost('no_pc'),
                'nama_pc' => $this->request->getPost('nama_pc'),
                'windows' => $this->request->getPost('windows'),
                'processor' => $this->request->getPost('processor'),
                'ram' => $this->request->getPost('ram'),
                'mouse' => $this->request->getPost('mouse'),
                'keyboard' => $this->request->getPost('keyboard'),

            ];

            // Periksa apakah ada file gambar yang diunggah
            $gambar = $this->request->getFile('gambar');
            if ($gambar->isValid() && !$gambar->hasMoved()) {
                // Jika ada, unggah gambar baru
                $newFileName = $gambar->getName();
                $gambar->move('img', $newFileName);
                // Simpan nama gambar ke dalam data
                $data['gambar'] = $newFileName;
            }


            // Update data dengan model yang sesuai
            $model->update($id_pc, $data);

            // Redirect ke halaman pengolahan lab
            return redirect()->to('admin/pengolahan_lab');
        }
        ;



    }

    public function add_data_lab($modelNumber)
    {
        // $softwareModel = new HardwareLab10();

        // Mengirimkan nomor model ke view untuk digunakan dalam formulir
        return view('hardware/add_data_lab', ['modelNumber' => $modelNumber]);
    }

    public function save_data_lab()
    {
        // Mendapatkan nomor model yang dipilih dari input tersembunyi
        $modelNumber = $this->request->getPost('modelNumber');

        switch ($modelNumber) {
            case 9:
                $model = new HardwareLab9();
                break;
            case 10:
                $model = new HardwareLab10();
                break;
            case 11:
                $model = new HardwareLab11();
                break;
            case 12:
                $model = new HardwareLab12();
                break;
            case 13:
                $model = new HardwareLab13();
                break;
            case 14:
                $model = new HardwareLab14();
                break;
            case 15:
                $model = new HardwareLab15();
                break;
            case 16:
                $model = new HardwareLab16();
                break;
            // Tambahkan case lainnya sesuai dengan model yang Anda miliki
            default:
                // Jika nomor model tidak cocok, kembalikan dengan pesan kesalahan
                return redirect()->back()->with('error', 'Nomor model tidak valid.');
        }



        $rules = $this->validate([
            'no_pc' => [
                'rules' => 'required|max_length[40]',
                'errors' => [
                    'required' => ' no pc tidak boleh kosong',
                    'max_length[40]' => 'Nama Terlalu Panjang',
                ]
            ],
            'nama_pc' => [
                'rules' => 'required|min_length[2]',
                'errors' => [
                    'required' => 'merk pc di perlukan',
                    'min_length' => 'terlalu pendek'
                ]
            ],
            'windows' => [
                'rules' => 'required|min_length[5]',
                'errors' => [
                    'required' => 'masukkan versi os',
                    'min_length' => 'terlalu pendek'
                ]
            ],
            'processor' => [
                'rules' => 'required|min_length[5]',
                'errors' => [
                    'required' => 'processor harus di isi',
                    'min_length' => 'terlalu pendek'
                ]
            ],
            'ram' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => ' jumlah ram harus di isi',
                    'min_length' => 'terlalu pendek'
                ]
            ],
            'mouse' => [
                'rules' => 'required|min_length[1]',
                'errors' => [
                    'required' => 'merek mouse harus di isi',
                    'min_length' => 'terlalu pendek'
                ]
            ],
            'keyboard' => [
                'rules' => 'required|min_length[1]',
                'errors' => [
                    'required' => 'keyboard harus di isi',
                    'min_length' => 'terlalu pendek'
                ]
            ],

        ]);

        if (!$rules) {

            $data = [
                'pageTitle' => 'Add data lab',
                'modelNumber' => $modelNumber,
                'validation' => $this->validator

            ];
            return view('hardware/add_data_lab', $data);

        } else {
            // Ambil data dari formulir
            $data = [
                'no_pc' => $this->request->getPost('no_pc'),
                'nama_pc' => $this->request->getPost('nama_pc'),
                'windows' => $this->request->getPost('windows'),
                'processor' => $this->request->getPost('processor'),
                'ram' => $this->request->getPost('ram'),
                'mouse' => $this->request->getPost('mouse'),
                'keyboard' => $this->request->getPost('keyboard'),
            ];

            // Ambil file gambar
            $foto = $this->request->getFile('gambar');

            // Periksa apakah file gambar berhasil diunggah
            if ($foto->isValid() && !$foto->hasMoved()) {
                // Jika ada, pindahkan file gambar ke direktori yang ditentukan
                $namaFoto = $foto->getName();
                $foto->move('img', $namaFoto);

                // Tambahkan nama file gambar ke dalam array data
                $data['gambar'] = $namaFoto;

                // Simpan data ke dalam database
                $model->insert($data);

                // Redirect ke halaman yang sesuai dengan parameter pagination
                $paginationParams = $this->request->getVar('page_lab2');
                return redirect()->to('admin/lab_2_hardware/' . $modelNumber . '?page_lab2=' . $paginationParams)->with('success', 'Data berhasil ditambahkan.');
            } else {
                // Jika file gambar tidak valid atau gagal diunggah, beri tanggapan yang sesuai
                return redirect()->back()->with('error', 'Gagal mengunggah gambar.');
            }
        }
    }




}

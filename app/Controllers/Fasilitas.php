<?php

namespace App\Controllers;

use App\Models\fasilitas_softwareModel;
use App\Models\RuanganModel;
use App\Models\barangModel;
use App\Models\galeriModel;

class Fasilitas extends BaseController
{
    public function index()
    {
        $hardwareModel = new RuanganModel();
        $fasilitas = $hardwareModel->paginate(10, 'fasilitas');
        $data = [
            'fasilitas' => $fasilitas,
            'pageTitle' => "Fasilitas Hardware",
            'pager' => $hardwareModel->pager,
        ];

        return view('pengolahan_lab/fasilitas', $data);
    }

    public function software()
    {
        $hardwareModel = new RuanganModel();
        $fasilitas = $hardwareModel->paginate(10, 'fasilitas');
        $data = [
            'fasilitas' => $fasilitas,
            'pageTitle' => "Fasilitas Software",
            'pager' => $hardwareModel->pager,
        ];

        return view('pengolahan_lab/r_software', $data);
    }

    public function detailFasilitas($id_ruangan)
    {
        $fasilitasModel = new fasilitas_softwareModel();
        $ruanganModel = new RuanganModel();

        // Ambil data ruangan untuk digunakan di view
        $ruangan = $ruanganModel->find($id_ruangan);

        // Ambil data fasilitas software berdasarkan id ruangan dengan paginasi
        $fasilitas = $fasilitasModel->where('id_ruangan', $id_ruangan)->paginate(10, 'fasilitas');

        $data = [
            'fasilitas' => $fasilitas,
            'ruangan' => $ruangan,
            'pageTitle' => 'Software Lab',
            'pager' => $fasilitasModel->pager,
            'id_ruangan' => $id_ruangan
        ];

        return view('pengolahan_lab/f_software', $data);
    }

    public function delete_software($id)
    {
        $fasilitas = new fasilitas_softwareModel();
        $fasilitas->delete(['id' => $id]);
        // Redirect ke halaman sebelumnya
        return redirect()->to($_SERVER['HTTP_REFERER'])->with('success', 'Data berhasil dihapus.');
    }


    public function edit_software($id)
    {
        $softwareModel = new fasilitas_softwareModel;
        $data = [
            'pageTitle' => 'software',
            'software' => $softwareModel->where('id', $id)->first()
        ];

        return view('pengolahan_lab/edit_data_software', $data);
    }

    public function update_software1($id)
    {
        $softwareModel = new fasilitas_softwareModel;
        $rules = $this->validate([
            'gambar' => [
                'rules' => 'required|max_length[40]',
                'errors' => [
                    'required' => 'gambar di perlukan',
                    'max_length' => 'terlalu panjang!'
                ]
            ],
            'nama' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'nama di perlukan',
                    'min_length' => 'terlalu pendek!'
                ]
            ],
            'jumlah' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'jumlah di perlukan',
                ]
            ],
            'id_ruangan' => [
                'rules' => 'required',
                'errors' => 'nama ruangan harus di isi'
            ]
        ]);

        if (!$rules) {
            $softwareModel = new fasilitas_softwareModel;
            $data = [
                'pageTitle' => 'software',
                'software' => $softwareModel->where('id', $id)->first(),
                'validation' => $this->validator
            ];

            return view('pengolahan_lab/edit_data_software', $data);
        } else {
            $data = $this->request->getPost();
            $softwareModel->update($id, $data);
            return redirect()->to('admin/fasilitas');

        }


    }

    public function add_data_software($id_ruangan)
    {
        $ruanganModel = new RuanganModel();
        $softwareModel = new fasilitas_softwareModel;
        $data = [
            'pageTitle' => 'galeri',
            'ruangan' => $ruanganModel->findAll(),
            'id_ruangan' => $id_ruangan,
            'software' => $softwareModel->findAll()

        ];
        return view('pengolahan_lab/add_data_software', $data);
    }

    public function save_data_software1()
    {
        $softwareModel = new fasilitas_softwareModel;
        $data = $this->request->getPost();
        $id_ruangan = $this->request->getPost('id_ruangan');

        $rules = $this->validate([
            'gambar' => [
                'rules' => 'required|max_length[40]',
                'errors' => [
                    'required' => 'Gambar diperlukan',
                    'max_length' => 'Nama file gambar terlalu panjang'
                ]
            ],
            'nama' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'Nama diperlukan',
                    'min_length' => 'Nama terlalu pendek'
                ]
            ],
            'jumlah' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jumlah diperlukan',
                ]
            ],
            'nama_ruangan' => [
                'rules' => 'required',
                'errors' => 'Nama ruangan harus diisi'
            ]
        ]);

        if (!$rules) {
            // Validasi gagal, kembali ke halaman form dengan pesan kesalahan
            $ruanganModel = new RuanganModel();
            return view('pengolahan_lab/add_data_software', [
                'pageTitle' => 'Tambah Data Software',
                'ruangan' => $ruanganModel->findAll(),
                'validation' => $this->validator,
                'id_ruangan' => $id_ruangan
            ]);
        } else {
            // Dapatkan id ruangan berdasarkan nama ruangan yang dipilih
            $ruanganModel = new RuanganModel();
            $ruangan = $ruanganModel->where('nama_ruangan', $data['nama_ruangan'])->first();
            $data['id_ruangan'] = $ruangan['id_ruangan'];

            // Hapus nama ruangan dari data sebelum menyimpan ke dalam tabel software
            unset($data['nama_ruangan']);

            // Simpan data perangkat lunak baru
            $softwareModel->insert($data);

            // Redirect kembali ke halaman detail fasilitas dengan menyertakan id ruangan
            return redirect()->to('admin/detail_fasilitas/' . $id_ruangan);
        }
    }




    //Ruangan Controller
    public function ruangan()
    {
        $fasilitas = new RuanganModel();
        $ruangan = $fasilitas->joinPegawai()->paginate(10, 'ruangan');
        $data = [
            'ruangan' => $ruangan,
            'pageTitle' => "Ruangan",
            'pager' => $fasilitas->pager,
        ];

        return view('pengolahan_lab/ruangan', $data);
    }

    public function edit_ruangan($id_ruangan)
    {
        $ruanganModel = new RuanganModel;
        $data = [
            'pageTitle' => 'ruangan',
            'ruangan' => $ruanganModel->where('id_ruangan', $id_ruangan)->first()
        ];

        return view('pengolahan_lab/edit_data_ruangan', $data);
    }

    public function update_ruangan($id_ruangan)
    {
        $ruanganModel = new RuanganModel;
        $rules = $this->validate([
            'nama_ruangan' => [
                'rules' => 'required|max_length[40]',
                'errors' => [
                    'required' => ' nama ruangan tidak boleh kosong',
                    'max_length[40]' => 'Nama Terlalu Panjang',
                ]
            ],
            'keterangan' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'keterangan di perlukan',
                    'min_length' => 'terlalu pendek'
                ]
            ],
            'lokasi' => [
                'rules' => 'required|min_length[5]',
                'errors' => [
                    'required' => 'lokasi tidak boleh kosong!',
                    'min_length' => 'terlalu pendek'
                ]
            ]
        ]);

        if (!$rules) {
            return view('pengolahan_lab/edit_data_ruangan', [
                'pageTitle' => 'Edit Data Ruangan',
                'ruangan' => $ruanganModel->where('id_ruangan', $id_ruangan)->first(),
                'validation' => $this->validator
            ]);
        } else {
            $data = $this->request->getPost();
            $ruanganModel->update($id_ruangan, $data);
            return redirect()->to('admin/ruangan');
        }
    }

    public function add_data_ruangan()
    {
        $ruanganModel = new ruanganModel;
        return view('pengolahan_lab/add_data_ruangan');
    }

    public function save_data_ruangan()
    {
        $ruanganModel = new RuanganModel;
        $rules = $this->validate([
            'nama_ruangan' => [
                'rules' => 'required|max_length[40]',
                'errors' => [
                    'required' => ' nama ruangan tidak boleh kosong',
                    'max_length[40]' => 'Nama Terlalu Panjang',
                ]
            ],
            'keterangan' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'keterangan di perlukan',
                    'min_length' => 'terlalu pendek'
                ]
            ],
            'lokasi' => [
                'rules' => 'required|min_length[5]',
                'errors' => [
                    'required' => 'lokasi tidak boleh kosong!',
                    'min_length' => 'terlalu pendek'
                ]
            ]
        ]);

        if (!$rules) {
            return view('pengolahan_lab/add_data_ruangan', [
                'pageTitle' => 'Tambah Data',
                'validation' => $this->validator
            ]);

        } else {
            $ruanganModel->insert($this->request->getPost());
            return redirect()->to('admin/ruangan');
        }
    }

    public function delete_ruangan($id_nama)
    {
        $ruanganModel = new RuanganModel();
        $ruanganModel->delete(['id_nama' => $id_nama]);
        return redirect()->to('admin/ruangan');
    }




    public function barang()
    {
        $fasilitas = new barangModel();
        $barang = $fasilitas->joinRuangan()->paginate(10, 'barang');
        $data = [
            'barang' => $barang,
            'pageTitle' => "Data Barang",
            'pager' => $fasilitas->pager,
        ];

        return view('pengolahan_lab/barang', $data);
    }

    public function delete_barang($id_aset)
    {
        $barangModel = new barangModel();
        $barangModel->delete(['id_aset' => $id_aset]);
        return redirect()->to('admin/barang');
    }

    public function edit_barang($id_aset)
    {
        $barangModel = new barangModel;
        $data = [
            'pageTitle' => 'barang',
            'barang' => $barangModel->where('id_aset', $id_aset)->first()
        ];

        return view('pengolahan_lab/edit_data_barang', $data);
    }

    public function update_barang($id_aset)
    {
        $barangModel = new barangModel;

        $rules = $this->validate([
            'deskripsi' => [
                'rules' => 'required|max_length[40]',
                'errors' => [
                    'required' => 'gambar di perlukan',
                    'max_length' => 'terlalu panjang!'
                ]
            ],
            'serialnumber' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'nama di perlukan',
                    'min_length' => 'terlalu pendek!'
                ]
            ],
            'supplier' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'jumlah di perlukan',
                ]
            ],
            'brand' => [
                'rules' => 'required',
                'errors' => 'nama ruangan harus di isi'
            ],
            'model' => [
                'rules' => 'required',
                'errors' => 'nama model harus di isi'
            ],
            'penanggungjawab' => [
                'rules' => 'required',
                'errors' => 'form harus di isi'
            ],
        ]);

        if (!$rules) {
            $barangModel = new barangModel;
            $data = [
                'pageTitle' => 'barang',
                'barang' => $barangModel->where('id_aset', $id_aset)->first(),
                'validation' => $this->validator
            ];

            return view('pengolahan_lab/edit_data_barang', $data);
        } else {
            $data = $this->request->getPost();
            $barangModel->update($id_aset, $data);
            return redirect()->to('admin/barang');
        }


    }

    public function add_data_barang()
    {
        $galeriModel = new galeriModel;
        return view('pengolahan_lab/add_data_barang');
    }

    public function save_data_barang()
    {
        $barangModel = new barangModel;

        $rules = $this->validate([
            'deskripsi' => [
                'rules' => 'required|max_length[40]',
                'errors' => [
                    'required' => 'gambar di perlukan',
                    'max_length' => 'terlalu panjang!'
                ]
            ],
            'serialnumber' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'nama di perlukan',
                    'min_length' => 'terlalu pendek!'
                ]
            ],
            'supplier' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'jumlah di perlukan',
                ]
            ],
            'brand' => [
                'rules' => 'required',
                'errors' => 'nama ruangan harus di isi'
            ],
            'model' => [
                'rules' => 'required',
                'errors' => 'nama model harus di isi'
            ],
            'penanggungjawab' => [
                'rules' => 'required',
                'errors' => 'form harus di isi'
            ],
        ]);

        if (!$rules) {
            $galeriModel = new galeriModel;
            return view('pengolahan_lab/add_data_barang', [
                'pageTitle' => 'Edit Barang',
                'validation' => $this->validator
            ]);
        } else {
            $barangModel->insert($this->request->getPost());
            return redirect()->to('admin/barang');
        }
    }


    public function galeri()
    {
        $fasilitas = new galeriModel();
        $galeri = $fasilitas->joinRuangan()->orderBy('galeri.id_ruangan', 'asc')->paginate(10, 'galeri');
        $data = [
            'galeri' => $galeri,
            'pageTitle' => "Galeri",
            'pager' => $fasilitas->pager,

        ];

        return view('pengolahan_lab/galeri', $data);

    }

    public function delete_galeri($id_galeri)
    {
        $galeriModel = new galeriModel();
        $galeriModel->delete(['id_galeri' => $id_galeri]);
        return redirect()->to('admin/galeri');
    }

    public function edit_galeri($id_galeri)
    {
        $galeriModel = new galeriModel();
        $ruanganModel = new RuanganModel();
        $data = [
            'pageTitle' => 'galeri',
            'galeri' => $galeriModel->where('id_galeri', $id_galeri)->first(),
            'ruangan' => $ruanganModel->findAll()
        ];

        return view('pengolahan_lab/edit_data_galeri', $data);
    }

    public function update_galeri($id_galeri)
    {
        $galeriModel = new galeriModel;
        $ruanganModel = new ruanganModel();
        $id_ruangan = $this->request->getPost('id_ruangan');
        // Menerima data yang dikirim melalui form
        $data = [

            // Pastikan untuk mengambil nama gambar yang sudah ada
            'foto' => $this->request->getPost('foto')
        ];

        $rules = $this->validate([
            'foto' => [
                'rules' => 'uploaded[foto]|mime_in[foto,image/jpg,image/jpeg,image/png,image/gif]|max_size[foto,1024]',
                'errors' => [
                    'uploaded' => 'foto belum di upload',
                    'mime_in' => 'maaf file anda bukan image',
                    'max_size' => 'maaf file anda bukan image',
                ]
            ]
        ]);

        if (!$rules) {
            return view('pengolahan_lab/edit_data_galeri', [
                'pageTitle' => 'Tambah Data',
                'galeri' => $galeriModel->find($id_galeri),
                'ruangan' => $ruanganModel->findAll(),
                'validation' => $this->validator
            ]);
        } else {
            $foto = $this->request->getFile('foto');
            // Periksa apakah ada file yang diunggah
            if ($foto->isValid() && !$foto->hasMoved()) {
                // Jika ada file yang diunggah, unggah gambar baru
                $namaFoto = $foto->getName();
                $foto->move('img', $namaFoto);
                $data = [
                    'foto' => $namaFoto
                ];
            } else {
                // Jika tidak ada file yang diunggah, tetapkan data foto dari input form
                $data = [
                    'foto' => $this->request->getPost('foto')
                ];
            }
            // Ambil nama ruangan baru dari database berdasarkan id_ruangan yang baru
            if ($id_ruangan) {
                // Lakukan sesuatu dengan $data['id_ruangan'] di sini
                $ruanganBaru = $ruanganModel->find($id_ruangan);
                // ...
            }
            // Perbarui entri di database dengan data yang baru
            $galeriModel->update($id_galeri, [
                'id_ruangan' => $id_ruangan,
                'nama_ruangan' => $ruanganBaru['nama_ruangan'], // Perbarui nama ruangan
                'foto' => $data['foto']
            ]);
            return redirect()->to('admin/galeri');
        }

    }

    public function add_data_galeri()
    {
        $galeriModel = new galeriModel;
        $ruanganModel = new RuanganModel();

        $galeri = $galeriModel->findAll();

        $data = [
            'ruangan' => $ruanganModel->findAll(),
            'galeri' => $galeriModel->findAll(),
        ];
        return view('pengolahan_lab/add_data_galeri', $data);
    }

    public function save_data_galeri()
    {
        $galeriModel = new galeriModel;

        $rules = $this->validate([
            'foto' => [
                'rules' => 'uploaded[foto]|mime_in[foto,image/jpg,image/jpeg,image/png,image/gif]|max_size[foto,1024]',
                'errors' => [
                    'uploaded' => 'foto belum di upload',
                    'mime_in' => 'maaf file anda bukan image',
                    'max_size' => 'maaf file anda bukan image',
                ]
            ]
        ]);
        if (!$rules) {
            return view('pengolahan_lab/add_data_galeri', [
                'pageTitle' => 'Tambah Data',
                'validation' => $this->validator,
            ]);

        } else {
            $foto = $this->request->getFile('foto');
            $namaFoto = $foto->getName();
            $foto->move('img', $namaFoto);
            $galeriModel->insert([
                'foto' => $namaFoto,  // Gunakan nama file yang valid
                'id_ruangan' => $this->request->getPost('id_ruangan'),
            ]);
            return redirect()->to('admin/galeri');
        }
    }

    public function update_software($id)
    {
        $softwareModel = new fasilitas_softwareModel;

        // Validasi input
        $rules = [
            'nama' => 'required|min_length[3]',
            'jumlah' => 'required',
            'id_ruangan' => 'required'
        ];

        if (!$this->validate($rules)) {
            $data = [
                'pageTitle' => 'Edit Software',
                'software' => $softwareModel->find($id),
                'validation' => $this->validator
            ];
            return view('pengolahan_lab/edit_data_software', $data);
        }

        // Ambil data dari form
        $data = [
            'nama' => $this->request->getPost('nama'),
            'jumlah' => $this->request->getPost('jumlah'),
            'id_ruangan' => $this->request->getPost('id_ruangan')
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

        // Lakukan update data
        $softwareModel->update($id, $data);

        return redirect()->to('admin/fasilitas');
    }

    public function save_data_software()
    {
        $softwareModel = new fasilitas_softwareModel;
        $data = $this->request->getPost();
        $id_ruangan = $this->request->getPost('id_ruangan');

        // Validasi input
        $rules = [
            'nama' => 'required|min_length[3]',
            'jumlah' => 'required',
            'gambar' => 'uploaded[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png,image/gif]|max_size[gambar,1024]',
            'nama_ruangan' => 'required'
        ];

        if (!$this->validate($rules)) {
            // Validasi gagal, kembali ke halaman form dengan pesan kesalahan
            $ruanganModel = new RuanganModel();
            return view('pengolahan_lab/add_data_software', [
                'pageTitle' => 'Tambah Data Software',
                'ruangan' => $ruanganModel->findAll(),
                'validation' => $this->validator,
                'id_ruangan' => $id_ruangan
            ]);
        }

        // Dapatkan id ruangan berdasarkan nama ruangan yang dipilih
        $ruanganModel = new RuanganModel();
        $ruangan = $ruanganModel->where('nama_ruangan', $data['nama_ruangan'])->first();
        $data['id_ruangan'] = $ruangan['id_ruangan'];

        // Hapus nama ruangan dari data sebelum menyimpan ke dalam tabel software
        unset($data['nama_ruangan']);

        // Unggah gambar
        $gambar = $this->request->getFile('gambar');
        $newFileName = $gambar->getName();
        $gambar->move('img', $newFileName);
        $data['gambar'] = $newFileName;

        // Simpan data perangkat lunak baru
        $softwareModel->insert($data);

        // Redirect kembali ke halaman detail fasilitas dengan menyertakan id ruangan
        return redirect()->to('admin/detail_fasilitas/' . $id_ruangan);
    }


}
<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\fasilitas_hardwareModel;
use CodeIgniter\HTTP\ResponseInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\JadwalModel;
use App\Models\JadwalDetailModel;
use App\Models\JamModel;
use App\Models\fasilitas_softwareModel;
use App\Models\RuanganModel;

class ExcelController extends BaseController
{
    public function index($reguler)
    {
        $jadwalModel = new JadwalModel();
        $jadwal = $jadwalModel->joinRuangan()->joinTA()->joinProdi()->joinJam()->where('jenis', $reguler)->findAll();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Mata Kuliah');
        $sheet->setCellValue('C1', 'Dosen');
        $sheet->setCellValue('D1', 'Kelas');
        $sheet->setCellValue('E1', 'Jam');
        $sheet->setCellValue('F1', 'Program Studi');
        $sheet->setCellValue('G1', 'Semester');
        $sheet->setCellValue('H1', 'Jenis');
        $sheet->setCellValue('I1', 'Hari');
        $sheet->setCellValue('J1', 'Tahun');
        $column = 2;
        foreach ($jadwal as $key => $value) {
            $sheet->setCellValue('A' . $column, ($column - 1));
            $sheet->setCellValue('B' . $column, $value['mk']);
            $sheet->setCellValue('C' . $column, $value['nama_dosen']);
            $sheet->setCellValue('D' . $column, $value['kelas']);
            $sheet->setCellValue('E' . $column, $value['jam']);
            $sheet->setCellValue('F' . $column, $value['nama_prodi']);
            $sheet->setCellValue('G' . $column, $value['semester']);
            $sheet->setCellValue('H' . $column, $value['jenis']);
            $sheet->setCellValue('I' . $column, $value['hari']);
            $sheet->setCellValue('J' . $column, $value['thn_awal'] . ' - ' . $value['thn_akhir']);
            $column++;
        }
        // Mendapatkan rentang seluruh isi tabel
        $tableRange = 'A1:J' . ($column - 1);

        $sheet->getStyle('A1:J1')->getFont()->setBold(true);
        $sheet->getStyle('A1:J1')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FFFFFF00');
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ];
        // Mendapatkan objek stylenya
        $style = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Penataan horizontal ke tengah
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER, // Penataan vertikal ke tengah
            ],
        ];

        $sheet->getStyle('A1:J' . ($column - 1))->applyFromArray($styleArray);
        // Menerapkan gaya ke seluruh isi tabel
        $sheet->getStyle($tableRange)->applyFromArray($style);


        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);
        $sheet->getColumnDimension('H')->setAutoSize(true);
        $sheet->getColumnDimension('I')->setAutoSize(true);
        $sheet->getColumnDimension('J')->setAutoSize(true);

        $writer = new Xlsx($spreadsheet);
        // Generate file name based on $reguler variable
        $filename = 'jadwal_' . $reguler . '.xlsx';
        header('Content-Type: appliaction/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename);
        header('Cache-Control: max_age=0');
        $writer->save('php://output');
        exit();
    }
    public function filterHari($reguler, $hari)
    {
        $jadwalModel = new JadwalModel();
        $jadwal = $jadwalModel->joinRuangan()->joinTA()->joinProdi()->joinJam()->where('jenis', $reguler)->where('jadwal.hari', $hari)->findAll();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Mata Kuliah');
        $sheet->setCellValue('C1', 'Dosen');
        $sheet->setCellValue('D1', 'Kelas');
        $sheet->setCellValue('E1', 'Jam');
        $sheet->setCellValue('F1', 'Program Studi');
        $sheet->setCellValue('G1', 'Semester');
        $sheet->setCellValue('H1', 'Jenis');
        $sheet->setCellValue('I1', 'Hari');
        $sheet->setCellValue('J1', 'Tahun');
        $column = 2;
        foreach ($jadwal as $key => $value) {
            $sheet->setCellValue('A' . $column, ($column - 1));
            $sheet->setCellValue('B' . $column, $value['mk']);
            $sheet->setCellValue('C' . $column, $value['nama_dosen']);
            $sheet->setCellValue('D' . $column, $value['kelas']);
            $sheet->setCellValue('E' . $column, $value['jam']);
            $sheet->setCellValue('F' . $column, $value['nama_prodi']);
            $sheet->setCellValue('G' . $column, $value['semester']);
            $sheet->setCellValue('H' . $column, $value['jenis']);
            $sheet->setCellValue('I' . $column, $value['hari']);
            $sheet->setCellValue('J' . $column, $value['thn_awal'] . ' - ' . $value['thn_akhir']);
            $column++;
        }
        // Mendapatkan rentang seluruh isi tabel
        $tableRange = 'A1:J' . ($column - 1);

        $sheet->getStyle('A1:J1')->getFont()->setBold(true);
        $sheet->getStyle('A1:J1')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FFFFFF00');
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ];
        // Mendapatkan objek stylenya
        $style = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Penataan horizontal ke tengah
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER, // Penataan vertikal ke tengah
            ],
        ];

        $sheet->getStyle('A1:J' . ($column - 1))->applyFromArray($styleArray);
        // Menerapkan gaya ke seluruh isi tabel
        $sheet->getStyle($tableRange)->applyFromArray($style);


        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);
        $sheet->getColumnDimension('H')->setAutoSize(true);
        $sheet->getColumnDimension('I')->setAutoSize(true);
        $sheet->getColumnDimension('J')->setAutoSize(true);

        $writer = new Xlsx($spreadsheet);
        // Generate file name based on $reguler variable
        $filename = 'jadwal_' . $reguler . '.xlsx';
        header('Content-Type: appliaction/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename);
        header('Cache-Control: max_age=0');
        $writer->save('php://output');
        exit();
    }
    public function filterJam($reguler, $jam)
    {
        $jadwalModel = new JadwalModel();
        $jadwal = $jadwalModel->joinRuangan()->joinTA()->joinProdi()->joinJam()->where('jenis', $reguler)->where('jam', $jam)->findAll();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Mata Kuliah');
        $sheet->setCellValue('C1', 'Dosen');
        $sheet->setCellValue('D1', 'Kelas');
        $sheet->setCellValue('E1', 'Jam');
        $sheet->setCellValue('F1', 'Program Studi');
        $sheet->setCellValue('G1', 'Semester');
        $sheet->setCellValue('H1', 'Jenis');
        $sheet->setCellValue('I1', 'Hari');
        $sheet->setCellValue('J1', 'Tahun');
        $column = 2;
        foreach ($jadwal as $key => $value) {
            $sheet->setCellValue('A' . $column, ($column - 1));
            $sheet->setCellValue('B' . $column, $value['mk']);
            $sheet->setCellValue('C' . $column, $value['nama_dosen']);
            $sheet->setCellValue('D' . $column, $value['kelas']);
            $sheet->setCellValue('E' . $column, $value['jam']);
            $sheet->setCellValue('F' . $column, $value['nama_prodi']);
            $sheet->setCellValue('G' . $column, $value['semester']);
            $sheet->setCellValue('H' . $column, $value['jenis']);
            $sheet->setCellValue('I' . $column, $value['hari']);
            $sheet->setCellValue('J' . $column, $value['thn_awal'] . ' - ' . $value['thn_akhir']);
            $column++;
        }
        // Mendapatkan rentang seluruh isi tabel
        $tableRange = 'A1:J' . ($column - 1);

        $sheet->getStyle('A1:J1')->getFont()->setBold(true);
        $sheet->getStyle('A1:J1')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FFFFFF00');
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ];
        // Mendapatkan objek stylenya
        $style = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Penataan horizontal ke tengah
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER, // Penataan vertikal ke tengah
            ],
        ];

        $sheet->getStyle('A1:J' . ($column - 1))->applyFromArray($styleArray);
        // Menerapkan gaya ke seluruh isi tabel
        $sheet->getStyle($tableRange)->applyFromArray($style);


        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);
        $sheet->getColumnDimension('H')->setAutoSize(true);
        $sheet->getColumnDimension('I')->setAutoSize(true);
        $sheet->getColumnDimension('J')->setAutoSize(true);

        $writer = new Xlsx($spreadsheet);
        // Generate file name based on $reguler variable
        $filename = 'jadwal_' . $reguler . '.xlsx';
        header('Content-Type: appliaction/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename);
        header('Cache-Control: max_age=0');
        $writer->save('php://output');
        exit();
    }

    public function filterSoftware($id_ruangan)
    {
        $softwareModel = new fasilitas_softwareModel();
        $software = $softwareModel->joinRuangan()->where('f_software.id_ruangan', $id_ruangan)->findAll();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Gambar');
        $sheet->setCellValue('C1', 'Nama hardware');
        $sheet->setCellValue('D1', 'Jumlah');
        $sheet->setCellValue('E1', 'Lab');
        $column = 2;
        foreach ($software as $key => $value) {
            $sheet->setCellValue('A' . $column, ($column - 1));
            $sheet->setCellValue('B' . $column, $value['gambar']);
            $sheet->setCellValue('C' . $column, $value['nama']);
            $sheet->setCellValue('D' . $column, $value['jumlah']);
            $sheet->setCellValue('E' . $column, $value['nama_ruangan']);
            $column++;
        }
        // Mendapatkan rentang seluruh isi tabel
        $tableRange = 'A1:E' . ($column - 1);

        $sheet->getStyle('A1:E1')->getFont()->setBold(true);
        $sheet->getStyle('A1:E1')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FFFFFF00');
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ];
        // Mendapatkan objek stylenya
        $style = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Penataan horizontal ke tengah
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER, // Penataan vertikal ke tengah
            ],
        ];

        $sheet->getStyle('A1:E' . ($column - 1))->applyFromArray($styleArray);
        // Menerapkan gaya ke seluruh isi tabel
        $sheet->getStyle($tableRange)->applyFromArray($style);


        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);

        $writer = new Xlsx($spreadsheet);
        $ruangan = 'Lab UPA-TIK';
        // Generate file name based on $reguler variable
        $filename = 'jadwal_' . $ruangan . '.xlsx';
        header('Content-Type: appliaction/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename);
        header('Cache-Control: max_age=0');
        $writer->save('php://output');
        exit();
    }

    public function filterHardware($id_ruangan)
    {
        $hardwareModel = new fasilitas_hardwareModel();
        $hardware = $hardwareModel->joinRuangan()->where('f_hardware_b.id_ruangan', $id_ruangan)->findAll();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Gambar');
        $sheet->setCellValue('C1', 'Nama Hardware');
        $sheet->setCellValue('D1', 'Jumlah');
        $sheet->setCellValue('E1', 'Lab');
        $column = 2;
        foreach ($hardware as $key => $value) {
            $sheet->setCellValue('A' . $column, ($column - 1));
            $sheet->setCellValue('B' . $column, $value['gambar']);
            $sheet->setCellValue('C' . $column, $value['nama']);
            $sheet->setCellValue('D' . $column, $value['jumlah']);
            $sheet->setCellValue('E' . $column, $value['nama_ruangan']);
            $column++;
        }
        // Mendapatkan rentang seluruh isi tabel
        $tableRange = 'A1:E' . ($column - 1);

        $sheet->getStyle('A1:E1')->getFont()->setBold(true);
        $sheet->getStyle('A1:E1')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FFFFFF00');
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ];
        // Mendapatkan objek stylenya
        $style = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Penataan horizontal ke tengah
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER, // Penataan vertikal ke tengah
            ],
        ];

        $sheet->getStyle('A1:E' . ($column - 1))->applyFromArray($styleArray);
        // Menerapkan gaya ke seluruh isi tabel
        $sheet->getStyle($tableRange)->applyFromArray($style);


        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);

        $writer = new Xlsx($spreadsheet);
        $ruangan = 'Lab UPA-TIK';
        // Generate file name based on $reguler variable
        $filename = 'ruangan_' . $ruangan . '.xlsx';
        header('Content-Type: appliaction/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename);
        header('Cache-Control: max_age=0');
        $writer->save('php://output');
        exit();
    }


    public function jadwalReguler()
    {
        $jadwalModel = new JadwalModel();

        // Fetch required data from the model
        $thn_awal = $jadwalModel->getTahunAwal();
        $thn_akhir = $jadwalModel->getTahunAkhir();
        $semester = $jadwalModel->getSemester();
        $hari = $jadwalModel->getHari();
        $jam = $jadwalModel->getJam();
        $ruangan = $jadwalModel->getRuangan();
        $jadwal = $jadwalModel->getJadwal();

        // Calculate the number of rooms
        $jumlahLab = count($ruangan);

        // Create new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set headers
        $sheet->setCellValue('A1', 'Hari');
        $sheet->setCellValue('B1', 'Lab');
        $col = 'C';
        foreach ($jam as $j) {
            $sheet->setCellValue($col . '1', $j->jam);
            $col++;
        }

        // Populate data
        $row = 2;
        foreach ($hari as $h) {
            foreach ($ruangan as $r) {
                $sheet->setCellValue('A' . $row, $h);
                $sheet->setCellValue('B' . $row, $r->nama_ruangan);
                $col = 'C';
                foreach ($jam as $j) {
                    $kelas = '';
                    foreach ($jadwal as $k) {
                        if ($k->hari == $h && $k->id_ruangan == $r->id_ruangan && $k->id_jam == $j->id) {
                            $kelas = $k->kelas;
                            break;
                        }
                    }
                    $sheet->setCellValue($col . $row, $kelas);
                    $col++;
                }
                $row++;
            }
        }

        // Save spreadsheet to file
        $writer = new Xlsx($spreadsheet);
        $filename = 'data-Jadwal.xlsx'; // Set file name
        $writer->save($filename);

        // Set header for Excel file
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // Output file to browser
        readfile($filename);
        exit();
    }
}

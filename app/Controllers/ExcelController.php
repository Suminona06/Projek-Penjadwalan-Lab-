<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\JadwalModel;
use App\Models\JadwalDetailModel;
use App\Models\JamModel;

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
}

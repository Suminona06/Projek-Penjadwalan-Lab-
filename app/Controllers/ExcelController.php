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
    public function index()
    {
        $jadwalModel = new JadwalModel();
        $jadwal = $jadwalModel->joinRuangan()->joinTA()->joinProdi()->joinJam()->where('jenis', 'REGULER');
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('A1', 'Mata Kuliah');
        $sheet->setCellValue('A1', 'Dosen');
        $sheet->setCellValue('A1', 'Kelas');
        $sheet->setCellValue('A1', 'Jam');
        $sheet->setCellValue('A1', 'Program Studi');
        $sheet->setCellValue('A1', 'Semester');
        $sheet->setCellValue('A1', 'Jenis');
        $sheet->setCellValue('A1', 'Hari');
        $sheet->setCellValue('A1', 'Tahun');

        $writer = new Xlsx($spreadsheet);
        $writer->save('hello world.xlsx');
    }
}

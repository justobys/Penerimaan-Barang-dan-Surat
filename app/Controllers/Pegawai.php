<?php

namespace App\Controllers;

use App\Models\PegawaiM;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Dompdf\Dompdf;

class Pegawai extends BaseController
{
    public function index()
    {
        $model = new PegawaiM();
        $search = $this->request->getGet('search');
        $data = $model->getDataPegawai($search);
        return view('pegawai', compact('data'));
    }

    public function tambah()
    {
        $model = new PegawaiM();
        $dataPegawai = $model->getTablePegawai();

        if ($this->request->getMethod() === 'post') {
            $data = [
                'nama_pegawai' => $this->request->getPost('nama_pegawai'),
                'email' => $this->request->getPost('email'),
            ];

            $model->insertPegawai($data);
            return redirect()->to('/Pegawai')->with('success', 'Data Pegawai Berhasil Dimasukkan');
        }

        return view('inputpegawai', compact('dataPegawai'));
    }

    public function edit($idpegawai)
    {
        $model = new PegawaiM;
        $dataPegawai = $model->getPegawaiById($idpegawai);

        if ($this->request->getMethod() === 'post') {
            $data = [
                'nama_pegawai' => $this->request->getPost('nama_pegawai'),
                'email' => $this->request->getPost('email'),
            ];
            $model->updatePegawai($idpegawai, $data);
            return redirect()->to('/Pegawai')->with('success', 'Data Pegawai Berhasil Diubah');
        }

        return view('ubahpegawai', ['dataPegawai' => $dataPegawai]);
    }

    public function hapus($idpegawai)
    {
        $model = new PegawaiM;
        $model->deletePegawai($idpegawai);
        return redirect()->to('/Pegawai')->with('success', 'Data Pegawai Berhasil Dihapus');
    }

    public function export()
    {
        // Load model
        $model = new PegawaiM();
        $data = $model->getTablePegawai();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Merge Untuk Judul
        $sheet->mergeCells('A1:C2');
        $sheet->setCellValue('A1', 'Daftar Pegawai');

        // Set style untuk judul
        $titleStyle = [
            'font' => ['bold' => true, 'size' => 14],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER, // Middle align
                'wrapText' => true,
            ],
        ];
        $sheet->getStyle('A1:C2')->applyFromArray($titleStyle);

        // Bagian Header
        $headerStyle = [
            'font' => ['bold' => true],
            'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]],
            'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'color' => ['argb' => 'DDDDDD']],
        ];
        $sheet->getStyle('A3:C3')->applyFromArray($headerStyle);

        $sheet->setCellValue('A3', 'ID Pegawai');
        $sheet->setCellValue('B3', 'Nama Pegawai');
        $sheet->setCellValue('C3', 'Email');

        $sheet->getColumnDimension('A')->setWidth(11);
        $sheet->getColumnDimension('B')->setWidth(26);
        $sheet->getColumnDimension('C')->setWidth(30);

        $row = 4; //Urutan Kolom
        $id = 1; //Id untuk perulangan

        foreach ($data as $item) {
            $sheet->setCellValue('A' . $row, $id);
            $sheet->setCellValue('B' . $row, $item['nama_pegawai']);
            $sheet->setCellValue('C' . $row, $item['email']);

            $bodyStyle = [
                'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]],
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT, 'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP]
            ];
            $sheet->getStyle('A' . $row . ':C' . $row)->applyFromArray($bodyStyle);

            $id++;
            $row++;
        }

        $filename = 'Daftar Pegawai.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

    public function exportpdf()
    {
        // Load model
        $model = new PegawaiM();
        $data = $model->getTablePegawai();

        $html = view('pdf/daftarpegawai_pdf', ['data' => $data]);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('Daftar Penerimaan Barang.pdf', ['Attachment' => 0]);
    }
}
?>
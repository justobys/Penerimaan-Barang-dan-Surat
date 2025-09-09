<?php

namespace App\Controllers;

use App\Models\DataSuratM;
use App\Models\PegawaiM;
use App\Helpers\WAGatewayHelper;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Dompdf\Dompdf;

class DaftarSurat extends BaseController
{
    public function index()
    {
        $model = new DataSuratM();
        $search = $this->request->getGet('search');
        $startdate = $this->request->getGet('StartDate');
        $enddate = $this->request->getGet('EndDate');
        $status = $this->request->getGet('status');
        $data = $model->getData($search, $startdate, $enddate, $status);
        return view('penerimaan_surat', compact('data'));
    }

    public function kirimWA($id)
    {
        $model = new DataSuratM();
        $data = $model->find($id);

        if (!$data) {
            return redirect()->to('/DaftarSurat')->with('error', 'Data surat tidak ditemukan');
        }

        $pegawaiModel = new PegawaiM();
        $pegawai = $pegawaiModel->getPegawaiById($data['id_pegawai']);

        if (!$pegawai) {
            return redirect()->to('/DaftarSurat')->with('error', 'Data pegawai tidak ditemukan');
        }

        $waHelper = new WAGatewayHelper();
        $nomorTujuan = $pegawai['nomor'];
        $pesan = "Hai *{$pegawai['nama_pegawai']}*\nAda surat {$data['nama_surat']} dengan nomor {$data['no_surat']} telah diterima.\nSilahkan datang segera ke lokasi pengambilan.";

        $fotoPath = FCPATH . $data['foto_surat'];

        if (file_exists($fotoPath) && is_readable($fotoPath)) {
            $result = $waHelper->kirimPesanDenganFoto($nomorTujuan, $pesan, $fotoPath);
        } else {
            $result = $waHelper->kirimPesan($nomorTujuan, $pesan);
            log_message('error', "File tidak ditemukan atau tidak dapat dibaca: $fotoPath");
        }

        if (isset($result['error'])) {
            return redirect()->to('/DaftarSurat')->with('error', 'Gagal mengirim pesan WA: ' . $result['error']);
        } else {
            $model->update($id, ['status' => 'Diterima']);
            return redirect()->to('/DaftarSurat')->with('message', 'Pesan WA berhasil dikirim dan status surat diperbarui');
        }
    }

    public function tambahSurat()
    {
        $model = new DataSuratM();
        $dataPegawai = $model->getTablePegawai();

        if ($this->request->getMethod() === 'post') {
            $data = [
                'no_surat' => $this->request->getPost('no_surat'),
                'nama_surat' => $this->request->getPost('nama_surat'),
                'deskripsi' => $this->request->getPost('deskripsi'),
                'id_pegawai' => $this->request->getPost('id_pegawai'),
                'status' => $this->request->getPost('status'),
            ];

            $foto_surat = $this->request->getFile('foto_surat');
            if ($foto_surat->isValid() && !$foto_surat->hasMoved()) {
                $newName = $foto_surat->getRandomName();
                $foto_surat->move(ROOTPATH . 'public/uploads', $newName);
                $data['foto_surat'] = 'uploads/' . $newName;
            }

            $model->insertSurat($data);
            return redirect()->to('/DaftarSurat')->with('success', 'Data Surat Berhasil Dimasukkan');
        }

        return view('inputsurat', compact('dataPegawai'));
    }

    public function ubahSurat($id)
    {
        $model = new DataSuratM();
        $dataPegawai = $model->getTablePegawai();
        $surat = $model->getSuratById($id);

        if ($this->request->getMethod() === 'post') {
            $data = [
                'status' => $this->request->getPost('status'),
            ];
            $model->updateSurat($id, $data);
            return redirect()->to('/DaftarSurat')->with('success', 'Status Surat Berhasil Diubah');
        }
        return view('ubahsurat', ['dataPegawai' => $dataPegawai, 'surat' => $surat]);
    }

    public function hapusSurat($id)
    {
        $model = new DataSuratM();
        $model->deleteSurat($id);
        return redirect()->to('/DaftarSurat')->with('success', 'Data Surat Berhasil Dihapus');
    }

    public function export()
    {
        $model = new DataSuratM();
        $data = $model->getTableSuratAll();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->mergeCells('A1:H2');
        $sheet->setCellValue('A1', 'Daftar Penerimaan Surat');

        $titleStyle = [
            'font' => ['bold' => true, 'size' => 14],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
        ];
        $sheet->getStyle('A1:H2')->applyFromArray($titleStyle);

        $headerStyle = [
            'font' => ['bold' => true],
            'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]],
            'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'color' => ['argb' => 'DDDDDD']],
        ];
        $sheet->getStyle('A3:H3')->applyFromArray($headerStyle);

        $sheet->setCellValue('A3', 'ID');
        $sheet->setCellValue('B3', 'Tanggal');
        $sheet->setCellValue('C3', 'No. Surat');
        $sheet->setCellValue('D3', 'Nama Surat');
        $sheet->setCellValue('E3', 'Deskripsi');
        $sheet->setCellValue('F3', 'Foto Surat');
        $sheet->setCellValue('G3', 'Penerima');
        $sheet->setCellValue('H3', 'Status');

        // Set column widths
        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(15);
        $sheet->getColumnDimension('C')->setWidth(20);
        $sheet->getColumnDimension('D')->setWidth(15);
        $sheet->getColumnDimension('E')->setWidth(30);
        $sheet->getColumnDimension('F')->setWidth(20);
        $sheet->getColumnDimension('G')->setWidth(27);
        $sheet->getColumnDimension('H')->setWidth(15);

        $row = 4;
        $id = 1;

        foreach ($data as $item) {
            $sheet->setCellValue('A' . $row, $id);
            $sheet->setCellValue('B' . $row, date('d/m/Y', strtotime($item['tanggal'])));
            $sheet->setCellValue('C' . $row, $item['no_surat']);
            $sheet->setCellValue('D' . $row, $item['nama_surat']);
            $sheet->setCellValue('E' . $row, $item['deskripsi']);
            $sheet->getStyle('E3:E' . $row)->getAlignment()->setWrapText(true);

            $imagePath = $item['foto_surat'];
            if (!empty($imagePath) && file_exists($imagePath)) {
                $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                $drawing->setName('Foto Surat');
                $drawing->setDescription('Foto Surat');
                $drawing->setPath($imagePath);
                $drawing->setCoordinates('F' . $row);
                $drawing->setResizeProportional(true);
                $drawing->setHeight(100);
                $drawing->setWorksheet($sheet);
                $sheet->getRowDimension($row)->setRowHeight(100);
            } else {
                $sheet->setCellValue('F' . $row, 'Image Not Found');
            }

            $sheet->setCellValue('G' . $row, $item['nama_pegawai']);
            $sheet->setCellValue('H' . $row, $item['status'] == 'Diterima' ? 'Diterima' : 'Belum Diterima');
            if ($item['status'] == 'Diterima') {
                $sheet->getStyle('H' . $row)->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_GREEN);
            } else {
                $sheet->getStyle('H' . $row)->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);
            }

            $bodyStyle = [
                'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]],
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT, 'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP]
            ];
            $sheet->getStyle('A' . $row . ':H' . $row)->applyFromArray($bodyStyle);

            $id++;
            $row++;
        }

        $filename = 'Daftar Penerimaan Surat.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

    public function exportpdf()
    {
        $model = new DataSuratM();
        $data = $model->getTableSuratAll();

        $html = view('pdf/daftarsurat_pdf', ['data' => $data]);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('Daftar Penerimaan Surat.pdf', ['Attachment' => 0]);
    }
}
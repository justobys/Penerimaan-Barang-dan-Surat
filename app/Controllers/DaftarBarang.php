<?php

namespace App\Controllers;

use App\Models\DataBarangM;
use App\Models\PegawaiM;
use App\Helpers\WAGatewayHelper;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Dompdf\Dompdf;

class DaftarBarang extends BaseController
{
    public function index()
    {
        $model = new DataBarangM();
        $search = $this->request->getGet('search');
        $startdate = $this->request->getGet('StartDate');
        $enddate = $this->request->getGet('EndDate');
        $status = $this->request->getGet('status');
        $data = $model->getData($search, $startdate, $enddate, $status);
        return view('penerimaan_barang', compact('data'));
    }

    public function kirimWA($id)
    {
        $model = new DataBarangM();
        $data = $model->find($id);

        if (!$data) {
            return redirect()->to('/DaftarBarang')->with('error', 'Data barang tidak ditemukan');
        }

        $pegawaiModel = new PegawaiM();
        $pegawai = $pegawaiModel->getPegawaiById($data['id_pegawai']);

        if (!$pegawai) {
            return redirect()->to('/DaftarBarang')->with('error', 'Data pegawai tidak ditemukan');
        }

        $waHelper = new WAGatewayHelper();
        $nomorTujuan = $pegawai['nomor'];
        $pesan = "Hai *{$pegawai['nama_pegawai']}*\nAda pesanan Barang {$data['nama_barang']} dengan nomor resi {$data['no_resi']} telah diterima.\nSilahkan datang segera ke lokasi pengambilan.";

        $fotoPath = FCPATH . $data['foto_barang'];

        if (file_exists($fotoPath) && is_readable($fotoPath)) {
            $result = $waHelper->kirimPesanDenganFoto($nomorTujuan, $pesan, $fotoPath);
        } else {
            $result = $waHelper->kirimPesan($nomorTujuan, $pesan);
            log_message('error', "File tidak ditemukan atau tidak dapat dibaca: $fotoPath");
        }

        if (isset($result['error'])) {
            return redirect()->to('/DaftarBarang')->with('error', 'Gagal mengirim pesan WA: ' . $result['error']);
        } else {
            $model->update($id, ['status' => 'Diterima']);
            return redirect()->to('/DaftarBarang')->with('message', 'Pesan WA berhasil dikirim dan status barang diperbarui');
        }
    }

    public function tambahBarang()
    {
        // Load the model
        $model = new DataBarangM();
        $dataPegawai = $model->getTablePegawai();

        // Mengecek apakah formnya terisi
        if ($this->request->getMethod() === 'post') {
            $data = [
                'no_resi' => $this->request->getPost('no_resi'),
                'nama_barang' => $this->request->getPost('nama_barang'),
                'deskripsi' => $this->request->getPost('deskripsi'),
                'id_pegawai' => $this->request->getPost('id_pegawai'),
                'status' => $this->request->getPost('status'),
            ];

            // File upload handling
            $foto_barang = $this->request->getFile('foto_barang');
            if ($foto_barang->isValid() && !$foto_barang->hasMoved()) {
                $newName = $foto_barang->getRandomName();
                $foto_barang->move(ROOTPATH . 'public/uploads', $newName);

                // Menyimpan file ke database
                $data['foto_barang'] = 'uploads/' . $newName;
            }

            // Memasukkan data ke dalam database
            $model->insertBarang($data);

            return redirect()->to('/DaftarBarang')->with('success', 'Data Barang Berhasil Dimasukkan');
        }

        return view('inputbarang', compact('dataPegawai'));
    }
    public function ubahBarang($id)
    {
        // Load the model
        $model = new DataBarangM();
        $dataPegawai = $model->getTablePegawai();

        // Mengambil data dari database
        $barang = $model->getBarangById($id);

        if ($this->request->getMethod() === 'post') {
            $data = [
                'status' => $this->request->getPost('status'),
            ];
            $model->updateBarang($id, $data);
            return redirect()->to('/DaftarBarang')->with('success', 'Status Barang Berhasil Diubah');
        }
        return view('ubahbarang', ['dataPegawai' => $dataPegawai, 'barang' => $barang]);
    }

    public function hapusBarang($id)
    {
        $model = new DataBarangM();
        $model->deleteBarang($id);
        return redirect()->to('/DaftarBarang')->with('success', 'Data Barang Berhasil Dihapus');
    }

    public function export()
    {
        // Load model
        $model = new DataBarangM();
        $data = $model->getTableBarangAll();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Merge Untuk Judul
        $sheet->mergeCells('A1:H2');
        $sheet->setCellValue('A1', 'Daftar Penerimaan Barang');

        // Set style untuk judul
        $titleStyle = [
            'font' => ['bold' => true, 'size' => 14],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER, // Middle align
                'wrapText' => true,
            ],
        ];
        $sheet->getStyle('A1:H2')->applyFromArray($titleStyle);

        // Bagian Header
        $headerStyle = [
            'font' => ['bold' => true],
            'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]],
            'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'color' => ['argb' => 'DDDDDD']],
        ];
        $sheet->getStyle('A3:H3')->applyFromArray($headerStyle);

        $sheet->setCellValue('A3', 'ID');
        $sheet->setCellValue('B3', 'Tanggal');
        $sheet->setCellValue('C3', 'No. Resi');
        $sheet->setCellValue('D3', 'Nama Barang');
        $sheet->setCellValue('E3', 'Deskripsi');
        $sheet->setCellValue('F3', 'Foto Barang');
        $sheet->setCellValue('G3', 'Penerima');
        $sheet->setCellValue('H3', 'Status');

        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(15);
        $sheet->getColumnDimension('C')->setWidth(20);
        $sheet->getColumnDimension('D')->setWidth(15);
        $sheet->getColumnDimension('E')->setWidth(30);
        $sheet->getColumnDimension('F')->setWidth(20);
        $sheet->getColumnDimension('G')->setWidth(27);
        $sheet->getColumnDimension('H')->setWidth(15);

        $row = 4; //Urutan Kolom
        $id = 1; //Id untuk perulangan

        foreach ($data as $item) {
            $sheet->setCellValue('A' . $row, $id);
            $sheet->setCellValue('B' . $row, date('d/m/Y', strtotime($item['tanggal'])));
            $sheet->setCellValue('C' . $row, $item['no_resi']);
            $sheet->setCellValue('D' . $row, $item['nama_barang']);
            $sheet->setCellValue('E' . $row, $item['deskripsi']);
            $sheet->getStyle('E3:E' . $row)->getAlignment()->setWrapText(true);
            // Setelah data lain dimasukkan, masukkan gambar ke dalam sel
            $imagePath = $item['foto_barang'];

            if (!empty($imagePath) && file_exists($imagePath)) {
                $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                $drawing->setName('Foto Barang');
                $drawing->setDescription('Foto Barang');
                $drawing->setPath($imagePath);
                $drawing->setCoordinates('F' . $row);
                $drawing->setResizeProportional(true); // Menjaga rasio aspek gambar
                $drawing->setHeight(100); // Mengatur tinggi gambar dalam piksel
                $drawing->setWorksheet($sheet);
                $sheet->getRowDimension($row)->setRowHeight(100); // Sesuaikan tinggi baris sesuai kebutuhan
            } else {
                $sheet->setCellValue('F' . $row, 'Image Not Found');
            }

            $sheet->setCellValue('G' . $row, $item['nama_pegawai']);
            $sheet->setCellValue('H' . $row, $item['status'] == 'Diterima' ? 'Diterima' : 'Belum Diterima');
            if ($item['status'] == 'Diterima') {
                $sheet->getStyle('H' . $row)->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_GREEN); // Mengatur warna font menjadi hijau
            } else {
                $sheet->getStyle('H' . $row)->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED); // Mengatur warna font menjadi merah
            }

            $bodyStyle = [
                'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]],
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT, 'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP]
            ];
            $sheet->getStyle('A' . $row . ':H' . $row)->applyFromArray($bodyStyle);

            $id++;
            $row++;
        }

        $filename = 'Daftar Penerimaan Barang.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

    public function exportpdf()
    {
        // Load model
        $model = new DataBarangM();
        $data = $model->getTableBarangAll();

        $html = view('pdf/daftarbarang_pdf', ['data' => $data]);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('Daftar Penerimaan Barang.pdf', ['Attachment' => 0]);
    }

    // public function sendEmailNotification($id, $type)
    // {
    //     // Ambil informasi barang dari database
    //     $modelBarang = new DataBarangM();
    //     $barang = $modelBarang->getBarangById($id);

    //     // Ambil informasi pegawai dari database
    //     $modelPegawai = new PegawaiM(); // Ganti dengan model pegawai yang sesuai
    //     $pegawai = $modelPegawai->getPegawaiById($barang['id_pegawai']);

    //     // Kirim email notifikasi
    //     $email = \Config\Services::email();
    //     $email->setTo($pegawai['email']);
    //     $email->setSubject('Notifikasi Barang Masuk');

    //     if ($type === 'barang') {
    //         $message = "Barang dengan nomor {$barang['no_resi']} telah diterima.";
    //     } else {
    //         // Jenis notifikasi tidak valid
    //         echo json_encode(['status' => 'error', 'message' => 'Jenis notifikasi tidak valid.']);
    //         return;
    //     }

    //     $email->setMessage($message);

    //     if ($email->send()) {
    //         // Email terkirim
    //         echo json_encode(['status' => 'success', 'message' => 'Email notifikasi berhasil dikirim.']);
    //     } else {
    //         // Gagal mengirim email
    //         echo json_encode(['status' => 'error', 'message' => 'Gagal mengirim email notifikasi.']);
    //     }
    // }

}
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();

        $this->load->model('Admin_model', 'admin');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->form_validation->set_rules('transaksi', 'Transaksi', 'required|in_list[barang_masuk,barang_keluar,keuntungan]');
        $this->form_validation->set_rules('tanggal', 'Periode Tanggal', 'required');

        if ($this->form_validation->run() == false) {
            $data['title'] = "Laporan Transaksi";
            $this->template->load('templates/dashboard', 'laporan/form', $data);
        } else {
            $input = $this->input->post(null, true);
            $table = $input['transaksi'];
            $tanggal = $input['tanggal'];
            $pecah = explode(' - ', $tanggal);
            $mulai = date('Y-m-d', strtotime($pecah[0]));
            $akhir = date('Y-m-d', strtotime(end($pecah)));

            $query = '';
            if ($table === 'barang_masuk') {
                $query = $this->admin->getBarangMasuk(null, null, ['mulai' => $mulai, 'akhir' => $akhir]);
            } else if ($table === 'barang_keluar') {
                $query = $this->admin->getBarangKeluar(null, null, ['mulai' => $mulai, 'akhir' => $akhir]);
            } else {
                $query = $this->admin->getKeuntungan(null, null, ['mulai' => $mulai, 'akhir' => $akhir]);
            }

            $this->_cetak($query, $table, $tanggal);
        }
    }

    private function _cetak($data, $table_, $tanggal)
    {
        $this->load->library('CustomPDF');
        $table = $table_ === 'barang_masuk' ? 'Barang Masuk' : ($table_ === 'barang_keluar' ? 'Barang Keluar' : 'Keuntungan');

        $pdf = new FPDF();
        $pdf->AddPage('L', 'Letter');
        $pdf->SetFont('Times', 'B', 16);
        $pdf->Cell(200, 7, 'Laporan ' . $table, 0, 1, 'C');
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(200, 4, 'Tanggal : ' . $tanggal, 0, 1, 'C');
        $pdf->Ln(10);

        $pdf->SetFont('Arial', 'B', 10);

        if ($table_ === 'barang_masuk')
        {
            $pdf->Cell(10, 7, 'No.', 1, 0, 'C');
            $pdf->Cell(30, 7, 'Tgl Masuk', 1, 0, 'C');
            $pdf->Cell(35, 7, 'ID Transaksi', 1, 0, 'C');
            $pdf->Cell(35, 7, 'Nama Supplier', 1, 0, 'C');
            $pdf->Cell(65, 7, 'Nama Barang', 1, 0, 'C');
            $pdf->Cell(25, 7, 'Harga Beli', 1, 0, 'C');
            $pdf->Cell(30, 7, 'Jumlah Masuk', 1, 0, 'C');
            $pdf->Cell(30, 7, 'Total Harga Beli', 1, 0, 'C');
            $pdf->Ln();

            $no = 1;
            $grandTotal = 0;
            foreach ($data as $d) {
                $total = $d['harga_beli'] * $d['jumlah_masuk'];
                $grandTotal += $total;

                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(10, 7, $no++ . '.', 1, 0, 'C');
                $pdf->Cell(30, 7, $d['tanggal_masuk'], 1, 0, 'C');
                $pdf->Cell(35, 7, $d['id_barang_masuk'], 1, 0, 'C');
                $pdf->Cell(35, 7, $d['nama_supplier'], 1, 0, 'C');
                $pdf->Cell(65, 7, $d['nama_barang'], 1, 0, 'L');
                $pdf->Cell(25, 7, number_format($d['harga_beli'], 0, ",", "."), 1, 0, 'C');
                $pdf->Cell(30, 7, $d['jumlah_masuk'] . ' ' . $d['nama_satuan'], 1, 0, 'C');
                $pdf->Cell(30, 7, number_format($total, 0, ",", "."), 1, 0, 'C');
                $pdf->Ln();
            }

            $pdf->Cell(230, 7, 'Total', 1, 0, 'C');
            $pdf->Cell(30, 7, number_format($grandTotal, 0, ",", "."), 1, 0, 'C');
            $pdf->Ln();
        }
        else if ($table_ === 'barang_keluar')
        {
            $pdf->Cell(10, 7, 'No.', 1, 0, 'C');
            $pdf->Cell(35, 7, 'Tgl Keluar', 1, 0, 'C');
            $pdf->Cell(35, 7, 'ID Transaksi', 1, 0, 'C');
            $pdf->Cell(80, 7, 'Nama Barang', 1, 0, 'C');
            $pdf->Cell(35, 7, 'Harga Jual', 1, 0, 'C');
            $pdf->Cell(30, 7, 'Jumlah Keluar', 1, 0, 'C');
            $pdf->Cell(30, 7, 'Total Harga Jual', 1, 0, 'C');
            $pdf->Ln();

            $no = 1;
            $grandTotal = 0;
            foreach ($data as $d) {
                $total = $d['harga_jual'] * $d['jumlah_keluar'];
                $grandTotal += $total;

                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(10, 7, $no++ . '.', 1, 0, 'C');
                $pdf->Cell(35, 7, $d['tanggal_keluar'], 1, 0, 'C');
                $pdf->Cell(35, 7, $d['id_barang_keluar'], 1, 0, 'C');
                $pdf->Cell(80, 7, $d['nama_barang'], 1, 0, 'L');
                $pdf->Cell(35, 7, number_format($d['harga_jual'], 0, ",", "."), 1, 0, 'C');
                $pdf->Cell(30, 7, $d['jumlah_keluar'] . ' ' . $d['nama_satuan'], 1, 0, 'C');
                $pdf->Cell(30, 7, number_format($total, 0, ",", "."), 1, 0, 'C');
                $pdf->Ln();
            }

            $pdf->Cell(225, 7, 'Total', 1, 0, 'C');
            $pdf->Cell(30, 7, number_format($grandTotal, 0, ",", "."), 1, 0, 'C');
            $pdf->Ln();
        }
        else
        {
            $pdf->Cell(10, 7, 'No.', 1, 0, 'C');
            $pdf->Cell(35, 7, 'ID Transaksi', 1, 0, 'C');
            $pdf->Cell(30, 7, 'Tgl Keluar', 1, 0, 'C');
            $pdf->Cell(50, 7, 'Barang', 1, 0, 'C');
            $pdf->Cell(20, 7, 'Satuan', 1, 0, 'C');
            $pdf->Cell(15, 7, 'Jumlah', 1, 0, 'C');
            $pdf->Cell(30, 7, 'Harga Beli', 1, 0, 'C');
            $pdf->Cell(30, 7, 'Harga Jual', 1, 0, 'C');
            $pdf->Cell(30, 7, 'Profit', 1, 0, 'C');
            $pdf->Ln();

            $grandTotal = 0;
            foreach ($data as $key => $d)
            {
                $profit = $d['harga_jual'] - $d['harga_beli'];
                $grandTotal += $profit;

                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(10, 7, $key + 1 . '.', 1, 0, 'C');
                $pdf->Cell(35, 7, $d['id_barang_keluar'], 1, 0, 'C');
                $pdf->Cell(30, 7, $d['tanggal_keluar'], 1, 0, 'C');
                $pdf->Cell(50, 7, $d['nama_barang'], 1, 0, 'L');
                $pdf->Cell(20, 7, $d['nama_satuan'], 1, 0, 'L');
                $pdf->Cell(15, 7, $d['jumlah_keluar'], 1, 0, 'L');
                $pdf->Cell(30, 7, number_format($d['harga_beli'], 0, ",", "."), 1, 0, 'C');
                $pdf->Cell(30, 7, number_format($d['harga_jual'], 0, ",", "."), 1, 0, 'C');
                $pdf->Cell(30, 7, number_format($profit, 0, ",", "."), 1, 0, 'C');
                $pdf->Ln();
            }

            $pdf->Cell(220, 7, 'Total', 1, 0, 'C');
            $pdf->Cell(30, 7, number_format($grandTotal, 0, ",", "."), 1, 0, 'C');
            $pdf->Ln();
        }

        $file_name = $table . ' ' . $tanggal;
        $pdf->Output('I', $file_name);
    }
}

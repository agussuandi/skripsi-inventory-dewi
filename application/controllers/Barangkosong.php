<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barangkosong extends CI_Controller
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
        $data['title'] = "Barang Kosong";
        $data['barangKosong'] = $this->admin->getBarangKosong();
        $this->template->load('templates/dashboard', 'barang_kosong/data', $data);
    }

    private function _validasi()
    {
        // $this->form_validation->set_rules('tanggal_keluar', 'Tanggal Keluar', 'required|trim');
        // $this->form_validation->set_rules('barang_id', 'Barang', 'required');

        // $input = $this->input->post('barang_id', true);
        // $stok = $this->admin->get('barang', ['id_barang' => $input])['stok'];
        // $stok_valid = $stok + 1;

        // $this->form_validation->set_rules(
        //     'jumlah_keluar',
        //     'Jumlah Keluar',
        //     "required|trim|numeric|greater_than[0]|less_than[{$stok_valid}]",
        //     [
        //         'less_than' => "Jumlah Keluar tidak boleh lebih dari {$stok}"
        //     ]
        // );
    }

    public function add()
    {
        $this->_validasi();
        // if ($this->form_validation->run() == false) {
            $data['title'] = "Barang Keluar";
        //     // $data['barang'] = $this->admin->get('barang', null, ['stok >' => 0]);

        //     // // Mendapatkan dan men-generate kode transaksi barang keluar
        //     // $kode = 'T-BK-' . date('ymd');
        //     // $kode_terakhir = $this->admin->getMax('barang_keluar', 'id_barang_keluar', $kode);
        //     // $kode_tambah = substr($kode_terakhir, -5, 5);
        //     // $kode_tambah++;
        //     // $number = str_pad($kode_tambah, 5, '0', STR_PAD_LEFT);
        //     // $data['id_barang_keluar'] = $kode . $number;

            $this->template->load('templates/dashboard', 'barang_kosong/add', $data);
        // } else {
        //     $input = $this->input->post(null, true);
        //     $insert = $this->admin->insert('barang_keluar', $input);

        //     if ($insert) {
        //         set_pesan('data berhasil disimpan.');
        //         redirect('barangkeluar');
        //     } else {
        //         set_pesan('Opps ada kesalahan!');
        //         redirect('barangkeluar/add');
        //     }
        // }
    }
}
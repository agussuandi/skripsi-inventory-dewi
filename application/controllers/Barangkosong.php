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
        $this->form_validation->set_rules('tanggal_kosong', 'Tanggal Kosong', 'required|trim');
        $this->form_validation->set_rules('id_barang', 'Barang', 'required');
    }

    public function add()
    {
        $this->_validasi();
        if ($this->form_validation->run() == false) {
            $data['title'] = "Barang Keluar";
            $data['barang'] = $this->admin->get('barang', null, ['stok >' => 0]);

            $this->template->load('templates/dashboard', 'barang_kosong/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $payload = [
                'id_barang' => $input['id_barang'],
                'tanggal'   => $input['tanggal_kosong'],
                'aksi'      => $input['aksi'],
            ];
            $insert = $this->admin->insert('barang_kosong', $payload);

            if ($insert) {
                set_pesan('data berhasil disimpan.');
                redirect('barangkosong');
            } else {
                set_pesan('Opps ada kesalahan!');
                redirect('barangkosong/add');
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('barang_kosong', 'id', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('barang_kosong');
    }
}
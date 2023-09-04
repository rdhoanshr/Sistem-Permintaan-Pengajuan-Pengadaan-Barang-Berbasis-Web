<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Unit extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(['ion_auth', 'form_validation']);

        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        } else if ($this->ion_auth->is_admin() || $this->ion_auth->in_group('kabag')) {
        } else {
            show_error('You must be an administrator to view this page.');
        }

        $this->load->model('UnitModel');
    }


    public function index()
    {
        $data['title'] = 'Data Unit';
        $data['unit'] = $this->UnitModel->lihat();

        $this->load->view('unit/data_unit', $data);
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Unit';

        $this->form_validation->set_rules('nama_unit', 'Nama Unit', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('unit/tambah_unit', $data);
        } else {
            $this->UnitModel->proses_tambah();
            $err = $this->db->error();
            if ($err['code'] !== 0) {
                echo $err['message'];
            } else {
                $this->session->set_flashdata('pesanbaik', 'Unit Berhasil Di tambah');
                redirect('unit');
            }
        }
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Barang';
        $data['barang'] = $this->BarangModel->getBarang($id);

        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required');
        $this->form_validation->set_rules('jenis_barang', 'Jenis Barang', 'required');
        $this->form_validation->set_rules('satuan', 'Satuan', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('barang/edit_barang', $data);
        } else {
            $this->BarangModel->proses_edit($id);
            $err = $this->db->error();
            if ($err['code'] !== 0) {
                echo $err['message'];
            } else {
                $this->session->set_flashdata('pesanbaik', 'Barang Berhasil Di update');
                redirect('barang');
            }
        }
    }

    public function hapus($id)
    {
        $this->BarangModel->hapus($id);
        $err = $this->db->error();
        if ($err['code'] !== 0) {
            echo $err['message'];
        } else {
            $this->session->set_flashdata('pesanbaik', 'Barang Berhasil Di Hapus');
            redirect('barang');
        }
    }
}

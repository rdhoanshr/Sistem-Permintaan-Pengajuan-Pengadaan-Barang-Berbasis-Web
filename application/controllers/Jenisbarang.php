<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jenisbarang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(['ion_auth', 'form_validation']);

        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        } else if ($this->ion_auth->in_group(2) || $this->ion_auth->in_group(3)) {
        } else {
            show_error('You must be an administrator to view this page.');
        }

        $this->load->model('JenisBarangModel');
    }


    public function index()
    {
        $data['title'] = 'Data Jenis Barang';
        $data['jenis_barang'] = $this->JenisBarangModel->lihat();

        $this->load->view('jenisbarang/data_jenisbarang', $data);
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Jenis Barang';

        $this->form_validation->set_rules('nama_jenisbarang', 'Nama Jenis Barang', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('jenisbarang/tambah_jenisbarang', $data);
        } else {
            $this->JenisBarangModel->proses_tambah();
            $err = $this->db->error();
            if ($err['code'] !== 0) {
                echo $err['message'];
            } else {
                $this->session->set_flashdata('pesanbaik', 'Jenis Barang Berhasil Di tambah');
                redirect('jenisbarang');
            }
        }
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Jenis Barang';
        $data['jenis_barang'] = $this->JenisBarangModel->getJenisBarang($id);

        $this->form_validation->set_rules('nama_jenisbarang', 'Nama Jenis Barang', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('jenisbarang/edit_jenisbarang', $data);
        } else {
            $this->JenisBarangModel->proses_edit($id);
            $err = $this->db->error();
            if ($err['code'] !== 0) {
                echo $err['message'];
            } else {
                $this->session->set_flashdata('pesanbaik', 'Jenis Barang Berhasil Di update');
                redirect('jenisbarang');
            }
        }
    }

    public function hapus($id)
    {
        $this->JenisBarangModel->hapus($id);
        $err = $this->db->error();
        if ($err['code'] !== 0) {
            echo $err['message'];
        } else {
            $this->session->set_flashdata('pesanbaik', 'Jenis Barang Berhasil Di Hapus');
            redirect('jenisbarang');
        }
    }
}

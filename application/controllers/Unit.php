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
        } else if ($this->ion_auth->in_group(2) || $this->ion_auth->in_group(3)) {
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
        $this->form_validation->set_rules('kode_unit', 'Kode Unit', 'required');

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
        $data['title'] = 'Edit Unit';
        $data['unit'] = $this->UnitModel->getUnit($id);

        $this->form_validation->set_rules('nama_unit', 'Nama Unit', 'required');
        $this->form_validation->set_rules('kode_unit', 'Kode Unit', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('unit/edit_unit', $data);
        } else {
            $this->UnitModel->proses_edit($id);
            $err = $this->db->error();
            if ($err['code'] !== 0) {
                echo $err['message'];
            } else {
                $this->session->set_flashdata('pesanbaik', 'Unit Berhasil Di update');
                redirect('unit');
            }
        }
    }

    public function hapus($id)
    {
        $this->UnitModel->hapus($id);
        $err = $this->db->error();
        if ($err['code'] !== 0) {
            echo $err['message'];
        } else {
            $this->session->set_flashdata('pesanbaik', 'Unit Berhasil Di Hapus');
            redirect('unit');
        }
    }
}

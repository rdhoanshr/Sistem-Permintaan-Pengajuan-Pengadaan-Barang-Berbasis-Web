<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vendor extends CI_Controller
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

        $this->load->model('VendorModel');
    }


    public function index()
    {
        $data['title'] = 'Data Vendor';
        $data['vendor'] = $this->VendorModel->lihat();

        $this->load->view('vendor/data_vendor', $data);
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Vendor';

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('no_telp', 'No Telp', 'required|min_length[10]|max_length[14]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('situs_web', 'Situs Web', 'required');
        $this->form_validation->set_rules('catatan', 'Catatan', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('vendor/tambah_vendor', $data);
        } else {
            $this->VendorModel->proses_tambah();
            $err = $this->db->error();
            if ($err['code'] !== 0) {
                echo $err['message'];
            } else {
                $this->session->set_flashdata('pesanbaik', 'Vendor Berhasil Di tambah');
                redirect('vendor');
            }
        }
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Unit';
        $data['unit'] = $this->UnitModel->getUnit($id);

        $this->form_validation->set_rules('nama_unit', 'Nama Unit', 'required');

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

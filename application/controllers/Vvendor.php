<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vvendor extends CI_Controller
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

        $this->form_validation->set_rules('kode', 'Kode', 'required');
        $this->form_validation->set_rules('nama', 'Nama', 'required|max_length[15]');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|max_length[15]');
        $this->form_validation->set_rules('no_telp', 'No Telp', 'required|min_length[10]|max_length[14]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('situs_web', 'Situs Web', 'required');
        $this->form_validation->set_rules('catatan', 'Catatan', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('vendor/tambah_vendor', $data);
        } else {
            $nama = $this->input->post('nama');
            $kode = $this->input->post('kode');
            $get_Nama = $this->VendorModel->getVendorNama($nama);
            $get_Kode = $this->VendorModel->getVendorKode($kode);

            if ($get_Nama['nama'] == $nama) {
                $this->session->set_flashdata('message', 'Nama Vendor sudah ada');
                redirect('vvendor/tambah');
            } elseif ($get_Kode['kode'] == $kode) {
                $this->session->set_flashdata('message', 'Kode Vendor sudah ada');
                redirect('vvendor/tambah');
            } else {
                $this->VendorModel->proses_tambah();
                $err = $this->db->error();
                if ($err['code'] !== 0) {
                    echo $err['message'];
                } else {
                    $this->session->set_flashdata('pesanbaik', 'Vendor Berhasil Di tambah');
                    redirect('vvendor');
                }
            }
        }
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Vendor';
        $data['vendor'] = $this->VendorModel->getVendor($id);

        $this->form_validation->set_rules('kode', 'Kode', 'required');
        $this->form_validation->set_rules('nama', 'Nama', 'required|max_length[15]');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|max_length[15]');
        $this->form_validation->set_rules('no_telp', 'No Telp', 'required|min_length[10]|max_length[14]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('situs_web', 'Situs Web', 'required');
        $this->form_validation->set_rules('catatan', 'Catatan', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('vendor/edit_vendor', $data);
        } else {
            $nama = $this->input->post('nama');
            $kode = $this->input->post('kode');

            $get_Nama = $this->VendorModel->getVendorNama($nama);
            $get_Kode = $this->VendorModel->getVendorKode($kode);

            if ($nama == $data['vendor']['nama'] && $kode == $data['vendor']['kode']) {
                $this->VendorModel->proses_edit($id);
                $err = $this->db->error();
                if ($err['code'] !== 0) {
                    echo $err['message'];
                } else {
                    $this->session->set_flashdata('pesanbaik', 'Vendor Berhasil Di update');
                    redirect('vvendor');
                }
            } else if ($nama != $data['vendor']['nama'] && $kode == $data['vendor']['kode']) {
                if ($get_Nama['nama'] == $nama) {
                    $this->session->set_flashdata('message', 'Nama Vendor sudah ada');
                    redirect('vvendor/edit/' . $id);
                } else {
                    $this->VendorModel->proses_edit($id);
                    $err = $this->db->error();
                    if ($err['code'] !== 0) {
                        echo $err['message'];
                    } else {
                        $this->session->set_flashdata('pesanbaik', 'Vendor Berhasil Di update');
                        redirect('vvendor');
                    }
                }
            } else if ($nama == $data['vendor']['nama'] && $kode != $data['vendor']['kode']) {
                if ($get_Kode['kode'] == $kode) {
                    $this->session->set_flashdata('message', 'Kode Vendor sudah ada');
                    redirect('vvendor/edit/' . $id);
                } else {
                    $this->VendorModel->proses_edit($id);
                    $err = $this->db->error();
                    if ($err['code'] !== 0) {
                        echo $err['message'];
                    } else {
                        $this->session->set_flashdata('pesanbaik', 'Vendor Berhasil Di update');
                        redirect('vvendor');
                    }
                }
            } else {
                if ($get_Kode['kode'] == $kode) {
                    $this->session->set_flashdata('message', 'Kode Vendor sudah ada');
                    redirect('vvendor/edit/' . $id);
                } else  if ($get_Nama['nama'] == $nama) {
                    $this->session->set_flashdata('message', 'Nama Vendor sudah ada');
                    redirect('vvendor/edit/' . $id);
                } else {
                    $this->VendorModel->proses_edit($id);
                    $err = $this->db->error();
                    if ($err['code'] !== 0) {
                        echo $err['message'];
                    } else {
                        $this->session->set_flashdata('pesanbaik', 'Vendor Berhasil Di update');
                        redirect('vvendor');
                    }
                }
            }
        }
    }

    public function hapus($id)
    {
        $this->VendorModel->hapus($id);
        $err = $this->db->error();
        if ($err['code'] !== 0) {
            echo $err['message'];
        } else {
            $this->session->set_flashdata('pesanbaik', 'Vendor Berhasil Di Hapus');
            redirect('vvendor');
        }
    }
}

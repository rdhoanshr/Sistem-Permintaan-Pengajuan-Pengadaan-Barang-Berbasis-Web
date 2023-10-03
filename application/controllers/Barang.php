<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
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

        $this->load->model('BarangModel');
    }


    public function index()
    {
        $data['title'] = 'Data Barang';
        $data['barang'] = $this->BarangModel->lihat();

        $this->load->view('barang/data_barang', $data);
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Barang';

        $this->form_validation->set_rules('kode_barang', 'Kode Barang', 'required');
        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required');
        $this->form_validation->set_rules('jenis_barang', 'Jenis Barang', 'required');
        $this->form_validation->set_rules('satuan', 'Satuan', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('barang/tambah_barang', $data);
        } else {
            $kode = $this->input->post('kode_barang');
            $get_Kode = $this->BarangModel->getBarangKode($kode);

            if ($get_Kode['kode_barang'] == $kode) {
                $this->session->set_flashdata('message', 'Kode Barang sudah ada');
                redirect('barang/tambah');
            } else {
                $this->BarangModel->proses_tambah();
                $err = $this->db->error();
                if ($err['code'] !== 0) {
                    echo $err['message'];
                } else {
                    $this->session->set_flashdata('pesanbaik', 'Barang Berhasil Di tambah');
                    redirect('barang');
                }
            }
        }
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Barang';
        $data['barang'] = $this->BarangModel->getBarang($id);

        $this->form_validation->set_rules('kode_barang', 'Kode Barang', 'required');
        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required');
        $this->form_validation->set_rules('jenis_barang', 'Jenis Barang', 'required');
        $this->form_validation->set_rules('satuan', 'Satuan', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('barang/edit_barang', $data);
        } else {
            $kode = $this->input->post('kode_barang');
            $get_Kode = $this->BarangModel->getBarangKode($kode);

            if ($kode == $data['barang']['kode_barang']) {
                $this->BarangModel->proses_edit($id);
                $err = $this->db->error();
                if ($err['code'] !== 0) {
                    echo $err['message'];
                } else {
                    $this->session->set_flashdata('pesanbaik', 'Barang Berhasil Di update');
                    redirect('barang');
                }
            } else {
                if ($get_Kode['kode_barang'] == $kode) {
                    $this->session->set_flashdata('message', 'Kode Barang sudah ada');
                    redirect('barang/edit/' . $id);
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

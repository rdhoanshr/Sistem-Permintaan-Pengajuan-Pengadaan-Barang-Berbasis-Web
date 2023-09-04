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
        } else if ($this->ion_auth->is_admin() || $this->ion_auth->in_group('kabag')) {
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

        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required');
        $this->form_validation->set_rules('jenis_barang', 'Jenis Barang', 'required');
        $this->form_validation->set_rules('satuan', 'Satuan', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('barang/tambah_barang', $data);
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
    // public function hapus($id)
    // {
    //     $this->PendudukModel->hapus($id);
    //     $this->session->set_flashdata('message', 'Penduduk Berhasil Di Hapus');
    //     redirect('admin/penduduk');
    // }

    // public function dataLapor()
    // {
    //     $data['title'] = 'SIPB Kertak Hanyar | Data Permohonan Ubah Data Penduduk';
    //     $data['sesi_user'] = $this->ion_auth->user()->row();
    //     $data['lapor'] = $this->PendudukModel->data_lapor();
    //     $data['akses'] = 'admin';

    //     $this->load->view('admin/penduduk/dataLapor', $data);
    // }

    // public function dataVerif()
    // {
    //     $data['title'] = 'SIPB Kertak Hanyar | Data Permohonan Ubah Data Penduduk';
    //     $data['sesi_user'] = $this->ion_auth->user()->row();
    //     $data['lapor'] = $this->PendudukModel->data_verif();
    //     $data['akses'] = 'admin';

    //     $this->load->view('admin/penduduk/dataVerif', $data);
    // }

    // public function ubahLapor($nik)
    // {
    //     $data['title'] = 'SIPB Kertak Hanyar | Edit Penduduk';
    //     $data['sesi_user'] = $this->ion_auth->user()->row();
    //     $data['penduduk'] = $this->PendudukModel->getlapor($nik);
    //     $data['agama'] = $this->PendudukModel->agama();
    //     $data['pendidikan'] = $this->PendudukModel->pendidikan();
    //     $data['status_kawin'] = $this->PendudukModel->status_kawin();

    //     $data['akses'] = 'admin';

    //     $this->form_validation->set_rules('nik', 'NIK', 'required');
    //     $this->form_validation->set_rules('no_kk', 'No. Kartu Keluarga', 'required');
    //     $this->form_validation->set_rules('nama_penduduk', 'Nama Penduduk', 'required');
    //     $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required');
    //     $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required');
    //     $this->form_validation->set_rules('alamat', 'Alamat', 'required');
    //     $this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'required');
    //     $this->form_validation->set_rules('no_rt', 'No. RT', 'required');
    //     $this->form_validation->set_rules('no_rw', 'No. RW', 'required');
    //     $this->form_validation->set_rules('nm_ayah', 'Nama Ayah', 'required');
    //     $this->form_validation->set_rules('nm_ibu', 'Nama Ibu', 'required');
    //     $this->form_validation->set_rules('hubungan_keluarga', 'Status Hubungan Dalam Keluarga', 'required');

    //     if ($this->form_validation->run() == false) {
    //         $this->load->view('admin/penduduk/ubahLapor', $data);
    //     } else {
    //         $this->PendudukModel->proses_ubahLapor($nik);
    //         $err = $this->db->error();
    //         if ($err['code'] !== 0) {
    //             echo $err['message'];
    //         } else {
    //             $this->session->set_flashdata('message', 'Permohonan Selesai');
    //             redirect('admin/penduduk/dataLapor');
    //         }
    //     }
    // }

    // public function Verify($id)
    // {
    //     $data['title'] = 'SIPB Kertak Hanyar | Verifikasi Penduduk';
    //     $data['sesi_user'] = $this->ion_auth->user()->row();
    //     $data['penduduk'] = $this->PendudukModel->get_statusverif($id);
    //     $data['agama'] = $this->PendudukModel->agama();
    //     $data['pendidikan'] = $this->PendudukModel->pendidikan();
    //     $data['status_kawin'] = $this->PendudukModel->status_kawin();

    //     $data['akses'] = 'admin';

    //     $this->form_validation->set_rules('nik', 'NIK', 'required');
    //     $this->form_validation->set_rules('no_kk', 'No. Kartu Keluarga', 'required');
    //     $this->form_validation->set_rules('nama_penduduk', 'Nama Penduduk', 'required');
    //     $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required');
    //     $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required');
    //     $this->form_validation->set_rules('alamat', 'Alamat', 'required');
    //     $this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'required');
    //     $this->form_validation->set_rules('no_rt', 'No. RT', 'required');
    //     $this->form_validation->set_rules('no_rw', 'No. RW', 'required');
    //     $this->form_validation->set_rules('nm_ayah', 'Nama Ayah', 'required');
    //     $this->form_validation->set_rules('nm_ibu', 'Nama Ibu', 'required');
    //     $this->form_validation->set_rules('hubungan_keluarga', 'Status Hubungan Dalam Keluarga', 'required');

    //     if ($this->form_validation->run() == false) {
    //         $this->load->view('admin/penduduk/verif', $data);
    //     } else {
    //         $this->PendudukModel->verifikasi($id);
    //         $err = $this->db->error();
    //         if ($err['code'] !== 0) {
    //             echo $err['message'];
    //         } else {
    //             $this->session->set_flashdata('message', 'Permohonan Selesai');
    //             redirect('admin/penduduk/dataVerif');
    //         }
    //     }
    // }

    // public function tolakVerifikasi($id)
    // {
    //     $this->PendudukModel->tolakVerifikasi($id);
    //     $err = $this->db->error();
    //     if ($err['code'] !== 0) {
    //         echo $err['message'];
    //     } else {
    //         $this->session->set_flashdata('message', 'Permohonan SPP Berhasil Di Tolak');
    //         redirect('admin/penduduk/dataverif');
    //     }
    // }
}

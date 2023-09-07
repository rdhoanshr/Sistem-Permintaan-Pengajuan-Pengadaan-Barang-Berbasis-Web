<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengajuan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(['ion_auth', 'form_validation']);

        // die(var_dump($this->ion_auth->logged_in()));
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        } else if ($this->ion_auth->in_group('vendor')) {
            show_error('You must be an administrator to view this page.');
        } else {
            // show_error('You must be an administrator to view this page.');
        }

        $this->load->model('PengajuanModel');
        $this->load->model('BarangModel');
    }


    public function index()
    {
        $data['title'] = 'Data Pengajuan';
        if ($this->ion_auth->in_group('unit')) {
            $data['pengajuan'] = $this->PengajuanModel->lihat_unit();
        } else {
            $data['pengajuan'] = $this->PengajuanModel->lihat();
        }

        $this->load->view('pengajuan/data_pengajuan', $data);
    }

    public function tambah()
    {
        if (!$this->ion_auth->in_group('unit')) {
            show_error('You must be an administrator to view this page.');
        }
        $user = $this->ion_auth->user()->row();
        if ($user->id_unit == null || $user->ttd == null) {
            $this->session->set_flashdata('message', 'Tambah Pengajuan Gagal - Harap Lengkapi Profil Anda Terlebih Dahulu');
            redirect('pengajuan');
        }
        $data['title'] = 'Tambah Pengajuan';
        $data['barang'] = $this->BarangModel->lihat();
        $data['tanggal'] = date('m/d/Y');

        $query = $this->db->query("SELECT MAX(id) as id FROM pengajuan");

        if ($query->row_array() != null) {
            $row = $query->row_array();
            $i = $row['id'];
            $i++;
            $no = $i;
        } else {
            $no = "1";
        };

        $id = $no;
        $data['id'] = $id;

        $this->form_validation->set_rules('pengajuan', 'Nama Pengajuan', 'required');
        $this->form_validation->set_rules('jenis_pengajuan', 'Jenis Pengajuan', 'required');
        $this->form_validation->set_rules('tgl_pengajuan', 'Tanggal Pengajuan', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('pengajuan/tambah_pengajuan', $data);
        } else {
            $id_user = $this->input->post('id_user');
            if (!$this->PengajuanModel->temp_barang($id, $id_user)) {
                $this->session->set_flashdata('message', 'Tidak Ada Barang Yang Di Ajukan');
                redirect('pengajuan/tambah');
            } else {
                $total = $this->PengajuanModel->total_pagu($id, $id_user);
                $this->PengajuanModel->proses_tambah($total);
                $err = $this->db->error();
                if ($err['code'] !== 0) {
                    echo $err['message'];
                } else {
                    $this->session->set_flashdata('pesanbaik', 'Pengajuan Berhasil Di tambah');
                    redirect('pengajuan');
                }
            }
        }
    }

    public function temp_barang()
    {
        $id_barang = $this->input->post('id_barang');
        $id_user = $this->input->post('id_user');
        $id = $this->input->post('id');
        $jumlah = $this->input->post('jumlah');
        $biaya = $this->input->post('biaya');

        if ($id_barang == null && $jumlah == null && $biaya == null) {
            $msg = [
                'gagal' => 'Gagal - Barang Harus Diisi'
            ];
        } else {
            $data = [
                'id_pengajuan' => $id,
                'id_barang' => $id_barang,
                'jumlah' => $jumlah,
                'biaya' => $biaya,
                'id_user' => $id_user,
            ];

            $this->PengajuanModel->insertTempBarang($data);

            $msg = [
                'sukses' => 'Berhasil'
            ];
        }
        echo json_encode($msg);
    }

    public function data_barang()
    {
        $id = $this->input->post('id');
        $id_user = $this->input->post('id_user');
        $getData = $this->PengajuanModel->temp_barang($id, $id_user);

        $data = [
            'barang' => $getData,
        ];

        $view = $this->load->view('pengajuan/temp_barang', $data, TRUE);
        $msg = [
            'data' => $view
        ];

        echo json_encode($msg);
    }

    public function hapus_barang($id)
    {
        $this->PengajuanModel->hapus_barang($id);
        $err = $this->db->error();
        if ($err['code'] !== 0) {
            echo $err['message'];
        } else {
            $this->session->set_flashdata('pesanbaik', 'Barang Berhasil Di Hapus');
            redirect('pengajuan/tambah');
        }
    }

    public function detail($id)
    {
        $data['title'] = 'Detail Pengajuan';
        $data['row'] = $this->PengajuanModel->getPengajuan($id);
        $data['barang'] = $this->PengajuanModel->detail($id);

        $this->load->view('pengajuan/detail_pengajuan', $data);
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Unit';
        $data['barang'] = $this->BarangModel->lihat();
        $data['row'] = $this->PengajuanModel->getPengajuan($id);

        $this->form_validation->set_rules('pengajuan', 'Nama Pengajuan', 'required');
        $this->form_validation->set_rules('jenis_pengajuan', 'Jenis Pengajuan', 'required');
        $this->form_validation->set_rules('tgl_pengajuan', 'Tanggal Pengajuan', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('pengajuan/edit_pengajuan', $data);
        } else {
            if (!$this->PengajuanModel->detail($id)) {
                $this->session->set_flashdata('message', 'Tidak Ada Barang Yang Di Ajukan');
                redirect('pengajuan/edit/' . $id);
            } else {
                $total = $this->PengajuanModel->total_pagudetail($id);
                $this->PengajuanModel->proses_edit($id, $total);
                $err = $this->db->error();
                if ($err['code'] !== 0) {
                    echo $err['message'];
                } else {
                    $this->session->set_flashdata('pesanbaik', 'Pengajuan Berhasil Di update');
                    redirect('Pengajuan');
                }
            }
        }
    }

    public function detail_pengajuan()
    {
        $id = $this->input->post('id');
        $getData = $this->PengajuanModel->detail($id);

        $data = [
            'barang' => $getData,
        ];

        $view = $this->load->view('pengajuan/detail_barang', $data, TRUE);
        $msg = [
            'data' => $view
        ];

        echo json_encode($msg);
    }

    public function insert_detail()
    {
        $id_barang = $this->input->post('id_barang');
        $id_user = $this->input->post('id_user');
        $id = $this->input->post('id');
        $jumlah = $this->input->post('jumlah');
        $biaya = $this->input->post('biaya');

        if ($id_barang == null && $jumlah == null && $biaya == null) {
            $msg = [
                'gagal' => 'Gagal - Barang Harus Diisi'
            ];
        } else {
            $data = [
                'id_pengajuan' => $id,
                'id_barang' => $id_barang,
                'jumlah' => $jumlah,
                'biaya' => $biaya,
                'id_user' => $id_user,
            ];

            $this->PengajuanModel->insertdetail($data);

            $msg = [
                'sukses' => 'Berhasil'
            ];
        }
        echo json_encode($msg);
    }

    public function hapus_detail($id)
    {
        $id_p = $this->input->get('id_p');
        if ($id_p != null) {
            $this->PengajuanModel->hapus_detail($id);
            $err = $this->db->error();
            if ($err['code'] !== 0) {
                echo $err['message'];
            } else {
                $this->session->set_flashdata('pesanbaik', 'Barang Berhasil Di Hapus');
                redirect('pengajuan/edit/' . $id_p);
            }
        } else {
            $this->session->set_flashdata('message', 'Barang Gagal Di Hapus');
            redirect('pengajuan');
        }
    }

    public function hapus($id)
    {
        $this->PengajuanModel->hapus($id);
        $err = $this->db->error();
        if ($err['code'] !== 0) {
            echo $err['message'];
        } else {
            $this->session->set_flashdata('pesanbaik', 'Pengajuan Berhasil Di Hapus');
            redirect('pengajuan');
        }
    }

    public function acc_staff($id)
    {
        $this->PengajuanModel->acc_staff($id);
        $err = $this->db->error();
        if ($err['code'] !== 0) {
            echo $err['message'];
        } else {
            $this->session->set_flashdata('pesanbaik', 'Pengajuan Berhasil Di Setujui');
            redirect('pengajuan');
        }
    }
}

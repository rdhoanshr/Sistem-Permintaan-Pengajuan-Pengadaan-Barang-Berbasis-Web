<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengajuan_vendor extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(['ion_auth', 'form_validation']);

        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        } else if (!$this->ion_auth->in_group('vendor')) {
            show_error('You must be an administrator to view this page.');
        } else {
        }

        $this->load->model('PengajuanModel');
        $this->load->model('BarangModel');
        $this->load->model('VendorModel');
    }


    public function index()
    {
        $data['title'] = 'Data Pengadaan';
        $data['pengajuan'] = $this->PengajuanModel->lihat_vendor();

        $this->load->view('pengajuan_vendor/data_pengajuan', $data);
    }

    public function persediaan()
    {
        $id = $this->input->post('id');
        $qty = $this->input->post('qty');
        $harga = $this->input->post('harga');

        $detail = $this->PengajuanModel->getDetail($id);

        if ($qty == null || $harga == null) {
            $msg = [
                'gagal' => 'Qty atau Harga Tidak Boleh Kosong'
            ];
        } elseif ($qty < 1 || $harga < 1) {
            $msg = [
                'gagal' => 'Qty atau Harga Tidak Boleh Kurang Dari 1'
            ];
        } elseif ($qty > $detail['jumlah'] || $harga > $detail['biaya']) {
            $msg = [
                'gagal' => 'Qty atau Harga Tidak Boleh Lebih Dari Jumlah Penawaran'
            ];
        } else {
            $this->PengajuanModel->inputPersediaanVendor($id, $qty, $harga);
            $id_pengajuan = $detail['id_pengajuan'];
            $total = $this->PengajuanModel->totalHargaVendor($id_pengajuan);
            $msg = [
                'data' => 'Persediaan Berhasil Diinput',
                'total' => number_format($total['total'])
            ];
        }

        echo json_encode($msg);
    }

    public function detail($id)
    {
        $data['title'] = 'Detail Pengajuan';
        $data['row'] = $this->PengajuanModel->getPengajuan_vendor($id);
        $data['barang'] = $this->PengajuanModel->detail($id);

        $total = $this->PengajuanModel->totalHargaVendor($id);
        if ($total['total'] == null) {
            $data['total'] = '0';
        } else {
            $data['total'] = number_format($total['total']);
        }

        if ($data['row']['rekomendasi'] != null) {
            $rekom = explode(';', $data['row']['rekomendasi']);
            $data['rekom'] = $rekom;
        }

        $this->load->view('pengajuan_vendor/detail_pengajuan', $data);
    }

    public function order_pembelian($id)
    {
        $data['title'] = 'Memo Direktur';
        $data['row'] = $this->PengajuanModel->getPengajuan($id);
        $data['detail'] = $this->PengajuanModel->detail($id);
        $data['surat'] = $this->PengajuanModel->surat($id);

        $id_vendor = $data['row']['id_vendor'];
        $data['vendor'] = $this->PengajuanModel->vendor($id_vendor);

        $id_staff = $data['row']['verifikasi_1'];
        $data['staff'] = $this->PengajuanModel->getStaff($id_staff);

        $id_kabag = $data['row']['verifikasi_2'];
        $data['kabag'] = $this->PengajuanModel->getKabag($id_kabag);

        $id_direktur = $data['row']['verifikasi_3'];
        $data['direktur'] = $this->PengajuanModel->getDirektur($id_direktur);

        if ($data['row'] != null) {
            $this->load->library('pdf');
            $customPaper = array(0, 0, 549, 500);
            $this->pdf->setPaper($customPaper, 'potrait');
            $this->pdf->load_view('pengajuan/order_pembelian', $data);
        } else {
            $this->session->set_flashdata('message', 'Halaman Tidak Tersedia');
            return redirect('pengajuan');
        }
    }

    public function konfirmasi($id)
    {
        $cek_detail = $this->PengajuanModel->detail($id);

        foreach ($cek_detail as $c) {
            if ($c['qty_vendor'] == null || $c['harga_vendor'] == null) {
                $this->session->set_flashdata('message', 'Konfirmasi Gagal - Harap Input Persediaan Barang Secara Lengkap');
                redirect('pengajuan_vendor/detail/' . $id);
            }
        }

        $gettotal = $this->PengajuanModel->totalHargaVendor($id);

        $total = $gettotal['total'];

        $this->PengajuanModel->konfirmasi($id, $total);
        $err = $this->db->error();
        if ($err['code'] !== 0) {
            echo $err['message'];
        } else {
            $this->session->set_flashdata('pesanbaik', 'Pengadaan Berhasil Di Setujui');
            redirect('pengajuan_vendor');
        }
    }

    public function acc($id)
    {
        $this->PengajuanModel->acc($id);
        $err = $this->db->error();
        if ($err['code'] !== 0) {
            echo $err['message'];
        } else {
            $this->session->set_flashdata('pesanbaik', 'Pengadaan Berhasil Di Setujui');
            redirect('pengajuan_vendor');
        }
    }



    public function tolak($id)
    {
        $this->form_validation->set_rules('rekomendasi', 'Rekomendasi', 'required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', 'Rekomendasi Harus Di isi');
            redirect('pengajuan_vendor/detail/' . $id);
        } else {
            $rekom = $this->input->post('rekomendasi');
            $rekom1 = explode(';', $rekom);
            foreach ($rekom1 as $r) {
                $rekom2 = explode(',', $r);
                if (sizeof($rekom2) < 3) {
                    $this->session->set_flashdata('message', 'Mohon Isi Rekomendasi Sesuai Format');
                    redirect('pengajuan_vendor/detail/' . $id);
                }
                if (is_numeric($rekom2[2]) == false || is_numeric($rekom2[1]) == false) {
                    $this->session->set_flashdata('message', 'Mohon Isi Rekomendasi Sesuai Format');
                    redirect('pengajuan_vendor/detail/' . $id);
                }
            }
            $this->PengajuanModel->tolak($id);
            $err = $this->db->error();
            if ($err['code'] !== 0) {
                echo $err['message'];
            } else {
                $this->session->set_flashdata('pesanbaik', 'Pengadaan Berhasil Di Tolak');
                redirect('pengajuan_vendor');
            }
        }
    }
}

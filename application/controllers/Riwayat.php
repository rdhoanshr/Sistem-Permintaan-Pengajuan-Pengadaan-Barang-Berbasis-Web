<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Riwayat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(['ion_auth', 'form_validation']);

        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        } else if ($this->ion_auth->in_group(5)) {
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
        $tgl = $this->input->post('tgl');

        if ($tgl) {
            $gettgl = explode(' - ', $tgl);
            $awal = date('Y-m-d', strtotime($gettgl[0]));
            $akhir = date('Y-m-d', strtotime($gettgl[1]));

            $data['tgl'] = $tgl;
            $data['pengajuan'] = $this->PengajuanModel->riwayatFilter($awal, $akhir);
        } else {
            $data['pengajuan'] = $this->PengajuanModel->riwayat();
        }


        $this->load->view('riwayat/riwayat_pengadaan', $data);
    }

    public function laporan()
    {
        $tgl = $this->input->get('tgl');
        if ($tgl) {
            $gettgl = explode(' - ', $tgl);
            $awal = date('Y-m-d', strtotime($gettgl[0]));
            $akhir = date('Y-m-d', strtotime($gettgl[1]));

            $data['tgl'] = $tgl;
            $data['pengajuan'] = $this->PengajuanModel->riwayatFilter($awal, $akhir);
        } else {
            $data['pengajuan'] = $this->PengajuanModel->riwayat();
        }

        $this->load->library('pdf');

        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->load_view('riwayat/laporan', $data);
    }

    public function surat_pengajuan($id)
    {
        $data['title'] = 'Surat Pengajuan';
        $data['row'] = $this->PengajuanModel->getPengajuan($id);
        $data['barang'] = $this->PengajuanModel->detail($id);

        if ($data['row'] != null) {
            $this->load->library('pdf');

            $this->pdf->setPaper('A4', 'potrait');
            $this->pdf->load_view('pengajuan/surat_unit', $data);
        } else {
            $this->session->set_flashdata('message', 'Halaman Tidak Tersedia');
            return redirect('riwayat');
        }
    }

    public function memo_kabag($id)
    {
        $data['title'] = 'Memo Kabag';
        $data['row'] = $this->PengajuanModel->getPengajuan($id);
        $id_kabag = $data['row']['verifikasi_2'];

        $data['kabag'] = $this->PengajuanModel->getKabag($id_kabag);

        if ($data['row'] != null) {
            $this->load->library('pdf');

            $this->pdf->setPaper('A4', 'potrait');
            $this->pdf->load_view('pengajuan/memo_kabag', $data);
        } else {
            $this->session->set_flashdata('message', 'Halaman Tidak Tersedia');
            return redirect('riwayat');
        }
    }

    public function memo_direktur($id)
    {
        $data['title'] = 'Memo Direktur';
        $data['row'] = $this->PengajuanModel->getPengajuan($id);
        $id_direktur = $data['row']['verifikasi_3'];

        $data['direktur'] = $this->PengajuanModel->getDirektur($id_direktur);

        if ($data['row'] != null) {
            $this->load->library('pdf');

            $this->pdf->setPaper('A4', 'potrait');
            $this->pdf->load_view('pengajuan/memo_direktur', $data);
        } else {
            $this->session->set_flashdata('message', 'Halaman Tidak Tersedia');
            return redirect('riwayat');
        }
    }

    public function order_pembelian($id)
    {
        $data['title'] = 'Order Pembelian';
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
            return redirect('riwayat');
        }
    }

    public function faktur($id)
    {
        $data['title'] = 'Faktur';
        $data['row'] = $this->PengajuanModel->getPengajuan_vendor($id);
        $data['barang'] = $this->PengajuanModel->detail($id);

        $total = $this->PengajuanModel->totalHargaVendor($id);
        if ($total['total'] == null) {
            $data['total'] = '0';
        } else {
            $data['total'] = number_format($total['total']);
        }

        $id_uservendor = $data['row']['user_vendor'];
        $data['user_vendor'] = $this->PengajuanModel->getStaff($id_uservendor);

        $id_vendor = $data['row']['id_vendor'];
        $data['vendor'] = $this->PengajuanModel->vendor($id_vendor);

        if ($data['row'] != null) {
            $this->load->library('pdf');
            $customPaper = array(0, 0, 549, 500);
            $this->pdf->setPaper($customPaper, 'potrait');
            $this->pdf->load_view('pengajuan/faktur', $data);
        } else {
            $this->session->set_flashdata('message', 'Halaman Tidak Tersedia');
            return redirect('riwayat');
        }
    }
}

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
        } else if ($this->ion_auth->in_group('vendor')) {
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
}

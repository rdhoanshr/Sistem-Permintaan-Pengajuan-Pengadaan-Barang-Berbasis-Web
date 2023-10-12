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
        } else if ($this->ion_auth->in_group(5)) {
            show_error('You must be an administrator to view this page.');
        } else {
            // show_error('You must be an administrator to view this page.');
        }

        $this->load->model('PengajuanModel');
        $this->load->model('BarangModel');
        $this->load->model('VendorModel');
    }


    public function index()
    {
        $data['title'] = 'Data Pengajuan';
        if ($this->ion_auth->in_group(1)) {
            $data['pengajuan'] = $this->PengajuanModel->lihat_unit();
        } elseif ($this->ion_auth->in_group('kabag') || $this->ion_auth->in_group(4)) {
            $data['pengajuan'] = $this->PengajuanModel->lihat_kabagdirut();
        } else {
            $data['pengajuan'] = $this->PengajuanModel->lihat();
            // $data['vendor'] = $this->VendorModel->user_vendor();
            $data['vendor'] = $this->VendorModel->lihat();
        }

        $this->load->view('pengajuan/data_pengajuan', $data);
    }

    public function tambah()
    {
        if (!$this->ion_auth->in_group(1)) {
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

    public function hapus_barang()
    {
        $id = $this->input->post('id');
        $this->PengajuanModel->hapus_barang($id);
        $err = $this->db->error();
        if ($err['code'] !== 0) {
            $msg = [
                'gagal' => $err['message']
            ];
        } else {
            $msg = [
                'sukses' => 'Barang Berhasil Di Hapus'
            ];
        }

        echo json_encode($msg);
    }

    public function detail($id)
    {
        $data['title'] = 'Detail Pengajuan';
        $data['row'] = $this->PengajuanModel->getPengajuan($id);
        $data['barang'] = $this->PengajuanModel->detail($id);

        if ($data['row']['rekomendasi'] != null) {
            $rekom = explode(';', $data['row']['rekomendasi']);
            $data['rekom'] = $rekom;
        }

        if ($data['row'] != null) {
            $this->load->view('pengajuan/detail_pengajuan', $data);
        } else {
            $this->session->set_flashdata('message', 'Halaman Tidak Tersedia');
            return redirect('pengajuan');
        }
    }

    public function surat_unit($id)
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
            return redirect('pengajuan');
        }
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
            if ($data['row'] != null) {
                $this->load->view('pengajuan/edit_pengajuan', $data);
            } else {
                $this->session->set_flashdata('message', 'Halaman Tidak Tersedia');
                return redirect('pengajuan');
            }
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

    public function hapus_detail()
    {
        $id = $this->input->post('id');
        $id_p = $this->input->post('id_p');
        if ($id_p != null) {
            $this->PengajuanModel->hapus_detail($id);
            $err = $this->db->error();
            if ($err['code'] !== 0) {
                $msg = [
                    'error' => $err['message']
                ];
            } else {
                $msg = [
                    'sukses' => 'Barang Berhasil Di Hapus'
                ];
            }
        } else {
            $msg = [
                'gagal' => 'Barang Gagal Di Hapus'
            ];
        }
        echo json_encode($msg);
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
        $user = $this->ion_auth->user()->row();
        if ($user->ttd == null) {
            $this->session->set_flashdata('message', 'Acc Pengajuan Gagal - Harap Lengkapi Profil Anda Terlebih Dahulu');
            redirect('pengajuan/detail/' . $id);
        }
        $this->PengajuanModel->acc_staff($id);
        $err = $this->db->error();
        if ($err['code'] !== 0) {
            echo $err['message'];
        } else {
            $this->session->set_flashdata('pesanbaik', 'Pengajuan Berhasil Di Setujui');
            redirect('pengajuan');
        }
    }

    public function acc_kabag($id)
    {
        $get = $this->input->post('catatan');
        if ($get == null) {
            $msg = [
                'gagal' => 'Gagal - Instruksi Harus Diisi'
            ];
        } else {
            $user = $this->ion_auth->user()->row();
            if ($user->ttd == null) {
                $msg = [
                    'gagal' => 'Acc Pengajuan Gagal - Harap Lengkapi Profil Anda Terlebih Dahulu'
                ];
            } else {
                $this->PengajuanModel->acc_kabag($id, $get);

                $msg = [
                    'sukses' => 'Pengajuan Berhasil Di Setujui'
                ];
            }
        }
        echo json_encode($msg);
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
            return redirect('pengajuan');
        }
    }

    public function acc_direktur($id)
    {
        $get = $this->input->post('catatan');
        if ($get == null) {
            $msg = [
                'gagal' => 'Gagal - Instruksi Harus Diisi'
            ];
        } else {
            $user = $this->ion_auth->user()->row();
            if ($user->ttd == null) {
                $msg = [
                    'gagal' => 'Acc Pengajuan Gagal - Harap Lengkapi Profil Anda Terlebih Dahulu'
                ];
            } else {
                $this->PengajuanModel->acc_direktur($id, $get);

                $msg = [
                    'sukses' => 'Pengajuan Berhasil Di Setujui'
                ];
            }
        }
        echo json_encode($msg);
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
            return redirect('pengajuan');
        }
    }

    public function modal_kirim()
    {
        $id = $this->input->post('id');

        $msg = [
            'sukses' => base_url('pengajuan/vendor/') . $id
        ];

        echo json_encode($msg);
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

    public function vendor($id)
    {
        $this->form_validation->set_rules('vendor', 'Vendor', 'required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', 'Vendor Harus Dipilih');
            redirect('pengajuan');
        } else {
            $this->PengajuanModel->kirim_vendor($id);
            $err = $this->db->error();
            if ($err['code'] !== 0) {
                echo $err['message'];
            } else {
                $this->session->set_flashdata('pesanbaik', 'Pengajuan Berhasil Di Kirim Ke Vendor');
                redirect('pengajuan');
            }
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
            return redirect('pengajuan');
        }
    }

    public function penyerahan($id)
    {
        $row = $this->PengajuanModel->getPengajuan($id);
        $id_unit = $row['id_unit'];

        $this->PengajuanModel->penyerahan($id, $id_unit);
        $err = $this->db->error();
        if ($err['code'] !== 0) {
            echo $err['message'];
        } else {
            $this->session->set_flashdata('pesanbaik', 'Pengajuan Telah Selesai');
            redirect('pengajuan');
        }
    }

    public function terima($id)
    {
        $row = $this->PengajuanModel->getPenyerahan($id);
        $id_penyerahan = $row['id'];

        $this->PengajuanModel->terima($id, $id_penyerahan);
        $err = $this->db->error();
        if ($err['code'] !== 0) {
            echo $err['message'];
        } else {
            $this->session->set_flashdata('pesanbaik', 'Pengajuan Telah Selesai');
            redirect('riwayat');
        }
    }
}

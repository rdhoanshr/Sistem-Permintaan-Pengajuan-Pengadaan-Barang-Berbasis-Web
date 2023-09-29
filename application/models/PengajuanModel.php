<?php

class PengajuanModel extends CI_model
{
    public function lihat()
    {
        $this->db->select('pengajuan.id,kode_pengajuan,pengajuan,jenis_pengajuan,tgl_pengajuan,keterangan,total,status,users.id_unit,nama_unit');
        $this->db->from('pengajuan');
        $this->db->join('users', 'pengajuan.id_user = users.id');
        $this->db->join('unit', 'users.id_unit = unit.id_unit');
        $this->db->where_not_in('status', 1);

        return $this->db->get()->result_array();
    }

    public function lihat_vendor()
    {
        $id_user = $this->ion_auth->user()->row()->id_vendor;
        $this->db->select('pengajuan.id,no_surat,tgl_persetujuan,kode_pengajuan,pengajuan,jenis_pengajuan,pengajuan.tgl_pengajuan,keterangan,total,status,users.id_unit,nama_unit');
        $this->db->from('pengajuan');
        $this->db->join('surat', 'pengajuan.kode_pengajuan = surat.no_surat');
        $this->db->join('users', 'pengajuan.id_user = users.id');
        $this->db->join('unit', 'users.id_unit = unit.id_unit');
        $this->db->where('pengajuan.id_vendor', $id_user);
        return $this->db->get()->result_array();
    }

    public function lihat_kabagdirut()
    {
        $this->db->select('pengajuan.id,kode_pengajuan,pengajuan,jenis_pengajuan,tgl_pengajuan,keterangan,total,status,users.id_unit,nama_unit');
        $this->db->from('pengajuan');
        $this->db->join('users', 'pengajuan.id_user = users.id');
        $this->db->join('unit', 'users.id_unit = unit.id_unit');
        $this->db->where_not_in('status', 0);
        $this->db->where_not_in('status', 1);

        return $this->db->get()->result_array();
    }

    public function lihat_unit()
    {
        $id_user = $this->ion_auth->user()->row()->id;
        $this->db->select('pengajuan.id,kode_pengajuan,pengajuan,jenis_pengajuan,tgl_pengajuan,keterangan,total,status,users.id_unit,nama_unit');
        $this->db->from('pengajuan');
        $this->db->join('users', 'pengajuan.id_user = users.id');
        $this->db->join('unit', 'users.id_unit = unit.id_unit');
        $this->db->where('users.id', $id_user);
        $this->db->where_not_in('status', 1);

        return $this->db->get()->result_array();
    }

    public function riwayat()
    {
        $this->db->select('pengajuan.id,no_surat,tgl_persetujuan,kode_pengajuan,pengajuan,jenis_pengajuan,pengajuan.tgl_pengajuan,keterangan,total,status,users.id_unit,nama_unit,tanggal_penyerahan,total_vendor');
        $this->db->from('pengajuan');
        $this->db->join('surat', 'pengajuan.kode_pengajuan = surat.no_surat');
        $this->db->join('users', 'pengajuan.id_user = users.id');
        $this->db->join('unit', 'users.id_unit = unit.id_unit');
        $this->db->join('penyerahan_barang', 'pengajuan.id = penyerahan_barang.id_pengajuan');

        $this->db->where_in('status', 1);

        return $this->db->get()->result_array();
    }

    public function riwayatFilter($awal, $akhir)
    {
        $this->db->select('pengajuan.id,no_surat,tgl_persetujuan,kode_pengajuan,pengajuan,jenis_pengajuan,pengajuan.tgl_pengajuan,keterangan,total,status,users.id_unit,nama_unit,tanggal_penyerahan,total_vendor');
        $this->db->from('pengajuan');
        $this->db->join('surat', 'pengajuan.kode_pengajuan = surat.no_surat');
        $this->db->join('users', 'pengajuan.id_user = users.id');
        $this->db->join('unit', 'users.id_unit = unit.id_unit');
        $this->db->join('penyerahan_barang', 'pengajuan.id = penyerahan_barang.id_pengajuan');

        $this->db->where_in('status', 1);
        $this->db->where('tanggal_penyerahan >=', $awal);
        $this->db->where('tanggal_penyerahan <=', $akhir);

        return $this->db->get()->result_array();
    }

    public function insertTempBarang($data)
    {
        $insert = [
            'id_pengajuan' => $data['id_pengajuan'],
            'id_barang' => $data['id_barang'],
            'jumlah' => $data['jumlah'],
            'biaya' => $data['biaya'],
            'id_user' => $data['id_user'],
        ];

        $this->db->insert('temp_detailpengajuan', $insert);
    }

    public function insertdetail($data)
    {
        $insert = [
            'id_pengajuan' => $data['id_pengajuan'],
            'id_barang' => $data['id_barang'],
            'jumlah' => $data['jumlah'],
            'biaya' => $data['biaya'],
            'id_user' => $data['id_user'],
        ];

        $this->db->insert('detail_pengajuan', $insert);
    }

    public function temp_barang($id, $id_user)
    {
        $this->db->select('*');
        $this->db->from('temp_detailpengajuan');
        $this->db->join('barang', 'temp_detailpengajuan.id_barang=barang.id_barang');
        $this->db->where('id_pengajuan', $id);
        $this->db->where('id_user', $id_user);

        return $this->db->get()->result_array();
    }

    public function total_pagu($id, $id_user)
    {
        $this->db->select_sum('biaya', 'total');
        $this->db->from('temp_detailpengajuan');
        $this->db->join('barang', 'temp_detailpengajuan.id_barang=barang.id_barang');
        $this->db->where('id_pengajuan', $id);
        $this->db->where('id_user', $id_user);

        return $this->db->get()->row_array();
    }

    public function total_pagudetail($id)
    {
        $this->db->select_sum('biaya', 'total');
        $this->db->from('detail_pengajuan');
        $this->db->join('barang', 'detail_pengajuan.id_barang=barang.id_barang');
        $this->db->where('id_pengajuan', $id);

        return $this->db->get()->row_array();
    }

    public function hapus_barang($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('temp_detailpengajuan');
    }

    public function hapus_detail($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('detail_pengajuan');
    }

    public function proses_tambah($total)
    {
        $id = $this->input->post('id');
        $id_user = $this->input->post('id_user');
        $getBarang = $this->db->select('*')->from('temp_detailpengajuan')->where('id_pengajuan', $id)->where('id_user', $id_user)->get()->result_array();
        $id_unit = $this->ion_auth->user($id_user)->row_array();
        $unit = $this->db->select('*')->from('unit')->where('id_unit', $id_unit['id_unit'])->get()->row_array();

        $urut_unit = sprintf("%02s", $unit['id_unit']);
        // Proses Pembuatan Kode
        include "fungsi-romawi.php";
        $bulan = date('n');
        $romawi = getRomawi($bulan);
        $tahun = date('Y');
        $nomor = "/" . $unit['kode_unit'] . "/RSI-SA/" . $urut_unit . "/" . $romawi . "/" . $tahun;

        $query = $this->db->query("SELECT MAX(MID(no_surat,1,3)) as maxKode FROM surat WHERE YEAR(tgl_pengajuan)=$tahun and no_surat like '%$unit[kode_unit]%'");
        if ($query->row_array() != null) {
            $row = $query->row_array();
            $i = $row['maxKode'];
            $i++;
            $no = $i;
        } else {
            $no = "1";
        };

        $kode =  sprintf("%03s", $no);
        $nomorbaru = $kode . $nomor;
        // End Proses Pembuatan Kode

        $data = [
            "id" => $id,
            "kode_pengajuan" => $nomorbaru,
            "pengajuan" => $this->input->post('pengajuan', true),
            "jenis_pengajuan" => $this->input->post('jenis_pengajuan', true),
            "tgl_pengajuan" => date('Y-m-d'),
            "keterangan" => $this->input->post('keterangan', true),
            "total" => implode("", $total),
            "status" => 0,
            "id_user" => $id_user,
        ];

        $data_surat = [
            "no_surat" => $nomorbaru,
            "ttd_pengaju" => $this->ion_auth->user()->row()->ttd,
            "tgl_pengajuan" => date('Y-m-d'),
        ];
        $this->db->insert('pengajuan', $data);
        $this->db->insert('surat', $data_surat);

        if (!empty($getBarang)) {
            $data_barang = [];
            foreach ($getBarang as $g) {
                $data_barang[] = [
                    'id_pengajuan' => $g['id_pengajuan'],
                    'id_barang' => $g['id_barang'],
                    'jumlah' => $g['jumlah'],
                    'biaya' => $g['biaya'],
                    'id_user' => $g['id_user'],
                ];
            }

            $this->db->insert_batch('detail_pengajuan', $data_barang);

            $this->db->where('id_pengajuan', $id);
            $this->db->where('id_user', $id_user);
            $this->db->delete('temp_detailpengajuan');
        }
    }

    public function getPengajuan($id)
    {
        $this->db->select('pengajuan.id,kode_pengajuan,pengajuan,jenis_pengajuan,tgl_pengajuan,keterangan,total,status,users.id_unit,nama_unit,id_user,total_vendor,rekomendasi,kode_unit,nama_lengkap,ttd,memo_2,catatan_2,verifikasi_2,memo_3,catatan_3,verifikasi_3,pengajuan.id_vendor,verifikasi_1');
        $this->db->from('pengajuan');
        $this->db->join('users', 'pengajuan.id_user = users.id');
        $this->db->join('unit', 'users.id_unit = unit.id_unit');
        $this->db->where('pengajuan.id', $id);

        return $this->db->get()->row_array();
    }

    public function vendor($id)
    {
        $this->db->select('*');
        $this->db->from('vendor');
        $this->db->where('id', $id);

        return $this->db->get()->row_array();
    }

    public function surat($id)
    {
        $this->db->select('*');
        $this->db->from('pengajuan');
        $this->db->join('surat', 'pengajuan.kode_pengajuan = surat.no_surat');
        $this->db->where('pengajuan.id', $id);

        return $this->db->get()->row_array();
    }

    public function getKabag($id_kabag)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('id', $id_kabag);

        return $this->db->get()->row_array();
    }

    public function getStaff($id_staff)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('id', $id_staff);

        return $this->db->get()->row_array();
    }

    public function getDirektur($id_direktur)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('id', $id_direktur);

        return $this->db->get()->row_array();
    }



    public function getPengajuan_vendor($id)
    {
        $this->db->select('pengajuan.id,no_surat,kode_pengajuan,pengajuan,jenis_pengajuan,pengajuan.tgl_pengajuan,tgl_persetujuan,keterangan,total,status,users.id_unit,nama_unit,id_user,total_vendor,rekomendasi,user_vendor,no_faktur,tgl_faktur,pengajuan.id_vendor');
        $this->db->from('pengajuan');
        $this->db->join('surat', 'pengajuan.kode_pengajuan = surat.no_surat');
        $this->db->join('users', 'pengajuan.id_user = users.id');
        $this->db->join('unit', 'users.id_unit = unit.id_unit');
        $this->db->where('pengajuan.id', $id);

        return $this->db->get()->row_array();
    }

    public function detail($id)
    {
        $this->db->select('*');
        $this->db->from('detail_pengajuan');
        $this->db->join('barang', 'detail_pengajuan.id_barang=barang.id_barang');
        $this->db->where('id_pengajuan', $id);

        return $this->db->get()->result_array();
    }

    public function getDetail($id)
    {
        $this->db->select('*');
        $this->db->from('detail_pengajuan');
        $this->db->join('barang', 'detail_pengajuan.id_barang=barang.id_barang');
        $this->db->where('id', $id);

        return $this->db->get()->row_array();
    }

    public function inputPersediaanVendor($id, $qty, $harga)
    {
        $data = [
            'qty_vendor' => $qty,
            'harga_vendor' => $harga
        ];

        $this->db->where('id', $id);
        $this->db->update('detail_pengajuan', $data);
    }

    public function totalHargaVendor($id_pengajuan)
    {
        $this->db->select_sum('harga_vendor', 'total');
        $this->db->from('detail_pengajuan');
        $this->db->where('id_pengajuan', $id_pengajuan);

        return $this->db->get()->row_array();
    }

    public function tolak($id)
    {
        $data = [
            'status' => 6,
            'rekomendasi' => $this->input->post('rekomendasi')
        ];

        $this->db->where('id', $id);
        $this->db->update('pengajuan', $data);
    }

    public function proses_edit($id, $total)
    {
        $id = $this->input->post('id');

        $data = [
            "pengajuan" => $this->input->post('pengajuan', true),
            "jenis_pengajuan" => $this->input->post('jenis_pengajuan', true),
            "keterangan" => $this->input->post('keterangan', true),
            "total" => implode("", $total),
        ];
        if ($this->ion_auth->in_group('unit')) {
            $data['status'] = 0;
        }

        $this->db->where('id', $id);
        $this->db->update('pengajuan', $data);
    }


    public function hapus($id)
    {
        $this->db->where('id_pengajuan', $id);
        $this->db->delete('detail_pengajuan');

        $this->db->where('id', $id);
        $this->db->delete('pengajuan');
    }

    public function acc_staff($id)
    {
        $user = $this->ion_auth->user()->row();
        $data = [
            "status" => 2,
            "verifikasi_1" => $user->id,
        ];

        $this->db->where('id', $id);
        $this->db->update('pengajuan', $data);
    }

    public function acc_kabag($id, $get)
    {
        $user = $this->db->select('*')->from('pengajuan')->where('id', $id)->get()->row_array();

        $id_unit = $this->db->select('*')->from('users')->where('id', $user['id_user'])->get()->row_array();
        $unit = $this->db->select('*')->from('unit')->where('id_unit', $id_unit['id_unit'])->get()->row_array();

        $urut_unit = sprintf("%02s", $unit['id_unit']);

        include "fungsi-romawi.php";
        $bulan = date('n');
        $romawi = getRomawi($bulan);
        $tahun = date('Y');
        $nomor = "/RSI-SA/" . $urut_unit . "/" . $romawi . "/" . $tahun;

        $query = $this->db->query("SELECT MAX(MID(kode_pengajuan,1,3)) as maxKode FROM pengajuan WHERE YEAR(tgl_pengajuan)=$tahun and memo_2 like '%$urut_unit%'");
        if ($query->row_array() != null) {
            $row = $query->row_array();
            $i = $row['maxKode'];
            $i++;
            $no = $i;
        } else {
            $no = "1";
        };

        $kode =  sprintf("%03s", $no);
        $nomorbaru = $kode . $nomor;

        $user = $this->ion_auth->user()->row();
        $data = [
            "status" => 3,
            "verifikasi_2" => $user->id,
            "memo_2" => $nomorbaru,
            "catatan_2" => $get,
        ];

        $this->db->where('id', $id);
        $this->db->update('pengajuan', $data);
    }

    public function acc_direktur($id, $get)
    {
        $user = $this->db->select('*')->from('pengajuan')->where('id', $id)->get()->row_array();

        $id_unit = $this->db->select('*')->from('users')->where('id', $user['id_user'])->get()->row_array();
        $unit = $this->db->select('*')->from('unit')->where('id_unit', $id_unit['id_unit'])->get()->row_array();

        $urut_unit = sprintf("%02s", $unit['id_unit']);

        include "fungsi-romawi.php";
        $bulan = date('n');
        $romawi = getRomawi($bulan);
        $tahun = date('Y');
        $nomor = "/RSI-SA/" . $urut_unit . "/" . $romawi . "/" . $tahun;

        $query = $this->db->query("SELECT MAX(MID(kode_pengajuan,1,3)) as maxKode FROM pengajuan WHERE YEAR(tgl_pengajuan)=$tahun and memo_3 like '%$urut_unit%'");
        if ($query->row_array() != null) {
            $row = $query->row_array();
            $i = $row['maxKode'];
            $i++;
            $no = $i;
        } else {
            $no = "1";
        };

        $kode =  sprintf("%03s", $no);
        $nomorbaru = $kode . $nomor;

        $user = $this->ion_auth->user()->row();
        $kode = $this->db->query("SELECT kode_pengajuan FROM pengajuan WHERE id=$id")->row_array();
        if ($kode != null) {
            $no_surat =  implode("", $kode);
        } else {
            $kode = null;
        }

        $data = [
            "status" => 4,
            "verifikasi_3" => $user->id,
            "memo_3" => $nomorbaru,
            "catatan_3" => $get,
        ];

        $data_surat = [
            "ttd_aprover" => $user->ttd,
            "tgl_persetujuan" => date('Y-m-d'),
        ];

        $this->db->where('id', $id);
        $this->db->update('pengajuan', $data);

        $this->db->where('no_surat', $no_surat);
        $this->db->update('surat', $data_surat);
    }

    public function kirim_vendor($id)
    {
        $data = [
            "status" => 5,
            "id_vendor" => $this->input->post('vendor'),
        ];

        $this->db->where('id', $id);
        $this->db->update('pengajuan', $data);
    }

    public function konfirmasi($id, $total)
    {
        $getVendor = $this->db->select('*')->from('pengajuan')->where('id', $id)->get()->row_array();

        $bulan = date('m');
        $tahun = date('y');
        $tahun2 = date('Y');
        $nomor = $tahun . "/" . $bulan;

        $query = $this->db->query("SELECT MAX(MID(no_faktur,8,10)) as maxKode FROM pengajuan WHERE YEAR(tgl_faktur)=$tahun2 and id_vendor=$getVendor[id_vendor]");
        if ($query->row_array() != null) {
            $row = $query->row_array();
            $i = $row['maxKode'];
            $i++;
            $no = $i;
        } else {
            $no = "1";
        };

        $kode =  sprintf("%03s", $no);
        $nomorbaru = $nomor . $kode;

        $data = [
            "status" => 7,
            "total_vendor" => $total,
            "tgl_faktur" => date('Y-m-d'),
            "no_faktur" => $nomorbaru,
            "user_vendor" =>  $this->ion_auth->user()->row()->id
        ];

        $this->db->where('id', $id);
        $this->db->update('pengajuan', $data);
    }

    public function acc($id)
    {
        $getVendor = $this->db->select('*')->from('pengajuan')->where('id', $id)->get()->row_array();

        $bulan = date('m');
        $tahun = date('y');
        $tahun2 = date('Y');
        $nomor = $tahun . "/" . $bulan;

        $query = $this->db->query("SELECT MAX(MID(no_faktur,8,10)) as maxKode FROM pengajuan WHERE YEAR(tgl_faktur)=$tahun2 and id_vendor=$getVendor[id_vendor]");
        if ($query->row_array() != null) {
            $row = $query->row_array();
            $i = $row['maxKode'];
            $i++;
            $no = $i;
        } else {
            $no = "1";
        };

        $kode =  sprintf("%03s", $no);
        $nomorbaru = $nomor . $kode;

        $data = [
            "status" => 8,
            "tgl_faktur" => date('Y-m-d'),
            "no_faktur" => $nomorbaru,
            "user_vendor" =>  $this->ion_auth->user()->row()->id
        ];

        $this->db->where('id', $id);
        $this->db->update('pengajuan', $data);
    }

    public function penyerahan($id, $id_unit)
    {
        $data = [
            'status' => 1
        ];

        $data_penyerahan = [
            'id_pengajuan' => $id,
            'kode_unit' => $id_unit,
            'tanggal_penyerahan' => date('Y-m-d')
        ];

        $this->db->where('id', $id);
        $this->db->update('pengajuan', $data);

        $this->db->insert('penyerahan_barang', $data_penyerahan);
    }

    public function totalMenunggu()
    {
        return  $this->db->select('*')->from('pengajuan')->where('status', 0)->get()->num_rows();
    }

    public function totalMenunggu_unit()
    {
        $id_user = $this->ion_auth->user()->row()->id;
        return  $this->db->select('*')->from('pengajuan')->where('status', 0)->where('id_user', $id_user)->get()->num_rows();
    }

    public function totalProses()
    {
        return  $this->db->select('*')->from('pengajuan')->where('status', 2)->get()->num_rows();
    }

    public function totalProses_unit()
    {
        $id_user = $this->ion_auth->user()->row()->id;
        return  $this->db->select('*')->from('pengajuan')->where('status', 2)->where('id_user', $id_user)->get()->num_rows();
    }

    public function totalTinjau()
    {
        return  $this->db->select('*')->from('pengajuan')->where_in('status', [3, 4, 5, 6, 7, 8])->get()->num_rows();
    }

    public function totalTinjau_unit()
    {
        $id_user = $this->ion_auth->user()->row()->id;
        return  $this->db->select('*')->from('pengajuan')->where_in('status', [3, 4, 5, 6, 7, 8])->where('id_user', $id_user)->get()->num_rows();
    }

    public function totalSelesai()
    {
        return  $this->db->select('*')->from('pengajuan')->where('status', 1)->get()->num_rows();
    }

    public function totalSelesai_unit()
    {
        $id_user = $this->ion_auth->user()->row()->id;
        return  $this->db->select('*')->from('pengajuan')->where('status', 1)->where('id_user', $id_user)->get()->num_rows();
    }

    public function totalMenunggu_vendor()
    {
        $id_user = $this->ion_auth->user()->row()->id_vendor;
        return  $this->db->select('*')->from('pengajuan')->where('status', 5)->where('id_vendor', $id_user)->get()->num_rows();
    }

    public function totalTolak_vendor()
    {
        $id_user = $this->ion_auth->user()->row()->id_vendor;
        return  $this->db->select('*')->from('pengajuan')->where('status', 6)->where('id_vendor', $id_user)->get()->num_rows();
    }

    public function totalSetuju_vendor()
    {
        $id_user = $this->ion_auth->user()->row()->id_vendor;
        return  $this->db->select('*')->from('pengajuan')->where_in('status', [7, 8])->where('id_vendor', $id_user)->get()->num_rows();
    }

    public function totalSelesai_vendor()
    {
        $id_user = $this->ion_auth->user()->row()->id_vendor;
        return  $this->db->select('*')->from('pengajuan')->where('status', 1)->where('id_vendor', $id_user)->get()->num_rows();
    }
}

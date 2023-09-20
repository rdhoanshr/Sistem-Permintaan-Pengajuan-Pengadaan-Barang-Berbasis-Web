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

        // Proses Pembuatan Kode
        $bulan = date('n');
        $tahun = date('Y');
        $nomor = "/PB/" . $bulan . "/" . $tahun;
        $query = $this->db->query("SELECT MAX(MID(no_surat,1,3)) as maxKode FROM surat WHERE YEAR(tgl_pengajuan)=$tahun");
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
        $this->db->select('pengajuan.id,kode_pengajuan,pengajuan,jenis_pengajuan,tgl_pengajuan,keterangan,total,status,users.id_unit,nama_unit,id_user,total_vendor,rekomendasi');
        $this->db->from('pengajuan');
        $this->db->join('users', 'pengajuan.id_user = users.id');
        $this->db->join('unit', 'users.id_unit = unit.id_unit');
        $this->db->where('pengajuan.id', $id);

        return $this->db->get()->row_array();
    }

    public function getPengajuan_vendor($id)
    {
        $this->db->select('pengajuan.id,no_surat,kode_pengajuan,pengajuan,jenis_pengajuan,pengajuan.tgl_pengajuan,tgl_persetujuan,keterangan,total,status,users.id_unit,nama_unit,id_user,total_vendor,rekomendasi');
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

    public function acc_kabag($id)
    {
        $user = $this->ion_auth->user()->row();
        $data = [
            "status" => 3,
            "verifikasi_2" => $user->id,
        ];

        $this->db->where('id', $id);
        $this->db->update('pengajuan', $data);
    }

    public function acc_direktur($id)
    {
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
        $data = [
            "status" => 7,
            "total_vendor" => $total,
        ];

        $this->db->where('id', $id);
        $this->db->update('pengajuan', $data);
    }

    public function acc($id)
    {
        $data = [
            "status" => 8,
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
}

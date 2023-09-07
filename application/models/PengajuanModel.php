<?php

class PengajuanModel extends CI_model
{
    public function lihat()
    {
        $this->db->select('pengajuan.id,kode_pengajuan,pengajuan,jenis_pengajuan,tgl_pengajuan,keterangan,total,status,users.id_unit,nama_unit');
        $this->db->from('pengajuan');
        $this->db->join('users', 'pengajuan.id_user = users.id');
        $this->db->join('unit', 'users.id_unit = unit.id_unit');

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

    public function hapus_barang($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('temp_detailpengajuan');
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
        $this->db->select('pengajuan.id,kode_pengajuan,pengajuan,jenis_pengajuan,tgl_pengajuan,keterangan,total,status,users.id_unit,nama_unit');
        $this->db->from('pengajuan');
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

    public function proses_edit($id)
    {
        $data = [
            "nama_unit" => $this->input->post('nama_unit', true),
        ];

        $this->db->where('id_unit', $id);
        $this->db->update('unit', $data);
    }


    public function hapus($id)
    {
        $this->db->where('id_pengajuan', $id);
        $this->db->delete('detail_pengajuan');

        $this->db->where('id', $id);
        $this->db->delete('pengajuan');
    }
}

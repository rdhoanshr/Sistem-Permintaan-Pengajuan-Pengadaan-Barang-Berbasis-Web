<?php

class BarangModel extends CI_model
{
    public function tidakkepakai()
    {
        $this->db->select('*');
        $this->db->from('barang');

        return $this->db->get()->result_array();
    }

    public function lihat()
    {
        $this->db->select('*');
        $this->db->from('barang');
        $this->db->join('jenis_barang', 'barang.id_jenis=jenis_barang.id_jenis');

        return $this->db->get()->result_array();
    }

    public function proses_tambah()
    {
        $data = [
            "kode_barang" => $this->input->post('kode_barang', true),
            "nama_barang" => $this->input->post('nama_barang', true),
            "id_jenis" => $this->input->post('id_jenis', true),
            "satuan" => $this->input->post('satuan', true),
            "keterangan" => $this->input->post('keterangan', true),
        ];

        $this->db->insert('barang', $data);
    }



    public function getBarang($id)
    {
        return $this->db->get_where('barang', ['id_barang' => $id])->row_array();
    }

    public function getBarangKode($kode)
    {
        return $this->db->get_where('barang', ['kode_barang' => $kode])->row_array();
    }

    public function getJenisBarang($id)
    {
        return $this->db->get_where('jenis_barang', ['id_jenis' => $id])->row_array();
    }

    public function proses_edit($id)
    {
        $data = [
            "kode_barang" => $this->input->post('kode_barang', true),
            "nama_barang" => $this->input->post('nama_barang', true),
            "id_jenis" => $this->input->post('id_jenis', true),
            "satuan" => $this->input->post('satuan', true),
            "keterangan" => $this->input->post('keterangan', true),
        ];

        $this->db->where('id_barang', $id);
        $this->db->update('barang', $data);
    }


    public function hapus($id)
    {
        $this->db->where('id_barang', $id);
        $this->db->delete('barang');
    }
}

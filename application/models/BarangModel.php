<?php

class BarangModel extends CI_model
{
    public function lihat()
    {
        $this->db->select('*');
        $this->db->from('barang');

        return $this->db->get()->result_array();
    }

    public function proses_tambah()
    {
        $data = [
            "nama_barang" => $this->input->post('nama_barang', true),
            "jenis_barang" => $this->input->post('jenis_barang', true),
            "satuan" => $this->input->post('satuan', true),
            "keterangan" => $this->input->post('keterangan', true),
        ];

        $this->db->insert('barang', $data);
    }

    public function getBarang($id)
    {
        return $this->db->get_where('barang', ['id_barang' => $id])->row_array();
    }

    public function proses_edit($id)
    {
        $data = [
            "nama_barang" => $this->input->post('nama_barang', true),
            "jenis_barang" => $this->input->post('jenis_barang', true),
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

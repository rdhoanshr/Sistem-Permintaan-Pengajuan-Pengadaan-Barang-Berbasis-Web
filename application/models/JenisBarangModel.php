<?php

class JenisBarangModel extends CI_model
{
    public function lihat()
    {
        $this->db->select('*');
        $this->db->from('jenis_barang');

        return $this->db->get()->result_array();
    }
    public function proses_tambah()
    {
        $data = [
            "nama_jenisbarang" => $this->input->post('nama_jenisbarang', true),
        ];

        $this->db->insert('jenis_barang', $data);
    }

    public function getJenisBarang($id)
    {
        return $this->db->get_where('jenis_barang', ['id_jenis' => $id])->row_array();
    }

    public function proses_edit($id)
    {
        $data = [
            "nama_jenisbarang" => $this->input->post('nama_jenisbarang', true),
        ];

        $this->db->where('id_jenis', $id);
        $this->db->update('jenis_barang', $data);
    }


    public function hapus($id)
    {
        $this->db->where('id_jenis', $id);
        $this->db->delete('jenis_barang');
    }
}

<?php

class UnitModel extends CI_model
{
    public function lihat()
    {
        $this->db->select('*');
        $this->db->from('unit');

        return $this->db->get()->result_array();
    }

    public function proses_tambah()
    {
        $data = [
            "nama_unit" => $this->input->post('nama_unit', true),
        ];

        $this->db->insert('unit', $data);
    }

    public function getUnit($id)
    {
        return $this->db->get_where('unit', ['id_unit' => $id])->row_array();
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
        $this->db->where('id_barang', $id);
        $this->db->delete('barang');
    }
}

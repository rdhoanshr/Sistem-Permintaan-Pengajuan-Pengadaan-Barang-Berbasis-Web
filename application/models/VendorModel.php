<?php

class VendorModel extends CI_model
{
    public function lihat()
    {
        $this->db->select('*');
        $this->db->from('vendor');

        return $this->db->get()->result_array();
    }

    public function proses_tambah()
    {
        $data = [
            "kode" => $this->input->post('kode', true),
            "nama" => $this->input->post('nama', true),
            "alamat" => $this->input->post('alamat', true),
            "no_telp" => $this->input->post('no_telp', true),
            "email" => $this->input->post('email', true),
            "situs_web" => $this->input->post('situs_web', true),
            "catatan" => $this->input->post('catatan', true),
        ];

        $this->db->insert('vendor', $data);
    }

    public function getVendor($id)
    {
        return $this->db->get_where('vendor', ['id' => $id])->row_array();
    }

    public function getVendorNama($nama)
    {
        return $this->db->get_where('vendor', ['nama' => $nama])->row_array();
    }

    public function getVendorKode($kode)
    {
        return $this->db->get_where('vendor', ['kode' => $kode])->row_array();
    }

    public function proses_edit($id)
    {
        $data = [
            "kode" => $this->input->post('kode', true),
            "nama" => $this->input->post('nama', true),
            "alamat" => $this->input->post('alamat', true),
            "no_telp" => $this->input->post('no_telp', true),
            "email" => $this->input->post('email', true),
            "situs_web" => $this->input->post('situs_web', true),
            "catatan" => $this->input->post('catatan', true),
        ];

        $this->db->where('id', $id);
        $this->db->update('vendor', $data);
    }


    public function hapus($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('vendor');
    }

    public function user_vendor()
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->join('vendor', 'users.id_vendor = vendor.id');
        $this->db->where('active', 1);

        return $this->db->get()->result_array();
    }
}

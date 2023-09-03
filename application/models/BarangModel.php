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

    // public function getPenduduk($id)
    // {
    //     return $this->db->get_where('penduduk', ['id' => $id])->row_array();
    // }

    // public function proses_edit($id)
    // {
    //     $data = [
    //         "nik" => $this->input->post('nik', true),
    //         "no_kk" => $this->input->post('no_kk', true),
    //         "nama_penduduk" => $this->input->post('nama_penduduk', true),
    //         "jenis_kelamin" => $this->input->post('jenis_kelamin', true),
    //         "tempat_lahir" => $this->input->post('tempat_lahir', true),
    //         "tgl_lahir" => $this->input->post('tgl_lahir', true),
    //         "gol_darah" => $this->input->post('gol_darah', true),
    //         "alamat" => $this->input->post('alamat', true),
    //         "no_rt" => $this->input->post('no_rt', true),
    //         "no_rw" => $this->input->post('no_rw', true),
    //         "pekerjaan" => $this->input->post('pekerjaan', true),
    //         "id_agama" => $this->input->post('id_agama', true),
    //         "id_pendidikan" => $this->input->post('id_pendidikan', true),
    //         "id_statuskawin" => $this->input->post('id_statuskawin', true),
    //         "nm_ayah" => $this->input->post('nm_ayah', true),
    //         "nm_ibu" => $this->input->post('nm_ibu', true),
    //         "hub_keluarga" => $this->input->post('hubungan_keluarga', true),
    //         "status" => $this->input->post('status', true),
    //     ];

    //     $this->db->where('id', $id);
    //     $this->db->update('penduduk', $data);
    // }


    // public function hapus($id)
    // {
    //     $this->db->where('id', $id);
    //     $this->db->delete('penduduk');
    // }

    // public function lapor_ubahdata($data)
    // {
    //     $submit = [
    //         "id_pemohon" => $data['id'],
    //         "alasan" => $this->input->post('alasan'),
    //         "nik" => $this->input->post('nik'),
    //         "lampiran" => $data['lampiran'],
    //         "tanggal" => date('Y-m-d H:i:s'),
    //         "status" => 0
    //     ];

    //     $this->db->insert('lapor', $submit);
    // }

    // public function data_lapor()
    // {
    //     $this->db->select('*');
    //     $this->db->from('lapor');
    //     $this->db->join('penduduk', 'lapor.nik = penduduk.nik');
    //     $this->db->where('lapor.status', '0');

    //     return $this->db->get()->result_array();
    // }

    // public function data_verif()
    // {
    //     $this->db->select('*');
    //     $this->db->from('lapor_nik');
    //     $this->db->where_in('status', [0, 2]);

    //     return $this->db->get()->result_array();
    // }

    // public function getlapor($nik)
    // {
    //     $this->db->select('*');
    //     $this->db->from('lapor');
    //     $this->db->join('penduduk', 'lapor.nik = penduduk.nik');
    //     $this->db->where('lapor.nik', $nik);

    //     return $this->db->get()->row_array();
    // }

    // public function proses_ubahLapor($nik)
    // {
    //     $data = [
    //         "nik" => $this->input->post('nik', true),
    //         "no_kk" => $this->input->post('no_kk', true),
    //         "nama_penduduk" => $this->input->post('nama_penduduk', true),
    //         "jenis_kelamin" => $this->input->post('jenis_kelamin', true),
    //         "tempat_lahir" => $this->input->post('tempat_lahir', true),
    //         "tgl_lahir" => $this->input->post('tgl_lahir', true),
    //         "gol_darah" => $this->input->post('gol_darah', true),
    //         "alamat" => $this->input->post('alamat', true),
    //         "no_rt" => $this->input->post('no_rt', true),
    //         "no_rw" => $this->input->post('no_rw', true),
    //         "pekerjaan" => $this->input->post('pekerjaan', true),
    //         "id_agama" => $this->input->post('id_agama', true),
    //         "id_pendidikan" => $this->input->post('id_pendidikan', true),
    //         "id_statuskawin" => $this->input->post('id_statuskawin', true),
    //         "nm_ayah" => $this->input->post('nm_ayah', true),
    //         "nm_ibu" => $this->input->post('nm_ibu', true),
    //         "hub_keluarga" => $this->input->post('hubungan_keluarga', true),
    //         "status" => $this->input->post('status', true),
    //     ];

    //     $lapor = [
    //         'status' => 1
    //     ];

    //     $this->db->where('nik', $nik);
    //     $this->db->update('penduduk', $data);
    //     $this->db->where('nik', $nik);
    //     $this->db->update('lapor', $lapor);
    // }

    // public function lapor_verifdata($data)
    // {
    //     $submit = [
    //         "id_pemohon" => $data['id'],
    //         "nik" => $this->input->post('nik', true),
    //         "no_kk" => $this->input->post('no_kk', true),
    //         "nama_penduduk" => $this->input->post('nama_penduduk', true),
    //         "jenis_kelamin" => $this->input->post('jenis_kelamin', true),
    //         "tempat_lahir" => $this->input->post('tempat_lahir', true),
    //         "tgl_lahir" => $this->input->post('tgl_lahir', true),
    //         "gol_darah" => $this->input->post('gol_darah', true),
    //         "alamat" => $this->input->post('alamat', true),
    //         "no_rt" => $this->input->post('no_rt', true),
    //         "no_rw" => $this->input->post('no_rw', true),
    //         "pekerjaan" => $this->input->post('pekerjaan', true),
    //         "id_agama" => $this->input->post('id_agama', true),
    //         "id_pendidikan" => $this->input->post('id_pendidikan', true),
    //         "id_statuskawin" => $this->input->post('id_statuskawin', true),
    //         "nm_ayah" => $this->input->post('nm_ayah', true),
    //         "nm_ibu" => $this->input->post('nm_ibu', true),
    //         "hub_keluarga" => $this->input->post('hubungan_keluarga', true),
    //         "status" => $this->input->post('status', true),
    //         "ktp" => $data['ktp'],
    //         "kk" => $data['kk'],
    //         "surat_pindah" => $data['surat_pindah'],
    //         "tanggal" => date('Y-m-d H:i:s'),
    //         "status" => 0
    //     ];

    //     $this->db->insert('lapor_nik', $submit);
    // }

    // public function status_verif($id)
    // {
    //     return $this->db->get_where('lapor_nik', ['id_pemohon' => $id])->row_array();
    // }

    // public function get_statusverif($id)
    // {
    //     return $this->db->get_where('lapor_nik', ['id' => $id])->row_array();
    // }

    // public function updatelapor_verifdata($data)
    // {
    //     $submit = [
    //         "id_pemohon" => $this->input->post('id', true),
    //         "nik" => $this->input->post('nik', true),
    //         "no_kk" => $this->input->post('no_kk', true),
    //         "nama_penduduk" => $this->input->post('nama_penduduk', true),
    //         "jenis_kelamin" => $this->input->post('jenis_kelamin', true),
    //         "tempat_lahir" => $this->input->post('tempat_lahir', true),
    //         "tgl_lahir" => $this->input->post('tgl_lahir', true),
    //         "gol_darah" => $this->input->post('gol_darah', true),
    //         "alamat" => $this->input->post('alamat', true),
    //         "no_rt" => $this->input->post('no_rt', true),
    //         "no_rw" => $this->input->post('no_rw', true),
    //         "pekerjaan" => $this->input->post('pekerjaan', true),
    //         "id_agama" => $this->input->post('id_agama', true),
    //         "id_pendidikan" => $this->input->post('id_pendidikan', true),
    //         "id_statuskawin" => $this->input->post('id_statuskawin', true),
    //         "nm_ayah" => $this->input->post('nm_ayah', true),
    //         "nm_ibu" => $this->input->post('nm_ibu', true),
    //         "hub_keluarga" => $this->input->post('hubungan_keluarga', true),
    //         "status" => $this->input->post('status', true),
    //         "ktp" => $data['ktp'],
    //         "kk" => $data['kk'],
    //         "surat_pindah" => $data['surat_pindah'],
    //         "tanggal" => date('Y-m-d H:i:s'),
    //         "status" => 0
    //     ];

    //     $id = $this->input->post('id_permohonan', true);

    //     $this->db->where('id', $id);
    //     $this->db->update('lapor_nik', $submit);
    // }

    // public function tolakVerifikasi($id)
    // {
    //     $submit = [
    //         "status" => 2,
    //         "alasan" => $this->input->post('alasan', true)
    //     ];

    //     $this->db->where('id', $id);
    //     $this->db->update('lapor_nik', $submit);
    // }

    // public function verifikasi($id)
    // {

    //     $submit = [
    //         "nik" => $this->input->post('nik', true),
    //         "no_kk" => $this->input->post('no_kk', true),
    //         "nama_penduduk" => $this->input->post('nama_penduduk', true),
    //         "jenis_kelamin" => $this->input->post('jenis_kelamin', true),
    //         "tempat_lahir" => $this->input->post('tempat_lahir', true),
    //         "tgl_lahir" => $this->input->post('tgl_lahir', true),
    //         "gol_darah" => $this->input->post('gol_darah', true),
    //         "alamat" => $this->input->post('alamat', true),
    //         "no_rt" => $this->input->post('no_rt', true),
    //         "no_rw" => $this->input->post('no_rw', true),
    //         "pekerjaan" => $this->input->post('pekerjaan', true),
    //         "id_agama" => $this->input->post('id_agama', true),
    //         "id_pendidikan" => $this->input->post('id_pendidikan', true),
    //         "id_statuskawin" => $this->input->post('id_statuskawin', true),
    //         "nm_ayah" => $this->input->post('nm_ayah', true),
    //         "nm_ibu" => $this->input->post('nm_ibu', true),
    //         "hub_keluarga" => $this->input->post('hubungan_keluarga', true),
    //     ];

    //     $verif = [
    //         "id_pemohon" => $this->input->post('id', true),
    //         "tanggal" => date('Y-m-d H:i:s'),
    //         "status" => 1
    //     ];
    //     $penduduk = [
    //         "status" => 'Aktif'
    //     ];

    //     $datapenduduk = array_merge($submit, $penduduk);
    //     $dataverif = array_merge($submit, $verif);

    //     $this->db->insert('penduduk', $datapenduduk);

    //     $this->db->where('id', $id);
    //     $this->db->update('lapor_nik', $dataverif);
    // }
}

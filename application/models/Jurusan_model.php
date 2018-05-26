<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jurusan_model extends CI_Model {

    public function list()
    {
        $query = $this->db->get('jurusan');
        return $query->result();
    }

    public function insert($data = [])
    {
        $result = $this->db->insert('jurusan', $data);
        return $result;
    }

    public function show($id_jurusan)
    {
        $this->db->where('id_jurusan', $id_jurusan);
        $query = $this->db->get('jurusan');
        return $query->row();
    }

    public function update($id_jurusan, $data = [])
    {
        // TODO: set data yang akan di update
        // https://www.codeigniter.com/userguide3/database/query_builder.html#updating-data

        $this->db->where('id_jurusan', $id_jurusan);
        $this->db->update('jurusan', $data);
        return result;
    }

    public function delete($id_jurusan)
    {
        // TODO: tambahkan logic penghapusan data
        $this->db->where('id_jurusan', $id_jurusan);
        $this->db->delete('jurusan');
    }
}
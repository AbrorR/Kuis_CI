<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa_model extends CI_Model {

    public function getTotal($box='',$search='')
    {
        $this->db->select('*');
        $this->db->join('jurusan', 'jurusan.id_jurusan=mahasiswa.id_jurusan');
        
        if ($box != 'null' && $search != 'null')
        { $this->db->like($box, $search); }

        return $this->db->count_all_results('mahasiswa');
    }

    public function list($limit, $start, $box='', $search='')
    {
        $this->db->select('*');
        $this->db->join('jurusan', 'jurusan.id_jurusan=mahasiswa.id_jurusan');
        
        if ($box != 'null' && $search != 'null')
        { $this->db->like($box, $search); }

        $query = $this->db->get('mahasiswa', $limit, $start);
        return ($query->num_rows() > 0) ? $query->result() : false;
        //$query = $this->db->query('select * from mahasiswa join jurusan on mahasiswa.id_jurusan = jurusan.id_jurusan');
        //return $query->result();
    }

    public function insert($data = [])
    {
        $result = $this->db->insert('mahasiswa', $data);
        return $result;
    }

    public function show($nim)
    {
        $this->db->select('*');
        $this->db->from('mahasiswa'); 
        $this->db->join('jurusan', 'mahasiswa.id_jurusan=jurusan.id_jurusan');
        $this->db->where('nim',$nim);     
        $query = $this->db->get();
        return $query->row();
    }

    public function update($nim, $data = [])
    {
        // TODO: set data yang akan di update
        // https://www.codeigniter.com/userguide3/database/query_builder.html#updating-data

        $this->db->where('nim', $nim);
        $this->db->update('mahasiswa', $data);
        return result;
    }
    
    public function delete($nim)
    {
        // TODO: tambahkan logic penghapusan data
        $this->db->where('nim', $nim);
        $this->db->delete('mahasiswa');
    }
}

/* End of file ModelName.php */
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jurusan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Jurusan_model');
    }

    public function index()
    {
        $jurusan = $this->Jurusan_model->list();

        $data = [
                    'title' => 'Pemrograman Web Framework :: Data Jurusan',
                    'jurusan' => $jurusan,
                ];
        $this->load->view('jurusan/index', $data);
    }

    public function create()
    {
        $error = array('error' => ' ' );
        $this->load->view('jurusan/create', $error);
    }

    public function store()
    {
        // Ambil value 
        $jurusan = $this->input->post('jurusan');

        // Validasi Nama dan Jurusan
        $dataval = $jurusan;
        $errorval = $this->validate($dataval);

        // Pesan Error atau Upload
        if ($errorval==false)
        {
            
            // Insert data
            $data = [
                'nama_jurusan' => $jurusan,
                ];
            $result = $this->Jurusan_model->insert($data);
            
            if ($result)
            {
                redirect(jurusan);
            }
            else
            {
                $error = array('error' => 'Gagal');
                $this->load->view('jurusan/create', $error);
            }
        }
        else
        {
            $error = ['error' => validation_errors()];
            $this->load->view('jurusan/create', $error);
        }
    }

    public function edit($id_jurusan,$error='')
    {
      // TODO: tampilkan view edit data
        $jurusan = $this->Jurusan_model->show($id_jurusan);
        $data = [
            'data' => $jurusan,
            'error' => $error
        ];
        $this->load->view('jurusan/edit', $data);
      
    }

    public function update($nim)
    {
        //Ambil Value
        $id_jurusan=$this->input->post('id_jurusan');
        $jurusan = $this->input->post('jurusan');

        // Validasi Nama dan Jurusan
        $dataval = $jurusan;
        $errorval = $this->validate($dataval);

        if ($errorval==false)
        {
            $data = [ 'nama_jurusan' => $this->input->post('jurusan') ];
            $result = $this->Jurusan_model->update($id_jurusan,$data);

            if ($result)
            {
                redirect('jurusan');
            }
            else
            {
                $data = array('error' => 'Gagal');
                $this->load->view('jurusan/edit', $data);
            }
        }
        else
        {
            $error = validation_errors();
            $this->edit($id_jurusan,$error=' ');
        }

        
    }

    public function destroy($id_jurusan)
    {
        $jurusan = $this->Jurusan_model->show($id_jurusan);
        $data = [ 'data' => $jurusan ];
        $this->Jurusan_model->delete($id_jurusan);
        redirect('jurusan');
    }

    public function validate($dataval)
    {
        // Validasi Nama dan Jurusan
        $this->form_validation->set_rules('jurusan','Jurusan','trim|required|callback_alpha_space');

        if (! $this->form_validation->run())
        { return true; }
        else
        { return false; }
    } 

    public function alpha_space($str)
    {
        return ( ! preg_match("/^([a-z ])+$/i", $str)) ? FALSE : TRUE;
    }
}
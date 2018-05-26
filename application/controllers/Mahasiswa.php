<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('pagination');
        $this->load->model('Jurusan_model');
        $this->load->model('Mahasiswa_model');

    }

   /*  public function index()
    {
        $data = [];
        $total = $this->Mahasiswa_model->getTotal();

        if ($total > 0) {
            $limit = 2;
            $start = $this->uri->segment(3, 0);

            $config = [
                'base_url' => base_url() . 'mahasiswa/index',
                'total_rows' => $total,
                'per_page' => $limit,
                'uri_segment' => 3,
            ];
            $this->pagination->initialize($config);

            $data = [
                'results' => $this->Mahasiswa_model->list($limit, $start),
                'links' => $this->pagination->create_links(),
            ];
        }
        /*$mahasiswa = $this->Mahasiswa_model->list();

        $data = [
                    'title' => 'Pemrograman Web Framework :: Data Mahasiswa',
                    'mahasiswa' => $mahasiswa,
                ];
        $this->load->view('mahasiswa/index', $data);
}*/

    public function create($error='')
    {
        $jurusan = $this->Jurusan_model->list();
        $data = [
            'error' => $error,
            'data' => $jurusan
        ];
        $this->load->view('mahasiswa/create', $data);
    }

    public function show($nim)
    {
        $mahasiswa = $this->Mahasiswa_model->show($nim);
        $data = [
            'data' => $mahasiswa
        ];
        $this->load->view('mahasiswa/show', $data);
    }
    
    public function store()
    {
        // Ambil value 
        $nama = $this->input->post('nama');
        $jurusan = $this->input->post('jurusan');
        $alamat = $this->input->post('alamat');

        // Validasi Nama dan Jurusan
        $dataval = $nama;
        $errorval = $this->validate($dataval);

        //tambah data
        $data = [
            'nama' => $nama,
            'id_jurusan' => $jurusan,
            'alamat'   => $alamat
        ];

        $result = $this->Mahasiswa_model->insert($data);

        redirect('mahasiswa');

    }

    public function edit($nim,$error='')
    {
      // TODO: tampilkan view edit data
        $mahasiswa = $this->Mahasiswa_model->show($nim);
        $jurusan = $this->Jurusan_model->list();
        $data = [
            'data' => $mahasiswa,
            'datajab' => $jurusan,
            'error' => $error
        ];
        $this->load->view('mahasiswa/edit', $data);
      
    }

    public function update($nim)
    {
        //Ambil Value
        $nim = $this->input->post('nim');
        $nama = $this->input->post('nama');
        $alamat = $this->input->post('alamat');
        $jurusan = $this->input->post('jurusan');

        // Validasi Nama dan jurusan
        $dataval = [
            'nama' => $nama,
            'jurusan' => $jurusan,
            'alamat'   => $alamat
            ];
        $errorval = $this->validate($dataval);

        $data = [
            'nama' => $nama,
            'id_jurusan' => $jurusan,
            'alamat'   => $alamat
            ];
        $result = $this->Mahasiswa_model->update($nim,$data);

        redirect('mahasiswa');

    }

    public function destroy($nim)
    {
        $mahasiswa = $this->Mahasiswa_model->show($nim);

        $this->Mahasiswa_model->delete($nim);

        redirect('mahasiswa');
    }

    public function validate($dataval)
    {
        // Validasi Nama dan Jurusan
        $rules = [
            [
                'field' => 'nama',
                'label' => 'Nama',
                'rules' => 'trim|required|callback_alpha_space'
            ]
          ];

        $this->form_validation->set_rules($rules);

        if (! $this->form_validation->run())
        { return true; }
        else
        { return false; }
    } 

    public function alpha_space($str)
    {
        return ( ! preg_match("/^([a-z ])+$/i", $str)) ? FALSE : TRUE;
    }

    public function index()
    {
        // Cek kolom combobox
        if($this->uri->segment(3))
        { $box=$this->uri->segment(3); }
        else
        {
            if($this->input->post("jurusan"))
            { $box = $this->input->post("jurusan"); }
            else
            { $box = 'null'; }
        }
        // Cek isi kotak
        if($this->uri->segment(4))
        { $search=$this->uri->segment(4); }
        else
        {
            if($this->input->post("search"))
            { $search = $this->input->post("search"); }
            else
            { $search = 'null'; }
        }
        $data = [];
        $total = $this->Mahasiswa_model->getTotal($box, $search);

        if ($total > 0) {
            $limit = 2;
            $start = $this->uri->segment(5, 0);

            $config = [
                'base_url' => site_url() . '/mahasiswa/index/'.$box.'/'.$search,
                'total_rows' => $total,
                'per_page' => $limit,
                'uri_segment' => 5,

                // Bootstrap 3 Pagination
                'first_link' => '&laquo;',
                'last_link' => '&raquo;',
                'next_link' => 'Next',
                'prev_link' => 'Prev',
                'full_tag_open' => '<ul class="pagination">',
                'full_tag_close' => '</ul>',
                'num_tag_open' => '<li>',
                'num_tag_close' => '</li>',
                'cur_tag_open' => '<li class="active"><span>',
                'cur_tag_close' => '<span class="sr-only">(current)</span></span></li>',
                'next_tag_open' => '<li>',
                'next_tag_close' => '</li>',
                'prev_tag_open' => '<li>',
                'prev_tag_close' => '</li>',
                'first_tag_open' => '<li>',
                'first_tag_close' => '</li>',
                'last_tag_open' => '<li>',
                'last_tag_close' => '</li>',
            ];
            $this->pagination->initialize($config);

            $data = [
                'mahasiswa' => $this->Mahasiswa_model->list($limit, $start, $box, $search),
                'start' => $start,
                'links' => $this->pagination->create_links()
            ];
        }

        $this->load->view('mahasiswa/index', $data);
    }
}

/* End of file Controllername.php */

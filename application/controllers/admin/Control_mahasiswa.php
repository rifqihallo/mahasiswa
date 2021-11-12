<?php defined('BASEPATH') OR exit('NO direct script acces allowed');

class Control_mahasiswa extends CI_Controller{
    public function __construct(){ // method contruck akan dipanggil pertama kali saat controler diakses
        parent::__construct();
        $this->load->model("Modul_mahasiswa");
        $this->load->library('form_validation'); // untuk menvalidasi datainput pada method
    }
    public function index(){
        $data["mahasiswa"] = $this->Modul_mahasiswa->getAll();// ,enga,bil semua data di db_mahasiswa
        $this->load->view("admin/mahasiswa/list", $data); // memanggil view
    }
    public function tambah(){
        $mahasiswa = $this->Modul_mahasiswa; // objek model
        $validation = $this->form_validation; // objek validation
        $validation->set_rules($mahasiswa->rules()); // menerapkan rules

        if ($validation->run()) {
            $mahasiswa->simpan();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }
        $this->load->view("admin/mahasiswa/new_form"); // menampilkan form tambah 
    }

    public function edit($id = null){ //id yang akan di edit kita berikan nilai defaultnya null 
        if (!isset($id)) redirect('admin/mahasiswa'); //akan di redirect ke rute disamping jika id null

        $mahasiswa = $this->Modul_mahasiswa;//object model
        $validation = $this->form_validation;//object validation
        $validation-> set_rules($mahasiswa->rules());//menerapkan rules

        if ($validation->run()){//melakukan validasi
            $mahasiswa->update();//menyimpan data
            $this->session->set_flashdata('success', 'Berhasill di simpan');
        }

        $data["mahasiswa"] = $mahasiswa->getById($id);//mengambil data untuk ditampilkan pada form
        if (!$data["mahasiswa"]) show_404();

        $this->load->view("admin/mahasiswa/edit_form", $data);//menampilkan form edit
    }
    public function hapus($id = null){
        if (!isset($id)) show_404();

        if ($this->Modul_mahasiswa->hapus($id)){
            redirect((site_url('admin/Control_mahasiswa')));
        }
    }

}
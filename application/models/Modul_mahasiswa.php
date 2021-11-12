<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Modul_mahasiswa extends CI_Model{
    private $_table = 'mahasiswa'; // $_tabel adalah nama dari tabel, menggunakan private karena hanya
                                 // akan di akses pada class ini saja

    // nama kolom pada tabel
    public $id_mahasiswa;
    public $nama_mahasiswa;
    public $jurusan_mahasiswa;
    public $alamat_mahasiswa;
    public $foto = "default.jpg";

    public function rules(){ // rules digunakan untuk validasi input data
        return[
            [
                'field' => 'nama_mahasiswa',
                'label' => 'Nama_mahasiswa',
                'rules' => 'required'],
            [
                'field' => 'jurusan_mahasiswa',
                'label' => 'Jurusan_mahasiswa',
                'rules' => 'required'],
            [
                'field' => 'alamat_mahasiswa',
                'label' => 'Alamat_mahasiswa',
                'rules' => 'required'],      

            ];
    }
    public function getAll(){
        return $this->db->get($this->_table)->result(); // untuk mengambil semua data hasil query
    }
    public function getById($id){
        return $this->db->get_where($this->_table,["id_mahasiswa" => $id])->row();// untuk mengambil data berdasarkan id dari hasil query
    }
    public function simpan(){ // untuk menyimpan data
        $post = $this->input->post(); // mengambil data dari form
        $this->id_mahasiswa = uniqid();
         // membuat id unik
        $this->nama_mahasiswa = $post["nama_mahasiswa"]; // isi field nama_mahasiswa
        $this->jurusan_mahasiswa = $post["jurusan_mahasiswa"];
        $this->alamat_mahasiswa = $post["alamat_mahasiswa"];
        $this->db->insert($this->_table, $this); // menyimpan data ke database
    }
    public function update(){ // untuk mengedit data
        $post = $this->input->post(); // mengambil data dari form
        $this->id_mahasiswa = $post["id"]; // isi field id
        $this->nama_mahasiswa = $post["nama_mahasiswa"];
        $this->jurusan_mahasiswa = $post["jurusan_mahasiswa"];
        $this->alamat_mahasiswa = $post["alamat_mahasiswa"];
        $this->db->update($this->_table, $this, array('id_mahasiswa' => $post['id']));// menyimpan data ke database
    }
    public function hapus($id){
        return $this->db->delete($this->_table, array("id_mahasiswa" => $id)); // menghapus data berdasarkan id yang dipilih
    }
} 
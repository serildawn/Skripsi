<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
installation
Controller Login,ErrorPage
Helper userlogin_helper
autoload userlogin
router 

usage 

user_allow([]) : harus login dan dapat diakses semua level
user_allow([1]) : harus login dan hanya dapat di akses oleh level 1
user_allow([1,2]) : harus login dan hanya dapat di akses oleh level 1 dan 2

user_allow([],false) : false di maksud redirect = false, sehingga hanya mengembalikan nilai boolean (digunakan untuk mengatur view)
*/
class Coba extends CI_Controller
{

    public function index()
    {
        // $array = (object)[
        //     'no'=>1,
        //     'nama'=>'farinda',
        //     'alamat'=>'malang'
        // ];

        // echo $array->alamat;

        // for($i=0;$i<=10;$i+=2){
        //     echo $i;
        // }

        // $array = [1,2,3,4,5];

        // for($i=0;$i<3;$i++){
        //     echo $array[$i];
        // }

        // foreach($array as $key=>$value){
        //     echo $value;
        // }

        $db_tabel = $this->db->get('coba')->result();
        // foreach($peramalan_coba as $key=>$value){
        //     echo $value->nama;
        // }

        //load dr view

        // $data = [
        //     'tabel' => $db_tabel,
        //     'judul' => 'halaman tabel coba'
        // ];
        $data['jumlah'] = count($db_tabel);
        $data['tabel'] = $db_tabel;
        $data['judul'] = 'halaman tabel coba';
        
        $this->load->view('coba',$data);
    }

    public function insert()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_message('required', 'Kolom {field} harus diisi');
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

        $this->form_validation->set_rules('nama', 'Nama', 'trim|required|is_unique[bahan.nama]|regex_match[/^([a-z ])+$/i]');
        $this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
        $this->form_validation->set_rules('tgl_lahir', 'tgl_lahir', 'trim|required');
        

        if ($this->form_validation->run() == false) {
            $this->load->view('coba_insert');
        } else {
            $set_biodata = [
                'nama' => $this->input->post('nama'),
                'alamat' => $this->input->post('alamat'),
                'tgl_lahir' => $this->input->post('tgl_lahir'),
            ];

            $this->db->insert('coba', $set_biodata);

            redirect("Coba");
        }
    }
    
}

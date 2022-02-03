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
class Login extends CI_Controller
{

    public function coba()
    {
        

        $db_tabel = $this->db->get('coba')->result();
       
        $data['jumlah'] = count($db_tabel);
        $data['tabel'] = $db_tabel;
        $data['judul'] = 'halaman tabel coba';
        
        $this->load->view('coba',$data);
    }

    public function index()
    {

        if (user_allow([], false)) {
            redirect("Home");
        }


        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Username', 'trim|required|callback_auth_username');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|callback_auth_password');
        if ($this->form_validation->run() == false) {
            $this->load->view('admin/login');
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');


            $data_users = $this->db
                ->where('username', $username)
                ->where('password', md5($password))
                ->get('users')
                ->row(0);

            $session_data = [
                'is_loggedin' => true,
                'id' => $data_users->id_user,
                'nama' => $data_users->nama,
                'username' => $data_users->username,
                'level' => $data_users->level,
                'gambar' => $data_users->gambar
            ];

            $this->session->set_userdata('userlogin', $session_data);
            redirect("Home");
        }
    }

    function auth_username($username)
    {
        $query = $this->db
            ->where('username', $username)
            ->get('users');

        if ($query->num_rows() != 1) {
            $this->form_validation->set_message('auth_username', '{field} belum terdaftar');
            return false;
        }
        return true;
    }

    function auth_password($password)
    {
        $username = $this->input->post('username');
        $query_username = $this->db
            ->where('username', $username)
            ->get('users');

        $query_password = $this->db
            ->where('username', $username)
            ->where('password', md5($password))
            ->get('users');

        if ($query_username->num_rows() == 1) {
            if ($query_password->num_rows() != 1) {
                $this->form_validation->set_message('auth_password', '{field} salah');
                return false;
            }
        }
        return true;
    }


    public function logout()
    {
        $this->session->unset_userdata('userlogin');
        redirect("Login");
    }
}

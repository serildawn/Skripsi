<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Users extends CI_Controller
{

    public function __construct() {
        parent::__construct();
        user_allow([1]);
    }

    public function index()
    {
        $data['users_data'] = $this->db
            ->get('users')
            ->result();
        $this->load->view('admin/users/index', $data);
    }

    public function insert()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nama', 'nama', 'trim|required');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[users.username]|min_length[4]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|matches[repassword]');
        $this->form_validation->set_rules('repassword', 'Re-Password', 'trim|required|min_length[6]');

        if ($this->form_validation->run() == false) {
            $this->load->view('admin/users/insert');
        } else {
            $error = false;
            if ($_FILES['gambar']['name'] != "") {
                $config['upload_path']          = './storage/users/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 2000;
                $config['file_ext_tolower']     = true;
                $config['encrypt_name']         = true;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('gambar')) {
                    $data['error_gambar'] = $this->upload->display_errors('', '');
                    $this->load->view('admin/users/insert', $data);
                    $error = true;
                } else {
                    $gambar = $this->upload->data('file_name');
                }
            }else{
                $gambar = "default.png";
            }

            if(!$error){
                $set_users = [
                    'nama' => $this->input->post('nama'),
                    'username' => $this->input->post('username'),
                    'password' => md5($this->input->post('password')),
                    'level' => $this->input->post('level'),
                ];
                $this->db->insert('users', $set_users);
                $insert_id = $this->db->insert_id();

                
                $set_users = [
                    'gambar' => $gambar
                ];
                $this->db
                    ->where('id_user', $insert_id)
                    ->update('users', $set_users);

                redirect('Users');
            }
            
        }
    }

    public function update($id_users)
    {
        $this->load->library('form_validation');

        $users_data = $this->db
            ->where('id_user', $id_users)
            ->get('users')
            ->row(0);

        $unique_username = "";
        if ($this->input->post('username') != $users_data->username) {
            $unique_username = '|is_unique[users.username]';
        }

        $this->form_validation->set_rules('nama', 'nama', 'trim|required');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]' . $unique_username);

        if ($this->input->post('password') != "") {
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|matches[repassword]');
            $this->form_validation->set_rules('repassword', 'Re-Password', 'trim|required|min_length[6]');
        }

        $this->form_validation->set_rules('gambar', 'gambar', 'callback_upload_gambar[' . $id_users . ']');

        if ($this->form_validation->run() == false) {
            $users_data = $this->db
                ->where('id_user', $id_users)
                ->get('users')
                ->row(0);
            $data['users_data'] = $users_data;
            $this->load->view('admin/users/update', $data);
        } else {
            $set_users = [
                'nama' => $this->input->post('nama'),
                'username' => $this->input->post('username'),

                'level' => $this->input->post('level'),
            ];

            if ($this->input->post('password') != "") {
                $set_users['password'] = md5($this->input->post('password'));
            }
            $this->db
                ->where('id_user', $id_users)
                ->update('users', $set_users);

            redirect('Users');
        }
    }


    function upload_gambar($gambar, $id_users)
    {
        if ($_FILES['gambar']['name'] != "") {
            $config['upload_path']          = './storage/users/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 2000;
            $config['file_ext_tolower']     = true;
            $config['encrypt_name']         = true;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('gambar')) {
                $this->form_validation->set_message('upload_gambar', "{field} : " . $this->upload->display_errors('', ''));
                return false;
            } else {
                $users_data = $this->db
                    ->where('id', $id_users)
                    ->get('users')
                    ->row(0);
                if ($users_data->gambar != 'default.png') {
                    unlink('storage/users/' . $users_data->gambar);
                }

                $set_users = [
                    'gambar' => $this->upload->data('file_name')
                ];
                $this->db
                    ->where('id', $id_users)
                    ->update('users', $set_users);

                $session_data = $this->session->userdata('userlogin');
                $session_data['gambar'] = $this->upload->data('file_name');
                $this->session->set_userdata('userlogin', $session_data);
            }
        }
        return true;
    }

    public function delete($id_users)
    {
        ##unlink gambar
        $users_data = $this->db
            ->where('id_user', $id_users)
            ->get('users')
            ->row(0);
        if ($users_data->gambar != 'default.png') {
            unlink('storage/users/' . $users_data->gambar);
        }

        $this->db
            ->where('id_user', $id_users)
            ->delete('users');

        redirect("Users");
    }
}

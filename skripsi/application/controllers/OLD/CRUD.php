<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
melakukan crud

file terkait
views :
- crud/*
*/

class CRUD extends CI_Controller
{


    public function index()
    {
        $data['users_data'] = $this->db
            ->get('users')
            ->result();
        $this->load->view('crud/index', $data);
    }

    public function insert()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nama', 'nama', 'trim|required');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[users.username]|min_length[8]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|matches[repassword]');
        $this->form_validation->set_rules('repassword', 'Re-Password', 'trim|required|min_length[6]');

        if ($this->form_validation->run() == false) {
            $this->load->view('crud/insert');
        } else {
            $set_users = [
                'nama' => $this->input->post('nama'),
                'username' => $this->input->post('username'),
                'password' => md5($this->input->post('password')),
                'level' => $this->input->post('level'),
            ];
            $this->db->insert('users', $set_users);

            redirect("CRUD");
        }
    }

    public function update($id_users)
    {
        $this->load->library('form_validation');

        $users_data = $this->db
            ->where('id', $id_users)
            ->get('users')
            ->row(0);

        $unique_username = "";
        if ($this->input->post('username') != $users_data->username) {
            $unique_username = '|is_unique[users.username]';
        }

        $this->form_validation->set_rules('nama', 'nama', 'trim|required');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[8]' . $unique_username);

        if ($this->input->post('password') != "") {
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|matches[repassword]');
            $this->form_validation->set_rules('repassword', 'Re-Password', 'trim|required|min_length[6]');
        }

        if ($this->form_validation->run() == false) {
            $users_data = $this->db
                ->where('id', $id_users)
                ->get('users')
                ->row(0);
            $data['users_data'] = $users_data;
            $this->load->view('crud/update', $data);
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
                ->where('id', $id_users)
                ->update('users', $set_users);

            redirect('CRUD');
        }
    }

    public function delete($id_users)
    {
        ##unlink gambar
        $users_data = $this->db
            ->where('id', $id_users)
            ->get('users')
            ->row(0);
        if ($users_data->gambar != 'default.png') {
            unlink('storage/users/' . $users_data->gambar);
        }

        $this->db
            ->where('id', $id_users)
            ->delete('users');

        redirect("CRUD");
    }
}

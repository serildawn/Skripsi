<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Pupuk extends CI_Controller
{

    public function __construct() {
        parent::__construct();
        user_allow([1,2]);
    }

    public function index()
    {
        $data['pupuk_data'] = $this->db
            ->get('pupuk')
            ->result();
        $this->load->view('admin/Pupuk/index', $data);
    }

    public function insert()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_message('required', 'Kolom {field} harus diisi');
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

        $this->form_validation->set_rules('nama_pupuk', 'nama_pupuk', 'trim|required|is_unique[pupuk.nama_pupuk]|regex_match[/^([a-z ])+$/i]');



        if ($this->form_validation->run() == false) {
            $this->load->view('admin/Pupuk/insert');
        } else {
            $set_pupuk = [
                'nama_pupuk' => $this->input->post('nama_pupuk'),
                'warna' => $this->input->post('warna'),

            ];

            $this->db->insert('pupuk', $set_pupuk);

            redirect("Pupuk");
        }
    }

    public function update($id_pupuk)
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nama_pupuk', 'nama_pupuk', 'trim|required');

        if ($this->form_validation->run() == false) {
            $pupuk_data = $this->db
                ->where('id_pupuk', $id_pupuk)
                ->get('pupuk')
                ->row(0);
            $data['pupuk_data'] = $pupuk_data;
            $this->load->view('admin/Pupuk/update', $data);
        } else {
            $set_pupuk = [
                'nama_pupuk' => $this->input->post('nama_pupuk'),
                'warna' => $this->input->post('warna'),

            ];
            $this->db
                ->where('id_pupuk', $id_pupuk)
                ->update('pupuk', $set_pupuk);

            redirect("Pupuk");
        }
    }

    public function delete($id_pupuk)
    {
        $this->db
            ->where('id_pupuk', $id_pupuk)
            ->delete('pupuk');

        redirect("Pupuk");
    }
}

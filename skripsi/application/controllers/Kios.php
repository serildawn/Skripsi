<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Kios extends CI_Controller
{

    public function __construct() {
        parent::__construct();
        user_allow([1,2]);
    }

    public function index()
    {
        $data['kios_data'] = $this->db
            ->get('kios')
            ->result();
        $this->load->view('admin/kios/index', $data);
    }
    public function insert()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_message('required', 'Kolom {field} harus diisi');
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

        $this->form_validation->set_rules('nama_kios', 'nama_kios', 'trim|required|is_unique[kios.nama_kios]|regex_match[/^([a-z ])+$/i]');
        $this->form_validation->set_rules('nama_pemilik', 'nama_pemilik', 'trim|required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
        $this->form_validation->set_rules('no_telp', 'no_telp', 'trim|required');
        $this->form_validation->set_rules('status', 'status', 'trim|required');


        if ($this->form_validation->run() == false) {
            $this->load->view('admin/kios/insert');
        } else {
            $set_kios = [
                'nama_kios' => $this->input->post('nama_kios'),
                'nama_pemilik' => $this->input->post('nama_pemilik'),
                'alamat' => $this->input->post('alamat'),
                'no_telp' => $this->input->post('no_telp'),
                'status' => $this->input->post('status'),

            ];

            $this->db->insert('kios', $set_kios);

            redirect("Kios");
        }
    }

   

    public function update($id_kios)
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nama_kios', 'nama_kios', 'trim|required');
        $this->form_validation->set_rules('nama_pemilik', 'nama_pemilik', 'trim|required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
        $this->form_validation->set_rules('no_telp', 'no_telp', 'trim|required');
        $this->form_validation->set_rules('status', 'status', 'trim|required');

        if ($this->form_validation->run() == false) {
            $kios_data = $this->db
                ->where('id_kios', $id_kios)
                ->get('kios')
                ->row(0);
            $data['kios_data'] = $kios_data;
            $this->load->view('admin/kios/update', $data);
        } else {
            $set_kios = [
                'nama_kios' => $this->input->post('nama_kios'),
                'nama_pemilik' => $this->input->post('nama_pemilik'),
                'alamat' => $this->input->post('alamat'),
                'no_telp' => $this->input->post('no_telp'),
                'status' => $this->input->post('status'),
            ];
            $this->db
                ->where('id_kios', $id_kios)
                ->update('kios', $set_kios);

            redirect("Kios");
        }
    }

    public function delete($id_kios)
    {
        $this->db
            ->where('id_kios', $id_kios)
            ->delete('kios');

        redirect("Kios");
    }
}

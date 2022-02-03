<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Distribusi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        user_allow([1, 2]);
    }


    public function index()
    {
        $data['distribusi_data'] = $this->db
        ->select('*,(SELECT nama_kios FROM kios WHERE id_kios=distribusi.id_kios) AS kios,(SELECT nama_pupuk FROM pupuk WHERE id_pupuk=distribusi.id_pupuk) AS pupuk, (select nama from users where id_user=distribusi.fk_karyawan) as nama_karyawan')
        ->get('distribusi')
        ->result();
        $this->load->view('admin/distribusi/index', $data);
    }

    public function detail($id_distribusi)
    {
        $data['distribusi_data'] = $this->db
        ->select('*,(SELECT nama_kios FROM kios WHERE id_kios=distribusi.id_kios) AS kios,(SELECT nama_pupuk FROM pupuk WHERE id_pupuk=distribusi.id_pupuk) AS pupuk, (select nama from users where id_user=distribusi.fk_karyawan) as nama_karyawan')
            ->where('id_distribusi', $id_distribusi)
            ->get('distribusi')
            ->row(0);

      

        $this->load->view('admin/distribusi/detail', $data);
    }

    public function insert()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('tanggal', 'tanggal', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('admin/distribusi/insert');
        } else {
            $set_penjualan = [
                'tanggal' => date("Y-m-d", strtotime($this->input->post('tanggal'))),
                'fk_karyawan' => $fk_karyawan,
                'id_kios' => $this->input->post('fk_kios'),
                'id_pupuk' => $this->input->post('fk_pupuk'),
                'jumlah' => $this->input->post('jumlah'),
                'supir' => $this->input->post('supir'),
                'nopol' => $this->input->post('nopol'),
            ];
            $set_detail = [
                'id_distribusi' => $id_distribusi,
                'id_kios' => $value['fk_kios'],
                'id_pupuk' => $value['fk_pupuk'],
                'jumlah' => $value['jumlah'],
                'supir' => $value['supir'],
                'nopol' => $value['jumlah']
            ];

           
            

            redirect("Distribusi");
        }

       
    }

   

    public function set_delete($id_distribusi)
    {
        $data_distribusi = $this->db->where('id_distribusi', $id_distribusi)->get('distribusi')->row(0);
        if ($data_distribusi->status == 1) {
            $this->db->where('id_distribusi', $id_distribusi)->delete('distribusi');
            echo "<script>alert('Berhasil melakukan delete')</script>";
            redirect("Distribusi", 'refresh');
        } else {
            echo "<script>alert('Wrong Function')</script>";
            redirect("Distribusi/detail/" . $id_distribusi, 'refresh');
        }
    }

   

  
}

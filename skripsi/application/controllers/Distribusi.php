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
        if (sizeof  ($_POST) >0){
            $arr = array(
                "id_pupuk" => $_POST["fk_pupuk"], 
                "id_kios" => $_POST["id_kios"], 
                "supir" => $_POST["supir"],
                "nopol" => $_POST["nopol"],
                "jumlah" => $_POST["jumlah"],
                "tanggal" => $_POST["tanggal"],
                "fk_karyawan" => $_SESSION["userlogin"]["id"],
            );
            // var_dump ($_POST);
            // die;
            $this->db->insert('distribusi', $arr);

            redirect("Distribusi");

        }
        else{
            $this->load->view('admin/distribusi/insert');
        }
       
           
            
       
        

       
    }

   

    public function set_delete($id_distribusi)
    {
        //  var_dump ($id_distribusi);
        //     die;
        $data_distribusi = $this->db->where('id_distribusi', $id_distribusi)->get('distribusi')->row(0);
        //  var_dump ($data_distribusi);
        //     die;
        if (sizeof  ($data_distribusi) >0) {
            $this->db->where('id_distribusi', $id_distribusi)->delete('distribusi');
            echo "<script>alert('Berhasil melakukan delete')</script>";
            redirect("Distribusi", 'refresh');
        } else {
            echo "<script>alert('Wrong Function')</script>";
            redirect("Distribusi/index/" . $id_distribusi, 'refresh');
        }
    }

   

  
}

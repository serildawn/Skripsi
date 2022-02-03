<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
installation
third_party/dompdf
libraries/Pdfprint.php
*/

class PrintPDF extends CI_Controller
{


    public function index()
    {
        $this->load->library('pdfprint');

        
        $data['users_data'] = $this->db
        ->get('users')
        ->result();

		$html = $this->load->view('pdf/users',$data,true);
		$filename = "hallow";
		$this->pdfprint->generate($html, $filename, true, 'A4', 'portrait');
    }
}
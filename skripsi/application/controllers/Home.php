<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

	public function __construct() {
		parent::__construct();
		if(!user_allow([],false)){
			redirect("Login");
		}
		$this->load->model(['homeModel']);
	}

	public function index()
	{
		$id_kios 			= $this->input->get('kios');

		$kios 			= $this->homeModel->getKios();
		$pupuk 			= $this->homeModel->getPupuk();
		$tahun 			= $this->homeModel->getTahun();

		$chart = [];
		foreach ($pupuk as $p) {
			$per_tahun_arr = [];
			foreach ($tahun as $t) {
				$per_tahun = $this->homeModel->getLaporan($p['id_pupuk'],$t['tahun'],$id_kios);
				$per_tahun = $per_tahun ? $per_tahun['jumlah'] : 0;
				array_push($per_tahun_arr, $per_tahun);
			}

			array_push($chart, [
				'label'				=> $p['nama_pupuk'],
				'backgroundColor'	=> $p['warna'],
				'data'				=> $per_tahun_arr,
			]);
		}

		$data['id_kios'] = $id_kios;
		$data['kios'] 	= $kios;
		$data['tahun'] 	= json_encode(array_column($tahun, 'tahun'));
		$data['chart'] 	= json_encode($chart);

		$this->load->view('admin/home/index', $data);
	}


}
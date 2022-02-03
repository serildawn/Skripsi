<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{

	public function __construct() {
		parent::__construct();
		user_allow([1]);
	}

	public function index()
	{
		$data['laporan_data'] = array();

		$data['laporan_data'] = $this->db
		->select('*,(SELECT nama_kios FROM kios WHERE id_kios=laporan.id_kios) AS kios,(SELECT nama_pupuk FROM pupuk WHERE id_pupuk=laporan.id_pupuk) AS pupuk, (SELECT nama_jenis FROM jenis WHERE id_jenis=laporan.id_jenis) AS jenis')
		->get('laporan')->result();

		$data["kios"] 	= $this->db->get('kios')->result_array();
		$data["pupuk"] 	= $this->db->get('pupuk')->result_array();
		$data["jenis"] 	= $this->db->get('jenis')->result_array();
		$data["tahun"] 	= $this->db->group_by('tahun')->get('laporan')->result_array();
		$data["bulan"] 	= ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];

		$this->load->view('admin/Laporan/index', $data);
	}

	public function insert()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_message('required', 'Kolom {field} harus diisi');
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

		$this->form_validation->set_rules('fk_kios', 'id_kios', 'trim|required');
		$this->form_validation->set_rules('fk_pupuk', 'id_pupuk', 'trim|required');
		$this->form_validation->set_rules('id_jenis', 'id_jenis', 'trim|required');
		$this->form_validation->set_rules('qty', 'qty', 'trim|required');
		$this->form_validation->set_rules('bulan', 'bulan', 'trim|required');
		$this->form_validation->set_rules('tahun', 'tahun', 'trim|required');


		if ($this->form_validation->run() == false) {
			$data["kios"] 	= $this->db->get('kios')->result_array();
			$data["pupuk"] 	= $this->db->get('pupuk')->result_array();
			$data["jenis"] 	= $this->db->get('jenis')->result_array();
			$this->load->view('admin/Laporan/insert', $data);
		} else {
			$bulan = $this->input->post('bulan');
			$tahun = $this->input->post('tahun');
			$set_laporan = [
				'id_kios' => $this->input->post('fk_kios'),
				'id_pupuk' => $this->input->post('fk_pupuk'),
				'id_jenis' => $this->input->post('id_jenis'),
				'qty' => $this->input->post('qty'),
				'bulan' => $bulan,
				'tahun' => $tahun,
				'tanggal' => $tahun.'-'.$this->bulanKe($bulan).'-01 00:00:00'
			];

			$this->db->insert('laporan', $set_laporan);

			redirect("Laporan");
		}
	}


	public function update($id_laporan)
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('fk_kios', 'id_kios', 'trim|required');
		$this->form_validation->set_rules('fk_pupuk', 'id_pupuk', 'trim|required');
		$this->form_validation->set_rules('id_jenis', 'id_jenis', 'trim|required');
		$this->form_validation->set_rules('qty', 'Qty', 'trim|required');
		$this->form_validation->set_rules('bulan', 'Bulan', 'trim|required');
		$this->form_validation->set_rules('tahun', 'Tahun', 'trim|required');

		if ($this->form_validation->run() == false) {
			$laporan_data = $this->db
			->select('*,(SELECT nama_kios FROM kios WHERE id_kios=laporan.id_kios) AS kios,(SELECT nama_pupuk FROM pupuk WHERE id_pupuk=laporan.id_pupuk) AS pupuk')
			->where('id_laporan', $id_laporan)
			->get('laporan')
			->row(0);
			$data['laporan_data'] = $laporan_data;
			$data["kios"] 	= $this->db->get('kios')->result_array();
			$data["pupuk"] 	= $this->db->get('pupuk')->result_array();
			$data["jenis"] 	= $this->db->get('jenis')->result_array();
			$this->load->view('admin/Laporan/update', $data);
		} else {
			$bulan = $this->input->post('bulan');
			$tahun = $this->input->post('tahun');
			$set_laporan = [
				'id_kios' => $this->input->post('fk_kios'),
				'id_pupuk' => $this->input->post('fk_pupuk'),
				'id_jenis' => $this->input->post('id_jenis'),
				'qty' => $this->input->post('qty'),
				'bulan' => $this->input->post('bulan'),
				'tahun' => $this->input->post('tahun'),
				'tanggal' => $tahun.'-'.$this->bulanKe($bulan).'-01 00:00:00'
			];
			$this->db
			->where('id_laporan', $id_laporan)
			->update('laporan', $set_laporan);

			redirect("Laporan");
		}
	}

	public function delete($id_laporan)
	{
		$this->db
		->where('id_laporan', $id_laporan)
		->delete('laporan');

		redirect("Laporan");

	}
	function tampil_laporan()
	{
		$ambil_data['produk1'] = $this->model_data->tampil_data_produk_1($where);
		$ambil_data['produk2'] = $this->model_data->tampil_data_produk_2($where);
		$ambil_data['produk3'] = $this->model_data->tampil_data_produk_3($where);
		$ambil_data['produk4'] = $this->model_data->tampil_data_produk_4($where);
		$ambil_data['produk5'] = $this->model_data->tampil_data_produk_5($where);
		$this->load->view('admin/home', $ambil_data);

		echo "<pre>";
		print_r($ambil_data['produk1']);
		exit;
	}

	function bulanKe($str) {
		if ($str=='Januari') {
			return '01';
		} elseif ($str=='Februari') {
			return '02';
		} elseif ($str=='Maret') {
			return '03';
		} elseif ($str=='April') {
			return '04';
		} elseif ($str=='Mei') {
			return '05';
		} elseif ($str=='Juni') {
			return '06';
		} elseif ($str=='Juli') {
			return '07';
		} elseif ($str=='Agustus') {
			return '08';
		} elseif ($str=='September') {
			return '09';
		} elseif ($str=='Oktober') {
			return '10';
		} elseif ($str=='November') {
			return '11';
		} elseif ($str=='Desember') {
			return '12';
		}
	}

}


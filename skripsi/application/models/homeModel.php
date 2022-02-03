<?php

class homeModel extends CI_Model
{

	public function getKios(){
		return $this->db->get('kios')->result_array();
	}

	public function getPupuk(){
		return $this->db->get('pupuk')->result_array();
	}

	public function getTahun(){
		return $this->db->group_by('tahun')->get('laporan')->result_array();
	}

	public function getLaporan($id_pupuk='',$tahun='', $id_kios=''){
		if ($id_kios!='') {
			$this->db->where('id_kios',$id_kios);
		}
		return $this->db
		->select('*,SUM(qty) as jumlah')
		->join('jenis', 'jenis.id_jenis=laporan.id_jenis','left')
		->where('id_pupuk',$id_pupuk)
		->where('tahun',$tahun)
		->where('jenis.nama_jenis','Pendistribusian')
		->group_by('tahun')
		->get('laporan')->row_array();
	}

}
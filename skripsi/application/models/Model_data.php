<?php
class Model_data extends CI_Model
{
    
    function tampil_data_produk_1()
	{		$sql = "SELECT sum(qty) FROM laporan
					where id_pupuk =  1
					GROUP BY tahun = 2017 ";		
		$query = $this->db->query($sql);
		return $query->result_array();
	}
    function tampil_data_produk_2()
	{		$sql = "SELECT sum(qty) FROM laporan
					where id_pupuk =  2
					GROUP BY tahun = 2017 ";		
		$query = $this->db->query($sql);
		return $query->result_array();
	}
    function tampil_data_produk_3()
	{		$sql = "SELECT sum(qty) FROM laporan
					where id_pupuk =  3
					GROUP BY tahun = 2017 ";		
		$query = $this->db->query($sql);
		return $query->result_array();
	}
    function tampil_data_produk_4()
	{		$sql = "SELECT sum(qty) FROM laporan
					where id_pupuk =  4
					GROUP BY tahun = 2017 ";		
		$query = $this->db->query($sql);
		return $query->result_array();
	}
    function tampil_data_produk_5()
	{		$sql = "SELECT sum(qty) FROM laporan
					where id_pupuk =  5
					GROUP BY tahun = 2017 ";		
		$query = $this->db->query($sql);
		return $query->result_array();
	}
}    
?>
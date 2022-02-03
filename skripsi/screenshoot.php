<?php 
class terserah{
    public function loadDataset()
    {
        $penjualan_data = $this->db
        ->select('year(penjualan.tanggal) tahun,
         month(penjualan.tanggal) bulan,
         sum(penjualan_detail.jumlah) as jumlah')
        ->join('penjualan_detail',
         'penjualan.id=penjualan_detail.fk_penjualan')
        ->group_by('year(tanggal)')
        ->group_by('month(tanggal)')
        ->get('penjualan')
        ->result();
        $data_peramalan = [];
        foreach ($penjualan_data as $key => $value) {
            $data_peramalan[$key] = [
                'tahun' => $value->tahun,
                'bulan' => $value->bulan,
                'jumlah' => $value->jumlah,
            ];
        }
    }

    public function loadVarArima()
    {
        $beta1 = (float) $this->input->post("beta_1");
            $beta2 = (float) $this->input->post("beta_2");


            if ($this->input->post('update_config') == 1) {
                $this->db->where('_key', 'beta1')
                ->update('web_config', ['_value' => $beta1]);
                $this->db->where('_key', 'beta2')
                ->update('web_config', ['_value' => $beta2]);
            }
    }

    public function menampilkanPeramalan($data_peramalan)
    {
        $data_arima =[];


        foreach ($data_peramalan as $key => $value) {

            if ($key == 0) {
                $data_peramalan[$key]['AR1'] = 0;
                $data_peramalan[$key]['ERROR'] = 0;
                $data_peramalan[$key]['MA1'] = 0;
                $data_peramalan[$key]['PE'] = 0;
                continue;
            }
            $data_peramalan[$key]['AR1'] = $data_arima[$key]['AR1'];
            $data_peramalan[$key]['ERROR'] = $data_arima[$key]['ERROR'];
            $data_peramalan[$key]['MA1'] = $data_arima[$key]['MA1'];
            $data_peramalan[$key]['PE'] = $data_arima[$key]['PE'];
        }
    
        
        $data['peramalan_data'] = $data_peramalan;
        $this->load->view('admin/peramalan/index', $data);
    }

    public function loadVarPoq()
    {
            $biaya_pemesanan = $this->input->post('biaya_pemesanan');
            $biaya_penyimpanan = $this->input->post('biaya_penyimpanan');
            $periode = $this->input->post('periode');

            if ($this->input->post('update_config') == 1) {
                $this->db->where('_key', 'biaya_pemesanan')
                     ->update('web_config', ['_value' => $biaya_pemesanan]);
                $this->db->where('_key', 'biaya_penyimpanan')
                     ->update('web_config', ['_value' => $biaya_penyimpanan]);
                $this->db->where('_key', 'periode')
                     ->update('web_config', ['_value' => $periode]);
            }
    }

    public function rumusPoq()
    {
        $data_peramalan =[];
        $biaya_pemesanan =[];
        $biaya_penyimpanan = [];
        $periode =[];

        $data_poq = [];
            foreach ($data_peramalan as $key => $value) {
                $_D = $value['jumlah'];
                $_2DS = 2 * $_D * $biaya_pemesanan;
                $_EOQ = sqrt($_2DS / $biaya_penyimpanan);
                $_R = $_D / $periode;
                $_POQ = $_EOQ / $_R;
                $_Error = (($_D - $_EOQ) / ($_D) / $periode);

                $data_poq[$key] = [
                    'D' => $_D,
                    '2DS' => $_2DS,
                    'EOQ' => $_EOQ,
                    'R' => $_R,
                    'POQ' => $_POQ,
                    'Error' => $_Error
                ];
            }
    }

    public function menampilkanHasilPoq()
    {
        $penjualan_data =[];
        $data_poq =[];
        $data_optimasi =[];

        foreach ($penjualan_data as $key => $value) {

            $data_peramalan[$key]['POQ'] = $data_poq[$key]['POQ'];
        }
        $data['peramalan_data'] = $data_optimasi;
            $this->load->view('admin/optimasi/index', $data);
    }
}




<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Peramalan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        user_allow([1]);
    }


    public function index()
    {
        ini_set('max_execution_time', '300');
        ini_set('memory_limit', '2048M');

        $data["id_kios"] = array();
        $_config = [];
        foreach ($this->db->get("_config")->result() as $value) {
            $_config[$value->_key] = $value->_value;
        }

        $data['config'] = $_config;
        if ($this->input->post('cfg_update') == 'on') {
            $this->db->where('_key', 'beta1')->update('_config', ['_value' => $this->input->post('beta1')]);
            $this->db->where('_key', 'beta2')->update('_config', ['_value' => $this->input->post('beta2')]);
        
        }

        if (isset($_POST["fk_kios"])) {
            $laporan_data = $this->db
                ->select('laporan.id_kios as id_kios, laporan.id_pupuk as id_pupuk,laporan.tahun as tahun, 
            laporan.bulan as bulan,kios.nama_kios as nama_kios, pupuk.nama_pupuk as nama_pupuk, laporan.qty as jumlah')
                ->join('pupuk', 'pupuk.id_pupuk=laporan.id_pupuk')
                ->where('laporan.id_kios', $this->input->post("fk_kios"))
                ->join('kios', 'kios.id_kios=laporan.id_kios')
                ->where('id_jenis', 3)
                ->get('laporan')
                ->result();
                $data["id_kios"] = $this->input->post("fk_kios");
            //$this->db->group_by('laporan.id_kios'); 
            //$this->db->where('laporan.id_kios', $this->input->post("fk_kios"));   
        } else {
            $laporan_data = $this->db
                ->select('laporan.id_kios as id_kios, laporan.id_pupuk as id_pupuk,laporan.tahun as tahun, 
            laporan.bulan as bulan,kios.nama_kios as nama_kios, pupuk.nama_pupuk as nama_pupuk, laporan.qty as jumlah')
                ->join('pupuk', 'pupuk.id_pupuk=laporan.id_pupuk')
                ->join('kios', 'kios.id_kios=laporan.id_kios')
                ->where('id_jenis', 3)
                ->get('laporan')
                ->result();
        }
        # arima
        $beta1 = ($this->input->post('beta1') == "" ? $_config['beta1'] : $this->input->post('beta1'));
        $beta2 = ($this->input->post('beta2') == "" ? $_config['beta2'] : $this->input->post('beta2'));
        $period = ($this->input->post('period') == "" ? date("W") : $this->input->post('period'));

        $data_peramalan = [];

        $data_hasil = [];
        foreach ($laporan_data as $key => $value) {

            $data_peramalan[$value->id_pupuk][] = $value;
        }

        $error_arima = [];


        $chart_data = [];

        foreach ($data_peramalan as $id_pupuk => $dimens1) {
            foreach ($dimens1 as $key_period => $value) {

                if ($key_period == 0) { //ketika index pertama maka nilai pasti 0
                    #arima
                    $data_peramalan[$id_pupuk][$key_period]->ar = 0;
                    $data_peramalan[$id_pupuk][$key_period]->ma = 0;
                    $data_peramalan[$id_pupuk][$key_period]->error = 0;
                    $data_peramalan[$id_pupuk][$key_period]->pe = 0;


                    $data_peramalan[$id_pupuk][$key_period]->rumus_ar = 0;
                    $data_peramalan[$id_pupuk][$key_period]->rumua_ma = 0;
                    $data_peramalan[$id_pupuk][$key_period]->rumus_error = 0;
                    $data_peramalan[$id_pupuk][$key_period]->rumus_pe = 0;




                    $chart_data[$id_pupuk]['label'][] = $value->bulan . " " . $value->tahun;
                    $chart_data[$id_pupuk]['jumlah'][] = $value->jumlah;
                    $chart_data[$id_pupuk]['arima'][] = null;
                } else {        // ketika bukan / tidak sama dengan 0 (index) dimana data sebelumnya, data -1 . key periode = index. jadi key periode -1
                    $data_sebelum = $data_peramalan[$id_pupuk][$key_period - 1];
                    $isi_jml = doubleval($data_sebelum->jumlah); // mengambil  data jumlah sebelumnya
                    $beta1 = doubleval($beta1);
                    $beta2 = doubleval($beta2);
                    $error = doubleval($data_sebelum->error); // error didata sebelumnya
                    $r1 = $isi_jml * $beta1;
                    $r2 = $error * $beta2;
                    $ar = $r1 + $r2;
                    $ma = $isi_jml - $ar;
                    $err = abs($ma);
                    $pe_save = ($isi_jml * 100);
                    #$pe = $err / $pe_save;
                    #var_dump($pe_save);
                    #echo "<br>";
                    if ($value->jumlah == 0) {
                        $value->jumlah = 1;
                    }
                    #arima
                    $_ar = ($data_sebelum->jumlah * $beta1) + ($data_sebelum->error * $beta2);
                    $_ma = $value->jumlah - $_ar;
                    $_error = abs($_ma); 
                    $_pe = abs($_ma) / $value->jumlah;
                
// karna eeror tidak boleh minus, mangkannya di absolute kan

                    $error_arima[] = $_pe;

                    $data_peramalan[$id_pupuk][$key_period]->ar = $_ar;
                    $data_peramalan[$id_pupuk][$key_period]->ma = $_ma;
                    $data_peramalan[$id_pupuk][$key_period]->error = $_error;
                    $data_peramalan[$id_pupuk][$key_period]->pe = $_pe;


                    $data_peramalan[$id_pupuk][$key_period]->rumus_ar = "(" . $data_sebelum->jumlah . " * " . $beta1 . ") + (" . $data_sebelum->error . "*" . $beta2 . ") =" . $_ar;
                    $data_peramalan[$id_pupuk][$key_period]->rumus_ma = $_ar . " - " . $data_peramalan[$id_pupuk][$key_period]->jumlah . " = " . $_ar;
                    $data_peramalan[$id_pupuk][$key_period]->rumus_error = "abs(" . $_error . ") = " . $_error;
                    $data_peramalan[$id_pupuk][$key_period]->rumus_pe = $_error . " / " . $data_peramalan[$id_pupuk][$key_period]->jumlah . " = " . $_pe;



                    $chart_data[$id_pupuk]['jumlah'][] = $value->jumlah;
                    $chart_data[$id_pupuk]['arima'][] = $_ar;
                }
            }
            
            do { 
                // echo $key_period;
                // echo'<br><br>';
               $key_period++;
                
                $data_sebelum = $data_peramalan[$id_pupuk][$key_period - 1];
                $bulan = $data_sebelum->bulan;
                // echo $bulan;
                // echo'<br><br>';
                $bulan++;


                $tahun = $data_sebelum->tahun;
                // echo $tahun;
                // echo'<br><br>';

               

                if ($bulan >= date("W", strtotime('28th December ' . $data_sebelum->tahun))) {

                    $bulan = 1;
                    $tahun = $tahun + 1;
                }

                if ($bulan > $period) {
                    break;
                }

                #menyimpan data peramalan
                $data_peramalan[$id_pupuk][$key_period] = new stdClass;

                $data_peramalan[$id_pupuk][$key_period]->id_kios = $data_sebelum->id_kios;
                $data_peramalan[$id_pupuk][$key_period]->id_pupuk = $data_sebelum->id_pupuk;
                $data_peramalan[$id_pupuk][$key_period]->bulan = $bulan;
                $data_peramalan[$id_pupuk][$key_period]->tahun = $tahun;
                $data_peramalan[$id_pupuk][$key_period]->nama_kios = $data_sebelum->nama_kios;
                $data_peramalan[$id_pupuk][$key_period]->nama_pupuk = $data_sebelum->nama_pupuk;
                $data_peramalan[$id_pupuk][$key_period]->jumlah = $data_sebelum->jumlah;

                // data pada priode ke n
                $_ar = ($data_sebelum->jumlah * $beta1) + ($data_sebelum->error * $beta2);
                // var_dump ($data_sebelum->jumlah);
                // echo'<br><br>';
                // var_dump (  $data_peramalan[$id_pupuk][$key_period]);
                // echo'<br><br>';
                $_ma = $data_peramalan[$id_pupuk][$key_period]->jumlah - $_ar;
                $_error = abs($_ma);

                if ($data_peramalan[$id_pupuk][$key_period]->jumlah != 0) {
                    $_pe = abs($_ma) / $data_peramalan[$id_pupuk][$key_period]->jumlah;
                } else {
                    $_pe = 0;
                }

                #arima
                $data_peramalan[$id_pupuk][$key_period]->ar = $_ar;
                $data_peramalan[$id_pupuk][$key_period]->ma = $_ma;
                $data_peramalan[$id_pupuk][$key_period]->error = $_error;
                $data_peramalan[$id_pupuk][$key_period]->pe = $_pe;


                $data_peramalan[$id_pupuk][$key_period]->rumus_ar = "(" . $data_sebelum->jumlah . " * " . $beta1 . ") + (" . $data_sebelum->error . "*" . $beta2 . ") =" . $_ar;
                $data_peramalan[$id_pupuk][$key_period]->rumus_ma = $_ar . " - " . $data_peramalan[$id_pupuk][$key_period]->jumlah . " = " . $_ma;
                $data_peramalan[$id_pupuk][$key_period]->rumus_error = "abs(" . $_ma . ") = " . $_error;
                $data_peramalan[$id_pupuk][$key_period]->rumus_pe = $_error . " / " . $data_peramalan[$id_pupuk][$key_period]->jumlah . " = " . $_pe;


                $chart_data[$id_pupuk]['label'][] = $bulan . " " . $tahun;
                $chart_data[$id_pupuk]['jumlah'][] = null;
            //    echo $_ar ;
            //    echo '<br>';
                $chart_data[$id_pupuk]['arima'][] = $_ar;
            } while ($bulan < $period);
        }
     
                // die;

        foreach ($data_peramalan as $id_pupuk => $dimens1) {
            foreach ($dimens1 as $key_period => $value) {
                if ($value->bulan == $period) {
                    $data_hasil[$id_pupuk] = $value;
                }
            }
        }
        #menghitung avg error
        if (count($error_arima) != 0) {
            $data['data_avg_error'] = [
                'arima' => array_sum($error_arima) / count($error_arima) * 100,

            ];
        }
        // var_dump ($data_hasil);
        // die;

        $data['data_hasil'] = $data_hasil;
        $data['chart_data'] = $chart_data;
        $data['data_peramalan'] = $data_peramalan;
        $this->load->view('admin/peramalan/index', $data);
    }
}

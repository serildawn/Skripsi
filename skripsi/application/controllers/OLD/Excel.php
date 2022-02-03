<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
melakukan crud dengan file upload

controller ini hanya pengganti untuk controller CRUD

instalation
third_party/PHPExcel
third_party/PHPExcel.php
libraries/ExcelReader.php

directory
storage/excel_tmp untuk menyimpan excel yang di upload
storage/format untuk menyimpan excel yang digunakan acuan untuk melakukan export / write excel
*/

class Excel extends CI_Controller
{
    public function index()
    {
        $path    = './storage/excel_tmp';
        $files = scandir($path);
        $files = array_diff(scandir($path), array('.', '..'));

        if (($key = array_search('index.html', $files)) !== false) {
            unset($files[$key]);
        }

        $files = array_values($files);

        $data['excel_tmp'] = $files;
        $this->load->view('excel/index', $data);
    }

    public function read($file_name)
    {
        $this->load->library('excelreader');

        $file_name = str_replace("%20", " ", $file_name);
        echo $file_name;

        $inputFileName = './storage/excel_tmp/' . $file_name;
        $inputFileType = 'xls';
        $is_error = false;
        try {
            $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);
        } catch (Exception $e) {
            $is_error = true;
            $data['error_info'] = 'Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage();
        }

        if (!$is_error) {
            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();
            $fetch_excel = $sheet->rangeToArray('A4:' . 'C' . $highestRow, NULL, TRUE, FALSE);

            $data_excel = [];
            foreach ($fetch_excel as $key => $value) {
                $data_excel[] = [
                    'no' => $value['0'],
                    'tanggal' => $this->excelreader->excelDateConvert('d M Y', $value['1']),
                    'data' => $value['2'],
                ];
            }
            dd($data_excel);
        } else {
            echo $data['error_info'];
        }
    }

    public function write()
    {
        $this->load->library('excelreader');

        //choose format
        $inputFileName = './storage/format/export_users.xlsx';
        $inputFileType = 'xls';
        $is_error = false;
        try {
            $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);
        } catch (Exception $e) {
            $is_error = true;
            $data['error_info'] = 'Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage();
        }

        if (!$is_error) {
            $sheet = $objPHPExcel->getSheet(0);

            $users_data = $this->db
                ->get('users')
                ->result();

            $row = 4;
            foreach ($users_data as $key => $value) {
                $sheet->setCellValueByColumnAndRow(0, $row, ($key + 1));
                $sheet->setCellValueByColumnAndRow(1, $row, $value->nama);
                $sheet->setCellValueByColumnAndRow(2, $row, $value->username);

                $row++;
            }

            #style 
            $column = PHPExcel_Cell::stringFromColumnIndex(2);
            $row = $row-1;
            $end_cell = $column . $row;

            $allborder = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
					)
				)
            );
            
            $sheet->getStyle('A4:'.$end_cell)->applyFromArray($allborder);
            
            
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            header('Content-type: application/vnd.ms-excel');
            header('Content-Disposition: attachment; filename="halo.xlsx"');
            $objWriter->save('php://output');
        } else {
            echo $data['error_info'];
        }
    }

    public function upload()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('excel', 'excel', 'trim');
        if ($this->form_validation->run() == false) {
            $this->load->view('excel/upload');
        } else {
            $config['upload_path']          = './storage/excel_tmp/';
            $config['allowed_types']        = 'xls|xlsx';
            $config['max_size']             = 2000;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('excel')) {
                echo $this->upload->display_errors('', '');
            } else {
                echo $this->upload->data('file_name');
            }
        }
    }
}

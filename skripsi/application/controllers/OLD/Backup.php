<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
melakukan backup database dan restore database.

file terkait
views :
- backup/index.php

*/
class Backup extends CI_Controller
{

    public function index()
    {
        $path    = './storage/backup';
        $files = scandir($path);
        $files = array_diff(scandir($path), array('.', '..'));

        if (($key = array_search('index.html', $files)) !== false) {
            unset($files[$key]);
        }

        $files = array_values($files);

        $data['backup_tmp'] = $files;
        $this->load->view('backup/index', $data);
    }

    public function backupdb()
    {
        $this->load->dbutil();

        $prefs = array(
            'tables'        => array('users'),              // Array of tables to backup.
            'ignore'        => array(),                     // List of tables to omit from the backup
            'format'        => 'txt',                       // gzip, zip, txt
            'filename'      => 'mybackup.sql',              // File name - NEEDED ONLY WITH ZIP FILES
            'add_drop'      => TRUE,                        // Whether to add DROP TABLE statements to backup file
            'add_insert'    => TRUE,                        // Whether to add INSERT data to backup file
            'newline'       => "\n"                         // Newline character used in backup file
        );

        $backup = $this->dbutil->backup($prefs);

        $this->load->helper('file');
        write_file('./storage/backup/mybackup'.date("Y-m-d-H-i-s").'.sql', $backup); //menyimpan file backup ke server


        $this->load->helper('download');
        //force_download('mybackup.sql', $backup); //menyimpan file backup ke perangkat

        echo "backuped at /storage/backup/";
    }

    

    function restoredb($file_name)
    {
        $file_name = str_replace("%20", " ", $file_name);

        $isi_file = file_get_contents('./storage/backup/'.$file_name);
        $string_query = rtrim($isi_file, '\n;');
        $array_query = explode(';', $string_query);
        foreach ($array_query as $query) {
            $trim_query = trim($query);
            if($trim_query != ""){
                $this->db->query($trim_query);
            }
        }

        echo "restored";
    }
}

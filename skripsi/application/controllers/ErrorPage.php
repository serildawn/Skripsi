<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
digunakan untuk mengalihkan halaman

401 need authentication : harus login terlebih dahulu jika ingin akses
403 need authorization : harus memiliki akses jika ingin mengakses halaman
404 tidak ada halaman

*/
class ErrorPage extends CI_Controller
{

    public function error401()
    {
        echo "<script>alert('Login terlebih dahulu')</script>";
        redirect("Login", 'refresh');
    }
    public function error403()
    {
        echo "<script>alert('Halaman tidak dapat diakses kembali ke home')</script>";
        redirect("Home", 'refresh');
    }

    public function error404()
    {
        echo "<script>alert('Halaman tidak ada kembali ke home')</script>";
        redirect("Home", 'refresh');
    }
}

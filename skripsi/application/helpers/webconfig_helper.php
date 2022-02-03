<?php 
function web_config($key)
{
    $CI =& get_instance();

    return $CI->db->where('_key',$key)->get('web_config')->row(0)->_value;
}

/*
by Aldhan :D 
hapus kalau sudah tidak digunakan
pastikan terlebih dahulu helper ngoding 
tidak ada pada autoload yang berada 
pada config/autoload section helper
*/

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Uploads extends CI_Controller{
    function index($archivo){
        //visualizar el archiv en uploads
        $this->load->helper('download');
        $data = file_get_contents(base_url()."uploads/".$archivo);
        $name = $archivo;
        force_download($name, $data);

    }
}

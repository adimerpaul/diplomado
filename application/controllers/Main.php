<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller{
     function index(){
         if ($_SESSION['idusuario']==""){
             header('Location: '.base_url());
         }
         $data['title']='Main';
         $this->load->View('templates/header',$data);
       $this->load->View('main',$data);
       $data['js']="";
         $this->load->View('templates/footer',$data);
     }
}
<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Simpan extends CI_Controller
{
    private $page = "Simpan/";
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    public function index()
    {
        $data = [
            "title" => "Setting",
            "page" => $this->page . "index",
            "script" => $this->page . "script",
            // "result" => ,
        ];
        $this->load->view('Router/route', $data);
    }
}

<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function index()
    {
        $Q = $this->Query_model->all('users');
        $data = [
            "title" => "Nasabah",
            "page" => "Home/index",
            "script" => "Home/script",
            "counting" => $this->countung()
        ];
        $this->load->view('Router/route', $data);
    }
    public function countung()
    {
        $d = [
            "sekolah" => $this->db->get_where("sekolah")->num_rows(),
            "nasabah" => $this->db->get_where("nasabah")->num_rows(),
            "peminjaman" => $this->db->get_where("pinjaman")->num_rows(),
        ];
        return $d;
    }
}

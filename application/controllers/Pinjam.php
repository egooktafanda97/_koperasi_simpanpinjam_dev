<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pinjam extends CI_Controller
{
    private $page = "Pinjam/";
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
            "sekolah" => $this->db->get("sekolah")->result_array()
            // "result" => ,
        ];
        $this->load->view('Router/route', $data);
    }
    public function created()
    {
        $post = $_POST;
        $up = up("surat_permohonan", "assets/surat/");
        if ($up) {
            $surat = $up;
        } else {
            $this->session->set_flashdata('error', 'gagal di gambar tidak ada / tidak valid');
            redirect('Pinjam');
        }
        $data = [
            "id_sekolah" => $post['id_sekolah'],
            "id_nasabah" => $post['id_nasabah'],
            "jumlah_pinjam" => rupiah_to_number($post['jumlah_pinjam']),
            "bunga" => rupiah_to_number($post['bunga']),
            "jumlah_bunga" => rupiah_to_number($post['jumlah_bunga']),
            "admin" => rupiah_to_number($post['admin']),
            "jumlah_tagihan_bulanan" => rupiah_to_number($post['jumlah_tagihan_bulanan']),
            "lama_pinjam" => $post['lama_pinjam'],
            "bulan_pembayaran" => $post['bulan_pembayaran'],
            "total" => rupiah_to_number($post['total']),
            "sisa_pinjam" => rupiah_to_number($post['total']),
            "surat_permohonan" => $surat,
            "tanggal_pinjam" => date("Y-m-d"),
            "waktu_pinjam" => date("H:i:s"),
        ];

        $save = $this->db->insert('pinjaman', $data);
        if ($save) {
            $this->session->set_flashdata('success', 'berhasil ditambahkan');
            redirect('Pinjam');
        } else {
            $this->session->set_flashdata('error', 'gagal di inputkan');
            redirect('Pinjam');
        }
    }
}

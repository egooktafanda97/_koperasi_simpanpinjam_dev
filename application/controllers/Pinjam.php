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
            "sekolah" => $this->db->get("sekolah")->result_array(),
            "result" => $this->getAllData(),
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
            "status_pinjaman" => true
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
    public function Updated($id_pinjaman)
    {
        $post = $_POST;

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
            "tanggal_pinjam" => date("Y-m-d"),
            "waktu_pinjam" => date("H:i:s"),
        ];

        $up = up("surat_permohonan", "assets/surat/");
        if ($up) {
            $data += ["surat_permohonan" => $up];
        }

        $save = $this->db->update('pinjaman', $data, ["id_pinjaman" => $id_pinjaman]);
        if ($save) {
            $this->session->set_flashdata('success', 'berhasil ditambahkan');
            redirect('Pinjam');
        } else {
            $this->session->set_flashdata('error', 'gagal di inputkan');
            redirect('Pinjam');
        }
    }
    public function getAllData()
    {

        $this->db->join("sekolah", "sekolah.id_sekolah = pinjaman.id_sekolah");
        $this->db->join("nasabah", "nasabah.id_nasabah = pinjaman.id_nasabah");
        $this->db->order_by("id_pinjaman", "DESC");
        $gets = $this->db->get_where("pinjaman")->result_array();
        return $gets;
    }
    public function getById($id)
    {

        $this->db->join("sekolah", "sekolah.id_sekolah = pinjaman.id_sekolah");
        $this->db->join("nasabah", "nasabah.id_nasabah = pinjaman.id_nasabah");
        $this->db->where("pinjaman.id_pinjaman", $id);
        $gets = $this->db->get_where("pinjaman")->row_array();
        dump($gets);
    }
    public function Pembayaran()
    {
        $data = [
            "title" => "Setting",
            "page" => $this->page . "pembayaran",
            "script" => $this->page . "script",
            "sekolah" => $this->db->get("sekolah")->result_array(),
            "result" => $this->getAllData(),
            "pinjaman" => $this->nasabah_pinjaman(),
            "tagihan" => $this->tagihan_pinjaman()

        ];
        $this->load->view('Router/route', $data);
    }
    public function nasabah_pinjaman()
    {
        $this->db->join("sekolah", "sekolah.id_sekolah = pinjaman.id_sekolah");
        $this->db->join("nasabah", "nasabah.id_nasabah = pinjaman.id_nasabah");
        $this->db->order_by("pinjaman.id_pinjaman", "DESC");
        $this->db->where("pinjaman.status_pinjaman", true);
        $get = $this->db->get_where("pinjaman")->result_array();
        return $get;
    }
    public function tagihan_pinjaman()
    {
        $this->db->order_by("id_tagihan", "DESC");
        $this->db->join("nasabah", "nasabah.id_nasabah = tagihan_pinjaman.id_nasabah");
        $result = $this->db->get_where("tagihan_pinjaman")->result_array();
        return $result;
    }

}

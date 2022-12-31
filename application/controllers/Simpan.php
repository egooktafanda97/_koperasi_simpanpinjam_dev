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
        $this->load->library('pagination');
        // library pagination
        $config['total_rows'] = $this->countAllData();
        $config['per_page'] = 10;
        $config['base_url'] = base_url("Simpan/index/");
        // stylingPage
        $config['full_tag_open'] = '<nav><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav>';

        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';

        $config['attributes'] = array('class' => 'page-link');

        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment(3);

        $all_data = $this->getAllData($config['per_page'], $data['start']);
        $data_nasasbah = $this->getNasabah();
        $data = [
            "title" => "Simpan",
            "page" => $this->page . "index",
            "script" => $this->page . "script",
            "result" =>  $all_data,
            "nasabah" =>  $data_nasasbah,
        ];
        $this->load->view('Router/route', $data);
    }

    public function getAllData($limit, $start)
    {
        $this->db->order_by("id_simpan ", "DESC");
        $this->db->limit($limit, $start);
        $this->db->join("nasabah", "nasabah.id_nasabah = simpan.id_nasabah");
        $result = $this->db->get_where("simpan")->result_array();
        return $result;
    }
    public function dataSimpanById($id)
    {
        $this->db->join("nasabah", "nasabah.id_nasabah  = simpan.id_nasabah ");
        $this->db->where("simpan.id_simpan", $id);
        $result = $this->db->get_where("simpan")->row_array();

        return $result;
    }
    public function getNasabah()
    {
        $this->db->order_by("id_nasabah", "DESC");
        $result = $this->db->get_where("nasabah")->result_array();
        return $result;
    }
    public function countAllData()
    {
        return $this->db->get_where("simpan")->num_rows();
    }

    public function created()
    {
        $this->form_validation->set_rules('id_nasabah', 'id_nasabah', 'required');
        $this->form_validation->set_rules('saldo_awal', 'saldo_awal', 'required');
        $this->form_validation->set_rules('jumlah_simpan', 'jumlah_simpan', 'required');
        $this->form_validation->set_rules('saldo', 'saldo', 'required');
        $this->form_validation->set_rules('biaya_admin', 'biaya_admin', 'required');
        $this->form_validation->set_rules('tanggal', 'tanggal', 'required');
        $this->form_validation->set_rules('jam', 'jam', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'gagal ditambahkan');
            redirect('simpan');
        } else {
            try {
                $post = $this->input->post();
                $data  = [
                    "id_nasabah" => $post['id_nasabah'],
                    "saldo_awal" => $post['saldo_awal'],
                    "jumlah_simpan" => $post['jumlah_simpan'],
                    "saldo" => $post['saldo'],
                    "biaya_admin" => $post['biaya_admin'],
                    "tanggal" => $post['tanggal'],
                    "jam" => $post['jam']
                ];

                $save = $this->db->insert('simpan', $data);
                if ($save) {
                    $this->session->set_flashdata('success', 'berhasil ditambahkan');
                    redirect('simpan');
                } else {
                    $this->session->set_flashdata('error', 'gagal di inputkan');
                    redirect('simpan');
                }
            } catch (\Throwable $th) {
                $this->session->set_flashdata('error', 'gagal ditambahkan');
                redirect('simpan');
            }
        }
    }

    public function deleted($id_simpan)
    {
        $this->db->where('id_simpan', $id_simpan);
        $this->db->delete('simpan');

        $this->session->set_flashdata('success', 'data berhasil dihapus');
        redirect('simpan');
    }

    public function getById($id_simpan)
    {

        $getData = $this->db->get_where('simpan', ['id_simpan' => $id_simpan])->row_array();
        echo json_encode($getData);
    }

    public function update($id)
    {

        $this->form_validation->set_rules('id_nasabah', 'id_nasabah', 'required');
        $this->form_validation->set_rules('saldo_awal', 'saldo_awal', 'required');
        $this->form_validation->set_rules('jumlah_simpan', 'jumlah_simpan', 'required');
        $this->form_validation->set_rules('saldo', 'saldo', 'required');
        $this->form_validation->set_rules('biaya_admin', 'biaya_admin', 'required');
        $this->form_validation->set_rules('tanggal', 'tanggal', 'required');
        $this->form_validation->set_rules('jam', 'jam', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'data tidak di ubah');
            redirect('simpan');
        } else {
            try {
                $post = $this->input->post();
                $data  = [
                    "id_nasabah" => $post['id_nasabah'],
                    "saldo_awal" => $post['saldo_awal'],
                    "jumlah_simpan" => $post['jumlah_simpan'],
                    "saldo" => $post['saldo'],
                    "biaya_admin" => $post['biaya_admin'],
                    "tanggal" => $post['tanggal'],
                    "jam" => $post['jam']
                ];
                $this->db->where('id_simpan', $id);
                $save = $this->db->update('simpan', $data);
                if ($save) {
                    $this->session->set_flashdata('success', 'berhasil di ubah');
                    redirect('simpan');
                } else {
                    $this->session->set_flashdata('error', 'gagal di ubah');
                    redirect('simpan');
                }
            } catch (\Throwable $th) {
                $this->session->set_flashdata('error', 'kesalahan');
                redirect('simpan');
            }
        }
    }

    public function detail($id_simpan)
    {

        $dataId =  $this->db->get_where('simpan', ['id_simpan' => $id_simpan])->row_array();
        $data = array(
            'title' => "Detail Data",
            'page' => $this->page . "detail",
            'script' => $this->page . "script",
            'val' => $this->dataSimpanById($id_simpan),
        );
        $this->load->view('Router/route', $data);
    }
}

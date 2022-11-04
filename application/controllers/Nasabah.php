<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Nasabah extends CI_Controller
{
    private $page = "Nasabah/";
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
        $config['per_page'] = 1;
        $config['base_url'] = base_url("Nasabah/index/");
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
        $data = [
            "title" => "Nasabah",
            "page" => $this->page . "index",
            "script" => $this->page . "script",
            "sekolah" => $this->db->get_where("sekolah")->result_array(),
            "result" =>  $all_data,
        ];
        $this->load->view('Router/route', $data);
    }

    public function getAllData($limit, $start)
    {
        $this->db->join("sekolah", "sekolah.id_sekolah = nasabah.id_sekolah");
        $this->db->order_by("id_nasabah", "DESC");
        $this->db->limit($limit, $start);
        $result = $this->db->get_where("nasabah")->result_array();
        return $result;
    }

    public function countAllData()
    {
        return $this->db->get_where("nasabah")->num_rows();
    }

    public function created()
    {
        $this->form_validation->set_rules('nip', 'nip', 'required');
        $this->form_validation->set_rules('nik', 'nik', 'required');
        $this->form_validation->set_rules('nama', ' nama', 'required');
        $this->form_validation->set_rules('jabatan', 'jabatan', 'required');
        $this->form_validation->set_rules('saldo', 'saldo', 'required');
        $this->form_validation->set_rules('alamat', 'alamat', 'required');
        $this->form_validation->set_rules('tanggal_masuk', 'tanggal_masuk', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'gagal ditambahkan');
            redirect('nasabah');
        } else {
            try {
                $post = $this->input->post();
                $data  = [
                    "id_sekolah" => $post['id_sekolah'],
                    "nip" => $post['nip'],
                    "nik" => $post['nik'],
                    "nama" => $post['nama'],
                    "jabatan" => $post['jabatan'],
                    "saldo" => $post['saldo'],
                    "alamat" => $post['alamat'],
                    "tanggal_masuk" => $post['tanggal_masuk']
                ];

                $save = $this->db->insert('nasabah', $data);
                if ($save) {
                    $this->session->set_flashdata('success', 'berhasil ditambahkan');
                    redirect('nasabah');
                } else {
                    $this->session->set_flashdata('error', 'gagal di inputkan');
                    redirect('nasabah');
                }
            } catch (\Throwable $th) {
                $this->session->set_flashdata('error', 'gagal ditambahkan');
                redirect('nasabah');
            }
        }
    }

    public function deleted($id_nasabah)
    {
        $this->db->where('id_nasabah', $id_nasabah);
        $this->db->delete('nasabah');

        $this->session->set_flashdata('success', 'data berhasil dihapus');
        redirect('nasabah');
    }

    public function getById($id_nasabah)
    {

        $getData = $this->db->get_where('nasabah', ['id_nasabah' => $id_nasabah])->row_array();
        echo json_encode($getData);
    }
    public function getBySekolah($id_sekolah)
    {

        $getData = $this->db->get_where('nasabah', ['id_sekolah' => $id_sekolah])->result_array();
        echo json_encode($getData);
    }

    public function update($id)
    {

        $this->form_validation->set_rules('nip', 'nip', 'required');
        $this->form_validation->set_rules('nik', 'nik', 'required');
        $this->form_validation->set_rules('nama', ' nama', 'required');
        $this->form_validation->set_rules('jabatan', 'jabatan', 'required');
        $this->form_validation->set_rules('saldo', 'saldo', 'required');
        $this->form_validation->set_rules('alamat', 'alamat', 'required');
        $this->form_validation->set_rules('tanggal_masuk', 'tanggal_masuk', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'data tidak di ubah');
            redirect('nasabah');
        } else {
            try {
                $post = $this->input->post();
                $data  = [
                    "nip" => $post['nip'],
                    "nik" => $post['nik'],
                    "nama" => $post['nama'],
                    "jabatan" => $post['jabatan'],
                    "saldo" => $post['saldo'],
                    "alamat" => $post['alamat'],
                    "tanggal_masuk" => $post['tanggal_masuk']
                ];
                $this->db->where('id_nasabah', $id);
                $save = $this->db->update('nasabah', $data);
                if ($save) {
                    $this->session->set_flashdata('success', 'berhasil di ubah');
                    redirect('nasabah');
                } else {
                    $this->session->set_flashdata('error', 'gagal di ubah');
                    redirect('nasabah');
                }
            } catch (\Throwable $th) {
                $this->session->set_flashdata('error', 'kesalahan');
                redirect('nasabah');
            }
        }
    }

    public function detail($id_nasabah)
    {

        $dataId =  $this->db->get_where('nasabah', ['id_nasabah' => $id_nasabah])->row_array();
        $data = array(
            'title' => "Detail Data",
            'page' => $this->page . "detail",
            'script' => $this->page . "script",
            'val' => $dataId
        );
        $this->load->view('Router/route', $data);
    }
}

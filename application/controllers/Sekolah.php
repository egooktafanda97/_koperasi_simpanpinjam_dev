<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Sekolah extends CI_Controller
{
    private $page = "Sekolah/";
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
        $config['base_url'] = base_url("Sekolah/index/");
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
            "title" => "Sekolah",
            "page" => $this->page . "index",
            "script" => $this->page . "script",
            "result" =>  $all_data,
        ];
        $this->load->view('Router/route', $data);
    }

    public function getAllData($limit, $start)
    {
        $this->db->order_by("id_sekolah", "DESC");
        $this->db->limit($limit, $start);
        $result = $this->db->get_where("sekolah")->result_array();
        return $result;
    }
    public function countAllData()
    {
        return $this->db->get_where("sekolah")->num_rows();
    }

    public function created()
    {
        $this->form_validation->set_rules('nama_sekolah', 'nama_sekolah', 'required');
        $this->form_validation->set_rules('jenjang', 'jenjang', 'required');
        $this->form_validation->set_rules('alamat', 'alamat', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'gagal ditambahkan');
            redirect('sekolah');
        } else {
            try {
                $post = $this->input->post();
                $data  = [
                    "nama_sekolah" => $post['nama_sekolah'],
                    "jenjang" => $post['jenjang'],
                    "alamat" => $post['alamat']
                ];

                $save = $this->db->insert('sekolah', $data);
                if ($save) {
                    $this->session->set_flashdata('success', 'berhasil ditambahkan');
                    redirect('sekolah');
                } else {
                    $this->session->set_flashdata('error', 'gagal di inputkan');
                    redirect('sekolah');
                }
            } catch (\Throwable $th) {
                $this->session->set_flashdata('error', 'gagal ditambahkan');
                redirect('sekolah');
            }
        }
    }

    public function deleted($id_sekolah)
    {
        $this->db->where('id_sekolah', $id_sekolah);
        $this->db->delete('sekolah');

        $this->session->set_flashdata('success', 'data berhasil dihapus');
        redirect('sekolah');
    }

    public function getById($id_sekolah)
    {

        $getData = $this->db->get_where('sekolah', ['id_sekolah' => $id_sekolah])->row_array();
        echo json_encode($getData);
    }

    public function update($id)
    {

        $this->form_validation->set_rules('nama_sekolah', 'nama_sekolah', 'required');
        $this->form_validation->set_rules('jenjang', 'jenjang', 'required');
        $this->form_validation->set_rules('alamat', 'alamat', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'data tidak di ubah');
            redirect('sekolah');
        } else {
            try {
                $post = $this->input->post();
                $data  = [
                    "nama_sekolah" => $post['nama_sekolah'],
                    "jenjang" => $post['jenjang'],
                    "alamat" => $post['alamat']
                ];
                $this->db->where('id_sekolah', $id);
                $save = $this->db->update('sekolah', $data);
                if ($save) {
                    $this->session->set_flashdata('success', 'berhasil di ubah');
                    redirect('sekolah');
                } else {
                    $this->session->set_flashdata('error', 'gagal di ubah');
                    redirect('sekolah');
                }
            } catch (\Throwable $th) {
                $this->session->set_flashdata('error', 'kesalahan');
                redirect('sekolah');
            }
        }
    }

    public function detail($id_sekolah)
    {

        $dataId =  $this->db->get_where('sekolah', ['id_sekolah' => $id_sekolah])->row_array();
        $data = array(
            'title' => "Detail Data",
            'page' => $this->page . "detail",
            'script' => $this->page . "script",
            'val' => $dataId
        );
        $this->load->view('Router/route', $data);
    }
}

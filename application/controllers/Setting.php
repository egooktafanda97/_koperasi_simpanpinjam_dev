<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Setting extends CI_Controller
{
    private $page = "Setting/";
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
        $config['base_url'] = base_url("Setting/index/");
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
            "title" => "Setting",
            "page" => $this->page . "index",
            "script" => $this->page . "script",
            "result" =>  $all_data,
        ];
        $this->load->view('Router/route', $data);
    }

    public function getAllData($limit, $start)
    {
        $this->db->order_by("id_pengaturan", "DESC");
        $this->db->limit($limit, $start);
        $result = $this->db->get_where("pengaturan")->result_array();
        return $result;
    }
    public function dataIndustri()
    {
        $this->db->order_by("id_pengaturan", "DESC");
        $result = $this->db->get_where("pengaturan")->result_array();
        return $result;
    }

    public function countAllData()
    {
        return $this->db->get_where("pengaturan")->num_rows();
    }

    public function created()
    {
        $this->form_validation->set_rules('tanggal_pembayaran', 'tanggal_pembayaran', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'gagal ditambahkan');
            redirect('setting');
        } else {
            try {
                $post = $this->input->post();
                $data  = [
                    "tanggal_pembayaran" => $post['tanggal_pembayaran'],
                ];

                $save = $this->db->insert('pengaturan', $data);
                if ($save) {
                    $this->session->set_flashdata('success', 'berhasil ditambahkan');
                    redirect('setting');
                } else {
                    $this->session->set_flashdata('error', 'gagal di inputkan');
                    redirect('setting');
                }
            } catch (\Throwable $th) {
                $this->session->set_flashdata('error', 'gagal ditambahkan');
                redirect('setting');
            }
        }
    }

    public function deleted($id_pengaturan)
    {
        $this->db->where('id_pengaturan', $id_pengaturan);
        $this->db->delete('pengaturan');

        $this->session->set_flashdata('success', 'data berhasil dihapus');
        redirect('setting');
    }

    public function getById($id_pengaturan)
    {

        $getData = $this->db->get_where('pengaturan', ['id_pengaturan' => $id_pengaturan])->row_array();
        echo json_encode($getData);
    }

    public function update($id)
    {

        $this->form_validation->set_rules('tanggal_pembayaran', 'tanggal_pembayaran', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'data tidak di ubah');
            redirect('setting');
        } else {
            try {
                $post = $this->input->post();
                $data  = [
                    "tanggal_pembayaran" => $post['tanggal_pembayaran']
                ];
                $this->db->where('id_pengaturan', $id);
                $save = $this->db->update('pengaturan', $data);
                if ($save) {
                    $this->session->set_flashdata('success', 'berhasil di ubah');
                    redirect('setting');
                } else {
                    $this->session->set_flashdata('error', 'gagal di ubah');
                    redirect('setting');
                }
            } catch (\Throwable $th) {
                $this->session->set_flashdata('error', 'kesalahan');
                redirect('setting');
            }
        }
    }

    public function detail($id_pengaturan)
    {

        $dataId =  $this->db->get_where('pengaturan', ['id_pengaturan' => $id_pengaturan])->row_array();
        $data = array(
            'title' => "Detail Data",
            'page' => $this->page . "detail",
            'script' => $this->page . "script",
            'val' => $dataId
        );
        $this->load->view('Router/route', $data);
    }

        
     
}

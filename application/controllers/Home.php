<?php
class Home extends CI_CONTROLLER{
    public function __construct(){
        parent::__construct();
        $this->load->model('Himmah_model');
    }

    public function index(){
        $data['title'] = "Form Input Data Alumni";
        $this->load->view("templates/header", $data);
        $this->load->view("page/input", $data);
        $this->load->view("templates/footer", $data);
    }

    public function get_data_alumni(){
        $id = $this->input->post("id", TRUE);

        $data = $this->Himmah_model->get_data_alumni($id);

        echo json_encode($data);
    }

    public function edit_alumni(){
        $id = $this->input->post("nik");
        
        $this->Himmah_model->edit_alumni($id);
        
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>Menginput</strong> data Anda<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        
        redirect($_SERVER['HTTP_REFERER']);
    }
}
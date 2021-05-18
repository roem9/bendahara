<?php
class Admin extends CI_CONTROLLER{
    public function __construct(){
        parent::__construct();
        $this->load->model('Bendahara_model');
        $this->load->model('Main_model');
        if($this->session->userdata('status') != "login"){
            $this->session->set_flashdata('login', 'Maaf, Anda harus login terlebih dahulu');
			redirect(base_url("login"));
		}
    }

    public function index(){
        $data['title'] = "Rekap Transaksi Asrama Lontara";

        $data['bulan'] = ["1" => "Januari", "2" => "Februari", "3" => "Maret", "4" => "April", "5" => "Mei", "6" => "Juni", "7" => "Juli", "8" => "Agustus", "9" => "September", "10" => "Oktober", "11" => "November", "12" => "Desember"];

        $pengeluaran = $this->Bendahara_model->get_total_pengeluaran();
        $pemasukan = $this->Bendahara_model->get_total_pemasukan();
        $data['saldo'] = $pemasukan['pemasukan'] - $pengeluaran['pengeluaran'];

        $periode = $this->Bendahara_model->get_periode_transaksi();

        foreach ($periode as $i => $periode) {
            $my = explode(" ", $periode['periode']);

            $data['transaksi'][$i]['bulan'] = $my[0];
            $data['transaksi'][$i]['tahun'] = $my[1];
            $pemasukan = $this->Bendahara_model->pemasukan_per_periode($periode['periode']);
            $pengeluaran = $this->Bendahara_model->pengeluaran_per_periode($periode['periode']);
            $data['transaksi'][$i]['pemasukan'] = $pemasukan['pemasukan'];
            $data['transaksi'][$i]['pengeluaran'] = $pengeluaran['pengeluaran'];
        }

        // ini_set('xdebug.var_display_max_depth', '10');
        // ini_set('xdebug.var_display_max_children', '256');
        // ini_set('xdebug.var_display_max_data', '1024');

        // var_dump($data);
        $this->load->view("templates/header", $data);
        $this->load->view("page/index", $data);
        $this->load->view("templates/footer", $data);
    }

    public function pengeluaran(){
        $data['title'] = "Pengeluaran";
        
        $data['pengeluaran'] = $this->Bendahara_model->get_all_pengeluaran();

        $this->load->view("templates/header", $data);
        $this->load->view("page/pengeluaran", $data);
        $this->load->view("templates/footer", $data);
    }
    
    public function pemasukan(){
        $data['title'] = "Pemasukan";
        
        $data['pemasukan'] = $this->Bendahara_model->get_all_pemasukan();

        $this->load->view("templates/header", $data);
        $this->load->view("page/pemasukan", $data);
        $this->load->view("templates/footer", $data);
    }

    public function rekap(){
        $data['title'] = "Rekap Bendahara";
        
        $i = 0;

        $pengeluaran = $this->Main_model->get_all("pengeluaran");
        foreach ($pengeluaran as $pengeluaran) {
            $data['data'][$i] = $pengeluaran;
            $data['data'][$i]['tgl'] = $pengeluaran['tgl_pengeluaran'];
            $data['data'][$i]['tipe'] = "Pengeluaran";

            $i++;
        }

        $pemasukan = $this->Main_model->get_all("pemasukan");
        foreach ($pemasukan as $pemasukan) {
            $data['data'][$i] = $pemasukan;
            $data['data'][$i]['tgl'] = $pemasukan['tgl_pemasukan'];
            $data['data'][$i]['tipe'] = "Pemasukan";

            $i++;
        }

        usort($data['data'], function($a, $b) {
            return $a['tgl'] <=> $b['tgl'];
        });

        // var_dump($data['data']);
        $this->load->view("page/rekap", $data);
    }

    // get
        public function get_pengeluaran_by_id(){
            $id = $this->input->post("id", TRUE);
            $data = $this->Bendahara_model->get_pengeluaran_by_id($id);

            echo json_encode($data);
        }
        
        public function get_pemasukan_by_id(){
            $id = $this->input->post("id", TRUE);
            $data = $this->Bendahara_model->get_pemasukan_by_id($id);

            echo json_encode($data);
        }

        public function get_pemasukan_per_periode(){
            $periode = $this->input->post("id");
            $data = $this->Bendahara_model->get_pemasukan_per_periode($periode);
            echo json_encode($data);
        }
        
        public function get_pengeluaran_per_periode(){
            $periode = $this->input->post("id");
            $data = $this->Bendahara_model->get_pengeluaran_per_periode($periode);
            echo json_encode($data);
        }
    // get

    // add
        public function add_pengeluaran(){
            $this->Bendahara_model->add_pengeluaran();
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>menambahkan</strong> pengeluaran<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect($_SERVER['HTTP_REFERER']);
        }

        public function add_pemasukan(){
            $this->Bendahara_model->add_pemasukan();
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>menambahkan</strong> pemasukan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect($_SERVER['HTTP_REFERER']);
        }
    // add

    // edit
        public function edit_pengeluaran(){
            $id = $this->input->post("id_pengeluaran");
            $this->Bendahara_model->edit_pengeluaran($id);
            
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>mengubah</strong> pengeluaran<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

            redirect($_SERVER['HTTP_REFERER']);
        }

        public function edit_pemasukan(){
            $id = $this->input->post("id_pemasukan");
            $this->Bendahara_model->edit_pemasukan($id);
            
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>mengubah</strong> pemasukan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

            redirect($_SERVER['HTTP_REFERER']);
        }
    // edit

    // delete
        public function delete_pengeluaran($id){
            $this->Bendahara_model->delete_pengeluaran($id);
            
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>menghapus</strong> pengeluaran<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

            redirect($_SERVER['HTTP_REFERER']);
        }

        public function delete_pemasukan($id){
            $this->Bendahara_model->delete_pemasukan($id);
            
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil <strong>menghapus</strong> pemasukan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

            redirect($_SERVER['HTTP_REFERER']);
        }
    // delete
}
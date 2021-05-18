<?php
class Himmah_Model extends CI_MODEL{
    
    public function get_data_alumni($id){
        $this->db->from("alumni");
        $this->db->where("nik", $id);
        return $this->db->get()->row_array();
    }

    public function get_all_alumni($angkatan, $jk){
        $this->db->from("alumni");
        $this->db->where("angkatan", $angkatan);
        $this->db->where("jk", $jk);
        return $this->db->get()->result_array();
    }

    public function get_alumni_belum_input($angkatan, $jk){
        $this->db->from("alumni");
        $this->db->where("angkatan", $angkatan);
        $this->db->where("jk", $jk);
        $this->db->where("status <>", "up to date");
        return $this->db->get()->result_array();
    }

    public function get_alumni_sudah_input($angkatan, $jk){
        $this->db->from("alumni");
        $this->db->where("angkatan", $angkatan);
        $this->db->where("jk", $jk);
        $this->db->where("status =", "up to date");
        return $this->db->get()->result_array();
    }

    public function edit_alumni($nik){
        
        if($this->input->post("pekerjaan_lainnya")){
            $kesibukan = $this->input->post("pekerjaan_lainnya", true);
        } else {
            $kesibukan = $this->input->post("kesibukan");
        }

        $data['alumni'] = [
            "nama" => $this->input->post("nama", true),
            "jk" => $this->input->post("jk"),
            "email" => $this->input->post("email", true),
            "no_hp" => $this->input->post("no_hp", true),
            "alamat_ktp" => $this->input->post("alamat_ktp", true),
            "alamat_domisili" => $this->input->post("alamat_domisili", true),
            "angkatan" => $this->input->post("angkatan", true),
            "wali" => $this->input->post("wali", true),
            "no_hp_wali" => $this->input->post("no_hp_wali", true),
            "kesibukan" => $kesibukan,
            "status" => "up to date"
        ];

        $this->db->where("nik", $nik);
        $this->db->update("alumni", $data['alumni']);

        $data['kuliah'] = [
            "universitas" => $this->input->post("universitas", true),
            "jurusan" => $this->input->post("jurusan", true),
            "jenjang" => $this->input->post("jenjang", true)
        ];

        $this->db->where("nik", $nik);
        $this->db->update("kuliah", $data['kuliah']);

        $data['kerja'] = [
            "perusahaan" => $this->input->post("perusahaan", true)
        ];

        $this->db->where("nik", $nik);
        $this->db->update("kerja", $data['kerja']);
    }
}
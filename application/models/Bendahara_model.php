<?php

class Bendahara_model extends CI_MODEL{
    public function get_all_pengeluaran(){
        $this->db->from("pengeluaran");
        $this->db->order_by("id_pengeluaran", "DESC");
        return $this->db->get()->result_array();
    }
    
    public function get_all_pemasukan(){
        $this->db->from("pemasukan");
        $this->db->order_by("id_pemasukan", "DESC");
        return $this->db->get()->result_array();
    }

    public function get_pengeluaran_by_id($id){
        $this->db->from("pengeluaran");
        $this->db->where("id_pengeluaran", $id);
        return $this->db->get()->row_array();
    }
    
    public function get_pemasukan_by_id($id){
        $this->db->from("pemasukan");
        $this->db->where("id_pemasukan", $id);
        return $this->db->get()->row_array();
    }

    public function get_total_pengeluaran(){
        $this->db->select("SUM(nominal) as pengeluaran");
        $this->db->from("pengeluaran");
        return $this->db->get()->row_array();
    }
    
    public function get_total_pemasukan(){
        $this->db->select("SUM(nominal) as pemasukan");
        $this->db->from("pemasukan");
        return $this->db->get()->row_array();
    }

    public function get_periode_transaksi(){
        $this->db->select("concat(MONTH(tgl_pemasukan), ' ', YEAR(tgl_pemasukan)) as periode");
        $this->db->from("pemasukan");
        $this->db->group_by('periode');
        $this->db->order_by("tgl_pemasukan", "desc");
        $pemasukan = $this->db->get()->result_array();
        
        $this->db->select("concat(MONTH(tgl_pengeluaran), ' ', YEAR(tgl_pengeluaran)) as periode");
        $this->db->from("pengeluaran");
        $this->db->group_by('periode');
        $this->db->order_by("tgl_pengeluaran", "desc");
        $pengeluaran = $this->db->get()->result_array();

        $periode = array_unique(array_merge($pemasukan,$pengeluaran), SORT_REGULAR);

        // var_dump($periode);
        return $periode;
    }

    public function pemasukan_per_periode($periode){
        $data = explode(" ", $periode);
        $bulan = $data[0];
        $tahun = $data[1];

        $this->db->select("sum(nominal) as pemasukan");
        $this->db->from("pemasukan");
        $this->db->where("MONTH(tgl_pemasukan)", $bulan);
        $this->db->where("YEAR(tgl_pemasukan)", $tahun);
        return $this->db->get()->row_array();
    }
    
    public function pengeluaran_per_periode($periode){
        $data = explode(" ", $periode);
        $bulan = $data[0];
        $tahun = $data[1];

        $this->db->select("sum(nominal) as pengeluaran");
        $this->db->from("pengeluaran");
        $this->db->where("MONTH(tgl_pengeluaran)", $bulan);
        $this->db->where("YEAR(tgl_pengeluaran)", $tahun);
        return $this->db->get()->row_array();
    }
    
    public function get_pengeluaran_per_periode($periode){
        $data = explode(" ", $periode);
        $bulan = $data[0];
        $tahun = $data[1];

        $this->db->from("pengeluaran");
        $this->db->where("MONTH(tgl_pengeluaran)", $bulan);
        $this->db->where("YEAR(tgl_pengeluaran)", $tahun);
        return $this->db->get()->result_array();
    }

    public function get_pemasukan_per_periode($periode){
        $data = explode(" ", $periode);
        $bulan = $data[0];
        $tahun = $data[1];

        $this->db->from("pemasukan");
        $this->db->where("MONTH(tgl_pemasukan)", $bulan);
        $this->db->where("YEAR(tgl_pemasukan)", $tahun);
        return $this->db->get()->result_array();
    }
    // add
        public function add_pengeluaran(){
            $nominal = $this->input->post("nominal");
            $nominal = str_replace("Rp. ", "", $nominal);
            $nominal = str_replace(".", "", $nominal);

            $data = [
                "pelaku" => $this->input->post("pelaku"),
                "tgl_pengeluaran" => $this->input->post("tgl_pengeluaran"),
                "nominal" => $nominal,
                "keterangan" => $this->input->post("keterangan")
            ];

            $this->db->insert("pengeluaran", $data);
        }
        
        public function add_pemasukan(){
            $nominal = $this->input->post("nominal");
            $nominal = str_replace("Rp. ", "", $nominal);
            $nominal = str_replace(".", "", $nominal);

            $data = [
                "pelaku" => $this->input->post("pelaku"),
                "tgl_pemasukan" => $this->input->post("tgl_pemasukan"),
                "nominal" => $nominal,
                "keterangan" => $this->input->post("keterangan")
            ];

            $this->db->insert("pemasukan", $data);
        }
    // add

    // edit
        public function edit_pengeluaran($id){
            $nominal = $this->input->post("nominal");
            $nominal = str_replace("Rp. ", "", $nominal);
            $nominal = str_replace(".", "", $nominal);

            $data = [
                "pelaku" => $this->input->post("pelaku"),
                "tgl_pengeluaran" => $this->input->post("tgl_pengeluaran"),
                "nominal" => $nominal,
                "keterangan" => $this->input->post("keterangan")
            ];

            $this->db->where("id_pengeluaran", $id);
            $this->db->update("pengeluaran", $data);
        }
        
        public function edit_pemasukan($id){
            $nominal = $this->input->post("nominal");
            $nominal = str_replace("Rp. ", "", $nominal);
            $nominal = str_replace(".", "", $nominal);

            $data = [
                "pelaku" => $this->input->post("pelaku"),
                "tgl_pemasukan" => $this->input->post("tgl_pemasukan"),
                "nominal" => $nominal,
                "keterangan" => $this->input->post("keterangan")
            ];

            $this->db->where("id_pemasukan", $id);
            $this->db->update("pemasukan", $data);
        }
    // edit

    // delete
        public function delete_pengeluaran($id){
            $this->db->where("id_pengeluaran", $id);
            $this->db->delete("pengeluaran");
        }
        
        public function delete_pemasukan($id){
            $this->db->where("id_pemasukan", $id);
            $this->db->delete("pemasukan");
        }
    // delete
}
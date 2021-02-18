<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CppModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        //load dependencise
        $this->load->model("BaseModel", "BM");
        $this->load->library("form_validation");
        $this->load->helper('utility');
        //local variabel
        $this->table = "input_lap_cpp";
    }

    public function getTotalKirim($month)
    {
        $this->db
            ->query(
                "SELECT SUM((a.lebar_roll_palet / 1000) * a.panjang_roll_palet * 0.91 * (a.tebal_roll_palet / 1000)) AS total_kirim 
                    FROM input_palet AS a
                    JOIN type_roll AS b ON a.type_roll_palet = b.type_roll
                    WHERE MONTH(tgl_kirim) = 1 
                    AND jumlah_roll = 0");
    }
}
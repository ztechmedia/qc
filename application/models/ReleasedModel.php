<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ReleasedModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        //load dependencise
        $this->load->model("BaseModel", "BM");
        $this->load->library("form_validation");
        $this->load->helper('utility');
    }

    public function getCountMonth($year, $month)
    {
        return $this->db
            ->select("a.status_akhir, COUNT(a.status_akhir) as total, SUM(b.kg_hasil_slitt) as total_kg")
            ->from("released_jr as a")
            ->join("input_lap_slitting as b", "a.status_form = b.id_slitt")
            ->where("YEAR(a.tgl_released_jr)", $year)
            ->where("MONTH(a.tgl_released_jr)", $month)
            ->group_by("a.status_akhir")
            ->get()
            ->result();
    }

    public function getCountYear($year)
    {
        return $this->db
            ->select("a.status_akhir as status, MONTH(a.tgl_released_jr) AS month, COUNT(a.status_akhir) as total, SUM(b.kg_hasil_slitt) as total_kg")
            ->from("released_jr as a")
            ->join("input_lap_slitting as b", "a.status_form = b.id_slitt")
            ->where("YEAR(a.tgl_released_jr)", $year)
            ->group_by("MONTH(a.tgl_released_jr)")
            ->group_by("a.status_akhir")
            ->get()
            ->result();
    }

    public function getRolls($year, $month)
    {
        return $this->db
            ->select("a.id_released_jr, a.no_released_jr, a.reason_jr, a.status_akhir, a.tgl_released_jr,
                no_roll_released_jr, a.id_user_released_jr, b.type_slitt, b.mic_slitt, b.lebar_slitt, b.panjang_slitt, b.kg_hasil_slitt")
            ->from("released_jr as a")
            ->join("input_lap_slitting as b", "a.status_form = b.id_slitt")
            ->where("YEAR(a.tgl_released_jr)", $year)
            ->where("MONTH(a.tgl_released_jr)", $month)
            ->where("a.status_akhir", "REJECT")
            ->get()
            ->result();
    }
}
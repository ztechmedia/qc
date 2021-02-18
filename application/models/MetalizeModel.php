<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MetalizeModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        //load dependencise
        $this->load->model("BaseModel", "BM");
        $this->load->library("form_validation");
        $this->load->helper('utility');
        //local variabel
        $this->table = "input_met";
    }

    public function totalRoll($machine, $year, $month)
    {
        return $this->db
            ->select("COUNT(id_met) AS total, SUM(kg_hasil_met) AS weight")
            ->from($this->table)
            ->where("YEAR(tgl_input)", $year)
            ->where("MONTH(tgl_input)", $month)
            ->where("id_mesin", $machine)
            ->get()
            ->result();
    }

    public function totalRollStatus($machine, $year, $month)
    {
        return $this->db
            ->select("status_met AS status, COUNT(status_met) as total_status")
            ->from($this->table)
            ->where("YEAR(tgl_input)", $year)
            ->where("MONTH(tgl_input)", $month)
            ->where("id_mesin", $machine)
            ->group_by("status")
            ->get()
            ->result();
    }

    public function totalRollStatusDay($machine, $date)
    {
        return $this->db
            ->select("status_met AS status, COUNT(status_met) as total_status")
            ->from($this->table)
            ->where("tgl_input", $date)
            ->where("id_mesin", $machine)
            ->group_by("status")
            ->get()
            ->result();
    }

    public function getAll($year)
    {
        return $this->db
            ->select("status_met AS status, MONTH(tgl_input) AS month, COUNT(status_met) AS total")
            ->from($this->table)
            ->where("YEAR(tgl_input)", $year)
            ->group_by("MONTH(tgl_input)")
            ->group_by("status")
            ->get()
            ->result();
    }

    public function statusRollGroup($year, $month, $regu)
    {
        return $this->db
            ->select("status_met AS status, regu, COUNT(status_met) as total")
            ->from($this->table)
            ->where("YEAR(tgl_input)", $year)
            ->where("MONTH(tgl_input)", $month)
            ->where("regu", $regu)
            ->group_by("status")
            ->get()
            ->result();
    }

    public function statusPerson($year)
    {   
     
        return $this->db
            ->select("user, COUNT(status_met) as total")
            ->from($this->table)
            ->where("YEAR(tgl_input)", $year)
            ->where("user !=", "")
            ->group_by("user")
            ->get()
            ->result();
    }

}
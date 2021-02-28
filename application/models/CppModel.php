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

    public function totalRoll($machine, $year, $month)
    {
        return $this->db
            ->select("COUNT(id) AS total, SUM(kg_hasil_cpp) AS weight")
            ->from($this->table)
            ->where("YEAR(tgl_input)", $year)
            ->where("MONTH(tgl_input)", $month)
            ->where("kode_mesin", $machine)
            ->get()
            ->result();
    }

    public function totalRollStatus($machine, $year, $month)
    {          
        return $this->db
            ->select("status, COUNT(status) as total_status")
            ->from($this->table)
            ->where("YEAR(tgl_input)", $year)
            ->where("MONTH(tgl_input)", $month)
            ->where("kode_mesin", $machine)
            ->group_by("status")
            ->get()
            ->result();
    }

    public function totalRollStatusDay($machine, $date)
    {
        return $this->db
            ->select("status, COUNT(status) as total_status")
            ->from($this->table)
            ->where("tgl_input", $date)
            ->where("kode_mesin", $machine)
            ->group_by("status")
            ->get()
            ->result();
    }

    public function getAll($year)
    {
        return $this->db
            ->select("status, MONTH(tgl_input) AS month, COUNT(status) AS total")
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
            ->select("status, regu, COUNT(status) as total")
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
            ->select("user, COUNT(status) as total")
            ->from($this->table)
            ->where("YEAR(tgl_input)", $year)
            ->where("user !=", "")
            ->group_by("user")
            ->get()
            ->result();
    }

    public function statusPersonMonth($year, $month)
    {   
     
        return $this->db
            ->select("user, COUNT(status) as total")
            ->from($this->table)
            ->where("YEAR(tgl_input)", $year)
            ->where("MONTH(tgl_input)", $month)
            ->where("user !=", "")
            ->group_by("user")
            ->get()
            ->result();
    }
}
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SlittingModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        //load dependencise
        $this->load->model("BaseModel", "BM");
        $this->load->library("form_validation");
        $this->load->helper('utility');
        //local variabel
        $this->table = "input_lap_slitting";
    }

    public function totalRollFG($machine, $year, $month)
    {
        return $this->db
            ->select("COUNT(id_slitt) AS total, SUM(kg_hasil_slitt) AS weight")
            ->from($this->table)
            ->where("YEAR(tgl)", $year)
            ->where("MONTH(tgl)", $month)
            ->where("nama_mesin", $machine)
            ->where("stock !=", "Base Film")
            ->get()
            ->result();
    }

    public function totalRollStatus($machine, $year, $month)
    {
        return $this->db
            ->select("status, COUNT(status) as total_status")
            ->from($this->table)
            ->where("YEAR(tgl)", $year)
            ->where("MONTH(tgl)", $month)
            ->where("nama_mesin", $machine)
            ->where("stock !=", "Base Film")
            ->group_by("status")
            ->get()
            ->result();
    }

    public function totalRollStatusDay($machine, $date)
    {
        return $this->db
            ->select("status, COUNT(status) as total_status")
            ->from($this->table)
            ->where("tgl", $date)
            ->where("nama_mesin", $machine)
            ->where("stock !=", "Base Film")
            ->group_by("status")
            ->order_by("status")
            ->get()
            ->result();
    }

    public function getAll($year)
    {
        return $this->db
            ->select("status, MONTH(tgl) AS month, COUNT(status) AS total")
            ->from($this->table)
            ->where("YEAR(tgl)", $year)
            ->where("stock !=", "Base Film")
            ->group_by("MONTH(tgl)")
            ->group_by("status")
            ->get()
            ->result();
    }

    public function statusRollGroup($year, $month, $regu)
    {
        return $this->db
            ->select("status, regu, COUNT(status) as total")
            ->from($this->table)
            ->where("YEAR(tgl)", $year)
            ->where("MONTH(tgl)", $month)
            ->where("stock !=", "Base Film")
            ->where("regu", $regu)
            ->group_by("status")
            ->get()
            ->result();
    }

    public function statusPerson($year, $jenis_roll)
    {   
        if($jenis_roll == "") {
            return $this->db
            ->select("user, COUNT(status) as total")
            ->from($this->table)
            ->where("YEAR(tgl)", $year)
            ->where("user !=", "")
            ->group_by("user")
            ->get()
            ->result();
        } else {
            return $this->db
            ->select("user, COUNT(status) as total")
            ->from($this->table)
            ->where("YEAR(tgl)", $year)
            ->where("user !=", "")
            ->where("stock !=", "Base Film")
            ->where("jenis_roll_slitt", $jenis_roll)
            ->group_by("user")
            ->get()
            ->result();
        } 
    }
}

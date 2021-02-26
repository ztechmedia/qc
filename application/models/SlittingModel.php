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
        if($machine != "all") {
            return $this->db
            ->select("COUNT(id_slitt) AS total, SUM(kg_hasil_slitt) AS weight")
            ->from($this->table)
            ->where("YEAR(tgl)", $year)
            ->where("MONTH(tgl)", $month)
            ->where("nama_mesin", $machine)
            ->where("stock !=", "Base Film")
            ->where("status !=", "")
            ->where("panjang_slitt >", 0)
            ->where("kg_hasil_slitt >", 0)
            ->get()
            ->result();
        } else {
            return $this->db
            ->select("COUNT(id_slitt) AS total, SUM(kg_hasil_slitt) AS weight")
            ->from($this->table)
            ->where("YEAR(tgl)", $year)
            ->where("MONTH(tgl)", $month)
            ->where("stock !=", "Base Film")
            ->where("status !=", "")
            ->where("panjang_slitt >", 0)
            ->where("kg_hasil_slitt >", 0)
            ->get()
            ->result();
        }
    }

    public function totalRollStatus($machine, $year, $month)
    {
        if($machine != "all") {
            return $this->db
            ->select("status, COUNT(status) as total_status")
            ->from($this->table)
            ->where("YEAR(tgl)", $year)
            ->where("MONTH(tgl)", $month)
            ->where("nama_mesin", $machine)
            ->where("stock !=", "Base Film")
            ->where("status !=", "")
            ->where("panjang_slitt >", 0)
            ->where("kg_hasil_slitt >", 0)
            ->group_by("status")
            ->get()
            ->result();
        } else {
            return $this->db
            ->select("status, COUNT(status) as total_status")
            ->from($this->table)
            ->where("YEAR(tgl)", $year)
            ->where("MONTH(tgl)", $month)
            ->where("stock !=", "Base Film")
            ->where("status !=", "")
            ->where("panjang_slitt >", 0)
            ->where("kg_hasil_slitt >", 0)
            ->group_by("status")
            ->get()
            ->result();
        }
    }

    public function totalRollStatusDay($machine, $date)
    {
        if($machine != "all") {
            return $this->db
            ->select("status, COUNT(status) as total_status")
            ->from($this->table)
            ->where("tgl", $date)
            ->where("nama_mesin", $machine)
            ->where("stock !=", "Base Film")
            ->where("status !=", "")
            ->where("panjang_slitt >", 0)
            ->where("kg_hasil_slitt >", 0)
            ->group_by("status")
            ->order_by("status")
            ->get()
            ->result();
        } else {
            return $this->db
            ->select("status, COUNT(status) as total_status")
            ->from($this->table)
            ->where("tgl", $date)
            ->where("stock !=", "Base Film")
            ->where("status !=", "")
            ->where("panjang_slitt >", 0)
            ->where("kg_hasil_slitt >", 0)
            ->group_by("status")
            ->order_by("status")
            ->get()
            ->result();
        }
    }

    public function getAll($year)
    {
        return $this->db
            ->select("status, MONTH(tgl) AS month, COUNT(status) AS total")
            ->from($this->table)
            ->where("YEAR(tgl)", $year)
            ->where("stock !=", "Base Film")
            ->where("status !=", "")
            ->where("panjang_slitt >", 0)
            ->where("kg_hasil_slitt >", 0)
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
            ->where("status !=", "")
            ->where("panjang_slitt >", 0)
            ->where("kg_hasil_slitt >", 0)
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
            ->where("status !=", "")
            ->where("panjang_slitt >", 0)
            ->where("kg_hasil_slitt >", 0)
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
            ->where("status !=", "")
            ->where("panjang_slitt >", 0)
            ->where("kg_hasil_slitt >", 0)
            ->group_by("user")
            ->get()
            ->result();
        } 
    }

    public function ncr($date, $group)
    {
       return $this->db
                ->select("customer_lap_slitt as customer, COUNT(status) as total, slitt_roll")
                ->from($this->table)
                ->where("status", "NCR")
                ->where("tgl", $date)
                ->where("regu", $group)
                ->where("stock", "Packing")
                ->order_by("customer_lap_slitt")
                ->group_by("customer_lap_slitt")
                ->get()
                ->result();
    }

    public function printNcr($date, $group, $customer)
    {
        return $this->db
        ->select("customer_lap_slitt , kode_roll_slitt, slitt_roll")
        ->from($this->table)
        ->where("status", "NCR")
        ->where("tgl", $date)
        ->where("regu", $group)
        ->where("stock", "Packing")
        ->like("customer_lap_slitt", $customer)
        ->order_by("customer_lap_slitt")
        ->get()
        ->result();
    }
}
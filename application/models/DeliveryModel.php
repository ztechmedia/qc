<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DeliveryModel extends CI_Model
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

    public function getTotalKirim($year)
    {
        return $this->db
            ->select('SUM((a.lebar_roll_palet / 1000) * a.panjang_roll_palet * 0.91 * (a.tebal_roll_palet / 1000)) AS total_kirim, MONTH(tgl_kirim) as month')
            ->from('input_palet AS a')
            ->join('type_roll AS b', 'a.type_roll_palet = b.type_roll')
            ->where('YEAR(a.tgl_kirim)', $year)
            ->group_by('MONTH(a.tgl_kirim)')
            ->order_by('MONTH(a.tgl_kirim)')
            ->get()
            ->result();
    }

    public function getTotalKirimJenis($year, $jenis)
    {
        return $this->db
            ->select('SUM((a.lebar_roll_palet / 1000) * a.panjang_roll_palet * 0.91 * (a.tebal_roll_palet / 1000)) AS total_kirim, MONTH(tgl_kirim) as month')
            ->from('input_palet AS a')
            ->join('type_roll AS b', 'a.type_roll_palet = b.type_roll')
            ->where('YEAR(a.tgl_kirim)', $year)
            ->where("b.jenis_roll", $jenis)
            ->group_by('MONTH(a.tgl_kirim)')
            ->order_by('MONTH(a.tgl_kirim)')
            ->get()
            ->result();
    }

    public function getTotalKirimMonth($year, $month, $jenis)
    {
        return $this->db
            ->select('SUM((a.lebar_roll_palet / 1000) * a.panjang_roll_palet * 0.91 * (a.tebal_roll_palet / 1000)) AS total_kirim')
            ->from('input_palet AS a')
            ->join('type_roll AS b', 'a.type_roll_palet = b.type_roll')
            ->where('YEAR(a.tgl_kirim)', $year)
            ->where('MONTH(a.tgl_kirim)', $month)
            ->where('b.jenis_roll', $jenis)
            ->get()
            ->row()
            ->total_kirim;
    }

    public function getStockMonth($year, $month, $jenis)
    {
        return $this->db
            ->select('SUM((a.lebar_roll_palet / 1000) * a.panjang_roll_palet * 0.91 * (a.tebal_roll_palet / 1000)) AS total_kirim')
            ->from('input_palet AS a')
            ->join('type_roll AS b', 'a.type_roll_palet = b.type_roll')
            ->where('YEAR(a.tgl_inputpalet)', $year)
            ->where('MONTH(a.tgl_inputpalet)', $month)
            ->where('a.tgl_kirim', '0000-00-00')
            ->where('b.jenis_roll', $jenis)
            ->get()
            ->row()
            ->total_kirim;
    }

    public function getListKirimMonth($year, $month, $jenis)
    {
        return $this->db
            ->select("a.slitt_roll_palet, SUM((a.lebar_roll_palet / 1000) * a.panjang_roll_palet * 0.91 * (a.tebal_roll_palet / 1000)) AS total_kirim, COUNT(a.slitt_roll_palet) AS total_roll")
            ->from("input_palet AS a")
            ->join('type_roll AS b', 'a.type_roll_palet = b.type_roll')
            ->where('YEAR(a.tgl_kirim)', $year)
            ->where('MONTH(a.tgl_kirim)', $month)
            ->where('b.jenis_roll', $jenis)
            ->group_by("a.slitt_roll_palet")
            ->order_by("a.slitt_roll_palet")
            ->get()
            ->result();

    }

    public function totalWaste($year, $month)
    {
        return $this->db
            ->select("SUM(wst_qty) as total_waste, nama_waste")
            ->from("waste_proses")
            ->where("YEAR(tgl_wst)", $year)
            ->where("MONTH(tgl_wst)", $month)
            ->group_by("nama_waste")
            ->get()
            ->result_array();
    }

    public function customerYear($year)
    {
        return $this->db
            ->select("a.customer_palet, SUM((a.lebar_roll_palet / 1000) * a.panjang_roll_palet * 0.91 * (a.tebal_roll_palet / 1000)) AS total_kirim, COUNT(a.customer_palet) AS total_roll")
            ->from("input_palet AS a")
            ->join('type_roll AS b', 'a.type_roll_palet = b.type_roll')
            ->where('YEAR(a.tgl_kirim)', $year)
            ->group_by("a.customer_palet")
            ->get()
            ->result();
    }

    public function customerMonth($year, $month)
    {
        return $this->db
            ->select("a.customer_palet, SUM((a.lebar_roll_palet / 1000) * a.panjang_roll_palet * 0.91 * (a.tebal_roll_palet / 1000)) AS total_kirim, COUNT(a.customer_palet) AS total_roll")
            ->from("input_palet AS a")
            ->join('type_roll AS b', 'a.type_roll_palet = b.type_roll')
            ->where('YEAR(a.tgl_kirim)', $year)
            ->where("MONTH(a.tgl_kirim)", $month)
            ->group_by("a.customer_palet")
            ->get()
            ->result();
    }

    public function personWorks($year, $month)
    {
        $userSlit = $this->db
            ->select("user")
            ->from("input_lap_slitting")
            ->where("YEAR(tgl)", $year)
            ->where("MONTH(tgl)", $month)
            ->where("user !=", "")
            ->where_not_in("user", ["ricky", "putra", "bangkit", "riswanto", "packing3", "packing2", "firdaus", "faisal", "alim"])
            ->group_by("user")
            ->get()
            ->result();

        $userMet = $this->db
            ->select("user")
            ->from("input_met")
            ->where("YEAR(tgl_input)", $year)
            ->where("MONTH(tgl_input)", $month)
            ->where("user !=", "")
            ->where_not_in("user", ["ricky", "putra", "bangkit", "riswanto", "packing3", "packing2", "firdaus", "faisal", "alim"])
            ->group_by("user")
            ->get()
            ->result();

        $userCpp = $this->db
            ->select("user")
            ->from("input_lap_cpp")
            ->where("YEAR(tgl_input)", $year)
            ->where("MONTH(tgl_input)", $month)
            ->where("user !=", "")
            ->where_not_in("user", ["ricky", "putra", "bangkit", "riswanto", "packing3", "packing2", "firdaus", "faisal", "alim"])
            ->group_by("user")
            ->get()
            ->result();
        
        $dates = $this->db
            ->select("tgl")
            ->from("input_lap_slitting")
            ->where("YEAR(tgl)", $year)
            ->where("MONTH(tgl)", $month)
            ->group_by("tgl")
            ->get()
            ->result();

        $date = [];
        foreach ($dates as $dt) {
           $date[] = $dt->tgl;
        }

        $users = [];
        foreach ($userSlit as $user) {
            $users[] = [
                "user" => $user->user,
                "machine" => "slitt"
            ];
        }

        foreach ($userMet as $user) {
            $users[] = [
                "user" => $user->user,
                "machine" => "met"
            ];
        }

        foreach ($userCpp as $user) {
            $users[] = [
                "user" => $user->user,
                "machine" => "cpp"
            ];
        }
        
        $workDays = [];
        foreach ($users as $key => $user) {
            if($user["machine"] == "slitt") {
                $day = $this->db
                    ->select("tgl")
                    ->from("input_lap_slitting")
                    ->where("YEAR(tgl)", $year)
                    ->where("MONTH(tgl)", $month)
                    ->where_in("tgl", $date)
                    ->where("user", $user['user'])
                    ->group_by("tgl")
                    ->count_all_results();
            } else if($user["machine"] == "met") {
                $day = $this->db
                    ->select("tgl_input")
                    ->from("input_met")
                    ->where("YEAR(tgl_input)", $year)
                    ->where("MONTH(tgl_input)", $month)
                    ->where_in("tgl_input", $date)
                    ->where("user", $user['user'])
                    ->group_by("tgl_input")
                    ->count_all_results();
            } else if($user["machine"] == "cpp") {
                $day = $this->db
                    ->select("tgl_input")
                    ->from("input_lap_cpp")
                    ->where("YEAR(tgl_input)", $year)
                    ->where("MONTH(tgl_input)", $month)
                    ->where_in("tgl_input", $date)
                    ->where("user", $user['user'])
                    ->group_by("tgl_input")
                    ->count_all_results();
            }
            
            $workDays[] = [
                "user" => $user['user'],
                "work_day" => $day
            ];
        }

        return $workDays;
    }

    public function personWasteWorks($year, $month)
    {
        $users = $this->db
            ->select("user_id_wst, SUM(wst_qty) as total_waste")
            ->from("waste_proses")
            ->where("YEAR(tgl_wst)", $year)
            ->where("MONTH(tgl_wst)", $month)
            ->where("user_id_wst !=", "")
            ->where_not_in("user_id_wst", ["ricky", "putra", "bangkit", "riswanto", "packing3", "packing2", "firdaus", "faisal", "alim"])
            ->group_by("user_id_wst")
            ->get()
            ->result();
                
        $dates = $this->db
            ->select("tgl_wst")
            ->from("waste_proses")
            ->where("YEAR(tgl_wst)", $year)
            ->where("MONTH(tgl_wst)", $month)
            ->group_by("tgl_wst")
            ->get()
            ->result();

        $date = [];
        foreach ($dates as $dt) {
           $date[] = $dt->tgl_wst;
        }
        
        $workDays = [];
        foreach ($users as $user) {
            $day = $this->db
                ->select("tgl_wst")
                ->from("waste_proses")
                ->where("YEAR(tgl_wst)", $year)
                ->where("MONTH(tgl_wst)", $month)
                ->where_in("tgl_wst", $date)
                ->where("user_id_wst", $user->user_id_wst)
                ->group_by("tgl_wst")
                ->count_all_results();
            
            $workDays[] = [
                "user" => $user->user_id_wst,
                "work_day" => $day,
                "total_waste" => $user->total_waste
            ];
        }

        return $workDays;
    }
}
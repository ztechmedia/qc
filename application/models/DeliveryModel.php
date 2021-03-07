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
            ->where('a.jumlah_roll', 0)
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
            ->where('a.jumlah_roll', 0)
            ->where('b.jenis_roll', $jenis)
            ->get()
            ->row()
            ->total_kirim;
    }
}
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SummaryModel extends CI_Model
{
    public function getTotalSlitt($first, $last)
    {
        return $this->db
                ->select('status, jenis_roll_slitt, kg_hasil_slitt, inputan, 
                    mic_inputan_slitt, lebar_inputan_slitt, panjang_inputan_slitt, stock')
                ->from("input_lap_slitting")
                ->where("tgl >=", $first)
                ->where("tgl <=", $last)
                ->where_not_in("nama_mesin", ["Secondary 1", "Secondary 2"])
                ->where("status !=", "")
                ->get()
                ->result();
    }
}
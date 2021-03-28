<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SummaryModel extends CI_Model
{
    public function getProducts($time)
    {
        $first = $time['first_day'];
        $last = $time['last_day'];
        return $this->db
                ->query(
                    "SELECT tgl, status, kg_hasil_slitt, jenis_roll_slitt 
                        FROM input_lap_slitting 
                        WHERE tgl BETWEEN '$first' AND '$last'
                        AND nama_mesin NOT IN ('Secondary 1', 'Secondary 2')
                        AND stock != 'Base Film'
                        AND status != ''
                ")
                ->result();
    }
}
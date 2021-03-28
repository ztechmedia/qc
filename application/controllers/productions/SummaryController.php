<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SummaryController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("BaseModel", "BM");
        $this->load->model("SummaryModel", "Summary");
        $this->load->helper("utility");
        $this->auth->logged();
    }

    public function summary($year)
    {
        $totalWeek = totalWeek($year);
        $dateByWeek = dateByWeek($year, $totalWeek);
        $dataSlitt = array();
        $total_slitt_ok = 0;
        $total_slitt_hold = 0;
        $total_slitt_not = 0;

        foreach ($dateByWeek as $key => $time) {
            $dataRoll = array();
            $products = $this->Summary->getProducts($time);
            $total_berat_ok = 0;
            $total_berat_hold = 0;
            $total_berat_not = 0;
            $total_roll_ok = 0;
            $total_roll_hold = 0;
            $total_roll_not = 0;

            foreach ($products as $product) {
                $ok = 0;
                $berat_ok = 0;
                $hold = 0;
                $berat_hold = 0;
                $not = 0;
                $berat_not = 0;
                if($product->status == "OK" || $product->status == "NCR") {
                    $ok += 1;
                    $berat_ok = $product->kg_hasil_slitt;
                } else if($product->status == "HOLD") {
                    $hold += 1;
                    $berat_hold = $product->kg_hasil_slitt;
                } else if($product->status == "NOT") {
                    $not += 1;
                    $berat_not = $product->kg_hasil_slitt;
                }

                if(!array_key_exists($product->tgl, $dataRoll)) {
                    $jenis = $product->jenis_roll_slitt == "POLOSAN" ? "METALIZZED" : "POLOSAN";

                    $dataRoll[$product->tgl][$product->jenis_roll_slitt] = [
                        "OK" => $ok,
                        "HOLD" => $hold,
                        "NOT" => $not,
                        "berat_ok" => $berat_ok,
                        "berat_hold" => $berat_hold,
                        "berat_not" => $berat_not
                    ];

                    $dataRoll[$product->tgl][$jenis] = [
                        "OK" => 0,
                        "HOLD" => 0,
                        "NOT" => 0,
                        "berat_ok" => 0,
                        "berat_hold" => 0,
                        "berat_not" => 0
                    ];
                } else {
                    $dataRoll[$product->tgl][$product->jenis_roll_slitt] = [
                        "OK" => $dataRoll[$product->tgl][$product->jenis_roll_slitt]["OK"] + $ok,
                        "HOLD" => $dataRoll[$product->tgl][$product->jenis_roll_slitt]["HOLD"] + $hold,
                        "NOT" => $dataRoll[$product->tgl][$product->jenis_roll_slitt]["NOT"] + $not,
                        "berat_ok" => $dataRoll[$product->tgl][$product->jenis_roll_slitt]["berat_ok"] + $berat_ok,
                        "berat_hold" => $dataRoll[$product->tgl][$product->jenis_roll_slitt]["berat_hold"] + $berat_hold,
                        "berat_not" => $dataRoll[$product->tgl][$product->jenis_roll_slitt]["berat_not"] + $berat_not,
                    ];
                }

                $total_berat_ok += $berat_ok;
                $total_berat_hold += $berat_hold;
                $total_berat_not += $berat_not;
                $total_roll_ok += $ok;
                $total_roll_hold += $hold;
                $total_roll_not += $not;
            }

            $total_slitt_ok += $total_berat_ok;
            $total_slitt_hold += $total_berat_hold;
            $total_slitt_not += $total_berat_not;

            $dataSlitt[] = [
                'week' => $time['week'],
                'first_day' => $time['first_day'],
                'last_day' => $time['last_day'],
                'total_berat_ok' => toRp($total_berat_ok). ' Kg',
                'total_berat_hold' => toRp($total_berat_hold). ' Kg',
                'total_berat_not' => toRp($total_berat_not). ' Kg',
                'total_roll_ok' => $total_roll_ok,
                'total_roll_hold' => $total_roll_hold,
                'total_roll_not' => $total_roll_not,
                'product' => $dataRoll
            ];
        }

        $data = [
            "products" => $dataSlitt,
            "total_slitt_ok" => $total_slitt_ok,
            "total_slitt_hold" => $total_slitt_hold,
            "total_slitt_not" => $total_slitt_not,
            "year" => $year
        ];
        $this->load->view('admin/summary/summary', $data);
    }
}
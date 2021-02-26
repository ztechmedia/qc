<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ReleasedController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("BaseModel", "BM");
        $this->load->model("ReleasedModel", "Released");
        $this->load->library('Datatables', 'datatables');
        $this->load->helper("utility");
        $this->auth->logged();
        $this->table = "released_jr";
    }

    public function released($year, $month)
    {
        $rolls = $this->Released->getCountMonth($year, $month);
        $rollsyear = $this->Released->getCountYear($year);

        $totalRoll = 0;
        $status = [
            "HOLD" => 0,
            "REWORK" => 0,
            "REJECT" => 0
        ];

        foreach ($rolls as $roll) {
            $totalRoll += $roll->total;
        }

        foreach ($rolls as $roll) {
            $status[$roll->status_akhir] = [
                "total" => $roll->total,
                "percent" => $roll->total > 0 ? ($roll->total / $totalRoll) * 100 : 0,
                "total_kg" => $roll->total_kg
            ];
        }

        $data = [];
        $hold = [];
        $rework = [];
        $reject = [];
        for ($i=1; $i <= 12 ; $i++) { 
            foreach ($rollsyear as $roll) {
                if($roll->month == $i) {
                    if($roll->status == "HOLD") {
                        $data["HOLD"][$i] = [
                            "total" => $roll->total   
                        ];
                    }

                    if($roll->status == "REWORK") {
                        $data["REWORK"][$i] = [
                            "total" => $roll->total   
                        ];
                    }

                    if($roll->status == "REJECT") {
                        $data["REJECT"][$i] = [
                            "total" => $roll->total   
                        ];
                    }
                }
            }
        }

        for ($i=1; $i <= 12 ; $i++) { 
            if(array_key_exists("HOLD", $data)) {
                if(array_key_exists($i, $data["HOLD"])) {
                    $hold[] = intval($data["HOLD"][$i]["total"]);
                } else {
                    $hold[] = 0;
                }
            } else {
                $hold[] = 0;
            }
            
            if(array_key_exists("REWORK", $data)) {
                if(array_key_exists($i, $data["REWORK"])) {
                    $rework[] = intval($data["REWORK"][$i]["total"]);
                } else {
                    $rework[] = 0;
                }
            }else {
                $rework[] = 0;
            }

            if(array_key_exists("REJECT", $data)) {
                if(array_key_exists($i, $data["REJECT"])) {
                    $reject[] = intval($data["REJECT"][$i]["total"]);
                } else {
                    $reject[] = 0;
                }
            }else {
                $reject[] = 0;
            }
        }

        $rollsTable = $this->Released->getRolls($year, $month);
        $data = [
            "totalRoll" => $totalRoll,
            "year" => $year,
            "month" => $month,
            "hold" => $hold,
            "rework" => $rework,
            "reject" => $reject,
            "fullMonth" => mToMonth($month),
            "status" => $status,
            "rolls" => $rollsTable
        ];

        $this->load->view("admin/productions/released/released", $data);
    }

}
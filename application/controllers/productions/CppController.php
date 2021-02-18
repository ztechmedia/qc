<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CppController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("BaseModel", "BM");
        $this->load->model("CppModel", "CPP");
        $this->load->library("Search", "search");
        $this->load->library("form_validation");
        $this->load->helper("utility");
        $this->auth->logged();
    }

    //@desc     CPP view
    //@route    GET /admin/productions/cpp
    public function cpp($year, $month, $day)
    {
        $data = [
            "year" => $year,
            "month" => $month,
            "day" => $day
        ];
        $this->load->view("admin/productions/cpp/cpp", $data);
    }

    //@desc     Tab on cpp menu view
    //@route    GET /admin/productions/cpp/tab/:tabName
    public function tab($tabName, $year, $month, $day, $filtered)
    {
        if ($tabName == "cpp1") {
            $machine = "1";
        } else if ($tabName == "cpp2") {
            $machine = "2";
        }

        $totalRollArray = $this->CPP->totalRoll($machine, $year = 2021, $month = 1);
        $totalRoll = $totalRollArray[0]->total ? $totalRollArray[0]->total : 0;
        $totalWeight = $totalRollArray[0]->weight ? $totalRollArray[0]->weight : 0;

        $statusQc = $this->CPP->totalRollStatus($machine, $year, $month);
        $ok = 0;
        $hold = 0;
        foreach ($statusQc as $status) {
            if($status->status == "OK" || $status->status == "NCR") {
                $ok += $status->total_status;
            } else if($status->status == "HOLD") {
                $hold += $status->total_status;
            } 
        }

        $currDate = date("Y-m-d", strtotime($year . "-" . $month . "-" . $day));

        $statusQcDay = $this->CPP->totalRollStatusDay($machine, $currDate);
        $okDay = 0;
        $holdDay = 0;
        foreach ($statusQcDay as $status) {
            if($status->status == "OK" || $status->status == "NCR") {
                $okDay += $status->total_status;
            } else if($status->status == "HOLD") {
                $holdDay += $status->total_status;
            }
        }
        $totalRollDay = $okDay + $holdDay;
        $data = [
            "tabName" => $tabName,
            "machineName" => $machine,
            "now" => toDay(date("Y-m-d")),
            "year" => $year,
            "month" => $month,
            "day" => $day,
            "totalRoll" => $totalRoll,
            "totalRollDay" => $totalRollDay,
            "totalWeight" => round($totalWeight),
            "thisMonth" => mToMonth($month) . " " . $year,
            "toDay" => toIndoDateDay($currDate),
            "currDate" => $currDate,
            "ok" => [
                "percen" => $ok > 0 ? ($ok / $totalRoll) * 100 : 0,
                "data" => $ok,
            ],
            "hold" => [
                "percen" => $hold > 0 ? ($hold / $totalRoll) * 100 : 0,
                "data" => $hold,
            ],
            "okDay" => [
                "percen" => $okDay > 0 ? ($okDay / $totalRollDay) * 100 : 0,
                "data" => $okDay,
            ],
            "holdDay" => [
                "percen" => $holdDay > 0 ? ($holdDay / $totalRollDay) * 100 : 0,
                "data" => $holdDay,
            ],
        ];
        $this->load->view("admin/productions/cpp/cpp-tab", $data);
    }

    public function cppTable()
    {
        $data = $this->search->advanceSearch(
            //params
            $_GET,
            //table
            "input_lap_cpp",
            //field date in table if u using date search
            $dateField = "tgl_input",
            //column to show
            "id, tgl_input, shift, regu, type, tebal, lebar, panjang, kode_roll, no_spk, kode_mesin, 
                kg_hasil_cpp, keterangan_cpp, status, qc_haze, qc_corona",
            //order by
            $order_by = [
                "tgl_input" => "desc",
                "id" => "desc"
            ]
        );
        $this->load->view("admin/productions/cpp/cpp-table", $data);
    }

    public function changeDesc()
    {
        $obj = fileGetContent();
        $data["keterangan_cpp"] = $obj->value;
        $update = $this->BM->update("input_lap_cpp", $obj->id, "id", $data);
        if ($update) {
            appJson([
                "message" => "Berhasil mengubah keterangan",
            ]);
        }
    }

    public function changeHaze()
    {
        $obj = fileGetContent();
        $data["qc_haze"] = $obj->value;
        $update = $this->BM->update("input_lap_cpp", $obj->id, "id", $data);
        if ($update) {
            appJson([
                "message" => "Berhasil mengubah haze",
            ]);
        }
    }

    //@desc     Change status view
    //@route    GET /admin/productions/cpp/change-status/:id
    public function changeStatus($id)
    {
        $product = $this->BM->getWhere("input_lap_cpp", ['id' => $id])->row();
        $data = [
            "id" => $id,
            "product" => " <b>No Lot: $product->kode_roll</b>",
        ];
        $this->load->view("admin/productions/actions/change-status-met", $data);
    }

    //@desc     Change status action
    //@route    GET /admin/productions/cpp/change-status-action
    public function changeStatusAction()
    {
        $obj = fileGetContent();
        $id = $obj->id;
        $status = $obj->status;
        $update = $this->BM->update("input_lap_cpp", $id, "id", ["status" => $status]);

        $statusClass = [
            "OK" => "ok",
            "HOLD" => "hold",
        ];

        if ($update) {
            appJson([
                "id" => $id,
                "newClass" => $statusClass[$status],
                "status" => $status,
                "message" => "Berhasil mengubah status",
            ]);
        }
    }

    public function changeCorona()
    {
        $obj = fileGetContent();
        $data["qc_corona"] = $obj->value;
        $update = $this->BM->update("input_lap_cpp", $obj->id, "id", $data);
        if ($update) {
            appJson([
                "message" => "Berhasil mengubah corona",
            ]);
        }
    }
    
}
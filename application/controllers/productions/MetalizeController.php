<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MetalizeController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("BaseModel", "BM");
        $this->load->model("MetalizeModel", "Metalize");
        $this->load->library("Search", "search");
        $this->load->library("form_validation");
        $this->load->helper("utility");
        $this->auth->logged();
    }

    //@desc     Metalize view
    //@route    GET /admin/productions/metalize
    public function metalize($year, $month, $day)
    {
        $data = [
            "year" => $year,
            "month" => $month,
            "day" => $day,
        ];
        $this->load->view("admin/productions/metalize/metalize", $data);
    }

    //@desc     Tab on metalize menu view
    //@route    GET /admin/productions/metalize/tab/:tabName
    public function tab($tabName, $year, $month, $day, $filtered)
    {
        if ($tabName == "mtz1") {
            $machine = "1";
        } else if ($tabName == "mtz2") {
            $machine = "2";
        }

        if ($tabName == "mtz1") {
            $machine = "1";
        } else if ($tabName == "mtz2") {
            $machine = "2";
        }

        $totalRollArray = $this->Metalize->totalRoll($machine, $year, $month);
        $totalRoll = $totalRollArray[0]->total ? $totalRollArray[0]->total : 0;
        $totalWeight = $totalRollArray[0]->weight ? $totalRollArray[0]->weight : 0;
        
        $statusQc = $this->Metalize->totalRollStatus($machine, $year, $month);
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

        $statusQcDay = $this->Metalize->totalRollStatusDay($machine, $currDate);
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
            "totalWeight" => $totalWeight,
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
        $this->load->view("admin/productions/metalize/metalize-tab", $data);
    }

    public function metalizeTable()
    {
        $data = $this->search->advanceSearch(
            //params
            $_GET,
            //table
            "input_met",
            //field date in table if u using date search
            $dateField = "tgl_input",
            //column to show
            "id_met, tgl_input, inputan_bf, type_input_met, shift, tebal_inp_met, lebar_inp_met, 
            panjang_inp_met, closed, opened, output_kode_roll, output_type_met, mic_met, lebar_met, 
            panjang_met, ket_met, status_met, kg_hasil_met,
            qc_corona, qc_od, qc_defects, qc_eaa, regu, user",
            //order by
            $order_by = [
                "tgl_input" => "desc",
                "id_met" => "desc",
            ]
        );

        $slitting  = $this->Metalize->getSlittingStatus($_GET['year'], $_GET['month']);
        $status = [];
        foreach ($slitting as $st) {
            if(array_key_exists($st->inputan, $status)){
                $status[$st->inputan][$st->status] += + 1;
            } else {
                $status[$st->inputan] = [
                    "OK" => 0,
                    "NCR" => 0,
                    "HOLD" => 0,
                    "NOT" => 0
                ];
                
                $status[$st->inputan][$st->status] += + 1;
            }
        }

        $data['status'] = $status;
        $this->load->view("admin/productions/metalize/metalize-table", $data);
    }

    //@desc     Change status view
    //@route    GET /admin/productions/metalize/change-status/:id
    public function changeStatus($id)
    {
        $product = $this->BM->getWhere("input_met", ['id_met' => $id])->row();
        $data = [
            "id" => $id,
            "product" => " <b>No Lot: $product->output_kode_roll</b>",
        ];
        $this->load->view("admin/productions/actions/change-status-met", $data);
    }

    //@desc     Change status action
    //@route    GET /admin/productions/metalize/change-status-action
    public function changeStatusAction()
    {
        $obj = fileGetContent();
        $id = $obj->id;
        $status = $obj->status;
        $update = $this->BM->update("input_met", $id, "id_met", ["status_met" => $status]);

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
        $update = $this->BM->update("input_met", $obj->id, "id_met", $data);
        if ($update) {
            appJson([
                "message" => "Berhasil mengubah corona",
            ]);
        }
    }

    //@desc     Change defect view
    //@route    GET /admin/productions/metalize/change-defect/:id
    public function changeDefect($id)
    {
        $product = $this->BM->getWhere("input_met", ['id_met' => $id])->row();
        $defects = $this->db->order_by("alias", "asc")->get("qc_defect_alias")->result();
        $newDefect = [];
        if ($product->qc_defects != null) {
            $currDefect = unserialize($product->qc_defects);
            foreach ($defects as $defect) {
                if (array_key_exists($defect->alias, $currDefect)) {
                    $newDefect[$defect->alias] = [
                        "defect" => $defect->defect,
                        "value" => $currDefect[$defect->alias],
                    ];
                } else {
                    $newDefect[$defect->alias] = [
                        "defect" => $defect->defect,
                        "value" => $defect->def_default,
                    ];
                }
            }
        } else {
            foreach ($defects as $defect) {
                $newDefect[$defect->alias] = [
                    "defect" => $defect->defect,
                    "value" => $defect->def_default,
                ];
            }
        }

        $data = [
            "id" => $id,
            "defects" => $newDefect,
            "url" => base_url("admin/productions/metalize/change-defect/$id/action"),
        ];

        $this->load->view("admin/productions/actions/change-defect", $data);
    }

    //@desc     Change defect action
    //@route    GET /admin/productions/metalize/change-defect/:id/action
    public function changeDefectAction($id)
    {
        $post = getPost();
        $defects = $post["defects"];
        $newDefect = [];
        foreach ($defects as $defect) {
            $expDef = explode(":", $defect);
            if (count($expDef) > 1) {
                $newDefect[$expDef[0]] = $expDef[1];
            } else {
                $newDefect[$expDef[0]] = "";
            }
        }
        $data["qc_defects"] = serialize($newDefect);
        $update = $this->BM->update("input_met", $id, "id_met", $data);
        $defect = "";
        $xx = "";
        $xxx = "";
        foreach ($newDefect as $alias => $value) {
            if ($value == "XX" || $value >= 4) {
                if ($xx == "") {
                    $xx = $alias;
                } else {
                    $xx = $xx . "·" . $alias;
                }
            } else if ($value == "XXX" || $value >= 6) {
                if ($xxx == "") {
                    $xxx = $alias;
                } else {
                    $xxx = $xxx . "·" . $alias;
                }
            }
        }
        $xx = $xx != "" ? "[ $xx ]" : $xx;
        $xxx = $xxx != "" ? "[ $xxx ]" : $xxx;
        $defect = "2X: " . $xx . "<br> 3X: " . $xxx;

        if ($update) {
            appJson([
                "id" => $id,
                "message" => "Berhasil update defect",
                "defect" => $defect,
            ]);
        }
    }

    //@desc     Change od view
    //@route    GET /admin/productions/metalize/change-od/:id
    public function changeOd($id)
    {
        $product = $this->BM->getWhere("input_met", ['id_met' => $id])->row();
        $newOd = [];
        if ($product->qc_od != null) {
            $od = unserialize($product->qc_od);
            for ($i = 0; $i < 10; $i++) {
                if (array_key_exists($i, $od)) {
                    $newOd[] = $od[$i];
                } else {
                    $newOd[] = "";
                }
            }
        } else {
            for ($i = 0; $i < 10; $i++) {
                $newOd[] = "";
            }
        }

        $data = [
            "id" => $id,
            "product" => " <b>No Lot: $product->output_kode_roll </b>",
            "od" => $newOd,
            "url" => base_url("admin/productions/metalize/change-od/$id/action"),
        ];

        $this->load->view("admin/productions/actions/change-od", $data);
    }
    
    //@desc     Change od action
    //@route    GET /admin/productions/metalize/change-od/:id/action
    public function changeOdAction($id)
    {
        $post = getPost();
        $od = $post["od"];
        $data["qc_od"] = serialize($od);
        $update = $this->BM->update("input_met", $id, "id_met", $data);

        $min = min($od);
        $max = max($od);
        $od = array_filter($od);
        $odSum = array_sum($od);
        $avg = $odSum > 0 ? substr($odSum / count($od), 0, 4) : 0;
        $maxV = $max ? $max : 0;
        $minV = $min ? $min : 0;
        $od = "OD: $minV" . "·" . $maxV . "·" . $avg;
        if ($update) {
            appJson([
                "id" => $id,
                "message" => "Berhasil update defect",
                "od" => $od,
            ]);
        }
    }

    //@desc     Change eaa view
    //@route    GET /admin/productions/metalize/change-eaa/:id
    public function changeEaa($id)
    {
        $product = $this->BM->getWhere("input_met", ['id_met' => $id])->row();
        $newEaa = [];
        if ($product->qc_eaa != null) {
            $eaa = unserialize($product->qc_eaa);
            for ($i = 0; $i < 3; $i++) {
                if (array_key_exists($i, $eaa)) {
                    $newEaa[] = $eaa[$i];
                } else {
                    $newEaa[] = "";
                }
            }
        } else {
            for ($i = 0; $i < 3; $i++) {
                $newEaa[] = "";
            }
        }

        $data = [
            "id" => $id,
            "product" => " <b>No Lot: $product->output_kode_roll </b>",
            "eaa" => $newEaa,
            "url" => base_url("admin/productions/metalize/change-eaa/$id/action"),
        ];

        $this->load->view("admin/productions/actions/change-eaa", $data);
    }

    //@desc     Change od action
    //@route    GET /admin/productions/metalize/change-eaa/:id/action
    public function changeEaaAction($id)
    {
        $post = getPost();
        $eaa = $post["eaa"];
        $data["qc_eaa"] = serialize($eaa);
        $update = $this->BM->update("input_met", $id, "id_met", $data);

        $eaa = "EAA: $eaa[0]" . "·" . $eaa[1] . "·" . $eaa[2];
        if ($update) {
            appJson([
                "id" => $id,
                "message" => "Berhasil update defect",
                "od" => $eaa,
            ]);
        }
    }

    public function changeDesc()
    {
        $obj = fileGetContent();
        $data["ket_met"] = strtoupper($obj->value);
        $update = $this->BM->update("input_met", $obj->id, "id_met", $data);
        if ($update) {
            appJson([
                "message" => "Berhasil mengubah keterangan",
            ]);
        }
    }

    public function edit($date, $id)
    {
        $date = explode("-", $date);
        $data = [
            "year" => $date[0],
            "month" => $date[1],
            "date" => $date[2]
        ];
        $data["metalize"] = $this->BM->getWhere('input_met', ['id_met' => $id])->row();
        $this->load->view('admin/productions/metalize/edit', $data);
    }
    
    public function update($id)
    {
        $post = getPost();
        $post["kg_hasil_met"] = number_format(($post['lebar_met']/1000) * $post['panjang_met'] * 0.91 * ($post['mic_met']/1000), 2, ".", "");
        $update = $this->BM->update("input_met", $id, "id_met", $post);
        
        if($update) {
            appJson(["message" => "Berhasil update roll Metalize"]);
        }
    }
}
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SlittingController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("BaseModel", "BM");
        $this->load->model("SlittingModel", "Slitting");
        $this->load->library("Search", "search");
        $this->load->library("form_validation");
        $this->load->helper("utility");
        $this->auth->logged();
    }

    //customer aliases
    public function customerAlias()
    {
        $aliases = $this->BM->getAll("qc_customer_alias");
        $newCustomer = [];
        foreach ($aliases as $alias) {
            $newCustomer[$alias->customer] = $alias->alias;
        }
        return $newCustomer;
    }

    //@desc     Slitting view
    //@route    GET /admin/productions/slitting
    public function slitting($year, $month, $day)
    {
        $data = [
            "year" => $year,
            "month" => $month,
            "day" => $day,
        ];

        $this->load->view("admin/productions/slitting/slitting", $data);
    }

    //@desc     Tab on slitting menu view
    //@route    GET /admin/productions/slitting/tab/:tabName
    public function tab($tabName, $year, $month, $day, $filtered)
    {
        if ($tabName == "scpp1") {
            $machine = "Sliting CPP 1";
        } else if ($tabName == "scpp2") {
            $machine = "Sliting CPP 2";
        } else if ($tabName == "scpp3") {
            $machine = "Sliting CPP 3";
        } else if ($tabName == "met1") {
            $machine = "Sliting Met 1";
        } else if ($tabName == "met2") {
            $machine = "Sliting Met 2";
        } else if ($tabName == "met3") {
            $machine = "Sliting Met 3";
        } else if ($tabName == "scnd1") {
            $machine = "Secondary 1";
        } else if ($tabName == "scnd2") {
            $machine = "Secondary 2";
        } else if ($tabName == "all") {
            $machine = "all";
        }

        $totalRoll = $this->Slitting->totalRollFG($machine, $year, $month);
        $totalRollFG = $totalRoll[0]->total ? $totalRoll[0]->total : 0;
        $totalWeight = $totalRoll[0]->weight ? $totalRoll[0]->weight : 0;

        $statusQc = $this->Slitting->totalRollStatus($machine, $year, $month);
        $ok = 0;
        $hold = 0;
        $not = 0;
        foreach ($statusQc as $status) {
            if($status->status == "OK" || $status->status == "NCR") {
                $ok += $status->total_status;
            } else if($status->status == "HOLD") {
                $hold += $status->total_status;
            } else if($status->status == "NOT") {
                $not += $status->total_status;
            }
        }

        $currDate = date("Y-m-d", strtotime($year . "-" . $month . "-" . $day));

        $statusQcDay = $this->Slitting->totalRollStatusDay($machine, $currDate);
        $okDay = 0;
        $holdDay = 0;
        $notDay = 0;
        foreach ($statusQcDay as $status) {
            if($status->status == "OK" || $status->status == "NCR") {
                $okDay += $status->total_status;
            } else if($status->status == "HOLD") {
                $holdDay += $status->total_status;
            } else if($status->status == "NOT") {
                $notDay += $status->total_status;
            }
        }
        $totalRollDay = $okDay + $holdDay + $notDay;

        $data = [
            "tabName" => $tabName,
            "machineName" => $machine,
            "now" => toDay(date("Y-m-d")),
            "year" => $year,
            "month" => $month,
            "day" => $day,
            "totalRollFG" => $totalRollFG,
            "totalRollDay" => $totalRollDay,
            "totalWeight" => $totalWeight,
            "thisMonth" => mToMonth($month) . " " . $year,
            "toDay" => toIndoDateDay($currDate),
            "currDate" => $currDate,
            "ok" => [
                "percen" => $ok > 0 ? ($ok / $totalRollFG) * 100 : 0,
                "data" => $ok,
            ],
            "hold" => [
                "percen" => $hold > 0 ? ($hold / $totalRollFG) * 100 : 0,
                "data" => $hold,
            ],
            "not" => [
                "percen" => $not > 0 ? ($not / $totalRollFG) * 100 : 0,
                "data" => $not,
            ],
            "okDay" => [
                "percen" => $okDay > 0 ? ($okDay / $totalRollDay) * 100 : 0,
                "data" => $okDay,
            ],
            "holdDay" => [
                "percen" => $holdDay > 0 ? ($holdDay / $totalRollDay) * 100 : 0,
                "data" => $holdDay,
            ],
            "notDay" => [
                "percen" => $notDay > 0 ? ($notDay / $totalRollDay) * 100 : 0,
                "data" => $notDay,
            ],
        ];

        $this->load->view("admin/productions/slitting/slitting-tab", $data);
    }

    public function slittingTable()
    {
        $data = $this->search->advanceSearch(
            //params
            $_GET,
            //table
            "input_lap_slitting",
            //field date in table if u using date search
            $dateField = "tgl",
            //column to show
            "id_slitt, tgl, shift, type_slitt, mic_slitt, lebar_slitt, 
            panjang_slitt, kode_roll_slitt, status, ket, kg_hasil_slitt,
            customer_lap_slitt, qc_cof_statik, qc_cof_kinetik, qc_corona,
            jenis_roll_slitt, qc_defects, qc_od, stock, regu, nama_mesin, user",
            //order by
            $order_by = [
                "tgl" => "desc",
                // "shift" => "desc",
                "id_slitt" => "desc"
            ]
        );
        $data["customerAlias"] = $this->customerAlias();

        if($_GET["nama_mesin"] != "all") {
            $this->load->view("admin/productions/slitting/slitting-table", $data);
        } else {
            $year = $_GET["year"];
            $month = $_GET["month"];
            $rolls = $this->Slitting->getAllRolls($year, $month);
            $met = [];
            $polos = [];
            foreach ($rolls as $roll) {
                $slitt_roll = explode("x", str_replace(" ", "", $roll->slitt_roll));
            if(
                $slitt_roll[2] == "4000" || $slitt_roll[2] == "6000" || 
                $slitt_roll[2] == "8000" || $slitt_roll[2] == "10000" || $slitt_roll[2] == "12000") 
                {
                    $roll->jenis_roll_slitt == "POLOSAN" ? $polos[] = $roll : $met[] = $roll;
                }
            }
            $data["year"] = $year;
            $data["month"] = $month;
            $data["polos"] = $polos;
            $data["met"] = $met;
            $this->load->view("admin/productions/slitting/slitting-all-table", $data);
        }
    }

    //@desc     Change status view
    //@route    GET /admin/productions/slitting/change-status/:id
    public function changeStatus($id)
    {
        $product = $this->BM->getWhere("input_lap_slitting", ['id_slitt' => $id])->row();
        $data = [
            "id" => $id,
            "product" => " <b>No Lot: $product->kode_roll_slitt ($product->slitt_roll)</b>",
        ];
        $this->load->view("admin/productions/actions/change-status", $data);
    }

    //@desc     Change status action
    //@route    GET /admin/productions/slitting/change-status-action
    public function changeStatusAction()
    {
        $obj = fileGetContent();
        $id = $obj->id;
        $status = $obj->status;
        $data["status"] = $status;

        if($status == "HOLD" || $status == "NOT") {
            $data['stock'] = "Secondary";
	    $data['id_stock'] = 1;
        }else {
            $data['stock'] = "Packing";

            $rollSlitt = $this->BM->getWhere('input_lap_slitting', ['id_slitt' => $id])->row();
            $no_roll = $rollSlitt->kode_roll_slitt;
           
            $released = $this->BM->getWhere('released_jr', ['no_roll_released_jr' => $no_roll])->row();
            if($released) {
                $this->BM->delete('released_jr', ['no_roll_released_jr' => $no_roll]);
            }

            $reject = $this->BM->getWhere('stock_begrade', ['no_roll' => $no_roll])->row();
            if($reject) {
                $this->BM->delete('stock_begrade', ['no_roll' => $no_roll]);
            }
        }
        
        $update = $this->BM->update("input_lap_slitting", $id, "id_slitt", $data);

        $statusClass = [
            "OK" => "ok",
            "HOLD" => "hold",
            "NOT" => "not",
            "NCR" => "ncr"
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

    public function changeCof()
    {
        $obj = fileGetContent();
        $type = explode("-", $obj->type);
        $column = "qc_cof_$type[1]";
        $data[$column] = $obj->value;
        $update = $this->BM->update("input_lap_slitting", $obj->id, "id_slitt", $data);
        if ($update) {
            appJson([
                "message" => "Berhasil mengubah nilai COF"
            ]);
        }
    }

    public function changeDesc()
    {
        $obj = fileGetContent();
        $data["ket"] = strtoupper($obj->value);
        $update = $this->BM->update("input_lap_slitting", $obj->id, "id_slitt", $data);
        if ($update) {
            appJson([
                "message" => "Berhasil mengubah keterangan"
            ]);
        }
    }

    public function changeCorona()
    {
        $obj = fileGetContent();
        $data["qc_corona"] = $obj->value;
        $update = $this->BM->update("input_lap_slitting", $obj->id, "id_slitt", $data);
        if ($update) {
            appJson([
                "message" => "Berhasil mengubah corona"
            ]);
        }
    }

    //@desc     Change defect view
    //@route    GET /admin/productions/slitting/change-defect/:id
    public function changeDefect($id)
    {
        $product = $this->BM->getWhere("input_lap_slitting", ['id_slitt' => $id])->row();
        $defects = $this->db->order_by("alias", "asc")->get("qc_defect_alias")->result();
        $newDefect = [];
        if ($product->qc_defects != null) {
            $currDefect = unserialize($product->qc_defects);
            foreach ($defects as $defect) {
                if (array_key_exists($defect->alias, $currDefect)) {
                    $newDefect[$defect->alias] = [
                        "defect" => $defect->defect,
                        "value" => $currDefect[$defect->alias]
                    ];
                } else {
                    $newDefect[$defect->alias] = [
                        "defect" => $defect->defect,
                        "value" => $defect->def_default
                    ];
                }
            }
        } else {
            foreach ($defects as $defect) {
                $newDefect[$defect->alias] = [
                    "defect" => $defect->defect,
                    "value" => $defect->def_default
                ];
            }
        }

        $data = [
            "id" => $id,
            "defects" => $newDefect,
            "url" => base_url("admin/productions/slitting/change-defect/$id/action")
        ];

        $this->load->view("admin/productions/actions/change-defect", $data);
    }

    //@desc     Change defect action
    //@route    GET /admin/productions/slitting/change-defect/:id/action
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
        $update = $this->BM->update("input_lap_slitting", $id, "id_slitt", $data);
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
                "defect" => $defect
            ]);
        }
    }

    //@desc     Change od view
    //@route    GET /admin/productions/slitting/change-od/:id
    public function changeOd($id)
    {
        $product = $this->BM->getWhere("input_lap_slitting", ['id_slitt' => $id])->row();
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
            for ($i = 1; $i <= 10; $i++) {
                $newOd[] = "";
            }
        }

        $data = [
            "id" => $id,
            "product" => " <b>No Lot: $product->kode_roll_slitt ($product->slitt_roll)</b>",
            "od" => $newOd,
            "url" => base_url("admin/productions/slitting/change-od/$id/action")
        ];

        $this->load->view("admin/productions/actions/change-od", $data);
    }

    //@desc     Change defect action
    //@route    GET /admin/productions/slitting/change-od/:id/action
    public function changeOdAction($id)
    {
        $post = getPost();
        $od = $post["od"];
        $data["qc_od"] = serialize($od);
        $update = $this->BM->update("input_lap_slitting", $id, "id_slitt", $data);
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
                "od" => "OD: $minV" . "·" . $maxV . "·" . $avg
            ]);
        }
    }

    public function ncr($date, $group)
    {
        $rolls = $this->Slitting->ncr(revDate($date), $group);
        $data = [
            "date" => $date,
            "group" => $group,
            "rolls" => $rolls
        ];

        $this->load->view('admin/print/ncr', $data);
    }

    public function printNcr($date, $slitt_roll, $group)
    {
	$date = revDate($date);
        $customer = $this->db->get_where("input_lap_slitting", 
            ["tgl" => $date, "regu" => $group, "slitt_roll" => str_replace("-", " ", $slitt_roll)])->row()->customer_lap_slitt;
        $rolls = $this->Slitting->printNcr($date, $group, $customer);
        $data = [
            "customer" => $customer,
            "rolls" => $rolls
        ];

        $this->load->view("admin/print/print-ncr", $data);
    }

    public function edit($date, $id)
    {
        $date = explode("-", $date);
        $data = [
            "year" => $date[0],
            "month" => $date[1],
            "date" => $date[2]
        ];
        $data["slitting"] = $this->BM->getWhere('input_lap_slitting', ['id_slitt' => $id])->row();
        $this->load->view('admin/productions/slitting/edit', $data);
    }
    
    public function update($id)
    {
        $post = getPost();
        $post["tgl"] = revDate($post["tgl"]);
        $post["kg_hasil_slitt"] = number_format(($post['lebar_slitt']/1000) * $post['panjang_slitt'] * 0.91 * ($post['mic_slitt']/1000), 2, ".", "");
        $update = $this->BM->update("input_lap_slitting", $id, "id_slitt", $post);
        
        if($update) {
            appJson(["message" => "Berhasil update roll"]);
        }
    }
}
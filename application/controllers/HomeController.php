<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HomeController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("BaseModel", "BM");
        $this->load->model("SlittingModel", "Slitting");
        $this->load->model("CppModel", "CPP");
        $this->load->model("MetalizeModel", "Metalize");
        $this->load->helper("utility");
        $this->auth->logged();
    }

    public function developer()
    {
        $this->load->view("admin/developer");
    }

    public function slitting($year, $month)
    {
        $monthlyGraph = $this->monthlyGraph($year, "Slitting");
       
        $A = $this->groupPerformance($year, $month, "A", "Slitting");
        $B = $this->groupPerformance($year, $month, "B", "Slitting");
        $C = $this->groupPerformance($year, $month, "C", "Slitting");
        $D = $this->groupPerformance($year, $month, "D", "Slitting");
        
        $person = $this->personPerformance($year, "POLOSAN", "Slitting");
        $person_month = $this->personPerformanceMonth($year, $month, $person["person"], "POLOSAN", "Slitting");
        $person_met = $this->personPerformance($year, "METALIZZED", "Slitting");
        $person_met_month = $this->personPerformanceMonth($year, $month, $person_met["person"], "METALIZZED", "Slitting");
        $person_all = $this->personPerformance($year, "", "Slitting");
        $person_all_month = $this->personPerformanceMonth($year, $month, $person_all["person"], "", "Slitting");
        $totalOk = $A["OK"] + $B["OK"] + $C["OK"] + $D["OK"]; 
        $totalNot = $A["HOLD"] + $B["HOLD"] + $C["HOLD"] + $D["HOLD"] 
                    + $A["NOT"] + $B["NOT"] + $C["NOT"] + $D["NOT"]; 
        $json = [
            "year" => $year,
            "month" => $month,
            "ok" => $monthlyGraph["ok"],
            "hold" => $monthlyGraph["hold"],
            "not" => $monthlyGraph["not"],
            "person" => $person["person"],
            "total_roll" => $person["total_roll"],
            "total_roll_month" => $person_month["total_roll"],
            "person_met" => $person_met["person"],
            "total_roll_met" => $person_met["total_roll"],
            "total_roll_met_month" => $person_met_month["total_roll"],
            "person_all" => $person_all["person"],
            "total_roll_all" => $person_all["total_roll"],
            "total_roll_all_month" => $person_all_month["total_roll"],
            "AOK" => $A["OK"] > 0 ? ($A["OK"] / $totalOk) * 100 : 0,
            "BOK" => $B["OK"] > 0 ? ($B["OK"] / $totalOk) * 100 : 0,
            "COK" => $C["OK"] > 0 ? ($C["OK"] / $totalOk) * 100 : 0,
            "DOK" => $D["OK"] > 0 ? ($D["OK"] / $totalOk) * 100 : 0,

            "ANOT" => ($A["HOLD"] + $A["NOT"]) > 0 
                ? (($A["HOLD"] + $A["NOT"]) / $totalNot) * 100 : 0,

            "BNOT" => $B["HOLD"] + $B["NOT"] > 0 
                ? (($B["HOLD"] + $B["NOT"]) / $totalNot) * 100 : 0,

            "CNOT" => $C["HOLD"] + $C["NOT"] > 0 
                ? (($C["HOLD"] + $C["NOT"]) / $totalNot) * 100 : 0,

            "DNOT" => $D["HOLD"] + $D["NOT"] > 0 
                ? (($D["HOLD"] + $D["NOT"]) / $totalNot) * 100 : 0,

            "AQOK" => $A["OK"],
            "BQOK" => $B["OK"],
            "CQOK" => $C["OK"],
            "DQOK" => $D["OK"],
            "AQHOLD" => $A["HOLD"] + $A["NOT"],
            "BQHOLD" => $B["HOLD"] + $B["NOT"],
            "CQHOLD" => $C["HOLD"] + $C["NOT"],
            "DQHOLD" => $D["HOLD"] + $D["NOT"],
        ];
        
        $this->load->view('admin/performance/slitting', $json);
    }

    public function cpp($year, $month)
    {
        $monthlyGraph = $this->monthlyGraph($year, "CPP");
        $A = $this->groupPerformance($year, $month, "A", "CPP");
        $B = $this->groupPerformance($year, $month, "B", "CPP");
        $C = $this->groupPerformance($year, $month, "C", "CPP");
        $D = $this->groupPerformance($year, $month, "D", "CPP");

        $person = $this->personPerformance($year, "", "CPP");
        $person_month = $this->personPerformanceMonth($year, $month, $person["person"], "", "CPP");
        $totalOk = $A["OK"] + $B["OK"] + $C["OK"] + $D["OK"]; 
        $totalNot = $A["HOLD"] + $B["HOLD"] + $C["HOLD"] + $D["HOLD"] 
                    + $A["NOT"] + $B["NOT"] + $C["NOT"] + $D["NOT"]; 
        $json = [
            "year" => $year,
            "month" => $month,
            "ok" => $monthlyGraph["ok"],
            "hold" => $monthlyGraph["hold"],
            "not" => $monthlyGraph["not"],
            "person" => $person["person"],
            "total_roll" => $person["total_roll"],
            "total_roll_month" => $person_month["total_roll"],
            "AOK" => $A["OK"] > 0 ? ($A["OK"] / $totalOk) * 100 : 0,
            "BOK" => $B["OK"] > 0 ? ($B["OK"] / $totalOk) * 100 : 0,
            "COK" => $C["OK"] > 0 ? ($C["OK"] / $totalOk) * 100 : 0,
            "DOK" => $D["OK"] > 0 ? ($D["OK"] / $totalOk) * 100 : 0,

            "ANOT" => ($A["HOLD"] + $A["NOT"]) > 0 
                ? (($A["HOLD"] + $A["NOT"]) / $totalNot) * 100 : 0,

            "BNOT" => $B["HOLD"] + $B["NOT"] > 0 
                ? (($B["HOLD"] + $B["NOT"]) / $totalNot) * 100 : 0,

            "CNOT" => $C["HOLD"] + $C["NOT"] > 0 
                ? (($C["HOLD"] + $C["NOT"]) / $totalNot) * 100 : 0,

            "DNOT" => $D["HOLD"] + $D["NOT"] > 0 
                ? (($D["HOLD"] + $D["NOT"]) / $totalNot) * 100 : 0,

            "AQOK" => $A["OK"],
            "BQOK" => $B["OK"],
            "CQOK" => $C["OK"],
            "DQOK" => $D["OK"],
            "AQHOLD" => $A["HOLD"] + $A["NOT"],
            "BQHOLD" => $B["HOLD"] + $B["NOT"],
            "CQHOLD" => $C["HOLD"] + $C["NOT"],
            "DQHOLD" => $D["HOLD"] + $D["NOT"],
        ];
        
        $this->load->view('admin/performance/cpp', $json);
    }

    public function metalize($year, $month)
    {
        $monthlyGraph = $this->monthlyGraph($year, "Metalize");
        $A = $this->groupPerformance($year, $month, "A", "Metalize");
        $B = $this->groupPerformance($year, $month, "B", "Metalize");
        $C = $this->groupPerformance($year, $month, "C", "Metalize");
        $D = $this->groupPerformance($year, $month, "D", "Metalize");

        $person = $this->personPerformance($year, "", "Metalize");
        $person_month = $this->personPerformanceMonth($year, $month, $person["person"], "", "Metalize");
        $totalOk = $A["OK"] + $B["OK"] + $C["OK"] + $D["OK"]; 
        $totalNot = $A["HOLD"] + $B["HOLD"] + $C["HOLD"] + $D["HOLD"] 
                    + $A["NOT"] + $B["NOT"] + $C["NOT"] + $D["NOT"]; 
        $json = [
            "year" => $year,
            "month" => $month,
            "ok" => $monthlyGraph["ok"],
            "hold" => $monthlyGraph["hold"],
            "not" => $monthlyGraph["not"],
            "person" => $person["person"],
            "total_roll" => $person["total_roll"],
            "total_roll_month" => $person_month["total_roll"],
            "AOK" => $A["OK"] > 0 ? ($A["OK"] / $totalOk) * 100 : 0,
            "BOK" => $B["OK"] > 0 ? ($B["OK"] / $totalOk) * 100 : 0,
            "COK" => $C["OK"] > 0 ? ($C["OK"] / $totalOk) * 100 : 0,
            "DOK" => $D["OK"] > 0 ? ($D["OK"] / $totalOk) * 100 : 0,

            "ANOT" => ($A["HOLD"] + $A["NOT"]) > 0 
                ? (($A["HOLD"] + $A["NOT"]) / $totalNot) * 100 : 0,

            "BNOT" => $B["HOLD"] + $B["NOT"] > 0 
                ? (($B["HOLD"] + $B["NOT"]) / $totalNot) * 100 : 0,

            "CNOT" => $C["HOLD"] + $C["NOT"] > 0 
                ? (($C["HOLD"] + $C["NOT"]) / $totalNot) * 100 : 0,

            "DNOT" => $D["HOLD"] + $D["NOT"] > 0 
                ? (($D["HOLD"] + $D["NOT"]) / $totalNot) * 100 : 0,
            
            "AQOK" => $A["OK"],
            "BQOK" => $B["OK"],
            "CQOK" => $C["OK"],
            "DQOK" => $D["OK"],
            "AQHOLD" => $A["HOLD"] + $A["NOT"],
            "BQHOLD" => $B["HOLD"] + $B["NOT"],
            "CQHOLD" => $C["HOLD"] + $C["NOT"],
            "DQHOLD" => $D["HOLD"] + $D["NOT"],
        ];
        
        $this->load->view('admin/performance/metalize', $json);
    }

    public function monthlyGraph($year, $group)
    {
        if($group == "Slitting") {
            $rolls = $this->Slitting->getAll($year);
        } else if($group == "CPP") {
            $rolls = $this->CPP->getAll($year);
        } else if($group == "Metalize") {
            $rolls = $this->Metalize->getAll($year);
        }
        
        $data = [];
        $ok = [];
        $hold = [];
        $not = [];
        for ($i=1; $i <= 12 ; $i++) { 
            foreach ($rolls as $roll) {
                if($roll->month == $i) {
                    if($roll->status == "OK") {
                        $data["OK"][$i] = [
                            "total" => $roll->total   
                        ];
                    }

                    if($roll->status == "HOLD") {
                        $data["HOLD"][$i] = [
                            "total" => $roll->total   
                        ];
                    }

                    if($roll->status == "NOT") {
                        $data["NOT"][$i] = [
                            "total" => $roll->total   
                        ]; 
                    }
                }
            }
        }

        for ($i=1; $i <= 12 ; $i++) { 
            if(array_key_exists("OK", $data)) {
                if(array_key_exists($i, $data["OK"])) {
                    $ok[] = intval($data["OK"][$i]["total"]);
                } else {
                    $ok[] = 0;
                }
            } else {
                $ok[] = 0;
            }
            
            if(array_key_exists("HOLD", $data)) {
                if(array_key_exists($i, $data["HOLD"])) {
                    $hold[] = intval($data["HOLD"][$i]["total"]);
                } else {
                    $hold[] = 0;
                }
            }else {
                $hold[] = 0;
            }

            if(array_key_exists("NOT", $data)) {
                if(array_key_exists($i, $data["NOT"])) {
                    $not[] = intval($data["NOT"][$i]["total"]);
                } else {
                    $not[] = 0;
                }
            }else {
                $not[] = 0;
            }
        }
        
        return [
            "ok" => $ok,
            "hold" => $hold,
            "not" => $not
        ];
    }

    public function groupPerformance($year, $month, $regu, $group)
    {
        $data = [
            "OK" => 0,
            "HOLD" => 0,
            "NOT" => 0
        ];

        if($group == "Slitting") {
            $status = $this->Slitting->statusRollGroup($year, $month, $regu);
        } else if($group == "CPP") {
            $status = $this->CPP->statusRollGroup($year, $month, $regu);
        } else if($group == "Metalize") {
            $status = $this->Metalize->statusRollGroup($year, $month, $regu);
        }
        
        foreach ($status as $st) {
            if($st->status == "OK") {
                $data["OK"] = $st->total;
            } else if($st->status == "HOLD") {
                $data["HOLD"] = $st->total;
            }if($st->status == "NOT") {
                $data["NOT"] = $st->total;
            }
        }

        return $data;
    }

    public function personPerformance($year, $jenis, $group)
    {
        if($group == "Slitting") {
            $persons = $this->Slitting->statusPerson($year, $jenis);
        } else if($group == "CPP") {
            $persons = $this->CPP->statusPerson($year);
        } else if($group == "Metalize") {
            $persons = $this->Metalize->statusPerson($year);
        }
       
        $person = [];
        $total_roll = [];
        foreach ($persons as $prs) {
            $person[] = strtoupper($prs->user);
            $total_roll[] = intval($prs->total);
        }

        return [
            "person" => $person,
            "total_roll" => $total_roll
        ];
    }

    public function personPerformanceMonth($year, $month, $person, $jenis, $group)
    {
        if($group == "Slitting") {
            $persons = $this->Slitting->statusPersonMonth($year, $month, $jenis);
        } else if($group == "CPP") {
            $persons = $this->CPP->statusPersonMonth($year, 2);
        } else if($group == "Metalize") {
            $persons = $this->Metalize->statusPersonMonth($year, $month);
        }
        $total_roll = [];
        $exist = 0;
        // dd($persons);
        foreach ($person as $pr) {
           
            foreach ($persons as $prs) { 
                if(strtoupper($pr) == strtoupper($prs->user)) {
                    $total_roll[] = intval($prs->total);
                    $exist = 1;
                }
            }

            if($exist == 0) {
                $total_roll[] = 0;
            } else {
                $exist = 0;
            }
        }
        return [
            "total_roll" => $total_roll
        ];
    }
}

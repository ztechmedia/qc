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

        $data = [
            "weeks" => $dateByWeek,
            "year" => $year,
        ];
        $this->load->view('admin/summary/summary', $data);
    }

    public function chart($first_day, $last_day)
    {
        $rolls = $this->Summary->getTotalSlitt($first_day, $last_day);
       
        $modelOutput = $this->modelOutput();

        $basePolos = [];
        $totalInpPolos = 0;
        $totalOutPolos = 0;

        $baseMet = [];
        $totalInpMet = 0;
        $totalOutMet = 0;

        $basePm = [];
        $totalInpPm = 0;
        $totalOutPm = 0;
        foreach ($rolls as $roll) {
            if($roll->stock == "Base Film") {
                if(!array_key_exists($roll->inputan, $basePm)) {
                    $basePm[$roll->inputan] = $roll->inputan;
                    $totalInpPm += ($roll->lebar_inputan_slitt/1000)*$roll->panjang_inputan_slitt*0.91*($roll->mic_inputan_slitt/1000);
                }

                if($roll->status == "OK" || $roll->status == "NCR") {
                    $modelOutput["pm"]["OK"]["total_roll"] += 1; 
                    $modelOutput["pm"]["OK"]["total_berat"] += $roll->kg_hasil_slitt; 
                } else if($roll->status == "HOLD") {
                    $modelOutput["pm"]["HOLD"]["total_roll"] += 1; 
                    $modelOutput["pm"]["HOLD"]["total_berat"] += $roll->kg_hasil_slitt;
                } else if($roll->status == "NOT") {
                    $modelOutput["pm"]["NOT"]["total_roll"] += 1; 
                    $modelOutput["pm"]["NOT"]["total_berat"] += $roll->kg_hasil_slitt;
                }

                $totalOutPm += $roll->kg_hasil_slitt;
            } else if($roll->jenis_roll_slitt == "POLOSAN") {
                if(!array_key_exists($roll->inputan, $basePolos)) {
                    $basePolos[$roll->inputan] = $roll->inputan;
                    $totalInpPolos += ($roll->lebar_inputan_slitt/1000)*$roll->panjang_inputan_slitt*0.91*($roll->mic_inputan_slitt/1000);
                }

                if($roll->status == "OK" || $roll->status == "NCR") {
                    $modelOutput["polos"]["OK"]["total_roll"] += 1; 
                    $modelOutput["polos"]["OK"]["total_berat"] += $roll->kg_hasil_slitt; 
                } else if($roll->status == "HOLD") {
                    $modelOutput["polos"]["HOLD"]["total_roll"] += 1; 
                    $modelOutput["polos"]["HOLD"]["total_berat"] += $roll->kg_hasil_slitt;
                } else if($roll->status == "NOT") {
                    $modelOutput["polos"]["NOT"]["total_roll"] += 1; 
                    $modelOutput["polos"]["NOT"]["total_berat"] += $roll->kg_hasil_slitt;
                }

                $totalOutPolos += $roll->kg_hasil_slitt;
            } else if($roll->jenis_roll_slitt == "METALIZZED") {
                if(!array_key_exists($roll->inputan, $baseMet)) {
                    $baseMet[$roll->inputan] = $roll->inputan;
                    $totalInpMet += ($roll->lebar_inputan_slitt/1000)*$roll->panjang_inputan_slitt*0.91*($roll->mic_inputan_slitt/1000);
                }

                if($roll->status == "OK" || $roll->status == "NCR") {
                    $modelOutput["met"]["OK"]["total_roll"] += 1; 
                    $modelOutput["met"]["OK"]["total_berat"] += $roll->kg_hasil_slitt; 
                } else if($roll->status == "HOLD") {
                    $modelOutput["met"]["HOLD"]["total_roll"] += 1; 
                    $modelOutput["met"]["HOLD"]["total_berat"] += $roll->kg_hasil_slitt;
                } else if($roll->status == "NOT") {
                    $modelOutput["met"]["NOT"]["total_roll"] += 1; 
                    $modelOutput["met"]["NOT"]["total_berat"] += $roll->kg_hasil_slitt;
                }

                $totalOutMet += $roll->kg_hasil_slitt;
            }
        }

        $modelOutput['polos']['total_berat_input'] = $totalInpPolos;
        $modelOutput['polos']['total_berat_output'] = $totalOutPolos;

        $modelOutput['met']['total_berat_input'] = $totalInpMet;
        $modelOutput['met']['total_berat_output'] = $totalOutMet;
        
        $modelOutput['pm']['total_berat_input'] = $totalInpPm;
        $modelOutput['pm']['total_berat_output'] = $totalOutPm;

        $data = [
            "output" => $modelOutput
        ];
        $this->load->view("admin/summary/slitt", $data);
    }

    public function modelOutput()
    {
        return [
            "polos" => [
                "OK" => [
                    "total_roll" => 0,
                    "total_berat" => 0,
                ],
                "HOLD" => [
                    "total_roll" => 0,
                    "total_berat" => 0,
                ],
                "NOT" => [
                    "total_roll" => 0,
                    "total_berat" => 0,
                ],
                "total_berat_input" => 0,
                "total_berat_output" => 0,
            ],
            "met" => [
                "OK" => [
                    "total_roll" => 0,
                    "total_berat" => 0,
                ],
                "HOLD" => [
                    "total_roll" => 0,
                    "total_berat" => 0,
                ],
                "NOT" => [
                    "total_roll" => 0,
                    "total_berat" => 0,
                ],
                "total_berat_input" => 0,
                "total_berat_output" => 0,
            ],
            "pm" => [
                "OK" => [
                    "total_roll" => 0,
                    "total_berat" => 0,
                ],
                "HOLD" => [
                    "total_roll" => 0,
                    "total_berat" => 0,
                ],
                "NOT" => [
                    "total_roll" => 0,
                    "total_berat" => 0,
                ],
                "total_berat_input" => 0,
                "total_berat_output" => 0,
            ],
        ];
    }
}

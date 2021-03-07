<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DeliveryController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("BaseModel", "BM");
        $this->load->model("DeliveryModel", "Delivery");
        $this->load->helper("utility");
        $this->auth->logged();
    }

    public function delivery($year, $month)
    {
        $total_kirim = [];
        $total_kirim_polos = [];
        $total_kirim_metal = [];
        $months = [];
        $deliveries = $this->Delivery->getTotalKirim($year);
        $deliveriesPolos = $this->Delivery->getTotalKirimJenis($year, "POLOSAN");
        $deliveriesMetal = $this->Delivery->getTotalKirimJenis($year, "METALIZZED");
        $totalMonthPolos = toRp($this->Delivery->getTotalKirimMonth($year, $month, "POLOSAN"));
        $totalMonthMetal = toRp($this->Delivery->getTotalKirimMonth($year, $month, "METALIZZED"));
        $totalWaste = $this->Delivery->totalWaste($year, $month);
        for ($i=1; $i <= 12 ; $i++) { 
            $exist = 0;
            $existPolos = 0;
            $existMetal = 0;

            foreach ($deliveries as $delivery) {
                if($delivery->month == $i) {
                    $total_kirim[] = intval($delivery->total_kirim);
                    $months[] = mToMonth($i).' ('.toRp($delivery->total_kirim).' Kg)';
                    $exist++;
                    break;
                }
            }

            foreach ($deliveriesPolos as $delivery) {
                if($delivery->month == $i) {
                    $total_kirim_polos[] = intval($delivery->total_kirim);
                    $existPolos++;
                    break;
                }
            }

            foreach ($deliveriesMetal as $delivery) {
                if($delivery->month == $i) {
                    $total_kirim_metal[] = intval($delivery->total_kirim);
                    $existMetal++;
                    break;
                }
            }

            if($existPolos == 0) {
                $total_kirim_polos[] = 0;
            }

            if($existMetal == 0) {
                $total_kirim_metal[] = 0;
            }

            if($exist == 0) {
                $total_kirim[] = 0;
                $months[] = mToMonth($i).' (0 Kg)';
            }
        }

        $total_month = 0;
        foreach ($deliveries as $delivery) {
            if($delivery->month == $month){
                $total_month = $delivery->total_kirim;
                break;
            }
        }

        $total_waste = 0;
        foreach ($totalWaste as $key => $value) {
            $total_waste += $value["total_waste"];
        }

        $data = [
            "total_kirim" => $total_kirim,
            "total_kirim_polos" => $total_kirim_polos,
            "total_kirim_metal" => $total_kirim_metal,
            'total_month' => toRp($total_month),
            'total_month_polos' => $totalMonthPolos, 
            'total_month_metal' => $totalMonthMetal, 
            'months' => $months,
            'year' => $year,
            'month' => $month,
            'waste' => $totalWaste,
            "total_waste" => toRp($total_waste),
            "waste_percen" => $total_waste > 0 ? toRp((($total_waste / $total_month) * 100)) : 0
        ];

        $this->load->view("admin/delivery/delivery", $data);
    }
}
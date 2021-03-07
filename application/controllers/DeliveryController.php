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
        $months = [];
        $deliveries = $this->Delivery->getTotalKirim($year);
        $totalMonthPolos = toRp(intval($this->Delivery->getTotalKirimMonth($year, $month, "POLOSAN")));
        $totalMonthMetal = toRp(intval($this->Delivery->getTotalKirimMonth($year, $month, "METALIZZED")));
        for ($i=1; $i <= 12 ; $i++) { 
            $exist = 0;
            foreach ($deliveries as $delivery) {
                if($delivery->month == $i) {
                    $total_kirim[] = intval($delivery->total_kirim);
                    $months[] = mToMonth($i).' ('.toRp(intval($delivery->total_kirim)).' Kg)';
                    $exist++;
                    break;
                }
            }

            if($exist == 0) {
                $total_kirim[] = 0;
                $months[] = mToMonth($i).' (0 Kg)';
            }
        }

        $total_month = 0;
        foreach ($deliveries as $delivery) {
            if($delivery->month == $month){
                $total_month = toRp(intval($delivery->total_kirim));
                break;
            }
        }

        $data = [
            "total_kirim" => $total_kirim,
            'total_month' => $total_month,
            'total_month_polos' => $totalMonthPolos, 
            'total_month_metal' => $totalMonthMetal, 
            'months' => $months,
            'year' => $year,
            'month' => $month
        ];

        $this->load->view("admin/delivery/delivery", $data);
    }
}
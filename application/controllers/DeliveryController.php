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

    public function customerAlias()
    {
        $aliases = $this->BM->getAll("qc_customer_alias");
        $newCustomer = [];
        foreach ($aliases as $alias) {
            $newCustomer[$alias->customer] = $alias->alias;
        }
        return $newCustomer;
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
        $stockPolos = $this->Delivery->getStockMonth($year, $month, "POLOSAN");
        $stockMetal = $this->Delivery->getStockMonth($year, $month, "METALIZZED");
        $totalMonthPolos = toRp($this->Delivery->getTotalKirimMonth($year, $month, "POLOSAN"));
        $totalMonthMetal = toRp($this->Delivery->getTotalKirimMonth($year, $month, "METALIZZED"));
        $totalMonthListPolos = $this->Delivery->getListKirimMonth($year, $month, "POLOSAN");
        $totalMonthListMetal = $this->Delivery->getListKirimMonth($year, $month, "METALIZZED");
        $totalWaste = $this->Delivery->totalWaste($year, $month);
        $customerYear = $this->Delivery->customerYear($year);
        $customerMonth = $this->Delivery->customerMonth($year, $month);
        $customerAlias = $this->customerAlias();

        $newCustomer = [];
        foreach ($customerYear as $cust) {
            $shortCust = $cust->customer_palet;
            if(array_key_exists($cust->customer_palet, $customerAlias)) {
                $shortCust = $customerAlias[$cust->customer_palet];
            }
            
            if(array_key_exists($shortCust, $newCustomer)) {
                $newCustomer[$shortCust]["total_roll"] += $cust->total_roll;
                $newCustomer[$shortCust]["total_kirim"] += $cust->total_kirim;
            } else {
                $newCustomer[$shortCust]["customer"] = $shortCust;
                $newCustomer[$shortCust]["total_roll"] = $cust->total_roll;
                $newCustomer[$shortCust]["total_kirim"] = $cust->total_kirim;
            }
        }

        $custYear = [];
        foreach ($newCustomer as $key => $value) {
            $custYear["name"][] = $value["customer"];
            $custYear["total_kirim"][] = intval($value["total_kirim"]);
        }

        $newCustomerMonth = [];
        foreach ($customerMonth as $cust) {
            $shortCust = $cust->customer_palet;
            if(array_key_exists($cust->customer_palet, $customerAlias)) {
                $shortCust = $customerAlias[$cust->customer_palet];
            }
            
            if(array_key_exists($shortCust, $newCustomerMonth)) {
                $newCustomerMonth[$shortCust]["total_roll"] += $cust->total_roll;
                $newCustomerMonth[$shortCust]["total_kirim"] += $cust->total_kirim;
            } else {
                $newCustomerMonth[$shortCust]["customer"] = $shortCust;
                $newCustomerMonth[$shortCust]["total_roll"] = $cust->total_roll;
                $newCustomerMonth[$shortCust]["total_kirim"] = $cust->total_kirim;
            }
        }

        $custMonthKirim = [];
        if(array_key_exists("name", $custYear)) {
            foreach ($custYear["name"] as $cYear) {
                $exist = 0;
                foreach ($newCustomerMonth as $key => $value) {
                    if($cYear == $value["customer"]) {
                        $custMonthKirim[] = intval($value["total_kirim"]);
                        $exist = 1;
                        break;
                    }
                }
    
                if($exist == 0) {
                    $custMonthKirim[] = 0;
                } else {
                    $exist = 0;
                }
            }
        }

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
        $waste = [];
        foreach ($totalWaste as $key => $value) {
            $total_waste += $value["total_waste"];
            $waste[] = [
                "name" => $value['nama_waste']." (".$value['total_waste']." Kg)",
                "y" => intval($value["total_waste"])
            ];
        }

        $data = [
            "total_kirim" => $total_kirim,
            "total_kirim_polos" => $total_kirim_polos,
            "total_stock_polos" => $stockPolos,
            "total_stock_metal" => $stockMetal,
            "total_kirim_metal" => $total_kirim_metal,
            'total_month' => $total_month,
            'total_month_polos' => $totalMonthPolos, 
            'total_month_metal' => $totalMonthMetal, 
            'list_polos' => $totalMonthListPolos,
            'list_metal' => $totalMonthListMetal,
            'months' => $months,
            'year' => $year,
            'month' => $month,
            'waste' => $waste,
            "total_waste" => toRp($total_waste),
            "waste_percen" => $total_waste > 0 ? toRp((($total_waste / $total_month) * 100)) : 0,
            "custYearName" => array_key_exists("name", $custYear) ? $custYear["name"] : [],
            "custYearKirim" => array_key_exists("total_kirim", $custYear) ? $custYear["total_kirim"] : [],
            "custMonthKirim" => $custMonthKirim,
        ];

        $this->load->view("admin/delivery/delivery", $data);
    }

    public function waste($year, $month)
    {
        $personWorks = $this->Delivery->personWorks($year, $month);
        $personWasteWorks = $this->Delivery->personWasteWorks($year, $month);

        $personWasteInputs = [];
        foreach ($personWorks as $key => $work) {
            $exist = 0;
            foreach ($personWasteWorks as $key => $waste) {
                if(strtoupper($work["user"]) == strtoupper($waste["user"])) {
                    $personWasteInputs[] = [
                        "user" => strtoupper($work["user"]),
                        "masuk_kerja" => $work["work_day"],
                        "total_input" => $waste["work_day"],
                        "total_waste" => toRp($waste["total_waste"]),
                    ];
                    $exist = 1;
                    break;
                }
            }

            if($exist == 0) {
                $personWasteInputs[] = [
                    "user" => strtoupper($work["user"]),
                    "masuk_kerja" => $work["work_day"],
                    "total_input" => 0,
                    "total_waste" => toRp(0),
                ];
            } else {
                $exist = 0;
            }
        }
        
        $data["personWasteInputs"] = $personWasteInputs;
        $this->load->view("admin/delivery/waste", $data);
    }
}
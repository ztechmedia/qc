<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CronController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("BaseModel", "BM");
        $this->load->helper("utility");
    }

    public function lastId($table)
    {
        if ($table == "input_lap_slitting") {
            return appJson(intval($this->db->query("SELECT MAX(id_slitt) AS slitting_id FROM input_lap_slitting")->row()->slitting_id));
        } else if($table == "input_met") {
            return appJson(intval($this->db->query("SELECT MAX(id_met) AS met_id FROM input_met")->row()->met_id));
        } else if($table == "input_lap_cpp") {
            return appJson(intval($this->db->query("SELECT MAX(id) AS cpp_id FROM input_lap_cpp")->row()->cpp_id));
        } else {
            return appJson(intval($this->db->query("SELECT MAX(id_released_jr) AS released_id FROM released_jr")->row()->released_id));
        }
    }

    public function updateDataServer()
    {
       $tables = ["input_lap_slitting", "input_met", "input_lap_cpp", "released_jr"];
       $post = null;
       $table = null;
       foreach ($tables as $tbl) {
           if(array_key_exists($tbl, $_POST)){
               $post = $_POST[$tbl];
               $table = $tbl;
           }
       }
       
       $create = $this->db->insert_batch($table, $post);
       if($create) {
            return appJson(true);
       } else {
           return appJson($create);
       }
       
    }

    //for server
    public function pushStart()
    {
        $tables = ["input_lap_slitting", "input_met", "input_lap_cpp",  "released_jr"];
        foreach ($tables as $table) {
            $this->updateDataClient($table);
        }
    }

    public function updateDataClient($table)
    {
        $lastId = json_decode($this->executeCurl("http://localhost/qc_server/last-id/$table", "GET"));
        $ids = [
            "input_lap_slitting" => "id_slitt",
            "input_met" => "id_met",
            "input_lap_cpp" => "id",
            "released_jr" => "id_released_jr",
        ];
        $id = $ids[$table];
        $total_roll = $this->db->where("$id >", $lastId)->get($table)->num_rows();
        $data = $this->db->where("$id >", $lastId)->limit(25)->get($table)->result();
        $this->pushData($table, $total_roll, $data);
    }

    public function pushData($table, $total_roll, $data)
    {
        $this->executeCurl("http://localhost/qc_server/update-data", "POST", http_build_query([$table => $data]));
        if($total_roll > 25) {
            $this->updateDataClient($table);
        }
    }

    public function executeCurl($url, $method, $post = null)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 5000,
            CURLOPT_TIMEOUT => 5000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => $post
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return $response;
        }
    }
}
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

    /* WIRA.GOREKLAME.COM */
    //get last id from wira.goreklame.com
    public function lastId($table)
    {
        if ($table == "input_lap_slitting") {
            return appJson(intval($this->db->query("SELECT MAX(id_slitt) AS slitting_id FROM input_lap_slitting")->row()->slitting_id));
        } else if($table == "input_met") {
            return appJson(intval($this->db->query("SELECT MAX(id_met) AS met_id FROM input_met")->row()->met_id));
        } else if($table == "input_lap_cpp") {
            return appJson(intval($this->db->query("SELECT MAX(id) AS cpp_id FROM input_lap_cpp")->row()->cpp_id));
        } else if($table == "input_palet") {
            return appJson(intval($this->db->query("SELECT MAX(id_pal) AS palet_id FROM input_palet")->row()->palet_id));
        } else if($table == "waste_proses") {
            return appJson(intval($this->db->query("SELECT MAX(id_wst) AS waste_id FROM waste_proses")->row()->waste_id));
        } else if($table == "type_roll") {
            return appJson(intval($this->db->query("SELECT MAX(id) AS typeroll_id FROM type_roll")->row()->typeroll_id));
        } else {
            return appJson(intval($this->db->query("SELECT MAX(id_released_jr) AS released_id FROM released_jr")->row()->released_id));
        }
    }

    //update data wira.goreklame.com
    public function updateDataServer()
    {
       $tables = ["input_lap_slitting", "input_met", "input_lap_cpp", "released_jr", "input_palet", "waste_proses", "type_roll"];
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

    /* 192.168.1.41 */
    //get data from 192.168.1.41
    public function getData($id, $lastId, $table)
    {
        $data['total_roll'] = $this->db->where("$id >", $lastId)->get($table)->num_rows();
        $data['data_list'] = $this->db->where("$id >", $lastId)->limit(25)->get($table)->result();
        return appJson($data);
    }

    /* LOCALHOST */
    //push start from localhost
    public function pushStart()
    {
        $tables = ["input_lap_slitting", "input_met", "input_lap_cpp",  "released_jr", "input_palet", "waste_proses", "type_roll"];
        foreach ($tables as $table) {
            $this->updateDataClient($table);
        }
    }

    //get data from 192.168.1.41 by localhost
    public function getDataServer($id, $lastId, $table)
    {
        return json_decode($this->executeCurl("http://192.168.1.41/dashboard/docs/images/qa/get-data/$id/$lastId/$table", "GET"));
    }

    //push to update data wira.goreklame.com
    public function updateDataClient($table)
    {
        $lastId = json_decode($this->executeCurl("http://wira.goreklame.com/last-id/$table", "GET"));
        $ids = [
            "input_lap_slitting" => "id_slitt",
            "input_met" => "id_met",
            "input_lap_cpp" => "id",
            "released_jr" => "id_released_jr",
            "input_palet" => "id_pal",
            "type_roll" => "id",
            "waste_proses" => "id_wst",
        ];
        $id = $ids[$table];
        $data = $this->getDataServer($id, $lastId, $table);
        $total_roll = $data->total_roll;
        $data_list = $data->data_list;
        $this->pushData($table, $total_roll, $data_list);
    }

    //push to update data wira.goreklame.com
    public function pushData($table, $total_roll, $data)
    {
        $this->executeCurl("http://wira.goreklame.com/update-data", "POST", http_build_query([$table => $data]));
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
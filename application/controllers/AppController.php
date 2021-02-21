<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AppController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("BaseModel", "BM");
        $this->load->library('user_agent', 'agent');
        $this->load->helper("utility");
        $this->auth->logged();
    }

    public function index()
    {
        $currentDate = date("Y-m-d");
        $date = explode("-", $currentDate);
        $data["currentYear"] = $date[2];
        $data["currentMonth"] = $date[1];
        $data["currentDay"] = $date[0];
        $data["currentDate"] = revDate($currentDate);

        $data["browser"] = $this->agent->browser();
        $data["browser_version"] = $this->agent->version();
        $data["os"] = $this->agent->platform();
        $data["ip"] = $this->input->ip_address();
        $this->load->view('template/admin/app', $data);
    }

    public function pageNotFound()
    {
        $this->load->view("errors/custom/page_not_found");
    }

    public function logout()
    {
        $this->session->unset_userdata(SESSION_KEY);
        appJson([
            "success" => true,
            "redirect" => base_url("home"),
        ]);
    }
}

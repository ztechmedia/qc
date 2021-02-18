<?php
defined('BASEPATH') or exit('No direct script access allowed');

class WebController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("BaseModel", "BM");
        $this->load->library("form_validation");
        $this->load->helper("utility");
    }

    public function home()
    {
        $data['view'] = "web/home";
        $data['menu'] = "home";
        $this->load->view('template/web/app', $data);
    }
}

<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Auth
{
    protected $ci;

    public $userId;
    public $name;
    public $email;
    public $role;
    public $role_id;

    public function __construct()
    {
        $this->ci = &get_instance();
        $this->me();
    }

    public function logged()
    {
        if (!$this->ci->session->userdata(SESSION_KEY)) {
            redirect("home");
        }
    }

    public function auth()
    {
        if ($this->ci->session->userdata(SESSION_KEY)) {
            redirect("admin");
        }
    }

    public function me()
    {
        if ($this->ci->session->userdata(SESSION_KEY)) {
            $this->userId = $_SESSION[SESSION_KEY]["userId"];
            $this->name = $_SESSION[SESSION_KEY]["name"];
            $this->email = $_SESSION[SESSION_KEY]["email"];
            $this->role = $_SESSION[SESSION_KEY]["role"];
            $this->role_id = $_SESSION[SESSION_KEY]["role_id"];
        }
    }
}

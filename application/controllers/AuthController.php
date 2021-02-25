<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AuthController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("BaseModel", "BM");
        $this->load->library("Sendmail");
        $this->load->helper("utility");
        $this->auth->auth();
        $this->usersTable = "qc_users";
        $this->rolesTable = "qc_roles";
    }

    //@desc     load login view
    //@route    GET /login
    public function login()
    {
        $data["view"] = "auth/login";
        $this->load->view("template/auth/app", $data);
    }

    //@desc     login logic to verify users
    //@route    GET auth/login
    public function authLogin()
    {
        $email = $this->input->post("email");
        $password = $this->input->post("password");

        if (strlen($email) <= 0) {
            appJson(["errors" => ["email" => "Email tidak boleh kosong"]]);
        }

        if (strlen($password) <= 0) {
            appJson(["errors" => ["password" => "Password tidak boleh kosong"]]);
        }

        $user = $this->BM->getWhere($this->usersTable, ["email" => $email])->row();
        if (!$user) {
            appJson(["errors" => [
                "email" => "Email tidak terdaftar",
            ]]);
        }

        if (!password_verify($password, $user->password)) {
            appJson(["errors" => [
                "password" => "Password tidak cocok",
            ]]);
        }

        $role = $this->BM->getById($this->rolesTable, $user->role);

        $session = array(
            "userId" => $user->id,
            "name" => $user->name,
            "email" => $user->email,
            "role" => $role->display_name,
            "role_id" => $role->id
        );

        $this->session->set_userdata(SESSION_KEY, $session);
	    $date = explode("-", date("Y-m-d"));
        appJson([
            "success" => true,
            "type" => "login",
            "redirect" => base_url("admin"),
            "currentUrl" => base_url("admin/performance/slitting/$date[0]/$date[1]"),
        ]);
    }

    //@desc     load forgot password view
    //@route    GET /forgot-password
    public function forgotPassword()
    {
        $data["view"] = "auth/forgot-password";
        $this->load->view("template/auth/app", $data);
    }

    //@desc     send link reset password
    //@route    GET /send-link-forgot
    public function sendLinkForgot()
    {
        $email = $this->input->post("email");
        if (strlen($email) <= 0) {
            appJson(["errors" => ["email" => "Email masih kosong"]]);
        }

        $user = $this->BM->getWhere($this->usersTable, ["email" => $email])->row();
        if (!$user) {
            appJson(["errors" => ["email" => "Email tidak terdaftar"]]);
        }

        $token = genUnique(62);
        $link = base_url("reset-password/$token");

        $sendEmail = $this->Sendmail->send("Reset Password", $link, $email);
        if ($sendEmail) {
            $data['token_password'] = $token;
            $updateEmail = $this->BM->updateById($this->usersTable, $user->id, $data);
            if ($updateEmail) {
                appJson([
                    "success" => true,
                    "type" => "send-link-forgot",
                    "message" => "Berhasil mengirim link reset password kepada $email",
                    "redirect" => base_url("login"),
                ]);
            }
        } else {
            appJson(["errors" => ["email" => $sendEmail]]);
        }
    }

    //@desc     reset password view
    //@route    GET /auth/reset-password/:token_password
    public function resetPassword($token_password)
    {
        $user = $this->BM->getWhere($this->usersTable, ["token_password" => $token_password])->row();
        if (!$user) {
            $data['message'] = "$token_password tidak ada di database kami";
            $this->load->view("errors/custom/page_not_found", $data);
        } else {
            $data["token_password"] = $token_password;
            $data['view'] = "auth/reset-password";
            $this->load->view("template/auth/app", $data);
        }
    }

    //@desc     reset password logic
    //@route    GET unknown
    public function reset($token_password)
    {
        $password = $this->input->post("password");
        $confirm = $this->input->post("confirm");

        $user = $this->BM->getWhere($this->usersTable, ["token_password" => $token_password])->row();

        if (!$user) {
            appJson(["errors" => ["token" => "Invalid TOKEN"]]);
        }

        if (strlen($password) <= 0) {
            appJson(["errors" => ["password" => "Password masih kosong"]]);
        }

        if (strlen($confirm) <= 0) {
            appJson(["errors" => ["confirm" => "Konfirmasi password masih kosong"]]);
        }

        if ($password !== $confirm) {
            appJson(["errors" => ["confirm" => "Konfirmasi password tidak cocok"]]);
        }

        $data["password"] = password_hash($password, PASSWORD_BCRYPT);
        $data["token_password"] = null;
        $this->BM->updateById($this->usersTable, $user->id, $data);
        $role = $this->BM->getById($this->rolesTable, $user->role);
        $session = array(
            "userId" => $user->id,
            "name" => $user->name,
            "email" => $user->email,
            "role" => $role->display_name,
            "role_id" => $user->role
        );

        $this->session->set_userdata(SESSION_KEY, $session);

        $redirect = $role->name === "member" ? base_url("home") : base_url("admin");
        $date = explode("-", date("Y-m-d"));
        appJson([
            "success" => true,
            "type" => "reset-password",
            "redirect" => $redirect,
            "currentUrl" => base_url("admin/performance/slitting/$date[0]/$date[1]"),
        ]);
    }
}
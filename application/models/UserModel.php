<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        //load dependencise
        $this->load->model("BaseModel", "BM");
        $this->load->library("form_validation");
        $this->load->helper('utility');
        //local variabel
        $this->validate = ['name', 'email', 'password', 'role'];
        $this->usersTable = "qc_users";
    }

    public function create($data, $validate = [])
    {
        $validator = $this->validator($validate ? $validate : $this->validate, $data);
        if ($validator) {
            return $this->BM->create($this->usersTable, $data);
        } else {
            appJson(['errors' => $this->form_validation->error_array()]);
            return false;
        }
    }

    public function update($id, $data, $validate = [])
    {
        $validator = $this->validator($validate ? $validate : $this->validate, $data, $id);
        if ($validator) {
            return $this->BM->updateById($this->usersTable, $id, $data);
        } else {
            appJson(['errors' => $this->form_validation->error_array()]);
            return false;
        }
    }

    public function validator($validate, $data, $id = null)
    {
        $isUnique = $id ? "qc_users.email.$id" : "qc_users.email";

        $rules = [
            "name" => [
                'field' => 'name',
                'label' => 'Nama',
                'rules' => 'required',
                'errors' => [
                    'required' => '* Nama tidak boleh kosong',
                ],
            ],
            "email" => [
                'field' => 'email',
                'label' => 'Email',
                'rules' => "required|trim|isUnique[$isUnique]",
                'errors' => [
                    'required' => '* Email tidak boleh kosong',
                    'isUnique' => 'Email sudah digunakan',
                ],
            ],
            "password" => [
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '* Password tidak boleh kosong',
                ],
            ],
            "role" => [
                'field' => 'role',
                'label' => 'Role',
                'rules' => 'required',
                'errors' => [
                    'required' => '* Level user tidak boleh kosong',
                ],
            ],
        ];

        $filterRules = [];

        foreach ($validate as $v) {
            $filterRules[] = $rules[$v];
        }

        $this->form_validation->set_rules($filterRules);
        return $this->form_validation->run();
    }

    public function users($where)
    {
        return $this->db->select("*")->from($this->usersTable)->where($where);
    }
}

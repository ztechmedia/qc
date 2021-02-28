<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MasterController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("BaseModel", "BM");
        $this->load->model("SlittingModel", "Slitting");
        $this->load->library('Datatables', 'datatables');
        $this->load->library("form_validation");
        $this->load->helper("utility");
    }

    public function customerAlias()
    {
        $this->load->view('admin/master/customer-alias/customer-alias');
    }

    public function customerAliasTable()
    {
        $tableOption = [
            "columns" => ["id", "customer", "alias"],
            "searchable" => ['customer', 'alias'],
            "delete_message" => [
                'name' => "Yakin ingin menghapus [customer] pada data Customer Alias",
            ],
            "actions_url" => [
                "edit" => base_url("admin/master/customer-alias/[id]/edit"),
                "delete" => base_url('admin/master/customer-alias/[id]/delete')
            ],
            "actions" => $this->auth->role_id == 1 ? "admin/actions/edit-delete" : "admin/actions/edit"
        ];

        $users = $this->datatables->setDatatables(
            "qc_customer_alias",
            $tableOption
        );

        json($users);
    }

    public function create()
    {
        $this->load->view("admin/master/customer-alias/create");
    }

    //@desc     customer alias create action
    //@route    POST admin/master/customer-alias/add
    public function add()
    {
        $post = getPost();
        if (!$this->cusValidator()) {
            appJson(['errors' => $this->form_validation->error_array()]);
        }
        $customer = $this->BM->create("qc_customer_alias", $post);
        if ($customer) {
            appJson([
                "message" => "Berhasil menambah data Customer Alias",
            ]);
        }
    }

    //@desc     show customer alias update view
    //@route    GET admin/master/customer-alias/:customerid/edit
    public function edit($id)
    {
        $data['customer'] = $this->BM->checkById("qc_customer_alias", $id);
        $this->load->view('admin/master/customer-alias/edit', $data);
    }


    //@desc     customer alias update action
    //@route    POST admin/master/customer-alias/:customerId/update
    public function update($id)
    {
        $post = getPost();
        if (!$this->cusValidator([], $id)) {
            appJson(['errors' => $this->form_validation->error_array()]);
        }
        $user = $this->BM->updateById("qc_customer_alias", $id, $post);
        if ($user) {
            appJson([
                "message" => "Berhasil mengubah data Customer Alias",
            ]);
        }
    }

    //@desc     customer delete action
    //@route    GET admin/master/customer-alias/:customerId/delete
    public function delete($id)
    {
        $this->BM->deleteById("qc_customer_alias", $id);
        appJson($id);
    }

    public function defectAlias()
    {
        $this->load->view('admin/master/defect-alias/defect-alias');
    }

    public function defectAliasTable()
    {
        $tableOption = [
            "columns" => ["id", "defect", "alias", "def_default", "max_cross"],
            "searchable" => ['defect', 'alias', 'def_default', 'max_cross'],
            "delete_message" => [
                'name' => "Yakin ingin menghapus [defect] pada data Defect Alias",
            ],
            "actions_url" => [
                "edit" => base_url("admin/master/defect-alias/[id]/edit"),
                "delete" => base_url('admin/master/defect-alias/[id]/delete')
            ],
            "actions" => "admin/actions/edit-delete"
        ];

        $users = $this->datatables->setDatatables(
            "qc_defect_alias",
            $tableOption
        );

        json($users);
    }

    public function createDefect()
    {
        $this->load->view("admin/master/defect-alias/create");
    }

    //@desc     defect alias create action
    //@route    POST admin/master/defect-alias/add
    public function addDefect()
    {
        $post = getPost();
        if (!$this->defValidator()) {
            appJson(['errors' => $this->form_validation->error_array()]);
        }

        $customer = $this->BM->create("qc_defect_alias", $post);
        if ($customer) {
            appJson([
                "message" => "Berhasil menambah data Defect Alias",
            ]);
        }
    }

    //@desc     show defect alias update view
    //@route    GET admin/master/defect-alias/:defectId/edit
    public function editDefect($id)
    {
        $data['defect'] = $this->BM->checkById("qc_defect_alias", $id);
        $this->load->view('admin/master/defect-alias/edit', $data);
    }


    //@desc     defect alias update action
    //@route    POST admin/master/defect-alias/:defectId/update
    public function updateDefect($id)
    {
        $post = getPost();
        if (!$this->defValidator([], $id)) {
            appJson(['errors' => $this->form_validation->error_array()]);
        }
        $user = $this->BM->updateById("qc_defect_alias", $id, $post);
        if ($user) {
            appJson([
                "message" => "Berhasil mengubah data Defect Alias",
            ]);
        }
    }

    //@desc     defect delete action
    //@route    GET admin/master/defect-alias/:defectId/delete
    public function deleteDefect($id)
    {
        $this->BM->deleteById("qc_defect_alias", $id);
        appJson($id);
    }

    public function defValidator($skip = [], $id = null)
    {
        $uniqueDefect = $id ? "qc_defect_alias.defect.$id" : "qc_defect_alias.defect";
        $uniqueAlias = $id ? "qc_defect_alias.alias.$id" : "qc_defect_alias.alias";

        $rules = [
            "defect" => [
                'field' => 'defect',
                'rules' => "required|trim|isUnique[$uniqueDefect]",
                'errors' => [
                    'required' => '* Defect tidak boleh kosong',
                    'isUnique' => 'Defect sudah digunakan',
                ],
            ],
            "alias" => [
                'field' => 'alias',
                'rules' => "required|trim|isUnique[$uniqueAlias]",
                'errors' => [
                    'required' => '* Defect alias tidak boleh kosong',
                    'isUnique' => 'Defect alias sudah digunakan',
                ],
            ],
        ];

        $filterRules = [];

        foreach ($rules as $rule => $value) {
            if (!array_key_exists($rule, $skip)) {
                $filterRules[] = $rules[$rule];
            }
        }

        $this->form_validation->set_rules($filterRules);
        return $this->form_validation->run();
    }

    public function cusValidator($skip = [], $id = null)
    {
        $uniqueDefect = $id ? "qc_customer_alias.customer.$id" : "qc_customer_alias.customer";
        $uniqueAlias = $id ? "qc_customer_alias.alias.$id" : "qc_customer_alias.alias";

        $rules = [
            "customer" => [
                'field' => 'customer',
                'rules' => "required|trim|isUnique[$uniqueDefect]",
                'errors' => [
                    'required' => '* Customer tidak boleh kosong',
                    'isUnique' => 'Customer sudah digunakan',
                ],
            ],
        ];

        $filterRules = [];

        foreach ($rules as $rule => $value) {
            if (!array_key_exists($rule, $skip)) {
                $filterRules[] = $rules[$rule];
            }
        }

        $this->form_validation->set_rules($filterRules);
        return $this->form_validation->run();
    }
}
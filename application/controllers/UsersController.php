<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UsersController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("BaseModel", "BM");
        $this->load->model('UserModel', 'User');
        $this->load->library('Datatables', 'datatables');
        $this->load->helper("utility");
        $this->auth->logged();
        $this->usersTable = "qc_users";
        $this->rolesTable = "qc_roles";
    }

    //@desc     show users table
    //@route    GET admin/users
    public function users($roleId)
    {
        $data['role'] = $this->BM->getById($this->rolesTable, $roleId);
        $this->load->view('admin/users/users', $data);
    }

    //@desc     show data users table
    //@route    GET admin/users/users-table
    public function usersTable($roleId)
    {
        $querySelector = [
            "1" => "user-admin",
            "2" => "user-mgr",
            "3" => "user-spv",
            "4" => "user-lab",
            "5" => "user-inout",
            "6" => "user-packing",
        ];

        $role = $this->BM->getById($this->rolesTable, $roleId);
        $tableOption = [
            "columns" => ["id", "name", "email"],
            "searchable" => ['name', 'email'],
            "delete_message" => [
                'name' => "Yakin ingin menghapus [name] pada data $role->display_name",
            ],
            "actions_url" => [
                "edit" => base_url("admin/users/[id]/edit"),
                "delete" => base_url('admin/users/[id]/delete')
            ],
            "actions" => $this->auth->role_id == 1 ? "admin/actions/edit-delete" : "admin/actions/edit",
            "querySelector" => $querySelector[$roleId]
        ];

        $users = $this->datatables->setDatatables(
            $this->usersTable,
            $tableOption
        );

        json($users);
    }

    //@desc     show users create view
    //@route    GET admin/users/users/create
    public function create($roleId)
    {
        $roles = $this->BM->getWhere($this->rolesTable, ['id' => $roleId]);
        $data = [
            "roles" => $roles->result(),
            "role" => $roles->row()
        ];
        $this->load->View('admin/users/create', $data);
    }

    //@desc     users create action
    //@route    POST admin/users/add
    public function add()
    {
        $post = getPost();
        $post['password'] = password_hash($post['password'], PASSWORD_BCRYPT);
        $user = $this->User->create($post);
        if ($user) {
            appJson([
                "message" => "Berhasil menambah data Pengguna",
            ]);
        }
    }

    //@desc     show users update view
    //@route    GET admin/users/:userId/edit
    public function edit($id)
    {
        $user = $this->BM->checkById($this->usersTable, $id);
        $role = $this->BM->getById($this->rolesTable, $user->role);
        $roles = $this->BM->getAll($this->rolesTable);
        $data = [
            "user" => $user,
            "role" => $role,
            "roles" => $roles
        ];
        $this->load->view('admin/users/edit', $data);
    }

    //@desc     users update action
    //@route    POST admin/users/:userId/update
    public function update($id)
    {
        $post = getPost();
        $user = $this->User->update($id, $post, $validate = ['name', 'email']);
        if ($user) {
            appJson([
                "message" => "Berhasil mengubah data Pengguna",
            ]);
        }
    }

    //@desc     users delete action
    //@route    GET admin/users/:userId/delete
    public function delete($id)
    {
        if ($id == $this->auth->userId) {
            appJson(["errors" => "Tidak dapat menghapus diri sendiri"]);
        } else {
            $this->BM->deleteById($this->usersTable, $id);
            appJson($id);
        }
    }
}

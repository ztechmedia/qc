<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PackingController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("BaseModel", "BM");
        $this->load->model('UserModel', 'User');
        $this->load->library('Datatables', 'datatables');
        $this->load->helper("utility");
        $this->auth->logged();
        $this->paletTable = "input_palet";
    }

    //@desc     show palet table
    //@route    GET admin/palet
    public function palet()
    {
        $this->load->view('admin/productions/packing/palet');
    }

    //@desc     show data palet table
    //@route    GET admin/productions/packing/palet-table
    public function paletTable()
    {
        $tableOption = [
            "columns" => [
                "id_pal", "no_palet", "no_roll", "tgl_inputpalet", "slitt_roll_palet", "lebar_roll_palet", 
                "panjang_roll_palet", "tebal_roll_palet", "type_roll_palet", "tgl_kirim", "customer_palet"
            ],
            "searchable" => [
                "id_pal", "no_palet", "no_roll", "tgl_inputpalet", "slitt_roll_palet", "lebar_roll_palet", 
                "panjang_roll_palet", "tebal_roll_palet", "type_roll_palet", "tgl_kirim", "customer_palet"
            ],
            "delete_message" => [
                'name' => "Yakin ingin menghapus [slitt_roll_palet] pada data Palet",
            ],
            "actions_url" => [
                "edit" => base_url("admin/productions/packing/palet/[id]/edit"),
                "delete" => base_url('admin/productions/packing/palet/[id]/delete')
            ],
            "id" => "id_pal",
            "middleware" => [
                "toDateTime"
            ],
            "actions" => $this->auth->role_id == 1 ? "admin/actions/edit-delete" : "admin/actions/edit",
        ];

        $palet = $this->datatables->setDatatables(
            $this->paletTable,
            $tableOption
        );

        json($palet);
    }

    //@desc     show palet update view
    //@route    GET admin/productions/packing/palet/:paletId/edit
    public function edit($id)
    {
        $palet = $this->BM->getWhere($this->paletTable, ["id_pal" => $id])->row();
        $data = [
            "palet" => $palet,
        ];
        $data['customers'] = $this->db
            ->select("customer_palet")
            ->from("input_palet")
            ->where("customer_palet !=", "")
            ->where_not_in("customer_palet", ["1835/PO/TAC/XII/19", "customer_palet"])
            ->group_by("customer_palet")
            ->get()->result();
            
        $this->load->view('admin/productions/packing/edit', $data);
    }

    //@desc     users update action
    //@route    POST admin/productions/packing/palet/:paletId/update
    public function update($id)
    {
        $post = getPost();
        $post['slitt_roll_palet'] = $post['type_roll_palet']." ".$post['tebal_roll_palet']." x ".$post['lebar_roll_palet']." x ".$post['panjang_roll_palet'];
        $palet = $this->BM->update($this->paletTable, $id, "id_pal", $post);
        if ($palet) {
            appJson([
                "message" => "Berhasil mengubah data palet",
            ]);
        }
    }

    //@desc     palet delete action
    //@route    GET admin/productions/packing/pallet/:paletId/delete
    public function delete($id)
    {
       
        $this->BM->delete($this->paletTable, ["id_pal" => $id]);
        appJson($id);
    }
}
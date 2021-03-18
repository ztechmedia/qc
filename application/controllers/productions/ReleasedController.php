<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ReleasedController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("BaseModel", "BM");
        $this->load->model("ReleasedModel", "Released");
        $this->load->library('Datatables', 'datatables');
        $this->load->helper("utility");
        $this->auth->logged();
        $this->table = "released_jr";
    }

    public function released($year, $month)
    {
        $rolls = $this->Released->getCountMonth($year, $month);
        $rollsyear = $this->Released->getCountYear($year);

        $totalRoll = 0;
        $status = [
            "HOLD" => [
                "total" => 0,
                "percent" => 0,
                "total_kg" =>0
            ],
            "REWORK" => [
                "total" => 0,
                "percent" => 0,
                "total_kg" =>0
            ],
            "REJECT" => [
                "total" => 0,
                "percent" => 0,
                "total_kg" =>0
            ]
        ];

        foreach ($rolls as $roll) {
            $totalRoll += $roll->total;
        }

        foreach ($rolls as $roll) {
            $status[$roll->status_akhir] = [
                "total" => $roll->total,
                "percent" => $roll->total > 0 ? ($roll->total / $totalRoll) * 100 : 0,
                "total_kg" => $roll->total_kg
            ];
        }

        $data = [];
        $hold = [];
        $rework = [];
        $reject = [];
        for ($i=1; $i <= 12 ; $i++) { 
            foreach ($rollsyear as $roll) {
                if($roll->month == $i) {
                    if($roll->status == "HOLD") {
                        $data["HOLD"][$i] = [
                            "total" => $roll->total   
                        ];
                    }

                    if($roll->status == "REWORK") {
                        $data["REWORK"][$i] = [
                            "total" => $roll->total   
                        ];
                    }

                    if($roll->status == "REJECT") {
                        $data["REJECT"][$i] = [
                            "total" => $roll->total   
                        ];
                    }
                }
            }
        }

        for ($i=1; $i <= 12 ; $i++) { 
            if(array_key_exists("HOLD", $data)) {
                if(array_key_exists($i, $data["HOLD"])) {
                    $hold[] = intval($data["HOLD"][$i]["total"]);
                } else {
                    $hold[] = 0;
                }
            } else {
                $hold[] = 0;
            }
            
            if(array_key_exists("REWORK", $data)) {
                if(array_key_exists($i, $data["REWORK"])) {
                    $rework[] = intval($data["REWORK"][$i]["total"]);
                } else {
                    $rework[] = 0;
                }
            }else {
                $rework[] = 0;
            }

            if(array_key_exists("REJECT", $data)) {
                if(array_key_exists($i, $data["REJECT"])) {
                    $reject[] = intval($data["REJECT"][$i]["total"]);
                } else {
                    $reject[] = 0;
                }
            }else {
                $reject[] = 0;
            }
        }

        $data = [
            "totalRoll" => $totalRoll,
            "year" => $year,
            "month" => $month,
            "hold" => $hold,
            "rework" => $rework,
            "reject" => $reject,
            "fullMonth" => mToMonth($month),
            "status" => $status,
        ];

        $this->load->view("admin/productions/released/released", $data);
    }

    public function releasedTable($year, $month)
    {
        $tableOption = [
            "columns" => ["id_released_jr", "no_released_jr", "reason_jr", "status_akhir", "tgl_released_jr",
                            "no_roll_released_jr", "id_user_released_jr", "type_slitt", "mic_slitt", "lebar_slitt", "panjang_slitt", "kg_hasil_slitt"],
            "searchable" => ["a.no_released_jr", "a.reason_jr", "a.status_akhir", "a.tgl_released_jr",
                            "a.no_roll_released_jr", "a.id_user_released_jr", "b.type_slitt", "b.mic_slitt", "b.lebar_slitt", "b.panjang_slitt", "b.kg_hasil_slitt"],
            "delete_message" => [
                'no_released_jr' => "Yakin ingin menghapus [no_released_jr]",
            ],
            "actions_url" => [
                "edit" => base_url("admin/productions/released/[id]/$year/$month/edit"),
            ],
            "actions" => "admin/actions/edit",
            "querySelector" => "released-roll",
            "id" => "id_released_jr",
            //"variabel" => [
            //    "YEAR(a.tgl_released_jr)" => $year,
            //    "MONTH(a.tgl_released_jr)" => $month,
            //]
        ];

        $released = $this->datatables->setDatatables(
            null,
            $tableOption
        );

        json($released);
    }

    public function edit($id, $year, $month)
    {
        $released = $this->BM->getWhere($this->table, ["id_released_jr" => $id])->row();
        $data = [
            "roll" => $released,
            "year" => $year,
            "month" => $month
        ];
        $this->load->view("admin/productions/released/edit", $data);
    }

    public function update($id)
    {
        $post = getPost();
        $status = $post['status_akhir'];
        $status_form = $post['status_form'];
        $rollSlitt = $this->BM->getWhere('input_lap_slitting', ['id_slitt' => $status_form])->row();
        if($status == "REJECT") {
            $reject = $this->BM->getWhere('stock_begrade', ['no_roll' => $post["no_roll_released_jr"]])->row();
            if(!$reject) {
                $dataReject = [
                    'tgl_masuk' => $post['tgl_released_jr'],
                    'type' => $rollSlitt->type_slitt,
                    'tebal' => $rollSlitt->mic_slitt,
                    'lebar' => $rollSlitt->lebar_slitt,
                    'panjang' => $rollSlitt->panjang_slitt,
                    'no_roll' => $post['no_roll_released_jr'],
                    'ket' => $post['reason_jr'],
                    'tgl_kirim' => '0000-00-00',
                    'inp' => 'secondary',
                    'no_dokumen' => $post['no_released_jr'],
                    'user' => $post['id_user_released_jr']
                ];

                $this->BM->create('stock_begrade', $dataReject);
            }
        } else if($status == "REWORK") {
            $reject = $this->BM->getWhere('stock_begrade', ['no_roll' => $post["no_roll_released_jr"]]);
           
            if($reject) {
                $this->BM->DELETE('stock_begrade', ["no_roll" => $post["no_roll_released_jr"]]);
            }
        }

        $update = $this->BM->update('released_jr', $id, 'id_released_jr', $post);
        if ($update) {
            appJson([
                "message" => "Berhasil mengubah data Released Roll",
            ]);
        }
    }

}
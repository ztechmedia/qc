<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Datatables
{
    protected $ci;

    public function __construct()
    {
        $this->ci = &get_instance();
        $this->ci->load->model('DatatablesModel', "Table");
    }

    public function setDatatables($table, $params)
    {
        $ci = $this->ci;

        $tableColumns = $params['columns'];
        $searchAble = $params['searchable'];
        $actions = array_key_exists("actions", $params) ? $params['actions'] : null;
        $actionsUrl = array_key_exists("actions_url", $params) ? $params['actions_url'] : null;
        $deleteMessage = array_key_exists("delete_message", $params) ? $params['delete_message'] : null;
        $middleware = array_key_exists("middleware", $params) ? $params['middleware'] : null;
        $querySelector = array_key_exists("querySelector", $params) ? $params['querySelector'] : null;

        $columns = array();
        $index = 0;
        foreach ($tableColumns as $column) {
            $columns[$index] = $column;
            $index++;
        }

        $limit = $ci->input->post('length');
        $start = $ci->input->post('start');
        $order = $columns[$ci->input->post('order')[0]['column']];
        $dir = $ci->input->post('order')[0]['dir'];
        $totalData = $ci->Table->totalDocument($table, $querySelector);
        $totalFiltered = $totalData;

        if (empty($ci->input->post('search')['value'])) {
            $dataTables = $ci->Table->getAll($table, $limit, $start, $order, $dir, $querySelector);
        } else {
            $search = $ci->input->post('search')['value'];
            $dataTables = $ci->Table->dataSearch($table, $limit, $start, $search, $order, $dir, $searchAble, $querySelector);
            $totalFiltered = $ci->Table->dataSearchCount($table, $search, $searchAble, $querySelector);
        }

        $data = array();
        if (!empty($dataTables)) {
            $no = $start + 1;
            foreach ($dataTables as $dt) {
                $deleteMsg = "Apakah anda yakin ingin melakukan tindakan ini?";

                $nestedData['no'] = $no++;
                foreach ($columns as $column) {

                    if ($deleteMessage) {
                        if (array_key_exists($column, $deleteMessage)) {
                            $deleteMsg = str_replace(
                                "[" . $column . "]",
                                $dt->$column,
                                $deleteMessage[$column]
                            );
                        }
                    }

                    if ($deleteMessage) {
                        if (array_key_exists($column, $deleteMessage)) {
                            $deleteMsg = str_replace(
                                "[" . $column . "]",
                                $dt->$column,
                                $deleteMessage[$column]
                            );
                        }
                    }

                    if ($middleware) {
                        if (array_key_exists($column, $middleware)) {
                            $type = $middleware[$column];
                            $nestedData[$column] = $this->middleware($type, $dt->$column);
                        } else {
                            $nestedData[$column] = $dt->$column;
                        }
                    } else {
                        $nestedData[$column] = $dt->$column;
                    }
                }

                if ($actions && $actionsUrl) {
                    $actionData = [
                        "table" => $table,
                        "data" => $dt,
                        "deleteMessage" => $deleteMsg,
                    ];

                    if ($actionsUrl) {
                        if (array_key_exists("edit", $actionsUrl)) {
                            if(array_key_exists("id", $params)) {
                                $id = $params["id"];
                                $actionData["edit"] = str_replace("[id]", $dt->$id, $actionsUrl["edit"]);
                            } else {
                                $actionData["edit"] = str_replace("[id]", $dt->id, $actionsUrl["edit"]);
                            }
                        }

                        if (array_key_exists("delete", $actionsUrl)) {
                            if(array_key_exists("id", $params)) {
                                $id = $params["id"];
                                $actionData["delete"] = str_replace("[id]", $dt->$id, $actionsUrl["delete"]);
                            } else {
                                $actionData["delete"] = str_replace("[id]", $dt->id, $actionsUrl["delete"]);
                            }
                        }
                    }

                    $nestedData['actions'] = $ci->load->view($actions, $actionData, true);
                }

                $data[] = $nestedData;
            }
        }

        $dataArray = array(
            "draw" => intval($ci->input->post('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data,
        );

        return $dataArray;
    }

    public function middleware($type, $value)
    {
        switch ($type) {
            case "toDateTime":
                return toDateTime(date_create($value));
            default:
                return null;
        }
    }
}

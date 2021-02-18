<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BaseModel extends CI_Model
{
    public function getAll($table)
    {
        return $this->db->get($table)->result();
    }

    public function getLike($table, $column, $value)
    {
        $this->db->like($column, $value);
        return $this->db->get($table);
    }

    public function getFirst($table)
    {
        $this->db->limit(1, 0);
        $this->db->order_by("created_at", "asc");
        return $this->db->get($table)->row();
    }

    public function getTotalData($table)
    {
        return $this->db->count_all($table);
    }

    public function getWhere($table, $where)
    {
        return $this->db->get_where($table, $where);
    }

    public function whereIn($table, $column, $data)
    {
        $this->db->where_in($column, $data);
        return $this->db->get($table);
    }

    public function getById($table, $id)
    {
        return $this->db->get_where($table, array("id" => $id))->row();
    }

    public function create($table, $data)
    {
        $this->db->insert($table, $data);
        $id = $this->db->insert_id();
        return $this->db->get_where($table, ['id' => $id])->row();
    }

    public function createMultiple($table, $data)
    {
        return $this->db->insert_batch($table, $data);
    }

    public function updateById($table, $id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update($table, $data);
        return $this->db->get_where($table, ["id" => $id])->row();
    }

    public function update($table, $fill, $column, $data)
    {
        $this->db->where($column, $fill);
        $this->db->update($table, $data);
        return $this->db->get_where($table, [$column => $fill])->row();
    }

    public function updateMultiple($table, $data, $column)
    {
        return $this->db->update_batch($table, $data, $column);
    }

    public function deleteById($table, $id)
    {
        return $this->db->delete($table, array('id' => $id));
    }

    public function delete($table, $where)
    {
        return $this->db->delete($table, $where);
    }

    public function deleteMultipleColumn($table, $single, $array)
    {
        if(count($single) > 0) {
            foreach($single as $skey => $sval){
                $this->db->where($skey, $sval);
            }
        }
        
        if(count($array) > 0) {
            foreach ($array as $akey => $aval) {
                $this->db->where_in($akey, $aval);
            }
        }

        return $this->db->delete($table);
    }

    public function checkById($table, $id)
    {
        $query = $this->db->get_where($table, ['id' => $id])->result();
        if(!$query) {
            $data['message'] = "ID: $id tidak ditemukan";
            $this->load->view("errors/custom/id_not_found", $data);
            die();
        }else{
            return $query[0];
        }
    }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DatatablesModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("UserModel", "User");
    }

    public function totalDocument($table, $querySelector)
    {
        if ($querySelector) {
            $query = $this->querySelector($querySelector)->get();
        } else {
            $query = $this->db->get($table);
        }
        return $query->num_rows();
    }

    public function getAll($table, $limit, $start, $col, $dir, $querySelector)
    {
        if ($querySelector) {
            $query = $this->querySelector($querySelector)
                ->limit($limit, $start)
                ->order_by($col, $dir)
                ->get();
        } else {
            $query = $this
                ->db
                ->limit($limit, $start)
                ->order_by($col, $dir)
                ->get($table);
        }

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    public function dataSearch($table, $limit, $start, $search, $col, $dir, $searchAble, $querySelector)
    {
        $like = 0;
        $query = $querySelector
            ? $this->querySelector($querySelector)
            : $this->db->select("*")->from($table);

        foreach ($searchAble as $sc) {
            if ($like === 0) {
                $query->like($sc, $search);
            } else {
                $query->or_like($sc, $search);
            }
            $like++;
        }

        return $query->limit($limit, $start)->order_by($col, $dir)->get()->result();
    }

    public function dataSearchCount($table, $search, $searchAble, $querySelector)
    {
        $like = 0;
        $query = $querySelector
            ? $this->querySelector($querySelector)
            : $this->db->select("*")->from($table);

        foreach ($searchAble as $sc) {
            if ($like === 0) {
                $query->like($sc, $search);
            } else {
                $query->or_like($sc, $search);
            }
            $like++;
        }

        return $query->get()->result();
    }

    public function querySelector($type)
    {
        switch ($type) {
            case "user-admin":
                return $this->User->users(["role" => 1]);
            case "user-mgr":
                return $this->User->users(["role" => 2]);
            case "user-spv":
                return $this->User->users(["role" => 3]);
            case "user-lab":
                return $this->User->users(["role" => 4]);
            case "user-inout":
                return $this->User->users(["role" => 5]);
            case "user-packing":
                return $this->User->users(["role" => 6]);
        }
    }
}

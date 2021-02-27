<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DatatablesModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("UserModel", "User");
        $this->load->model("ReleasedModel", "Released");
    }

    public function totalDocument($table, $querySelector , $queryVariabel)
    {
        if ($querySelector) {
            if($queryVariabel) {
                $query = $this->querySelector($querySelector);
                foreach ($queryVariabel as $where => $field) {
                    $query->where($where, $field);
                }
                return $query->count_all_results();
            } else {
                return $this->querySelector($querySelector)->count_all_results();
            }
        } else {
            return $this->db->count_all_results($table);
        }
    }

    public function getAll($table, $limit, $start, $col, $dir, $querySelector, $queryVariabel)
    {
        if ($querySelector) {
            if($queryVariabel) {
                $query = $this->querySelector($querySelector);
                
                foreach ($queryVariabel as $where => $field) {
                    $query->where($where, $field);
                }

                $query->limit($limit, $start);
                $query->order_by($col, $dir);
                return $query->get()->result();
            } else {
                return $this->querySelector($querySelector)
                ->limit($limit, $start)
                ->order_by($col, $dir)
                ->get()
                ->result();
            }
        } else {
            return $this->db
                ->limit($limit, $start)
                ->order_by($col, $dir)
                ->get($table)
                ->result();
        }

        // if ($query->num_rows() > 0) {
        //     return $query->result();
        // } else {
        //     return null;
        // }
    }

    public function dataSearch($table, $limit, $start, $search, $col, $dir, $searchAble, $querySelector, $queryVariabel)
    {
        $like = 0;
        $query = $querySelector
            ? $this->querySelector($querySelector)
            : $this->db->select("*")->from($table);

        if($queryVariabel) {
            foreach ($queryVariabel as $where => $field) {
                $query->where($where, $field);
            }
        }

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

    public function dataSearchCount($table, $search, $searchAble, $querySelector, $queryVariabel)
    {
        $like = 0;
        $query = $querySelector
            ? $this->querySelector($querySelector)
            : $this->db->select("*")->from($table);

        if($queryVariabel) {
            foreach ($queryVariabel as $where => $field) {
                $query->where($where, $field);
            }
        }

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
            case "released-roll":
                return $this->Released->getRolls();
        }
    }
}

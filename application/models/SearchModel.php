<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SearchModel extends CI_Model
{
    public function getTotal($params, $table, $dateField)
    {
        $like = 0;
        foreach ($params as $field => $value) {
            if ($field == "year") {
                $this->db->where("YEAR($dateField)", $value);
            } else if ($field == "month") {
                $this->db->where("MONTH($dateField)", $value);
            } else {
                $fieldExp = explode(":", $field);
                if (count($fieldExp) > 1) {
                    if ($fieldExp[0] == "like") {
                        if ($like == 0) {
                            if ($value) {
                                $this->db->like($fieldExp[1], $value);
                                $like++;
                            }
                        } else {
                            if ($value) {
                                $this->db->or_like($fieldExp[1], $value);
                            }
                        }
                    } else if ($fieldExp[0] == "where_in") {
                        $val2 = explode(",", $value);
                        if (count($val2) > 1) {
                            $this->db->where_in($fieldExp[1], $val2);
                        } else {
                            $this->db->where($fieldExp[1], $value);
                        }
                    } else if ($fieldExp[0] == "gt") {
                        $this->db->where("$fieldExp[1] >", $value);
                    } else if ($fieldExp[0] == "not") {
                        $this->db->where("$fieldExp[1] !=", $value);
                    }
                } else {
                    if ($value) {
                        $this->db->where($field, $value);
                    }
                }
            }
        }
        return $this->db->count_all_results($table);
    }

    public function getLimit($select, $params, $table, $dateField, $limit, $startIndex, $order_by)
    {
        $this->db->select($select);

        $like = 0;
        foreach ($params as $field => $value) {
            if ($field == "year") {
                $this->db->where("YEAR($dateField)", $value);
            } else if ($field == "month") {
                $this->db->where("MONTH($dateField)", $value);
            } else {
                $fieldExp = explode(":", $field);
                if (count($fieldExp) > 1) {
                    if ($fieldExp[0] == "like") {
                        if ($like == 0) {
                            if ($value) {
                                $this->db->like($fieldExp[1], $value);
                                $like++;
                            }
                        } else {
                            if ($value) {
                                $this->db->or_like($fieldExp[1], $value);
                            }
                        }
                    } else if ($fieldExp[0] == "where_in") {
                        $val2 = explode(",", $value);
                        if (count($val2) > 1) {
                            $this->db->where_in($fieldExp[1], $val2);
                        } else {
                            $this->db->where($fieldExp[1], $value);
                        }
                    } else if ($fieldExp[0] == "gt") {
                        $this->db->where("$fieldExp[1] >", $value);
                    } else if ($fieldExp[0] == "not") {
                        $this->db->where("$fieldExp[1] !=", $value);
                    }
                } else {
                    if ($value) {
                        $this->db->where($field, $value);
                    }
                }
            }
        }
        foreach ($order_by as $field => $value) {
            $this->db->order_by($field, $value);
        }
        $this->db->limit($limit, $startIndex);
        return $this->db->get($table)->result();
    }
}

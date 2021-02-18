<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My_Form_validation extends CI_Form_validation {
    protected $ci;

    public function __construct() {
        parent::__construct();
        $this->ci = &get_instance();    
    }

    public function isUnique($value, $params)
    {
        $params = explode(".", $params);

        $table = $params[0];
        $field = $params[1];

        $this->ci->db->where($field, $value);

        if (count($params) === 3) {
            $id = $params[2];
            $this->ci->db->where_not_in('id', $id);
        }

        $data = $this->ci->db->limit(1)->get($table)->result();
        return $data ? false : true;
    }
}
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_master extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
    function get_id($table, $where = null, $order = null)
    {
        $this->db->order_by($order);
        $where == null ? null : $this->db->where($where);
        return $this->db->get($table);
    }
    function get_like($table, $like = null, $where = null, $join = [], $order = null)
    {
        foreach ($join as $key => $value) {
            $this->db->join($key, $value);
        }
        $this->db->order_by($order);
        if ($like != null) $this->db->like($like);
        if ($where != null) $this->db->where($where);
        return $this->db->get($table);
    }
    
    function get_count_id($table, $where)
    {
        $this->db->where($where);
        return $this->db->query("SELECT COUNT(*) AS total FROM $table WHERE $where");
    }
    function get_join_id($table, $join, $where, $select = '*', $order = null)
    {
        $this->db->select($select);

        foreach ($join as $j) {
            $this->db->join($j['table'], $j['fk']);
        }
        $this->db->order_by($order);
        if($where != null){
            $this->db->where($where);
        }
        

        return $this->db->get($table);
    }
    function get_join($table, $join, $on, $select = '*',$order = null)
    {
        $this->db->select($select);
        $this->db->join($join, $on);
        $this->db->order_by($order);
        return $this->db->get($table);
    }

    function get($table, $order = null)
    {
        $this->db->order_by($order);
        return $this->db->get($table);
    }
    function get_data_table($table, $start, $join = [], $select = null)
    {
        $draw       = $this->input->post('draw');
        $length     = $this->input->post('length');
        $search     = $this->input->post('search')['value'];

        $output     = [
            'draw'              => $draw,
            'recordsTotal'      => 0,
            'recordsFiltered'   => 0,
            'data'              => []
        ];

        foreach ($join as $key => $value) {
            $on = is_array($value) ? $value['on'] : $value;
            $join = is_array($value) ? $value['join'] : 'INNER';
            $this->db->join($key, $on, $join);
        }
        if ($select) {
            $this->db->select($select);
        }
        $get    = $this->db->from($table)
            ->limit($length, $start);
        if ($search != '') {
            $get->like('LOWER(nama)', strtolower($search));
        }

        $output['data']    = $get->get()->result();
        $output['recordsTotal'] = $output['recordsFiltered']  = $this->db->from($table)->count_all_results();

        return $output;
    }
    function add($table, $data)
    {
        return $this->db->insert($table, $data);
    }
    function edit($table, $data, $where)
    {
        $this->db->where($where);
        return $this->db->update($table, $data);
    }
    function del($table, $where)
    {
        $this->db->where($where);
        return $this->db->delete($table);
    }
    function search($table, $like)
    {
        $this->db->like($like);
        return $this->db->get($table);
    }
    function success($mess)
    {
        $this->session->set_flashdata("mess", "<div class='alert alert-info'><center>" . $mess . "</center></div>");
    }
    function wrong($mess)
    {
        $this->session->set_flashdata("mess", "<div class='alert alert-danger'><center>" . $mess . "</center></div>");
    }
    function warning($mess)
    {
        $this->session->set_flashdata("mess", "<div class='alert alert-warning'><center>" . $mess . "</center></div>");
    }
    function access($only)
    {
        $access =  in_array($this->session->userdata('tipe'), $only);
        return $access;
    }
}

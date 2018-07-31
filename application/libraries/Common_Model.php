<?php

class Common_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

   function get_datatables($tableName, $fileds,$orderBy="",$orderByVal="",$searchWhere="", $sWhere="", $start="", $length="",$joinData=""){

        if (!empty($joinData['join']) && isset($joinData['join'])) {
            foreach ($joinData['join'] as $join) {
                $this->db->join($join['tableName'], $join['condition'], $join['type']);
            }
               
            if(isset($joinData['group_by']) && $joinData['group_by'] != ''){
                $this->db->group_by($joinData['group_by']); 
            }
        }
        $this->db->select($fileds);
        $this->db->from($tableName);

        
        if(!empty($sWhere)){
            $this->db->where($sWhere);
        }

        if(!empty($searchWhere)){
            $this->db->where($searchWhere);
        }
        
        // $this->db->group_by('shortId');
        if($start >= 0 && $length > 0){
           $this->db->limit($length, $start);
        }
        
        if(!empty($orderBy) && !empty($orderByVal)){
            $this->db->order_by($orderBy, $orderByVal);
        }
        
        $posts = $this->db->get()->result_array();

        //echo $this->db->last_query();
        
        if (count($posts)) {
            return $posts;
        } else {
            return array();
        }
    }

    function addRecordsCommon($tableName, $data) {

        $this->db->insert($tableName, $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function updateRecordsCommon($tableName, $dataToUpdate, $key, $value) {
        return $this->db->update($tableName, $dataToUpdate, array($key => $value));
    }

    function deleteAllCommon($id, $tbl_name, $key) {
        $this->db->where($key . ' IN (' . $id . ')');
        $this->db->delete($tbl_name);
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }

    function getListByIdForOneRecordCommon($tableName, $key, $value, $fileds) {
        $this->db->select($fileds);
        $this->db->from($tableName);
        $this->db->where($key, $value);
        $posts = $this->db->get()->result_array();
        if (count($posts) > 0) {
            return $posts[0];
        } else {
            return array();
        }
    }

    function getListByIdForAllRecordsCommon($tableName, $key, $value,$likeVal, $fileds) {
        if($likeVal != ''){
             $this->db->like($key,$likeVal);
        }
        if($value != ''){
            $this->db->where($key, $value); 
        }
        $this->db->select($fileds);
        $this->db->from($tableName);
       
        $posts = $this->db->get()->result_array();
        if (count($posts) > 0) {
            return $posts;
        } else {
            return array();
        }
    }
    

}

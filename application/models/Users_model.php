<?php

require_once(APPPATH . '/libraries/Common_Model.php');

class Users_model extends Common_Model {

    function __construct() {
        parent::__construct();
        $this->tableName = 'tbl_users';
        $this->key = 'userId';
        $this->fields = "userId,firstName,lastName,email,profilePic,createdDate,status,companyName,mobileNumber,address";
    }

    // check validation for login admin user
    function validate($userName, $password) {
        $this->db->where('email', $userName);
        $this->db->where('password', md5($password));
        $this->db->where('status', '1');

        $query = $this->db->get('tbl_admin')->result_array();
        
        if (!empty($query)) {
            return $query;
        } else {
            return false;
        }
    }

    // for login user data
    function getRows() {
        $this->db->select('au.*');
        $this->db->from('tbl_admin au');
        $this->db->order_by('au.id', 'DESC');
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->result_array() : FALSE;
    }

    //    get user data at ajax call
    function get_user_datatables($searchWhere = "", $searchParamVal = "", $start = "", $length = "", $orderByKey = "", $orderByVal = "", $joinData = "") {

        $selecFileds = $this->fields;
        if (!empty($joinData['select'])) {
            $selecFileds = $this->fields . ", " . $joinData['select'];
        }

        //define columns for searching
        $aColumns = explode(",", $selecFileds);

        // Addtitional Filtering
        $sWhere = "";
        if ($searchParamVal != "") {
            $sWhere .= "(";
            for ($i = 0; $i < count($aColumns); $i++) {
                $sWhere .= $aColumns[$i] . " LIKE '%" . $searchParamVal . "%' OR ";
            }
            $sWhere = substr_replace($sWhere, "", -3);
            $sWhere .= ')';
        }

        if (!empty($orderByKey)) {
            $this->key = $orderByKey;
        }

        $newResult = $this->get_datatables($this->tableName, $selecFileds, $this->key, $orderByVal, $searchWhere, $sWhere, $start, $length, $joinData);
        return $newResult;
    }

    function checkEmailExist($email, $whereId = NULL) {
        if (empty($whereId)) {
            return $this->db->get_where('tbl_admin', array('email' => $email))->row_array();
        } else {
            return $this->db->get_where('tbl_admin', array('email' => $email, 'id!=' => $whereId))->row_array();
        }
    }

    function checkAdminEmailExist($email, $whereId = NULL) {
        if (empty($whereId)) {
            return $this->db->get_where('tbl_admin', array('email' => $email))->row_array();
        } else {
            return $this->db->get_where('tbl_admin', array('email' => $email, 'id!=' => $whereId))->row_array();
        }
    }

    // get user detail
    function getUser($id) {

        $getRecord = $this->getListByIdForOneRecordCommon($this->tableName, $this->key, $id, $this->fields);
        return $getRecord;
    }

    // get user detail
    function getAdminUser($id) {
        $tableName = "tbl_admin";
        $fields = "id,firstName,lastName,email,password,profile";
        $getRecord = $this->getListByIdForOneRecordCommon($tableName, "id", $id, $fields);
        return $getRecord;
    }

}

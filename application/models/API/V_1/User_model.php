<?php

require_once(APPPATH . '/libraries/API_Common_model.php');

class User_model extends API_Common_model {

    public function __construct() {
        parent::__construct();
        $this->tableName = 'tbl_users u';
        $this->key = 'u.id';
        $this->fields = "u.id,u.firstName,u.lastName,u.email,u.roleId,u.techId,u.gender,u.joiningDate,u.phoneNo,u.altPhoneNo,u.address,u.description";
        $this->load->database();
    }

    function addRecords($data_to_store) {
        $addRecord = $this->addRecordsCommon($this->tableName, $data_to_store);
        return $addRecord;
    }

    function updateRecords($data_to_update, $key, $value) {
        $updateRecord = $this->updateRecordsCommon($this->tableName, $data_to_update, $key, $value);
        return $updateRecord;
    }

    function getListByIdForOneRecord($key, $value) {
        $recordById = $this->getListByIdForOneRecordCommon($this->tableName, $key, $value, $this->fileds);
        return $recordById;
    }

    function getListByIdForAllRecords($key, $value, $fileds = NULL) {
        if (empty($fileds)) {
            $fileds = $this->fileds;
        }
        $recordById = $this->getListByIdForAllRecordsCommon($this->tableName, $key, $value, $fileds);
        return $recordById;
    }

    function getListForAllRecordsCommon($searchWhere, $fileds = NULL) {

        if (empty($fileds)) {
            $fileds = $this->fileds;
        }
        $recordById = $this->getAllRecordsCommon($this->tableName, $searchWhere, $fileds);
        return $recordById;
    }

    function getListByTwoKeysForAllRecords($key1, $value1, $key2, $value2, $fileds = NULL) {
        if (empty($fileds)) {
            $fileds = $this->fileds;
        }
        $recordById = $this->getListByTwoKeysForAllRecordsCommon($this->tableName, $key1, $value1, $key2, $value2, $fileds);
        return $recordById;
    }

    //    get All data with join data
    function getAllUsers($searchWhere = "", $searchParamVal = "", $start = "", $length = "", $orderByKey = "", $orderByVal = "", $joinData = "") {

        $selecFileds = $this->fileds;
        if (!empty($joinData['select'])) {
            $selecFileds = $selecFileds . ", " . $joinData['select'];
        }

        if (!empty($orderByKey)) {
            $this->key = $orderByKey;
        }
//        echo 'key-----'.$this->key;
        $newResult = $this->get_datatables($this->tableName, $selecFileds, $this->key, $orderByVal, $searchWhere, $sWhere, $start, $length, $joinData);
        return $newResult;
    }

    //    get All data with join data
    function getAllData($searchWhere = "", $searchParamVal = "", $start = "", $length = "", $orderByKey = "", $orderByVal = "", $joinData = "") {

        $selecFileds = "uf.friendId,uf.friendStatus";
        if (!empty($joinData['select'])) {
            $selecFileds = $selecFileds . ", " . $joinData['select'];
        }

        if (!empty($orderByKey)) {
            $this->key = $orderByKey;
        }

        $newResult = $this->get_datatables("sc_userFriendList uf", $selecFileds, $this->key, $orderByVal, $searchWhere, $sWhere, $start, $length, $joinData);
        return $newResult;
    }

    function calculateAge($birthDate) {
        $from = new DateTime($birthDate);
        $to = new DateTime('today');
        return $from->diff($to)->y;
    }

}

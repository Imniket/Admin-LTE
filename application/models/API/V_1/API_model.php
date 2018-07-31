<?php

require_once(APPPATH . '/libraries/API_Common_model.php');

class API_model extends API_Common_model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function addRecords($table, $data_to_store) {
        $addRecord = $this->addRecordsCommon($table, $data_to_store);
        return $addRecord;
    }

    function updateRecords($table, $data_to_update, $key, $value) {
        $updateRecord = $this->updateRecordsCommon($table, $data_to_update, $key, $value);
        return $updateRecord;
    }

    function getListByIdForOneRecord($table, $key, $value, $fields) {
        $recordById = $this->getListByIdForOneRecordCommon($table, $key, $value, $fields);
        return $recordById;
    }

    function getLatestPageRandom($table, $key, $value, $fields) {
        $this->db->select($fields);
        $this->db->from($table);
        $this->db->where($key, $value);
        $posts = $this->db->get()->result_array();
        if (count($posts) > 0) {
            return $posts;
        } else {
            return array();
        }
    }

    function getListByIdForAllRecords($tabel, $key, $value, $fileds = NULL) {
        $recordById = $this->getListByIdForAllRecordsCommon($tabel, $key, $value, $fileds);
        return $recordById;
    }

    function getListByTwoKeysForAllRecords($table, $key1, $value1, $key2, $value2, $fileds = NULL) {
        $recordById = $this->getListByTwoKeysForAllRecordsCommon($table, $key1, $value1, $key2, $value2, $fileds);
        return $recordById;
    }

}

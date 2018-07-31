<?php

require_once(APPPATH . '/libraries/API_Common_model.php');

class Device_model extends API_Common_model {

    public function __construct() {
        parent::__construct();
        $this->tableName = 'tbl_devices';
        $this->key = 'deviceId';
        $this->fileds = "deviceId, userId, intUdid, deviceType, deviceToken, accessToken, isLogin";
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

    function getListByIdForAllRecords($key, $value) {
        $recordById = $this->getListByIdForAllRecordsCommon($this->tableName, $key, $value, $this->fileds);
        return $recordById;
    }

    function getListByTwoKeysForAllRecords($key1, $value1, $key2, $value2) {
        $recordById = $this->getListByTwoKeysForAllRecordsCommon($this->tableName, $key1, $value1, $key2, $value2, $this->fileds);
        return $recordById;
    }

}

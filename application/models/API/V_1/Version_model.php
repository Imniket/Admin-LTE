<?php

require_once(APPPATH . '/libraries/API_Common_model.php');

class Version_model extends API_Common_model {

    public function __construct() {
        parent::__construct();
        $this->tableName = 'tbl_versions';
        $this->key = 'versionsId';
        $this->fileds = "version, minVersion, update, msg";
        $this->load->database();
    }

    function getListByIdForAllRecords($key, $value) {
        $recordById = $this->getListByIdForAllRecordsCommon($this->tableName, $key, $value, $this->fileds);
        return $recordById;
    }

}

<?php

require_once(APPPATH . '/libraries/API_Common_model.php');

class Apilogs_model extends API_Common_model {

    public function __construct() {
        parent::__construct();
        $this->tableName = 'tbl_apilogs';
        $this->load->database();
    }

    function addRecords($data_to_store) {
        $addRecord = $this->addRecordsCommon($this->tableName, $data_to_store);
        return $addRecord;
    }
}

<?php

error_reporting(0);
require(APPPATH . '/libraries/REST_Controller.php');

class Logout extends REST_Controller {

    function index() {
        if (($this->flag) == 1) {

            $accessToken = $this->accessToken; 
            $userId = $this->userId;

            $dataToUpdate['isLogin'] = '0';
            $dataToUpdate['accessToken'] = '';
            $updateDevices = $this->Device_model->updateRecords($dataToUpdate, 'userId', $userId);
            
            if ($updateDevices) {
                $this->setResponseData(STATUS_SUCCESS_CODE, "Success", $accessToken, $this->config->item('logout_success'));
            } else {
                $this->setResponseData(STATUS_FAILURE_CODE, "Failure", $accessToken, $this->config->item('logout_failed'));
            }
            echo json_encode($response);
            exit;
        }
    }

}

?>
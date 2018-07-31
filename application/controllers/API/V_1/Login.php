<?php

error_reporting(0);
require(APPPATH . '/libraries/REST_Controller.php');

class Login extends REST_Controller {

    function index() {
        if (($this->flag) == 1) {

            $accessToken = $this->accessToken;
            $versionData = $this->versionData;

            $userName = $this->input->post('email');
            $password = $this->input->post('password');
            $deviceIntUdid = $this->input->post('intUdid');

            if (empty($userName) || empty($password)) {
                $this->setResponseData(STATUS_PARAMETER_MISSING_CODE, "Failure", $accessToken, $this->config->item('parameter_missing'));
            } else {
                $isUserNameExistOrNot = $this->User_model->getListByIdForOneRecord('email', $userName);
                if (empty($isUserNameExistOrNot)) {
                    $this->setResponseData(STATUS_FAILURE_CODE, "Failure", $accessToken, $this->config->item('email_not_registered'));
                } else {

                    $password = md5($this->input->post('password'));
                    $searchWhere = "email='" . $userName . "' AND password='" . $password . "' ";
                    $loginUserDetails = $this->User_model->getListForAllRecordsCommon($searchWhere, "");
                    if (empty($loginUserDetails)) {
                        $this->setResponseData(STATUS_FAILURE_CODE, "Failure", $accessToken, $this->config->item('pass_incorrect'));
                    } else {

                        $allLoginDevice = $this->Device_model->getListByIdForAllRecords("userId", $loginUserDetails[0]['userId']);
                        if (!empty($allLoginDevice)) {
                            $deviceData['isLogin'] = "0";
                            $updateDevices = $this->Device_model->updateRecords($deviceData, "userId", $loginUserDetails[0]['userId']);
                        }

                        $device['userId'] = $loginUserDetails[0]['userId'];
                        $device['isLogin'] = "1";
                        $updateDevices = $this->Device_model->updateRecords($device, "intUdid", $deviceIntUdid);

                        $loginUserDetails[0]['profilePic'] = base_url() . 'uploads/users/original/' . $loginUserDetails[0]['profilePic'];

                        $loginUserDetails = array_map(function($v) {
                            return (is_null($v)) ? "" : $v;
                        }, $loginUserDetails);

                        $userResponse = array();
                        $userResponse = $loginUserDetails;

                        $this->setResponseData(STATUS_SUCCESS_CODE, "Success", $accessToken, $this->config->item('login_success'), $userResponse);
                    }
                }
            }
        }
    }

}

?>

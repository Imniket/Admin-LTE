<?php

defined('BASEPATH') or exit('No direct script access allowed');

//require(APPPATH . '/third_party/Facebook/vendor/autoload.php');

abstract class REST_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->library('email');
        $this->load->library('upload');
        $this->load->helper('file');

        $this->flag = false;

        $this->load->model('API/V_1/Device_model', 'Device_model');
        $this->load->model('API/V_1/Version_model', 'Version_model');
        $this->load->model('API/V_1/User_model', 'User_model');
        $this->load->model('API/V_1/Apilogs_model', 'Apilogs_model');
        $this->load->model('API/V_1/API_Common_model', 'API_Common_model');

        function json($data) {

            if (is_array($data)) {

                return json_encode($data);
            }
        }

        function jsond($data) {

            return json_decode(stripslashes($data), true);
        }
        
        $REQUEST = $_REQUEST;
        //$apiNameArray = $_SERVER['REDIRECT_URL'];
        //print_r($_SERVER);exit;
        $apiName = $this->getApiName($_SERVER['REDIRECT_URL']);

        $api_key = "1mz2mowebapp2app3mtpl4dev5ci6";

        $apiKey = $REQUEST['apiKey'];

        if (!empty($apiKey)) {

            if ($apiKey == $api_key) {

                /*                 * **** Value store device table Start ****** */
                $deviceDetail['deviceType'] = $REQUEST['deviceType'];
                $deviceDetail['deviceToken'] = $REQUEST['deviceToken'];
                $deviceDetail['intUdid'] = $REQUEST['intUdid'];
                $deviceDetail['createdDate'] = date('Y-m-d h:i:s');
                /*                 * **** Value store device table End ****** */

                if (empty($deviceDetail['deviceType']) || empty($deviceDetail['deviceToken']) || empty($deviceDetail['intUdid'])) {
                    $error = array('status' => 'Failure', 'errorcode' => '-21', 'msg' => 'Devices parameters are missing.');
                    echo json_encode($error);
                    exit;
                }

                $versionData = $this->getVersionData($deviceDetail['deviceType']);

                $userId = 0;
                if (isset($REQUEST['userId'])) {
                    $userId = $REQUEST['userId'];
                }

                $accessToken = $REQUEST['accessToken'];

                if (strtolower($apiName) != 'login' && strtolower($apiName) != 'forgotpassword') {

                    if (empty($userId)) {
                        $error = array('status' => 'Failure', 'errorcode' => '-11', 'msg' => 'UserId is missing.');
                        echo json_encode($error);
                        exit;
                    }
                    if (empty($accessToken)) {
                        $error = array('status' => 'Failure', 'errorcode' => '-31', 'msg' => 'Access Token is missing.');
                        echo json_encode($error);
                        exit;
                    }

                    $deviceDetails = $this->Device_model->getListByTwoKeysForAllRecords('intUdid', $deviceDetail['intUdid'], 'accessToken', $accessToken);

                    if (empty($deviceDetails)) {
                        $error = array('status' => 'Failure', 'errorcode' => '-30', 'msg' => 'Access Token is not matched.');
                        echo json_encode($error);
                        exit;
                    }
                }

                if (empty($accessToken)) {
                    $newAccessToken = $this->generateAccessToken();
                } else {
                    $newAccessToken = $accessToken;
                }


                $deviceDetail['accessToken'] = $newAccessToken;

                $deviceDetail['apiName'] = $apiName;
                $checkDevice = $this->Device_model->getListByIdForOneRecord('intUdid', $deviceDetail['intUdid']);
                if (!empty($checkDevice)) {
                    $deviceDetail['updatedDate'] = date('Y-m-d h:i:s');
                    if ($apiName != 'Logout') {
                        $deviceDetail['isLogin'] = '1';
                    }
                    $updateDevices = $this->Device_model->updateRecords($deviceDetail, 'deviceId', $checkDevice['deviceId']);
                } else {
                    $deviceDetail['createdDate'] = date('Y-m-d h:i:s');
                    $deviceDetail['userId'] = $userId;
                    $addDevices = $this->Device_model->addRecords($deviceDetail);
                }

                $dataToAddLog['userId'] = $userId;
                $dataToAddLog['apiName'] = $apiName;
                $this->addApiLogs($dataToAddLog);

                $this->userId = $userId;
                $this->accessToken = $newAccessToken;
                $this->flag = true;
                $this->versionData = $versionData;
            } else {
                $error = array('status' => 'Failure', 'errorcode' => '-101', 'msg' => 'API key not match.');
                print_r(json($error));
                exit;
            }
        } else {
            $error = array('status' => 'Failure', 'errorcode' => '-100', 'msg' => 'API key is missing.');
            print_r(json($error));
            exit;
        }
    }
    
    public function getHeaders(){
        $this->input->request_headers();
    }

    public function getApiName($apiName) {

        $apiNamearr = explode('/', $apiName);
        $apiName = end($apiNamearr);
        return $apiName;
    }

    public function getVersionData($deviceType) {
        $versionData = $this->Version_model->getListByIdForAllRecords('device', $deviceType);
        return $versionData;
    }

    public function addApiLogs($dataToAdd) {
        $versionData = $this->Apilogs_model->addRecords($dataToAdd);
        return $versionData;
    }

    public function getUserDetails($userId) {
        $userarray = $this->User_model->getListByIdForOneRecord('userId', $userId);
        return $userarray;
    }

    public function generateAccessToken() {

        $accessToken = substr(str_shuffle(MD5(microtime())), 0, 8);

        $checkDevice = $this->Device_model->getListByIdForOneRecord('accessToken', $accessToken);
        if (!empty($checkDevice)) {
            $acessToken = substr(str_shuffle(MD5(microtime())), 0, 8);
        } else {
            $acessToken = $accessToken;
        }
        return $acessToken;
    }

    public function sendEmail($subject, $template, $fullName, $emailId, $fromEmail, $url) {

        $this->email->set_newline("\r\n");

        $fromEmail = "support@socap.com.au";

        $this->email->from($fromEmail, APP_NAME); // From Email	      
        $this->email->to($emailId); // To Email

        $this->email->subject($subject); // Target name is company admin name or employee name        

        $this->email->set_mailtype("html"); // Email type
//if default codigniter email is not working  enable the below  

        $this->load->helper('file');
        $emailBody = read_file('./EmailTemplates/' . $template); // Path email template

        $emailBody = str_replace('<<LOGO>>', base_url() . 'themes/adminLte/dist/img/logo_mail.png', $emailBody); // Dynamic variable
        $emailBody = str_replace('<<NAME>>', $fullName, $emailBody); // Dynamic variable

        if ($url) {
            $emailBody = str_replace('<<URL>>', $url, $emailBody); // Dynamic variable
        }

        $emailBody = str_replace('<<FROMEMAIL>>', $fromEmail, $emailBody); // Dynamic variable

        $this->email->message($emailBody);

        if ($this->email->send()) {
            return 1;
        } else {
            return 0;
        }
    }

    public function upload($field_name1 = '', $target_folder1 = '', $file_name1 = '', $thumb1 = FALSE, $thumb_folder1 = '', $thumb_width1 = '', $thumb_height1 = '', $thumb_folder2 = '', $thumb_width2 = '', $thumb_height2 = '', $thumb_folder3 = '', $thumb_width3 = '', $thumb_height3 = '') {
        //folder path setup
        $target_path1 = $target_folder1;
        $thumb_path1 = $thumb_folder1;
        $thumb_path2 = $thumb_folder2;
        $thumb_path3 = $thumb_folder3;
        //echo $field_name1;
        $filename = $_FILES[$field_name1]['name'];

        $ext = explode(".", $filename);
        $ffname = rand() . "." . $ext[1];
        //file name setup
        $filename_err1 = explode(".", $ffname);
        $filename_err_count1 = count($filename_err1);
        $file_ext1 = $filename_err1[$filename_err_count1 - 1];
        //exit;
        if ($file_name1 != '') {
            $fileName1 = $file_name1 . '.' . $file_ext1;
        } else {
            $fileName1 = $ffname;
        }
//upload image path
        $upload_image1 = $target_path1 . basename($fileName1);
//upload image
        if (move_uploaded_file($_FILES[$field_name1]['tmp_name'], $upload_image1)) {
//thumbnail creation
            if ($thumb1 == TRUE) {
                $thumbnail1 = $thumb_path1 . $fileName1;
                list($width1, $height1) = getimagesize($upload_image1);
                $thumb_create1 = imagecreatetruecolor($thumb_width1, $thumb_height1);
                switch ($file_ext1) {
                    case 'jpg':
                        $source1 = imagecreatefromjpeg($upload_image1);
                        break;
                    case 'jpeg':
                        $source1 = imagecreatefromjpeg($upload_image1);
                        break;
                    case 'png':
                        $source1 = imagecreatefrompng($upload_image1);
                        break;
                    case 'gif':
                        $source1 = imagecreatefromgif($upload_image1);
                        break;
                    default:
                        $source1 = imagecreatefromjpeg($upload_image1);
                }
                imagecopyresized($thumb_create1, $source1, 0, 0, 0, 0, $thumb_width1, $thumb_height1, $width1, $height1);
                switch ($file_ext1) {
                    case 'jpg' || 'jpeg':
                        imagejpeg($thumb_create1, $thumbnail1, 100);
                        break;
                    case 'png':
                        imagepng($thumb_create1, $thumbnail1, 100);
                        break;
                    case 'gif':
                        imagegif($thumb_create1, $thumbnail1, 100);
                        break;
                    default:
                        imagejpeg($thumb_create1, $thumbnail1, 100);
                }
                $thumbnail2 = $thumb_path2 . $fileName1;
                list($width1, $height1) = getimagesize($upload_image1);
                $thumb_create2 = imagecreatetruecolor($thumb_width2, $thumb_height2);
                switch ($file_ext1) {
                    case 'jpg':
                        $source1 = imagecreatefromjpeg($upload_image1);
                        break;
                    case 'jpeg':
                        $source1 = imagecreatefromjpeg($upload_image1);
                        break;
                    case 'png':
                        $source1 = imagecreatefrompng($upload_image1);
                        break;
                    case 'gif':
                        $source1 = imagecreatefromgif($upload_image1);
                        break;
                    default:
                        $source1 = imagecreatefromjpeg($upload_image1);
                }
                imagecopyresized($thumb_create2, $source1, 0, 0, 0, 0, $thumb_width2, $thumb_height2, $width1, $height1);
                switch ($file_ext1) {
                    case 'jpg' || 'jpeg':
                        imagejpeg($thumb_create2, $thumbnail2, 100);
                        break;
                    case 'png':
                        imagepng($thumb_create2, $thumbnail2, 100);
                        break;
                    case 'gif':
                        imagegif($thumb_create2, $thumbnail2, 100);
                        break;
                    default:
                        imagejpeg($thumb_create2, $thumbnail2, 100);
                }
                $thumbnail3 = $thumb_path3 . $fileName1;
                list($width1, $height1) = getimagesize($upload_image1);
                $thumb_create3 = imagecreatetruecolor($thumb_width3, $thumb_height3);
                switch ($file_ext1) {
                    case 'jpg':
                        $source1 = imagecreatefromjpeg($upload_image1);
                        break;
                    case 'jpeg':
                        $source1 = imagecreatefromjpeg($upload_image1);
                        break;
                    case 'png':
                        $source1 = imagecreatefrompng($upload_image1);
                        break;
                    case 'gif':
                        $source1 = imagecreatefromgif($upload_image1);
                        break;
                    default:
                        $source1 = imagecreatefromjpeg($upload_image1);
                }
                imagecopyresized($thumb_create3, $source1, 0, 0, 0, 0, $thumb_width3, $thumb_height3, $width1, $height1);
                switch ($file_ext1) {
                    case 'jpg' || 'jpeg':
                        imagejpeg($thumb_create3, $thumbnail3, 100);
                        break;
                    case 'png':
                        imagepng($thumb_create3, $thumbnail3, 100);
                        break;
                    case 'gif':
                        imagegif($thumb_create3, $thumbnail3, 100);
                        break;
                    default:
                        imagejpeg($thumb_create3, $thumbnail3, 100);
                }
            }
            return $fileName1;
        } else {
            return false;
        }
    }

    public function uploadFile($config) {

        $field = $config['field'];
        $upload_conf = array(
            'upload_path' => $config['upload_path'],
            'allowed_types' => (isset($config['allowed_types'])) ? $config['allowed_types'] : 'gif|jpg|jpeg|png|doc|pdf|docx|odt|mp4|mp3',
            'max_size' => (isset($config['max_size'])) ? $config['max_size'] : '',
            'encrypt_name' => true,
        );

        $this->upload->initialize($upload_conf);

        if (!$this->upload->do_upload($field)) {
            $error['status'] = "error";
            $error['msg'] = $this->upload->display_errors();
            return $error;
        } else {
            $upload_data = $this->upload->data();

            if (isset($config['thumb_path']) && $config['thumb_path'] != "") {
                $resize_conf = array(
                    'upload_path' => $config['thumb_path'],
                    'source_image' => $upload_data['full_path'],
                    'new_image' => $upload_data['file_path'] . '../thumb/' . $upload_data['file_name'],
                    'width' => (isset($config['width'])) ? $config['width'] : $this->config->item('thumb_widht'),
                    'height' => (isset($config['height'])) ? $config['height'] : $this->config->item('thumb_height')
                );
                $this->load->library('image_lib');
                // initializing
                $this->image_lib->initialize($resize_conf);
                // do it!
                if (!$this->image_lib->resize()) {
                    // if got fail.
                    $error['status'] = "error";
                    $error['msg'] = $this->image_lib->display_errors();
                    return $error;
                } else {
                    $upload_img = $upload_data['file_name'];
                }
                $success['status'] = "success";
                $success['name'] = $upload_img;
                return $success;
            }
            $success['status'] = "success";
            $success['name'] = $upload_data['file_name'];

            return $success;
        }
    }

    function setResponseData($errorcode, $status, $accessToken, $msg = NUll, $dataArray = array(), $totalRecords = 0, $currentPage = 0, $key1, $value1) {
        if ($value1) {
            $response = array('errorcode' => $errorcode, 'status' => $status, 'accessToken' => $accessToken, 'msg' => $msg, 'data' => $dataArray, $key1 => $value1, 'totalRecords' => (string) $totalRecords, 'currentPage' => $currentPage, 'versionData' => $this->versionData);
        } else {
            $response = array('errorcode' => $errorcode, 'status' => $status, 'accessToken' => $accessToken, 'msg' => $msg, 'data' => $dataArray, 'totalRecords' => (string) $totalRecords, 'currentPage' => $currentPage, 'versionData' => $this->versionData);
        }
        echo json_encode($response);
        exit;
    }

}

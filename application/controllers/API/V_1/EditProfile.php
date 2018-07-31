<?php

error_reporting(0);
require(APPPATH . '/libraries/REST_Controller.php');

class EditProfile extends REST_Controller {

    function index() {
        if (($this->flag) == 1) {

            $accessToken = $this->accessToken;

            $firstName = $this->input->post('firstName');
            if ($firstName) {
                $dataToUpdate['firstName'] = $firstName;
            }
            $lastName = $this->input->post('lastName');
            if ($lastName) {
                $dataToUpdate['lastName'] = $lastName;
            }
            $birthDate = $this->input->post('birthDate');
            if ($birthDate) {
                $dataToUpdate['birthDate'] = $birthDate;
            }
            $gender = $this->input->post('gender');
            if ($gender) {
                $dataToUpdate['gender'] = $gender;
            }
            $profilePic = $this->input->post('profilePic');
            if ($profilePic) {
                $dataToUpdate['profilePic'] = $profilePic;
            }
            $phoneNo = $this->input->post('phoneNo');
            if ($phoneNo) {
                $dataToUpdate['phoneNo'] = $phoneNo;
            }
            $skype = $this->input->post('skype');
            if ($skype) {
                $dataToUpdate['skype'] = $skype;
            }
            $password = md5($this->input->post('password'));
            if ($password) {
                $dataToUpdate['password'] = $password;
            }

            if (!empty($_FILES['profilePic'])) {
                $config['upload_path'] = 'uploads/users/original';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = $_FILES['profilePic']['name'];
                list($width, $height) = getimagesize($_FILES['profilePic']['tmp_name']);
                $ratio = $width / $height;
                $desired_height = $height;
                $desired_width = $desired_height * $ratio;
                $upload_img = $this->upload('profilePic', 'uploads/users/original/', '', TRUE, 'uploads/users/thumb/', $desired_width, $desired_height);
                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $picture = $upload_img;
                $dataToUpdate['profilePic'] = $picture;
            }

            $userUpdate = $this->User_model->updateRecords($dataToUpdate, 'userId', $this->userId);

            $userDetails = $this->User_model->getListByIdForAllRecords('userId', $this->userId);
            foreach ($userDetails as $i => $j) {
                if ($userDetails[$i]['profilePic']) {
                    $userDetails[$i]['profilePic'] = base_url() . 'uploads/users/original/' . $userDetails[$i]['profilePic'];
                }
            }

            $this->setResponseData(STATUS_SUCCESS_CODE, "Success", $accessToken, $this->config->item('setting_update'), $userDetails);
        }
    }

}

?>

<?php

require(APPPATH . '/libraries/Custom_Controller.php');

class Dashboard extends Custom_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Users_model', 'ci_model');
    }

    function index() {
        $data['page_title'] = 'Dashboard';
        
        $data['content'] = 'admin/dashboard';
        $this->load->view('admin/layouts/main', $data);
    } 
    function profile() {
        $data['page_title'] = 'Profile';
        $userData = $this->session->userdata('AdminUserData');
        $data['user'] = $this->ci_model->getAdminUser($userData['id']);
        #print_r($userData);exit; 
        $data['content'] = 'admin/profile';
        $this->load->view('admin/layouts/main', $data);
    }

    function updateProfile($id) {
        
        if (isset($_POST) && !empty($_POST)) {
            $data = array();
            $data['email'] = $this->input->post('email');
            $userData = $this->session->userdata('AdminUserData');

            $checkEmailExist = $this->ci_model->checkAdminEmailExist($data['email'], $id);

            if (!empty($checkEmailExist)) {
                $this->session->set_flashdata('flash_message_error', "Email associated with another account");
                redirect('admin/dashboard/profile');
            } else {
                $data['firstName'] = $this->input->post('first_name');
                $data['lastName'] = $this->input->post('last_name');

                if (isset($_POST['password']) && $_POST['password'] != "") {
                    $data['password'] = sha1($this->input->post('password'));
                }

                if (!empty($_FILES['profile']) && $_FILES['profile']['name'] != "") {

                    $config = array(
                        'upload_path' => realpath('./uploads/users/original/'),
                        'thumb_path' => realpath('./uploads/users/thumb/'),
                        'field' => 'profile',
                        'allowed_types' => 'gif|jpg|jpeg|png',
                        'max_size' => '3000',
                    );

                    $response = $this->uploadFile($config);
                    if ($response['status'] == "success") {
                        $data['profile'] = $response['name'];
                        $userData['profile'] = $response['name'];
                    } else {
                        $this->session->set_flashdata('flash_message_error', $response['msg']);
                        redirect('admin/dashboard/profile');
                    }
                }

                $menu = $this->ci_model->updateRecordsCommon("fm_admins", $data, "id", $id);
                $sessionData = $this->ci_model->getAdminUser($id);
                /*
                  $userData['firstName'] = $this->input->post('first_name');
                  $userData['lastName'] = $this->input->post('last_name');
                  $userData['profile'] = $data['profile'];
                 */

                $this->session->set_userdata('AdminUserData', $sessionData);

                if ($menu) {
                    $this->session->set_flashdata('flash_message_success', $this->config->item('profile_update'));
                    redirect('admin/dashboard/profile');
                }
            }
        }
    }

}

<?php
require(APPPATH . '/libraries/Custom_Controller.php');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Users_model', 'ci_model');
    }

    function index() {
        ($this->session->userdata('AdminUserData') != "") ? redirect('admin/dashboard') : $this->load->view('admin/login');
    }

    function validate_credentials() {
        $UserName = $this->input->post('email');
        $Password = $this->input->post('password');

        if (!empty($UserName) && !empty($Password)) {
            $is_valid = $this->ci_model->validate($UserName, $Password);
            
            if (!empty($is_valid)) {
                $data = array(
                    'id' => $is_valid[0]['id'],
                    'firstName' => $is_valid[0]['firstName'],
                    'lastName' => $is_valid[0]['lastName'],
                    'profile' => $is_valid[0]['profile'],
                    'email' => $UserName,
                    'is_logged_in' => true,
                );
                
                $this->session->set_userdata('AdminUserData', $data);
                redirect('admin/dashboard');
            } else {
                $this->session->set_flashdata('flash_message_error', $this->config->item('login_error'));
                redirect('admin');
            }
        } else {
            $this->session->set_flashdata('flash_message_error', $this->config->item('login_error_blank'));
            redirect('admin');
        }
    }

    function forgotPassword() {

        if (isset($_POST) && !empty($_POST)) {

            $email = $_POST['email'];
            $checkEmailExist = $this->ci_model->checkEmailExist($email);

            if (empty($checkEmailExist)) {
                $this->session->set_flashdata('flash_message_error', $this->config->item('email_not_registered'));
                redirect('admin/admin/forgotPassword');
            } else {

                $token = md5(time() . rand(1000, 999) . 'mysite');
                $expiredTime = date("F j, Y, H:i", strtotime('+1 hour'));
                //             $newPasswordText = "admin@123";
                // $newPassword = sha1($newPasswordText);

                /* save user token */
                $params = array(
                    'token' => $token,
                    'forgotPasswordStatus' => 'send',
                    'forgotPasswordExpiredTime' => $expiredTime
                );
                // $this->ci_model->updateUser($checkEmailExist['adminId'], $params);
                $this->ci_model->updateRecordsCommon("sc_adminUsers", $params, "adminId", $checkEmailExist['adminId']);

                /* sent mail */
                $fromEmail = "support@socap.co.uk";

                $this->email->from($fromEmail, APP_NAME); // From Email	
                $to = $email;
                $subject = APP_NAME . ' - Forgot Password';
                $logoUrl = base_url() . 'themes/adminLte/dist/img/logo_mail.png';
                $url = base_url() . 'admin/admin/resetPassword/' . $token;

                $this->load->helper('file');
                $body = read_file('./EmailTemplates/forgotPasswordAdmin.html');
                $body = str_replace('<<NAME>>', $checkEmailExist['firstName'] . " " . $checkEmailExist['lastName'], $body);
                $body = str_replace('<<LOGO>>', $logoUrl, $body);
                // $body = str_replace('<<NEWPWD>>', $newPasswordText, $body);
                $body = str_replace('<<URL>>', $url, $body);
                $mail = $this->sendEmail($subject, $to, $fromEmail, $body);

                if ($mail) {
                    $this->session->set_flashdata('flash_message_success', $this->config->item('forgotPassword_success'));
                    redirect('admin/admin/forgotPassword');
                } else {
                    $this->session->set_flashdata('flash_message_error', $this->config->item('forgotPassword_error'));
                    redirect('admin/admin/forgotPassword');
                }
            }
        }

        // if (isset($_POST) && !empty($_POST)) {
        //     $forgotEmail = $this->sendEmail($subject="Forgot Password", $template="forgotPassword.html", $fullName="User", $emailId=$_POST['email'], $fromEmail="", $url="");
        //     // $this->email->from($_POST['email']); // From Email
        //     // $this->email->to('patel@mailinator.com'); // To Email
        //     // $this->email->subject('Forgot Password'); // Email Subject 
        //     // $this->email->message('Testing the email class.'); // Email message
        //     // $this->email->message('Testing the email class.'); // Email message
        //   if($forgotEmail){
        //       $this->session->set_flashdata('flash_message_success', $this->config->item('forgotPassword_success'));
        //     } else {
        //       $this->session->set_flashdata('flash_message_error', $this->config->item('forgotPassword_error'));
        //     }
        //     redirect('admin');
        // }
        $this->load->view('admin/forgotPassword');
    }

    public function sendEmail($subject, $to, $from, $body) {

        $this->load->library('email');
        $this->email->clear();
        $this->email->set_newline("\r\n");

        $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';
        $this->email->initialize($config);
        //$this->email->set_newline("\r\n");
        $this->email->from($from, APP_NAME); // change it to yours
        $this->email->to($to); // change it to yours
        // $this->email->bcc('testsocap@mailinator.com');
        $this->email->bcc('mayur.zala@moweb.com');
        $this->email->subject($subject);
        $this->email->message($body);
        //$this->email->set_mailtype("html");
        if ($this->email->send()) {
            return '1';
        } else {
            return '0';
        }
    }

    function resetPassword($token = NULL) {
        $data['token'] = $token;

        if (isset($_POST) && !empty($_POST)) {
            $password = sha1($_POST['forgotPassword']);
            $token = $_POST['token'];

            $params = array(
                'password' => $password
            );

            $result = $this->ci_model->updateRecordsCommon("sc_adminUsers", $params, "token", $token);
            if ($result) {
                $this->session->set_flashdata('flash_message_success', $this->config->item('Password_reset'));
                redirect('admin');
            }
        }
        $this->load->view('admin/adminResetPassword', $data);
    }

    function logout() {

        $this->session->unset_userdata('AdminUserData');
        redirect('admin');
    }

}

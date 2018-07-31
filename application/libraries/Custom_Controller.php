<?php

defined('BASEPATH') or exit('No direct script access allowed');

abstract class Custom_Controller extends CI_Controller {

    public function __construct() {

        parent::__construct();

        if ($this->session->userdata('AdminUserData') == "") {
            redirect('admin');
        }

        $this->load->library('encrypt');
        $this->load->library('upload');
        $this->load->helper('file');
    }

    public function uploadFile($config) {

        $field = $config['field'];
        $upload_conf = array(
            'upload_path' => $config['upload_path'],
            'allowed_types' => (isset($config['allowed_types'])) ? $config['allowed_types'] : 'gif|jpg|jpeg|png|pdf|mp4',
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
    
    public function uploadVideo($config) {

        $field = $config['field'];
        $upload_conf = array(
            'upload_path' => $config['upload_path'],
            'allowed_types' => (isset($config['allowed_types'])) ? $config['allowed_types'] : 'gif|jpg|jpeg|png|pdf|mp4',
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

//            if (isset($config['thumb_path']) && $config['thumb_path'] != "") {
//                $resize_conf = array(
//                    'upload_path' => $config['thumb_path'],
//                    'source_image' => $upload_data['full_path'],
//                    'new_image' => $upload_data['file_path'] . '../thumb/' . $upload_data['file_name'],
//                    'width' => (isset($config['width'])) ? $config['width'] : $this->config->item('thumb_widht'),
//                    'height' => (isset($config['height'])) ? $config['height'] : $this->config->item('thumb_height')
//                );
//                $this->load->library('image_lib');
//                // initializing
//                $this->image_lib->initialize($resize_conf);
//                // do it!
//                if (!$this->image_lib->resize()) {
//                    // if got fail.
//                    $error['status'] = "error";
//                    $error['msg'] = $this->image_lib->display_errors();
//                    return $error;
//                } else {
//                    $upload_img = $upload_data['file_name'];
//                }
//                $success['status'] = "success";
//                $success['name'] = $upload_img;
//                return $success;
//            }
            $success['status'] = "success";
            $success['name'] = $upload_data['file_name'];
            return $success;
        }
    }

}

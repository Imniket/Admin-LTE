<?php

/* User Model for Councillor user panel */

class API_Common_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function get_user_datatables($tableName, $fileds, $orderByKey, $orderBy, $searchWhere, $start, $length, $companyKey = 0, $companyId = 0) {

        $this->db->select($fileds);
        $this->db->from($tableName);
        if (!empty($companyId)) {
            $this->db->where($companyKey, $companyId);
        }
        if (!empty($searchWhere)) {
            $this->db->where($searchWhere);
        }
        if ($start >= 0 && $length > 0) {
            $this->db->limit($length, $start);
        }
        $this->db->order_by($orderByKey, $orderBy);
        $posts = $this->db->get()->result_array();
        //echo $this->db->last_query();
        if (count($posts)) {
            return $posts;
        } else {
            return array();
        }
    }

    function get_datatables($tableName, $fileds, $orderBy = "", $orderByVal = "", $searchWhere = "", $sWhere = "", $start = "", $length = "", $joinData = "") {

        if (!empty($joinData) && isset($joinData)) {
            if (!empty($joinData['join']) && isset($joinData['join'])) {
                foreach ($joinData['join'] as $join) {
                    $this->db->join($join['tableName'], $join['condition'], $join['type']);
                }
            }

            if (isset($joinData['group_by']) && $joinData['group_by'] != '') {
                $this->db->group_by($joinData['group_by']);
            }
        }
        $this->db->select($fileds);
        $this->db->from($tableName);

        if (!empty($sWhere)) {
            $this->db->where($sWhere);
        }
        if (!empty($searchWhere)) {
            $this->db->where($searchWhere);
        }

        // $this->db->group_by('shortId');
        if ($start >= 0 && $length > 0) {
            $this->db->limit($length, $start);
        }

        if (!empty($orderBy) && !empty($orderByVal)) {
            $this->db->order_by($orderBy, $orderByVal);
        }
        $posts = $this->db->get()->result_array();
//        echo $this->db->last_query();

        if (count($posts)) {
            return $posts;
        } else {
            return array();
        }
    }

    function addRecordsCommon($tableName, $data) {

        $this->db->insert($tableName, $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    // update data with multiple where condition
    function updateRecordsData($tableName, $dataToUpdate, $searchWhere) {

        $this->db->where($searchWhere);
        $result = $this->db->update($tableName, $dataToUpdate);
//         echo $this->db->last_query();
        return $result;
    }

    function updateRecordsCommon($tableName, $dataToUpdate, $key, $value) {
        return $this->db->update($tableName, $dataToUpdate, array($key => $value));
    }

    function deleteAllCommon($id, $tbl_name, $key) {
        $this->db->where($key . ' IN (' . $id . ')');
        $this->db->delete($tbl_name);
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }

    function getAllRecordsCommon($tableName, $searchWhere, $fileds) {
        $this->db->select($fileds);
        $this->db->from($tableName);
        
        if(!empty($searchWhere)){
            $this->db->where($searchWhere);
        }
        $posts = $this->db->get()->result_array();
        if (count($posts) > 0) {
            return $posts;
        } else {
            return array();
        }
    }

    function getListByIdForOneRecordCommon($tableName, $key, $value, $fileds) {
        $this->db->select($fileds);
        $this->db->from($tableName);
        $this->db->where($key, $value);
        $posts = $this->db->get()->result_array();
        if (count($posts) > 0) {
            return $posts[0];
        } else {
            return array();
        }
    }

    function getListByIdForAllRecordsCommon($tableName, $key, $value, $fileds) {
        $this->db->select($fileds);
        $this->db->from($tableName);
        $this->db->where($key, $value);
        $posts = $this->db->get()->result_array();
        if (count($posts) > 0) {
            return $posts;
        } else {
            return array();
        }
    }

    function getListByIdForAllRecordsOrderByCommon($tableName, $key, $value, $fileds, $orderBy, $order) {
        $this->db->select($fileds);
        $this->db->from($tableName);
        $this->db->where($key, $value);
        $this->db->order_by($orderBy, $order);
        $posts = $this->db->get()->result_array();
        if (count($posts) > 0) {
            return $posts;
        } else {
            return array();
        }
    }

    function getListByTwoKeysForAllRecordsCommon($tableName, $key1, $value1, $key2, $value2, $fileds) {
        $this->db->select($fileds);
        $this->db->from($tableName);
        $this->db->where($key1, $value1);
        $this->db->where($key2, $value2);
        $posts = $this->db->get()->result_array();
        if (count($posts) > 0) {
            return $posts;
        } else {
            return array();
        }
    }

    function checkRocordExistCommon($tableName, $key, $value, $fileds) {
        $this->db->select($fileds);
        $this->db->from($tableName);
        $this->db->where($key, $value);
        $posts = $this->db->get()->result_array();
        if (count($posts) > 0) {
            return count($posts);
        } else {
            return array();
        }
    }

    function checkRocordExistForEditCommon($tableName, $key, $value, $fileds, $pkey, $id) {
        $this->db->select($fileds);
        $this->db->from($tableName);
        $this->db->where($key, $value);
        $this->db->where($pkey . '!=' . $id);
        $posts = $this->db->get()->result_array();
        if (count($posts) > 0) {
            return count($posts);
        } else {
            return array();
        }
    }

    /* User upload pic and resize into thumbnail */

    public function upload($field_name1 = '', $target_folder1 = '', $file_name1 = '', $thumb1 = FALSE, $thumb_folder1 = '', $thumb_width1 = '', $thumb_height1 = '', $thumb_folder2 = '', $thumb_width2 = '', $thumb_height2 = '', $thumb_folder3 = '', $thumb_width3 = '', $thumb_height3 = '') {
        //folder path setup
        $target_path1 = $target_folder1;
        $thumb_path1 = $thumb_folder1;

        $thumb_path2 = $thumb_folder2;

        $thumb_path3 = $thumb_folder3;
        $ffname = rand() . str_replace(" ", "_", $_FILES[$field_name1]['name']);

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

    /* User upload pic and resize into thumbnail */
}

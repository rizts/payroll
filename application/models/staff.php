<?php

class Staff extends DataMapper {

    var $table = "staffs";
    var $has_many = array(
        'family',
        'education',
        'work'
    );
    var $auto_populate_has_many = TRUE;
    var $auto_populate_has_one = TRUE;
    var $gallery_path_staff;
    var $gallery_path_url_staff;
    var $validation = array(
        'staff_nik' => array(
            'label' => 'Staff NIK',
            'rules' => array('required')
        ),
        'staff_kode_absen' => array(
            'label' => 'Code Absen',
            'rules' => array('required')
        )
//        'staff_name' => array(
//            'label' => 'Staff Name',
//            'rules' => array('required')
//        ),
//        'staff_email' => array(
//            'label' => 'Email Address',
//            'rules' => array('required', 'trim', 'unique', 'valid_email')
//        )
    );

    function __construct() {
        parent::__construct();

        $this->gallery_path_staff = realpath(APPPATH . '../uploads/staff/medium/');
        $this->gallery_path_url_staff = base_url() . 'uploads/staff/medium/';
    }

    function _delete($id) {
        $this->db->where('staff_id', $id);
        $this->db->delete($this->table);
    }

    function _login() {
        $staff = new Staff();
        $query = $staff->get_where(
                        array(
                            'staff_email' => $this->input->post('email'),
                            'staff_password' => md5($this->input->post('password')))
                )->row();
        return $query;
    }

    function list_drop() {
        $staff = new Staff();
        $staff->get();
        foreach ($staff as $row) {
            $data[''] = '[ Staffs ]';
            $data[$row->staff_id] = $row->staff_name;
        }
        return $data;
    }

    function do_upload($dir, $file_name) {
        $config['upload_path'] = "./uploads/" . $dir . "/real/";
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '2000';
        $config['max_width'] = '2000';
        $config['max_height'] = '2000';
        $config['overwrite'] = TRUE;
        $config['file_name'] = $file_name;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload("photo")) {
            $data = $this->upload->data();

            /* PATH */
            $source = "./uploads/" . $dir . "/real/" . $data['file_name'];
            $destination_thumb = "./uploads/" . $dir . "/thumbnails/";
            $destination_medium = "./uploads/" . $dir . "/medium/";

            /* Permission Configuration */
            chmod($source, 777);

            /*
              Resizing Processing
              Configuration Of Image Manipulation :: Static
             */

            $this->load->library('image_lib');
            $img['image_library'] = 'GD2';
            $img['create_thumb'] = TRUE;
            $img['maintain_ratio'] = TRUE;

            /* Limit Width Resize */
            $limit_medium = 200;
            $limit_thumb = 90;

            /* Size Image Limit was using (LIMIT TOP) */
            $limit_use = $data['image_width'] > $data['image_height'] ? $data['image_width'] : $data['image_height'];

            /* Percentase Resize */
            if ($limit_use > $limit_medium || $limit_use > $limit_thumb) {
                $percent_medium = $limit_medium / $limit_use;
                $percent_thumb = $limit_thumb / $limit_use;
            }

            /* Making THUMBNAIL */
            $img['width'] = $limit_use > $limit_thumb ? $data['image_width'] * $percent_thumb : $data['image_width'];
            $img['height'] = $limit_use > $limit_thumb ? $data['image_height'] * $percent_thumb : $data['image_height'];

            /*
              @Configuration Of Image Manipulation :: Dynamic
             */
            $img['thumb_marker'] = '-thumbnails'; //floor($img['width']).'x'.floor($img['height']) ;
            $img['quality'] = '100%';
            $img['source_image'] = $source;
            $img['new_image'] = $destination_thumb;

            /* Do Resizing */
            $this->image_lib->initialize($img);
            $this->image_lib->resize();
            $this->image_lib->clear();

            /* Making MEDIUM */
            $img['width'] = $limit_use > $limit_medium ? $data['image_width'] * $percent_medium : $data['image_width'];
            $img['height'] = $limit_use > $limit_medium ? $data['image_height'] * $percent_medium : $data['image_height'];

            /* Configuration Of Image Manipulation :: Dynamic */
            $img['thumb_marker'] = '-medium'; //.floor($img['width']).'x'.floor($img['height']) ;
            $img['quality'] = '100%';
            $img['source_image'] = $source;
            $img['new_image'] = $destination_medium;

            /* Do Resizing */
            $this->image_lib->initialize($img);
            $this->image_lib->resize();
            $this->image_lib->clear();
        } else {

        }

        return true;
    }

    function do_upload_fix($dir, $file_name) {
        $config['upload_path'] = $dir;
        $config['allowed_types'] = 'gif|jpg|png|pjpeg';
        $config['max_size'] = '2000';
        $config['max_width'] = '2000';
        $config['max_height'] = '2000';
        $config['overwrite'] = TRUE;
        $config['file_name'] = $file_name;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {
            $error = $this->upload->display_errors();
            $data = '<div class="error">' . $error . '</div>';
            $this->session->set_flashdata('message', $data);
        } else {
            $data = $this->upload->data();
        }
    }

    function show_images($dir_path, $dir_url, $file_name, $width, $height) {
        if (file_exists($dir_path . $file_name . ".jpg")) {
            $type = "jpg";
        } elseif (file_exists($dir_path . $file_name . ".gif")) {
            $type = "gif";
        } elseif (file_exists($dir_path . $file_name . ".png")) {
            $type = "png";
        } elseif (file_exists($dir_path . $file_name . ".pjpeg")) {
            $type = "pjpeg";
        } else {
            $type = "";
        }

        if ($type == "") {
            $data = array(
                'src' => $dir_url . 'empty.png',
                'width' => $width,
                'height' => $height,
                'border' => 0,
                'class' => ''
            );
            $picture = img($data);
        } else {
            $data = array(
                'src' => $dir_url . $file_name . '.' . $type,
                'width' => $width,
                'height' => $height,
                'border' => 0,
                'class' => ''
            );
            $picture = img($data);
        }
        return $picture;
    }

    function remove_images($dir_path, $file_name) {
        if (file_exists($dir_path . $file_name . ".jpg")) {
            unlink($dir_path . $file_name . ".jpg");
        }
        if (file_exists($dir_path . $file_name . ".gif")) {
            unlink($dir_path . $file_name . ".gif");
        }
        if (file_exists($dir_path . $file_name . ".png")) {
            unlink($dir_path . $file_name . ".png");
        }
        if (file_exists($dir_path . $file_name . ".jpeg")) {
            unlink($dir_path . $file_name . ".jpeg");
        }
        if (file_exists($dir_path . $file_name . ".pjpeg")) {
            unlink($dir_path . $file_name . ".pjpeg");
        }
    }

}

?>
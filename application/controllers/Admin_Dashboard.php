<?php
defined('BASEPATH') or exit('no direct access allowed');

class Admin_Dashboard extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        if (sessionId('admin_id') == "") {
            $this->load->view('admin/login');
        }
        date_default_timezone_set("Asia/Kolkata");
    }

    public function index()
    {
        $data['title'] = "Blogs";
        $data['favicon'] = base_url() . 'assets/images/favicon.png';
        $this->load->view('admin/blogs', $data);
    }

    public function banner()
    {

        $data['favicon'] = base_url() . 'assets/images/favicon.png';
        $data['title'] = "Home Banner";
        $data['banner'] = $this->CommonModal->getAllRows('banner');
        $config['upload_path'] = base_url('uploads/banner');

        if (count($_POST) > 0) {

            $post = $this->input->post();
            $no = rand();
            $folder = "./uploads/banner/";
            move_uploaded_file($_FILES["b_img"]["tmp_name"], "$folder" . $no . $_FILES["b_img"]["name"]);
            $file_name = $no . $_FILES["b_img"]["name"];
            $post['b_img'] =  $file_name;
            $savedata = $this->CommonModal->insertRowReturnId('banner', $post);

            if ($savedata) {
                $this->session->set_flashdata('msg', 'Banner added Sucessfully');
                $this->session->set_flashdata('msg_class', 'alert-success');
            } else {
                $this->session->set_userdata('msg', 'Something went Wrong. please try again later  ');
            }
            redirect(base_url('admin_Dashboard/banner'));
        } else {
            $this->load->view('admin/banner', $data);
        }
    }
    public function deletebanner($bid)
    {
        $data['favicon'] = base_url() . 'assets/images/favicon.png';
        $table = "banner";
        $data = $this->CommonModal->getRowById('banner', 'bid', $bid);
        print_r($data[0]['b_img']);
        if (file_exists("./uploads/banner/' . $data[0]['b_img']")) {
            unlink('./uploads/banner/' . $data[0]['b_img']);
        }

        if ($this->CommonModal->deleteRowById($table, array('bid' => $bid))) {

            $this->session->set_flashdata('msg', 'Banner Delete successfully');
            $this->session->set_flashdata('msg_class', 'alert-success');
        } else {
            $this->session->set_flashdata('msg', 'Banner not Delete Please try again!!');
            $this->session->set_flashdata('msg_class', 'alert-danger');
        }
        redirect('admin_Dashboard/banner');
    }

    public function disable()
    {
        $id = $this->uri->segment(3);
        $table = $this->uri->segment(4);
        $status = $this->uri->segment(5);

        $data['favicon'] = base_url() . 'assets/images/favicon.png';

        if ($table == 'category') {
            $this->CommonModal->updateRowById($table, 'category_id', $id, array('status' => $status));
            redirect(base_url('admin_Dashboard/view_category'));
        }
        if ($table == 'sub_category') {
            $this->CommonModal->updateRowById($table, 'sub_category_id', $id, array('status' => $status));
            redirect(base_url('admin_Dashboard/view_subcategory'));
        }
        if ($table == 'promocode') {
            $this->CommonModal->updateRowById($table, 'pid', $id, array('status' => $status));
            redirect(base_url('admin_Dashboard/promocode'));
        }
        if ($table == 'video') {
            $this->CommonModal->updateRowById($table, 'product_id', $id, array('status' => $status));
            redirect(base_url('admin_Dashboard/view_video'));
        }
    }

    public function testimonials()
    {

        $data['favicon'] = base_url() . 'assets/images/favicon.png';
        $data['title'] = "Testimonials  ";
        $data['testimonials'] = $this->CommonModal->getAllRows('testimonials');


        if (count($_POST) > 0) {

            $post = $this->input->post();

            $savedata = $this->CommonModal->insertRowReturnId('testimonials', $post);

            if ($savedata) {
                $this->session->set_userdata('msg', 'Testimonial Added Succesfully.');
            } else {
                $this->session->set_userdata('msg', 'We are facing technical error, please try again later  ');
            }
            redirect(base_url('admin_Dashboard/testimonials'));
        } else {
            $this->load->view('admin/testimonials', $data);
        }
    }
    public function deletetestimonials($tid)
    {
        $data['favicon'] = base_url() . 'assets/images/favicon.png';
        $table = "testimonials";
        $this->CommonModal->deleteRowById($table, array('tid' => $tid));
        redirect('admin_Dashboard/testimonials');
    }

    public function blogs()
    {
        $table = "tbl_blog";
        $id = 'id';
        $data['favicon'] = base_url() . 'assets/images/favicon.png';
        $data['title'] = "Blogs";
        $data['blogs'] = $this->Dashboard_model->fetchalldesc($table, $id);
        $this->load->view('admin/blogs', $data);
    }


    public function blogs_add()
    {
        $data['title'] = "Add Blogs ";
        $data['favicon'] = base_url() . 'assets/images/favicon.png';
        $data['category'] = $this->Dashboard_model->fetchall('tbl_blog_category');
        $this->load->view('admin/blogs_add', $data);
    }

    public function blogsadd()
    {
        $table = 'tbl_blog';
        if (count($_POST) > 0) {
            print_r($_POST);

            $post = $this->input->post();
            $post['image'] = imageUpload('image', 'uploads/blogs/');

            if ($this->Dashboard_model->insertdata($table, $post)) {

                $this->session->set_flashdata('msg', 'Blog Add successfully');
                $this->session->set_flashdata('msg_class', 'alert-success');
            } else {
                $this->session->set_flashdata('msg', 'Soemthing went wrong Please try again!!');
                $this->session->set_flashdata('msg_class', 'alert-danger');
            }

            redirect(base_url('admin_Dashboard/blogs'));
        } else {
            redirect(base_url('admin_Dashboard/blogs'));
        }
    }

    public function editblogs()
    {
        $id = $this->uri->segment(3);
        // echo $id;
        $data['favicon'] = base_url() . 'assets/images/favicon.png';
        $data['title'] = "Edit Blog";
        $data['blog'] = $this->CommonModal->getRowById('tbl_blog', 'id', $id);
        $data['category'] = $this->Dashboard_model->fetchall('tbl_blog_category');
        if (count($_POST) > 0) {
            $post = $this->input->post();
            $temp_image = $post['image'];
            if ($_FILES['img']['name'] != '') {
                $img = imageUpload('img', 'uploads/blogs/');
                $post['image'] = $img;
                if ($temp_image != "") {
                    unlink('uploads/blogs/' . $temp_image);
                }
            }
            $update = $this->CommonModal->updateRowById('tbl_blog', 'id', $id, $post);
            if ($update) {
                $this->session->set_flashdata('msg', 'Blog Update successfully');
                $this->session->set_flashdata('msg_class', 'alert-success');
            }
            redirect(base_url('admin_Dashboard/blogs'));
        } else {
            $this->load->view('admin/edit_blogs', $data);
        }
    }

    public function deleteblogs($id)
    {
        $data['favicon'] = base_url() . 'assets/images/favicon.png';
        $table = "tbl_blog";

        $data = $this->CommonModal->getRowById('tbl_blog', 'id', $id);
        if (file_exists("uploads/blogs/" . $data[0]['image'])) {
            unlink('uploads/blogs/' . $data[0]['image']);
        }

        if ($this->CommonModal->deleteRowById($table, array('id' => $id))) {
            $this->session->set_flashdata('msg', 'Blog Delete successfully');
            $this->session->set_flashdata('msg_class', 'alert-success');
        } else {
            $this->session->set_flashdata('msg', 'Blog not Delete Please try again!!');
            $this->session->set_flashdata('msg_class', 'alert-danger');
        }


        redirect('admin_Dashboard/blogs');
    }

    public function view_category()
    {
        $table = "tbl_category";
        $data['favicon'] = base_url() . 'assets/logo.png';
        $data['title'] = "Video Category";
        $data['category'] = $this->Dashboard_model->fetchall($table);
        $this->load->view('admin/view_category', $data);
    }


    public function add_category()
    {
        $data['title'] = "Add Product Main Category";
        $data['favicon'] = base_url() . 'assets/logo.png';
        $this->load->view('admin/add_category', $data);
    }

    public function addcategory()
    {
        $data['favicon'] = base_url() . 'assets/logo.png';
        if (isset($_POST['submit'])) {

            $cat_name = $this->input->post('cat_name');

            $file_name = imageUpload('image', 'uploads/category/');
            // $no = rand();
            // $folder = base_url() . "uploads/category/";
            // move_uploaded_file($_FILES["image"]["tmp_name"], "$folder" . $no . $_FILES["image"]["name"]);
            // $file_name = $no . $_FILES["image"]["name"];

            $table = "tbl_category";
            $data = array('cat_name' => $cat_name, 'image' => $file_name);

            if ($this->Dashboard_model->insertdata($table, $data)) {

                $this->session->set_flashdata('msg', 'Category Add successfully');
                $this->session->set_flashdata('msg_class', 'alert-success');
            } else {
                $this->session->set_flashdata('msg', 'Soemthing went wrong Please try again!!');
                $this->session->set_flashdata('msg_class', 'alert-danger');
            }

            redirect(base_url('admin_Dashboard/view_category'));
        } else {
            redirect(base_url('admin_Dashboard/add_category'));
        }
    }



    public function edit_category($category_id = true)
    {

        $data['favicon'] = base_url() . 'assets/logo.png';
        $data['title'] = "Edit category";
        $data['categoryInfo'] = $this->Dashboard_model->get_category_Info($category_id);
        $this->load->view('admin/edit_category', $data);
    }

    public function editcategory()
    {
        $table = "tbl_category";
        $data['favicon'] = base_url() . 'assets/logo.png';
        if (isset($_POST['submit'])) {

            $id = $this->input->post('id');
            $cat_name = $this->input->post('cat_name');

            $no = rand();
            if ($_FILES["image"]["name"] == "") {
                $this->db->select("*");
                $this->db->where('category_id', $id);
                $query = $this->db->get($table);
                $result = $query->row();
                $file_name = $result->image;
            } else {
                $uploadfile = $_FILES["image"]["tmp_name"];
                $folder = "uploads/category/";
                move_uploaded_file($_FILES["image"]["tmp_name"], "$folder" . $no . $_FILES["image"]["name"]);
                $file_name = $no . $_FILES["image"]["name"];
            }
            $data = array('cat_name' => $cat_name, 'image' => $file_name);

            $update = $this->CommonModal->updateRowById($table, 'category_id', $id, $data);
            if ($update) {

                $this->session->set_flashdata('msg', 'Category Update successfully');
                $this->session->set_flashdata('msg_class', 'alert-success');
            } else {
                $this->session->set_flashdata('msg', 'Category Update successfully');
                $this->session->set_flashdata('msg_class', 'alert-success');
            }

            redirect(base_url() . 'admin_Dashboard/view_category');
        } else {
            redirect(base_url() . 'admin_Dashboard/edit_category');
        }
    }

    public function deletecategory($id)
    {
        $data['favicon'] = base_url() . 'assets/logo.png';
        $table = "tbl_category";

        $data = $this->CommonModal->getRowById('tbl_category', 'category_id', $id);

        if (file_exists("./uploads/category/' . $data[0]['image']")) {
            unlink('./uploads/category/' . $data[0]['image']);
        }

        if ($this->CommonModal->deleteRowById($table, array('category_id' => $id))) {
            $this->session->set_flashdata('msg', 'Category Delete successfully');
            $this->session->set_flashdata('msg_class', 'alert-success');
        } else {
            $this->session->set_flashdata('msg', 'Category not Delete Please try again!!');
            $this->session->set_flashdata('msg_class', 'alert-danger');
        }


        redirect('admin_Dashboard/view_category');
    }

    public function view_video()
    {
        $data['favicon'] = base_url() . 'assets/logo.png';

        $data['title'] = "Videos";
        $data['video'] = $this->CommonModal->getAllRows('tbl_videos');

        $this->load->view('admin/view_video', $data);
    }

    public function add_video()
    {

        $data['title'] = "Add Video";
        $table = "tbl_category";
        $data['category'] = $this->Dashboard_model->fetchall($table);
        $this->load->view('admin/add_video', $data);
    }

    public function edit_video($product_id = true)
    {

        $data['title'] = "Edit Category";
        $data['productInfo'] = $this->CommonModal->getRowById('tbl_videos', 'product_id', $product_id);
        $data['category'] = $this->Dashboard_model->fetchall('tbl_category');
        if (count($_POST) > 0) {
            $post = $this->input->post();


            $imgtemp = $post['thumbnail'];

            if ($_FILES['thumbnail_temp']['name'] != '') {
                $thumbnail = imageUpload('thumbnail_temp', 'uploads/video/');
                $post['thumbnail'] = $thumbnail;
                if ($imgtemp != "") {
                    unlink('uploads/video/' . $imgtemp);
                }
            }

            $update = $this->CommonModal->updateRowById('tbl_videos', 'product_id', $product_id, $post);
            if ($update) {
                $this->session->set_flashdata('msg', 'Video Update successfully');
                $this->session->set_flashdata('msg_class', 'alert-success');
            }
            redirect(base_url('admin_Dashboard/view_video'));
        }
        $this->load->view('admin/edit_video', $data);
    }


    public function addvideo()
    {
        $table = 'tbl_videos';
        if (count($_POST) > 0) {
            print_r($_POST);

            $post = $this->input->post();
            $post['thumbnail'] = imageUpload('thumbnail', 'uploads/video/');

            if ($this->Dashboard_model->insertdata($table, $post)) {

                $this->session->set_flashdata('msg', 'video Add successfully');
                $this->session->set_flashdata('msg_class', 'alert-success');
            } else {
                $this->session->set_flashdata('msg', 'Soemthing went wrong Please try again!!');
                $this->session->set_flashdata('msg_class', 'alert-danger');
            }

            redirect(base_url('admin_Dashboard/view_video'));
        } else {
            redirect(base_url('admin_Dashboard/view_video'));
        }
    }

    public function online_classes()
    {
        $data['favicon'] = base_url() . 'assets/logo.png';

        $data['title'] = "Online Classes";
        $data['class'] = $this->CommonModal->getAllRows('online_class_videos');

        $this->load->view('admin/online_classes', $data);
    }

    public function add_online_classes()
    {

        $data['title'] = "Add Online Classes";
        $data['category'] = $this->Dashboard_model->fetchall('online_classes_category');

        $table = 'online_class_videos';
        if (count($_POST) > 0) {
            print_r($_POST);

            $post = $this->input->post();
            $post['thumbnail'] = imageUpload('thumbnail', 'uploads/class_video/');

            if ($this->Dashboard_model->insertdata($table, $post)) {

                $this->session->set_flashdata('msg', 'Online class Video Add successfully');
                $this->session->set_flashdata('msg_class', 'alert-success');
            } else {
                $this->session->set_flashdata('msg', 'Soemthing went wrong Please try again!!');
                $this->session->set_flashdata('msg_class', 'alert-danger');
            }

            redirect(base_url('admin_Dashboard/online_classes'));
        } else {
            $this->load->view('admin/add_online_classes', $data);
        }
    }

    public function edit_online_classes($cid = true)
    {

        $data['title'] = "Edit Online Classes";
        $data['productInfo'] = $this->CommonModal->getRowById('online_class_videos', 'cid', $cid);
        $data['category'] = $this->Dashboard_model->fetchall('online_classes_category');
        if (count($_POST) > 0) {
            $post = $this->input->post();


            $imgtemp = $post['thumbnail'];

            if ($_FILES['thumbnail_temp']['name'] != '') {
                $thumbnail = imageUpload('thumbnail_temp', 'uploads/class_video/');
                $post['thumbnail'] = $thumbnail;
                if ($imgtemp != "") {
                    unlink('uploads/class_video/' . $imgtemp);
                }
            }

            $update = $this->CommonModal->updateRowById('online_class_videos', 'cid', $cid, $post);
            if ($update) {
                $this->session->set_flashdata('msg', 'Video Update successfully');
                $this->session->set_flashdata('msg_class', 'alert-success');
            }
            redirect(base_url('admin_Dashboard/online_classes'));
        }
        $this->load->view('admin/edit_online_classes', $data);
    }





    public function deleteonline_classes($id)
    {
        $data['favicon'] = base_url() . 'assets/logo.png';
        $table = "online_class_videos";
        $this->CommonModal->deleteRowById($table, array('cid' => $id));
        redirect('admin_Dashboard/online_classes');
    }



    public function deletevideo($id)
    {
        $data['favicon'] = base_url() . 'assets/logo.png';
        $table = "tbl_videos";
        $this->CommonModal->deleteRowById($table, array('product_id' => $id));
        redirect('admin_Dashboard/view_video');
    }

    public function contact_query()
    {
        $data['favicon'] = base_url() . 'assets/logo.png';
        $data['title'] = "Subscribers";
        $table = "tbl_subscribers";
        $data['subs'] = $this->CommonModal->getAllRows($table);
        $this->load->view('admin/contact', $data);
    }

    public function deletesubscriber($id)
    {
        $data['favicon'] = base_url() . 'assets/logo.png';
        $table = "tbl_subscribers";
        $this->CommonModal->deleteRowById($table, array('sid' => $id));
        redirect('admin_Dashboard/contact_query');
    }

    public function franchise_query()
    {
        $data['favicon'] = base_url() . 'assets/logo.png';
        $data['title'] = "Subscribers";
        $table = "tbl_franchise";
        $data['fran'] = $this->CommonModal->getAllRows($table);
        $this->load->view('admin/franchise', $data);
    }

    public function deletefranchise($id)
    {
        $data['favicon'] = base_url() . 'assets/logo.png';
        $table = "tbl_franchise";
        $this->CommonModal->deleteRowById($table, array('fid' => $id));
        redirect('admin_Dashboard/franchise_query');
    }

    public function gallery()
    {
        $data['favicon'] = base_url() . 'assets/images/favicon.png';
        $data['title'] = "Gallery Add";
        $data['gallery'] = $this->CommonModal->getAllRows('tbl_gallery');
        $this->load->view('admin/gallery', $data);
    }

    public function gallery_add()
    {

        $data['favicon'] = base_url() . 'assets/images/favicon.png';
        $data['title'] = "Gallery Add";
        $data['category'] = $this->CommonModal->getRowBybyOrder('tbl_gallery_category', 'cid', 'ASC');



        if (count($_POST) > 0) {


            $post = $this->input->post();

            $countImg = count($_FILES['img']);
            for ($i = 0; $i <= $countImg; $i++) {
                $no = rand();
                if (!empty($_FILES["img"]["name"][$i])) {
                    $folder = "uploads/gallery/";
                    move_uploaded_file($_FILES["img"]["tmp_name"][$i], "$folder" . $no . $_FILES["img"]["name"][$i]);
                    $post['img'] = $no . $_FILES["img"]["name"][$i];
                    $savedata = $this->CommonModal->insertRowReturnId('tbl_gallery', $post);
                }



                if ($savedata) {
                    $this->session->set_flashdata('msg', 'gallery added Sucessfully');
                    $this->session->set_flashdata('msg_class', 'alert-success');;
                } else {
                    $this->session->set_userdata('msg', 'Something went Wrong. please try again later  ');
                }
            }
            redirect(base_url('admin_Dashboard/gallery'));
        } else {
            $this->load->view('admin/gallery_add', $data);
        }
    }
    public function deletegallery($id)
    {
        $data['favicon'] = base_url() . 'assets/images/favicon.png';
        $table = "tbl_gallery";
        $data = $this->CommonModal->getRowById('tbl_gallery', 'cid', $id);
        // print_r($data[0]['img']);
        if (file_exists("./images/gallery/' . $data[0]['img']")) {
            unlink('images/gallery/' . $data[0]['img']);
        }

        if ($this->CommonModal->deleteRowById($table, array('cid' => $id))) {

            $this->session->set_flashdata('msg', 'gallery Delete successfully');
            $this->session->set_flashdata('msg_class', 'alert-success');
        } else {
            $this->session->set_flashdata('msg', 'gallery not Delete Please try again!!');
            $this->session->set_flashdata('msg_class', 'alert-danger');
        }
        redirect('admin_Dashboard/gallery');
    }
}

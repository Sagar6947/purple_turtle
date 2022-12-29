<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

	public function index()
	{

		$table = "tbl_blog";
		$id = 'id';
		$data['favicon'] = base_url() . 'assets/img/favicon.webp';
		$limit = '3';
		$data['gallery'] = $this->CommonModal->getAllRowsWithLimit('tbl_gallery', '8', 'cid');
		$data['cat'] = $this->CommonModal->getAllRows('tbl_gallery_category');
		$data['blogs'] = $this->CommonModal->getRowByIdWithLimit($table, 'category_id', '44', $limit);
		$data['news'] = $this->CommonModal->getRowByIdWithLimit($table, 'category_id', '50', $limit);
		$data['event'] = $this->CommonModal->getRowByIdWithLimit($table, 'category_id', '51', $limit);


		$this->load->view('home', $data);
	}

	public function blog_view()
	{

		// $data['blogs'] = $this->CommonModal->getAllRows('tbl_blog');
		$data['blogs'] = $this->CommonModal->getRowById('tbl_blog', 'category_id', '44');

		$this->load->view('blog_view', $data);
	}

	public function news_view()
	{

		// $data['blogs'] = $this->CommonModal->getAllRows('tbl_blog');
		$data['news'] = $this->CommonModal->getRowById('tbl_blog', 'category_id', '50');

		$this->load->view('news_view', $data);
	}

	public function event_view()
	{

		// $data['blogs'] = $this->CommonModal->getAllRows('tbl_blog');
		$data['event'] = $this->CommonModal->getRowById('tbl_blog', 'category_id', '51');

		$this->load->view('event_view', $data);
	}


	public function franchise()
	{
		$data['title'] = 'Franchise | Purple Turtle';
		$data['state_list'] = $this->CommonModal->getAllRows('tbl_state');

		if (count($_POST) > 0) {
			$post = $this->input->post();
			$insert = $this->CommonModal->insertRowReturnId('tbl_franchise', $post);
			if ($insert) {
				$this->session->set_userdata('msg', '<div class="alert alert-success">Your query is successfully submit. We will contact you as soon as possible.</div>');
			} else {
				$this->session->set_userdata('msg', '<div class="alert alert-danger">We are facing technical error ,please try again later or get in touch with Email ID provided in contact section.</div>');
			}
		} else {
		}
		$this->load->view('franchise', $data);
	}


	public function getcity()
	{
		$state = $this->input->post('state');


		$data['city'] = $this->CommonModal->getRowByIdInOrder('tbl_cities', array('state_id' => $state), 'name', 'asc');
		$this->load->view('dropdown', $data);
	}


	public function blog()
	{
		$id = $this->uri->segment(2);
		$data['title'] = 'Blogs | Purple Turtle';
		$table = "tbl_blog";

		$where = array('id' => $id);
		$data['favicon'] = base_url() . 'assets/images/favicon.png';
		$data['details'] = $this->CommonModal->getRowByMoreId($table, $where);
		// $data['bloglist'] = $this->CommonModal->getAllRows($table);
		// $data['bloglist'] = $this->CommonModal->getRowByIdWithLimit('tbl_blog', 'category_id', '44', '1');
		$data['bloglist'] = $this->CommonModal->getRowById('tbl_blog', 'category_id', '44');

		$this->load->view('blog', $data);
	}


	public function news()
	{
		$id = $this->uri->segment(2);
		$data['title'] = 'News | Purple Turtle';
		$table = "tbl_blog";

		$where = array('id' => $id);
		$data['favicon'] = base_url() . 'assets/images/favicon.png';
		$data['details'] = $this->CommonModal->getRowByMoreId($table, $where);
		// $data['bloglist'] = $this->CommonModal->getAllRows($table);
		// $data['bloglist'] = $this->CommonModal->getRowByIdWithLimit('tbl_blog', 'category_id', '44', '1');
		$data['newslist'] = $this->CommonModal->getRowById('tbl_blog', 'category_id', '50');

		$this->load->view('news', $data);
	}

	public function event()
	{
		$id = $this->uri->segment(2);
		$data['title'] = 'Event | Purple Turtle';
		$table = "tbl_blog";

		$where = array('id' => $id);
		$data['favicon'] = base_url() . 'assets/images/favicon.png';
		$data['details'] = $this->CommonModal->getRowByMoreId($table, $where);
		// $data['bloglist'] = $this->CommonModal->getAllRows($table);
		// $data['bloglist'] = $this->CommonModal->getRowByIdWithLimit('tbl_blog', 'category_id', '44', '1');
		$data['eventlist'] = $this->CommonModal->getRowById('tbl_blog', 'category_id', '51');

		$this->load->view('event', $data);
	}

	public function about()
	{
		$data['title'] = 'About | Purple Turtle';
		$this->load->view('about', $data);
	}


	public function foundation()
	{
		$data['title'] = 'Foundation | Purple Turtle';
		if (count($_POST) > 0) {
			$post = $this->input->post();
			$insert = $this->CommonModal->insertRowReturnId('tbl_subscribers', $post);
			if ($insert) {
				$this->session->set_userdata('msg', '<div class="alert alert-success">Your query is successfully submit. We will contact you as soon as possible.</div>');
			} else {
				$this->session->set_userdata('msg', '<div class="alert alert-danger">We are facing technical error ,please try again later or get in touch with Email ID provided in contact section.</div>');
			}
		} else {
		}


		$this->load->view('foundation', $data);
	}

	public function faqs()
	{
		$data['title'] = 'FAQ | Purple Turtle';
		$data['faq_title'] = $this->CommonModal->getAllRowsInOrder('faq_cat', 'fid', 'asc');
		$this->load->view('faqs', $data);
	}

	public function gallery()
	{
		$data['title'] = 'GALLERY | Purple Turtle';
		$id = 'cid';
		// 		$data['gallery'] = $this->CommonModal->getAllRowsWithLimit('tbl_gallery', '20', $id);
		$data['gallery'] = $this->CommonModal->getAllRowsInOrder('tbl_gallery', 'cid', 'asc');
		// 		$data['gallery'] = $this->CommonModal->getAllRows('tbl_gallery');
		$data['cat'] = $this->CommonModal->getAllRows('tbl_gallery_category');
		$this->load->view('gallery', $data);
	}

	public function animated_videos()
	{
		$data['title'] = 'Animated Videos | Purple Turtle';

		$data['cate'] = $this->CommonModal->getAllRows('tbl_category');
		$data['class_cate'] = $this->CommonModal->getAllRows('online_classes_category');
		$this->load->view('animated-videos', $data);
	}

	public function all_videos()
	{
		$id = $this->uri->segment(3);
		$data['title'] = 'All Videos | Purple Turtle';
		$table = "tbl_videos";
		$where = array('category_id' => $id);
		$data['favicon'] = base_url() . 'assets/images/favicon.png';
		$data['all_vid'] = $this->CommonModal->getRowByMoreId($table, $where);



		$this->load->view('all_videos', $data);
	}

	public function all_classes()
	{
		$lid = $this->uri->segment(4);
		$cid = $this->uri->segment(3);
		$data['title'] = 'All online classes Video | Purple Turtle';
		$table = "online_class_videos";
		$where = array('category_id' => $cid, 'level_id' => $lid);
		$data['favicon'] = base_url() . 'assets/images/favicon.png';
		$data['all_vid'] = $this->CommonModal->getRowByMoreId($table, $where);



		$this->load->view('online-series', $data);
	}

	public function grievance()
	{
		$id = $this->uri->segment(3);
		$data['title'] = 'Grievance | Purple Turtle';
		$this->load->view('grievance', $data);
	}
 
}

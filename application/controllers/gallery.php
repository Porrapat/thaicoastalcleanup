<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class gallery extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->isBackend = true;
		$this->load->helper("url");
		$this->load->library('form_validation');
		
	}

	public function index() {

		$this->load->library("pagination");
		$config = array();
        $config['full_tag_open'] = "<ul class='pagination'>";
		$config['full_tag_close'] ="</ul>";
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
		$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
		$config['next_tag_open'] = "<li>";
		$config['next_tagl_close'] = "</li>";
		$config['prev_tag_open'] = "<li>";
		$config['prev_tagl_close'] = "</li>";
		$config['first_tag_open'] = "<li>";
		$config['first_tagl_close'] = "</li>";
		$config['last_tag_open'] = "<li>";
		$config['last_tagl_close'] = "</li>";
		$config["base_url"] = base_url('gallery/index');
		$config["per_page"] = 15;
		$config["total_rows"] = $this->db->count_all('icc_card');
		$this->pagination->initialize($config);


		$data['rs']=$this->db->select('*')->from('icc_card')->limit($config["per_page"], $this->uri->segment(3))->get()->result_array();
    	//$sql="select * from icc_card";
        //$rs=$this->db->query($sql);

       

        $this->data = $data;

		$this->body = 'admin/gallery/index';
		$this->renderWithTemplate();	
	}



	}
<?php

class slideshow extends MY_Controller {
    public function __construct() {
		parent::__construct();
	}

    public function index() {

    	$sql="select * from slideshow";
        $rs=$this->db->query($sql);

       if($rs->num_rows() == 0){

       	 $data['rs'] = array();

       }else{

       	$data['rs'] =$rs->result_array();

       }

        $this->data = $data;

		$this->body = 'admin/slideshow/index';
		$this->renderWithTemplate3();	
	}


	public function create() {

		$data = array();
        $userData = array();

        if($this->input->post('slideSubmit') != null){

    	$config['upload_path'] = './assets/admin/slide/';
	    $config['allowed_types'] = 'gif|jpg|png';
	    $config['max_size'] = '1000000';
	    $this->load->library('upload', $config);

        $this->upload->do_upload('file_name');

        $imageDetailArray = $this->upload->data();
        $image =  $imageDetailArray['file_name'];

        $userData = array(
                'name' => $this->input->post('name'),
                'title' => $this->input->post('first_text'),
                'image' => strip_tags($image),
                'url_web' => $this->input->post('url_web'),
                'sub_title' => $this->input->post('secend_text')
        );

        $this->db->insert("slideshow",$userData);

        $this->session->set_flashdata('success_slide', 'This is my message');
		redirect('slideshow'); 

        }


        
        

		$this->body = 'admin/slideshow/create';
		$this->renderWithTemplate3();

	}

	public function edit($id){

		$id = $this->uri->segment(3);
        
        if (empty($id))
        {
            show_404();
        }



        if($this->input->post('slideSubmit') != null){

        	if(!empty($_FILES['file_name']['name'])){

        		$config['upload_path'] = './assets/admin/slide/';
			    $config['allowed_types'] = 'gif|jpg|png';
			    $config['max_size'] = '1000000';
			    $this->load->library('upload', $config);
			    $this->upload->do_upload('file_name');

			    $imageDetailArray = $this->upload->data();
		        $image =  $imageDetailArray['file_name'];

		        $userData = array(
                'name' => $this->input->post('name'),
                'title' => $this->input->post('first_text'),
                'image' => strip_tags($image),
                'url_web' => $this->input->post('url_web'),
                'sub_title' => $this->input->post('secend_text')
        );

		    $img="select * from slideshow where id='$id'";
        	$imgs=$this->db->query($img);
        	$img =$imgs->row_array();

        	unlink("./assets/admin/slide/".$img['image']);


        	}else{

        		$userData = array(
                'name' => $this->input->post('name'),
                'title' => $this->input->post('first_text'),
                'url_web' => $this->input->post('url_web'),
                'sub_title' => $this->input->post('secend_text')
        );

        	}


        	$this->db->where("id",$id);
        	$this->db->update("slideshow",$userData);
        	$this->session->set_flashdata('success_slideshow_edit', 'This is my message');


        }

		$sql="select * from slideshow where id='$id'";
        $rs=$this->db->query($sql);

       if($rs->num_rows() == 0){

       	 $data['RS'] = array();

       }else{

       	$data['rs'] =$rs->row_array();

       }
      	

   		$data["id"] = $id;
        $this->data = $data;

		$this->body = 'admin/slideshow/edit';
		$this->renderWithTemplate3();



	}


	public function del($id){

		$property_id = $id;



            $blog="select * from slideshow where id='$property_id'";
            $rs_blog=$this->db->query($blog);
            $rs_blogs = $rs_blog->row_array();
            unlink("./assets/admin/slide/".$rs_blogs['image']);
            $this->db->delete('slideshow', array('id' => $rs_blogs['id']));
        


        $this->session->set_flashdata('success_slide_del', 'This is my message');
        redirect('slideshow/'); 

	}





}
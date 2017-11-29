<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class blog extends MY_Controller {
        function __construct() {
		parent::__construct();
		$this->load->model('selectblog');  
		$this->load->helper("url");
		$this->load->library("pagination");
		$this->load->library('form_validation');
		
	}

    public function create() {

    	$data = array();
        $userData = array();

    	
    	$data['obj'] = $this->selectblog->select_cat(); 

    	$config['upload_path'] = './assets/admin/blog/';
	    $config['allowed_types'] = 'gif|jpg|png';
	    $config['max_size'] = '1000000';
	    $this->load->library('upload', $config);

	    $this->form_validation->set_rules('Title_a', 'หัวข้อเรื่อง', 'required');
        $this->form_validation->set_rules('blog_type', 'เลือกประเภท บทความ', 'required');
        $this->form_validation->set_rules('detail', 'เนื้อหา', 'required');
        $this->upload->do_upload('file_name');

        $imageDetailArray = $this->upload->data();
        $image =  $imageDetailArray['file_name'];

        $userData = array(
                'Title_a' => strip_tags($this->input->post('Title_a')),
                'Content' => strip_tags($this->input->post('detail')),
                'Thumbnail_Url' => strip_tags($image),
                'tag' => strip_tags($this->input->post('tag')),
                'edate' => strip_tags($this->input->post('edate')),
                'FK_Article_Category' => strip_tags($this->input->post('blog_type'))
            );

            $data['user'] = $userData;
         
	   

	    if ( ! $this->upload->do_upload('file_name'))
	    {
	        // no file uploaded or failed upload
	        $error = array('error' => $this->upload->display_errors());
	        $data['error'] = 'มีบางอย่างผิดพลาด.';
			
	    }
	    else
	    {
	    	

	    	

            if($this->form_validation->run() == true){
                $insert = $this->selectblog->add($userData);
                if($insert){






        
        $data = array();
        if(!empty($_FILES['userFiles']['name'])){
            $filesCount = count($_FILES['userFiles']['name']);
            for($i = 0; $i < $filesCount; $i++){
                $_FILES['userFile']['name'] = $_FILES['userFiles']['name'][$i];
                $_FILES['userFile']['type'] = $_FILES['userFiles']['type'][$i];
                $_FILES['userFile']['tmp_name'] = $_FILES['userFiles']['tmp_name'][$i];
                $_FILES['userFile']['error'] = $_FILES['userFiles']['error'][$i];
                $_FILES['userFile']['size'] = $_FILES['userFiles']['size'][$i];

                $uploadPath = './assets/admin/blog/';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'gif|jpg|png';
                
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('userFile')){
                    $fileData = $this->upload->data();
                    $uploadData[$i]['blog_id'] = $insert;
                    $uploadData[$i]['file_name'] = $fileData['file_name'];
                    $uploadData[$i]['created'] = date("Y-m-d H:i:s");
                    $uploadData[$i]['modified'] = date("Y-m-d H:i:s");
                }
            }
            
                if(!empty($uploadData)){
                    $this->selectblog->insert($uploadData);
                }
                //Insert file information into the database
                
     
    
        }


        

        		
        			$this->session->set_flashdata('success_blog', 'This is my message');
                    $this->data = $data;
					redirect('blog/', $data);



                }else{
                    $data['error_msg'] = 'มีบางอย่างผิดพลาด.';
                }
            }

	    }
	


	   	$data['user'] = $userData;
	    
	    $this->data = $data;
		$this->body = 'admin/blog/create';
		$this->renderWithTemplate3();
	}


	public function index() {
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
        $config["base_url"] = base_url('blog/index');
        $config["total_rows"] = $this->selectblog->record_count();
        $config["per_page"] = 15;
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
   		$config["num_links"] = round($choice);

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["obj"] = $this->selectblog->fetch_blog($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();

   
        $this->data = $data;
		$this->body = 'admin/blog/index';
		$this->renderWithTemplate3();
    }

        public function posting($source=null) {

        	$this->output->set_header('Content-Type: application/json; charset=utf-8');
       
            //set preferences
            //file upload destination
            $upload_path = './assets/admin/blog/';
            $config['upload_path'] = $upload_path;
            //allowed file types. * means all types
            $config['allowed_types'] = 'jpg|png|gif';
            //allowed max file size. 0 means unlimited file size
            $config['max_size'] = '0';
            //max file name size
            $config['max_filename'] = '255';
            //whether file name should be encrypted or not
            $config['encrypt_name'] = TRUE;
            
            //store image info once uploaded
            $image_data = array();
            //check for errors
            $is_file_error = FALSE;
            //check if file was selected for upload
            if (!$_FILES) {
                $is_file_error = TRUE;
                $this->handle_error('Select an image file.');
            }
            //if file was selected then proceed to upload
            if (!$is_file_error) {
                //load the preferences
                $this->load->library('upload', $config);
                //check file successfully uploaded. 'image_name' is the name of the input
                if (!$this->upload->do_upload('files')) {
                    //if file upload failed then catch the errors
                    $this->handle_error($this->upload->display_errors());
                    $is_file_error = TRUE;
                } else {
                    //store the file info
                    $image_data = $this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = $image_data['full_path']; //get original image
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 750;
                   // $config['height'] = 100;
                    $this->load->library('image_lib', $config);
                    if (!$this->image_lib->resize()) {
                        $this->handle_error($this->image_lib->display_errors());
                    }
                }
            }
            // There were errors, we have to delete the uploaded image
            if ($is_file_error) {
                if ($image_data) {
                    $file = $upload_path . $image_data['file_name'];
                    if (file_exists($file)) {
                        unlink($file);
                    }
                }
            } else {
                $arr = array('success' => 200,
		            'filename' => $image_data['file_name']
		        );
			    echo json_encode( $arr );
            }
        
    }








    public function edit($id)
    {
        $id = $this->uri->segment(3);
        
        if (empty($id))
        {
            show_404();
        }

        if($this->input->post('regisSubmit') != null){

        	if(!empty($_FILES['file_name']['name'])){

        		$config['upload_path'] = './assets/admin/blog/';
			    $config['allowed_types'] = 'gif|jpg|png';
			    $config['max_size'] = '1000000';
			    $this->load->library('upload', $config);
			    $this->upload->do_upload('file_name');

			    $imageDetailArray = $this->upload->data();
		        $image =  $imageDetailArray['file_name'];

		        $userData = array(
		                'Title_a' => strip_tags($this->input->post('Title_a')),
		                'Content' => $this->input->post('detail'),
		                'Thumbnail_Url' => strip_tags($image),
                        'tag' => strip_tags($this->input->post('tag')),
                        'edate' => strip_tags($this->input->post('edate')),
		                'FK_Article_Category' => strip_tags($this->input->post('blog_type'))
		        );


        	}else{

        		$userData = array(
                'Title_a' => strip_tags($this->input->post('Title_a')),
                'Content' => $this->input->post('detail'),
                'tag' => strip_tags($this->input->post('tag')),
                'edate' => strip_tags($this->input->post('edate')),
                'FK_Article_Category' => strip_tags($this->input->post('blog_type'))
            	);

        	}


        	if(!empty($_FILES['userFiles']['name'])){
            $filesCount = count($_FILES['userFiles']['name']);
            for($i = 0; $i < $filesCount; $i++){
                $_FILES['userFile']['name'] = $_FILES['userFiles']['name'][$i];
                $_FILES['userFile']['type'] = $_FILES['userFiles']['type'][$i];
                $_FILES['userFile']['tmp_name'] = $_FILES['userFiles']['tmp_name'][$i];
                $_FILES['userFile']['error'] = $_FILES['userFiles']['error'][$i];
                $_FILES['userFile']['size'] = $_FILES['userFiles']['size'][$i];

                $uploadPath = './assets/admin/blog/';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'gif|jpg|png';
                
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('userFile')){
                    $fileData = $this->upload->data();
                    $uploadData[$i]['blog_id'] = $id;
                    $uploadData[$i]['file_name'] = $fileData['file_name'];
                    $uploadData[$i]['created'] = date("Y-m-d H:i:s");
                    $uploadData[$i]['modified'] = date("Y-m-d H:i:s");
                }
            }
            if(!empty($uploadData)){
                $this->selectblog->insert($uploadData);
            }
        }




        

        	$this->db->where("id",$id);
        	$this->db->update("article",$userData);
        	$this->session->set_flashdata('success_blog_edit', 'This is my message');


        }


        
        $sql="select * from article where id='$id'";
        $rs=$this->db->query($sql);

        $img="select * from files_blog where blog_id='$id'";
        $imgs=$this->db->query($img);

       if($rs->num_rows() == 0){

       	 $data['RS'] = array();

       }else{

       	$data['rs'] =$rs->row_array();
       	$data['img'] =$imgs->result_array();

       }
       $data['obj'] = $this->selectblog->select_cat(); 
       //$data['img'] = $this->selectblog->select_img($id); 
      	

   		$data["id"] = $id;
        $this->data = $data;
		$this->body = 'admin/blog/edit';
		$this->renderWithTemplate3();

    }



    public function del($id)
    {

        $property_id = $id;
        
       

            $img="select * from files_blog where blog_id='$property_id'";
            $imgs=$this->db->query($img);
            $rs =$imgs->result_array();

            if(count($rs) != 0){
                foreach($rs as $row) {
          
            unlink("./assets/admin/blog/".$row['file_name']);
            $this->db->delete('files_blog', array('id' => $row['id']));

                }
            }


            $blog="select * from article where id='$property_id'";
            $rs_blog=$this->db->query($blog);
            $rs_blogs = $rs_blog->row_array();
            unlink("./assets/admin/blog/".$rs_blogs['Thumbnail_Url']);
            $this->db->delete('article', array('id' => $rs_blogs['id']));
        


        $this->session->set_flashdata('success_blog_del', 'This is my message');
        redirect('blog/'); 
    }




    public function del_img()
    {
    	if($this->input->post('delimage') != null){
    	$id_img = $this->input->post('product_image');
    	$property_id = $this->input->post('property_id');
    	
    	$ImgsCount = count($id_img);

    	for($i = 0; $i < $ImgsCount; $i++){

    		$img="select * from files_blog where id='$id_img[$i]'";
        	$imgs=$this->db->query($img);
        	$img =$imgs->row_array();

        	unlink("./assets/admin/blog/".$img['file_name']);

    		$this->db->delete('files_blog', array('id' => $id_img[$i]));

    	}

    	}


    	$this->session->set_flashdata('success_blog_del_img', 'This is my message');
		redirect('blog/edit/'.$property_id); 
    }








}
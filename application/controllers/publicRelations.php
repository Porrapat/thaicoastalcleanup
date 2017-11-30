<?php
class PublicRelations extends MY_Controller {
// Property.
	private $dataTypeName = [1 => "ข่าวสารโครงการ"];
	private $inputModeName = [1 => 'เพิ่มข้อมูล', 2 => 'แก้ไข'];
	private $paginationLimit = 20;

	private $articleTypeId = 1;
	private $articleCategoryId = 0;

// End Property.


// Constructor.
    public function __construct() {
        parent::__construct();
        $this->load->helper("url");
    }
// End Constructor.




// Method start.
    public function index() {
		$this->articleCategory();
	}

	public function content($id) {


		$sql="select * from article where id = '$id'";
        $rs=$this->db->query($sql);
       if($rs->num_rows() == 0){
       	 $data['article'] = array();
       }else{

       	$data['article'] =$rs->row_array();
       	$view =$rs->row_array();
       }

       $sql_view="select * from article where edate <= now() ORDER BY view DESC LIMIT 0,6";
        $rs_view=$this->db->query($sql_view);
       if($rs_view->num_rows() == 0){
       	 $data['rs_view'] = array();
       }else{
       	$data['rs_view'] =$rs_view->result_array();
       }

       $totol_view = $view['view']+1;
       $userData = array(
                'view' => $totol_view
        );
       $this->db->where("id",$id);
       $this->db->update("article",$userData);

   		$this->data = $data;
		$this->body = 'frontend/publicRelations/full/body_v';
		$this->renderWithTemplate();	
	}

	public function content_list(){
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
		$config["base_url"] = base_url('publicRelations/content_list');
		$config["per_page"] = 15;
		$config["total_rows"] = $this->db->count_all('article');
		$this->pagination->initialize($config);


		//$data['rs']=$this->db->select('*')->from('article')->where('edate' <= date())->limit($config["per_page"], $this->uri->segment(3))->get()->result_array();

		$set_end=$this->uri->segment(3);
		if($set_end == null){
			$set_end = 0;
		}
    	$sql="select * from article where edate <= now() LIMIT $set_end, $config[per_page]";
        $rs=$this->db->query($sql);
        $data['rs'] =$rs->result_array();

        $sql_view="select * from article where edate <= now() ORDER BY view DESC LIMIT 0,6";
        $rs_view=$this->db->query($sql_view);
       if($rs_view->num_rows() == 0){
       	 $data['rs_view'] = array();
       }else{
       	$data['rs_view'] =$rs_view->result_array();
       }

       

        $this->data = $data;

		$this->body = 'frontend/publicRelations/list/body_v';
		$this->renderWithTemplate();
	}


// End Method start.



// Public function.
    // ------------------------------------- For display list view article -----------------------------
	public function articleCategory() {
		$this->articleTypeId = ( ($this->uri->segment(3) == '') ? $this->articleTypeId : $this->uri->segment(3) );
		$this->articleCategoryId = ( ($this->uri->segment(4) == '') ? $this->articleCategoryId : $this->uri->segment(4) );
		// Prepare data of list.
		$this->data = $this->GetDataForRenderListArticle($this->articleTypeId, $this->articleCategoryId);
		$this->data['articleTypeId'] = $this->articleTypeId;
		$this->data['articleCategoryId'] = $this->articleCategoryId;
		// Caption.
		$this->data['dataTypeName'] = $this->dataTypeName[$this->articleTypeId];
		
		// Prepare Template.
		$this->extendedCss = 'frontend/publicRelations/list/extendedCss_v';
		//$this->body = 'frontend/publicRelations/list/body_v';
		$this->extendedJs = 'frontend/publicRelations/list/extendedJs_v';
		$this->renderWithTemplate();
	}

	public function fullContent() {
	/*	$this->articleTypeId = ( ($this->uri->segment(3) == '') ? $this->articleTypeId : $this->uri->segment(3) );
		$articleId = $this->uri->segment(4);
		// Prepare data of list.
		$this->data = $this->GetDataForRenderFullArticle($articleId);
		$this->data['articleTypeId'] = $this->articleTypeId;
		$this->data["dsArticleList"] = $this->GetDataForRenderListArticle($this->articleTypeId, $this->articleCategoryId);
		// Breadcrumb.
		$this->lastBreadcrumbCaption = "เนื้อหา";
		// Caption.
		$this->data['dataTypeName'] = $this->dataTypeName[$this->articleTypeId];
		
		// Prepare Template.
		$this->extendedCss = 'frontend/publicRelations/full/extendedCss_v';
		$this->body = 'frontend/publicRelations/full/body_v';
		$this->extendedJs = 'frontend/publicRelations/full/extendedJs_v';
		$this->renderWithTemplate(); */
	}
// End Public function.


// AJAX function.
// End AJAX function.


// Private function.
    // ---------------------------------------- For display list article -------------------------------
	private function GetDataForRenderListArticle($articleTypeId=1, $articleCategoryId=null) {
		$this->load->model('article_m');
		$result['dsArticle'] = $this->article_m->GetArticle($articleTypeId, $articleCategoryId, null, $this->paginationLimit);

		
		// Get DataSet to combobox.
		$dsComboBox = $this->article_m->GetDataForComboBox($articleTypeId);
		if($dsComboBox != null) {
			foreach($dsComboBox as $key => $value) {
				$result[$key] = $value;
			}
		}

		return $result;
	}


    // ---------------------------------------- For display full article -------------------------------
	private function GetDataForRenderFullArticle($articleId=1) {
		$this->load->model('article_m');
		$result = $this->article_m->GetArticle(null, null, $articleId, 1);
		$data["article"] = ( (count($result) > 0) ? $result[0] : null );

		return $data;
	}
// End Private function.
}
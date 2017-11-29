<?php  
   class selectblog extends CI_Model  
   {  
      function __construct()  
      {  
         // Call the Model constructor  
         parent::__construct();  
         $this->userTbl = 'article';
      }  
      //we will use the select function  
      public function select_blog()  
      {  
         //data is retrive from this query  
         $this->db->select(
            'article.*'
         );
         $this->db->select(
            "article.id as id_b"
         );
         $this->db->from('article');
         $this->db->join('article_category', 'article_category.id = article.FK_Article_Category', 'left');
         $query = $this->db->get();

        // $query = $this->db->get('country');  
         return $query;  
      }  

      public function select_cat()  
      {  

         $query = $this->db->query("SELECT * FROM article_category")->result();

        // $query = $this->db->get('country');  
         return $query;  
      }


      public function select_img($id)  
      {  

        
         $this->db->select(
            'files_blog.*'
         );
         $this->db->from('files_blog');
         $this->db->where('files_blog.blog_id' , $id);
         $query = $this->db->get();
        // $query = $this->db->get('country');  
         return $query;  
      }

      public function record_count() {
        return $this->db->count_all("article");
      }

      public function add($data = array()){

         //add created and modified data if not included
        if(!array_key_exists("Create_Date", $data)){
            $data['Create_Date'] = date("Y-m-d H:i:s");
        }
        if(!array_key_exists("Update_Date", $data)){
            $data['Update_Date'] = date("Y-m-d H:i:s");
        }
        
        //insert user data to users table
        //print_r($data);

        $insert = $this->db->insert($this->userTbl, $data);
        
        //return the status
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }

      }


      public function fetch_blog($limit, $start) {
        $this->db->limit($limit, $start);
        $this->db->select('*');
        $this->db->select(
            "article.id as id_b"
         );
        $this->db->from('article');
        $this->db->join('article_category', 'article_category.id = article.FK_Article_Category', 'left');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }

   public function insert($data){
        $insert = $this->db->insert_batch('files_blog',$data);
        return $insert?true:false;
    }





    public function get_blog_by_id($id = 0)
    {
        $this->db->select(
            'article.*'
         );
         $this->db->select(
            "article.id as id_b"
         );
         $this->db->from('article');
         $this->db->join('article_category', 'article_category.id = article.FK_Article_Category', 'left');
         $this->db->where('article.id' , $id);
         $query = $this->db->get();

        // $query = $this->db->get('country');  
 
      
        return $query->row_array();
    }





   }  
?>  
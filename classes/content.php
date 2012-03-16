<?php 
class content  {
	
		var $content_id;
		var $category_id;
		var $category_name;
		var $content_title;
		var $content_brief;
		var $content_details;
		var $content_thumb;
		var $content_image;
		
		//set
		
		function set_content_id($content_id){
			$this->content_id = $content_id;
			return true;
		}
		function set_category_id($category_id){
			$this->category_id = $category_id;
			return true;
		}
		function set_category_name($category_name){
			$this->category_id = $category_name;
			return true;
		}
		function set_content_title($content_title){
			$this->content_title = $content_title;
			return true;
		}
		function set_content_brief($content_brief){
			$this->content_brief = $content_brief;
			return true;
		}
		function set_content_details($content_details){
			$this->content_details = $content_details;
			return true;
		}
		function set_content_thumb($content_thumb){
			$this->content_thumb = $content_thumb;
			return true;
		}
		function set_content_image($content_image){
			$this->content_image = $content_image;
			return true;
		}
		//get
		function get_content_id(){
			return $this->content_id;
		}
		function get_category_id(){
			return $this->category_id;
		}
		function get_category_name(){
			return $this->category_name;
		}
		function get_content_title(){
			return $this->content_title;
		}
		function get_content_brief(){
			return $this->content_brief;
		}
		function get_content_details(){
			return $this->content_details;
		}
		function get_content_thumb(){
			return $this->content_thumb;
		}
		function get_content_image(){
			return $this->content_image;
		}


		function get_category_by_id($category_id) {
			$category_query=mysql_query("SELECT * FROM site_category WHERE category_id='".VerifyInt($category_id)."'")or die(mysql_error());
			$category_row=mysql_fetch_array($category_query);
			return $category_row['category_name'];

		}
		
		function get_category_by_id2($category_id) {
			$category_query=mysql_query("SELECT * FROM site_category WHERE category_id='".VerifyInt($category_id)."'")or die(mysql_error());
			$category_row=mysql_fetch_array($category_query);
			if($category_row['category_image'])
			{
				return $category_row['category_image'];
				exit();
			}
			return "categories/image_about.jpg";

		}
		
		
		function get_content_by_id($content_id) {
			$content_query=mysql_query("SELECT site_content.*,category_name FROM site_content "
			." LEFT JOIN site_category ON(site_category.category_id=site_content.category_id) "
			." WHERE content_id='".VerifyInt($content_id)."'")or die(mysql_error());
			$content_row=mysql_fetch_array($content_query);

			$this-> content_id		=$content_row['content_id'];
			$this-> category_id     =$content_row['category_id'];
			$this-> category_name   =Output($content_row['category_name']);
			$this-> content_title	=Output($content_row['content_title']);
			$this-> content_brief	=Output($content_row['content_brief']);
			$this-> content_details	=Output($content_row['content_details']);
			$this-> content_thumb	=$content_row['content_thumb'];
			$this-> content_image	=$content_row['content_image'];
		}
		function search_content($key) {
			$content_query=mysql_query("SELECT content_id,category_id,content_title FROM site_content "
			." WHERE content_title LIKE '%".VerifyInput($key)."%' OR content_brief LIKE '%".VerifyInput($key)."%' "
			." OR content_details LIKE '%".VerifyInput($key)."%'")or die(mysql_error());
			
			while($content_row=mysql_fetch_array($content_query)){
				$result.="<a href=content_details.php?content_category_id=".$content_row['category_id']."&content_id=".$content_row['content_id'].">".Output($content_row['content_title'])."</a><br>";
				
			}
			return $result;

		}
	
	}


?>
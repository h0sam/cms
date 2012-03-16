<?php 
class job  {
	
		var $job_id;
		var $category_id;
		var $category_name;
		var $job_title;
		var $job_location;
		var $job_responsibilities;
		var $job_requirement;
		var $job_deadline;
		var $job_num_vacancies;
		
		//set
		
		function set_job_id($job_id){
			$this->job_id = $job_id;
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
		function set_job_title($job_title){
			$this->job_title = $job_title;
			return true;
		}
		function set_job_location($job_location){
			$this->job_location = $job_location;
			return true;
		}
		function set_job_responsibilities($job_responsibilities){
			$this->job_responsibilities = $job_responsibilities;
			return true;
		}
		function set_job_requirement($job_requirement){
			$this->job_requirement = $job_requirement;
			return true;
		}
		function set_job_deadline($job_deadline){
			$this->job_deadline = $job_deadline;
			return true;
		}
		function set_job_num_vacancies($job_num_vacancies){
			$this->job_num_vacancies = $job_num_vacancies;
			return true;
		}
		//get
		function get_job_id(){
			return $this->job_id;
		}
		function get_category_id(){
			return $this->category_id;
		}
		function get_category_name(){
			return $this->category_name;
		}
		function get_job_title(){
			return $this->job_title;
		}
		function get_job_location(){
			return $this->job_location;
		}
		function get_job_responsibilities(){
			return $this->job_responsibilities;
		}
		function get_job_requirement(){
			return $this->job_requirement;
		}
		function get_job_deadline(){
			return $this->job_deadline;
		}
		function get_job_num_vacancies(){
			return $this->job_num_vacancies;
		}


		function get_category_by_id($category_id) {
			$category_query=mysql_query("SELECT * FROM job_category WHERE category_id='".VerifyInt($category_id)."'")or die(mysql_error());
			$category_row=mysql_fetch_array($category_query);
			return $category_row['category_name'];

		}
		function get_job_by_id($job_id) {
			$job_query=mysql_query("SELECT job.*,category_name FROM job "
			." LEFT JOIN job_category ON(job_category.category_id=job.category_id) "
			." WHERE job_id='".VerifyInt($job_id)."' AND job.active=1")or die(mysql_error());
			$job_row=mysql_fetch_array($job_query);

			$this-> job_id					=$job_row['job_id'];
			$this-> category_id    			=$job_row['category_id'];
			$this-> category_name   		=Output($job_row['category_name']);
			$this-> job_title				=Output($job_row['job_title']);
			$this-> job_location			=Output($job_row['job_location']);
			$this-> job_responsibilities	=Output($job_row['job_responsibilities']);
			$this-> job_requirement			=Output($job_row['job_requirement']);
			$this-> job_deadline			=Output($job_row['job_deadline']);
			$this-> job_num_vacancies		=Output($job_row['job_num_vacancies']);
		}
		function search_job($key) {
			$job_query=mysql_query("SELECT job_id,category_id,job_title FROM job "
			." WHERE job_title LIKE '%".VerifyInput($key)."%' OR job_location LIKE '%".VerifyInput($key)."%' "
			." OR job_responsibilities LIKE '%".VerifyInput($key)."%' "
			." OR job_requirement LIKE '%".VerifyInput($key)."%'")or die(mysql_error());
			
			while($job_row=mysql_fetch_array($job_query)){
				$result.="<a href=job_details.php?job_category_id=".$job_row['category_id']."&job_id=".$job_row['job_id'].">".Output($job_row['job_title'])."</a><br>";
				
			}
			return $result;

		}
	
	}


?>
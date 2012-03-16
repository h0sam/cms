<?php 
class user{
	
		var $first_name;
		var $last_name;
		var $email_address;
		var $username;
		var $department_id;
		var $job;
		var $is_manager;
		
		//set
		
		function set_first_name($first_name){
			$this->first_name = $first_name;
			return true;
		}
		function set_last_name($last_name){
			$this->last_name = $last_name;
			return true;
		}
		function set_email_address($email_address){
			$this->email_address = $email_address;
			return true;
		}
		function set_username($username){
			$this->username = $username;
			return true;
		}
		function set_department_id($department_id){
			$this->department_id = $department_id;
			return true;
		}
		function set_job($job){
			$this->job = $job;
			return true;
		}
		function set_is_manager($is_manager){
			$this->is_manager = $is_manager;
			return true;
		}
		
		//get
		function get_first_name(){
			return $this->first_name;
		}
		function get_last_name(){
			return $this->last_name;
		}
		function get_email_address(){
			return $this->email_address;
		}
		function get_username(){
			return $this->username;
		}
		function get_department_id(){
			return $this->department_id;
		}
		function get_job(){
			return $this->job;
		}
		function get_is_manager(){
			return $this->is_manager;
		}


		function get_annual($user_id) {
			$annual_query=mysql_query("SELECT leaves_annual FROM leaves WHERE user_id='".$user_id."'")or die(mysql_error());
			$annual_row=mysql_fetch_array($annual_query);
			return $annual_row['leaves_annual'];
		}
		function get_earned($user_id) {
			$earned_query=mysql_query("SELECT leaves_earned FROM leaves WHERE user_id='".$user_id."'")or die(mysql_error());
			$earned_row=mysql_fetch_array($earned_query);
			return $earned_row['leaves_earned'];
		}
		function get_balance($user_id,$leave_type) {
			$leave_type=($leave_type==1? "leaves_annual" : "leaves_earned");
			$balance_query=mysql_query("SELECT ".$leave_type." AS balance FROM leaves WHERE user_id='".$user_id."'")or die(mysql_error());
			$balance_row=mysql_fetch_array($balance_query);
			return $balance_row['balance'];
		}
		function get_full_name($user_id) {
			$name_query=mysql_query("SELECT first_name,last_name FROM users WHERE username='".$user_id."'")or die(mysql_error());
			$name_row=mysql_fetch_array($name_query);
			$full_name=$name_row['first_name']."&nbsp;".$name_row['last_name'];
			return $full_name;
		}
		function get_by_username($username) {
			$user_query=mysql_query("SELECT * FROM users WHERE username='".$username."'")or die(mysql_error());
			$user_row=mysql_fetch_array($user_query);
			
			$this-> first_name=$user_row['first_name'];
			$this-> last_name=$user_row['last_name'];
			$this-> email_address=$user_row['email_address'];
			$this-> username=$user_row['username'];
			$this-> department_id=$user_row['department_id'];
			$this-> job=$user_row['job'];
			$this-> is_manager=$user_row['is_manager'];
		}
			function get_delegated_department($department_id,$user_name) {
			$user_query=mysql_query("SELECT username,first_name,last_name FROM users WHERE department_id='".$department_id."' AND username !='".$user_name."'")or die(mysql_error());
			while($user_row=mysql_fetch_array($user_query)){
				$option .="<option value=".$user_row['username'].">".$user_row['first_name']."&nbsp;".$user_row['last_name']."</option> ";
			}
			
			return $option;
		}
	}


?>
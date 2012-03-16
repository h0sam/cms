<?php 
class leave_request extends user  {
	
		var $user_id;
		var $leave_type;
		var $delegated_id;
		var $request_num_days;
		var $request_start_day;
		var $request_start_date;
		var $request_end_day;
		var $request_end_date;
		var $in_country;
		var $out_country;
		var $leave_address;
		var $request_creation_date;
		var $request_status;
		var $delegated_acceptance;
		var $manager_acceptance;
		
		//set
		
		function set_user_id($user_id){
			$this->user_id = $user_id;
			return true;
		}
		function set_leave_type($leave_type){
			$this->leave_type = $leave_type;
			return true;
		}
		function set_delegated_id($delegated_id){
			$this->delegated_id = $delegated_id;
			return true;
		}
		function set_request_num_days($request_num_days){
			$this->request_num_days = $request_num_days;
			return true;
		}
		function set_request_start_day($request_start_day){
			$this->request_start_day = $request_start_day;
			return true;
		}
		function set_request_start_date($request_start_date){
			$this->request_start_date = $request_start_date;
			return true;
		}
		function set_request_end_day($request_end_day){
			$this->request_end_day = $request_end_day;
			return true;
		}
		function set_request_end_date($request_end_date){
			$this->request_end_date = $request_end_date;
			return true;
		}
		function set_in_country($in_country){
			$this->in_country = $in_country;
			return true;
		}
		function set_out_country($out_country){
			$this->out_country = $out_country;
			return true;
		}
		function set_leave_address($leave_address){
			$this->leave_address = $leave_address;
			return true;
		}
		function set_request_creation_date($request_creation_date){
			$this->request_creation_date = $request_creation_date;
			return true;
		}
		function set_request_status($request_status){
			$this->request_status = $request_status;
			return true;
		}
		function set_delegated_acceptance($delegated_acceptance){
			$this->delegated_acceptance = $delegated_acceptance;
			return true;
		}
		function set_manager_acceptance($manager_acceptance){
			$this->manager_acceptance = $manager_acceptance;
			return true;
		}
		//get
		function get_user_id(){
			return $this->user_id;
		}
		function get_leave_type(){
			return $this->leave_type;
		}
		function get_delegated_id(){
			return $this->delegated_id;
		}
		function get_request_num_days(){
			return $this->request_num_days;
		}
		function get_request_start_day(){
			return $this->request_start_day;
		}
		function get_request_start_date(){
			return $this->request_start_date;
		}
		function get_request_end_day(){
			return $this->request_end_day;
		}
		function get_request_end_date(){
			return $this->request_end_date;
		}
		function get_in_country(){
			return $this->in_country;
		}
		function get_out_country(){
			return $this->out_country;
		}
		function get_leave_address(){
			return $this->leave_address;
		}
		function get_request_creation_date(){
			return $this->request_creation_date;
		}
		function get_request_status(){
			return $this->request_status;
		}
		function get_delegated_acceptance(){
			return $this->delegated_acceptance;
		}
		function get_manager_acceptance(){
			return $this->manager_acceptance;
		}


		function get_by_id($request_id) {
			$request_query=mysql_query("SELECT * FROM leave_request WHERE request_id='".$request_id."'")or die(mysql_error());
			$request_row=mysql_fetch_array($request_query);

			$this-> user_id				=$request_row['user_id'];
			$this-> leave_type      	=$request_row['leave_type'];
			$this-> delegated_id		=$request_row['delegated_id'];
			$this-> request_num_days	=$request_row['request_num_days'];
			$this-> request_start_day	=$request_row['request_start_day'];
			$this-> request_start_date	=$request_row['request_start_date'];
			$this-> request_end_day		=$request_row['request_end_day'];
			$this-> request_end_date	=$request_row['request_end_date'];
			$this-> in_country			=$request_row['in_country'];
			$this-> out_country			=$request_row['out_country'];
			$this-> leave_address		=$request_row['leave_address'];
			$this-> request_creation_date=$request_row['request_creation_date'];
			$this-> request_status		=$request_row['request_status'];
			$this-> delegated_acceptance=$request_row['delegated_acceptance'];
			$this-> manager_acceptance	=$request_row['manager_acceptance'];
		}
	
	}


?>
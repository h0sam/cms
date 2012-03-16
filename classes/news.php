<?php 
class news  {
	
		var $news_id;
		var $news_date;
		var $news_title;
		var $news_brief;
		var $news_details;
		var $news_thumb;
		var $news_image;
		
		//set
		
		function set_news_id($news_id){
			$this->news_id = $news_id;
			return true;
		}
		function set_news_date($news_date){
			$this->news_date = $news_date;
			return true;
		}
		function set_news_title($news_title){
			$this->news_date = $news_title;
			return true;
		}
		function set_news_brief($news_brief){
			$this->news_brief = $news_brief;
			return true;
		}
		function set_news_details($news_details){
			$this->news_details = $news_details;
			return true;
		}
		function set_news_thumb($news_thumb){
			$this->news_thumb = $news_thumb;
			return true;
		}
		function set_news_image($news_image){
			$this->news_image = $news_image;
			return true;
		}
		//get
		function get_news_id(){
			return $this->news_id;
		}
		function get_news_date(){
			return $this->news_date;
		}
		function get_news_title(){
			return $this->news_title;
		}
		function get_news_brief(){
			return $this->news_brief;
		}
		function get_news_details(){
			return $this->news_details;
		}
		function get_news_thumb(){
			return $this->news_thumb;
		}
		function get_news_image(){
			return $this->news_image;
		}

		function get_news_by_id($news_id) {
			$news_query=mysql_query("SELECT * FROM news WHERE news_id='".VerifyInt($news_id)."'")or die(mysql_error());
			$news_row=mysql_fetch_array($news_query);

			$this-> news_id			=$news_row['news_id'];
			$this-> news_date    	=$news_row['news_date'];
			$this-> news_title   	=Output($news_row['news_title']);
			$this-> news_brief		=Output($news_row['news_brief']);
			$this-> news_details	=Output($news_row['news_details']);
			$this-> news_thumb		=$news_row['news_thumb'];
			$this-> news_image		=$news_row['news_image'];
		}
		function get_last_news() {
			$news_query=mysql_query("SELECT * FROM news ORDER BY news_id DESC LIMIT 1")or die(mysql_error());
			$news_row=mysql_fetch_array($news_query);

			$this-> news_id			=$news_row['news_id'];
			$this-> news_date    	=$news_row['news_date'];
			$this-> news_title   	=Output($news_row['news_title']);
			$this-> news_brief		=Output($news_row['news_brief']);
		}
		function get_news_ticker() {
			$news_query=mysql_query("SELECT * FROM news ORDER BY news_id DESC LIMIT 10")or die(mysql_error());
			$ticker="<marquee id=ticker  scrollamount=2 scrolldelay=15   onmouseover=this.stop() onMouseOut=this.start()>";
			while($news_row=mysql_fetch_array($news_query)){
				$ticker.="&nbsp;<a href=news_details.php?news_id=".$news_row[news_id]." class=Link_Report>".Output($news_row[news_title])."</a>&nbsp;&nbsp;";
			}
            $ticker.="</marquee>"; 
			return $ticker;

		}
		function search_news($key) {
			$news_query=mysql_query("SELECT news_id,news_title FROM news "
			." WHERE news_title LIKE '%".VerifyInput($key)."%' OR news_brief LIKE '%".VerifyInput($key)."%' "
			." OR news_details LIKE '%".VerifyInput($key)."%'")or die(mysql_error());
			
			while($news_row=mysql_fetch_array($news_query)){
				$result.="<a href=news_details.php?news_id=".$news_row['news_id'].">".Output($news_row['news_title'])."</a><br>";
				
			}
			return $result;

		}
	
	}


?>
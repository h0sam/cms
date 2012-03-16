<?php 
function dbQuery ($query){
	$doDebug=true;
	$result=mysql_query($query,$db);
	if (!$result){
		if ($doDebug){
			// We are debugging so show some nice error output
       		echo "Query failed\n<br><b>$query</b>\n";
       		echo mysql_error(); 
		}
		else{
			
		}
		exit();
	}
}


function strip_only($str, $tags) {

    if(!is_array($tags)) {

        $tags = (strpos($str, '>') !== false ? explode('>', str_replace('<', '', $tags)) : array($tags));

        if(end($tags) == '') array_pop($tags);

    }

    foreach($tags as $tag) $str = preg_replace('#</?'.$tag.'[^>]*>#is', '', $str);

    return $str;

}



function VerifyInput($input)

{

	$input=mysql_real_escape_string($input);

	return $input;

}



function VerifyInt($input)

{

	 if (!is_numeric($input)) 

	{

		$input=0;

	}

	return $input;

}



function Output($output)

{

	 $output=stripslashes($output); 

	

	 return $output;

}



function sqlcommand($sql)

{

	mysql_query($sql) or die(mysql_error());

}



function dayNumber($date)

{

	$days=explode("-", $date);

	$days=gregoriantojd($days[0],$days[1],$days[2]);

	return $days;

}



function firstPart($text)

{

	$text=explode(" ", $text);

	$text=$text[0];

	return $text;

}



function thumbnail($image_path,$thumb_path,$thumb_width,$image_name)

	{

		//ini_set("memory_limit","10M");

		$ext = substr(strrchr($image_name, '.'), 1);

		$ext = strtolower($ext);

		if($ext =="jpg" || $ext =="jpeg")

		{

			$src_img = imagecreatefromjpeg("$image_path");

		}

		elseif($ext =="png")

		{

			$src_img = imagecreatefrompng("$image_path");

		}

		

		elseif($ext =="gif")

		{

			$src_img = imagecreatefromgif("$image_path");

		}

		else

		{

			echo"not allowed extension only gif,png,jpg  allowed <br>";

			echo"<a href='javascript:history.back()'>Back</a>";

			//break;

			exit();

		}

			$origw=imagesx($src_img);

			$origh=imagesy($src_img);

			if($thumb_width){

				$new_w = $thumb_width;

			}else{

				$new_w = $origw ;

			}

			$diff=$origw/$new_w;

			$new_h=$origh / $diff;

			$dst_img = imagecreatetruecolor($new_w,$new_h);

			imagecopyresampled($dst_img,$src_img,0,0,0,0,$new_w,$new_h,imagesx($src_img),imagesy($src_img));

		

			if($ext =="jpg" || $ext =="jpeg")

			{	

				imagejpeg($dst_img, "$thumb_path");

			}

			if($ext =="png")

			{	

				imagepng($dst_img, "$thumb_path");

			}

			if($ext =="gif")

			{

				imagegif($dst_img, "$thumb_path");

			}

		

		

		return true;

	} 



function Encrypt($string)

{

	return base64_encode($string);

}

function Decrypt($string)

{

	return base64_decode($string);

}

function Language_name($language_id)

{

	$language_name=array(	"1"		=>	"English",

							"2"		=>	"Arabic"	

	);

	return $language_name[$language_id];

}



function category_name($category_id){

$category_query=mysql_query("SELECT * FROM product_category  WHERE category_id='".$category_id."'")or die(mysql_error());

$category_row=mysql_fetch_array($category_query);



$category_name.=$category_row['category_name'];

$category_id=$category_row['category_id'];

$parent_id=$category_row['parent_id'];

if($parent_id >0){

	category_name($parent_id);

}

echo "&nbsp;<a class=navigat href=product.php?category_id=".$category_id.">".$category_name." /</a>&nbsp;";

}



function category_name_admin($category_id){

$category_query=mysql_query("SELECT * FROM image_category  WHERE image_category_id='".$category_id."'")or die(mysql_error());

$category_row=mysql_fetch_array($category_query);



$category_name=$category_row['image_category_name'];

$category_id=$category_row['image_category_id'];

$parent_id=$category_row['parent_id'];

if($parent_id >0){

	category_name_admin($parent_id);

}

echo "&nbsp;<a  href=image_library.php?category_id=".$category_id."&parent_id=".$parent_id.">".$category_name." /</a>&nbsp;";

}



function category_map($parent_id=0){

	$category_query=mysql_query("SELECT * FROM image_category  WHERE parent_id='".$parent_id."'")or die(mysql_error());

	echo"<ul>";

	while($category_row=mysql_fetch_array($category_query)){

	

		

		echo "<li><a class=menulink href=image_library.php?category_id=".$category_row['image_category_id']."&parent_id=".$category_row['parent_id'].">".$category_row['image_category_name']."</a></li>";

		category_map($category_row['image_category_id']);

		

	}

	echo"</ul>";

}



function site_map($parent_id=0){

	$category_query=mysql_query("SELECT * FROM product_category  WHERE parent_id='".$parent_id."'")or die(mysql_error());

	echo"<ul>";

	while($category_row=mysql_fetch_array($category_query)){

	

		

		echo "<li><a class=title href=product.php?category_id=".$category_row['category_id'].">".$category_row['category_name']."</a></li>";

		site_map($category_row['category_id']);

		

	}

	echo"</ul>";

}



function first_parent($category_id){

	$category_query=mysql_query("SELECT * FROM product_category  WHERE category_id='".$category_id."'")or die(mysql_error());

	

		$category_row=mysql_fetch_array($category_query);

		if($category_row['parent_id']==0){

		global $first_parent_id;

		$first_parent_id=$category_row['category_id'];

		}else{

			first_parent($category_row['parent_id']);

		}

	return $first_parent_id;

}



function curPageName() 

{

	return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);

}



// bourse function 







function select_ruters($selected)

{



   $ruter_query=mysql_query("SELECT * FROM symbol_info ORDER BY arabic_name ASC");



         while ($ruter_row=mysql_fetch_array($ruter_query))



         {



                 echo "<option ";

                 if ($selected==$ruter_row[reuters_code])

                 {

                 echo " selected ";



                 }

          echo " value='$ruter_row[reuters_code]'>$ruter_row[arabic_name]</option>";



         }



}

//end select_ruters code



//start select_sectors code

function select_sectors($selected)



{



   $sector_query=mysql_query("SELECT * FROM sectors ORDER BY name_ar ASC");



         while ($sector_row=mysql_fetch_array($sector_query))



         {



                 echo "<option ";



                 if ($selected==$sector_row[sector_id])



                 {

                 echo " selected ";



                 }



          echo " value='$sector_row[sector_id]'>$sector_row[name_ar]</option>";





         }



}

//end select_sectors code



function download($filename)

{

	$ctype="application/force-download";

	//header('Content-type: application/'.$file_pass);

	header("Cache-Control: private",false); // required for certain browsers

	header("Content-Type: $ctype");

	header('Content-Disposition: attachment; filename='.basename($filename));

	header("Content-Transfer-Encoding: binary");

	header("Content-Length: ".@filesize($filename));

	readfile($filename);

}

function download_icon($file)

{

		$ext = substr(strrchr($file, '.'), 1);

		$ext = strtolower($ext);

		if($ext =="doc" || $ext =="docx") 

		$image="word.jpg";

		elseif($ext =="xls" || $ext =="xlsx") 

		$image="excel.jpg";

		elseif($ext =="pdf") 

		$image="pdf.png";

		else

		$image="text.jpg";

	return $image;

}

	function date_input($date){
		$date_parts=explode("-",$date);
		$date=($date_parts[2]."-".$date_parts[1]."-".$date_parts[0]);
		return $date;
	}
	function date_input2($date){
		$date_parts=explode("/",$date);
		$date=($date_parts[2]."-".$date_parts[1]."-".$date_parts[0]);
		return $date;
	}
	function date_output($date){
		$date_parts=explode("-",$date);
		$date=($date_parts[2]."-".$date_parts[1]."-".$date_parts[0]);
		return $date;
	}
	function date_output2($date){
		$date_parts=explode("-",$date);
		$date=($date_parts[2]."/".$date_parts[1]."/".$date_parts[0]);
		return $date;
	}
	function request_status($status_id){
		
		$status_name=array(	"0"		=>	"pending",
							"1"		=>	"accepted",
							"-1"  	=> "not accepted"
		);
		return $status_name[$status_id];
	}

	function leave_type($type){
		
		$leave_type=array(	"1"		=>	"annual",
							"2"		=>	"earned"
		);
		return $leave_type[$type];
	}

?>
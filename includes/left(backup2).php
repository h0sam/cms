
<script type=text/javascript>
var xmlhttp;

function showCategory(id)
{
xmlhttp=GetXmlHttpObject();
if (xmlhttp==null)
  {
  alert ("Browser does not support HTTP Request");
  return;
  }
var url="includes/test.php";
url=url+"?q="+id;
url=url+"&sid="+Math.random();
xmlhttp.onreadystatechange=stateChanged;
xmlhttp.open("GET",url,true);
xmlhttp.send(null);
}

function stateChanged()
{
if (xmlhttp.readyState==4)
{
document.getElementById("categories").innerHTML=xmlhttp.responseText;
}
}

function GetXmlHttpObject()
{
if (window.XMLHttpRequest)
  {
  // code for IE7+, Firefox, Chrome, Opera, Safari
  return new XMLHttpRequest();
  }
if (window.ActiveXObject)
  {
  // code for IE6, IE5
  return new ActiveXObject("Microsoft.XMLHTTP");
  }
return null;
}
</script>

                <?php
					
					
					
					if($_GET[status]=="sign_out")
					{
					session_unset();
					session_destroy();
					header("location: login.php");
					}

					include_once("includes/config.php");
                if ($_POST['action']=="login" && ($REQUEST_METHOD=="POST" || $_SERVER['REQUEST_METHOD']=="POST"))
					{
						
						$rs=mysql_query("SELECT * FROM users WHERE username ='".VerifyInput($_POST['user_name'])."' AND password='".VerifyInput($_POST['password'])."' ") or die(mysql_errno());
						   if(!(mysql_num_rows($rs)))
							{
								
							 header("LOCATION: ".$PHP_SELF."?x=1");
							 exit();
							}
							else
							{
							$_SESSION['user_name']=$_POST['user_name'];
							header("location: ".$PHP_SELF."?1=1");
							exit();
							}
					}
				?>
                <!--Logo-->
                <div class="Logo">
                    <img src="images/spacer.gif" alt="" />
                </div>
                
                <!-- login box -->
              <div id="box_login" class="box">
              <?php if(!$_SESSION['user_name']){ ?>
		<div class="box_title_holder"><div class="box_title">Log in</div>
        <?php
        if (isset($_GET['x']))

            {
            
            echo("<font color='#ff0000'><b>Invalid User Name or Password</b></font><br><br>");
            
            }
            ?>

        </div>
		<div class="box_body">
			<div class="box_content">

				
					<form action="" method="post">
						<input name="action" value="login" type="hidden">
						<input name="cmd" value="login" type="hidden">
						<div class="form_line"> 
							<label>PY NO:</label>
							<div class="formElement">
								<input class="text" name="user_name" value="" style="width: 216px;" type="text">
							</div>
						</div>

						<div class="form_line"> 
							<label>Password:</label>
							<div class="formElement">
								<input class="text" name="password" value="" style="width: 216px;" type="password">
							</div>
						</div>
						<div class="form_line"> 
							<label> </label>
							
						</div>

						<div class="form_line"> 
							
							<div class="formElement submit">
								 <input class="submit_button" name="login" value="Log in" type="submit">
							</div>
						</div>
					</form>
					
				
			</div>
		</div>
        <?php } else{?>
        welcome: <?php echo $_SESSION['user_name']?>
        <br />
        <a href="<?php echo $PHP_SELF?>?status=sign_out">log out</a>
        <?php }?>
	</div>
<!-- end login box -->
                <!--Menu-->
                <div id="Menu">
                 <script type="text/javascript">


ddaccordion.init({
	headerclass: "expandable", //Shared CSS class name of headers group that are expandable
	contentclass: "categoryitems", //Shared CSS class name of contents group
	revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
	mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
	collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
	defaultexpanded: [0], //index of content(s) open by default [index1, index2, etc]. [] denotes no content
	onemustopen: true, //Specify whether at least one header should be open always (so never all headers closed)
	animatedefault: false, //Should contents open by default be animated into view?
	persiststate: true, //persist state of opened contents within browser session?
	toggleclass: ["", "openheader"], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
	togglehtml: ["prefix", "", ""], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
	animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
	oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
		//do nothing
	},
	onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
		//do nothing
	}
})


</script>

<style type="text/css">

.arrowlistmenu{
width: 240px; /*width of accordion menu*/
}

.arrowlistmenu .menuheader{ /*CSS class for menu headers in general (expanding or not!)*/
font: bold 14px Arial;
color: #666;
background: url(images/bg_men.jpg) no-repeat;
margin-bottom: 5px; /*bottom spacing between header and rest of content*/
text-transform: uppercase;
padding: 8px 0 5px 35px; /*header text is indented 10px*/
cursor: hand;
cursor: pointer;
}

.arrowlistmenu .openheader{ /*CSS class to apply to expandable header when it's expanded*/
background-image: url(images/bg_men.jpg);
}

.arrowlistmenu ul{ /*CSS for UL of each sub menu*/
list-style-type: none;
margin: 0;
padding: 0;
margin-bottom: 8px; /*bottom spacing between each UL and rest of content*/
}

.arrowlistmenu ul li{
padding-bottom: 2px; /*bottom spacing between menu items*/
}

.arrowlistmenu ul li a{
color: #A70303;
background: url(arrowbullet.png) no-repeat center left; /*custom bullet list image*/
display: block;
padding: 2px 0;
padding-left: 19px; /*link text is indented 19px*/
text-decoration: none;
font-weight: bold;
border-bottom: 1px solid #dadada;
font-size: 90%;
}

.arrowlistmenu ul li a:visited{
color: #A70303;
}

.arrowlistmenu ul li a:hover{ /*hover state CSS*/
color: #A70303;
background-color: #F3F3F3;
}

</style>

</head>


<div class="arrowlistmenu">
<h2 >image library</h2>
<ul >
<select name="users" onchange="showCategory(this.value);">
<option>___ Select Category ___</option>
<?php
	include_once("includes/config.php");
	$category_query=mysql_query("SELECT * FROM image_category  WHERE parent_id='0' ORDER BY image_category_id DESC")or die(mysql_error());
	while($category_row=mysql_fetch_array($category_query)){
?>

<option onMouseDown="return sR('image_library.php?action=get_images&category_id=<?php echo $category_row['image_category_id']?>&parent_id=<?php echo $category_row['parent_id']?>&category_name=<?php echo Encrypt($category_row['image_category_name'])?>','','','images');" value="<?php echo $category_row['image_category_id']?>"><?php echo $category_row['image_category_name']?></option>

<?php }?>
</select>
</ul>

<div id="categories" ></div>

<h2 >video library</h2>
<ul>

<?php
	$category_query=mysql_query("SELECT * FROM video_category  ORDER BY category_id DESC")or die(mysql_error());
	while($category_row=mysql_fetch_array($category_query)){
?>

<li><a href="video_library.php?category_id=<?php echo $category_row['category_id']?>&category_name=<?php echo Encrypt($category_row['category_name'])?>"><?php echo $category_row['category_name']?></a></li>
<?php }?>

</ul>
                            </div>
</div>
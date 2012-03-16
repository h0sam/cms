                <?php
					if($_GET[status]=="sign_out")
					{
					session_unset();
					session_destroy();
					header("location: index.php");
					}

					include_once("includes/config.php");
					include_once("classes/user.php");
					$user=new user();
				?>
                <!--Logo-->
                <div class="Logo">
                    <img src="images/spacer.gif" alt="" />
                    <br /><br />
                </div>
                <!-- login box -->
              <div id="box_login" class="box" align="left">
        <?php if($_SESSION['user_name']){ ?>
        <img src="images/account-welcome.jpg" alt="Welcome" width="31" height="31" align="absmiddle" /><span class="text_welcome"> welcome:</span><span class="text_red_normal"> <?=$user->get_full_name($_SESSION['user_name']);?></span>
        <br /><br />
        <img src="images/logout.jpg" alt="Logout" width="30" height="30" align="absmiddle" /><a href="<?php echo $PHP_SELF?>?status=sign_out">log out</a>
        <?php }?>
	</div>
<!-- end login box -->
                <!--Menu-->
<div id="Menu">
                	<ul>
                    	   <? 
						   		$select_category_query=mysql_query("SELECT * FROM site_category WHERE "
								." category_id='".$_GET['content_category_id']."' "
								." ORDER BY category_id ASC") or die(mysql_error());
								if($select_category_row=mysql_fetch_array($select_category_query)){
							?>

                    	<li>
                        <a href="content_list.php?content_category_id=<?=$select_category_row['category_id']?>" title="<?=$select_category_row['category_name']?>"><?=$select_category_row['category_name']?></a>
                    	   <? 
						   		$select_content_query=mysql_query("SELECT * FROM site_content WHERE "
								." category_id='".$_GET['content_category_id']."' "
								." ORDER BY category_id ASC") or die(mysql_error());
								if($select_content_num=mysql_num_rows($select_content_query)){
							?>
                            <div id="Menulevel2">
                                <ul>
                                    <? while($select_content_row=mysql_fetch_array($select_content_query)){?>
                                    <li><a href="content_details.php?content_category_id=<?=$select_content_row['category_id']?>&content_id=<?=$select_content_row['content_id']?>" title="<?=strip_tags($select_content_row['content_title'])?>"><?=strip_tags($select_content_row['content_title'])?></a></li>
                                    <? }?>
                                </ul>
                            </div>
                            <? }?>
                        </li>
                        <? }?>
                    	   <? 
						   		$site_category_query=mysql_query("SELECT * FROM site_category WHERE "
								." category_id !='".$_GET['content_category_id']."' "
								." ORDER BY category_id ASC") or die(mysql_error());
								while($site_category_row=mysql_fetch_array($site_category_query)){
							?>
                                    <li><a href="content_list.php?content_category_id=<?=$site_category_row['category_id']?>" title="<?=strip_tags($site_category_row['category_name'])?>"><?=strip_tags($site_category_row['category_name'])?></a></li>
                    		<? }?>
                             <!--<li><a href="image_library.php" title="image library">Image Library</a></li>
                             <li><a href="video_category.php" title="Video library">Video Library</a></li> -->
                    </ul>
                </div>
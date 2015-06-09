

<!--START HEADER HEADER SECTION -->
<header>
<div class="header_main">
	<div class="body_common_section">
    	
        <div class="logo"><a href="/"><img src="/images/logo.png" alt=""></a></div>
   			<div class="search">
   								<form action="/search" method="GET">
                	<div class="search_l"><a href="#"><img src="/images/search.png" alt=""></a></div>
                  <div class="search_r"><input name="keyword" id="keyword" type="text" class="search_textbox"></div>
                	</form>
                <div class="clr"></div>
        </div>
        <div class="mavmenu_section">
        	<nav class="animenu">
						<input type="checkbox" id="button">
						<label for="button" onclick>Menu</label>

        	<ul>
        	<?php if (isset($_SESSION['isLoggedIn']) && ($_SESSION['isLoggedIn'] == true)){ ?>
            		<li><a href="/user/myaccount">MY PROFILE</a></li>
            		<?php if (count($_SESSION['companies']) == 0){ ?>
            				<li style="z-index:9999;"><a href="/profile/claimcompany">MY COMPANY</a></li>
            		<?php } else {  ?>
										<li style="z-index:9999;"><a href="#">MY COMPANY</a>
                            	<ul>
						                		<li><a href="/company/addnewform">+ Add New</a></i>                		                            	
                            	<?php for ($x=0; $x<count($_SESSION['companies']); $x++){ 
																	if ((isset($_SESSION['selectedCompany'])) && ($_SESSION['selectedCompany'] == $_SESSION['companies'][$x]['id'])){
																	 		$showSelected = "<img src='/images/following.png'>";																	
																	 } else {
																	 		$showSelected = "";
																	 } ?>
                               <li><a href="/profile/viewcompany?cid=<?php echo $_SESSION['companies'][$x]['id']; ?>"><img height="40" width="40" src="<?php echo $_SESSION['companies'][$x]['logo']; ?>" alt=""><?php echo $_SESSION['companies'][$x]['name']; ?><?php echo $showSelected;?></a></li>
                                	
                              <?php } ?> 	
                                </ul>
                    </li>
                <?php } ?>

                <li><a href="#"><a href="/messages/home"><img src="/images/email.jpg" alt=""></a></a></li>
                <li style="z-index:9999;"><a href="#"><img src="/images/setting.jpg" alt=""></a>
                		<ul>
                		<?php if (($x > 0) && (isset($_SESSION['selectedCompany']))) { //if we have companies, show the EDIT for the selected company ?>
                			<li><a href="/profile/editcompany?cid=<?php echo $_SESSION['selectedCompany']; ?>">Edit Company</a>
                		<?php } ?>
	                		<li><a href="/login/logout">Log Out</a></i>
                		</ul>
                </li>
                <li><a href="/assets/listall"><img src="/images/list_assets.png" alt=""></a></li>
          <?php }  else {  ?>
            		<li><a href="#login">LOGIN!</a></li>
          <?php }     ?>
            </ul>
            </nav>
        </div>
    
    
    <div class="clr"></div>
    </div>
</div>
</header>

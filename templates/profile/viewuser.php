<!--START HEADER HEADER SECTION -->

<div class="clr"></div>

<!--START BODY SECTION -->

<div class="body_section">

 <div class="body_common_section">
    <section class="ipourit">
    	
        <div class="ipourit_secion">
       		 <div class="ipourit_logo"><img src="https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcSr1Sy29KIo42wdWzvHYE7S8cvG8n6vGLZl5CAI4pSHay90P--hIyhAwYVT" alt=""></div>
        </div>
   		
        <div class="ipourit_details">
        	<h3><?php echo $this->userInfo->firstName; ?> <?php echo $this->userInfo->lastName; ?></h3>
        	<h4><?php echo $this->userInfo->whatIDo;?></h4>
            <div class="ipourit_details_add">
            	<ul>
            	<?php //LOCATIONS
            		$arrLocations = unserialize($this->userInfo->arrLocations);
            		if (count($arrLocations) > 0) { ?>
									<li><img src="/images/icon2.jpg" alt=""> 
									<?php for ($x=0; $x<count($arrLocations);$x++) {
											if ($x>0) {
													echo ", ";
											}
											echo $arrLocations[$x];
									} ?>
									</li>
							<?php } ?>		

            	<?php // EDUCATION
            		$arrEducation = unserialize($this->userInfo->arrEducation);
            		if (count($arrEducation) > 0) { ?>
									<li><img src="/images/icon5.jpg" alt=""><?php echo $arrEducation[0]; ?></li>
							<?php } ?>		
                </ul>
                <div class="clr"></div>
            </div>							
								 <p><img src="/images/icon3.jpg" alt=""> Member Since: <?php echo $this->userInfo->createdAt;?></p>
            </div>

        
        <div class="share">

        	<p><img src="/images/share_icon1.jpg" alt=""> <img src="/images/share_icon5.jpg" alt=""> <img src="/images/share_icon2.jpg" alt=""> <img src="/images/share_icon3.jpg" alt=""> <img src="/images/share_icon6.jpg" alt=""> <img src="/images/share_icon4.jpg" alt=""></p>
						<?php if (isset($_SESSION['userId'])) { ?>
						<?php if (!$this->isProfileOwner) {  ?>
						<p class="sharebutton">
						<?php	if (!$this->isFollowing) { ?>
							<span id='spfollowon'><a href="javascript:follow(<?php echo $this->userId; ?>,<?php echo $_SESSION['userId']; ?>);"><img id='imgfollow' src="/images/follow_icon.jpg" alt="">FOLLOW</a></span>
							<span id='spfollowoff' style="display:none"><a href="javascript:unfollow(<?php echo $this->userId; ?>,<?php echo $_SESSION['userId']; ?>);"><img id='imgfollow' src="/images/bullate1.jpg" alt=""><span id='spfollow'>FOLLOWING</a></span>
						<?php } else { ?>
							<span id='spfollowon' style="display:none"><a href="javascript:follow(<?php echo $this->userId; ?>,<?php echo $_SESSION['userId']; ?>);"><img id='imgfollow' src="/images/follow_icon.jpg" alt="">FOLLOW</a></span>
							<span id='spfollowoff'><a href="javascript:unfollow(<?php echo $this->userId; ?>,<?php echo $_SESSION['userId']; ?>);"><img id='imgfollow' src="/images/bullate1.jpg" alt=""><span id='spfollow'>FOLLOWING</a></span>
						<?php } ?>	
						</p>
						<p class="sharebutton"><a href="javascript:contact();"><img src="/images/contact_icon.jpg" alt=""> CONTACT</a></p>
						<?php } }?>
            
            <div class="rollowers">
            
            <div class="rollowers_l">Followers <br /> <strong><?php echo $this->totalFollowers; ?></strong></div>
            <div class="rollowers_r">Following <br /> <strong><?php echo $this->totalFollowing; ?></strong></div>
            
            <div class="clr"></div>
            </div>

        </div>
   
   			<div class="clr"></div> 
    </section>
    
  <div class="body_bt">
    
    	<section class="profile_completion">
        
        	<div class="experience">
            	<h3>Experience</h3>
                <?php 
                $arrExperience = unserialize($this->userInfo->arrExperience);
            		if (count($arrExperience) > 0) { ?>
									<?php for ($x=0; $x<count($arrExperience);$x++) { ?>
										<div class="job_title_box">
											<div class="job_title_box_l"><img src="/images/search_pic.jpg" alt=""></div>
												<div class="job_title_box_r">
													<?php echo $arrExperience[$x]['jobTitle'];?> <br />
														<span><?php echo $arrExperience[$x]['companyName'];?> <br />
														<?php echo $arrExperience[$x]['month_from'];?>, <?php echo $arrExperience[$x]['year_from'];?> – 
														<?php echo $arrExperience[$x]['month_to'];?>, <?php echo $arrExperience[$x]['year_to'];?>
														</span>
												</div>
								
												<div class="clr"></div>
										</div>											
<?php									}
								}
 ?>
                
                
          </div>
            
            <div class="what_do">
            	<h3>What I do</h3>
                <p><?php echo $this->userInfo->whatIDo; ?></p>
            
            	<h3>Skills</h3>
                <p>
                <?php 
                $skills = unserialize($this->userInfo->arrSkills);
                for ($x=0; $x<count($skills);$x++){
                	if ($x > 0)
                		echo ", ";
                	echo $skills[$x];
                }
                ?>
                </p>
            </div>
            
        <div class="clr"></div>
    	</section>
        
        <section class="profile_completion">
             
             <div class="shortlist">
             	<h3>Shortlist</h3>
                
                <div class="shortlist_box">
                	<div class="shortlist_box_l"><img src="/images/search_pic.jpg" alt=""></div>
                    <div class="shortlist_box_r">
                    	<strong>iPourIt</strong> <br />
                        Self-serve Draft Beer & Premium Wine on Tap Systems.
                    </div>
                <div class="clr"></div>
                </div>
                
                <div class="shortlist_inner">
                
                	<div class="shortlist_inner_l">
                    
                    	<article class="shortlist_assets_section">
            			<h5> <img src="/images/assets_icon1.jpg" alt=""> Asset Name</h5>
                		<div class="shortlist_assets_section_inner">
                            <p>Brief description for this asset here...           ... to here.<br />
                            Status: For Sale <br />
                            Info: $10,000</p>
                		</div>
              			</article>
                        
                        <article class="shortlist_assets_section">
            			<h5> <img src="/images/assets_icon2.jpg" alt=""> Asset Name</h5>
                		<div class="shortlist_assets_section_inner">
                            <p>Brief description for this asset here...           ... to here.<br />
                            Status: For Sale <br />
                            Info: $10,000</p>
                		</div>
              			</article>
                        
                        <article class="shortlist_assets_section">
            			<h5> <img src="/images/assets_icon3.jpg" alt=""> Asset Name</h5>
                		<div class="shortlist_assets_section_inner">
                            <p>Brief description for this asset here...           ... to here.<br />
                            Status: For Sale <br />
                            Info: $10,000</p>
                		</div>
              			</article>
                        
                    </div>
                    
                    <div class="shortlist_inner_r">
                    	<h3>Notes</h3>
                        
                        <ul>
                        <li>• A space for the user to put notes on the companies they add to their
                        Shortlist.</li>
                        
                        <li>• Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                        eiusmod tempor incididunt ut labore et dolore magna aliqua.</li>
                        
                        <li>• Ut enim ad minim veniam, quis nostrud exercitation ullamco.</li>
                        
                        <li>• Laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
                        dolor in reprehenderit in voluptate velit esse cillum dolore eu
                        fugiat nulla pariatur. </li>
                        </ul>
                        
                        <div class="edit_button"><a href="#">EDIT</a></div>
                        
                    </div>
                
                <div class="clr"></div>
                </div>
                
                <div class="shortlist_box">
                	<div class="shortlist_box_l"><img src="/images/search_pic.jpg" alt=""></div>
                    <div class="shortlist_box_r">
                    	<strong>iPourIt</strong> <br />
                        Self-serve Draft Beer & Premium Wine on Tap Systems.
                    </div>
                <div class="clr"></div>
                </div>
                
                <div class="shortlist_inner sbn">
                
                	<div class="shortlist_inner_l">
                    
                    	<article class="shortlist_assets_section">
            			<h5> <img src="/images/assets_icon1.jpg" alt=""> Asset Name</h5>
                		<div class="shortlist_assets_section_inner">
                            <p>Brief description for this asset here...           ... to here.<br />
                            Status: For Sale <br />
                            Info: $10,000</p>
                		</div>
              			</article>
                        
                        <article class="shortlist_assets_section">
            			<h5> <img src="/images/assets_icon2.jpg" alt=""> Asset Name</h5>
                		<div class="shortlist_assets_section_inner">
                            <p>Brief description for this asset here...           ... to here.<br />
                            Status: For Sale <br />
                            Info: $10,000</p>
                		</div>
              			</article>
                        
                        <article class="shortlist_assets_section">
            			<h5> <img src="/images/assets_icon3.jpg" alt=""> Asset Name</h5>
                		<div class="shortlist_assets_section_inner">
                            <p>Brief description for this asset here...           ... to here.<br />
                            Status: For Sale <br />
                            Info: $10,000</p>
                		</div>
              			</article>
                        
                    </div>
                    
                    <div class="shortlist_inner_r">
                   	  <h3>Notes</h3>
                        <textarea name="" class="shortlist_textbox"></textarea>
                        
                        <div class="notebt">
                        
                        <div class="edit_button"><a href="#">SAVE</a></div>
                        <div class="save"> Your profile has been saved! </div>
                        
                        
                        <div class="clr"></div>
                        </div>
                    </div>
                
                <div class="clr"></div>
                </div>
                
             </div>
             
    	</section>
        
        <section class="profile_completion">
            <div class="accordion__content_social_l">
            	
                <div class="profiel_l">
                	
                   	<h4>Followers (<?php echo $this->totalFollowers; ?>)</h4>
                  
                  <?php for($x=0; $x<count($this->allFollowers); $x++) { 
                  	if (($x % 2 == 0) && $x > 0 ) {
                  		echo '<div class="clr4"></div>';
                  	}?>  
                	<div class="profile_main">
                        <div id="tooltip" class="profile_pic">
                        	<img src="/images/profile_pic1.jpg" alt="">
                        </div>
                        <div class="profile_text">
                          	<h5><a href="#"><?php echo $this->allFollowers[$x]['FIRST_NAME'];?> <?php echo $this->allFollowers[$x]['LAST_NAME'];?></a></h5>
                            <?php echo $this->allFollowers[$x]['WHAT_I_DO'];?><!-- <br />
                            @ShopJimmy.com-->
                      </div>
                  	  <div class="clr"></div>
                    </div>
								<?php } ?>                    
                     
                
                <div class="clr"></div>
                </div>
            
            		<div class="clr"></div>
            		
            </div>
         
         		<div class="accordion__content_social_r">
            	
                
              <div class="profiel_r">
                	<h4>Following (<?php echo $this->totalFollowing; ?>)</h4>
 
                   <?php for($x=0; $x<count($this->allFollowing); $x++) { 
                  	if (($x % 2 == 0) && $x > 0 ) {
                  		echo '<div class="clr4"></div>';
                  	}?>  
                	<div class="profile_main">
                        <div id="tooltip" class="profile_pic">
                        	<img src="/images/profile_pic1.jpg" alt="">
                        </div>
                        <div class="profile_text">
                          	<h5><a href="#"><?php echo $this->allFollowing[$x]['FIRST_NAME'];?> <?php echo $this->allFollowing[$x]['LAST_NAME'];?></a></h5>
                            <?php echo $this->allFollowing[$x]['WHAT_I_DO'];?><!-- <br />
                            @ShopJimmy.com-->
                      </div>
                  	  <div class="clr"></div>
                    </div>
								<?php } ?>                    

 
                    
                    
                    
                     
                
                <div class="clr"></div>
                </div>
                
            </div>
        
        		<div class="clr"></div>
        
        		<!--<div class="loading loading_t"><img src="/images/loading.jpg" alt=""></div>-->
        
    	</section>
        
    	<div class="clr"></div>
    </div>    

 </div> <!-- body_common_section -->

</div>	<!-- body_section -->


<!--END BODY SECTION -->  
<?php hoho\fwk\Fwk_JsEnqueuer::getInstance()->enqueue(JS_FILE, "/js/user.js"); ?>
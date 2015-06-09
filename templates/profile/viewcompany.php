<!--START HEADER HEADER SECTION -->

<div class="clr"></div>

<!--START BODY SECTION -->

<div class="body_section">

 <div class="body_common_section">

    <section class="ipourit">
    	
        <div class="ipourit_secion">
       		 <div class="ipourit_logo"><img src="<?php echo $this->companyInfo->logoUrl; ?>" alt=""></div>
        </div>
   		
        <div class="ipourit_details">
        	<h3><?php echo $this->companyInfo->companyName; ?>   <img src="/images/icon1.jpg" alt=""></h3>
       	  <h4><?php echo $this->companyInfo->oneLiner; ?></h4>
            <div class="ipourit_details_add">
            	<ul>
									<li><img src="/images/icon2.jpg" alt=""> 
											<?php
													$city = unserialize($this->companyInfo->city);
													for ($x=0; $x<count($city);$x++){
															if ($x > 0){
																echo ", ";
															}
															echo trim($city[$x]);														
													}
											?>
									</li>
									<li><img src="/images/icon3.jpg" alt=""> Member Since: <?php echo $this->memberSince;?></li>
									<!--
									<li><img src="/images/star1.jpg" alt=""> <img src="/images/star1.jpg" alt=""> <img src="/images/star1.jpg" alt=""> <img src="/images/star1.jpg" alt=""> <img src="/images/star2.jpg" alt=""> (7)</li>
									-->
                </ul>
                <div class="clr"></div>
            </div>
            <p>
			<?php
					$sector = unserialize($this->companyInfo->sector);
					for ($x=0; $x<count($sector);$x++){
							if ($x > 0){
								echo " • ";
							}
							echo trim($sector[$x]);
					}
			?>	</p>
        </div>
        
        <div class="share">
        	<p><img src="/images/share_icon1.jpg" alt=""> <img src="/images/share_icon2.jpg" alt=""> <img src="/images/share_icon3.jpg" alt=""> <img src="/images/share_icon4.jpg" alt=""></p>
        	<?php if (!$this->isCompanyOwner) {  ?>
      		<p class="sharebutton">
					<?php	if (!$this->isFollowing) { ?>
	      		<span id='spfollowon'><a href="javascript:follow(<?php echo $this->cid; ?>,<?php echo $_SESSION['userId']; ?>);"><img id='imgfollow' src="/images/follow_icon.jpg" alt="">FOLLOW</a></span>
						<span id='spfollowoff' style="display:none"><a href="javascript:unfollow(<?php echo $this->cid; ?>,<?php echo $_SESSION['userId']; ?>);"><img id='imgfollow' src="/images/bullate1.jpg" alt=""><span id='spfollow'>FOLLOWING</a></span>
					<?php } else { ?>
	      		<span id='spfollowon' style="display:none"><a href="javascript:follow(<?php echo $this->cid; ?>,<?php echo $_SESSION['userId']; ?>);"><img id='imgfollow' src="/images/follow_icon.jpg" alt="">FOLLOW</a></span>
						<span id='spfollowoff'><a href="javascript:unfollow(<?php echo $this->cid; ?>,<?php echo $_SESSION['userId']; ?>);"><img id='imgfollow' src="/images/bullate1.jpg" alt=""><span id='spfollow'>FOLLOWING</a></span>
	      	<?php } ?>	
	      	</p>
          <p class="sharebutton"><a href="javascript:contact();"><img src="/images/contact_icon.jpg" alt=""> CONTACT</a></p>
      		<?php } ?>
        </div>
   
   			<div class="clr"></div> 
    </section>
    
    <div class="body_bt">
    	<div class="body_bt_l2">
        	<div class="tabs minimal cross-fade bcw">
						<section>                
                    <div>OVERVIEW</div>
                    <div class="tab_con">
                  
                    </div>

										<div class="product_technology">
												<h4>Product &amp; Technology</h4>
													<h5>
											 <?php
													 for ($x=0; $x<count($sector);$x++){
															 if ($x > 0){
																 echo " • ";
															 }
															 echo trim($sector[$x]);
													 }
											 ?>	</h5>                
													<p><?php print_r($this->technology); ?></p>
										</div>

	<?php
								$customers = unserialize($this->companyInfo->customers);
								if (count($customers) > 0) { 
	?>            
										 <div class="product_technology">
												<h4>Marketing & Traction</h4>
								
												<div class="customer">
													 <h4>Customers</h4>               	
													 <div class="customer_section">
															<?php

															 for ($x=0; $x<count($customers);$x++){   ?>
																<div class="customer_box">
																	<img src="/images/marketing_icon.jpg" alt=""> <?php echo $customers[$x]; ?>
																</div>
									 
															<?php		 						
															 } ?>
									
								
																<div class="clr"></div>
													 </div>
								
													 <p class="all"><a href="#">ALL</a> <img src="/images/arrow2.jpg" alt=""></p>
								
													</div>
								
									 </div>
	<?php				 }  // if count customers > 0?>
						
									<!--
									<div class="product_technology">
										<h4>Company History</h4>
											<p>
											Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. <br /><br />

							Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae.
											</p>
									</div>
									-->
						
						
							<?php if ((trim($this->companyInfo->fundCurrent)!='') || (trim($this->companyInfo->fundPast)!='')){ ?>
							<div class="product_technology">
								<h4>Funding</h4>
								
									<?php if (trim($this->companyInfo->fundCurrent)!=''){ ?>
									<div class="product_technology_box">
											<div class="product_technology_inn_l"><img src="/images/funding_icon.jpg" alt=""></div>
											<div class="product_technology_inn_r">
												<h5><?php echo $this->companyInfo->fundCurrent; ?></h5>
											</div>
											<div class="clr"></div>
									</div>
									<?php } ?>

									<?php if (trim($this->companyInfo->fundPast)!=''){ ?>                
									<div class="product_technology_box">
											<div class="product_technology_inn_l"><img src="/images/funding_icon.jpg" alt=""></div>
											<div class="product_technology_inn_r">
												<h5><?php echo $this->companyInfo->fundPast; ?></h5>
											</div>
											<div class="clr"></div>
									</div>
									<?php } ?>                
						
									<div class="clr"></div>   
							</div>
							<?php } ?>
						
							<div class="product_technology">
								<h4>Founders</h4>
									<?php
									$founders = $this->founders; //unserialize($this->companyInfo->founders);
									for ($x=0; $x<count($founders);$x++){   ?>
									<div class="product_technology_box">
													<img src="<?php echo $founders[$x]['FOUNDER_PHOTO_URL'];?>" height="50" width="50" alt=""> <?php echo $founders[$x]['FOUNDER_NAME']; ?>
									</div>
								<?php
								 } ?>
							<div class="clr"></div>
							</div>

                                        
							 </section>
                
            <section>
                
                    <div>ASSETS</div>
                    
                    <div class="tab_con">
                        <?php 
                        	if ($this->assets != null){
                          foreach ($this->assets as $asset) {  
                        	$assetData = unserialize($asset->assetValues);
                        	switch ($asset->assetType){
                        		case 'technology':
                        			$assetImg = 'assets_icon_big1.jpg'; ?>
															<h4><img src="/images/<?php echo $assetImg; ?>" alt=""> <?php echo ucfirst($asset->assetType); ?></h4>
															<div class="assest_name_section">
																	<div class="tab_con_assets_name"><?php echo $asset->assetName; ?></div>
																	                        			
																	<div class="tab_con_assets_box">
																		<div class="tab_con_assets_box_l">Description</div>
																		<div class="tab_con_assets_box_r"><?php echo $assetData['description']; ?></div>
																		<div class="clr"></div>
																	</div>
												
																	<div class="tab_con_assets_box">
																		 <div class="tab_con_assets_box_l">Why It’s Interesting</div>
																		 <div class="tab_con_assets_box_r"><?php echo $assetData['why']; ?></div>
																		 <div class="clr"></div>
																	</div>
												
																	<div class="tab_con_assets_box">
																		 <div class="tab_con_assets_box_l">Useful For</div>
																		 <div class="tab_con_assets_box_r"><?php echo $assetData['useful']; ?></div>
																		 <div class="clr"></div>
																	</div>
												
																	<div class="tab_con_assets_box">
																		<div class="tab_con_assets_box_l">Specs</div>
																		 <div class="tab_con_assets_box_r"><?php echo $assetData['specs']; ?></div>
																		<div class="clr"></div>
																	</div>
												
																	<div class="tab_con_assets_box">
																		<div class="tab_con_assets_box_l">Usage Example/Applications</div>
																		 <div class="tab_con_assets_box_r"><?php echo $assetData['example']; ?></div>
																		<div class="clr"></div>
																	</div>
															</div>
                        			<?php
                        			break;
                        		case 'data':
                        			$assetImg = 'assets_icon_big2.jpg'; ?>
															<h4><img src="/images/<?php echo $assetImg; ?>" alt=""> <?php echo ucfirst($asset->assetType); ?></h4>
															<div class="assest_name_section">
																	<div class="tab_con_assets_name"><?php echo $asset->assetName; ?></div>
																	                        			
																	<div class="tab_con_assets_box">
																		<div class="tab_con_assets_box_l">Description</div>
																		<div class="tab_con_assets_box_r"><?php echo $assetData['description']; ?></div>
																		<div class="clr"></div>
																	</div>
												
																	<div class="tab_con_assets_box">
																		 <div class="tab_con_assets_box_l">Why It’s Interesting/Unique</div>
																		 <div class="tab_con_assets_box_r"><?php echo $assetData['why']; ?></div>
																		 <div class="clr"></div>
																	</div>
												
																	<div class="tab_con_assets_box">
																		 <div class="tab_con_assets_box_l">Useful For</div>
																		 <div class="tab_con_assets_box_r"><?php echo $assetData['useful']; ?></div>
																		 <div class="clr"></div>
																	</div>
												
																	<div class="tab_con_assets_box">
																		<div class="tab_con_assets_box_l">Specs</div>
																		 <div class="tab_con_assets_box_r"><?php echo $assetData['specs']; ?></div>
																		<div class="clr"></div>
																	</div>              			
                        			</div>
                        			<?php
                        			break;                        		
                        		case 'client':
                        			$assetImg = 'assets_icon_big3.jpg'; ?>
															<h4><img src="/images/<?php echo $assetImg; ?>" alt=""> <?php echo ucfirst($asset->assetType); ?></h4>
															<div class="assest_name_section">
																	<div class="tab_con_assets_name"><?php echo $asset->assetName; ?></div>
																	                        			
																	<div class="tab_con_assets_box">
																		<div class="tab_con_assets_box_l">Description</div>
																		<div class="tab_con_assets_box_r"><?php echo $assetData['description']; ?></div>
																		<div class="clr"></div>
																	</div>
												
																	<div class="tab_con_assets_box">
																		 <div class="tab_con_assets_box_l">Size</div>
																		 <div class="tab_con_assets_box_r"><?php echo $assetData['size']; ?></div>
																		 <div class="clr"></div>
																	</div>
												
																	<div class="tab_con_assets_box">
																		 <div class="tab_con_assets_box_l">Engagement</div>
																		 <div class="tab_con_assets_box_r"><?php echo $assetData['engagement']; ?></div>
																		 <div class="clr"></div>
																	</div>
												
																	<div class="tab_con_assets_box">
																		<div class="tab_con_assets_box_l">Growth</div>
																		 <div class="tab_con_assets_box_r"><?php echo $assetData['growth']; ?></div>
																		<div class="clr"></div>
																	</div>

																	<div class="tab_con_assets_box">
																		<div class="tab_con_assets_box_l">Financial Information</div>
																		 <div class="tab_con_assets_box_r"><?php echo $assetData['financial']; ?></div>
																		<div class="clr"></div>
																	</div>                        			
															</div>
                        			<?php
                        			break;                        		
                        		case 'user': //customer
                        			$assetImg = 'assets_icon_big4.jpg'; ?>
															<h4><img src="/images/<?php echo $assetImg; ?>" alt=""> <?php echo ucfirst($asset->assetType); ?></h4>
															<div class="assest_name_section">
																	<div class="tab_con_assets_name"><?php echo $asset->assetName; ?></div>
																	                        			
																	<div class="tab_con_assets_box">
																		<div class="tab_con_assets_box_l">Description</div>
																		<div class="tab_con_assets_box_r"><?php echo $assetData['description']; ?></div>
																		<div class="clr"></div>
																	</div>
												
																	<div class="tab_con_assets_box">
																		 <div class="tab_con_assets_box_l">Size and Location</div>
																		 <div class="tab_con_assets_box_r"><?php echo $assetData['size']; ?></div>
																		 <div class="clr"></div>
																	</div>
												
																	<div class="tab_con_assets_box">
																		 <div class="tab_con_assets_box_l">Engagement</div>
																		 <div class="tab_con_assets_box_r"><?php echo $assetData['engagement']; ?></div>
																		 <div class="clr"></div>
																	</div>
												
																	<div class="tab_con_assets_box">
																		<div class="tab_con_assets_box_l">Growth</div>
																		 <div class="tab_con_assets_box_r"><?php echo $assetData['growth']; ?></div>
																		<div class="clr"></div>
																	</div>
                        			<?php
                        			break;                        		
                        		case 'branding':
                        			$assetImg = 'assets_icon_big7.jpg'; ?>
															<h4><img src="/images/<?php echo $assetImg; ?>" alt=""> <?php echo ucfirst($asset->assetType); ?></h4>
															<div class="assest_name_section">
																	<div class="tab_con_assets_name"><?php echo $asset->assetName; ?></div>
																	                        			
																	<div class="tab_con_assets_box">
																		<div class="tab_con_assets_box_l">Description</div>
																		<div class="tab_con_assets_box_r"><?php echo $assetData['description']; ?></div>
																		<div class="clr"></div>
																	</div>
												
																	<div class="tab_con_assets_box">
																		 <div class="tab_con_assets_box_l">Images</div>
																		 <div class="tab_con_assets_box_r"><?php echo $assetData['images']; ?></div>
																		 <div class="clr"></div>
																	</div>
												
																	<div class="tab_con_assets_box">
																		 <div class="tab_con_assets_box_l">Unique/Cool</div>
																		 <div class="tab_con_assets_box_r"><?php echo $assetData['unique']; ?></div>
																		 <div class="clr"></div>
																	</div>
												
																	<div class="tab_con_assets_box">
																		<div class="tab_con_assets_box_l">New?</div>
																		 <div class="tab_con_assets_box_r"><?php echo $assetData['new']; ?></div>
																		<div class="clr"></div>
																	</div>

																	<div class="tab_con_assets_box">
																		<div class="tab_con_assets_box_l">Target Audience</div>
																		 <div class="tab_con_assets_box_r"><?php echo $assetData['target']; ?></div>
																		<div class="clr"></div>
																	</div>                                      			
															</div>
                        			<?php
                        			break;                        		
                        		case 'team':
                        			$assetImg = 'assets_icon_big5.jpg'; ?>
															<h4><img src="/images/<?php echo $assetImg; ?>" alt=""> <?php echo ucfirst($asset->assetType); ?></h4>
															<div class="assest_name_section">
																	<div class="tab_con_assets_name"><?php echo $asset->assetName; ?></div>
																	                        			
																	<div class="tab_con_assets_box">
																		<div class="tab_con_assets_box_l">Name And Position</div>
																		<div class="tab_con_assets_box_r"><?php echo $assetData['name']; ?></div>
																		<div class="clr"></div>
																	</div>
												
																	<div class="tab_con_assets_box">
																		 <div class="tab_con_assets_box_l">Expertise</div>
																		 <div class="tab_con_assets_box_r"><?php echo $assetData['expertise']; ?></div>
																		 <div class="clr"></div>
																	</div>
												
																	<div class="tab_con_assets_box">
																		 <div class="tab_con_assets_box_l">Strengths</div>
																		 <div class="tab_con_assets_box_r"><?php echo $assetData['strengths']; ?></div>
																		 <div class="clr"></div>
																	</div>
												
																	<div class="tab_con_assets_box">
																		<div class="tab_con_assets_box_l">Availability</div>
																		 <div class="tab_con_assets_box_r"><?php echo $assetData['available']; ?></div>
																		<div class="clr"></div>
																	</div>
															</div>
                        			<?php
                        			break;                        		
                        		case 'offices': 
                        			$assetImg = 'assets_icon_big6.jpg'; ?>
															<h4><img src="/images/<?php echo $assetImg; ?>" alt=""> <?php echo ucfirst($asset->assetType); ?></h4>
															<div class="assest_name_section">
																	<div class="tab_con_assets_name"><?php echo $asset->assetName; ?></div>
																	                        			
																	<div class="tab_con_assets_box">
																		<div class="tab_con_assets_box_l">Description</div>
																		<div class="tab_con_assets_box_r"><?php echo $assetData['description']; ?></div>
																		<div class="clr"></div>
																	</div>
												
																	<div class="tab_con_assets_box">
																		 <div class="tab_con_assets_box_l">Location</div>
																		 <div class="tab_con_assets_box_r"><?php echo $assetData['location']; ?></div>
																		 <div class="clr"></div>
																	</div>
												
																	<div class="tab_con_assets_box">
																		 <div class="tab_con_assets_box_l">Size</div>
																		 <div class="tab_con_assets_box_r"><?php echo $assetData['size']; ?></div>
																		 <div class="clr"></div>
																	</div>
												
																	<div class="tab_con_assets_box">
																		<div class="tab_con_assets_box_l">Type</div>
																		 <div class="tab_con_assets_box_r"><?php echo $assetData['type']; ?></div>
																		<div class="clr"></div>
																	</div>

																	<div class="tab_con_assets_box">
																		<div class="tab_con_assets_box_l">Availability</div>
																		 <div class="tab_con_assets_box_r"><?php echo $assetData['available']; ?></div>
																		<div class="clr"></div>
																	</div>                                      			

																	<div class="tab_con_assets_box">
																		<div class="tab_con_assets_box_l">Price</div>
																		 <div class="tab_con_assets_box_r"><?php echo $assetData['price']; ?></div>
																		<div class="clr"></div>
																	</div>                                      										

																	<div class="tab_con_assets_box">
																		<div class="tab_con_assets_box_l">Looking For</div>
																		 <div class="tab_con_assets_box_r"><?php echo $assetData['looking']; ?></div>
																		<div class="clr"></div>
																	</div>                                      																														
															</div>
                        			<?php
                        			break;                        		
                        		case 'other':
                        			$assetImg = 'assets_icon_big1.jpg';
                        			break;                        		
                        	 }//end-switch
                        
                        ?>                    
															<div class="tab_con_assets_box2">    
																	<div class="make_button"><a href="#offerModal">MAKE AN OFFER</a></div>
																	<!--
																	<div class="make_button2"><a href="#">REQUEST MORE INFO</a></div>
																	-->
																	<div class="clr"></div><br />
															</div>
                        
                       		<!-- </div>   -->
											<?php } // end-foreach asset
												} 
													else 
												{  // there are no assets ?>
												
												This company hasn't listed any assets yet. 
												If you are interested, click here and we'll give them a nudge.
												
											<?php }	
											?>
                    </div>
                                            
								</section>
                
                <section>
                
                    <div>DETAILS</div>
                    
<?php 
                    if (count($customers) > 0) { 
?>
                    <div class="tab_con">
											<h4>Marketing</h4>
													<div class="customer">               
														<h4>Customers</h4>               	
														<div class="customer_section">
<?php
														 for ($x=0; $x<count($customers);$x++){   
?>
															<div class="customer_box">
																<img src="/images/marketing_icon.jpg" alt=""> <?php echo $customers[$x]; ?>
															</div>						 
<?php		 						
														 }
?>
																<div class="clr"></div>
													   </div>                   	     
													</div>
										</div>
<?php 			
      			        }   // if customers > 0
      			        
                  $traction = unserialize($this->companyInfo->traction);                    
                  if (count($traction) > 0) {   
?>									<div class="tab_con">
                     <h4>Traction</h4>   
                      <div class="customer">                                		
                    		<div class="customer_section">
<?php
												for ($x=0; $x<count($traction);$x++){
?>
													<div class="tab_con_assets_box">
															<div class="tab_con_assets_box_l"><?php echo $traction[$x]['name']; ?></div>
															<div class="tab_con_assets_box_r2"><?php echo $traction[$x]['data'][0]['date']; ?></div>
															<div class="tab_con_assets_box_r3"><?php echo $traction[$x]['data'][0]['content']; ?></div>
															<div class="clr"></div>
													</div>
<?php
												} 
?>	
                    		</div>

												<div class="clr"></div>
											</div>   
											
                    </div>
<?php 						}	// if traction > 0
?>
									<?php if ((trim($this->companyInfo->fundCurrent)!='') || (trim($this->companyInfo->fundPast)!='')){ ?>
									<div class="product_technology">
										<h4>Funding</h4>
								
											<?php if (trim($this->companyInfo->fundCurrent)!=''){ ?>
											<div class="product_technology_box">
												<div class="product_technology_inn_l"><img src="/images/funding_icon.jpg" alt=""></div>
													<div class="product_technology_inn_r">
														<h5><?php echo $this->companyInfo->fundCurrent; ?></h5>
													</div>
											<div class="clr"></div>
											</div>
											<?php } ?>

											<?php if (trim($this->companyInfo->fundPast)!=''){ ?>                
											<div class="product_technology_box">
												<div class="product_technology_inn_l"><img src="/images/funding_icon.jpg" alt=""></div>
													<div class="product_technology_inn_r">
														<h5><?php echo $this->companyInfo->fundPast; ?></h5>
													</div>
											<div class="clr"></div>
											</div>
											<?php } ?>                
						
											<div class="clr"></div>   

									<?php } ?>

			<br /><br />
									 <div class="customer">               
											 <h4>Investors</h4>               	
											 <div class="customer_section">
			<?php
											$investors = unserialize($this->companyInfo->currentInvestors);                    
											for ($x=0; $x<count($investors);$x++){   
			?>
											 <div class="customer_box">
												 <strong><?php echo $investors[$x]['name']; ?></strong><br />
												 <?php echo $investors[$x]['Descr']; ?>
											 </div>
			
			<?php		 						
											}
			?>
												 <div class="clr"></div>
											</div>                   	     
									 </div>

									<div class="product_technology">
										<h4>Founders</h4>
											<?php
											for ($x=0; $x<count($founders);$x++){   ?>
											<div class="product_technology_box">
															<img src="<?php echo $founders[$x]['FOUNDER_PHOTO_URL'];?>" height="80" width="80" alt=""> 
															<strong><?php echo $founders[$x]['FOUNDER_NAME']; ?></strong>
															<?php echo $founders[$x]['BIO_TEXT']; ?>
											</div>
										<?php
										 } ?>
									<div class="clr"></div>
									</div>


									<div class="product_technology">
										<h4>Employees</h4>
											<?php
											$employees = unserialize($this->companyInfo->employees);                                    
											for ($x=0; $x<count($employees);$x++){   ?>
											<div class="product_technology_box">
															<strong><?php echo $employees[$x]['Name']; ?></strong>
															<?php echo $employees[$x]['description']; ?>
															<br /><br />
											</div>
										<?php
										 } ?>
										<div class="clr"></div>
									</div>

									<div class="product_technology">
										<h4>Attorneys</h4>
											<?php
											$attorneys = unserialize($this->companyInfo->attorneys);                                    
											for ($x=0; $x<count($attorneys);$x++){   ?>
											<div class="product_technology_box">
															<strong><?php echo $attorneys[$x]['Name']; ?></strong>
															<?php echo $attorneys[$x]['Descr']; ?>
															<br /><br />
											</div>
										<?php
										 } ?>
									 <div class="clr"></div>
									</div>


									<div class="product_technology">
										<h4>Advisors</h4>
											<?php
											$advisors = unserialize($this->companyInfo->advisors);                                    
											for ($x=0; $x<count($advisors);$x++){   ?>
											<div class="product_technology_box">
															<strong><?php echo $advisors[$x]['Name']; ?></strong>
															<?php echo $advisors[$x]['Descr']; ?>
															<br /><br />
											</div>
										<?php
										 } ?>
										 <div class="clr"></div>
									</div>


									<div class="product_technology">
										<h4>Press</h4>
											<?php
											$press = unserialize($this->companyInfo->press);                                    
											for ($x=0; $x<count($press);$x++){   ?>
											<div class="product_technology_box_large">
															<strong><?php echo $press[$x]['posted_at']; ?></strong><br />
															<?php echo $press[$x]['url'];?><br />
															<?php echo $press[$x]['title']; ?>
															<br /><br />
											</div>
										<?php
										 } ?>
										 <div class="clr"></div>
									</div>



<!--								</div>					-->
								
						 	 </section>
                
                <section>
                
                    <div>SOCIAL</div>
                    
                    <div class="tab_con plr">
                        <h4>Followers (<?php echo $this->followersTotal; ?>)</h4>                        
                        <!--<div class="less"><img src="/images/less.jpg" alt=""></div>-->
                        <div class="clr"></div>

												<div class="followers_section">

														<?php
														$followers = $this->follwersDetail;
														for ($x=0; $x<count($followers);$x++){  
															if (isset($followers[$x]['PHOTO_URL']))
																$imgLogo = $followers[$x]['PHOTO_URL'];
															else
																$imgLogo = "/images/no-img.png"; ?>
														<div class="followers_section_box">
																	<div class="followers_section_box_l"><img src="<?php echo $imgLogo; ?>" heigth="50" width="50" alt=""></div>
																	<div class="followers_section_box_r">
																			<p class="followers_title"><a href="#"><?php echo $followers[$x]['FIRST_NAME']; ?> <?php echo $followers[$x]['LAST_NAME']; ?></a></p>				
																			<p><?php echo $followers[$x]['WHAT_I_DO']; ?> </p> <!--Angel Investor and Founder <br />@ShopJimmy.com</p>-->
																	</div>
																	<div class="clr"></div>	
														</div>
													<?php
													 } ?>
												</div>
                    </div>


                    
			  				</section>
			  				
				  </div> <!-- class="tabs minimal cross-fade bcw" -->
      </div> <!-- class="body_bt_l2" -->
      
        
      <div class="body_bt_r">
        
          <section class="assets_right">
       	  <h6>Assets</h6>
            <?php

            if ($this->sortedAssets) {
                $i = 0;
                while ($i < 10) {
            ?>
            <article class="assets_section">
                <h5> <img src="/images/<?php echo $this->sortedAssets[$i]['img']; ?>" alt=""> <?php echo $this->sortedAssets[$i]['assetTypeName']; ?></h5>
                <div class="assets_section_inner">
                    <h6><?php echo $this->sortedAssets[$i]['assetName']; ?></h6>
                    <p><?php echo $this->sortedAssets[$i]['description']; ?><br />
                    <?php
                    if ($this->sortedAssets[$i]['status']) {
                    ?>
                        Status: <?php echo $this->sortedAssets[$i]['status']; ?><br />
                    <?php
                    }
                    ?>
                    <?php
                    if ($this->sortedAssets[$i]['info']) {
                    ?>
                        Info: <?php echo $this->sortedAssets[$i]['info']; ?></p>
                    <?php
                    }
                    ?>
                    <p class="view_assets_link"><a href="#">View Asset</a></p>
                </div>
            </article>
            <?php
                    $i++;
                }
            }
            ?>
<!--
            <article class="assets_section">
            	<h5> <img src="/images/assets_icon6.jpg" alt=""> Customer Base</h5>
                <div class="assets_section_inner">
              		<h6>Asset Name</h6>
              		<p>Brief description for this... <br />
                	Status: For Sale <br />
                	Info: Open to offers
                    </p>
            		<p class="view_assets_link"><a href="#">View Asset</a></p>
                </div>
              </article>
              
            <article class="assets_section">
            	<h5> <img src="/images/assets_icon9.jpg" alt="">Other</h5>
                <div class="assets_section_inner">
              		<h6>Asset Name</h6>
              		<p>Brief description for this... <br /> 
                	Status: For Sale <br />
                	Info: Open to offers
                    </p>
            		<p class="view_assets_link btn"><a href="#">View Asset</a></p>
                </div>
              </article>
-->            
            <div class="clr"></div>
            </section>

<!--            
          <div class="similar_com">
       			<h6>Similar Companies</h6>
                <div class="company"><a href="#"><img src="/images/similar_com1.jpg" alt=""> Boost Media</a></div>
                <div class="company"><a href="#"><img src="/images/similar_com2.jpg" alt=""> Recarga.com</a></div>
                <div class="company"><a href="#"><img src="/images/similar_com3.jpg" alt=""> Requested</a></div>
                <div class="company"><a href="#"><img src="/images/similar_com4.jpg" alt=""> Revolar</a></div>
                <div class="company"><a href="#"><img src="/images/similar_com5.jpg" alt=""> NodeSource</a></div>
          </div>
-->            
      </div>
        
    	<div class="clr"></div>
    </div> <!-- body_bt -->

 </div> <!-- body_common_section -->



</div>

<div class="login_bg">
<div id="offerModal" class="modalbg">
  <div class="dialog">
    <a href="#close" title="Close" class="close">X</a>
    <div class="login_box">
   	  <h4>Make An Offer</h4>
        
      <div class="login_box_t">
   	    <div class="login_box_sec">
       	  <p><input id="offerPrice" type="text" class="login_textbox" onFocus="if(this.value == 'Price: ex $5,000') { this.value = ''; }" onBlur="if(this.value == '') { this.value = 'Price: ex $5,000'; }"  value="Price: ex $5,000" /></p>
          <p><input id="offerItems" type="text" class="login_textbox" onFocus="if(this.value == 'Items for exchange') { this.value = ''; }" onBlur="if(this.value == '') { this.value = 'Ites for exchange'; }"  value="Items for exchange" /></p>
        </div>
        <B><a href="javascript:sendOffer();">SEND</a></B>
      </div>        
    </div>
    </div>
    </div>
    
</div>


<!--END BODY SECTION -->  
<?php hoho\fwk\Fwk_JsEnqueuer::getInstance()->enqueue(JS_FILE, "/js/company.js"); ?>

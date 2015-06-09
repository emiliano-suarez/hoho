<!--START BODY SECTION -->

<div class="body_section">

<div class="body_common_section">

        <input type="hidden" id="cid" value="<?php echo $this->companyInfo->id; ?>">
        <input type="hidden" id="txtNumberEmployees" value="<?php echo $this->companyInfo->totalEmployees; ?>">
        <input type="hidden" id="txtFundCurrent" value="<?php echo $this->companyInfo->fundCurrent; ?>">
        <input type="hidden" id="txtFundPast" value="<?php echo $this->companyInfo->fundPast; ?>">
        <input type="hidden" id="txtInvestors" value="<?php echo $this->companyInfo->investorNames; ?>">
        <input type="hidden" id="txtProductDescription" value="<?php echo $this->companyInfo->productDescription; ?>">
        <input type="hidden" id="txtTechnology" value="<?php echo $this->companyInfo->technology; ?>">
        <input type="hidden" id="txtSpecialties" value="<?php echo $this->companyInfo->specialties; ?>">
        <input type="hidden" id="txtTraction" value="<?php echo $this->companyInfo->traction; ?>">
        <input type="hidden" id="txtFounders" value="<?php echo $this->companyInfo->founders; ?>">
        <input type="hidden" id="txtCustomers" value="<?php echo $this->companyInfo->customers; ?>">
        <input type="hidden" id="txtAdvisors" value="<?php echo $this->companyInfo->advisors; ?>">
        <input type="hidden" id="txtIncubators" value="<?php echo $this->companyInfo->incubators; ?>">
        <input type="hidden" id="txtPress" value="<?php echo $this->companyInfo->press; ?>">
        <input type="hidden" id="txtMoreInfo" value="<?php echo $this->companyInfo->moreInfo; ?>">
        <input type="hidden" id="txtAttorneys" value="<?php echo $this->companyInfo->attorneys; ?>">
        <input type="hidden" id="txtContactDetails" value="<?php echo $this->companyInfo->contactDetails; ?>">
        <input type="hidden" id="txtLogoUrl" value="<?php echo $this->companyInfo->logoUrl; ?>">

		 <section class="profile_completion">
				
								 <div class="accordion_example2">
			
										 <div class="accordion_in acc_active">
												 <div class="acc_head">Profile Completion</div>
												 <div class="acc_content">
										
													 <div class="acc_content_l"><img src="/images/percentage.jpg" alt="">  Keeno</div>
											
														 <div class="acc_content_r">
															 <h3>What am I missing?</h3>
														
																 <div class="acc_content_r_l">
																	 <ul>
																			 <li><a href="#">Complete your personal profile</a></li>
																				 <li><a href="#">List your assets</a></li>
																				 <li><a href="#">Complete your company profile</a></li>
																		 </ul>
																 </div>
																 <div class="acc_content_r_r">
																	 <ul>
																			 <li><a href="#">Follow other users and companies</a></li>
																			 <li><a href="#" class="active">Search for interesting assets</a></li>
																		 </ul>
																 </div>
												
														 <div class="clr"></div>
														 </div>
										
												 <div class="clr"></div>
											 </div>
										 </div>
						
								 </div>
		
				 </section>

<div class="profile_edit">
    
   	    <div class="accordion_r">
        
  <div id="tabCompanyInfo" class="accordion__title">COMPANY INFO</div>
  
      
        <div class="accordion__content">
        <h3>Profile Information</h3>
        
        <div class="accordion_frst">

            <div class="accordion_box">
                <div class="accordion_box_l">Profile Photo</div>
                <div class="accordion_box_r">
<?php
if ($this->companyInfo->logoUrl) {

}
?>
                    <div class="dropzone" id="company_drag_drop"></div>
                </div>

                <div class="clr"></div>
            </div>

            <div class="accordion_box">
                <div class="accordion_box_r2" id="btnFileUpload">
                    <div class="browse_l">
                        <img src="../../images/browse.jpg" alt="">
                        <input name="browse" type="file" />
                    </div>
                    <div class="browse_r"></div>
                    <div class="clr"></div>
                </div>
                <div class="clr"></div>
            </div>

<!--
            <div class="accordion_box">
                <div class="accordion_box_l">Profile Photo</div>
                <div class="accordion_box_r">
                    <div class="dragbox"><img src="/images/drag_pic.jpg" alt=""></div>
                </div>
                <div class="clr"></div>
            </div>
        
            <div class="accordion_box">
                <div class="accordion_box_r2">
                    <div class="browse_l">
                        <input type="file" id="companyLogo" name="companyLogo">
                    </div>
                    <div class="browse_r">/images/filename.jpg</div>
                    <div class="clr"></div>
                </div>
                <div class="clr"></div>
            </div>
-->
            <div class="accordion_box">
            <div class="accordion_box_l">Company Name</div>
            <div class="accordion_box_r">
            	<input id="txtCompanyName" type="text" class="accordion_textbox" onFocus="if(this.value == '<?php echo $this->companyInfo->companyName; ?>') { this.value = ''; }" onBlur="if(this.value == '') { this.value = '<?php echo $this->companyInfo->companyName; ?>'; }"  value="<?php echo $this->companyInfo->companyName; ?>" />
            </div>
        <div class="clr"></div>
        </div>
        
           <div class="accordion_box">
            <div class="accordion_box_l">
            Description <br />
            <span>Limit to one or two sentences.</span>
            </div>
            <div class="accordion_box_r">
            	<textarea id="txtDescription" class="accordion_textbox2" onFocus="if(this.value == '<?php echo $this->companyInfo->oneLiner; ?>') { this.value = ''; }" onBlur="if(this.value == '') { this.value = '<?php echo $this->companyInfo->oneLiner; ?>'; }"><?php echo $this->companyInfo->oneLiner; ?></textarea>
            </div>
        <div class="clr"></div>
        </div>
        
           <div class="accordion_box">
            <div class="accordion_box_l">Location</div>
            <div class="accordion_box_r">
            <?php
								$city = unserialize($this->companyInfo->city);
								$locationCity = "";
								for ($x=0; $x<count($city);$x++){
										$locationCity = $city[$x];
								}
            
            ?>
            	<input id="txtLocation" type="text" class="accordion_textbox" onFocus="if(this.value == '<?php echo $locationCity; ?>') { this.value = ''; }" onBlur="if(this.value == '') { this.value = '<?php echo $locationCity; ?>'; }"  value="<?php echo $locationCity; ?>" />            
            	<!--
            	<select name="" class="accordion_textbox3">
            	  <option> Santa Ana</option>
            	</select>
            	-->
            </div>
        <div class="clr"></div>
        </div>
        
            <div class="accordion_box">
                <div class="accordion_box_l">Sector(s)</div>
                <div class="accordion_box_r">
                    <select id="txtSector" name="txtSectorCompany" class="js-example-basic-multiple accordion_textbox3" multiple="multiple">
                    <?php

                    $companySectors = unserialize($this->companyInfo->sector);
                    foreach($this->sectorCatalog as $key => $sector) {
                        $selected = "";
                        if ( ! empty($companySectors) && in_array($sector['SECTOR_NAME'], $companySectors)) {
                            $selected = "selected=\"selected\"";
                        }
                    ?>
                        <option value="<?php echo $sector['SECTOR_NAME']; ?>" <?php echo $selected; ?>><?php echo $sector['SECTOR_NAME']; ?></option>
                    <?php
                    }
                    ?>
                    </select>
                </div>
                <div class="clr"></div>
            </div>

        </div>
        
        <div class="accordion_frst">
            <?php
								$socialInfo = unserialize($this->companyInfo->contactDetails);
								$arrayUrls  = array();
								$totalOthers= 0;
								for ($x=0; $x<count($socialInfo);$x++){
										if (strpos(strtolower($socialInfo[$x]),'twitter') === true){
												$arrayUrls['twitter'] = $socialInfo[$x];
										} else if (strpos(strtolower($socialInfo[$x]),'facebook') === true){
												$arrayUrls['facebook'] = $socialInfo[$x];										
										} else if (strpos(strtolower($socialInfo[$x]),'angel.co') === true){
												$arrayUrls['angel'] = $socialInfo[$x];																				
										} else if (strpos(strtolower($socialInfo[$x]),'linkedin') === true){
												$arrayUrls['linkedin'] = $socialInfo[$x];																
										} else {
												$arrayUrls['other'][$totalOthers] = $socialInfo[$x];
												$totalOthers++;
										}
								}
            
            ?>        
        	<h3>Social Media & Contact Information</h3>

            <div class="accordion_box">
    	        <div class="accordion_box_l">Website</div>
      	      <div class="accordion_box_r">
      	      <?php if ($totalOthers > 0) { ?>
        	    	<input name="urlWebsite" type="text" class="accordion_textbox" onFocus="if(this.value == '<?php echo $arrayUrls['other'][0];?>') { this.value = ''; }" onBlur="if(this.value == '') { this.value = '<?php echo $arrayUrls['other'][0];?>'; }"  value="<?php echo $arrayUrls['other'][0];?>" />
        	    <?php } else { ?>
        	    	<input name="urlWebsite" type="text" class="accordion_textbox" onFocus="if(this.value == '') { this.value = ''; }" onBlur="if(this.value == '') { this.value = ''; }"  value="" />        	    
        	    <?php } ?>
          	  </div>
		        	<div class="clr"></div>
		        </div> 
        	
            <div class="accordion_box">
            <div class="accordion_box_l"><img src="/images/social_icon4.jpg" alt=""></div>
            <div class="accordion_box_r">
            <?php if (isset($arrayUrls['linkedin'])) { ?>
            	<input id="urlLinkedin" type="text" class="accordion_textbox" onFocus="if(this.value == '<?php echo $arrayUrls['linkedin'];?>') { this.value = ''; }" onBlur="if(this.value == '') { this.value = '<?php echo $arrayUrls['linkedin'];?>'; }"  value="<?php echo $arrayUrls['linkedin'];?>" />
            <?php } else { ?>
            	<input id="urlLinkedin" type="text" class="accordion_textbox" onFocus="if(this.value == '') { this.value = ''; }" onBlur="if(this.value == '') { this.value = ''; }"  value="" />            
            <?php } ?>
            </div>
        <div class="clr"></div>
        </div>
        	<div class="accordion_box">
            <div class="accordion_box_l"><img src="/images/social_icon5.jpg" alt=""></div>
            <div class="accordion_box_r">
            <?php if (isset($arrayUrls['twitter'])) { ?>
            	<input id="urlTwitter" type="text" class="accordion_textbox" onFocus="if(this.value == '<?php echo $arrayUrls['twitter'];?>') { this.value = ''; }" onBlur="if(this.value == '') { this.value = '<?php echo $arrayUrls['twitter'];?>'; }"  value="<?php echo $arrayUrls['twitter'];?>" />
            <?php } else { ?>
            	<input id="urlTwitter" type="text" class="accordion_textbox" onFocus="if(this.value == '') { this.value = ''; }" onBlur="if(this.value == '') { this.value = ''; }"  value="" />            
            <?php } ?>
            </div>
        <div class="clr"></div>
        </div>
        	<div class="accordion_box">
            <div class="accordion_box_l"><img src="/images/social_icon6.jpg" alt=""></div>
            <div class="accordion_box_r">
            <?php if (isset($arrayUrls['facebook'])) { ?>
            	<input id="urlFacebook" type="text" class="accordion_textbox" onFocus="if(this.value == '<?php echo $arrayUrls['facebook'];?>') { this.value = ''; }" onBlur="if(this.value == '') { this.value = '<?php echo $arrayUrls['facebook'];?>'; }"  value="<?php echo $arrayUrls['facebook'];?>" />
            <?php } else { ?>
            	<input id="urlFacebook" type="text" class="accordion_textbox" onFocus="if(this.value == '') { this.value = ''; }" onBlur="if(this.value == '') { this.value = ''; }"  value="" />            
            <?php } ?>
            </div>
        <div class="clr"></div>
        </div>

        	<div class="accordion_box">
                <div class="accordion_box_l"><img src="/images/social_icon7.jpg" alt=""></div>
                <div class="accordion_box_r">
            <?php if (isset($arrayUrls['angel'])) { ?>
                    <input id="urlAngel" type="text" class="accordion_textbox" onFocus="if(this.value == '<?php echo $arrayUrls['angel'];?>') { this.value = ''; }" onBlur="if(this.value == '') { this.value = '<?php echo $arrayUrls['angel'];?>'; }"  value="<?php echo $arrayUrls['angel'];?>" />
            <?php } else { ?>
            	<input id="urlAngel" type="text" class="accordion_textbox" onFocus="if(this.value == '') { this.value = ''; }" onBlur="if(this.value == '') { this.value = ''; }"  value="" />            
            <?php } ?>
                </div>
                <div class="clr"></div>
            </div>
        <!--
        	<div class="accordion_box">
            <div class="accordion_box_l"><img src="/images/social_icon8.jpg" alt=""></div>
            <div class="accordion_box_r">
            	<input name="" type="text" class="accordion_textbox" onFocus="if(this.value == 'Add another') { this.value = ''; }" onBlur="if(this.value == '') { this.value = 'Add another'; }"  value="Add another" />
            </div>
		        <div class="clr"></div>
        </div>
        -->
            
        </div>
        
        <div class="accordion_sec">
        
        	<h3>How much would you sell your company for?</h3>
            
            <div class="accordion_box">
            <div class="accordion_box_l">Reserve Price ($)</div>
            <div class="accordion_box_r">
            	<input id="txtReservePrice" name="" type="text" class="accordion_textbox" onFocus="if(this.value == '<?php echo $this->reservePrice; ?>') { this.value = ''; }" onBlur="if(this.value == '') { this.value = '<?php echo $this->reservePrice; ?>'; }"  value="<?php echo $this->reservePrice; ?>" />
            </div>
            <div class="clr"></div>
        </div>
        	
            <div class="accordion_box_r4">
            	
                <div class="been_saved_bt">
                	<input id="btnEditCompany" name="" type="button" value="SAVE" class="button_rr" />
                </div>
                
            	<div class="been_saved">
                Your profile has been saved!
                </div>
                
                
                
                <div class="clr"></div>
                </div>
        
        	
        	        	
        	
            
        </div>
        
        
        
      </div>
  
  
  <div id="tabOverview" class="accordion__title">OVERVIEW</div>
  <div class="accordion__content">

    <h3>Quick Facts</h3>

    <div class="accordion_frst">

        <div class="accordion_box">
            <div class="accordion_box_l">Founded (Year)</div>
            <div class="accordion_box_r">
                <input id="txtFounded" name="" type="text" class="accordion_textbox" onFocus="if(this.value == '<?php echo $founded; ?>') { this.value = ''; }" onBlur="if(this.value == '') { this.value = '<?php echo $founded; ?>'; }"  value="<?php echo $founded; ?>" />
            </div>
            <div class="clr"></div>
        </div>

        <div class="accordion_box">
            <div class="accordion_box_l">Main Industry</div>
            <div class="accordion_box_r">
                <select id="txtMainindustry">
                <?php
                $mainIndustry = "";
                $companySectors = unserialize($this->companyInfo->sector);

                foreach($companySectors as $key => $sector) {
                    $selected = "";
                    if ( $mainIndustry == $sector) {
                        $selected = "selected=\"selected\"";
                    }
                ?>
                    <option value="<?php echo $sector; ?>" <?php echo $selected; ?>><?php echo $sector; ?></option>
                <?php
                }
                ?>
                </select>
            </div>
            <div class="clr"></div>
        </div>

        <div class="accordion_box">
            <div class="accordion_box_l">Total Funding ($)</div>
            <div class="accordion_box_r">
                <input id="txtFunding" name="" type="text" class="accordion_textbox" onFocus="if(this.value == '<?php echo $founded; ?>') { this.value = ''; }" onBlur="if(this.value == '') { this.value = '<?php echo $founded; ?>'; }"  value="<?php echo $founded; ?>" />
            </div>
            <div class="clr"></div>
        </div>


        <div class="accordion_box">
            <div class="accordion_box_l">Brief Bio</div>
            <div class="accordion_box_r">
                <textarea id="txtBio" class="accordion_textbox2" onFocus="if(this.value == '<?php echo $bio; ?>') { this.value = ''; }" onBlur="if(this.value == '') { this.value = '<?php echo $bio; ?>'; }"><?php echo $bio; ?></textarea>
            </div>
            <div class="clr"></div>
        </div>

    </div>

    <h3>Product & Technology</h3>

    <div class="accordion_frst">

        <div class="accordion_box">
            <div class="accordion_box_l">Sector(s)</div>
            <div class="accordion_box_r">
                <select id="txtSector" name="txtSectorOverview" class="js-example-basic-multiple" multiple="multiple">
                <?php

                $companySectors = unserialize($this->companyInfo->sector);
                foreach($this->sectorCatalog as $key => $sector) {
                    $selected = "";
                    if ( ! empty($companySectors) && in_array($sector['SECTOR_NAME'], $companySectors)) {
                        $selected = "selected=\"selected\"";
                    }
                ?>
                    <option value="<?php echo $sector['SECTOR_NAME']; ?>" <?php echo $selected; ?>><?php echo $sector['SECTOR_NAME']; ?></option>
                <?php
                }
                ?>
                </select>
            </div>
            <div class="clr"></div>
        </div>

        <div class="accordion_box">
            <div class="accordion_box_l">Description</div>
            <div class="accordion_box_r">
                <textarea id="txtProductDescription" class="accordion_textbox2" onFocus="if(this.value == '<?php echo $bio; ?>') { this.value = ''; }" onBlur="if(this.value == '') { this.value = '<?php echo $bio; ?>'; }"><?php echo $bio; ?></textarea>
            </div>
            <div class="clr"></div>
        </div>

    </div>

    <h3>Marketing & Traction</h3>

    <div class="accordion_frst">

        <div class="accordion_box">
            <div class="accordion_box_l">Customer(s)</div>
            <div class="accordion_box_r">
                <select id="txtCustomer" class="js-example-basic-multiple" multiple="multiple">
                <?php

                $companySectors = unserialize($this->companyInfo->sector);
                foreach($this->sectorCatalog as $key => $sector) {
                    $selected = "";
                    if ( ! empty($companySectors) && in_array($sector['SECTOR_NAME'], $companySectors)) {
                        $selected = "selected=\"selected\"";
                    }
                ?>
                    <option value="<?php echo $sector['SECTOR_NAME']; ?>" <?php echo $selected; ?>><?php echo $sector['SECTOR_NAME']; ?></option>
                <?php
                }
                ?>
                </select>
            </div>
            <div class="clr"></div>
        </div>

        <div class="accordion_box">
            <div class="accordion_box_l">Partner(s)</div>
            <div class="accordion_box_r">
                <select id="txtPartner" class="js-example-basic-multiple" multiple="multiple">
                <?php

                $companySectors = unserialize($this->companyInfo->sector);
                foreach($this->sectorCatalog as $key => $sector) {
                    $selected = "";
                    if ( ! empty($companySectors) && in_array($sector['SECTOR_NAME'], $companySectors)) {
                        $selected = "selected=\"selected\"";
                    }
                ?>
                    <option value="<?php echo $sector['SECTOR_NAME']; ?>" <?php echo $selected; ?>><?php echo $sector['SECTOR_NAME']; ?></option>
                <?php
                }
                ?>
                </select>
            </div>
            <div class="clr"></div>
        </div>

    </div>

    <h3>Company History</h3>

    <div class="accordion_frst">

        <div class="accordion_box">
            <div class="accordion_box_l">Description</div>
            <div class="accordion_box_r">
                <textarea id="txtHistoryDescription" class="accordion_textbox2" onFocus="if(this.value == '<?php echo $bio; ?>') { this.value = ''; }" onBlur="if(this.value == '') { this.value = '<?php echo $bio; ?>'; }"><?php echo $bio; ?></textarea>
            </div>
            <div class="clr"></div>
        </div>

    </div>

    <h3>Founding</h3>

    <div class="accordion_frst">

        <div class="accordion_box">
            <div class="accordion_box_l">Type</div>
            <div class="accordion_box_r">
                <input id="txtFundingType" name="" type="text" class="accordion_textbox" onFocus="if(this.value == '<?php echo $founded; ?>') { this.value = ''; }" onBlur="if(this.value == '') { this.value = '<?php echo $founded; ?>'; }"  value="<?php echo $founded; ?>" />
            </div>
            <div class="clr"></div>
        </div>

        <div class="accordion_box">
            <div class="accordion_box_l">Date</div>
            <div class="accordion_box_r">
                <input id="txtFundingDate" name="" type="text" class="accordion_textbox" onFocus="if(this.value == '<?php echo $founded; ?>') { this.value = ''; }" onBlur="if(this.value == '') { this.value = '<?php echo $founded; ?>'; }"  value="<?php echo $founded; ?>" />
            </div>
            <div class="clr"></div>
        </div>

        <div class="accordion_box">
            <div class="accordion_box_l">Amount ($)</div>
            <div class="accordion_box_r">
                <input id="txtFundingAmount" name="" type="text" class="accordion_textbox" onFocus="if(this.value == '<?php echo $founded; ?>') { this.value = ''; }" onBlur="if(this.value == '') { this.value = '<?php echo $founded; ?>'; }"  value="<?php echo $founded; ?>" />
            </div>
            <div class="clr"></div>
        </div>

        <br/>

        <div class="accordion_box">
            <div class="accordion_box_l">Type</div>
            <div class="accordion_box_r">
                <input id="txtFundingType" name="" type="text" class="accordion_textbox" onFocus="if(this.value == '<?php echo $founded; ?>') { this.value = ''; }" onBlur="if(this.value == '') { this.value = '<?php echo $founded; ?>'; }"  value="<?php echo $founded; ?>" />
            </div>
            <div class="clr"></div>
        </div>

        <div class="accordion_box">
            <div class="accordion_box_l">Date</div>
            <div class="accordion_box_r">
                <input id="txtFundingDate" name="" type="text" class="accordion_textbox" onFocus="if(this.value == '<?php echo $founded; ?>') { this.value = ''; }" onBlur="if(this.value == '') { this.value = '<?php echo $founded; ?>'; }"  value="<?php echo $founded; ?>" />
            </div>
            <div class="clr"></div>
        </div>

        <div class="accordion_box">
            <div class="accordion_box_l">Amount ($)</div>
            <div class="accordion_box_r">
                <input id="txtFundingAmount" name="" type="text" class="accordion_textbox" onFocus="if(this.value == '<?php echo $founded; ?>') { this.value = ''; }" onBlur="if(this.value == '') { this.value = '<?php echo $founded; ?>'; }"  value="<?php echo $founded; ?>" />
            </div>
            <div class="clr"></div>
        </div>

        <div class="accordion_box">
            <div class="accordion_box_l"></div>
            <div class="accordion_box_r"><a href="#" class="addlink">+ Add Funding</a></div>
        </div>

        <br/>

    </div>

    <div class="accordion_sec">

        <h3>Founders</h3>

        <div class="accordion_box">
            <div class="accordion_box_l">Name</div>
            <div class="accordion_box_r">
                <input id="txtFounderName" name="" type="text" class="accordion_textbox" onFocus="if(this.value == '<?php echo $founded; ?>') { this.value = ''; }" onBlur="if(this.value == '') { this.value = '<?php echo $founded; ?>'; }"  value="<?php echo $founded; ?>" />
            </div>
            <div class="clr"></div>
        </div>

        <div class="accordion_box">
            <div class="accordion_box_l">Name</div>
            <div class="accordion_box_r">
                <input id="txtFounderName" name="" type="text" class="accordion_textbox" onFocus="if(this.value == '<?php echo $founded; ?>') { this.value = ''; }" onBlur="if(this.value == '') { this.value = '<?php echo $founded; ?>'; }"  value="<?php echo $founded; ?>" />
            </div>
            <div class="clr"></div>
        </div>

        <div class="accordion_box">
            <div class="accordion_box_l"></div>
            <div class="accordion_box_r"><a href="#" class="addlink">+ Add Funding</a></div>
        </div>

        <div class="accordion_box_r4">
            <div class="been_saved_bt">
                <input id="btnSaveOverview" name="" type="button" value="SAVE" class="button_rr" />
                <!-- <input id="btnEditCompany" name="" type="button" value="SAVE" class="button_rr" /> -->
            </div>
            <div class="been_saved">Your profile has been saved!</div>
            <div class="clr"></div>
        </div>

        <br/>

    </div>

  </div>
  
  <div id="tabAssets" class="accordion__title">ASSETS</div>
  <div class="accordion__content">
    ASSETS
 </div>
 
  <div id="tabDetails" class="accordion__title">DETAILS</div>
  <div class="accordion__content">
    DETAILS
 </div>
 
 <div id="tabSocial" class="accordion__title">SOCIAL</div>
    <div class="accordion__content">
         
            <div class="accordion__content_social_l">
            	<h3>Who You’re Following</h3>
                
                	
                <div class="profiel_l">
                	
                   
                	<div class="profile_main">

                        <div id="tooltip" class="profile_pic">
                        
                        	<img src="/images/profile_pic1.jpg" alt="">
                         	<div class="tooltip" style="display: none;">
                            
                            	<p><img src="/images/profile_pic1.jpg" alt=""></p>
                                <div>
                                    <h4>Mihir Bhanot</h4>
                                    Investor @Shyp
                                </div>
                                <p><input name="" type="button" value="UNFOLLOW" class="button_rr2" /></p>
                                <p class="tooltip_arrow"><img src="/images/tooltip_arrow.png" alt=""></p>
                            </div>
                        </div>
                        
                        <div class="profile_text">
                          	<h5><a href="#">Jimmy Vosika</a></h5>
                            Angel Investor and Founder <br />
                            @ShopJimmy.com
                      </div>
                    
                    <div class="clr"></div>
                    
                    </div>
                    
                    
                    
                    <div class="profile_main">
                    	
                        <div class="profile_pic"><img src="/images/profile_pic2.jpg" alt=""></div>
                      <div class="profile_text">
                          	<h5><a href="#">Evan Cheng</a></h5>
                            Senior Pointy-Haired Boss <br />
                            @Apple
                      </div>
                    
                    <div class="clr"></div>
                    
                    </div>
                
                	<div class="clr4"></div>
                    
               	    <div class="profile_main">
                    	
                        <div class="profile_pic"><img src="/images/profile_pic3.jpg" alt=""></div>
                      <div class="profile_text">
                          	<h5><a href="#">Brad Feld</a></h5>
                            Managing Director at <br />
                            @Foundry Group
                      </div>
                    
                    <div class="clr"></div>
                    
                    </div>
                    
                    <div class="profile_main">
                    	
                        <div class="profile_pic"><img src="/images/profile_pic4.jpg" alt=""></div>
                      <div class="profile_text">
                          	<h5><a href="#">Cameron Johnson</a></h5>
                            Serial Entrepreneur
                      </div>
                    
                    <div class="clr"></div>
                    
                    </div>
                    
                  <div class="clr4"></div>
                    
                    <div class="profile_main">
                    	
                        <div class="profile_pic"><img src="/images/profile_pic5.jpg" alt=""></div>
                      <div class="profile_text">
                          	<h5><a href="#">Geoff Ward</a></h5>
                            Early employee <br />
                            @AgencyPort.
                      </div>
                    
                    <div class="clr"></div>
                    
                    </div>
                    
                    <div class="profile_main">
                    	
                        <div class="profile_pic"><img src="/images/profile_pic6.jpg" alt=""></div>
                      <div class="profile_text">
                          	<h5><a href="#">Mihir Bhanot</a></h5>
                            Investor @Shyp @Mattermark @Transcriptic
                      </div>
                    
                    <div class="clr"></div>
                    
                    </div>
                    
                    <div class="clr4"></div>
                    
                    <div class="profile_main">
                    	
                        <div class="profile_pic"><img src="/images/profile_pic1.jpg" alt=""></div>
                      <div class="profile_text">
                          	<h5><a href="#">Jimmy Vosika</a></h5>
                            Angel Investor and Founder <br />
                            @ShopJimmy.com
                      </div>
                    
                    <div class="clr"></div>
                    
                    </div>
                    
                    <div class="profile_main">
                    	
                        <div class="profile_pic"><img src="/images/profile_pic2.jpg" alt=""></div>
                      <div class="profile_text">
                          	<h5><a href="#">Evan Cheng</a></h5>
                            Senior Pointy-Haired Boss <br />
                            @Apple
                      </div>
                    
                    <div class="clr"></div>
                    
                    </div>
                
                	<div class="clr4"></div>
                    
               	    <div class="profile_main">
                    	
                        <div class="profile_pic"><img src="/images/profile_pic3.jpg" alt=""></div>
                      <div class="profile_text">
                          	<h5><a href="#">Brad Feld</a></h5>
                            Managing Director at <br />
                            @Foundry Group
                      </div>
                    
                    <div class="clr"></div>
                    
                    </div>
                    
                    <div class="profile_main">
                    	
                        <div class="profile_pic"><img src="/images/profile_pic4.jpg" alt=""></div>
                      <div class="profile_text">
                          	<h5><a href="#">Cameron Johnson</a></h5>
                            Serial Entrepreneur
                      </div>
                    
                    <div class="clr"></div>
                    
                    </div>
                    
                    <div class="clr4"></div>
                    
                    <div class="profile_main">
                    	
                        <div class="profile_pic"><img src="/images/profile_pic5.jpg" alt=""></div>
                      <div class="profile_text">
                          	<h5><a href="#">Geoff Ward</a></h5>
                            Early employee <br />
                            @AgencyPort.
                      </div>
                    
                    <div class="clr"></div>
                    
                    </div>
                    
                    <div class="profile_main">
                    	
                        <div class="profile_pic"><img src="/images/profile_pic6.jpg" alt=""></div>
                      <div class="profile_text">
                          	<h5><a href="#">Mihir Bhanot</a></h5>
                            Investor @Shyp @Mattermark @Transcriptic
                      </div>
                    
                    <div class="clr"></div>
                    
                    </div>
                    
                    
                    
                     
                
                <div class="clr"></div>
                </div>
            
            <div class="clr"></div>
            </div>
         
         	<div class="accordion__content_social_r">
            	<h3>Your Followers</h3>
                
              <div class="profiel_r">
                
                	<div class="profile_main">
                    	
                        <div class="profile_pic"><img src="/images/profile_pic1.jpg" alt=""></div>
                      <div class="profile_text">
                          	<h5><a href="#">Jimmy Vosika</a></h5>
                            Angel Investor and Founder <br />
                            @ShopJimmy.com
                      </div>
                    
                    <div class="clr"></div>
                    
                    </div>
                    
                    <div class="profile_main">
                    	
                        <div class="profile_pic"><img src="/images/profile_pic2.jpg" alt=""></div>
                      <div class="profile_text">
                          	<h5><a href="#">Evan Cheng</a></h5>
                            Senior Pointy-Haired Boss <br />
                            @Apple
                      </div>
                    
                    <div class="clr"></div>
                    
                    </div>
                
                	<div class="clr4"></div>
                    
               	    <div class="profile_main">
                    	
                        <div class="profile_pic"><img src="/images/profile_pic3.jpg" alt=""></div>
                      <div class="profile_text">
                          	<h5><a href="#">Brad Feld</a></h5>
                            Managing Director at <br />
                            @Foundry Group
                      </div>
                    
                    <div class="clr"></div>
                    
                    </div>
                    
                    <div class="profile_main">
                    	
                        <div class="profile_pic"><img src="/images/profile_pic4.jpg" alt=""></div>
                      <div class="profile_text">
                          	<h5><a href="#">Cameron Johnson</a></h5>
                            Serial Entrepreneur
                      </div>
                    
                    <div class="clr"></div>
                    
                    </div>
                    
                    <div class="clr4"></div>
                    
                    <div class="profile_main">
                    	
                        <div class="profile_pic"><img src="/images/profile_pic5.jpg" alt=""></div>
                      <div class="profile_text">
                          	<h5><a href="#">Geoff Ward</a></h5>
                            Early employee <br />
                            @AgencyPort.
                      </div>
                    
                    <div class="clr"></div>
                    
                    </div>
                    
                    <div class="profile_main">
                    	
                        <div class="profile_pic"><img src="/images/profile_pic6.jpg" alt=""></div>
                      <div class="profile_text">
                          	<h5><a href="#">Mihir Bhanot</a></h5>
                            Investor @Shyp @Mattermark @Transcriptic
                      </div>
                    
                    <div class="clr"></div>
                    
                    </div>
                    
                    <div class="clr4"></div>
                    
                    <div class="profile_main">
                    	
                        <div class="profile_pic"><img src="/images/profile_pic1.jpg" alt=""></div>
                      <div class="profile_text">
                          	<h5><a href="#">Jimmy Vosika</a></h5>
                            Angel Investor and Founder <br />
                            @ShopJimmy.com
                      </div>
                    
                    <div class="clr"></div>
                    
                    </div>
                    
                    <div class="profile_main">
                    	
                        <div class="profile_pic"><img src="/images/profile_pic2.jpg" alt=""></div>
                      <div class="profile_text">
                          	<h5><a href="#">Evan Cheng</a></h5>
                            Senior Pointy-Haired Boss <br />
                            @Apple
                      </div>
                    
                    <div class="clr"></div>
                    
                    </div>
                
                	<div class="clr4"></div>
                    
               	    <div class="profile_main">
                    	
                        <div class="profile_pic"><img src="/images/profile_pic3.jpg" alt=""></div>
                      <div class="profile_text">
                          	<h5><a href="#">Brad Feld</a></h5>
                            Managing Director at <br />
                            @Foundry Group
                      </div>
                    
                    <div class="clr"></div>
                    
                    </div>
                    
                    <div class="profile_main">
                    	
                        <div class="profile_pic"><img src="/images/profile_pic4.jpg" alt=""></div>
                      <div class="profile_text">
                          	<h5><a href="#">Cameron Johnson</a></h5>
                            Serial Entrepreneur
                      </div>
                    
                    <div class="clr"></div>
                    
                    </div>
                    
                    <div class="clr4"></div>
                    
                    <div class="profile_main">
                    	
                        <div class="profile_pic"><img src="/images/profile_pic5.jpg" alt=""></div>
                      <div class="profile_text">
                          	<h5><a href="#">Geoff Ward</a></h5>
                            Early employee <br />
                            @AgencyPort.
                      </div>
                    
                    <div class="clr"></div>
                    
                    </div>
                    
                    <div class="profile_main">
                    	
                        <div class="profile_pic"><img src="/images/profile_pic6.jpg" alt=""></div>
                      <div class="profile_text">
                          	<h5><a href="#">Mihir Bhanot</a></h5>
                            Investor @Shyp @Mattermark @Transcriptic
                      </div>
                    
                    <div class="clr"></div>
                    
                    </div>
                    
                    
                    
                     
                
                <div class="clr"></div>
                </div>
                
            </div>
         
         <div class="clr"></div>
         
         <div class="beensaved2">
         	<div class="accordion_box_r5">
            	
                <div class="been_saved_bt">
                	<input name="" type="button" value="SAVE" class="button_rr" />
                </div>
                
            	<div class="been_saved">
                Your profile has been saved!
                </div>
                
                
                
                <div class="clr"></div>
                </div>
         </div>
         
         	<div class="loading"><img src="/images/loading.jpg" alt=""></div>
         </div>
 </div>
        
    	<div class="clr"></div>
    </div>

 
		<form>
		<table>
			<tr>
				<td>Fund Current</td>
				<td> <input type="text" size="100" id="fundCurrent" value="<?php echo $this->companyInfo->fundCurrent; ?>"></td>
			</tr>

			<tr>
				<td>Fund Past</td>
				<td> <input type="text" size="100" id="fundPast" value="<?php echo $this->companyInfo->fundPast; ?>"> </td>
			</tr>

			<tr>
				<td>One Liner</td>
				<td> <input type="text" size="100" id="oneLiner" value="<?php echo $this->companyInfo->oneLiner; ?>"> </td>
			</tr>

			<tr>
				<td valign="top">Investors</td>
				<td> 
					<?php
							$investors = unserialize($this->companyInfo->investorNames);
							for ($x=0; $x<count($investors);$x++){
									echo "<li>" . trim($investors[$x])  . " </li> \n";
							}
					?>
				</td>
			</tr>	

			<tr>
				<td valign="top">Cities</td>
				<td valign="top"> 
					<?php
							$city = unserialize($this->companyInfo->city);
							for ($x=0; $x<count($city);$x++){
									echo "<li>" . trim($city[$x])  . " </li> \n";														
							}
					?>
				</td>
			</tr>
	
			<tr>
				<td valign="top">Product Description</td>
				<td valign="top">  
					<?php
							$product = unserialize($this->companyInfo->productDescription);
							for ($x=0; $x<count($product);$x++){
									echo "<li>" . trim($product[$x]) . "</li> \n";
							}
					?>
				</td>
			</tr>	

			<tr>
				<td valign="top">Technology</td>
				<td valign="top">  
					<?php
							$technology = unserialize($this->companyInfo->technology);
							for ($x=0; $x<count($technology);$x++){
									echo "<li>" . trim($technology[$x]) . " </li>\n";
							}
					?>
				</td>
			</tr>	

			<tr>
				<td valign="top">Specialties</td>
				<td valign="top">  
					<?php
							$specialties = unserialize($this->companyInfo->specialties);
							for ($x=0; $x<count($specialties);$x++){
									echo "<li>" . trim($specialties[$x]) . " </li>\n";
							}
					?>
				</td>
			</tr>	
	
			<tr>
				<td valign="top">Traction</td>
				<td valign="top">  
					<?php
							$traction = unserialize($this->companyInfo->traction);
							for ($x=0; $x<count($traction);$x++){
									echo "<li>" . trim($traction[$x]) . " </li> \n";
							}
					?>
				</td>
			</tr>	
	
			<tr>
				<td valign="top">Founders</td>
				<td valign="top"> 
					<?php
							$founders = unserialize($this->companyInfo->founders);
							for ($x=0; $x<count($founders);$x++){
									echo "<li>";
									echo "<b>Profile URL:" . $founders[$x]['profileUrl'] . "</b><br />";
									echo $founders[$x]['text'] . "<br />";							
									echo $founders[$x]['name'] . "<br />";														
									echo "</li><br />";
							}
					?>
				</td>
			</tr>	
	
			<tr>
				<td valign="top">Sector</td>
				<td valign="top"> 
					<?php
							$sector = unserialize($this->companyInfo->sector);
							for ($x=0; $x<count($sector);$x++){
									echo "<li>" . trim($sector[$x]) . " </li>\n";
							}
					?>
				</td>
			</tr>	
	
			<tr>
				<td valign="top">Customers</td>
				<td valign="top">  
					<?php
							$customers = unserialize($this->companyInfo->customers);
							for ($x=0; $x<count($customers);$x++){
									echo "<li>" . trim($customers[$x]) . "</li> \n";
							}
					?>
				</td>
			</tr>	
	
			<tr>
				<td valign="top">Advisors</td>
				<td valign="top"> 
					<?php
							$advisors = unserialize($this->companyInfo->advisors);
							for ($x=0; $x<count($advisors);$x++){
									echo "<li>";
									echo "<b>Name:" . $advisors[$x]['Name'] . "</b><br />";
									echo $advisors[$x]['Descr'];							
									echo "</li><br />";
							}
					?>
				</td>
			</tr>	
	
			<tr>
				<td valign="top">Incubators</td>
				<td valign="top"> 
					<?php
							$incubators = unserialize($this->companyInfo->incubators);
							for ($x=0; $x<count($incubators);$x++){
									echo "<li>" . trim($incubators[$x]) . " </li>\n";
							}
					?>
				</td>
			</tr>	

			<tr>
				<td valign="top">Press</td>
				<td valign="top">  
					<?php
							$press = unserialize($this->companyInfo->press);
							for ($x=0; $x<count($press);$x++){
									echo "<li>";
									echo $press[$x]['url'] . "<br />";
									echo $press[$x]['snippet']."<br />";							
									echo $press[$x]['posted_at']."<br />";														
									echo $press[$x]['title']."<br />";																					
									echo "</li><br />";
							}
					?>
				</td>
			</tr>	
	
			<tr>
				<td valign="top">More Info</td>
				<td valign="top"> 
					<?php
							$moreInfo = unserialize($this->companyInfo->moreInfo);
							for ($x=0; $x<count($moreInfo);$x++){
									echo "<li>" . trim($moreInfo[$x]) . " </li>\n";
								}
					?>
				</td>
			</tr>	
	
			<tr>
				<td valign="top">Current Investors</td>
				<td valign="top">  
					<?php
							$currentInvestors = unserialize($this->companyInfo->currentInvestors);
							for ($x=0; $x<count($currentInvestors);$x++){
									echo "<li>" .  trim($currentInvestors[$x]) . " </li>\n";
							}
					?>
				</td>
			</tr>	
	
			<tr>
				<td valign="top">Attorneys</td>
				<td valign="top"> 
					<?php
							$attorneys = unserialize($this->companyInfo->attorneys);
							for ($x=0; $x<count($attorneys);$x++){
									echo "<li>";
									echo "<b>" . $attorneys[$x]['Name'] . "</b><br />";
									echo $attorneys[$x]['Descr'];
									echo "</li><br />";
							}
					?>
				</td>
			</tr>	
	
			<tr>
				<td valign="top">Employees</td>
				<td valign="top">  
					<?php
                            $employees = unserialize($this->companyInfo->employees);
							for ($x=0; $x<count($employees);$x++){
									echo "<li>";
									echo "<b>" . $employees[$x]['Name'] . "</b><br />";
									echo $employees[$x]['description'];
									echo "</li><br />";
							}
					?>	
				</td>
			</tr>	
	
			<tr>
				<td valign="top">Contact Details</td>
				<td valign="top">  
					<?php
							$contactDetails = $this->companyInfo->contactDetails;
							for ($x=0; $x<count($contactDetails);$x++){
									echo "<li>";
									print_r($contactDetails[$x]);
									echo "</li>";
								}
					?>
				</td>
			</tr>	
		</table>


</div>



</div>

<!--END BODY SECTION -->


<?php
    hoho\fwk\Fwk_JsEnqueuer::getInstance()->enqueue(JS_FILE, "/js/company.js");
    hoho\fwk\Fwk_JsEnqueuer::getInstance()->enqueue(JS_FILE, "/js/dropzone.js");
    hoho\fwk\Fwk_JsEnqueuer::getInstance()->enqueue(JS_FILE, "/js/select2/select2.min.js");
?>
<script>
if($(window).width() > 768){

// Hide all but first tab content on larger viewports
$('.accordion__content:not(:first)').hide();

// Activate first tab
$('.accordion__title:first-child').addClass('active');

} else {
  
// Hide all content items on narrow viewports
$('.accordion__content').hide();
};

// Wrap a div around content to create a scrolling container which we're going to use on narrow viewports
$( ".accordion__content" ).wrapInner( "<div class='overflow-scrolling'></div>" );

// The clicking action
$('.accordion__title').on('click', function() {
    $('.accordion__content').hide();
    $(this).next().show().prev().addClass('active').siblings().removeClass('active');
    
    if ($(this).attr("id") == 'tabOverview') {
        $('select[name=txtSectorCompany]').attr("id", "txtSectorDisabled"); 
        $('select[name=txtSectorCompany]').attr("disabled", "disabled"); 
        $('select[name=txtSectorCompany]').hide();
    }
});

$(document).ready(function() {

    $(".js-example-basic-multiple").select2();

    Dropzone.autoDiscover = false;

    var myDropzone = new Dropzone('#company_drag_drop', {
        paramName: 'companyLogo',
        url: "/profile/uploadCompanyLogoUrl",
        dictDefaultMessage: "Drag your images or click here",
        maxFiles: 1,
        maxFilesize: 2,
        clickable: true,
        autoProcessQueue: true,
        addRemoveLinks: true,
        dictRemoveFile: "Remove image",
        init: function() {
            var thisDropzone = this;
            var fileName = "<?php echo $this->companyInfo->logoUrl; ?>";
            if (fileName != "") {
                $.getJSON('/profile/loadCompanyLogoUrl', {file: fileName}, function(data) {
                    $.each(data, function(key, value) {
                        var mockFile = { name: value.name, size: value.size };
                        thisDropzone.options.addedfile.call(thisDropzone, mockFile);
                        thisDropzone.options.thumbnail.call(thisDropzone, mockFile, value.full_name);
                    });
                });
            }
        }
    });

    myDropzone.on("complete", function(file) {
        var path = '<?php echo $this->photoPath; ?>';
        var value = path + file.name;
        $('#txtLogoUrl').val(value);
    });

    myDropzone.on("reset", function(file) {
        var value = "";
        $('#txtLogoUrl').val(value);
    });
});
</script>

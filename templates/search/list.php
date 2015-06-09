<div class="body_section">

<div class="body_common_section">
    
    <div class="search_section">
   		<div class="keyword">
            	<div class="keyword_top">
                	<div class="keyword_top_l">
                    	<ul>
                        
                        	<li><a href="#"><img src="/images/search.png" alt=""></a></li>
                            
                            <li><div class="hidetab" id="hider">KEYWORD <a href="#" ><img src="/images/cross.jpg" alt=""></a></div></li>
                            <li><div class="hidetab2" id="hider2">KEYWORD <a href="#"><img src="/images/cross.jpg" alt=""></a></div></li>
                            <li><div class="hidetab3" id="hider3">KEYWORD <a href="#" ><img src="/images/cross.jpg" alt=""></a></div></li>
                            
                        </ul>
                    
                    <div class="clr"></div>
                    </div>
                    
                    <div class="keyword_top_r"><a href="#">CLEAR ALL</a></div>
                <div class="clr"></div>
                
               
                
                </div>
            	
          <div class="search_box">
          			 <div class="accordion_example2">
                    <div class="accordion_in2 acc_active">
                    <div class="acc_head2"></div>
                    <div class="search_box_l"><input name="" type="text" class="search_textbox2" onFocus="if(this.value == 'ENTER A KEYWORD') { this.value = ''; }" onBlur="if(this.value == '') { this.value = 'ENTER A KEYWORD'; }"  value="<?php echo $this->keyword; ?>"></div>
                </div>
                	</div>
                 
                 <div class="clr"></div>
          </div>
        </div>
            
            <div id="search_b2">
            	<ul>
                	<li><a href="#">LOCATION</a></li>
                    <li><a href="#">SECTOR</a></li>
                    <li><a href="#">TEAM</a></li>
                    <li><a href="#">FUNDING</a></li>
                    <li><a href="#">TECH</a></li>
                    <li><a href="#">ASSETS</a></li>
                    <li><a href="#">TRACTION</a></li>
                    <li><a href="#">MARKETING</a></li>
                    <li><a href="#">PRODUCT</a></li>
                </ul>
                
            <div class="clr"></div>
            </div>
    
    </div>
    
    <?php echo $this->totalResults; ?> results found
    
    <section class="search_section_details">
    	
        <div class="search_section_tit">
        	
            <div class="search_section_tit_a">COMPANY </div>
            <div class="search_section_tit_b">ASSETS</div>
            <div class="search_section_tit_c">LOCATION</div>
            <div class="search_section_tit_d">SECTOR</div>
            <div class="search_section_tit_e">TEAM</div>
            <div class="search_section_tit_f">FUNDING</div>
            
        
        <div class="clr"></div>
        </div>
        
        <?php foreach($this->resultsList as $item){
        //for ($x=0; $x< count($this->resultsList);$x++) { ?>
        <div class="search_section_con">
        
        	   <div class="search_section_con_a">
                   	<div class="search_section_tit_a_l"><img src="<?php echo $item->_source->logo; ?>" height="50" width="50"></div>
                    <div class="search_section_tit_a_r">
                    <h4><a href="/profile/viewcompany?cid=<?php echo $item->_id; ?>"><?php echo $item->_source->name; ?></a></h4>
										<p><?php //echo $this->resultsList[$x]['ONE_LINER']; ?></p>
                    </div>
                
                </div>
               <div class="search_section_con_b">
                	<h4><?php echo $item->_source->assets; ?> Assets Total</h4>
                	<!--
                    <h5>Asset Name </h5>
                    <p>Brief assset description...</p>
                    <h5>Asset Name</h5>
                    <p>Brief assset description...</p>
                  -->
          </div>
               <div class="search_section_con_c"> 
									 <?php echo $item->_source->location;
									 /*
											 $city = unserialize($this->resultsList[$x]['CITY']);
									 		 if (count($city) > 0) {
											 for ($y=0; $y<count($city);$y++){
													 if ($y > 0){
														 echo "<br />";
													 }
													 echo trim($city[$y]);														
											 }
											 } else {
											 	echo "-";
											 } */
									 ?>
               </div>
               <div class="search_section_con_d"> 
               <?php  /*
									 $sector = unserialize($this->resultsList[$x]['SECTOR']);
									 if (count($sector) > 0) {
									 for ($y=0; $y<count($sector);$y++){
											 if ($y > 0){
												 echo ", ";
											 }
											 echo trim($sector[$y]);
									 }
									 } else {
										echo "-";
									 }			 */						 
							?>
			          </div>
               <div class="search_section_con_e"> 
               <?php
               	echo $item->_source->employees;
               /*
									 $employees = unserialize($this->resultsList[$x]['EMPLOYEES']);               
									 $teamTotal = count($employees);
									 switch ($teamTotal){
									 	case 0:
									 		echo '-';
									 		break;
									 	case in_array($teamTotal, range(1,10)):
									 		echo '1-10';
									 		break;		
									 	case in_array($teamTotal, range(11,50)):
									 		echo '10-50';
									 		break;		
									 	case in_array($teamTotal, range(51,100)):
									 		echo '5-100';
									 		break;		
										default:
											echo '> 100';
											break;
									 } */
							?>		 
               </div>
               <div class="search_section_con_f"> <?php //echo $this->resultsList[$x]['FUNDRAISING_CURRENT']; ?></div>
                
        <div class="clr"></div> 
        </div>
        <?php } ?>
        
            <?php echo $this->renderSubModule('generic/paging');?>
   
   	<div class="clr"></div> 
    </section>
    
</div>



</div>
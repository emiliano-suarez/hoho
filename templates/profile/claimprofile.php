<section class="main-landing-about-info">
	<div class="container">

		 <h3>Claim your Personal Profile Process</h3>

	 <?php 
	 if ($this->hasInfo){
		 if ($this->totalFounders > 0) { ?>
		 <b>Are you one of these people?</b>
		 <br /><br />
		 <select id="sPeople">
		 <?php	
				 foreach ($this->founders as $founder){ ?>
					 <option value="<?php echo $founder->id; ?>"><?php echo $founder->founderName; ?> ( <?php echo $founder->companyName; ?> )</option> 
	
		 <?php  } ?>
		 </select>

		 <br /><br />
		 <input type="button" id="btnYes" value="Yes!"> 
		 <input type="button" id="btnNo" value="No :("> 
		 <!--<input type="button" id="btnBack" value="Go Back"> -->

	 <?php  
			 } 
				else  {  ?>
		
			 Seems like we can't find this information. Please contact us <b>admin@hoho.ly</b> to claim your personal profile!.

	 <?php  }  
			 }
		 else {	?>
		 We're sorry... it's not possible to claim this profile !

	 <?php  } ?>

	</div>
</section>	

	 <?php hoho\fwk\Fwk_JsEnqueuer::getInstance()->enqueue(JS_FILE, "/js/profile.js"); ?>
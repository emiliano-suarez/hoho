	<h3>Claim your Company Profile Process</h3>

<?php 
if ($this->hasInfo){
	if ($view->totalFounders > 0) { ?>
	<b>Are you one of these people?</b>
	<br /><br />
	<select id="sPeople">
	<?php	for ($x=0;$x<count($this->founders);$x++){ ?>
						<option value="<?php echo $this->founders[$x]['name']; ?>"><?php echo $this->founders[$x]['name']; ?></option> 
	
		<?php  } ?>
	</select>

	<br /><br />
	<input type="button" id="btnYes" value="Yes!"> 
	<input type="button" id="btnNo" value="No :("> 
	<input type="button" id="btnBack" value="Go Back"> 

<?php  
		} 
		 else  {  ?>
		
		Seems like we can't find this information. Please contact us [place email-address here] to claim your company profile!.

<?php  }  
		}
	else {	?>
	We're sorry... it's not possible to claim this profile !
<br />

<input type="button" id="btnBack" value="Go Back"> 
<?php  } ?>

<?php hoho\fwk\Fwk_JsEnqueuer::getInstance()->enqueue(JS_FILE, "/js/profile.js"); ?>
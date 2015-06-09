<html>
  <body>
    <h3><?php echo $this->message; ?></h3>
  <form id="testForm" />
	<table>
		<tr><td><?php echo _('Nick'); ?>: </td><td><input type="text" id="txtNick" size="50" value=""></td></tr>
		<tr><td><?php echo _('Email Address'); ?>: </td><td><input type="text" id="txtEmailAddress" size="50" value=""></td></tr>
		<tr><td><?php echo _('First Name'); ?>: </td><td>
		<input type="text" name="txtFirstName" id="txtFirstName" size="50" value="" placeholder="First Name" 
		validation="required length" minlength="1" maxlength="40" >
		</td></tr>
		<tr><td><?php echo _('Last Name'); ?>: </td><td><input type="text" id="txtLastName" size="50" value=""></td></tr>
		<tr><td><?php echo _('Company'); ?>: </td><td><input type="text" id="txtCompany" size="50" value=""></td></tr>		
		<tr><td><?php echo _('Password'); ?>: </td><td><input type="password" id="txtPwd1" size="50" value=""></td></tr>		
		<tr><td><?php echo _('Confirm Password'); ?>: </td><td><input type="password" id="txtPwd2" size="50" value=""></td></tr>
		<tr><td><?php echo _('Choose your plan'); ?>:</td>
			<td><select id="txtPlan">
				<?php foreach($this->plans as $planItem) { 
						echo "<option value='" . $planItem->id . "'>" . $planItem->name . "</option>";
				 	 }
				?>
				</select>
			</td>
		</tr>		
		<tr><td colspan=2><input type="button"  id="btnSubmit" value="<?php echo _('Submit'); ?>"></td></tr>		
	</table>	
	<div id="signupActionStatus"></div>
	</form>

<?php hoho\fwk\Fwk_JsEnqueuer::getInstance()->enqueue(JS_FILE, "/js/signup.js"); ?>  </body>  
</html>
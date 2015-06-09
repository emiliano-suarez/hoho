<h3>New Company Form</h3>

<form id="company_form">
<table>
	<tr>
		<td>Company Name</td><td><input type="text" id="txtCompanyName" size="50" maxlength="50"></td>
	</tr>	
	<tr>
		<td>One Liner</td><td><textarea id="txtOneLiner" rows="2" cols="50"></textarea></td>
	</tr>		
	<tr>
		<td>Sector</td><td><textarea id="txtSector" rows="5" cols="150"></textarea></td>
	</tr>		

	<tr>
		<td>Location</td><td><textarea id="txtLocation" rows="5" cols="150"></textarea></td>
	</tr>				
	
	<tr>
		<td>Number of employees</td>
			<td>
				<select id="txtNumberEmployees">
					<option value="1">5 or less</option>
					<option value="2">5 to to 10</option>
					<option value="3">10 to 25</option>
					<option value="4">more than 25</option>															
				</select>
			</td>
	</tr>			
</table>

<br /><br />
<input type="button" id="btnAddNewCompany" value="Submit">
</form>
<br /><br />
[<a href="/user/company">Back</a>]

<?php hoho\fwk\Fwk_JsEnqueuer::getInstance()->enqueue(JS_FILE, "/js/company.js"); ?>

<h3>New Asset Form</h3> 

<?php if ($this->showForm === false) { ?>

	<br /><br />
	<li>Can't create new asset, invalid asset type selected</li>
	
	<br /><br />
	<a href="/user/myaccount">Back To My Profile Page</a>

<?php } else {?>

<table>
	<tr>
		<td>Name: </td> 
			<td><input type="text" size="50" maxlength="200" id="asset_name"></td>
	</tr>


	<tr>
		<td>Asset Type: </td> <td><?php echo $this->newType; ?></td>
		<input type="hidden" value="<?php echo $this->newType; ?>" id="assetType">
	</tr>

	<tr>
		<td>Company Related: </td> 
		<td> <select id="sCompany">
	 <?php for ($x=0; $x<count($_SESSION['companies']); $x++){  ?>
			 <option value="<?php echo $_SESSION['companies'][$x]['id']; ?>"><?php echo $_SESSION['companies'][$x]['name']; ?></option>			 
	 <?php } ?> 	
				</select>
		</td>
	</tr>



<?php switch ($this->newType) {
	 case 'technology':  ?>

	<tr>
		<td>Description: </td> 
			<td><input type="text" size="50" maxlength="200" id="asset_1"></td>
	</tr>

	<tr>
		<td>Why Is it Interesting?: </td> 
			<td><input type="text" size="50" maxlength="200" id="asset_2"></td>
	</tr>

	<tr>
		<td>Useful For: </td> 
			<td><input type="text" size="50" maxlength="200" id="asset_3"></td>
	</tr>

	<tr>
		<td>Specs: </td> 
			<td><input type="text" size="50" maxlength="200" id="asset_4"></td>
	</tr>

	<tr>
		<td>IP/Patent: </td> 
			<td><input type="text" size="50" maxlength="200" id="asset_5"></td>
	</tr>

	<tr>
		<td>Give an example/applications of how it can be used: </td> 
			<td><input type="text" size="50" maxlength="200" id="asset_6"></td>
	</tr>

	<tr>
		<td>Status: </td> 
			<td>
                <select id="sStatus">
                    <option value="for_sale">For Sale</option>
                    <option value="for_exchange">For Exchange</option>
                    <option value="for_lease">For Lease</option>
                </select>
			</td>
	</tr>

	<tr>
		<td>Info: </td> 
			<td><input type="text" size="50" maxlength="200" id="asset_8"></td>
	</tr>

			<input type="hidden" id="asset_7" value="">
		 <?php
		 break;
	 case 'data': ?>
	<tr>
		<td>Description: </td> 
			<td><input type="text" size="50" maxlength="200" id="asset_1"></td>
	</tr>

	<tr>
		<td>Why Is it Interesting?: </td> 
			<td><input type="text" size="50" maxlength="200" id="asset_2"></td>
	</tr>

	<tr>
		<td>Useful For: </td> 
			<td><input type="text" size="50" maxlength="200" id="asset_3"></td>
	</tr>

	<tr>
		<td>Specs: </td> 
			<td><input type="text" size="50" maxlength="200" id="asset_4"></td>
	</tr>

    <tr>
        <td>Status: </td> 
            <td>
                <select id="sStatus">
                    <option value="for_sale">For Sale</option>
                    <option value="for_exchange">For Exchange</option>
                    <option value="for_lease">For Lease</option>
                </select>
            </td>
    </tr>

    <tr>
        <td>Info: </td> 
            <td><input type="text" size="50" maxlength="200" id="asset_8"></td>
    </tr>

			<input type="hidden" id="asset_5" value="">
			<input type="hidden" id="asset_6" value="">
			<input type="hidden" id="asset_7" value="">						
		 <?php
		 break;                        		
	 case 'client': ?>
	<tr>
		<td>Description: </td> 
			<td><input type="text" size="50" maxlength="200" id="asset_1"></td>
	</tr>

	<tr>
		<td>Size: </td> 
			<td><input type="text" size="50" maxlength="200" id="asset_2"></td>
	</tr>

	<tr>
		<td>Engagement: </td> 
			<td><input type="text" size="50" maxlength="200" id="asset_3"></td>
	</tr>

	<tr>
		<td>Growth: </td> 
			<td><input type="text" size="50" maxlength="200" id="asset_4"></td>
	</tr>

	<tr>
		<td>Financial Information: </td> 
			<td><input type="text" size="50" maxlength="200" id="asset_5"></td>
	</tr>

    <tr>
        <td>Status: </td> 
            <td>
                <select id="sStatus">
                    <option value="for_sale">For Sale</option>
                    <option value="for_exchange">For Exchange</option>
                    <option value="for_lease">For Lease</option>
                </select>
            </td>
    </tr>

    <tr>
        <td>Info: </td> 
            <td><input type="text" size="50" maxlength="200" id="asset_8"></td>
    </tr>

			<input type="hidden" id="asset_6" value="">
			<input type="hidden" id="asset_7" value="">					
		 <?php
		 break;     
		                    		
	 case 'user': ?>
	<tr>
		<td>Description: </td> 
			<td><input type="text" size="50" maxlength="200" id="asset_1"></td>
	</tr>

	<tr>
		<td>Size & Location: </td> 
			<td><input type="text" size="50" maxlength="200" id="asset_2"></td>
	</tr>

	<tr>
		<td>Engagement: </td> 
			<td><input type="text" size="50" maxlength="200" id="asset_3"></td>
	</tr>

	<tr>
		<td>Growth: </td> 
			<td><input type="text" size="50" maxlength="200" id="asset_4"></td>
	</tr>

    <tr>
        <td>Status: </td> 
            <td>
                <select id="sStatus">
                    <option value="for_sale">For Sale</option>
                    <option value="for_exchange">For Exchange</option>
                    <option value="for_lease">For Lease</option>
                </select>
            </td>
    </tr>

    <tr>
        <td>Info: </td> 
            <td><input type="text" size="50" maxlength="200" id="asset_8"></td>
    </tr>

			<input type="hidden" id="asset_5" value="">
			<input type="hidden" id="asset_6" value="">
			<input type="hidden" id="asset_7" value="">						
		 <?php
		 break;                        		
	 case 'branding': ?>
	<tr>
		<td>Description: </td> 
			<td><input type="text" size="50" maxlength="200" id="asset_1"></td>
	</tr>

	<tr>
		<td>Images: </td> 
			<td><input type="text" size="50" maxlength="200" id="asset_2"></td>
	</tr>

	<tr>
		<td>Unique/Cool: </td> 
			<td><input type="text" size="50" maxlength="200" id="asset_3"></td>
	</tr>

	<tr>
		<td>New Or Recognized: </td> 
			<td><input type="text" size="50" maxlength="200" id="asset_4"></td>
	</tr>

	<tr>
		<td>Target Audience: </td> 
			<td><input type="text" size="50" maxlength="200" id="asset_5"></td>
	</tr>

	<tr>
		<td>Price: </td> 
			<td><input type="text" size="50" maxlength="200" id="asset_6"></td>
	</tr>

    <tr>
        <td>Status: </td> 
            <td>
                <select id="sStatus">
                    <option value="for_sale">For Sale</option>
                    <option value="for_exchange">For Exchange</option>
                    <option value="for_lease">For Lease</option>
                </select>
            </td>
    </tr>

    <tr>
        <td>Info: </td> 
            <td><input type="text" size="50" maxlength="200" id="asset_8"></td>
    </tr>

			<input type="hidden" id="asset_7" value="">						                           			
		 <?php
		 break;                        		
	 case 'team': ?>
	<tr>
		<td>Name And Position: </td> 
			<td><input type="text" size="50" maxlength="200" id="asset_1"></td>
	</tr>

	<tr>
		<td>Expertise: </td> 
			<td><input type="text" size="50" maxlength="200" id="asset_2"></td>
	</tr>

	<tr>
		<td>Strengths: </td> 
			<td><input type="text" size="50" maxlength="200" id="asset_3"></td>
	</tr>

	<tr>
		<td>Availability: </td> 
			<td><input type="text" size="50" maxlength="200" id="asset_4"></td>
	</tr>

    <tr>
        <td>Status: </td> 
            <td>
                <select id="sStatus">
                    <option value="for_sale">For Sale</option>
                    <option value="for_exchange">For Exchange</option>
                    <option value="for_lease">For Lease</option>
                </select>
            </td>
    </tr>

    <tr>
        <td>Info: </td> 
            <td><input type="text" size="50" maxlength="200" id="asset_8"></td>
    </tr>

			<input type="hidden" id="asset_5" value="">
			<input type="hidden" id="asset_6" value="">
			<input type="hidden" id="asset_7" value="">					

		 <?php
		 break;                        		
	 case 'offices':  ?>
	<tr>
		<td>Description: </td> 
			<td><input type="text" size="50" maxlength="200" id="asset_1"></td>
	</tr>

	<tr>
		<td>Location: </td> 
			<td><input type="text" size="50" maxlength="200" id="asset_2"></td>
	</tr>

	<tr>
		<td>Size: </td> 
			<td><input type="text" size="50" maxlength="200" id="asset_3"></td>
	</tr>

	<tr>
		<td>Type: </td> 
			<td><input type="text" size="50" maxlength="200" id="asset_4"></td>
	</tr>

	<tr>
		<td>Availability: </td> 
			<td><input type="text" size="50" maxlength="200" id="asset_5"></td>
	</tr>

	<tr>
		<td>Price: </td> 
			<td><input type="text" size="50" maxlength="200" id="asset_6"></td>
	</tr>                                    																														
	<tr>
		<td>Looking For: </td> 
			<td><input type="text" size="50" maxlength="200" id="asset_7"></td>
	</tr>

    <tr>
        <td>Status: </td> 
            <td>
                <select id="sStatus">
                    <option value="for_sale">For Sale</option>
                    <option value="for_exchange">For Exchange</option>
                    <option value="for_lease">For Lease</option>
                </select>
            </td>
    </tr>

    <tr>
        <td>Info: </td> 
            <td><input type="text" size="50" maxlength="200" id="asset_8"></td>
    </tr>


		 <?php
		 break;                        		
		 
} ?>    			


	
</table>
<br /><input type="button" value="Submit" id="btnAssetNew">

[<a href="/assets/listall">Back</a>]

<?php } ?>
<?php hoho\fwk\Fwk_JsEnqueuer::getInstance()->enqueue(JS_FILE, "/js/assets.js"); ?>

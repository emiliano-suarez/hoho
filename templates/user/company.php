<h3>My Company Profiles</h3>

<br /><br />
<li><a href="/profile/claimcompany">Claim company profile</a></li>
<li><a href="/company/addnewform">Create New Company</a></li> 
<hr />
<h4>My Companies</h4>
<br />
<?php
        for ($x=0; $x<count($this->companies);$x++){ ?>
					<li><?php echo $this->companies[$x]['COMPANY_NAME']; ?> 
						[<a href="/profile/editcompany?cid=<?php echo $this->companies[$x]['COMPANY_PROFILE_ID']; ?>">Edit</a>]
					</li>
<?php }?>

<br /><br />
[<a href="/user/myaccount">Back To My Profile</a>]
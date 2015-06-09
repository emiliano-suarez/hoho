<?php if ($this->newUser) { ?>

  <h3>Your new HOHO profile is ready!</h3>

	
	<br /><br />
	
	<li>Click <a href="/login">here</a> to start browsing the site now!</li>

<?php } else { ?>

  <h3>Claim your Company Profile :: Process End</h3>

 <li><?php echo $this->displayMessage; ?></li>
 
  <br /><br />
  <?php
        if (isset($this->hasInfo)){
                if ($this->hasInfo == false){
                        echo "We are sorry but it seems you are not related to this company in any way...!";
                        echo "<hr />";
                }
        } 
        ?>      
                [ <a href="<?php echo $this->backUrl; ?>">Back to My Profile</a> ]
                
<?php } ?>                
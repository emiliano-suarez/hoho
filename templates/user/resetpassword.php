<link rel="stylesheet" href="/css/landing.css" media="screen">
        <section class="main-landing-about-info">
                <div class="container">
                        <h2>Claim your personal profile today!</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim aminim veniam, quis nostrud exercitation ullamco laboris.</p>
                        <form method="get" action="/profile/claimprofile">
                        <input id="txtName" name="txtName" type="text" placeholder="TYPE YOUR FULL NAME" />
                        </form>
                </div>
        </section>

<?php if ($this->showForm) {  ?>

<div class="login_bg">
    
    <div id="resetModal" class="modalbg">
		  <div class="dialog">
    		<a href="#close" title="Close" class="close">X</a>
		    <div class="login_box">
		   	  <h4>RESET YOUR PASSWORD</h4>    
					<div class="login_box_t">
						<div class="login_box_sec">
								<p id="result" style="display:none"></p>
								<p id='p1'>Type your new password<br /><input id="password1" type="password" class="login_textbox" onFocus="if(this.value == '') { this.value = ''; }" onBlur="if(this.value == '') { this.value = ''; }"  value="" /></p>						
								<p id='p2'>Again...please...<br /><input id="password2" type="password" class="login_textbox" onFocus="if(this.value == '') { this.value = ''; }" onBlur="if(this.value == '') { this.value = ''; }"  value="" /></p>
								<p><input id="btnResetPassword" type="button" value="RESET PASSWORD" class="button_rr2" /></p>
								<p class="forgot"><span id="resetActionStatus"></span></p>		        
						</div>
    		  </div>
        
	    </div>
    </div>
  </div>
    
</div>

<form action="">
<input type="hidden" id="email" value="<?php echo $this->email; ?>">
<input type="hidden" id="reqId" value="<?php echo $this->reqId; ?>">

</form>




<?php }  

		else   {  ?>

<div class="login_bg">
    
    <div id="resetModal" class="modalbg">
		  <div class="dialog">
    		<a href="#close" title="Close" class="close">X</a>
		    <div class="login_box">
		   	  <h4>RESET YOUR PASSWORD</h4>    
					<div class="login_box_t">
							<p id="result">There seems to be a problem with the link. Please try again....</p>						
					 </div>
        
	    </div>
    </div>
  </div>
    
</div>				
				
				
		
<?php }   ?>		

<script type="text/javascript">
$(document).ready(function(){
window.location.href = "#resetModal";
});
</script>

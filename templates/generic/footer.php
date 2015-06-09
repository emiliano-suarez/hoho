<?php if (!isset($_SESSION['isLoggedIn']) || ($_SESSION['isLoggedIn'] == false)){ ?>
<link rel="stylesheet" href="/css/landing.css" media="screen">
<div class="login_bg">
    
    <div id="login" class="modalbg">
		  <div class="dialog">
    		<a href="#close" title="Close" class="close">X</a>
		    <div class="login_box">
		   	  <h4>LOG IN</h4>    
					<div class="login_box_t">
						<div class="login_box_sec">
								<p><input id="username" type="text" 		class="login_textbox" onFocus="if(this.value == 'Email') { this.value = ''; }" onBlur="if(this.value == '') { this.value = 'Email'; }"  value="Email" /></p>
								<p><input id="password" type="password" class="login_textbox" onFocus="if(this.value == 'Password') { this.value = ''; }" onBlur="if(this.value == '') { this.value = 'Password'; }"  value="Password" /></p>
								<p><input id="btnLogin" type="button" value="LOG IN" class="button_rr2" /></p>
								<?php if ($this->denied == true) { ?>
								<p class="forgot"><span id="loginActionStatus">We couldn't find that email</span></p>
								<?php } ?>
		        </div>
    		  </div>
					<div id="btnLinkedIn" class="login_box_m"><a href="#"><img src="/images/linkedin_button.jpg" alt=""></a></div>
					<div class="login_box_b">New to HoHo? <span class="forgot"><a href="#signup">Sign Up</a></span>
					<br /><span class="forgot"><a href="#lostpassword">Forgot Your Password?</a></span></div>
        
	    </div>
    </div>
  </div>
    
</div>


<div class="login_bg">
    
    <div id="lostpassword" class="modalbg">
		  <div class="dialog">
    		<a href="#close" title="Close" class="close">X</a>
		    <div class="login_box">
		   	  <h4>FORGOT PASSWORD</h4>    
					<div class="login_box_t">
						<div class="login_box_sec">
								<p id="result">Let's get your password back...</p>
								<p><input id="emailaddress" type="text" class="login_textbox" onFocus="if(this.value == 'Email') { this.value = ''; }" onBlur="if(this.value == '') { this.value = 'Email'; }"  value="Email" /></p>
								<p><input id="btnPassword" type="button" value="CONTINUE" class="button_rr2" /></p>
								<p class="forgot"><span id="lostPasswordActionStatus"></span></p>
		        </div>
    		  </div>        
	    </div>
    </div>
  </div>
    
</div>

<div class="login_bg">
    
    <div id="signup" class="modalbg">
		  <div class="dialog">
    		<a href="#close" title="Close" class="close">X</a>
		    <div class="login_box">
		   	  <h4>SIGN UP</h4>    
					<div class="login_box_t">
						<div class="login_box_sec">
								<p><input id="firstname" type="text" 		class="login_textbox" onFocus="if(this.value == 'First Name') { this.value = ''; }" onBlur="if(this.value == '') { this.value = 'First Name'; }"  value="First Name" /></p>						
								<p><input id="lastname" type="text" 		class="login_textbox" onFocus="if(this.value == 'Last Name') { this.value = ''; }" onBlur="if(this.value == '') { this.value = 'Last Name'; }"  value="Last Name" /></p>						
								<p><input id="email" type="text" 		class="login_textbox" onFocus="if(this.value == 'Email') { this.value = ''; }" onBlur="if(this.value == '') { this.value = 'Email'; }"  value="Email" /></p>
								<p><input id="signup_password" type="password" class="login_textbox" onFocus="if(this.value == 'Password') { this.value = ''; }" onBlur="if(this.value == '') { this.value = 'Password'; }"  value="Password" /></p>
								<p><input id="btnSubmit" type="button" value="SIGN UP" class="button_rr2" /></p>
								<p class="forgot"><span id="signupActionStatus"></span></p>
		        </div>
    		  </div>
					<div class="login_box_m"><a href="#"><img src="images/linkedin_button.jpg" alt=""></a></div>
					<div class="login_box_b">Already have an account? <span class="forgot"><a href="#login">Log In</a></span></div>
	    </div>
    </div>
  </div>
    
</div>


<?php hoho\fwk\Fwk_JsEnqueuer::getInstance()->enqueue(JS_FILE, "/js/login.js"); ?>
<?php hoho\fwk\Fwk_JsEnqueuer::getInstance()->enqueue(JS_FILE, "/js/signup.js"); ?>
<?php } ?>
<!--START FOOTER SECTION -->

<footer class="footer_section">
	<div class="footer_section_top">
    	<div class="body_common_section">
        <div class="footer_topcon">
        	
            <div class="footer_box">
            	<h4>Heading one</h4>
                <ul>
                 <li><a href="#">TERMS & CONDITIONS</a></li>
               	 <li><a href="#">PRIVACY</a></li>
                 <li><a href="#">SUPPORT</a></li>
                </ul>
            </div>
            
            <div class="footer_box">
            	<h4>Heading TWO</h4>
                <ul>
                 <li><a href="#">TERMS & CONDITIONS</a></li>
               	 <li><a href="#">PRIVACY</a></li>
                 <li><a href="#">SUPPORT</a></li>
                </ul>
            </div>
            
            <div class="clr2"></div>
            
            <div class="footer_box">
            	<h4>Heading THREE</h4>
                <ul>
                 <li><a href="#">TERMS & CONDITIONS</a></li>
               	 <li><a href="#">PRIVACY</a></li>
                 <li><a href="#">SUPPORT</a></li>
                </ul>
            </div>
            
            <div class="footer_box">
           	<h4>Heading FOUR</h4>
            <img src="/images/social_icon1.jpg" alt=""> <img src="/images/social_icon2.jpg" alt=""> <img src="/images/social_icon3.jpg" alt="">
            </div>

            
        
        <div class="clr"></div>
        </div>
        </div>
    </div>
    
    <div class="footer_section_bottom">
    	<div class="body_common_section">COPYRIGHT © 2015 HOHO. ALL RIGHTS RESERVED</div>
    </div>
    
</footer>	


<!--END FOOTER SECTION -->

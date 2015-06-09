
<link rel="stylesheet" href="/css/landing.css" media="screen">

        <section class="main-landing-about-info">
        				<form action="">
                <div class="container">
                        <h2>Claim your Company profile today!</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim aminim veniam, quis nostrud exercitation ullamco laboris.</p>
                        <input type="text" placeholder="TYPE YOUR COMPANY NAME" id="companyName" />
                        <br /><br />
                        <input type="button" value = "Submit" id="btnClaimCompany">
                </div>
                </form>
        </section>
<?php hoho\fwk\Fwk_JsEnqueuer::getInstance()->enqueue(JS_FILE, "/js/profile.js"); ?>        
    <form id="register-form">
      <h4 style="margin-bottom: 30px"><?php echo _('Please enter your details below'); ?>:</h4>
      <div class="row-fluid"><?php echo _('First Name'); ?>: <input  type="text" name="firstname" id="firstname" class="span8" maxlength="50"  minlength="2" /></div>
      <div class="row-fluid"><?php echo _('Last Name'); ?>: <input  type="text" name="lastname" id="lastname" class="span8" maxlength="50"  minlength="2" /></div>
      <div class="validate-error"><span id="name_valid" class="payment-errors text-error"></span></div>
      <div class="row-fluid"><?php echo _('Email Address'); ?>: <input  type="text" class="span8" name="email" id="email" validation="required email"/></div>
      <div class="validate-error"><span id="email_valid" class="payment-errors text-error"></span></div>
      <div class="row-fluid"><?php echo _('Company'); ?>: <input  type="text" name="company" id="company" class="span8" maxlength="50"   minlength="3" /></div>
      <div class="validate-error"><span id="company_valid" class="payment-errors text-error"></span></div>
      <div class="row-fluid"><?php echo _('Password'); ?>: <input  type="password" name="pass1" id="pass1" class="span8" maxlength="25" minlength="8" />
      <span id="pwd1_err"></span></div>
      <div class="row-fluid"><?php echo _('Confirm Password'); ?>: <input  type="password" name="pass2" id="pass2" class="span8" maxlength="25"  minlength="8" /></div>      
      <br/>
      <div class="controls" style="margin: 10px 0 5px 0;">
        <div class="span3">
          <div id="signupActionStatus"></div>
          <button class="btn btn-large btn-success span4" id="btnSubmit" type="button">Submit</button>
        </div>
      </div>
    </form>
  </div>
  <!-- END: Payment form -->
</div><br /><br />
<!--end: Container-->

<?php hoho\fwk\Fwk_JsEnqueuer::getInstance()->enqueue(JS_FILE, "/js/signup.js"); ?>
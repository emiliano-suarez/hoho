<h3>My Personal Info</h3>

<form>
First Name : <input type="text" size="30" value="<?php echo $this->userInfo->firstName; ?>" id="txtFirstName">
<br />
Last Name : <input type="text" size="30" value="<?php echo $this->userInfo->lastName; ?>" id="txtLastName">	
<br />

Photo Url : <input type="text" size="30" value="<?php echo $this->userInfo->photoUrl; ?>" id="txtPhotoUrl">

<br />

What I Do : <textarea id="txtWhatIDo" cols="50" rows="5">
<?php echo $this->userInfo->whatIDo; ?></textarea>

<br />

Bio : <textarea id="txtBio" cols="50" rows="5">
<?php echo unserialize($this->userInfo->bio); ?></textarea>
	
</form>	

<br /><br />
[<a href="javascript:submit();">Submit</a>] [<a href="/user/myaccount">Back</a>]

<?php hoho\fwk\Fwk_JsEnqueuer::getInstance()->enqueue(JS_FILE, "/js/user.js"); ?>
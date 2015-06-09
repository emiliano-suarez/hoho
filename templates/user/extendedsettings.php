<h3>My Personal Info</h3>

<form>

<li>Education : <textarea id="education" cols="50" rows="5">
<?php 
$arrEducation = $this->infoEducation;
for ($i=0; $i<count($arrEducation); $i++) {
	echo $arrEducation[$i] . " \n";
}
?>
</textarea>

<br />

<li>Links : <textarea id="links" cols="50" rows="5">
<?php 
$arrLinks = $this->infoLinks;
for ($i=0; $i<count($arrLinks); $i++) {
	echo $arrLinks[$i] . " \n";
}
?>
</textarea>

<br />

<li>Locations : <textarea id="locations" cols="50" rows="5">
<?php 
$arrLocations = $this->infoLocations;
for ($i=0; $i<count($arrLocations); $i++) {
	echo $arrLocations[$i] . " \n";
}
?>
</textarea>

<br />

<li>Skills : <textarea id="skills" cols="50" rows="5">
<?php 
$arrSkils = $this->infoSkills;
for ($i=0; $i<count($arrSkils); $i++) {
	echo $arrSkils[$i] . " \n";
}
?>
</textarea>

	
</form>	

<br /><br />
[<a href="javascript:submitExtended();">Submit</a>] [<a href="/user/myaccount">Back</a>]

<?php hoho\fwk\Fwk_JsEnqueuer::getInstance()->enqueue(JS_FILE, "/js/user.js"); ?>
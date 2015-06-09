<h3>My Personal Info :: Experience</h3>

<form>



<?php 
$arrExperience = $this->infoExperience;
if (count($arrExperience)>0) {
	for ($i=0; $i<count($arrExperience); $i++) {
		echo $arrExperience[$i]['companyName'] . "<br >";
	}
}
?>
<li><a href="javascript:addPosition();">Add Position</a></li>

<br />

</form>	

<br /><br />
[<a href="javascript:submitExPerience();">Submit</a>] [<a href="/user/myaccount">Back</a>]

<?php hoho\fwk\Fwk_JsEnqueuer::getInstance()->enqueue(JS_FILE, "/js/user.js"); ?>

<div class="modal hide" id="experienceModal" style="width:630px;">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>Add Experience</h3>
    </div>
    <div class="experience-modal-body" id="experience-modal-body">
            <table class="table table-bordered table-striped">
                <tr>
                    <td>Company Name: </td><td><input type="text" id="companyName" size="50" maxlength="100"></td>
                </tr>
                <tr>
                    <td>Job Title: </td><td><input type="text" id="jobTitle" size="50" maxlength="100"></td>
                </tr>
                
                <tr>
                	<td>Time Period: </td>
                	<td>
                	<select id="month_from">
                	 <option value="1">Jan</option>
                	 <option value="2">Feb</option>
                	 <option value="3">Mar</option>
                	 <option value="4">Apr</option>
                	 <option value="5">May</option>
                	 <option value="6">Jun</option>
                	 <option value="7">Jul</option>
                	 <option value="8">Aug</option>
                	 <option value="9">Sep</option>
                	 <option value="10">Oct</option>
                	 <option value="11">Nov</option>
                	 <option value="12">Dec</option>                	                 	                 	                 	                 	                 	                 	                 	                 	                 	                 	 
                	</select>
                	<input type="text" id="year_from" size="5" maxlength="4"> - 
                	<select id="month_to">
                	 <option value="1">Jan</option>
                	 <option value="2">Feb</option>
                	 <option value="3">Mar</option>
                	 <option value="4">Apr</option>
                	 <option value="5">May</option>
                	 <option value="6">Jun</option>
                	 <option value="7">Jul</option>
                	 <option value="8">Aug</option>
                	 <option value="9">Sep</option>
                	 <option value="10">Oct</option>
                	 <option value="11">Nov</option>
                	 <option value="12">Dec</option>                	                 	                 	                 	                 	                 	                 	                 	                 	                 	                 	 
                	</select>
                	<input type="text" id="year_to" size="5" maxlength="4">                	
                	</td>
                </tr>                

                <tr>
                    <td>Description: </td><td><textarea id="jobDescription" cols="50" rows="4"></textarea></td>
                </tr>

                
                <tr>                    
                    <td colspan="2">
                    	<button type="button" id="btnAddPosition" class="btn btn-primary">Submit</button>
                    	<button type="button" data-dismiss="modal">Close</button>
                    	</td>
                </tr>
            </table>
            <div id="experience-message"></div>
    </div>
    <div>&nbsp;</div>
        <div>&nbsp;</div>
</div>

<style>
.modal {
  position: fixed;
  top: 50%;
  left: 50%;
  z-index: 1050;
  overflow: auto;
  width: 560px;
  margin: -250px 0 0 -280px;
  background-color: #ffffff;
  border: 1px solid #999;
  border: 1px solid rgba(0, 0, 0, 0.3);
  *border: 1px solid #999;
  /* IE6-7 */

  -webkit-border-radius: 6px;
  -moz-border-radius: 6px;
  border-radius: 6px;
  -webkit-box-shadow: 0 3px 7px rgba(0, 0, 0, 0.3);
  -moz-box-shadow: 0 3px 7px rgba(0, 0, 0, 0.3);
  box-shadow: 0 3px 7px rgba(0, 0, 0, 0.3);
  -webkit-background-clip: padding-box;
  -moz-background-clip: padding-box;
  background-clip: padding-box;
}
.modal.fade {
  -webkit-transition: opacity .3s linear, top .3s ease-out;
  -moz-transition: opacity .3s linear, top .3s ease-out;
  -ms-transition: opacity .3s linear, top .3s ease-out;
  -o-transition: opacity .3s linear, top .3s ease-out;
  transition: opacity .3s linear, top .3s ease-out;
  top: -25%;
}
.modal.fade.in {
  top: 50%;
}
.modal-header {
  padding: 9px 15px;
  border-bottom: 1px solid #eee;
}
.modal-header .close {
  margin-top: 2px;
}
.modal-body {
  overflow-y: auto;
  max-height: 400px;
  padding: 15px;
}
.modal-form {
  margin-bottom: 0;
}
.modal-footer {
  padding: 14px 15px 15px;
  margin-bottom: 0;
  text-align: right;
  background-color: #f5f5f5;
  border-top: 1px solid #ddd;
  -webkit-border-radius: 0 0 6px 6px;
  -moz-border-radius: 0 0 6px 6px;
  border-radius: 0 0 6px 6px;
  -webkit-box-shadow: inset 0 1px 0 #ffffff;
  -moz-box-shadow: inset 0 1px 0 #ffffff;
  box-shadow: inset 0 1px 0 #ffffff;
  *zoom: 1;
}
.modal-footer:before,
.modal-footer:after {
  display: table;
  content: "";
}
.modal-footer:after {
  clear: both;
}
.modal-footer .btn + .btn {
  margin-left: 5px;
  margin-bottom: 0;
}
.modal-footer .btn-group .btn + .btn {
  margin-left: -1px;
}

.hide {
  display: none;
}
.show {
  display: block;
}
.invisible {
  visibility: hidden;
}

.close {
  float: right;
  font-size: 20px;
  font-weight: bold;
  line-height: 18px;
  color: #000000;
  text-shadow: 0 1px 0 #ffffff;
  opacity: 0.2;
  filter: alpha(opacity=20);
}
.close:hover {
  color: #000000;
  text-decoration: none;
  cursor: pointer;
  opacity: 0.4;
  filter: alpha(opacity=40);
}
button.close {
  padding: 0;
  cursor: pointer;
  background: transparent;
  border: 0;
  -webkit-appearance: none;
}

</style>
function addNewPossition(){
  var companyName      = $('#companyName').val();
  var jobTitle			= $('#jobTitle').val();
  var jobDescription			= $('#jobDescription').val();
  var month_from			= $('#month_from').val();
  var month_to			= $('#month_to').val();
  var year_from			= $('#year_from').val();
  var year_to			= $('#year_to').val();          
  
  if (companyName.length == 0){
  	alert ('please enter company name');
  	$('#companyName').focus();
  	return false;
  }

  if (jobTitle.length == 0){
  	alert ('please enter job title');
  	$('#jobTitle').focus();
  	return false;
  }  


  if (year_from.length == 0){
  	alert ('please enter year-from');
  	$('#year_from').focus();
  	return false;
  }  


  if (year_to.length == 0){
  	alert ('please enter year-to');
  	$('#year_to').focus();
  	return false;
  }  

  
 
  $.ajax({
      url: '/user/addnewposition',
      type: 'post',          
      
      data: {companyName: companyName, jobTitle: jobTitle,jobDescription: jobDescription,month_from: month_from,month_to: month_to,year_from:year_from,year_to:year_to },
      success: function(result) {
        if (result.result == 'OK') {
        	alert ('new position added ok!');
          $(window).attr('location',result.redirectUrl);
        } else {
        	alert ('error adding new position, please try again in a few minutes...');
        }
      }
  });

}
function follow(tid,fid){

  $.ajax({
      url: '/user/addfollow',
      type: 'post',          
      data: {fromid: fid, toid: tid},
      success: function(result) {
        if (result.result == 'OK') {
        	alert ('changes applied ok...');
					$('#spfollowoff').show();        	
					$('#spfollowon').hide();
        } else {
        	alert ('error when trying to update...');
        }
      }
  });
}

function unfollow(tid,fid){
  
  $.ajax({
      url: '/user/removefollow',
      type: 'post',          
      data: {fromid: fid, toid: tid},
      success: function(result) {
        if (result.result == 'OK') {
        	alert ('changes applied ok...');
					$('#spfollowoff').hide();        	
					$('#spfollowon').show();        	
        } else {
        	alert ('error when trying to update...');
        }
      }
  });
}

function  sendDirectMessage(){
  var destId      = $('#uid').val();
  var msgBody			= $('#txtMessageBody').val();
  
  if (msgBody.length == 0){
  	alert ('please enter some message...');
  	$('#txtMessageBody').focus();
  	return false;
  }
 
  $.ajax({
      url: '/user/sendMsgDo',
      type: 'post',          
      data: {destId: destId, msgBody: msgBody},
      success: function(result) {
        if (result.result == 'OK') {
        	alert ('message sent ok...');
          $(window).attr('location',result.redirectUrl);
        } else {
        	alert ('error sending message...');
        }
      }
  });


}

function sendContact(){

  var txtName      = $('#username').val();
  if (txtName.length == 0){
  	alert ('please enter contact name');
  	$('#username').focus();
  	return false;
  }
 
  var url = '/user/sendcontact?txtName='+ txtName;
  $(window).attr('location',url);

}

function submit() {
  var txtFirstName = $('#txtFirstName').val();
  var txtLastName  = $('#txtLastName').val();
  var txtPhotoUrl  = $('#txtPhotoUrl').val();
  var txtWhatIDo  = $('#txtWhatIDo').val();
  var txtBio  = $('#txtBio').val();
  
  $.ajax({
      url: '/user/updatepersonalinfo',
      type: 'post',          
      data: {firstname: txtFirstName, lastname: txtLastName, photo:txtPhotoUrl, whatido: txtWhatIDo, bio:txtBio},
      success: function(result) {
        if (result.result == 'OK') {
        	alert ('changes applied ok...');
          $(window).attr('location',result.redirectUrl);
        } else {
        	alert ('error when trying to update...');
        }
      }
  });
}

function submitExtended() {
  var education = $('#education').val();
//  var experience  = $('#experience').val();
  var links  = $('#links').val();
  var locations  = $('#locations').val();
  var skills  = $('#skills').val();
  
  $.ajax({
      url: '/user/updatedextendedsettings',
      type: 'post',          
      data: {education: education, links:links, locations: locations, skills:skills},
      success: function(result) {
        if (result.result == 'OK') {
        	alert ('changes applied ok...');
          $(window).attr('location',result.redirectUrl);
        } else {
        	alert ('error when trying to update...');
        }
      }
  });
}

function addPosition(){
		 $('#experienceModal').modal();
		 $('#experienceModal').modal('show');
}


$(document).ready(function() {
  $('#btnContact').click(function () {
     sendContact();
  });

  $('#btnSendDirect').click(function () {
     sendDirectMessage();
  });

	$('#btnAddPosition').click(function () {
     addNewPossition();
  });
	
});

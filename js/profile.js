function backToProfile(){
  var url = '/profile';
  $(window).attr('location',url);
}

function confirmClaim(){
	var selectedName = $('#sPeople').val();
	var url = '/profile/processclaim?sName=' + selectedName;
  $(window).attr('location',url);
	
}

function stopClaim(){
	alert ('We are sorry... but the process is stopping now...');
	return;
}

function startClaimCompany(){
  var txtCompany      = $('#companyName').val();  
  
  if (txtCompany.length == 0){
  	alert ('please type your company name');
  	$('#companyName').focus();
  	return false;
  }
 
  var url = '/profile/processclaimcompany?txtCompany='+txtCompany;
  $(window).attr('location',url);

}

function startClaim(){
  var txtFirstName      = $('#firstName').val();
  var txtLastName      = $('#lastName').val();  
  var txtCompany      = $('#companyName').val();  
  
  if (txtFirstName.length == 0){
  	alert ('please type your first name');
  	$('#firstName').focus();
  	return false;
  }

  if (txtLastName.length == 0){
  	alert ('please type your first name');
  	$('#lastName').focus();
  	return false;
  }


  if (txtCompany.length == 0){
  	alert ('please type your company name');
  	$('#companyName').focus();
  	return false;
  }
 
  var url = '/profile/startclaim?txtFirstName='+ txtFirstName + '&txtLastName=' + txtLastName + '&txtCompany='+txtCompany;
  $(window).attr('location',url);

}

function doLogin(){
  var txtEmail      = $('#username').val();
  var txtPassword  = $('#password').val();
  var addUrl = '/login/doLogin';
  var returnTo = '';
  
  $('#loginActionStatus').html('');  
  
  $.ajax({
    type: "POST",
    url: addUrl,
    data: {txtEmail: txtEmail, txtPassword: txtPassword, returnTo: returnTo},
      success: function(data) {
        if (data.result == 'OK') {
          $(window).attr('location',data.redirectUrl);
        } else {
          var message = data.message;
          $('#loginActionStatus').html(message);
          $('#loginActionStatus').css('color', 'red');
        }
      },
      error: function(msg) {
        $('#loginActionStatus').val('Internal server error, contact your IT team');
        $('#loginActionStatus').css('color', 'red');
      }
  });
}

$(document).ready(function() {

  $('#btnClaimCompany').click(function () {
     startClaimCompany();
  });


  $('#btnClaim').click(function () {
     startClaim();
  });

  $('#btnYes').click(function () {
     confirmClaim();
  });
  
    $('#btnNo').click(function () {
     stopClaim();
  });
  
    $('#btnBack').click(function () {
     backToProfile();
  });

});


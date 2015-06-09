function doResetPassword(){
  var txtPwd1      = $('#password1').val();
  var txtPwd2      = $('#password2').val();  
  var txtEmail      = $('#email').val();  
  var txtReqId      = $('#reqId').val();      
  
  if (txtPwd1.length < 6){
  	alert ('please choose a password having at least 6 chars');
  	$('#password1').focus();
  	return false;
  }

  if (txtPwd1 != txtPwd2){
  	alert ('passwords do not match!');
  	$('#password1').focus();
  	return false;
  }
  
  var addUrl = '/lostpassword/resetpassword';
  
  $('#resetActionStatus').html('');  
  
  $.ajax({
    type: "POST",
    url: addUrl,
    data: {txtPwd: txtPwd1, txtReqId: txtReqId, txtEmail: txtEmail},
      success: function(data) {
        if (data.result == 'OK') {
          //$(window).attr('location',data.redirectUrl);
					hideAll();
					$('#result').html("Your password was changed! Please go to the Login page to proceed...");                                      
          $('#result').show();					
        } else {
           var message = 'Invalid data received!'; //data.message;
					hideAll();           
          $('#resetActionStatus').html(message);
          $('#resetActionStatus').css('color', 'red');
        }
      },
      error: function(msg) {
        $('#resetActionStatus').val('Internal server error, contact your IT team');
        $('#resetActionStatus').css('color', 'red');
      }
  });

}

function hideAll(){
	$('#password1').hide();
	$('#password2').hide();
	$('#p1').hide();          
	$('#p2').hide();                    
	$('#btnResetPassword').hide();  
	return;
}


function doLostPassword(){
  var txtEmail      = $('#emailaddress').val();
  var addUrl = '/lostpassword/sendemail';
  var returnTo = '';
  
  $('#lostPasswordActionStatus').html('');  
  
  $.ajax({
    type: "POST",
    url: addUrl,
    data: {txtEmail: txtEmail},
      success: function(data) {
        if (data.result == 'OK') {
          //$(window).attr('location',data.redirectUrl);
          $('#emailaddress').hide();
          $('#btnPassword').hide();
          $('#lostPasswordActionStatus').hide();
          $('#result').html("We've sent you a link to change your password. Don't forget to check your spam folder!");
        } else {
          var message = "We couldn't find that email"; //data.message;
          $('#lostPasswordActionStatus').html(message);
          $('#lostPasswordActionStatus').css('color', 'red');
        }
      },
      error: function(msg) {
        $('#lostPasswordActionStatus').val('Internal server error, contact your IT team');
        $('#lostPasswordActionStatus').css('color', 'red');
      }
  });

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

function doRequestAuthCode() {
    var addUrl = '/linkedin/authCodeRequest';
    var returnTo = '';

    $('#loginActionStatus').html('');  

    $.ajax({
        type: "GET",
        url: addUrl,
        data: {},
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

  $('#btnLogin').click(function () {
     doLogin();
  });

  $('#btnPassword').click(function () {
     doLostPassword();
  });

  $('#btnResetPassword').click(function () {
     doResetPassword();
  });

  $('#btnLinkedIn').click(function () {
     doRequestAuthCode();
  });

});

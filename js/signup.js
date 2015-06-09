function createUser(){
  var txtFirstName = $('#firstname').val();
  var txtLastName  = $('#lastname').val();
  var txtEmailAddress = $('#email').val();
  var txtPwd1      = $('#signup_password').val();

	if (txtPwd1.length < 6){
			alert ('please password with at least 6 chars');
	    $('#signup_password').focus();				
			return false;
	}


  var addUrl = '/signup/adduser';
  $('#errorMsg').val('');
  
  $('body').css('cursor', 'progress');
  
  $.ajax({
    type: "POST",
    url: addUrl,
    data: {firstname: txtFirstName, lastname: txtLastName, email:txtEmailAddress, pass1: txtPwd1},
      success: function(data) {
        $('body').css('cursor', 'default');
        if (data.result == 'OK') {
          $(window).attr('location',data.redirectUrl);
        } else {
          var message = data.message;
          if (typeof(data.detail) != 'undefined') {
            for (var i = 0; i < data.detail.length; i++) {
              message += '<br />- ' + data.detail[i].msg;
            }
          }
          $('#signupActionStatus').html(message);
          $('#signupActionStatus').css('color', 'red');
          $('#submitPaymentDetails').attr('disabled', false);
        }
      },
      error: function(msg) {
        $('body').css('cursor', 'default');
        $('#signupActionStatus').val('Internal server error, contact your IT team');
        $('#signupActionStatus').css('color', 'red');
      }
  });
}


$(document).ready(function() {
  $('#btnSubmit').click(function () {
      createUser();
  });

});

function fillSubjectAndBody() {
    var tag = $('#tagDropdown').val();
    
    var updateurl = "/email/getByTag";
        
    $.ajax({
        type: "POST",
        url: updateurl,
        data: {'tag':tag},
        success: function(data) {
            if(data.result=='OK')
            {
                $('#emailSubject').val(data.subject);
                $('#emailBody').val(data.body);
            }
        },
        error: function(msg) {
        $('#messageText').html('Error');
        $('#messageText').css('color', 'red');
        }
    });
}


function save() {
    
    var fdata = new FormData(document.getElementById("emailEditForm"));
    
    var updateurl = "/email/save";
    
    $.ajax({
      type: "POST",
      url: updateurl,
      data: fdata,
      cache: false,
      processData: false, 
      contentType: false,
      success: function(data) { 
        if (data.result == 'OK') {
            $('#messageText').html('Template saved successfully');
            $('#messageText').css('color', 'green');
            }
        else {
            var errorMessage = "";
            for(var i=0; i<data.errors.length; i++) {
              errorMessage += data.errors[i] +'<br />'; }
            $('#messageText').html(errorMessage);
            $('#messageText').css('color', 'red');
        }
      },
      error: function(msg) {
	    alert(msg.toSource());      
        $('#messageText').html('Error');
        $('#messageText').css('color', 'red');
      }
      });
}


function deleteTags() {
    var formData = $("#deleteForm").serializeArray();
    var originalData = $("#deleteForm").serializeArray();   
    
    //get just the tag from the id of the element
    for (var i=0,len=originalData.length; i<len; i++) {
        originalData[i].name = originalData[i].name.substring(8);
        }
        
    var updateurl = "/email/deleteEmail";
    $.ajax({
      type: "POST",
      url: updateurl,
      data: originalData,
      success: function(data) { 
        for (var i=0,len=formData.length; i<len; i++)
        {
            $('#uniform-'+formData[i].name).parent('span').remove();
        }
      },
      error: function(msg) {
        $('#messageText').html('Error');
        $('#messageText').css('color', 'red');
      }
      });
}

function create() {
    
    var fdata = new FormData(document.getElementById("emailForm"));
    var updateurl = "/email/createEmail";
    
    $.ajax({
      type: "POST",
      url: updateurl,
      data: fdata,
      cache: false,
      processData: false, 
      contentType: false,
      success: function(data) { 
      alert(data.toSource());
            if (data.result == 'OK') {
                $('#emailSubject').val('');
                $('#emailBody').val('');
                $('#tag').val('');
                $('#messageText').html('Template created successfully');
                $('#messageText').css('color', 'green');
                }
            else {
                var errorMessage = "";
                for(var i=0; i<data.errors.length; i++) {
                  errorMessage += data.errors[i] +'<br />'; }
                $('#messageText').html(errorMessage);
                $('#messageText').css('color', 'red');
            }
      },
      error: function(msg) {
        $('#messageText').html('Error');
        $('#messageText').css('color', 'red');
      }
      });
}


function clearAllFields() {
    $('#emailSubject').val('');
    $('#emailBody').val('');
    $('#tag').val('')
    $('#tagDropdown').val('');
    $('#messageText').html('');
}





$(document).ready(function() {
  $('#btnSave').click(function () {
     save();
  });
  $('#btnCreateLink').click(function () {
    window.location.href="/email/create";
   });
  $('#btnEditLink').click(function () {
    window.location.href="/email/index";
   });
  $('#btnDeleteLink').click(function () {
    window.location.href="/email/delete";
   });
  $('#btnCreate').click(function() {
    create();
    });
  $('#btnDelete').click(function() {
    deleteTags();
    });
  $('#tagDropdown').change(function() {
    fillSubjectAndBody();
  });  
  $('#btnClose').click(function() {
    window.close();
  });  
  $('#btnCancel').click(function() {
    clearAllFields();
  });
 });
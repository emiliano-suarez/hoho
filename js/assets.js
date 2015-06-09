function  sendNewAsset(){
  var a_1      = $('#asset_1').val();
  var a_2			= $('#asset_2').val();
  var a_3			= $('#asset_3').val();
  var a_4			= $('#asset_4').val();
  var a_5			= $('#asset_5').val();
  var a_6			= $('#asset_6').val();
  var a_7			= $('#asset_7').val();
  var a_8			= $('#asset_8').val();
  var a_comp	= $('#sCompany').val();
  var a_status = $('#sStatus').val();
  var assetType = $('#assetType').val();
  var asset_name = $('#asset_name').val();

/*
  if (txtDescription.length == 0){
  	alert ('please enter some description...');
  	$('#txtDescription').focus();
  	return false;
  }
*/ 
  $.ajax({
      url: '/assets/addnew',
      type: 'post',          
      data: {asset_name:asset_name, a_1: a_1, a_2: a_2,a_3: a_3,a_4: a_4,a_5:a_5,a_6:a_6,a_7:a_7,a_8:a_8,assetType:assetType,a_comp:a_comp,a_status:a_status },
      success: function(result) {
        if (result.result == 'OK') {
        	alert ('New asset loaded ok...');
          $(window).attr('location',result.redirectUrl);
        } else {
        	alert ('Error creating new asset...Please try again in a few minutes.');
        }
      }
  });


}


$(document).ready(function() {
  $('#btnAssetNew').click(function () {
     sendNewAsset();
  });

	
});

function follow(cid,uid){
  
  $.ajax({
      url: '/profile/addfollow',
      type: 'post',          
      data: {cid: cid, uid: uid},
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

function unfollow(cid,uid){
  
  $.ajax({
      url: '/profile/removefollow',
      type: 'post',          
      data: {cid: cid, uid: uid},
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

function submit() {
	var cid = $('#cid').val();
  var fundCurrent = $('#fundCurrent').val();
  var fundPast  = $('#fundPast').val();
  var oneLiner  = $('#oneLiner').val();
  var investors  = $('#investors').val();
  var city  = $('#city').val();

  var productDescription  = $('#productDescription').val();
  var technology  = $('#technology').val();
  var specialties  = $('#specialties').val();
  var traction  = $('#traction').val();
  var founders  = $('#founders').val();
  var sector  = $('#sector').val();
  var customers  = $('#customers').val();
  var advisors  = $('#advisors').val();
  var incubators  = $('#incubators').val();
  var press  = $('#press').val();
  var moreInfo  = $('#moreInfo').val();
  var attorneys  = $('#attorneys').val();
  var employees  = $('#employees').val();
  var contactDetails  = $('#contactDetails').val();  
  
  $.ajax({
      url: '/profile/updatecompanyprofile',
      type: 'post',          
      data: {cid: cid, fundCurrent: fundCurrent, fundPast: fundPast, oneLiner: oneLiner, investors:investors, city:city,
      productDescription: productDescription, technology: technology, specialties: specialties, traction:traction,
      founders:founders, sector: sector, customers: customers, advisors: advisors, incubators:incubators,
      pres:press, moreInfo: moreInfo, attorneys: attorneys, employees:employees, contactDetails: contactDetails},
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
  var experience  = $('#experience').val();
  var links  = $('#links').val();
  var locations  = $('#locations').val();
  var skills  = $('#skills').val();
   
   $.ajax({
      url: '/user/updatedextendedsettings',
       type: 'post',          
      data: {education: education, experience: experience, links:links, locations: locations, skills:skills},
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

function addnewCompany() {
    var txtCompanyName = $('#txtCompanyName').val();
    var txtOneLiner = $('#txtOneLiner').val();
    var txtSector  = $('#txtSector').val();
    var txtLocation  = $('#txtLocation').val();
    var txtNumberEmployees  = $('#txtNumberEmployees').val();

    $.ajax({
      url: '/company/add',
      type: 'post',          
      data: {txtCompanyName: txtCompanyName, txtOneLiner: txtOneLiner, txtSector: txtSector, txtLocation: txtLocation,txtNumberEmployees:txtNumberEmployees},
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

function editCompany() {
    var cid = $('#cid').val();
    var companyName = $('#txtCompanyName').val();
    var oneLiner = $('#txtDescription').val();
    var location  = $('#txtLocation').val();
    var sector  = $('#txtSector').val();
    var employees = $('#txtNumberEmployees').val();
    var fundCurrent = $('#txtFundCurrent').val();
    var fundPast = $('#txtFundPast').val();
    var investors = $('#txtInvestors').val();
    var city = $('#txtCity').val();
    var productDescription = $('#txtProductDescription').val();
    var technology = $('#txtTechnology').val();
    var specialties = $('#txtSpecialties').val();
    var traction = $('#txtTraction').val();
    var founders = $('#txtFounders').val();
    var customers = $('#txtCustomers').val();
    var advisors = $('#txtAdvisors').val();
    var incubators = $('#txtIncubators').val();
    var press = $('#txtPress').val();
    var moreInfo = $('#txtMoreInfo').val();
    var attorneys = $('#txtAttorneys').val();
    var contactDetails = $('#txtContactDetails').val();
    var logoUrl = $('#txtLogoUrl').val();
    var reservePrice = $('#txtReservePrice').val();
    // Overview fields

    $.ajax({
        url: '/profile/updatecompanyprofile',
        type: 'post',
        data: {
            cid: cid,
            companyName: companyName,
            oneLiner: oneLiner,
            sector: sector,
            logoUrl: logoUrl,
            location: location,
            employees: employees,
            fundCurrent: fundCurrent,
            fundPast: fundPast,
            investors: investors,
            productDescription: productDescription,
            technology: technology,
            specialties: specialties,
            traction: traction,
            founders: founders,
            customers: customers,
            advisors: advisors,
            incubators: incubators,
            press: press,
            moreInfo: moreInfo,
            attorneys: attorneys,
            contactDetails: contactDetails,
            reservePrice: reservePrice
        },
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

$(document).ready(function() {

  $('#btnAddNewCompany').click(function () {
     addnewCompany();
  });

  $('#btnEditCompany').click(function () {
    editCompany();
  });

  $('#btnSaveOverview').click(function () {
    editCompany();
  });

  $('#btnSendDirect').click(function () {
    sendDirectMessage();
  });
});

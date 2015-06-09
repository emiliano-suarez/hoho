$(window).scroll(function() {
        if ($(this).scrollTop() >= $('.main-intro').height()){
                $('.main-header').addClass("sticky");
        }
        else{
                $('.main-header').removeClass("sticky");
        }
});

$(document).ready(function() {



 $("#homeForm").submit(function() {
                 var url = "/profile/claimprofile";

                 $.ajax({
                                                type: "POST",
                                                url: url,
                                                data: $("#homeForm").serialize(), // serializes the form's elements.
                                                success: function(data)
                                                {
                                                                alert(data); // show response from the php script.
                                                }
                                        });

                 return false; // avoid to execute the actual submit of the form.
 });

});


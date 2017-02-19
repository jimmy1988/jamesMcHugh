var exit;
$(document).ready(function(){
    // to fade in on page load
    $("body").css("display", "none");
    $("body").fadeIn(1000, function(){
		exit=true;
	}); 
    // to fade out before redirect
    $("a#yes").click(function(e){
			redirect = $(this).attr('href');
			var n = redirect.search("#");
			if (n !=-1){
				e.preventDefault();
				$('body').fadeOut(1000, function(){
					exit=false;
					document.location.href = redirect;
				});
			}
    });
})
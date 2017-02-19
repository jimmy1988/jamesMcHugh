var time=10000;
var timer;
var sliding=false;

$(document).ready(function(){

	// setTimeout(slide,8000);
	timer=setInterval(slide,time);

	$("#navSliderRight").click(function(){slide();})
	$("#navSliderLeft").click(function(){previous();})
	$("#navSliderPlay").click(function(){resume();})
	$("#navSliderPause").click(function(){pause();})
});

function slide(){

	if(sliding==false){
			clearInterval(timer);
			if(timer==null){
				start=false;
			}else{
				start=true;
				timer=null;
			}
			sliding=true;

			// var sliderWidth=$("#slider li").width();

			var sliderWidth = 102;

			$("#slider").animate({

				"margin-left" : "-" + sliderWidth + "%",

			}, 2000, function() {
				var first = $("#slider li").first();

				first.remove();
				$("#slider").append(first);

				$("#slider").css("margin-left", "0%");

				sliding = false;
			});

			if(start){
				timer = setInterval(slide, time);
			}else{
				timer=null;
			}
		}
}

function previous(){

	if(sliding == false){

		clearInterval(timer);

		var start;

		if(timer==null){
			start=false;
		}else{
			start=true;
			timer=null;
		}

		sliding = true;

		// var sliderWidth = $("#slider > li").first().width();

		var sliderWidth=102;

		var last = $("#slider > li").last();

		last.remove();
		$("#slider").prepend(last);

		$("#slider").css("margin-left", "-" + sliderWidth + "%");

		$("#slider").animate({

			"margin-left" : "0%",

		}, 2000, function() {

			sliding = false;

			if(start){
				timer = setInterval(slide, time);
			}else{
				timer=null;
			}

		});
	}
}

function pause(){
	event.preventDefault();
	if(sliding==false){
		clearInterval(timer);
		timer=null;
		$("#navSliderPause").removeClass("showIB");
		$("#navSliderPause").addClass("hide");
		$("#navSliderPlay").removeClass("hide");
		$("#navSliderPlay").addClass("showIB");
	}

}

function resume(){
	event.preventDefault();
	timer = setInterval(slide, time);
	$("#navSliderPause").removeClass("hide");
	$("#navSliderPause").addClass("showIB");
	$("#navSliderPlay").removeClass("showIB");
	$("#navSliderPlay").addClass("hide");
}

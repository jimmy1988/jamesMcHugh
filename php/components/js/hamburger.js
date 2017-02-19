window.onresize=function() {
	$("#container").removeAttr("style");
	$("#mainMenu").removeAttr("style");
};

function openMenu(){
	$("#hamburger").unbind("click");

	$("#mainMenu").css({
		"opacity": "1"
	});

	var contentWidth=$("#content").width();

	$("#content").css("width", contentWidth);

	$("#contentLayer").css("display", "block");

	$("#container").bind("touchmove", function (e) {
		e.preventDefault()
	});

	$("#container").animate({"left": "50%"}, 400, function(){
		$("#hamburger").on("click", closeMenu);
		$("#menuLabel").html("Close Menu");
	});

	$("#mainMenu").animate({"left": "0"}, 400);
}

function closeMenu(){
	$("#hamburger").unbind("click");

	$("#container").animate({"left" : "0"},400,function(){
		$("#mainMenu").css("opacity", 0);
		$("#content").css('width', 'auto');
        $("#contentLayer").css("display", "none");
        $("#content").css("min-height", "auto");

		$("#hamburger").on("click", openMenu);
		$("#menuLabel").html("Open Menu");
	});
	$("#mainMenu").animate({"left" : "-50%"},400);
}

function bindEvents(){
	$("#hamburger").on("click", openMenu);
	$("#contentLayer").on("click", openMenu);
	$("#menuLabel").html("Open Menu");
}

$(document).ready(function(){
	bindEvents();
});

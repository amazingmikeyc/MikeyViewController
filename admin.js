/**
Mikeynet Javascript library!!

**/
/*
tinyMCE.init({mode : "textareas",
		theme : "advanced",
		plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

});
*/
$(document).ready(function() 
{
//	$("table").tablesorter();
});


function saveForm() {
	
}

function sort(col) {

}

function expand(sender) {
	id = sender.id.substring(4);
	
	if (document.getElementById('subpages_' + id)) {
		sender.parentNode.removeChild(document.getElementById('subpages_' + id));
	//	document.getElementById('icon_' + id).src='images/plus.gif';
		return;
	}

	
	popup = document.createElement("div");
	
	popup.id = "subpages_"+id
	
	$(popup).addClass("popup");
	
	popup.innerHTML = "Loading...";
	$(popup).load("admin.php?function=pageAjax&id=" + id + "&ajax=1");
	//	document.getElementById('icon_' + id).src='images/minus.gif';

	$(popup).appendTo("#main");
	
	pos = $('#icon_' + id).position();
	
	$(popup).css("left",pos.left + "px");
	$(popup).css("top",pos.top + "px");
	
	
}

function closeBox(id)
{

	$("#subpages_"+id).remove();
}

function addToFolder(page,folder) {
//alert(page + ' ' + folder);
	$.get("ajax.php?function=addToFolder&page=" + page + "&folder=" + folder);
	
	options = $("#selectFolder").attr("options")
	text = options[document.getElementById("selectFolder").selectedIndex].text;
	
	
	$("#foldersList").append("<li>" + text + " - <a href='#' onclick='removeFromFolder("+page+","+folder+")'>Remove</a></li>");
}

function removeFromFolder(page,folder) {
		$.get("ajax.php?function=removeFromFolder&page=" + page + "&folder=" + folder);
		
	
}

function show(target, url) {
	if (target == "popup") {
		target = document.createElement("div");
		$(target).addClass("popup");
		$(target).css("position","fixed");
		
		$(target).appendTo("#main");
		
		target.id = "popup";	
		centre(target);
	}	

	$(target).html("Loading...");

	$(target).load(url + '&ajax=1', null,function() { centre(target)});
	
	 return false;
}
function init() {
	$(".navLink").click(show);
}


/**
	UPLOADER
**/

function uploadSuccess(url) {
	
	$("#uploadForm").fadeOut(100);
	$("#uploadForm img").hide();
	
	$("#uploadImage").show();
	
	var spliturl = url.split('.');
	
	$("#uploadImage").attr("src",spliturl[0] + "100x100." + spliturl[1]);
	
}


function uploadFail(url, error) {
	$("#uploadForm :submit ").show();
	$("#uploadForm img").hide();
	dialog(error, 0);
}

function uploadForm(form) {
/**
TODO: Check file type
**/
	if (!validateForm(form)) {
		return false;
	};


	$(form + " :submit").hide();
	var image = document.createElement("img");
	image.src = "/admin/images/ajax-loader.gif";
	
	$(image).insertAfter(form + " :submit");
	$(image).show();
	
	
}

function validateForm(form) {
	if ($(form + " :file").attr("value")) {
		
	}
	else {
		uploadFail("", "Enter a filename");
	} 
}

 /**
 END OF UPLOADER
 **/



/**
	Saves the form specified by the selector
**/
function ajaxSave(form) {
	$(form + " :submit").hide();
	
	//show busy icon in place of submit button
	var image = document.createElement("img");
	image.src = "/images/ajax-loader.gif";
	$(image).insertAfter(form + " :submit");
	$(image).show();
	
	var serialised = $(form).serialize();
	
	//disable the form
	$(form + " input," + form + " select," + form + " textarea").attr("disabled","true");

	
	$.post($(form).attr("action") + "&ajax=1",serialised,function(data) {
		
		//bring them all back
		$(form + " :submit").show();
		
		$(image).remove();
		$(form + " input," + form + " select," + form + " textarea").removeAttr("disabled");
		
		data = eval(data);
		
		dialog(data.message);
		
		$(form + ' [name="id"]').val(data.id);

	});
}

/**
	showshttp://api.jquery.com/attribute-equals-selector/ a pop up box which will close when clicked
	html - HTML contents
	time - time before it disappears automatically
		0 means it won't disappear at all.
**/

function dialog(html, time) {
	var x = document.createElement("div");
	
	$(x).addClass("alert");
	$(x).html(html);
		
	$(x).bind("click",function() {
		$(this).fadeOut("50", function() {
			$(this).remove();
		});
	});
	
	if (time>0) {
		setTimeout(function() {
			$(x).fadeOut("50", function() {
				$(this).remove();
			});
		}, time);
	}
	
	$(x).css("z-index",100);
	$(x).appendTo("#mainpane");
	
	centre(x);
}

function centre(object) {
	var h = ($(window).height() - $(object).height()) / 2;
	var w = ($(window).width() - $(object).width()) / 2

	$(object).css("left",w + "px");
	$(object).css("top",h + "px");
}

function loadComponent(componentName, args) {
	var x = document.createElement("div");
	
	console.log(componentName);
	
	$.post('/' + componentName, args, function(data) {
		$(x).html(data);
	});
	$(x).appendTo('#mainpane');
	return x;
}

function popUpComponent(componentName, args) {
	x = loadComponent(componentName, args)
	
	$(x).appendTo('#mainpane');
	$(x).dialog();
}

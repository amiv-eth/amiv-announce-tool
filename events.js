/*  List based on http://stackoverflow.com/questions/3390786/jquery-ui-sortable-selectable
    Selected IDs based on http://stackoverflow.com/questions/8582686/get-data-attribute-of-jquery-ui-selectable */


/* Create List Based on JSON */
/* https://amiv-apidev.vsos.ethz.ch/events?where={%22show_announce%22:%20true} */


$(document).ready(function(){
    $.getScript("https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css");
    $.getJSON( "https://amiv-apidev.vsos.ethz.ch/events", function( data ) {
	
	var html = "<ul id='sortableList'>";
	
	html += "<style>.selected{}li{width:20%;}</style>";
	
	$.each( data._items, function( key, val ) {
	    html +="<li id='" + this.id + "'>" + this.title_de + "</li>";
	});
	
	html += "</ul>";
	
	$( ".events" ).append(html);
	
	$("#sortableList").sortable();

	$("li").click(function(){
	    if($(this).css("background-color")=="rgb(255, 0, 0)"){
		$(this).css("background-color", "white");
		$(this).removeClass(".selected");
	    } else {
		$(this).css("background-color","red");
		$(this).addClass(".selected");
	    }
	});

	/* Get selected IDs */
	$('button').click(function() {
	    var arr = [];
	    var elements = document.getElementsByClassName(".selected");
	    $.each(elements, function(index, value){
		arr.push(this.id);
	    });

	    console.log(arr);
	    alert('id: ' + arr);
	});
    });
})

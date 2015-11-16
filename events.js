/*  List based on http://stackoverflow.com/questions/3390786/jquery-ui-sortable-selectable
    Selected IDs based on http://stackoverflow.com/questions/8582686/get-data-attribute-of-jquery-ui-selectable */


/* Create List Based on JSON */
/* https://amiv-apidev.vsos.ethz.ch/events?where={%22show_announce%22:%20true} */


$(document).ready(function(){
    $.getJSON( "https://amiv-apidev.vsos.ethz.ch/events", function( data ) {

	var posturl = "./request_announce.php";
	var out = "";
	
	var html = "<ul id='sortableList'>";
	
	html += "<style>.selected{}.featured{}li{width:20%; background-color:white;}</style>";
	
	$.each( data._items, function( key, val ) {
	    if(this.show_announce==true){
		html +="<li id='" + this.id + "'>" + this.title_de + " </li>";
	    }
	});
	
	html += "</ul>";
	
	$( ".events" ).append(html);
	
	$("#sortableList").sortable();
	
	$("li").click(function(){
	    if($(this).css("background-color")=="rgb(255, 0, 0)"){
		$(this).css("background-color", "rgb(0, 255, 0)");
		$(this).addClass(".featured");
	    } else if($(this).css("background-color")=="rgb(255, 255, 255)"){
		$(this).css("background-color","rgb(255, 0, 0)");
		$(this).addClass(".selected");
	    } else if($(this).css("background-color")=="rgb(0, 255, 0)"){
		$(this).css("background-color", "rgb(255, 255, 255)");
		$(this).removeClass(".selected");
		$(this).removeClass(".featured");
	    }
	});
	
	/* Get selected IDs */
	$('button').click(function() {
	    var arr_id = [];
	    var elements_id = document.getElementsByClassName(".selected");
	    var arr_feature = [];
	    var elements_feature = document.getElementsByClassName(".featured");
	    var err = 0;

	    err=0;
	    
	    $.each(elements_id, function(index, value){
		arr_id.push(this.id);
	    });
	    $.each(elements_feature, function(index, value){
		arr_feature.push(this.id);
	    });
	    console.log(arr_id);
	    console.log(arr_feature);
	    
	    if (arr_id.length != 0 && arr_feature.length == 2){
		out += posturl+"?";
		for(id in arr_id){
		    out += "id[]="+arr_id[id]+"&";
		}
		for(feature in arr_feature){
		    out += "feature[]="+arr_feature[feature];
		    if(feature != arr_feature.length-1){
			out += "&";
		    }
		}
		console.log(out);
		window.location = out;
	    } else if(arr_id.length == 0){
		alert("You have to select at least two events to be displayed.");
	    } else if(arr_feature.length != 2){
		alert("You have to select exactly two events to be featured.");
	    }
	});
    });
})

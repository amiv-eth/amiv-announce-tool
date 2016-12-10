/*  List based on http://stackoverflow.com/questions/3390786/jquery-ui-sortable-selectable
    Selected IDs based on http://stackoverflow.com/questions/8582686/get-data-attribute-of-jquery-ui-selectable */


/* Create List Based on JSON */
/* https://amiv-apidev.vsos.ethz.ch/events?where={%22show_announce%22:%20true} */

var URL = "http://192.168.1.100";
var events = URL + "/events"; 

// Concept: Get all event data from AMIV API, filter by show_announce tag, allow for some sorting and selecting of the displayed data, generate mail and finally post mail to mail server

$(document).ready(function(){
    $.getJSON( events, function( data ) {

	var out = "";
	
	var html = "<table class='table' id='mytable'><tbody class='sortableList'>";
	
	html += "<tr><th>ID</th><th>Title</th></tr>"; // Add all headers here
	$.each( data._items, function( key, val ) {
	    if(this.show_announce==true){ // Only display events which are selected to appear in the Announce
		html +="<tr class='clicky' id='" + this._id + "'><td  id='" + this._id + "'>" + this._id + "</td><td>"+this.title_en +" </td></tr>"; // List all display worthy data here
	    }
	});
	
	html += "</tbody></table>";
	
	$( function(){
	    $( "#events" ).append(html);
	});
	
	$('#events').on("click",  ".clicky", function(){ //Handle is events since the table is NOT in DOM and has to be accessed indirectly
	    if($(this).hasClass("selected")){
		$(this).removeClass("selected");
		$(this).addClass("featured");
	    } else if($(this).hasClass("featured")){
		$(this).removeClass("featured");
	    } else {
		$(this).addClass("selected");
	    }
	});

	$(  function() {
	    $(".sortableList").sortable(); // Make table rows sortable
	});
	
	$('button').click(function() {
	    var arr_id = [];
	    var elements_id = document.getElementsByClassName("selected");
	    var arr_feature = [];
	    var elements_feature = document.getElementsByClassName("featured");
	    
	    $.each(elements_id, function(index,value){
		arr_id.push(this.id);
	    });
	    $.each(elements_feature, function(index, value){
		arr_feature.push(this.id);
	    });
	    
	    console.log(arr_id);
	    console.log(arr_feature);
	    
	    if (arr_feature.length == 2){ // The selection is valid iff there are two featured events

		alert("Everything worked!");
		
/*		out += posturl+"?";
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
		window.location = out; */
	    } else if(arr_feature.length != 2){
		alert("You have to select exactly two events to be featured.");
	    }
	});
    });
}) 

/*  List based on http://stackoverflow.com/questions/3390786/jquery-ui-sortable-selectable
    Selected IDs based on http://stackoverflow.com/questions/8582686/get-data-attribute-of-jquery-ui-selectable */


/* Create List Based on JSON */
/* https://amiv-apidev.vsos.ethz.ch/events?where={%22show_announce%22:%20true} */

// Concept: Get all event data from AMIV API, filter by show_announce tag, allow for some sorting and selecting of the displayed data, generate mail and finally post mail to mail server

$(document).ready(function(){
    $.getJSON( generateURL('?where{\'show_announce\': true}'), function( data ) {

	var out = "";

	var html = "<table class='table' id='mytable'>";

	html += "<tr><thead>";
	html+= "<th>Title</th>";// Add all headers here
	html+= "<th>Description</th>";
	html+= "<th>Catchphrase</th>";
	html+= "<th>Location</th>";
	html+= "<th>Price</th>";
	html += "</tr></thead><tbody class='sortableList'>";
	
	$.each( data._items, function( key, val ) {
	    if(this.show_announce==true){ // Only display events which are selected to appear in the Announce
		html +="<tr class='clicky' id='" + this._id + "'>";
		html+= "<td>"+this.title_en +" </td>"; // List all display worthy data here
		html += "<td>"+this.description_en+"</td>";
		html += "<td>"+this.catchphrase_en+"</td>";
		html += "<td>"+this.location+"</td>";
		html += "<td>"+this.price+"</td>";
		html+= "</tr>";
	    }
	});

	html += "</tbody></table>";

	$( function(){
	    $( "#events" ).append(html);
	});

	$('#events').on("click",  ".clicky", function(){ //Handle is #events since the table is NOT in DOM and therefore has to be accessed indirectly
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
	    $(".sortableList").sortable("option","axis","y");
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

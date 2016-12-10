/*  List based on http://stackoverflow.com/questions/3390786/jquery-ui-sortable-selectable
    Selected IDs based on http://stackoverflow.com/questions/8582686/get-data-attribute-of-jquery-ui-selectable */


/* Create List Based on JSON */
/* https://amiv-apidev.vsos.ethz.ch/events?where={%22show_announce%22:%20true} */

var URL = "http://192.168.1.100";
var events = URL + "/events";

$(document).ready(function(){
    $.getJSON( events, function( data ) {

	var out = "";
	
	var html = "<table class='table' id='mytable'><tbody class='sortableList'>";
	
	html += "<tr><th>ID</th><th>Title</th></tr>";
	$.each( data._items, function( key, val ) {
	    if(this.show_announce==true){
		html +="<tr><td  id='" + this._id + "'><div>" + this._id + "</td><td>"+this.title_en +" </td></div></tr>";
	    }
	});
	
	html += "</tbody></table>";
	
	$( function(){
	    $( "#events" ).append(html);
	});
	$(  function() {
	    $(".sortableList").sortable();
	});

	
	$("div").click(function(){
	    
	    if($(this).hasClass("featured")){
		$(this).removeClass("featured");
	    } else{
		$(this).addClass("featured").siblings().removeClass("featured");
	    }
	    
	    /*if(!($(this).hasClass(".featured"))){
		$(this).css("background-color", "rgb(0, 255, 0)");
		$(this).addClass(".featured");
	    }  else if($(this).css("background-color")=="rgb(0, 255, 0)"){
		$(this).css("background-color", "rgb(255, 255, 255)");
		$(this).removeClass(".selected");
		$(this).removeClass(".featured");
	    } else {
		$(this).css("background-color","rgb(255, 0, 0)");
		$(this).addClass(".selected");
	    }*/
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

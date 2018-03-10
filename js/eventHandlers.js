import { generateURL } from './config.js'
import { doRender } from './doRender.js'
var $ = require('jquery')
require('featherlight')
require('jquery-ui')
require('jquery-ui/ui/widgets/sortable')

/*  List based on http://stackoverflow.com/questions/3390786/jquery-ui-sortable-selectable
    Selected IDs based on http://stackoverflow.com/questions/8582686/get-data-attribute-of-jquery-ui-selectable */


/* Create List Based on JSON */
/* https://amiv-apidev.vsos.ethz.ch/events?where={%22show_announce%22:%20true} */

// Concept: Get all event data from AMIV API, filter by show_announce tag, allow for some sorting and selecting of the displayed data, generate mail and finally post mail to mail server

// Selected elements
var arr_id = [];
var arr_feature = [];

var hasRendered = false;

export function wasRenderedOnce() {
  return hasRendered;
}

export function render() {

  hasRendered = true;

  /*
    Refresher helper
    Refreshes the selected data
  */
  function refreshSelected() {
    // Reset elements
    arr_id = [];
    arr_feature = [];

    // Get all selected events
    var elements_id = document.querySelectorAll('.selected,.featured');
    var elements_feature = document.getElementsByClassName("featured");

    arr_id = $('.selected, .featured').map(function(i) {
      return this.id;
    }).get();
    arr_feature = $('.featured').map(function(i) {
      return this.id;
    }).get();

    console.log(arr_id);
    console.log(arr_feature);
  }
  /*
    Request data
    Get current events from the API
    @todo: Eww, that looks dirty... should be tidied up somewhen
  */
  $.getJSON( generateURL('?where{\'show_announce\': true}'), function(data) {

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
  	  if(this.show_announce==true)
      { // Only display events which are selected to appear in the Announce
    		html +="<tr class='clicky selected' id='" + this._id + "'>";
    		html+= "<td>"+this.title_en +" </td>"; // List all display worthy data here (with its english title)
    		html += "<td class='clickdescription'><a href='#' data-featherlight='<div>"+this.description_en+"</div>'>Click here to read</td>";
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

    /*
      Event list
      Can be selected, featured or deselected
    */
  	$('#events').on("click",  ".clicky", function(e){ //Handle is #events since the table is NOT in DOM and therefore has to be accessed indirectly
	    if($(this).hasClass("selected"))
      {
    		$(this).removeClass("selected");
    		$(this).addClass("featured");
	    }
      else if($(this).hasClass("featured"))
      {
        $(this).removeClass("featured");
	    }
      else
      {
        $(this).addClass("selected");
	    }
    });

  	$(function() {
      $(".sortableList").sortable(); // Make table rows sortable
  	  $(".sortableList").sortable("option","axis","y");
  	});

  	$('#reset').click(function() {
      if(confirm("Are you sure you want to delete your selection?"))
      {
        $(".clicky").removeClass("featured");
        $(".clicky").addClass("selected");
  	  }
  	});

    /*
      Preview selected
      Renders data and shows it in overlay
    */
    $('#preview').click(function() {
      refreshSelected();
      doRender(arr_id, arr_feature, function(){
        $.featherlight($('#target').val());
      });
    });

    /*
      Send selected
      Renders data and sends it to the mail handler
    */
    $('#send').click(function() {
      refreshSelected();
      doRender(arr_id, arr_feature, function() {
        if(confirm("Are you sure you want to send the Announce?"))
        {
          $.post(mailHandler,
            {
              msg: $('#target').val(),
              sub: $('#MailTitle').val()
            },
            function() {
            // Success function
            // @todo: Tell API to deselect sent entries
            $(".clicky").removeClass("featured");
            $(".clicky").removeClass("selected");
          }).fail(function() {
            alert("Oh no, something went wrong!")
          });
        }
      });
    });
  });
}

$(document).ready(render)

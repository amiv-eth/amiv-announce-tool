/*  List based on http://stackoverflow.com/questions/3390786/jquery-ui-sortable-selectable
    Selected IDs based on http://stackoverflow.com/questions/8582686/get-data-attribute-of-jquery-ui-selectable */


/* Create List Based on JSON */
/* https://amiv-apidev.vsos.ethz.ch/events?where={%22show_announce%22:%20true} */
$.getJSON( "https://amiv-apidev.vsos.ethz.ch/events", function( data ) {

  var html = "<ul id='sortableList'>";

  $.each( data._items, function( key, val ) {
    html += "<li id='" + this.id + "'>Event ID " + this.id + "</li>";
  });

  html += "</ul>";

  $( ".events" ).append(html);


  /* Make List sortable */
  $( "#sortableList" )
      .sortable({ handle: ".handle" })
      .selectable({ filter: "li", cancel: ".handle" })
      .find( "li" )
          .addClass( "ui-corner-all" )
          .prepend( "<div class='handle'><span class='ui-icon ui-icon-carat-2-n-s'></span></div>"
  );


  /* Get selected IDs */
  $('button').click(function() {
      var ids = $('.ui-selected').map(function() {
          return this.id;
      });
      alert('id: ' + ids.toArray().join(','));
  });

});

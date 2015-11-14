$( "body" ).append( "<p>Test</p>" );

$.getJSON( "https://amiv-apidev.vsos.ethz.ch/events", function( data ) {

  var items = [];

  $.each( data._items, function( key, val ) {
    items.push( "<li id='" + key + "'>" + this._created + "</li>" );
  });

  $( "<ul/>", {
    "class": "my-new-list",
    html: items.join( "" )
  }).appendTo( ".events" );

});

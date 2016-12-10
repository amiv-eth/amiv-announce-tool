$(document).ready(function() {

  // Get JSON file with test data
  $.getJSON(generateURL('?where{\'show_announce\': true}'), function(data) {

  }).done(function(data) {
    // Render data with templates
    $.get('./templates/header.html', function(template) {
      var rendered = Mustache.render(template, data);
      $('#target').html(rendered);
    }, 'html');

    $.get('./templates/logo.html', function(template) {
      var rendered = Mustache.render(template, data);
      $('#target').append(rendered);
    }, 'html');

    $.get('./templates/agenda.html', function(template) {
      var rendered = Mustache.render(template, data);
      $('#target').append(rendered);
    }, 'html');

    $.get('./templates/articles.html', function(template) {
      var rendered = Mustache.render(template, data);
      $('#target').append(rendered);
    }, 'html');

    $.get('./templates/footer.html', function(template) {
      var rendered = Mustache.render(template, data);
      $('#target').append(rendered);
    }, 'html');
  });

});

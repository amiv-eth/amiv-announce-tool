var selectedData;
var featuredData;

function doRender(selectedIDs, featuredIDs) {

  // Prepare array with quotation marks
  // based on https://stackoverflow.com/questions/8483179/javascript-array-as-a-list-of-strings-preserving-quotes
  var IDs = '"' + selectedIDs.join('","') + '"';

  // Get JSON file with test data
  $.getJSON(generateURL('?where={"_id": { "$in":[' + IDs + '] } }'), function(data) {

  }).done(function(data) {
    selectedData = prepareJSON(data);
    renderhelp();
  });

//same thing as above but for the featured IDs. Renderhelp is called here and above, as it is not known which data is ready first.
//the renderhelp function then checks both data are available before executing so that the data is rendered in the right order
  IDs = '"' + featuredIDs.join('","') + '"';
  $.getJSON(generateURL('?where={"_id": { "$in":[' + IDs + '] } }'), function(data) {

  }).done(function(data) {
    featuredData = prepareJSON(data);
    renderhelp();
  });

}

//this function renders the data. It checks that both data are available else it aborts to wait for the next call when the data should be ready
// (the function is called twice from above as it is not known which data will be ready first)
// It is necessary for both data to be ready so that the data is rendered in the right order with the featured events between rest.
function renderhelp() {
      if (typeof selectedData == "undefined" || typeof featuredData == "undefined") {
        return;
      }
      // Render data with templates
      $.get('./templates/header.html', function(template) {
        var rendered = Mustache.render(template, selectedData);
        $('#target').html(rendered);
      }, 'html');

      $.get('./templates/logo.html', function(template) {
        var rendered = Mustache.render(template, selectedData);
        $('#target').append(rendered);
      }, 'html');


      $.get('./templates/featured.html', function(template) {
        var rendered = Mustache.render(template, featuredData); //uses featureData
        $('#target').append(rendered);
      }, 'html');


      $.get('./templates/agenda.html', function(template) {
        var rendered = Mustache.render(template, selectedData);
        $('#target').append(rendered);
      }, 'html');

      $.get('./templates/articles_de.html', function(template) {
        var rendered = Mustache.render(template, selectedData);
        $('#target').append(rendered);
      }, 'html');
      $.get('./templates/articles_en.html', function(template) {
        var rendered = Mustache.render(template, selectedData);
        $('#target').append(rendered);
      }, 'html');


      $.get('./templates/footer.html', function(template) {
        var rendered = Mustache.render(template, selectedData);
        $('#target').append(rendered);
      }, 'html');
}

var selectedData;
var featuredData;
var targetElement;

function doRender(selectedIDs, featuredIDs) {

  // Prepare array with quotation marks
  // based on https://stackoverflow.com/questions/8483179/javascript-array-as-a-list-of-strings-preserving-quotes
  var IDs = '"' + selectedIDs.join('","') + '"';

  // Get JSON file with test data
  $.getJSON(generateURL('?where={"_id": { "$in":[' + IDs + '] } }'), function(data) {

  }).done(function(data) {
    selectedData = prepareJSON(data);
    renderhelp(7);
  });

//same thing as above but for the featured IDs. Renderhelp is called here and above, as it is not known which data is ready first.
//the renderhelp function then checks both data are available before executing so that the data is rendered in the right order
  IDs = '"' + featuredIDs.join('","') + '"';
  $.getJSON(generateURL('?where={"_id": { "$in":[' + IDs + '] } }'), function(data) {

  }).done(function(data) {
    featuredData = prepareJSON(data);
    renderhelp(7);
  });


}

//this function renders the data. It checks that both data are available else it aborts to wait for the next call when the data should be ready
// (the function is called twice from above as it is not known which data will be ready first)
// It is necessary for both data to be ready so that the data is rendered in the right order with the featured events between rest.
function renderhelp(renderProgress) {
      if (typeof selectedData == "undefined" || typeof featuredData == "undefined") {
        return;
      }
    //  targetElement = $('div');
      targetElement = $('#target');

      // Render data with templates
      switch(renderProgress){
      case 7:
       $.get('./templates/header.html', function(template) {
        var rendered = Mustache.render(template, selectedData);
        //write in Target space(index.html)
        targetElement.html(rendered);
        renderhelp(renderProgress-1);
        }, 'html');
        break;
      case 6:
      $.get('./templates/logo.html', function(template) {
        var rendered = Mustache.render(template, selectedData);
        targetElement.append(rendered);
        renderhelp(renderProgress-1);
        }, 'html');
        break;
      case 5:
      $.get('./templates/featured.html', function(template) {
        var rendered = Mustache.render(template, featuredData); //uses featureData
        targetElement.append(rendered);
        renderhelp(renderProgress-1);
        }, 'html');
        break;
      case 4:
        $.get('./templates/agenda.html', function(template) {
        var rendered = Mustache.render(template, selectedData);
        targetElement.append(rendered);
        renderhelp(renderProgress-1);
        }, 'html');
        break;
      case 3:
        $.get('./templates/articles_de.html', function(template) {
        var rendered = Mustache.render(template, selectedData);
        targetElement.append(rendered);
        renderhelp(renderProgress-1);
        }, 'html');
        break;
      case 2:
        $.get('./templates/articles_en.html', function(template) {
        var rendered = Mustache.render(template, selectedData);
        targetElement.append(rendered);
        renderhelp(renderProgress-1);
        }, 'html');
        break;
      case 1:
        $.get('./templates/footer.html', function(template) {
        var rendered = Mustache.render(template, selectedData);
        targetElement.append(rendered);
        renderhelp(renderProgress-1);
        }, 'html');
      break;
      case 0:
          selectedData = undefined;
          featuredData = undefined;

          $.featherlight(targetElement);
      break;
    }
 }

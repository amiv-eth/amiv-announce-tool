import { generateURL } from './config.js'
import { prepareJSON } from './prepareJSON.js'
var $ = require('jquery')
import { render } from 'mustache'
import header from '../templates/header.html';
import logo from '../templates/logo.html';
import featured from '../templates/featured.html';
import agenda from '../templates/agenda.html';
import articles_de from '../templates/articles_de.html';
import articles_en from '../templates/articles_en.html';
import footer from '../templates/footer.html';


var selectedData;
var featuredData;
var targetElement;

export function doRender(selectedIDs, featuredIDs, callback) {
  // Prepare array with quotation marks
  // based on https://stackoverflow.com/questions/8483179/javascript-array-as-a-list-of-strings-preserving-quotes
  var IDs = '"' + selectedIDs.join('","') + '"';

  // Get JSON file with test data
  $.getJSON(generateURL('?where={"_id": { "$in":[' + IDs + '] } }'), function(data) {

  }).done(function(data) {
    selectedData = prepareJSON(data);
    renderhelp(7, callback);
  });

//same thing as above but for the featured IDs. Renderhelp is called here and above, as it is not known which data is ready first.
//the renderhelp function then checks both data are available before executing so that the data is rendered in the right order
  IDs = '"' + featuredIDs.join('","') + '"';
  $.getJSON(generateURL('?where={"_id": { "$in":[' + IDs + '] } }'), function(data) {

  }).done(function(data) {
    featuredData = prepareJSON(data);
    renderhelp(7, callback);
  });


}

//this function renders the data. It checks that both data are available else it aborts to wait for the next call when the data should be ready
// (the function is called twice from above as it is not known which data will be ready first)
// It is necessary for both data to be ready so that the data is rendered in the right order with the featured events between rest.
// @todo: Tidier to use Deferred objects?
function renderhelp(renderProgress, callback) {
  if (typeof selectedData == "undefined" || typeof featuredData == "undefined") {
    return;
  }
  //  targetElement = $('div');
  targetElement = $('#target');

  // Render data with templates
  switch(renderProgress){
  case 7:
   $.get(header, function(template) {
    var rendered = render(template, selectedData);
    //write in Target space(index.html)
    targetElement.val(rendered);
    renderhelp(renderProgress-1, callback);
    }, 'html');
    break;
  case 6:
  $.get(logo, function(template) {
    var rendered = render(template, selectedData);
    targetElement.val(targetElement.val() + rendered);
    renderhelp(renderProgress-1, callback);
    }, 'html');
    break;
  case 5:
  $.get(featured, function(template) {
    var rendered = render(template, featuredData); //uses featureData
    targetElement.val(targetElement.val() + rendered);
    renderhelp(renderProgress-1, callback);
    }, 'html');
    break;
  case 4:
    $.get(agenda, function(template) {
    var rendered = render(template, selectedData);
    targetElement.val(targetElement.val() + rendered);
    renderhelp(renderProgress-1, callback);
    }, 'html');
    break;
  case 3:
    $.get(articles_de, function(template) {
    var rendered = render(template, selectedData);
    targetElement.val(targetElement.val() + rendered);
    renderhelp(renderProgress-1, callback);
    }, 'html');
    break;
  case 2:
    $.get(articles_en, function(template) {
    var rendered = render(template, selectedData);
    targetElement.val(targetElement.val() + rendered);
    renderhelp(renderProgress-1, callback);
    }, 'html');
    break;
  case 1:
    $.get(footer, function(template) {
    var rendered = render(template, selectedData);
    targetElement.val(targetElement.val() + rendered);
    renderhelp(renderProgress-1, callback);
    }, 'html');
  break;
  case 0:
      selectedData = undefined;
      featuredData = undefined;
      callback();
  break;
  }
}



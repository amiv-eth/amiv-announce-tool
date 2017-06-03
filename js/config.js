/*
Config file
*/

var baseURL = "https://amiv-apidev.vsos.ethz.ch/";
var directory = "events"

function generateURL(filter = '')
{
  return baseURL + directory + filter;
}

/*
@brief: Config file
*/

var baseURL = "https://amiv-apidev.vsos.ethz.ch/";
var directory = "events";

var mailHandler = "https://mail.handler.url/";

function generateURL(filter = '')
{
  return baseURL + directory + filter;
}

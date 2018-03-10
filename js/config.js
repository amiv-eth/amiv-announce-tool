/*
@brief: Config file
*/

var baseURL = "https://amiv-api.ethz.ch/";
var directory = "events";

var mailHandler = "http://192.168.1.9:5000/mailer";

function generateURL(filter = '')
{
  return baseURL + directory + filter;
}

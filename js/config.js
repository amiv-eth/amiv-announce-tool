/*
@brief: Config file
*/

var baseURL = "https://amiv-apidev.vsos.ethz.ch/";
var directory = "events";

var mailHandler = "http://192.168.1.9:5000/mailer";

export function generateURL(filter = '')
{
  return baseURL + directory + filter;
}

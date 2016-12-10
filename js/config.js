/*
Config file
*/

var baseURL = "http://192.168.1.100/";
var directory = "events"

function generateURL(filter = '')
{
  return baseURL + directory + filter;
}

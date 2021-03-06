/*
@brief: Add formatted date and time for English and German readers.
        Also we need to sort the array again by ID.

Source for two digit date/month: https://stackoverflow.com/questions/6040515/how-do-i-get-month-and-date-of-javascript-in-2-digit-format
*/

import logo from '../images/logo_announce.png'
import css from '../css/announce.css'

function makeDateNamed_en(inDate){
  var monthNames = ["January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"];
  return (("0" + inDate.getDate()).slice(-2) + " "
                              + monthNames[inDate.getMonth()] + " "
                              + inDate.getHours() + ":"
                              + inDate.getMinutes()
                            );
}

function makeDateNamed_de(inDate) {
  var monthNames = ["Januar", "Februar", "März", "April", "Mai", "Juni",
    "Juli", "August", "September", "October", "November", "Dezember"];
  return (("0" + inDate.getDate()).slice(-2) + " "
                              + monthNames[inDate.getMonth()] + " "
                              + inDate.getHours() + ":"
                              + inDate.getMinutes()
                            );
}

function makeDate(inDate){
  return  ("0" + inDate.getDate()).slice(-2) + "/"
                              + ("0" + (inDate.getMonth() + 1)).slice(-2) + ", "
                              + inDate.getHours() + ":"
                              + inDate.getMinutes();

}


export function prepareJSON(selectedData, selectedIDs)
{
  // Used for sorting according to the selectedIDs
  var preparedData = {};
  preparedData._items = [];
  var position = 0;

  // Add formatted date and time
  selectedData._items.forEach(function(item) {
    var startTime = new Date(item.time_start);
    var startRegister = new Date(item.time_register_start);

    item.time_start_de =  makeDate(startTime);
    item.time_start_en = makeDateNamed_en(startTime);

    item.time_register_start_de = makeDateNamed_de(startRegister);
    item.time_register_start_en = makeDateNamed_en(startRegister);

    // Look which position it has according to the sorted list of IDs
    item.position = $.inArray(item._id, selectedIDs);
    // console.log(item._id + " is at position " + item.position + " in " + selectedIDs);
    preparedData._items[item.position] = item;
  });

  // Add today's date for the header
  var now = new Date();
  preparedData.today = now.getDay() + "/" + now.getMonth() + "/" + now.getFullYear();
  preparedData.logo = logo;
  preparedData.announceCss = css;

  return preparedData;
}

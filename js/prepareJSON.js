/*
@brief: Add formatted date and time for English and German readers.

Source for two digit date/month: https://stackoverflow.com/questions/6040515/how-do-i-get-month-and-date-of-javascript-in-2-digit-format
*/

function makeDateNamed_en(inDate){
  var monthNames = ["January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"
  ];
  return  (("0" + inDate.getDate()).slice(-2) + " "
                              + monthNames[inDate.getMonth()] + " "
                              + inDate.getHours() + ":"
                              + inDate.getMinutes()
                            );
}

function makeDateNamed_de(inDate){
  var monthNames = ["Januar", "Februar", "März", "April", "Mai", "Juni",
    "Juli", "August", "September", "October", "November", "Dezember"
  ];
  return  (("0" + inDate.getDate()).slice(-2) + " "
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


function prepareJSON(selectedData)
{
  console.log(selectedData);


  selectedData._items.forEach(function(item) {
    var startTime = new Date(item.time_start);
    var startRegister = new Date(item.time_register_start);

    item.time_start_de =  makeDate(startTime);

    item.time_start_en = makeDateNamed_en(startTime);

    item.time_register_start_de = makeDateNamed_de(startRegister);

    item.time_register_start_en = makeDateNamed_en(startRegister);
  });

  return selectedData;
}

/*
@brief: Add formatted date and time for English and German readers.

Source for two digit date/month: https://stackoverflow.com/questions/6040515/how-do-i-get-month-and-date-of-javascript-in-2-digit-format
*/

function prepareJSON(selectedData)
{
  console.log(selectedData);


  selectedData._items.forEach(function(item) {
    var startTime = new Date(item.time_start);
    var startRegister = new Date(item.time_register_start);

    item.time_start_de = ("0" + startTime.getDate()).slice(-2) + "."
                                + ("0" + (startTime.getMonth() + 1)).slice(-2) + ", "
                                + startTime.getHours() + ":"
                                + startTime.getMinutes();

    item.time_start_en = ("0" + startTime.getDate()).slice(-2) + "/"
                                + ("0" + (startTime.getMonth() + 1)).slice(-2) + ", "
                                + startTime.getHours() + ":"
                                + startTime.getMinutes();

    item.time_register_start_de = ("0" + startRegister.getDate()).slice(-2) + "."
                                + ("0" + (startRegister.getMonth() + 1)).slice(-2) + ", "
                                + startRegister.getHours() + ":"
                                + startRegister.getMinutes();

    item.time_register_start_en = ("0" + startRegister.getDate()).slice(-2) + "/"
                                + ("0" + (startRegister.getMonth() + 1)).slice(-2) + ", "
                                + startRegister.getHours() + ":"
                                + startRegister.getMinutes();
  });

  return selectedData;
}

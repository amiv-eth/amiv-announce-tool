/*
For the given event JSON and the given ID array filter the corresponding entries.
Accepts language input en/de.
Shorten language keys so that we can use the same template for all languages.
Then style the date.
@todo: test!
*/

function prepareJSON(selectedData, lang)
{

  // // Get raw data of the selected IDs
  // var selectedData;
  // $.getJSON(generateURL('?where={"_id": { \'$in\':' + listID + '\' } }'), function(data) {
  //
  // }).done(function(data) {
  //   selectedData = data;
  // });

  console.log(selectedData['_items']);

  // Go through JSON and delete all unnecessary language tags. Also add helper
  // function to get the right date.
  // Based on https://stackoverflow.com/questions/13391579/how-to-rename-json-key
  // @todo: do for all elements!
  var obj = JSON.parse(selectedData[_items]);
  console.log(obj);

  if(lang = 'en')
  {
    alert('en');
    obj.title = obj.title_en;
    obj.catchphrase = obj.catchphrase_en;
    obj.description = obj.description_en;

    delete obj.title_en, obj.catchphrase_en, obj.description_en;

    // var startTime = new Date(obj.time_register_start);
    // obj.start_time = startTime;
  }
  else
  {
    obj.title = obj.title_de;
    obj.catchphrase = obj.catchphrase_de;
    obj.description = obj.description_de;

    delete obj.title_de, obj.catchphrase_de, obj.description_de;

    // var startTime = new Date(obj.time_register_start);
    // obj.start_time = startTime;
  }

  selectedData = JSON.stringify([obj]);

  return selectedData;
}

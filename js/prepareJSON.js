/*
For the given event JSON and the given ID array filter the corresponding entries.
Accepts language input en/de.
*/

function(listID, lang)
{

  // Get raw data of the selected IDs
  var selectedData;
  $.getJSON(generateURL('?where={"_id": { \'$in\':' + listID + '\' } }'), function(data) {

  }).done(function(data) {
    selectedData = data;
  });

  // Go through JSON and delete all unnecessary language tags. Also add helper
  // function to get the right date.
  // Based on https://stackoverflow.com/questions/13391579/how-to-rename-json-key
  var obj = JSON.parse(selectedData)[0];

  if(lang = 'en')
  {
    obj.title = obj.title_en;
    obj.catchphrase = obj.catchphrase_en;
    obj.description = obj.description_en;

    delete obj.title_en, obj.catchphrase_en, obj.description_en;
  }
  else
  {
    obj.title = obj.title_de;
    obj.catchphrase = obj.catchphrase_de;
    obj.description = obj.description_de;

    delete obj.title_de, obj.catchphrase_de, obj.description_de;
  }

  selectedData = JSON.stringify([obj]);

  return selectedData;
}

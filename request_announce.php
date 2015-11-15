<?php

// This script gets event-ids via HTTP-GET from the AMIV announce tool, queries the API and posts an array containing the relevant data to the following program in the toolchain
// The get variables have to be given in the following way: ?id[]=21&id[]=22&id[]=23&id[]=24&id[]=25&id[]=26&id[]=27&id[]=28&id[]=29&feature[]=24&feature[]=25
// The variables are meant to be given by an admin tool

if(empty($_GET['id']) || empty($_GET['feature'])){
    echo "You need to call this program with the admin tool\n";
}else{

$input = $_GET['id']; //Use get on URL
$feature = $_GET['feature'];
$out = []; // Initialize output
$feature1 = [];
$feature2 = [];

$baseurl = "https://amiv-apidev.vsos.ethz.ch";
$targeturl = "http://localhost/template.php"; // Temporary 
// Takes date from API
function name_of_month($date) {
    $month_num = date_format($date, "n");
    switch ($month_num) {
        case 1:
            return "Januar";
        case 2:
            return "Februar";
        case 3:
            return "März";
        case 4:
            return "April";
        case 5:
            return "Mai";
        case 6:
            return "Juni";
        case 7:
            return "Juli";
        case 8:
            return "August";
        case 9:
            return "September";
        case 10:
            return "Oktober";
        case 11:
            return "November";
        case 12:
            return "Dezember";
    }
}

function name_of_day($date) {
    $day_num = date_format($date, "N");
    switch ($day_num) {
        case 1:
            return "Montag";
        case 2:
            return "Dienstag";
        case 3:
            return "Mittwoch";
        case 4:
            return "Donnerstag";
        case 5:
            return "Freitag";
        case 6:
            return "Samstag";
        case 7:
            return "Sonntag";
    }
}

foreach ($input as $id) {

    $url = $baseurl . "/events/" . $id;

    //Send HTTP-GET via curl
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_REFERER, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($curl, CURLOPT_HTTPGET, TRUE);
    $result = curl_exec($curl);
    curl_close($curl);

    $decoded = json_decode($result, true); // Decode returned data
    // Define variables
    $title_de = $decoded['title_de'];
    $title_en = $decoded['title_en'];
    $catchphrase_de = $decoded['catchphrase_de'];
    $catchphrase_en = $decoded['catchphrase_en'];
    $location = $decoded['location'];
    $description_de = $decoded['description_de'];
    $description_en = $decoded['description_en'];
    $price = $decoded['price'];
    $signuplink = $baseurl . "/eventsignups/" . $id;
    $time_start = $decoded['time_start'];
    $time_end = $decoded['time_end'];
    $image = $decoded['img_thumbnail'];

    $push_name = "id" . $decoded['id'];

    // Specify array to be returned
    $push = ["image" => $image, "title_de" => $title_de, "title_en" => $title_en, "catchphrase_de" => $catchphrase_de, "catchphrase_en" => $catchphrase_en, "location" => $location, "description_de" => $description_de, "description_en" => $description_en, "price" => $price, "signuplink" => $signuplink, "time_start" => $time_start, "time_end" => $time_end];
    $entries[$push_name] = $push;

    if ($decoded['id'] == $feature[0]) {
        $feature1 = $push; 
    }elseif($decoded['id'] == $feature[1]) {
            $feature2 = $push;
        }
    }



    $date = 11;
    $month = "November";

// !!! Please be warned: the following is very adhoc and not at all meant to be readable !!!

    function entry_full_de(array $obj) { // List full entries in german
        echo "                      <tr>
				  <td valign='top'>
				    <table cellspacing='0' cellpadding='0' border='0' align='center' width='100%'>
				      <tbody>
					<tr><!--- Ext. Reference  !--->
					  <td height='49' width='100%' valign='middle' bgcolor='#c8cfd8' background='https://www.amiv.ethz.ch/sites/all/modules/amivannounce/images/article-title-bg.png' style='vertical-align:middle; border-left-width: 1px; border-left-color: #BAC2CC; border-left-style: solid; border-right-width: 1px; border-right-color: #BAC2CC; border-right-style: solid; border-bottom-width: 1px; border-bottom-color: #98a3b4; border-bottom-style: solid; border-top-width: 1px; border-top-color: #BAC2CC; border-top-style: solid;'>
					    <h3 class='textshadow' style='margin:0; margin-left: 17px; padding:0; font-size: 18px; font-weight: normal; color:#324258;'>
					      " . $obj['title_de'] . "<small>" . " [" . $obj['catchphrase_de'] . "]" . "</small><br><!--- Ext. Reference  !--->
					      <small>";
        if (date_format(new DateTime($obj['time_end']), "d.m.y") != date_format(new DateTime($obj['time_start']), "d.m.y")) {
            echo date_format(new DateTime($obj['time_start']), "d") . ". - " . date_format(new DateTime($obj['time_end']), "d.m.y");
        } else {
            echo name_of_day(new DateTime($obj['time_start'])) . " " . date_format(new DateTime($obj['time_start']), "d.m.y H:i");
        } echo " // " . $obj['location'] . " // " . $obj['price'] . " // <a href='" . $obj['signuplink'] . "'>Anmeldung</a></small> </h3>
					  </td>
					</tr>
					<tr>
					  <td valign='top' bgcolor='#edeff2' style='padding-top: 20px; padding-bottom: 15px; padding-left: 21px; padding-right: 21px; border-width: 1px; border-color: #bac2cc; border-style: solid;'>
					    <table cellspacing='0' cellpadding='0' border='0' align='left' width='100%'>
					      <tbody>
						<tr><!--- Ext. Reference  !--->
						  <td valign='top' style='padding-right: 20px;' width='150'>
						    <p><img src='" . $obj['image'] . "' alt='imgtitle' align='left' style='border-width: 3px; border-style: solid; border-color: #ffffff;'>
						    </p>
						  </td>
						  <td style='font-size: 12px; line-height: 20px; font-weight: normal; color: #56667d; margin: 0;'>
						    <!--<p style='font-size: 12px; line-height: 20px; font-weight: normal; color: #56667d; margin: 0; margin-bottom: 10px;'>-->
						    <p>" . $obj['description_de'] . "</p>
						    <!--</p>--></td>
						</tr>
					      </tbody>
					    </table>
					  </td>
					</tr>
				      </tbody>
				    </table>
				  </td>
				</tr>";
    }

    function entry_full_en(array $obj) { // List full entries in english
        echo "                      <tr>
				  <td valign='top'>
				    <table cellspacing='0' cellpadding='0' border='0' align='center' width='100%'>
				      <tbody>
					<tr><!--- Ext. Reference  !--->
					  <td height='49' width='100%' valign='middle' bgcolor='#c8cfd8' background='https://www.amiv.ethz.ch/sites/all/modules/amivannounce/images/article-title-bg.png' style='vertical-align:middle; border-left-width: 1px; border-left-color: #BAC2CC; border-left-style: solid; border-right-width: 1px; border-right-color: #BAC2CC; border-right-style: solid; border-bottom-width: 1px; border-bottom-color: #98a3b4; border-bottom-style: solid; border-top-width: 1px; border-top-color: #BAC2CC; border-top-style: solid;'>
					    <h3 class='textshadow' style='margin:0; margin-left: 17px; padding:0; font-size: 18px; font-weight: normal; color:#324258;'>
					      " . $obj['title_en'] . "<small>" . " [" . $obj['catchphrase_en'] . "]" . "</small><br><!--- Ext. Reference  !--->
					      <small>";
        if (date_format(new DateTime($obj['time_end']), "d.m.y") != date_format(new DateTime($obj['time_start']), "d.m.y")) {
            echo date_format(new DateTime($obj['time_start']), "d") . ". - " . date_format(new DateTime($obj['time_end']), "d.m.y");
        } else {
            echo name_of_day(new DateTime($obj['time_start'])) . " " . date_format(new DateTime($obj['time_start']), "d.m.y H:i");
        } echo " // " . $obj['location'] . " // " . $obj['price'] . " // <a href='" . $obj['signuplink'] . "'>Signup</a></small> </h3>
					  </td>
					</tr>
					<tr>
					  <td valign='top' bgcolor='#edeff2' style='padding-top: 20px; padding-bottom: 15px; padding-left: 21px; padding-right: 21px; border-width: 1px; border-color: #bac2cc; border-style: solid;'>
					    <table cellspacing='0' cellpadding='0' border='0' align='left' width='100%'>
					      <tbody>
						<tr><!--- Ext. Reference  !--->
						  <td valign='top' style='padding-right: 20px;' width='150'>
						    <p><img src='" . $obj['image'] . "' alt='imgtitle' align='left' style='border-width: 3px; border-style: solid; border-color: #ffffff;'>
						    </p>
						  </td>
						  <td style='font-size: 12px; line-height: 20px; font-weight: normal; color: #56667d; margin: 0;'>
						    <!--<p style='font-size: 12px; line-height: 20px; font-weight: normal; color: #56667d; margin: 0; margin-bottom: 10px;'>-->
						    <p>" . $obj['description_en'] . "</p>
						    <!--</p>--></td>
						</tr>
					      </tbody>
					    </table>
					  </td>
					</tr>
				      </tbody>
				    </table>
				  </td>
				</tr>";
    }

    function entry_agenda(array $obj) { // Generic template for Agenda entry
        echo "<tr>
						  <td width='45%'>
						    <p style='font-size: 12px;  font-weight: normal; color: #56667d; margin: 0;margin-left:17px;'>" .
        date_format(new DateTime($obj['time_start']), "d.m.y H:i") . " :: " . $obj['title_de'] . "</p>
						  </td>
						  <td><!--- Ext. Reference  !--->
						    <p style='font-size: 12px; font-weight: normal; color: #56667d; margin: 0;margin-left:17px;'>
						      Wo: " . $obj['location'] . " |  <a href=" . $obj['signuplink'] . ">
							Anmeldung</a> </p>
						  </td>
						</tr>";
    }

    function announce_top($month, $date) { //Part where only day and month are dynamic
        echo "
<!DOCTYPE html PUBLIC '-//W3C//DTD HTML 4.01//EN' 'http://www.w3.org/TR/html4/strict.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml' xml:lang='en'>
  <head>
    <meta http-equiv='Content-Type' content='text/html; charset=3DWindows-1252'>
    <meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='pragma' content='no-cache'>
    <meta http-equiv='expires' content='0'>
    <title>Amiv Announce</title>
    <!--general stylesheet--><style type='text/css'>
      p { font-size:12px; margin:0; margin-bottom: 10px; padding: 0;}
      h1, h2, h3, p, li { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; }
      td { vertical-align:top;}
      ul, ol { margin: 0; padding: 0;}
      .title, .date {
      text-shadow: #005 0px 1px 0px;
      }
      =09
      .textshadow {
      text-shadow: #ffffff 0px 1px 0px;
      }
      .trxtshadow-2 {
      text-shadow: #768296 0px -1px 0px;
      }
      li {
      font-size: 12px;  font-weight: normal; color: #56667d; margin: 0;list-style:none;
      }
    </style><script type='text/javascript'>
      function setHeight() {
      parent.document.getElementById('announceFrame').height =3D document['body'].offsetHeight;
      }
      window.onload =3D setHeight;
    </script>
  </head>
  <body marginheight='0' topmargin='0' marginwidth='0' leftmargin='0' background='' style='margin: 0px; background-color: #eee; background-image: url(\'\'); background-repeat: repeat;' bgcolor=''>
    <table cellspacing='0' border='0' cellpadding='0' width='100%'>
      <tbody>
	<tr valign='top'>
	  <td valign='top'><!--container-->
	    <table cellspacing='0' cellpadding='0' border='0' align='center' width='629px'>
	      <tbody>
		<tr> <!-- Ext. Reference  -->
		  <td valign='middle' height='149' bgcolor='56667d' background='https://www.amiv.ethz.ch/sites/all/modules/amivannounce/images/header-bg.jpg' style='vertical-align: middle;'>
		    <table cellspacing='0' cellpadding='0' border='0' align='center' width='595' height='149'>
		      <tbody>
			<tr height='100'>
			  <td valign='middle' width='105' height='45' style='vertical-align:middle;'>
			    <table cellspacing='0' cellpadding='0' border='0' align='center' margin='0' width='160' height='55' style='margin:0px;'>
			      <tbody>
				<tr width='160'>
				  <td width='105'></td><!--- Ext. Reference  !--->
				  <td width='55'><img src='https://www.amiv.ethz.ch/sites/all/modules/amivannounce/images/gear.png'></td>
				</tr>
			      </tbody>
			    </table>
			  </td>
			  <td valign='middle' width='350' style='vertical-align: middle; text-align: left;'>
			    <h1 class='title_de' style='margin:0; padding:0; font-size:30px; font-weight: normal; color: #fff;'>
			      <span style='font-weight: bold;'>AMIV</span>Announce </h1>
			  </td>
			  <td width='115' valign='middle' style='vertical-align:middle; text-align: center;'>
			    <h2 class='date' style='margin:0; padding:0; font-size:13px; font-weight: normal; color: #fff; text-transform: uppercase; font-weight: bold; line-height:1;'>
			     " . name_of_month(new DateTime(date(""))) . " </h2>
			    <h2 class='date' style='margin:0; padding:0; font-size:23px; font-weight: normal; color: #fff; font-weight: bold;'>
			      " . date("j") . " </h2>
			  </td>
			</tr>
			<tr>
			  <td colspan='2' height='49' width='100%' valign='bottom' style='vertical-align:middle;border:none;background:transparent;'>
			  </td>
			</tr>
		      </tbody>
		    </table>
		  </td>
		</tr>
		<tr>
		  <td valign='top'>
		    <table cellspacing='0' cellpadding='0' border='0' align='center' width='100%' style='border-width: 3px; border-color: #ffffff; border-style: solid;'>
		      <tbody>
			<tr>
			  <td width='100%' valign='top' style='border-bottom-width: 3px; border-bottom-color: #ffffff; border-bottom-style: solid;'>
			    <!--content--><!--article-->
			    <table cellspacing='0' cellpadding='0' border='0' align='center' width='100%'>
			      <tbody>
				<tr>
				  <td valign='top'>
				    <table cellspacing='0' cellpadding='0' border='0' align='center' width='100%'>
				      <tbody>
					<tr><!--- Ext. Reference  !--->
					  <td height='49' width='100%' valign='middle' bgcolor='#c8cfd8' background='https://www.amiv.ethz.ch/sites/all/modules/amivannounce/images/article-title-bg.png' style='vertical-align:middle; border-left-width: 1px; border-left-color: #BAC2CC; border-left-style: solid; border-right-width: 1px; border-right-color: #BAC2CC; border-right-style: solid; border-bottom-width: 1px; border-bottom-color: #98a3b4; border-bottom-style: solid; border-top-width: 1px; border-top-color: #BAC2CC; border-top-style: solid;'>
					    <h3 class='textshadow' style='margin:0; margin-left: 17px; padding:0; font-size: 18px; font-weight: normal; color:#324258;'>
					      AMIV Announce </h3>
					  </td>
					</tr>
					<tr><!--- Ext. Reference  !--->
					  <td height='20' width='100%' valign='middle' bgcolor='#c8cfd8' background='https://www.amiv.ethz.ch/sites/all/modules/amivannounce/images/article-title-bg.png' style='vertical-align:middle; border-left-width: 1px; border-left-color: #BAC2CC; border-left-style: solid; border-right-width: 1px; border-right-color: #BAC2CC; border-right-style: solid; border-bottom-width: 1px; border-bottom-color: #98a3b4; border-bottom-style: solid; border-top-width: 1px; border-top-color: #BAC2CC; border-top-style: solid;'>
					    <p style='font-size: 13px; line-height: 20px; font-weight: normal; color: #56667d; margin: 0; margin-bottom: 0px;margin-left:13px;'>
					      <b><i>FEATURING</i></b> &nbsp; </p>
					  </td>
					</tr>";
    }

// TODO: Implement feature in front end and consequently in backend
    function featuring(array $obj1, array $obj2) { // Specifies the features --- not yet fully implemented
        echo "<tr> <!-- static -->
					  <td valign='top' bgcolor='#edeff2' style='border-width: 1px; border-color: #bac2cc; border-style: solid;'>
					    <table cellspacing='0' cellpadding='3' border='0' align='center' width='100%'>
					      <tbody>
						<tr><!--- Ext. Reference  !--->
						  <td valign='middle'><img src='" . $obj1["image"] . "' alt='imgtitle' title='imgtitle' align='left' style='border-width: 3px; border-style: solid; border-color: #ffffff;'>
						  </td>
						  <td valign='middle'>
						    <p style='font-size: 13px;  font-weight: normal; color: #56667d; margin: 0; margin-bottom: 0px;margin-left:13px;'>
						      <b>" . $obj1['title_de'] . "</b><br>" . name_of_day(new DateTime($obj1['time_start'])) . " " . date_format(new DateTime($obj1['time_start']), "d.m.y H:i") . "<br>" . $obj1['location'] . "<br>
						    </p>
						  </td><!--- Ext. Reference  !--->
						  <td valign='middle'><img src='" . $obj2['image'] . "' alt='imgtitle' title='imgtitle' align='left' style='border-width: 3px; border-style: solid; border-color: #ffffff;'>
						  </td>
						  <td valign='middle'>
						    <p style='font-size: 13px;  font-weight: normal; color: #56667d; margin: 0; margin-bottom: 0px;margin-left:13px;'>
                                                    <b>" . $obj2['title_de'] . "</b><br>" . name_of_day(new DateTime($obj2['time_start'])) . " " . date_format(new DateTime($obj2['time_start']), "d.m.y H:i") . "<br>" . $obj2['location'] . "<br>
						    </p>
						  </td>
						</tr>
					      </tbody>
					    </table>
					  </td>
</tr>";
    }

    function static_0() { // Part without dynamic data
        echo "<tr style='background-color:#ffffff; height:2px;'>
					  <td></td>
					</tr>
					<tr>
					  <td valign='top' bgcolor='#edeff2' style='border-width: 1px; border-color: #bac2cc; border-style: solid;'>
					    <table cellspacing='0' cellpadding='3' border='0' align='center' width='100%'>
					      <tbody>
						<tr><!--- Ext. Reference  !--->
						  <td height='15' valign='middle' bgcolor='#c8cfd8' background='https://www.amiv.ethz.ch/sites/all/modules/amivannounce/images/article-title-bg.png' style='vertical-align:middle; border-left-width: 1px; border-left-color: #BAC2CC; border-left-style: solid; border-right-width: 1px; border-right-color: #BAC2CC; border-right-style: solid; border-bottom-width: 1px; border-bottom-color: #98a3b4; border-bottom-style: solid; border-top-width: 1px; border-top-color: #BAC2CC; border-top-style: solid;'>
						    <p style='font-size: 13px; line-height: 20px; font-weight: normal; color: #56667d; margin: 0; margin-bottom: 0px;margin-left:13px;'>
						      <b><i>Agenda</i></b> </p>
						  </td><!--- Ext. Reference  !--->
						  <td height='15' width='35%' valign='middle' bgcolor='#c8cfd8' background='https://www.amiv.ethz.ch/sites/all/modules/amivannounce/images/article-title-bg.png' style='vertical-align:middle; border-left-width: 1px; border-left-color: #BAC2CC; border-left-style: solid; border-right-width: 1px; border-right-color: #BAC2CC; border-right-style: solid; border-bottom-width: 1px; border-bottom-color: #98a3b4; border-bottom-style: solid; border-top-width: 1px; border-top-color: #BAC2CC; border-top-style: solid;'>
						    <p style='font-size: 13px; line-height: 20px; font-weight: normal; color: #56667d; margin: 0; margin-bottom: 0px;margin-left:13px;'>
						      <b><i>Information</i></b> </p>
						  </td>
						</tr>";
    }

    function static_1() { // Part without dynamic data
        echo "
					      </tbody>
					    </table>
					  </td>
					</tr>
				      </tbody>
				    </table>
				  </td>
					      </tr>";
    }

    function static_2() { // Part without dynamic data
        echo "<tr>
    <td valign='top'>
        <table cellspacing='0' cellpadding='0' border='0' align='center' width='100%'>
            <tbody>
                <tr>
                    <td height='49' width='100%' valign='middle' bgcolor='#c8cfd8' background='https://www.amiv.ethz.ch/sites/all/modules/amivannounce/images/article-title-bg.png' style='vertical-align:middle; border-left-width: 1px; border-left-color: #BAC2CC; border-left-style: solid; border-right-width: 1px; border-right-color: #BAC2CC; border-right-style: solid; border-bottom-width: 1px; border-bottom-color: #98a3b4; border-bottom-style: solid; border-top-width: 1px; border-top-color: #BAC2CC; border-top-style: solid;'>
                        <h3 class='textshadow' style='margin:0px; margin-left:44%; padding:0; font-size: 18px; font-weight: normal; color:#324258;'>
                            ENGLISH<br>
                            <small></small></h3>
                    </td>
                </tr>
            </tbody>
        </table>
    </td>
</tr>";
    }

    function static_3() { // Part without dynamic data
        echo"<tr>
    <td height='15' valign='middle' bgcolor='#c8cfd8' background='https://www.amiv.ethz.ch/sites/all/modules/amivannounce/images/article-title-bg.png' style='vertical-align:middle; border-left-width: 1px; border-left-color: #BAC2CC; border-left-style: solid; border-right-width: 1px; border-right-color: #BAC2CC; border-right-style: solid; border-bottom-width: 1px; border-bottom-color: #98a3b4; border-bottom-style: solid; border-top-width: 1px; border-top-color: #BAC2CC; border-top-style: solid;'>
        <p style='font-size: 13px; line-height: 20px; font-weight: normal; color: #56667d; margin: 0; margin-bottom: 0px;margin-left:13px;'>
            AMIV Announce kann <a href='mailto:amiv-announce-request@list.ee.ethz.ch?subject=3Dunsubscribe'>
                abbestellt</a> werden </p>
    </td>
</tr>
<tr>
    <td colspan='2' valign='middle' height='50' bgcolor='#e7eaee' style='vertical-align:middle; border-width: 1px; border-style: solid; border-color: #b6bec9; text-align: center;'>
        <p style='margin:0; font-size: 10px; font-weight: bold; color: #96a2b3; font-family: Arial; line-height: 18px;'>
            AMIV Announce wird angeboten von der AMIV - Akademische Maschinen- und Elektro-Ingenieur Verein<br>
        </p>
        <p style='margin:0; font-size: 10px; font-weight: bold; color: #96a2b3; font-family: Arial; line-height: 18px;'>
            <a href='https://www.amiv.ethz.ch'>www.amiv.ethz.ch</a></p>
    </td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</body>
</html>
";
    }

    announce_top($month, $date);
    featuring($feature1, $feature2);
    static_0();
    foreach ($entries as $entry) {
        entry_agenda($entry);
    }
    static_1();
    foreach ($entries as $entry) {
        entry_full_de($entry);
    }
    static_2();
    foreach ($entries as $entry) {
        if ($entry['title_en'] != "") {
            entry_full_en($entry);
        }
    }
    static_3();
}
    ?>
 

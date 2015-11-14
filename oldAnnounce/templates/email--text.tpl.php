********** English below **********

              AGENDA               
***********************************
<?php
foreach ($nodes as $node) {
	$start = NULL;
	if (!empty($node->node_announce_start_date['und'][0]['value'])){
		$start = new DateObject($node->node_announce_start_date['und'][0]['value'],new DateTimeZone($node->node_announce_start_date['und'][0]['timezone_db']),'Y-m-d\TH:i:s');
		$start->setTimeZone(new DateTimeZone($node->node_announce_start_date['und'][0]['timezone']));
		echo $start->format('d.m.y H:i') . " ";
		echo !empty($node->node_announce_shorttitle['de'][0]['safe_value']) ? $node->node_announce_shorttitle['de'][0]['safe_value'] : $node->node_announce_shorttitle['en'][0]['safe_value'];
		echo "\n";
	}
}
echo "\n";
?>
            ANMELDUNGEN            
***********************************
Zurzeit keine Anmeldungen

www.amiv.ch/anmeldung

+++++++++++++++++++++++++++++++
In dieser Ausgabe:
<?php
foreach ($nodes as $node){
	echo "* ";
	echo (!empty($node->title_field['de'][0]['safe_value'])) ? $node->title_field['de'][0]['safe_value'] : $node->title_field['en'][0]['safe_value'];
	echo "\n";
}
?>

+++++++++++++++++++++++++++++++
	
	
<?php foreach ($nodes as $node){
	$start = NULL;
	if (!empty($node->node_announce_start_date['und'][0]['value'])){
		$start = new DateObject($node->node_announce_start_date['und'][0]['value'],new DateTimeZone($node->node_announce_start_date['und'][0]['timezone_db']),'Y-m-d\TH:i:s');
		$start->setTimeZone(new DateTimeZone($node->node_announce_start_date['und'][0]['timezone']));
	}
	$end = NULL;
	if (!empty($node->node_announce_end_date['und'][0]['value'])){
		$end = new DateObject($node->node_announce_end_date['und'][0]['value'],new DateTimeZone($node->node_announce_end_date['und'][0]['timezone_db']),'Y-m-d\TH:i:s');
		$end->setTimeZone(new DateTimeZone($node->node_announce_end_date['und'][0]['timezone']));
	}
	// Determine german items to be displayed
	if ($node->language == "de" || count($node->translations->data) == 2){
		$nodeLang = "de";
		include('email--node--text.tpl.php');
	}
}
?>
********** English here ***********

<?php foreach ($nodes as $node){
		$start = NULL;
	if (!empty($node->node_announce_start_date['und'][0]['value'])){
		$start = new DateObject($node->node_announce_start_date['und'][0]['value'],new DateTimeZone($node->node_announce_start_date['und'][0]['timezone_db']),'Y-m-d\TH:i:s');
		$start->setTimeZone(new DateTimeZone($node->node_announce_start_date['und'][0]['timezone']));
	}
	$end = NULL;
	if (!empty($node->node_announce_end_date['und'][0]['value'])){
		$end = new DateObject($node->node_announce_end_date['und'][0]['value'],new DateTimeZone($node->node_announce_end_date['und'][0]['timezone_db']),'Y-m-d\TH:i:s');
		$end->setTimeZone(new DateTimeZone($node->node_announce_end_date['und'][0]['timezone']));
	}
	// Determine german items to be displayed
	if ($node->language == "en" || count($node->translations->data) == 2){
		$nodeLang = "en";
		include('email--node--text.tpl.php');
	}
}
?>
--
Weitere Informationen findest du unter http://www.amiv.ethz.ch/
Du bekommst dieses Mail als Studierender an einem der AMIV-Departemente D-ITET/D-MAVT oder weil du dich manuell in die Mailingliste eingetragen hast.
Bitte benutze mailto:amiv-announce-request@list.ee.ethz.ch?subject=unsubscribe zum Abbestellen.
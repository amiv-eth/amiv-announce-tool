<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
	<head>
		<meta http-equiv="cache-control" content="no-cache" />
		<meta http-equiv="pragma" content="no-cache" />
		<meta http-equiv="expires" content="0" />

		<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />	
		<title>Amiv Announce</title>
		<!--general stylesheet-->
		<style type="text/css">
			p { font-size:12px; margin:0; margin-bottom: 10px; padding: 0;}
			a { color: #FFF;}
			h1, h2, h3, p, li { font-family: "Helvetica Neue", Helvetica, Arial, sans-serif; }
			td { vertical-align:top;}
			ul, ol { margin: 0; padding: 0;}
			.title_text {
				text-align: center;
				font-size: 42px;
				color: #ffffff;
			}
			.date {
				margin:0;
				padding:0;
				color: #fff;
				font-weight: bold;
			}
			.textshadow {
				text-shadow: #ffffff 0px 1px 0px;
			}
			.trxtshadow-2 {
				text-shadow: #768296 0px -1px 0px;
			}
			li {
				font-size: 12px;  font-weight: normal; color: #56667d; margin: 0;list-style:none;
			}
		</style>
		<script type="text/javascript">
			function setHeight() {
				parent.document.getElementById('announceFrame').height = document['body'].offsetHeight;
			}
			window.onload = setHeight;
		</script>
	</head>
	<body marginheight="0" topmargin="0" marginwidth="0" leftmargin="0" background="" style="margin: 0px; background-color: #ffffff" bgcolor="">
		<table cellspacing="0" border="0" cellpadding="0" width="100%" >
			<tbody>
				<tr valign="top">
					<td valign="top"><!--container-->
						<table cellspacing="0" cellpadding="0" border="0" align="center" width="629px">
							<tbody>
								<tr height="30px" bgcolor="ffffff"><td width="629px"></td></tr>
								<tr>
									<td valign="middle" height="109px"  background="" style="vertical-align: middle;">
										<table cellspacing="0" cellpadding="0" border="0" align="center" width="629px" height="109px">
											<tbody>
												<tr height="109px" bgcolor="1f2d54">
													<td width="69px"></td>
													<td valign="middle" width="380px" height="109px" style="vertical-align:middle; position:relative;">
														<img style="position:absolute; top:8px; left:0px; z-index:2;" src="<?php global $base_url; echo $base_url."/"; echo drupal_get_path('module', 'amivannounce'); ?>/images/logo_announce.gif" />
														<p class="title_text" style="position:relative; z-index:1; top:6px;"><font color="#e8462b">AMIV</font> Announce</p>
													</td>
													<td width="60px"> </td>
													<td width="110px" valign="middle" style="vertical-align:middle; text-align: center;">
														<h2 class="date" style="font-size:13px; text-transform: uppercase;">
															<?php echo amivannounce_date_helper(new DateObject(), null, 'month', 'de'); ?>
														</h2>
														<h2 class="date" style="font-size:23px; ">
															<?php echo date("d"); ?>
														</h2>
													</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
								<tr height="30px" bgcolor="ffffff"><td width="629px"></td></tr>
								<tr>
									<td valign="top">
										<table cellspacing="0" cellpadding="0" border="0" align="center" width="100%">
											<tbody>
												<tr>
													<td width="100%" valign="top"><!--content-->
										<!--article--><table cellspacing="0" cellpadding="0" border="0" align="center" width="100%">
															<tbody>
																<tr>
																	<td valign="top">
																		<table cellspacing="0" cellpadding="0" border="0" align="center" width="100%">
																			<tbody>
																				<tr>
																					<td height="30" width="100%" valign="middle" bgcolor="#e8462b" background="" style="vertical-align:middle">
																						<p style="font-size: 13px; line-height: 20px; font-weight: normal; color: #ffffff; margin: 0; margin-bottom: 0px;margin-left:13px;">
																							<b>FEATURING</b>
																						</p>
																					</td>
																				</tr>
																				<tr>
																					<td valign="top" bgcolor="#1f2d54">
																						<table cellspacing="0" cellpadding="3" border="0" align="center" width="100%" style="border-left-width: 5px; border-left-color: #1f2d54; border-left-style: solid; border-right-width: 5px; border-right-color: #1f2d54; border-right-style: solid; border-bottom-width: 5px; border-bottom-color: #1f2d54; border-bottom-style: solid; border-top-width: 5px; border-top-color: #1f2d54; border-top-style: solid">
																							<tr>
																								<?php foreach($nodes as $node){ if($node->node_announce_featured['und'][0]['value']==1){ 
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
																									
																								?>																								
																								<td valign="middle" >
																									<img src="<?php echo file_create_url($node->node_announce_image['und'][0]['uri']); ?>" alt="<?php echo 'imgtitle'; ?>" title="<?php echo 'imgtitle'; ?>" align="left" style="border-width: 3px; border-style: solid; border-color: #ffffff;" />
																								</td>
																								<td valign="middle">
																									<p style="font-size: 13px;  font-weight: normal; color: #ffffff; margin: 0; margin-bottom: 0px;margin-left:5px;">
																										<b><?php echo isset($node->title_field['de'][0]['safe_value']) ? $node->title_field['de'][0]['safe_value'] : $node->title; ?></b><br />
																										<?php if (isset($node->node_announce_start_date['und'][0]['value'])) echo amivannounce_date_helper($start,$end,"long",'de')."<br />"; ?>
																										<?php if (isset($node->node_announce_location['de'][0]['safe_value'])) echo $node->node_announce_location['de'][0]['safe_value'] . "<br />"; ?>
																										<?php 	/*if ($F['infourl'] != '') {
																													echo "<a href=\" ${F['infourl']} \"> info</a>";
																													if ($F['signupurl'] != '') echo " | ";
																												}
																												if ($F['signupurl'] != '') 
																													echo "<a href=\"${F['signupurl']}\">sign up</a><br />";*/
																										?>
																									</p>
																								</td>
																								<?php }} ?>
																							</tr>
																						</table>
																					</td>
																				</tr>
																				<tr height="10"><td width="100%" bgcolor="#ffffff"></td></tr>
																				<tr>
																					<td valign="top" bgcolor="#1f2d54">
																						<table cellspacing="0" cellpadding="0" border="0" align="center" width="100%">
																							<tbody>
																								<tr>
																									<td height="30" valign="middle" bgcolor="#e8462b" style="vertical-align:middle">
																										<p style="font-size: 13px; line-height: 20px; font-weight: normal; color: #ffffff; margin: 0; margin-bottom: 0px;margin-left:13px;">
																											<b>Agenda</b> 
																										</p>
																									</td>
																									<td height="30" width="35%" valign="middle" bgcolor="#e8462b" style="vertical-align:middle">
																										<p style="font-size: 13px; line-height: 20px; font-weight: normal; color: #ffffff; margin: 0; margin-bottom: 0px;margin-left:13px;">
																											<b>Information</b> 
																										</p>
																									</td>
																								</tr>
																								<tr height="5px"><td width="35%"></td><td></td></tr>
																								<?php
																								$agendas = Array();
																								foreach ($nodes as $node){
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
																									if(!empty($node->node_announce_start_date['und'][0]['value'])){
																									?>
																								<tr >
																									<td width="45%" style="border-bottom-width: 5px; border-bottom-color: #1f2d54; border-bottom-style: solid; border-top-width: 5px; border-top-color: #1f2d54; border-top-style: solid">
																										<p style="font-size: 12px;  font-weight: normal; color: #ffffff; margin: 0;margin-left:13px;">
																											<?php echo $start->format('d.m.y H:i') . "  ::  "; echo !empty($node->node_announce_shorttitle['de'][0]['safe_value']) ? $node->node_announce_shorttitle['de'][0]['safe_value'] : $node->node_announce_shorttitle['en'][0]['safe_value']; ?>
																										</p>
																									</td>
																									<td style="border-bottom-width: 5px; border-bottom-color: #1f2d54; border-bottom-style: solid; border-top-width: 5px; border-top-color: #1f2d54; border-top-style: solid">
																										<p style="font-size: 12px; font-weight: normal; color: #ffffff; margin: 0;margin-left:13px;">
																										<?php
																											$info = array();
																											if (!empty($node->node_announce_location['de'][0]['safe_value']) || !empty($node->node_announce_location['en'][0]['safe_value'])){
																												$location = !empty($node->node_announce_location['de'][0]['safe_value']) ? $node->node_announce_location['de'][0]['safe_value'] : $node->node_announce_location['en'][0]['safe_value'] ;
																												$location = isset($node->node_announce_location_link['und'][0]['safe_value']) ? "<a href=\"". $node->node_announce_location_link['und'][0]['safe_value'] ."\">$location</a>" : $location;
																												$info[] = $location;
																											}
																											if (!empty($node->node_announce_signup_link['und'][0]['safe_value'])){
																												$signup = '<a href="' . $node->node_announce_signup_link['und'][0]['safe_value'] . '">Anmeldung</a>';
																												$info[] = $signup;
																											}
																										echo 'Wo: ' . implode(" | ", $info);
																										
																										?>
																										</p>
																									</td>
																								</tr>
																								<?php																							    
																								    }
																								}
																								?>
																								<tr height="5px"><td width="35%"></td><td></td></tr>
																							</tbody>
																						</table>
																					</td>
																				</tr>
																			</tbody>
																		</table>
																	</td>
																</tr>

																<tr height="30px" bgcolor="ffffff"><td width="629px"></td></tr>

																<?php
																foreach ($nodes as $node){
																	// Determine german items to be displayed
																	if ($node->language == "de" || count($node->translations->data) == 2){
																		$nodeLang = "de";
																		include('email--node--html.tpl.php');
																	}
																}
																?>

																<tr height="30px" bgcolor="ffffff"><td width="629px"></td></tr>

																<tr>
																	<td valign="top">
																		<table cellspacing="0" cellpadding="0" border="0" align="center" width="100%">
																			<tbody>
																				<tr>
																					<td height="30" width="100%" valign="middle" bgcolor="#e8462b" background="" style="vertical-align:middle">
																						<p style="font-size: 13px; line-height: 20px; font-weight: normal; color: #ffffff; margin: 0; margin-bottom: 0px;margin-left:13px;">
																							<b>English</b>
																						</p>
																					</td>
																				</tr>
																			</tbody>
																		</table>
																	</td>
																</tr>

																<tr height="10px" bgcolor="ffffff"><td width="629px"></td></tr>

																<?php
																foreach ($nodes as $node){
																	if ($node->language == "en" || count($node->translations->data) == 2){
																		$nodeLang = "en";
																		include('email--node--html.tpl.php');
																	}
																}
																?>
															</tbody>
														</table>
													</td>
												</tr>
												<tr height="30px" bgcolor="ffffff"><td width="629px"></td></tr>
												<tr>
													<td colspan="2" valign="middle" height="50" bgcolor="#1f2d54" style="vertical-align:middle; text-align: center; border-bottom-width: 5px; border-bottom-color: #1f2d54; border-bottom-style: solid; border-top-width: 5px; border-top-color: #1f2d54; border-top-style: solid">
														<p style="margin:0; font-size: 10px; font-weight: bold; color: #ffffff; line-height: 18px;">
															Die AMIV Announce wird angeboten vom AMIV, der Akademische Maschinen- und Elektro-Ingenieur Verein der ETH Z&uuml;rich.
														</p>
														<p style="margin:0; font-size: 10px; font-weight: bold; color: #ffffff; line-height: 18px;"><a href="https://www.amiv.ethz.ch" style="font-size: 10px; line-height: 20px; font-weight: normal; color: #ffffff;">www.amiv.ethz.ch</a></p>
														<p style="font-size: 10px; line-height: 18px; font-weight: normal; color: #ffffff; margin: 0; margin-bottom: 0px;margin-left:13px;">
															Die AMIV Announce kann <a href="mailto:amiv-announce-request@list.ee.ethz.ch?subject=unsubscribe" style="font-size: 10px; line-height: 20px; font-weight: normal; color: #ffffff;">abbestellt</a> werden.
														</p>
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

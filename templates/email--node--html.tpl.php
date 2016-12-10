<?php

/**
 * @file
 * Default theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: An array of node items. Use render($content) to print them all,
 *   or print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct url of the current node.
 * - $display_submitted: Whether submission information should be displayed.
 * - $submitted: Submission information created from $name and $date during
 *   template_preprocess_node().
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - node: The current template type, i.e., "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser
 *     listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type, i.e. story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $view_mode: View mode, e.g. 'full', 'teaser'...
 * - $teaser: Flag for the teaser state (shortcut for $view_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * Field variables: for each field instance attached to the node a corresponding
 * variable is defined, e.g. $node->body becomes $body. When needing to access
 * a field's raw values, developers/themers are strongly encouraged to use these
 * variables. Otherwise they will have to explicitly specify the desired field
 * language, e.g. $node->body['en'], thus overriding any language negotiation
 * rule that was previously applied.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see template_process()
 */
?>

<?php
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
<tr>
	<td valign="top">
		<table cellspacing="0" cellpadding="0" border="0" align="center" width="100%">
			<tbody>
				<tr>
					<td height="50" width="100%" valign="middle" bgcolor="#e8462b" style="vertical-align:middle;">
						<h3 style="margin:0; margin-left: 13px; padding:0; font-size: 18px; font-weight: normal; color:#ffffff;">
							<?php echo isset($node->title_field[$nodeLang][0]['safe_value']) ? $node->title_field[$nodeLang][0]['safe_value'] : $node->title; ?> <small><?php echo "[" . $node->node_announce_catchphrase[$nodeLang][0]['safe_value'] . "]"; ?></small><br/>
							<?php 
								$date = "";
								$location = "";
								$cost = "";
								$signup = "";
								if(!empty($node->node_announce_start_date)){
									$date = amivannounce_date_helper($start,$end,"long",$nodeLang);									
								}
								if (!empty($node->node_announce_location[$nodeLang][0]['safe_value'])){
									$location = $node->node_announce_location[$nodeLang][0]['safe_value'];									
									$location = isset($node->node_announce_location_link['und'][0]['safe_value']) ? "<a href=\"". $node->node_announce_location_link['und'][0]['safe_value'] ."\">$location</a>" : $location;
								}
								if (!empty($node->node_announce_cost[$nodeLang][0]['safe_value'])){
									$cost .= $node->node_announce_cost[$nodeLang][0]['safe_value'];
								}
								if (!empty($node->node_announce_signup_link['und'][0]['safe_value'])){
									$word = ($nodeLang == 'en') ? 'Signup' : 'Anmeldung';
									$signup .= '<a href="'. $node->node_announce_signup_link['und'][0]['safe_value'] .'">' . $word . '</a>';
								}
							?>							
							<small><?php echo amivannounce_put_dashes(Array($date, $location, $cost, $signup)); ?></small>
						</h3>
					</td>
				</tr>
				<tr>
					<td valign="top" bgcolor="#1f2d54">
						<table cellspacing="0" cellpadding="3" border="0" align="left" width="100%" style="border-left-width: 5px; border-left-color: #1f2d54; border-left-style: solid; border-right-width: 5px; border-right-color: #1f2d54; border-right-style: solid; border-bottom-width: 5px; border-bottom-color: #1f2d54; border-bottom-style: solid; border-top-width: 5px; border-top-color: #1f2d54; border-top-style: solid">
							<tr>
								<td valign="top" width="150">
										<img src="<?php echo file_create_url($node->node_announce_image['und'][0]['uri']); ?>" alt="<?php echo 'imgtitle'; ?>" align="left" style="border-width: 3px; border-style: solid; border-color: #ffffff;" />
								</td>
								<td style="font-size: 13px; font-weight: normal; color: #ffffff; border-left-width: 5px; border-left-color: #1f2d54; border-left-style: solid; border-right-width: 5px; border-right-color: #1f2d54; border-right-style: solid; border-bottom-width: 5px; border-bottom-color: #1f2d54; border-bottom-style: solid;">
									<!--<p style="font-size: 12px; line-height: 20px; font-weight: normal; color: #56667d; margin: 0; margin-bottom: 10px;">-->
									<?php print $node->body[$nodeLang][0]['safe_value']; ?>
									<!--</p>-->
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</tbody>
		</table>
	</td>
</tr>

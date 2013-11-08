<?php
/**
 * Main activity stream list page
 */
$page_filter = 'tags';
$options = array();

$page_type = 'tags';
$type = get_input('type', 'all');
$subtype = get_input('subtype', '');
if ($subtype) {
	$selector = "type=$type&subtype=$subtype";
} else {
	$selector = "type=$type";
}

if ($type != 'all') {
	$options['type'] = $type;
	if ($subtype) {
		$options['subtype'] = $subtype;
	}
}

$title = elgg_echo('river:tags');

//Get Edit Button and Current Tags
$content = elgg_view_form('follow_tags/activity');
//Get Riverfilter
$content .= elgg_view('core/river/filter', array('selector' => $selector));

$activity = follow_tags_get_activity_follow_tags($options);

if(!$activity){
	$activity = '<div class="emptynotice">';
	$activity .= elgg_echo('follow_tags:notags');
	$activity .= '</div>';
}

//Get Sidebar
$sidebar = elgg_view('core/river/sidebar');

$params = array(
	'content' =>  $content . $activity,
	'sidebar' => $sidebar,
	'filter_context' => 'tags',
	'class' => 'elgg-river-layout',
);

$body = elgg_view_layout('content', $params);

echo elgg_view_page($title, $body);

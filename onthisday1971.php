<?php
// মহান মুক্তিযুদ্ধের প্রতিদিনের উল্লেখযোগ্য ঘটনা নিয়ে সাজানো হয়েছে এই ’একাত্তরের এই দিনে’অপশনটি
/*
 *	onthisday_1971_shortcode
 */
add_shortcode('onthisday1971', 'onthisday_1971_shortcode');

function onthisday_1971_shortcode($atts, $content = null) {

	// Prepare the date
	$current_date = date_i18n(get_option('date_format'), strtotime('1971'));
	$current_date = '<strong>' . $current_date . '</strong><br />';

	// Prepare the event
	$month_array = file('http://file.projoktibangla.net/ekattor/data/' . date('n') . '.php');
	$day = date('n');
	$day_line = $month_array[$day + 3];
	$day_array = explode('<month>', $day_line);
	$story_array = explode('<event>', $day_array[1]);
	for($i = 0; $i < sizeof($story_array); $i++) {
		$event_array = explode('<num>', $story_array[$i]);
		$story = $event_array[0] . ' ' . $event_array[1] . '<br />';
	}

	// Display
	$content = '<table style="border-width: thin thin thin thin; border-style: solid solid solid solid;">';
	$content .= '<thead><tr><th><center><font face="arial" size="+1"><b>' . __('একাত্তরের এই দিনে', 'onthisday-1971') . '</b></center></font></th></tr></thead>';
	$content .= '<tbody><tr><td>';

	$content .= '<div style="text-align:justify; padding:8px;">';
	$content .= $current_date;
	$content .= $story;
	$content .= '</div>';

	$content .= '</td></tr></tbody>';
	$content .= '<tfoot><tr><td><div style="text-align: right;"><font face="arial" size="-3">তথ্যসূত্র: মুক্তিযুদ্ধ জাদুঘর ও অন্যান্য</font></div></td></tr></tfoot>';
	$content .= '</table>';

	return $content;
}


/*
 *
 *	WP_Widget_On_this_day_1971
 *
 */

class WP_Widget_onthisday1971 extends WP_Widget {

	function WP_Widget_onthisday1971() {

		parent::WP_Widget(false, $name = 'একাত্তরের এই দিনে');
	}

	function widget($args, $instance) {

		// Get options
		extract($args);
		$option_title = apply_filters('widget_title', empty($instance['title']) ? __('একাত্তরের এই দিনে', 'onthisday1971') : $instance['title']);
		$option_alignment = empty($instance['alignment']) ? 'left' : $instance['alignment'];
		$option_date_style = empty($instance['date_style']) ? 'bold' : $instance['date_style'];

		// Prepare the date
		$current_date = date_i18n(get_option('date_format'), strtotime('1971'));
		switch($option_date_style) {
			case 'bold':
				$current_date = '<strong>' . $current_date . '</strong><br />';
				break;
			case 'bold_italic':
				$current_date = '<strong><em>' . $current_date . '</em></strong><br />';
				break;
			case 'italic':
				$current_date = '<em>' . $current_date . '</em><br />';
				break;
			case 'regular':
				$current_date .= '<br />';
				break;
		}

		// Prepare the event
		$month_array = file('http://file.projoktibangla.net/ekattor/data/' . date('n') . '.php');
		$day = date('n');
		$day_line = $month_array[$day + 3];
		$day_array = explode('<month>', $day_line);
		$story_array = explode('<event>', $day_array[1]);

		// Help widget to conform to the active theme: before_widget, before_title and after_title
		echo $before_widget;
		echo $before_title . $option_title . $after_title;
 
			echo '<div style="text-align:justify; padding:8px;">';
			echo $current_date;
			for($i = 0; $i < sizeof($story_array); $i++) {
				$event_array = explode('<num>', $story_array[$i]);
				echo $event_array[0] . ' ' . $event_array[1] . '<br />';
			}
			echo '</div>';
			echo '<div style="text-align: right;"><font face="arial" size="-3">তথ্যসূত্র: মুক্তিযুদ্ধ জাদুঘর ও অন্যান্য</font></div>';

		echo $after_widget;
	}

	function update($new_instance, $old_instance) {

		return $new_instance;
	}

	function form($instance) {

		// Get options
		$instance = wp_parse_args((array)$instance, array('title' => __('একাত্তরের এই দিনে', 'onthisday1971'), 'date_style' => 'bold', 'alignment' => 'left'));
		$option_title = esc_attr($instance['title']);

		// Display form
		echo '<p>';
		echo 	'<label for="' . $this->get_field_id('title') . '">' . __('শিরোনাম: ', 'onthisday1971') . '</label>';
		echo 	'<input class="widefat" type="text" value="' . $option_title . '" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" />';
		echo	'<br />';
		echo	'<br />';
		echo 	'<label for="' . $this->get_field_id('date_style') . '">' . __('তারিখের ধরন: ', 'onthisday1971') . '</label>';
		echo 	'<select class="widefat" id="' . $this->get_field_id('date_style') . '" name="' . $this->get_field_name('date_style') . '">';
		echo 		'<option value="bold"' . selected($instance['date_style'], 'bold') . '>' . __('মোটা', 'onthisday1971') . '</option>';
		echo 		'<option value="bold_italic"' . selected($instance['date_style'], 'bold_italic') . '>' . __('মোটা  ও বাঁকা', 'onthisday1971') . '</option>';
		echo 		'<option value="italic"' . selected($instance['date_style'], 'italic') . '>' . __('বাঁকা', 'onthisday1971') . '</option>';
		echo 		'<option value="regular"' . selected($instance['date_style'], 'regular') . '>' . __('সাধারণ', 'onthisday1971') . '</option>';
		echo 	'</select>';
		echo '</p>';
	}
}

add_action('widgets_init', create_function('', 'return register_widget("WP_Widget_onthisday1971");'));


//convert english date to bangla date
function BanglaNumDate ($text) {
$text = str_replace('1', '১', $text);
$text = str_replace('2', '২', $text);
$text = str_replace('3', '৩', $text);
$text = str_replace('4', '৪', $text);
$text = str_replace('5', '৫', $text);
$text = str_replace('6', '৬', $text);
$text = str_replace('7', '৭', $text);
$text = str_replace('8', '৮', $text);
$text = str_replace('9', '৯', $text);
$text = str_replace('0', '০', $text); 
$text = str_replace('th', '-এ', $text); 
$text = str_replace('st', '-এ', $text);
$text = str_replace('rd', '-এ', $text);
$text = str_replace('th', '-এ', $text);
$text = str_replace('January', 'জানুয়ারী', $text);
$text = str_replace('February', 'ফেব্রুয়ারী', $text);
$text = str_replace('March', 'মার্চ', $text);
$text = str_replace('April', 'এপ্রিল', $text);
$text = str_replace('May', 'মে', $text);
$text = str_replace('June', 'জুন', $text);
$text = str_replace('July', 'জুলাই', $text);
$text = str_replace('August', 'অগাষ্ট', $text);
$text = str_replace('September', 'সেপ্টেম্বর', $text);
$text = str_replace('October', 'অক্টোবর', $text); 
$text = str_replace('November', 'নভেম্বর', $text); 
$text = str_replace('December', 'ডিসেম্বর', $text);
$text = str_replace('Jan', 'জানুয়ারী', $text);
$text = str_replace('Feb', 'ফেব্রুয়ারী', $text);
$text = str_replace('Mar', 'মার্চ', $text);
$text = str_replace('Apr', 'এপ্রিল', $text);
$text = str_replace('May', 'মে', $text);
$text = str_replace('Jun', 'জুন', $text);
$text = str_replace('Jul', 'জুলাই', $text);
$text = str_replace('Aug', 'অগাষ্ট', $text);
$text = str_replace('Sep', 'সেপ্টেম্বর', $text);
$text = str_replace('Oct', 'অক্টোবর', $text); 
$text = str_replace('Nov', 'নভেম্বর', $text); 
$text = str_replace('Dec', 'ডিসেম্বর', $text);
$text = str_replace('Saturday', 'শনিবার', $text);
$text = str_replace('Sunday', 'রবিবার', $text);
$text = str_replace('Monday', 'সোমবার', $text);
$text = str_replace('Tuesday', 'মঙ্গলবার', $text);
$text = str_replace('Wednesday', 'বুধবার', $text);
$text = str_replace('Thursday', 'বৃহস্পতিবার', $text);
$text = str_replace('Friday', 'শুক্রবার', $text);
$text = str_replace('Sat', 'শনি', $text);
$text = str_replace('Sun', 'রবি', $text);
$text = str_replace('Mon', 'সোম', $text);
$text = str_replace('Tue', 'মঙ্গল', $text);
$text = str_replace('Tues', 'মঙ্গল', $text);
$text = str_replace('Wed', 'বুধ', $text);
$text = str_replace('Thurs', 'বৃহস্পতি', $text);
$text = str_replace('Thu', 'বৃহস্পতি', $text);
$text = str_replace('Fri', 'শুক্র', $text);
return $text;
}

add_filter('date_i18n', 'BanglaNumDate');

?>
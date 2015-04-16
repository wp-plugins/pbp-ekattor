<?php
// একাত্তরের বীরসেনানিদের তালিকা 
// creating a shortcode
add_shortcode('our-hero', 'hero_shortcode');

function hero_shortcode(){
wp_register_style('hero-tab-style', plugins_url('/hero_file/hero_tab.css', __FILE__));
wp_register_script('hero-tab-js', plugins_url('/hero_file/hero_tab.js', __FILE__), array('jquery'));
wp_enqueue_style('hero-tab-style');
wp_enqueue_script('hero-tab-js');
?>
<table style="border-width: thin thin thin thin; border-style: solid solid solid solid;">
<thead><tr><th><center><font size="+1"><b>একাত্তরের বীর সেনানীরা</b></font></center></th></tr>
<tr><th><center>
	<ul class="tabs">
		<li class="active"><a href="#birsreshto">বীর শ্রেষ্ঠ (৭জন)</a></li>
		<li><a href="#biruttom">বীর উত্তম (৬৮জন)</a></li>
		<li><a href="#birbikrom">বীর বিক্রম (১৭৫ জন)</a></li>
		<li><a href="#birprotik">বীর প্রতীক (৪২৬জন)</a></li>
	</ul>
</center></th></tr></thead>
<tbody><tr><td>
<div class="tab_container">
<div id="birsreshto" class="tab_content">
<?php 
$file = file_get_contents('http://goo.gl/RqmzhY', true);
			echo '<div style="text-align: left;">';
			echo $file;			
			echo '</div>';
?>
</div>
<div id="biruttom" class="tab_content" style="display:none;">
<div style="overflow-y: scroll;height: 300px">   
<?php 
$file = file_get_contents('http://goo.gl/ifYZ6g', true);
			echo '<div style="text-align: left;">';
			echo $file;			
			echo '</div>';
?>
</div>
</div>
<div id="birbikrom" class="tab_content" style="display:none;">
<div style="overflow-y: scroll;height: 300px">   
<?php 
$file = file_get_contents('http://goo.gl/LHOzMx', true);
			echo '<div style="text-align: left;">';
			echo $file;			
			echo '</div>';
?>
</div>
</div>
<div id="birprotik" class="tab_content" style="display:none;">
<div style="overflow-y: scroll;height: 300px">   
<?php 
$file = file_get_contents('http://goo.gl/JpcW39', true);
			echo '<div style="text-align: left;">';
			echo $file;			
			echo '</div>';
?>
</div>
</div>
</div>
</td></tr></tbody>
<tfoot><tr><td><div style="float: left;"><font face="arial" size="-3">(*) চিহ্নিত বীর সেনানীরা মহান মুক্তিযুদ্ধে শহীদ হন</font></div><div style="float: right;"><font face="arial" size="-3">তথ্যসূত্র: মুক্তিযুদ্ধ জাদুঘর ও অন্যান্য</font></div></td></tr></tfoot>
</table>
<div class="tab-clear"></div>
<?php
}
?>
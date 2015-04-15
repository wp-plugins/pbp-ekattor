<?php
/* 
	Plugin Name: একাত্তর | ekattor
	Plugin URI:  http://projoktibangla.net
	Description: বাংলাদেশের মহান মুক্তিযুদ্ধের স্মৃতিবিজারিত উল্লেখযোগ্য ঘটনা, মহান বীরসেনানীদের তালিকা, মুক্তিযুদ্ধের সেক্টরগুলো সম্পর্কে সংক্ষিপ্ত আলোচনা সহ মুক্তিযুদ্ধ ইতিহাসের নানা বিষয় নিয়ে বিশেষ অনলাইন টুলস, যেটিকে সর্টকোড দ্বারা ব্যবহার করা যাবে।
	Author:      প্রযুক্তি বাংলা
	Author URI:  http://projoktibangla.net
	Version:     ১.০
	License:     GPLv2 or later
*/

/*
	এই প্লাগইনটির সর্বস্বত্ত্ব সংরক্ষিত আছে প্রযুক্তি বাংলা টিম ও এস এম ফাউন্ডেশন এর দ্বারা। সুতরাং এই প্লাগইনটির কোনো প্রকার পরিবর্ধন, পরিমার্জন কিংবা কোনোরূপ পরিবর্তন করতে চাইলে অবশ্যই আমাদের কাছ থেকে অনুমতি নিতে হবে। এমনকি এইখানে ব্যবহৃত তথ্য যদি অন্যকোথায় ব্যবহার করতে চান তাহলেও আমাদের কাছ থেকে অনুমতি নিতে হবে। নয়তো আমরা যথাযথ ব্যবস্থা গ্রহন করব।

	এবং এই প্লাগইনে ব্যবহৃত সকল তথ্যের একমাত্র স্বত্ত্ব মুক্তিযুদ্ধ জাদুঘরের কাছে সংরক্ষিত। 
*/
include 'heros.php';
include 'war-sector.php';
include 'onthisday1971.php';

add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'my_plugin_action_links' );
 
function my_plugin_action_links( $links ) {
   $links[] = '<a href="'. get_admin_url(null, '/admin.php?page=ekattor.php') .'"> তথ্যসূত্র</a>';
   return $links;
}

add_action('admin_menu', 'menu_function');

function menu_function(){
	add_menu_page( 'একাত্তর | ekattor', 'একাত্তর | ekattor', 'manage_options', 'ekattor.php', 'ekattor_menu', 'dashicons-flag', 30 );
}

function ekattor_menu(){
?>
<h1>একাত্তর | ekattor</h1>

<p style="font-size: 18px;text-align:justify; padding:10px">১৯৭১ সালে সংগঠিত বাংলাদেশের স্বাধীনতা যুদ্ধের ইতিহাসকে অনলাইন জগতে বাংলায় প্রচার করার লক্ষ্যে আমাদের এই ক্ষুদ্র প্রয়াস। আমরা আশা করি, এই প্লাগইনটির মাধ্যমে বাংলাদেশের প্রতিটি মানুষ যারা ইন্টারনেট ব্যবহার করছে তারা সবাই আমাদের মহান স্বাধীনতা যুদ্ধের পূর্ণাঙ্গ ইতিহাস জানবে এবং অন্যদেরকেও জানাতে উৎসাহ দিবে। </br>
এই প্লাগইনটি তৈরী করতে গিয়ে বিভিন্ন মাধ্যম ও উৎস থেকে তথ্য সংগ্রহ করতে হয়েছে। যারা যেভাবে এটি তৈরীতে সহযোগীতা করেছে তাদের সবার প্রতি কৃতজ্ঞতা প্রকাশ করছি। বিশেষ করে বাংলা উইকিপিডিয়া ও মুক্তিযুদ্ধ জাদুঘর থেকে সবচেয়ে বেশী তথ্য সংগ্রহ করেছি, তাই এই দুটি মাধ্যমের সকল কারিগরি ব্যক্তিদের প্রতি রইল সশ্রদ্ধ সালাম ও কৃতজ্ঞতা। এই প্লাগইনটির কাজ কখনোই থেমে থাকবে না। প্রতিনিয়ত এটিকে আরো বেশি তথ্য সমৃদ্ধ ও নির্ভুল করার কাজ আমরা করে যাব।</p>

<p style="font-size: 18px; font-weight: bold;">উল্লেখযোগ্য ফিচার সমূহ:</p>
<p style="font-size: 18px;">
* ১৯৭১ সালের প্রতিটি দিনের উল্লেখযোগ্য ঘটনার উল্লেখ।</br>
* মুক্তিযুদ্ধের মহান বীর সেনানীদের (বীরশ্রেষ্ঠ, বীর উত্তম, বীর বিক্রম, বীর প্রতীক) নামের তালিকা। </br>
* মুক্তিযুদ্ধকালীন গঠিত বিভিন্ন সেক্টর সম্পর্কে সংক্ষিপ্ত আলোচনা।</br>
* প্রতিটি অংশই সর্টকোড দ্বারা ওয়েবসাইটের যেকোন জায়গায় ব্যবহার করা যাবে।</br>
* এছাড়াও প্রতিনিয়ত নতুন নতুন তথ্য হালনাগাদ ও পূর্বের তথ্যের নিশ্চয়তাকরণ করা হবে।</p>

<p style="font-size: 18px; font-weight: bold;"> কিছু গুরুত্বপূর্ণ প্রশ্নের উত্তরঃ </p>  
<p style="font-size: 18px; text-align:justify;padding:10px">
১. এই প্লাগইনটি দ্বারা মুক্তিযুদ্ধের বিভিন্ন তথ্য কিভাবে ওয়েবসাইটে প্রকাশ করব?</br>
- সর্টকোডের মাধ্যমে বিভিন্ন তথ্য ওয়েবসাইটে প্রকাশ করা যায়।</br>

২. ১৯৭১ সালের প্রতিদিনের উল্লেখযোগ্য ঘটনাগুলো কিভাবে ওয়েবসাইটে প্রকাশ করব? </br>
- ‘একাত্তরের এই দিনে’ নামের সেবাটি ব্যবহার করে ১৯৭১ সালের প্রতিদিনের উল্লেখযোগ্য ঘটনা ওয়েবসাইটে প্রকাশ করা যায়। সেক্ষেত্রে  [onthisday1971] এই সর্টকোড ব্যবহার করতে হবে। এছাড়াও ড্যাশবোর্ডের widget অপশনে ‘একাত্তরের এই দিনে’ নামে একটি widget আছে যেটিকে ব্যবহার করেও ওয়েবসাইটের Sidebar এ প্রকাশ করা যাবে।</br>

৩. ১৯৭১ সালের মহান মুক্তিযুদ্ধের বীর সেনানীদের নাম কিভাবে প্রকাশ করব?</br>
- ‘একাত্তরের বীর সেনানীরা’ নামের সেবাটি ব্যবহার করে মহান বীরযোদ্ধাদের নামের তালিকা ওয়েবসাইটে প্রকাশ করা যায়। সেক্ষেত্রে [our-hero] এই সর্টকোডটি ব্যবহার করতে হবে।</br>

৪. মুক্তিযুদ্ধকালীন গঠিত সেক্টরগুলোর সংক্ষিপ্ত আলোচনা কিভাবে প্রকাশ করব?</br>
- ‘একাত্তরের সেক্টরসমূহ’ নামের সেবাটি ব্যবহার করে মুক্তিযুদ্ধকালীন গঠিত সেক্টরগুলো সম্পর্কে সংক্ষিপ্ত আলোচনা প্রকাশ করা যায়। সেক্ষেত্রে 
[sector1971] এই সর্টকোডটি ব্যবহার করতে হবে।</p>

<p style="font-size: 18px; font-weight: bold; text-align:justify; padding:10px">পুনশ্চঃ যেহেতু এটি একটি মহান ইতিহাস নির্ভর প্লাগইন, তাই সকল ব্যবহারকারীর কাছে অনুরোধ এখানে ব্যবহৃত কোন তথ্য ভুল কিংবা বিভ্রান্তিকর মনে হলে সংগে সংগে আমাদের ইমেইলে (projoktibangla@gmail.com) বিস্তারিত জানাবেন, যেন পরবর্তী হালনাগাদের সময়ই তথ্য নিশ্চিতকরণ করা যায়।</p>

<p style="font-size: 18px;"> এই প্লাগইনটির সর্বস্বত্ত্ব সংরক্ষিত আছে প্রযুক্তি বাংলা টিম ও এস এম ফাউন্ডেশন এর দ্বারা। এবং ব্যবহৃত সকল তথ্যের স্বত্ত্ব বাংলাদেশ মুক্তিযুদ্ধ জাদুঘরের কাছে সংরক্ষিত।</p>

<?php	
}
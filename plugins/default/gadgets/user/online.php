<?php

$online = whoisonline_gadget(['page_limit' => 20]);
$count = whoisonline_gadget(['count' => true]);
echo '<div class="ossn-profile-module-friends">';
if($online) {
		foreach($online as $user) {
				$url       = $user->iconURL()->small;
				$profile   = $user->profileURL();
				$user_name = $user->fullname;
				echo "<a target='_blank' href='{$profile}'>
            			<img src='{$url}' title='{$user->fullname}'/>
      			 </a>";
		}
		if($count > 20 && com_is_active('WhoisOnline')){
			echo ossn_plugin_view('output/url', array(
					'class' => 'd-block margin-top-10 text-center',
					'text' => ossn_print('ossngadget:view:all'),
					'href' => ossn_site_url('whoisonline'),
			));	
		}
} else {
	echo ossn_print('ossngadget:whoisonline:no');		
}
echo '</div>';
<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Core Team
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
$friends = $params['user']->getFriends(false, array(
		'limit' => 9
));
if($friends) {
		foreach($friends as $friend) {
				$url       = $friend->iconURL()->small;
				$profile   = $friend->profileURL();
				$user_name = $friend->fullname;
				echo "<a href='{$profile}'>
            		<img src='{$url}' title='{$friend->fullname}'/>
       			</a>";
		}
} else {
		echo '<h3>' . ossn_print('no:friends') . '</h3>';
}

<div class="text-center">
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
$user =  new OssnUser();
$users = $user->searchUsers(array(
		'order_by' => 'u.guid DESC',							
		'limit' => 8
));
if($users) {
		foreach($users as $user) {
				$url       = $user->iconURL()->small;
				$profile   = $user->profileURL();
				$user_name = $user->fullname;
				echo "<a href='{$profile}'>
            		<img src='{$url}' title='{$user->fullname}'/>
       			</a>";
		}
}
?>
</div>
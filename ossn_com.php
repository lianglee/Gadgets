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
define('__Gadget__', ossn_route()->com . 'Gadgets/');

global $Ossn;
$Ossn->gadgets = array();

//Register the Gadgets class
ossn_register_class(array(
		'Gadgets' => __Gadget__ . 'classes/Gadgets.php',
));
/**
 * Initialize the Gadgets
 *
 * @return void
 */
ossn_register_callback('ossn', 'init', function () {
		ossn_new_js('gadgets.core', 'gadgets/js/core');
		ossn_new_css('gadgets.core', 'gadgets/css/core');
		
		$contain = str_contains('12', '1');
		if(ossn_isLoggedin()) {
				ossn_register_gadget('user/friends', 'gadgets/user/friends');
				ossn_register_gadget('user/latest', 'gadgets/user/latest');
				ossn_register_gadget('user/albums', 'gadgets/user/albums');
				ossn_register_gadget('user/online', 'gadgets/user/online');
				ossn_register_gadget('site/search', 'gadgets/site/search');

				if(com_is_active('Events')) {
						ossn_register_gadget('site/events', 'gadgets/site/events');
				}
				if(com_is_active('MarketPlace')) {
						ossn_register_gadget('site/marketplace', 'gadgets/site/marketplace');
				}
				if(com_is_active('MP3')) {
						ossn_register_gadget('site/mp3', 'gadgets/site/mp3');
				}
				if(com_is_active('Files')) {
						ossn_register_gadget('site/files', 'gadgets/site/files');
				}
				ossn_register_action('gadget/user/save', __Gadget__ . 'actions/user/save.php');
		}
		if(ossn_isAdminLoggedin()){
				ossn_register_action('gadget/site/save', __Gadget__ . 'actions/site/save.php');
		}
});
/**
 * Gadget whois online
 *
 * @param array $params Options for OssnUser
 *
 * @return int | array | bool
 */
function whoisonline_gadget(array $params = array()): int | array | bool {
		$time      = time();
		$intervals = 60;
		$users     = new OssnUser();
		$notself   = '';

		if(ossn_isLoggedin()) {
				$user    = ossn_loggedin_user();
				$notself = "AND u.guid != {$user->guid}";
		}
		$default = array(
				'offset' => input('online_users_page', '', 1),
				'wheres' => "(u.last_activity > {$time} - {$intervals} {$notself})",
		);
		$args = array_merge($default, $params);
		return $users->searchUsers($args);
}
/**
 * Gadget types allowed
 *
 * @return array
 */
function ossn_gadget_allowed_save_types(): array {
		return ossn_call_hook('gadget', 'allowed:types', false, array(
				'user/dashboard',
		));
}
/**
 * Register a gadget
 *
 * @param string $name Name for gadget
 * @param string $path Path to the view
 *
 * @return void
 */
function ossn_register_gadget(string $name, string $path): void {
		global $Ossn;
		$Ossn->gadgets[$name] = $path;
}
/**
 * Get all gadgets
 *
 * @return array
 */
function ossn_gadgets_all(): array {
		global $Ossn;
		return array_keys($Ossn->gadgets);
}
/**
 * Normalize name for system use
 *
 * @param string $name Name for gadget
 *
 * @return string
 */
function ossn_gadget_normalize_name(string $name): string {
		return str_replace('/', ':', $name);
}
/**
 * View gadget
 *
 * @param string $name Name for gadget
 * @param object $user User Instance
 *
 * @return mixed
 */
function ossn_view_gadget(string $name, false | OssnUser $user = false): mixed {
		global $Ossn;
		if(isset($Ossn->gadgets) && isset($Ossn->gadgets[$name])) {
				if(!$user || ($user && !$user instanceof OssnUser)) {
						$user = ossn_loggedin_user();
				}
				$path     = $Ossn->gadgets[$name];
				$contents = ossn_plugin_view($path, array(
						'user' => $user,
				));
				$title = ossn_gadget_normalize_name($name);
				return ossn_plugin_view('widget/view', array(
						'title'    => ossn_print('ossngadget:' . $title),
						'contents' => $contents,
				));
		}
		return false;
}

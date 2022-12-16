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
echo ossn_view_form('OssnSearch/search', array(
		'autocomplete' => 'off',
		'method' => 'get',
		'security_tokens' => false,
		'action' => ossn_site_url("search"),
));
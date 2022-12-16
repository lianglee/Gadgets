<?php
$allowed = ossn_gadget_allowed_save_types();
$name    = input('name');
$layout  = base64_decode(input('layout'));
$layout  = json_decode($layout, true);
if($layout) {
		$escaped = array();
		foreach($layout as $key => $item) {
				ossn_set_input('_key', $key);
				$ekey           = input('_key');
				$escaped[$ekey] = array();
				foreach($item as $subitem) {
						ossn_set_input('_subitem', $subitem);
						$esubitem = input('_subitem');
						array_push($escaped[$ekey], $esubitem);
				}
		}
}
$type    = explode('/', $name);
if( $type[0] != 'admin' && $type[0] != 'user'){
		echo 0;
		exit;
}
if(in_array($type, $allowed)){
		echo 0;
		exit;
}
$Gadgets = new Gadgets();
$Gadgets->layout_page = $name;
$Gadgets->owner_guid = ossn_loggedin_user()->guid;
if($Gadgets->saveLayout($escaped)){
		echo 1;	
}
exit();
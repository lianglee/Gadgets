<?php
	$files = new MP3;
		$all = $files->getAll(array(
				'page_limit' => 5,
				'order_by' => 'o.guid DESC',
				'entities_pairs' => array(
					array(
						'name' => 'container_type',
						'value' => 'user',
				 	),
			)						
		));	
	if($all){
		foreach($all as $item){
				$data['file'] = $item;
				$data['user_entity'] = false;
				$data['show_desc'] = false;
				echo ossn_plugin_view('mp3file/item', $data);
		}
	}
	<?php
	$files = new File;
		$all = $files->getAll(array(
				'order_by' => 'o.guid DESC',
				'page_limit' => 3,
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
				echo ossn_plugin_view('files/item', $data);
		}
	}
	?>
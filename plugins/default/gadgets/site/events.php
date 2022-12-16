<?php
$Events = new Events();
$Coming = $Events->getEvents(array(
		'offset' => 1,
		'limit' => 5,
		'entities_pairs' =>  array(
					array(
								'name'   => 'date',
								'value'  => false,
								'wheres' => 'emd0.value IS NOT NULL',
					),
					array(
								'name'   => 'is_finished',
								'value'  => 'no',
					)
					
		),
		'order_by' => "STR_TO_DATE(emd0.value, '%c/%d/%Y') ASC",
));
			if($Coming){
				foreach($Coming as $item){ 
					if(!$item instanceof Events){
						continue;
					}
?>
            <div class="row event-list-item">
           			<div class="col-md-4">
                                  <div class="image-event">
                				<img class="img-responsive" src="<?php echo $item->iconURL();?>" />
                			</div>
                    </div>
                    <div class="col-md-8">
                    	<div class="title"><span><a href="<?php echo $item->profileURL();?>"><?php echo $item->title;?></a></span></div>
						<?php if(isset($item->is_finished) && $item->is_finished == 'yes'){ ?>
        					<div class="badge bg-warning label label-warning"><?php echo ossn_print('event:finished'); ?></div>
						<?php } ?>                        
                        <div class="options">
                        	<div class="metadata">
                                <li><i class="fa fa-map-marker"></i><?php echo $item->location;?></li>
                                <li><i class="fa fa-calendar-o"></i><?php echo date("F, d Y", strtotime($item->date));?></li>
                                <li><i class="fa fa-clock-o"></i><?php echo $item->start_time; ?> - <?php echo $item->end_time; ?></li>
                            </div>
                        </div>
                    </div>
            </div>
            <?php
				}
			} if(!$Coming){ 
				echo ossn_print("event:no:result");
			}
?>

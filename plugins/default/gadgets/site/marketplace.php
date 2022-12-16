<?php
$list = new Ossn\MarketPlace\Product;
$all = $list->getList(array(
		'page_limit' => 3,							
));
?>
<?php
if($all){
	foreach($all as $product){ ?>
				<div class="marketplace-ibox">
					<div class="marketplace-ibox-content marketplace-product-box">
						<?php if($product->isSold()){ ?>
						<span class="marketplace-product-sold">
						<?php echo ossn_print('marketplace:sold');?>
						</span>
						<?php } ?>
						<div class="marketplace-product-imitation">
							<img src="<?php echo $product->getCover();?>" />
						</div>
						<div class="marketplace-product-desc">
							<span class="marketplace-product-price">
							<?php echo ossn_print('marketplace:currenct:input', array($product->price, $product->currency));?>
							</span>
							<small class="text-muted"><?php echo $product->getCategory()->title;?></small>
							<a href="<?php echo $product->getURL();?>" class="marketplace-product-name"><?php echo $product->title;?></a>
							<div class="small m-t-xs">
								<div class="marketplace-desc-list">
									<li><i class="fa fa-map-marker"></i><span><?php echo $product->location;?></span></li>
									<li>
										<i class="fa fa-archive"></i>
										<span><?php if($product->product_type == 'new'){ echo ossn_print('marketplace:type:new'); }  else { echo ossn_print('marketplace:type:used'); }?></span>
									</li>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php 
	} 
} else {
					echo "<div class='marketplace-nothing'>".ossn_print('marketplace:nothing')."</div>";		
}
?>

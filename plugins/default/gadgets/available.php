<div class="ossn-gadget-editor-container">
	<div class="ossn-gadget-layout">
		<div class="ossn-gadget-editor-head"><span class="ossn-gadget-editor-title"><?php echo ossn_print('ossngadget:available');?></span></div>
		<ul id="gadgets-available">
			<?php 
				foreach(ossn_gadgets_all() as $gadget){ 
					$translation = ossn_print('ossngadget:' . ossn_gadget_normalize_name($gadget));
					?>
			<li data-name="<?php echo $gadget;?>" data-title='<?php echo $translation?>'><?php echo $translation;?> <span class="gadget-add"><i class="fas fa-plus"></i></span></li>
			<?php } ?>
		</ul>
	</div>
</div>
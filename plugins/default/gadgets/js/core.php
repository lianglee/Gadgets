//<script>
Ossn.register_callback('ossn', 'init', 'ossn_gadgets_init');
/**
 * Gadget get order
 * @param string $id gadget element 
 * 
 * @return array
 */
function ossn_gadgets_get_order($id) {
	$item = $($id).find('li');
	$order = new Array();
	$($item).each(function() {
		$order.push($(this).attr('data-name'));
	});
	return $order;
}
/**
 * Initialize sortable
 * 
 * @return void
 */
function gadgets_sortable() {
	cols = Ossn.call_hook('gadget', 'sections');
	$(cols).sortable({
		connectWith: ".gadget-sortable",
		receive: function() {
			//console.log('droped');
		},
	});
}
/**
 * Gadget insert template into element
 * @param string name name of gadget
 * @param string title gadget title gadget 
 * @param string element element id
 * 
 * @return boolean|void
 */
function gadget_insert(name, title, element) {
	if ($('.gadget-sortable').find('li[data-name="' + name + '"]').length > 0) {
		return true;
	}
	var tpl = '<li data-name="' + name + '">' + title + '  <span class="gadget-remove"><i class="fas fa-trash-alt"></i></span></li>';
	$(element).append(tpl);
}
/**
 * Gadget emulate add event to add gadgets into sections manually
 * 
 * @param string name name of gadget
 * @param string contain element id
 * 
 * @return void
 */
function gadget_emulate_add(name, container) {
	var available = $('#gadgets-available').find('li[data-name="' + name + '"]');
	var title = available.attr('data-title');
	available.addClass('gadget-inuse');
	gadget_insert(name, title, container);
}
/**
 * Initialize the gadgets
 * 
 * @return void
 */
function ossn_gadgets_init() {
	$(document).ready(function() {
		var jqv = jQuery().jquery;
		if (jqv == '1.11.1') {
			return false;
		}
		$('body').on('click', '#gadget-save-layout', function() {
			var options = Ossn.call_hook('gadget', 'save', null, {
				'layout_page': false,
			});
			var name = options['name'];
			delete options['name'];

			var save_url = Ossn.site_url + 'action/gadget/user/save?name=' + name;
			var gadget_data_type = $('#gadget-save-layout').attr('data-type');
			
			if(gadget_data_type && gadget_data_type == 'site'){
				save_url = Ossn.site_url + 'action/gadget/site/save?name=' + name;
			}
			
			Ossn.PostRequest({
				params: '&layout=' + btoa(JSON.stringify(options['layout'])),
				url: save_url,
				beforeSend: function(request) {
					$('.gadget-save').prepend('<div class="ossn-loading"></div>');
					$('.gadget-save a').hide();
				},
				callback: function(callback) {
					$('.gadget-save .ossn-loading').remove();
					$('.gadget-save a').show();
				}
			});
		});

		$('body').on('click', '.gadget-remove', function() {
			var $parent = $(this).parent().remove();
			var name = $(this).parent().attr('data-name');
			$('#gadgets-available').find('li[data-name="' + name + '"]').removeClass('gadget-inuse');
		});

		$('body').on('click', '.gadget-add', function() {
			var title = $(this).parent().attr('data-title');
			var name = $(this).parent().attr('data-name');
			$insert_element = Ossn.call_hook('gadget', 'insert');

			gadget_insert(name, title, $insert_element);
			//mark as existed already
			$(this).parent().addClass('gadget-inuse');
		});
	});
}
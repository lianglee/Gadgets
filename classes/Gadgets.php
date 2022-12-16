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
class Gadgets extends OssnObject {
		public $layout_page;
		public $owner_guid = 0;
		public $type       = 'user';
		public $subtype    = 'gadget';
		/**
		 * Gadget existing layout for the owner
		 *
		 * @return object|boolean
		 */
		public function getLayout(): Gadgets | bool {
				if(!empty($this->layout_page) && !empty($this->owner_guid)) {
						$search = $this->searchObject(array(
								'type'           => $this->type,
								'subtype'        => $this->subtype,
								'owner_guid'     => $this->owner_guid,
								'entities_pairs' => array(
										array(
												'name'  => 'layout_page',
												'value' => $this->layout_page,
										),
								),
						));
						if($search) {
								return $search[0];
						}
				}
				return false;
		}
		/**
		 * Parse layout
		 *
		 * @param string $layout JSON
		 *
		 * @return boolean|array
		 */
		public function parseLayout($layout) {
				return json_decode($layout, true);
		}
		/**
		 * Save layout for user
		 *
		 * @param array $layout Layout settings
		 *
		 * @return integer|boolean
		 */
		public function saveLayout(array $layout = array()): int | bool {
				if(!empty($this->layout_page) && !empty($this->owner_guid) && !empty($layout)) {
						$allowed = ossn_gadget_allowed_save_types();
						if(!in_array($this->layout_page, $allowed)) {
								return false;
						}
						$existing = $this->getLayout();
						if($existing) {
								$existing->description       = json_encode($layout);
								$existing->data->layout_page = $this->layout_page;
								if($existing->save()) {
										return $existing->guid;
								}
						}
						$this->description       = json_encode($layout);
						$this->data->layout_page = $this->layout_page;
						return $this->addObject();
				}
				return false;
		}
}
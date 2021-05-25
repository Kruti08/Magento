<?php
class Ccc_Vendor_Block_Adminhtml_Vendor_Attribute_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs {

	public function __construct() {
		parent::__construct();
		$this->setId('vendor_attribute_tabs');
		$this->setDestElementId('edit_form');
		$this->setTitle(Mage::helper('vendor')->__('Attribute Information'));
	}

	protected function _beforeToHtml() {
		$this->addTab('main', array(
			'label' => Mage::helper('vendor')->__('Properties'),
			'title' => Mage::helper('vendor')->__('Properties'),
			'content' => $this->getLayout()->createBlock('vendor/adminhtml_vendor_attribute_edit_tab_main')->toHtml(),
			'active' => true,
		));

		$model = Mage::registry('entity_attribute');

		$this->addTab('labels', array(
			'label' => Mage::helper('vendor')->__('Manage Label / Options'),
			'title' => Mage::helper('vendor')->__('Manage Label / Options'),
			'content' => $this->getLayout()->createBlock('vendor/adminhtml_vendor_attribute_edit_tab_options')->toHtml(),
		));
		return parent::_beforeToHtml();
	}

	protected function _filterPostData($data) {
		if ($data) {

			$helperCatalog = Mage::helper('user');

			$data['frontend_label'] = (array) $data['frontend_label'];
			foreach ($data['frontend_label'] as &$value) {
				if ($value) {
					$value = $helperCatalog->stripTags($value);
				}
			}
			if (!empty($data['option']) && !empty($data['option']['value']) && is_array($data['option']['value'])) {
				$allowableTags = isset($data['is_html_allowed_on_front']) && $data['is_html_allowed_on_front']
				? sprintf('<%s>', implode('><', $this->_getAllowedTags())) : null;
				foreach ($data['option']['value'] as $key => $values) {
					foreach ($values as $storeId => $storeLabel) {
						$data['option']['value'][$key][$storeId]
						= $helperCatalog->stripTags($storeLabel, $allowableTags);
					}
				}
			}
		}
		return $data;
	}

}
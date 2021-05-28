<?php

class Ccc_Order_Block_Adminhtml_Order_Cart_Items extends Mage_Adminhtml_Block_Sales_Order_Create_Abstract
{

    protected $_buttons = array();

    public function __construct()
    {
        parent::__construct();
        $this->setId('sales_order_create_items');
    }

    public function getItems()
    {
        return $this->getQuote()->getAllVisibleItems();
    }
    
    public function getHeaderText()
    {
        return Mage::helper('sales')->__('Items Ordered');
    }

    public function addButton($args)
    {
        $this->_buttons[] = $args;
    }

    public function getButtonsHtml()
    {
        $html = '';
        $this->_buttons = array_reverse($this->_buttons);
        foreach ($this->_buttons as $buttonData) {
            $html .= $this->getLayout()->createBlock('adminhtml/widget_button')->setData($buttonData)->toHtml();
        }

        return $html;
    }

    protected function _toHtml()
    {
        if ($this->getStoreId()) {
            return parent::_toHtml();
        }
        return '';
    }
}

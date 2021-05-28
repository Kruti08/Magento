<?php

class Ccc_Order_Block_Adminhtml_Order_Cart_Product extends Mage_Adminhtml_Block_Sales_Order_Create_Abstract
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('sales_order_create_search');
    }

    public function getHeaderText()
    {
        return Mage::helper('sales')->__('Please Select Products to Add');
    }

    public function getHeaderCssClass()
    {
        return 'head-catalog-product';
    }
}

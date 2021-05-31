<?php

class Ccc_Order_Block_Adminhtml_Order_Cart_Items_Grid extends Mage_Adminhtml_Block_Template
{
    protected $cart = null;

    public function __construct()
    {
        parent::__construct();
        $this->setId('sales_order_create_search_grid');
    }

    public function setCart($cart)
    {
        $this->cart = $cart;
        return $this;
    }
    
    public function getCart()
    {
        if (!$this->cart) {
            $cart = Mage::getModel('order/cart')->load((int)$this->getCustomerId(), 'customer_id');
            return $cart;
        }
        return $this->cart;
    }

    public function getAddProductButtonHtml()
    {
        $addButtonData = array(
            'label' => Mage::helper('order')->__('Add Product'),
            'onclick' => 'showAction()',
            'class' => 'add',
        );
        return $this->getLayout()->createBlock('adminhtml/widget_button')->setData($addButtonData)->toHtml();
    }

    public function getUpdateProductButtonHtml()
    {
        $addButtonData = array(
            'label' => Mage::helper('order')->__('update Quantity'),
            'onclick' => 'mage.formSubmit(this)',
            'class' => 'add',
        );
        return $this->getLayout()->createBlock('adminhtml/widget_button')->setData($addButtonData)->toHtml();
    }

    public function getProductName($id = null)
    {
        if (!$id) {
            return null;
        }
        $products = Mage::getModel('catalog/product')->getCollection();
        $products->addAttributeToSelect(['name'], 'inner');
        $products->getSelect()->reset(Zend_Db_Select::COLUMNS)->columns(['name' => 'at_name.value']);
        $products->addFieldToFilter('entity_id', $id);
        $products = $products->getResource()->getReadConnection()->fetchRow($products->getSelect());
        return $products['name'];
    }

    public function getHeaderText()
    {
        return Mage::helper('order')->__('Cart Items');
    }
}

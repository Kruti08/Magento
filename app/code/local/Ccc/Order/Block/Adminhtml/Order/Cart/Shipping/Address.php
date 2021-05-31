<?php

class Ccc_Order_Block_Adminhtml_Order_Cart_Shipping_Address extends Mage_Adminhtml_Block_Template
{
    protected $cart = null;

    public function getHeaderText()
    {
        return Mage::helper('order')->__('Shipping Address');
    }

    public function setCart(Ccc_Order_Model_Cart $cart)
    {
        $this->cart = $cart;
        return $this;
    }

    public function getCart()
    {
        if (!$this->cart) {
            return false;
        }
        return $this->cart;
    }

    public function getCustomerId()
    {
        $session = Mage::getSingleton('core/session');
        return $session->getCustomerId();
    }

    public function getShippingAddress()
    {
        $cart = $this->getCart();
        $shippingAddress = $cart->getShippingAddress();
        if ($shippingAddress->getId()) {
            return $shippingAddress;
        }
        $shippingAddress = $cart->getCustomer()->getDefaultShippingAddress();
        if (!$shippingAddress) {
            return mage::getModel('customer/address');
        }
        return $shippingAddress;
    }

    public function getCustomerShippingAddress()
    {
        $customerCollection = Mage::getModel('customer/address')->getCollection();
        $customerCollection->addAttributeToSelect(['city', 'firstname', 'lastname', 'country_id', 'postcode', 'region', 'street'], 'inner');
        $customerCollection->getSelect()
            ->reset(Zend_Db_Select::COLUMNS)
            ->columns(['e.entity_id', 'city' => 'at_city.value', 'firstname' => 'at_firstname.value', 'lastname' => 'at_lastname.value', 'country_id' => 'at_country_id.value', 'postcode' => 'at_postcode.value', 'street' => 'at_street.value', 'region' => 'at_region.value']);
        $customerCollection->addFieldToFilter('entity_id', $this->getCustomerId());
        return $customerCollection->getResource()->getReadConnection()->fetchRow($customerCollection->getSelect());
    }
}

?>

<?php

class Ccc_Order_Model_Customer extends Mage_Customer_Model_Customer
{
    protected $shippingAddress;
    protected $billingAddress;

    public function setBillingAddress(Mage_Customer_Model_Address $address)
    {
        $this->billingAddress = $address;
        return $this;
    }

    public function setShippingAddress(Mage_Customer_Model_Address $address)
    {
        $this->shippingAddress = $address;
        return $this;
    }
    
    public function getBillingAddress()
    {
        if ($this->billingAddress) {
            return $this->billingAddress;
        }
        if (!$this->getId()) {
            return false;
        }
        $addressId = $this->getResource()->getAttribute('13')->getFrontEnd()->getValue($this);
        $address = Mage::getModel('customer/address')->load($addressId);
        $this->setBillingAddress($address);
        return $this->billingAddress;
    }

    public function getShippingAddress()
    {
        if ($this->shippingAddress) {
            return $this->shippingAddress;
        }
        if (!$this->getId()) {
            return false;
        }
        $addressId = $this->getResource()->getAttribute('14')->getFrontEnd()->getValue($this);
        $address = Mage::getModel('customer/address')->load($addressId);
        $this->setShippingAddress($address);
        return $this->shippingAddress;
    }
}

?>

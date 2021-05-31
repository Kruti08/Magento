<?php

class Ccc_Order_Block_Adminhtml_Order_Cart_Billing_Methods extends Mage_Adminhtml_Block_Widget_Form
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('order_create_billing_method');
    }

    public function getHeaderText()
    {
        return Mage::helper('order')->__('Payment Method');
    }

    public function getHeaderCssClass()
    {
        return 'head-payment-method';
    }
    
    public function getPaymentMethod()
    {
        return $this->getCart()->getPaymentMethodCode();
    }
    
    public function getPayemntMethodName()
    {
        $methods = Mage::getModel('payment/config');
        $activeMethods = $methods->getActiveMethods();
        unset($activeMethods['paypal_billing_agreement']);
        unset($activeMethods['checkmo']);
        unset($activeMethods['free']);
        return $activeMethods;
    }

}

?>
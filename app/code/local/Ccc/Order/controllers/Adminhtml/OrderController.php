<?php

class Ccc_Order_Adminhtml_OrderController extends Mage_Adminhtml_Controller_Action
{
    protected $_publicActions = array('view', 'index');

    protected function _construct()
    {
        $this->setUsedModuleName('Ccc_Order');
    }

    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('order')
            ->_addBreadcrumb($this->__('Orders'), $this->__('Orders'));
        return $this;
    }

    protected function _initOrder()
    {
        $id = $this->getRequest()->getParam('order_id');
        $order = Mage::getModel('sales/order')->load($id);

        if (!$order->getId()) {
            $this->_getSession()->addError($this->__('This order no longer exists.'));
            $this->_redirect('*/*/');
            $this->setFlag('', self::FLAG_NO_DISPATCH, true);
            return false;
        }
        Mage::register('sales_order', $order);
        Mage::register('current_order', $order);
        return $order;
    }

    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('newOrderAction');
    }

    public function newOrderAction()
    {
        $this->loadLayout();
        $cart = $this->newCartAction();
        $this->_addContent($this->getLayout()->createBlock('order/adminhtml_order_cart')->setCart($cart));
        $this->renderLayout();
    }

    public function newCartAction()
    {
        try {
            $customerId = $this->getRequest()->getParam('id');
            if (!$customerId) {
            }
            $cart = Mage::getModel('order/cart');
            $session = Mage::getSingleton('core/session');
            $session->setCustomerId($customerId);
            $cart = $cart->load($customerId, 'customer_id');
            if (!$cart->getdata()) {
                $cart = Mage::getModel('order/cart');
                $cart->setCustomerId($customerId);
                $cart->setCreatedDate(Mage::getModel('core/date')->gmtDate('Y-m-d H:i:s'));
                $cart->save();
            }
            return $cart;
        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }

    public function orderCreateAction()
    {
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('order/adminhtml_order_create_grid'));
        $this->renderLayout();
    }
}

?>

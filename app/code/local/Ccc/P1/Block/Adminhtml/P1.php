<?php

class Ccc_P1_Block_Adminhtml_P1 extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    public function __construct()
    {
        $this->_controller = 'adminhtml_p1';
        $this->_blockGroup = 'p1';
        $this->_headerText = Mage::helper('p1')->__('View Data');
        $this->_addButtonLabel = Mage::helper('p1')->__('Add New Data');
        parent::__construct();
    }

}
h<?php
class Ccc_P1_Block_Adminhtml_P1_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{

    public function __construct()
    {
        parent::__construct();
        $this->_controller = 'adminhtml_p1';
        $this->_blockGroup = 'p1';
        $this->_objectId = 'p1_id';
    }
    public function getHeaderText()
    {
        if (Mage::registry('p1_data')->getId()) {
            return 'Edit P1';
        }
        return 'Add P1';
    }
}
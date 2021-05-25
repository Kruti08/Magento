<?php 

class Ccc_P1_Block_Adminhtml_P1_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
	
	public function __construct()
    {
        parent::__construct();
        $this->setId('p1_tab');
        $this->setDestElementId('edit_form');
    }

    protected function _beforeToHtml()
    {
        $this->addTab('tab1', [
            'label' => 'Tab1',
            'title' => 'Tab1',
            'content' => $this->getLayout()->createBlock('p1/adminhtml_p1_edit_tabs_form')->toHtml(),
            'active' => 1,
        ]);
      

        return parent::_beforeToHtml();
	}
}

?>
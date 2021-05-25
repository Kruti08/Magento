<?php 

class Ccc_P1_Block_Adminhtml_P1_Edit_Tabs_Form extends Mage_Adminhtml_Block_Widget_Form{

	public function _prepareForm()
	{
		$form= new Varien_Data_Form();
		$this->setForm($form);
		$model = Mage::registry('p1_data');
        $fieldset = $form->addFieldset('p1_form', [
            'legend' => Mage::helper('p1')->__('P1 Form'),
        ]);

        $fieldset->addField('firstname', 'text', [
            'label' => Mage::helper('p1')->__('First Name'),
            'class' => 'required-entry',
            'required' => true,
            'name' => "p1[firstname]",
            'value'=> $model->getFirstname()
        ]);

        $fieldset->addField('lastname', 'text', [
            'label' => Mage::helper('p1')->__('Last Name'),
            'class' => 'required-entry',
            'required' => true,
            'name' => "p1[lastname]",
            'value'=> $model->getLastname()
        ]);
	}
}

?>
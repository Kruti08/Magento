<?php
class Ccc_Vendor_Block_Adminhtml_Vendor_Attribute_Edit_Tab_Main extends Mage_Eav_Block_Adminhtml_Attribute_Edit_Main_Abstract {

	protected function _prepareForm()
    {
        $attributeObject = $this->getAttributeObject();

        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getData('action'),
            'method' => 'post'
        ));

        $fieldset = $form->addFieldset('base_fieldset',
            array('legend'=>Mage::helper('eav')->__('Attribute Properties'))
        );
        if ($attributeObject->getAttributeId()) {
            $fieldset->addField('attribute_id', 'hidden', array(
                'name' => 'attribute_id',
            ));
        }

        $this->_addElementTypes($fieldset);

        $yesno = Mage::getModel('adminhtml/system_config_source_yesno')->toOptionArray();

        $validateClass = sprintf('validate-code validate-length maximum-length-%d',
            Mage_Eav_Model_Entity_Attribute::ATTRIBUTE_CODE_MAX_LENGTH);
        $fieldset->addField('attribute_code', 'text', array(
            'name'  => 'attribute_code',
            'label' => Mage::helper('eav')->__('Attribute Code'),
            'title' => Mage::helper('eav')->__('Attribute Code'),
            'note'  => Mage::helper('eav')->__('For internal use. Must be unique with no spaces. Maximum length of attribute code must be less then %s symbols', Mage_Eav_Model_Entity_Attribute::ATTRIBUTE_CODE_MAX_LENGTH),
            'class' => $validateClass,
            'required' => true,
        ));

        $inputTypes = Mage::getModel('eav/adminhtml_system_config_source_inputtype')->toOptionArray();

        $fieldset->addField('frontend_input', 'select', array(
            'name' => 'frontend_input',
            'label' => Mage::helper('eav')->__('Vendor Input Type for Store Owner'),
            'title' => Mage::helper('eav')->__('Vendor Input Type for Store Owner'),
            'value' => 'text',
            'values'=> $inputTypes
        ));

        $fieldset->addField('default_value_text', 'text', array(
            'name' => 'default_value_text',
            'label' => Mage::helper('eav')->__('Default Value'),
            'title' => Mage::helper('eav')->__('Default Value'),
            'value' => $attributeObject->getDefaultValue(),
        ));

        // $fieldset->addField('default_value_yesno', 'select', array(
        //     'name' => 'default_value_yesno',
        //     'label' => Mage::helper('eav')->__('Default Value'),
        //     'title' => Mage::helper('eav')->__('Default Value'),
        //     'values' => $yesno,
        //     'value' => $attributeObject->getDefaultValue(),
        // ));

        // $dateFormatIso = Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT);
        // $fieldset->addField('default_value_date', 'date', array(
        //     'name'   => 'default_value_date',
        //     'label'  => Mage::helper('eav')->__('Default Value'),
        //     'title'  => Mage::helper('eav')->__('Default Value'),
        //     'image'  => $this->getSkinUrl('images/grid-cal.gif'),
        //     'value'  => $attributeObject->getDefaultValue(),
        //     'format'       => $dateFormatIso
        // ));

        // $fieldset->addField('default_value_textarea', 'textarea', array(
        //     'name' => 'default_value_textarea',
        //     'label' => Mage::helper('eav')->__('Default Value'),
        //     'title' => Mage::helper('eav')->__('Default Value'),
        //     'value' => $attributeObject->getDefaultValue(),
        // ));

        $fieldset->addField('is_unique', 'select', array(
            'name' => 'is_unique',
            'label' => Mage::helper('eav')->__('Unique Value'),
            'title' => Mage::helper('eav')->__('Unique Value (not shared with other products)'),
            'note'  => Mage::helper('eav')->__('Not shared with other products'),
            'values' => $yesno,
        ));

        $fieldset->addField('is_required', 'select', array(
            'name' => 'is_required',
            'label' => Mage::helper('eav')->__('Values Required'),
            'title' => Mage::helper('eav')->__('Values Required'),
            'values' => $yesno,
        ));

        $fieldset->addField('frontend_class', 'select', array(
            'name'  => 'frontend_class',
            'label' => Mage::helper('eav')->__('Input Validation for Store Owner'),
            'title' => Mage::helper('eav')->__('Input Validation for Store Owner'),
            'values'=> Mage::helper('eav')->getFrontendClasses($attributeObject->getEntityType()->getEntityTypeCode())
        ));

        if ($attributeObject->getId()) {
            $form->getElement('attribute_code')->setDisabled(1);
            $form->getElement('frontend_input')->setDisabled(1);
            if (!$attributeObject->getIsUserDefined()) {
                $form->getElement('is_unique')->setDisabled(1);
            }
        }

        $this->setForm($form);

        // return parent::_prepareForm();
    }

}
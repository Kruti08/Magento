<?php
class Ccc_P1_Block_Adminhtml_P1_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct()
    {
        parent::__construct();
        $this->setSaveParametersInSession(true);
    }
    
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('ccc_p1/p1')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('id', [
            'header' => 'User Id',
            'type' => 'text',
            'index' => 'id',
        ]);
        $this->addColumn('firstname', [
            'header' => 'First Name',
            'index' => 'firstname',
        ]);
        $this->addColumn('lastname', [
            'header' => 'Last Name',
            'index' => 'lastname',
        ]);
        return parent::_prepareColumns();
    }
    
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', ['id' => $row->getId()]);
    }

}
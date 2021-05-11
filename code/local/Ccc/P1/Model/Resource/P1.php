<?php
class Ccc_P1_Model_Resource_P1 extends Mage_Core_Model_Resource_Db_Abstract
{
    public function _construct()
    {
        $this->_init('ccc_p1/p1', 'id');
    }
}
<?php
class Ccc_P1_AdminHtml_P1Controller extends Mage_Adminhtml_Controller_Action
{
    public function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('ccc_p1');
        return $this;
    }

    public function indexAction()
    {
        $this->_initAction();
        // $this->_addContent($this->getLayout()->createBlock('p1/adminhtml_p1'));
        $this->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function editAction()
    {
        try {
            $id = $this->getRequest()->getParam('id');
            $model = Mage::getModel('ccc_p1/p1')->load($id);
            if ($id && !$model->getId()) {
                throw new Exception("Invalid Id", 1);

            }
            Mage::register('p1_data', $model);
            $this->_initAction();
            $this->_addContent($this->getLayout()->createBlock('p1/adminhtml_p1_edit'));
            $this->_addLeft($this->getLayout()->createBlock('p1/adminhtml_p1_edit_tabs'));
            // $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
            $this->renderLayout();
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            $this->_redirect('*/*/');
        }
    }

    public function saveAction()
    {
        if ($this->getRequest()->getPost()) {
            try {
                $id = $this->getRequest()->getParam('id');
                $data = $this->getRequest()->getPost('p1');
                $p1Model = Mage::getModel('ccc_p1/p1')->load($id);
                if ($p1Model->getId()) {
                    $p1Model->addData($data);
                } else {
                    $p1Model->addData($data);
                }
                $p1Model->save();
            } catch (Exception $e) {

            }
            $this->_redirect('*/*/');
        }
    }

    public function deleteAction()
    {
        try {
            $id = (int) $this->getRequest()->getParam('id');
            $p1Model = Mage::getModel('ccc_p1/p1')->load($id);
            $p1Model->delete();
        } catch (Exception $e) {
            Mage::getSingleton('core/session')->addError($e->getMessage());
        }
        $this->_redirect('*/*/');
    }

}
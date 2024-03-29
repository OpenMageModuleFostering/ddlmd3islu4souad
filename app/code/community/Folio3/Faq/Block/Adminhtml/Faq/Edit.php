<?php

class Folio3_Faq_Block_Adminhtml_Faq_Edit extends Mage_Adminhtml_Block_Widget_Form_Container {

  protected function _construct() {
    $this->_blockGroup = 'folio3_faq_adminhtml';
    $this->_controller = 'faq';

    /**
     * The $_mode property tells Magento which folder to use
     * to locate the related form blocks to be displayed in
     * this form container. In our example, this corresponds
     * to BrandDirectory/Block/Adminhtml/Brand/Edit/.
     */
    $this->_mode = 'edit';

    $newOrEdit = $this->getRequest()->getParam('id') ? $this->__('Edit') : $this->__('New');
    $this->_headerText = $newOrEdit . ' ' . $this->__('Faq');
  }

}

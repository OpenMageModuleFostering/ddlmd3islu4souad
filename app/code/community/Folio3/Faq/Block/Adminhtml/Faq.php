<?php

class Folio3_Faq_Block_Adminhtml_Faq extends Mage_Adminhtml_Block_Widget_Grid_Container {

  protected function _construct() {
    parent::_construct();

    /**
     * The $_blockGroup property tells Magento which alias to use to
     * locate the blocks to be displayed in this grid container.
     * In our example, this corresponds to Folio3_Faq/Block/Adminhtml.
     */
    $this->_blockGroup = 'folio3_faq_adminhtml';

    /**
     * $_controller is a slightly confusing name for this property.
     * This value, in fact, refers to the folder containing our
     * Grid.php and Edit.php - in our example,
     */
    $this->_controller = 'faq';

    /**
     * The title of the page in the admin panel.
     */
    $this->_headerText = Mage::helper('folio3_faq')
        ->__('Faq');
  }

  public function getCreateUrl() {
    /**
     * When the "Add" button is clicked, this is where the user should
     * be redirected to - in our example, the method editAction of
     * faqController.php in Folio3_Faq module.
     */
    return $this->getUrl(
            'folio3_faq_admin/faq/edit'
    );
  }

}

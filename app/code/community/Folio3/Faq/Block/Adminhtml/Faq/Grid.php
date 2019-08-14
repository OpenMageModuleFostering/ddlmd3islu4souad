<?php

class Folio3_Faq_Block_Adminhtml_Faq_Grid extends Mage_Adminhtml_Block_Widget_Grid {

  protected function _prepareCollection() {
    /**
     * Tell Magento which collection to use to display in the grid.
     */
    $collection = Mage::getResourceModel(
            'folio3_faq/faq_collection'
    );
    $this->setCollection($collection);
    return parent::_prepareCollection();
  }

  public function getRowUrl($row) {
    /**
     * When a grid row is clicked, this is where the user should
     * be redirected to - in our example, the method editAction of
     * FaqController.php in Folio3_Faq module.
     */
    return $this->getUrl(
            'folio3_faq_admin/faq/edit', array(
          'id' => $row->getId()
            )
    );
  }

  protected function _prepareColumns() {
    /**
     * Here, we'll define which columns to display in the grid.
     */
    $this->addColumn('id', array(
      'header' => $this->_getHelper()->__('ID'),
      'type' => 'number',
      'index' => 'id',
    ));

    $this->addColumn('faq_question', array(
      'header' => $this->_getHelper()->__('Questions'),
      'type' => 'text',
      'index' => 'faq_question',
    ));
	
	$this->addColumn('faq_answer', array(
      'header' => $this->_getHelper()->__('Answers'),
      'type' => 'text',
      'index' => 'faq_answer',
    ));

    $forumoptionsSingleton = Mage::getSingleton(
            'folio3_faq/faq'
    );
    
    /**
     * Finally, we'll add an action column with an edit link.
     */
    $this->addColumn('action', array(
      'header' => $this->_getHelper()->__('Action'),
      'width' => '50px',
      'type' => 'action',
      'actions' => array(
        array(
          'caption' => $this->_getHelper()->__('Edit'),
          'url' => array(
            'base' => 'folio3_faq_admin'
            . '/faq/edit',
          ),
          'field' => 'id'
        ),
      ),
      'filter' => false,
      'sortable' => false,
      'index' => 'id',
    ));

    return parent::_prepareColumns();
  }

  protected function _getHelper() {
    return Mage::helper('folio3_faq');
  }

}

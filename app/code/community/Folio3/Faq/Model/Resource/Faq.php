<?php

class Folio3_Faq_Model_Resource_Faq extends Mage_Core_Model_Resource_Db_Abstract {

  protected function _construct() {
    /**
     * Tell Magento the database name and primary key field to persist
     * data to. Similar to the _construct() of our model, Magento finds
     * this data from config.xml by finding the <resourceModel/> node
     * and locating children of <entities/>.
     *
     * In this example:
     * - Folio3_Faq is the model alias
     * - faq is the entity referenced in config.xml
     * - id is the name of the primary key column
     *
     * As a result, Magento will write data to the table
     * 'folio3_faq/faq' and any calls
     * to $model->getId() will retrieve the data from the
     * column named 'id'.
     */
    $this->_init('folio3_faq/faq', 'id');
  }

}

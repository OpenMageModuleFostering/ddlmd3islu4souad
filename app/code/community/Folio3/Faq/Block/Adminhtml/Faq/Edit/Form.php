<?php

class Folio3_Faq_Block_Adminhtml_Faq_Edit_Form extends Mage_Adminhtml_Block_Widget_Form {

  protected function _prepareForm() {
    // Instantiate a new form to display our folio3_faq for editing.
    $form = new Varien_Data_Form(array(
      'id' => 'edit_form',
      'action' => $this->getUrl(
          'folio3_faq_admin/faq/edit', array(
        '_current' => true,
        'continue' => 0,
          )
      ),
      'method' => 'post',
    ));
    $form->setUseContainer(true);
    $this->setForm($form);

    // Define a new fieldset. We need only one for our simple entity.
    $fieldset = $form->addFieldset(
        'general', array(
      'legend' => $this->__('Faq')
        )
    );

    $forumoptionsSingleton = Mage::getSingleton(
            'folio3_faq/faq'
    );

    // Add the fields that we want to be editable.
    $this->_addFieldsToFieldset($fieldset, array(
      'faq_question' => array(
        'label' => $this->__('Question'),
        'input' => 'text',
        'required' => true,
      ),
	  'faq_answer' => array(
        'label' => $this->__('Answer'),
        'input' => 'textarea',
        'required' => true,
      ),
    ));
    return $this;
  }

  /**
   * This method makes life a little easier for us by pre-populating
   * fields with $_POST data where applicable and wrapping our post data
   * in 'FaqData' so that we can easily separate all relevant information
   * in the controller. You could of course omit this method entirely
   * and call the $fieldset->addField() method directly.
   */
  protected function _addFieldsToFieldset(
  Varien_Data_Form_Element_Fieldset $fieldset, $fields) {
    $requestData = new Varien_Object($this->getRequest()
            ->getPost('faqData'));

    foreach ($fields as $name => $_data) {
      if ($requestValue = $requestData->getData($name)) {
        $_data['value'] = $requestValue;
      }

      // Wrap all fields with faqData group.
      $_data['name'] = "faqData[$name]";

      // Generally, label and title are always the same.
      $_data['title'] = $_data['label'];

      // If no new value exists, use the existing Faq data.
      if (!array_key_exists('value', $_data)) {
        $_data['value'] = $this->_getFaq()->getData($name);
      }

      // Finally, call vanilla functionality to add field.
      $fieldset->addField($name, $_data['input'], $_data);
    }

    return $this;
  }

  /**
   * Retrieve the existing Faq for pre-populating the form fields.
   * For a new Folio3_Faq entry, this will return an empty Folio3_Faq object.
   */
  protected function _getFaq() {
    if (!$this->hasData('faq')) {
      // This will have been set in the controller.
      $faq = Mage::registry('current_faq');

      // Just in case the controller does not register the Folio3_Faq.
      if (!$faq instanceof
          Folio3_Faq_Model_Faq) {
        $faq = Mage::getModel(
                'folio3_faq/faq'
        );
      }

      $this->setData('faq', $faq);
    }

    return $this->getData('faq');
  }

}

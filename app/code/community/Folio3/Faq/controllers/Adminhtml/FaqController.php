<?php

class Folio3_Faq_Adminhtml_FaqController extends Mage_Adminhtml_Controller_Action {

  /**
   * Instantiate our grid container block and add to the page content.
   * When accessing this admin index page, we will see a grid of all
   * Faq currently available in our Magento instance, along with
   * a button to add a new one if we wish.
   */
    public function indexAction() {
		// instantiate the grid container
		$faqBlock = $this->getLayout()
						->createBlock('folio3_faq_adminhtml/faq');
		$this->loadLayout();
		$this->_setActiveMenu('folio3_faq');
		$this->_addContent($faqBlock);
		$this->renderLayout();
    }
 
    public function gridAction()
    {
        $this->loadLayout();
        $this->getResponse()->setBody(
            $this->getLayout()->createBlock('folio3_faq/adminhtml_faq_grid')->toHtml()
        );
    }

  /**
   * This action handles both viewing and editing existing faq.
   */
	public function editAction()
    {
        /**
        * Retrieve existing forum data if an ID was specified.
        * If not, we will have an empty forum entity ready to be populated.
        */
		
        $faq = Mage::getModel('folio3_faq/faq');
        if ($faqId = $this->getRequest()->getParam('id', false)) {
			$faq->load($faqId);
		    if (!$faq->getId()){
                    $this->_getSession()->addError(
                        $this->__('This faq no longer exists.')
                );
                return $this->_redirect('folio3_faq_admin/faq/index');
            }
        }
        //}

        // process $_POST data if the form was submitted
        if ($postData = $this->getRequest()->getPost('faqData')) {
		
        try {
			$faq->addData($postData);
			$faq->save();

			$this->_getSession()->addSuccess(
			$this->__('The faq has been saved.')
			);

			// redirect to remove $_POST data from the request
			return $this->_redirect(
			'folio3_faq_admin/faq/edit',
			array('id' => $faq->getId())
			);
        } 
		catch (Exception $e) {
			Mage::logException($e);
			$this->_getSession()->addError($e->getMessage());
        }

        /**
        * If we get to here, then something went wrong. Continue to
        * render the page as before, the difference this time being
        * that the submitted $_POST data is available.
        */
        }

        // Make the current forum object available to blocks.
        Mage::register('current_faq', $faq);

        // Instantiate the form container.
        $faqEditBlock = $this->getLayout()->createBlock(
        'folio3_faq_adminhtml/faq_edit'
        );

        // Add the form container as the only item on this page.
        $this->loadLayout()
		->_setActiveMenu('folio3_faq/faq')
        ->_addContent($faqEditBlock)
        ->renderLayout();
    }


	public function deleteAction() {
		$params   = $this->getRequest()->getParams();
		$faq = Mage::getModel('folio3_faq/faq');
		$faq->load($params['id']);
		$faq->delete();
		Mage::getSingleton('core/session')->addSuccess(Mage::helper('folio3_faq')->__('Question Successfully Deleted'));
		return $this->_redirect('folio3_faq_admin/faq/index');
	}

  

	public function postAction() {
		if ($data = $this->getRequest()->getPost()) {
				
				//create Folio3_Faq model object
                $model = Mage::getModel('folio3_faq/faq');       
				
				$model->setData($data);
				var_dump ($data);
				die();
                try {
                    
					//Save form data in Folio3_Faq_Info table
						if ($model->getCreatedTime == NULL || $model->getUpdateTime() == NULL) {
                        $model->setCreatedTime(now())
                            ->setUpdateTime(now());
						} else {
							$model->setUpdateTime(now());
						}   
						
						
						$model
						->setFaqQuestion($data['faq']['faq_question'])
						->setFaqAnswer($data['faq']['faq_answer'])
						->save();
						
						//To unset model object -- do not comment out this
						$model->unsetData();
					
					
					Mage::getSingleton('core/session')->addSuccess(Mage::helper('folio3_faq')->__('Item was successfully saved'));
                    Mage::getSingleton('core/session')->setFormData(false);
                    
                    if ($this->getRequest()->getParam('back')) {
                        $this->_redirect('*/*/edit', array('id' => $model->getId()));
                        return;
                    }
                    $this->_redirect('*/*/');
                    return;
				} catch (Exception $e) {
					Mage::getSingleton('core/session')->addError($e->getMessage());
					Mage::getSingleton('core/session')->setFormData($data);
					$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
					return;
				}
        }
        Mage::getSingleton('core/session')->addError(Mage::helper('folio3_faq')->__('Unable to find item to save'));
        $this->_redirect('*/*/');
	}

}

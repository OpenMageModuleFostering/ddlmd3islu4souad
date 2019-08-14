<?php

class Folio3_Faq_IndexController extends Mage_Core_Controller_Front_Action {

	public function indexAction() {
		$this->loadLayout();
		$block = $this->getLayout()->createBlock(
			'Mage_Core_Block_Template', 'folio3_faq.faq', array(
				'template' => 'folio3_faq/faq.phtml'
			)
		);
		$this->getLayout()->getBlock('content')->append($block);
		$this->_initLayoutMessages('core/session');
		$this->renderLayout();
	}

	public function viewAction() {
		$this->loadLayout();
		$this->renderLayout();
	}
}

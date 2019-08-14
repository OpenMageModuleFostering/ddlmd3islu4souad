<?php

/**
 */
$installer = $this;

$installer->startSetup();


$installer->run("CREATE TABLE IF NOT EXISTS `" . $this->getTable("folio3_faq") . "` (
  `id` int unsigned NOT NULL auto_increment,
  `faq_question` text NOT NULL,
  `faq_answer` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=INNODB charset=utf8 COLLATE=utf8_unicode_ci COMMENT='this table is for faq'");

$installer->endSetup();

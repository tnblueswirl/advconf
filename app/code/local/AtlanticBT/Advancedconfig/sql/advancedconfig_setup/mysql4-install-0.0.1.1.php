<?php

$installer = $this;
/* @var $installer Mage_Core_Model_Resource_Setup */

$installer->startSetup();

$installer->run("
    DROP TABLE IF EXISTS {$installer->getTable('atlanticbt_advanced_super_attribute_pricing')};

    CREATE TABLE {$installer->getTable('atlanticbt_advanced_super_attribute_pricing')} (
      `value_id` int(10) unsigned NOT NULL auto_increment,
      `product_super_attribute_id` int(10) unsigned NOT NULL default '0',
      `value_condition` varchar(255) character set utf8 NOT NULL default '',
      `is_percent` tinyint(1) unsigned default '0',
      `pricing_value` decimal(10,4) default NULL,
      `website_id` smallint(5) unsigned NOT NULL DEFAULT '0',
      PRIMARY KEY  (`value_id`),
      KEY `FK_SUPER_PRODUCT_ATTRIBUTE_PRICING` (`product_super_attribute_id`),
      KEY `FK_CATALOG_PRODUCT_SUPER_PRICE_WEBSITE` (`website_id`),
      CONSTRAINT `FK_CATALOG_PRODUCT_SUPER_PRICE_WEBSITE` FOREIGN KEY (`website_id`)
        REFERENCES `{$installer->getTable('core/website')}` (`website_id`)
        ON DELETE CASCADE ON UPDATE CASCADE,
      CONSTRAINT `FK_SUPER_PRODUCT_ATTRIBUTE_PRICING` FOREIGN KEY (`product_super_attribute_id`)
        REFERENCES `{$installer->getTable('catalog_product_super_attribute')}` (`product_super_attribute_id`)
        ON DELETE CASCADE ON UPDATE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

$installer->endSetup();

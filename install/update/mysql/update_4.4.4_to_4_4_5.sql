ALTER TABLE `{prefix}pages` ADD `target` SMALLINT( 1 ) NOT NULL DEFAULT '0';
ALTER TABLE `{prefix}content` ADD `info_mobile` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL AFTER `info3`;
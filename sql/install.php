<?php

$sql = array();

$sql[] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'favorite_products` (
    `id_favorite_products` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `id_product` int(10) unsigned NOT NULL,
    `id_customer` int(10) unsigned NOT NULL,
    `id_shop` int(10) unsigned NOT NULL,
    `date_add` datetime NOT NULL,
    PRIMARY KEY (`id_favorite_products`))
    ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8;';

foreach ($sql as $query) {
    if (!Db::getInstance()->execute($query)) {
        return false;
    }
}
<?php

// use PrestaShop\PrestaShop\Core\Addon\Module\ModuleManagerBuilder;
// use PrestaShop\PrestaShop\Adapter\SymfonyContainer;
// use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
// use PrestaShop\PrestaShop\Core\Feature\TokenInUrls;

// class Link extends LinkCore
// {
//     public function getLastImageLink($id_product, $product_name, $type = null)
//     {
//         $maxId = Db::getInstance()->getValue('SELECT id_image FROM `' . _DB_PREFIX_ . 'image` WHERE id_product = ' . (int)$id_product . '  ORDER BY position DESC');
//         return $this->getImageLink($product_name, $id_product . '-' . $maxId, $type = null);
//     }
// }
<?php

class FavoriteProductsProductsModuleFrontController extends ModuleFrontController
{

    public function setMedia()
    {
        $this->registerStylesheet(
            'front-controller-module',
            'modules/' . $this->module->name . '/views/css/front/favoriteproducts-list.css',
            [
                'media' => 'all',
                'priority' => 1000,
            ]
        );

        $this->registerJavascript(
            'front-controller-module',
            'modules/' . $this->module->name . '/views/js/front/ajax/ajax_favoriteproducts_list.js',
            [
                'position' => 'bottom',
                'priority' => 1000,
            ]
        );

        $this->registerJavascript(
            'front-controller-module-del',
            'modules/' . $this->module->name . '/views/js/front/ajax/ajax_favoriteproducts_del.js',
            [
                'position' => 'bottom',
                'priority' => 1000,
            ]
        );

        $this->registerJavascript(
            'front-controller-module-buy',
            'modules/' . $this->module->name . '/views/js/front/ajax/ajax_favoriteproducts_buy.js',
            [
                'position' => 'bottom',
                'priority' => 1000,
            ]
        );

        return parent::setMedia();
    }

    public function initContent()
    {
        parent::initContent();
        if (Context::getContext()->customer->logged) {
            $admin = false;
            $customerShow = true;
            $id_customer = (int)$this->context->customer->id;
            $db = Db::getInstance();
            $id_shop = (int)Context::getContext()->shop->id;
            $sql = new DbQuery();
            $sql->select('id_product');
            $sql->from('favorite_products', 'c');
            $sql->where('c.id_customer = ' . (int)$id_customer);
            $sql->where('c.id_shop = ' . (int)$id_shop);
            $sql->innerJoin('customer', 'pa', 'c.id_customer = ' . (int)$id_customer);
            $sql->groupBy('c.id_product');

            $products = $db->executeS($sql);

            $info = new Info();
            $info->getInfo($products);

            $contextObject = $this->context;
            $this->context->smarty->assign(array(
                'id' => (int)$contextObject->customer->id,
                'id_customer' => $id_customer,
                'first_name' => $contextObject->customer->firstname,
                'last_name' => $contextObject->customer->lastname,
                'customerShow' => $customerShow,
                'products' => $info->getInfo($products),
                'admin' => $admin,
            ));
            return $this->setTemplate("module:favoriteproducts/views/templates/front/products.tpl");
        } else {
            $this->context->smarty->assign(array(
                'result' => false,
                'error' => 'ERROR you need to register',
            ));
            return $this->setTemplate("module:favoriteproducts/views/templates/front/show-info.tpl");
        }
    }
}


class Info extends ProductListingFrontController
{
    public $products = [];

    public function getInfo($products)
    {
        return $this->prepareMultipleProductsForTemplate($products);
    }

    public function getListingLabel()
    {
    }

    protected function getProductSearchQuery()
    {
    }
    protected function getDefaultProductSearchProvider()
    {
    }
}
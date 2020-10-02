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
        if (Context::getContext()->customer->logged || isset($_GET['id_customer'])) {

            if (isset($_GET['id_customer'])) {
                $admin = true;
                $customerShow = false;
                $id_customer = (int)($_GET['id_customer']);
            } else {
                $admin = false;
                $customerShow = true;
                $id_customer = (int)$this->context->customer->id;
            }
            $db = Db::getInstance();
            $id_shop = (int)Context::getContext()->shop->id;
            $sql = new DbQuery();
            $sql->select('id_product');
            $sql->from('favorite_products', 'c');
            $sql->where('c.id_customer = ' . (int)$id_customer);
            $sql->where('c.id_shop = ' . (int)$id_shop);
            $sql->innerJoin('customer', 'pa', 'c.id_customer = ' . (int)$id_customer);
            // $sql->join('LEFT JOIN `' . _DB_PREFIX_ . 'customer` c ON a.`id_customer` = c.`id_customer`');
            $sql->groupBy('c.id_product');

            $products = $db->executeS($sql);

            // $mysql = 'SELECT p.id_product, p.active, pl.name, GROUP_CONCAT(DISTINCT(cl.name) SEPARATOR ",") as categories,GROUP_CONCAT(DISTINCT(im.id_image) SEPARATOR ",") as images, p.price, p.id_tax_rules_group, p.wholesale_price, p.reference, p.supplier_reference, p.id_supplier, p.id_manufacturer, p.upc, p.ecotax, p.weight, p.quantity, pl.description_short, pl.description, pl.meta_title, pl.meta_keywords, pl.meta_description,CONVERT(pl.meta_description USING utf8), pl.link_rewrite, pl.available_now, pl.available_later, p.available_for_order, p.date_add, p.show_price, p.online_only, p.condition, p.id_shop_default
            // FROM ps_product p
            // LEFT JOIN ps_product_lang pl ON (p.id_product = pl.id_product)
            // LEFT JOIN ps_category_product cp ON (p.id_product = cp.id_product)
            // LEFT JOIN ps_category_lang cl ON (cp.id_category = cl.id_category)
            // LEFT JOIN ps_category c ON (cp.id_category = c.id_category)
            // LEFT JOIN ps_product_tag pt ON (p.id_product = pt.id_product)
            // LEFT JOIN ps_image im ON (im.id_product = p.id_product)
            // WHERE pl.id_lang = 1
            // AND cl.id_lang = 1
            // AND p.id_shop_default = 1 AND c.id_shop_default = 1
            // GROUP BY p.id_product';
            // $favoriteproducts = $db->executeS($mysql);


            //$products = array("id_product" => "1", "id_product" => "1",);

            // $products = [
            //     ["id_product" => 1],
            //     ["id_product" => 2]
            // ];

            // $products = [
            //     "id_product" => 1,
            //     "id_product" => 2
            // ];

            //var_dump($products);

            // $products = array(
            //     array('id_product' => 1),
            //     array('id_product' => 2)
            // );

            // var_dump($products);

            $info = new Info();
            $info->getInfo($products);

            //var_dump($info->getInfo($products));
            $contextObject = $this->context; // or this // $contextObject = Context::getContext();
            $this->context->smarty->assign(array(
                'id' => (int)$contextObject->customer->id,
                'id_customer' => $id_customer,
                'first_name' => $contextObject->customer->firstname,
                'last_name' => $contextObject->customer->lastname,
                // 'email' => $contextObject->customer->email,
                // 'favoriteproducts' => $db->executeS($sql),
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
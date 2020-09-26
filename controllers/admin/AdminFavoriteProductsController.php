<?php

class AdminFavoriteProductsController extends ModuleAdminController
{
    public function __construct()
    {
        $this->bootstrap = true;
        $this->display = 'view';

        //$this->id_lang = $this->context->language->id;
        //$this->default_form_language = $this->context->language->id;

        $this->table = "favorite_products";
        $this->fields_list = array(
            'id_favorite_products' => array('title' => 'ID'),
            'parameter' => array('title' => 'Message'),
        );

        parent::__construct();
    }

    // public function initContent()
    // {
    //     parent::initContent();
    // }



    public function initContent()
    {
        $db = Db::getInstance();

        //var_dump($db);
        // //$product = $params['product'];
        // //$id_product = (int)$product->id;
        // //$id_product_atribute = $product->id_product_atribute;

        // $id_shop = (int)Context::getContext()->shop->id;

        $sql = new DbQuery();
        $sql->select('*');
        $sql->from('favorite_products');
        //$sql->where('id_product_atribute = ' . $id_product_atribute);



        parent::initContent();

        $this->context->smarty->assign(array(
            'favoriteproducts' => $db->executeS($sql),
            'db' => $db,
            'show' => $db->execute($sql),
        ));
        //         return $this->setTemplate("module:favoriteproducts/views/templates/front/favoriteproducts-list.tpl");


        return $this->setTemplate('admin-favoriteproducts-list.tpl');
    }



    // public function initContent()
    // {
    //     parent::initContent();
    //     if (Context::getContext()->customer->logged) {

    //         $db = Db::getInstance();
    //         $id_customer = (int)$this->context->customer->id;
    //         $id_shop = (int)Context::getContext()->shop->id;
    //         $id_lang = (int) Configuration::get('PS_LANG_DEFAULT');

    //         //$product = $params['product'];
    //         // $id_product_atribute = $product->id_product_atribute;
    //         //$name = Tools::getValue('name');

    //         $sql = new DbQuery();
    //         $sql->select('*');
    //         $sql->from('favorite_products', 'c');
    //         //$sql->innerJoin('product_lang', 'l', 'c.id_product = l.id_product AND l.id_product = ' . (int)$id_product);
    //         $sql->innerJoin('product', 'p', 'c.id_product = p.id_product');

    //         $sql->innerJoin('product_attribute', 'pa', 'p.id_product = pa.id_product');
    //         $sql->innerJoin('product_attribute_image', 'pai', 'pa.id_product_attribute = pai.id_product_attribute');


    //         $sql->innerJoin('tax', 't', 't.id_tax = p.id_tax_rules_group');
    //         $sql->innerJoin('product_lang', 'l', 'c.id_product = l.id_product');


    //         $sql->where('id_customer = ' . (int)$id_customer);
    //         //$sql->where('id_shop = ' . (int)$id_shop);
    //         $sql->orderBy('c.id_product');

    //         // $sql->select('id_currency');
    //         // $sql->from('currency_lang', 'cl1');
    //         // $sql->innerJoin('currency_lang', 'cl', 'cl.id_currency =' . $id_lang);


    //         //var_dump($db->executeS($sql));

    //         $contextObject = $this->context; // or this // $contextObject = Context::getContext();
    //         $this->context->smarty->assign(array(
    //             'id' => (int)$contextObject->customer->id,
    //             'first_name' => $contextObject->customer->firstname,
    //             'last_name' => $contextObject->customer->lastname,
    //             'email' => $contextObject->customer->email,
    //             'favoriteproducts' => $db->executeS($sql),
    //             'image' => '777',
    //         ));
    //         return $this->setTemplate("module:favoriteproducts/views/templates/front/favoriteproducts-list.tpl");
    //     } else {
    //         $this->context->smarty->assign(array(
    //             'error' => 'ERROR you need to register',
    //         ));
    //         return $this->setTemplate("module:favoriteproducts/views/templates/front/show-info.tpl");
    //     }
    // }
}
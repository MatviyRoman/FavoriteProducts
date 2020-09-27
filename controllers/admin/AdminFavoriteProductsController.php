<?php

class AdminFavoriteProductsController extends ModuleAdminController
{
    public function __construct()
    {
        $this->bootstrap = true;
        $this->display = 'view';

        // $this->id_lang = $this->context->language->id;
        // $this->default_form_language = $this->context->language->id;

        $this->table = "favorite_products";
        $this->fields_list = array(
            'id_favorite_products' => array('title' => 'ID'),
            'parameter' => array('title' => 'Message'),
        );

        parent::__construct();
    }

    public function initContent()
    {
        $db = Db::getInstance();

        $sql = new DbQuery();
        $sql->select('*');
        $sql->from('favorite_products', 'c');
        $sql->innerJoin('product_lang', 'l', 'c.id_product = l.id_product');
        $sql->innerJoin('customer', 'r', 'c.id_customer = r.id_customer');
        $sql->orderBy('c.id_customer');
        $sql->orderBy('c.id_product');


        parent::initContent();

        $this->context->smarty->assign(array(
            'favoriteproducts' => $db->executeS($sql),
        ));

        return $this->setTemplate('admin-favoriteproducts-list.tpl');
    }


    public function renderView()
    {
        return parent::renderView();
    }
}
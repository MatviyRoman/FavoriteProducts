<?php

class AdminFavoriteProductsController extends ModuleAdminController
{
    protected $countries_array = array();
    protected $position_identifier = 'id_customer';

    public function __construct()
    {
        parent::__construct();
        $this->bootstrap = true;
        $this->required_database = true;
        $this->lang = false;
        $this->table = 'favorite_products';
        $this->_select = 'a.*, c.*';
        $this->_defaultOrderBy = 'a.id_customer';
        $this->_defaultOrderWay = 'ASC';
        $this->orderBy = "a.id_customer";
        $this->orderWay = "desc";
        $this->identifier = 'id_customer';
        $this->className = 'FavoriteProductsClass';
        $this->_join = 'LEFT JOIN `' . _DB_PREFIX_ . 'customer` c ON a.`id_customer` = c.`id_customer`';
        $this->filter = 'id_customer';
        $this->position_identifier = 'id_customer';
        $this->_group = 'GROUP BY a.`id_customer`';
        $this->list_no_link = false;
        $this->context = Context::getContext();
        $this->allow_export = true;
        $this->addressType = 'customer';
        $this->explicitSelect = true;
        parent::__construct();
        $this->addRowAction('view');

        $countries = Country::getCountries($this->context->language->id);
        foreach ($countries as $country) {
            $this->countries_array[$country['id_country']] = $country['name'];
        }

        $this->fields_list = [
            'id_favorite_products' => array(
                'title' => $this->trans('ID', array(), 'Admin.Global'),
                'align' => 'center',
                'class' => 'fixed-width-xs',
            ),
            'firstname' => array('title' => 'First name',),
            'lastname' => array('title' => 'Last name', 'type' => 'text',),
        ];

        parent::__construct();
    }

    public function initContent()
    {
        $this->renderView();
        return parent::initContent();
    }

    public function renderView()
    {
        $id_customer = (int) Tools::getValue('id_customer');
        if (!$id_customer && Validate::isLoadedObject($this->object)) {
            $id_customer = $this->object->id_customer;
        }

        $db = Db::getInstance();
        $id_lang = $this->context->employee->id_lang;
        $id_shop_default = (int)$this->context->shop->id;

        $mysql = 'SELECT DISTINCT fp.id_product, fp.id_customer,fp.date_add,fp.id_shop,p.price,p.id_category_default,pl.description,pl.description_short,pl.name,pl.link_rewrite,pl.id_lang,pl.link_rewrite, pl.name, image_shop.id_image id_image,il.legend as legend, cl.name AS category_default
        FROM ' . _DB_PREFIX_ . 'favorite_products fp
        LEFT JOIN ' . _DB_PREFIX_ . 'product p ON fp.id_product = p.id_product
        LEFT JOIN ' . _DB_PREFIX_ . 'product_attribute_shop product_attribute_shop ON (p.id_product = product_attribute_shop.id_product AND product_attribute_shop.default_on = 1 AND product_attribute_shop.id_shop=' . $id_shop_default . ')
        LEFT JOIN ' . _DB_PREFIX_ . 'image_shop image_shop ON (image_shop.id_product = p.id_product AND image_shop.cover=1 AND image_shop.id_shop=' . $id_shop_default . ')
        LEFT JOIN ' . _DB_PREFIX_ . 'image_lang il ON (image_shop.id_image = il.id_image AND il.id_lang = ' . $id_lang . ')
        LEFT JOIN ' . _DB_PREFIX_ . 'category_lang cl ON cl.id_category = p.id_category_default
        LEFT JOIN ' . _DB_PREFIX_ . 'product_lang pl ON pl.id_product = fp.id_product
        WHERE fp.id_customer = ' . $id_customer . '
        AND fp.id_shop = ' . $id_shop_default . '
        AND pl.id_lang = ' . $id_lang . '
        ORDER BY fp.id_product ASC';

        $products = $db->executeS($mysql);

        $this->context->smarty->assign(
            array(
                'id_customer' => $id_customer,
                'products' => $products,
                'url' => __PS_BASE_URI__
            )
        );
        return $this->context->smarty->fetch(_PS_MODULE_DIR_ . "favoriteproducts/views/templates/admin/products.tpl");
    }

    public function setMedia($isNewTheme = false)
    {
        parent::setMedia($isNewTheme);
        $this->addCSS(__PS_BASE_URI__ . 'modules/' . $this->module->name . '/views/css/admin/admin.css');
        $this->addJS(__PS_BASE_URI__ . 'modules/' . $this->module->name . '/views/js/admin/admin.js');
    }
}
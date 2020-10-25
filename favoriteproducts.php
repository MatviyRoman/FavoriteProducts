<?php

if (!defined('_PS_VERSION_')) {
    exit;
}

require_once('favoriteProductsClass.php');

class Favoriteproducts extends Module
{
    protected $config_form = false;

    public function __construct()
    {
        $this->context = Context::getContext();
        $this->name = 'favoriteproducts';
        $this->tab = 'front_office_features';
        $this->version = '1.1.1';
        $this->author = 'Roman Matviy';
        $this->need_instance = 0;
        $this->bootstrap = true;
        $this->controllers = array('adminfavoriteproducts');
        $this->displayName = $this->l('Favorite Products');
        $this->description = $this->l('The module creates a page for all favorite products');
        $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
        $this->ps_versions_compliancy = array('min' => '1.7', 'max' => _PS_VERSION_);
        parent::__construct();
    }

    /**
     * Don't forget to create update methods if needed:
     * http://doc.prestashop.com/display/PS16/Enabling+the+Auto-Update
     */
    public function install()
    {
        Configuration::updateValue('FAVORITEPRODUCTS_LIVE_MODE', false);

        /**
         * Create New Tab
         */

        $tab = new Tab();
        $tab->class_name = 'AdminFavoriteProducts';
        $tab->module = $this->name;
        $tab->id_parent = 2;
        $tab->icon = 'star';
        $tab->name[1] = $this->l('Favorite Products List');
        $tab->active = 1;
        if (!$tab->save()) {
            return false;
        }

        include(dirname(__FILE__) . '/sql/install.php');

        return parent::install() &&
            $this->registerHook('header') &&
            $this->registerHook('backOfficeHeader') &&
            $this->registerHook('displayCustomerAccount') &&
            $this->registerHook('displayProductPriceBlock') &&
            $this->registerHook('actionFrontControllerSetMedia') &&
            $this->registerHook('displayProductAdditionalInfo') &&
            $this->registerHook('displayFooterAfter') &&
            $this->registerHook('actionCartSave');
    }

    public function uninstall()
    {
        Configuration::deleteByName('FAVORITEPRODUCTS_LIVE_MODE');
        include(dirname(__FILE__) . '/sql/uninstall.php');
        return parent::uninstall();
    }


    /**
     * Add the CSS & JavaScript files you want to be loaded in the BO.
     */
    public function hookBackOfficeHeader()
    {
        if (Tools::getValue('module_name') == $this->name) {
            $this->context->controller->addJS('modules/' . $this->module->name . '/views/js/back/favoriteproducts.js');
            $this->context->controller->addCSS('modules/' . $this->module->name . '/views/css/back/favoriteproducts.css');
        }
    }


    public function hookDisplayCustomerAccount($params)
    {
        $this->smarty->assign('in_footer', false);
        return $this->display(__FILE__, 'account.tpl');
    }

    public function hookActionFrontControllerSetMedia($params)
    {
        $this->context->controller->registerStylesheet(
            'favoriteproducts-style',
            'modules/' . $this->name . '/views/css/front/favoriteproducts.css',
            [
                'media' => 'all',
                'priority' => 1000,
            ]
        );

        $this->context->controller->registerJavascript(
            'favoriteproducts-javascript',
            'modules/' . $this->name . '/views/js/front/favoriteproducts.js',
            [
                'position' => 'top',
                'priority' => 0,
            ]
        );
        $this->context->controller->registerJavascript(
            'favoriteproducts-ajax-add',
            'modules/' . $this->name . '/views/js/front/ajax/ajax_favoriteproducts_add.js',
            [
                'position' => 'top',
                'priority' => 0,
            ]
        );
    }


    public function hookDisplayProductPriceBlock($params)
    {
        if (Context::getContext()->customer->logged) {
            $product = $params['product'];
            $id_product = (int)$product['id_product'];
            $id_customer = (int)$this->context->customer->id;
            $id_shop = (int)Context::getContext()->shop->id;
            $sql = new DbQuery();
            $sql->select('id_product');
            $sql->from('favorite_products');
            $sql->where('id_customer = ' . $id_customer);
            $sql->where('id_shop = ' . $id_shop);

            if ($params['type']  == 'before_price' || $params['type']  == 'price') {
                $product = $params['product'];

                return '<input size="1" type="text" class="multi_product_quantity" value="1" style="display: none" /><input type="checkbox" id="item_product' . $id_product . '" class="check item_product" value="' . $id_product . '"><input type="checkbox" id="cb' . $id_product . '" class="addstar" value="' . $id_product . '" /><label for="cb' . $id_product . '" class="star"></label>';
            }
        }
    }

    public function hookDisplayProductAdditionalInfo($params)
    {
        if (isset($params['product'])) {
            return '<input type="hidden" name="id_product_attribute" id="product_attribute_info" value="' . $params['product']['id_product_attribute'] . '"/>';
        }
    }

    public function hookDisplayFooterAfter($params)
    {
        $siteurl = __PS_BASE_URI__;
        $this->context->smarty->assign(array(
            'siteurl' => $siteurl,
        ));

        return $this->display(__FILE__, 'info.tpl');
    }
}
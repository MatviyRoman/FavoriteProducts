<?php

// if (!defined('_CAN_LOAD_FILES_'))
// 	exit;

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
        $this->version = '1.0.0';
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
        $tab->module = 'favoriteproducts';
        $tab->icon = 'star';

        $tab->name[1] = $this->l('Favorite Products List');
        $tab->id_parent = 2;
        $tab->active = 1;
        if (!$tab->save()) {
            return false;
        }

        include(dirname(__FILE__) . '/sql/install.php');

        return parent::install() &&
            $this->registerHook('header') &&
            $this->registerHook('backOfficeHeader') &&
            $this->registerHook('displayCustomerAccount') &&
            $this->registerHook('DisplayProductPriceBlock') &&
            $this->registerHook('actionFrontControllerSetMedia') &&
            //$this->installTab('2', 'AdminFavoriteProducts', 'Favorite Products List') &&
            $this->registerHook('actionCartSave');
    }

    public function uninstall()
    {
        Configuration::deleteByName('FAVORITEPRODUCTS_LIVE_MODE');

        include(dirname(__FILE__) . '/sql/uninstall.php');

        return parent::uninstall();


        // return parent::uninstall() 
        // &&
        // $this->uninstallTab('AdminFavoriteProducts');
    }



    // public function installTab($parent, $class_name, $name)
    // {
    //     $tab = new Tab();
    //     $tab->id_parent = (int)Tab::getIdFromClassName($parent);
    //     $tab->name = array();
    //     foreach (Language::getLanguage(true) as $lang)
    //         $tab->name[$lang['id_lang']] = $name;
    //     $tab->class_name = $class_name;
    //     $tab->module = $this->name;
    //     $tab->active = 1;
    //     return $tab->add();
    // }

    // public function uninstallTab($class_name)
    // {
    //     $id_tab = (int)Tab::getIdFromClassName($class_name);
    //     $tab = new Tab((int)$id_tab);
    //     return $tab->delete();
    // }



    /**
     * Load the configuration form
     */
    public function getContent()
    {
        /**
         * If values have been submitted in the form, process.
         */
        if (((bool)Tools::isSubmit('submitFavoriteproductsModule')) == true) {
            $this->postProcess();
        }

        $this->context->smarty->assign('module_dir', $this->_path);
        $output = $this->context->smarty->fetch($this->local_path . 'views/templates/admin/configure.tpl');
        return $output . $this->renderForm();
    }

    /**
     * Create the form that will be displayed in the configuration of your module.
     */
    protected function renderForm()
    {
        $helper = new HelperForm();

        $helper->show_toolbar = false;
        $helper->table = $this->table;
        $helper->module = $this;
        $helper->default_form_language = $this->context->language->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG', 0);

        $helper->identifier = $this->identifier;
        $helper->submit_action = 'submitFavoriteproductsModule';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false)
            . '&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');

        $helper->tpl_vars = array(
            'fields_value' => $this->getConfigFormValues(), /* Add values for your inputs */
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id,
        );

        return $helper->generateForm(array($this->getConfigForm()));
    }

    /**
     * Create the structure of your form.
     */
    protected function getConfigForm()
    {
        return array(
            'form' => array(
                'legend' => array(
                    'title' => $this->l('Settings'),
                    'icon' => 'icon-cogs',
                ),
                'input' => array(
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Live mode'),
                        'name' => 'FAVORITEPRODUCTS_LIVE_MODE',
                        'is_bool' => true,
                        'desc' => $this->l('Use this module in live mode'),
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => true,
                                'label' => $this->l('Enabled')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => false,
                                'label' => $this->l('Disabled')
                            )
                        ),
                    ),
                    array(
                        'col' => 3,
                        'type' => 'text',
                        'prefix' => '<i class="icon icon-envelope"></i>',
                        'desc' => $this->l('Enter a valid email address'),
                        'name' => 'FAVORITEPRODUCTS_ACCOUNT_EMAIL',
                        'label' => $this->l('Email'),
                    ),
                    array(
                        'type' => 'password',
                        'name' => 'FAVORITEPRODUCTS_ACCOUNT_PASSWORD',
                        'label' => $this->l('Password'),
                    ),
                ),
                'submit' => array(
                    'title' => $this->l('Save'),
                ),
            ),
        );
    }

    /**
     * Set values for the inputs.
     */
    protected function getConfigFormValues()
    {
        return array(
            'FAVORITEPRODUCTS_LIVE_MODE' => Configuration::get('FAVORITEPRODUCTS_LIVE_MODE', true),
            'FAVORITEPRODUCTS_ACCOUNT_EMAIL' => Configuration::get('FAVORITEPRODUCTS_ACCOUNT_EMAIL', 'contact@prestashop.com'),
            'FAVORITEPRODUCTS_ACCOUNT_PASSWORD' => Configuration::get('FAVORITEPRODUCTS_ACCOUNT_PASSWORD', null),
        );
    }

    /**
     * Save form data.
     */
    protected function postProcess()
    {
        $form_values = $this->getConfigFormValues();

        foreach (array_keys($form_values) as $key) {
            Configuration::updateValue($key, Tools::getValue($key));
        }
    }

    /**
     * Add the CSS & JavaScript files you want to be loaded in the BO.
     */
    public function hookBackOfficeHeader()
    {
        if (Tools::getValue('module_name') == $this->name) {
            $this->context->controller->addJS($this->_path . 'views/js/back/favoriteproducts.js');
            $this->context->controller->addCSS($this->_path . 'views/css/back/favoriteproducts.css');
        }
    }

    /**
     * Add the CSS & JavaScript files you want to be added on the FO.
     */
    // public function hookHeader()
    // {
    //     $this->context->controller->addJS($this->_path.'/views/js/front.js');
    //     $this->context->controller->addCSS($this->_path.'/views/css/front.css');
    // }


    public function hookDisplayCustomerAccount($params)
    {
        $this->smarty->assign('in_footer', false);
        return $this->display(__FILE__, 'account.tpl');
    }

    public function hookActionFrontControllerSetMedia()
    {
        $this->context->controller->registerStylesheet(
            'favoriteproducts-style',
            $this->_path . 'views/css/front/favoriteproducts.css',
            [
                'media' => 'all',
                'priority' => 1000,
            ]
        );

        $this->context->controller->registerJavascript(
            'favoriteproducts-javascript',
            $this->_path . 'views/js/front/favoriteproducts.js',
            [
                'position' => 'top',
                'priority' => 0,
            ]
        );
        $this->context->controller->registerJavascript(
            'favoriteproducts-ajax-add',
            $this->_path . 'views/js/front/ajax/ajax_favoriteproducts_add.js',
            [
                'position' => 'top',
                'priority' => 0,
            ]
        );
    }


    public function hookDisplayProductPriceBlock($params)
    {
        if (Context::getContext()->customer->logged) {

            //parent::initContent();
            $db = Db::getInstance();
            $product = $params['product'];
            $id_product = (int)$product->id;
            //$id_product_atribute = $product->id_product_atribute;

            $id_customer = (int)$this->context->customer->id;
            $id_shop = (int)Context::getContext()->shop->id;

            $sql = new DbQuery();
            $sql->select('id_product');
            $sql->from('favorite_products');
            $sql->where('id_customer = ' . $id_customer);
            $sql->where('id_product = ' . $id_product);
            //$sql->where('id_product_atribute = ' . $id_product_atribute);
            $sql->where('id_shop = ' . $id_shop);

            //var_dump($db->executeS($sql));

            // $request = 'SELECT `id_product` FROM `' . _DB_PREFIX_ . 'favorite_products` WHERE `id_customer` = ' . (int)$id_customer . ' AND `id_product` = ' . (int)$id_product;
            // $result = $db->executeS($request);
            // var_dump($result);

            if ($params['type']  == 'before_price' || $params['type']  == 'price') {
                $request = 'SELECT `id_product` FROM `' . _DB_PREFIX_ . 'favorite_products` WHERE `id_customer` = ' . (int)$id_customer . ' AND `id_product` = ' . (int)$id_product;
                $result = $db->executeS($request);

                //var_dump($result);
                //$product = $params['product'];
                // return '<input type="checkbox" id="cb' . $product->id . '" class="addstar" value="' . $product->id . '" />
                //             <label for="cb' . $product->id . '" class="star"></label>';

                return '<input type="checkbox" id="cb' . $id_product . '" class="addstar" value="' . $id_product . '" />
                <label for="cb' . $id_product . '" class="star"></label>';
            }
        }
    }
}
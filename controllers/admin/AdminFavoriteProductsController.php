<?php

//require_once _PS_MODULE_DIR_ . '/favoriteproducts/favoriteProductsClass.php';


// public function displayInformationLink($token = null, $id, $name = null)
// {
//     // $token will contain token variable
//     // $id will hold id_identifier value
//     // $name will hold display name
//     return $this->context->smarty->fetch(_PS_MODULE_DIR_ . 'yourmodulename/views/templates/hook/information.tpl');
// }


// public function initToolbar()
// {
//     parent::initToolbar();

//     if (!$this->display && $this->can_import) {
//         $this->toolbar_btn['import'] = array(
//             'href' => $this->context->link->getAdminLink('AdminImport', true, array(), array('import_type' => 'favorite_products')),
//             'desc' => $this->trans('Import', array(), 'Admin.Actions'),
//         );
//     }
// }


//add new address
// public function initPageHeaderToolbar()
// {
//     if (empty($this->display)) {
//         $this->page_header_toolbar_btn['new_address'] = array(
//             'href' => $this->context->link->getAdminLink('AdminAddresses', true, array(), array('addaddress' => 1)),
//             'desc' => $this->trans('Add new address', array(), 'Admin.Orderscustomers.Feature'),
//             'icon' => 'process-icon-new',
//         );
//     }

//     parent::initPageHeaderToolbar();
// }


// public function renderList($token = null)
// {
//     $current_index = AdminController::$currentIndex;
//     $token = Tools::getAdminTokenLite('AdminModules');

//     $db = Db::getInstance();
//     $sql = new DbQuery();
//     $sql->select('*');
//     $sql->from('favorite_products', 'c');
//     // $sql->innerJoin('product_lang', 'l', 'c.id_product = l.id_product');
//     $sql->innerJoin('customer', 'r', 'c.id_customer = r.id_customer');
//     $sql->orderBy('c.id_favorite_products');
//     //$sql->orderBy('c.id_product');
//     $sql->groupBy('c.id_customer');
//     $list = $db->executeS($sql);

//     //var_dump($list);


//     //$list = DB::getInstance()->executeS("SELECT * FROM `" . _DB_PREFIX_ . "favorite_products`");
//     $fields_list = [
//         'id_favorite_products' => ['title' => $this->l('ID'), 'class' => 'fixed-width-xs'],
//         //'id_product' => ['title' => 'SKU'],
//         'id_customer' => ['title' => $this->l('ID Customer'), 'type' => 'number', 'width' => 190, 'class' => 'fixed-width-xs', 'remove_onclick' => true], // filter_key mandatory because "name" is ambiguous for SQL
//         'firstname' => ['title' => $this->l('First Name'), 'type' => 'text', 'remove_onclick' => true], // filter_key mandatory because "name" is ambiguous for SQL
//         'lastname' => ['title' => $this->l('Last Name'), 'type' => 'text', 'remove_onclick' => true], // filter_key mandatory because "name" is ambiguous for SQL
//         'id_shop' => ['title' => $this->l('ID Shop'), 'type' => 'number', 'remove_onclick' => true],
//         'date_add' => ['title' => $this->l('Date'), 'type' => 'datetime', 'remove_onclick' => true],
//         //'listTotal' => ['title' => 'total', 'remove_onclick' => true],
//     ];
//     $helper = new HelperList();
//     $helper->module = $this;
//     $helper->shopLinkType = '';
//     $helper->simple_header = true;
//     $helper->identifier = 'id_rule';

//     //$helper->actions = array('edit', 'delete', 'view');
//     $helper->actions = array('view');
//     $helper->show_toolbar = true;
//     $helper->title = 'Favorite Products List';
//     //$helper->table = '_rule';
//     $helper->table = '_customer';
//     $helper->token = Tools::getAdminTokenLite('AdminModules');
//     $helper->href = $this->context->link->getAdminLink('AdminCustomerThreads');

//     $helper->listTotal = count($list);

//     $helper->currentIndex = AdminController::$currentIndex . '&configure=' . $this->name;
//     //$helper->currentIndex = $current_index . '&configure=' . $this->name;
//     // $helper->toolbar_btn = array('link' => array('href' => $current_index . '&amp;configure=' . $this->name . '&amp;token=' . Tools::getAdminTokenLite('AdminModules') . '&amp;addBlockCMS', 'desc' => $this->l('Add new')));
//     // $helper->toolbar_btn = [
//     //     'save' => [
//     //         'desc' => $this->l('Save'),
//     //         'href' => AdminController::$currentIndex . '&configure=' . $this->name . '&save' . $this->name .
//     //             '&token=' . Tools::getAdminTokenLite('AdminModules'),
//     //     ],
//     //     'back' => [
//     //         'href' => AdminController::$currentIndex . '&token=' . Tools::getAdminTokenLite('AdminModules'),
//     //         'desc' => $this->l('Back to list')
//     //     ],
//     //     'next' => [
//     //         'href' => AdminController::$currentIndex . '&token=' . Tools::getAdminTokenLite('AdminModules'),
//     //         'desc' => $this->l('Back to list')
//     //     ]
//     // ];

//     // if (Tools::isSubmit('view' . $this->name)) {
//     //     if (!$this->deleteEstimatedDelivery())
//     //         $output . $this->displayError($this->l('An error occured during link deletion'));
//     //     else
//     //         $output . $this->displayConfirmation($this->l('The estimated delivery has been deleted'));
//     // }

//     return $helper->generateList($list, $fields_list);
// }


// public function deleteEstimatedDelivery()
// {
//     //return Db::getInstance()->execute('DELETE FROM '. _DB_PREFIX_ .'estimateddelivery WHERE `id_estimateddelivery` = '. (int)Tools::getValue('id_estimateddelivery'));
//     return 'ok';
// }

// public function renderView()
// {
//     $order = new Order(Tools::getValue('id_customer'));
//     if (!Validate::isLoadedObject($order)) {
//         $this->errors[] = $this->trans('The order cannot be found within your database.', array(), 'Admin.Orderscustomers.Notification');
//     }
//     return parent::renderView();
// }


// public function renderView()
// {
//     if (!($manufacturer = $this->loadObject())) {
//         return;
//     }
//     $this->toolbar_btn['new'] = array('href' => $this->context->link->getAdminLink('AdminManufacturers') . '&addaddress=1&id_manufacturer=' . (int) $manufacturer->id, 'desc' => $this->l('Add address'));
//     $this->toolbar_title = is_array($this->breadcrumbs) ? array_unique($this->breadcrumbs) : array($this->breadcrumbs);
//     $this->toolbar_title[] = $manufacturer->name;
//     $addresses = $manufacturer->getAddresses($this->context->language->id);
//     $products = $manufacturer->getProductsLite($this->context->language->id);
//     $total_product = count($products);
//     for ($i = 0; $i < $total_product; $i++) {
//         $products[$i] = new Product($products[$i]['id_product'], false, $this->context->language->id);
//         $products[$i]->loadStockData();
//         /* Build attributes combinations */
//         $combinations = $products[$i]->getAttributeCombinations($this->context->language->id);
//         foreach ($combinations as $k => $combination) {
//             $comb_array[$combination['id_product_attribute']]['reference'] = $combination['reference'];
//             $comb_array[$combination['id_product_attribute']]['ean13'] = $combination['ean13'];
//             $comb_array[$combination['id_product_attribute']]['upc'] = $combination['upc'];
//             $comb_array[$combination['id_product_attribute']]['quantity'] = $combination['quantity'];
//             $comb_array[$combination['id_product_attribute']]['attributes'][] = array($combination['group_name'], $combination['attribute_name'], $combination['id_attribute']);
//         }
//         if (isset($comb_array)) {
//             foreach ($comb_array as $key => $product_attribute) {
//                 $list = '';
//                 foreach ($product_attribute['attributes'] as $attribute) {
//                     $list .= $attribute[0] . ' - ' . $attribute[1] . ', ';
//                 }
//                 $comb_array[$key]['attributes'] = rtrim($list, ', ');
//             }
//             isset($comb_array) ? $products[$i]->combination = $comb_array : '';
//             unset($comb_array);
//         }
//     }
//     $this->tpl_view_vars = array('manufacturer' => $manufacturer, 'addresses' => $addresses, 'products' => $products, 'stock_management' => Configuration::get('PS_STOCK_MANAGEMENT'), 'shopContext' => Shop::getContext());
//     return parent::renderView();
// }



//     public function initContent()
//     {
//         $this->renderView();
//         return parent::initContent();
//     }

//     public function renderList()
//     {
//         // Adds an Edit button for each result
//         $this->addRowAction('edit');

//         // Adds a Delete button for each result
//         $this->addRowAction('delete');

//         return parent::renderList();
//     }


//     public function renderView()
//     {
//         // if (!($config = $this->loadObject())) {
//         //     return;
//         // }

//         //data = Config::getDataForm(Tools::getValue('id_config'));
//         // var_dump($data);

//         $this->addRowAction('edit');

//         // Adds a Delete button for each result
//         $this->addRowAction('delete');


//         $this->table = 'favorite_products';
//         $this->_select = 'a.*, c.*';
//         $this->_defaultOrderBy = 'a.id_customer'; // the table alias is always `a`
//         $this->_defaultOrderWay = 'ASC';
//         $this->orderBy = "a.id_customer";
//         $this->orderWay = "desc";
//         $this->meta_title = $this->l('Favorite Products');

//         //$this->identifier = 'id_customer';
//         $this->className = 'FavoriteProductsClass';
//         $this->_join = 'LEFT JOIN `' . _DB_PREFIX_ . 'customer` c ON a.`id_customer` = c.`id_customer`';
//         //$this->_join = 'LEFT JOIN `' . _DB_PREFIX_ . 'customer` c ON (c.id_customer=a.id_customer)';

//         $this->deleted = false;

//         $this->filter = 'id_customer';
//         $this->position_identifier = 'id_customer';
//         //$this->list_id = 'id_customer';

//         $this->_group = 'GROUP BY a.`id_customer`';
//         //$this->_where = ' AND a.`id_customer` = 3';
//         //$this->_where = 'AND id_customer != 0 ' . Shop::addSqlRestriction(Shop::SHARE_CUSTOMER);

//         $this->list_no_link = true;
//         $this->context = Context::getContext();
//         $this->allow_export = true;
//     }
// }




class AdminFavoriteProductsController extends ModuleAdminController
{
    protected $countries_array = array();
    protected $position_identifier = 'id_customer';

    public function __construct()
    {
        parent::__construct();
        $this->bootstrap = true;
        $this->required_database = true;
        //$this->display = 'view';
        $this->lang = false;

        $this->table = 'favorite_products';
        $this->_select = 'a.*, c.*';
        $this->_defaultOrderBy = 'a.id_customer'; // the table alias is always `a`
        $this->_defaultOrderWay = 'ASC';
        $this->orderBy = "a.id_customer";
        $this->orderWay = "desc";
        //$this->meta_title = $this->l('Favorite Products');

        $this->identifier = 'id_customer';
        $this->className = 'FavoriteProductsClass';
        //$this->className = 'Customer';

        $this->_join = 'LEFT JOIN `' . _DB_PREFIX_ . 'customer` c ON a.`id_customer` = c.`id_customer`';
        //$this->_join = 'LEFT JOIN `' . _DB_PREFIX_ . 'customer` c ON (c.id_customer=a.id_customer)';

        //$this->deleted = false;
        $this->filter = 'id_customer';
        $this->position_identifier = 'id_customer';
        //$this->list_id = 'id_customer';

        $this->_group = 'GROUP BY a.`id_customer`';
        //$this->_where = ' AND a.`id_customer` = 3';
        //$this->_where = 'AND id_customer != 0 ' . Shop::addSqlRestriction(Shop::SHARE_CUSTOMER);

        //$this->list_no_link = true; //link
        $this->context = Context::getContext();
        $this->allow_export = true;

        //$this->required_fields = array('company', 'address2', 'postcode', 'other', 'phone', 'phone_mobile', 'vat_number', 'dni');

        $this->lang = false;
        $this->addressType = 'customer';
        $this->explicitSelect = true;

        parent::__construct();


        // $this->actions = array('view');
        $this->addRowAction('view');
        //$this->addRowAction('edit');
        // $this->addRowAction('delete');
        // $this->addRowAction('information');


        // $this->bulk_actions = array(
        //'view' => array(
        //         //         'text' => $this->trans('Delete selected', array(), 'Admin.Notifications.Info'),
        //         //         'confirm' => $this->trans('Delete selected items?', array(), 'Admin.Notifications.Info'),
        //         //         'icon' => 'icon-trash',
        //         //     ),
        //     'delete' => array(
        //         'text' => $this->trans('Delete selected', array(), 'Admin.Notifications.Info'),
        //         'confirm' => $this->trans('Delete selected items?', array(), 'Admin.Notifications.Info'),
        //         'icon' => 'icon-trash',
        //     ),
        // );

        // $this->_select
        // $this->_join
        // $this->_where
        // $this->_group
        // $this->_having


        // if (!Tools::getValue('realedit')) {
        //     $this->deleted = true;
        // }

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
            //'id_customer' => array('title' => 'ID customer', 'width' => true, 'remove_onclick' => true),
            'firstname' => array('title' => 'First name',),
            'lastname' => array('title' => 'Last name', 'type' => 'text',),
            //'id_shop' => array('title' => 'ID shop', 'type' => 'number', 'remove_onclick' => true),
            //'date_add' => array('title' => 'Date', 'type' => 'datetime', 'remove_onclick' => true),
        ];


        // $this->_select = 'cl.`name` as country';
        // $this->_join = '
        // 	LEFT JOIN `' . _DB_PREFIX_ . 'country_lang` cl ON (cl.`id_country` = a.`id_country` AND cl.`id_lang` = ' . (int) $this->context->language->id . ')
        // 	LEFT JOIN `' . _DB_PREFIX_ . 'customer` c ON a.id_customer = c.id_customer
        // ';
        // $this->_where = 'AND a.id_customer != 0 ' . Shop::addSqlRestriction(Shop::SHARE_CUSTOMER, 'c');
        // $this->_use_found_rows = false;

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
        if ($id_customer) {
            $customer = new Customer((int) $id_customer);
        }


        // $db = Db::getInstance();
        // $id_shop = (int)Context::getContext()->shop->id;
        // $sql = new DbQuery();
        // $sql->from('favorite_products', 'c');
        // $sql->select('c.id_product');
        // $sql->innerJoin('product', 'p', 'c.id_product = p.id_product');
        // $sql->innerJoin('product_attribute', 'pa', 'p.id_product = pa.id_product');
        // $sql->innerJoin('product_attribute_image', 'pai', 'pa.id_product_attribute = pai.id_product_attribute');
        // $sql->innerJoin('tax', 't', 't.id_tax = p.id_tax_rules_group');
        // $sql->innerJoin('product_lang', 'l', 'c.id_product = l.id_product');
        // $sql->innerJoin('product_shop', 'ps', 'c.id_product = ps.id_product');
        // $sql->where('c.id_customer = ' . (int)$id_customer);
        // $sql->where('c.id_shop = ' . (int)$id_shop);
        // $sql->orderBy('c.id_product');
        // $sql->groupBy('c.id_product');
        // $products = $db->executeS($sql);


        // $db = Db::getInstance();
        // $id_shop = (int)Context::getContext()->shop->id;
        // $sql = new DbQuery();
        // $sql->select('id_product');
        // $sql->from('favorite_products', 'c');
        // $sql->where('c.id_customer = ' . (int)$id_customer);
        // $sql->where('c.id_shop = ' . (int)$id_shop);
        // $sql->innerJoin('customer', 'pa', 'c.id_customer = ' . (int)$id_customer);
        // //$sql->join('LEFT JOIN `' . _DB_PREFIX_ . 'customer` c ON a.`id_customer` = c.`id_customer`');
        // $sql->groupBy('c.id_product');
        // $products = $db->executeS($sql);

        $db = Db::getInstance();
        $mysql = 'SELECT p.id_product, p.active, pl.name, GROUP_CONCAT(DISTINCT(cl.name) SEPARATOR ",") as categories,GROUP_CONCAT(DISTINCT(im.id_image) SEPARATOR ",") as images, p.price, p.id_tax_rules_group, p.wholesale_price, p.reference, p.supplier_reference, p.id_supplier, p.id_manufacturer, p.upc, p.ecotax, p.weight, p.quantity, pl.description_short, pl.description, pl.meta_title, pl.meta_keywords, pl.meta_description,CONVERT(pl.meta_description USING utf8), pl.link_rewrite, pl.available_now, pl.available_later, p.available_for_order, p.date_add, p.show_price, p.online_only, p.condition, p.id_shop_default
        FROM ps_product p
        LEFT JOIN ps_favorite_products fp ON (p.id_product = fp.id_product)
        LEFT JOIN ps_product_lang pl ON (p.id_product = pl.id_product)
        LEFT JOIN ps_category_product cp ON (p.id_product = cp.id_product)
        LEFT JOIN ps_category_lang cl ON (cp.id_category = cl.id_category)
        LEFT JOIN ps_category c ON (cp.id_category = c.id_category)
        LEFT JOIN ps_product_tag pt ON (p.id_product = pt.id_product)
        LEFT JOIN ps_image im ON (im.id_product = p.id_product)
        WHERE pl.id_lang = 1
        AND fp.id_customer = ' . $id_customer . '
        AND cl.id_lang = 1
        AND p.id_shop_default = 1 AND c.id_shop_default = 1
        GROUP BY p.id_product';
        $products = $db->executeS($mysql);

        //var_dump($products);

        // $info = new Info();
        // $info->getInfo($products);
        // var_dump($info->getInfo($products));


        // $context = Context::getContext();
        // $info = new ProductTemplate($context, $products);
        // $info->getInfo($products);
        // var_dump($info->getInfo($products));


        $this->context->smarty->assign(
            array(
                'id_customer' => $id_customer,
                //'products' =>  $info->getInfo($products),
                'products' => $products,
            )
        );
        return $this->context->smarty->fetch(_PS_MODULE_DIR_ . "favoriteproducts/views/templates/admin/products.tpl");
    }


    // public function initToolbar()
    // {
    //     parent::initToolbar();

    //     if (!$this->display && $this->can_import) {
    //         $this->toolbar_btn['import'] = array(
    //             'href' => $this->context->link->getAdminLink('AdminImport', true, array(), array('import_type' => 'favorite_products')),
    //             'desc' => $this->trans('Import', array(), 'Admin.Actions'),
    //         );
    //     }
    // }


    // public function displayViewLink($token = null, $id_customer = null, $name = null)
    // {
    //     $this->context->smarty->assign(array(
    //         'id_customer' => $id_customer,
    //         'token' => $token,
    //     ));

    //     return $this->context->smarty->fetch(_PS_MODULE_DIR_ . 'favoriteproducts/views/templates/admin/adminFavoriteProductsControllerBtn.tpl');
    // }

    public function setMedia($isNewTheme = false)
    {
        parent::setMedia($isNewTheme);

        $this->addCSS(__PS_BASE_URI__ . 'modules/' . $this->module->name . '/views/css/admin/admin.css');
        $this->addJS(__PS_BASE_URI__ . 'modules/' . $this->module->name . '/views/js/admin/admin.js');
    }

    // //@ Delete prefix in $this->table
    // protected function getFromClause()
    // {
    //     return str_replace(_DB_PREFIX_, '', parent::getFromClause());
    // }
}



// class Info extends ProductListingFrontController
// {
//     public $products = [];

//     public function getInfo($products)
//     {
//         return $this->prepareMultipleProductsForTemplate($products);
//     }

//     public function getListingLabel()
//     {
//     }

//     protected function getProductSearchQuery()
//     {
//     }
//     protected function getDefaultProductSearchProvider()
//     {
//     }
// }



// class ProductInfo extends ProductController
// {
// }
// class MyProduct extends ProductController
// {
//     function catalogAction()
//     {
//     }
// }


// class ProductTemplate extends ProductAssembler
// {
//     public function getInfo($products)
//     {
//         return $this->addMissingProductFields($products);
//     }
// }
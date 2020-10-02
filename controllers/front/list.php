<?php

//require_once 'classes/controller/ProductListingFrontController.php';


class FavoriteProductsListModuleFrontController extends ModuleFrontController
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
        if (Context::getContext()->customer->logged && isset(int($_GET['id_customer']))) {

            $id_customer = $_GET['id_customer'];
            $db = Db::getInstance();
            //$id_customer = (int)$this->context->customer->id;
            $id_shop = (int)Context::getContext()->shop->id;
            $sql = new DbQuery();
            $sql->from('favorite_products', 'c');
            $sql->select('c.id_product');
            $sql->innerJoin('product', 'p', 'c.id_product = p.id_product');
            $sql->innerJoin('product_attribute', 'pa', 'p.id_product = pa.id_product');
            $sql->innerJoin('product_attribute_image', 'pai', 'pa.id_product_attribute = pai.id_product_attribute');
            $sql->innerJoin('tax', 't', 't.id_tax = p.id_tax_rules_group');
            $sql->innerJoin('product_lang', 'l', 'c.id_product = l.id_product');
            $sql->innerJoin('product_shop', 'ps', 'c.id_product = ps.id_product');
            $sql->where('c.id_customer = ' . (int)$id_customer);
            $sql->where('c.id_shop = ' . (int)$id_shop);
            $sql->orderBy('c.id_product');
            $sql->groupBy('c.id_product');


            $mysql = 'SELECT p.id_product, p.active, pl.name, GROUP_CONCAT(DISTINCT(cl.name) SEPARATOR ",") as categories,GROUP_CONCAT(DISTINCT(im.id_image) SEPARATOR ",") as images, p.price, p.id_tax_rules_group, p.wholesale_price, p.reference, p.supplier_reference, p.id_supplier, p.id_manufacturer, p.upc, p.ecotax, p.weight, p.quantity, pl.description_short, pl.description, pl.meta_title, pl.meta_keywords, pl.meta_description,CONVERT(pl.meta_description USING utf8), pl.link_rewrite, pl.available_now, pl.available_later, p.available_for_order, p.date_add, p.show_price, p.online_only, p.condition, p.id_shop_default
            FROM ps_product p
            LEFT JOIN ps_product_lang pl ON (p.id_product = pl.id_product)
            LEFT JOIN ps_category_product cp ON (p.id_product = cp.id_product)
            LEFT JOIN ps_category_lang cl ON (cp.id_category = cl.id_category)
            LEFT JOIN ps_category c ON (cp.id_category = c.id_category)
            LEFT JOIN ps_product_tag pt ON (p.id_product = pt.id_product)
            LEFT JOIN ps_image im ON (im.id_product = p.id_product)
            WHERE pl.id_lang = 1
            AND cl.id_lang = 1
            AND p.id_shop_default = 1 AND c.id_shop_default = 1
            GROUP BY p.id_product';

            $all = $db->executeS($mysql);
            var_dump($all);

            $favoriteproducts = $db->executeS($sql);
            $favoriteproducts = $mysql;



            var_dump($favoriteproducts);





            // $enter_id_product = Configuration::get('PRODS');
            // $enter_id_product = 1;
            // $array_id_product = explode(",", $enter_id_product);

            // if (!preg_match('/^[0-9]+(,[0-9]+)*$/', $enter_id_product))
            //     return false;

            // foreach ($array_id_product as $key => $arr) {
            //     $result[$key]['id_product'] = $arr;
            // }

            // foreach ($result as $product) {
            //     $product = (new ProductAssembler($this->context))
            //         ->assembleProduct($product);
            //     $presenterFactory = new ProductPresenterFactory($this->context);
            //     $presentationSettings = $presenterFactory->getPresentationSettings();
            //     $presenter = new ProductListingPresenter(
            //         new ImageRetriever(
            //             $this->context->link
            //         ),
            //         $this->context->link,
            //         new PriceFormatter(),
            //         new ProductColorsRetriever(),
            //         $this->context->getTranslator()
            //     );
            //     $template_products[] = $presenter->present(
            //         $presentationSettings,
            //         $product,
            //         $this->context->language
            //     );
            // }

            // $this->context->smarty->assign(array(
            //     'products' => $template_products
            // ));

            // return $this->display(__FILE__, 'mymodule.tpl');



            // $myProducts = $favoriteproducts;

            // foreach( $myProducts as $id_product ) {
            //     $myProducts[] = new Product($id_product);
            // }

            // var_dump($myProducts);


            // $id_product = 10;
            // // Language id
            // $lang_id = (int) Configuration::get('PS_LANG_DEFAULT');
            // // Load product object
            //$product = new Product($id_product, false, $lang_id);
            // // Validate product object
            // if (Validate::isLoadedObject($product)) {

            //     // Get product Quanity
            //     echo $product->quantity;
            //     // Get product minimum quantity
            //     echo $product->minimal_quantity;

            //     // Get product low stock threshold
            //     echo $product->low_stock_threshold;

            //     // Get product low stock alert
            //     echo $product->low_stock_alert;

            //     $link = new Link;
            //     //$id_image = $val['id_image'];
            //     //echo $link->getImageLink($product->link_rewrite[Context::getContext()->language->id], $id_image, 'home_default');
            //     var_dump($id_image = Image::getCover($id_product));

            //     echo $id_image['id_image'];
            // }


            $contextObject = $this->context; // or this // $contextObject = Context::getContext();
            $this->context->smarty->assign(array(
                'id' => (int)$contextObject->customer->id,
                'first_name' => $contextObject->customer->firstname,
                'last_name' => $contextObject->customer->lastname,
                'email' => $contextObject->customer->email,
                'favoriteproducts' => $favoriteproducts,
            ));

            //return false;
            return $this->setTemplate("module:favoriteproducts/views/templates/front/favoriteproducts-list.tpl");
        } elseif (Context::getContext()->customer->logged) {

            $db = Db::getInstance();
            $id_customer = (int)$this->context->customer->id;
            $id_shop = (int)Context::getContext()->shop->id;
            $sql = new DbQuery();
            $sql->select('*');
            $sql->from('favorite_products', 'c');
            $sql->innerJoin('product', 'p', 'c.id_product = p.id_product');
            $sql->innerJoin('product_attribute', 'pa', 'p.id_product = pa.id_product');
            $sql->innerJoin('product_attribute_image', 'pai', 'pa.id_product_attribute = pai.id_product_attribute');
            $sql->innerJoin('tax', 't', 't.id_tax = p.id_tax_rules_group');
            $sql->innerJoin('product_lang', 'l', 'c.id_product = l.id_product');
            $sql->innerJoin('product_shop', 'ps', 'c.id_product = ps.id_product');
            $sql->where('c.id_customer = ' . (int)$id_customer);
            $sql->where('c.id_shop = ' . (int)$id_shop);
            $sql->orderBy('c.id_product');
            $sql->groupBy('c.id_product');

            // $sql->select('id_currency');
            // $sql->from('currency_lang', 'cl1');
            // $sql->innerJoin('currency_lang', 'cl', 'cl.id_currency =' . $id_lang);


            $favoriteproducts = $db->executeS($sql);

            $all = ProductListingFrontController::prepareMultipleProductsForTemplate($id_product, false, $lang_id);

            var_dump($all);

            foreach ($favoriteproducts as $product) {
                $product = new prepareMultipleProductsForTemplate($id_product, false, $lang_id);
            }


            // Your product id
            $id_product = 10;

            // Language id
            $lang_id = (int) Configuration::get('PS_LANG_DEFAULT');

            // Load product object
            $product = new Product($id_product, false, $lang_id);

            // Validate product object
            if (Validate::isLoadedObject($product)) {

                // Get product Quanity
                echo $product->quantity;

                // Get product minimum quantity
                echo $product->minimal_quantity;

                // Get product low stock threshold
                echo $product->low_stock_threshold;

                // Get product low stock alert
                echo $product->low_stock_alert;

                $link = new Link;
                //$id_image = $val['id_image'];
                //echo $link->getImageLink($product->link_rewrite[Context::getContext()->language->id], $id_image, 'home_default');
                var_dump($id_image = Image::getCover($id_product));

                echo $id_image['id_image'];

                $productLink = $link->getProductLink($id_product);
                $productImg = $link->getImageLink($product->link_rewrite, $id_image, 'home_default');


                // echo '<a href="' . $link->getProductLink($id_product) . '" class="thumbnail product-thumbnail"><img src="' . $link->getImageLink($product->link_rewrite, $id_image, 'home_default') . '" alt=""></a>';

                // Print Product Object
                // echo "<pre>";
                // print_r($product);
                // echo "</pre>";
            }

            // $id_product = 1; //set your product ID here
            // $image = Image::getCover($id_product);
            // $product = new Product($id_product, false, Context::getContext()->language->id);
            // $link = new Link; //because getImageLInk is not static function
            // $imagePath = $link->getImageLink($product->link_rewrite, $image['id_image'], 'home_default');
            // echo $imagePath;

            $contextObject = $this->context; // or this // $contextObject = Context::getContext();
            $this->context->smarty->assign(array(
                'id' => (int)$contextObject->customer->id,
                'first_name' => $contextObject->customer->firstname,
                'last_name' => $contextObject->customer->lastname,
                'email' => $contextObject->customer->email,
                'favoriteproducts' => $favoriteproducts,
            ));
            return $this->setTemplate("module:favoriteproducts/views/templates/front/favoriteproducts-list.tpl");
        } else {
            $this->context->smarty->assign(array(
                'error' => 'ERROR you need to register',
            ));
            return $this->setTemplate("module:favoriteproducts/views/templates/front/show-info.tpl");
        }
    }
}


// public function createProductsObject($productID, $productName, $price, $weight, $category, $description, $link_rewrite, $singleStock, $getCategoryID, $getImages, $attrs) {
//     $product = new Product;
//     $product->name = $productName;
//     $product->ean13 = '';
//     $product->reference = '';
//     $product->id_category_default = $getCategoryID;
//     $product->category = $getCategoryID;
//     $product->indexed = 1;
//     $product->description = $description;
//     $product->condition = 'new';
//     $product->redirect_type = '404';
//     $product->visibility = 'both';
//     $product->id_supplier = 1;
//     $product->link_rewrite = $link_rewrite;
//     $product->quantity = $singleStock;
//     $product->price = round($price - (18.69 / 100) * $price, 2);
//     $product->active = 1;
//     $product->psoft_hurtobergamo_id = $productID;
//     $product->add();


//     $product->addToCategories($getCategoryID);

//     $shops = 1;
//     $count = 0;


//     foreach ($getImages->children() AS $image) {
//         $url = $image->attributes()->url->__toString();

//         $id_product = $product->id;
//         $image = new Image();
//         $image->id_product = $id_product;
//         $image->position = Image::getHighestPosition($id_product) + 1;

//         if ($count == 0) {
//             $image->cover = true;
//             $count = 1;
//         } else {
//             $image->cover = false;
//         }

//         if (($image->validateFields(false, true)) === true &&
//                 ($image->validateFieldsLang(false, true)) === true && $image->add()) {
//             if (Configuration::get('PSOFT_HURTO_BERGAMO_THUMB') == '0') {
//                 $productThumb = false;
//             } else {
//                 $productThumb = true;
//             }
//             $image->associateTo($shops);
//             if (!self::copyImg($id_product, $image->id, $url, 'products', $productThumb)) {
//                 $image->delete();
//             }
//         }
//     }


// protected static function copyImg($id_entity, $id_image = null, $url, $entity = 'products', $regenerate = false) {
//     $tmpfile = tempnam(_PS_TMP_IMG_DIR_, 'ps_import');
//     $watermark_types = explode(',', Configuration::get('WATERMARK_TYPES'));

//     switch ($entity) {
//         default:
//         case 'products':
//             $image_obj = new Image($id_image);
//             $path = $image_obj->getPathForCreation();
//             break;
//     }

//     $url = urldecode(trim($url));
//     $parced_url = parse_url($url);

//     if (isset($parced_url['path'])) {
//         $uri = ltrim($parced_url['path'], '/');
//         $parts = explode('/', $uri);
//         foreach ($parts as &$part) {
//             $part = rawurlencode($part);
//         }
//         unset($part);
//         $parced_url['path'] = '/' . implode('/', $parts);
//     }

//     if (isset($parced_url['query'])) {
//         $query_parts = array();
//         parse_str($parced_url['query'], $query_parts);
//         $parced_url['query'] = http_build_query($query_parts);
//     }

//     if (!function_exists('http_build_url')) {
//         require_once(_PS_TOOL_DIR_ . 'http_build_url/http_build_url.php');
//     }

//     $url = http_build_url('', $parced_url);

//     $orig_tmpfile = $tmpfile;

//     if (Tools::copy($url, $tmpfile)) {
// // Evaluate the memory required to resize the image: if it's too much, you can't resize it.
//         if (!ImageManager::checkImageMemoryLimit($tmpfile)) {
//             @unlink($tmpfile);
//             return false;
//         }

//         $tgt_width = $tgt_height = 0;
//         $src_width = $src_height = 0;
//         $error = 0;
//         ImageManager::resize($tmpfile, $path . '.jpg', null, null, 'jpg', false, $error, $tgt_width, $tgt_height, 5, $src_width, $src_height);
//         $images_types = ImageType::getImagesTypes($entity, true);

//         if ($regenerate) {
//             $previous_path = null;
//             $path_infos = array();
//             $path_infos[] = array($tgt_width, $tgt_height, $path . '.jpg');
//             foreach ($images_types as $image_type) {
//                 $tmpfile = self::get_best_path($image_type['width'], $image_type['height'], $path_infos);

//                 if (ImageManager::resize($tmpfile, $path . '-' . stripslashes($image_type['name']) . '.jpg', $image_type['width'], $image_type['height'], 'jpg', false, $error, $tgt_width, $tgt_height, 5, $src_width, $src_height)) {
// // the last image should not be added in the candidate list if it's bigger than the original image
//                     if ($tgt_width <= $src_width && $tgt_height <= $src_height) {
//                         $path_infos[] = array($tgt_width, $tgt_height, $path . '-' . stripslashes($image_type['name']) . '.jpg');
//                     }
//                     if ($entity == 'products') {
//                         if (is_file(_PS_TMP_IMG_DIR_ . 'product_mini_' . (int) $id_entity . '.jpg')) {
//                             unlink(_PS_TMP_IMG_DIR_ . 'product_mini_' . (int) $id_entity . '.jpg');
//                         }
//                         if (is_file(_PS_TMP_IMG_DIR_ . 'product_mini_' . (int) $id_entity . '_' . (int) Context::getContext()->shop->id . '.jpg')) {
//                             unlink(_PS_TMP_IMG_DIR_ . 'product_mini_' . (int) $id_entity . '_' . (int) Context::getContext()->shop->id . '.jpg');
//                         }
//                     }
//                 }
//                 if (in_array($image_type['id_image_type'], $watermark_types)) {
//                     Hook::exec('actionWatermark', array('id_image' => $id_image, 'id_product' => $id_entity));
//                 }
//             }
//         }
//     } else {
//         @unlink($orig_tmpfile);
//         return false;
//     }
//     unlink($orig_tmpfile);
//     return true;
// }

// protected static function get_best_path($tgt_width, $tgt_height, $path_infos) {
//     $path_infos = array_reverse($path_infos);
//     $path = '';
//     foreach ($path_infos as $path_info) {
//         list($width, $height, $path) = $path_info;
//         if ($width >= $tgt_width && $height >= $tgt_height) {
//             return $path;
//         }
//     }
//     return $path;
// }


// $product->link_rewrite = $link_rewrite[(int)Context::getContext()->language->id];



class GetProductData extends ProductListingFrontController
{
    private $num;
    private $arr = [];
    private $foo;
    //private $products = [];

    // public function __construct($products, $foo)
    public function __construct($num = [5], $foo = null)
    {
        $this->num = $num;
        $this->foo = $foo;
        // for ($i = 0; $i < $this->num; $i++) {
        //     $this->arr[] = rand(0,100);
        // }
    }

    public function init()
    {
        $id_category = (int) Tools::getValue('id_category');
        $this->category = new Product(
            $id_category,
            $this->context->language->id
        );

        if (!Validate::isLoadedObject($this->category) || !$this->category->active) {
            Tools::redirect('index.php?controller=404');
        }

        parent::init();

        // if (!$this->category->checkAccess($this->context->customer->id)) {
        //     header('HTTP/1.1 403 Forbidden');
        //     header('Status: 403 Forbidden');
        //     $this->errors[] = $this->trans('You do not have access to this category.', array(), 'Shop.Notifications.Error');
        //     $this->setTemplate('errors/forbidden');

        //     return;
        // }

        $categoryVar = $this->getTemplateVarCategory();

        $filteredCategory = Hook::exec(
            'filterCategoryContent',
            array('object' => $categoryVar),
            $id_module = null,
            $array_return = false,
            $check_exceptions = true,
            $use_push = false,
            $id_shop = null,
            $chain = true
        );
        if (!empty($filteredCategory['object'])) {
            $categoryVar = $filteredCategory['object'];
        }

        $this->context->smarty->assign(array(
            'category' => $categoryVar,
            'subcategories' => $this->getTemplateVarSubCategories(),
        ));
    }
    public function initContent()
    {
        parent::initContent();

        if ($this->category->checkAccess($this->context->customer->id)) {
            $this->doProductSearch(
                'catalog/listing/category',
                [
                    'entity' => 'category',
                    'id' => $this->category->id,
                ]
            );
        }
    }





    public function getArray($desc = true)
    {
        for ($j = 0; $j < $this->num; $j++) {
            for ($i = $j + 1; $i < $this->num; $i++) {
                if ($desc) {
                    if ($this->arr[$i] > $this->arr[$j]) {
                        list($this->arr[$i], $this->arr[$j]) = [$this->arr[$j], $this->arr[$i]];
                    }
                } else {
                    if ($this->arr[$i] < $this->arr[$j]) {
                        list($this->arr[$i], $this->arr[$j]) = [$this->arr[$j], $this->arr[$i]];
                    }
                }
            }
        }
        return $this->arr;
    }



    public function info(GetProductData $products)
    {
        // Мы можем изменить закрытое свойство:
        $products->foo = 'Hello ';
        var_dump($products->foo);

        // Мы также можем вызвать закрытый метод:
        //$other->prepareMultipleProductsForTemplate($num = [1, 2, 3]);
        // $this->prepareProductForTemplate($this->arr);
        $this->prepareMultipleProductsForTemplate($this->arr);
    }



    /** string Internal controller name */
    public $php_self = 'category';

    /** @var bool If set to false, customer cannot view the current category. */
    public $customer_access = true;

    /**
     * @var Category
     */
    protected $category;




    protected function getAjaxProductSearchVariables()
    {
        $data = parent::getAjaxProductSearchVariables();
        $rendered_products_header = $this->render('catalog/_partials/category-header', array('listing' => $data));
        $data['rendered_products_header'] = $rendered_products_header;

        return $data;
    }



    public function getListingLabel()
    {
    }

    public function getProductSearchQuery()
    {
    }
    public function getDefaultProductSearchProvider()
    {
    }


    // protected function getProductSearchQuery()
    // {
    //     $query = new ProductSearchQuery();
    //     $query
    //         ->setIdCategory($this->category->id)
    //         ->setSortOrder(new SortOrder('product', Tools::getProductsOrder('by'), Tools::getProductsOrder('way')));

    //     return $query;
    // }
    // protected function getDefaultProductSearchProvider()
    // {
    //     return new CategoryProductSearchProvider(
    //         $this->getTranslator(),
    //         $this->category
    //     );
    // }
    // public function getListingLabel()
    // {
    //     if (!Validate::isLoadedObject($this->category)) {
    //         $this->category = new Category(
    //             (int) Tools::getValue('id_category'),
    //             $this->context->language->id
    //         );
    //     }

    //     return $this->trans(
    //         'Category: %category_name%',
    //         array('%category_name%' => $this->category->name),
    //         'Shop.Theme.Catalog'
    //     );
    // }





    // private function prepareProductForTemplate(array $rawProduct)
    // {
    //     $product = (new ProductAssembler($this->context))->assembleProduct($rawProduct);

    //     $presenter = $this->getProductPresenter();
    //     $settings = $this->getProductPresentationSettings();
    //     $productOut = $presenter->present($settings, $product, $this->context->language);

    //     // Force delete this value from the ProductListingLazyArray > ProductLazyArray. Cya! 
    //     $productOut->offsetUnset('main_variants', true);
    //     // Regenerate (performance hit).
    //     $mainVs = $productOut->getMainVariants();

    //     // This time we can play around with the 'main_variants' var however we like
    //     foreach ($mainVs as &$varient) {
    //         $imgs = Image::getImages($this->context->language->id, $varient['id_product'], $varient['id_product_attribute']);
    //         $varient['image_url'] = '';
    //         if (count($imgs) > 0) {
    //             $varient['image_url'] = $this->context->link->getImageLink($productOut['link_rewrite'], $product['id_product'] . '-' . $imgs[0]['id_image'], 'home_default');
    //         }
    //     }

    //     // Put it back (using their method, because why not).
    //     $productOut->__set('main_variants', $mainVs);

    //     return $productOut;
    // }




    // public function getFrontendProductInformation($allSelectedProductIds, $languageId)
    // {
    //     // set default category Home
    //     $category = new Category((int)2);

    //     // create new product search proider
    //     $searchProvider = new CategoryProductSearchProvider(
    //         $this->context->getTranslator(),
    //         $category
    //     );

    //     // set actual context
    //     $context = new ProductSearchContext($this->context);

    //     // create new search query
    //     $query = new ProductSearchQuery();
    //     $query->setResultsPerPage(PHP_INT_MAX)->setPage(1);
    //     $query->setSortOrder(new SortOrder('product', 'position', 'asc'));

    //     $result = $searchProvider->runQuery(
    //         $context,
    //         $query
    //     );

    //     // Product handling - to get relevant data
    //     $assembler = new ProductAssembler($this->context);
    //     $presenterFactory = new ProductPresenterFactory($this->context);
    //     $presentationSettings = $presenterFactory->getPresentationSettings();
    //     $presenter = new ProductListingPresenter(
    //         new ImageRetriever(
    //             $this->context->link
    //         ),
    //         $this->context->link,
    //         new PriceFormatter(),
    //         new ProductColorsRetriever(),
    //         $this->context->getTranslator()
    //     );

    //     $products = array();
    //     foreach ($result->getProducts() as $rawProduct) {
    //         $productId = $rawProduct['id_product'];
    //         if (in_array($productId, $allSelectedProductIds)) {
    //             $product = $presenter->present(
    //                 $presentationSettings,
    //                 $assembler->assembleProduct($rawProduct),
    //                 $this->context->language
    //             );
    //             array_push($products, $product);
    //         }
    //     }

    //     return $products;
    // }





    //work
    // $products = array($favoriteproducts);

    // foreach ($products as $p) {
    //     var_dump($p);

    //     $products[$p['id_product']] = new Product($p['id_product'], false, '1');
    // }
}


$products = [1, 2, 3];
//echo 'number: ' . $products . "\n";

$arr = new GetProductData($products);

var_dump($arr);
print "<br><br>\n";
print 'Max number: ';
//print_r($arr->getArray());
//print_r($arr->prepareMultipleProductsForTemplate());
print_r($arr->info(new GetProductData()));


//var_dump($arr->baz(new GetProductData($product)));

$getProductInfo = new GetProductData($products);


//$getProductInfo->prepareProductForTemplate($rawproducts);
//$getProductInfo->prepareMultipleProductsForTemplate();
//var_dump($getProductInfo->prepareMultipleProductsForTemplate());
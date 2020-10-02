<?php

// class CartController extends CartControllerCore
// {
//     public $php_self = 'cart';

//     public function init()
//     {
//         parent::init();
//         $this->qty = abs(Tools::getValue('qty', 1));
//         var_dump(1);

//         if ($this->qty >= 2) {
//             #How can i show notification?
//         }
//     }
// }


class FavoriteProductsAjax_FavoriteProducts_Buy_FavoritesModuleFrontController extends ModuleFrontController
{
    public function initContent()
    {




        /* Data */
        $id_product = (int)Tools::getValue('id_product');
        $id_products = (array)$_GET['check'];


        $id_customization = (int)Tools::getValue('id_customization'); // = 0
        $price_product = (int)Tools::getValue('priceform');

        /* Create the cart */
        if (!$this->context->cart->id) {

            /* Detect the user logged */
            if ($this->context->cookie->id_guest) {
                $guest = new Guest($this->context->cookie->id_guest);
                $this->context->cart->mobile_theme = $guest->mobile_theme;
            }
            $this->context->cart->add();

            /* Create the cookie */
            if ($this->context->cart->id) {
                $this->context->cookie->id_cart = (int)$this->context->cart->id;
            }
        }

        /* Select the cart */
        $cart = $this->context->cart;

        /* Select the product */
        //$product = new Product($id_product, true, (int)($this->context->cookie->id_lang));
        $id_product_attribute = Product::getDefaultAttribute($id_product);

        /* Add to cart */
        $cart->updateQty(1, $id_product, $id_product_attribute, $id_customization);







        //     if (Context::getContext()->customer->logged && isset($_GET['check'])) {
        //         //if (Context::getContext()->customer->logged) {

        //         $db = Db::getInstance();
        //         $id_customer = (int)$this->context->customer->id;
        //         $id_products = (array)$_GET['check'];

        //         var_dump($id_products);

        //         $id_shop = (int)Context::getContext()->shop->id;

        //         $sql = new DbQuery();
        //         $sql->select('*');
        //         $sql->from('favorite_products', 'c');
        //         $sql->where('id_customer = ' . (int)$id_customer);
        //         //$sql->where('id_product = ' . (int)$id_product);
        //         $sql->where('id_shop = ' . (int)$id_shop);








        //         // $sql = 'SELECT * FROM `' . _DB_PREFIX_ . 'favorite_products` WHERE `id_customer` = :id_customer AND `id_product` = :id_product';
        //         // $db->execute($sql);
        //         //var_dump($db->executeS($sql));

        //         if ($db->executeS($sql)) {

        //             //delete
        //             // foreach ($id_products as $id_product) {
        //             //     $sql = 'DELETE FROM `' . _DB_PREFIX_ . 'favorite_products` WHERE `id_customer`= ' . (int)$id_customer . ' AND `id_product` = ' . (int)$id_product;
        //             //     $db->execute($sql);
        //             //     $this->context->smarty->assign(array(
        //             //         'result' => 'All product delete where customer id=' . (int)$id_customer . ' ' . $id_product,
        //             //     ));
        //             // }



        //             // $cart = $params['cart'];
        //             // $cart = new Cart($id_cart);

        //             foreach ($id_products as $id_product) {
        //                 var_dump($id_product);
        //                 echo 777;

        //                 $id_product = (int)Tools::getValue('id_product');
        //                 //$this->CartController::processChangeProductInCart($id_product);



        //                 $context = Context::getContext();
        //                 $id_cart = $context->cookie->__get('id_cart');
        //                 $cart = new Cart($id_cart);
        //                 $cart->id_currency = $context->cookie->id_currency;
        //                 $cart->id_carrier = 1;
        //                 $cart->recyclable = 0;
        //                 $cart->gift = 0;
        //                 $cart->id_customer = 92;
        //                 $cart->id_lang = $context->cookie->id_lang;
        //                 $cart->add();

        //                 $quantity = (int)Tools::getValue('ordered_qty');

        //                 $cart->updateQty(1, $id_product, null, false, 'down');
        //                 //$cart->updateQty($quantity, $id_product, null, false);


        //                 //глянь метод: CartController::processChangeProductInCart() .
        //             }






        //             // $db->execute($sql);

        //             // echo 'DELETE FROM `ps_favorite_products` WHERE `id_product`= ' . $id_product . ' AND `id_customer`= ' . $id_customer . ' LIMIT 1<br>';

        //             $this->context->smarty->assign(array(
        //                 'result' => 'All product delete where customer id=' . (int)$id_customer . $id_product,
        //             ));
        //         } else {
        //             $this->context->smarty->assign(array(
        //                 'error' => 'ERROR',
        //                 'result' => 'ERROR',
        //             ));
        //         }
        //     } else {
        //         $this->context->smarty->assign(array(
        //             'error' => 'ERROR you need to register or not isset POST',
        //             'result' => 'ERROR you need to register or not isset POST',
        //         ));
        //     }
        //     parent::initContent();
        //     return $this->setTemplate("module:favoriteproducts/views/templates/front/show-info.tpl");
        // }


        //     public $id_products;


        //     public function __construct($id_products)
        //     {
        //         $this->id_products = $id_products; //присвоили переданный id экземпляру класса
        //         //$this->url = 'http://site.ru/str.php?id=' . $this->id;
        //         //$this->get = self::_setGet($this->url);
        //     }

        //     public function hookActionCartSave($params, $id_products)
        //     {
        //         $cart = $params['cart'];
        //         $id_products = (array)$_GET['check'];

        //         foreach ($id_products as $id_product) {
        //             $id_product = (int)Tools::getValue('id_product');
        //             $quantity = (int)Tools::getValue('ordered_qty');
        //             $cart->updateQty($quantity, $id_product, null, false);
        //             $cart->add($quantity, $id_product, null, false);
        //         }

        //         // foreach ($id_products as $prod)
        //         //     if ($prod['id_product'] != $last['id_product'])
        //         //         $cart->deleteProduct($prod['id_product']);

        //         parent::initContent();
        //         return $this->setTemplate("module:favoriteproducts/views/templates/front/show-info.tpl");
        //     }

        //     public function initContent()
        //     {
        //         parent::initContent();
        //         return $this->setTemplate("module:favoriteproducts/views/templates/front/show-info.tpl");
        //     }



        //     // public function initContent()
        //     // {
        //     //     //if (Context::getContext()->customer->logged && isset($_POST['check'])) {
        //     //     if (Context::getContext()->customer->logged && isset($_GET['check'])) {

        //     //         // $db = Db::getInstance();


        //     //         // $context = Context::getContext();

        //     //         // $message = '';
        //     //         // $id_cart = (int)$context->cookie->id_cart;
        //     //         // $id_customer = (int)$this->context->customer->id;
        //     //         // // $id_products = (array)$_POST['check'];
        //     //         // $id_products = (array)$_GET['check'];

        //     //         // //var_dump($id_products);

        //     //         // if (Tools::isSubmit('submitAddProduct')) {

        //     //         //     $cart = new Cart($id_cart);

        //     //         //     // foreach ($id_products as $id_product) {
        //     //         //     //     $id_product = (int)Tools::getValue('id_product');
        //     //         //     //     $quantity = (int)Tools::getValue('ordered_qty');
        //     //         //     //     $cart->updateQty($quantity, $id_product, null, false);
        //     //         //     // }
        //     //         // }
        //     //         // $message = 'Product Added Successfully';

        //     //         // $this->context->smarty->assign(array(
        //     //         //     'message' => 'Product Added Successfully',
        //     //         // ));

        //     //         // header('Location: /cart?action=show');
        //     //         // Tools::redirect('/cart?action=show');
        //     //     } else {
        //     //         $this->context->smarty->assign(array(
        //     //             'error' => 'ERROR you need to register or not isset POST',
        //     //         ));
        //     //     }
        //     //     parent::initContent();
        //     //     return $this->setTemplate("module:favoriteproducts/views/templates/front/show-info.tpl");
        //     // }



        //     // public function addToCart()
        //     // {

        //     //     if (Context::getContext()->customer->logged && isset($_POST['check'])) {

        //     //         $context = Context::getContext();
        //     //         $message = '';
        //     //         $id_cart = (int)$context->cookie->id_cart;

        //     //         if (Tools::isSubmit('submitAddProduct')) {

        //     //             $cart = new Cart($id_cart);
        //     //             $id_product = (int)Tools::getValue('id_product');
        //     //             $quantity = (int)Tools::getValue('ordered_qty');

        //     //             $cart->updateQty($quantity, $id_product, null, false);
        //     //             $message = 'Product Added Successfully';
        //     //         }

        //     //         return $message;
        //     //     } else {
        //     //         $this->context->smarty->assign(array(
        //     //             'error' => 'ERROR you need to register or not isset POST',
        //     //         ));
        //     //     }
        //     //     // parent::initContent();
        //     //     // return $this->setTemplate("module:favoriteproducts/views/templates/front/show-info.tpl");
    }
}
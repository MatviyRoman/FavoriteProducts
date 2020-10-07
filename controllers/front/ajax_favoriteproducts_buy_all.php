<?php

class FavoriteProductsAjax_FavoriteProducts_Buy_AllModuleFrontController extends ModuleFrontController
{
    public function initContent()
    {
        //if (Context::getContext()->customer->logged) {
        if (Context::getContext()->customer->logged && isset($_POST['check'])) {

            // $db = Db::getInstance();
            // $id_customer = (int)$this->context->customer->id;
            // $id_shop = (int)Context::getContext()->shop->id;
            // $sql = new DbQuery();
            // $sql->select('id_product');
            // $sql->from('favorite_products', 'c');
            // $sql->where('id_customer = ' . (int)$id_customer);
            // $sql->where('id_shop = ' . (int)$id_shop);
            // // $sql = 'SELECT * FROM `' . _DB_PREFIX_ . 'favorite_products` WHERE `id_customer` = :id_customer AND `id_product` = :id_product';
            // //$id_products = (implode(',', $db->executeS($sql)));
            // $id_products = $db->executeS($sql);
            // var_dump($id_products);

            // foreach ($id_products as $key => $value) {
            //     // $id_products = (implode(',', $value));
            //     // var_dump($id_products);
            //     $id_products = $value;
            //     var_dump($value);
            // }


            $id_products = (explode(',', $_POST['check']));
            $context = Context::getContext();
            var_dump($id_products);

            $id_customer = (int)$this->context->customer->id;

            foreach ($id_products as $id_product) {
                var_dump($id_product);
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
            }

            // $this->context->smarty->assign(array(
            //     //'result' => 'All product add to cart where customer id=' . (int)$id_customer . ' products id=' . implode(",", $id_products),
            //     'result' => false,
            //     'error' => false,
            //     'cart' => true,
            // ));

            Tools::redirect(_PS_ROOT_DIR_ . '/cart?action=show');
        } else {
            $this->context->smarty->assign(array(
                'result' => false,
                'error' => 'ERROR you need to register or not isset POST',
            ));
            parent::initContent();
            return $this->setTemplate("module:favoriteproducts/views/templates/front/show-info.tpl");
        }
    }
}
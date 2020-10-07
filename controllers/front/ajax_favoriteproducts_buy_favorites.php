<?php

class FavoriteProductsAjax_FavoriteProducts_Buy_FavoritesModuleFrontController extends ModuleFrontController
{
    public function initContent()
    {
        // if (Context::getContext()->customer->logged && isset($_GET['check'])) {
        //     $id_products = (explode(',', $_GET['check']));

        if (Context::getContext()->customer->logged && isset($_POST['check'])) {
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
            //Tools::redirect(_PS_ROOT_DIR_ . $urls . pages . cart);
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

//CartController::processChangeProductInCart()

// class AddToCart extends CartController
// {
// }
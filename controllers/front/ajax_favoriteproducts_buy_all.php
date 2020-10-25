<?php

class FavoriteProductsAjax_FavoriteProducts_Buy_AllModuleFrontController extends ModuleFrontController
{
    public function initContent()
    {
        if (Context::getContext()->customer->logged && isset($_POST['check'])) {

            $id_products = (explode(',', $_POST['check']));

            foreach ($id_products as $id_product) {
                var_dump($id_product);
                $id_customization = (int)Tools::getValue('id_customization');

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
                $id_product_attribute = Product::getDefaultAttribute($id_product);

                /* Add to cart */
                $cart->updateQty(1, $id_product, $id_product_attribute, $id_customization);
            }

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
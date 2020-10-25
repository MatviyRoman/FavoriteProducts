<?php

class FavoriteProductsAjax_FavoriteProducts_Del_FavoritesModuleFrontController extends ModuleFrontController
{
    public function initContent()
    {
        if (Context::getContext()->customer->logged && isset($_POST['check'])) {
            $db = Db::getInstance();
            $id_customer = (int)$this->context->customer->id;
            $id_products = (array)$_POST['check'];
            $id_shop = (int)Context::getContext()->shop->id;
            $sql = new DbQuery();
            $sql->select('*');
            $sql->from('favorite_products', 'c');
            $sql->where('id_customer = ' . (int)$id_customer);
            $sql->where('id_shop = ' . (int)$id_shop);

            if ($db->executeS($sql)) {
                foreach ($id_products as $id_product) {
                    $sql = 'DELETE FROM `' . _DB_PREFIX_ . 'favorite_products` WHERE `id_customer`= ' . (int)$id_customer . ' AND `id_product` = ' . (int)$id_product;
                    $db->execute($sql);
                    $this->context->smarty->assign(array(
                        'result' => 'All product delete where customer id=' . (int)$id_customer . ' ' . $id_product,
                    ));
                }
            } else {
                $this->context->smarty->assign(array(
                    'error' => 'ERROR',
                ));
            }
        } else {
            $this->context->smarty->assign(array(
                'error' => 'ERROR you need to register or not isset POST',
            ));
        }
        parent::initContent();
        return $this->setTemplate("module:favoriteproducts/views/templates/front/show-info.tpl");
    }
}
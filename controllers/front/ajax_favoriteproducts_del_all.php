<?php

class FavoriteProductsAjax_FavoriteProducts_Del_AllModuleFrontController extends ModuleFrontController
{
    public function initContent()
    {
        if (Context::getContext()->customer->logged) {

            $db = Db::getInstance();
            $id_customer = (int)$this->context->customer->id;
            $id_shop = (int)Context::getContext()->shop->id;
            $sql = new DbQuery();
            $sql->select('*');
            $sql->from('favorite_products', 'c');
            $sql->where('id_customer = ' . (int)$id_customer);
            $sql->where('id_shop = ' . (int)$id_shop);

            if ($db->executeS($sql)) {
                $sql = 'DELETE FROM `' . _DB_PREFIX_ . 'favorite_products` WHERE `id_customer`= ' . (int)$id_customer;
                $db->execute($sql);

                $this->context->smarty->assign(array(
                    'result' => 'All product delete where customer id=' . (int)$id_customer,
                ));
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
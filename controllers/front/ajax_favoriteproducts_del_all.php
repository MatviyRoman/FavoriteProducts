<?php

class FavoriteProductsAjax_FavoriteProducts_Del_AllModuleFrontController extends ModuleFrontController
{
    public function initContent()
    {
        // if (Context::getContext()->customer->logged && isset($_POST['product'])) {
        if (Context::getContext()->customer->logged) {

            $db = Db::getInstance();
            $id_customer = (int)$this->context->customer->id;
            $id_shop = (int)Context::getContext()->shop->id;

            $sql = new DbQuery();
            $sql->select('*');
            $sql->from('favorite_products', 'c');
            $sql->where('id_customer = ' . (int)$id_customer);
            $sql->where('id_shop = ' . (int)$id_shop);


            // $sql = 'SELECT * FROM `' . _DB_PREFIX_ . 'favorite_products` WHERE `id_customer` = :id_customer AND `id_product` = :id_product';
            // $db->execute($sql);
            //var_dump($db->executeS($sql));

            if ($db->executeS($sql)) {
                $sql = 'DELETE FROM `' . _DB_PREFIX_ . 'favorite_products` WHERE `id_customer`= ' . (int)$id_customer;

                $db->execute($sql);

                // echo 'DELETE FROM `ps_favorite_products` WHERE `id_product`= ' . $id_product . ' AND `id_customer`= ' . $id_customer . ' LIMIT 1<br>';

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
            // return $this->setTemplate("module:favoriteproducts/views/templates/front/show-info.tpl");
        }
        parent::initContent();
        return $this->setTemplate("module:favoriteproducts/views/templates/front/show-info.tpl");
    }
}
<?php

class FavoriteProductsJson_FavoriteProductsModuleFrontController extends ModuleFrontController
{
    public function initContent()
    {
        parent::initContent();
        if (Context::getContext()->customer->logged) {
            //if (Context::getContext()->customer->logged) {

            $db = Db::getInstance();
            //$id_product = (int)$_GET['product'];
            $id_customer = (int)$this->context->customer->id;
            $id_shop = (int)Context::getContext()->shop->id;

            $sql = new DbQuery();
            $sql->select('id_product');
            $sql->from('favorite_products');
            $sql->where('id_customer = ' . (int)$id_customer);

            //var_dump($db->executeS($sql));

            echo json_encode($db->executeS($sql));

            $this->context->smarty->assign(array(
                //'json' => json_encode($db->executeS($sql)),
                //'json' => ($db->executeS($sql)),
            ));
            return $this->setTemplate("module:favoriteproducts/views/templates/front/json/json_favoriteproducts.tpl");
        } else {
            $this->context->smarty->assign(array(
                'error' => 'ERROR you need to register',
            ));
            return $this->setTemplate("module:favoriteproducts/views/templates/front/show-info.tpl");
        }
    }
}
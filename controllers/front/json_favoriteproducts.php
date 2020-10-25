<?php

class FavoriteProductsJson_FavoriteProductsModuleFrontController extends ModuleFrontController
{
    public function initContent()
    {
        parent::initContent();
        if (Context::getContext()->customer->logged) {
            $db = Db::getInstance();
            $id_customer = (int)$this->context->customer->id;
            $sql = new DbQuery();
            $sql->select('id_product');
            $sql->from('favorite_products');
            $sql->where('id_customer = ' . (int)$id_customer);

            echo json_encode($db->executeS($sql));

            return $this->setTemplate("module:favoriteproducts/views/templates/front/json/json_favoriteproducts.tpl");
        } else {
            $this->context->smarty->assign(array(
                'error' => 'ERROR you need to register',
            ));
            return $this->setTemplate("module:favoriteproducts/views/templates/front/show-info.tpl");
        }
    }
}
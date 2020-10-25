<?php

class FavoriteProductsAjax_FavoriteProducts_AddModuleFrontController extends ModuleFrontController
{
    public function initContent()
    {
        if (Context::getContext()->customer->logged && isset($_POST['product'])) {
            $db = Db::getInstance();
            $id_product = (int)$_POST['product'];
            $id_customer = (int)$this->context->customer->id;
            $id_shop = (int)Context::getContext()->shop->id;
            $sql = new DbQuery();
            $sql->select('*');
            $sql->from('favorite_products', 'c');
            $sql->innerJoin('product_lang', 'l', 'c.id_product = l.id_product AND l.id_product = ' . (int)$id_product);
            $sql->where('id_customer = ' . (int)$id_customer);
            $sql->orderBy('c.id_product');

            if ($db->executeS($sql)) {
                $sql = 'DELETE FROM `' . _DB_PREFIX_ . 'favorite_products` WHERE `id_product`= ' . (int)$id_product . ' AND `id_customer`= ' . (int)$id_customer . ' LIMIT 1';
                $db->execute($sql);
                $this->context->smarty->assign(array(
                    'result' => 'Delete Product id=' . (int)$id_product,
                ));
            } else {
                $db->insert('favorite_products', array(
                    'id_product' => (int)$id_product,
                    'id_customer'      => (int)$id_customer,
                    'id_shop'      => (int)$id_shop,
                    'date_add'  => date('Y-m-d H:i:s'),
                ));

                $this->context->smarty->assign(array(
                    'result' => 'Add Product id=' . (int)$id_product,
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
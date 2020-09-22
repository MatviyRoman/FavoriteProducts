<?php

class FavoriteProductsAjax_FavoriteProducts_AddModuleFrontController extends ModuleFrontController
{
    public function initContent()
    {
        if (Context::getContext()->customer->logged && isset($_POST['product'])) {
            //if (Context::getContext()->customer->logged) {

            $db = Db::getInstance();
            $id_product = (int)$_POST['product'];
            //$id_product = (int)$_GET['product'];
            $id_customer = (int)$this->context->customer->id;
            $id_shop = (int)Context::getContext()->shop->id;

            //$name = Tools::getValue('name');

            $sql = new DbQuery();
            $sql->select('*');
            $sql->from('favorite_products', 'c');
            $sql->innerJoin('product_lang', 'l', 'c.id_product = l.id_product AND l.id_product = ' . (int)$id_product);
            $sql->where('id_customer = ' . (int)$id_customer);
            $sql->orderBy('c.id_product');


            // $sql = 'SELECT * FROM `' . _DB_PREFIX_ . 'favorite_products` WHERE `id_customer` = :id_customer AND `id_product` = :id_product';
            // $db->execute($sql);
            //var_dump($db->executeS($sql));

            if ($db->executeS($sql)) {
                //DELETE FROM `ps_favorite_products` WHERE `id_product` = 0 AND `id_customer` = 4 LIMIT 1
                $sql = 'DELETE FROM `' . _DB_PREFIX_ . 'favorite_products` WHERE `id_product`= ' . (int)$id_product . ' AND `id_customer`= ' . (int)$id_customer . ' LIMIT 1';

                $db->execute($sql);

                // echo 'DELETE FROM `ps_favorite_products` WHERE `id_product`= ' . $id_product . ' AND `id_customer`= ' . $id_customer . ' LIMIT 1<br>';

                $this->context->smarty->assign(array(
                    'result' => 'Delete Product id=' . (int)$id_product,
                ));
            } else {
                $db->insert('favorite_products', array(
                    'id_product' => (int)$id_product,
                    'id_customer'      => (int)$id_customer,
                    'id_shop'      => (int)$id_shop,
                    'date_add'  => date('Y-m-d H:i:s'),

                    //'name'      => pSQL($name),  
                ));

                // echo 'INSERT INTO `ps_favorite_products`(`id_favorite_products`, `id_product`, `id_customer`, `id_shop`, `date_add`, `date_upd`) VALUES ([value-1],[value-2],[value-3],[value-4],[' . date('Y-m-d H:i:s') . '],[value-6])';

                $this->context->smarty->assign(array(
                    'result' => 'Add Product id=' . (int)$id_product,
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
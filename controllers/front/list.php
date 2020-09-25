<?php

class FavoriteProductsListModuleFrontController extends ModuleFrontController
{
    public function setMedia()
    {
        $this->registerStylesheet(
            'front-controller-module',
            'modules/' . $this->module->name . '/views/css/front/favoriteproducts-list.css',
            [
                'media' => 'all',
                'priority' => 1000,
            ]
        );

        $this->registerJavascript(
            'front-controller-module',
            'modules/' . $this->module->name . '/views/js/front/ajax/ajax_favoriteproducts_list.js',
            [
                'position' => 'bottom',
                'priority' => 1000,
            ]
        );

        $this->registerJavascript(
            'front-controller-module-del',
            'modules/' . $this->module->name . '/views/js/front/ajax/ajax_favoriteproducts_del.js',
            [
                'position' => 'bottom',
                'priority' => 1000,
            ]
        );

        return parent::setMedia();
    }


    public function initContent()
    {
        parent::initContent();
        if (Context::getContext()->customer->logged) {

            $db = Db::getInstance();
            $id_customer = (int)$this->context->customer->id;
            $id_shop = (int)Context::getContext()->shop->id;
            $id_lang = (int) Configuration::get('PS_LANG_DEFAULT');
            //$name = Tools::getValue('name');


            $sql = new DbQuery();
            $sql->select('*');
            $sql->from('favorite_products', 'c');
            //$sql->innerJoin('product_lang', 'l', 'c.id_product = l.id_product AND l.id_product = ' . (int)$id_product);
            $sql->innerJoin('product', 'p', 'c.id_product = p.id_product');
            $sql->innerJoin('tax', 't', 't.id_tax = p.id_tax_rules_group');
            $sql->innerJoin('product_lang', 'l', 'c.id_product = l.id_product');


            $sql->where('id_customer = ' . (int)$id_customer);
            //$sql->where('id_shop = ' . (int)$id_shop);
            $sql->orderBy('c.id_product');

            // $sql->select('id_currency');
            // $sql->from('currency_lang', 'cl1');
            // $sql->innerJoin('currency_lang', 'cl', 'cl.id_currency =' . $id_lang);


            //var_dump($db->executeS($sql));

            $contextObject = $this->context; // or this // $contextObject = Context::getContext();
            $this->context->smarty->assign(array(
                'id' => (int)$contextObject->customer->id,
                'first_name' => $contextObject->customer->firstname,
                'last_name' => $contextObject->customer->lastname,
                'email' => $contextObject->customer->email,
                'favoriteproducts' => $db->executeS($sql),
            ));
            return $this->setTemplate("module:favoriteproducts/views/templates/front/favoriteproducts-list.tpl");
        } else {
            $this->context->smarty->assign(array(
                'error' => 'ERROR you need to register',
            ));
            return $this->setTemplate("module:favoriteproducts/views/templates/front/show-info.tpl");
        }
    }
}

// index.php?fc=module&module=favoriteproducts&controller=list&id_lang=1
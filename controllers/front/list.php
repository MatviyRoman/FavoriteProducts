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
            'modules/' . $this->module->name . '/views/js/front/favoriteproducts-list.js',
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

            //$name = Tools::getValue('name');

            $sql = new DbQuery();
            $sql->select('*');
            $sql->from('favorite_products', 'c');
            //$sql->innerJoin('product_lang', 'l', 'c.id_product = l.id_product AND l.id_product = ' . (int)$id_product);
            $sql->innerJoin('product', 'p', 'c.id_product = p.id_product');
            $sql->innerJoin('product_lang', 'l', 'c.id_product = l.id_product');

            $sql->where('id_customer = ' . (int)$id_customer);
            //$sql->where('id_shop = ' . (int)$id_shop);
            $sql->orderBy('c.id_product');




            // // Your Product Id
            // $id_product = 1;
            // // Language id
            // $id_lang = (int) Configuration::get('PS_LANG_DEFAULT');
            // // Get cover image for your product
            // $image = Image::getCover($id_product);
            // // Load Product Object
            // $product = new Product($id_product);
            // // Initialize the link object
            // $link = new Link;
            // $imagePath = $link->getImageLink($product->link_rewrite[Context::getContext()->language->id], $image['id_image'], 'home_default');
            // echo $imagePath;
            // echo '<img src="http://' . $imagePath . '">';




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
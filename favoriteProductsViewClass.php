<?php

// class favoriteProductsClass extends ObjectModelCore
class favoriteProductsViewClass extends ObjectModel
{
    public $id_favorite_products;
    public $id_product;
    public $id_customer;
    // public $firstname;
    // public $lastname;
    public $id_shop;
    public $date_add;

    public static $definition = [
        'table' => 'favorite_products',
        'primary' => 'id_customer',
        'fields' => [
            'id_favorite_product' =>  ['type' => self::TYPE_INT, 'validate' => 'isUnsignedInt', 'required' => true,],
            'id_product' =>  ['type' => self::TYPE_INT, 'validate' => 'isUnsignedInt', 'required' => true,],
            'id_customer' =>  ['type' => self::TYPE_INT, 'validate' => 'isGenericName', 'required' => true,],
            // 'firstname' =>  ['type' => self::TYPE_STRING, 'validate' => 'isAnything', 'required' => true],
            // 'lastname' =>  ['type' => self::TYPE_STRING, 'validate' => 'isAnything', 'required' => true],
            'id_shop' =>  ['type' => self::TYPE_INT, 'validate' => 'isUnsignedInt', 'required' => true,],
            'date_add' =>  ['type' => self::TYPE_DATE, 'validate' => 'isDateFormat'],


            // 'description' =>  ['type' => self::TYPE_HTML, 'validate' => 'isAnything',],
            // 'created' =>  ['type' => self::TYPE_DATE, 'validate' => 'isDateFormat'],
            // 'id_pasta_category' => ['type' => self::TYPE_INT, 'validate' => 'isUnsignedInt', 'required' => true,],
        ],
    ];
}
<?php

class favoriteProductsViewClass extends ObjectModel
{
    public $id_favorite_products;
    public $id_product;
    public $id_customer;
    public $id_shop;
    public $date_add;

    public static $definition = [
        'table' => 'favorite_products',
        'primary' => 'id_customer',
        'fields' => [
            'id_favorite_product' =>  ['type' => self::TYPE_INT, 'validate' => 'isUnsignedInt', 'required' => true,],
            'id_product' =>  ['type' => self::TYPE_INT, 'validate' => 'isUnsignedInt', 'required' => true,],
            'id_customer' =>  ['type' => self::TYPE_INT, 'validate' => 'isGenericName', 'required' => true,],
            'id_shop' =>  ['type' => self::TYPE_INT, 'validate' => 'isUnsignedInt', 'required' => true,],
            'date_add' =>  ['type' => self::TYPE_DATE, 'validate' => 'isDateFormat'],
        ],
    ];
}
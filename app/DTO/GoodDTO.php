<?php

namespace App\DTO;

/**
 * @property int $type
 * @property string $name
 * @property string $description
 * @property float $price
 * @property bool $is_published
 */
class GoodDTO extends BaseDTO
{
    protected static function map(): array
    {
        return [
            'id'           => [ 'property' => 'id',           'type' => 'int' ],
            'name'         => [ 'property' => 'name',         'type' => 'string' ],
            'description'  => [ 'property' => 'description',  'type' => 'string' ],
            'price'        => [ 'property' => 'price',        'type' => 'float' ],
            'is_published' => [ 'property' => 'is_published', 'type' => 'bool' ]
        ];
    }
}

<?php

namespace App\DTO;

/**
 * @property int $type
 * @property string $name
 * @property string $description
 */
class CategoryDTO extends BaseDTO
{
    protected static function map(): array
    {
        return [
            'id'          => [ 'property' => 'id',          'type' => 'int' ],
            'name'        => [ 'property' => 'name',        'type' => 'string' ],
            'description' => [ 'property' => 'description', 'type' => 'string' ]
        ];
    }
}
